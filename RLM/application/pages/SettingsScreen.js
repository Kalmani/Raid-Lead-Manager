var SettingsScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    this.parent(app);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    this.app.SCS.static_context['identifiants_panels'] = this.app.sess.user;
    this.app.SCS.static_context['other_settings_panels'] = this.app.sess.user;
    this.parent(args);
  },

});
