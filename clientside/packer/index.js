'use strict';

const fs = require('fs');
const path = require('path');

const browserify = require('browserify');
const watchify = require('watchify');
const sass = require('sass');
const CleanCSS = require('clean-css');
const babelify = require('babelify');

const {
  ROOT_DIR,
  SOURCE_DIR,
  CONFIG_DIR,
  DEFAULT_DEPLOY_DIR
} = require('./constants');

class Packer {

  constructor() {
    this.watchers = [];
  }

  async deploy(targetDir = DEFAULT_DEPLOY_DIR) {
    this.ensureOutputTree(targetDir);
    await this.buildConfig(targetDir);
    this.copyIndex(targetDir);
    this.buildCss(targetDir);
    await this.buildApp(targetDir, false);
  }

  async watch(targetDir = DEFAULT_DEPLOY_DIR) {
    this.ensureOutputTree(targetDir);
    await this.buildConfig(targetDir);
    this.copyIndex(targetDir);
    this.buildCss(targetDir);
    await this.buildApp(targetDir, true);

    this.registerWatcher(path.join(SOURCE_DIR, 'theme', '_main.scss'), {}, () => {
      this.buildCss(targetDir);
    });

    this.registerWatcher(path.join(SOURCE_DIR, 'rsrcs'), {}, () => {
      this.copyIndex(targetDir);
    });

    this.registerWatcher(CONFIG_DIR, {recursive : false}, async (eventType, filename) => {
      if (filename && filename.endsWith('.json')) {
        await this.buildConfig(targetDir);
      }
    });
  }

  ensureOutputTree(targetDir) {
    this.ensureDir(targetDir);
    this.ensureDir(path.join(targetDir, 'theme'));
  }

  ensureDir(targetPath) {
    fs.mkdirSync(targetPath, {recursive : true});
  }

  registerWatcher(targetPath, options, onChange) {
    if (!fs.existsSync(targetPath)) {
      return;
    }

    const watcher = fs.watch(targetPath, options, onChange);
    this.watchers.push(watcher);
  }

  buildCss(targetDir) {
    const sourcePath = path.join(SOURCE_DIR, 'theme', '_main.scss');
    const targetPath = path.join(targetDir, 'theme', 'main.css');
    const compiled = sass.renderSync({file : sourcePath, outputStyle : 'expanded'});
    const minified = new CleanCSS({level : 2}).minify(compiled.css.toString());
    fs.writeFileSync(targetPath, minified.styles);
  }

  copyIndex(targetDir) {
    const sourcePath = path.join(SOURCE_DIR, 'rsrcs', 'index.html');
    const targetPath = path.join(targetDir, 'index.html');
    fs.copyFileSync(sourcePath, targetPath);
  }

  async buildConfig(targetDir) {
    const targetPath = path.join(targetDir, 'config.json');
    const fileNames = fs.readdirSync(CONFIG_DIR)
      .filter((fileName) => fileName.endsWith('.json'))
      .sort();

    const merged = fileNames.reduce((accumulator, fileName) => {
      const sourcePath = path.join(CONFIG_DIR, fileName);
      const fileContent = JSON.parse(fs.readFileSync(sourcePath, 'utf8'));
      return {...accumulator, ...fileContent};
    }, {});

    merged.version = await this.resolveVersion();

    fs.writeFileSync(targetPath, JSON.stringify(merged, null, 2));
  }

  async resolveVersion() {
    const gitHead = path.join(ROOT_DIR, '.git', 'HEAD');

    try {
      const headRef = fs.readFileSync(gitHead, 'utf8').trim();
      if (!headRef.startsWith('ref: ')) {
        return headRef.slice(0, 7);
      }

      const refPath = headRef.replace('ref: ', '');
      const absoluteRefPath = path.join(ROOT_DIR, '.git', refPath);
      const commit = fs.readFileSync(absoluteRefPath, 'utf8').trim();
      return commit.slice(0, 7);
    } catch (error) {
      return 'dev';
    }
  }

  createBundler(targetDir, watching) {
    const entryFile = path.join(SOURCE_DIR, 'app', 'init.js');
    const targetFile = path.join(targetDir, 'app.js');
    const options = {
      entries : [entryFile],
      extensions : ['.js'],
      cache : {},
      packageCache : {},
      debug : watching,
      commondir : false
    };

    const bundler = browserify(options).transform(babelify, {
      global : true,
      babelrc : false,
      presets : ['@babel/preset-env', '@babel/preset-react']
    });

    if (watching) {
      bundler.plugin(watchify);
      bundler.on('update', () => this.bundle(bundler, targetFile, true));
    }

    return {bundler, targetFile};
  }

  async buildApp(targetDir, watching) {
    const {bundler, targetFile} = this.createBundler(targetDir, watching);
    await this.bundle(bundler, targetFile, watching);
  }

  bundle(bundler, targetFile, watching) {
    return new Promise((resolve, reject) => {
      const stream = fs.createWriteStream(targetFile);

      bundler.bundle((error) => {
        if (error) {
          if (watching) {
            console.error(error.message);
            resolve();
            return;
          }

          reject(error);
        }
      }).pipe(stream);

      stream.on('close', resolve);
      stream.on('error', reject);
    });
  }

}

module.exports = Packer;
module.exports.DEFAULT_DEPLOY_DIR = DEFAULT_DEPLOY_DIR;
