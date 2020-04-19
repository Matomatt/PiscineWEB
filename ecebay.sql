-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 19, 2020 at 02:23 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecebay`
--

-- --------------------------------------------------------

--
-- Table structure for table `acheteurs`
--

DROP TABLE IF EXISTS `acheteurs`;
CREATE TABLE IF NOT EXISTS `acheteurs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` tinytext NOT NULL,
  `Password` tinytext NOT NULL,
  `Nom` tinytext NOT NULL,
  `Prenom` tinytext NOT NULL,
  `ID_Adresse` int(11) NOT NULL,
  `ID_Solde` int(11) NOT NULL,
  `Photo` tinytext NOT NULL,
  `Telephone` tinytext NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_Adresse` (`ID_Adresse`),
  UNIQUE KEY `ID_Solde` (`ID_Solde`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acheteurs`
--

INSERT INTO `acheteurs` (`ID`, `Email`, `Password`, `Nom`, `Prenom`, `ID_Adresse`, `ID_Solde`, `Photo`, `Telephone`) VALUES
(1, 'jeanjean3645@gmail.com', 'poney02', 'Jean', 'Michel', 1, 0, '', '0729864531');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` tinytext NOT NULL,
  `Password` tinytext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `Email`, `Password`) VALUES
(1, 'admin@admin.root', 'adminpw');

-- --------------------------------------------------------

--
-- Table structure for table `adresses`
--

DROP TABLE IF EXISTS `adresses`;
CREATE TABLE IF NOT EXISTS `adresses` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` tinytext NOT NULL,
  `Adresse_ligne_1` text NOT NULL,
  `Adresse_ligne_2` text NOT NULL,
  `Ville` tinytext NOT NULL,
  `Code_postale` tinytext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Pays` tinytext NOT NULL,
  `Telephone` tinytext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adresses`
--

INSERT INTO `adresses` (`ID`, `Nom`, `Adresse_ligne_1`, `Adresse_ligne_2`, `Ville`, `Code_postale`, `Pays`, `Telephone`) VALUES
(1, 'Jean', '3 rue des iseau', '', 'Morain', '59864', 'France', '0729864531'),
(2, 'Antine', '5 boulevard maréchale', '', 'Gué-doux', '68445', 'France', '0698547897'),
(4, 'Le miro', 'Le-Plessi', '', 'Vigagne', '64458', 'France', '0689474826');

-- --------------------------------------------------------

--
-- Table structure for table `carte_bancaires`
--

DROP TABLE IF EXISTS `carte_bancaires`;
CREATE TABLE IF NOT EXISTS `carte_bancaires` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Acheteur` int(11) NOT NULL,
  `Nom` tinytext NOT NULL,
  `Numero` tinytext NOT NULL,
  `Annee_exp` int(11) NOT NULL,
  `Mois_exp` int(11) NOT NULL,
  `Code` tinytext NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_Acheteur` (`ID_Acheteur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `ID` tinytext NOT NULL,
  `Nom` tinytext NOT NULL,
  PRIMARY KEY (`ID`(11))
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Nom`) VALUES
('FerOuTres', 'Ferraille ou trésor'),
('BonMusee', 'Bon pour le musée'),
('AccesVIP', 'Accessoires VIP'),
('CategorieCool', 'Ca c\'est trop cool');

-- --------------------------------------------------------

--
-- Table structure for table `demandes_vendeur`
--

DROP TABLE IF EXISTS `demandes_vendeur`;
CREATE TABLE IF NOT EXISTS `demandes_vendeur` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` tinytext NOT NULL,
  `Password` tinytext NOT NULL,
  `Nom` tinytext NOT NULL,
  `Prenom` tinytext NOT NULL,
  `Boutique` tinytext NOT NULL,
  `ID_Adresse` int(11) NOT NULL,
  `Telephone` tinytext NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_Adresse` (`ID_Adresse`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `encheres`
--

DROP TABLE IF EXISTS `encheres`;
CREATE TABLE IF NOT EXISTS `encheres` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Item` int(11) NOT NULL,
  `ID_Acheteur` int(11) NOT NULL,
  `Prix_Max` double NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `encheres`
