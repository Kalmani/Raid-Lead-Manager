var Session = new Class ({

  character : null,

  initialize : function(app) {
    this.app = app;
  },

  login : function(datas) {
    if (!datas)
      return false;
    this.user = datas;
    return true;
  }

});
