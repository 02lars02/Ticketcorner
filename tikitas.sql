-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 15. Apr 2019 um 18:51
-- Server-Version: 10.1.38-MariaDB
-- PHP-Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- DROP DATABASE IF EXISTS `tikitas`;
-- CREATE DATABASE `tikitas` DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;;

-- USE `tikitas`;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `tikitas`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bonus`
--

CREATE TABLE `bonus` (
  `id` int(11) NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `termReduction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `bonus`
--

INSERT INTO `bonus` (`id`, `text`, `termReduction`) VALUES
(1, 'kein Rabatt', 0),
(2, '5% Rabatt', 10),
(3, '10% Rabatt', 15),
(4, '15% Rabatt', 20);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `concerts`
--

CREATE TABLE `concerts` (
  `id` int(11) NOT NULL,
  `artist` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `concerts`
--

INSERT INTO `concerts` (`id`, `artist`) VALUES
(1, 'The Beatles'),
(2, 'Elvis Presley'),
(3, 'Michael Jackson'),
(4, 'Madonna'),
(5, 'Elton John'),
(6, 'ABBA'),
(7, 'Led Zeppelin'),
(8, 'Pink Floyd'),
(9, 'Mariah Carey'),
(10, 'Céline Dion'),
(11, 'AC/DC'),
(12, 'Whitney Houston'),
(13, 'Queen'),
(14, 'The Rolling Stones'),
(15, 'Rihanna'),
(16, 'Taylor Swift'),
(17, 'Eminem'),
(18, 'Garth Brooks'),
(19, 'Eagles'),
(20, 'U2'),
(21, 'Billy Joel'),
(22, 'Phil Collins'),
(23, 'Aerosmith'),
(24, 'Frank Sinatra'),
(25, 'Barbra Streisand'),
(26, 'Bon Jovi'),
(27, 'Genesis'),
(28, 'Donna Summer'),
(29, 'Neil Diamond'),
(30, 'Kanye West'),
(31, 'Bruce Springsteen'),
(32, 'Bee Gees'),
(33, 'Julio Iglesias'),
(34, 'Dire Straits'),
(35, 'Lady Gaga'),
(36, 'Metallica'),
(37, 'Bruno Mars'),
(38, 'Jay Z'),
(39, 'Rod Stewart'),
(40, 'Britney Spears'),
(41, 'Fleetwood Mac'),
(42, 'George Strait'),
(43, 'Backstreet Boys'),
(44, 'Guns N’ Roses'),
(45, 'Prince'),
(46, 'Paul McCartney'),
(47, 'Kenny Rogers'),
(48, 'Janet Jackson'),
(49, 'Chicago'),
(50, 'The Carpenters'),
(51, 'Bob Dylan'),
(52, 'George Michael'),
(53, 'Bryan Adams'),
(54, 'Def Leppard'),
(55, 'Cher'),
(56, 'Lionel Richie'),
(57, 'Olivia Newton-John'),
(58, 'Stevie Wonder'),
(59, 'Tina Turner'),
(60, 'Kiss'),
(61, 'The Who'),
(62, 'Barry White'),
(63, 'Katy Perry'),
(64, 'Santana'),
(65, 'Earth, Wind & Fire'),
(66, 'Beyoncé'),
(67, 'Shania Twain'),
(68, 'R.E.M.'),
(69, 'B’z'),
(70, 'Coldplay'),
(71, 'Van Halen'),
(72, 'Red Hot Chili Peppers'),
(73, 'The Doors'),
(74, 'Barry Manilow'),
(75, 'Johnny Hallyday'),
(76, 'The Black Eyed Peas'),
(77, 'Journey'),
(78, 'Kenny G'),
(79, 'Enya'),
(80, 'Green Day'),
(81, 'Tupac Shakur'),
(82, 'Nirvana'),
(83, 'The Police'),
(84, 'Bob Marley'),
(85, 'Depeche Mode'),
(86, 'Aretha Franklin');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ticketbuys`
--

CREATE TABLE `ticketbuys` (
  `id` int(11) NOT NULL,
  `createDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fk_bonus` int(11) NOT NULL,
  `fk_concert` int(11) NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `bonus`
--
ALTER TABLE `bonus`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `concerts`
--
ALTER TABLE `concerts`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `ticketbuys`
--
ALTER TABLE `ticketbuys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bonus` (`fk_bonus`),
  ADD KEY `fk_concert` (`fk_concert`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bonus`
--
ALTER TABLE `bonus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `concerts`
--
ALTER TABLE `concerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `ticketbuys`
--
ALTER TABLE `ticketbuys`
  ADD CONSTRAINT `ticketbuys_ibfk_1` FOREIGN KEY (`fk_bonus`) REFERENCES `bonus` (`id`),
  ADD CONSTRAINT `ticketbuys_ibfk_2` FOREIGN KEY (`fk_concert`) REFERENCES `concerts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
