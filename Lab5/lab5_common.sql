-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 21, 2019 at 07:21 PM
-- Server version: 8.0.15
-- PHP Version: 7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lab5_common`
--

-- --------------------------------------------------------

--
-- Table structure for table `author registrations`
--

CREATE TABLE `author registrations` (
  `id` mediumint(1) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` tinytext NOT NULL,
  `ip_registration` tinytext NOT NULL,
  `date_registration` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `author registrations`
--

INSERT INTO `author registrations` (`id`, `name`, `password`, `ip_registration`, `date_registration`) VALUES
(1, 'Kostya', '1234567890', '127.0.0.1', '2019-04-17'),
(2, 'Kostya', '90129031902390213', '192.168.200.0', '2019-04-10'),
(3, 'Pasha', 'Cucumber', '192.168.2.3', '2019-04-18');

-- --------------------------------------------------------

--
-- Table structure for table `authors articles`
--

CREATE TABLE `authors articles` (
  `id` mediumint(1) NOT NULL,
  `author_id` mediumint(1) NOT NULL,
  `title` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `text` text NOT NULL,
  `image` varbinary(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authors articles`
--

INSERT INTO `authors articles` (`id`, `author_id`, `title`, `text`, `image`) VALUES
(1, 3, 'SuperTitle', 'asldakls lkd1kl; o123 91-0 -031 0-10-92 30-12 0-so;d;la', 0x00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author registrations`
--
ALTER TABLE `author registrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authors articles`
--
ALTER TABLE `authors articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author registrations`
--
ALTER TABLE `author registrations`
  MODIFY `id` mediumint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `authors articles`
--
ALTER TABLE `authors articles`
  MODIFY `id` mediumint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authors articles`
--
ALTER TABLE `authors articles`
  ADD CONSTRAINT `authors articles_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author registrations` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
