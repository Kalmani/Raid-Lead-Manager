-- phpMyAdmin SQL Dump
-- version 4.1.14.6
-- http://www.phpmyadmin.net
--
-- Client :  db410250125.db.1and1.com
-- Généré le :  Jeu 27 Novembre 2014 à 19:49
-- Version du serveur :  5.1.73-log
-- Version de PHP :  5.4.35-0+deb7u2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `db410250125`
--

-- --------------------------------------------------------

--
-- Structure de la table `larmes_maj`
--

CREATE TABLE IF NOT EXISTS `larmes_maj` (
  `maj_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `maj_content` text COLLATE latin1_german2_ci NOT NULL,
  `maj_date` date NOT NULL,
  PRIMARY KEY (`maj_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci AUTO_INCREMENT=29 ;

--
-- Contenu de la table `larmes_maj`
--

INSERT INTO `larmes_maj` (`maj_id`, `user_id`, `maj_content`, `maj_date`) VALUES
(1, 1, 'Correction d\\''un bug empêchant l\\''import de certains Slots', '2013-03-01'),
(4, 1, 'Correction d\\''un bug empêchant de sélectioner une main gauche dans certains cas', '2013-03-01'),
(7, 1, 'Mise en place des notes de mise à jour', '2013-03-01'),
(8, 1, 'Admin - Mise en place des premières statistiques', '2013-03-01'),
(9, 1, 'Admin - Possibilité de visionner / rafraichir des fiches perso d\\''autres comptes sans modifier la wish list', '2013-03-01'),
(10, 1, 'Ajout des torses T14 moine', '2013-03-04'),
(11, 1, 'Admin - Possibilité d\\''attribuer des objets hors wish list', '2013-03-04'),
(12, 1, 'Possibilité de consulter les fiches d\\''autres joueurs', '2013-03-04'),
(13, 1, 'Les objets PvP sont maintenant visible quand équipé mais ne sont toujours pas sélectionable dans la Wish List', '2013-03-04'),
(14, 1, 'Les arcs, armes à feu et arbalettes sont maintenant concidérées commes des armes à deux mains.', '2013-03-05'),
(15, 1, 'Importation des objets 5.2 terminée', '2013-03-14'),
(16, 1, 'Distinction des loots/crafts/vaillance et raid finder', '2013-03-14'),
(17, 1, 'Suppression de la list des objets 528 et 541', '2013-03-20'),
(18, 1, 'Le Raid Lead peut maintenant choisir quel bijou ou quelle bague échanger lors de l\\''attribution', '2013-03-27'),
(19, 1, 'Possibilité de filtrer les objets par statistiques !!!', '2013-04-02'),
(20, 1, 'Ajout des filtres gemmes et use/proc pour les bijoux', '2013-04-02'),
(21, 1, 'Correction du bug empêchant dans certains cas les DPS de choisir une arme en main gauche', '2013-05-02'),
(22, 1, 'Les gemmes et enchantements apparaissent avec votre équipement.', '2013-09-09'),
(23, 1, 'Objets 5.4 importés.', '2013-09-12'),
(24, 1, 'Nouvelle fonctionnalité dans paramètre : Vous pouvez rafraichir votre fiche sans supprimer votre wish list :)', '2013-09-12'),
(25, 1, 'Vous pouvez maintenant rechercher une pièce en tapant le début de son nom sans majuscule', '2013-09-16'),
(26, 1, 'Possibilité de choisir des loots non BIS et sa spé 2', '2013-10-09'),
(27, 1, 'Possibilité de corriger une erreur d\\''attribution de loot', '2013-10-09'),
(28, 1, 'Vous pouvez maintenant envoyer plein de Po à Kalmani pour ce qu\\''il fait pour la guilde ! (de toute façon, qui lira cette note franchement...)', '2013-10-09');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
