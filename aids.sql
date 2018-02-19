-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Erstellungszeit: 19. Feb 2018 um 11:15
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
(2, 'Katz', 1, 1, 'Iudex Gundyr'),
(3, 'Pat', 3, 1, 'Vordt of the Boreal Valley\r\nCrystal Sage\r\nCurse-Rotted Greatwood'),
(4, '\\[T]/', 0, 0, '0');

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
(8, 8, 'No Crit'),
(9, 9, 'Crap Waffe'),
(10, 10, 'Ohne Ringe'),
(11, 11, 'Ohne Alles'),
(12, 12, 'Crap Ringe'),
(13, 13, 'No Hit Run'),
(14, 14, 'Kill on sight'),
(15, 15, 'No Dodge/Run'),
(16, 16, 'Invade'),
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
(5, 5, 'Whip'),
(6, 6, 'Handaxe'),
(7, 7, 'Broadsword'),
(8, 8, 'Brigand Axe');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `boss`
--
ALTER TABLE `boss`
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
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
