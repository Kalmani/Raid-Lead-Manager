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

  switchPanel : function(tpl, dom, animate) {
    renderedPanel = this.app.render(tpl, this.context);
    if (animate)
      $(renderedPanel).children().addClass('animated ' + animate);
    renderedPanel.inject(dom);
    return renderedPanel;
  },

  switchScreen : function(screen_tpl_id, screen_dom) {
    renderedScreen = this.app.render(screen_tpl_id, this.context);
    renderedScreen.inject(screen_dom.empty());
    Object.each(this.panels_list, function(datas, tpl_id) {
      this.serial_implement = true;
      this.switchPanel(tpl_id, renderedScreen.getElementById(datas.id), (datas.animate || false));
    }.bind(this));
    this.serial_implement = false;

    return renderedScreen;
  },

  switchRubric : function(screen_id, args) {
    this.reset();
    var screen = this.screens_list[screen_id];
    if(!screen)
      return;
    return screen.show(args);
  },

  reset : function() {
    var main_container = document.getElementById('main_container');
    main_container.empty();
  }

});