--

INSERT INTO `encheres` (`ID`, `ID_Item`, `ID_Acheteur`, `Prix_Max`, `Date`) VALUES
(40, 9, 1, 63, '2020-04-18 20:52:36'),
(38, 8, 1, 45, '2020-04-18 19:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Vendeur` int(11) NOT NULL,
  `Nom` tinytext NOT NULL,
  `Prix` double NOT NULL,
  `Prix_Encheres` double NOT NULL,
  `Prix_depart_encheres` double NOT NULL,
  `Description` longtext NOT NULL,
  `Categorie` tinytext NOT NULL,
  `Etat` tinytext NOT NULL,
  `Marque` tinytext NOT NULL,
  `Type_de_vente_1` tinytext NOT NULL,
  `Type_de_vente_2` tinytext NOT NULL,
  `Date_MEV` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Quantite` int(11) NOT NULL,
  `Type_livraison` tinytext NOT NULL,
  `Frais_de_port` double NOT NULL,
  `Vendu` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ID`, `ID_Vendeur`, `Nom`, `Prix`, `Prix_Encheres`, `Prix_depart_encheres`, `Description`, `Categorie`, `Etat`, `Marque`, `Type_de_vente_1`, `Type_de_vente_2`, `Date_MEV`, `Quantite`, `Type_livraison`, `Frais_de_port`, `Vendu`) VALUES
