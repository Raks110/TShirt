-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2018 at 01:18 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--
CREATE DATABASE 'login';
GRANT ALL ON login.* TO 'seven'@'localhost' IDENTIFIED BY 'zap';
GRANT ALL ON login.* TO 'seven'@'127.0.0.1' IDENTIFIED BY 'zap';

-- --------------------------------------------------------

--
-- Table structure for table `infodesk`
--

CREATE TABLE `infodesk` (
  `infoID` int(11) NOT NULL,
  `iusername` varchar(255) DEFAULT NULL,
  `ipass` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `infodesk`
--


-- --------------------------------------------------------

--
-- Table structure for table `logintime`
--

CREATE TABLE `logintime` (
  `logID` int(11) NOT NULL,
  `logintime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `infoID` int(11) DEFAULT NULL,
  `sysID` int(11) DEFAULT NULL,
  `logouttime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logintime`
--


-- --------------------------------------------------------

--
-- Table structure for table `mode`
--

CREATE TABLE `mode` (
  `modeID` int(11) NOT NULL,
  `pmode` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mode`
--

INSERT INTO `mode` (`modeID`, `pmode`) VALUES
(1, 'Online'),
(2, 'Offline');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `statusID` int(11) NOT NULL,
  `Status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`statusID`, `Status`) VALUES
(1, 'Paid'),
(2, 'Unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `sizeID` int(11) NOT NULL,
  `Size` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`sizeID`, `Size`) VALUES
(3, 'L'),
(2, 'M'),
(1, 'S'),
(4, 'XL'),
(5, 'XXL');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studID` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `reg` int(11) DEFAULT NULL,
  `phone` bigint(11) DEFAULT NULL,
  `sizeID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--


-- --------------------------------------------------------

--
-- Table structure for table `sysadmin`
--

CREATE TABLE `sysadmin` (
  `sysID` int(11) NOT NULL,
  `susername` varchar(255) DEFAULT NULL,
  `spass` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sysadmin`
--


-- --------------------------------------------------------

--
-- Table structure for table `tpay`
--

CREATE TABLE `tpay` (
  `payID` int(11) NOT NULL,
  `studID` int(11) DEFAULT NULL,
  `statusID` int(11) DEFAULT NULL,
  `modeID` int(11) NOT NULL,
  `infoID` int(11) DEFAULT NULL,
  `sysID` int(11) DEFAULT NULL,
  `signtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `confirmtime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tpay`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `infodesk`
--
ALTER TABLE `infodesk`
  ADD PRIMARY KEY (`infoID`);

--
-- Indexes for table `logintime`
--
ALTER TABLE `logintime`
  ADD PRIMARY KEY (`logID`),
  ADD KEY `infoID` (`infoID`),
  ADD KEY `sysID` (`sysID`);

--
-- Indexes for table `mode`
--
ALTER TABLE `mode`
  ADD PRIMARY KEY (`modeID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`statusID`),
  ADD UNIQUE KEY `Status` (`Status`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`sizeID`),
  ADD UNIQUE KEY `Size` (`Size`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studID`),
  ADD UNIQUE KEY `reg` (`reg`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `sizeID` (`sizeID`);

--
-- Indexes for table `sysadmin`
--
ALTER TABLE `sysadmin`
  ADD PRIMARY KEY (`sysID`);

--
-- Indexes for table `tpay`
--
ALTER TABLE `tpay`
  ADD PRIMARY KEY (`payID`),
  ADD KEY `studID` (`studID`),
  ADD KEY `infoID` (`infoID`),
  ADD KEY `sysID` (`sysID`),
  ADD KEY `modeID` (`modeID`),
  ADD KEY `statusID` (`statusID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `infodesk`
--
ALTER TABLE `infodesk`
  MODIFY `infoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logintime`
--
ALTER TABLE `logintime`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mode`
--
ALTER TABLE `mode`
  MODIFY `modeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sysadmin`
--
ALTER TABLE `sysadmin`
  MODIFY `sysID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tpay`
--
ALTER TABLE `tpay`
  MODIFY `payID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logintime`
--
ALTER TABLE `logintime`
  ADD CONSTRAINT `logintime_ibfk_1` FOREIGN KEY (`infoID`) REFERENCES `infodesk` (`infoID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `logintime_ibfk_2` FOREIGN KEY (`sysID`) REFERENCES `sysadmin` (`sysID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`sizeID`) REFERENCES `size` (`sizeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tpay`
--
ALTER TABLE `tpay`
  ADD CONSTRAINT `tpay_ibfk_1` FOREIGN KEY (`studID`) REFERENCES `student` (`studID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tpay_ibfk_2` FOREIGN KEY (`infoID`) REFERENCES `infodesk` (`infoID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tpay_ibfk_3` FOREIGN KEY (`sysID`) REFERENCES `sysadmin` (`sysID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tpay_ibfk_4` FOREIGN KEY (`modeID`) REFERENCES `mode` (`modeID`),
  ADD CONSTRAINT `tpay_ibfk_5` FOREIGN KEY (`statusID`) REFERENCES `payment` (`statusID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
