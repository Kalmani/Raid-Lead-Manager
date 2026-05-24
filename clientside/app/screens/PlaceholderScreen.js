import React from 'react';
import {Box, Stack, Typography} from '@mui/material';

import Panel from '../components/Panel';

function PlaceholderScreen({description, title}) {
  return (
    <Box sx={{display : 'grid', gap : 3}}>
        <Panel subtitle="Le frontend React remplace ici les anciens écrans presque vides du legacy." title={title}>
          <Stack spacing={2}>
            <Typography>{description}</Typography>
            <Typography color="text.secondary">
              Le menu, le shell, le routing et l’intégration backend sont déjà migrés.
              Cette section attend maintenant le vrai métier côté API ou une reprise de logique plus poussée.
            </Typography>
          </Stack>
        </Panel>
    </Box>
  );
}

export default PlaceholderScreen;
