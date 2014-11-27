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
-- Structure de la table `larmes_user_slots`
--

CREATE TABLE IF NOT EXISTS `larmes_user_slots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `slot_id` text CHARACTER SET utf8 NOT NULL,
  `item_id` int(11) NOT NULL,
  `wich_id` int(11) NOT NULL,
  `wich_prov_id` int(11) NOT NULL DEFAULT '0',
  `wish_spe_2_id` int(11) NOT NULL DEFAULT '0',
  `gems_ench` text COLLATE latin1_german2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci AUTO_INCREMENT=1198 ;

--
-- Contenu de la table `larmes_user_slots`
--

INSERT INTO `larmes_user_slots` (`id`, `user_id`, `slot_id`, `item_id`, `wich_id`, `wich_prov_id`, `wish_spe_2_id`, `gems_ench`) VALUES
(1197, 1, 'offHand', 104470, 0, 0, 0, '76694[||]4434'),
(17, 3, 'head', 96027, 99161, 103751, 0, '95347_76641[||]'),
(18, 3, 'neck', 104792, 103868, 0, 0, '[||]'),
(19, 3, 'shoulder', 95264, 99153, 0, 0, '76694_76697[||]4806'),
(20, 3, 'back', 102246, 102246, 0, 0, '76660[||]4892'),
(21, 3, 'chest', 99152, 103803, 0, 0, '76660_76660_76660[||]4419'),
(22, 3, 'wrist', 96080, 103810, 103850, 0, '76697[||]4414'),
(23, 3, 'hands', 95260, 99160, 0, 0, '83150[||]4430'),
(24, 3, 'waist', 103899, 103899, 0, 0, '76660_76697_76697[||]'),
(25, 3, 'legs', 99162, 99162, 0, 0, '76697_76697[||]4895'),
(26, 3, 'feet', 96156, 103806, 103805, 0, '76694[||]4429'),
(27, 3, 'finger1', 103823, 103774, 0, 0, '[||]'),
(28, 3, 'finger2', 105194, 105194, 0, 0, '[||]'),
(29, 3, 'trinket1', 102300, 102300, 0, 0, '[||]'),
(30, 3, 'trinket2', 104675, 102293, 0, 0, '[||]'),
(31, 3, 'mainHand', 103946, 103946, 0, 0, '83150[||]4442'),
(32, 3, 'offHand', 103918, 103918, 0, 0, '76697[||]4434'),
(1004, 5, 'mainHand', 112723, 104598, 0, 103869, '76700[||]4442'),
(1003, 5, 'trinket2', 104544, 104544, 0, 102298, '[||]'),
(1002, 5, 'trinket1', 104426, 104426, 0, 102305, '[||]'),
(1001, 5, 'finger2', 112916, 104538, 0, 103896, '[||]'),
(1000, 5, 'finger1', 112852, 104502, 0, 103793, '76700[||]'),
(999, 5, 'feet', 112765, 104497, 0, 103878, '76700[||]4429'),
(998, 5, 'legs', 99426, 99426, 0, 99199, '76700_76700[||]4895'),
(997, 5, 'waist', 104519, 104519, 0, 0, '76671_76643_76700[||]'),
(996, 5, 'hands', 99424, 99424, 0, 99198, '76671_76671[||]4433'),
(995, 5, 'wrist', 105461, 104595, 0, 103740, '[||]4414'),
(994, 5, 'chest', 99416, 99416, 0, 99197, '76671_76671_76671[||]4419'),
(993, 5, 'back', 102246, 102246, 0, 102249, '76671[||]'),
(992, 5, 'shoulder', 104468, 104468, 0, 86149, '76671_76643[||]4806'),
(991, 5, 'neck', 112559, 104469, 0, 103917, '[||]'),
(990, 5, 'head', 99425, 99425, 0, 99206, '95347_76671[||]'),
(1196, 1, 'mainHand', 105688, 0, 0, 0, '76694_76694[||]4442'),
(1195, 1, 'trinket2', 104426, 0, 0, 0, '[||]'),
(1194, 1, 'trinket1', 112768, 0, 0, 0, '[||]'),
(1193, 1, 'finger2', 112852, 0, 0, 0, '76694[||]'),
(1192, 1, 'finger1', 104524, 0, 0, 0, '76668[||]'),
(1191, 1, 'feet', 104450, 0, 0, 0, '76694[||]4426'),
(1190, 1, 'legs', 99333, 0, 0, 0, '76672_76672[||]4825'),
(1189, 1, 'waist', 103941, 0, 0, 0, '76694_76668_76694[||]'),
(1188, 1, 'hands', 99345, 0, 0, 0, '76694_76694[||]4431'),
(1053, 4, 'offHand', 104448, 104448, 0, 0, '76620[||]4434'),
(1052, 4, 'mainHand', 105688, 104545, 0, 0, '76694_76694[||]4442'),
(1051, 4, 'trinket2', 104478, 104478, 0, 0, '[||]'),
(1050, 4, 'trinket1', 112778, 104611, 0, 0, '[||]'),
(1049, 4, 'finger2', 104524, 104524, 0, 0, '76672[||]'),
(1048, 4, 'finger1', 104427, 104427, 0, 0, '76620[||]'),
(1047, 4, 'feet', 104428, 104580, 0, 0, '76694[||]4429'),
(1046, 4, 'legs', 99429, 99429, 0, 0, '76699_76699[||]4825'),
(1045, 4, 'waist', 104504, 104655, 0, 0, '76694_76620_76694[||]'),
(1044, 4, 'hands', 104599, 104599, 0, 0, '76694_76699[||]4430'),
(1043, 4, 'wrist', 104526, 104526, 0, 0, '[||]4414'),
(1042, 4, 'chest', 99430, 104633, 0, 0, '76694_76694_76694[||]4419'),
(1041, 4, 'back', 102247, 102247, 0, 0, '76694[||]4423'),
(209, 24, 'head', 103751, 103751, 0, 103900, '76885_76577[||]'),
(210, 24, 'neck', 105216, 103867, 0, 0, '[||]'),
(211, 24, 'shoulder', 103857, 99205, 0, 103808, '76672_76577[||]4806'),
(212, 24, 'back', 102246, 102246, 0, 0, '76672[||]4892'),
(213, 24, 'chest', 104845, 99204, 0, 0, '76672_76672_76700[||]4419'),
(214, 24, 'wrist', 105342, 105342, 0, 0, '[||]4414'),
(215, 24, 'hands', 99096, 99096, 0, 0, '76606_76606[||]4433'),
(216, 24, 'waist', 105266, 103898, 0, 0, '76672_76643_76700[||]'),
(217, 24, 'legs', 99098, 99098, 0, 103921, '76700_76700[||]4825'),
(218, 24, 'feet', 94277, 103806, 0, 103805, '76700_76700[||]4429'),
(219, 24, 'finger1', 101937, 103774, 0, 103823, '[||]'),
(220, 24, 'finger2', 103822, 103824, 0, 0, '[||]'),
(221, 24, 'trinket1', 94531, 102300, 0, 0, '[||]'),
(222, 24, 'trinket2', 96041, 102293, 0, 0, '[||]'),
(223, 24, 'mainHand', 103873, 103873, 0, 103946, '76577[||]4442'),
(224, 24, 'offHand', 0, 0, 0, 0, ''),
(973, 20, 'offHand', 103847, 103847, 0, 0, '76686[||]4434'),
(972, 20, 'mainHand', 104803, 103936, 0, 0, '76686[||]4442'),
(971, 20, 'trinket2', 104868, 102309, 0, 0, '[||]'),
(970, 20, 'trinket1', 94509, 102299, 0, 0, '[||]'),
(969, 20, 'finger2', 104773, 103773, 0, 0, '76672[||]'),
(968, 20, 'finger1', 105174, 105174, 0, 0, '76579[||]'),
(967, 20, 'feet', 104681, 103766, 0, 0, '76686[||]4429'),
(966, 20, 'legs', 99124, 99124, 0, 0, '76672_76672[||]4826'),
(965, 20, 'waist', 105178, 105178, 0, 0, '76672_76672_76672[||]'),
(964, 20, 'hands', 103817, 103817, 0, 0, '76672_76638[||]4433'),
(963, 20, 'wrist', 103866, 103866, 0, 0, '[||]4414'),
(962, 20, 'chest', 99133, 103958, 99133, 0, '76672_76672_76672[||]4418'),
(961, 20, 'back', 105816, 102247, 0, 0, '[||]'),
(960, 20, 'shoulder', 99125, 99125, 0, 0, '76672_76672[||]4806'),
(959, 20, 'neck', 103882, 103882, 103881, 0, '[||]'),
(958, 20, 'head', 104730, 99135, 103821, 0, '95345_76686[||]'),
(957, 36, 'offHand', 104559, 0, 0, 0, '76697[||]4444'),
(956, 36, 'mainHand', 104483, 104406, 103873, 0, '76643[||]4444'),
(955, 36, 'trinket2', 102308, 102293, 102303, 102300, '[||]'),
(954, 36, 'trinket1', 102305, 102310, 102300, 102293, '[||]'),
(953, 36, 'finger2', 103793, 103824, 103822, 0, '[||]'),
(952, 36, 'finger1', 104593, 103774, 103823, 0, '76659[||]'),
(951, 36, 'feet', 105229, 103805, 103804, 0, '76659[||]4429'),
(950, 36, 'legs', 99199, 99162, 103921, 0, '83146_76700[||]4823'),
(949, 36, 'waist', 112834, 105781, 105781, 0, '76659_76700_76700[||]'),
(948, 36, 'hands', 105850, 99160, 99160, 0, '76700_76700[||]4433'),
(947, 36, 'wrist', 104460, 103851, 103849, 0, '[||]4411'),
(946, 36, 'chest', 105532, 99152, 105191, 0, '76659_76659_83143[||]4419'),
(945, 36, 'back', 102249, 102246, 103770, 0, '76659[||]4424'),
(944, 36, 'shoulder', 99200, 99153, 103807, 0, '76659_76659[||]4803'),
(943, 36, 'neck', 105264, 103867, 103867, 103868, '[||]'),
(942, 36, 'head', 104590, 103901, 103751, 0, '95346_76659[||]'),
(273, 25, 'head', 94949, 0, 0, 0, '76885_76686[||]'),
(274, 25, 'neck', 95146, 0, 0, 0, '[||]'),
(275, 25, 'shoulder', 96067, 0, 0, 0, '83150[||]4806'),
(276, 25, 'back', 94960, 0, 0, 0, '76694[||]4423'),
(277, 25, 'chest', 95715, 0, 0, 0, '76668_76668[||]4419'),
(278, 25, 'wrist', 94767, 0, 0, 0, '76668[||]4414'),
(279, 25, 'hands', 95321, 0, 0, 0, '76694[||]4430'),
(280, 25, 'waist', 86342, 0, 0, 0, '76694_83150[||]'),
(281, 25, 'legs', 95323, 0, 0, 0, '76668_76686[||]4826'),
(282, 25, 'feet', 94736, 0, 0, 0, '76668[||]4429'),
(283, 25, 'finger1', 95164, 0, 0, 0, '[||]'),
(284, 25, 'finger2', 95138, 0, 0, 0, '[||]'),
(285, 25, 'trinket1', 94513, 0, 0, 0, '[||]'),
(286, 25, 'trinket2', 94510, 0, 0, 0, '[||]'),
(287, 25, 'mainHand', 94922, 0, 0, 0, '76694[||]4442'),
(288, 25, 'offHand', 94778, 0, 0, 0, '76686[||]'),
(337, 35, 'head', 99341, 99103, 0, 0, '95346_76692[||]'),
(338, 35, 'neck', 104411, 103749, 0, 0, '[||]'),
(339, 35, 'shoulder', 105455, 99105, 0, 0, '76699_76699[||]4804'),
(340, 35, 'back', 102248, 102248, 0, 0, '76626[||]4424'),
(341, 35, 'chest', 99347, 99101, 0, 0, '76692_76692_76692[||]4419'),
(342, 35, 'wrist', 104491, 105238, 0, 0, '[||]4416'),
(343, 35, 'hands', 99340, 103781, 0, 0, '76692_76692[||]4430'),
(344, 35, 'waist', 104490, 103887, 0, 0, '76699_76699_76699[||]'),
(345, 35, 'legs', 99104, 99104, 0, 0, '76699_76699[||]4822'),
(346, 35, 'feet', 104511, 103731, 0, 0, '76666[||]4429'),
(347, 35, 'finger1', 104455, 103842, 0, 0, '76692[||]'),
(348, 35, 'finger2', 104487, 103844, 0, 0, '76699[||]'),
(349, 35, 'trinket1', 104476, 102292, 0, 0, '[||]'),
(350, 35, 'trinket2', 104531, 102301, 0, 0, '[||]'),
(351, 35, 'mainHand', 105685, 104404, 0, 0, '76692_76692[||]4444'),
(352, 35, 'offHand', 104508, 104404, 0, 0, '76692[||]4444'),
(353, 16, 'head', 105495, 99164, 103728, 99624, '95347_76699[||]'),
(354, 16, 'neck', 112767, 103750, 103749, 103882, '[||]'),
(355, 16, 'shoulder', 99401, 99166, 103913, 0, '76672_76672[||]4806'),
(356, 16, 'back', 102246, 102245, 103935, 102247, '76668[||]'),
(357, 16, 'chest', 105440, 99170, 103834, 99172, '76668_76699_76642[||]4419'),
(358, 16, 'wrist', 112716, 103909, 103911, 103759, '[||]4414'),
(359, 16, 'hands', 99397, 103832, 103831, 99185, '76668_76668[||]4433'),
(360, 16, 'waist', 104519, 103928, 103927, 0, '76668_76642_76699[||]'),
(361, 16, 'legs', 104520, 99165, 103929, 0, '76642_76642[||]4895'),
(362, 16, 'feet', 112486, 103778, 103777, 0, '76671[||]4426'),
(363, 16, 'finger1', 104502, 103843, 103842, 0, '[||]'),
(364, 16, 'finger2', 104447, 103843, 103843, 0, '[||]'),
(365, 16, 'trinket1', 104544, 102307, 102297, 0, '[||]'),
(366, 16, 'trinket2', 104426, 102306, 102296, 0, '[||]'),
(367, 16, 'mainHand', 105690, 103726, 0, 0, '76694_76694[||]4442'),
(368, 16, 'offHand', 0, 0, 0, 0, ''),
(385, 19, 'head', 101855, 99109, 0, 103930, '[||]'),
(386, 19, 'neck', 95144, 103881, 0, 103749, '[||]'),
(387, 19, 'shoulder', 101858, 103816, 0, 103836, '[||]'),
(388, 19, 'back', 95653, 102247, 0, 103934, '[||]'),
(389, 19, 'chest', 101851, 99107, 0, 103962, '[||]'),
(390, 19, 'wrist', 86849, 103862, 0, 103889, '[||]'),
(391, 19, 'hands', 95831, 99108, 0, 103780, '[||]'),
(392, 19, 'waist', 101854, 105294, 0, 103887, '[||]'),
(393, 19, 'legs', 101856, 99099, 0, 103838, '[||]'),
(394, 19, 'feet', 98141, 103812, 0, 103731, '[||]'),
(395, 19, 'finger1', 118765, 103771, 0, 103842, '[||]'),
(396, 19, 'finger2', 101860, 105271, 0, 103841, '[||]'),
(397, 19, 'trinket1', 118778, 102299, 0, 102292, '[||]'),
(398, 19, 'trinket2', 87575, 102309, 0, 102301, '[||]'),
(399, 19, 'mainHand', 95875, 103936, 0, 103908, '[||]'),
(400, 19, 'offHand', 103828, 105217, 0, 103908, '76692[||]4441'),
(433, 33, 'head', 94724, 99114, 0, 0, '95346_76670[||]'),
(434, 33, 'neck', 103749, 103749, 0, 0, '[||]'),
(435, 33, 'shoulder', 95309, 104555, 0, 0, '83151_76670[||]4804'),
(436, 33, 'back', 102248, 102248, 0, 0, '76692[||]4421'),
(437, 33, 'chest', 99006, 99112, 0, 0, '76692_76692_76692[||]4419'),
(438, 33, 'wrist', 95133, 103910, 0, 0, '[||]4416'),
(439, 33, 'hands', 99113, 99113, 0, 0, '83151_76692[||]4433'),
(440, 33, 'waist', 95088, 98613, 0, 0, '76670_76692[||]'),
(441, 33, 'legs', 95308, 99115, 0, 0, '76670_76680[||]4822'),
(442, 33, 'feet', 94967, 103779, 0, 0, '76670[||]4428'),
(443, 33, 'finger1', 95510, 103844, 0, 0, '[||]4359'),
(444, 33, 'finger2', 104736, 103842, 0, 0, '76670[||]4359'),
(445, 33, 'trinket1', 105029, 102301, 0, 0, '[||]'),
(446, 33, 'trinket2', 105223, 102311, 0, 0, '[||]'),
(447, 33, 'mainHand', 105298, 103827, 0, 0, '76692[||]4444'),
(448, 33, 'offHand', 103827, 103827, 0, 0, '76692[||]4444'),
(1040, 4, 'shoulder', 99431, 99431, 0, 0, '76694_76694[||]4806'),
(1039, 4, 'neck', 104597, 104597, 0, 0, '[||]'),
(1038, 4, 'head', 104480, 104480, 0, 0, '95345_76620[||]'),
(561, 18, 'head', 98985, 0, 0, 0, '95346_76630[||]'),
(562, 18, 'neck', 101884, 0, 0, 0, '[||]'),
(563, 18, 'shoulder', 95284, 0, 0, 0, '76696_76633[||]4803'),
(564, 18, 'back', 102249, 0, 0, 0, '76696[||]4424'),
(565, 18, 'chest', 105767, 0, 0, 0, '76630_76642_76642[||]4419'),
(566, 18, 'wrist', 96022, 0, 0, 0, '[||]4415'),
(567, 18, 'hands', 95281, 0, 0, 0, '83141[||]4432'),
(568, 18, 'waist', 94726, 0, 0, 0, '76669_76699_76699[||]'),
(569, 18, 'legs', 99139, 0, 0, 0, '76633_76633[||]4823'),
(570, 18, 'feet', 94265, 0, 0, 0, '76696_76696[||]4426'),
(571, 18, 'finger1', 95140, 0, 0, 0, '[||]4807'),
(572, 18, 'finger2', 95513, 0, 0, 0, '83141[||]4807'),
(573, 18, 'trinket1', 86336, 0, 0, 0, '[||]'),
(574, 18, 'trinket2', 94526, 0, 0, 0, '[||]'),
(575, 18, 'mainHand', 104732, 0, 0, 0, '76576[||]4444'),
(576, 18, 'offHand', 100168, 0, 0, 0, '[||]4434'),
(609, 37, 'head', 112832, 99206, 0, 0, '95346_76659[||]'),
(610, 37, 'neck', 112742, 103917, 0, 0, '[||]'),
(611, 37, 'shoulder', 99414, 99200, 0, 0, '76659_76659[||]4803'),
(612, 37, 'back', 102249, 102249, 0, 0, '76697[||]4424'),
(613, 37, 'chest', 99411, 103736, 0, 0, '76697_76697_76697[||]4419'),
(614, 37, 'wrist', 112420, 103740, 0, 0, '[||]4411'),
(615, 37, 'hands', 99412, 99198, 0, 0, '76697_76697[||]4432'),
(616, 37, 'waist', 104437, 98616, 0, 0, '76696_76636_76697[||]'),
(617, 37, 'legs', 99413, 99139, 0, 0, '76697_76697[||]4823'),
(618, 37, 'feet', 104482, 103878, 0, 0, '76697[||]4427'),
(619, 37, 'finger1', 104593, 103796, 0, 0, '76697[||]'),
(620, 37, 'finger2', 104440, 103798, 0, 0, '[||]'),
(621, 37, 'trinket1', 104862, 102298, 0, 0, '[||]'),
(622, 37, 'trinket2', 104495, 102295, 0, 0, '[||]'),
(623, 37, 'mainHand', 112785, 103649, 0, 0, '83146[||]4444'),
(624, 37, 'offHand', 104559, 0, 0, 0, '83146[||]4444'),
(1187, 1, 'wrist', 105524, 0, 0, 0, '[||]4414'),
(1186, 1, 'chest', 99344, 0, 0, 0, '76694_76694_76694[||]4419'),
(1185, 1, 'back', 102246, 0, 0, 0, '76694[||]4423'),
(1184, 1, 'shoulder', 99334, 0, 0, 0, '76694_76694[||]4915'),
(1183, 1, 'neck', 104477, 0, 0, 0, '[||]'),
(1182, 1, 'head', 99332, 0, 0, 0, '95347_76694[||]'),
(864, 7, 'head', 99122, 103939, 103751, 0, '95347_76681[||]'),
(865, 7, 'neck', 105764, 103882, 0, 0, '[||]'),
(866, 7, 'shoulder', 104501, 99120, 103755, 0, '76636_76636[||]4806'),
(867, 7, 'back', 102246, 102247, 0, 0, '76697[||]4423'),
(868, 7, 'chest', 99362, 104308, 103922, 0, '76681_76681_76681[||]4419'),
(869, 7, 'wrist', 105461, 103810, 103809, 0, '[||]4414'),
(870, 7, 'hands', 99121, 105169, 0, 0, '76681_76681[||]4430'),
(871, 7, 'waist', 112808, 103855, 0, 0, '76681_76697_76697[||]'),
(872, 7, 'legs', 99123, 99118, 0, 0, '76697_76697[||]4825'),
(873, 7, 'feet', 104443, 103806, 103904, 0, '76681[||]4427'),
(874, 7, 'finger1', 103823, 103772, 0, 0, '[||]'),
(875, 7, 'finger2', 103774, 105174, 0, 0, '76681[||]'),
(876, 7, 'trinket1', 102310, 102309, 0, 0, '[||]'),
(877, 7, 'trinket2', 112426, 102299, 102294, 0, '[||]'),
(878, 7, 'mainHand', 104598, 105226, 0, 0, '76681[||]4442'),
(879, 7, 'offHand', 104448, 0, 0, 0, '76636[||]4434'),
(927, 61, 'head', 99379, 99138, 103892, 103839, '76886_76693[||]'),
(928, 61, 'neck', 105766, 103916, 103917, 103883, '[||]'),
(929, 61, 'shoulder', 99132, 99132, 0, 103747, '76671_76671[||]4803'),
(930, 61, 'back', 102249, 103845, 0, 103799, '76693[||]4421'),
(931, 61, 'chest', 105412, 99136, 0, 103914, '76693_76699_76681[||]4419'),
(932, 61, 'wrist', 112733, 103738, 0, 103741, '[||]4415'),
(933, 61, 'hands', 99137, 99127, 0, 103790, '76693_76693[||]4431'),
(934, 61, 'waist', 112482, 103788, 0, 103933, '76693_76681_76693[||]'),
(935, 61, 'legs', 99139, 104311, 0, 0, '76700_76700[||]4823'),
(936, 61, 'feet', 112419, 103880, 103879, 103744, '76693[||]4429'),
(937, 61, 'finger1', 103794, 103794, 103798, 103894, '76693[||]'),
(938, 61, 'finger2', 112828, 103796, 103793, 103895, '76671[||]'),
(939, 61, 'trinket1', 102305, 102298, 102295, 102297, '[||]'),
(940, 61, 'trinket2', 112703, 102305, 0, 102306, '[||]'),
(941, 61, 'mainHand', 105692, 103968, 0, 103727, '76671_76671[||]4444'),
(1005, 5, 'offHand', 100170, 104654, 0, 0, '[||]4993'),
(1022, 64, 'head', 104413, 99348, 0, 0, '95346_76699[||]'),
(1023, 64, 'neck', 104411, 104411, 0, 0, '[||]'),
(1024, 64, 'shoulder', 99116, 99322, 0, 0, '83151_76666[||]4804'),
(1025, 64, 'back', 102248, 102248, 0, 0, '83151[||]4421'),
(1026, 64, 'chest', 99356, 99356, 0, 0, '76666_76666_76666[||]4419'),
(1027, 64, 'wrist', 104509, 104620, 0, 0, '[||]4416'),
(1028, 64, 'hands', 99355, 99355, 0, 0, '76666_76666[||]4431'),
(1029, 64, 'waist', 104532, 104532, 0, 0, '76666_76642_76699[||]'),
(1030, 64, 'legs', 99115, 99349, 0, 0, '76699_76699[||]4822'),
(1031, 64, 'feet', 104435, 104435, 0, 0, '76666[||]4428'),
(1032, 64, 'finger1', 103841, 104628, 0, 0, '76699[||]'),
(1033, 64, 'finger2', 103844, 104562, 0, 0, '76666[||]'),
(1034, 64, 'trinket1', 104974, 104476, 0, 0, '[||]'),
(1035, 64, 'trinket2', 102301, 104531, 0, 0, '[||]'),
(1036, 64, 'mainHand', 104434, 0, 0, 0, '76666[||]4444'),
(1037, 64, 'offHand', 104404, 0, 0, 0, '76666_76666[||]4444'),
(1054, 66, 'head', 99206, 0, 0, 0, '95346_76659[||]'),
(1055, 66, 'neck', 103917, 0, 0, 0, '[||]'),
(1056, 66, 'shoulder', 112481, 0, 0, 0, '76636_76636[||]4803'),
(1057, 66, 'back', 102249, 0, 0, 0, '76659[||]4100'),
(1058, 66, 'chest', 99411, 0, 0, 0, '76659_76659_76659[||]4419'),
(1059, 66, 'wrist', 112420, 0, 0, 0, '[||]4415'),
(1060, 66, 'hands', 113229, 0, 0, 0, '76697_76697[||]4432'),
(1061, 66, 'waist', 105338, 0, 0, 0, '76659_76697_76697[||]'),
(1062, 66, 'legs', 99413, 0, 0, 0, '76697_76697[||]4823'),
(1063, 66, 'feet', 105478, 0, 0, 0, '76659[||]4429'),
(1064, 66, 'finger1', 103798, 0, 0, 0, '76697[||]'),
(1065, 66, 'finger2', 103896, 0, 0, 0, '76659[||]'),
(1066, 66, 'trinket1', 112850, 0, 0, 0, '[||]'),
(1067, 66, 'trinket2', 112703, 0, 0, 0, '[||]'),
(1068, 66, 'mainHand', 105692, 0, 0, 0, '76659_76659[||]4444'),
(1069, 66, 'offHand', 112925, 0, 0, 0, '76659[||]4444'),
(1070, 66, 'head', 99206, 0, 0, 0, '95346_76659[||]'),
(1071, 66, 'neck', 103917, 0, 0, 0, '[||]'),
(1072, 66, 'shoulder', 112481, 0, 0, 0, '76636_76636[||]4803'),
(1073, 66, 'back', 102249, 0, 0, 0, '76659[||]4100'),
(1074, 66, 'chest', 99411, 0, 0, 0, '76659_76659_76659[||]4419'),
(1075, 66, 'wrist', 112420, 0, 0, 0, '[||]4415'),
(1076, 66, 'hands', 113229, 0, 0, 0, '76697_76697[||]4432'),
(1077, 66, 'waist', 105338, 0, 0, 0, '76659_76697_76697[||]'),
(1078, 66, 'legs', 99413, 0, 0, 0, '76697_76697[||]4823'),
(1079, 66, 'feet', 105478, 0, 0, 0, '76659[||]4429'),
(1080, 66, 'finger1', 103798, 0, 0, 0, '76697[||]'),
(1081, 66, 'finger2', 103896, 0, 0, 0, '76659[||]'),
(1082, 66, 'trinket1', 112850, 0, 0, 0, '[||]'),
(1083, 66, 'trinket2', 112703, 0, 0, 0, '[||]'),
(1084, 66, 'mainHand', 105692, 0, 0, 0, '76659_76659[||]4444'),
(1085, 66, 'offHand', 112925, 0, 0, 0, '76659[||]4444'),
(1086, 67, 'head', 104480, 0, 0, 0, '[||]'),
(1087, 67, 'neck', 104597, 0, 0, 0, '[||]'),
(1088, 67, 'shoulder', 99431, 0, 0, 0, '[||]'),
(1089, 67, 'back', 102247, 0, 0, 0, '[||]'),
(1090, 67, 'chest', 99430, 0, 0, 0, '[||]'),
(1091, 67, 'wrist', 104526, 0, 0, 0, '[||]'),
(1092, 67, 'hands', 104599, 0, 0, 0, '[||]'),
(1093, 67, 'waist', 104504, 0, 0, 0, '[||]'),
(1094, 67, 'legs', 99429, 0, 0, 0, '[||]'),
(1095, 67, 'feet', 104428, 0, 0, 0, '[||]'),
(1096, 67, 'finger1', 104427, 0, 0, 0, '[||]'),
(1097, 67, 'finger2', 104524, 0, 0, 0, '[||]'),
(1098, 67, 'trinket1', 112778, 0, 0, 0, '[||]'),
(1099, 67, 'trinket2', 104478, 0, 0, 0, '[||]'),
(1100, 67, 'mainHand', 105688, 0, 0, 0, '[||]'),
(1101, 67, 'offHand', 104448, 0, 0, 0, '[||]'),
(1102, 68, 'head', 96027, 96027, 0, 0, '[||]'),
(1103, 68, 'neck', 94803, 0, 0, 0, '[||]'),
(1104, 68, 'shoulder', 105797, 0, 0, 0, '[||]'),
(1105, 68, 'back', 102246, 0, 0, 0, '[||]'),
(1106, 68, 'chest', 105773, 0, 0, 0, '[||]'),
(1107, 68, 'wrist', 96060, 0, 0, 0, '[||]'),
(1108, 68, 'hands', 99160, 0, 0, 0, '[||]'),
(1109, 68, 'waist', 98612, 0, 0, 0, '[||]'),
(1110, 68, 'legs', 105757, 0, 0, 0, '[||]'),
(1111, 68, 'feet', 104692, 0, 0, 0, '[||]'),
(1112, 68, 'finger1', 95512, 0, 0, 0, '[||]'),
(1113, 68, 'finger2', 95138, 0, 0, 0, '[||]'),
(1114, 68, 'trinket1', 94521, 0, 0, 0, '[||]'),
(1115, 68, 'trinket2', 96144, 0, 0, 0, '[||]'),
(1116, 68, 'mainHand', 104728, 0, 0, 0, '[||]'),
(1117, 68, 'offHand', 0, 0, 0, 0, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;