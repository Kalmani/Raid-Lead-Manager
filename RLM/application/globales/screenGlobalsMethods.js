var ScreenGlobalsMethods = new Class ({

  active : false,
  link : false,
  subs : false,

  initialize : function(app) {
    this.app = app;
    console.log('initializing ' + this.data.className);
    this.is_active();
    this.get_nav_component();
  },

  is_active : function() {
    // tu as ce dont tu as besoin ici : this.ID / this.data
    this.active = true;
  },

  get_nav_component : function() {
    if (this.active === false)
      return false;
    this.link = {
      'title' : this.app.translate("Menu." + this.ID + ".Title")
    };
    // not recursive, it sucks hard for now
    if (this.data.subs) {
      this.link.subs = new Array();
      this.link.has_sub = true;
      var i = 0;
      Object.each(this.data.subs, function(data, screen) {
        RaidLeadManager[screen] = screen;
        var sub = this.app.SCS.register(new window[data.className](this.app, RaidLeadManager[screen], data));
        if (sub !== false) {
          this.link.subs[i] = sub;
          i++;
        }
      }.bind(this)); 
    }
  },

});
