// instanciate all pages
var RaidLeadManager = new Class ({

  Implements : Events,

  // to bind some methods, use binds : ['method1, method2'],

  locales : {},

  // declare methodes here :
  initialize : function() {
    console.log('initializing api');
    this.sess = new Session(this);
    this.ScreenSwitch = new ScreenSwitcher(this);
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
    Object.each(this.config.rubrics, function(datas, screen) {
      RaidLeadManager[screen] = screen;
      this.ScreenSwitch.register(new window[datas.className](this, RaidLeadManager[screen], screen.datas));
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
    // load templates here
  }

});
