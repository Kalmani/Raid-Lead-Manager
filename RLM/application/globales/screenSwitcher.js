var ScreenSwitcher = new Class ({

  screens_list : {},

  sName : null,
  sZone : null,
  pName : null,
  pZone : null,
  context : {},

  initialize : function(app) {
    this.app = app;
  },

  register : function(screen) {
    if (screen.ID)
      this.screens_list[screen.ID] = screen;
  },

  switchPanel : function() {
    rendered = this.app.render(this.pName, this.context);
    $(this.pZone).fadeOut(function() {
      rendered.inject(this.pZone.empty());
      $(this.pZone).fadeIn();
    }.bind(this));
    return rendered;
  },

  switchScreen : function() {
    rendered = this.app.render(this.sName, this.context);
    rendered.inject(this.sZone.empty());
    console.log(rendered, this.sName, this.sZone);
    return rendered;
  }

});
