var ScreenSwitcher = new Class ({

  current : null, // Current Screen
  screens_list : {},

  screen_zone : null,
  panel_name : null,
  panel_zone : null,
  context : {},

  initialize : function(app) {
    this.app = app;
  },

  register : function(screen) {
    if (screen.ID)
      this.screens_list[screen.ID] = screen;
  },

  switchPanel : function() {
    rendered = this.app.render(this.panel_name, this.context);
    $(rendered).css('display', 'none');
    rendered.inject(this.panel_zone);
    $(rendered).fadeIn();
  }

});
