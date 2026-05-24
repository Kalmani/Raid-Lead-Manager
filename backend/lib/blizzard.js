'use strict';

const {URL} = require('url');

class BlizzardClient {

  constructor(options = {}) {
    this.clientId = options.clientId || process.env.BLIZZARD_CLIENT_ID || '';
    this.clientSecret = options.clientSecret || process.env.BLIZZARD_CLIENT_SECRET || '';
    this.defaultRegion = options.defaultRegion || process.env.BLIZZARD_REGION || 'eu';
    this.defaultLocale = options.defaultLocale || process.env.BLIZZARD_LOCALE || 'fr_FR';
    this.tokenCache = new Map();
    this.responseCache = new Map();
  }

  isConfigured() {
    return Boolean(this.clientId && this.clientSecret);
  }

  getProfileNamespace(region) {
    return `profile-${region}`;
  }

  getStaticNamespace(region) {
    return `static-${region}`;
  }

  async getAccessToken(region = this.defaultRegion) {
    if (!this.isConfigured()) {
      throw new Error('API Blizzard non configurée. Définis BLIZZARD_CLIENT_ID et BLIZZARD_CLIENT_SECRET.');
    }

    const cached = this.tokenCache.get(region);
    if (cached && cached.expiresAt > Date.now()) {
      return cached.token;
    }

    const credentials = Buffer.from(`${this.clientId}:${this.clientSecret}`).toString('base64');
    const response = await fetch(`https://${region}.battle.net/oauth/token`, {
      method : 'POST',
      headers : {
        Authorization : `Basic ${credentials}`,
        'Content-Type' : 'application/x-www-form-urlencoded'
      },
      body : 'grant_type=client_credentials'
    });

    const payload = await response.json().catch(() => null);

    if (!response.ok || !payload || !payload.access_token) {
      throw new Error(`Impossible d'obtenir un token Battle.net (${response.status}).`);
    }

    this.tokenCache.set(region, {
      token : payload.access_token,
      expiresAt : Date.now() + ((payload.expires_in || 0) * 1000) - 60000
    });

    return payload.access_token;
  }

  async fetchJson(url, region, options = {}) {
    const ttlMs = options.ttlMs === undefined ? 5 * 60 * 1000 : options.ttlMs;
    const ignoreCache = Boolean(options.ignoreCache);
    const cacheKey = url.toString();
    const cached = this.responseCache.get(cacheKey);

    if (!ignoreCache && ttlMs > 0 && cached && cached.expiresAt > Date.now()) {
      return cached.payload;
    }

    const token = await this.getAccessToken(region);
    const response = await fetch(url, {
      headers : {
        Authorization : `Bearer ${token}`,
        Accept : 'application/json'
      }
    });

    const payload = await response.json().catch(() => null);

    if (!response.ok) {
      const detail = payload && (payload.detail || payload.title || payload.error || payload.type);
      throw new Error(`Erreur Battle.net ${response.status}${detail ? `: ${detail}` : ''}`);
    }

    if (ttlMs > 0) {
      this.responseCache.set(cacheKey, {
        payload,
        expiresAt : Date.now() + ttlMs
      });
    }

    return payload;
  }

  async request(region, endpoint, options = {}) {
    const locale = options.locale || this.defaultLocale;
    const namespace = options.namespace;
    const query = new URLSearchParams();

    if (namespace) {
      query.set('namespace', namespace);
    }

    if (locale) {
      query.set('locale', locale);
    }

    Object.entries(options.query || {}).forEach(([key, value]) => {
      if (value === undefined || value === null || value === '') {
        return;
      }

      query.set(key, String(value));
    });

    const url = new URL(`https://${region}.api.blizzard.com${endpoint}`);
    url.search = query.toString();

    return this.fetchJson(url, region, options);
  }

  async requestHref(region, href, options = {}) {
    const url = new URL(href);

    if (options.locale && !url.searchParams.has('locale')) {
      url.searchParams.set('locale', options.locale);
    }

    return this.fetchJson(url, region, options);
  }

}

module.exports = BlizzardClient;
