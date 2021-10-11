'use strict';

const Provider               = ReactRedux.Provider;
const {createBrowserHistory} = RouterHistory;

const {
  Router,
  Route,
  Switch
} = ReactRouter;

const store           = require('./store');
const Routes          = require('./Routes');

const history         = createBrowserHistory();

const {initApp}     = require('./store/actions');

const render = () => {
  ReactDom.render(
    (<Provider store={store}>
      <Router history={history} basename="/">
        <Switch>
          <Route component={Routes} />
        </Switch>
      </Router>
    </Provider>),
    document.getElementById('root')
  );
};

store.subscribe(render);
render();
store.dispatch(initApp());
