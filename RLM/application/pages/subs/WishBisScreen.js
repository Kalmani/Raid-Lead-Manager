var WishBisScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    this.parent(app);
    this.SCS = this.app.SCS;
    this.parentID = "WISH_LIST";
  },

  show : function(args) {
    this.parent(args);
  },

});