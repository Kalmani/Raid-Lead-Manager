// instanciate all pages
var RaidLeadManager = new Class ({
  // to extend class : use Extends : className,
  // to bind some methods, use binds : ['method1, method2'],
  // declare global vars here

  // declare methodes here :
  initialize : function() {
    console.log('initializing api');
    this.ScreenSwitch = new ScreenSwitcher(this);
  },

  init : function() {
    this.sess = new Session(this);
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
    // load texts here
  },

  load_templates : function() {
    // load templates here
  }

});
