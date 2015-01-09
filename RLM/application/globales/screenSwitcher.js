var ScreenSwitcher = new Class ({

  current : null, // Current Screen
  screens_list : {},

  initialize : function(app) {
    this.app = app;
  },
  register : function(screen) {
    if (screen.ID)
      this.screens_list[screen.ID] = screen;
  }

});
