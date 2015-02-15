var WishlistScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  Binds : ['bind_btn'],

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    this.parent(app);
    this.SCS = this.app.SCS;
  },

  show : function(args) {
    console.log(this.ID);
    this.parent(args);
    this.app.addEvent('asyn_panel_ready', function(panel_id) {
      if (panel_id == 'wish_list_panel') {
        this.bind_btns();
      }
    }.bind(this));
  },

  bind_btns : function() {
    Object.each(document.getElements('.refresh_item'), function(elem) {
      if (typeof(elem) !== 'number') {
        var slot = elem.get('id').split('_')[1];
        elem.removeEvents('click');
        elem.addEvent('click', this.bind_btn.pass(slot));
      }
    }.bind(this));
  },

  bind_btn : function(slot) {
    console.info('refresh slot : ' + slot);
    var line = document.id('line_' + slot);
    line.addClass('loading_stuff');
    var options = {
      'success' : function(response) {
        var result = JSON.parse(response);
        line.getElement('.item_img').set('src', 'http://eu.media.blizzard.com/wow/icons/56/' + result.img + '.jpg');
        line.getElement('.item_name').set('html', result.name);
        line.getElement('.item_level').set('level', result.level);
        line.removeClass('loading_stuff');
        // don't forget to switch border colors with response.scarcity
      }.bind(this)
    },
    params = {
      'slot' : slot,
      'nocache' : true,
    };
    this.app.ask_server('character', 'update_item', params, options);
  },

});
