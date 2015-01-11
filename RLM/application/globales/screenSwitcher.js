var ScreenSwitcher = new Class ({

  screens_list : {},

  screen_name : null,
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
    $(this.panel_zone).fadeOut(function() {
      rendered.inject(this.panel_zone.empty());
      $(this.panel_zone).fadeIn();
    }.bind(this));
    return rendered;
  }

});
