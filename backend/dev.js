'use strict';

require('./load-env');

const Packer = require('../clientside/packer');
const {startServer} = require('./server');

async function main() {
  const packer = new Packer();

  await packer.deploy();
  await packer.watch();
  await startServer();
}

main().catch((error) => {
  console.error(error);
  process.exitCode = 1;
});
