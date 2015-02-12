var HomeScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  Binds : ['show', 'callback_login'],

  panels_list : [
    {'profile_panel' : {'id' : 'profile_missing_panel', 'animate' : 'fadeIn', 'namespace' : 'character', 'action' : 'show_profile'}},
    {'missing_panel' : {'id' : 'profile_missing_panel', 'animate' : 'fadeIn'}},
    {'updates_panel' : {'id' : 'profile_missing_panel', 'animate' : 'flash', 'namespace' : 'base', 'action' : 'show_last_notes'}},
    {'items_list_panel' : {'id' : 'stuff_panel', 'animate' : 'fadeIn'}}
  ],
  initial_zones : [
    'profile_missing_panel',
    'stuff_panel'
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
      this.app.loading(document.id('login_panel'));
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
      this.app.alertMessage('error', response.error, document.id('login_panel'));
    } else if (response.warning) {
      this.app.alertMessage('warning', response.warning, document.id('login_panel'));
    } else if (response.success) {
      if (this.app.sess.login(response.user_datas)) {
        this.app.alertMessage('success', response.success, document.id('login_panel'));
        this.app.make_nav();
        this.SCS.switchRubric('HOME');
      } else {
        this.app.alertMessage('error', response.error_case, document.id('login_panel'));
      }
    }
  },

  show : function(args) {
    this.parent(args);
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
