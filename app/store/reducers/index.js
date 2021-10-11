'use strict';

module.exports = Redux.combineReducers({
  config  : require('./config'),
  session : require('./session')
});
