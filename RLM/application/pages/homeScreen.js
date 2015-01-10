var HomeScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id) {
    this.ID = screen_id;
    this.parent(app);
    console.log('initializing HomeScreen');
  },


  show_login_panel : function() {
    this.app.ScreenSwitch.panel_zone = document.getElementById('login_container'),
    this.app.ScreenSwitch.panel_name = 'login_tpl';

    var zone = this.app.ScreenSwitch.switchPanel();

    zone.getElementById('login_try').addEvent('click', function() {
      console.log('ok');
      this.app.ScreenSwitch.panel_name = 'login_tpl_test';
      this.app.ScreenSwitch.switchPanel();
    }.bind(this));
  }

});
