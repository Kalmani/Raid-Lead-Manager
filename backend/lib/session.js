'use strict';

const crypto = require('crypto');

const COOKIE_NAME = 'RLM_user';
const MD5_PATTERN = /^[a-f0-9]{32}$/;

function md5(value) {
  return crypto.createHash('md5').update(String(value)).digest('hex');
}

function isMd5(value) {
  return MD5_PATTERN.test(String(value || ''));
}

function matchesLegacyPassword(storedPassword, providedPassword) {
  return storedPassword === providedPassword || storedPassword === md5(providedPassword);
}

function sanitizeUser(user) {
  return {
    user_id : user.user_id,
    user_log : user.user_log,
    user_mail : user.user_mail,
    user_perso : user.user_perso,
    user_ilvl_wish : user.user_ilvl_wish,
    user_statut : user.user_statut,
    perso_class : user.perso_class,
    ilvl_moy : user.ilvl_moy,
    character_id : user.character_id,
    character_name : user.character_name,
    realm_slug : user.realm_slug,
    region : user.region,
    locale : user.locale
  };
}

function readCookies(req) {
  const header = req.headers.cookie || '';

  return header.split(';').reduce((cookies, chunk) => {
    const trimmed = chunk.trim();

    if (!trimmed) {
      return cookies;
    }

    const separatorIndex = trimmed.indexOf('=');
    if (separatorIndex === -1) {
      return cookies;
    }

    const key = trimmed.slice(0, separatorIndex);
    const value = trimmed.slice(separatorIndex + 1);
    cookies[key] = value;
    return cookies;
  }, {});
}

function readSession(req) {
  const cookies = readCookies(req);
  const rawValue = cookies[COOKIE_NAME];

  if (!rawValue) {
    return null;
  }

  try {
    return JSON.parse(decodeURIComponent(rawValue));
  } catch (error) {
    return null;
  }
}

function writeSession(res, user) {
  res.cookie(COOKIE_NAME, JSON.stringify(sanitizeUser(user)), {
    path : '/',
    sameSite : 'lax'
  });
}

module.exports = {
  COOKIE_NAME,
  isMd5,
  matchesLegacyPassword,
  md5,
  readSession,
  sanitizeUser,
  writeSession
};
