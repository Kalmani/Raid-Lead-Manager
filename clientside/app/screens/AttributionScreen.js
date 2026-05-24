import React, {useEffect, useState} from 'react';
import {
  Box,
  Button,
  Chip,
  CircularProgress,
  Divider,
  MenuItem,
  Stack,
  TextField,
  Typography
} from '@mui/material';

import Panel from '../components/Panel';
import StatusMessage from '../components/StatusMessage';
import {ensureServerData, extractNotice, postAction} from '../lib/api';

function resolveItemImage(item) {
  if (!item) {
    return '';
  }

  return item.img_url || `http://eu.media.blizzard.com/wow/icons/56/${item.icon}.jpg`;
}

function getWishMeta(kind) {
  return {
    bis : {label : 'BIS', color : 'success'},
    prov : {label : 'Provisoire', color : 'warning'},
    spe2 : {label : 'Spe 2', color : 'secondary'},
    hors : {label : 'Hors wishlist', color : 'default'}
  }[kind] || {label : kind || 'Inconnu', color : 'default'};
}

function SummaryStat({label, value}) {
  return (
    <Box
      sx={{
        p : 2,
        borderRadius : 2,
        border : '1px solid rgba(255,255,255,0.08)',
        backgroundImage : 'linear-gradient(145deg, rgba(228,191,115,0.08), rgba(255,255,255,0.02) 40%, rgba(120,168,216,0.08))'
      }}
    >
      <Typography color="text.secondary" variant="caption">{label}</Typography>
      <Typography fontWeight={800} sx={{mt : 0.5}} variant="h4">{value}</Typography>
    </Box>
  );
}

function CandidateCard({assigning, candidate, onAward, onSlotChange, slotValue}) {
  const wishMeta = getWishMeta(candidate.wishKind);
  const replacementOptions = candidate.replacementOptions || [];

  return (
    <Box
      sx={{
        p : 2,
        borderRadius : 2,
        border : '1px solid rgba(255,255,255,0.08)',
        backgroundColor : 'rgba(255,255,255,0.03)'
      }}
    >
      <Stack spacing={1.5}>
        <Stack
          direction={{xs : 'column', md : 'row'}}
          justifyContent="space-between"
          spacing={1.5}
        >
          <Box sx={{minWidth : 0}}>
            <Stack direction="row" flexWrap="wrap" gap={1} sx={{mb : 1}}>
              <Chip color={wishMeta.color} label={wishMeta.label} size="small" variant="outlined" />
              <Chip label={`${candidate.role} ${candidate.spec}`} size="small" variant="outlined" />
            </Stack>
            <Typography fontWeight={700} sx={{overflowWrap : 'anywhere'}} variant="h6">
              {candidate.displayName}
            </Typography>
            <Typography color="text.secondary" variant="body2">
              {candidate.className}
            </Typography>
          </Box>

          <SummaryStat label="Score" value={candidate.score} />
        </Stack>

        <Typography color="text.secondary" variant="body2">
          {candidate.reason}
        </Typography>

        {replacementOptions.length > 0 ? (
          <Stack spacing={1.25}>
            <TextField
              label="Piece remplacee"
              onChange={(event) => onSlotChange(event.target.value)}
              select
              value={slotValue || replacementOptions[0].slot}
            >
              {replacementOptions.map((option) => (
                <MenuItem key={option.slot} value={option.slot}>
                  {`${option.slot} - ${option.currentItem ? option.currentItem.name : 'Objet inconnu'} (+${option.deltaItemLevel} ilvl)`}
                </MenuItem>
              ))}
            </TextField>

            {replacementOptions.map((option) => {
              if (option.slot !== (slotValue || replacementOptions[0].slot)) {
                return null;
              }

              return (
                <Stack alignItems="center" direction="row" key={option.slot} spacing={1.5}>
                  {option.currentItem ? (
                    <Box
                      alt={option.currentItem.name}
                      component="img"
                      src={resolveItemImage(option.currentItem)}
                      sx={{
                        width : 42,
                        height : 42,
                        borderRadius : 1.5,
                        border : '1px solid rgba(228,191,115,0.18)'
                      }}
                    />
                  ) : null}
                  <Box sx={{minWidth : 0}}>
                    <Typography fontWeight={700} sx={{overflowWrap : 'anywhere'}} variant="body2">
                      {option.currentItem ? option.currentItem.name : option.slot}
                    </Typography>
                    <Typography color="text.secondary" variant="caption">
                      {`Slot ${option.slot} · +${option.deltaItemLevel} ilvl`}
                    </Typography>
                  </Box>
                </Stack>
              );
            })}
          </Stack>
        ) : null}

        <Button disabled={assigning} onClick={onAward} variant="contained">
          {assigning ? 'Attribution…' : `Attribuer a ${candidate.displayName}`}
        </Button>
      </Stack>
    </Box>
  );
}

