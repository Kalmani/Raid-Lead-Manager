'use strict';

const BlizzardClient = require('../lib/blizzard');
const {encodeProfileSlug, slugify} = require('../lib/slug');

const SLOT_ORDER = [
  'head',
  'neck',
  'shoulder',
  'back',
  'chest',
  'wrist',
  'hands',
  'waist',
  'legs',
  'feet',
  'finger1',
  'finger2',
  'trinket1',
  'trinket2',
  'offHand'
];

const STATUS_SEQUENCE = ['warning', 'error', 'done'];
const QUALITY_TO_SCARCITY = {
  POOR : 0,
  COMMON : 1,
  UNCOMMON : 2,
  RARE : 3,
  EPIC : 4,
  LEGENDARY : 5,
  ARTIFACT : 6,
  HEIRLOOM : 7
};

const SLOT_TO_INVENTORY_TYPES = {
  head : ['HEAD'],
  neck : ['NECK'],
  shoulder : ['SHOULDER'],
  back : ['CLOAK'],
  chest : ['CHEST', 'ROBE'],
  wrist : ['WRIST'],
  hands : ['HANDS'],
  waist : ['WAIST'],
  legs : ['LEGS'],
  feet : ['FEET'],
  finger1 : ['FINGER'],
  finger2 : ['FINGER'],
  trinket1 : ['TRINKET'],
  trinket2 : ['TRINKET'],
  offHand : ['HOLDABLE', 'SHIELD', 'WEAPONOFFHAND']
};

const BLIZZARD_SLOT_TO_LEGACY = {
  HEAD : 'head',
  NECK : 'neck',
  SHOULDER : 'shoulder',
  BACK : 'back',
  CHEST : 'chest',
  WRIST : 'wrist',
  HANDS : 'hands',
  WAIST : 'waist',
  LEGS : 'legs',
  FEET : 'feet',
  FINGER_1 : 'finger1',
  FINGER_2 : 'finger2',
  TRINKET_1 : 'trinket1',
  TRINKET_2 : 'trinket2',
  OFF_HAND : 'offHand'
};

function localizedName(value, locale) {
  if (!value) {
    return null;
  }

  if (typeof value === 'string') {
    return value;
  }

  return value[locale] || value.en_US || value.en_GB || Object.values(value)[0] || null;
}

function extractAssetValue(assets, preferredKeys) {
  if (!Array.isArray(assets)) {
    return null;
  }

  for (const key of preferredKeys) {
    const match = assets.find((asset) => asset.key === key);
    if (match && match.value) {
      return match.value;
    }
  }

  const fallback = assets.find((asset) => asset.value);
  return fallback ? fallback.value : null;
}

function iconNameFromUrl(url) {
  if (!url) {
    return null;
  }

  const match = /\/([^/]+)\.(?:jpg|jpeg|png|webp)$/i.exec(url);
  return match ? match[1] : null;
}

function parseStats(stats, locale) {
  if (!Array.isArray(stats)) {
    return [];
  }

  return stats
    .map((stat) => {
      const name = stat.type && localizedName(stat.type.name || stat.type, locale);
      const amount = stat.value !== undefined ? stat.value : stat.amount;

      if (!name || amount === undefined) {
        return null;
      }

      return {name, amount};
    })
    .filter(Boolean);
}

function parseQuality(quality) {
  if (!quality) {
    return 1;
  }

  if (typeof quality === 'number') {
    return quality;
  }

  return QUALITY_TO_SCARCITY[quality.type] || 1;
}

function splitEquipment(items) {
  return items.reduce((result, item, index) => {
    if (index > 7) {
      result.right.push(item);
      return result;
    }

    result.left.push(item);
    return result;
  }, {left : [], right : []});
}

class WowService {

  constructor(store, options = {}) {
    this.store = store;
    this.client = options.client || new BlizzardClient(options.blizzard);
  }

  getLocalCharacter(user) {
    return this.store.findCharacterById(user.character_id) || this.store.findCharacterByPseudo(user.user_perso);
  }

