"use strict";

module.exports = {

  rub_name : 'home',

  dispatch_action : function(elem, app, id, rubric) {
    this.id = id.replace(this.rub_name + '_', '');
    this.rubric = rubric;
    this.app = app;

    switch(this.id) {
      case 'login_try' : 
        this.login_try();
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


  /*test_import_update : function(response) {
    if (response === undefined) {
      var options = {
          'success' : this.test_import_update.bind(this)
        },
        params = {
        };
      this.app.ask_server('items', 'get_all_ids_item', params, options);
    } else {
      var response = JSON.parse(response),
          i = response.i || 0;
          ids = response.ids || response;
      if (i < ids.length) {
        console.log(i, ids);
        var options = {
            'success' : this.test_import_update.bind(this)
          },
          params = {
            'i' : i,
            'ids' : ids
          };
        this.app.ask_server('items', 'update_type', params, options);
      } else {
        console.info('FINISH');
      }
    }
  }

  test_import : function(response) {
    if (response) {
      var response = JSON.parse(response);
      if (!response.no_item && response['raid-normal'].itemLevel >= 665) {
        var line = new Element('div', {'class' : 'col-md-2', 'style' : 'color:#FFF;', 'text' : response['raid-normal'].id}).inject(document.id('listing'));
        var div2 = new Element('div', {'class' : 'col-md-2', 'style' : 'color:#FFF;', 'html' : '<img src="http://media.blizzard.com/wow/icons/56/'+response['raid-normal'].icon+'.jpg" />'}).inject(document.id('listing'));
        var div3 = new Element('div', {'class' : 'col-md-6', 'style' : 'color:#FFF;', 'text' : response['raid-normal'].name}).inject(document.id('listing'));
        var div4 = new Element('div', {'class' : 'col-md-2', 'style' : 'color:#FFF;', 'text' : response['raid-normal'].itemLevel}).inject(document.id('listing'));
        var div5 = new Element('div', {'style' : 'clear:both;'}).inject(document.id('listing'));
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
  }*/

};
