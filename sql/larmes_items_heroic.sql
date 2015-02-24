-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 23 Février 2015 à 15:47
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `bd_flo`
--

-- --------------------------------------------------------

--
-- Structure de la table `larmes_items_heroic`
--

CREATE TABLE IF NOT EXISTS `larmes_items_heroic` (
  `id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `icon` text NOT NULL,
  `inventoryType` smallint(6) NOT NULL,
  `itemClass` smallint(6) NOT NULL,
  `itemSubClass` smallint(6) NOT NULL,
  `itemLevel` int(11) NOT NULL,
  `quality` smallint(6) NOT NULL,
  `armor` int(11) NOT NULL,
  `itemSource` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `larmes_items_heroic`
--

INSERT INTO `larmes_items_heroic` (`id`, `name`, `icon`, `inventoryType`, `itemClass`, `itemSubClass`, `itemLevel`, `quality`, `armor`, `itemSource`) VALUES
(113863, 'Couronne en peau de gronn', 'inv_helm_mail_raidshaman_o_01', 1, 4, 3, 680, 4, 185, 0),
(113864, 'Escaladeurs de troglodyte', 'inv_boot_cloth_raidpriest_o_01', 8, 4, 1, 680, 4, 86, 0),
(113865, 'Collier de sombre lumière', 'inv_6_0raid_necklace_4d', 2, 4, 0, 680, 4, 0, 0),
(113866, 'Sceau phosphorescent', 'inv_ringwod_d3_1', 11, 4, 0, 680, 4, 0, 0),
(113867, 'Spallières de pierre réfléchie', 'inv_shoulder_mail_raidhunter_o_01', 3, 4, 3, 680, 4, 171, 0),
(113868, 'Chaperon aux yeux flamboyants', 'inv_helm_cloth_raidmage_o_01', 1, 4, 1, 680, 4, 101, 0),
(113869, 'Bâton de flammes infernales', 'inv_staff_2h_draenorraid_d_02', 17, 2, 10, 680, 4, 0, 0),
(113870, 'Gilet de fureur énergique', 'inv_leather_raiddruid_o_01chest', 5, 4, 2, 680, 4, 173, 0),
(113871, 'Brassards de perfection martiale', 'inv_bracer_plate_raidpaladin_o_01', 9, 4, 4, 680, 4, 159, 0),
(113872, 'Anneau labial de Gruul', 'inv_6_0raid_necklace_1d', 2, 4, 0, 680, 4, 0, 0),
(113873, 'Grande cape cousue de gronn', 'inv_cape_draenorraid_d_01plate_dk', 16, 4, 1, 680, 4, 165, 0),
(113874, 'Arrache-tripes marqué à l?acide de Mangeroc', 'inv_knife_1h_draenorraid_d_02', 13, 2, 15, 680, 4, 0, 0),
(113875, 'Garde-jambes anti-corrosion', 'inv_pant_mail_raidhunter_o_01', 7, 4, 3, 680, 4, 199, 0),
(113876, 'Poignes de casse-dent', 'inv_glove_cloth_raidpriest_o_01', 10, 4, 1, 680, 4, 78, 0),
(113877, 'Eclat explosif intact', 'inv_ringwod_d2_4', 11, 4, 0, 680, 4, 0, 0),
(113878, 'Cape esquive-barrages', 'inv_cape_draenorraid_d_01caster_purple', 16, 4, 1, 680, 4, 62, 0),
(113879, 'Limon vivant en cage', 'inv_offhand_1h_draenorraid_d_01', 23, 4, 0, 680, 4, 0, 0),
(113880, 'Mâchoires acides', 'inv_leather_raidrogue_o_01helm', 1, 4, 2, 680, 4, 141, 0),
(113881, 'Cuirasse de fureur déferlante', 'inv_plate_raiddeathknight_o_01chest', 5, 4, 4, 680, 4, 363, 0),
(113882, 'Fichu de Glouton', 'inv_6_0raid_necklace_1b', 2, 4, 0, 680, 4, 104, 0),
(113883, 'Grande cape vorace', 'inv_cape_draenorraid_d_01plate_warrior', 16, 4, 1, 680, 4, 152, 0),
(113884, 'Plaques d?épaule de scorie instable', 'inv_plate_raidwarrior_o_01shoulders', 3, 4, 4, 680, 4, 272, 0),
(113885, 'Bouche de la fureur', 'inv_bow_2h_crossbow_draenorraid_d_01', 26, 2, 18, 680, 4, 0, 0),
(113886, 'Croissant de magma vivant', 'inv_axe_2h_draenorraid_d_01', 17, 2, 1, 680, 4, 0, 0),
(113887, 'Brassards d?acier maculé', 'inv_bracer_cloth_raidpriest_o_01', 9, 4, 1, 680, 4, 55, 0),
(113888, 'Bottines d?écraseur de scories', 'inv_boot_mail_raidhunter_o_01', 8, 4, 3, 680, 4, 156, 0),
(113889, 'Talisman protecteur de l?élémentaliste', 'inv_misc_trinket6oih_ironskull2', 12, 4, 0, 680, 4, 0, 0),
(113890, 'Sautoir de contrôle de Feldspath', 'inv_6_0raid_necklace_2b', 2, 4, 0, 680, 4, 0, 0),
(113891, 'Capuche résistante aux explosions', 'inv_helm_mail_raidshaman_o_01', 1, 4, 3, 680, 4, 185, 0),
(113892, 'Gorgerin de conduction d?ingénieur', 'inv_6_0raid_necklace_1c', 2, 4, 0, 680, 4, 0, 0),
(113893, 'Porte du haut fourneau', 'inv_misc_trinket6oih_ironskull1', 12, 4, 0, 680, 4, 253, 0),
(113894, 'Grand heaume trempé dans la lave', 'inv_plate_raidwarrior_o_01helm', 1, 4, 4, 680, 4, 295, 0),
(113895, 'Bottines de gardien de fourneau', 'inv_leather_raidmonk_o_01boot', 8, 4, 2, 680, 4, 119, 0),
(113896, 'Brassards de fondeur de chair', 'inv_plate_raiddeathknight_o_01bracer', 9, 4, 4, 680, 4, 159, 0),
(113897, 'Marteau de forge de Hans?gar', 'inv_mace_1h_draenorraid_d_02', 13, 2, 4, 680, 4, 0, 0),
(113898, 'Robe dorée tape-à-l??il', 'inv_robe_cloth_raidmage_o_01', 20, 4, 1, 680, 4, 125, 0),
(113899, 'Garde-épaules de casse-cou', 'inv_shoulder_mail_raidshaman_o_01', 3, 4, 3, 680, 4, 171, 0),
(113900, 'Protège-vertèbres', 'inv_6_0raid_necklace_2d', 2, 4, 0, 680, 4, 0, 0),
(113901, 'Bague aux six yeux', 'inv_ringwod_d_2', 11, 4, 0, 680, 4, 0, 0),
(113902, 'Corselet des rugissements interminables', 'inv_chest_mail_raidhunter_o_01', 5, 4, 3, 680, 4, 227, 0),
(113903, 'Siphons géants', 'inv_shoulder_cloth_raidpriest_o_01', 3, 4, 1, 680, 4, 94, 0),
(113904, 'Pilonne-tête de Franzok', 'inv_mace_1h_draenorraid_d_04purple', 21, 2, 4, 680, 4, 0, 0),
(113905, 'Tablette du tendeur tactique', 'inv_misc_trinket6oih_orb4', 12, 4, 0, 680, 4, 0, 0),
(113906, 'Gantelets des coups spectaculaires', 'inv_plate_raiddeathknight_o_01glove', 10, 4, 4, 680, 4, 227, 0),
(113907, 'Ceinturon de gloire insoumise', 'inv_leather_raidmonk_o_01belt', 6, 4, 2, 680, 4, 97, 0),
(113908, 'Anneau des lames tranchantes', 'inv_ringwod_d2_1', 11, 4, 0, 680, 4, 81, 0),
(113913, 'Lame-Ardente de Ka?graz', 'inv_sword_2h_draenorraid_d_01', 17, 2, 8, 680, 4, 0, 0),
(113914, 'Jambières du torrent de lave', 'inv_pant_cloth_raidmage_o_01', 7, 4, 1, 680, 4, 109, 0),
(113915, 'Poignes ravivantes', 'inv_glove_mail_raidshaman_o_01', 10, 4, 3, 680, 4, 142, 0),
(113916, 'Cape de feu du souffle calcinant', 'inv_cape_draenorraid_d_01plate_warrior', 16, 4, 1, 680, 4, 62, 0),
(113917, 'Chevalière du loup de braise', 'inv_ringwod_d5_3', 11, 4, 0, 680, 4, 0, 0),
(113918, 'Eviscérateur au tranchant de lave', 'inv_knife_1h_draenorraid_d_03', 13, 2, 15, 680, 4, 0, 0),
(113919, 'Bottines des flammes ravivées', 'inv_boot_mail_raidhunter_o_01', 8, 4, 3, 680, 4, 156, 0),
(113920, 'Dague de la radiance flamboyante', 'inv_knife_1h_draenorraid_d_03', 21, 2, 15, 680, 4, 0, 0),
(113921, 'Cuissards tempête-de-feu', 'inv_plate_raidwarrior_o_01pants', 7, 4, 4, 680, 4, 317, 0),
(113922, 'Sceau de la flamme inextinguible', 'inv_ringwod_d5_1', 11, 4, 0, 680, 4, 104, 0),
(113923, 'Liens ardents de courage', 'inv_6_0raid_necklace_3a', 2, 4, 0, 680, 4, 100, 0),
(113924, 'Garde-épaules de courbe-flamme', 'inv_leather_raidmonk_o_01shoulders', 3, 4, 2, 680, 4, 130, 0),
(113925, 'Gantelets de la fureur de flamme', 'inv_plate_raidwarrior_o_01gloves', 10, 4, 4, 680, 4, 227, 0),
(113926, 'Paume protectrice de Kromog', 'inv_shield_draenorraid_d_01', 14, 4, 6, 680, 4, 779, 0),
(113927, 'Poing brutal de Kromog', 'inv_mace_1h_draenorraid_d_01', 13, 2, 4, 680, 4, 0, 0),
(113928, 'Protège-épaules de houle terrestre', 'inv_cloth_raidwarlock_o_01shoulder', 3, 4, 1, 680, 4, 94, 0),
(113929, 'Cape des secrets enfouis', 'inv_cape_draenorraid_d_01leather_rogue', 16, 4, 1, 680, 4, 62, 0),
(113930, 'Ceinturon de prise-terre', 'inv_belt_mail_raidshaman_o_01', 6, 4, 3, 680, 4, 128, 0),
(113931, 'C?ur palpitant de la montagne', 'inv_misc_trinket6oih_lanternb3', 12, 4, 0, 680, 4, 0, 0),
(113932, 'Talisman des fomoires', 'inv_6_0raid_necklace_1a', 2, 4, 0, 680, 4, 0, 0),
(113933, 'Protège-mains de courbe-pierre', 'inv_glove_cloth_raidmage_o_01', 10, 4, 1, 680, 4, 78, 0),
(113934, 'Croc de la Terre', 'inv_sword_1h_draenorraid_d_03blue', 21, 2, 7, 680, 4, 0, 0),
(113935, 'Brassards des stalactites brisées', 'inv_leather_raidmonk_o_01bracer', 9, 4, 2, 680, 4, 76, 0),
(113936, 'Solerets de la terre fractale', 'inv_plate_raiddeathknight_o_01boot', 8, 4, 4, 680, 4, 249, 0),
(113937, 'Grande cape de la frénésie runique', 'inv_cape_draenorraid_d_01caster_blue', 16, 4, 1, 680, 4, 62, 0),
(113938, 'Bague de Poing-de-pierre', 'inv_ringwod_d_1', 11, 4, 0, 680, 4, 95, 0),
(113939, 'Tal?rak, crâne sanglant des Sire-Tonnerre', 'inv_polearm_2h_thunderlordclan_b_01', 17, 2, 6, 680, 4, 0, 0),
(113940, 'Sceau du hurlement bestial', 'inv_ringwod_d2_1', 11, 4, 0, 680, 4, 0, 0),
(113941, 'Ceinturon de braises chercheuses', 'inv_cloth_raidwarlock_o_01belt', 6, 4, 1, 680, 4, 70, 0),
(113942, 'Sandales du souffle infernal', 'inv_boot_cloth_raidmage_o_01', 8, 4, 1, 680, 4, 86, 0),
(113943, 'Brassards de la ruse du loup', 'inv_bracer_mail_raidhunter_o_01', 9, 4, 3, 680, 4, 100, 0),
(113944, 'Garde-jambes de la ruée', 'inv_pant_mail_raidshaman_o_01', 7, 4, 3, 680, 4, 199, 0),
(113945, 'Drapé de l?infusion de flammes', 'inv_cape_draenorraid_d_01leather_monk', 16, 4, 1, 680, 4, 62, 0),
(113946, 'C?ur du sabot-fourchu', 'inv_shield_draenorraid_d_04', 14, 4, 6, 680, 4, 779, 0),
(113947, 'Jonc de l?épicentre', 'inv_ringwod_d2_3', 11, 4, 0, 680, 4, 0, 0),
(113948, 'Talisman instable de Darmac', 'inv_misc_trinket6oih_orb2', 12, 4, 0, 680, 4, 0, 0),
(113949, 'Poignes de chargeur de boulet', 'inv_leather_raidmonk_o_01glove', 10, 4, 2, 680, 4, 108, 0),
(113950, 'Collier d?Ecrase-Fer', 'inv_plate_raiddeathknight_o_01buckle', 6, 4, 4, 680, 4, 204, 0),
(113951, 'Robe indéchirable en peau de loup', 'inv_leather_raidrogue_o_01chest', 5, 4, 2, 680, 4, 173, 0),
(113952, 'Sautoir de force bestiale', 'inv_6_0raid_necklace_2d', 2, 4, 0, 680, 4, 114, 0),
(113953, 'Bâtonnet de contrôle de Thogar', 'ivn_polearm_2h_draenorraid_d_01', 17, 2, 6, 680, 4, 0, 0),
(113954, 'Bottes ligaturées de marche-rail', 'inv_boot_mail_raidshaman_o_01', 8, 4, 3, 680, 4, 156, 0),
(113955, 'Ceinture de grenadier', 'inv_belt_mail_raidhunter_o_01', 6, 4, 3, 680, 4, 128, 0),
(113956, 'Brassards de puissance embrasée', 'inv_cloth_raidwarlock_o_01bracer', 9, 4, 1, 680, 4, 55, 0),
(113957, 'Chevalière fumante de garde-feu', 'inv_ringwod_d5_2', 11, 4, 0, 680, 4, 0, 0),
(113958, 'Robe de la blessure cautérisée', 'inv_robe_cloth_raidpriest_o_01', 20, 4, 1, 680, 4, 125, 0),
(113959, 'Chaîne dentelée de Thogar', 'inv_6_0raid_necklace_4c', 2, 4, 0, 680, 4, 0, 0),
(113960, 'Lanterne de chauffeur de chaudière', 'inv_offhand_1h_draenorraid_d_03', 23, 4, 0, 680, 4, 0, 0),
(113961, 'Solerets du soufflet de fer', 'inv_plate_raidwarrior_o_01boots', 8, 4, 4, 680, 4, 249, 0),
(113962, 'Brassards électroplaqués d?écuyer', 'inv_leather_raiddruid_o_01bracer', 9, 4, 2, 680, 4, 76, 0),
(113963, 'Bague du bombardier de siège', 'inv_ringwod_d4_1', 11, 4, 0, 680, 4, 78, 0),
(113964, 'Ceinturon porte-outils de conducteur', 'inv_leather_raidrogue_o_01buckle', 6, 4, 2, 680, 4, 97, 0),
(113965, 'Chaîne de poing de Sorka', 'inv_hand_1h_draenorraid_d_03', 13, 2, 13, 680, 4, 0, 0),
(113966, 'Jette-lance brutal de Gar?an', 'inv_firearm_2h_rifle_draenorraid_d_01', 26, 2, 3, 680, 4, 0, 0),
(113967, 'Ceinture de matelot en corde', 'inv_belt_cloth_raidmage_o_01', 6, 4, 1, 680, 4, 70, 0),
(113968, 'Brassards du tourbillon sanglant', 'inv_bracer_mail_raidshaman_o_01', 9, 4, 3, 680, 4, 100, 0),
(113969, 'Fiole d?ombres convulsives', 'inv_misc_trinket6oih_horn1', 12, 4, 0, 680, 4, 0, 0),
(113970, 'Jambards de mécanicien de tourelle', 'inv_cloth_raidwarlock_o_01pants', 7, 4, 1, 680, 4, 109, 0),
(113971, 'Drapé de chasse de l?ombre', 'inv_cape_draenorraid_d_02_mail_blue', 16, 4, 1, 680, 4, 62, 0),
(113972, 'Cape de la terreur sanguine', 'inv_cape_draenorraid_d_01plate_dk', 16, 4, 1, 680, 4, 62, 0),
(113973, 'Koloch?na, le festin sanglant', 'inv_axe_1h_draenorraid_d_03', 21, 2, 0, 680, 4, 0, 0),
(113974, 'Bottines de chasse de l?ombre', 'inv_leather_raidrogue_o_01boot', 8, 4, 2, 680, 4, 119, 0),
(113975, 'Sceau corrompu d?Uk?urogg', 'inv_ringwod_d4_2', 11, 4, 0, 680, 4, 0, 0),
(113976, 'Ceinture aux anneaux carillonnants d?Uktar', 'inv_belt_plate_raidpaladin_o_01', 6, 4, 4, 680, 4, 204, 0),
(113977, 'Protège-c?ur imprégné de sang', 'inv_plate_raidwarrior_o_01chest', 5, 4, 4, 680, 4, 363, 0),
(113978, 'Capuche de belladone de Sorka', 'inv_leather_raiddruid_o_01helm', 1, 4, 2, 680, 4, 141, 0),
(113979, 'La Main-Noire', 'inv_mace_2h_draenorraid_d_02_blackhand', 17, 2, 5, 680, 4, 0, 0),
(113980, 'Sabre de soldat de Fer', 'inv_sword_1h_draenorraid_d_02', 13, 2, 7, 680, 4, 0, 0),
(113981, 'Chaperon de bombardier de scories', 'inv_cloth_raidwarlock_o_01helm', 1, 4, 1, 680, 4, 101, 0),
(113982, 'Corselet de l?assiégeur', 'inv_chest_mail_raidshaman_o_01', 5, 4, 3, 680, 4, 227, 0),
(113983, 'Insigne de maître-forge', 'inv_hammer_07', 12, 4, 0, 680, 4, 0, 0),
(113984, 'Micro-creuset en noirfer', 'inv_misc_trinket6oih_orb1', 12, 4, 0, 680, 4, 0, 0),
(113985, 'Gâchette en noirfer frémissante', 'inv_misc_trinket6oih_clefthoof2', 12, 4, 0, 680, 4, 0, 0),
(113986, 'Autoclave à réparation automatique', 'inv_misc_trinket6oih_orb3', 12, 4, 0, 680, 4, 0, 0),
(113987, 'Talisman ravageur', 'inv_misc_trinket6oih_lanternb1', 12, 4, 0, 680, 4, 0, 0),
(113988, 'Bâton du destin de Main-Noire', 'inv_staff_2h_draenorraid_d_04', 17, 2, 10, 680, 4, 0, 0),
(113989, 'Jambières de frappe fracassante', 'inv_leather_raidmonk_o_01pant', 7, 4, 2, 680, 4, 151, 0),
(113990, 'Spallières surmultipliées', 'inv_shoulder_plate_raidpaladin_o_01', 3, 4, 4, 680, 4, 272, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
