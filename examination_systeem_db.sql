-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2019 at 08:26 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examination_systeem_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_halls`
--

CREATE TABLE `tbl_halls` (
  `hall_id` varchar(5) NOT NULL,
  `hall_name` varchar(50) NOT NULL,
  `hall_department` varchar(30) NOT NULL,
  `hall_floor` int(2) NOT NULL,
  `capacity` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_halls`
--

INSERT INTO `tbl_halls` (`hall_id`, `hall_name`, `hall_department`, `hall_floor`, `capacity`) VALUES
('CSH01', 'Hall C', 'Computer Science', 1, 30),
('PSA02', 'Hall A', 'Psychology', 2, 36),
('BMD02', 'Hall D', 'Mathematics', 0, 40),
('MBA04', 'Hall D', 'Business Administration', 3, 48),
('PHS03', 'Hall B', 'Pharmacy', 2, 30),
('PSA01', 'Hall A', 'Psychology', 2, 40),
('CHM02', 'Hall D', 'Chemstry', 0, 48),
('CSH02', 'Hall B', 'Computer Science', 3, 40);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_halls`
--
ALTER TABLE `tbl_halls`
  ADD PRIMARY KEY (`hall_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
