-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Erstellungszeit: 02. Feb 2018 um 16:32
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

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `boss`
--

CREATE TABLE `boss` (
  `ID` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `boss`
--

INSERT INTO `boss` (`ID`, `name`) VALUES
(1, 'Ohne Schild'),
(2, 'Ohne Flask'),
(3, 'Ohne Rüstung'),
(4, 'Fatroll'),
(5, 'Zufällige Waffe'),
(6, 'Waffe linke Hand'),
(7, 'Nur RT'),
(8, 'Lumbe'),
(9, 'Normal'),
(10, 'Ohne Ringe'),
(11, 'Ohne Alles'),
(12, 'Crap Ringe');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kills`
--

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
(1, 'Biber', 4, 4, 'The Last Giant\r\nOld Dragonslayer\r\nFlexible Sentry\r\nBelfry Gargoyles'),
(2, 'Katz', 7, 4, 'The Lost Sinner\r\nSkeleton Lords\r\nCovetous Demon\r\nRoyal Rat Authority\r\nDragonriderz\r\nDemon of Song\r\nVelstadt, the Royal Aegis'),
(3, 'Pat', 10, 7, 'Dragonrider (Cheese)\r\nThe Pursuer (Cheese)\r\nRuin Sentinels (wegen Biber)\r\nScorpioness Najka\r\nMytha the Baneful Queen\r\nSmelter Demon\r\nOld Iron King\r\nProwling Magus & Congregation\r\nThe Duke''s Dear Freja\r\nLooking Glass Knight'),
(4, 'Bonfire', 5, 4, 'Rotten\r\n+1\r\n+2\r\n+3\r\n+4');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mobs`
--

CREATE TABLE `mobs` (
  `ID` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `mobs`
--

INSERT INTO `mobs` (`ID`, `name`) VALUES
(1, 'Ohne Schild'),
(2, 'Ohne Flask'),
(3, 'Ohne Rüstung'),
(4, 'Fatroll'),
(5, 'Parry/Lumbe'),
(6, 'Waffe linke Hand'),
(7, 'Nur RT'),
(8, 'No Crit'),
(9, 'Crap Waffe'),
(10, 'Ohne Ringe'),
(11, 'Ohne Alles'),
(12, 'Crap Ringe'),
(13, 'No Hit Run'),
(14, 'Kill on sight'),
(15, 'No Dodge/Run/Facebuttons'),
(16, 'Normal'),
(17, 'Normal'),
(18, 'Zufällige Waffe'),
(19, 'Zufällige Waffe'),
(20, 'Zufällige Waffe');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `weapons`
--

CREATE TABLE `weapons` (
  `ID` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `weapons`
--

INSERT INTO `weapons` (`ID`, `name`) VALUES
(1, 'Gyrm Axe'),
(2, 'Flamberge'),
(3, 'Bluemoon Greatsword'),
(4, 'Mastadon Greatsword'),
(5, 'Lucerne'),
(6, 'Sentier''s Spear'),
(7, 'Battle Axe'),
(8, 'Craftman''s Hammer'),
(9, 'Uchigatana'),
(10, 'Large Club'),
(11, 'Pat''s Spear'),
(12, 'Old Knight Halberd'),
(13, 'Murokumo'),
(14, 'Dark Scythe'),
(15, 'Old Knight Pike'),
(16, 'Royal Greatsword'),
(17, 'Malformed Skull'),
(18, 'Claws'),
(19, 'Great Scythe'),
(20, 'Black Knight Halberd');

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
-- AUTO_INCREMENT für Tabelle `weapons`
--
ALTER TABLE `weapons`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
