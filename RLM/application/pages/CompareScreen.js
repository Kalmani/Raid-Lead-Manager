"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../globales/ScreenGlobalsMethods');

var CompareScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    CompareScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    CompareScreen.parent.show.call(this, args);
  },

});

module.exports = CompareScreen;
