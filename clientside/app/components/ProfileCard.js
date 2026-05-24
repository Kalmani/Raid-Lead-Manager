import React from 'react';
import {
  Avatar,
  Box,
  Chip,
  List,
  ListItem,
  ListItemText,
  Stack,
  Typography
} from '@mui/material';

import Panel from './Panel';

function StatBox({label, value}) {
  return (
    <Box
      sx={{
        p : 2,
        minWidth : 0,
        borderRadius : 3,
        border : '1px solid rgba(255,255,255,0.08)',
        bgcolor : 'rgba(255,255,255,0.03)',
        backgroundImage : 'linear-gradient(145deg, rgba(228,191,115,0.1), rgba(255,255,255,0.02) 42%, rgba(120,168,216,0.08))'
      }}
    >
      <Typography
        color="text.secondary"
        sx={{
          display : 'block',
          lineHeight : 1.25,
          overflowWrap : 'anywhere'
        }}
        variant="caption"
      >
        {label}
      </Typography>
      <Typography
        color="primary.main"
        fontWeight={800}
        sx={{overflowWrap : 'anywhere'}}
        variant="h5"
      >
        {value}
      </Typography>
    </Box>
  );
}

function ProfileCard({profile}) {
  if (!profile || !profile.character) {
    return (
      <Panel subtitle="Le backend n’a pas renvoyé de profil exploitable." title="Profil">
        <p>Données indisponibles.</p>
      </Panel>
    );
  }

  const {character, guild_characters = []} = profile;

  return (
    <Panel subtitle={`${character.classe} ${character.activ_spe}`} title={character.pseudo}>
      <Stack spacing={3}>
        <Box
          sx={{
            position : 'relative',
            borderRadius : 4,
            overflow : 'hidden',
            border : '1px solid rgba(255,255,255,0.08)',
            backgroundImage : 'linear-gradient(180deg, rgba(228,191,115,0.16), transparent 34%)'
          }}
        >
          <Avatar
            alt={character.pseudo}
            src={character.profil_img}
            sx={{
              width : '100%',
              height : 240,
              borderRadius : 0
            }}
            variant="square"
          />
          <Stack
            direction="row"
            flexWrap="wrap"
            gap={1}
            sx={{
              position : 'absolute',
              left : 16,
              right : 16,
              bottom : 16
            }}
          >
            <Chip label={character.classe} variant="outlined" />
            <Chip color="primary" label={character.activ_spe} variant="outlined" />
          </Stack>
        </Box>

        <Box
          sx={{
            display : 'grid',
            gridTemplateColumns : {
              xs : '1fr',
              sm : 'repeat(2, minmax(0, 1fr))',
              lg : 'repeat(4, minmax(0, 1fr))'
            },
            gap : 1.5
          }}
        >
          <StatBox label="Niveau d’objet" value={character.ilvl} />
          <StatBox label="Niveau souhaité" value={character.wish_ilvl} />
          <StatBox label="Accomplissement" value={`${character.accomplished_purcent}%`} />
          <StatBox label="Loots / raid" value={character.loots_by_raid} />
        </Box>

        <Box
          sx={{
            display : 'grid',
            gridTemplateColumns : {
              xs : '1fr',
              md : '1fr 1fr'
            },
            gap : 3
          }}
        >
          <Box>
            <Typography sx={{mb : 1.5}} variant="h6">Métiers</Typography>
            <List disablePadding>
              {(character.professions || []).map((profession) => (
                <ListItem
                  disableGutters
                  key={`${profession.name}-${profession.level}`}
                  sx={{
                    py : 1,
                    borderBottom : '1px solid rgba(255,255,255,0.06)'
                  }}
                >
                  <ListItemText
                    primary={profession.name}
                    primaryTypographyProps={{fontWeight : 700}}
                    secondary={`${profession.level}/${profession.max}`}
                  />
                </ListItem>
              ))}
            </List>
          </Box>
        </Box>
      </Stack>
    </Panel>
  );
}

export default ProfileCard;
