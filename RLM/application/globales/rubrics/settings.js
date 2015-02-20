ScreenEvents.actions.settings = {
  rub_name : 'settings',

  dispatch_action : function(app, id, rubric) {
    this.id = id.replace(this.rub_name + '_', '');
    this.rubric = rubric;
    this.app = app;

    switch(this.id) {
      case 'btn_test' : 
        this.test_func();
        break;
    }
  },

  test_func : function() {
    console.log(this.rubric);
  },

};