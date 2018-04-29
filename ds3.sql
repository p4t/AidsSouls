-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 17. Apr 2018 um 10:39
-- Server-Version: 5.5.54-0ubuntu0.12.04.1
-- PHP-Version: 5.6.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `ds3`
--
CREATE DATABASE IF NOT EXISTS `ds3` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ds3`;

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
(7, 7, 'Nur R2 '),
(8, 8, 'Lumbe'),
(9, 9, 'Crap Waffe'),
(10, 10, 'Ohne Ringe'),
(11, 11, 'Ohne Alles'),
(12, 12, 'Crap Ringe'),
(13, 13, 'Normal'),
(14, 14, 'Normal'),
(15, 15, 'Flask Würfeln'),
(17, 16, 'Jäscher'),
(22, 17, 'Feige');

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
(11, 11, 'Ohne Alles', 11, 'Ohne Alles', 11, 'Executioner\'s Greatsword'),
(12, 12, 'Crap Ringe', 12, 'Crap Ringe', 12, 'Barbed Straightsword'),
(13, 13, 'No Hit Run', NULL, '', 13, 'DarkSword'),
(14, 14, 'Kill on Sight', NULL, '', 14, 'Astora Greatsword'),
(15, 15, 'No Dodge/Run', NULL, '', 15, 'Butcher\'S Knife'),
(16, 16, 'Normal', NULL, '', 16, 'Drang Hammers'),
(17, 17, 'Normal', NULL, '', 17, 'Astor Spear'),
(18, 18, 'Zufällige Waffe', NULL, '', 18, 'Whip'),
(19, 19, 'Zufällige Waffe', NULL, '', 19, 'Crow Talons'),
(20, 20, 'Zufällige Waffe', NULL, '', 20, 'Iritrill Straight Sword');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `global`
--

DROP TABLE IF EXISTS `global`;
CREATE TABLE `global` (
  `ID` int(10) NOT NULL,
  `flasks` tinyint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `global`
--

INSERT INTO `global` (`ID`, `flasks`) VALUES
(1, 13);

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
(1, 'Biber', 1, 1, 'Ancient Wyvern'),
(2, 'Katz', 4, 3, 'Iudex Gundyr\r\nAbyss Watchers\r\nOceiros\r\nDraonslayer Armour'),
(3, 'Pat', 11, 11, 'Vordt of the Boreal Valley\r\nCrystal Sage\r\nCurse-Rotted Greatwood\r\nDeacons of the Deep\r\nHigh Lord Wolnir\r\nOld Demon King\r\nYhorm The Giant\r\nPontiff Sulyvahn\r\nAldrich Devourer of Gods\r\nDancer of the Boreal Valley\r\nChampion Gyunsüe'),
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
(15, 'kills', 'Edit', 1, '', 'SCHNBAANALALBA', '0', '95.90.230.5', '2018-04-12 13:53:38'),
(16, 'kills', 'Edit', 1, 'joker', '0', '3', '95.90.230.5', '2018-04-12 14:28:48'),
(17, 'kills', 'Edit', 1, 'spent', '0', '3', '95.90.230.5', '2018-04-12 14:28:48'),
(18, 'kills', 'Edit', 1, 'bossNames', '0', 'Ramona\r\nRamona\r\nRamona\r\nRamona\r\nRamona\r\n', '95.90.230.5', '2018-04-12 14:28:48'),
(19, 'kills', 'Edit', 1, 'joker', '3', '0', '95.90.230.5', '2018-04-12 14:29:29'),
(20, 'kills', 'Edit', 1, 'spent', '3', '0', '95.90.230.5', '2018-04-12 14:29:29'),
(21, 'kills', 'Edit', 1, 'bossNames', 'Ramona\r\nRamona\r\nRamona\r\nRamona\r\nRamona\r\n', '0', '95.90.230.5', '2018-04-12 14:29:29'),
(22, 'boss', 'Del', 25, 'bossName', '', '', '95.90.230.5', '2018-04-12 14:32:11'),
(23, 'mobs', 'Edit', 21, 'mobsName', 'Symbol of Aids ÜÜÜ', 'Symbol of Aids', '95.90.230.5', '2018-04-12 14:33:21'),
(24, 'mobs', 'Del', 26, 'mobsName', '', '', '95.90.230.5', '2018-04-12 15:34:18'),
(25, 'boss', 'edit.ajax', 11, 'name', '', 'Ohne Alles ÜÄÖÜÄÖ', '95.90.230.5', '2018-04-13 15:37:40'),
(26, 'boss', 'edit.ajax', 17, 'bossName', '', 'Jäscher ÄÄÄ', '95.90.230.5', '2018-04-13 15:38:14'),
(27, 'boss', 'edit.ajax', 17, 'bossName', '', 'Jäscher 123', '95.90.230.5', '2018-04-13 15:39:00'),
(28, 'boss', 'post.ajax', 0, 'bossName', '', 'WAT', '95.90.230.5', '2018-04-13 15:41:33'),
(29, 'weapons', 'post.ajax', 0, 'weaponsName', '', 'WATAT', '95.90.230.5', '2018-04-13 15:41:47'),
(30, 'boss', 'Del', 19, 'bossName', '', '', '95.90.230.5', '2018-04-13 15:42:07'),
(31, 'weapons', 'Del', 21, 'weaponsName', '', '', '95.90.230.5', '2018-04-13 15:42:11'),
(32, 'boss', 'edit.ajax', 17, 'bossName', '', 'Jäscher', '95.90.230.5', '2018-04-13 15:42:36'),
(33, 'boss', 'edit.ajax', 11, 'bossName', '', 'Ohne Alles', '95.90.230.5', '2018-04-13 15:42:39'),
(34, 'boss', 'edit.ajax', 18, 'bossName', '', 'Feige TEST', '95.90.230.5', '2018-04-13 14:26:10'),
(35, 'boss', 'Del', 20, 'bossName', '', '', '95.90.230.5', '2018-04-13 14:26:57'),
(36, 'boss', 'Del', 21, 'bossName', '', '', '95.90.230.5', '2018-04-13 14:27:01'),
(37, 'boss', 'Del', 18, 'bossName', '', '', '95.90.230.5', '2018-04-13 14:27:05'),
(38, 'boss', 'edit.ajax', 17, 'bossName', '', 'Jäscher Ü', '95.90.230.5', '2018-04-13 14:27:13'),
(39, 'boss', 'edit.ajax', 17, 'bossName', '', 'Jäscher', '95.90.230.5', '2018-04-13 14:27:15'),
(40, 'kills', 'Edit', 2, 'joker', '2', '3', '91.66.249.29', '2018-04-14 12:42:01'),
(41, 'kills', 'Edit', 2, 'spent', '2', '2', '91.66.249.29', '2018-04-14 12:42:01'),
(42, 'kills', 'Edit', 2, 'bossNames', 'Iudex Gundyr\r\nAbyss Watchers', 'Iudex Gundyr\r\nAbyss Watchers\r\nOceiros', '91.66.249.29', '2018-04-14 12:42:01'),
(43, 'weapons', 'edit.ajax', 19, 'weaponsName', '', 'wolnirs holy sword', '91.66.249.29', '2018-04-14 12:54:28'),
(44, 'kills', 'Edit', 3, 'joker', '10', '10', '91.66.249.29', '2018-04-14 12:56:25'),
(45, 'kills', 'Edit', 3, 'spent', '9', '10', '91.66.249.29', '2018-04-14 12:56:25'),
(46, 'kills', 'Edit', 3, 'bossNames', 'Vordt of the Boreal Valley\r\nCrystal Sage\r\nCurse-Rotted Greatwood\r\nDeacons of the Deep\r\nHigh Lord Wolnir\r\nOld Demon King\r\nYhorm The Giant\r\nPontiff Sulyvahn\r\nAldrich Devourer of Gods\r\nDancer of the Boreal Valley', 'Vordt of the Boreal Valley\r\nCrystal Sage\r\nCurse-Rotted Greatwood\r\nDeacons of the Deep\r\nHigh Lord Wolnir\r\nOld Demon King\r\nYhorm The Giant\r\nPontiff Sulyvahn\r\nAldrich Devourer of Gods\r\nDancer of the Boreal Valley', '91.66.249.29', '2018-04-14 12:56:25'),
(47, 'weapons', 'edit.ajax', 5, 'weaponsName', '', 'crow talons', '91.66.249.29', '2018-04-14 12:57:49'),
(48, 'kills', 'Edit', 1, 'joker', '0', '1', '91.66.249.29', '2018-04-14 13:50:08'),
(49, 'kills', 'Edit', 1, 'spent', '0', '1', '91.66.249.29', '2018-04-14 13:50:08'),
(50, 'kills', 'Edit', 1, 'bossNames', '0', 'Ancient Wyvern', '91.66.249.29', '2018-04-14 13:50:08'),
(51, 'kills', 'Edit', 3, 'joker', '10', '11', '91.66.249.29', '2018-04-14 17:00:25'),
(52, 'kills', 'Edit', 3, 'spent', '10', '10', '91.66.249.29', '2018-04-14 17:00:25'),
(53, 'kills', 'Edit', 3, 'bossNames', 'Vordt of the Boreal Valley\r\nCrystal Sage\r\nCurse-Rotted Greatwood\r\nDeacons of the Deep\r\nHigh Lord Wolnir\r\nOld Demon King\r\nYhorm The Giant\r\nPontiff Sulyvahn\r\nAldrich Devourer of Gods\r\nDancer of the Boreal Valley', 'Vordt of the Boreal Valley\r\nCrystal Sage\r\nCurse-Rotted Greatwood\r\nDeacons of the Deep\r\nHigh Lord Wolnir\r\nOld Demon King\r\nYhorm The Giant\r\nPontiff Sulyvahn\r\nAldrich Devourer of Gods\r\nDancer of the Boreal Valley\r\nChampion Gyunsüe', '91.66.249.29', '2018-04-14 17:00:25'),
(54, 'weapons', 'Edit', 3, 'weaponsName', 'Black Knight sword', 'Chaosblade', '91.66.249.29', '2018-04-14 17:17:18'),
(55, 'weapons', 'Edit', 20, 'weaponsName', 'Yorshka\'s Spear', 'Blackknight Piekser', '91.66.249.29', '2018-04-14 17:18:17'),
(56, 'weapons', 'Edit', 20, 'weaponsName', 'Blackknight Piekser', 'Blackknight Gleave', '91.66.249.29', '2018-04-14 17:18:43'),
(57, 'kills', 'Edit', 3, 'joker', '11', '11', '91.66.249.29', '2018-04-14 17:25:24'),
(58, 'kills', 'Edit', 3, 'spent', '10', '11', '91.66.249.29', '2018-04-14 17:25:24'),
(59, 'kills', 'Edit', 3, 'bossNames', 'Vordt of the Boreal Valley\r\nCrystal Sage\r\nCurse-Rotted Greatwood\r\nDeacons of the Deep\r\nHigh Lord Wolnir\r\nOld Demon King\r\nYhorm The Giant\r\nPontiff Sulyvahn\r\nAldrich Devourer of Gods\r\nDancer of the Boreal Valley\r\nChampion Gyunsüe', 'Vordt of the Boreal Valley\r\nCrystal Sage\r\nCurse-Rotted Greatwood\r\nDeacons of the Deep\r\nHigh Lord Wolnir\r\nOld Demon King\r\nYhorm The Giant\r\nPontiff Sulyvahn\r\nAldrich Devourer of Gods\r\nDancer of the Boreal Valley\r\nChampion Gyunsüe', '91.66.249.29', '2018-04-14 17:25:24'),
(60, 'kills', 'Edit', 2, 'joker', '3', '4', '91.66.249.29', '2018-04-14 19:03:27'),
(61, 'kills', 'Edit', 2, 'spent', '2', '2', '91.66.249.29', '2018-04-14 19:03:27'),
(62, 'kills', 'Edit', 2, 'bossNames', 'Iudex Gundyr\r\nAbyss Watchers\r\nOceiros', 'Iudex Gundyr\r\nAbyss Watchers\r\nOceiros\r\nDraonslayer Armour', '91.66.249.29', '2018-04-14 19:03:27'),
(63, 'kills', 'Edit', 2, 'joker', '4', '4', '91.66.249.29', '2018-04-14 19:06:20'),
(64, 'kills', 'Edit', 2, 'spent', '2', '3', '91.66.249.29', '2018-04-14 19:06:20'),
(65, 'kills', 'Edit', 2, 'bossNames', 'Iudex Gundyr\r\nAbyss Watchers\r\nOceiros\r\nDraonslayer Armour', 'Iudex Gundyr\r\nAbyss Watchers\r\nOceiros\r\nDraonslayer Armour', '91.66.249.29', '2018-04-14 19:06:20'),
(66, 'boss', 'edit.ajax', 7, 'bossName', '', 'Nur R2 ', '91.66.249.29', '2018-04-14 20:17:17');

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
(21, 21, 'Symbol of Aids'),
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
(1, '2018-04-14 10:13:28', '95.90.230.5', '', ''),
(2, '2018-04-14 11:09:48', '91.66.249.29', 'Crap Waffe', 'Symbol of Aids'),
(3, '2018-04-14 11:09:55', '91.66.249.29', 'Invert Controls', 'Jäscher: Normal'),
(4, '2018-04-14 11:10:06', '91.66.249.29', 'Ohne Alles', 'Flask Würfeln (3) '),
(5, '2018-04-14 11:10:08', '91.66.249.29', 'Crap Waffe', 'Symbol of Aids'),
(6, '2018-04-14 11:10:16', '91.66.249.29', 'Ohne Ringe', 'Astora Greatsword'),
(7, '2018-04-14 11:11:04', '91.66.249.29', 'Kill on Sight', 'Normal'),
(8, '2018-04-14 11:13:18', '91.66.249.29', 'Ohne Alles', 'Normal'),
(9, '2018-04-14 12:15:09', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Lumbe', 'Ohne Alles'),
(10, '2018-04-14 12:16:08', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Kill on Sight', 'Waffe linke Hand'),
(11, '2018-04-14 12:41:37', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', '', ''),
(12, '2018-04-14 12:41:38', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', '', ''),
(13, '2018-04-14 12:42:01', '91.66.249.29', '', ''),
(14, '2018-04-14 12:42:01', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', '', ''),
(15, '2018-04-14 12:42:14', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Crap Ringe', 'Jäscher: Symbol of Aids'),
(16, '2018-04-14 12:46:55', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', '', ''),
(17, '2018-04-14 12:47:05', '91.66.249.29', '', ''),
(18, '2018-04-14 12:47:05', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', '', ''),
(19, '2018-04-14 12:50:07', '91.66.249.29', 'Parry', 'Crap Ringe'),
(20, '2018-04-14 12:56:14', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', '', ''),
(21, '2018-04-14 12:56:25', '91.66.249.29', '', ''),
(22, '2018-04-14 12:56:25', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', '', ''),
(23, '2018-04-14 13:22:27', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Parry', 'Ohne Schild'),
(24, '2018-04-14 13:26:23', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Kill on Sight', 'Lumbe'),
(25, '2018-04-14 13:27:53', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', '', ''),
(26, '2018-04-14 13:27:53', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', '', ''),
(27, '2018-04-14 13:30:02', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Invade', 'Symbol of Aids'),
(28, '2018-04-14 13:31:52', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Waffe linke Hand', 'Ohne Schild'),
(29, '2018-04-14 13:32:43', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Invert Controls', 'Ohne Alles'),
(30, '2018-04-14 13:37:04', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Brigand Axe', 'Fatroll'),
(31, '2018-04-14 13:40:37', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Ohne Schild', 'Symbol of Aids'),
(32, '2018-04-14 13:44:32', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Crap Ringe', 'Feige: Crap Waffe'),
(33, '2018-04-14 13:49:57', '91.66.249.29', '', ''),
(34, '2018-04-14 13:50:08', '91.66.249.29', '', ''),
(35, '2018-04-14 13:50:08', '91.66.249.29', '', ''),
(36, '2018-04-14 13:50:29', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Jäscher: Crap Waffe', 'Fatroll'),
(37, '2018-04-14 13:52:51', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Symbol of Aids', 'Ohne Rüstung'),
(38, '2018-04-14 14:03:03', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Parry', 'Flask Würfeln (11) '),
(39, '2018-04-14 14:05:15', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Ohne Schild', 'Ohne Schild'),
(40, '2018-04-14 14:11:25', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Normal', 'Ohne Schild'),
(41, '2018-04-14 14:12:13', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Crap Waffe', 'Nur R2'),
(42, '2018-04-14 14:14:58', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Ohne Schild', 'Nur R2'),
(43, '2018-04-14 14:26:07', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Invade', 'Jäscher: Normal'),
(44, '2018-04-14 15:11:41', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Lumbe', 'Ohne Alles'),
(45, '2018-04-14 16:17:55', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Feige: Crap Waffe', 'Ohne Alles'),
(46, '2018-04-14 16:22:34', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Arstor\'s Spear', 'Crap Waffe'),
(47, '2018-04-14 16:27:40', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Jäscher: Nur R2', 'Nur R2'),
(48, '2018-04-14 16:32:52', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Symbol of Aids', 'Normal'),
(49, '2018-04-14 16:41:24', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Normal', 'Nur R2'),
(50, '2018-04-14 16:45:21', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'wolnirs holy sword', 'Ohne Alles'),
(51, '2018-04-14 16:48:22', '91.66.249.29', '', ''),
(52, '2018-04-14 16:48:24', '91.66.249.29', '', ''),
(53, '2018-04-14 16:50:20', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Ohne Alles', 'Ohne Rüstung'),
(54, '2018-04-14 16:53:30', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', '', ''),
(55, '2018-04-14 16:53:31', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', '', ''),
(56, '2018-04-14 16:53:36', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', '', ''),
(57, '2018-04-14 16:55:12', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Parry', 'Waffe linke Hand'),
(58, '2018-04-14 16:59:45', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Ohne Rüstung', 'Flask Würfeln (14) '),
(59, '2018-04-14 17:00:09', '91.66.249.29', '', ''),
(60, '2018-04-14 17:00:25', '91.66.249.29', '', ''),
(61, '2018-04-14 17:00:25', '91.66.249.29', '', ''),
(62, '2018-04-14 17:17:05', '91.66.249.29', '', ''),
(63, '2018-04-14 17:17:18', '91.66.249.29', '', ''),
(64, '2018-04-14 17:17:18', '91.66.249.29', '', ''),
(65, '2018-04-14 17:18:06', '91.66.249.29', '', ''),
(66, '2018-04-14 17:18:17', '91.66.249.29', '', ''),
(67, '2018-04-14 17:18:17', '91.66.249.29', '', ''),
(68, '2018-04-14 17:18:35', '91.66.249.29', '', ''),
(69, '2018-04-14 17:18:43', '91.66.249.29', '', ''),
(70, '2018-04-14 17:18:43', '91.66.249.29', '', ''),
(71, '2018-04-14 17:25:21', '91.66.249.29', '', ''),
(72, '2018-04-14 17:25:24', '91.66.249.29', '', ''),
(73, '2018-04-14 17:25:24', '91.66.249.29', '', ''),
(74, '2018-04-14 18:13:20', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Crap Ringe', 'Ohne Schild'),
(75, '2018-04-14 18:14:58', '91.66.249.29', '', ''),
(76, '2018-04-14 18:15:47', '91.66.249.29', '', ''),
(77, '2018-04-14 18:24:51', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Ohne Rüstung', 'Feige: Ohne Rüstung'),
(78, '2018-04-14 18:36:27', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Ohne Rüstung', 'Handaxe'),
(79, '2018-04-14 18:48:30', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Flask Würfeln (6) ', 'Feige: Flask Würfeln (8) '),
(80, '2018-04-14 19:03:15', '91.66.249.29', '', ''),
(81, '2018-04-14 19:03:17', '91.66.249.29', '', ''),
(82, '2018-04-14 19:03:27', '91.66.249.29', '', ''),
(83, '2018-04-14 19:03:27', '91.66.249.29', '', ''),
(84, '2018-04-14 19:03:51', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Ohne Schild', 'Lumbe'),
(85, '2018-04-14 19:05:56', '91.66.249.29', '', ''),
(86, '2018-04-14 19:06:20', '91.66.249.29', '', ''),
(87, '2018-04-14 19:06:20', '91.66.249.29', '', ''),
(88, '2018-04-14 19:19:41', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Normal', 'Ohne Ringe'),
(89, '2018-04-14 19:24:37', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Crap Waffe', 'Ohne Ringe'),
(90, '2018-04-14 20:28:03', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Nur R2', 'Nur R2 '),
(91, '2018-04-14 20:45:18', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Normal', 'Waffe linke Hand'),
(92, '2018-04-14 21:25:45', '2a02:810b:c540:5fb4:2c5e:b128:2064:9a1', 'Nur R2', 'Ohne Rüstung'),
(93, '2018-04-14 22:30:02', '2a02:810b:c540:5fb4:9186:1b31:cd:960b', 'Symbol of Aids', 'Normal'),
(94, '2018-04-14 23:18:17', '91.66.249.29', 'Symbol of Aids', 'Normal'),
(95, '2018-04-14 23:18:25', '91.66.249.29', 'Ohne Schild', 'Jäscher: Lumbe'),
(96, '2018-04-14 23:21:56', '91.66.249.29', 'Flask Würfeln (2) ', 'Drang Hammers'),
(97, '2018-04-15 10:23:12', '95.90.230.5', 'Ohne Alles', 'Symbol of Aids'),
(98, '2018-04-15 10:23:20', '95.90.230.5', 'No Dodge/Run', 'Ohne Rüstung'),
(99, '2018-04-15 15:57:23', '109.173.25.162', '', ''),
(100, '2018-04-15 17:34:01', '95.90.230.5', '', ''),
(101, '2018-04-15 19:23:27', '95.90.230.5', '', ''),
(102, '2018-04-15 19:33:35', '95.90.230.5', 'Ohne Ringe', 'Symbol of Aids'),
(103, '2018-04-16 09:00:53', '95.90.230.5', 'Symbol of Aids', 'Flask Würfeln (10) '),
(104, '2018-04-16 09:04:01', '95.90.230.5', 'Ohne Flask', 'Waffe linke Hand'),
(105, '2018-04-16 09:04:03', '95.90.230.5', 'Normal', 'Ohne Alles'),
(106, '2018-04-16 09:04:33', '95.90.230.5', 'Lumbe', 'Ohne Ringe'),
(107, '2018-04-16 09:04:35', '95.90.230.5', 'Ohne Rüstung', 'Ohne Schild'),
(108, '2018-04-16 09:04:53', '95.90.230.5', 'Waffe linke Hand', 'Pickaxe'),
(109, '2018-04-16 09:05:08', '95.90.230.5', 'Parry', 'Ohne Alles'),
(110, '2018-04-16 09:05:26', '95.90.230.5', 'Ohne Alles', 'Ohne Schild'),
(111, '2018-04-16 09:05:29', '95.90.230.5', 'Invade', 'Chaosblade'),
(112, '2018-04-16 09:07:02', '95.90.230.5', 'Invert Controls', 'Ohne Alles'),
(113, '2018-04-16 09:07:24', '95.90.230.5', 'Parry', 'wolnirs holy sword'),
(114, '2018-04-16 09:07:34', '95.90.230.5', 'Lumbe', 'Lumbe'),
(115, '2018-04-16 09:07:35', '95.90.230.5', 'Normal', 'Ohne Alles'),
(116, '2018-04-16 09:08:30', '95.90.230.5', 'Nur R2', 'Ohne Ringe'),
(117, '2018-04-16 09:08:33', '95.90.230.5', 'Ohne Schild', 'Ohne Ringe'),
(118, '2018-04-16 09:08:37', '95.90.230.5', '', ''),
(119, '2018-04-16 09:10:15', '95.90.230.5', 'Ohne Flask', 'Symbol of Aids'),
(120, '2018-04-16 09:10:48', '95.90.230.5', '', ''),
(121, '2018-04-16 09:12:45', '95.90.230.5', 'Nur R2', 'Crap Waffe'),
(122, '2018-04-16 09:12:47', '95.90.230.5', 'Barbed Straight Sword', 'Crap Ringe'),
(123, '2018-04-16 09:13:49', '95.90.230.5', 'No Dodge/Run', 'Ohne Schild'),
(124, '2018-04-16 09:13:51', '95.90.230.5', 'Symbol of Aids', 'Lumbe'),
(125, '2018-04-16 09:13:53', '95.90.230.5', 'Ohne Flask', 'Executioner\'s Greatsword'),
(126, '2018-04-16 09:14:29', '95.90.230.5', 'Nur R2', 'Ohne Alles'),
(127, '2018-04-16 09:14:31', '95.90.230.5', 'Ohne Ringe', 'Crap Waffe'),
(128, '2018-04-16 09:14:32', '95.90.230.5', 'Normal', 'Normal'),
(129, '2018-04-16 09:14:35', '95.90.230.5', 'Nur R2', 'Normal'),
(130, '2018-04-16 09:14:46', '95.90.230.5', 'Executioner\'s Greatsword', 'Normal'),
(131, '2018-04-16 09:14:47', '95.90.230.5', 'Ohne Flask', 'Lumbe'),
(132, '2018-04-16 09:19:12', '95.90.230.5', 'Ohne Rüstung', 'Lumbe'),
(133, '2018-04-16 09:19:14', '95.90.230.5', 'Invade', 'Ohne Rüstung'),
(134, '2018-04-16 09:19:25', '95.90.230.5', 'Invade', 'Ohne Rüstung'),
(135, '2018-04-16 10:03:38', '95.90.230.5', 'Ohne Alles', 'Lumbe'),
(136, '2018-04-16 10:03:49', '95.90.230.5', 'Flask Würfeln (14) ', 'wolnirs holy sword'),
(137, '2018-04-16 12:55:01', '95.90.230.5', 'Parry', 'Normal'),
(138, '2018-04-16 12:55:26', '91.66.249.29', 'Waffe linke Hand', 'Ohne Alles'),
(139, '2018-04-16 12:55:42', '95.90.230.5', '', ''),
(140, '2018-04-16 12:57:58', '95.90.230.5', '', ''),
(141, '2018-04-16 12:58:05', '95.90.230.5', 'Lumbe', 'Normal'),
(142, '2018-04-16 13:32:53', '95.90.230.5', 'No Dodge/Run', 'Lumbe'),
(143, '2018-04-16 13:33:19', '95.90.230.5', 'Ohne Schild', 'Barbed Straight Sword'),
(144, '2018-04-16 13:33:50', '95.90.230.5', 'Symbol of Aids', 'Flask Würfeln (2) '),
(145, '2018-04-16 13:46:45', '95.90.230.5', 'Normal', 'Ohne Alles'),
(146, '2018-04-16 13:46:53', '95.90.230.5', '', ''),
(147, '2018-04-16 13:47:02', '95.90.230.5', 'Ohne Alles', 'Ohne Schild'),
(148, '2018-04-16 13:49:29', '95.90.230.5', 'Feige: Ohne Ringe', 'Jäscher: Lumbe'),
(149, '2018-04-16 13:49:40', '95.90.230.5', 'Nur R2', 'Symbol of Aids'),
(150, '2018-04-16 13:50:40', '95.90.230.5', 'Crap Waffe', 'Normal'),
(151, '2018-04-16 13:51:50', '95.90.230.5', '', ''),
(152, '2018-04-16 13:52:00', '95.90.230.5', '', ''),
(153, '2018-04-16 13:56:58', '95.90.230.5', 'Ohne Schild', 'Crap Waffe'),
(154, '2018-04-16 14:01:28', '95.90.230.5', 'Symbol of Aids', 'Normal'),
(155, '2018-04-16 14:21:54', '95.90.230.5', '', ''),
(156, '2018-04-16 14:21:55', '95.90.230.5', '', ''),
(157, '2018-04-16 14:21:56', '95.90.230.5', '', ''),
(158, '2018-04-16 14:29:36', '95.90.230.5', 'Lumbe', 'Ohne Ringe'),
(159, '2018-04-16 14:29:45', '95.90.230.5', 'Ohne Ringe', 'Ohne Ringe'),
(160, '2018-04-16 15:34:35', '95.90.230.5', 'Normal', 'Crap Ringe'),
(161, '2018-04-16 18:22:19', '95.90.230.5', 'Waffe linke Hand', 'Waffe linke Hand'),
(162, '2018-04-16 18:22:24', '95.90.230.5', 'Symbol of Aids', 'Crap Waffe'),
(163, '2018-04-16 18:22:31', '95.90.230.5', '', ''),
(164, '2018-04-16 18:22:31', '95.90.230.5', '', ''),
(165, '2018-04-16 18:22:38', '95.90.230.5', '', ''),
(166, '2018-04-16 18:39:00', '95.90.230.5', 'Crap Waffe', 'Ohne Rüstung'),
(167, '2018-04-16 18:39:04', '95.90.230.5', 'Flask Würfeln (5) ', 'Normal'),
(168, '2018-04-16 18:39:13', '95.90.230.5', 'Invade', 'Feige: Crap Ringe'),
(169, '2018-04-16 18:39:19', '95.90.230.5', 'Feige: Crap Waffe', 'Crap Waffe'),
(170, '2018-04-16 18:39:26', '95.90.230.5', 'Flask Würfeln (12) ', 'Brigand Axe'),
(171, '2018-04-16 18:39:32', '95.90.230.5', 'Crap Waffe', 'Ohne Ringe'),
(172, '2018-04-16 18:55:48', '95.90.230.5', 'Jäscher: Waffe linke Hand', 'Feige: Crap Ringe'),
(173, '2018-04-16 19:10:23', '95.90.230.5', '', ''),
(174, '2018-04-16 19:10:27', '95.90.230.5', '', ''),
(175, '2018-04-16 19:28:40', '95.90.230.5', '', ''),
(176, '2018-04-16 20:08:30', '95.90.230.5', 'Invade', 'Ohne Rüstung'),
(177, '2018-04-16 20:08:41', '95.90.230.5', 'Soldering Iron', 'Crap Ringe'),
(178, '2018-04-16 20:08:47', '95.90.230.5', 'Feige: Fatroll', 'Nur R2 '),
(179, '2018-04-16 20:40:21', '95.90.230.5', 'Ohne Rüstung', 'Ohne Ringe'),
(180, '2018-04-16 20:40:28', '95.90.230.5', '', ''),
(181, '2018-04-16 20:40:29', '95.90.230.5', '', ''),
(182, '2018-04-16 20:40:32', '95.90.230.5', '', ''),
(183, '2018-04-16 20:40:34', '95.90.230.5', '', ''),
(184, '2018-04-16 22:49:40', '95.90.230.5', '', ''),
(185, '2018-04-16 22:50:52', '95.90.230.5', 'Ohne Ringe', 'Feige: Waffe linke Hand'),
(186, '2018-04-17 08:26:45', '95.90.230.5', 'Invert Controls', 'Symbol of Aids'),
(187, '2018-04-17 08:37:45', '95.90.230.5', '', '');

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
(1, '- 1 Schatztruhe Dungeon Frösche\n- Loot ithryll valley bei pointiff\n- Speer Typ bei Skelette, Loot bei Krabbe\n- bonfire dingens bei demon bonfire\n- Drache Loot\n- Ohne Backstab/Riposte/Plunge?\n- No Hit Run\n- Hunde unten beim Covenant\n- Dusk Crown Ringj\n- Magic Clutch Ring\n- Lightning Clutch Ring\n- Fire Clutch Ring\n- Dark Clutch Ring\n- Symbol of Aids, Carthus Bloodring\n- Calamity Ring\n- Symbol of Aids');

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
(3, 3, 'Chaosblade'),
(4, 4, 'Great Club'),
(5, 5, 'crow talons'),
(6, 6, 'Handaxe'),
(7, 7, 'Rotten Spear'),
(8, 8, 'Brigand Axe'),
(9, 9, 'Partizan'),
(10, 10, 'Soldering Iron'),
(11, 11, 'Executioner\'s Greatsword'),
(12, 12, 'Barbed Straight Sword'),
(13, 13, 'Dark Sword'),
(14, 14, 'Astora Greatsword'),
(15, 15, 'Butcher Knife'),
(16, 16, 'Drang Hammers'),
(17, 17, 'Arstor\'s Spear'),
(18, 18, 'Whip'),
(19, 19, 'wolnirs holy sword'),
(20, 20, 'Blackknight Gleave');

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
-- Indizes für die Tabelle `global`
--
ALTER TABLE `global`
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
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT für Tabelle `ds3`
--
ALTER TABLE `ds3`
  MODIFY `ID` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT für Tabelle `log`
--
ALTER TABLE `log`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT für Tabelle `mobs`
--
ALTER TABLE `mobs`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT für Tabelle `rolls`
--
ALTER TABLE `rolls`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;
--
-- AUTO_INCREMENT für Tabelle `weapons`
--
ALTER TABLE `weapons`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
