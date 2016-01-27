"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../globales/ScreenGlobalsMethods');

var WishlistScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  Binds : ['bind_btn'],

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    WishlistScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    console.log(this.ID);
    WishlistScreen.parent.show.call(this, args);
  },

  show_add_item_page : function(slot) {
    this.app.remove_all = true;
    var dom = document.id('main_container');
    dom.empty();

    this.app.SCS.panels_list = {
      'change_item' : {'id' : 'change_item', 'animate' : 'fadeIn'}
    };
    this.app.SCS.switchScreen('select_wish_item', dom);


    // load async items list
    var options = {
          'success' : function(response) {
            var items = JSON.parse(response);
            this.add_items(items);
          }.bind(this)
        },
        params = {
          'slot' : slot
        },
        namespace = 'items',
        action = 'list_items';
    this.app.ask_server(namespace, action, params, options);
  },

  add_items : function(items) {
    var container = document.id('current_item'),
        context = {
          'current_item' : items.current_item
        }
    this.app.render('current_item', context).inject(container);

    var container = document.id('items_list_wish');
    var i = 0;
    Array.each(items.items_list, function(item, key) {
      var context = {
            'item' : item
          },
          element = this.app.render('item_bloc', context),
          bloc_container = new Element('div', {'class' : "col-md-6 col-sm-12 col-xs-12"});
      element.inject(bloc_container);
      bloc_container.inject(container);
      i++;
      if (i%2 === 0) {
        var clearer = new Element('div', {'style' : 'clear:both;'});
        clearer.inject(container);
      }
    }.bind(this));
  },

  show_chose_item : function(id) {
    var options = {
          'success' : function(response) {
            var item = JSON.parse(response);
            this.app.SCS.context = item;
            this.app.SCS.switchPanel('selected_bis', document.id('selected_bis'), 'fadeIn');
          }.bind(this)
        },
        params = {
          'id' : id
        },
        namespace = 'items',
        action = 'show_item';
    this.app.ask_server(namespace, action, params, options);
  }

});

module.exports = WishlistScreen;
