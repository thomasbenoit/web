CREATE TABLE IF NOT EXISTS `activite` (
  `idActivite` int(11) NOT NULL AUTO_INCREMENT,
  `nomActivite` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idActivite`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `applications`
--

INSERT INTO `activite` (`idActivite`, `nomActivite`) VALUES
(1, 'java'),
(2, 'python'),
(3, 'anglais'),
(4, 'repos'),
(5, 'cafe'),
(6,'PHP');

-- --------------------------------------------------------

--
-- Structure de la table `configapplication`
--
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `idUtilisateurs` int(11) NOT NULL AUTO_INCREMENT,
  `nomUtilisateurs` varchar(45) DEFAULT NULL,
  `prenomUtilisateurs` varchar(45) DEFAULT NULL,
  `pseudoUtilisateurs` varchar(45) DEFAULT NULL,
  `mdpUtilisateurs` varchar(255) DEFAULT NULL,
  `emailUtilisateurs` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idUtilisateurs`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;



CREATE TABLE IF NOT EXISTS `reservation` (
  `idReservation` int(11) NOT NULL AUTO_INCREMENT,
  `dateReservation` DATETIME DEFAULT NULL,
  `idActivite` int(11) NOT NULL,
  idUtilisateurs int(11) NOT NULL,
  PRIMARY KEY (`idReservation`),
  KEY `fk_1` (`idActivite`),
  KEY `fk_2` (idUtilisateurs)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_1` FOREIGN KEY (`idActivite`) REFERENCES `activite` (`idActivite`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_2` FOREIGN KEY (`idUtilisateurs`) REFERENCES `utilisateurs` (`idUtilisateurs`) ON DELETE NO ACTION ON UPDATE NO ACTION;


