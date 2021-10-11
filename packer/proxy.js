'use strict';

const path      = require('path');

const express   = require('express');
const debug     = require('debug');

const defer     = require('nyks/promise/defer');

const Packer    = require('./');

const HTTP_PORT = 8000;

class Proxy {

  constructor() {
    this.log    = debug('RLM:Proxy');
    this.packer = new Packer();
  }

  async dev_mode(deploy_dir) /**
  * @param string [deploy_dir=www]
  */ {
    await Promise.all([this.packer.watch(deploy_dir), this.run(deploy_dir)]);
  }

  async run(deploy_dir) /**
  * @param string [deploy_dir=www]
  */ {
    this.log('Running proxy');

    this.app = express();

    this.app.use((req, res, next) => {
      this.log('Incoming query', req.url);
      next();
    });

    this.app.use('/', express.static(deploy_dir));
    this.app.get('/*', (req, res) => {
      res.sendFile(path.join(__dirname, '..', deploy_dir, 'index.html'));
    });

    let defered = defer();
    let server  = this.app.listen(HTTP_PORT, defered.resolve);

    await defered;

    return {close : server.close.bind(server)};
  }

}

module.exports = Proxy;
