var ScreenSwitcher = new Class ({

  Binds : ['switchPanel', 'switchScreen'],

  screens_list : {},
  serial_implement : false,

  panels_list : {},
  context : {},

  initialize : function(app) {
    this.app = app;
  },

  register : function(screen) {
    if (!screen.ID)
      return false;
    this.screens_list[screen.ID] = screen;
    return screen.link;
  },

  switchPanel : function(tpl, dom) {
    console.info('Inject panel ' + tpl);
    renderedPanel = this.app.render(tpl, this.context);
    renderedPanel.inject(dom);
    return renderedPanel;
  },

  switchScreen : function(screen_tpl_id, screen_dom) {
    console.info('Inject screen ' + this.sName);
    renderedScreen = this.app.render(screen_tpl_id, this.context);
    renderedScreen.inject(screen_dom.empty());
    Object.each(this.panels_list, function(container_id, tpl_id) {
      this.serial_implement = true;
      this.switchPanel(tpl_id, renderedScreen.getElementById(container_id));
    }.bind(this));
    this.serial_implement = false;

    return renderedScreen;
  }

});
