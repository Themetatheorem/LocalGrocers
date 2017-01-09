-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2016 at 10:51 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `local_grocers`
--

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `StoreReview` varchar(625) NOT NULL,
  `StoreID` int(128) NOT NULL,
  `Username` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `StoreName` varchar(64) NOT NULL,
  `StoreLocation` varchar(150) NOT NULL,
  `Longitude` decimal(10,7) NOT NULL,
  `Latitude` decimal(10,7) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`StoreName`, `StoreLocation`, `Longitude`, `Latitude`, `ID`) VALUES
('Fortinos', '1579 Main St. W, Hamilton, ON L8S 1E6', '-79.9205000', '43.2589000', 1),
('Metro', '1585 Mississauga Valley Blvd., Mississauga, ON L5A 3W9', '-79.6259670', '43.5922010', 2),
('WalMart', '100 City Centre Dr.,\r\nMississauga, ON L5B 2C9', '-79.6408140', '43.5942760', 3),
('Westdale Food Market', '1023 King St W, Hamilton, ON L8S 1L3', '-79.9056760', '43.2616810', 7),
('Starsky Fine Foods', '685 Queenston Rd, Hamilton, ON L8G 1A1', '-79.7727710', '43.2304520', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(128) NOT NULL,
  `Name` varchar(64) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Email` varchar(128) NOT NULL,
  `Passwordhash` varchar(128) NOT NULL,
  `Salt` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Name`, `Username`, `Email`, `Passwordhash`, `Salt`) VALUES
(1, 'Anagh', 'Anagh', 'Anagh@email.com', 'fd623126d140fec4701a8a915f1ee353687c0efb4d466b7fe52d05d1e43141d2', '5aa29f327a176c5547d8a6fe7c877c6c78b59b26'),
(2, 'Meet Pandya', 'pandyama', 'pandyama@email.com', 'ef98cfb7808b1b98945a60df27107ee7fa3042e9762d6fc1ec22a41bb64ee1d1', '4be4d8d3eadcb230fbce60392b54c6ff16d539d3'),
(3, 'Eggnog', '123asd', '123asd@email.com', '4ef867e5d299be8e90a6bd3e59396fab1294f7fd3c91e1db373e7dfcae454c0a', 'e2c3fe7145cb52e686bcb43573aee832044acfc6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `StoreName` (`StoreName`),
  ADD KEY `StoreName_2` (`StoreName`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
