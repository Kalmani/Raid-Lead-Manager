'use strict';

const path = require('path');

const ROOT_DIR = path.resolve(__dirname, '..', '..');
const SOURCE_DIR = path.join(ROOT_DIR, 'clientside');
const CONFIG_DIR = path.join(ROOT_DIR, 'config');
const DEFAULT_DEPLOY_DIR = path.join(ROOT_DIR, 'RLM');

module.exports = {
  ROOT_DIR,
  SOURCE_DIR,
  CONFIG_DIR,
  DEFAULT_DEPLOY_DIR
};
