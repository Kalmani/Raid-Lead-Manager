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
      this.SCS.panels_list = {
        'profile_panel' : 'profile_missing_panel',
        'missing_panel' : 'profile_missing_panel',
        'updates_panel' : 'profile_missing_panel',
        'items_list_panel' : 'stuff_panel'
      };
      this.SCS.switchScreen('home_main', dom);
    }.bind(this));
  },

  show : function(args) {
    console.log(this.ID);
  },

});
