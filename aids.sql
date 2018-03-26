-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Erstellungszeit: 25. Mrz 2018 um 11:07
-- Server-Version: 5.5.54-0ubuntu0.12.04.1
-- PHP-Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `aids`
--
CREATE DATABASE IF NOT EXISTS `aids` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `aids`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `boss`
--

DROP TABLE IF EXISTS `boss`;
CREATE TABLE `boss` (
  `ID` int(10) NOT NULL,
  `dice` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `boss`
--

INSERT INTO `boss` (`ID`, `dice`, `name`) VALUES
(1, 1, 'Ohne Schild'),
(2, 2, 'Ohne Flask'),
(3, 3, 'Ohne Rüstung'),
(4, 4, 'Fatroll'),
(5, 5, 'Zufällige Waffe'),
(6, 6, 'Waffe linke Hand'),
(7, 7, 'Nur RT'),
(8, 8, 'Lumbe'),
(9, 9, 'Normal'),
(10, 10, 'Ohne Ringe'),
(11, 11, 'Ohne Alles'),
(12, 12, 'Crap Ringe'),
(13, 13, 'Normal'),
(14, 14, 'Flask würfeln');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ds3`
--

DROP TABLE IF EXISTS `ds3`;
CREATE TABLE `ds3` (
  `ID` tinyint(10) NOT NULL,
  `mobDice` tinyint(10) DEFAULT NULL,
  `mobName` varchar(255) NOT NULL,
  `bossDice` tinyint(10) DEFAULT NULL,
  `bossName` varchar(255) NOT NULL,
  `weaponDice` tinyint(10) DEFAULT NULL,
  `weaponName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `ds3`
--

INSERT INTO `ds3` (`ID`, `mobDice`, `mobName`, `bossDice`, `bossName`, `weaponDice`, `weaponName`) VALUES
(1, 1, 'Ohne Schild', 1, 'Ohne Schild', 1, 'Club'),
(2, 2, 'Ohne Flask', 2, 'Ohne Flask', 2, 'Rapier'),
(3, 3, 'Ohne Rüstung', 3, 'Ohne Rüstung', 3, 'Deep Battle Axe'),
(4, 4, 'Fatroll', 4, 'Fatroll', 4, 'Lucerne'),
(5, 5, 'Parry/Lumbe', 5, 'Zufällige Waffe', 5, 'Greataxe'),
(6, 6, 'Waffe linke Hand', 6, 'Waffe linke Hand', 6, 'Handaxe'),
(7, 7, 'Nur RT', 7, 'Nur RT', 7, 'Broadsword'),
(8, 8, 'Invade', 8, 'Lumbe', 8, 'Brigand Axe'),
(9, 9, 'Crap Waffe', 9, 'Normal', 9, 'Partizan'),
(10, 10, 'Ohne Ringe', 10, 'Ohne Ringe', 10, 'Zweihänder'),
(11, 11, 'Ohne Alles', 11, 'Ohne Alles', 11, 'Executioner''s Greatsword'),
(12, 12, 'Crap Ringe', 12, 'Crap Ringe', 12, 'Barbed Straightsword'),
(13, 13, 'No Hit Run', NULL, '', 13, 'DarkSword'),
(14, 14, 'Kill on Sight', NULL, '', 14, 'Astora Greatsword'),
(15, 15, 'No Dodge/Run', NULL, '', 15, 'Butcher''S Knife'),
(16, 16, 'Normal', NULL, '', 16, 'Drang Hammers'),
(17, 17, 'Normal', NULL, '', 17, 'Astor Spear'),
(18, 18, 'Zufällige Waffe', NULL, '', 18, 'Whip'),
(19, 19, 'Zufällige Waffe', NULL, '', 19, 'Crow Talons'),
(20, 20, 'Zufällige Waffe', NULL, '', 20, 'Iritrill Straight Sword');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kills`
--

DROP TABLE IF EXISTS `kills`;
CREATE TABLE `kills` (
  `ID` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `joker` int(10) NOT NULL,
  `spent` int(10) NOT NULL,
  `bossNames` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `kills`
--

INSERT INTO `kills` (`ID`, `name`, `joker`, `spent`, `bossNames`) VALUES
(1, 'Biber', 0, 0, '0'),
(2, 'Katz', 2, 2, 'Iudex Gundyr\r\nAbyss Watchers'),
(3, 'Pat', 9, 8, 'Vordt of the Boreal Valley\r\nCrystal Sage\r\nCurse-Rotted Greatwood\r\nDeacons of the Deep\r\nHigh Lord Wolnir\r\nOld Demon King\r\nYhorm The Giant\r\nPointiff Sully\r\nAldritch'),
(4, 'Coop', 3, 2, 'Crystal Sage\r\nYhorm the Giant\r\npontiff sully');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mobs`
--

DROP TABLE IF EXISTS `mobs`;
CREATE TABLE `mobs` (
  `ID` int(10) NOT NULL,
  `dice` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `mobs`
--

INSERT INTO `mobs` (`ID`, `dice`, `name`) VALUES
(1, 1, 'Ohne Schild'),
(2, 2, 'Ohne Flask'),
(3, 3, 'Ohne Rüstung'),
(4, 4, 'Fatroll'),
(5, 5, 'Parry'),
(6, 6, 'Waffe linke Hand'),
(7, 7, 'Nur RT'),
(8, 8, 'Invade'),
(9, 9, 'Crap Waffe'),
(10, 10, 'Ohne Ringe'),
(11, 11, 'Ohne Alles'),
(12, 12, 'Crap Ringe'),
(13, 13, 'No Dodge/Run'),
(14, 14, 'Kill on sight'),
(15, 15, 'Flask Würfeln'),
(16, 16, 'Normal'),
(17, 17, 'Normal'),
(18, 18, 'Normal'),
(19, 19, 'Reverse Controls'),
(20, 20, 'Zufällige Waffe');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rolls`
--

DROP TABLE IF EXISTS `rolls`;
CREATE TABLE `rolls` (
  `ID` int(10) NOT NULL,
  `date` datetime NOT NULL,
  `IP` varchar(255) NOT NULL,
  `mobs` varchar(255) NOT NULL,
  `boss` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `rolls`
--

INSERT INTO `rolls` (`ID`, `date`, `IP`, `mobs`, `boss`) VALUES
(1, '2018-03-24 09:30:26', '2a02:810b:c540:5fb4:58d9:174b:d8e5:b078', 'Crap Waffe', 'Waffe linke Hand'),
(2, '2018-03-24 10:29:40', '95.90.230.5', 'Flask Würfeln (7) ', 'Waffe linke Hand'),
(3, '2018-03-24 11:32:33', '95.90.230.5', 'Parry/Lumbe', 'Fatroll'),
(4, '2018-03-24 14:32:26', '91.66.249.29', 'Waffe linke Hand', 'Waffe linke Hand'),
(5, '2018-03-24 14:32:40', '91.66.249.29', 'Ohne Rüstung', 'Waffe linke Hand'),
(6, '2018-03-24 14:32:47', '91.66.249.29', 'Crap Ringe', 'Lumbe'),
(7, '2018-03-24 14:33:21', '91.66.249.29', 'Black Knight sword', 'Ohne Alles'),
(8, '2018-03-24 14:34:54', '91.66.249.29', 'Ohne Ringe', 'Crap Ringe'),
(9, '2018-03-24 14:40:53', '91.66.249.29', 'Crap Waffe', 'Waffe linke Hand'),
(10, '2018-03-24 16:25:54', '91.66.249.29', 'Invade', 'Irithyll Straight Sword'),
(11, '2018-03-24 16:29:40', '91.66.249.29', 'Normal', 'Waffe linke Hand'),
(12, '2018-03-24 16:47:25', '91.66.249.29', 'Dark Sword', 'Nur RT'),
(13, '2018-03-24 16:51:07', '91.66.249.29', 'Ohne Schild', 'Ohne Schild'),
(14, '2018-03-24 17:01:37', '91.66.249.29', 'Normal', 'Fatroll'),
(15, '2018-03-24 17:09:02', '91.66.249.29', 'Invade', 'Ohne Alles'),
(16, '2018-03-24 17:14:10', '91.66.249.29', 'Ohne Ringe', 'Lumbe'),
(17, '2018-03-24 17:17:03', '91.66.249.29', 'Handaxe', 'Ohne Rüstung'),
(18, '2018-03-24 17:41:37', '91.66.249.29', 'Waffe linke Hand', 'Ohne Schild'),
(19, '2018-03-24 17:45:57', '91.66.249.29', 'Nur RT', 'Ohne Alles'),
(20, '2018-03-24 17:49:44', '91.66.249.29', 'Nur RT', 'Fatroll'),
(21, '2018-03-24 18:14:20', '91.66.249.29', 'Kill on sight', 'Nur RT'),
(22, '2018-03-24 18:20:28', '91.66.249.29', 'Normal', 'Ohne Flask'),
(23, '2018-03-24 18:54:08', '91.66.249.29', 'Ohne Rüstung', 'Ohne Rüstung'),
(24, '2018-03-24 19:14:35', '91.66.249.29', 'Ohne Schild', 'Normal'),
(25, '2018-03-24 19:22:57', '91.66.249.29', 'No Dodge/Run', 'Ohne Rüstung'),
(26, '2018-03-24 19:32:08', '91.66.249.29', 'Kill on sight', 'Ohne Schild'),
(27, '2018-03-24 19:34:54', '91.66.249.29', 'Crap Waffe', 'Ohne Rüstung'),
(28, '2018-03-24 19:47:24', '91.66.249.29', 'Kill on sight', 'Nur RT'),
(29, '2018-03-24 19:56:49', '91.66.249.29', 'Parry/Lumbe', 'Greataxe'),
(30, '2018-03-24 20:08:23', '91.66.249.29', 'Ohne Rüstung', 'Waffe linke Hand'),
(31, '2018-03-24 20:37:40', '91.66.249.29', 'Waffe linke Hand', 'Ohne Flask'),
(32, '2018-03-24 20:42:03', '91.66.249.29', 'Ohne Ringe', 'Fatroll'),
(33, '2018-03-24 20:46:03', '91.66.249.29', 'Flask Würfeln (7) ', 'Ohne Flask'),
(34, '2018-03-24 21:00:29', '91.66.249.29', 'Flask Würfeln (6) ', 'Ohne Schild'),
(35, '2018-03-24 21:07:01', '91.66.249.29', 'Astora Greatsword', 'Zufällige Waffe'),
(36, '2018-03-24 21:34:21', '91.66.249.29', 'Parry', 'Ohne Alles'),
(37, '2018-03-24 21:49:06', '91.66.249.29', 'Dark Sword', 'Waffe linke Hand'),
(38, '2018-03-24 21:59:13', '91.66.249.29', 'Ohne Rüstung', 'Ohne Rüstung'),
(39, '2018-03-24 22:02:00', '91.66.249.29', 'Normal', 'Ohne Ringe'),
(40, '2018-03-24 22:07:47', '91.66.249.29', 'Ohne Rüstung', 'Ohne Rüstung'),
(41, '2018-03-24 22:12:32', '91.66.249.29', 'Ohne Rüstung', 'Normal'),
(42, '2018-03-24 22:22:43', '91.66.249.29', 'Parry', 'Normal'),
(43, '2018-03-24 22:30:54', '91.66.249.29', 'Invade', 'Crap Ringe'),
(44, '2018-03-24 22:39:16', '91.66.249.29', 'Normal', 'Flask würfeln'),
(45, '2018-03-24 23:19:36', '91.66.249.29', 'Ohne Alles', 'Normal'),
(46, '2018-03-24 23:24:16', '91.66.249.29', 'Invade', 'Ohne Schild'),
(47, '2018-03-24 23:35:31', '91.66.249.29', 'great club', 'Normal'),
(48, '2018-03-25 05:36:38', '95.220.194.52', 'Ohne Alles', 'Black Knight sword'),
(49, '2018-03-25 06:24:01', '46.188.32.108', 'Normal', 'Nur RT');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `todo`
--

DROP TABLE IF EXISTS `todo`;
CREATE TABLE `todo` (
  `ID` int(10) NOT NULL,
  `todoText` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `todo`
--

INSERT INTO `todo` (`ID`, `todoText`) VALUES
(1, '- 1 Schatztruhe Dungeon Frösche\n- Loot ithryll valley bei pointiff\n- Speer Typ bei Skelette, Loot bei Krabbe\n- Dungeon Giant Chunks obbe un unne\n- Drache Loot');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `weapons`
--

DROP TABLE IF EXISTS `weapons`;
CREATE TABLE `weapons` (
  `ID` int(10) NOT NULL,
  `dice` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `weapons`
--

INSERT INTO `weapons` (`ID`, `dice`, `name`) VALUES
(1, 1, 'pickaxe'),
(2, 2, 'Rapier'),
(3, 3, 'Black Knight sword'),
(4, 4, 'great club'),
(5, 5, 'Greataxe'),
(6, 6, 'Handaxe'),
(7, 7, 'rotten spear'),
(8, 8, 'Brigand Axe'),
(9, 9, 'Partizan'),
(10, 10, 'soldering iron'),
(11, 11, 'Executioner''s Greatesword'),
(12, 12, 'Barbed Straight Sword'),
(13, 13, 'Dark Sword'),
(14, 14, 'Astora Greatsword'),
(15, 15, 'Butcher Knife'),
(16, 16, 'Drang Hammers'),
(17, 17, 'Arstor''s Spear'),
(18, 18, 'Whip'),
(19, 19, 'Crow Talons'),
(20, 20, 'yoshis spear');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `boss`
--
ALTER TABLE `boss`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `ds3`
--
ALTER TABLE `ds3`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `mobs`
--
ALTER TABLE `mobs`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `rolls`
--
ALTER TABLE `rolls`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `weapons`
--
ALTER TABLE `weapons`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `boss`
--
ALTER TABLE `boss`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT für Tabelle `ds3`
--
ALTER TABLE `ds3`
  MODIFY `ID` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT für Tabelle `mobs`
--
ALTER TABLE `mobs`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT für Tabelle `rolls`
--
ALTER TABLE `rolls`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT für Tabelle `weapons`
--
ALTER TABLE `weapons`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