  resolveIdentity(user, fallbackCharacter) {
    return {
      region : user.region || process.env.BLIZZARD_REGION || 'eu',
      locale : user.locale || process.env.BLIZZARD_LOCALE || 'fr_FR',
      realmSlug : user.realm_slug || fallbackCharacter && fallbackCharacter.realmSlug || process.env.BLIZZARD_REALM_SLUG || '',
      characterName : user.character_name || user.user_perso || fallbackCharacter && fallbackCharacter.pseudo || process.env.BLIZZARD_CHARACTER_NAME || '',
      characterSlug : slugify(user.character_name || user.user_perso || fallbackCharacter && fallbackCharacter.pseudo || process.env.BLIZZARD_CHARACTER_NAME || '')
    };
  }

  useLiveData(user, fallbackCharacter) {
    const identity = this.resolveIdentity(user, fallbackCharacter);
    return this.client.isConfigured() && Boolean(identity.realmSlug && identity.characterSlug);
  }

  async getCharacterSummary(identity, options = {}) {
    return this.client.request(identity.region, `/profile/wow/character/${encodeProfileSlug(identity.realmSlug)}/${encodeProfileSlug(identity.characterName)}`, {
      namespace : this.client.getProfileNamespace(identity.region),
      locale : identity.locale,
      ttlMs : 5 * 60 * 1000,
      ignoreCache : options.ignoreCache
    });
  }

  async getCharacterMedia(identity, options = {}) {
    return this.client.request(identity.region, `/profile/wow/character/${encodeProfileSlug(identity.realmSlug)}/${encodeProfileSlug(identity.characterName)}/character-media`, {
      namespace : this.client.getProfileNamespace(identity.region),
      locale : identity.locale,
      ttlMs : 30 * 60 * 1000,
      ignoreCache : options.ignoreCache
    });
  }

  async getCharacterProfessions(identity, options = {}) {
    return this.client.request(identity.region, `/profile/wow/character/${encodeProfileSlug(identity.realmSlug)}/${encodeProfileSlug(identity.characterName)}/professions`, {
      namespace : this.client.getProfileNamespace(identity.region),
      locale : identity.locale,
      ttlMs : 30 * 60 * 1000,
      ignoreCache : options.ignoreCache
    });
  }

  async getCharacterSpecializations(identity, options = {}) {
    return this.client.request(identity.region, `/profile/wow/character/${encodeProfileSlug(identity.realmSlug)}/${encodeProfileSlug(identity.characterName)}/specializations`, {
      namespace : this.client.getProfileNamespace(identity.region),
      locale : identity.locale,
      ttlMs : 30 * 60 * 1000,
      ignoreCache : options.ignoreCache
    });
  }

  async getCharacterEquipment(identity, options = {}) {
    return this.client.request(identity.region, `/profile/wow/character/${encodeProfileSlug(identity.realmSlug)}/${encodeProfileSlug(identity.characterName)}/equipment`, {
      namespace : this.client.getProfileNamespace(identity.region),
      locale : identity.locale,
      ttlMs : 5 * 60 * 1000,
      ignoreCache : options.ignoreCache
    });
  }

  async getItem(identity, itemId, options = {}) {
    return this.client.request(identity.region, `/data/wow/item/${itemId}`, {
      namespace : this.client.getStaticNamespace(identity.region),
      locale : identity.locale,
      ttlMs : 24 * 60 * 60 * 1000,
      ignoreCache : options.ignoreCache
    });
  }

  async getItemMedia(identity, itemId, options = {}) {
    return this.client.request(identity.region, `/data/wow/media/item/${itemId}`, {
      namespace : this.client.getStaticNamespace(identity.region),
      locale : identity.locale,
      ttlMs : 24 * 60 * 60 * 1000,
      ignoreCache : options.ignoreCache
    });
  }

