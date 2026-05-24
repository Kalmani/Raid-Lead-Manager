import React, {useState} from 'react';
import {Box, Button, Stack, TextField} from '@mui/material';

import Panel from '../components/Panel';
import StatusMessage from '../components/StatusMessage';
import {extractNotice, postAction} from '../lib/api';

function SettingsScreen({actionRoot, onSessionPatch, session}) {
  const [loginForm, setLoginForm] = useState({
    identifiant : session.user_log || '',
    old_password : '',
    new_password : '',
    new_password_conf : ''
  });
  const [email, setEmail] = useState(session.user_mail || '');
  const [notice, setNotice] = useState(null);
  const [loading, setLoading] = useState(null);

  const updateLoginField = (field, value) => {
    setLoginForm((current) => ({...current, [field] : value}));
  };

  const submitLogin = async (event) => {
    event.preventDefault();
    setLoading('login');
    setNotice(null);

    try {
      const response = await postAction(actionRoot, 'account', 'change_login', loginForm);
      const nextNotice = extractNotice(response);
      setNotice(nextNotice);

      if (response.datas) {
        onSessionPatch(response.datas);
      }
    } catch (error) {
      setNotice({tone : 'error', message : error.message});
    } finally {
      setLoading(null);
    }
  };

  const submitEmail = async (event) => {
    event.preventDefault();
    setLoading('email');
    setNotice(null);

    try {
      const response = await postAction(actionRoot, 'account', 'change_email', {email});
      const nextNotice = extractNotice(response);
      setNotice(nextNotice);

      if (response.datas) {
        onSessionPatch(response.datas);
      }
    } catch (error) {
      setNotice({tone : 'error', message : error.message});
    } finally {
      setLoading(null);
    }
  };

  return (
    <Box
      sx={{
        display : 'grid',
        gridTemplateColumns : {
          xs : '1fr',
          xl : 'minmax(0, 1fr) 360px'
        },
        gap : 3
      }}
    >
      <Box sx={{display : 'grid', gap : 3}}>
        <StatusMessage notice={notice} />

        <Panel subtitle="Le backend Node conserve le cookie RLM_user pour rester compatible avec le shell React." title="Identifiants">
          <Box component="form" onSubmit={submitLogin}>
            <Stack spacing={2}>
              <TextField
                label="Identifiant"
                onChange={(event) => updateLoginField('identifiant', event.target.value)}
                type="text"
                value={loginForm.identifiant}
              />

              <TextField
                label="Mot de passe actuel"
                onChange={(event) => updateLoginField('old_password', event.target.value)}
                type="password"
                value={loginForm.old_password}
              />

              <TextField
                label="Nouveau mot de passe"
                onChange={(event) => updateLoginField('new_password', event.target.value)}
                type="password"
                value={loginForm.new_password}
              />

              <TextField
                label="Confirmation"
                onChange={(event) => updateLoginField('new_password_conf', event.target.value)}
                type="password"
                value={loginForm.new_password_conf}
              />

              <Button disabled={loading === 'login'} fullWidth size="large" type="submit" variant="contained">
                {loading === 'login' ? 'Mise à jour…' : 'Mettre à jour'}
              </Button>
            </Stack>
          </Box>
        </Panel>
      </Box>

      <Box sx={{display : 'grid', gap : 3, alignContent : 'start'}}>
        <Panel subtitle="Cette route persiste maintenant l’email dans la base JSON locale." title="Adresse email">
          <Box component="form" onSubmit={submitEmail}>
            <Stack spacing={2}>
              <TextField
                label="Email"
                onChange={(event) => setEmail(event.target.value)}
                type="email"
                value={email}
              />

              <Button disabled={loading === 'email'} fullWidth type="submit" variant="contained">
                {loading === 'email' ? 'Enregistrement…' : 'Mettre à jour'}
              </Button>
            </Stack>
          </Box>
        </Panel>

        <Panel subtitle="Ces actions existaient dans l’UI legacy, mais n’étaient pas réellement câblées." title="Maintenance">
          <Stack spacing={1.5}>
            <Button disabled fullWidth variant="outlined">Recharger personnage et wish list</Button>
            <Button disabled fullWidth variant="outlined">Recharger personnage</Button>
            <Button disabled fullWidth variant="outlined">Supprimer la wish list</Button>
          </Stack>
        </Panel>
      </Box>
    </Box>
  );
}

export default SettingsScreen;
