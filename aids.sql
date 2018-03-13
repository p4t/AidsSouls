-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Erstellungszeit: 10. Mrz 2018 um 22:10
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
(12, 12, 'Crap Ringe');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ds3`
--

DROP TABLE IF EXISTS `ds3`;
CREATE TABLE `ds3` (
  `ID` tinyint(10) NOT NULL,
  `mobsDice` tinyint(10) NOT NULL,
  `mobsName` varchar(255) NOT NULL,
  `bossDice` tinyint(10) NOT NULL,
  `bossName` int(10) NOT NULL,
  `weaponDice` tinyint(4) NOT NULL,
  `weaponName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(2, 'Katz', 2, 1, 'Iudex Gundyr\r\nAbyss Watchers'),
(3, 'Pat', 5, 4, 'Vordt of the Boreal Valley\r\nCrystal Sage\r\nCurse-Rotted Greatwood\r\nDeacons of the Deep\r\nHigh Lord Wolnir'),
(4, 'Coop', 0, 0, '0');

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
(5, 5, 'Parry/Lumbe'),
(6, 6, 'Waffe linke Hand'),
(7, 7, 'Nur RT'),
(8, 8, 'Invade'),
(9, 9, 'Crap Waffe'),
(10, 10, 'Ohne Ringe'),
(11, 11, 'Ohne Alles'),
(12, 12, 'Crap Ringe'),
(13, 13, 'No Hit Run'),
(14, 14, 'Kill on sight'),
(15, 15, 'No Dodge/Run'),
(16, 16, 'Normal'),
(17, 17, 'Normal'),
(18, 18, 'Zufällige Waffe'),
(19, 19, 'Zufällige Waffe'),
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
(1, '2018-03-10 15:26:22', '91.66.249.29', 'Parry/Lumbe', 'Club'),
(2, '2018-03-10 15:27:39', '91.66.249.29', 'Ohne Ringe', 'Ohne Ringe'),
(3, '2018-03-10 16:32:48', '91.66.249.29', 'Waffe linke Hand', 'Lumbe'),
(4, '2018-03-10 16:55:27', '91.66.249.29', 'Ohne Alles', 'Brigand Axe'),
(5, '2018-03-10 16:58:51', '91.66.249.29', 'Ohne Alles', 'Ohne Alles'),
(6, '2018-03-10 17:18:05', '91.66.249.29', 'Whip', 'Normal'),
(7, '2018-03-10 17:19:24', '91.66.249.29', 'Ohne Ringe', 'Nur RT'),
(8, '2018-03-10 17:19:41', '91.66.249.29', 'Rapier', 'Fatroll'),
(9, '2018-03-10 17:24:14', '82.113.106.21', 'Executioner''s Greatesword', 'Lumbe'),
(10, '2018-03-10 17:24:28', '82.113.106.21', 'Nur RT', 'Normal'),
(11, '2018-03-10 17:35:45', '91.66.249.29', 'Club', 'Fatroll'),
(12, '2018-03-10 17:45:30', '91.66.249.29', 'Ohne Rüstung', 'Ohne Alles'),
(13, '2018-03-10 17:48:28', '91.66.249.29', 'Fatroll', 'Lumbe'),
(14, '2018-03-10 18:06:11', '91.66.249.29', 'Ohne Ringe', 'Fatroll'),
(15, '2018-03-10 18:13:13', '91.66.249.29', 'Crap Waffe', 'Ohne Schild'),
(16, '2018-03-10 18:52:26', '91.66.249.29', 'Normal', 'Crap Ringe'),
(17, '2018-03-10 19:05:12', '91.66.249.29', 'Executioner''s Greatesword', 'Club'),
(18, '2018-03-10 19:40:17', '91.66.249.29', 'Normal', 'Ohne Rüstung'),
(19, '2018-03-10 19:44:06', '91.66.249.29', 'Deep Battle Axe', 'Ohne Schild'),
(20, '2018-03-10 20:08:52', '91.66.249.29', 'Fatroll', 'Fatroll'),
(21, '2018-03-10 20:19:01', '91.66.249.29', 'Fatroll', 'Waffe linke Hand'),
(22, '2018-03-10 21:04:40', '91.66.249.29', 'Ohne Ringe', 'Ohne Flask'),
(23, '2018-03-10 21:08:54', '91.66.249.29', 'Invade', 'Normal'),
(24, '2018-03-10 21:18:19', '91.66.249.29', 'No Hit Run', 'Ohne Schild'),
(25, '2018-03-10 21:18:48', '91.66.249.29', 'Kill on sight', 'Lucerne'),
(26, '2018-03-10 21:27:27', '91.66.249.29', 'Kill on sight', 'Ohne Schild');

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
(1, 1, 'Club'),
(2, 2, 'Rapier'),
(3, 3, 'Deep Battle Axe'),
(4, 4, 'Lucerne'),
(5, 5, 'Greataxe'),
(6, 6, 'Handaxe'),
(7, 7, 'Broadsword'),
(8, 8, 'Brigand Axe'),
(9, 9, 'Partizan'),
(10, 10, 'Zweihänder'),
(11, 11, 'Executioner''s Greatesword'),
(12, 12, 'Barbed Straightsword'),
(13, 13, 'Darksword'),
(14, 14, 'Astora greatsword'),
(15, 15, 'butcher knive'),
(16, 16, 'drang hammers'),
(17, 17, 'astor spear'),
(18, 18, 'whip'),
(19, 19, 'crow tallons'),
(20, 20, 'iritrill straight sword');

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
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT für Tabelle `ds3`
--
ALTER TABLE `ds3`
  MODIFY `ID` tinyint(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `mobs`
--
ALTER TABLE `mobs`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT für Tabelle `rolls`
--
ALTER TABLE `rolls`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT für Tabelle `weapons`
--
ALTER TABLE `weapons`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
