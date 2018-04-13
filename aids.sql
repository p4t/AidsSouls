-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Erstellungszeit: 12. Apr 2018 um 14:18
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
(2, 2, 'Symbol of Aids'),
(3, 3, 'Ohne Rüstung'),
(4, 4, 'Fatroll'),
(5, 5, 'Zufällige Waffe'),
(6, 6, 'Waffe linke Hand'),
(7, 7, 'Nur R2'),
(8, 8, 'Lumbe'),
(9, 9, 'Crap Waffe'),
(10, 10, 'Ohne Ringe'),
(11, 11, 'Ohne Alles'),
(12, 12, 'Crap Ringe'),
(13, 13, 'Normal'),
(14, 14, 'Normal'),
(15, 15, 'Flask Würfeln'),
(17, 16, 'Jäscher'),
(18, 17, 'Feige'),
(25, 18, 'ffgh');

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
(3, 'Pat', 10, 9, 'Vordt of the Boreal Valley\r\nCrystal Sage\r\nCurse-Rotted Greatwood\r\nDeacons of the Deep\r\nHigh Lord Wolnir\r\nOld Demon King\r\nYhorm The Giant\r\nPontiff Sulyvahn\r\nAldrich Devourer of Gods\r\nDancer of the Boreal Valley'),
(4, 'Coop', 3, 3, 'Crystal Sage\r\nYhorm the Giant\r\nPontiff Sulyvahn');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `ID` int(10) NOT NULL,
  `section` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `parentID` int(10) NOT NULL,
  `parentField` varchar(255) NOT NULL,
  `old` varchar(255) NOT NULL,
  `new` varchar(255) NOT NULL,
  `IP` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `log`
--

