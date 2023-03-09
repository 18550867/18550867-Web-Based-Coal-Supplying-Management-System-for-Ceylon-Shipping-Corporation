-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2023 at 05:10 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `auto_id`
--

CREATE TABLE `auto_id` (
  `autoId` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auto_id`
--

INSERT INTO `auto_id` (`autoId`) VALUES
(1),
(2),
(3),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(44),
(45),
(46),
(47),
(48),
(49),
(50),
(51),
(52),
(53),
(54),
(55),
(56),
(57),
(58),
(59),
(60),
(61),
(62),
(63),
(64),
(65),
(66),
(67),
(68),
(69),
(70),
(71),
(72),
(73),
(74),
(75),
(76),
(77),
(78),
(79),
(80),
(81),
(82),
(83),
(84),
(85),
(86);

-- --------------------------------------------------------

--
-- Table structure for table `coalsupplier`
--

CREATE TABLE `coalsupplier` (
  `id` int(10) NOT NULL,
  `supId` varchar(10) NOT NULL,
  `cName` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `fax` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `port` varchar(50) NOT NULL,
  `coalSupply` varchar(5) NOT NULL,
  `experience` varchar(15) NOT NULL,
  `exDoc` varchar(30) NOT NULL,
  `regDoc` varchar(30) NOT NULL,
  `finDoc` varchar(30) NOT NULL,
  `datetime` varchar(20) NOT NULL,
  `type` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coalsupplier`
--

INSERT INTO `coalsupplier` (`id`, `supId`, `cName`, `address`, `telephone`, `fax`, `email`, `port`, `coalSupply`, `experience`, `exDoc`, `regDoc`, `finDoc`, `datetime`, `type`, `status`, `password`) VALUES
(10, 'CSP0000077', 'Fure Coal Limited', 'RCBT, South Africa', '35456788', '34343345', 'ksameeraniroshan@gmail.com', 'RCBT', 'Yes', 'Above 5 Years', '4 - bid document.pdf', '3 - bid document.pdf', '1 - Registration Notice.pdf', '2022-11-25T17:54', 'Coal Supply', 'Approved', 'umaFfpty'),
(11, 'CSP0000078', 'Ten Coal Limited', 'Russia', '4353536363', '784848484', 'mailsamee2@gmail.com', 'Moscow', 'Yes', '4', '3 - bid document.pdf', '3 - bid document.pdf', '3 - Registration Notice.pdf', '2022-11-25T17:55', 'Coal Supply', 'Approved', 'u$LR5CpK'),
(12, 'CSP0000079', 'Coal India', 'Wishakapatnam, India', '009756456564', '0097654535', 'wije@gmail.com', 'Vishag', 'Yes', '4', '2 - bid document.pdf', '2 - bid document.pdf', '2 - Registration Notice.pdf', '2022-11-25T17:56', 'Coal Supply', 'Approved', 'kKbANZan'),
(13, 'CSP0000080', 'Sea Coal', 'Chennai, India', '0097656565', '00976567', 'mailsame@gmail.com', 'Chennai', 'No', '2', '4 - bid document.pdf', '3 - bid document.pdf', '3 - bid document.pdf', '2022-11-25T17:57', 'Coal Supply', 'Rejected', 'JXtuvYIC');

--
-- Triggers `coalsupplier`
--
DELIMITER $$
CREATE TRIGGER `getSupId` BEFORE INSERT ON `coalsupplier` FOR EACH ROW BEGIN
	INSERT INTO auto_id VALUES (NULL);
    SET NEW.supId=CONCAT("CSP" , LPAD(LAST_INSERT_ID(), 7, "0"));
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `laycan`
--

CREATE TABLE `laycan` (
  `id` int(10) NOT NULL,
  `procId` varchar(10) NOT NULL,
  `supId` varchar(10) NOT NULL,
  `laycan1` varchar(50) NOT NULL,
  `qty1` int(15) NOT NULL,
  `laycan2` varchar(50) NOT NULL,
  `qty2` int(15) NOT NULL,
  `laycan3` varchar(50) NOT NULL,
  `qty3` int(15) NOT NULL,
  `decision` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laycan`
--

INSERT INTO `laycan` (`id`, `procId`, `supId`, `laycan1`, `qty1`, `laycan2`, `qty2`, `laycan3`, `qty3`, `decision`) VALUES
(2, 'PRC0000039', 'VSP0000063', '2022-11-24T11:19', 2000, '2022-11-30T11:19', 2000, '2022-12-21T11:19', 2000, 'Not Agreed'),
(4, 'PRC0000035', 'VSP0000001', '2022-11-26T21:35', 2000, '2022-11-30T21:35', 2000, '2022-12-09T21:35', 2000, 'Agreed'),
(5, 'PRC0000035', 'VSP0000001', '2022-11-30T09:33', 1000, '2022-11-30T09:34', 1000, '2022-11-30T09:34', 1000, 'Not Agreed');

-- --------------------------------------------------------

--
-- Table structure for table `offertrans`
--

CREATE TABLE `offertrans` (
  `id` int(10) NOT NULL,
  `supId` varchar(10) NOT NULL,
  `procId` varchar(10) NOT NULL,
  `datetime` varchar(20) NOT NULL,
  `qty` int(15) NOT NULL,
  `unitprice` float NOT NULL,
  `addcom` float NOT NULL,
  `total` float NOT NULL,
  `results` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offertrans`
--

INSERT INTO `offertrans` (`id`, `supId`, `procId`, `datetime`, `qty`, `unitprice`, `addcom`, `total`, `results`) VALUES
(15, 'VSP0000001', 'PRC0000035', '2022-11-25T18:47', 300000, 25, 1, 7800000, 'Approved'),
(16, 'VSP0000002', 'PRC0000035', '2022-11-25T18:48', 300000, 32, 2, 10200000, 'Pending'),
(18, 'VSP0000001', 'PRC0000039', '2022-11-25T18:50', 60000, 26, 2, 1680000, 'Pending'),
(19, 'VSP0000002', 'PRC0000039', '2022-11-25T18:50', 60000, 20, 1, 1260000, 'Approved'),
(20, 'VSP0000003', 'PRC0000039', '2022-11-25T18:51', 60000, 24, 3, 1620000, 'Pending'),
(21, 'VSP0000001', 'PRC0000038', '2022-11-26T09:32', 30000, 10, 1, 330000, 'Pending'),
(22, 'VSP0000001', 'PRC0000085', '2022-11-26T10:33', 10000, 40, 1, 410000, 'Pending'),
(23, 'VSP0000002', 'PRC0000085', '2022-11-26T10:33', 10000, 10, 2, 120000, 'Pending'),
(24, 'VSP0000086', 'PRC0000085', '2022-11-26T10:37', 10000, 25, 3, 280000, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `procurement`
--

CREATE TABLE `procurement` (
  `id` int(10) NOT NULL,
  `procId` varchar(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `qty` int(20) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `document` varchar(50) NOT NULL,
  `deadline` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `procurement`
--

INSERT INTO `procurement` (`id`, `procId`, `title`, `author`, `type`, `qty`, `datetime`, `document`, `deadline`) VALUES
(64, 'PRC0000034', 'Coal Supply Term Tender for 2023', 'Sameera', 'Coal Term', 300000, '2022-11-19T23:45', '1 - bid document.pdf', '2022-12-31T23:55'),
(65, 'PRC0000035', 'Coal Transport Term Tender for 2023', 'Sameera', 'Transport Term', 300000, '2022-11-19T23:46', '2 - bid document.pdf', '2022-12-31T23:55'),
(66, 'PRC0000036', 'Coal Supply Spot Tender 01', 'Sameera', 'Coal Spot', 30000, '2022-11-19T23:47', '3 - bid document.pdf', '2022-11-26T23:55'),
(67, 'PRC0000037', 'Coal Supply Spot Tender 2', 'Sameera', 'Coal Spot', 60000, '2022-11-19T23:48', '4 - bid document.pdf', '2022-12-25T23:55'),
(68, 'PRC0000038', 'Coal Transport Spot Tender 01', 'Sameera', 'Transport Spot', 30000, '2022-11-19T23:50', '5 - bid document.pdf', '2022-11-30T23:55'),
(69, 'PRC0000039', 'Coal Transport Spot Tender 2', 'Sameera', 'Transport Spot', 60000, '2022-11-19T23:50', '6 - bid document.pdf', '2022-12-30T23:55');

--
-- Triggers `procurement`
--
DELIMITER $$
CREATE TRIGGER `getProcId` BEFORE INSERT ON `procurement` FOR EACH ROW BEGIN
	INSERT INTO auto_id VALUES (NULL);
    SET NEW.procId=CONCAT("PRC" , LPAD(LAST_INSERT_ID(), 7, "0"));
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(9) NOT NULL,
  `regId` varchar(10) DEFAULT NULL,
  `datetime` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `document` varchar(50) DEFAULT NULL,
  `deadline` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `regId`, `datetime`, `title`, `author`, `type`, `document`, `deadline`) VALUES
(17, 'REG0000040', '2022-11-19T23:53', 'Coal Sea Transporter Registration for 2023 ', 'Sameera', 'Transporter', '1 - Registration Notice.pdf', '2022-12-15T23:55'),
(18, 'REG0000041', '2022-12-10T23:54', 'Coal Supplier Registration for 2023', 'Sameera', 'Supplier', '2 - Registration Notice.pdf', '2022-12-10T23:55');

--
-- Triggers `register`
--
DELIMITER $$
CREATE TRIGGER `getRegId` BEFORE INSERT ON `register` FOR EACH ROW BEGIN
	INSERT INTO auto_id VALUES (NULL);
    SET NEW.regId=CONCAT("REG" , LPAD(LAST_INSERT_ID(), 7, "0"));
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `datetime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `title`, `author`, `datetime`) VALUES
(1, 'sameera', 'Sameera', 'November-17-2022 :49:48'),
(2, 'bvnvnj', 'Sameera', 'November-17-2022 :21:40'),
(3, 'jkhgjfhh', 'Sameera', 'November-17-2022 21:52:36'),
(4, 'hfhgfhfhfhf', 'Sameera', 'November-17-2022 22:56:36'),
(5, 'ryeryeywrwy', 'Sameera', 'November-17-2022 23:00:31');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `userId` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL,
  `createby` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `userId`, `name`, `mobile`, `email`, `usertype`, `password`, `createby`) VALUES
(2, 'USR0000001', 'Sameera', '0714013135', 'ksameeraniroshan@gmail.com', 'Procurement Manager', '11111111', 'Admin'),
(3, 'USR0000002', 'Niroshan', '0721143938', 'mailsamee2@gmail.com', 'Admin', '22222222', 'Admin'),
(4, 'USR0000003', 'Wijerathna', '0712345679', 'wije@gmail.com', 'Charter Manager', '33333333', 'Admin'),
(5, 'USR0000081', 'Test', '0714013135', 'fafaf@gmail.com', 'Admin', 'h2WZ9oEg', 'Admin');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `getUserId` BEFORE INSERT ON `user` FOR EACH ROW BEGIN
	INSERT INTO auto_id VALUES (NULL);
    SET NEW.userId=CONCAT("USR" , LPAD(LAST_INSERT_ID(), 7, "0"));
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `vesselsupplier`
--

CREATE TABLE `vesselsupplier` (
  `id` int(10) NOT NULL,
  `supId` varchar(10) NOT NULL,
  `cName` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `fax` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `vessel` varchar(10) NOT NULL,
  `coalSupply` varchar(15) NOT NULL,
  `experience` varchar(20) NOT NULL,
  `exDoc` varchar(50) NOT NULL,
  `regDoc` varchar(50) NOT NULL,
  `finDoc` varchar(50) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vesselsupplier`
--

INSERT INTO `vesselsupplier` (`id`, `supId`, `cName`, `address`, `telephone`, `fax`, `email`, `vessel`, `coalSupply`, `experience`, `exDoc`, `regDoc`, `finDoc`, `datetime`, `type`, `status`, `password`) VALUES
(7, 'VSP0000001', 'Express Russia', 'RCBT, Russia', '1122334455', '1122445566', 'ksameeraniroshan@gmail.com', '10', 'Yes', 'Above 5 Years', '3 - bid document.pdf', '1 - bid document.pdf', '1 - bid document.pdf', '2022-11-25T17:46', 'Coal Transport', 'Approved', '11111111'),
(8, 'VSP0000002', 'Laylod', 'Indunisia', '1111111111', '2222222222', 'mailsamee2@gmail.com', '10', 'Yes', '5', '2 - bid document.pdf', '2 - bid document.pdf', '2 - Registration Notice.pdf', '2022-11-25T17:48', 'Coal Transport', 'Approved', '22222222'),
(9, 'VSP0000003', 'Express Parle', 'India', '00971234567', '0097111111', 'wije@gmail.com', '15', 'Yes', '3', '2 - bid document.pdf', '5 - bid document.pdf', '6 - bid document.pdf', '2022-11-25T17:49', 'Coal Transport', 'Approved', '33333333'),
(10, 'VSP0000004', 'SA - Africa', 'South Africa', '1122334459', '1122445555', 'mailsame@gmail.com', '12', 'Yes', '4', '3 - bid document.pdf', '3 - bid document.pdf', '2 - bid document.pdf', '2022-11-25T17:50', 'Coal Transport', 'Rejected', '44444444'),
(11, 'VSP0000005', 'Singo Travel', 'Singapore', '34567895', '23456789', 'ksameeraniroshan@gmail.com', '2', 'No', '2', '5 - bid document.pdf', '4 - Registration Notice.pdf', '3 - bid document.pdf', '2022-11-25T17:51', 'Coal Transport', 'Rejected', '55555555'),
(12, 'VSP0000086', 'Test User', 'abc', '1111', '1111', 'ds@gmail.com', '5', 'Yes', '3', '5 - bid document.pdf', '6 - bid document.pdf', '6 - bid document.pdf', '2022-11-26T10:35', 'Coal Transport', 'Approved', 'alimYQ#t');

--
-- Triggers `vesselsupplier`
--
DELIMITER $$
CREATE TRIGGER `getSupId2` BEFORE INSERT ON `vesselsupplier` FOR EACH ROW BEGIN
	INSERT INTO auto_id VALUES (NULL);
    SET NEW.supId=CONCAT("VSP" , LPAD(LAST_INSERT_ID(), 7, "0"));
    END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auto_id`
--
ALTER TABLE `auto_id`
  ADD PRIMARY KEY (`autoId`);

--
-- Indexes for table `coalsupplier`
--
ALTER TABLE `coalsupplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laycan`
--
ALTER TABLE `laycan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offertrans`
--
ALTER TABLE `offertrans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `procurement`
--
ALTER TABLE `procurement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vesselsupplier`
--
ALTER TABLE `vesselsupplier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auto_id`
--
ALTER TABLE `auto_id`
  MODIFY `autoId` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `coalsupplier`
--
ALTER TABLE `coalsupplier`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `laycan`
--
ALTER TABLE `laycan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `offertrans`
--
ALTER TABLE `offertrans`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `procurement`
--
ALTER TABLE `procurement`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vesselsupplier`
--
ALTER TABLE `vesselsupplier`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
