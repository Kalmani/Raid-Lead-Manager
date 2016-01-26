(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../../application/globales/ScreenGlobalsMethods');

var AccountScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    AccountScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    this.parent(args);
    console.log(this.ID);
  }

});

module.exports = AccountScreen;

},{"../../application/globales/ScreenGlobalsMethods":12,"uclass":50}],2:[function(require,module,exports){
"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../../application/globales/ScreenGlobalsMethods');

var AttributionScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    AttributionScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    this.parent(args);
    console.log(this.ID);
  },

});

module.exports = AttributionScreen;

},{"../../application/globales/ScreenGlobalsMethods":12,"uclass":50}],3:[function(require,module,exports){
"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../../application/globales/ScreenGlobalsMethods');

var CalendarScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    CalendarScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    this.parent(args);
    console.log(this.ID);
  },

});

module.exports = CalendarScreen;

},{"../../application/globales/ScreenGlobalsMethods":12,"uclass":50}],4:[function(require,module,exports){
"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../../application/globales/ScreenGlobalsMethods');

var CraftScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    CraftScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    this.parent(args);
    console.log(this.ID);
  },

});

module.exports = CraftScreen;

},{"../../application/globales/ScreenGlobalsMethods":12,"uclass":50}],5:[function(require,module,exports){
"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../../application/globales/ScreenGlobalsMethods');

var DownScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    DownScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    this.parent(args);
    console.log(this.ID);
  },

});

module.exports = DownScreen;

},{"../../application/globales/ScreenGlobalsMethods":12,"uclass":50}],6:[function(require,module,exports){
"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../../application/globales/ScreenGlobalsMethods');

var FixAttribScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    FixAttribScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    this.parent(args);
    console.log(this.ID);
  },

});

module.exports = FixAttribScreen;

},{"../../application/globales/ScreenGlobalsMethods":12,"uclass":50}],7:[function(require,module,exports){
"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../../application/globales/ScreenGlobalsMethods');

var ImportScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    ImportScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    this.parent(args);
    console.log(this.ID);
  },

});

module.exports = ImportScreen;

},{"../../application/globales/ScreenGlobalsMethods":12,"uclass":50}],8:[function(require,module,exports){
"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../../application/globales/ScreenGlobalsMethods');

var MissingScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    MissingScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    this.parent(args);
    console.log(this.ID);
  },

});

module.exports = MissingScreen;

},{"../../application/globales/ScreenGlobalsMethods":12,"uclass":50}],9:[function(require,module,exports){
"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../../application/globales/ScreenGlobalsMethods');

var StatScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    StatScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    this.parent(args);
    console.log(this.ID);
  },

});

module.exports = StatScreen;

},{"../../application/globales/ScreenGlobalsMethods":12,"uclass":50}],10:[function(require,module,exports){
"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../../application/globales/ScreenGlobalsMethods');

var UpdateScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    UpdateScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    this.parent(args);
    console.log(this.ID);
  },

});

