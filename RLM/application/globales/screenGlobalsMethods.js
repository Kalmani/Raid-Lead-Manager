var ScreenGlobalsMethods = new Class ({

  Binds : ['build_panel'],

  active : false,
  link : false,
  subs : false,

  initialize : function(app) {
    this.app = app;
    this.is_active();
    this.get_nav_component();
  },

  is_active : function() {
    this.active = true;
  },

  get_nav_component : function() {
    if (this.active === false)
      return false;
    this.link = {
      'title' : this.app.translate("Menu." + this.ID + ".Title"),
      'id' : this.ID
    };
    // not recursive, it sucks hard for now
    if (this.data.subs) {
      this.link.subs = new Array();
      this.link.has_sub = true;
      var i = 0;
      Object.each(this.data.subs, function(data, screen) {
        RaidLeadManager[screen] = screen;
        var sub = this.app.SCS.register(new window[data.className](this.app, RaidLeadManager[screen], data));
        if (sub !== false) {
          this.link.subs[i] = sub;
          i++;
        }
      }.bind(this));
    }
  },

  show_login_panel : function() {
    this.app.current_screen = this.ID;
  },

  show : function(args) {
    this.container = document.id('main_container');
    this.get_panels();
    this.app.current_screen = this.ID;
    $('.nav_link, .nav_subs').removeClass('active');
    if (this.parentID) {
      $('#' + this.parentID).addClass('active');
    } else {
      $('#' + this.ID).addClass('active');
    }
  },

  get_panels : function() {
    // take panels from config
    this.panels_list = this.app.config.panels[this.ID];
    Array.each(this.panels_list, function(datas, key_c) {
      this.current_col = key_c;
      this.build_column(datas.settings, key_c);
      Array.each(datas.list, this.build_panel);
    }.bind(this));
  },

  build_column : function(settings, id) {
    if (this.app.remove_all)
      document.id('main_container').empty();
    this.app.remove_all = false;
    var col_w = 4 * settings.cols;

    if (settings.static && this.container.getElementById('column_' + id)) {
      var current_cols = this.container.getElementById('column_' + id).get('class').split('-')[2];
      if (col_w == parseInt(current_cols))
        return;
    }

    if (document.id('column_' + id))
      document.id('column_' + id).dispose();
    var column = new Element('div', {'class' : 'col-md-' + col_w, 'id' : 'column_' + id});
    column.inject(this.container);
  },

  build_panel : function(datas, key) {
    // means static
    if (document.id('cell_' + datas.id))
      return;
    var cell = new Element('div', {'id' : 'cell_' + datas.id});
    this.SCS.switchPanel('alert_loading', cell, datas.animate);
    cell.inject(document.id('column_' + this.current_col));
    if (datas.namespace) {
      var options = {
        'success' : function(response) {
          this.SCS.context = JSON.parse(response);
          this.SCS.switchPanel(datas.id, cell, datas.animate);
          this.app.fireEvent('asyn_panel_ready', datas.id);
        }.bind(this)
      },
      params = {
      };
      this.app.ask_server(datas.namespace, datas.action, params, options);
    } else {
      this.SCS.context = this.SCS.static_context[datas.id] || {};
      this.SCS.switchPanel(datas.id, cell, datas.animate);
    }
  }

});
