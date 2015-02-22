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
    var response = JSON.parse(response);
    if (response.error) {
      this.app.alertMessage('error', response.error, document.id('cell_identifiants_panels'));
    } else if (response.warning) {
      this.app.alertMessage('warning', response.warning, document.id('cell_identifiants_panels'));
    } else if (response.success) {
      this.app.sess.update_value('user_log', response.datas.user_log);
      if (response.datas.user_pass)
        this.app.sess.update_value('user_pass', response.datas.user_pass);
      this.app.alertMessage('success', response.success, document.id('cell_identifiants_panels'));
      setTimeout(function () {
        this.app.SCS.switchRubric('HOME');
      }.bind(this), 1500);
    }
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
    var response = JSON.parse(response);
    console.log(response);
    if (response.error) {
      this.app.alertMessage('error', response.error, document.id('cell_other_settings_panels'));
    } else if (response.warning) {
      this.app.alertMessage('warning', response.warning, document.id('cell_other_settings_panels'));
    } else if (response.success) {
      this.app.sess.update_value('user_mail', response.datas.user_mail);
      if (response.datas.user_pass)
        this.app.sess.update_value('user_pass', response.datas.user_pass);
      this.app.alertMessage('success', response.success, document.id('cell_other_settings_panels'));
      setTimeout(function () {
        this.app.SCS.switchRubric('HOME');
      }.bind(this), 1500);
    }
  }

};