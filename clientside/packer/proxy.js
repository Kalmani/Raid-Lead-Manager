'use strict';

const path = require('path');

const express = require('express');

const {DEFAULT_DEPLOY_DIR} = require('./constants');

class ProxyServer {

  attach(app, targetDir = DEFAULT_DEPLOY_DIR) {
    app.use('/', express.static(targetDir));
    app.get('*', (req, res, next) => {
      if (req.method !== 'GET') {
        next();
        return;
      }

      res.sendFile(path.join(targetDir, 'index.html'));
    });
  }

  async run(targetDir = DEFAULT_DEPLOY_DIR, port = Number(process.env.PORT) || 8000, host = process.env.HOST || 'localhost') {
    const app = express();

    this.attach(app, targetDir);

    return new Promise((resolve, reject) => {
      const server = app.listen(port, host, () => {
        console.log(`Proxy listening on http://${host}:${port}`);
        resolve(server);
      });

      server.on('error', reject);
    });
  }

}

module.exports = ProxyServer;
