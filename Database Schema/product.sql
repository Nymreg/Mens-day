-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2025 at 03:46 PM
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
-- Database: `product`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(10) NOT NULL,
  `Name` varchar(500) NOT NULL,
  `Stock` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `Name`, `Stock`) VALUES
(1, 'Silent Hill', 5),
(2, 'Tomb Raider', 12),
(3, 'Resident Evil', 8),
(4, 'Crash Bandicoot', 20),
(5, 'Pepsiman', 27),
(6, 'Legend of Zelda', 6),
(7, 'GoldenEye 007', 14),
(8, 'Duke Nukem 64', 5),
(9, 'Super Mario 64', 12),
(10, 'Donkey Kong 64', 10),
(11, 'Sonic Adventure', 13),
(12, 'Marvel vs Capcom 2', 8),
(13, 'Power Stone', 11),
(14, 'JetSet Radio', 11),
(15, 'Crazy Taxi', 18),
(16, 'Call of Duty Black Ops 2', 17),
(17, 'Borderlands 2', 4),
(18, 'Fallout 3', 7),
(19, 'Forza Horizon', 6),
(20, 'Mirrors Edge', 7);

-- --------------------------------------------------------

--
-- Table structure for table `table1`
--

CREATE TABLE `table1` (
  `ID` int(10) NOT NULL,
  `Name` varchar(500) NOT NULL,
  `Quantity` int(10) NOT NULL,
  `Price` decimal(30,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table1`
--

INSERT INTO `table1` (`ID`, `Name`, `Quantity`, `Price`) VALUES
(2, 'Pepsiman', 1, 19.00),
(6, 'Resident Evil', 1, 29.00);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `ID` int(10) NOT NULL,
  `Total` decimal(11,2) NOT NULL,
  `Discount` int(10) NOT NULL,
  `Discounted` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`ID`, `Total`, `Discount`, `Discounted`) VALUES
(1, 87.00, 20, 69.60),
(2, 29.00, 10, 26.10);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `data_name` varchar(100) DEFAULT NULL,
  `data_color` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `coupon_applied` varchar(50) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `data_name`, `data_color`, `quantity`, `coupon_applied`, `total_price`, `created_at`) VALUES
(1, 'Homburg Hat', 'Cream', 4, '', 200.00, '2025-05-04 10:24:48'),
(2, 'Homburg Hat', 'Cream', 3, 'DISCOUNT10', 135.00, '2025-05-04 10:26:27'),
(3, 'Feodora Hat', 'Brown', 2, '', 602.00, '2025-05-04 10:27:50'),
(4, 'Panama Hat', 'Black', 2, '', 602.00, '2025-05-04 10:27:50'),
(5, 'Panama Hat', 'Black', 1, '', 188.00, '2025-05-15 10:43:02'),
(6, 'Panama Hat', 'Black', 1, 'DISCOUNT10', 169.20, '2025-05-15 10:43:42'),
(7, 'Panama Hat', 'Black', 2, 'DISCOUNT10', 338.40, '2025-05-15 10:44:28'),
(8, 'Homburg Hat', 'Cream', 1, '', 50.00, '2025-05-15 10:45:06'),
(9, 'Panama Hat', 'Black', 1, 'DISCOUNT10', 214.20, '2025-05-15 10:47:58'),
(10, 'Homburg Hat', 'Cream', 1, 'DISCOUNT10', 214.20, '2025-05-15 10:47:58'),
(11, 'Leather Belt', 'Black', 1, 'DISCOUNT30', 19.60, '2025-05-15 11:49:24'),
(12, 'NeonPulse Sneakers', 'Black & White', 1, '', 140.00, '2025-05-15 12:56:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table1`
--
ALTER TABLE `table1`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `table1`
--
ALTER TABLE `table1`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
