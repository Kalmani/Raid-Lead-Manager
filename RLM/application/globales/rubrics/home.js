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
      case 'test_impot' :
        this.i = 113817;
        this.test_import();
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

  test_import : function(response) {
    if (response) {
      var response = JSON.parse(response);
      if (!response.no_item && response['raid-normal'].requiredLevel == 100 && response['raid-normal'].itemLevel >= 665) {
        console.log(response);
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
  }


};