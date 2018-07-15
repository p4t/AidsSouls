CREATE TABLE IF NOT EXISTS `TMP_boss` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `dice` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `TMP_kills` (
  `ID` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `joker` int(10) NOT NULL,
  `spent` int(10) NOT NULL,
  `bossNames` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `TMP_mobs` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `dice` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `TMP_weapons` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `dice` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE `TMP_kills`;

INSERT INTO `TMP_kills` (`ID`, `name`, `joker`, `spent`, `bossNames`) VALUES
(1, 'Biber', 0, 0, '0'),
(2, 'Katz', 0, 0, '0'),
(3, 'Pat', 0, 0, '0'),
(4, 'Coop', 0, 0, '0');