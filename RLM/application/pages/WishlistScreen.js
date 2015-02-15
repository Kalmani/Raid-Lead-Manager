var WishlistScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    this.parent(app);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    this.parent(args, this.dom_ready);
  },

  dom_ready : function() {
    console.log(this.ID);
    console.log(document.id('cell_wish_list_panel'));
  },

});
