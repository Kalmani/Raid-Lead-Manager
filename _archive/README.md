Raid-Lead-Manager
=================

Création d'un environnement de travail :

1. Installer npm sur votre machine [How to install npm on windows](http://stackoverflow.com/questions/16000173/install-npm-node-js-package-manager-on-windows-w-o-using-node-js-msi)
2. Installer un serveur php/Mysql (WampServer2 par exemple)
3. Lancer une invite de commandes dans le répertoire www de votre wamp (Shift+Clic droit, Ouvrir une fenêtre de commande ici)
4. Cloner le projet dans ce répertoire - "git clone https://github.com/Kalmani/Raid-Lead-Manager.git"
5. Récupérer les sous modules - "git submodule update --init"
6. Lancer la commande "npm install" - toutes les dépendances grunt seront installées
7. Copier les fichier suivant au même emplacement et en retirant l'extention ".example"
  * ftp/ftpaccess.json.example
  * RLM/actions/config.php.example
  * RLM/actions/config.prod.php.example
    * Le fichier config.prod.php ne concerne que la version déployée sur server distant et n'aura donc aucun impact sur votre environnement de dev local.
    * les api_key et share_key sont distribuées via [l'interface blizzard api](https://dev.battle.net/), si vous faites parti de la guilde LN, contactez moi pour obtenir notre api key
8. uploader les fichiers sql contenus dans le dossier du même nom dans votre phpMyAdmin afin d'avoir une base d'items
9. Dans votre invite de commandes, lancer la commande "grunt" afin de compiler les fichiers js/xml/css existants
10. Lancer la commande "grunt watch", qui compilera tous les fichiers modifiés en temps réel
11. Enjoy