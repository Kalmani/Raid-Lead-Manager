var HomeScreen = new Class ({

  Extends : ScreenGlobalsMethods,

  Binds : ['show', 'callback_login'],

  initialize : function(app, screen_id, screen_data) {
    this.data = screen_data;
    this.ID = screen_id;
    this.parent(app);
    this.SCS = this.app.SCS;
  },


  show_login_panel : function() {
    this.parent();
    var dom = document.getElementById('main_container'),
        zone = this.SCS.switchPanel('login_tpl', dom);
  },

  show : function(args) {
    this.parent(args);
  },

  items_list : function() {
    var context = {'left' : new Array(), 'right' : new Array()},
        item = 0;
    Object.each(this.parent(), function(item_datas, key) {
      item_datas.item_url = null;
      if (item_datas.item_caracs)
        item_datas.item_url = item_datas.item_caracs.join('&amp;');
      var current = item_datas;
      if (item < 8) {
        context.left[context.left.length] = current;
      } else {
        context.right[context.right.length] = current;
      }
      item++;
    });
    return context;
  },

});
