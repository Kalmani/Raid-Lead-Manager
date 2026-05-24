'use strict';

require('./load-env');

const {createApp} = require('./app');

async function startServer(options = {}) {
  const app = createApp(options);
  const port = Number(options.port || process.env.PORT) || 8000;
  const host = options.host || process.env.HOST || 'localhost';

  return new Promise((resolve, reject) => {
    const server = app.listen(port, host, () => {
      console.log(`Backend listening on http://${host}:${port}`);
      resolve(server);
    });

    server.on('error', reject);
  });
}

if (require.main === module) {
  startServer().catch((error) => {
    console.error(error);
    process.exitCode = 1;
  });
}

module.exports = {
  startServer
};
