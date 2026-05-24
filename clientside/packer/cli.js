'use strict';

const path = require('path');

const ProxyServer = require('./proxy');
const {DEFAULT_DEPLOY_DIR} = require('./constants');

async function main() {
  const command = process.argv[2] || 'start';
  const deployDir = process.argv[3] ? path.resolve(process.argv[3]) : DEFAULT_DEPLOY_DIR;
  const proxy = new ProxyServer();

  if (command === 'build') {
    const Packer = require('./index');
    const packer = new Packer();
    await packer.deploy(deployDir);
    return;
  }

  if (command === 'watch') {
    const Packer = require('./index');
    const packer = new Packer();
    await packer.watch(deployDir);
    return;
  }

  if (command === 'serve') {
    await proxy.run(deployDir);
    return;
  }

  if (command === 'start') {
    await proxy.run(deployDir);
    return;
  }

  if (command === 'dev') {
    const Packer = require('./index');
    const packer = new Packer();
    await packer.deploy(deployDir);
    await packer.watch(deployDir);
    await proxy.run(deployDir);
    return;
  }

  throw new Error(`Unknown command "${command}"`);
}

main().catch((error) => {
  console.error(error);
  process.exitCode = 1;
});
