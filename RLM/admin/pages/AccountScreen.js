"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../../application/globales/ScreenGlobalsMethods');

var AccountScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    AccountScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    this.parent(args);
    console.log(this.ID);
  }

});

module.exports = AccountScreen;
