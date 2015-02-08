var ScreenGlobalsMethods = new Class ({

  active : false,
  link : false,
  subs : false,

  initialize : function(app) {
    this.app = app;
    this.is_active();
    this.get_nav_component();
    this.get_panels();
  },

  is_active : function() {
    // tu as ce dont tu as besoin ici : this.ID / this.data
    this.active = true;
  },

  get_nav_component : function() {
    if (this.active === false)
      return false;
    this.link = {
      'title' : this.app.translate("Menu." + this.ID + ".Title"),
      'id' : this.ID
    };
    // not recursive, it sucks hard for now
    if (this.data.subs) {
      this.link.subs = new Array();
      this.link.has_sub = true;
      var i = 0;
      Object.each(this.data.subs, function(data, screen) {
        RaidLeadManager[screen] = screen;
        var sub = this.app.SCS.register(new window[data.className](this.app, RaidLeadManager[screen], data));
        if (sub !== false) {
          this.link.subs[i] = sub;
          i++;
        }
      }.bind(this));
    }
  },

  show : function(args) {
    this.app.current_screen = this.ID;
    $('.nav_link, .nav_subs').removeClass('active');
    if (this.parentID) {
      $('#' + this.parentID).addClass('active');
    } else {
      $('#' + this.ID).addClass('active');
    }
  },

  get_panels : function() {
    // take panels from config
    this.panels_list = this.app.config.panels_list[this.ID];
  },






  items_list : function() {
    //expected output
    var items_list = [
      {
        'name' : "Chapel d'harmonie céleste",
        'img_url' : "http://eu.media.blizzard.com/wow/icons/56/inv_mail_raidshaman_n_01helm.jpg",
        'item_caracs' : {
          'item' : '99332',
          'domain' : 'fr',
          'gems' : '95347:76694',
          'ench' : ''
        },
        'level' : 566,
        'status' : 'warning',
        'scarcity' : 4,
        'has_item' : true
      },
      {
        'name' : "Collier de la lumière faiblissante",
        'img_url' : "http://eu.media.blizzard.com/wow/icons/56/inv_misc_necklace_mop5.jpg",
        'item_caracs' : {
          'item' : '104477',
          'domain' : 'fr',
          'gems' : '',
          'ench' : ''
        },
        'level' : 566,
        'status' : 'warning',
        'scarcity' : 4,
        'has_item' : true
      },
      {
        'name' : "Drape-épaules d'harmonie céleste",
        'img_url' : "http://eu.media.blizzard.com/wow/icons/56/inv_mail_raidshaman_n_01shoulder.jpg",
        'item_caracs' : {
          'item' : '99334',
          'domain' : 'fr',
          'gems' : '76694:76694',
          'ench' : '4915'
        },
        'level' : 566,
        'status' : 'warning',
        'scarcity' : 4,
        'has_item' : true
      },
      {
        'name' : "Xing-Ho, Souffle de Yu'lon",
        'img_url' : "http://eu.media.blizzard.com/wow/icons/56/inv_cape_pandaria_dragoncaster_d_02.jpg",
        'item_caracs' : {
          'item' : '102246',
          'domain' : 'fr',
          'gems' : '76694',
          'ench' : '4423'
        },
        'level' : 608,
        'status' : 'warning',
        'scarcity' : 4,
        'has_item' : true
      },
      {
        'name' : "Haubert d'harmonie céleste",
        'img_url' : "http://eu.media.blizzard.com/wow/icons/56/inv_mail_raidshaman_n_01chest.jpg",
        'item_caracs' : {
          'item' : '99344',
          'domain' : 'fr',
          'gems' : '76694:76694:76694',
          'ench' : '4419'
        },
        'level' : 566,
        'status' : 'warning',
        'scarcity' : 4,
        'has_item' : true
      },
      {
        'name' : "Garde-poignets de cavernier",
        'img_url' : "http://eu.media.blizzard.com/wow/icons/56/inv_mail_raidshaman_n_01bracer.jpg",
        'item_caracs' : {
          'item' : '105524',
          'domain' : 'fr',
          'gems' : '',
          'ench' : '4414'
        },
        'level' : 572,
        'status' : 'warning',
        'scarcity' : 4,
        'has_item' : true
      },
      {
        'name' : "Gants d'harmonie céleste",
        'img_url' : "http://eu.media.blizzard.com/wow/icons/56/inv_mail_raidshaman_n_01glove.jpg",
        'item_caracs' : {
          'item' : '99345',
          'domain' : 'fr',
          'gems' : '76694:76694',
          'ench' : '4431'
        },
        'level' : 566,
        'status' : 'warning',
        'scarcity' : 4,
        'has_item' : true
      },
      {
        'name' : "Ceinture en anneaux chitineux",
        'img_url' : "http://eu.media.blizzard.com/wow/icons/56/inv_mail_raidshaman_n_01belt.jpg",
        'item_caracs' : {
          'item' : '103941',
          'domain' : 'fr',
          'gems' : '76694:76668:76694',
          'ench' : '4431'
        },
        'level' : 553,
        'status' : 'warning',
        'scarcity' : 4,
        'has_item' : true
      },
      {
        'name' : "Jambières d'harmonie céleste",
        'img_url' : "http://eu.media.blizzard.com/wow/icons/56/inv_mail_raidshaman_n_01pant.jpg",
        'item_caracs' : {
          'item' : '99333',
          'domain' : 'fr',
          'gems' : '76672:76672',
          'ench' : '4825'
        },
        'level' : 566,
        'status' : 'warning',
        'scarcity' : 4,
        'has_item' : true
      },
      {
        'name' : "Solerets de profanation",
        'img_url' : "http://eu.media.blizzard.com/wow/icons/56/inv_mail_raidshaman_n_01boot.jpg",
        'item_caracs' : {
          'item' : '104450',
          'domain' : 'fr',
          'gems' : '76694',
          'ench' : '4426'
        },
        'level' : 566,
        'status' : 'warning',
        'scarcity' : 4,
        'has_item' : true
      },
      {
        'name' : "Chevalière de la coupe au laser",
        'img_url' : "http://eu.media.blizzard.com/wow/icons/56/inv_misc_ring_mop17.jpg",
        'item_caracs' : {
          'item' : '104524',
          'domain' : 'fr',
          'gems' : '76668',
          'ench' : ''
        },
        'level' : 566,
        'status' : 'warning',
        'scarcity' : 4,
        'has_item' : true
      },
      {
        'no_item' : true
      },
      {
        'no_item' : true
      },
      {
        'name' : "Liens purifiés d'Immerseus",
        'img_url' : "http://eu.media.blizzard.com/wow/icons/56/inv_jewelry_orgrimmarraid_trinket_07.jpg",
        'item_caracs' : {
          'item' : '104426',
          'domain' : 'fr',
          'gems' : '',
          'ench' : ''
        },
        'level' : 566,
        'status' : 'warning',
        'scarcity' : 4,
        'has_item' : true
      },
      {
        'name' : "Masse de guerre de Hurlenfer",
        'img_url' : "http://eu.media.blizzard.com/wow/icons/56/inv_hammer_1h_pvphorde_a_01red_upres.jpg",
        'item_caracs' : {
          'item' : '105688',
          'domain' : 'fr',
          'gems' : '76694:76694',
          'ench' : '4442'
        },
        'level' : 574,
        'status' : 'warning',
        'scarcity' : 4,
        'has_item' : true
      },
      {
        'name' : "Barrière énigmatique de Norushen",
        'img_url' : "http://eu.media.blizzard.com/wow/icons/56/inv_shield_orgrimmarraid_d_02.jpg",
        'item_caracs' : {
          'item' : '104470',
          'domain' : 'fr',
          'gems' : '76694',
          'ench' : '4434'
        },
        'level' : 566,
        'status' : 'warning',
        'scarcity' : 4,
        'has_item' : true
      }
    ];
    return items_list;
  }

});
