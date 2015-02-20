ScreenEvents.actions.wishlist = {
  rub_name : 'wishlist',

  dispatch_action : function(elem, app, id, rubric) {
    this.id = id.replace(this.rub_name + '_', '');
    this.rubric = rubric;
    this.app = app;
    this.elem = elem;
    switch(this.id) {
      case 'refresh' : 
        this.refresh_item();
        break;
      default :
        console.info('No bind on button ' + this.id);
        break;
    }

  },

  refresh_item : function() {
    var slot = this.elem.get('rel');
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
};