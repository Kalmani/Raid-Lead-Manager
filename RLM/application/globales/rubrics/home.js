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
    var response = JSON.parse(response);
    if (response.error) {
      this.app.alertMessage('error', response.error, document.id('login_panel'));
    } else if (response.warning) {
      this.app.alertMessage('warning', response.warning, document.id('login_panel'));
    } else if (response.success) {
      if (this.app.sess.login(response.user_datas)) {
        this.app.alertMessage('success', response.success, document.id('login_panel'));
        document.id('main_container').empty();
        this.app.make_nav();
        this.app.SCS.switchRubric('HOME');
      } else {
        this.app.alertMessage('error', response.error_case, document.id('login_panel'));
      }
    }
  },


};