-- phpMyAdmin SQL Dump
-- version 4.1.14.6
-- http://www.phpmyadmin.net
--
-- Client :  db410250125.db.1and1.com
-- Généré le :  Jeu 27 Novembre 2014 à 19:47
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
-- Structure de la table `larmes_down`
--

CREATE TABLE IF NOT EXISTS `larmes_down` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `boss_id` int(11) NOT NULL,
  `down_type` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci AUTO_INCREMENT=155 ;

--
-- Contenu de la table `larmes_down`
--

INSERT INTO `larmes_down` (`id`, `boss_id`, `down_type`) VALUES
(1, 60043, 2),
(2, 60009, 2),
(3, 60143, 2),
(4, 60701, 3),
(55, 62511, 1),
(56, 60410, 2),
(7, 60400, 1),
(8, 62980, 1),
(24, 62543, 1),
(51, 62164, 1),
(20, 62837, 1),
(14, 60585, 1),
(15, 62442, 1),
(19, 60999, 1),
(18, 62983, 1),
(37, 62397, 1),
(54, 60399, 1),
(57, 69465, 1),
(68, 68476, 1),
(79, 69078, 1),
(84, 67977, 1),
(90, 68066, 1),
(89, 68177, 1),
(96, 67827, 1),
(94, 69017, 1),
(95, 69427, 1),
(99, 68078, 1),
(101, 68904, 1),
(102, 68397, 1),
(123, 71543, 2),
(126, 71475, 2),
(139, 71454, 2),
(135, 71965, 2),
(131, 71734, 2),
(132, 72249, 2),
(133, 71466, 2),
(134, 71859, 2),
(138, 71515, 2),
(140, 71889, 2),
(147, 71529, 2),
(145, 71504, 2),
(146, 71152, 2),
(152, 71865, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
