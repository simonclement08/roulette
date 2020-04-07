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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;