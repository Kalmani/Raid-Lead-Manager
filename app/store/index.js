'use strict';

const reducers       = require('./reducers');
const {createLogger} = require('redux-logger');
const thunk          = require('redux-thunk').default;

module.exports = Redux.createStore(
  reducers,
  Redux.applyMiddleware(thunk, createLogger())
);
