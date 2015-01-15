var HomeScreen = new Class ({

  Extends : ScreenGlobalsMethods,

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
      // bind login try here
    }.bind(this));
  },

  show : function(args) {
    this.parent(args);
    var dom = document.getElementById('main_container');
    this.SCS.panels_list = {
      'profile_panel' : {'id' : 'profile_missing_panel', 'animate' : 'fadeIn'},
      'missing_panel' : {'id' : 'profile_missing_panel', 'animate' : 'fadeIn'},
      'updates_panel' : {'id' : 'profile_missing_panel', 'animate' : 'flash'},
      'items_list_panel' : {'id' : 'stuff_panel', 'animate' : 'fadeIn'}
    };
    this.SCS.switchScreen('home_main', dom);
  },

});
