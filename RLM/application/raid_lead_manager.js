// instanciate all pages
var RaidLeadManager = new Class ({

  Implements : Events,

  // to bind some methods, use binds : ['method1, method2'],

  locales : {},
  templates  : {},

  // declare methodes here :
  initialize : function() {
    console.log('initializing api');
    this.sess = new Session(this);
    this.SCS = new ScreenSwitcher(this);
  },

  init : function() {
    var load_ready = {};

    this.addEvent('init', function(step) {
      load_ready[step] = true;
      console.info("Load ", step, " > Finish");

      if(load_ready.templates && load_ready.locales)
        this.show_content();
    });

    this.load_config();
  },

  load_config : function() {
    new Request({
      url : 'config.json?',
      onSuccess : function(txt) {
        this.config = JSON.decode(txt);
        // Build endpoints
        this.navigation = this.get_rubrics_list();
        this.load_locales();
        this.load_templates();
      }.bind(this)
    }).get();
  },

  get_rubrics_list : function() {
    Object.each(this.config.rubrics, function(data, screen) {
      RaidLeadManager[screen] = screen;
      this.SCS.register(new window[data.className](this, RaidLeadManager[screen], data));
    }.bind(this));
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
            tmp[lang]['&' + k + ';'] = v;
          });
        });

        //ensure at least default en-us is used
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
    this.SCS.screens_list.HOME.show_login_panel();
  },

  render : function(template_id, view) {
    var res, output = Mustache.render(this.templates[template_id], view, this.templates);
    output = this.translate_full(output);
    return new Element('div', {html : output});
  },

  translate : function(i) {
    if(i === "" || !i) return "";
    return this.translate_full('&' + i + ';');
  },

  translate_full : function(i) {
    var tmp = '', lang = this.current_language || 'fr-fr';
    do {
      tmp = i;
      i = i.replaces(this.locales[lang]);
    } while (tmp != i);
    return tmp;
  }

});
