'use strict';

const {useState}    = React;
const {useSelector} = ReactRedux;
const {
  Route,
  Switch,
  Redirect,
  useLocation,
  withRouter
} = ReactRouter;

const {keys}  = require('mout/object');

const {Screens} = require('./views');
const Layout  = require('./layout');

const default_screen = 'home';

const Routes = () => {
  const componentNames = useSelector(({config}) => config.componentNames);
  const connected      = useSelector(({session}) => session.connected);

  const [pathname]     = useState(`${useLocation().pathname}${useLocation().search}`);

  let fallback         = ['/', '/Login'].includes(pathname) ? null : pathname;

  if(connected && !fallback)
    fallback = default_screen;

  let [from_route, to_route] = connected ? ['/Login', fallback] : [useLocation().pathname, '/Login'];
  let redirect_props         = {to : to_route};

  if(from_route)
    redirect_props.from = from_route;

  return !componentNames ? null : (
    <Switch>
      {redirect_props.from != redirect_props.to ? <Redirect exact {...redirect_props} /> : null}
      <Route path="/" exact={true} render={(props) => <Layout component={Screens[default_screen]} {...props} />} />
      {keys(Screens).map((componentLink) => {
        let componentName = componentNames[componentLink];

        return (<Route key={componentName} path={`/${componentLink}/:slug?`} render={(props) => <Layout component={Screens[componentLink]} {...props} />} />);
      })}
      {/*<Route render={() => <Layout component={Screens.NotFound} />} />*/}
    </Switch>
  );
};

module.exports = withRouter(Routes);
