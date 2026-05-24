import React from 'react';
import {
  Avatar,
  Box,
  Button,
  Chip,
  List,
  ListItem,
  ListItemText,
  Stack,
  TextField,
  Typography
} from '@mui/material';

import Panel from './Panel';

function resolveItemImage(item) {
  if (!item) {
    return '';
  }

  return item.img_url || `http://eu.media.blizzard.com/wow/icons/56/${item.icon}.jpg`;
}

function ItemStats({item}) {
  if (!item) {
    return <Typography color="text.secondary">Aucun objet sélectionné.</Typography>;
  }

  return (
    <Stack spacing={2}>
      <Stack alignItems="center" direction="row" spacing={2}>
        <Avatar
          alt={item.name}
          src={resolveItemImage(item)}
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
          <Chip label={`ilvl ${item.itemLevel || item.level}`} size="small" sx={{mt : 0.75}} variant="outlined" />
        </Box>
      </Stack>
      <List disablePadding>
        {(item.stats || []).map((stat, index) => (
          <ListItem
            disableGutters
            key={`${stat.name}-${index}`}
            sx={{
              py : 0.75,
              borderBottom : '1px solid rgba(255,255,255,0.06)'
            }}
          >
            <ListItemText primary={stat.name} secondary={stat.amount} />
          </ListItem>
        ))}
      </List>
    </Stack>
  );
}

function WishlistPicker({
  canBind,
  currentItem,
  filter,
  items,
  loading,
  onBind,
  onFilterChange,
  onSelectItem,
  selectedItem,
  slot
}) {
  return (
    <Box
      sx={{
        display : 'grid',
        gridTemplateColumns : {
          xs : '1fr',
          xl : 'repeat(3, minmax(0, 1fr))'
        },
        gap : 3
      }}
    >
      <Panel subtitle={slot ? `Slot en cours: ${slot}` : 'Choisis un slot pour ouvrir le catalogue.'} title="Équipement actuel">
        <ItemStats item={currentItem} />
      </Panel>

      <Panel subtitle="Prévisualisation avant envoi au backend." title="Objet sélectionné">
        <ItemStats item={selectedItem} />
        <Button disabled={!canBind} fullWidth onClick={onBind} sx={{mt : 2}} variant="contained">
          Enregistrer cette sélection
        </Button>
      </Panel>

      <Panel subtitle="Catalogue filtré côté client après récupération de la liste backend." title="Objets disponibles">
        <TextField
          onChange={(event) => onFilterChange(event.target.value)}
          placeholder="Rechercher une pièce"
          type="search"
          value={filter}
        />

        {loading ? <Typography color="text.secondary" sx={{mt : 2}}>Chargement du catalogue…</Typography> : null}

        <Stack sx={{maxHeight : 520, mt : 2, overflow : 'auto'}} spacing={1.5}>
          {items.map((item) => (
            <Button
              key={item.id}
              onClick={() => onSelectItem(item.id)}
              sx={{
                justifyContent : 'flex-start',
                p : 1.25,
                gap : 2,
                minWidth : 0,
                borderRadius : 3,
                borderColor : 'rgba(255,255,255,0.08)',
                bgcolor : 'rgba(255,255,255,0.03)',
                backgroundImage : 'linear-gradient(145deg, rgba(228,191,115,0.08), rgba(255,255,255,0.02) 40%, rgba(120,168,216,0.08))',
                transition : 'transform 180ms ease, border-color 180ms ease, box-shadow 180ms ease',
                '&:hover' : {
                  transform : 'translateY(-2px)',
                  borderColor : 'rgba(228,191,115,0.22)',
                  boxShadow : '0 18px 36px rgba(0,0,0,0.24)'
                }
              }}
              variant="outlined"
            >
              <Avatar
                alt={item.name}
                src={resolveItemImage(item)}
                sx={{
                  width : 56,
                  height : 56,
                  borderRadius : 2.5,
                  border : '1px solid rgba(228,191,115,0.18)'
                }}
                variant="rounded"
              />
              <Box sx={{minWidth : 0, textAlign : 'left'}}>
                <Typography fontWeight={700} sx={{overflowWrap : 'anywhere'}}>{item.name}</Typography>
                <Typography color="text.secondary" variant="body2">ilvl {item.itemLevel}</Typography>
              </Box>
            </Button>
          ))}
        </Stack>
      </Panel>
    </Box>
  );
}

export default WishlistPicker;
