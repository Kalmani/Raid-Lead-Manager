"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../globales/ScreenGlobalsMethods');

var HomeScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  Binds : ['show'],

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    HomeScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = app.SCS;
  },

  show_login_panel : function() {
    HomeScreen.parent.show_login_panel.call(this);
    var dom = document.getElementById('main_container'),
        zone = this.SCS.switchPanel('login_tpl', dom);
  },

  show : function(args) {
    HomeScreen.parent.show.call(this, args);
  },

  items_list : function() {
    var context = {'left' : new Array(), 'right' : new Array()},
        item = 0;
    Object.each(this.parent(), function(item_datas, key) {
      item_datas.item_url = null;
      if (item_datas.item_caracs)
        item_datas.item_url = item_datas.item_caracs.join('&amp;');
      var current = item_datas;
      if (item < 8) {
        context.left[context.left.length] = current;
      } else {
        context.right[context.right.length] = current;
      }
      item++;
    });
    return context;
  },

  import_character_screen : function() {
    var self = this;

    self.app.SCS.switchPanel('import_character', document.getElement('#cell_profile_panel .panel-body'), 'fadeIn');
  }

});

module.exports = HomeScreen;
