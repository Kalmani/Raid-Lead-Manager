var ScreenEvents = new Class ({

  Binds : ['dispatch'],

  elem_id : null,
  args : null,

  initialize : function(app) {
    this.app = app;
    document.addEvent('click', function(evt) {
      var el = evt.target;
      if (el.get('id')) {
        this.elem_id = el.get('id');
      } else {
        while (el.parentNode) {
            el = el.parentNode;
            if(el.get('id')) {
              this.elem_id = el.get('id');
              break;
            }
        }
      }
      if (this.args && this.elem_id)
        this.dispatch_rubrics();

    }.bind(this), false);
  },

  dispatch : function(args) {
    this.args = args;
  },

  dispatch_rubrics : function() {
    var rubric = this.elem_id.split('_')[0];
    if (ScreenEvents.actions[rubric])
      ScreenEvents.actions[rubric].dispatch_action(this.app, this.elem_id, this.args);
  }

});

ScreenEvents.actions = {};