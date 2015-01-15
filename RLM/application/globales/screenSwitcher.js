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
    renderedPanel = this.app.render(tpl, this.context);
    renderedPanel.inject(dom);
    return renderedPanel;
  },

  switchScreen : function(screen_tpl_id, screen_dom) {
    renderedScreen = this.app.render(screen_tpl_id, this.context);
    renderedScreen.inject(screen_dom.empty());
    Object.each(this.panels_list, function(container_id, tpl_id) {
      this.serial_implement = true;
      this.switchPanel(tpl_id, renderedScreen.getElementById(container_id));
    }.bind(this));
    this.serial_implement = false;

    return renderedScreen;
  },

  switchRubric : function(screen_id, args) {
    var screen = this.screens_list[screen_id];
    if(!screen)
      return;
    return screen.show(args);
  }

});
