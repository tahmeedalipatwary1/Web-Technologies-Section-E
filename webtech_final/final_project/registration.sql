-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2023 at 10:18 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `userName` varchar(25) NOT NULL,
  `Name` text NOT NULL,
  `phoneNum` int(11) NOT NULL,
  `eMail` text NOT NULL,
  `passWord` text NOT NULL,
  `balance` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`userName`, `Name`, `phoneNum`, `eMail`, `passWord`, `balance`) VALUES
('hello321', 'Hello Bhai', 1931275890, 'hello@hotmail.com', 'hi', 0.00),
('keya12', 'Purobi Keya', 1742356891, 'keya@gamil.com', '1212', 0.00),
('satya123', 'Satya', 1741958171, 'satyajit.xd@gmail.com', '1212', 700.00),
('surjo321', 'Surjo Kanta Das', 1716784255, 'surjo@gmail.com', '1212', 500.00),
('tahmeed11', 'Tahmeed Ali Patwary', 1303380333, 'tahmeed@gmail.com', '4321', 500.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`userName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
