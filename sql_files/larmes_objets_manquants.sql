-- phpMyAdmin SQL Dump
-- version 4.1.14.6
-- http://www.phpmyadmin.net
--
-- Client :  db410250125.db.1and1.com
-- Généré le :  Jeu 27 Novembre 2014 à 19:50
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
-- Structure de la table `larmes_objets_manquants`
--

CREATE TABLE IF NOT EXISTS `larmes_objets_manquants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objet_name` text COLLATE latin1_german2_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_demande` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci AUTO_INCREMENT=28 ;

--
-- Contenu de la table `larmes_objets_manquants`
--

INSERT INTO `larmes_objets_manquants` (`id`, `objet_name`, `user_id`, `date_demande`) VALUES
(26, 'sceau du retour karmique', 16, '2013-10-09'),
(27, 'casque de l''assassin barbelé', 64, '2014-03-11');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
