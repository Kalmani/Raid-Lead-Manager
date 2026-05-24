import React, {useState} from 'react';
import {Box, Button, Chip, Paper, Stack, TextField, Typography} from '@mui/material';

import StatusMessage from '../components/StatusMessage';
import {extractNotice, postAction} from '../lib/api';

function LoginScreen({actionRoot, onLogin}) {
  const [credentials, setCredentials] = useState({pseudo : '', pass : ''});
  const [loading, setLoading] = useState(false);
  const [notice, setNotice] = useState(null);

  const updateField = (field, value) => {
    setCredentials((current) => ({...current, [field] : value}));
  };

  const handleSubmit = async (event) => {
    event.preventDefault();
    setLoading(true);
    setNotice(null);

    try {
      const response = await postAction(actionRoot, 'account', 'login', credentials);
      const nextNotice = extractNotice(response);
      setNotice(nextNotice);

      if (response.user_datas) {
        onLogin(response.user_datas);
      }
    } catch (error) {
      setNotice({tone : 'error', message : error.message});
    } finally {
      setLoading(false);
    }
  };

  return (
    <Box
      sx={{
        minHeight : '100vh',
        display : 'grid',
        placeItems : 'center',
        p : 3
      }}
    >
      <Paper
        sx={{
          width : 'min(980px, 100%)',
          p : {
            xs : 3,
            md : 4
          },
          backgroundImage : 'linear-gradient(135deg, rgba(228,191,115,0.12), transparent 38%), linear-gradient(225deg, rgba(120,168,216,0.14), transparent 42%), linear-gradient(145deg, rgba(16,24,38,0.96), rgba(8,12,21,0.95))'
        }}
      >
        <Box
          sx={{
            display : 'grid',
            gridTemplateColumns : {
              xs : '1fr',
              md : '1.1fr 0.9fr'
            },
            gap : {
              xs : 3,
              md : 4
            },
            alignItems : 'stretch'
          }}
        >
          <Stack
            spacing={3}
            sx={{
              justifyContent : 'space-between',
              minHeight : {
                md : 440
              }
            }}
          >
            <Box>
              <Stack direction="row" flexWrap="wrap" gap={1} sx={{mb : 2}}>
                <Chip color="primary" label="Ancien backend, nouveau shell" />
                <Chip label="React + Express + Battle.net" variant="outlined" />
              </Stack>
              <Typography gutterBottom sx={{maxWidth : 560}} variant="h2">
                Raid Lead Manager
              </Typography>
              <Typography color="text.secondary" sx={{maxWidth : 560}} variant="h6">
                Une interface de raid qui assume enfin un peu de présence visuelle.
              </Typography>
            </Box>

            <Stack spacing={2.5}>
              <Paper
                sx={{
                  p : 2.5,
                  borderRadius : 4,
                  backgroundImage : 'linear-gradient(145deg, rgba(228,191,115,0.1), rgba(255,255,255,0.02) 36%, rgba(120,168,216,0.08))'
                }}
                variant="outlined"
              >
                <Typography fontWeight={700} sx={{mb : 1}} variant="overline">
                  Field Notes
                </Typography>
                <Typography color="text.secondary">
                  Wishlist, profil, équipement et administration sont servis depuis le nouveau backend Node,
                  sans garder le rendu poussiéreux de l’ancienne app.
                </Typography>
              </Paper>

              <Typography color="text.secondary" variant="body2">
                Connecte-toi pour retrouver le portail de guilde, la wishlist et les outils de pilotage de raid.
              </Typography>
            </Stack>
          </Stack>

          <Paper
            component="form"
            onSubmit={handleSubmit}
            sx={{
              p : {
                xs : 2.5,
                md : 3
              },
              borderRadius : 4,
              backgroundImage : 'linear-gradient(180deg, rgba(255,255,255,0.04), transparent 18%), linear-gradient(150deg, rgba(18,27,42,0.94), rgba(9,13,22,0.96))'
            }}
            variant="outlined"
          >
            <Stack spacing={2.25}>
              <Box>
                <Typography gutterBottom variant="h5">Connexion</Typography>
                <Typography color="text.secondary" variant="body2">
                  Entre avec ton compte de test ou ton profil guilde.
                </Typography>
              </Box>

              <TextField
                label="Identifiant"
                onChange={(event) => updateField('pseudo', event.target.value)}
                type="text"
                value={credentials.pseudo}
              />

              <TextField
                label="Mot de passe"
                onChange={(event) => updateField('pass', event.target.value)}
                type="password"
                value={credentials.pass}
              />

              <Button disabled={loading} fullWidth size="large" type="submit" variant="contained">
                {loading ? 'Connexion…' : 'Entrer dans le portail'}
              </Button>

              <StatusMessage notice={notice} />
            </Stack>
          </Paper>
        </Box>
      </Paper>
    </Box>
  );
}

export default LoginScreen;
