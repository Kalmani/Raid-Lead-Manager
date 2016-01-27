"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../../application/globales/ScreenGlobalsMethods');

var CalendarScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    CalendarScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    CalendarScreen.parent.show.call(this, args);
    console.log(this.ID);
  },

});

module.exports = CalendarScreen;
