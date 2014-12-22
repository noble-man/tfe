-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 30 Septembre 2015 à 00:17
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `ecole`
--

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE IF NOT EXISTS `cours` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(45) NOT NULL,
  `fkProf` int(11) NOT NULL,
  `local` varchar(3) NOT NULL,
  `annee` int(11) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9858 ;

--
-- Contenu de la table `cours`
--

INSERT INTO `cours` (`code`, `intitule`, `fkProf`, `local`, `annee`) VALUES
(9835, 'Histoire ', 237, 'A11', 1),
(9853, 'Microeconomie', 214, 'B28', 1),
(9855, 'Macroeconomie', 237, 'A15', 1),
(9856, 'Reseaux informatiques', 237, 'C06', 1),
(9857, 'G?ographie', 237, 'C72', 1);

-- --------------------------------------------------------

--
-- Structure de la table `criminalrecord`
--

CREATE TABLE IF NOT EXISTS `criminalrecord` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `ville` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `charge` varchar(25) NOT NULL,
  `peine` varchar(25) NOT NULL,
  `fkStudent` int(11) NOT NULL,
  PRIMARY KEY (`num`),
  UNIQUE KEY `fkStudent` (`fkStudent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Contenu de la table `criminalrecord`
--

INSERT INTO `criminalrecord` (`num`, `ville`, `date`, `charge`, `peine`, `fkStudent`) VALUES
(26, '', '0000-00-00', 'Escroquerie', 'Prison ferme', 67);

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE IF NOT EXISTS `inscription` (
  `idInscr` int(11) NOT NULL AUTO_INCREMENT,
  `fkStudent` int(11) NOT NULL,
  `annee` int(11) NOT NULL,
  `anneescolaire` int(11) NOT NULL,
  `date` date NOT NULL,
  `montantVerse` int(10) NOT NULL,
  `decision` varchar(15) NOT NULL,
  `remarque` varchar(50) NOT NULL,
  PRIMARY KEY (`idInscr`),
  KEY `fkStudent` (`fkStudent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `inscription`
--

INSERT INTO `inscription` (`idInscr`, `fkStudent`, `annee`, `anneescolaire`, `date`, `montantVerse`, `decision`, `remarque`) VALUES
(1, 67, 0, 0, '2015-09-09', 300, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE IF NOT EXISTS `professeur` (
  `idProf` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(35) NOT NULL,
  `prenom` varchar(35) NOT NULL,
  `email` varchar(35) NOT NULL,
  PRIMARY KEY (`idProf`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=247 ;

--
-- Contenu de la table `professeur`
--

INSERT INTO `professeur` (`idProf`, `nom`, `prenom`, `email`) VALUES
(237, 'Lemaire', 'Jacques', 'jl@lerendezvous.com'),
(240, 'Bultman', 'Antos', 'antbult@lerendezvous.com'),
(243, 'Bart', 'Karl', 'karba@lerendezvous.com'),
(245, 'Piper', 'John', 'jpiper@desiringgod.com'),
(246, 'Pauper', 'Jean', 'jpaup@ath.com');

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `idPromo` int(11) NOT NULL AUTO_INCREMENT,
  `annee` int(11) NOT NULL,
  `anneeacademique` varchar(9) NOT NULL,
  PRIMARY KEY (`idPromo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `idStudent` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `adresse` varchar(45) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `ville` varchar(30) NOT NULL,
  `tel` varchar(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `statut` varchar(30) NOT NULL,
  PRIMARY KEY (`idStudent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Contenu de la table `student`
--

INSERT INTO `student` (`idStudent`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `tel`, `email`, `statut`) VALUES
(67, 'Stael', 'Kevin', 'Rue Theodore Roosevelt', 'WC2E 9RZ', 'London', '0044 20 743', 'stalkev@yahoo.com', 'Candidat'),
(68, 'Beumier', 'Pierre', '', '', '', '', 'pbm@lerendezvous.com', ''),
(69, 'Luther', 'Karl', '', '', '', '', 'kl@lerendezvous', ''),
(70, 'Luther', 'Karl', '', '', '', '', 'kl@lerendezvous.com', '');

-- --------------------------------------------------------

--
-- Structure de la table `study`
--

CREATE TABLE IF NOT EXISTS `study` (
  `idStudy` int(11) NOT NULL AUTO_INCREMENT,
  `fkStudent` int(11) NOT NULL,
  `startYear` int(5) NOT NULL,
  `endYear` int(5) NOT NULL,
  `diplome` varchar(50) NOT NULL,
  `ecole` varchar(50) NOT NULL,
  PRIMARY KEY (`idStudy`),
  KEY `stStudent_fk` (`fkStudent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `first_name`, `last_name`, `email`) VALUES
(1, 'admin', 'admin', 'adam', 'adamo', 'admin@admin.com'),
(2, 'sec', 'sec', 'selma', 'sechan', 'sec@sec.com');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '',
  `nicename` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_n` (`username`),
  UNIQUE KEY `user_e` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `username`, `nicename`, `email`, `password`) VALUES
(4, 'swashata', 'Swashata Ghosh', 'abc@domain.com', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684'),
(5, 'admin', 'Adam Mine', 'admin@lerendezvous.com', 'd033e22ae348aeb5660fc2140aec35850c4da997');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `criminalrecord`
--
ALTER TABLE `criminalrecord`
  ADD CONSTRAINT `criminalrecord_ibfk_1` FOREIGN KEY (`fkStudent`) REFERENCES `student` (`idStudent`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `fkStudent` FOREIGN KEY (`fkStudent`) REFERENCES `student` (`idStudent`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `study`
--
ALTER TABLE `study`
  ADD CONSTRAINT `stStudent_fk` FOREIGN KEY (`fkStudent`) REFERENCES `student` (`idStudent`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
