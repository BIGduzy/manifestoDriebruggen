-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 11 jun 2014 om 17:32
-- Serverversie: 5.5.24-log
-- PHP-versie: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `manifestodriebruggen`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artiest`
--

CREATE TABLE IF NOT EXISTS `artiest` (
  `artiest_id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(80) DEFAULT NULL,
  `omschrijving` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `geluids_fragment` text,
  `video_fragment` text,
  `website` text,
  PRIMARY KEY (`artiest_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `artiest`
--

INSERT INTO `artiest` (`artiest_id`, `naam`, `omschrijving`, `foto`, `geluids_fragment`, `video_fragment`, `website`) VALUES
(1, 'test_artiest', 'test artiest 1', '', NULL, NULL, NULL),
(2, 'test_artiest2', 'test artiest 2', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artiesten_groep`
--

CREATE TABLE IF NOT EXISTS `artiesten_groep` (
  `artiesten_groep_id` int(11) NOT NULL,
  `optreden` int(11) NOT NULL,
  `artiest` int(11) NOT NULL,
  PRIMARY KEY (`artiesten_groep_id`),
  UNIQUE KEY `artiesten_id_UNIQUE` (`artiesten_groep_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling`
--

CREATE TABLE IF NOT EXISTS `bestelling` (
  `bestelling_id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `optreden` int(11) NOT NULL,
  `aantal` int(11) NOT NULL,
  PRIMARY KEY (`bestelling_id`),
  KEY `klant` (`user`),
  KEY `optreden` (`optreden`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `genre_id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(80) NOT NULL,
  PRIMARY KEY (`genre_id`,`naam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `genre_artiest`
--

CREATE TABLE IF NOT EXISTS `genre_artiest` (
  `genre` int(11) NOT NULL,
  `artiest` int(11) NOT NULL,
  PRIMARY KEY (`genre`,`artiest`),
  KEY `artiest` (`artiest`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `mailing_list`
--

CREATE TABLE IF NOT EXISTS `mailing_list` (
  `mailinglist_id` int(11) NOT NULL AUTO_INCREMENT,
  `klant` int(11) NOT NULL,
  `genre` int(11) DEFAULT NULL,
  `artiesten` text,
  PRIMARY KEY (`mailinglist_id`),
  KEY `klant` (`klant`),
  KEY `genre` (`genre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `optreden`
--

CREATE TABLE IF NOT EXISTS `optreden` (
  `optreden_id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date NOT NULL,
  `artiest` int(11) NOT NULL,
  `zaal` int(11) NOT NULL,
  `uitverkocht` tinyint(1) DEFAULT NULL,
  `kaarten_beschikbaar` int(11) NOT NULL,
  `kaarten_verkocht` int(11) DEFAULT NULL,
  `afgelast` tinyint(1) NOT NULL,
  `datum_uitverkocht` date NOT NULL,
  `foto` varchar(255) NOT NULL,
  PRIMARY KEY (`optreden_id`),
  KEY `artiest` (`artiest`),
  KEY `zaal` (`zaal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Gegevens worden uitgevoerd voor tabel `optreden`
--

INSERT INTO `optreden` (`optreden_id`, `datum`, `artiest`, `zaal`, `uitverkocht`, `kaarten_beschikbaar`, `kaarten_verkocht`, `afgelast`, `datum_uitverkocht`, `foto`) VALUES
(1, '2014-06-25', 1, 1, 0, 10, 0, 0, '2014-06-30', 'Lewis_Black.jpg'),
(2, '2014-06-25', 1, 1, 0, 10, 0, 0, '2014-06-30', 'War_Horse.jpg'),
(3, '2014-06-25', 1, 1, 0, 10, 0, 0, '2014-06-30', 'War_Horse.jpg'),
(4, '2014-06-25', 1, 1, 0, 10, 0, 0, '2014-06-30', 'War_Horse.jpg'),
(5, '2014-06-25', 1, 1, 0, 10, 0, 0, '2014-06-30', 'Lewis_Black.jpg'),
(6, '2014-06-25', 1, 1, 0, 10, 0, 0, '2014-06-30', 'Lewis_Black.jpg'),
(7, '2014-06-25', 1, 1, 0, 10, 0, 0, '2014-06-30', 'Lewis_Black.jpg'),
(8, '2014-06-25', 1, 1, 0, 10, 0, 0, '2014-06-30', 'War_Horse.jpg'),
(9, '2014-06-25', 1, 1, 0, 10, 0, 0, '2014-06-30', 'War_Horse.jpg'),
(10, '2014-06-25', 1, 1, 0, 10, 0, 0, '2014-06-30', 'Lewis_Black.jpg'),
(11, '2014-06-25', 1, 1, 0, 10, 0, 0, '2014-06-30', 'Lewis_Black.jpg'),
(12, '2014-06-25', 1, 1, 0, 10, 0, 0, '2014-06-30', 'War_Horse.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `persbericht`
--

CREATE TABLE IF NOT EXISTS `persbericht` (
  `persbericht_id` int(11) NOT NULL AUTO_INCREMENT,
  `titel` varchar(80) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`persbericht_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `userroles`
--

CREATE TABLE IF NOT EXISTS `userroles` (
  `userrole_id` int(11) NOT NULL,
  `userrole` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`userrole_id`),
  UNIQUE KEY `userrole_id_UNIQUE` (`userrole_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `userroles`
--

INSERT INTO `userroles` (`userrole_id`, `userrole`) VALUES
(1, 'administrator'),
(2, 'user');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(80) NOT NULL,
  `achternaam` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `wachtwoord` text NOT NULL,
  `userrole` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`email`),
  KEY `fk_klant_userrole_idx` (`userrole`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `voornaam`, `achternaam`, `email`, `wachtwoord`, `userrole`) VALUES
(1, 'admin', 'achternaam', 'admin@gmail.com', 'geheim', 1),
(2, 'user', 'achternaam', 'user@gmail.com', 'geheim', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `zaal`
--

CREATE TABLE IF NOT EXISTS `zaal` (
  `zaal_id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(80) NOT NULL,
  `status` enum('vrij','schoonmaak','ingebruik') NOT NULL,
  `plaatsen` int(11) NOT NULL,
  PRIMARY KEY (`zaal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `zaal`
--

INSERT INTO `zaal` (`zaal_id`, `naam`, `status`, `plaatsen`) VALUES
(1, 'test_zaal', 'vrij', 165),
(2, 'test_zaal2', 'vrij', 199);

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `bestelling`
--
ALTER TABLE `bestelling`
  ADD CONSTRAINT `bestelling_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bestelling_ibfk_2` FOREIGN KEY (`optreden`) REFERENCES `optreden` (`optreden_id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `genre_artiest`
--
ALTER TABLE `genre_artiest`
  ADD CONSTRAINT `genre_artiest_ibfk_1` FOREIGN KEY (`genre`) REFERENCES `genre` (`genre_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `genre_artiest_ibfk_2` FOREIGN KEY (`artiest`) REFERENCES `artiest` (`artiest_id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `mailing_list`
--
ALTER TABLE `mailing_list`
  ADD CONSTRAINT `mailing_list_ibfk_1` FOREIGN KEY (`klant`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mailing_list_ibfk_2` FOREIGN KEY (`genre`) REFERENCES `genre` (`genre_id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `optreden`
--
ALTER TABLE `optreden`
  ADD CONSTRAINT `optreden_ibfk_1` FOREIGN KEY (`artiest`) REFERENCES `artiest` (`artiest_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `optreden_ibfk_2` FOREIGN KEY (`zaal`) REFERENCES `zaal` (`zaal_id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_klant_userrole` FOREIGN KEY (`userrole`) REFERENCES `userroles` (`userrole_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
