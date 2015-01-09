var HomeScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id) {
    this.ID = screen_id;
    this.parent(app);
    console.log('initializing HomeScreen');
  },

});
