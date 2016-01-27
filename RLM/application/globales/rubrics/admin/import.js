"use strict";

module.exports = {

  rub_name : 'import',

  dispatch_action : function(elem, app, id, rubric) {
    this.id = id.replace(this.rub_name + '_', '');
    this.rubric = rubric;
    this.app = app;

    switch(this.id) {
      case 'import_items' : 
        this.import_items();
        break;
      default :
        console.info('No bind on button ' + this.id);
        break;
    }

  },

  import_items : function() {
    var self = this,
        item_id = document.id('start_id').get('value').trim();

    if (item_id != parseInt(item_id) || !item_id)
      return;

    var options = {
          'success' : self.loop_import_item.bind(this)
        },
        params = {
          'item_id' : item_id
        };

    self.app.ask_server('items', 'import_item', params, options);
  },

  loop_import_item : function(data) {
    var self = this,
        data = JSON.parse(data),
        next_id = data.next_id;

    if (data.no_item) {
      console.error('No item for id ', data.no_item);
    } else {
      console.log('Item found for id ', data.item_id);
    }
    var options = {
          'success' : self.loop_import_item.bind(this)
        },
        params = {
          'item_id' : next_id
        };

    self.app.ask_server('items', 'import_item', params, options);
  },

};
