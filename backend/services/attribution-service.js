'use strict';

function clone(value) {
  return JSON.parse(JSON.stringify(value));
}

function resolveItemImage(item) {
  if (!item) {
    return '';
  }

  return item.img_url || `http://eu.media.blizzard.com/wow/icons/56/${item.icon}.jpg`;
}

function enrichItem(store, itemId) {
  const item = store.findItemById(itemId);

  if (!item) {
    return null;
  }

  return {
    ...item,
    img_url : resolveItemImage(item)
  };
}

function enrichReplacementOption(store, option) {
  const currentItem = enrichItem(store, option.currentItemId);

  return {
    ...option,
    currentItem
  };
}

function sortCandidates(candidates) {
  return [...candidates].sort((left, right) => {
    if (right.score !== left.score) {
      return right.score - left.score;
    }

    return left.displayName.localeCompare(right.displayName);
  });
}

class AttributionService {

  constructor(store) {
    this.store = store;
  }

  getBoard() {
    const raw = clone(this.store.getAttributions());
    const pendingDrops = (raw.drops || [])
      .filter((drop) => drop.status !== 'awarded')
      .map((drop) => ({
        ...drop,
        item : enrichItem(this.store, drop.itemId),
        candidates : sortCandidates((drop.candidates || []).map((candidate) => ({
          ...candidate,
          replacementOptions : (candidate.replacementOptions || []).map((option) => enrichReplacementOption(this.store, option))
        })))
      }));

    const history = (raw.history || [])
      .map((entry) => ({
        ...entry,
        item : enrichItem(this.store, entry.itemId),
        replacementItem : enrichItem(this.store, entry.replacementItemId)
      }))
      .sort((left, right) => {
        if (left.date === right.date) {
          return right.id.localeCompare(left.id);
        }

        return right.date.localeCompare(left.date);
      });

    const awardedThisWeek = history.filter((entry) => entry.date >= '2026-05-18').length;
    const outsideWishlist = history.filter((entry) => entry.wishKind === 'hors').length;

    return {
      raid : raw.raid,
      summary : {
        pendingCount : pendingDrops.length,
        awardedThisWeek,
        outsideWishlist
      },
      pendingDrops,
      history : history.slice(0, 8)
    };
  }

  awardDrop(params) {
    const {candidate_id : candidateId, drop_id : dropId, replacement_slot : replacementSlot} = params;
    const data = clone(this.store.getAttributions());
    const drop = (data.drops || []).find((candidateDrop) => candidateDrop.id === dropId);

    if (!drop) {
      throw new Error("Attribution introuvable");
    }

    if (drop.status === 'awarded') {
      throw new Error("Cet objet a deja ete attribue");
    }

    const candidate = (drop.candidates || []).find((candidateItem) => candidateItem.id === candidateId);

    if (!candidate) {
      throw new Error("Candidat introuvable");
    }

    const replacementOptions = candidate.replacementOptions || [];
    const selectedReplacement = replacementOptions.find((option) => option.slot === replacementSlot) || replacementOptions[0] || null;

    if (replacementOptions.length > 0 && !selectedReplacement) {
      throw new Error("Slot de remplacement invalide");
    }

    drop.status = 'awarded';
    drop.awardedTo = candidate.id;
    drop.awardedAt = new Date().toISOString();
    drop.replacementSlot = selectedReplacement ? selectedReplacement.slot : null;

    data.history = [
      {
        id : `hist_${Date.now()}`,
        dropId : drop.id,
        date : new Date().toISOString().slice(0, 10),
        boss : drop.boss,
        itemId : drop.itemId,
        playerId : candidate.id,
        playerName : candidate.displayName,
        className : candidate.className,
        spec : candidate.spec,
        wishKind : candidate.wishKind,
        replacementSlot : selectedReplacement ? selectedReplacement.slot : null,
        replacementItemId : selectedReplacement ? selectedReplacement.currentItemId : null,
        score : candidate.score,
        note : drop.note || candidate.reason || ''
      }
    ].concat(data.history || []);

    this.store.saveAttributions(data);

    return {
      success : {
        message : `${candidate.displayName} recoit ${enrichItem(this.store, drop.itemId).name}.`
      },
      board : this.getBoard()
    };
  }

}

module.exports = {
  AttributionService
};
