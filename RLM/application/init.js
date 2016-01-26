"use strict";

var RaidLeadManager = require('./raid_lead_manager');

window.addEvent('domready', function() {
  var wowhead_tooltips = { "colorlinks": false, "iconizelinks": false, "renamelinks": false }
  window.RLM = new RaidLeadManager();
  RLM.init();
});
