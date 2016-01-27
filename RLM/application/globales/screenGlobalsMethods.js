var ScreenGlobalsMethods = new Class ({

  Binds : ['initialize', 'build_panel'],

  active : false,
  link : false,
  subs : false,

  initialize : function(app, data) {
    this.app = app;
    this.data = data;
    this.is_active();
    this.get_nav_component();
  },

  is_active : function() {
    this.active = true;
  },

  get_nav_component : function() {
    var self = this;

    if (self.active === false)
      return false;
    self.link = {
      'title' : self.app.translate("Menu." + self.ID + ".Title"),
      'id' : self.ID
    };
    // not recursive, it sucks hard for now
    if (self.data.subs) {
      self.link.subs = new Array();
      self.link.has_sub = true;
      var i = 0;
      Object.each(self.data.subs, function(data, screen) {
        self.app[screen] = screen;
        var sub = self.app.SCS.register(new self.app.Classes[data.className](self.app, self.app[screen], data));
        if (sub !== false) {
          self.link.subs[i] = sub;
          i++;
        }
      });
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
    var column = new Element('div', {'class' : 'col-md-' + col_w + ' col-sm-' + col_w, 'id' : 'column_' + id});
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
          try {
            this.SCS.context = JSON.parse(response);
            this.SCS.switchPanel(datas.id, cell, datas.animate);
          } catch (e) {
            var error = {
              'message' : e
            }
            this.app.alertMessage('error', error, cell);
          }
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

module.exports = ScreenGlobalsMethods;
