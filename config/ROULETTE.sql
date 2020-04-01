CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surname` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `class` varchar(10) NOT NULL,
  `bool` tinyint(1) NOT NULL DEFAULT 0,
  `passage` int(5) NOT NULL DEFAULT 0,
  `absence` int(2) NOT NULL DEFAULT 0,
  `noteaddition` int(100) NOT NULL DEFAULT 0,
  `notetotal` int(10) NOT NULL DEFAULT 0,
  `average` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

INSERT INTO `student` (`id`, `surname`, `firstname`, `class`, `bool`, `passage`, `absence`, `noteaddition`, `notetotal`, `average`) VALUES
(31, 'BEGUE', 'Theo', 'TEST', 0, 0, 0, 0, 0, 0),
(32, 'BEN REJEB', 'Razi', 'TEST', 0, 0, 0, 0, 0, 0),
(33, 'BETTINELI', 'Thomas', 'TEST', 0, 0, 0, 0, 0, 0),
(34, 'BILLARD', 'Maximilien', 'TEST', 0, 0, 0, 0, 0, 0),
(35, 'BOUDRIQUE', 'Victor', 'TEST', 0, 0, 0, 0, 0, 0),
(36, 'CHAUWIN', 'Cedric', 'TEST', 0, 0, 0, 0, 0, 0),
(37, 'CHAYOT', 'Thibaut', 'TEST', 0, 0, 0, 0, 0, 0),
(38, 'COQUET', 'Donovan', 'TEST', 0, 0, 0, 0, 0, 0),
(39, 'COURIER', 'Valentin', 'TEST', 0, 0, 0, 0, 0, 0),
(40, 'DEMARLY', 'Lucas', 'TEST', 0, 0, 0, 0, 0, 0),
(41, 'DOCQ', 'Gregory', 'TEST', 0, 0, 0, 0, 0, 0),
(42, 'DUJEUX', 'Aurelien', 'TEST', 0, 0, 0, 0, 0, 0),
(43, 'FERNANDES', 'Benoit', 'TEST', 0, 0, 0, 0, 0, 0),
(44, 'GESNOT', 'Corentin', 'TEST', 0, 0, 0, 0, 0, 0),
(45, 'GRESSIER', 'Dylan', 'TEST', 0, 0, 0, 0, 0, 0),
(46, 'HELIOT', 'Thimoté', 'TEST', 0, 0, 0, 0, 0, 0),
(47, 'KALUZNY', 'Geoffrey', 'TEST', 0, 0, 0, 0, 0, 0),
(48, 'LAMBERT', 'Ruddy', 'TEST', 0, 0, 0, 0, 0, 0),
(49, 'LARNACK', 'Damien', 'TEST', 0, 0, 0, 0, 0, 0),
(50, 'LE GUINIO', 'Florentin', 'TEST', 0, 0, 0, 0, 0, 0),
(51, 'LONGNIAUX', 'Guillaume', 'TEST', 0, 0, 0, 0, 0, 0),
(52, 'MADAMA', 'Thomas', 'TEST', 0, 0, 0, 0, 0, 0),
(53, 'MAILLARD', 'Theo', 'TEST', 0, 0, 0, 0, 0, 0),
(54, 'MIDOUX', 'Kevin', 'TEST', 0, 0, 0, 0, 0, 0),
(55, 'PADOVAN', 'Alexandre', 'TEST', 0, 0, 0, 0, 0, 0),
(56, 'PETITFILS', 'Florian', 'TEST', 0, 0, 0, 0, 0, 0),
(57, 'PICHE', 'Alexis', 'TEST', 0, 0, 0, 0, 0, 0),
(58, 'PIETOT', 'Maxence', 'TEST', 0, 0, 0, 0, 0, 0),
(59, 'PITON', 'Tony', 'TEST', 0, 0, 0, 0, 0, 0),
(60, 'PORQUET', 'Vincent', 'TEST', 0, 0, 0, 0, 0, 0),
(61, 'REMY', 'Theo', 'TEST', 0, 0, 0, 0, 0, 0),
(62, 'ROBERT', 'Julien', 'TEST', 0, 0, 0, 0, 0, 0),
(63, 'SAIDI', 'Mohammed', 'TEST', 0, 0, 0, 0, 0, 0),
(64, 'TREILLE', 'Alexis', 'TEST', 0, 0, 0, 0, 0, 0);