DROP TABLE IF EXISTS `boss`;
CREATE TABLE `boss` (
  `ID` int(10) NOT NULL,
  `dice` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `global`;
CREATE TABLE `global` (
  `ID` int(10) NOT NULL,
  `flasks` tinyint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `global` (`ID`, `flasks`) VALUES
(1, 15);

DROP TABLE IF EXISTS `kills`;
CREATE TABLE `kills` (
  `ID` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `joker` int(10) NOT NULL,
  `spent` int(10) NOT NULL,
  `bossNames` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `ID` int(10) NOT NULL,
  `section` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `parentID` int(10) NOT NULL,
  `parentField` varchar(255) NOT NULL,
  `old` varchar(255) NOT NULL,
  `new` varchar(255) NOT NULL,
  `userID` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `IP` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `mobs`;
CREATE TABLE `mobs` (
  `ID` int(10) NOT NULL,
  `dice` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `rolls`;
CREATE TABLE `rolls` (
  `ID` int(10) NOT NULL,
  `date` datetime NOT NULL,
  `userID` int(10) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `IP` varchar(255) NOT NULL,
  `mobs` varchar(255) NOT NULL,
  `boss` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `todo`;
CREATE TABLE `todo` (
  `ID` int(10) NOT NULL,
  `todoText` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`ID`, `username`, `password`, `active`) VALUES
(1, 'Biber', 'larry', 1),
(2, 'Katz', 'larry', 1),
(3, 'Pat', 'larry', 1);

DROP TABLE IF EXISTS `weapons`;
CREATE TABLE `weapons` (
  `ID` int(10) NOT NULL,
  `dice` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `boss`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `global`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `log`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `mobs`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `rolls`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `todo`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `weapons`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `boss`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;
ALTER TABLE `log`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;
ALTER TABLE `mobs`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;
ALTER TABLE `rolls`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `weapons`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;
