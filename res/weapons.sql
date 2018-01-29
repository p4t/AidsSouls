-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Erstellungszeit: 29. Jan 2018 um 09:30
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
-- Tabellenstruktur für Tabelle `weapons`
--

CREATE TABLE `weapons` (
  `weaponID` int(10) NOT NULL,
  `weaponName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `weapons`
--

INSERT INTO `weapons` (`weaponID`, `weaponName`) VALUES
(1, 'Gyrm Axe'),
(2, 'Flamberge'),
(3, 'Bluemoon'),
(4, 'Mastadon Greatsword'),
(5, 'Lucerne'),
(6, 'Sentier''s Spear'),
(7, 'Battle Axe'),
(8, 'Craftman''s Hammer'),
(9, 'Uschi'),
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
