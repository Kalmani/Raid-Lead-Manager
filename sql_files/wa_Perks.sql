-- phpMyAdmin SQL Dump
-- version 4.1.14.6
-- http://www.phpmyadmin.net
--
-- Client :  db410250125.db.1and1.com
-- Généré le :  Jeu 27 Novembre 2014 à 19:53
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
-- Structure de la table `wa_Perks`
--

CREATE TABLE IF NOT EXISTS `wa_Perks` (
  `ObjectID` varchar(50) NOT NULL,
  `Data` longblob NOT NULL,
  `Part` int(11) NOT NULL,
  `Timestamp` varchar(75) NOT NULL,
  PRIMARY KEY (`ObjectID`,`Part`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `wa_Perks`
--

INSERT INTO `wa_Perks` (`ObjectID`, `Data`, `Part`, `Timestamp`) VALUES
('7b65f49874fa77688d58d8a31846f3c5', 0x7b227065726b73223a5b7b226775696c644c6576656c223a312c227370656c6c223a7b226964223a37383633332c226e616d65223a224d6f756e74205570222c2273756274657874223a224775696c64205065726b222c2269636f6e223a22616368696576656d656e745f6775696c647065726b5f6d6f756e747570222c226465736372697074696f6e223a22496e63726561736573207370656564207768696c65206d6f756e746564206279203130252e20204e6f742061637469766520696e20426174746c6567726f756e6473206f72204172656e61732e222c226361737454696d65223a2250617373697665227d7d2c7b226775696c644c6576656c223a312c227370656c6c223a7b226964223a38333934342c226e616d65223a22486173747920486561727468222c2273756274657874223a224775696c64205065726b222c2269636f6e223a22616368696576656d656e745f6775696c647065726b5f6861737479686561727468222c226465736372697074696f6e223a22526564756365732074686520636f6f6c646f776e206f6e20796f75722048656172746873746f6e65206279203135206d696e757465732e222c226361737454696d65223a2250617373697665227d7d2c7b226775696c644c6576656c223a312c227370656c6c223a7b226964223a38333936382c226e616d65223a224d61737320526573757272656374696f6e222c2273756274657874223a224775696c64205065726b222c2269636f6e223a22616368696576656d656e745f6775696c647065726b5f6d617373726573757272656374696f6e222c226465736372697074696f6e223a224272696e677320616c6c206465616420706172747920616e642072616964206d656d62657273206261636b20746f206c696665207769746820333525206865616c746820616e6420333525206d616e612e20204120706c61796572206d6179206f6e6c792062652072657375727265637465642062792074686973207370656c6c206f6e6365206576657279203130206d696e757465732e202043616e6e6f74206265206361737420696e20636f6d626174206f72207768696c6520696e206120626174746c6567726f756e64206f72206172656e612e222c2272616e6765223a223130302079642072616e6765222c226361737454696d65223a223130207365632063617374227d7d2c7b226775696c644c6576656c223a312c227370656c6c223a7b226964223a38333935302c226e616d65223a2254686520517569636b20616e64207468652044656164222c2273756274657874223a224775696c64205065726b222c2269636f6e223a22616368696576656d656e745f6775696c647065726b5f717569636b616e6464656164222c226465736372697074696f6e223a22496e63726561736573206865616c7468206761696e6564207768656e2072657375727265637465642062792035302520616e6420696e63726561736573206d6f76656d656e74207370656564207768696c652064656164206279203130252e2020446f6573206e6f742066756e6374696f6e20696e20636f6d626174206f72207768696c6520696e206120426174746c6567726f756e64206f72204172656e612e222c226361737454696d65223a2250617373697665227d7d2c7b226775696c644c6576656c223a312c227370656c6c223a7b226964223a38333935312c226e616d65223a224775696c64204d61696c222c2273756274657874223a224775696c64205065726b222c2269636f6e223a22616368696576656d656e745f6775696c647065726b5f676d61696c222c226465736372697074696f6e223a22496e2d67616d65206d61696c2073656e74206265747765656e206775696c64206d656d62657273206e6f77206172726976657320696e7374616e746c792e222c226361737454696d65223a2250617373697665227d7d2c7b226775696c644c6576656c223a312c227370656c6c223a7b226964223a38333935382c226e616d65223a224d6f62696c652042616e6b696e67222c2273756274657874223a224775696c64205065726b222c2269636f6e223a22616368696576656d656e745f6775696c647065726b5f6d6f62696c6562616e6b696e67222c226465736372697074696f6e223a2253756d6d6f6e732061204775696c64204368657374207468617420616c6c6f77732061636365737320746f20796f7572206775696c642062616e6b20666f722035206d696e2e20204f6e6c79206775696c64206d656d626572732077697468206775696c642072657075746174696f6e206f6620667269656e646c7920616e642061626f76652061726520616c6c6f77656420746f207573652061204775696c642043686573742e222c226361737454696d65223a2233207365632063617374222c22636f6f6c646f776e223a223630206d696e20636f6f6c646f776e227d7d5d7d, 0, '1415843856'),
('1cf1ff2ee723e7faf3f30979ac8917c8', 0x7b227065726b73223a5b7b226775696c644c6576656c223a312c227370656c6c223a7b226964223a37383633332c226e616d65223a224d6f756e74205570222c2273756274657874223a224775696c64205065726b222c2269636f6e223a22616368696576656d656e745f6775696c647065726b5f6d6f756e747570222c226465736372697074696f6e223a22496e63726561736573207370656564207768696c65206d6f756e746564206279203130252e20204e6f742061637469766520696e20426174746c6567726f756e6473206f72204172656e61732e222c226361737454696d65223a2250617373697665227d7d2c7b226775696c644c6576656c223a312c227370656c6c223a7b226964223a38333934342c226e616d65223a22486173747920486561727468222c2273756274657874223a224775696c64205065726b222c2269636f6e223a22616368696576656d656e745f6775696c647065726b5f6861737479686561727468222c226465736372697074696f6e223a22526564756365732074686520636f6f6c646f776e206f6e20796f75722048656172746873746f6e65206279203135206d696e757465732e222c226361737454696d65223a2250617373697665227d7d2c7b226775696c644c6576656c223a312c227370656c6c223a7b226964223a38333936382c226e616d65223a224d61737320526573757272656374696f6e222c2273756274657874223a224775696c64205065726b222c2269636f6e223a22616368696576656d656e745f6775696c647065726b5f6d617373726573757272656374696f6e222c226465736372697074696f6e223a224272696e677320616c6c206465616420706172747920616e642072616964206d656d62657273206261636b20746f206c696665207769746820333525206865616c746820616e6420333525206d616e612e20204120706c61796572206d6179206f6e6c792062652072657375727265637465642062792074686973207370656c6c206f6e6365206576657279203130206d696e757465732e202043616e6e6f74206265206361737420696e20636f6d626174206f72207768696c6520696e206120626174746c6567726f756e64206f72206172656e612e222c2272616e6765223a223130302079642072616e6765222c226361737454696d65223a223130207365632063617374227d7d2c7b226775696c644c6576656c223a312c227370656c6c223a7b226964223a38333935302c226e616d65223a2254686520517569636b20616e64207468652044656164222c2273756274657874223a224775696c64205065726b222c2269636f6e223a22616368696576656d656e745f6775696c647065726b5f717569636b616e6464656164222c226465736372697074696f6e223a22496e63726561736573206865616c7468206761696e6564207768656e2072657375727265637465642062792035302520616e6420696e63726561736573206d6f76656d656e74207370656564207768696c652064656164206279203130252e2020446f6573206e6f742066756e6374696f6e20696e20636f6d626174206f72207768696c6520696e206120426174746c6567726f756e64206f72204172656e612e222c226361737454696d65223a2250617373697665227d7d2c7b226775696c644c6576656c223a312c227370656c6c223a7b226964223a38333935312c226e616d65223a224775696c64204d61696c222c2273756274657874223a224775696c64205065726b222c2269636f6e223a22616368696576656d656e745f6775696c647065726b5f676d61696c222c226465736372697074696f6e223a22496e2d67616d65206d61696c2073656e74206265747765656e206775696c64206d656d62657273206e6f77206172726976657320696e7374616e746c792e222c226361737454696d65223a2250617373697665227d7d2c7b226775696c644c6576656c223a312c227370656c6c223a7b226964223a38333935382c226e616d65223a224d6f62696c652042616e6b696e67222c2273756274657874223a224775696c64205065726b222c2269636f6e223a22616368696576656d656e745f6775696c647065726b5f6d6f62696c6562616e6b696e67222c226465736372697074696f6e223a2253756d6d6f6e732061204775696c64204368657374207468617420616c6c6f77732061636365737320746f20796f7572206775696c642062616e6b20666f722035206d696e2e20204f6e6c79206775696c64206d656d626572732077697468206775696c642072657075746174696f6e206f6620667269656e646c7920616e642061626f76652061726520616c6c6f77656420746f207573652061204775696c642043686573742e222c226361737454696d65223a2233207365632063617374222c22636f6f6c646f776e223a223630206d696e20636f6f6c646f776e227d7d5d7d, 0, '1415900459');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;