  async enrichItem(identity, item, options = {}) {
    const itemId = item.id || item.item && item.item.id;
    const mediaId = item.media && item.media.id ? item.media.id : itemId;
    let mediaUrl = options.mediaUrl || null;

    if (!mediaUrl && mediaId) {
      const media = await this.getItemMedia(identity, mediaId, options);
      mediaUrl = extractAssetValue(media.assets, ['icon', 'main', 'zoom']);
    }

    return {
      id : itemId,
      name : localizedName(item.name, identity.locale),
      icon : iconNameFromUrl(mediaUrl),
      img_url : mediaUrl,
      itemLevel : item.level && item.level.value !== undefined ? item.level.value : item.level,
      quality : parseQuality(item.quality),
      level : item.level && item.level.value !== undefined ? item.level.value : item.level,
      scarcity : parseQuality(item.quality),
      slot : item.slot,
      stats : parseStats(item.preview_item && item.preview_item.stats || item.stats, identity.locale),
      inventory_type : item.inventory_type && item.inventory_type.type,
      item_class_id : item.item_class && item.item_class.id,
      item_subclass_id : item.item_subclass && item.item_subclass.id
    };
  }

  formatLocalItem(item) {
    return {
      id : item.id,
      name : item.name,
      icon : item.icon,
      img_url : `http://eu.media.blizzard.com/wow/icons/56/${item.icon}.jpg`,
      itemLevel : item.itemLevel,
      quality : item.quality,
      level : item.itemLevel,
      scarcity : item.quality,
      slot : item.slot,
      stats : item.stats || []
    };
  }

  formatEquipmentItem(slot, item) {
    return {
      ...item,
      slot,
      item_url : `item=${item.id}`,
      item_caracs : {
        item : item.id,
        domain : 'fr',
        gems : '',
        ench : ''
      },
      has_item : true,
      status : 'warning'
    };
  }

  async getProfile(user) {
    const fallbackCharacter = this.getLocalCharacter(user);

    if (!this.useLiveData(user, fallbackCharacter)) {
      if (!fallbackCharacter) {
        throw new Error('Personnage introuvable');
      }

      return {
        character : {
          pseudo : fallbackCharacter.pseudo,
          classe : fallbackCharacter.className,
          classe_icon : fallbackCharacter.classIcon,
          activ_spe : fallbackCharacter.activeSpec,
          profil_img : fallbackCharacter.profileImage,
          ilvl : fallbackCharacter.ilvl,
          wish_ilvl : user.user_ilvl_wish,
          accomplished_purcent : fallbackCharacter.accomplishedPercent,
          loots_by_raid : fallbackCharacter.lootsByRaid,
          professions : fallbackCharacter.professions,
          last_loots : []
        },
        guild_characters : fallbackCharacter.guildCharacters
      };
    }

    const identity = this.resolveIdentity(user, fallbackCharacter);
    const [summary, media, professions, specializations] = await Promise.all([
      this.getCharacterSummary(identity),
      this.getCharacterMedia(identity),
      this.getCharacterProfessions(identity),
      this.getCharacterSpecializations(identity)
    ]);

    const profileImage = extractAssetValue(media.assets, ['main-raw', 'main', 'avatar', 'inset']) || fallbackCharacter && fallbackCharacter.profileImage;
    const activeSpec = summary.active_spec && summary.active_spec.name ||
      specializations.active_specialization && specializations.active_specialization.specialization && specializations.active_specialization.specialization.name ||
      fallbackCharacter && fallbackCharacter.activeSpec ||
      'Inconnue';

    const professionList = (professions.primaries || []).map((profession) => {
      const tiers = profession.tiers || [];
      const topTier = tiers.reduce((best, tier) => {
        if (!best || (tier.max_skill_points || 0) > (best.max_skill_points || 0)) {
          return tier;
        }

        return best;
      }, null);

      return {
        name : profession.profession && profession.profession.name || 'Profession',
        level : topTier && topTier.skill_points || 0,
        max : topTier && topTier.max_skill_points || 0
      };
    });

    return {
      character : {
        pseudo : summary.name || identity.characterName,
        classe : summary.character_class && summary.character_class.name || fallbackCharacter && fallbackCharacter.className || 'Inconnue',
        classe_icon : summary.character_class && summary.character_class.id || fallbackCharacter && fallbackCharacter.classIcon || '',
        activ_spe : activeSpec,
        profil_img : profileImage,
        ilvl : summary.equipped_item_level || summary.average_item_level || fallbackCharacter && fallbackCharacter.ilvl || 0,
        wish_ilvl : user.user_ilvl_wish,
        accomplished_purcent : fallbackCharacter && fallbackCharacter.accomplishedPercent || 0,
        loots_by_raid : fallbackCharacter && fallbackCharacter.lootsByRaid || 0,
        professions : professionList,
        last_loots : []
      },
      guild_characters : fallbackCharacter && fallbackCharacter.guildCharacters || []
    };
  }

