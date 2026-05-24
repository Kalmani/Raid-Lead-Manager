import React from 'react';
import {
  Avatar,
  Box,
  Button,
  Chip,
  Divider,
  List,
  ListItemButton,
  ListItemText,
  Paper,
  Stack,
  Typography
} from '@mui/material';

import {getMenuGroups} from '../lib/menu';
import {navigateTo} from '../hooks/useHashRoute';

const packageMeta = require('../../../package.json');
const appVersion = packageMeta.version || '0.0.0';

function AppShell({children, currentPath, onLogout, screenMeta, session}) {
  const menuGroups = getMenuGroups();
  const displayName = session.user_perso || session.user_log;

  return (
    <Box
      sx={{
        position : 'relative',
        display : 'grid',
        gridTemplateColumns : {
          xs : '1fr',
          md : '320px minmax(0, 1fr)'
        },
        gap : 3,
        minHeight : '100vh',
        maxWidth : 1640,
        mx : 'auto',
        p : {
          xs : 2,
          md : 3
        },
        '&::before' : {
          content : '""',
          position : 'absolute',
          inset : {
            xs : '12px 12px auto',
            md : '20px 20px auto'
          },
          height : 180,
          borderRadius : 4,
          background : 'linear-gradient(90deg, rgba(228,191,115,0.28), rgba(120,168,216,0.12), transparent)',
          filter : 'blur(22px)',
          pointerEvents : 'none',
          opacity : 0.7
        }
      }}
    >
      <Paper
        component="aside"
        sx={{
          p : {
            xs : 2.5,
            md : 3
          },
          minWidth : 0,
          display : 'flex',
          flexDirection : 'column',
          gap : 3,
          backgroundImage : 'linear-gradient(180deg, rgba(228,191,115,0.1), transparent 26%), linear-gradient(150deg, rgba(20,28,43,0.94), rgba(10,15,26,0.94))',
          overflowY : {
            md : 'auto'
          },
          position : {
            md : 'sticky'
          },
          top : {
            md : 24
          },
          height : {
            md : 'calc(100vh - 48px)'
          }
        }}
      >
        <Stack spacing={2}>
          <Stack alignItems="center" direction="row" spacing={1.5}>
            <Box sx={{minWidth : 0}}>
              <Typography sx={{lineHeight : 1.05, overflowWrap : 'anywhere'}} variant="h5">Raid Lead Manager</Typography>
              <Typography color="text.secondary" sx={{mt : 0.35}} variant="body2">
                Command bridge pour roster, wishlist et pilotage de raid.
              </Typography>
            </Box>
          </Stack>
        </Stack>

        {menuGroups.map((group) => (
          <Box key={group.title}>
            <Typography color="text.secondary" sx={{mb : 1, letterSpacing : '0.12em', textTransform : 'uppercase'}} variant="caption">
              {group.title}
            </Typography>
            <List disablePadding>
              {group.items.map((item) => (
                <ListItemButton
                  selected={currentPath === item.path}
                  key={item.path}
                  onClick={() => navigateTo(item.path)}
                  sx={{
                    minWidth : 0,
                    alignItems : 'flex-start',
                    border : '1px solid',
                    borderColor : currentPath === item.path ? 'primary.main' : 'rgba(255,255,255,0.08)',
                    bgcolor : currentPath === item.path ? 'rgba(228,191,115,0.12)' : 'rgba(255,255,255,0.03)',
                    boxShadow : currentPath === item.path ? 'inset 0 0 0 1px rgba(255,255,255,0.04), 0 12px 30px rgba(0,0,0,0.2)' : 'none'
                  }}
                >
                  <ListItemText
                    primary={item.label}
                    primaryTypographyProps={{
                      sx : {
                        lineHeight : 1.25,
                        whiteSpace : 'normal',
                        overflowWrap : 'anywhere'
                      }
                    }}
                    sx={{minWidth : 0}}
                  />
                </ListItemButton>
              ))}
            </List>
          </Box>
        ))}

        <Divider sx={{mt : 'auto'}} />

        <Button onClick={onLogout} size="large" variant="outlined">
          Déconnexion
        </Button>
      </Paper>

      <Box component="main" sx={{minWidth : 0}}>
        <Stack spacing={3}>
          <Paper
            sx={{
              p : {
                xs : 2.5,
                md : 3.5
              },
              backgroundImage : 'linear-gradient(135deg, rgba(228,191,115,0.15), rgba(120,168,216,0.12) 42%, rgba(11,18,32,0.9) 78%)'
            }}
          >
            <Stack spacing={2}>
              <Stack direction={{xs : 'column', sm : 'row'}} justifyContent="space-between" spacing={2}>
                <Typography color="text.secondary" sx={{alignSelf : {sm : 'center'}}} variant="body2">
                  {`Connecté en tant que ${displayName}`}
                </Typography>
              </Stack>
              <Typography sx={{lineHeight : 0.98, overflowWrap : 'anywhere', maxWidth : 900}} variant="h3">
                {screenMeta.title}
              </Typography>
              <Typography color="text.secondary" sx={{overflowWrap : 'anywhere', maxWidth : 760}}>
                {screenMeta.description}
              </Typography>
            </Stack>
          </Paper>

          {children}

          <Paper
            sx={{
              p : 2.5,
              backgroundImage : 'linear-gradient(90deg, rgba(228,191,115,0.08), rgba(255,255,255,0.01) 35%, rgba(120,168,216,0.08))'
            }}
          >
            <Typography color="text.secondary" sx={{lineHeight : 1.4, overflowWrap : 'anywhere', textAlign : 'center'}} variant="body2">
              {`v${appVersion} • created by Kalmani, boosted by his friend codex`}
            </Typography>
          </Paper>
        </Stack>
      </Box>
    </Box>
  );
}

export default AppShell;
