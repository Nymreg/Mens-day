-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2025 at 03:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mens_daydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(9) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(11, 'Alvin', 'ken', '$2y$10$haUuuJwfVlhju'),
(12, 'Ken', 'Alvin', '$2y$10$xcQSBgRhF2gLT'),
(13, 'Ken', 'qwewqe', '$2y$10$kzS3zn38N04xQ'),
(14, 'Alvin2', 'asdasd', '$2y$10$B4ARCbPRake7y'),
(15, 'asd', 'asd', '$2y$10$BBDlKhDnTvUvT'),
(16, 'asdf', 'asdf', '$2y$10$oyHXdxLRo4a4Y'),
(17, 'cac', 'acaffds', '12'),
(18, 'R', 'r', '$2y$10$0xSg.Kz7xFoOp'),
(19, '12', '12', '12'),
(20, 'al', 'al', 'al'),
(21, 'ad', 'ad', '$2y$10$CTyPLwYLVl6fp'),
(22, 's', 's', 's'),
(23, 'Alvin Ken', 'qakdelac', 'asd'),
(25, 'asdasd', 'asds', 'asd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
