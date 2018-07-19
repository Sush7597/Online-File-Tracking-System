-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 13, 2018 at 04:41 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `one`
--

-- --------------------------------------------------------

--
-- Table structure for table `emp`
--

DROP TABLE IF EXISTS `emp`;
CREATE TABLE IF NOT EXISTS `emp` (
  `code` bigint(20) UNSIGNED NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `department` varchar(10) DEFAULT NULL,
  `designation` varchar(30) DEFAULT NULL,
  `section` varchar(15) DEFAULT NULL,
  `Person_concerned` varchar(50) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp`
--

INSERT INTO `emp` (`code`, `password`, `department`, `designation`, `section`, `Person_concerned`) VALUES
(1, 'sush', 'HRD', 'trainee', 'Training', 'AGM'),
(2, 'Divya', 'HRD', 'Manager', '', 'GM'),
(1234, 'Rhea', 'HRD', 'Personnel Officer', 'Training', 'CMD');

-- --------------------------------------------------------

--
-- Table structure for table `ref`
--

DROP TABLE IF EXISTS `ref`;
CREATE TABLE IF NOT EXISTS `ref` (
  `S_no` bigint(20) NOT NULL AUTO_INCREMENT,
  `Ref_no` bigint(20) NOT NULL,
  `Doc_id` bigint(20) NOT NULL,
  PRIMARY KEY (`S_no`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ref`
--

INSERT INTO `ref` (`S_no`, `Ref_no`, `Doc_id`) VALUES
(5, 186, 212);

-- --------------------------------------------------------

--
-- Table structure for table `track`
--

DROP TABLE IF EXISTS `track`;
CREATE TABLE IF NOT EXISTS `track` (
  `Doc_No` varchar(200) DEFAULT NULL,
  `Doc_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Description` varchar(200) DEFAULT NULL,
  `Pages` bigint(20) NOT NULL,
  `Generated_by` bigint(20) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Department` varchar(20) DEFAULT NULL,
  `Section` varchar(30) DEFAULT NULL,
  `File_no` varchar(20) DEFAULT NULL,
  `Date_of_Generation` date DEFAULT NULL,
  `Stage` varchar(20) NOT NULL DEFAULT 'Open',
  `Action_taken` varchar(100) NOT NULL,
  PRIMARY KEY (`Doc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=213 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `track`
--

INSERT INTO `track` (`Doc_No`, `Doc_id`, `Description`, `Pages`, `Generated_by`, `Type`, `Department`, `Section`, `File_no`, `Date_of_Generation`, `Stage`, `Action_taken`) VALUES
('CEL/HRD/Training/2018/1/186', 186, 'Trial', 1, 1, 'Noting', 'HRD', 'Training', '1', '2018-07-05', 'Sent', 'Noting with reference number 212 has been forwarded to HRD'),
('CEL/HRD/Training/2018/2/212', 212, 'Trial2', 1, 1, 'Noting', 'HRD', 'Training', '2', '2018-07-12', 'Open', '');

-- --------------------------------------------------------

--
-- Table structure for table `track2`
--

DROP TABLE IF EXISTS `track2`;
CREATE TABLE IF NOT EXISTS `track2` (
  `S_no` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Doc_No` varchar(100) NOT NULL,
  `Doc_id` int(11) DEFAULT NULL,
  `Pages` bigint(20) NOT NULL,
  `Dispatched_By` bigint(20) NOT NULL,
  `Person_concerned` varchar(30) NOT NULL,
  `Dispatched_To` bigint(20) NOT NULL,
  `Date` date NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Type_of_dispatch` varchar(10) NOT NULL,
  `Remarks` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`S_no`)
) ENGINE=MyISAM AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `track2`
--

INSERT INTO `track2` (`S_no`, `Doc_No`, `Doc_id`, `Pages`, `Dispatched_By`, `Person_concerned`, `Dispatched_To`, `Date`, `Status`, `Type_of_dispatch`, `Remarks`) VALUES
(63, 'CEL/HRD/Training/2018/1/186', 186, 3, 1, 'GM', 2, '2018-07-11', 'Accepted', 'Internal', ''),
(62, 'CEL/HRD/Training/2018/1/186', 186, 3, 1, 'AGM', 1, '2018-07-11', 'Accepted', 'Internal', 'Forwarded'),
(59, 'CEL/HRD/Training/2018/1/186', 186, 1, 2, 'AGM', 1, '2018-07-05', 'Accepted', 'Internal', 'Forwarded'),
(60, 'CEL/HRD/Training/2018/1/186', 186, 2, 1, 'GM', 2, '2018-07-07', 'Accepted', 'Internal', 'Forwarded'),
(61, 'CEL/HRD/Training/2018/1/186', 186, 2, 2, 'AGM', 1, '2018-07-07', 'Accepted', 'Internal', 'Forwarded'),
(58, 'CEL/HRD/Training/2018/1/186', 186, 1, 1, 'GM', 2, '2018-07-05', 'Rejected', 'Internal', 'Returned'),
(96, 'CEL/HRD/Training/2018/2/212', 212, 1, 1, 'AGM', 1, '2018-07-12', 'Accepted', 'Internal', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
