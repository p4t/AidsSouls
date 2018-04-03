-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Erstellungszeit: 31. Mrz 2018 um 11:38
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
(9, 9, 'Crap Waffe'),
(10, 10, 'Ohne Ringe'),
(11, 11, 'Ohne Alles'),
(12, 12, 'Crap Ringe'),
(13, 13, 'Normal'),
(14, 14, 'Normal'),
(15, 15, 'Flask Würfeln');

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
(3, 'Pat', 9, 8, 'Vordt of the Boreal Valley\r\nCrystal Sage\r\nCurse-Rotted Greatwood\r\nDeacons of the Deep\r\nHigh Lord Wolnir\r\nOld Demon King\r\nYhorm The Giant\r\nPontiff Sulyvahn\r\nAldrich, Devourer of Gods'),
(4, 'Coop', 3, 2, 'Crystal Sage\r\nYhorm the Giant\r\nPontiff Sulyvahn');

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
(7, 7, 'Nur RT'),
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
(20, 20, 'Invade');

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
(1, '- 1 Schatztruhe Dungeon Frösche\n- Loot ithryll valley bei pointiff\n- Speer Typ bei Skelette, Loot bei Krabbe\n- bonfire dingens bei demon bonfire\n- Drache Loot\n- Ohne Backstab/Riposte/Plunge?\n- No Hit Run\n- Hunde unten beim Covenant\n- Dusk Crown Ring, Magic Clutch Ring, Lightning Clutch Ring, Fire Clutch Ring, Dark Clutch Ring, Symbol of Aids, Carthus Bloodring, Calamity Ring\n- Symbol of Aids');

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
(11, 11, 'Executioner''s Greatesword'),
(12, 12, 'Barbed Straight Sword'),
(13, 13, 'Dark Sword'),
(14, 14, 'Astora Greatsword'),
(15, 15, 'Butcher Knife'),
(16, 16, 'Drang Hammers'),
(17, 17, 'Arstor''s Spear'),
(18, 18, 'Whip'),
(19, 19, 'Crow Talons'),
(20, 20, 'Yoshis Spear');

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
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
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
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `weapons`
--
ALTER TABLE `weapons`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
