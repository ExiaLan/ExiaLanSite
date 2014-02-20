-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 19 Février 2014 à 16:10
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `exialan`
--

-- --------------------------------------------------------

--
-- Structure de la table `place`
--

CREATE TABLE IF NOT EXISTS `place` (
  `ID_PLACE` int(11) NOT NULL AUTO_INCREMENT,
  `TYPE_PLACE` text,
  `PRIX_PLACE` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`ID_PLACE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `ID_TEAM` int(11) NOT NULL AUTO_INCREMENT,
  `ID_TOURNOIS` int(11) NOT NULL,
  `NOM_TEAM` text,
  `LEVEL_TEAM` int(11) DEFAULT NULL,
  `CODE_TEAM` text,
  `IDCHEF_TEAM` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_TEAM`),
  KEY `FK_PARTICIPE_A` (`ID_TOURNOIS`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `team`
--

INSERT INTO `team` (`ID_TEAM`, `ID_TOURNOIS`, `NOM_TEAM`, `LEVEL_TEAM`, `CODE_TEAM`, `IDCHEF_TEAM`) VALUES
(1, 0, 'Sans team', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tournois`
--

CREATE TABLE IF NOT EXISTS `tournois` (
  `ID_TOURNOIS` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_TOURNOIS` text,
  PRIMARY KEY (`ID_TOURNOIS`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `tournois`
--

INSERT INTO `tournois` (`ID_TOURNOIS`, `NOM_TOURNOIS`) VALUES
(1, 'Pas de tournois');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID_USER` int(11) NOT NULL AUTO_INCREMENT,
  `ID_TEAM` int(11) NOT NULL,
  `ID_TOURNOIS` int(11) NOT NULL,
  `ID_PLACE` int(11) NOT NULL,
  `PSEUDO_USER` text,
  `NOM_USER` text,
  `PRENOM_USER` text,
  `DTNAISSANCE_USER` date DEFAULT NULL,
  `TEL_USER` text,
  `MAIL_USER` text,
  `MDP_USER` text,
  `PLACEPAYEE_USER` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID_USER`),
  KEY `FK_ACHETER` (`ID_PLACE`),
  KEY `FK_APPARTENIR_A` (`ID_TEAM`),
  KEY `FK_S_INSCRIRE_A` (`ID_TOURNOIS`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
