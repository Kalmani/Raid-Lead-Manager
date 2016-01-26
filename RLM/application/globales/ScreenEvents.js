"use strict";

var Class        = require('uclass');

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
        var screen_id = this[app.current_screen],
            rubric = app.SCS.screens_list[screen_id],
            rubric_id = elem_id.split('_')[0];
        if (ScreenEvents.actions[rubric_id])
          ScreenEvents.actions[rubric_id].dispatch_action(el, app, elem_id, rubric);
      }
    }.bind(this), false);
  }

});

ScreenEvents.actions = {
  'home'     : require('./rubrics/home.js'),
  'settings' : require('./rubrics/settings.js'),
  'wishlist' : require('./rubrics/wishlist.js')
};

module.exports = ScreenEvents;
