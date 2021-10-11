'use strict';

const keyMirror = require('keymirror');

module.exports = {
  DEFAULT_STATE : {
    config : {
      ready : false
    },
    session : {
      connected : false
    },
  },
  ACTION_TYPES : keyMirror({
    APP_READY        : null,
    SET_CONFIG_STATE : null,
    LOGIN            : null,
    LOGOUT           : null
  })
};
