ScreenEvents.actions.settings = {
  rub_name : 'settings',

  dispatch_action : function(elem, app, id, rubric) {
    this.id = id.replace(this.rub_name + '_', '');
    this.rubric = rubric;
    this.app = app;

    switch(this.id) {
      case 'btn_test' : 
        this.test_func();
        break;
      default :
        console.info('No bind on button ' + this.id);
        break;
    }
  },

  test_func : function() {
    console.log(this.rubric);
  },

};