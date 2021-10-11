'use strict';

window.React            = require('react/cjs/react.production.min.js');
window.ReactDom         = require('react-dom/cjs/react-dom.production.min.js');
window.ReactRedux       = require('react-redux/dist/react-redux.min');
window.Redux            = require('redux');
window.ReactRouter      = require('react-router-dom');
window.RouterHistory    = require('history');

window.MaterialUi       = {
  Box          : require('@mui/material/Box').default,
  Button       : require('@mui/material/Button').default,
  Divider      : require('@mui/material/Divider').default,
  Drawer       : require('@mui/material/Drawer').default,
  List         : require('@mui/material/List').default,
  ListItem     : require('@mui/material/ListItem').default,
  ListItemIcon : require('@mui/material/ListItemIcon').default,
  ListItemText : require('@mui/material/ListItemText').default,
  TextField    : require('@mui/material/TextField').default
};

window.MaterialIcons    = {
  InboxIcon : require('@mui/icons-material/Inbox').default,
  MailIcon  : require('@mui/icons-material/Mail').default
};
