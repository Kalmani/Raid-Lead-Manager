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
