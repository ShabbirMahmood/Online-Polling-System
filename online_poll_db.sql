-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2018 at 03:58 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_poll_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tb`
--

CREATE TABLE `admin_tb` (
  `id` int(11) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_tb`
--

INSERT INTO `admin_tb` (`id`, `Email`, `Password`) VALUES
(1, 'shabbirmahmood1996@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `check_tb`
--

CREATE TABLE `check_tb` (
  `id` int(11) NOT NULL,
  `Checked` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `option_tb`
--

CREATE TABLE `option_tb` (
  `id` int(11) NOT NULL,
  `Option` varchar(200) NOT NULL,
  `Votes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `option_tb`
--

INSERT INTO `option_tb` (`id`, `Option`, `Votes`) VALUES
(19, 'Candidate1', 0),
(20, 'Candidate2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `time_tb`
--

CREATE TABLE `time_tb` (
  `id` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `StartTime` time NOT NULL,
  `EndDate` date NOT NULL,
  `EndTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_tb`
--

INSERT INTO `time_tb` (`id`, `StartDate`, `StartTime`, `EndDate`, `EndTime`) VALUES
(1, '2018-03-15', '09:00:00', '2018-03-15', '13:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tb`
--
ALTER TABLE `admin_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check_tb`
--
ALTER TABLE `check_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `option_tb`
--
ALTER TABLE `option_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_tb`
--
ALTER TABLE `time_tb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tb`
--
ALTER TABLE `admin_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `check_tb`
--
ALTER TABLE `check_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `option_tb`
--
ALTER TABLE `option_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
