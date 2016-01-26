"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../globales/ScreenGlobalsMethods');

var SettingsScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    SettingsScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    this.app.SCS.static_context['identifiants_panels'] = this.app.sess.user;
    this.app.SCS.static_context['other_settings_panels'] = this.app.sess.user;
    SettingsScreen.parent.show.call(this, args);
  },

});

module.exports = SettingsScreen;
