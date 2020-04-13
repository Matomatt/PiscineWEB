-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 13, 2020 at 08:09 PM
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
  `Photo` tinytext NOT NULL,
  `ID_Solde` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_Solde` (`ID_Solde`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `Date_Expiration` date NOT NULL,
  `Code` tinytext NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_Acheteur` (`ID_Acheteur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`ID`)
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
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_Item` (`ID_Item`),
  UNIQUE KEY `ID_Acheteur` (`ID_Acheteur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Vendeur` int(11) NOT NULL,
  `Nom` tinytext NOT NULL,
  `ID_Medias` int(11) NOT NULL,
  `Prix` double NOT NULL,
  `Prix_Encheres` double NOT NULL,
  `Description` longtext NOT NULL,
  `Categorie` tinytext NOT NULL,
  `Type_de_vente_1` tinytext NOT NULL,
  `Type_de_vente_2` tinytext NOT NULL,
  `Date_MEV` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `medias`
--

DROP TABLE IF EXISTS `medias`;
CREATE TABLE IF NOT EXISTS `medias` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Media1` tinytext NOT NULL,
  `Media2` tinytext NOT NULL,
  `Media3` tinytext NOT NULL,
  `Media4` tinytext NOT NULL,
  `Media5` tinytext NOT NULL,
  `Media6` tinytext NOT NULL,
  `Media7` tinytext NOT NULL,
  `Media8` tinytext NOT NULL,
  `Media9` tinytext NOT NULL,
  `Media0` tinytext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `offres`
--

DROP TABLE IF EXISTS `offres`;
CREATE TABLE IF NOT EXISTS `offres` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Item` int(11) NOT NULL,
  `ID_Acheteur` int(11) NOT NULL,
  `Prix` double NOT NULL,
  `Accepted` tinyint(1) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_Item` (`ID_Item`),
  UNIQUE KEY `ID_Acheteur` (`ID_Acheteur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_Proprietaire` (`ID_Proprietaire`)
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Item` int(11) NOT NULL,
  `ID_Vendeur` int(11) NOT NULL,
  `ID_Acheteur` int(11) NOT NULL,
  `Moyen_de_paiement` tinytext NOT NULL,
  `ID_mdp` int(11) NOT NULL,
  `Type_de_vente` tinytext NOT NULL,
  `Montant` double NOT NULL,
  `Prix_livraison` double NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_Item` (`ID_Item`),
  UNIQUE KEY `ID_Vendeur` (`ID_Vendeur`),
  UNIQUE KEY `ID_Acheteur` (`ID_Acheteur`),
  UNIQUE KEY `ID_mdp` (`ID_mdp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `ID_Medias` int(11) NOT NULL,
  `ID_Solde` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