INSERT INTO `log` (`ID`, `section`, `action`, `parentID`, `parentField`, `old`, `new`, `IP`, `date`) VALUES
(1, 'boss', 'Edit', 0, '', '', 'Ohne Schild Ü', '95.90.230.5', '2018-04-12 13:16:08'),
(2, 'boss', 'Edit', 0, '', '', 'Ohne Schild Ü34535', '95.90.230.5', '2018-04-12 13:19:22'),
(3, 'boss', 'Edit', 0, '', 'Ohne Schild Ü34535', 'Ohne Schild', '95.90.230.5', '2018-04-12 13:32:47'),
(4, 'mobs', 'Edit', 21, '', 'Symbol of Aids', 'Symbol of Aids ÜÜÜ', '95.90.230.5', '2018-04-12 13:37:04'),
(5, 'kills', 'Edit', 1, '', 'Schnaggesfsdf', 'dgdgdfgdfgdf', '95.90.230.5', '2018-04-12 13:43:47'),
(6, 'kills', 'Edit', 1, '', 'dgdgdfgdfgdf', '0', '95.90.230.5', '2018-04-12 13:44:01'),
(7, 'kills', 'Edit', 1, '', '0', '0', '95.90.230.5', '2018-04-12 13:47:37'),
(8, 'kills', 'Edit', 1, '', '0', '0', '95.90.230.5', '2018-04-12 13:47:37'),
(9, 'kills', 'Edit', 1, '', '0dgdgdfgdfg', 'SCHNAGGES', '95.90.230.5', '2018-04-12 13:47:37'),
(10, 'kills', 'Edit', 1, '', '0', '4', '95.90.230.5', '2018-04-12 13:47:56'),
(11, 'kills', 'Edit', 1, '', '0', '2', '95.90.230.5', '2018-04-12 13:47:56'),
(12, 'kills', 'Edit', 1, '', 'SCHNAGGES', 'SCHNBAANALALBA', '95.90.230.5', '2018-04-12 13:47:56'),
(13, 'kills', 'Edit', 1, '', '4', '0', '95.90.230.5', '2018-04-12 13:53:38'),
(14, 'kills', 'Edit', 1, '', '2', '0', '95.90.230.5', '2018-04-12 13:53:38'),
(15, 'kills', 'Edit', 1, '', 'SCHNBAANALALBA', '0', '95.90.230.5', '2018-04-12 13:53:38');

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
(5, 5, 'Zufällige Waffe'),
(6, 6, 'Waffe linke Hand'),
(7, 7, 'Nur R2'),
(8, 8, 'Lumbe'),
(9, 9, 'Crap Waffe'),
(10, 10, 'Ohne Ringe'),
(11, 11, 'Ohne Alles'),
(12, 12, 'Crap Ringe'),
(13, 13, 'Normal'),
(14, 14, 'Normal'),
(15, 15, 'Flask Würfeln'),
(16, 16, 'No Dodge/Run'),
(17, 17, 'Invert Controls'),
(18, 18, 'Kill on Sight'),
(19, 19, 'Parry'),
(20, 20, 'Invade'),
(21, 21, 'Symbol of Aids ÜÜÜ'),
(22, 22, 'Jäscher'),
(23, 23, 'Feige');

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
(1, '2018-04-12 11:30:49', '95.90.230.5', '', ''),
(2, '2018-04-12 11:31:27', '95.90.230.5', 'Crap Ringe', 'Ohne Rüstung'),
(3, '2018-04-12 11:31:35', '95.90.230.5', 'Symbol of Aids', 'Symbol of Aids'),
(4, '2018-04-12 11:32:08', '95.90.230.5', 'Crap Ringe', 'Crap Ringe'),
(5, '2018-04-12 11:32:37', '95.90.230.5', 'Jäscher', 'Waffe linke Hand'),
(6, '2018-04-12 11:33:32', '95.90.230.5', 'Invert Controls', 'Normal'),
(7, '2018-04-12 11:34:16', '95.90.230.5', 'Ohne Rüstung', 'Crow Talons'),
(8, '2018-04-12 11:34:18', '95.90.230.5', 'Ohne Ringe', 'Waffe linke Hand'),
(9, '2018-04-12 11:34:28', '95.90.230.5', 'Normal', 'Ohne Ringe'),
(10, '2018-04-12 11:34:30', '95.90.230.5', 'Flask Würfeln (8) ', 'Ohne Alles'),
(11, '2018-04-12 11:35:23', '95.90.230.5', 'Fatroll', 'Feige'),
(12, '2018-04-12 11:36:28', '95.90.230.5', 'Symbol of Aids', 'Lumbe'),
(13, '2018-04-12 11:36:30', '95.90.230.5', 'Parry', 'Flask Würfeln (7) '),
(14, '2018-04-12 11:36:36', '95.90.230.5', 'Feige', 'Waffe linke Hand'),
(15, '2018-04-12 11:36:37', '95.90.230.5', 'Invert Controls', 'Lumbe'),
(16, '2018-04-12 11:36:38', '95.90.230.5', 'Normal', 'Ohne Rüstung'),
(17, '2018-04-12 11:36:40', '95.90.230.5', 'Kill on Sight', 'Nur R2'),
(18, '2018-04-12 11:36:41', '95.90.230.5', 'Crap Waffe', 'Ohne Schild'),
(19, '2018-04-12 11:36:41', '95.90.230.5', 'Waffe linke Hand', 'Schniedel'),
(20, '2018-04-12 11:44:05', '95.90.230.5', 'Nur R2', 'Feige'),
(21, '2018-04-12 11:44:15', '95.90.230.5', 'Feige', 'Waffe linke Hand'),
(22, '2018-04-12 11:44:38', '95.90.230.5', '', ''),
(23, '2018-04-12 11:44:49', '95.90.230.5', '', ''),
(24, '2018-04-12 11:44:49', '95.90.230.5', '', ''),
(25, '2018-04-12 11:44:53', '95.90.230.5', '', ''),
(26, '2018-04-12 11:44:54', '95.90.230.5', '', ''),
(27, '2018-04-12 11:44:58', '95.90.230.5', '', ''),
(28, '2018-04-12 11:44:58', '95.90.230.5', '', ''),
(29, '2018-04-12 11:45:02', '95.90.230.5', '', ''),
(30, '2018-04-12 11:45:02', '95.90.230.5', '', ''),
(31, '2018-04-12 11:45:07', '95.90.230.5', '', ''),
(32, '2018-04-12 11:45:07', '95.90.230.5', '', ''),
(33, '2018-04-12 11:45:08', '95.90.230.5', '', ''),
(34, '2018-04-12 11:45:08', '95.90.230.5', '', ''),
(35, '2018-04-12 11:45:09', '95.90.230.5', '', ''),
(36, '2018-04-12 11:45:09', '95.90.230.5', '', ''),
(37, '2018-04-12 11:45:10', '95.90.230.5', '', ''),
(38, '2018-04-12 11:45:12', '95.90.230.5', '', ''),
(39, '2018-04-12 11:45:18', '95.90.230.5', '', ''),
(40, '2018-04-12 11:45:18', '95.90.230.5', '', ''),
(41, '2018-04-12 11:45:18', '95.90.230.5', '', ''),
(42, '2018-04-12 11:45:24', '95.90.230.5', '', ''),
(43, '2018-04-12 11:45:25', '95.90.230.5', '', ''),
(44, '2018-04-12 11:45:30', '95.90.230.5', '', ''),
(45, '2018-04-12 11:45:30', '95.90.230.5', '', ''),
(46, '2018-04-12 11:45:32', '95.90.230.5', '', ''),
(47, '2018-04-12 11:45:34', '95.90.230.5', 'Fatroll', 'Ohne Schild'),
(48, '2018-04-12 11:49:00', '95.90.230.5', 'Feige', 'Symbol of Aids'),
(49, '2018-04-12 11:49:50', '95.90.230.5', 'Ohne Alles', 'Normal'),
(50, '2018-04-12 11:49:58', '95.90.230.5', 'Jäscher', 'Normal'),
(51, '2018-04-12 13:12:17', '95.90.230.5', 'Normal', 'Crap Waffe'),
(52, '2018-04-12 13:12:30', '95.90.230.5', 'Ohne Alles', 'Ohne Rüstung'),
(53, '2018-04-12 13:12:42', '95.90.230.5', 'Jäscher', 'Feige'),
(54, '2018-04-12 13:16:00', '95.90.230.5', 'Crap Ringe', 'Crap Waffe'),
(55, '2018-04-12 13:16:02', '95.90.230.5', '', ''),
(56, '2018-04-12 13:16:04', '95.90.230.5', '', ''),
(57, '2018-04-12 13:16:08', '95.90.230.5', '', ''),
(58, '2018-04-12 13:16:08', '95.90.230.5', '', ''),
(59, '2018-04-12 13:16:15', '95.90.230.5', '', ''),
(60, '2018-04-12 13:19:18', '95.90.230.5', '', ''),
(61, '2018-04-12 13:19:19', '95.90.230.5', '', ''),
(62, '2018-04-12 13:19:22', '95.90.230.5', '', ''),
(63, '2018-04-12 13:19:24', '95.90.230.5', 'Waffe linke Hand', 'Normal'),
(64, '2018-04-12 13:19:27', '95.90.230.5', '', ''),
(65, '2018-04-12 13:31:37', '95.90.230.5', '', ''),
(66, '2018-04-12 13:31:50', '95.90.230.5', '', ''),
(67, '2018-04-12 13:32:17', '95.90.230.5', '', ''),
(68, '2018-04-12 13:32:31', '95.90.230.5', '', ''),
(69, '2018-04-12 13:32:43', '95.90.230.5', '', ''),
(70, '2018-04-12 13:32:47', '95.90.230.5', '', ''),
(71, '2018-04-12 13:32:50', '95.90.230.5', '', ''),
(72, '2018-04-12 13:35:48', '95.90.230.5', '', ''),
(73, '2018-04-12 13:36:53', '95.90.230.5', '', ''),
(74, '2018-04-12 13:37:00', '95.90.230.5', '', ''),
(75, '2018-04-12 13:37:04', '95.90.230.5', '', ''),
(76, '2018-04-12 13:37:06', '95.90.230.5', '', ''),
(77, '2018-04-12 13:40:21', '95.90.230.5', '', ''),
(78, '2018-04-12 13:40:29', '95.90.230.5', '', ''),
(79, '2018-04-12 13:40:33', '95.90.230.5', '', ''),
(80, '2018-04-12 13:42:04', '95.90.230.5', '', ''),
(81, '2018-04-12 13:42:06', '95.90.230.5', '', ''),
(82, '2018-04-12 13:42:06', '95.90.230.5', '', ''),
(83, '2018-04-12 13:42:14', '95.90.230.5', '', ''),
(84, '2018-04-12 13:43:35', '95.90.230.5', '', ''),
(85, '2018-04-12 13:43:47', '95.90.230.5', '', ''),
(86, '2018-04-12 13:43:47', '95.90.230.5', '', ''),
(87, '2018-04-12 13:43:51', '95.90.230.5', '', ''),
(88, '2018-04-12 13:44:01', '95.90.230.5', '', ''),
(89, '2018-04-12 13:44:01', '95.90.230.5', '', ''),
(90, '2018-04-12 13:46:34', '95.90.230.5', '', ''),
(91, '2018-04-12 13:46:36', '95.90.230.5', '', ''),
(92, '2018-04-12 13:46:40', '95.90.230.5', '', ''),
(93, '2018-04-12 13:46:40', '95.90.230.5', '', ''),
(94, '2018-04-12 13:47:32', '95.90.230.5', '', ''),
(95, '2018-04-12 13:47:37', '95.90.230.5', '', ''),
(96, '2018-04-12 13:47:37', '95.90.230.5', '', ''),
(97, '2018-04-12 13:47:47', '95.90.230.5', '', ''),
(98, '2018-04-12 13:47:56', '95.90.230.5', '', ''),
(99, '2018-04-12 13:47:56', '95.90.230.5', '', ''),
(100, '2018-04-12 13:53:28', '95.90.230.5', '', ''),
(101, '2018-04-12 13:53:38', '95.90.230.5', '', ''),
(102, '2018-04-12 13:53:38', '95.90.230.5', '', ''),
(103, '2018-04-12 13:54:26', '95.90.230.5', '', ''),
(104, '2018-04-12 13:54:27', '95.90.230.5', '', ''),
(105, '2018-04-12 13:54:28', '95.90.230.5', '', ''),
(106, '2018-04-12 13:54:31', '95.90.230.5', '', ''),
(107, '2018-04-12 13:54:42', '95.90.230.5', '', ''),
(108, '2018-04-12 13:55:01', '95.90.230.5', '', ''),
(109, '2018-04-12 13:55:24', '95.90.230.5', '', ''),
(110, '2018-04-12 13:55:32', '95.90.230.5', '', ''),
(111, '2018-04-12 14:09:14', '95.90.230.5', '', '');

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
(1, '- 1 Schatztruhe Dungeon Frösche\n- Loot ithryll valley bei pointiff\n- Speer Typ bei Skelette, Loot bei Krabbe\n- bonfire dingens bei demon bonfire\n- Drache Loot\n- Ohne Backstab/Riposte/Plunge?\n- No Hit Run\n- Hunde unten beim Covenant\n- Dusk Crown Ring\n- Magic Clutch Ring\n- Lightning Clutch Ring\n- Fire Clutch Ring\n- Dark Clutch Ring\n- Symbol of Aids, Carthus Bloodring\n- Calamity Ring\n- Symbol of Aids');

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
(1, 1, 'Pickaxe'),
(2, 2, 'Rapier'),
(3, 3, 'Black Knight sword'),
(4, 4, 'Great Club'),
(5, 5, 'Greataxe'),
(6, 6, 'Handaxe'),
(7, 7, 'Rotten Spear'),
(8, 8, 'Brigand Axe'),
(9, 9, 'Partizan'),
(10, 10, 'Soldering Iron'),
(11, 11, 'Executioner''s Greatsword'),
(12, 12, 'Barbed Straight Sword'),
(13, 13, 'Dark Sword'),
(14, 14, 'Astora Greatsword'),
(15, 15, 'Butcher Knife'),
(16, 16, 'Drang Hammers'),
(17, 17, 'Arstor''s Spear'),
(18, 18, 'Whip'),
(19, 19, 'Crow Talons'),
(20, 20, 'Yorshka''s Spear');

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
-- Indizes für die Tabelle `log`
--
ALTER TABLE `log`
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
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT für Tabelle `ds3`
--
ALTER TABLE `ds3`
  MODIFY `ID` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT für Tabelle `log`
--
ALTER TABLE `log`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT für Tabelle `mobs`
--
ALTER TABLE `mobs`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT für Tabelle `rolls`
--
ALTER TABLE `rolls`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT für Tabelle `weapons`
--
ALTER TABLE `weapons`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
