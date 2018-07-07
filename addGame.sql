
CREATE TABLE `TMP_boss` (
  `ID` int(10) NOT NULL,
  `dice` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `TMP_kills` (
  `ID` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `joker` int(10) NOT NULL,
  `spent` int(10) NOT NULL,
  `bossNames` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `TMP_log` (
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



CREATE TABLE `TMP_mobs` (
  `ID` int(10) NOT NULL,
  `dice` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `TMP_rolls` (
  `ID` int(10) NOT NULL,
  `date` datetime NOT NULL,
  `userID` int(10) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `IP` varchar(255) NOT NULL,
  `mobs` varchar(255) NOT NULL,
  `boss` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `TMP_todo` (
  `ID` int(10) NOT NULL,
  `todoText` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `TMP_weapons` (
  `ID` int(10) NOT NULL,
  `dice` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `TMP_boss`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `TMP_log`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `TMP_mobs`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `TMP_rolls`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `TMP_todo`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `TMP_weapons`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `TMP_boss`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `TMP_log`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `TMP_mobs`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `TMP_rolls`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `TMP_weapons`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
