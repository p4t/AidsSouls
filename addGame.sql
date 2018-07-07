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

CREATE TABLE IF NOT EXISTS `TMP_log` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `section` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `parentID` int(10) NOT NULL,
  `parentField` varchar(255) NOT NULL,
  `old` varchar(255) NOT NULL,
  `new` varchar(255) NOT NULL,
  `userID` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `IP` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `TMP_mobs` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `dice` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `TMP_rolls` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `userID` int(10) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `IP` varchar(255) NOT NULL,
  `mobs` varchar(255) NOT NULL,
  `boss` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `TMP_todo` (
  `ID` int(10) NOT NULL,
  `todoText` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `TMP_weapons` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `dice` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;