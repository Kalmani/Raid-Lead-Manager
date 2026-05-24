Raid-Lead-Manager
=================

Etat actuel
-----------

Le frontend historique est remplace par un frontend React et le backend PHP est remplace par un serveur Node/Express.

Nouvelle structure :

* `clientside/app` : sources React
* `clientside/theme` : styles SCSS
* `clientside/packer` : build maison inspiré du packer de `lisieredumorvan`
* `backend` : API Express et stockage JSON
* sortie cible : `RLM/` servie par le backend Node

Nouvelles commandes :

* `npm start`
* `npm run build`
* `npm run watch`
* `npm run serve`
* `npm run dev`

Création d'un environnement de travail :

1. Installer Node.js et npm
2. Cloner le projet
3. Lancer `npm install`
4. Copier `.env.example` vers `.env`
5. Renseigner `BLIZZARD_CLIENT_ID` et `BLIZZARD_CLIENT_SECRET` dans `.env` si tu veux activer le mode live Battle.net
6. Lancer `npm run build` pour produire les assets dans `RLM/`
7. Lancer `npm start` pour servir l'application sur `http://127.0.0.1:8000`
8. Utiliser `npm run watch` pour rebuilder automatiquement le frontend
9. Utiliser `npm run dev` pour builder, watcher puis servir localement
10. Les donnees mockees sont dans `backend/data/*.json`

Configuration Blizzard :

* `BLIZZARD_CLIENT_ID` et `BLIZZARD_CLIENT_SECRET` activent les appels live vers les API Battle.net
* `BLIZZARD_REGION` et `BLIZZARD_LOCALE` peuvent surcharger les valeurs par defaut (`eu`, `fr_FR`)
* `HOST` et `PORT` sont aussi lus depuis `.env`
* sans ces variables, le backend continue de fonctionner sur les fichiers JSON mockes
