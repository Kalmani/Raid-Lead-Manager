var HomeScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  Binds : ['show', 'callback_login', 'inject_home_panels'],

  panels_list : [
    {'profile_panel' : {'id' : 'profile_missing_panel', 'animate' : 'fadeIn', 'namespace' : 'character', 'action' : 'show_profile'}},
    {'missing_panel' : {'id' : 'profile_missing_panel', 'animate' : 'fadeIn'}},
    {'updates_panel' : {'id' : 'profile_missing_panel', 'animate' : 'flash', 'namespace' : 'base', 'action' : 'show_last_notes'}},
    {'items_list_panel' : {'id' : 'stuff_panel', 'animate' : 'fadeIn'}}
  ],

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    this.parent(app);
    this.SCS = this.app.SCS;
  },


  show_login_panel : function() {
    var dom = document.getElementById('main_container'),
        zone = this.SCS.switchPanel('login_tpl', dom);

    zone.getElementById('login_try').addEvent('click', function() {
      this.app.loading(document.id('main_container'));
      var pseudo = document.id('identifiant').value,
          pass = document.id('password').value;
      this.try_login(pseudo, pass);
    }.bind(this));
  },

  try_login : function(pseudo, pass) {
    var options = {
          'success' : this.callback_login
        },
        params = {
          'pseudo' : pseudo,
          'pass' : pass
        };
    this.app.ask_server('account', 'login', params, options);
  },

  callback_login : function(response) {
    var response = JSON.parse(response);
    if (response.error) {
      this.app.alertMessage('error', response.error, document.id('main_container'));
    } else if (response.warning) {
      this.app.alertMessage('warning', response.warning, document.id('main_container'));
    } else if (response.success) {
      this.app.alertMessage('success', response.success, document.id('main_container'));
    }
  },

  show : function(args) {
    this.parent(args);
    var dom = document.getElementById('main_container');
    this.SCS.switchScreen('home_main', dom);
    this.context_list = new Array();
    var panels = this.panels_list.clone();
    this.build_home_panel(panels);
    this.app.addEvent('panels_ready', function() {
      this.inject_home_panels();
    }.bind(this));
  },

  //j'aime pas
  build_home_panel : function(panels_list) {
    var panel = panels_list.shift(),
        id = Object.keys(panel)[0],
        datas = panel[id];
    if (datas.namespace) {
      var options = {
        'success' : function(response) {
          var context = JSON.parse(response);
          this.context_list[this.context_list.length] = context;
          if (panels_list.length > 0) {
            this.build_home_panel(panels_list);
          } else {
            this.app.fireEvent('panels_ready');
          }
        }.bind(this)
      },
      params = {
      };
      this.app.ask_server(datas.namespace, datas.action, params, options);
    } else {
      this.context_list[this.context_list.length] = {};
      if (panels_list.length > 0) {
        this.build_home_panel(panels_list);
      } else {
        this.app.fireEvent('panels_ready');
      }
    }
  },

  inject_home_panels : function() {
    for (var i = 0; i < this.panels_list.length; i++) {
      var id = Object.keys(this.panels_list[i])[0],
          datas = this.panels_list[i][id],
          dom = document.id(datas.id);
      console.log(this.context_list[i]);
      this.SCS.context = this.context_list[i];
      this.SCS.switchPanel(id, dom, datas.animate);
    }
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

});