  async getEquipment(user, options = {}) {
    const fallbackCharacter = this.getLocalCharacter(user);

    if (!this.useLiveData(user, fallbackCharacter)) {
      if (!fallbackCharacter) {
        throw new Error('Personnage introuvable');
      }

      const localItems = SLOT_ORDER.map((slot) => {
        const item = this.store.findItemById(fallbackCharacter.equipment[slot]);

        if (!item) {
          return {slot, no_item : true};
        }

        return this.formatEquipmentItem(slot, this.formatLocalItem(item));
      });

      return splitEquipment(localItems);
    }

    const identity = this.resolveIdentity(user, fallbackCharacter);
    const equipment = await this.getCharacterEquipment(identity, options);
    const equippedItems = equipment.equipped_items || [];
    const formatted = await Promise.all(equippedItems.map(async (item) => {
      const slot = BLIZZARD_SLOT_TO_LEGACY[item.slot && item.slot.type];
      if (!slot) {
        return null;
      }

      const normalized = await this.enrichItem(identity, item, options);
      return this.formatEquipmentItem(slot, normalized);
    }));

    const filled = new Map(formatted.filter(Boolean).map((item) => [item.slot, item]));
    const ordered = SLOT_ORDER.map((slot) => filled.get(slot) || {slot, no_item : true});
    return splitEquipment(ordered);
  }

  async getEquipmentWishlist(user, kind) {
    const equipment = await this.getEquipment(user);
    const flatEquipment = [...equipment.left, ...equipment.right];
    const wishlist = this.store.getWishlistForUser(user.user_id, kind);
    const fallbackCharacter = this.getLocalCharacter(user);

    if (!this.useLiveData(user, fallbackCharacter)) {
      return {
        equipment : SLOT_ORDER.map((slot, index) => {
          const wishlistItem = wishlist[slot] ? this.store.findItemById(wishlist[slot]) : null;
          const baseItem = wishlistItem ? this.formatEquipmentItem(slot, this.formatLocalItem(wishlistItem)) : flatEquipment.find((item) => item.slot === slot) || {slot, no_item : true};

          return {
            ...baseItem,
            status : STATUS_SEQUENCE[index % STATUS_SEQUENCE.length]
          };
        })
      };
    }

    const identity = this.resolveIdentity(user, fallbackCharacter);
    const wishlistEntries = await Promise.all(SLOT_ORDER.map(async (slot, index) => {
      let item = flatEquipment.find((entry) => entry.slot === slot) || {slot, no_item : true};

      if (wishlist[slot]) {
        const selectedItem = await this.getItem(identity, wishlist[slot]);
        const normalized = await this.enrichItem(identity, selectedItem);
        item = this.formatEquipmentItem(slot, normalized);
      }

      return {
        ...item,
        status : STATUS_SEQUENCE[index % STATUS_SEQUENCE.length]
      };
    }));

    return {
      equipment : wishlistEntries
    };
  }

  async refreshItem(user, slot, options = {}) {
    const equipment = await this.getEquipment(user, options);
    const item = [...equipment.left, ...equipment.right].find((entry) => entry.slot === slot);

    if (!item || item.no_item) {
      throw new Error('Objet introuvable');
    }

    return {
      img : item.icon,
      img_url : item.img_url,
      scarcity : item.scarcity,
      name : item.name,
      level : item.level
    };
  }

