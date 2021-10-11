'use strict';

const {useState}    = React;
const {useSelector} = ReactRedux;

const {Box, Button, Divider, Drawer, List, ListItem, ListItemIcon, ListItemText} = MaterialUi;
const {InboxIcon, MailIcon} = MaterialIcons;

const Layout = ({component : Component, ...rest}) => {
  const ready = useSelector(({config}) => config.ready);

  const [anchorStatus, setAnchorStatus] = useState(false);

  const ListComp = () => (
    <Box
      sx={{width : 250}}
      role="presentation"
      onClick={() => setAnchorStatus(false)}
    >
      <List>
        {['Inbox', 'Starred', 'Send email', 'Drafts'].map((text, index) => (
          <ListItem button key={text}>
            <ListItemIcon>
              {index % 2 === 0 ? <InboxIcon /> : <MailIcon />}
            </ListItemIcon>
            <ListItemText primary={text} />
          </ListItem>
        ))}
      </List>
      <Divider />
      <List>
        {['All mail', 'Trash', 'Spam'].map((text, index) => (
          <ListItem button key={text}>
            <ListItemIcon>
              {index % 2 === 0 ? <InboxIcon /> : <MailIcon />}
            </ListItemIcon>
            <ListItemText primary={text} />
          </ListItem>
        ))}
      </List>
    </Box>
  );

  return (!ready) ? null : (
    <React.Fragment>
      <div>
        <Button onClick={() => setAnchorStatus(true)}>test</Button>
        <Drawer
          anchor="left"
          open={anchorStatus}
          onClose={() => setAnchorStatus(false)}
        >
          <ListComp />
        </Drawer>
      </div>

      <div class="row nomargin" style={{paddingTop : '85px'}}>
        <div class="col-md-11 col-lg-11 col-centered">
          <Component {...rest} />
        </div>
      </div>
    </React.Fragment>
  );
};

module.exports = Layout;
