ScreenEvents.actions.settings = {
  rub_name : 'settings',

  dispatch_action : function(elem, app, id, rubric) {
    this.id = id.replace(this.rub_name + '_', '');
    this.rubric = rubric;
    this.app = app;

    switch(this.id) {
      case 'change_login_pass' :
        this.change_login_pass();
        break;
      case 'change_email' :
        this.change_email();
        break;
      default :
        console.info('No bind on button ' + this.id);
        break;
    }
  },

  change_login_pass : function() {
    var ids = [
          'identifiant',
          'old_password',
          'new_password',
          'new_password_conf'
        ],
        values = {};
    Array.each(ids, function(id) {
      values[id] = document.id(id).get('value').trim();
    });
    var options = {
          'success' : this.callback_change_login.bind(this)
        },
        params = values;
    this.app.ask_server('account', 'change_login', params, options);
  },

  callback_change_login : function(response) {
    var response = JSON.parse(response),
        zone = document.id('cell_identifiants_panels'),
        callback = function() {
          this.app.sess.update_value('user_log', response.datas.user_log);
          if (response.datas.user_pass)
            this.app.sess.update_value('user_pass', response.datas.user_pass);
          setTimeout(function () {
            this.app.SCS.switchRubric('HOME');
          }.bind(this), 1500);
        }.bind(this);
    this.app.generate_callback(response, zone, callback);
  },

  change_email : function() {
    var email = document.id('email').get('value').trim();
    var options = {
          'success' : this.callback_change_email.bind(this)
        },
        params = {'email' : email};
    this.app.ask_server('account', 'change_email', params, options);
  },

  callback_change_email : function(response) {
    var response = JSON.parse(response),
        zone = document.id('cell_other_settings_panels'),
        callback = function() {
          this.app.sess.update_value('user_mail', response.datas.user_mail);
          setTimeout(function () {
            this.app.SCS.switchRubric('HOME');
          }.bind(this), 1500);
        }.bind(this);
    this.app.generate_callback(response, zone, callback);
  }

};