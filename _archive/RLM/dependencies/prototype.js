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

Object.prototype.join = function(hash) {
  var join = '',
      i = 0;
  Object.each(this, function(value, key) {
    join += (i > 0) ? hash : '';
    join += key + '=' + value;
    i++;
  });
  return join;
}

XMLDocument.fromXML = function(xml) {
  var parser = new DOMParser();
  return parser.parseFromString(xml, "text/xml");
};

XMLDocument.prototype.xpath = function(query, ctx) {
  var out = [],
      result = this.evaluate(query, ctx || this, null, XPathResult.ANY_TYPE, null),
      current = result.iterateNext();
  while (current) {
    out.push(current);
    current = result.iterateNext();
  }
  return out;
};