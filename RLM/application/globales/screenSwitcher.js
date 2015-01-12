var ScreenSwitcher = new Class ({

  Binds : ['switchPanel', 'switchScreen'],

  screens_list : {},
  serial_implement : false,

  sName : null,
  sZone : null,
  panels_list : {},
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
    console.info('Inject panel ' + this.pName);
    renderedPanel = this.app.render(this.pName, this.context);
    if (this.serial_implement === false) {
      $(this.pZone).fadeOut(function() {
        renderedPanel.inject(this.pZone.empty());
        $(this.pZone).fadeIn();
      }.bind(this));
    } else {
      renderedPanel.inject(this.pZone);
    }
    return renderedPanel;
  },

  switchScreen : function() {
    console.info('Inject screen ' + this.sName);
    renderedScreen = this.app.render(this.sName, this.context);
    renderedScreen.inject(this.sZone.empty());
    Object.each(this.panels_list, function(container_id, tpl_id) {
      this.serial_implement = true;
      this.pName = tpl_id;
      this.pZone = renderedScreen.getElementById(container_id);
      this.switchPanel();
    }.bind(this));
    this.serial_implement = false;

    return renderedScreen;
  }

});
