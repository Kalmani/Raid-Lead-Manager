var ScreenEvents = new Class ({

  initialize : function(app) {
    var elem_id = null;
    document.addEvent('click', function(evt) {
      var el = evt.target;
      if (el.get && el.get('id')) {
        elem_id = el.get('id');
      } else {
        while (el.parentNode) {
            el = el.parentNode;
            if(el.get && el.get('id')) {
              elem_id = el.get('id');
              break;
            }
        }
      }
      if (elem_id) {
        var screen_id = RaidLeadManager[app.current_screen],
            rubric = app.SCS.screens_list[screen_id],
            rubric_id = elem_id.split('_')[0];
        console.log(app.current_screen, screen_id, rubric, rubric_id);
        if (ScreenEvents.actions[rubric_id])
          ScreenEvents.actions[rubric_id].dispatch_action(app, elem_id, rubric);
      }
    }.bind(this), false);
  }

});

ScreenEvents.actions = {};