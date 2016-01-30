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

    self.total = 0;
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

    self.total++;

    var total_container = document.id('total_container'),
        current_status_container = document.id('current_status_container'),
        total_dom = new Element('span', {'html' : 'Total items scaned : ' + self.total}),
        current_dom = new Element('span', {'html' : ((data.no_item) ? 'No item for id ' + data.no_item : 'Item found for id ' + data.item_id)  + '<br />Next id : ' + next_id});
    
    total_dom.inject(total_container.empty());
    current_dom.inject(current_status_container.empty());

    var options = {
          'success' : self.loop_import_item.bind(this)
        },
        params = {
          'item_id' : next_id
        };

    self.app.ask_server('items', 'import_item', params, options);
  },

};
