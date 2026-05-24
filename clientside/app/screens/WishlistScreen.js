import React, {useEffect, useState} from 'react';
import {Box, Button, CircularProgress, Stack, Typography} from '@mui/material';

import Panel from '../components/Panel';
import ProfileCard from '../components/ProfileCard';
import StatusMessage from '../components/StatusMessage';
import UpdatesCard from '../components/UpdatesCard';
import WishlistPicker from '../components/WishlistPicker';
import {ensureServerData, extractNotice, postAction} from '../lib/api';

function sortItems(items, filter) {
  const query = filter.trim().toLowerCase();
  const filtered = query
    ? items.filter((item) => item.name.toLowerCase().includes(query))
    : items;

  return [...filtered].sort((left, right) => {
    if (right.itemLevel !== left.itemLevel) {
      return right.itemLevel - left.itemLevel;
    }

    return left.name.localeCompare(right.name);
  });
}

function WishlistScreen({actionRoot, kind, title}) {
  const [state, setState] = useState({
    loading : true,
    notice : null,
    profile : null,
    updates : [],
    equipment : [],
    picker : {
      slot : null,
      loading : false,
      currentItem : null,
      selectedItem : null,
      items : [],
      filter : ''
    }
  });

  const loadScreen = async () => {
    setState((current) => ({...current, loading : true, notice : null}));

      try {
        const [profile, wishlist, updates] = await Promise.all([
          postAction(actionRoot, 'character', 'show_profile'),
          postAction(actionRoot, 'character', 'show_equipment_wish', {wishlist_kind : kind}),
          postAction(actionRoot, 'base', 'show_last_notes')
        ]);

      ensureServerData(profile);
      ensureServerData(wishlist);
      ensureServerData(updates);

      setState((current) => ({
        ...current,
        loading : false,
        profile,
        updates : updates.updates || [],
        equipment : wishlist.equipment || []
      }));
    } catch (error) {
      setState((current) => ({
        ...current,
        loading : false,
        notice : {tone : 'error', message : error.message}
      }));
    }
  };

  useEffect(() => {
    loadScreen();
  }, [actionRoot, kind]);

  const refreshSlot = async (slot) => {
    setState((current) => ({...current, notice : null}));

    try {
      const response = ensureServerData(await postAction(actionRoot, 'character', 'update_item', {slot, nocache : true}));

      setState((current) => ({
        ...current,
        equipment : current.equipment.map((item) => {
          if (item.slot !== slot) {
            return item;
          }

          return {
            ...item,
            img_url : response.img_url || `http://eu.media.blizzard.com/wow/icons/56/${response.img}.jpg`,
            name : response.name,
            level : response.level,
            scarcity : response.scarcity
          };
        }),
        notice : {tone : 'success', message : `Slot ${slot} rafraîchi.`}
      }));
    } catch (error) {
      setState((current) => ({
        ...current,
        notice : {tone : 'error', message : error.message}
      }));
    }
  };

  const openPicker = async (slot) => {
    setState((current) => ({
      ...current,
      picker : {...current.picker, slot, loading : true, filter : ''}
    }));

    try {
      const response = ensureServerData(await postAction(actionRoot, 'items', 'list_items', {slot}));
      setState((current) => ({
        ...current,
        picker : {
          ...current.picker,
          slot,
          loading : false,
          currentItem : response.current_item,
          selectedItem : null,
          items : response.items_list || [],
          filter : ''
        }
      }));
    } catch (error) {
      setState((current) => ({
        ...current,
        picker : {...current.picker, loading : false},
        notice : {tone : 'error', message : error.message}
      }));
    }
  };

  const selectItem = async (id) => {
    setState((current) => ({
      ...current,
      picker : {...current.picker, loading : true}
    }));

    try {
      const response = ensureServerData(await postAction(actionRoot, 'items', 'show_item', {id}));
      setState((current) => ({
        ...current,
        picker : {
          ...current.picker,
          loading : false,
          selectedItem : response.new_item
        }
      }));
    } catch (error) {
      setState((current) => ({
        ...current,
        picker : {...current.picker, loading : false},
        notice : {tone : 'error', message : error.message}
      }));
    }
  };

  const bindSelection = async () => {
    const selectedId = state.picker.selectedItem && state.picker.selectedItem.id;
    if (!selectedId) {
      return;
    }

    try {
      const response = await postAction(actionRoot, 'character', 'bind_bis', {
        new_id : selectedId,
        wishlist_kind : kind,
        slot : state.picker.slot
      });
      const nextNotice = extractNotice(response, 'Sélection envoyée au backend legacy.');
      setState((current) => ({...current, notice : nextNotice}));
    } catch (error) {
      setState((current) => ({
        ...current,
        notice : {tone : 'error', message : error.message}
      }));
    }
  };

  const visibleItems = sortItems(state.picker.items, state.picker.filter);

  if (state.loading) {
    return (
      <Box sx={{minHeight : 320, display : 'grid', placeItems : 'center', gap : 2}}>
        <CircularProgress color="primary" />
        <Typography color="text.secondary">Chargement de {title.toLowerCase()}…</Typography>
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
        <Panel subtitle="Chaque ligne pilote maintenant la wishlist persistée par le backend Node." title={title}>
          <Stack spacing={1.5}>
            {state.equipment.map((item) => (
              <Box
                key={`${item.slot}-${item.name}`}
                sx={{
                  p : 2,
                  display : 'flex',
                  flexDirection : {
                    xs : 'column',
                    md : 'row'
                  },
                  alignItems : {
                    md : 'center'
                  },
                  justifyContent : 'space-between',
                  gap : 2,
                  borderRadius : 3,
                  border : '1px solid rgba(255,255,255,0.08)',
                  bgcolor : 'rgba(255,255,255,0.03)',
                  backgroundImage : 'linear-gradient(145deg, rgba(228,191,115,0.08), rgba(255,255,255,0.02) 40%, rgba(120,168,216,0.08))'
                }}
              >
                <Box sx={{display : 'flex', alignItems : 'center', gap : 2, minWidth : 0}}>
                  <Box
                    component="img"
                    alt={item.name}
                    src={item.img_url}
                    sx={{
                      width : 56,
                      height : 56,
                      borderRadius : 2.5,
                      objectFit : 'cover',
                      border : '1px solid rgba(228,191,115,0.18)',
                      boxShadow : '0 10px 24px rgba(0,0,0,0.24)'
                    }}
                  />
                  <Box sx={{minWidth : 0}}>
                    <Typography fontWeight={700} sx={{overflowWrap : 'anywhere'}}>{item.name}</Typography>
                    <Typography color="text.secondary" variant="body2">{item.slot} · ilvl {item.level}</Typography>
                  </Box>
                </Box>

                <Stack direction="row" spacing={1.25}>
                  <Button onClick={() => openPicker(item.slot)} variant="outlined">
                    Choisir
                  </Button>
                  <Button onClick={() => refreshSlot(item.slot)} variant="outlined">
                    Rafraîchir
                  </Button>
                </Stack>
              </Box>
            ))}
          </Stack>
        </Panel>

        <WishlistPicker
          canBind={Boolean(state.picker.selectedItem)}
          currentItem={state.picker.currentItem}
          filter={state.picker.filter}
          items={visibleItems}
          loading={state.picker.loading}
          onBind={bindSelection}
          onFilterChange={(filter) => setState((current) => ({
            ...current,
            picker : {...current.picker, filter}
          }))}
          onSelectItem={selectItem}
          selectedItem={state.picker.selectedItem}
          slot={state.picker.slot}
        />
      </Box>
    </Box>
  );
}

export default WishlistScreen;
