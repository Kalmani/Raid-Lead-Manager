'use strict';

const fs = require('fs');
const path = require('path');

class JsonStore {

  constructor(dataDir) {
    this.dataDir = dataDir;
  }

  read(name) {
    const filePath = path.join(this.dataDir, `${name}.json`);
    return JSON.parse(fs.readFileSync(filePath, 'utf8'));
  }

  write(name, data) {
    const filePath = path.join(this.dataDir, `${name}.json`);
    fs.writeFileSync(filePath, `${JSON.stringify(data, null, 2)}\n`);
  }

  getUsers() {
    return this.read('users').users;
  }

  saveUsers(users) {
    this.write('users', {users});
  }

  getUpdates() {
    return this.read('updates').updates;
  }

  getCharacters() {
    return this.read('characters').characters;
  }

  getCatalog() {
    return this.read('items').items;
  }

  getWishlists() {
    return this.read('wishlists').wishlists;
  }

  saveWishlists(wishlists) {
    this.write('wishlists', {wishlists});
  }

  getAttributions() {
    return this.read('attributions');
  }

  saveAttributions(attributions) {
    this.write('attributions', attributions);
  }

  findUserById(userId) {
    return this.getUsers().find((user) => Number(user.user_id) === Number(userId)) || null;
  }

  findUserByLogin(login) {
    return this.getUsers().find((user) => user.user_log === login) || null;
  }

  findCharacterById(characterId) {
    return this.getCharacters().find((character) => character.id === characterId) || null;
  }

  findCharacterByPseudo(pseudo) {
    return this.getCharacters().find((character) => character.pseudo === pseudo) || null;
  }

  findItemById(itemId) {
    return this.getCatalog().find((item) => Number(item.id) === Number(itemId)) || null;
  }

  listItemsBySlot(slot) {
    return this.getCatalog().filter((item) => item.slot === slot);
  }

  getWishlistForUser(userId, kind) {
    const wishlists = this.getWishlists();
    const userWishlists = wishlists[String(userId)] || {};
    return userWishlists[kind] || {};
  }

  setWishlistItem(userId, kind, slot, itemId) {
    const wishlists = this.getWishlists();
    const userKey = String(userId);

    if (!wishlists[userKey]) {
      wishlists[userKey] = {};
    }

    if (!wishlists[userKey][kind]) {
      wishlists[userKey][kind] = {};
    }

    wishlists[userKey][kind][slot] = Number(itemId);
    this.saveWishlists(wishlists);
  }

}

module.exports = JsonStore;
