// instanciate all pages
var raidLeadManager = new Class ({
  // to extend class : use Implement : className,
  // to bind some methods, use binds : ['method1, method2'],
  // declare global vars here

  // declare methodes here :
  initialize : function() {
    console.log('initializing api');
  },

  init : function() {
    this.sess = new Session(this);
    console.log(this.sess);
  },

  other_method : function() {

  }
});