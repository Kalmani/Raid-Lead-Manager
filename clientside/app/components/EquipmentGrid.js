import React from 'react';
import {Avatar, Box, Chip, Typography} from '@mui/material';

import Panel from './Panel';

function EquipmentCard({item}) {
  if (item.no_item) {
    return (
      <Box
        sx={{
          p : 2,
          display : 'flex',
          alignItems : 'center',
          gap : 2,
          borderRadius : 3,
          border : '1px solid rgba(255,255,255,0.08)',
          bgcolor : 'rgba(255,255,255,0.03)',
          backgroundImage : 'linear-gradient(145deg, rgba(228,191,115,0.08), rgba(255,255,255,0.02) 42%, rgba(120,168,216,0.06))'
        }}
      >
        <Avatar sx={{bgcolor : 'rgba(240,199,94,0.15)', color : 'primary.main'}}>?</Avatar>
        <Typography fontWeight={700}>Slot vide</Typography>
      </Box>
    );
  }

  return (
    <Box
      sx={{
        p : 2,
        display : 'flex',
        alignItems : 'center',
        gap : 2,
        borderRadius : 3,
        border : '1px solid rgba(255,255,255,0.08)',
        bgcolor : 'rgba(255,255,255,0.03)',
        backgroundImage : 'linear-gradient(145deg, rgba(228,191,115,0.08), rgba(255,255,255,0.02) 40%, rgba(120,168,216,0.08))',
        transition : 'transform 180ms ease, border-color 180ms ease, box-shadow 180ms ease',
        '&:hover' : {
          transform : 'translateY(-2px)',
          borderColor : 'rgba(228,191,115,0.2)',
          boxShadow : '0 18px 36px rgba(0,0,0,0.24)'
        }
      }}
    >
      <Avatar
        alt={item.name}
        src={item.img_url}
        sx={{
          width : 56,
          height : 56,
          borderRadius : 2.5,
          border : '1px solid rgba(228,191,115,0.18)',
          boxShadow : '0 10px 24px rgba(0,0,0,0.24)'
        }}
        variant="rounded"
      />
      <Box sx={{minWidth : 0}}>
        <Typography fontWeight={700} sx={{overflowWrap : 'anywhere'}}>{item.name}</Typography>
        <Chip label={`ilvl ${item.level}`} size="small" sx={{mt : 0.85}} variant="outlined" />
      </Box>
    </Box>
  );
}

function EquipmentGrid({equipment, title}) {
  const list = [...(equipment.left || []), ...(equipment.right || [])];

  return (
    <Panel subtitle="Équipement remonté depuis l’Armory." title={title}>
      <Box
        sx={{
          display : 'grid',
          gridTemplateColumns : {
            xs : '1fr',
            sm : 'repeat(2, minmax(0, 1fr))'
          },
          gap : 1.5
        }}
      >
        {list.map((item) => (
          <EquipmentCard item={item} key={`${item.slot}-${item.name}`} />
        ))}
      </Box>
    </Panel>
  );
}

export default EquipmentGrid;
