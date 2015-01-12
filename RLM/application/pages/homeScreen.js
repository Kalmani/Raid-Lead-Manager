var HomeScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  active : false,

  initialize : function(app, screen_id) {
    this.ID = screen_id;
    this.parent(app);
    this.scs = this.app.SCS;
    console.log('initializing HomeScreen');
  },


  show_login_panel : function() {
    this.scs.pZone = document.getElementById('main_container');
    this.scs.pName = 'login_tpl';

    var zone = this.scs.switchPanel();

    zone.getElementById('login_try').addEvent('click', function() {
      this.scs.sName = 'home_main';
      this.scs.sZone = document.getElementById('main_container');
      this.scs.switchScreen();
    }.bind(this));
  }

});
