const COOKIE_NAME = 'RLM_user';

function readCookie(name) {
  const prefix = `${name}=`;
  const cookies = document.cookie ? document.cookie.split(';') : [];

  for (const rawCookie of cookies) {
    const cookie = rawCookie.trim();
    if (cookie.startsWith(prefix)) {
      return cookie.slice(prefix.length);
    }
  }

  return null;
}

export function readSession() {
  const rawValue = readCookie(COOKIE_NAME);
  if (!rawValue) {
    return null;
  }

  try {
    return JSON.parse(decodeURIComponent(rawValue));
  } catch (error) {
    return null;
  }
}

export function writeSession(user) {
  const encoded = encodeURIComponent(JSON.stringify(user));
  document.cookie = `${COOKIE_NAME}=${encoded}; path=/; SameSite=Lax`;
}

export function updateSession(patch) {
  const current = readSession() || {};
  const next = {...current, ...patch};
  writeSession(next);
  return next;
}

export function clearSession() {
  document.cookie = `${COOKIE_NAME}=; path=/; expires=Thu, 01 Jan 1970 00:00:00 GMT; SameSite=Lax`;
}
