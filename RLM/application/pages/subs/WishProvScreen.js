"use strict";

var Class          = require('uclass'),
    WishlistScreen = require('../WishlistScreen');

var WishProvScreen = new Class ({

  Extends : WishlistScreen,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    WishProvScreen.parent.initialize.call(this, app, screen_id, screen_data);
    this.SCS = this.app.SCS;
    this.parentID = "WISH_LIST";
  },

  show : function(args) {
    this.parent(args);
  }

});

module.exports = WishProvScreen;
