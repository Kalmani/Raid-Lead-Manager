var ScreenGlobalsMethods = new Class ({

  initialize : function(app) {
    this.app = app;
    console.log('initializing ' + this.data.className);
    this.is_active();
  },

  is_active : function() {
    // tu as ce dont tu as besoin ici
    console.log(this.ID);
    console.log(this.data);
    return true;
  }

});
