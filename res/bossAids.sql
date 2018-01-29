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
-- Tabellenstruktur für Tabelle `bossAids`
--

CREATE TABLE `bossAids` (
  `bossAidsID` int(10) NOT NULL,
  `bossAidsName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `bossAids`
--

INSERT INTO `bossAids` (`bossAidsID`, `bossAidsName`) VALUES
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