function DropCard({assigningKey, drop, onAward, onSlotChange, selections}) {
  return (
    <Panel
      subtitle={`${drop.boss} · ${drop.date}`}
      title={drop.item ? drop.item.name : 'Objet introuvable'}
      actions={<Chip color="primary" label={`${drop.candidates.length} candidats`} variant="outlined" />}
    >
      <Stack spacing={2.5}>
        <Stack direction={{xs : 'column', md : 'row'}} spacing={2}>
          {drop.item ? (
            <Box
              alt={drop.item.name}
              component="img"
              src={resolveItemImage(drop.item)}
              sx={{
                width : 74,
                height : 74,
                borderRadius : 1.75,
                border : '1px solid rgba(228,191,115,0.18)',
                boxShadow : '0 10px 24px rgba(0,0,0,0.24)'
              }}
            />
          ) : null}
          <Box sx={{minWidth : 0}}>
            <Stack direction="row" flexWrap="wrap" gap={1} sx={{mb : 1}}>
              <Chip label={drop.item ? `ilvl ${drop.item.itemLevel}` : 'Objet'} size="small" variant="outlined" />
              <Chip label={drop.item ? drop.item.slot : 'slot'} size="small" variant="outlined" />
            </Stack>
            <Typography color="text.secondary" variant="body2">
              {drop.note}
            </Typography>
          </Box>
        </Stack>

        <Divider sx={{borderColor : 'rgba(228,191,115,0.12)'}} />

        <Stack spacing={1.5}>
          {drop.candidates.map((candidate) => {
            const selectionKey = `${drop.id}:${candidate.id}`;

            return (
              <CandidateCard
                assigning={assigningKey === selectionKey}
                candidate={candidate}
                key={candidate.id}
                onAward={() => onAward(drop, candidate)}
                onSlotChange={(slot) => onSlotChange(selectionKey, slot)}
                slotValue={selections[selectionKey]}
              />
            );
          })}
        </Stack>
      </Stack>
    </Panel>
  );
}

