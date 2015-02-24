var WishlistScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  Binds : ['bind_btn'],

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    this.parent(app);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    console.log(this.ID);
    this.parent(args);
    this.app.addEvent('asyn_panel_ready', function(panel_id) {
      if (panel_id == 'wish_list_panel') {
        Object.each(document.getElements('.refresh_item'), function(elem) {
          if (typeof(elem) !== 'number') {
            var slot = elem.get('id').split('_')[1];
            elem.removeEvents('click');
          }
        }.bind(this));
      }
    }.bind(this));
  },

  show_add_item_page : function(slot) {
    this.app.remove_all = true;
    var dom = document.id('main_container');
    dom.empty();

    this.app.SCS.panels_list = {
      'current_item' : {'id' : 'current_item', 'animate' : 'fadeIn'},
      'selected_bis' : {'id' : 'selected_bis', 'animate' : 'fadeIn'},
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
    var container = document.id('items_list_wish');
    Array.each(items, function(item, key) {
      var context = {
            'item' : item
          },
          element = this.app.render('item_bloc', context);
          bloc_container = new Element('div', {'class' : "col-md-4 col-sm-6 col-xs-12"});
      element.inject(bloc_container);
      bloc_container.inject(container);
    }.bind(this));
  },

});
