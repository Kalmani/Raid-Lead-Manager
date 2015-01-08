String.implement({
  startsWith : function(str) {
    return (this.indexOf(str) === 0);
  },
  replaces : function(hash) {
    var self = this;
    Object.each(hash, function(v, k) {
      self = self.replace(k, v);
    });
    return self;
  },
  nl2br : function() {
    var breakTag = '<br />';
    return (this + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
  }
});