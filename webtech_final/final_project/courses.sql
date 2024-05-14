-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2023 at 10:17 AM
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
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `ID` int(5) NOT NULL,
  `title` varchar(80) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `category` varchar(20) NOT NULL,
  `videoURL` varchar(100) NOT NULL,
  `price` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`ID`, `title`, `description`, `category`, `videoURL`, `price`) VALUES
(1, 'Python for Data Science Full Course. Tutorials for Beginners in 2023', 'Great Learning\'s \"Python for data science” course is all about learning exciting ways of understandi', 'Data Science', 'https://www.youtube.com/watch?v=JDcZBzb46ts', 200),
(2, 'Trigonometry full course for Beginners', 'Trigonometry is a branch of mathematics that studies relationships between side lengths and angles of #triangles.', 'Math', 'https://www.youtube.com/watch?v=5zi5eG5Ui-Y', 300),
(3, 'C++ Programming Course - Beginner to Advanced', 'Learn modern C++ 20 programming in this comprehensive course.', 'C++', 'https://www.youtube.com/watch?v=8jLOx1hD3_o', 500),
(4, 'C++ Tutorial for Beginners - Full Course', 'This course will give you a full introduction into all of the core concepts in C++', 'C++', 'https://www.youtube.com/watch?v=vLnPwxZdW4Y', 200),
(5, 'College Algebra - Full Course', 'Learn Algebra in this full college course. These concepts are often used in programming.', 'Math', 'https://www.youtube.com/watch?v=LwCRRUa8yTU', 300),
(6, 'Learn Data Science in 3 Hours', 'This Data Science video will start with basics of Statistics and Probability and then moves to Machine Learning and Finally ends the journey with Deep Learning and AI.', 'Data Science', 'https://www.youtube.com/watch?v=aGu0fbkHhek', 200);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
