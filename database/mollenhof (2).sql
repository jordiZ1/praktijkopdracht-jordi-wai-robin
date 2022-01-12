-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 23 jun 2021 om 12:05
-- Serverversie: 10.4.11-MariaDB
-- PHP-versie: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mollenhof`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `beschikbaarheid`
--

CREATE TABLE `beschikbaarheid` (
  `gebruiker_id` int(255) NOT NULL,
  `ma` varchar(255) NOT NULL,
  `di` varchar(255) NOT NULL,
  `wo` varchar(255) NOT NULL,
  `do` varchar(255) NOT NULL,
  `vr` varchar(255) NOT NULL,
  `za` varchar(255) NOT NULL,
  `zo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `beschikbaarheid`
--

INSERT INTO `beschikbaarheid` (`gebruiker_id`, `ma`, `di`, `wo`, `do`, `vr`, `za`, `zo`) VALUES
(9, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
(13, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruiker`
--

CREATE TABLE `gebruiker` (
  `gebruiker_id` int(255) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `beroep` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gebruiker`
--

INSERT INTO `gebruiker` (`gebruiker_id`, `naam`, `email`, `wachtwoord`, `admin`, `beroep`) VALUES
(9, 'admin', 'admin', 'admin', 1, 'admin'),
(13, 'Jordi', 'jordizweden@gmail.com', '123', 1, 'test beheerder');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `projecten`
--

CREATE TABLE `projecten` (
  `project_id` int(255) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `begindatum` date NOT NULL,
  `einddatum` date NOT NULL,
  `tijd` varchar(255) NOT NULL,
  `personen` int(255) NOT NULL,
  `beschrijving` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `project_dagen`
--

CREATE TABLE `project_dagen` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `begin_tijd` time NOT NULL,
  `eind_tijd` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `project_leden`
--

CREATE TABLE `project_leden` (
  `project_id` int(255) NOT NULL,
  `gebruiker_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `vrije_dagen`
--

CREATE TABLE `vrije_dagen` (
  `vrij_aanvraag_id` int(255) NOT NULL,
  `gebruiker_id` int(255) NOT NULL,
  `dag` date NOT NULL,
  `beschrijving` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `beschikbaarheid`
--
ALTER TABLE `beschikbaarheid`
  ADD PRIMARY KEY (`gebruiker_id`);

--
-- Indexen voor tabel `gebruiker`
--
ALTER TABLE `gebruiker`
  ADD PRIMARY KEY (`gebruiker_id`);

--
-- Indexen voor tabel `projecten`
--
ALTER TABLE `projecten`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexen voor tabel `project_dagen`
--
ALTER TABLE `project_dagen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `project_leden`
--
ALTER TABLE `project_leden`
  ADD PRIMARY KEY (`project_id`,`gebruiker_id`);

--
-- Indexen voor tabel `vrije_dagen`
--
ALTER TABLE `vrije_dagen`
  ADD PRIMARY KEY (`vrij_aanvraag_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `gebruiker`
--
ALTER TABLE `gebruiker`
  MODIFY `gebruiker_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT voor een tabel `projecten`
--
ALTER TABLE `projecten`
  MODIFY `project_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `project_dagen`
--
ALTER TABLE `project_dagen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `vrije_dagen`
--
ALTER TABLE `vrije_dagen`
  MODIFY `vrij_aanvraag_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