function AttributionScreen({actionRoot}) {
  const [state, setState] = useState({
    loading : true,
    board : null,
    notice : null,
    assigningKey : null,
    selections : {}
  });

  useEffect(() => {
    let active = true;

    async function loadBoard() {
      try {
        const response = ensureServerData(await postAction(actionRoot, 'admin', 'show_attribution'));

        if (!active) {
          return;
        }

        setState((current) => ({
          ...current,
          loading : false,
          board : response,
          notice : null
        }));
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

    loadBoard();

    return () => {
      active = false;
    };
  }, [actionRoot]);

  const handleSlotChange = (selectionKey, slot) => {
    setState((current) => ({
      ...current,
      selections : {
        ...current.selections,
        [selectionKey] : slot
      }
    }));
  };

  const handleAward = async (drop, candidate) => {
    const selectionKey = `${drop.id}:${candidate.id}`;
    const selectedSlot = state.selections[selectionKey]
      || candidate.replacementOptions && candidate.replacementOptions[0] && candidate.replacementOptions[0].slot
      || '';

    setState((current) => ({
      ...current,
      assigningKey : selectionKey
    }));

    try {
      const response = await postAction(actionRoot, 'admin', 'award_attribution', {
        drop_id : drop.id,
        candidate_id : candidate.id,
        replacement_slot : selectedSlot
      });

      setState((current) => ({
        ...current,
        assigningKey : null,
        notice : extractNotice(response, 'Attribution enregistree.'),
        board : response.board || current.board
      }));
    } catch (error) {
      setState((current) => ({
        ...current,
        assigningKey : null,
        notice : {tone : 'error', message : error.message}
      }));
    }
  };

  if (state.loading) {
    return (
      <Box sx={{minHeight : 320, display : 'grid', placeItems : 'center', gap : 2}}>
        <CircularProgress color="primary" />
        <Typography color="text.secondary">Chargement du tableau d'attribution…</Typography>
      </Box>
    );
  }

  const board = state.board || {summary : {}, pendingDrops : [], history : [], raid : {}};

  return (
    <Box sx={{display : 'grid', gap : 3}}>
      <StatusMessage notice={state.notice} />

      <Panel
        subtitle={`${board.raid.instance || ''} · ${board.raid.difficulty || ''}`}
        title={board.raid.title || 'Attribution'}
      >
        <Stack spacing={2.5}>
          <Stack direction="row" flexWrap="wrap" gap={1}>
            <Chip color="primary" label={board.raid.weekLabel || 'Semaine en cours'} variant="outlined" />
            <Chip label="Workflow d'attribution retrouve du legacy" variant="outlined" />
          </Stack>

          <Box
            sx={{
              display : 'grid',
              gridTemplateColumns : {
                xs : '1fr',
                sm : 'repeat(3, minmax(0, 1fr))'
              },
              gap : 1.5
            }}
          >
            <SummaryStat label="Drops en attente" value={board.summary.pendingCount || 0} />
            <SummaryStat label="Attribues cette semaine" value={board.summary.awardedThisWeek || 0} />
            <SummaryStat label="Hors wishlist" value={board.summary.outsideWishlist || 0} />
          </Box>
        </Stack>
      </Panel>

      <Box
        sx={{
          display : 'grid',
          gridTemplateColumns : {
            xs : '1fr',
            xl : 'minmax(0, 1.55fr) minmax(320px, 0.85fr)'
          },
          gap : 3,
          alignItems : 'start'
        }}
      >
        <Stack spacing={3}>
          {board.pendingDrops.length === 0 ? (
            <Panel subtitle="Plus aucun objet a traiter." title="Attributions">
              <Typography color="text.secondary">
                Tout est distribue pour cette semaine.
              </Typography>
            </Panel>
          ) : (
            board.pendingDrops.map((drop) => (
              <DropCard
                assigningKey={state.assigningKey}
                drop={drop}
                key={drop.id}
                onAward={handleAward}
                onSlotChange={handleSlotChange}
                selections={state.selections}
              />
            ))
          )}
        </Stack>

        <Panel subtitle="Dernieres decisions enregistrees dans le backend Node." title="Historique recent">
          <Stack divider={<Divider flexItem sx={{borderColor : 'rgba(228,191,115,0.12)'}} />} spacing={2}>
            {board.history.map((entry) => {
              const wishMeta = getWishMeta(entry.wishKind);

              return (
                <Box key={entry.id}>
                  <Stack direction={{xs : 'column', sm : 'row'}} justifyContent="space-between" spacing={1.5}>
                    <Box sx={{minWidth : 0}}>
                      <Typography fontWeight={700} sx={{overflowWrap : 'anywhere'}}>
                        {entry.item ? entry.item.name : 'Objet introuvable'}
                      </Typography>
                      <Typography color="text.secondary" variant="body2">
                        {`${entry.playerName} · ${entry.className} ${entry.spec}`}
                      </Typography>
                    </Box>
                    <Chip color={wishMeta.color} label={wishMeta.label} size="small" variant="outlined" />
                  </Stack>

                  <Stack alignItems="center" direction="row" spacing={1.5} sx={{mt : 1.25}}>
                    {entry.item ? (
                      <Box
                        alt={entry.item.name}
                        component="img"
                        src={resolveItemImage(entry.item)}
                        sx={{
                          width : 40,
                          height : 40,
                          borderRadius : 1.5,
                          border : '1px solid rgba(228,191,115,0.16)'
                        }}
                      />
                    ) : null}
                    <Box sx={{minWidth : 0}}>
                      <Typography color="text.secondary" variant="body2">
                        {`${entry.boss} · ${entry.date} · score ${entry.score}`}
                      </Typography>
                      <Typography color="text.secondary" variant="caption">
                        {entry.replacementSlot ? `Remplace ${entry.replacementSlot}` : 'Pas de slot precise'}
                      </Typography>
                    </Box>
                  </Stack>

                  {entry.note ? (
                    <Typography color="text.secondary" sx={{mt : 1.25}} variant="body2">
                      {entry.note}
                    </Typography>
                  ) : null}
                </Box>
              );
            })}
          </Stack>
        </Panel>
      </Box>
    </Box>
  );
}

export default AttributionScreen;
