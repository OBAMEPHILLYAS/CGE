-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 14 oct. 2023 à 17:17
-- Version du serveur : 5.7.40
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ged`
--

-- --------------------------------------------------------

--
-- Structure de la table `bureau`
--

DROP TABLE IF EXISTS `bureau`;
CREATE TABLE IF NOT EXISTS `bureau` (
  `id_bureau` int(3) NOT NULL AUTO_INCREMENT,
  `nom_bureau` varchar(100) NOT NULL,
  `responsable_bureau` varchar(100) NOT NULL,
  `id_centre` int(3) NOT NULL,
  PRIMARY KEY (`id_bureau`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bureau`
--

INSERT INTO `bureau` (`id_bureau`, `nom_bureau`, `responsable_bureau`, `id_centre`) VALUES
(1, 'Bureau 1', 'ABO Yannick', 1),
(2, 'Bureau 1', 'NDONG Léon', 2);

-- --------------------------------------------------------

--
-- Structure de la table `candidat`
--

DROP TABLE IF EXISTS `candidat`;
CREATE TABLE IF NOT EXISTS `candidat` (
  `id_candidat` int(3) NOT NULL AUTO_INCREMENT,
  `nom_candidat` varchar(100) NOT NULL,
  `prenom_candidat` varchar(50) NOT NULL,
  `parti_candidat` varchar(100) NOT NULL,
  `id_election` int(3) NOT NULL,
  `photo_candidat` varchar(500) NOT NULL,
  PRIMARY KEY (`id_candidat`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `candidat`
--

INSERT INTO `candidat` (`id_candidat`, `nom_candidat`, `prenom_candidat`, `parti_candidat`, `id_election`, `photo_candidat`) VALUES
(1, 'ONDO OSSA', 'Albert Pierre', 'Independant', 1, ''),
(2, 'BONGO ONDIMBA', 'Ali', 'PDG', 1, ''),
(3, 'NDONG SIMA', 'Léon', 'Indépendant', 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `centre`
--

DROP TABLE IF EXISTS `centre`;
CREATE TABLE IF NOT EXISTS `centre` (
  `id_centre` int(3) NOT NULL AUTO_INCREMENT,
  `nom_centre` varchar(100) NOT NULL,
  `adresse_centre` varchar(100) NOT NULL,
  `province_centre` varchar(100) NOT NULL,
  `responsable_centre` varchar(100) NOT NULL,
  `id_election` int(3) NOT NULL,
  PRIMARY KEY (`id_centre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `centre`
--

INSERT INTO `centre` (`id_centre`, `nom_centre`, `adresse_centre`, `province_centre`, `responsable_centre`, `id_election`) VALUES
(1, 'IAI 1', '5e Arrondissement', 'ESTUAIRE', 'NKOUMBA Lenaick', 1),
(2, 'IAI 2', '5e Arrondissement', 'ESTUAIRE', 'OBAME AKUE', 1);

-- --------------------------------------------------------

--
-- Structure de la table `electeur`
--

DROP TABLE IF EXISTS `electeur`;
CREATE TABLE IF NOT EXISTS `electeur` (
  `id_electeur` int(10) NOT NULL AUTO_INCREMENT,
  `nom_electeur` varchar(100) NOT NULL,
  `prenom_electeur` varchar(100) NOT NULL,
  `adresse_electeur` varchar(100) NOT NULL,
  `date_electeur` date NOT NULL,
  `lieu_electeur` varchar(100) NOT NULL,
  `cni_electeur` int(12) NOT NULL,
  `id_bureau` int(3) NOT NULL,
  `photo_electeur` varchar(100) NOT NULL,
  PRIMARY KEY (`id_electeur`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `electeur`
--

INSERT INTO `electeur` (`id_electeur`, `nom_electeur`, `prenom_electeur`, `adresse_electeur`, `date_electeur`, `lieu_electeur`, `cni_electeur`, `id_bureau`, `photo_electeur`) VALUES
(1, 'MBA SNO', 'Stévi Charles', 'Acaé', '1995-03-02', 'Lastrouville', 14725836, 1, ''),
(2, 'BARRA ', 'AbdulKarim', '5e Arrondissement', '1966-02-12', 'LBV', 15896325, 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `election`
--

DROP TABLE IF EXISTS `election`;
CREATE TABLE IF NOT EXISTS `election` (
  `id_election` int(5) NOT NULL AUTO_INCREMENT,
  `libelle_election` varchar(50) NOT NULL,
  `annee` year(4) NOT NULL,
  PRIMARY KEY (`id_election`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `election`
--

INSERT INTO `election` (`id_election`, `libelle_election`, `annee`) VALUES
(1, 'Election Présidentielle 2023', 2023);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(5) NOT NULL,
  `photo` varchar(100) NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`login`, `password`, `role`, `photo`) VALUES
('bobo', 'ca2cd2bcc63c4d7c8725577442073dde', 'user', 'Jellyfish.jpg'),
('coco', 'ac0ddf9e65d57b6a56b2453386cd5db5', 'user', 'Fotolia_53742416_XS.jpg'),
('dadi', '11cce4cbc871796013fa495b82ff98a6', 'user', 'Koala.jpg'),
('dodo', '721c6ff80a6d3e4ad4ffa52a04c60085', 'admin', 'Lighthouse.jpg'),
('gaga', '811584043b844704c9bb9a6e99dd05d3', 'user', 'Fotolia_53742416_XS.jpg'),
('gigi', 'ec0c8fe7ad80dfe93c0de35448b1d581', 'user', 'ged.jpg'),
('kaki', '9f5cc93a91524713c66b55d7ff1233fb', 'user', 'archivage.jpg'),
('kiki', '0d61130a6dd5eea85c2c5facfe1c15a7', 'admin', 'Jellyfish.jpg'),
('koki', 'c38be0f1f87d0e77a0cd2fe6941253eb', 'user', ''),
('taca', '1c5fd1dc507fd4272645af6085ebeecf', 'user', ''),
('tate', 'c8c01893d9bc804c03b7f7ff190fea79', 'user', ''),
('tite', 'd666e5c87d3392cdd1b00efc8ac4281c', 'user', ''),
('toti', '6545a7ca8eb3bc492bb4948c728e3913', 'user', 'Desert.jpg'),
('toto', 'f71dbe52628a3f83a77ab494817525c6', 'admin', 'archivage.jpg'),
('tuto', 'b2218117085d7b3886e312b35b7f42fa', 'user', 'Penguins.jpg'),
('zinzin', '35f45a16e09f18867951eaa6574b4ba2', 'user', 'Koala.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

DROP TABLE IF EXISTS `vote`;
CREATE TABLE IF NOT EXISTS `vote` (
  `id_vote` int(7) NOT NULL AUTO_INCREMENT,
  `id_candidat` int(3) NOT NULL,
  `id_election` int(3) NOT NULL,
  `id_electeur` int(10) NOT NULL,
  PRIMARY KEY (`id_vote`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vote`
--

INSERT INTO `vote` (`id_vote`, `id_candidat`, `id_election`, `id_electeur`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
