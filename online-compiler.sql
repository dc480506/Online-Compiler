-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2019 at 08:39 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online-compiler`
--

-- --------------------------------------------------------

--
-- Table structure for table `code_info`
--

CREATE TABLE `code_info` (
  `username` varchar(256) NOT NULL,
  `codename` varchar(256) NOT NULL,
  `language` varchar(256) NOT NULL,
  `ctime` datetime NOT NULL,
  `utime` datetime NOT NULL,
  `star` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `code_info`
--

INSERT INTO `code_info` (`username`, `codename`, `language`, `ctime`, `utime`, `star`) VALUES
('abc', 'hii', 'C', '2019-12-17 08:17:21', '2019-12-17 08:17:21', 1),
('abc', 'hiih', 'C', '2019-11-03 19:57:36', '2019-11-03 19:57:36', 0),
('abc', 'meet', 'C', '2019-12-10 16:18:17', '2019-12-10 16:18:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `username`, `email`, `password`) VALUES
(5, 'abc', '\'\'@gmail.com', '$2y$10$D8UwGWrkXC0PKHo4.4Di..SR06Kx8HnocQzFLn9yY/tGyKCT7L.La');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `code_info`
--
ALTER TABLE `code_info`
  ADD PRIMARY KEY (`username`,`codename`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
