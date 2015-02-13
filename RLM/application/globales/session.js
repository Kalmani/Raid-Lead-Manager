var Session = new Class ({

  character : null,

  initialize : function(app) {
    this.app = app;
    this.user = JSON.parse(Cookie.read('RLM_user')) || false;
  },

  login : function(datas) {
    if (!datas)
      return false;
    var cookme = new Cookie('RLM_user', false);
    cookme.write(JSON.stringify(datas));
    this.user = datas;
    return true;
  },

  disconnect : function() {
    Cookie.dispose('RLM_user');
  }

});
