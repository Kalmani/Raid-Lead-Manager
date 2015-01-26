var HomeScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  Binds : ['callback_login'],

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    this.parent(app);
    this.SCS = this.app.SCS;
  },


  show_login_panel : function() {
    var dom = document.getElementById('main_container'),
        zone = this.SCS.switchPanel('login_tpl', dom);

    zone.getElementById('login_try').addEvent('click', function() {
      this.app.loading(document.id('main_container'));
      var pseudo = document.id('identifiant').value,
          pass = document.id('password').value;
      this.try_login(pseudo, pass);
    }.bind(this));
  },

  try_login : function(pseudo, pass) {
    var options = {
          'success' : this.callback_login
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
      this.app.alertMessage('error', response.error, document.id('main_container'));
    } else if (response.warning){
      this.app.alertMessage('warning', response.warning, document.id('main_container'));
    }
  },

  show : function(args) {
    this.parent(args);
    var dom = document.getElementById('main_container');
    this.SCS.panels_list = {
      'profile_panel' : {'id' : 'profile_missing_panel', 'animate' : 'fadeIn', 'context' : this.profile_context()},
      'missing_panel' : {'id' : 'profile_missing_panel', 'animate' : 'fadeIn'},
      'updates_panel' : {'id' : 'profile_missing_panel', 'animate' : 'flash', 'context' : this.updates_context()},
      'items_list_panel' : {'id' : 'stuff_panel', 'animate' : 'fadeIn', 'context' : this.items_list()}
    };
    this.SCS.switchScreen('home_main', dom);
  },

  profile_context : function() {
    //expected concept
    var context = {
      'character' : {
        'pseudo' : 'Kalmani',
        'classe' : 'Chaman',
        'activ_spe' : 'Restauration',
        'ilvl' : 667,
        'wish_ilvl' : 670,
        'accomplished_purcent' : 75,
        'loots_by_raid' : 0.78,
        'professions' : [
          {'name' : 'Alchimie', 'level' : 650, 'max' : 700},
          {'name' : 'Calligraphie', 'level' : 636, 'max' : 700}
        ],
        'last_loots' : [
          {'name' : 'Ceinture en anneaux chitineux', 'level' : 553},
          {'name' : 'Brassards du purificateur en parfait état', 'level' : 553},
          {'name' : 'Cristal de rage frénétique', 'level' : 553}
        ]
      },
      'guild_characters' : [
        {'pseudo' : 'Deewan'},
        {'pseudo' : 'Efcaïa'},
        {'pseudo' : 'Faytas'},
        {'pseudo' : 'Grimnak'},
        {'pseudo' : 'Harôkar'},
        {'pseudo' : 'Ilmïrïs'},
        {'pseudo' : 'Kalhan'},
        {'pseudo' : 'Kélarno'},
        {'pseudo' : 'Rotkäppchen'},
        {'pseudo' : 'Telvia'},
        {'pseudo' : 'Valhallà'},
        {'pseudo' : 'Warana'},
        {'pseudo' : 'Zhalob'}
      ]
    }
    return context;
  },

  updates_context : function() {
    var context = {
      'updates' : [
        {'author' : 'Kalmani', 'date' : '09/10/2013', 'note' : "Vous pouvez maintenant envoyer plein de Po à Kalmani pour ce qu'il fait pour la guilde ! (de toute façon, qui lira cette note franchement...)"},
        {'author' : 'Kalmani', 'date' : '09/10/2013', 'note' : "Possibilité de corriger une erreur d'attribution de loot"},
        {'author' : 'Kalmani', 'date' : '09/10/2013', 'note' : "Possibilité de choisir des loots non BIS et sa spé 2"},
        {'author' : 'Kalmani', 'date' : '16/09/2013', 'note' : "Vous pouvez maintenant rechercher une pièce en tapant le début de son nom sans majuscule"},
        {'author' : 'Kalmani', 'date' : '12/09/2013', 'note' : "Nouvelle fonctionnalité dans paramètre : Vous pouvez rafraichir votre fiche sans supprimer votre wish list :)"},
        {'author' : 'Kalmani', 'date' : '12/09/2013', 'note' : "Objets 5.4 importés."}
      ]
    };
    return context;
  },

  items_list : function() {
    var context = {'left' : new Array(), 'right' : new Array()},
        item = 0;
    Object.each(this.parent(), function(item_datas, key) {
      item_datas.item_url = null;
      if (item_datas.item_caracs)
        item_datas.item_url = item_datas.item_caracs.join('&amp;');
      var current = item_datas;
      if (item < 8) {
        context.left[context.left.length] = current;
      } else {
        context.right[context.right.length] = current;
      }
      item++;
    });
    return context;
  },

});
