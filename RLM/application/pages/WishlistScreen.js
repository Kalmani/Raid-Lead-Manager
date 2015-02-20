var WishlistScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  Binds : ['bind_btn'],

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    this.parent(app);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    console.log(this.ID);
    this.parent(args);
    this.app.addEvent('asyn_panel_ready', function(panel_id) {
      if (panel_id == 'wish_list_panel') {
        Object.each(document.getElements('.refresh_item'), function(elem) {
          if (typeof(elem) !== 'number') {
            var slot = elem.get('id').split('_')[1];
            elem.removeEvents('click');
          }
        }.bind(this));
      }
    }.bind(this));
  }
});
