-- phpMyAdmin SQL Dump
-- version autre
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: un jour...
-- Server version: une version...
-- PHP Version: une autre version...

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ParcInfo`
--

-- --------------------------------------------------------

--
-- Table structure for table `Postes`
--

DROP TABLE IF EXISTS `Postes`;
CREATE TABLE `Postes` (
  `id` int(11) NOT NULL,
  `salle` int(3) NOT NULL,
  `os` enum('Ubuntu','Debian','MacOS','Windows') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `Postes`
--

INSERT INTO `Postes` (`id`, `salle`, `os`) VALUES
(1, 5, 'Ubuntu'),
(2, 5, 'Windows'),
(3, 5, 'Debian'),
(4, 5, 'MacOS'),
(5, 17, 'Ubuntu'),
(6, 17, 'Debian'),
(7, 105, 'Ubuntu'),
(8, 105, 'MacOS'),
(9, 106, 'Ubuntu'),
(10, 106, 'Debian');

-- --------------------------------------------------------

--
-- Table structure for table `Reservations`
--

DROP TABLE IF EXISTS `Reservations`;
CREATE TABLE `Reservations` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `poste_id` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `est_root` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Postes`
--
ALTER TABLE `Postes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Reservations`
--
ALTER TABLE `Reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`login`);


ALTER TABLE `Users`
  ADD UNIQUE(`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Postes`
--
ALTER TABLE `Postes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `Reservations`
--
ALTER TABLE `Reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
