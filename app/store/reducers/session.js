'use strict';

const AppConstants  = require('../../AppConstants');
const ACTION_TYPES  = AppConstants.ACTION_TYPES;
const DEFAULT_STATE = AppConstants.DEFAULT_STATE;

const reducer = (state = DEFAULT_STATE.session, {type, payload}) => {
  switch(type) {
    case ACTION_TYPES.LOGIN: {
      var session_data = {
        connected  : true,
      };

      return {...state, ...session_data};
    } case ACTION_TYPES.LOGOUT: {
      return {...state, ...DEFAULT_STATE.session};
    } default: {
      return {...state};
    }
  }
};

module.exports = reducer;
