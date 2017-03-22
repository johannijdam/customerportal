-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 22 mrt 2017 om 09:10
-- Serverversie: 10.1.16-MariaDB
-- PHP-versie: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `customerportal`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cp_companies`
--

CREATE TABLE `cp_companies` (
  `cp_companies_id` int(11) NOT NULL,
  `cp_companies_name` varchar(200) DEFAULT NULL,
  `cp_companies_address` varchar(45) DEFAULT NULL,
  `cp_companies_zipcode` varchar(45) DEFAULT NULL,
  `cp_companies_city` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `cp_companies`
--

INSERT INTO `cp_companies` (`cp_companies_id`, `cp_companies_name`, `cp_companies_address`, `cp_companies_zipcode`, `cp_companies_city`) VALUES
(1, 'Weblust', 'Drinkwaterweg 272', '3063 JC', 'Rotterdam');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cp_documents`
--

CREATE TABLE `cp_documents` (
  `cp_documents_id` int(11) NOT NULL,
  `cp_documents_name` varchar(200) DEFAULT NULL,
  `cp_documents_date_added` date DEFAULT NULL,
  `cp_documents_date_expired` date DEFAULT NULL,
  `cp_documents_filename` varchar(200) DEFAULT NULL,
  `cp_companies_cp_companies_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cp_roles`
--

CREATE TABLE `cp_roles` (
  `cp_roles_id` int(11) NOT NULL,
  `cp_roles_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `cp_roles`
--

INSERT INTO `cp_roles` (`cp_roles_id`, `cp_roles_name`) VALUES
(1, 'admin'),
(2, 'customer');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cp_users`
--

CREATE TABLE `cp_users` (
  `cp_users_id` int(11) NOT NULL,
  `cp_users_firstname` varchar(200) DEFAULT NULL,
  `cp_users_lastname` varchar(200) DEFAULT NULL,
  `cp_users_email` varchar(45) DEFAULT NULL,
  `cp_users_password` varchar(50) DEFAULT NULL,
  `cp_users_last_login` datetime DEFAULT NULL,
  `cp_companies_cp_companies_id` int(11) NOT NULL,
  `cp_roles_cp_roles_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `cp_users`
--

INSERT INTO `cp_users` (`cp_users_id`, `cp_users_firstname`, `cp_users_lastname`, `cp_users_email`, `cp_users_password`, `cp_users_last_login`, `cp_companies_cp_companies_id`, `cp_roles_cp_roles_id`) VALUES
(12, 'Johan', 'Nijdam', 'johannijdam@gmail.com', '9f86eaae87527a57e9c67524520c07ac', '2017-02-22 11:34:35', 1, 1),
(16, 'Vicky', 'Nguyen', 'nguvn@hr.nl', 'b4c8b35bd4a80586bec3c263e8c99b28', NULL, 1, 2);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `cp_companies`
--
ALTER TABLE `cp_companies`
  ADD PRIMARY KEY (`cp_companies_id`);

--
-- Indexen voor tabel `cp_documents`
--
ALTER TABLE `cp_documents`
  ADD PRIMARY KEY (`cp_documents_id`),
  ADD KEY `fk_cp_documents_cp_companies1_idx` (`cp_companies_cp_companies_id`);

--
-- Indexen voor tabel `cp_roles`
--
ALTER TABLE `cp_roles`
  ADD PRIMARY KEY (`cp_roles_id`);

--
-- Indexen voor tabel `cp_users`
--
ALTER TABLE `cp_users`
  ADD PRIMARY KEY (`cp_users_id`),
  ADD KEY `fk_cp_users_cp_companies_idx` (`cp_companies_cp_companies_id`),
  ADD KEY `fk_cp_users_cp_roles1_idx` (`cp_roles_cp_roles_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `cp_companies`
--
ALTER TABLE `cp_companies`
  MODIFY `cp_companies_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `cp_documents`
--
ALTER TABLE `cp_documents`
  MODIFY `cp_documents_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `cp_roles`
--
ALTER TABLE `cp_roles`
  MODIFY `cp_roles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `cp_users`
--
ALTER TABLE `cp_users`
  MODIFY `cp_users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `cp_documents`
--
ALTER TABLE `cp_documents`
  ADD CONSTRAINT `fk_cp_documents_cp_companies1` FOREIGN KEY (`cp_companies_cp_companies_id`) REFERENCES `cp_companies` (`cp_companies_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `cp_users`
--
ALTER TABLE `cp_users`
  ADD CONSTRAINT `fk_cp_users_cp_companies` FOREIGN KEY (`cp_companies_cp_companies_id`) REFERENCES `cp_companies` (`cp_companies_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cp_users_cp_roles1` FOREIGN KEY (`cp_roles_cp_roles_id`) REFERENCES `cp_roles` (`cp_roles_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