  async listItems(user, slot) {
    const fallbackCharacter = this.getLocalCharacter(user);
    const kindlessEquipment = await this.getEquipment(user);
    const currentItem = [...kindlessEquipment.left, ...kindlessEquipment.right].find((entry) => entry.slot === slot) || null;

    if (!this.useLiveData(user, fallbackCharacter)) {
      return {
        current_item : currentItem,
        items_list : this.store.listItemsBySlot(slot).map((item) => this.formatLocalItem(item))
      };
    }

    const identity = this.resolveIdentity(user, fallbackCharacter);
    const currentItemData = currentItem || await this.refreshItem(user, slot);
    const itemClassId = currentItem && currentItem.item_class_id;
    const itemSubClassId = currentItem && currentItem.item_subclass_id;
    const inventoryTypes = SLOT_TO_INVENTORY_TYPES[slot] || (currentItem && currentItem.inventory_type ? [currentItem.inventory_type] : []);

    const queries = inventoryTypes.length > 0 ? inventoryTypes : [''];
    const searchResults = await Promise.all(queries.map((inventoryType) => this.client.request(identity.region, '/data/wow/search/item', {
      namespace : this.client.getStaticNamespace(identity.region),
      locale : identity.locale,
      ttlMs : 60 * 60 * 1000,
      query : {
        orderby : 'id',
        _page : 1,
        _pageSize : 100,
        'item_class.id' : itemClassId,
        'item_subclass.id' : itemSubClassId,
        'inventory_type.type' : inventoryType,
        is_equippable : true
      }
    })));

    const uniqueEntries = new Map();
    searchResults.forEach((response) => {
      (response.results || []).forEach((entry) => {
        if (entry && entry.data && entry.data.id && !uniqueEntries.has(entry.data.id)) {
          uniqueEntries.set(entry.data.id, entry.data);
        }
      });
    });

    const topItems = [...uniqueEntries.values()]
      .sort((left, right) => {
        const leftLevel = left.level && left.level.value !== undefined ? left.level.value : left.level || 0;
        const rightLevel = right.level && right.level.value !== undefined ? right.level.value : right.level || 0;
        return rightLevel - leftLevel;
      })
      .slice(0, 30);

    const itemsList = await Promise.all(topItems.map(async (item) => {
      const mediaUrl = item.media && item.media.id ? extractAssetValue((await this.getItemMedia(identity, item.media.id)).assets, ['icon', 'main', 'zoom']) : null;

      return this.enrichItem(identity, item, {mediaUrl});
    }));

    return {
      current_item : currentItemData,
      items_list : itemsList
    };
  }

  async getItemDetails(user, itemId) {
    const fallbackCharacter = this.getLocalCharacter(user);

    if (!this.useLiveData(user, fallbackCharacter)) {
      const item = this.store.findItemById(itemId);
      if (!item) {
        throw new Error('Objet introuvable');
      }

      return {
        new_item : this.formatLocalItem(item)
      };
    }

    const identity = this.resolveIdentity(user, fallbackCharacter);
    const item = await this.getItem(identity, itemId);
    const normalized = await this.enrichItem(identity, item);

    return {
      new_item : normalized
    };
  }

  async bindWishlistItem(user, kind, slot, itemId) {
    const fallbackCharacter = this.getLocalCharacter(user);

    if (this.useLiveData(user, fallbackCharacter)) {
      const identity = this.resolveIdentity(user, fallbackCharacter);
      await this.getItem(identity, itemId);
    } else if (!this.store.findItemById(itemId)) {
      throw new Error('Objet introuvable');
    }

    this.store.setWishlistItem(user.user_id, kind, slot, itemId);

    return {
      success : {
        message : `Sélection ${kind.toUpperCase()} enregistrée pour ${slot}.`
      },
      datas : {
        slot,
        wishlist_kind : kind,
        item_id : Number(itemId)
      }
    };
  }

}

module.exports = {
  SLOT_ORDER,
  WowService
};
