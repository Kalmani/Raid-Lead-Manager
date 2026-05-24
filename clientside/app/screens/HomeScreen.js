import React, {useEffect, useState} from 'react';
import {Box, CircularProgress, Typography} from '@mui/material';

import EquipmentGrid from '../components/EquipmentGrid';
import ProfileCard from '../components/ProfileCard';
import StatusMessage from '../components/StatusMessage';
import UpdatesCard from '../components/UpdatesCard';
import {ensureServerData, postAction} from '../lib/api';

function HomeScreen({actionRoot}) {
  const [state, setState] = useState({
    loading : true,
    profile : null,
    equipment : {left : [], right : []},
    updates : [],
    notice : null
  });

  useEffect(() => {
    let active = true;

    async function load() {
      try {
        const [profile, equipment, updates] = await Promise.all([
          postAction(actionRoot, 'character', 'show_profile'),
          postAction(actionRoot, 'character', 'show_equipment'),
          postAction(actionRoot, 'base', 'show_last_notes')
        ]);

        ensureServerData(profile);
        ensureServerData(equipment);
        ensureServerData(updates);

        if (!active) {
          return;
        }

        setState({
          loading : false,
          profile,
          equipment,
          updates : updates.updates || [],
          notice : null
        });
      } catch (error) {
        if (!active) {
          return;
        }

        setState((current) => ({
          ...current,
          loading : false,
          notice : {tone : 'error', message : error.message}
        }));
      }
    }

    load();

    return () => {
      active = false;
    };
  }, [actionRoot]);

  if (state.loading) {
    return (
      <Box sx={{minHeight : 320, display : 'grid', placeItems : 'center', gap : 2}}>
        <CircularProgress color="primary" />
        <Typography color="text.secondary">Chargement de l’accueil…</Typography>
      </Box>
    );
  }

  return (
    <Box
      sx={{
        display : 'grid',
        gridTemplateColumns : {
          xs : '1fr',
          xl : '360px minmax(0, 1fr)'
        },
        gap : 3
      }}
    >
      <Box sx={{display : 'grid', gap : 3, alignContent : 'start'}}>
        <StatusMessage notice={state.notice} />
        <ProfileCard profile={state.profile} />
        <UpdatesCard updates={state.updates} />
      </Box>

      <Box sx={{display : 'grid', gap : 3}}>
        <EquipmentGrid equipment={state.equipment} title="Équipement actuel" />
      </Box>
    </Box>
  );
}

export default HomeScreen;
