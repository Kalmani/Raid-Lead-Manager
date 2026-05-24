import React, {useEffect, useState} from 'react';
import {Box, CircularProgress, Typography} from '@mui/material';

import AppShell from './components/AppShell';
import AttributionScreen from './screens/AttributionScreen';
import LoginScreen from './screens/LoginScreen';
import HomeScreen from './screens/HomeScreen';
import SettingsScreen from './screens/SettingsScreen';
import WishlistScreen from './screens/WishlistScreen';
import PlaceholderScreen from './screens/PlaceholderScreen';
import {postAction} from './lib/api';
import {getScreenMeta} from './lib/menu';
import {clearSession, readSession, updateSession, writeSession} from './lib/session';
import {navigateTo, useHashRoute} from './hooks/useHashRoute';

const DEFAULT_CONFIG = {
  action_root : 'actions/main.php'
};

async function loadConfig() {
  try {
    const response = await fetch('config.json', {credentials : 'same-origin'});
    if (!response.ok) {
      return DEFAULT_CONFIG;
    }

    const data = await response.json();
    return {...DEFAULT_CONFIG, ...data};
  } catch (error) {
    return DEFAULT_CONFIG;
  }
}

function App() {
  const [config, setConfig] = useState(DEFAULT_CONFIG);
  const [configReady, setConfigReady] = useState(false);
  const [session, setSession] = useState(() => readSession());
  const {path} = useHashRoute(Boolean(session));

  useEffect(() => {
    let active = true;

    loadConfig().then((data) => {
      if (!active) {
        return;
      }

      setConfig(data);
      setConfigReady(true);
    });

    return () => {
      active = false;
    };
  }, []);

  const actionRoot = config.action_root || DEFAULT_CONFIG.action_root;
  const screenMeta = getScreenMeta(path);

  const handleLogin = (user) => {
    writeSession(user);
    setSession(user);
    navigateTo('/home');
  };

  const handleSessionPatch = (patch) => {
    const nextSession = updateSession(patch);
    setSession(nextSession);
  };

  const handleLogout = () => {
    clearSession();
    setSession(null);
    navigateTo('/login');
  };

  if (!configReady) {
    return (
      <Box
        sx={{
          minHeight : '100vh',
          display : 'grid',
          placeItems : 'center',
          gap : 2,
          p : 4
        }}
      >
        <CircularProgress color="primary" />
        <Typography color="text.secondary">Chargement du shell Material UI…</Typography>
      </Box>
    );
  }

  if (!session) {
    return (
      <LoginScreen
        actionRoot={actionRoot}
        onLogin={handleLogin}
      />
    );
  }

  let content = (
    <PlaceholderScreen
      title={screenMeta.title}
      description={screenMeta.description}
    />
  );

  if (path === '/home') {
    content = <HomeScreen actionRoot={actionRoot} />;
  }

  if (path === '/settings') {
    content = (
      <SettingsScreen
        actionRoot={actionRoot}
        session={session}
        onSessionPatch={handleSessionPatch}
      />
    );
  }

  if (path.startsWith('/wishlist/')) {
    content = (
      <WishlistScreen
        actionRoot={actionRoot}
        title={screenMeta.title}
        kind={screenMeta.kind}
      />
    );
  }

  if (path === '/admin/attribution') {
    content = <AttributionScreen actionRoot={actionRoot} />;
  }

  return (
    <AppShell
      currentPath={path}
      screenMeta={screenMeta}
      session={session}
      onLogout={handleLogout}
    >
      {content}
    </AppShell>
  );
}

export default App;
