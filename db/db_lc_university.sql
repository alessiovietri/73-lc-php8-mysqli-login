-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 06, 2022 at 05:30 PM
-- Server version: 5.7.24
-- PHP Version: 8.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lc_university`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `head_of_department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `address`, `phone`, `email`, `website`, `head_of_department`) VALUES
(1, 'Dipartimento di Biologia', 'Via Milani 8 Appartamento 02', '+03 8952 1711580', 'biologia@uni.it', 'www.biologia.uni.it', 'Gilda Romano'),
(2, 'Dipartimento di Fisica e astronomia', 'Strada Barbieri 57', '367 410 378', 'fisica-e-astronomia@uni.it', 'www.fisica-e-astronomia.uni.it', 'Dott. Deborah De Santis'),
(3, 'Dipartimento di Ingegneria civile, edile e ambientale', 'Strada Pablo 85 Appartamento 75', '+54 35 36896630', 'ingegneria-civile-edile-e-ambientale@uni.it', 'www.ingegneria-civile-edile-e-ambientale.uni.it', 'Olimpia D\'amico'),
(4, 'Dipartimento di Ingegneria dell\'informazione', 'Borgo De luca 877 Appartamento 28', '+39 091 353 730', 'ingegneria-dellinformazione@uni.it', 'www.ingegneria-dellinformazione.uni.it', 'Ing. Marzio Gatti'),
(5, 'Dipartimento di Matematica', 'Via Cosetta 5', '+84 63 00392338', 'matematica@uni.it', 'www.matematica.uni.it', 'Sig. Alessandro Orlando'),
(6, 'Dipartimento di Medicina', 'Rotonda Pagano 59', '+15 8928 3017622', 'medicina@uni.it', 'www.medicina.uni.it', 'Lisa Farina'),
(7, 'Dipartimento di Neuroscienze', 'Borgo Ubaldo 181 Appartamento 41', '+32 6290 01889948', 'neuroscienze@uni.it', 'www.neuroscienze.uni.it', 'Dante Lombardi'),
(8, 'Dipartimento di Scienze chimiche', 'Strada Gatti 943 Appartamento 49', '+94 833 74282438', 'scienze-chimiche@uni.it', 'www.scienze-chimiche.uni.it', 'Jole Benedetti'),
(9, 'Dipartimento di Scienze economiche e aziendali', 'Piazza Sibilla 876 Appartamento 03', '+80 092 00 17 3967', 'scienze-economiche-e-aziendali@uni.it', 'www.scienze-economiche-e-aziendali.uni.it', 'Selvaggia De Angelis'),
(10, 'Dipartimento di Scienze politiche, giuridiche e studi internazionali', 'Strada Gelsomina 295', '+59 862 14592149', 'scienze-politiche-giuridiche-e-studi-internazionali@uni.it', 'www.scienze-politiche-giuridiche-e-studi-internazionali.uni.it', 'Bernardo Sanna'),
(11, 'Dipartimento di Scienze statistiche', 'Contrada Valentini 577', '+39 034 983 279', 'scienze-statistiche@uni.it', 'www.scienze-statistiche.uni.it', 'Lauro Barone'),
(12, 'Dipartimento di Studi linguistici e letterari', 'Borgo Ricci 140 Piano 9', '+50 14 37174267', 'studi-linguistici-e-letterari@uni.it', 'www.studi-linguistici-e-letterari.uni.it', 'Dott. Ludovico Marino');

-- --------------------------------------------------------

--
-- Table structure for table `sensitive_data`
--

CREATE TABLE `sensitive_data` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `amount` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sensitive_data`
--

INSERT INTO `sensitive_data` (`ID`, `name`, `last_name`, `amount`) VALUES
(7, 'Mario', 'Rossi', '150.00'),
(8, 'Luigi', 'Bianchi', '250.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`) VALUES
(1, 'mario', '5f4dcc3b5aa765d61d8327deb882cf99'),
(2, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_email_unique` (`email`);

--
-- Indexes for table `sensitive_data`
--
ALTER TABLE `sensitive_data`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sensitive_data`
--
ALTER TABLE `sensitive_data`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
