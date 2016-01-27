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
    console.log('ok ?');
  },

};
