'use strict';

const fs          = require('fs');

const browserify  = require('browserify');
const debug       = require('debug');
const glob        = require('glob').sync;
const uglify      = require('uglify-es');
const watchify    = require('watchify');

const copyFiles   = require('nyks/fs/copyFiles');
const deleteFold  = require('nyks/fs/deleteFolderRecursive');
const mkdirpSync  = require('nyks/fs/mkdirpSync');
const defer       = require('nyks/promise/defer');
const sprintf     = require('nyks/string/format');

class Packer {

  constructor() {
    this.log = debug('RML:Packer');
  }

  clean_app(deploy_dir) /**
  * @param string [deploy_dir=www]
  */ {
    deleteFold(deploy_dir);
    mkdirpSync(deploy_dir);
  }

  async deploy(deploy_dir) /**
  * @param string [deploy_dir=www]
  */ {
    this.log(`Deploy app in ${deploy_dir}`);

    this.clean_app(deploy_dir);
    this.copy_statics(deploy_dir);
    await this.build_app(deploy_dir);
  }

  async build_app(deploy_dir) /**
  * @param string [deploy_dir=www]
  */ {
    if(!fs.existsSync(deploy_dir))
      fs.mkdirSync(deploy_dir);

    await this.browserify(deploy_dir, false);

    //let source_path = sprintf('%s/app.js', deploy_dir);

    //await this.babelify(source_path, ['@babel/preset-env'].map(require.resolve));
    //await this.uglify(source_path);
  }

  async watch(deploy_dir) /**
  * @param string [deploy_dir=www]
  */ {
    await this.browserify(deploy_dir, true);
  }

  async browserify(deploy_dir, watching) /**
  * @param string [deploy_dir=www]
  * @param boolean [watching=false]
  */ {
    const target_path = sprintf('%s/%s', deploy_dir, 'app.js');

    var b = browserify({
      node         : false,
      cache        : {},
      commondir    : false,
      entries      : [
        require.resolve('regenerator-runtime/runtime'),
        'app/init.js'
      ],
      packageCache : {}
    });

    //b.plugin(discify);
    //b.transform('browserify-shim');

    if(watching) {
      b.plugin(watchify);
      b.transform({global : true, presets : ['@babel/preset-react'], plugins : ['@babel/plugin-proposal-object-rest-spread']}, 'babelify');
    } else {
      b.transform({global : true, babelrc : false, presets : ['@babel/preset-react'], plugins : ['@babel/plugin-proposal-object-rest-spread']}, 'babelify');
    }

    return this._browserify(b, target_path, watching);
  }

  _browserify(b, outpath, watching) {
    var self    = this;
    var defered = defer();

    var bundle = function () {
      var target = fs.createWriteStream(outpath);
      var end    = function() {
        if(!watching)
          defered.resolve();
      };

      b.once('discified', end);

      b.bundle((err) => {
        if(err) {
          if(watching) {
            if(err.loc && err.filename)
              self.log('Error with Browserify on file %s %s', err.filename, JSON.stringify(err.loc));
            else
              self.log(err);
          } else {
            return defered.reject(err);
          }
        }
        self.log('', 'Updated files.');
      }).pipe(target);
    };

    b.on('update', bundle);
    bundle();

    return defered;
  }

  async copy_statics(deploy_dir) /**
  * @param string [deploy_dir=www]
  */ {
    this.log(`Copying static files in ${deploy_dir}`);

    let statics  = [
      {files : '**', target : deploy_dir, options : {dot : true, cwd : 'rsrcs'}}
    ];

    statics.forEach((toCopy) => {
      copyFiles(glob(toCopy.files, toCopy.options), toCopy.target, toCopy.options);
    });
  }

  async uglify(source, target) /**
  * @param string [source]
  * @param string [target=false]
  */ {
    this.log(`Minify js file ${target || source}`);

    let comments     = /(?:^!|@(?:license|preserve|cc_on))/;
    let file_content = fs.readFileSync(source, 'utf8');
    let minified     = uglify.minify(file_content, {output : {comments}});

    if(target)
      fs.unlinkSync(source);

    fs.writeFileSync((target || source), minified.code);
  }

  async build_vendors() {
    process.env.NODE_ENV = 'production';

    let vendors_src    = 'app/_vendors.js';
    let vendors_target = 'rsrcs/vendors.js';
    let presets        = ['@babel/preset-env'].map(require.resolve);

    this.log(`Building in ${vendors_target} with preset(s) ${presets.join(', ')}`);

    var defered       = defer();
    var b             = browserify({
      commondir       : false,
      entries         : [vendors_src]
    });

    b.transform({global : true, babelrc : false, presets}, 'babelify');

    function bundle() {
      var target = fs.createWriteStream(vendors_target);

      target.on('close', defered.resolve);

      b.bundle((err) => {
        if(err)
          return defered.reject(err);
      }).pipe(target);
    }

    b.on('update', bundle);
    bundle();

    await defered;

    this.uglify(vendors_target);
  }

}

module.exports = Packer;
