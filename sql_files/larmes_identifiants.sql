-- phpMyAdmin SQL Dump
-- version 4.1.14.6
-- http://www.phpmyadmin.net
--
-- Client :  db410250125.db.1and1.com
-- Généré le :  Jeu 27 Novembre 2014 à 19:48
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
-- Structure de la table `larmes_identifiants`
--

CREATE TABLE IF NOT EXISTS `larmes_identifiants` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_log` text COLLATE latin1_german2_ci NOT NULL,
  `user_pass` text COLLATE latin1_german2_ci NOT NULL,
  `user_note` text COLLATE latin1_german2_ci NOT NULL,
  `user_mail` text COLLATE latin1_german2_ci NOT NULL,
  `user_perso` text COLLATE latin1_german2_ci NOT NULL,
  `user_ilvl_wish` int(11) NOT NULL,
  `user_statut` tinyint(4) NOT NULL,
  `perso_class` tinyint(4) NOT NULL,
  `ilvl_moy` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci AUTO_INCREMENT=69 ;

--
-- Contenu de la table `larmes_identifiants`
--

INSERT INTO `larmes_identifiants` (`user_id`, `user_log`, `user_pass`, `user_note`, `user_mail`, `user_perso`, `user_ilvl_wish`, `user_statut`, `perso_class`, `ilvl_moy`) VALUES
(1, 'admin', 'admin', '', 'admin@raidleadmanager.com', '', 0, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
