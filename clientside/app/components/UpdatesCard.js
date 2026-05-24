import React from 'react';
import {Box, Divider, Stack, Typography} from '@mui/material';

import Panel from './Panel';

function UpdatesCard({updates}) {
  return (
    <Panel subtitle="Historique venant du stockage JSON du backend Node." title="Notes de mise à jour">
      <Stack divider={<Divider flexItem sx={{borderColor : 'rgba(255,255,255,0.08)'}} />} spacing={2}>
        {(updates || []).map((update) => (
          <Box
            key={update.id}
            sx={{
              p : 2,
              borderRadius : 3,
              backgroundImage : 'linear-gradient(145deg, rgba(228,191,115,0.08), rgba(255,255,255,0.02) 42%, rgba(120,168,216,0.08))'
            }}
          >
            <Stack direction={{xs : 'column', sm : 'row'}} justifyContent="space-between" spacing={1}>
              <Typography fontWeight={700}>{update.author}</Typography>
              <Typography color="text.secondary" variant="body2">{update.date}</Typography>
            </Stack>
            <Typography sx={{mt : 1.25}} variant="body2">{update.note}</Typography>
          </Box>
        ))}
      </Stack>
    </Panel>
  );
}

export default UpdatesCard;