(1, 1, 'Pièce', 23.99, 0, 0, 'C\'est une pièce de fort bonne qualité.', 'FerOuTres', '', '', 'achat_imm', 'offres', '2020-04-14 12:43:09', 3, '', 0, 0),
(9, 1, 'Ravissant vase forme navette signature à identifier !', 0, 63, 60, '<p>Ravissant vase forme navette.\r\n\r\nHauteur : 14cm\r\n\r\nPlus de photos ou d\'infos sur demande\r\n\r\nEnvoi en colis bien protégé avec suivi de commande</p>', 'BonMusee', 'neuf', '', 'encheres', '', '2020-04-10 11:52:08', 1, '', 0, 0),
(8, 1, 'Masque coréen', 80, 45, 40, '<p>Un superbe masque traditionnel du village hahoe.</p>', 'BonMusee', 'neuf', '', 'achat_imm', 'encheres', '2020-04-18 12:57:18', 1, '', 0, 0),
(12, 1, 'Tableau HST d\'après Claude Monet \" la femme  l\'ombrelle\" 54,5 x 66,5 cm', 300, 0, 0, '<p>Tableau huile sur toile d&#39;apr&egrave;s l&#39;oeuvre de Claude Monet &quot;La Femme &agrave;&nbsp; l&#39;ombrelle&quot; tournez &agrave; droite 54,5 x 66,5 cm</p>', 'BonMusee', 'neuf', '', 'achat_imm', '', '2020-04-18 19:46:38', 1, '', 0, 0),
(13, 1, 'Ancienne épée d\'escrime', 55, 0, 0, '<p><strong>Ancienne &eacute;p&eacute;e&nbsp;escrime longueur 1m 05</strong></p><p>&nbsp;</p><p>Mati&egrave;re:Bronze</p><p>Type:Objet de m&eacute;tier</p><p>Authenticit&eacute;:Original</p><p>Origine:France</p>', 'BonMusee', 'neuf', '', 'offres', '', '2020-04-18 23:46:56', 1, '', 0, 0),
(14, 2, 'Bouddha Ancien Laqué Rouge Chine Antique Buddha Chinese China', 299, 200, 200, '<p>Bouddha Ancien Laqu&eacute; Rouge Chine Antique Buddha Chinese China</p><p>Dimensions totale avec socle : 11 cm * 8 cm</p>', 'BonMusee', 'use', '', 'achat_imm', 'encheres', '2020-04-19 12:30:06', 1, 'Colissimo', 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `medias`
--

DROP TABLE IF EXISTS `medias`;
CREATE TABLE IF NOT EXISTS `medias` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Item` int(11) NOT NULL,
  `File` tinytext NOT NULL,
  `indx` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medias`
--

INSERT INTO `medias` (`ID`, `ID_Item`, `File`, `indx`) VALUES
(1, 9, 'pat52bpmheguxiwx6f7oerqcstz189oh.jpg', 1),
(2, 9, 'wa9fwvyve6eml6stxo855gxprd6cx7kt.jpg', 0),
(3, 8, '0gbqadpezuev5772funn38dav9lau5q6.jpg', 0),
(4, 1, 'on1xlu57hsp6vq1ns9cfhejd9q0r129c.png', 0),
(5, 11, 's7ccj8xzz8m8uqwwm0xnd9imdc7i75lw.jpg', 0),
(6, 12, '1sf7gq98oose2zpmyfgtb35ki8dg5aul.jpg', 0),
(7, 12, '64f77xngzrepey91hjs425uoin6nsig4.jpg', 1),
(8, 12, 'qwmox695zg05kn7mzr5bsismskb23553.jpg', 2),
(9, 12, 'uhsieq2rmazai2vkcn10zvkr8klcbtdr.jpg', 3),
(10, 13, 'y13p1waj8tzu1d8i55nizqynr19u86mz.jpg', 0),
(11, 13, 'd12x245div7045s8pcl58xevx5cbpse5.jpg', 1),
(12, 13, 'zbbfv11qec99fgntdcihho610rpqz9uw.jpg', 2),
(13, 14, 'jxzqzg0i0jdjp9x50wv4drnafhimlcnv.jpg', 0),
(14, 14, '5t2yhwn4dkvqvw25l1b9bcethvbvcvii.jpg', 1),
(15, 14, 'ui28v3dp73q6s7el1mpbnqylhu06kkl5.jpg', 2),
(16, 14, 'eomct0bhwymr6660y7oxj9r2u9kjq1di.jpg', 3),
(17, 14, 'la8q5b0u1xb1hbcwyykjf4i89wg799c7.jpg', 4),
(18, 14, 'h03vzelo2nzreatgepotjyj1g2m0zoib.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `Note` int(11) NOT NULL,
  `Commentaire` text NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_Item` int(11) NOT NULL,
  `ID_Acheteur` int(11) NOT NULL,
  `ID_Vendeur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`Note`, `Commentaire`, `Date`, `ID_Item`, `ID_Acheteur`, `ID_Vendeur`) VALUES
(10, 'Excellent', '2020-04-17 17:30:46', 2, 1, 1),
(3, 'Coucou', '2020-04-19 14:45:50', 8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `offres`
--

DROP TABLE IF EXISTS `offres`;
CREATE TABLE IF NOT EXISTS `offres` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Item` int(11) NOT NULL,
  `ID_Acheteur` int(11) NOT NULL,
  `Instigateure` int(11) NOT NULL,
  `Instigateur` tinytext NOT NULL,
  `Prix` double NOT NULL,
  `Accepted` tinyint(1) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offres`
--

INSERT INTO `offres` (`ID`, `ID_Item`, `ID_Acheteur`, `Instigateure`, `Instigateur`, `Prix`, `Accepted`, `Date`) VALUES
(24, 1, 1, 0, 'Acheteur', 13, 0, '2020-04-18 16:49:35'),
(23, 1, 1, 0, 'Acheteur', 12, 0, '2020-04-18 16:49:30'),
(22, 1, 1, 0, 'Acheteur', 11, 0, '2020-04-18 16:49:20'),
(25, 1, 0, 0, 'Acheteur', 0, 0, '2020-04-18 18:42:59'),
(26, 1, 0, 0, 'Acheteur', 0, 0, '2020-04-18 18:45:52');

-- --------------------------------------------------------

--
-- Table structure for table `paniers`
--

DROP TABLE IF EXISTS `paniers`;
CREATE TABLE IF NOT EXISTS `paniers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Acheteur` int(11) NOT NULL,
  `ID_Item` int(11) NOT NULL,
  `Quantite` int(11) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paniers`
--

INSERT INTO `paniers` (`ID`, `ID_Acheteur`, `ID_Item`, `Quantite`, `Date`) VALUES
(20, 1, 14, 1, '2020-04-19 12:48:31'),
(21, 1, 8, 1, '2020-04-19 14:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `paypal_accounts`
--

DROP TABLE IF EXISTS `paypal_accounts`;
CREATE TABLE IF NOT EXISTS `paypal_accounts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Proprietaire` int(11) NOT NULL,
  `Type_proprietaire` tinytext NOT NULL,
  `Email` tinytext NOT NULL,
  `Montant` double NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `soldes`
--

DROP TABLE IF EXISTS `soldes`;
CREATE TABLE IF NOT EXISTS `soldes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Montant` double NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soldes`
--

INSERT INTO `soldes` (`ID`, `Montant`) VALUES
(1, 100),
(8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Item` int(11) NOT NULL,
  `ID_Acheteur` int(11) NOT NULL,
  `ID_Vendeur` int(11) NOT NULL,
  `Moyen_de_paiement` tinytext NOT NULL,
  `ID_MDP` int(11) NOT NULL,
  `Type_de_vente` tinytext NOT NULL,
  `Quantite` int(11) NOT NULL,
  `Montant` double NOT NULL,
  `Prix_livraison` double NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `type_de_vente`
--

DROP TABLE IF EXISTS `type_de_vente`;
CREATE TABLE IF NOT EXISTS `type_de_vente` (
  `ID` tinytext NOT NULL,
  `Nom` tinytext NOT NULL,
  PRIMARY KEY (`ID`(11))
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_de_vente`
--

INSERT INTO `type_de_vente` (`ID`, `Nom`) VALUES
('tout', 'Tout'),
('achat_imm', 'Achats immediat'),
('encheres', 'Encheres'),
('offres', 'Offres');

-- --------------------------------------------------------

--
-- Table structure for table `vendeurs`
--

DROP TABLE IF EXISTS `vendeurs`;
CREATE TABLE IF NOT EXISTS `vendeurs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` tinytext NOT NULL,
  `Password` tinytext NOT NULL,
  `Nom` tinytext NOT NULL,
  `Prenom` tinytext NOT NULL,
  `ID_Adresse` int(11) NOT NULL,
  `Boutique` tinytext NOT NULL,
  `ID_Solde` int(11) NOT NULL,
  `Telephone` tinytext NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_Solde` (`ID_Solde`),
  UNIQUE KEY `Boutique` (`Boutique`(255))
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendeurs`
--

INSERT INTO `vendeurs` (`ID`, `Email`, `Password`, `Nom`, `Prenom`, `ID_Adresse`, `Boutique`, `ID_Solde`, `Telephone`) VALUES
(1, 'matthieu.gaucher@edu.ece.fr', 'lebonmdp', 'G', 'M', 0, 'NitroBoutique', 1, ''),
(2, 'pamplemousse@orange.fr', 'agrume101', 'Antine', 'Clem', 2, 'Choppe', 0, '0698547897'),
(4, 'acacia@bouygues.com', 'pneuneuneu', 'Le miro', 'Robert', 4, 'Mag à zinzin', 8, '0689474826');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE IF NOT EXISTS `wishlists` (
  `ID_Acheteur` int(11) NOT NULL,
  `ID_Item` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`ID_Acheteur`, `ID_Item`) VALUES
(1, 9);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
