-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 03 jul 2014 om 12:30
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
  `website` text,
  PRIMARY KEY (`artiest_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `artiest`
--

INSERT INTO `artiest` (`artiest_id`, `naam`, `omschrijving`, `foto`, `website`) VALUES
(1, 'test_artiest', 'test artiest 1 omschrijving', 'portret-liselotte-van-saarloos.jpg', 'www.test_artiest.com'),
(2, 'test_artiest2', 'test artiest 2', '', NULL);

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
  `datum` datetime NOT NULL,
  PRIMARY KEY (`bestelling_id`),
  KEY `klant` (`user`),
  KEY `optreden` (`optreden`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `bestelling`
--

INSERT INTO `bestelling` (`bestelling_id`, `user`, `optreden`, `aantal`, `datum`) VALUES
(1, 2, 3, 3, '2014-07-03 11:40:54'),
(2, 2, 3, 1, '2014-07-03 11:41:30');

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
  PRIMARY KEY (`mailinglist_id`),
  KEY `klant` (`klant`),
  KEY `genre` (`genre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `mailing_list`
--

INSERT INTO `mailing_list` (`mailinglist_id`, `klant`, `genre`) VALUES
(1, 1, NULL),
(2, 2, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `optreden`
--

CREATE TABLE IF NOT EXISTS `optreden` (
  `optreden_id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` datetime NOT NULL,
  `artiest` int(11) NOT NULL,
  `zaal` int(11) NOT NULL,
  `kaart_prijs` decimal(18,2) NOT NULL,
  `kaarten_beschikbaar` int(11) NOT NULL,
  `totaal_kaarten_beschikbaar` int(11) NOT NULL,
  `afgelast` tinyint(1) NOT NULL COMMENT '0 = true, 1= false',
  `datum_uitverkocht` date NOT NULL,
  `foto` varchar(255) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `omschrijving` text NOT NULL,
  `geluidsfragment` text,
  `videofragment` text,
  PRIMARY KEY (`optreden_id`),
  KEY `artiest` (`artiest`),
  KEY `zaal` (`zaal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Gegevens worden uitgevoerd voor tabel `optreden`
--

INSERT INTO `optreden` (`optreden_id`, `datum`, `artiest`, `zaal`, `kaart_prijs`, `kaarten_beschikbaar`, `totaal_kaarten_beschikbaar`, `afgelast`, `datum_uitverkocht`, `foto`, `naam`, `omschrijving`, `geluidsfragment`, `videofragment`) VALUES
(1, '2014-06-25 00:00:00', 1, 1, '50.00', 10, 10, 1, '2014-06-30', 'Parelvissers.jpg', 'Nederlandse reisopera - parelvissers', '"De Nederlandse Reisopera heeft de harten veroverd van de operaliefhebbers. Eindelijk weer voorstellingen waarin heel erg goed wordt gezongen en de regie de muziek niet in de weg zit. Wij zijn er trots op dat al hun voorstellingen voortaan in ons theater te zien zijn. Een abonnement geeft dát extra''s wat een avondje opera nog leuker maakt."\n\nDe Parelvissers is één van die opera’s die ooit grote populariteit genoot. De muziek is jeugdig en fris en heeft een lichtvoetige toon. Het is een super goed idee van de Nederlandse Reis Opera om dit pareltje weer eens te spelen.\n\nHet Noord Nederlands Orkest, dat afgelopen seizoen een schitterend aandeel in Tristan und Isolde had, staat dit keer onder leiding van de  Franse dirigent Benjamin Levy.  De twee gezworen vrienden Nadir en Zurga worden net als de rol van Leïla gezongen door jonge zangers die aan de vooravond van een internationale carrière staan.\n\nDe parelvissers Nadir en Zurga waren ooit allebei verliefd op Leïla. Onverwacht verdween zij uit hun leven. Als de hogepriester een nieuwe tempeldienares introduceert, herkent Nadir in haar onmiddellijk zijn jeugdliefde. Maar helaas, op elk menselijk contact staat voor Leïla de dood. Nadir haar in de nacht op. De twee worden betrapt en Zurga, die leider is van het dorp, moet het doodvonnis uitspreken. Wanneer de dorpelingen samenstromen om de terechtstelling bij te wonen, steekt Zurga het dorp in brand. Hij bevrijdt Leïla en Nadir. De woedende dorpelingen grijpen hem en werpen Zurga op de brandstapel die bedoeld was voor de gevluchte minnaars.', 'Kalimba.mp3', 'xmhNiE8R6zs'),
(2, '2014-06-25 00:00:00', 1, 1, '50.00', 10, 10, 1, '2014-06-30', 'War_Horse.jpg', 'War horse', 'War horse omschrijving', NULL, NULL),
(3, '2014-06-25 00:00:00', 1, 1, '50.00', 6, 10, 1, '2014-06-30', 'War_Horse.jpg', 'War horse 2', 'War horse omschrijving 2', NULL, NULL),
(4, '2014-06-25 00:00:00', 1, 1, '50.00', 10, 10, 1, '2014-06-30', 'War_Horse.jpg', 'War horse 3', 'War horse omschrijving 3', NULL, NULL),
(5, '2014-06-25 00:00:00', 1, 1, '50.00', 10, 10, 1, '2014-06-30', 'Lewis_Black.jpg', 'Lewis black 2', 'Lewis black omschrijving 2', NULL, NULL),
(6, '2014-06-25 00:00:00', 1, 1, '50.00', 10, 10, 1, '2014-06-30', 'Lewis_Black.jpg', 'Lewis black 3', 'Lewis black omschrijving 3', NULL, NULL),
(7, '2014-06-25 00:00:00', 1, 1, '50.00', 10, 10, 1, '2014-06-30', 'Lewis_Black.jpg', 'Lewis black 4', 'Lewis black omschrijving 4', NULL, NULL),
(8, '2014-06-25 00:00:00', 1, 1, '50.00', 10, 10, 1, '2014-06-30', 'War_Horse.jpg', 'War horse 4', 'War horse omschrijving 4', NULL, NULL),
(9, '2014-06-25 00:00:00', 1, 1, '50.00', 10, 10, 1, '2014-06-30', 'War_Horse.jpg', 'War horse 5', 'War horse omschrijving 5', NULL, NULL),
(10, '2014-06-25 00:00:00', 1, 1, '50.00', 10, 10, 1, '2014-06-30', 'Lewis_Black.jpg', 'Lewis black 5', 'Lewis black omschrijving 5', NULL, NULL),
(11, '2014-06-25 00:00:00', 1, 1, '50.00', 10, 10, 1, '2014-06-30', 'Lewis_Black.jpg', 'Lewis black 6', 'Lewis black omschrijving 6', NULL, NULL),
(12, '2014-06-25 00:00:00', 1, 1, '50.00', 10, 10, 1, '2014-06-30', 'War_Horse.jpg', 'War horse 6', 'War horse omschrijving 6', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `persbericht`
--

CREATE TABLE IF NOT EXISTS `persbericht` (
  `persbericht_id` int(11) NOT NULL AUTO_INCREMENT,
  `titel` varchar(80) NOT NULL,
  `content` text NOT NULL,
  `website` text,
  PRIMARY KEY (`persbericht_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `persbericht`
--

INSERT INTO `persbericht` (`persbericht_id`, `titel`, `content`, `website`) VALUES
(1, 'Goed nieuws', 'Lorem ipsum dolor sit amet, mei laboramus consequuntur no. Vim vocent alienum eu. Ad adhuc vocent pro, brute doming labitur id nec. Ei duo senserit evertitur, odio commune facilisi nam et, no dicta consulatu pri. Antiopam recteque ex vel, mea verterem argumentum no, mel ad feugiat mediocritatem. Populo recusabo in usu, error meliore molestiae cum eu.\n\nPostea quaeque ex cum, tota novum oporteat pro eu. Repudiare dignissim in mea, no usu eleifend voluptaria, vel nullam percipit praesent ea. Eam ex incorrupte omittantur complectitur, ridens aliquid deterruisset his no, usu mediocrem contentiones comprehensam at. Vim ne quas omnis ubique. Cum ridens signiferumque id.\n\nCu affert eligendi has. Ei vero exerci repudiandae eum, virtute scriptorem ullamcorper ex per. Quodsi saperet molestie et eos, in meliore delectus vel, duo corpora recusabo no. Id sit inani explicari, tota delectus vituperatoribus no per, pro et debet invenire gloriatur.\n\nHarum ignota graecis duo ad, ad inani utinam per. Ex his labores voluptatibus. Mel sumo dicunt voluptaria ex. Et pri partem putant eligendi, idque nonumy signiferumque et vel. Duo zril nemore id, vim cu harum delicata.\n\nFabulas fuisset adipisci no vix, ad nostrud volumus nominati his, has an regione integre. Nam graeci deterruisset ea, sit viderer accusamus ei. Ridens deserunt senserit te his, omnium aperiri definitionem sed ad. Nam ex augue feugiat. Has at paulo appareat, ex ius accusamus hendrerit, option tincidunt an vis. At inani eruditi alienum vis, no suscipit mediocrem sea.', NULL),
(2, 'Minder goed nieuws', 'blablabllablablbalabl', 'Link.nl');

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
  `totaal_deze_periode` decimal(18,2) NOT NULL,
  `banned` tinyint(1) NOT NULL COMMENT '0 = true, 1= false',
  `banned_since` date NOT NULL,
  `aantal_niet_opgehaald` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`email`),
  KEY `fk_klant_userrole_idx` (`userrole`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `voornaam`, `achternaam`, `email`, `wachtwoord`, `userrole`, `totaal_deze_periode`, `banned`, `banned_since`, `aantal_niet_opgehaald`) VALUES
(1, 'admin', 'achternaam', 'admin@gmail.com', 'geheim', 1, '0.00', 1, '0000-00-00', 0),
(2, 'user', 'achternaam', 'user@gmail.com', 'geheim', 2, '0.00', 1, '0000-00-00', 0);

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
