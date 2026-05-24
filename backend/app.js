'use strict';

const path = require('path');

const express = require('express');

const ProxyServer = require('../clientside/packer/proxy');
const {DEFAULT_DEPLOY_DIR, ROOT_DIR} = require('../clientside/packer/constants');
const JsonStore = require('./lib/store');
const {
  isMd5,
  matchesLegacyPassword,
  md5,
  readSession,
  sanitizeUser,
  writeSession
} = require('./lib/session');
const {AttributionService} = require('./services/attribution-service');
const {WowService} = require('./services/wow-service');

function toError(message) {
  return {error : {message}};
}

function toSuccess(message, extra = {}) {
  return {success : {message}, ...extra};
}

function normalizeWishKind(kind) {
  return ['bis', 'prov', 'spe2'].includes(kind) ? kind : 'bis';
}

function getCurrentUser(req, store) {
  const session = readSession(req);

  if (!session || !session.user_id) {
    return null;
  }

  return store.findUserById(session.user_id);
}

function getAdminUser(req, store) {
  const user = getCurrentUser(req, store);

  if (!user) {
    return null;
  }

  return Number(user.user_statut) > 0 ? user : null;
}

function createActionHandlers(store, wowService) {
  const attributionService = new AttributionService(store);

  return {
    account : {
      login : async ({params, res}) => {
        const user = store.findUserByLogin((params.pseudo || '').trim());
        const password = (params.pass || '').trim();

        if (!user || !matchesLegacyPassword(user.user_pass, password)) {
          return {
            warning : {
              message : 'Identifiants incorrects'
            }
          };
        }

        writeSession(res, user);

        return toSuccess('Identification réussi', {
          user_datas : {
            ...sanitizeUser(user),
            need_new_pass : !isMd5(user.user_pass)
          }
        });
      },

      change_login : async ({req, params, res}) => {
        const user = getCurrentUser(req, store);

        if (!user) {
          return toError('Session invalide');
        }

        const identifiant = (params.identifiant || '').trim();
        const oldPassword = params.old_password || '';
        const newPassword = params.new_password || '';
        const newPasswordConf = params.new_password_conf || '';

        if (!identifiant) {
          return toError('Merci de saisir un identifiant correct');
        }

        if (!matchesLegacyPassword(user.user_pass, oldPassword)) {
          return toError('Mot de passe actuel incorrect');
        }

        const existing = store.findUserByLogin(identifiant);
        if (existing && existing.user_id !== user.user_id) {
          return toError('Cet identifiant est déjà utilisé');
        }

        if ((newPassword || newPasswordConf) && newPassword !== newPasswordConf) {
          return toError('Merci de saisir des mots de passe identiques');
        }

        const users = store.getUsers().map((candidate) => {
          if (candidate.user_id !== user.user_id) {
            return candidate;
          }

          return {
            ...candidate,
            user_log : identifiant,
            user_pass : newPassword ? md5(newPassword) : candidate.user_pass
          };
        });

        store.saveUsers(users);

        const updatedUser = store.findUserById(user.user_id);
        writeSession(res, updatedUser);

        if (newPassword) {
          return toSuccess('Identifiant et mot de passe modifiés avec succès', {
            datas : {
              user_log : identifiant
            }
          });
        }

        return toSuccess('Identifiant modifié avec succès', {
          datas : {
            user_log : identifiant
          }
        });
      },

      change_email : async ({req, params, res}) => {
        const user = getCurrentUser(req, store);

        if (!user) {
          return toError('Session invalide');
        }

        const email = (params.email || '').trim();

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
          return toError('Email incorrect');
        }

        const users = store.getUsers().map((candidate) => {
          if (candidate.user_id !== user.user_id) {
            return candidate;
          }

          return {
            ...candidate,
            user_mail : email
          };
        });

        store.saveUsers(users);

        const updatedUser = store.findUserById(user.user_id);
        writeSession(res, updatedUser);

        return toSuccess('Adresse email modifiée avec succès', {
          datas : {
            user_mail : email
          }
        });
      }
    },

    character : {
      show_profile : async ({req}) => {
        const user = getCurrentUser(req, store);

        if (!user) {
          return toError('Session invalide');
        }

        return wowService.getProfile(user);
      },

      show_equipment : async ({req}) => {
        const user = getCurrentUser(req, store);

        if (!user) {
          return toError('Session invalide');
        }

        return wowService.getEquipment(user);
      },

      show_equipment_wish : async ({req, params}) => {
        const user = getCurrentUser(req, store);

        if (!user) {
          return toError('Session invalide');
        }

        return wowService.getEquipmentWishlist(user, normalizeWishKind(params.wishlist_kind));
      },

      update_item : async ({req, params}) => {
        const user = getCurrentUser(req, store);

        if (!user) {
          return toError('Session invalide');
        }

        return wowService.refreshItem(user, params.slot, {ignoreCache : Boolean(params.nocache)});
      },

      bind_bis : async ({req, params}) => {
        const user = getCurrentUser(req, store);

        if (!user) {
          return toError('Session invalide');
        }

        return wowService.bindWishlistItem(user, normalizeWishKind(params.wishlist_kind), params.slot, params.new_id);
      }
    },

    items : {
      list_items : async ({req, params}) => {
        const user = getCurrentUser(req, store);

        if (!user) {
          return toError('Session invalide');
        }

        return wowService.listItems(user, params.slot);
      },

      show_item : async ({req, params}) => {
        const user = getCurrentUser(req, store);

        if (!user) {
          return toError('Session invalide');
        }

        return wowService.getItemDetails(user, params.id);
      }
    },

    base : {
      show_last_notes : async () => ({
        updates : store.getUpdates()
      })
    },

    admin : {
      show_attribution : async ({req}) => {
        const user = getAdminUser(req, store);

        if (!user) {
          return toError('Acces admin refuse');
        }

        return attributionService.getBoard();
      },

      award_attribution : async ({req, params}) => {
        const user = getAdminUser(req, store);

        if (!user) {
          return toError('Acces admin refuse');
        }

        return attributionService.awardDrop(params);
      }
    }
  };
}

function createApp(options = {}) {
  const dataDir = options.dataDir || path.join(ROOT_DIR, 'backend', 'data');
  const targetDir = options.targetDir || DEFAULT_DEPLOY_DIR;
  const store = new JsonStore(dataDir);
  const wowService = new WowService(store, options);
  const proxy = new ProxyServer();
  const handlers = createActionHandlers(store, wowService);
  const app = express();

  app.use(express.json());
  app.use(express.urlencoded({extended : false}));

  app.get('/api/health', (req, res) => {
    res.json({
      ok : true,
      blizzard : wowService.client.isConfigured()
    });
  });

  app.post('/actions/main.php', async (req, res) => {
    try {
      const namespace = String(req.body.namespace || '').trim().toLowerCase();
      const action = String(req.body.action || '').trim().toLowerCase();
      const namespaceHandlers = handlers[namespace];

      if (!namespaceHandlers) {
        res.json(toError(`Bad namespace ${namespace}, file ${namespace}.php does not exist`));
        return;
      }

      const handler = namespaceHandlers[action];

      if (!handler) {
        res.json(toError(`Unknown action ${namespace}/${action}`));
        return;
      }

      const params = {...req.body};
      delete params.namespace;
      delete params.action;

      res.json(await handler({req, res, params}));
    } catch (error) {
      res.json(toError(error.message || 'Erreur backend inattendue'));
    }
  });

  proxy.attach(app, targetDir);

  return app;
}

module.exports = {
  createApp
};
