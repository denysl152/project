-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 03 Juillet 2017 à 19:26
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lrvl_demo`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `nom_clt` varchar(30) NOT NULL,
  `prenom_clt` varchar(30) NOT NULL,
  `email_clt` varchar(30) NOT NULL,
  `adresse__clt` varchar(100) NOT NULL,
  `mobile_clt` int(11) NOT NULL,
  `cp` varchar(8) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `domaine` varchar(100) NOT NULL,
  `nom_etablissement` varchar(100) NOT NULL,
  `adresse_etablissement` varchar(100) NOT NULL,
  `ville_etablissement` varchar(100) NOT NULL,
  `cp_etablissement` varchar(8) NOT NULL,
  `date_cmd` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vistite360`
--

CREATE TABLE `vistite360` (
  `nom_client` varchar(30) NOT NULL,
  `prenom_client` varchar(30) NOT NULL,
  `email_client` varchar(30) NOT NULL,
  `mobile_client` int(11) NOT NULL,
  `date` varchar(11) NOT NULL,
  `heure` varchar(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