module.exports = UpdateScreen;

},{"../../application/globales/ScreenGlobalsMethods":12,"uclass":50}],11:[function(require,module,exports){
"use strict";

var Class        = require('uclass');

var ScreenEvents = new Class ({

  initialize : function(app) {
    var elem_id = null;
    document.addEvent('click', function(evt) {
      var el = evt.target;
      if (el.get && el.get('id')) {
        elem_id = el.get('id');
      } else {
        while (el.parentNode) {
            el = el.parentNode;
            if(el.get && el.get('id')) {
              elem_id = el.get('id');
              break;
            }
        }
      }
      if (elem_id) {
        var screen_id = this[app.current_screen],
            rubric = app.SCS.screens_list[screen_id],
            rubric_id = elem_id.split('_')[0];
        if (ScreenEvents.actions[rubric_id])
          ScreenEvents.actions[rubric_id].dispatch_action(el, app, elem_id, rubric);
      }
    }.bind(this), false);
  }

});

ScreenEvents.actions = {
  'home'     : require('./rubrics/home.js'),
  'settings' : require('./rubrics/settings.js'),
  'wishlist' : require('./rubrics/wishlist.js')
};

module.exports = ScreenEvents;

},{"./rubrics/home.js":13,"./rubrics/settings.js":14,"./rubrics/wishlist.js":15,"uclass":50}],12:[function(require,module,exports){
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
        console.log(data.className);
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

},{}],13:[function(require,module,exports){
"use strict";

module.exports = {

  rub_name : 'home',

  dispatch_action : function(elem, app, id, rubric) {
    this.id = id.replace(this.rub_name + '_', '');
    this.rubric = rubric;
    this.app = app;

    switch(this.id) {
      case 'login_try' : 
        this.login_try();
        break;
      default :
        console.info('No bind on button ' + this.id);
        break;
    }

  },

  login_try : function() {
    this.app.loading(document.id('login_panel'));
    var pseudo = document.id('identifiant').value,
        pass = document.id('password').value;
    this.try_login(pseudo, pass);
  },

  try_login : function(pseudo, pass) {
    var options = {
          'success' : this.callback_login.bind(this)
        },
        params = {
          'pseudo' : pseudo,
          'pass' : pass
        };
    this.app.ask_server('account', 'login', params, options);
  },

  callback_login : function(response) {
    var response = JSON.parse(response),
        zone = document.id('login_panel'),
        callback = function() {
          this.app.sess.login(response.user_datas);
          document.id('main_container').empty();
          this.app.make_nav();
          this.app.SCS.switchRubric('HOME');
        }.bind(this);
    this.app.generate_callback(response, zone, callback);
  },


  /*test_import_update : function(response) {
    if (response === undefined) {
      var options = {
          'success' : this.test_import_update.bind(this)
        },
        params = {
        };
      this.app.ask_server('items', 'get_all_ids_item', params, options);
    } else {
      var response = JSON.parse(response),
          i = response.i || 0;
          ids = response.ids || response;
      if (i < ids.length) {
        console.log(i, ids);
        var options = {
            'success' : this.test_import_update.bind(this)
          },
          params = {
            'i' : i,
            'ids' : ids
          };
        this.app.ask_server('items', 'update_type', params, options);
      } else {
        console.info('FINISH');
      }
    }
  }

  test_import : function(response) {
    if (response) {
      var response = JSON.parse(response);
      if (!response.no_item && response['raid-normal'].itemLevel >= 665) {
        var line = new Element('div', {'class' : 'col-md-2', 'style' : 'color:#FFF;', 'text' : response['raid-normal'].id}).inject(document.id('listing'));
        var div2 = new Element('div', {'class' : 'col-md-2', 'style' : 'color:#FFF;', 'html' : '<img src="http://media.blizzard.com/wow/icons/56/'+response['raid-normal'].icon+'.jpg" />'}).inject(document.id('listing'));
        var div3 = new Element('div', {'class' : 'col-md-6', 'style' : 'color:#FFF;', 'text' : response['raid-normal'].name}).inject(document.id('listing'));
        var div4 = new Element('div', {'class' : 'col-md-2', 'style' : 'color:#FFF;', 'text' : response['raid-normal'].itemLevel}).inject(document.id('listing'));
        var div5 = new Element('div', {'style' : 'clear:both;'}).inject(document.id('listing'));
      }
    }
    this.i++;
    var options = {
          'success' : this.test_import.bind(this)
        },
        params = {
          'item' : this.i
        };
    this.app.ask_server('character', 'import_item', params, options);
  }*/

};

},{}],14:[function(require,module,exports){
"use strict";

module.exports = {
  rub_name : 'settings',

  dispatch_action : function(elem, app, id, rubric) {
    this.id = id.replace(this.rub_name + '_', '');
    this.rubric = rubric;
    this.app = app;

    switch(this.id) {
      case 'change_login_pass' :
        this.change_login_pass();
        break;
      case 'change_email' :
        this.change_email();
        break;
      default :
        console.info('No bind on button ' + this.id);
        break;
    }
  },

  change_login_pass : function() {
    var ids = [
          'identifiant',
          'old_password',
          'new_password',
          'new_password_conf'
        ],
        values = {};
    Array.each(ids, function(id) {
      values[id] = document.id(id).get('value').trim();
    });
    var options = {
          'success' : this.callback_change_login.bind(this)
        },
        params = values;
    this.app.ask_server('account', 'change_login', params, options);
  },

  callback_change_login : function(response) {
    var response = JSON.parse(response),
        zone = document.id('cell_identifiants_panels'),
        callback = function() {
          this.app.sess.update_value('user_log', response.datas.user_log);
          if (response.datas.user_pass)
            this.app.sess.update_value('user_pass', response.datas.user_pass);
          setTimeout(function () {
            this.app.SCS.switchRubric('HOME');
          }.bind(this), 1500);
        }.bind(this);
    this.app.generate_callback(response, zone, callback);
  },

  change_email : function() {
    var email = document.id('email').get('value').trim();
    var options = {
          'success' : this.callback_change_email.bind(this)
        },
        params = {'email' : email};
    this.app.ask_server('account', 'change_email', params, options);
  },

  callback_change_email : function(response) {
    var response = JSON.parse(response),
        zone = document.id('cell_other_settings_panels'),
        callback = function() {
          this.app.sess.update_value('user_mail', response.datas.user_mail);
          setTimeout(function () {
            this.app.SCS.switchRubric('HOME');
          }.bind(this), 1500);
        }.bind(this);
    this.app.generate_callback(response, zone, callback);
  }

};

},{}],15:[function(require,module,exports){
"use strict";

module.exports = {
  rub_name : 'wishlist',

  dispatch_action : function(elem, app, id, rubric) {
    this.id = id.replace(this.rub_name + '_', '');
    this.rubric = rubric;
    this.app = app;
    this.elem = elem;
    if (this.id.split('_')[0] == 'refresh')
      this.id = 'refresh';
    if (this.id.split('_')[0] == 'add')
      this.id = 'add';
    if (this.id.indexOf('chose_item_') !== -1)
      this.id = 'chose_item';
    switch(this.id) {
      case 'refresh' : 
        this.refresh_item();
        break;
      case 'add' :
        this.add_page();
        break;
      case 'chose_item' :
        this.chose_item();
        break;
      case 'keep_item' :
      case 'bind_item' :
        this.bind_item();
        break;
      default :
        console.info('No bind on button ' + this.id);
        break;
    }
  },

  refresh_item : function() {
    try {
      this.elem.get('id')
    } catch(e) {
      return;
    }
    var slot = this.elem.get('rel');
    console.info('refresh slot : ' + slot);
    var line = document.id('line_' + slot);
    line.addClass('loading_stuff');
    var options = {
      'success' : function(response) {
        var result = JSON.parse(response);
        line.getElement('.item_img').set('src', 'http://eu.media.blizzard.com/wow/icons/56/' + result.img + '.jpg');
        line.getElement('.item_name').set('html', result.name);
        line.getElement('.item_level').set('level', result.level);
        line.removeClass('loading_stuff');
        // don't forget to switch border colors with response.scarcity
      }.bind(this)
    },
    params = {
      'slot' : slot,
      'nocache' : true,
    };
    this.app.ask_server('character', 'update_item', params, options);
  },

  add_page : function() {
    try {
      this.elem.get('id')
    } catch(e) {
      return;
    }
    var slot = this.elem.get('rel');
    console.info('Add wish item : ' + slot);
    this.rubric.show_add_item_page(slot);
  },

  chose_item : function() {
    var new_id = this.elem.get('rel');
    this.rubric.show_chose_item(new_id);
  },

  bind_item : function() {
    var new_id = this.elem.get('rel');
    alert("new id will be " + new_id);
    var options = {
      'success' : function(response) {
        var result = JSON.parse(response);
        console.log(result);
      }.bind(this)
    },
    params = {
      'new_id' : new_id
    };
    this.app.ask_server('character', 'bind_bis', params, options);
  }
};

},{}],16:[function(require,module,exports){
"use strict";

var RaidLeadManager = require('./raid_lead_manager');

window.addEvent('domready', function() {
  var wowhead_tooltips = { "colorlinks": false, "iconizelinks": false, "renamelinks": false }
  window.RLM = new RaidLeadManager();
  RLM.init();
});

},{"./raid_lead_manager":27}],17:[function(require,module,exports){
"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../globales/ScreenGlobalsMethods');

var AdminScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    AdminScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    this.parent(args);
  },

});

