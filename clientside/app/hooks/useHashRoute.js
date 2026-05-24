import {useEffect, useState} from 'react';

function normalizePath(rawHash, authenticated) {
  const fallback = authenticated ? '/home' : '/login';
  const cleaned = (rawHash || '').replace(/^#/, '').trim();

  if (!cleaned) {
    return fallback;
  }

  return cleaned.startsWith('/') ? cleaned : `/${cleaned}`;
}

export function navigateTo(path) {
  const normalized = path.startsWith('/') ? path : `/${path}`;
  const targetHash = `#${normalized}`;

  if (window.location.hash !== targetHash) {
    window.location.hash = targetHash;
  }
}

export function useHashRoute(authenticated) {
  const [path, setPath] = useState(() => normalizePath(window.location.hash, authenticated));

  useEffect(() => {
    const sync = () => {
      setPath(normalizePath(window.location.hash, authenticated));
    };

    window.addEventListener('hashchange', sync);
    sync();

    return () => {
      window.removeEventListener('hashchange', sync);
    };
  }, [authenticated]);

  useEffect(() => {
    if (!authenticated && path !== '/login') {
      navigateTo('/login');
    }

    if (authenticated && path === '/login') {
      navigateTo('/home');
    }
  }, [authenticated, path]);

  return {path};
}
