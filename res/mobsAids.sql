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
-- Tabellenstruktur für Tabelle `mobsAids`
--

CREATE TABLE `mobsAids` (
  `mobsAidsID` int(10) NOT NULL,
  `mobsAidsName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `mobsAids`
--

INSERT INTO `mobsAids` (`mobsAidsID`, `mobsAidsName`) VALUES
(1, 'Ohne Schild'),
(2, 'Ohne Flask'),
(3, 'Ohne Rüstung'),
(4, 'Fatroll'),
(5, 'Parry/Lumbe'),
(6, 'Waffe linke Hand'),
(7, 'Nur RT'),
(8, 'Ohne Backstab, Riposte'),
(9, 'Crap Waffe'),
(10, 'Ohne Ringe'),
(11, 'Ohne Alles'),
(12, 'Crap Ringe'),
(13, 'Normal'),
(14, 'Normal'),
(15, 'Normal'),
(16, 'Normal'),
(17, 'Zufällige Waffe'),
(18, 'Zufällige Waffe'),
(19, 'Zufällige Waffe'),
(20, 'Zufällige Waffe');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