module.exports = AdminScreen;

},{"../globales/ScreenGlobalsMethods":12,"uclass":50}],18:[function(require,module,exports){
"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../globales/ScreenGlobalsMethods');

var CompareScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    CompareScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    this.parent(args);
  },

});

module.exports = CompareScreen;

},{"../globales/ScreenGlobalsMethods":12,"uclass":50}],19:[function(require,module,exports){
"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../globales/ScreenGlobalsMethods');

var DisconnectScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    DisconnectScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    this.parent(args);
    this.app.sess.disconnect();
    document.location.reload();
  },

});

module.exports = DisconnectScreen;

},{"../globales/ScreenGlobalsMethods":12,"uclass":50}],20:[function(require,module,exports){
"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../globales/ScreenGlobalsMethods');

var HomeScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  Binds : ['show'],

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    HomeScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = app.SCS;
  },

  show_login_panel : function() {
    HomeScreen.parent.show_login_panel.call(this);
    var dom = document.getElementById('main_container'),
        zone = this.SCS.switchPanel('login_tpl', dom);
  },

  show : function(args) {
    HomeScreen.parent.show.call(this, args);
  },

  items_list : function() {
    var context = {'left' : new Array(), 'right' : new Array()},
        item = 0;
    Object.each(this.parent(), function(item_datas, key) {
      item_datas.item_url = null;
      if (item_datas.item_caracs)
        item_datas.item_url = item_datas.item_caracs.join('&amp;');
      var current = item_datas;
      if (item < 8) {
        context.left[context.left.length] = current;
      } else {
        context.right[context.right.length] = current;
      }
      item++;
    });
    return context;
  }

});

module.exports = HomeScreen;

},{"../globales/ScreenGlobalsMethods":12,"uclass":50}],21:[function(require,module,exports){
"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../globales/ScreenGlobalsMethods');

var HystoryScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    HystoryScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    this.parent(args);
  },

});

module.exports = HystoryScreen;

},{"../globales/ScreenGlobalsMethods":12,"uclass":50}],22:[function(require,module,exports){
"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../globales/ScreenGlobalsMethods');

var SettingsScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    SettingsScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    this.app.SCS.static_context['identifiants_panels'] = this.app.sess.user;
    this.app.SCS.static_context['other_settings_panels'] = this.app.sess.user;
    SettingsScreen.parent.show.call(this, args);
  },

});

module.exports = SettingsScreen;

},{"../globales/ScreenGlobalsMethods":12,"uclass":50}],23:[function(require,module,exports){
"use strict";

var Class                = require('uclass'),
    ScreenGlobalsMethods = require('../globales/ScreenGlobalsMethods');

var WishlistScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  Binds : ['bind_btn'],

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    WishlistScreen.parent.initialize.call(this, app, screen_data);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    console.log(this.ID);
    WishlistScreen.parent.show.call(this, args);
  },

  show_add_item_page : function(slot) {
    this.app.remove_all = true;
    var dom = document.id('main_container');
    dom.empty();

    this.app.SCS.panels_list = {
      'change_item' : {'id' : 'change_item', 'animate' : 'fadeIn'}
    };
    this.app.SCS.switchScreen('select_wish_item', dom);


    // load async items list
    var options = {
          'success' : function(response) {
            var items = JSON.parse(response);
            this.add_items(items);
          }.bind(this)
        },
        params = {
          'slot' : slot
        },
        namespace = 'items',
        action = 'list_items';
    this.app.ask_server(namespace, action, params, options);
  },

  add_items : function(items) {
    var container = document.id('current_item'),
        context = {
          'current_item' : items.current_item
        }
    this.app.render('current_item', context).inject(container);

    var container = document.id('items_list_wish');
    var i = 0;
    Array.each(items.items_list, function(item, key) {
      var context = {
            'item' : item
          },
          element = this.app.render('item_bloc', context);
          bloc_container = new Element('div', {'class' : "col-md-6 col-sm-12 col-xs-12"});
      element.inject(bloc_container);
      bloc_container.inject(container);
      i++;
      if (i%2 === 0) {
        var clearer = new Element('div', {'style' : 'clear:both;'});
        clearer.inject(container);
      }
    }.bind(this));
  },

  show_chose_item : function(id) {
    var options = {
          'success' : function(response) {
            var item = JSON.parse(response);
            this.app.SCS.context = item;
            this.app.SCS.switchPanel('selected_bis', document.id('selected_bis'), 'fadeIn');
          }.bind(this)
        },
        params = {
          'id' : id
        },
        namespace = 'items',
        action = 'show_item';
    this.app.ask_server(namespace, action, params, options);
  }

});

