ScreenEvents.actions.home = {
  rub_name : 'home',

  dispatch_action : function(elem, app, id, rubric) {
    this.id = id.replace(this.rub_name + '_', '');
    this.rubric = rubric;
    this.app = app;

    switch(this.id) {
      case 'login_try' : 
        this.login_try();
        break;
    }

  },

  login_try : function() {
    this.app.loading(document.id('login_panel'));
    var pseudo = document.id('identifiant').value,
        pass = document.id('password').value;
    this.rubric.try_login(pseudo, pass);
  },
};