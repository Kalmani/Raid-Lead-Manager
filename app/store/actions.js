'use strict';
/* global ga */

const {reject}       = require('mout/array');
const {forOwn, get}  = require('mout/object');
const {startsWith}   = require('mout/string');
const sprintf        = require('nyks/string/format');

const {ACTION_TYPES} = require('../AppConstants');

const {json} = require('../utils');

const actions = {
  setAppReady    : (payload) => (dispatch) => dispatch({type : ACTION_TYPES.APP_READY, payload}),
  setConfigState : (payload) => (dispatch) => dispatch({type : ACTION_TYPES.SET_CONFIG_STATE, payload})
};


const initApp = (history) => async (dispatch) => {
  let config = await json(`/config.json?${Math.random()}`);

  dispatch(actions.setConfigState(config));
  dispatch(actions.setAppReady());
};

module.exports = {
  ...actions,
  initApp
};
