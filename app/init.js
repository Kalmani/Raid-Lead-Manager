'use strict';

//const Provider      = ReactRedux.Provider;

//const store           = require('./store');
const RaidLeadManager = require('./views/Manager');

//const {initApp}     = require('./store/actions');

const render = () => {
  ReactDom.render(
    (<RaidLeadManager />),
    document.getElementById('root')
  );
};

//store.subscribe(render);
render();
//store.dispatch(initApp());