module.exports = WishlistScreen;

},{"../globales/ScreenGlobalsMethods":12,"uclass":50}],24:[function(require,module,exports){
"use strict";

var Class          = require('uclass'),
    WishlistScreen = require('../WishlistScreen');

var WishBisScreen = new Class ({

  Extends : WishlistScreen,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    WishBisScreen.parent.initialize.call(this, app, screen_id, screen_data);
    this.SCS = this.app.SCS;
    this.parentID = "WISH_LIST";
  },

  show : function(args) {
    this.parent(args);
  }

});

module.exports = WishBisScreen;

},{"../WishlistScreen":23,"uclass":50}],25:[function(require,module,exports){
"use strict";

var Class          = require('uclass'),
    WishlistScreen = require('../WishlistScreen');

var WishProvScreen = new Class ({

  Extends : WishlistScreen,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    WishProvScreen.parent.initialize.call(this, app, screen_id, screen_data);
    this.SCS = this.app.SCS;
    this.parentID = "WISH_LIST";
  },

  show : function(args) {
    this.parent(args);
  }

});

module.exports = WishProvScreen;

},{"../WishlistScreen":23,"uclass":50}],26:[function(require,module,exports){
"use strict";

var Class          = require('uclass'),
    WishlistScreen = require('../WishlistScreen');

var WishSpeScreen = new Class ({

  Extends : WishlistScreen,

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    WishSpeScreen.parent.initialize.call(this, app, screen_id, screen_data);
    this.SCS = this.app.SCS;
    this.parentID = "WISH_LIST";
  },

  show : function(args) {
    this.parent(args);
  }

});

module.exports = WishSpeScreen;

},{"../WishlistScreen":23,"uclass":50}],27:[function(require,module,exports){
"use strict";

var Class        = require('uclass'),
    Events       = require('uclass/events'),

    forIn        = require('mout/object/forIn'),
    ScreenEvents = require('./globales/ScreenEvents');

// instanciate all pages
var RaidLeadManager = new Class ({

  Extends : ScreenEvents,

  Implements : Events,

  Binds : ['init', 'generate_callback'],

  locales : {},
  templates  : {},
  remove_all : false,

  initialize : function() {

    this.Classes = {
      'AdminScreen'       : require('./pages/AdminScreen'),
      'CompareScreen'     : require('./pages/CompareScreen'),
      'DisconnectScreen'  : require('./pages/DisconnectScreen'),
      'HomeScreen'        : require('./pages/HomeScreen'),
      'HystoryScreen'     : require('./pages/HystoryScreen'),
      'SettingsScreen'    : require('./pages/SettingsScreen'),
      'WishlistScreen'    : require('./pages/WishlistScreen'),
      // subs
      'WishBisScreen'     : require('./pages/subs/WishBisScreen'),
      'WishProvScreen'    : require('./pages/subs/WishProvScreen'),
      'WishSpeScreen'     : require('./pages/subs/WishSpeScreen'),
      // admin
      'DownScreen'        : require('../admin/pages/DownScreen'),
      'AttributionScreen' : require('../admin/pages/AttributionScreen'),
      'FixAttribScreen'   : require('../admin/pages/FixAttribScreen'),
      'AccountScreen'     : require('../admin/pages/AccountScreen'),
      'StatScreen'        : require('../admin/pages/StatScreen'),
      'UpdateScreen'      : require('../admin/pages/UpdateScreen'),
      'ImportScreen'      : require('../admin/pages/ImportScreen'),
      'MissingScreen'     : require('../admin/pages/MissingScreen'),
      'CalendarScreen'    : require('../admin/pages/CalendarScreen'),
      'CraftScreen'       : require('../admin/pages/CraftScreen'),

    };

    console.log('initializing api');
    this.sess = new Session(this);
    this.SCS = new ScreenSwitcher(this);
    RaidLeadManager.parent.initialize.call(this, this);
  },

  init : function() {
    var self = this,
        load_ready = {};

    self.addEvent('init', function(step) {
      load_ready[step] = true;
      console.info("Load ", step, " > Finish");

      if(load_ready.templates && load_ready.locales) {
        self.show_content();
      }
    });
    self.load_config();
  },

  load_config : function() {
    new Request({
      url : 'config.json?',
      onSuccess : function(txt) {
        this.config = JSON.decode(txt);
        if (Cookie.read('current_language') === null) {
          var language = new Cookie('current_language', false);
          language.write(this.config.default_language || 'en-us');
        }
        this.current_language = Cookie.read('current_language') || this.config.default_language || 'en-us';
        // Build endpoints
        this.load_locales();
        this.load_templates();
      }.bind(this)
    }).get();
  },

  make_nav : function() {
    var self = this,
        navigation = new Array(),
        i = 0;
    forIn(self.config.rubrics, function(data, screen) {
      RaidLeadManager[screen] = screen;
      if (data.className) {
        var link = self.SCS.register(new self.Classes[data.className](self, RaidLeadManager[screen], data));
        if (link !== false) {
          navigation[i] = link;
          i++;
        }
      }
    });
    self.navigation = navigation;
    var dom_nav = self.render('navbar', {'navigation' : self.navigation});
    dom_nav.inject(document.getElementById('navbar').empty());
    $('.nav_link').click(function() {
      self.SCS.switchRubric(RaidLeadManager[self.get('id')]);
    });
  },

  load_locales : function() {
    new Request({
      url : 'locales.json',
      onSuccess : function(txt) {
        var tmp = {},
            locales = JSON.decode(txt);

        Object.each(locales, function(trad, lang) {
          tmp[lang] = {};
          Object.each(trad, function(v, k) {
            tmp[lang]['$' + k + ';'] = v;
          });
        });
        Object.each(tmp, function(v, k) {
          tmp[k] = Object.merge({}, tmp['fr-fr'], v);
        });

        this.locales = tmp;
        this.fireEvent('init', 'locales');
      }.bind(this)
    }).get();
  },

  load_templates : function() {
    var that = this;
    new Request({
      url : 'templates.xml',
      onSuccess : function(txt, xml) {
        var serializer = new XMLSerializer();
        Array.each(xml.xpath("//script[@type='text/template']"), function(node) {
          var str = "";
          Array.each(node.childNodes, function(child) {
            str += serializer.serializeToString(child);
          });
          that.templates[node.getAttribute('id')] = str;
        });
        that.fireEvent('init', 'templates');
      }
    }).get();
  },

  show_content : function() {
    var context = {
          'guild_emblem' : 'http://www.larmes-nebuleuses.fr/Portail/emblem.png',
          'guild_name' : 'Larmes Nébuleuses',
          'server' : 'Dalaran'
        },
        dom = this.render('global_main', context).inject(document.body);
    if (this.sess.user) {
      this.make_nav();
      this.SCS.switchRubric('HOME');
    } else {
      // default value for login page
      RaidLeadManager['HOME'] = 'HOME';
      this.SCS.register(new Classes['HomeScreen'](this, 'HOME', this.config.rubrics.HOME));
      this.SCS.screens_list.HOME.show_login_panel();
    }

  },

  render : function(template_id, view) {
    var res, output = Mustache.render(this.templates[template_id], view, this.templates);
    output = this.translate_full(output);
    return new Element('div', {'html' : output});
  },

  translate : function(i) {
    if(i === "" || !i) return "";
    return this.translate_full('$' + i + ';');
  },

  translate_full : function(i) {
    var tmp = '', lang = this.current_language || 'fr-fr';
    do {
      tmp = i;
      i = i.replaces(this.locales[lang]);
    } while (tmp != i);
    return tmp;
  },

  ask_server : function(namespace, action, params, options) {
    //Server side actions here
    var datas = 'namespace=' + namespace + '&action=' + action + ((params) ? '&' + params.join('&') : ''),
        action_root = this.config.action_root,
        myRequest = new Request({
          method : 'post',
          url : action_root,
          data : datas,
          onSuccess : function(responseText, responseXML) {
            if (options.success)
              options.success(responseText);
          }
        }).send();
  },

  loading : function(zone) {
    Array.each(zone.getElementsByClassName('alert'), function(elem) {
      elem.remove();
    });
    var dom = this.render('alert_loading', {});
    dom.inject(zone, 'top');
  },

  alertMessage : function(type, error, zone) {
    Array.each(zone.getElementsByClassName('alert'), function(elem) {
      elem.remove();
    });
    var dom = this.render('alert_' + type, {'message' : error.message});
    dom.inject(zone, 'top');
  },

  generate_callback : function(response, zone, callback) {
    if (response.error) {
      this.alertMessage('error', response.error, zone);
    } else if (response.warning) {
      this.alertMessage('warning', response.warning, zone);
    } else if (response.success) {
      this.alertMessage('success', response.success, zone);
      callback();
    }
  }

});

module.exports = RaidLeadManager;

},{"../admin/pages/AccountScreen":1,"../admin/pages/AttributionScreen":2,"../admin/pages/CalendarScreen":3,"../admin/pages/CraftScreen":4,"../admin/pages/DownScreen":5,"../admin/pages/FixAttribScreen":6,"../admin/pages/ImportScreen":7,"../admin/pages/MissingScreen":8,"../admin/pages/StatScreen":9,"../admin/pages/UpdateScreen":10,"./globales/ScreenEvents":11,"./pages/AdminScreen":17,"./pages/CompareScreen":18,"./pages/DisconnectScreen":19,"./pages/HomeScreen":20,"./pages/HystoryScreen":21,"./pages/SettingsScreen":22,"./pages/WishlistScreen":23,"./pages/subs/WishBisScreen":24,"./pages/subs/WishProvScreen":25,"./pages/subs/WishSpeScreen":26,"mout/object/forIn":38,"uclass":50,"uclass/events":49}],28:[function(require,module,exports){
var kindOf = require('./kindOf');
var isPlainObject = require('./isPlainObject');
var mixIn = require('../object/mixIn');

    /**
     * Clone native types.
     */
    function clone(val){
        switch (kindOf(val)) {
            case 'Object':
                return cloneObject(val);
            case 'Array':
                return cloneArray(val);
            case 'RegExp':
                return cloneRegExp(val);
            case 'Date':
                return cloneDate(val);
            default:
                return val;
        }
    }

    function cloneObject(source) {
        if (isPlainObject(source)) {
            return mixIn({}, source);
        } else {
            return source;
        }
    }

    function cloneRegExp(r) {
        var flags = '';
        flags += r.multiline ? 'm' : '';
        flags += r.global ? 'g' : '';
        flags += r.ignoreCase ? 'i' : '';
        return new RegExp(r.source, flags);
    }

    function cloneDate(date) {
        return new Date(+date);
    }

    function cloneArray(arr) {
        return arr.slice();
    }

    module.exports = clone;



},{"../object/mixIn":42,"./isPlainObject":34,"./kindOf":35}],29:[function(require,module,exports){
var mixIn = require('../object/mixIn');

    /**
     * Create Object using prototypal inheritance and setting custom properties.
     * - Mix between Douglas Crockford Prototypal Inheritance <http://javascript.crockford.com/prototypal.html> and the EcmaScript 5 `Object.create()` method.
     * @param {object} parent    Parent Object.
     * @param {object} [props] Object properties.
     * @return {object} Created object.
     */
    function createObject(parent, props){
        function F(){}
        F.prototype = parent;
        return mixIn(new F(), props);

    }
    module.exports = createObject;



},{"../object/mixIn":42}],30:[function(require,module,exports){
var clone = require('./clone');
var forOwn = require('../object/forOwn');
var kindOf = require('./kindOf');
var isPlainObject = require('./isPlainObject');

    /**
     * Recursively clone native types.
     */
    function deepClone(val, instanceClone) {
        switch ( kindOf(val) ) {
            case 'Object':
                return cloneObject(val, instanceClone);
            case 'Array':
                return cloneArray(val, instanceClone);
            default:
                return clone(val);
        }
    }

    function cloneObject(source, instanceClone) {
        if (isPlainObject(source)) {
            var out = {};
            forOwn(source, function(val, key) {
                this[key] = deepClone(val, instanceClone);
            }, out);
            return out;
        } else if (instanceClone) {
            return instanceClone(source);
        } else {
            return source;
        }
    }

    function cloneArray(arr, instanceClone) {
        var out = [],
            i = -1,
            n = arr.length,
            val;
        while (++i < n) {
            out[i] = deepClone(arr[i], instanceClone);
        }
        return out;
    }

    module.exports = deepClone;




},{"../object/forOwn":39,"./clone":28,"./isPlainObject":34,"./kindOf":35}],31:[function(require,module,exports){
var isKind = require('./isKind');
    /**
     */
    var isArray = Array.isArray || function (val) {
        return isKind(val, 'Array');
    };
    module.exports = isArray;


},{"./isKind":32}],32:[function(require,module,exports){
var kindOf = require('./kindOf');
    /**
     * Check if value is from a specific "kind".
     */
    function isKind(val, kind){
        return kindOf(val) === kind;
    }
    module.exports = isKind;


},{"./kindOf":35}],33:[function(require,module,exports){
var isKind = require('./isKind');
    /**
     */
    function isObject(val) {
        return isKind(val, 'Object');
    }
    module.exports = isObject;


},{"./isKind":32}],34:[function(require,module,exports){


    /**
     * Checks if the value is created by the `Object` constructor.
     */
    function isPlainObject(value) {
        return (!!value && typeof value === 'object' &&
            value.constructor === Object);
    }

    module.exports = isPlainObject;



},{}],35:[function(require,module,exports){


    var _rKind = /^\[object (.*)\]$/,
        _toString = Object.prototype.toString,
        UNDEF;

    /**
     * Gets the "kind" of value. (e.g. "String", "Number", etc)
     */
    function kindOf(val) {
        if (val === null) {
            return 'Null';
        } else if (val === UNDEF) {
            return 'Undefined';
        } else {
            return _rKind.exec( _toString.call(val) )[1];
        }
    }
    module.exports = kindOf;


},{}],36:[function(require,module,exports){
/**
 * @constant Maximum 32-bit signed integer value. (2^31 - 1)
 */

    module.exports = 2147483647;


},{}],37:[function(require,module,exports){
/**
 * @constant Minimum 32-bit signed integer value (-2^31).
 */

    module.exports = -2147483648;


},{}],38:[function(require,module,exports){
var hasOwn = require('./hasOwn');

    var _hasDontEnumBug,
        _dontEnums;

    function checkDontEnum(){
        _dontEnums = [
                'toString',
                'toLocaleString',
                'valueOf',
                'hasOwnProperty',
                'isPrototypeOf',
                'propertyIsEnumerable',
                'constructor'
            ];

        _hasDontEnumBug = true;

        for (var key in {'toString': null}) {
            _hasDontEnumBug = false;
        }
    }

    /**
     * Similar to Array/forEach but works over object properties and fixes Don't
     * Enum bug on IE.
     * based on: http://whattheheadsaid.com/2010/10/a-safer-object-keys-compatibility-implementation
     */
    function forIn(obj, fn, thisObj){
        var key, i = 0;
        // no need to check if argument is a real object that way we can use
        // it for arrays, functions, date, etc.

        //post-pone check till needed
        if (_hasDontEnumBug == null) checkDontEnum();

        for (key in obj) {
            if (exec(fn, obj, key, thisObj) === false) {
                break;
            }
        }


        if (_hasDontEnumBug) {
            var ctor = obj.constructor,
                isProto = !!ctor && obj === ctor.prototype;

            while (key = _dontEnums[i++]) {
                // For constructor, if it is a prototype object the constructor
                // is always non-enumerable unless defined otherwise (and
                // enumerated above).  For non-prototype objects, it will have
                // to be defined on this object, since it cannot be defined on
                // any prototype objects.
                //
                // For other [[DontEnum]] properties, check if the value is
                // different than Object prototype value.
                if (
                    (key !== 'constructor' ||
                        (!isProto && hasOwn(obj, key))) &&
                    obj[key] !== Object.prototype[key]
                ) {
                    if (exec(fn, obj, key, thisObj) === false) {
                        break;
                    }
                }
            }
        }
    }

    function exec(fn, obj, key, thisObj){
        return fn.call(thisObj, obj[key], key, obj);
    }

    module.exports = forIn;



},{"./hasOwn":40}],39:[function(require,module,exports){
var hasOwn = require('./hasOwn');
var forIn = require('./forIn');

    /**
     * Similar to Array/forEach but works over object properties and fixes Don't
     * Enum bug on IE.
     * based on: http://whattheheadsaid.com/2010/10/a-safer-object-keys-compatibility-implementation
     */
    function forOwn(obj, fn, thisObj){
        forIn(obj, function(val, key){
            if (hasOwn(obj, key)) {
                return fn.call(thisObj, obj[key], key, obj);
            }
        });
    }

    module.exports = forOwn;



},{"./forIn":38,"./hasOwn":40}],40:[function(require,module,exports){


    /**
     * Safer Object.hasOwnProperty
     */
     function hasOwn(obj, prop){
         return Object.prototype.hasOwnProperty.call(obj, prop);
     }

     module.exports = hasOwn;



},{}],41:[function(require,module,exports){
var hasOwn = require('./hasOwn');
var deepClone = require('../lang/deepClone');
var isObject = require('../lang/isObject');

    /**
     * Deep merge objects.
     */
    function merge() {
        var i = 1,
            key, val, obj, target;

        // make sure we don't modify source element and it's properties
        // objects are passed by reference
        target = deepClone( arguments[0] );

        while (obj = arguments[i++]) {
            for (key in obj) {
                if ( ! hasOwn(obj, key) ) {
                    continue;
                }

                val = obj[key];

                if ( isObject(val) && isObject(target[key]) ){
                    // inception, deep merge objects
                    target[key] = merge(target[key], val);
                } else {
                    // make sure arrays, regexp, date, objects are cloned
                    target[key] = deepClone(val);
                }

            }
        }

        return target;
    }

    module.exports = merge;



},{"../lang/deepClone":30,"../lang/isObject":33,"./hasOwn":40}],42:[function(require,module,exports){
var forOwn = require('./forOwn');

    /**
    * Combine properties from all the objects into first one.
    * - This method affects target object in place, if you want to create a new Object pass an empty object as first param.
    * @param {object} target    Target Object
    * @param {...object} objects    Objects to be combined (0...n objects).
    * @return {object} Target Object.
    */
    function mixIn(target, objects){
        var i = 0,
            n = arguments.length,
            obj;
        while(++i < n){
            obj = arguments[i];
            if (obj != null) {
                forOwn(obj, copyProp, target);
            }
        }
        return target;
    }

    function copyProp(val, key){
        this[key] = val;
    }

    module.exports = mixIn;


},{"./forOwn":39}],43:[function(require,module,exports){
var randInt = require('./randInt');
var isArray = require('../lang/isArray');

    /**
     * Returns a random element from the supplied arguments
     * or from the array (if single argument is an array).
     */
    function choice(items) {
        var target = (arguments.length === 1 && isArray(items))? items : arguments;
        return target[ randInt(0, target.length - 1) ];
    }

    module.exports = choice;



},{"../lang/isArray":31,"./randInt":47}],44:[function(require,module,exports){
var randHex = require('./randHex');
var choice = require('./choice');

  /**
   * Returns pseudo-random guid (UUID v4)
   * IMPORTANT: it's not totally "safe" since randHex/choice uses Math.random
   * by default and sequences can be predicted in some cases. See the
   * "random/random" documentation for more info about it and how to replace
   * the default PRNG.
   */
  function guid() {
    return (
        randHex(8)+'-'+
        randHex(4)+'-'+
        // v4 UUID always contain "4" at this position to specify it was
        // randomly generated
        '4' + randHex(3) +'-'+
        // v4 UUID always contain chars [a,b,8,9] at this position
        choice(8, 9, 'a', 'b') + randHex(3)+'-'+
        randHex(12)
    );
  }
  module.exports = guid;


},{"./choice":43,"./randHex":46}],45:[function(require,module,exports){
var random = require('./random');
var MIN_INT = require('../number/MIN_INT');
var MAX_INT = require('../number/MAX_INT');

    /**
     * Returns random number inside range
     */
    function rand(min, max){
        min = min == null? MIN_INT : min;
        max = max == null? MAX_INT : max;
        return min + (max - min) * random();
    }

    module.exports = rand;


},{"../number/MAX_INT":36,"../number/MIN_INT":37,"./random":48}],46:[function(require,module,exports){
var choice = require('./choice');

    var _chars = '0123456789abcdef'.split('');

    /**
     * Returns a random hexadecimal string
     */
    function randHex(size){
        size = size && size > 0? size : 6;
        var str = '';
        while (size--) {
            str += choice(_chars);
        }
        return str;
    }

    module.exports = randHex;



},{"./choice":43}],47:[function(require,module,exports){
var MIN_INT = require('../number/MIN_INT');
var MAX_INT = require('../number/MAX_INT');
var rand = require('./rand');

    /**
     * Gets random integer inside range or snap to min/max values.
     */
    function randInt(min, max){
        min = min == null? MIN_INT : ~~min;
        max = max == null? MAX_INT : ~~max;
        // can't be max + 0.5 otherwise it will round up if `rand`
        // returns `max` causing it to overflow range.
        // -0.5 and + 0.49 are required to avoid bias caused by rounding
        return Math.round( rand(min - 0.5, max + 0.499999999999) );
    }

    module.exports = randInt;


},{"../number/MAX_INT":36,"../number/MIN_INT":37,"./rand":45}],48:[function(require,module,exports){


    /**
     * Just a wrapper to Math.random. No methods inside mout/random should call
     * Math.random() directly so we can inject the pseudo-random number
     * generator if needed (ie. in case we need a seeded random or a better
     * algorithm than the native one)
     */
    function random(){
        return random.get();
    }

    // we expose the method so it can be swapped if needed
    random.get = Math.random;

    module.exports = random;



},{}],49:[function(require,module,exports){
"use strict";

var Class = require('../');
var guid  = require('mout/random/guid');
var forIn  = require('mout/object/forIn');

var EventEmitter = new Class({
  Binds : ['on', 'off', 'once', 'emit'],

  callbacks : {},

  initialize : function() {
    var self = this;
    this.addEvent = this.on;
    this.removeListener = this.off;
    this.removeAllListeners = this.off;
    this.fireEvent = this.emit;
  },

  emit:function(event, payload){
    if(!this.callbacks[event])
      return;

    var args = Array.prototype.slice.call(arguments, 1);

    forIn(this.callbacks[event], function(callback){
      callback.apply(null, args);
    });
  },


  on:function(event, callback){
    if(!this.callbacks[event])
      this.callbacks[event] = {};
    this.callbacks[event][guid()] = callback;
  },

  once:function(event, callback){
    var self = this;
    var once = function(){
      self.off(event, once);
      callback.apply(null, arguments);
    };

    this.on(event, once);
  },

  off:function(event, callback){
    if(!event)
      this.callbacks = {};
    else if(!callback)
      this.callbacks[event] = {};
    else forIn(this.callbacks[event] || {}, function(v, k) {
      if(v == callback)
        delete this.callbacks[event][k];
    }, this);
  },
});

module.exports = EventEmitter;
},{"../":50,"mout/object/forIn":38,"mout/random/guid":44}],50:[function(require,module,exports){
"use strict";

var hasOwn = require("mout/object/hasOwn");
var create = require("mout/lang/createObject");
var merge  = require("mout/object/merge");
var kindOf = require("mout/lang/kindOf");
var mixIn  = require("mout/object/mixIn");


//from http://javascript.crockford.com/prototypal.html

var verbs = /^Implements|Extends|Binds$/

var implement = function(obj){
  for(var key in obj) {
    if(key.match(verbs)) continue;
    if((typeof obj[key] == 'function') && obj[key].$static)
      this[key] = obj[key];
    else
      this.prototype[key] = obj[key];
  }
  return this;
}



var uClass = function(proto){

  if(kindOf(proto) === "Function") proto = {initialize: proto};

  var superprime = proto.Extends;

  var constructor = (hasOwn(proto, "initialize")) ? proto.initialize : superprime ? superprime : function(){};



  var out = function() {
    var self = this;
      //autobinding takes place here
    if(proto.Binds) proto.Binds.forEach(function(f){
      var original = self[f];
      if(original)
        self[f] = mixIn(self[f].bind(self), original);
    });

      //clone non function/static properties to current instance
    for(var key in out.prototype) {
      var v = out.prototype[key], t = kindOf(v);

      if(key.match(verbs) || t === "Function") continue;
      if(t == "Object")
        self[key] = merge({}, self[key]); //create(null, self[key]);
      else if(t == "Array")
        self[key] = v.slice(); //clone ??
      else
        self[key] = v;
    }

    if(proto.Implements)
      proto.Implements.forEach(function(Mixin){
        Mixin.call(self);
      });




    constructor.apply(this, arguments);
  }

  out.implement = implement;


  if (superprime) {
    // inherit from superprime
      var superproto = superprime.prototype;
      if(superproto.Binds)
        proto.Binds = (proto.Binds || []).concat(superproto.Binds);

      if(superproto.Implements)
        proto.Implements = (proto.Implements || []).concat(superproto.Implements);

      var cproto = out.prototype = create(superproto);
      // setting constructor.parent to superprime.prototype
      // because it's the shortest possible absolute reference
      out.parent = superproto;
      cproto.constructor = out

  }


 if(proto.Implements) {
    if (kindOf(proto.Implements) !== "Array")
      proto.Implements = [proto.Implements];
    proto.Implements.forEach(function(Mixin){
      out.implement(Mixin.prototype);
    });
  }

  out.implement(proto);
  if(proto.Binds)
     out.prototype.Binds = proto.Binds;
  if(proto.Implements)
     out.prototype.Implements = proto.Implements;

  return out;
};



module.exports = uClass;
},{"mout/lang/createObject":29,"mout/lang/kindOf":35,"mout/object/hasOwn":40,"mout/object/merge":41,"mout/object/mixIn":42}]},{},[16]);
