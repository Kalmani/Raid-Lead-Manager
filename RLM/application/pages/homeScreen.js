var HomeScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id) {
    this.ID = screen_id;
    this.parent(app);
    console.log('initializing HomeScreen');
  },


  show_login_panel : function() {
    this.app.ScreenSwitch.panel_zone = document.getElementById('login_container');
    this.app.ScreenSwitch.panel_name = 'login_tpl';
    this.app.ScreenSwitch.switchPanel();
  }

});
