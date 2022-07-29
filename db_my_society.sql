-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2021 at 10:48 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_my_society`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `aid` int(6) NOT NULL,
  `aname` varchar(20) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `emailid` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `image` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`aid`, `aname`, `phone`, `emailid`, `password`, `image`) VALUES
(1, 'Tushar S', '8956238956', 'tusharsavaliya4444@gmail.com', 'ca2b46b4960815fa27f334a13299b552', 'download.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city`
--

CREATE TABLE `tbl_city` (
  `cid` int(6) NOT NULL,
  `stid` int(6) NOT NULL,
  `cname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_city`
--

INSERT INTO `tbl_city` (`cid`, `stid`, `cname`) VALUES
(30, 12, 'Ahmedabad'),
(31, 12, 'Amreli'),
(32, 12, 'Anand'),
(33, 12, 'Banaskantha'),
(34, 12, 'Baroda'),
(35, 12, 'Bharuch'),
(36, 12, 'Bhavnagar'),
(37, 12, 'Dahod'),
(38, 12, 'Dang'),
(39, 12, 'Dwarka'),
(40, 12, 'Gandhinagar'),
(41, 12, 'Jamnagar'),
(42, 12, 'Junagadh'),
(43, 12, 'Kheda'),
(44, 12, 'Kutch'),
(45, 12, 'Mehsana'),
(46, 12, 'Nadiad'),
(47, 12, 'Narmada'),
(48, 12, 'Navsari'),
(49, 12, 'Panchmahals'),
(50, 12, 'Patan'),
(51, 12, 'Porbandar'),
(52, 12, 'Rajkot'),
(53, 12, 'Sabarkantha'),
(54, 12, 'Surat'),
(55, 12, 'Surendranagar'),
(56, 12, 'Vadodara'),
(57, 12, 'Valsad'),
(58, 12, 'Vapi'),
(59, 9, 'Central Delhi'),
(60, 9, 'East Delhi'),
(61, 9, 'New Delhi'),
(62, 9, 'North Delhi'),
(63, 9, 'North East Delhi'),
(64, 9, 'North West Delhi'),
(65, 9, 'Old Delhi'),
(66, 9, 'South Delhi'),
(67, 9, 'South West Delhi'),
(68, 9, 'West Delhi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense`
--

CREATE TABLE `tbl_expense` (
  `eid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(50) NOT NULL,
  `amount` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_expense`
--

INSERT INTO `tbl_expense` (`eid`, `mid`, `date`, `description`, `amount`) VALUES
(1, 118, '2021-05-01', 'lightning', '12000'),
(2, 118, '2021-05-22', 'suage', '1500'),
(3, 2, '2021-05-01', 'janmashtami', '10000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_landmark`
--

CREATE TABLE `tbl_landmark` (
  `lid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `landmark` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_landmark`
--

INSERT INTO `tbl_landmark` (`lid`, `cid`, `landmark`) VALUES
(1, 54, 'Varachha Road'),
(2, 54, 'landmark52'),
(3, 52, 'landmark12'),
(4, 52, 'landmark23'),
(5, 54, 'hirabaug'),
(6, 40, 'gandhibaug'),
(7, 40, 'gandhibaug'),
(8, 52, 'lan1'),
(15, 54, 'Kapodra'),
(16, 54, 'Kapodra'),
(17, 54, 'lan4'),
(18, 54, 'lan4'),
(19, 54, 'lan3'),
(20, 54, 'lan3'),
(21, 54, 'lan5'),
(22, 54, 'lan6'),
(23, 53, 'landmark7'),
(26, 52, 'dasd'),
(27, 53, 'sabarlandmark1'),
(28, 54, 'mota varachha'),
(29, 52, 'dasdad');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance`
--

CREATE TABLE `tbl_maintenance` (
  `mnid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `wing` char(2) NOT NULL,
  `year` year(4) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `dis_12` decimal(10,0) NOT NULL,
  `dis_6` decimal(10,0) NOT NULL,
  `dis_4` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_maintenance`
--

INSERT INTO `tbl_maintenance` (`mnid`, `sid`, `wing`, `year`, `amount`, `dis_12`, `dis_6`, `dis_4`) VALUES
(2, 2, 'A', 2021, '10000', '9500', '9800', '10000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_status`
--

CREATE TABLE `tbl_maintenance_status` (
  `msid` int(11) NOT NULL,
  `mnid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `installment` int(11) NOT NULL,
  `payment_id` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_maintenance_status`
--

INSERT INTO `tbl_maintenance_status` (`msid`, `mnid`, `mid`, `installment`, `payment_id`, `status`, `datetime`) VALUES
(7, 2, 24, 1, 'pay_H539oZAmmwAsmA', 'Paid', '2021-04-30 12:58:18'),
(11, 2, 118, 1, 'pay_H58U9Zwwj5ypyj', 'Paid', '2021-04-30 18:11:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `mid` int(6) NOT NULL,
  `sid` int(6) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `wing` char(2) NOT NULL,
  `flat` int(6) NOT NULL,
  `image` varchar(150) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(32) NOT NULL,
  `member_type` varchar(12) NOT NULL,
  `is_approved` varchar(10) NOT NULL DEFAULT 'pending',
  `date_registered` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`mid`, `sid`, `mname`, `phone`, `wing`, `flat`, `image`, `email`, `password`, `member_type`, `is_approved`, `date_registered`) VALUES
(1, 1, 'Tushar Savaliya', '8238529241', 'A', 10, 'download.png', '18bmiit042@gmail.com', 'ca2b46b4960815fa27f334a13299b552', 'President', 'Approved', '2021-03-15 14:04:50'),
(2, 2, 'parth lunagariya', '8866784512', 'A', 21, 'download.png', '18bmiit070@gmail.com', 'ca2b46b4960815fa27f334a13299b552', 'Secretary', 'Approved', '2021-03-15 14:04:50'),
(4, 4, 'Tushar S', '8956238956', 'B', 2, 'download.png', 'tusharsavaliya4444@gmail.com', 'ca2b46b4960815fa27f334a13299b552', 'Admin', 'Approved', '2021-03-15 14:04:50'),
(24, 1, 'Tushar JS', '8565985689', 'A', 122, 'download446.png', 'member1@djv.com', 'ca2b46b4960815fa27f334a13299b552', 'Member', 'Approved', '2021-03-15 14:04:50'),
(113, 1, 'member A', '6565956895', 'A', 5, 'user.jpg', 'tjmoda44@gmail.com', 'ca2b46b4960815fa27f334a13299b552', 'Member', 'Approved', '2021-03-18 13:53:43'),
(114, 20, 'Tushar Savaliya', '8238529241', 'A', 21, 'user1.jpg', 'member3@gmail.com', 'ca2b46b4960815fa27f334a13299b552', 'Member', 'Pending', '2021-03-18 15:20:16'),
(116, 1, 'Tushar Savaliya', '8238529241', 'A', 13, 'user.jpg', 'admin1@gmail.com', 'ca2b46b4960815fa27f334a13299b552', 'Admin', 'Approved', '2021-03-18 23:08:14'),
(117, 1, 'Parth L', '8866222995', 'B', 5, 'download438.png', 'sp1@gmail.com', 'ca2b46b4960815fa27f334a13299b552', 'Spresident', 'Approved', '2021-03-19 00:32:37'),
(118, 1, 'Smit Donga', '6365986585', 'A', 2, 'images297.png', 'sec1@gmail.com', 'ca2b46b4960815fa27f334a13299b552', 'Secretary', 'Approved', '2021-03-19 00:37:39'),
(119, 1, 'Faruk Akhtar', '8866784512', 'A', 1, 'user.jpg', 'guard1@gmail.com', 'ca2b46b4960815fa27f334a13299b552', 'Guard', 'Approved', '2021-03-19 10:41:47'),
(120, 1, 'guard djA', '8866691451', 'A', 1, 'user.jpg', 'guard2@gmail.com', 'ca2b46b4960815fa27f334a13299b552', 'Guard', 'Approved', '2021-03-20 17:11:17'),
(121, 1, 'Jaggu Bhai', '8586896523', 'A', 1, 'user.jpg', 'guard3@gmail.com', 'ca2b46b4960815fa27f334a13299b552', 'Guard', 'Approved', '2021-03-20 17:14:52'),
(122, 1, 'Pappu bhai', '8998989898', 'A', 1, 'user.jpg', 'guard4@gmail.com', 'ca2b46b4960815fa27f334a13299b552', 'Guard', 'Approved', '2021-03-20 17:16:08'),
(124, 1, 'member B', '6956985785', 'B', 5, 'images.png', 'wehog75743@leonvero.com', 'ca2b46b4960815fa27f334a13299b552', 'Member', 'pending', '2021-03-22 23:40:16'),
(125, 1, 'member D', '8866691451', 'B', 12, 'images.png', 'hisosec558@990ys.com', 'ca2b46b4960815fa27f334a13299b552', 'Member', 'pending', '2021-03-23 11:47:03'),
(126, 1, 'sanket desai', '8866691451', 'c', 45, 'user1813.jpg', 'sp2@gmail.com', 'ca2b46b4960815fa27f334a13299b552', 'Spresident', 'Approved', '2021-03-25 01:30:23'),
(130, 9, 'mayur togadiya', '9205312459', 'A', 35, 'images.png', '5a9dd087ca@firemailbox.club', 'ca2b46b4960815fa27f334a13299b552', 'Member', 'pending', '2021-05-01 14:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notice`
--

CREATE TABLE `tbl_notice` (
  `nid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `message` varchar(250) NOT NULL,
  `notice_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_notice`
--

INSERT INTO `tbl_notice` (`nid`, `mid`, `message`, `notice_date`) VALUES
(6, 1, 'notice 1', '2021-03-22 02:38:43'),
(7, 1, 'this is notice 2', '2021-03-22 03:15:14'),
(8, 117, 'notice by sp', '2021-03-23 14:39:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_provider`
--

CREATE TABLE `tbl_service_provider` (
  `spid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `spname` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `service` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_service_provider`
--

INSERT INTO `tbl_service_provider` (`spid`, `sid`, `spname`, `phone`, `service`) VALUES
(1, 2, 'rohan', '8586896523', 'tv repairer');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_society`
--

CREATE TABLE `tbl_society` (
  `sid` int(6) NOT NULL,
  `sname` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pincode` int(6) NOT NULL,
  `lid` int(11) NOT NULL,
  `cid` int(6) NOT NULL,
  `stid` int(6) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_society`
--

INSERT INTO `tbl_society` (`sid`, `sname`, `address`, `pincode`, `lid`, `cid`, `stid`, `is_active`, `is_delete`) VALUES
(1, 'Dharmjvan', 'B/H Kalakunj soc.', 395006, 1, 54, 12, 1, 0),
(2, 'Dharmsagar', 'B/H Kalakunj soc.', 395006, 2, 54, 12, 1, 0),
(4, 'suman', 'AK Road', 395004, 3, 54, 12, 1, 0),
(5, 'abc', 'rajkot nagar road', 235623, 4, 52, 12, 1, 0),
(6, 'soc1', 'rajkot nagar road', 235689, 3, 52, 12, 1, 0),
(9, 'Surykiran', 'B/h kalakunj society', 395006, 1, 54, 12, 1, 0),
(10, 'Hariom', 'B/h kalakunj society', 395006, 1, 54, 12, 1, 0),
(12, 'swaminarayan nagar 1', 'B/h kalakunj society', 395006, 1, 54, 12, 1, 0),
(14, 'gajanand', 'Near Shri Swaminarayan Temple Kalakunj', 395006, 1, 54, 12, 1, 0),
(16, 'soc2', 'B/h kalakunj society', 395006, 3, 52, 12, 1, 0),
(17, 'soc3', 'B/h kalakunj society', 395006, 5, 52, 12, 1, 0),
(18, 'soc4', 'near patel faliyu', 395569, 8, 52, 12, 1, 0),
(19, 'soc4', 'near patel faliyu', 395569, 8, 52, 12, 1, 0),
(20, 'soc5', 'nehru road', 365236, 27, 53, 12, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE `tbl_state` (
  `stid` int(6) NOT NULL,
  `sname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`stid`, `sname`) VALUES
(1, 'ANDAMAN AND NICOBAR '),
(2, 'ANDHRA PRADESH'),
(3, 'ARUNACHAL PRADESH'),
(4, 'ASSAM'),
(5, 'BIHAR'),
(6, 'CHATTISGARH'),
(7, 'CHANDIGARH'),
(8, 'DAMAN AND DIU'),
(9, 'DELHI'),
(10, 'DADRA AND NAGAR HAVE'),
(11, 'GOA'),
(12, 'GUJARAT'),
(13, 'HIMACHAL PRADESH'),
(14, 'HARYANA'),
(15, 'JAMMU AND KASHMIR'),
(16, 'JHARKHAND'),
(17, 'KERALA'),
(18, 'KARNATAKA'),
(19, 'LAKSHADWEEP'),
(20, 'MEGHALAYA'),
(21, 'MAHARASHTRA'),
(22, 'MANIPUR'),
(23, 'MADHYA PRADESH'),
(24, 'MIZORAM'),
(25, 'NAGALAND'),
(26, 'ORISSA'),
(27, 'PUNJAB'),
(28, 'PONDICHERRY'),
(29, 'RAJASTHAN'),
(30, 'SIKKIM'),
(31, 'TAMIL NADU'),
(32, 'TRIPURA'),
(33, 'UTTARAKHAND'),
(34, 'UTTAR PRADESH'),
(35, 'WEST BENGAL'),
(36, 'TELANGANA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_visitor`
--

CREATE TABLE `tbl_visitor` (
  `vid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `vname` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `description` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_visitor`
--

INSERT INTO `tbl_visitor` (`vid`, `mid`, `vname`, `phone`, `date`, `time`, `description`, `email`, `image`) VALUES
(23, 24, 'visitor c', '8866691451', '2021-03-21', '18:37:00', 'hgljlh,v', '18bmiit042@gmail.com', 'user.jpg'),
(24, 24, 'visitor d', '8866691451', '2021-03-21', '18:39:00', 'guest', '18bmiit042@gmail.com', 'user1771.jpg'),
(25, 24, 'dixit donga', '7874790493', '2021-03-23', '16:29:00', 'Guest', 'tjmoda44@gmail.com', 'user1266.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_visitor_entry`
--

CREATE TABLE `tbl_visitor_entry` (
  `veid` int(11) NOT NULL,
  `vname` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `sid` int(11) NOT NULL,
  `wing` char(2) NOT NULL,
  `flat` int(6) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `image` varchar(150) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_visitor_entry`
--

INSERT INTO `tbl_visitor_entry` (`veid`, `vname`, `description`, `sid`, `wing`, `flat`, `phone`, `datetime`, `image`, `status`) VALUES
(1, 'visit A', 'guest', 1, 'A', 122, '8238529241', '2021-03-22 04:23:04', 'user.jpg', 'Approved'),
(2, 'Visitor B', 'Electrician', 1, 'A', 122, '8866784512', '2021-03-22 14:27:39', 'download.png', 'pending'),
(3, 'visitor c', 'electrician', 1, 'A', 122, '8998989898', '2021-03-22 16:14:36', 'user1707.jpg', 'Pending'),
(4, 'visitor d', 'guest', 1, 'A', 122, '7874790493', '2021-03-22 16:16:14', 'images719.png', 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `tbl_city`
--
ALTER TABLE `tbl_city`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `stid` (`stid`);

--
-- Indexes for table `tbl_expense`
--
ALTER TABLE `tbl_expense`
  ADD PRIMARY KEY (`eid`),
  ADD KEY `mid` (`mid`);

--
-- Indexes for table `tbl_landmark`
--
ALTER TABLE `tbl_landmark`
  ADD PRIMARY KEY (`lid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `tbl_maintenance`
--
ALTER TABLE `tbl_maintenance`
  ADD PRIMARY KEY (`mnid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `tbl_maintenance_status`
--
ALTER TABLE `tbl_maintenance_status`
  ADD PRIMARY KEY (`msid`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`mid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `tbl_notice`
--
ALTER TABLE `tbl_notice`
  ADD PRIMARY KEY (`nid`),
  ADD KEY `mid` (`mid`);

--
-- Indexes for table `tbl_service_provider`
--
ALTER TABLE `tbl_service_provider`
  ADD PRIMARY KEY (`spid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `tbl_society`
--
ALTER TABLE `tbl_society`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `stid` (`stid`);

--
-- Indexes for table `tbl_state`
--
ALTER TABLE `tbl_state`
  ADD PRIMARY KEY (`stid`);

--
-- Indexes for table `tbl_visitor`
--
ALTER TABLE `tbl_visitor`
  ADD PRIMARY KEY (`vid`),
  ADD KEY `mid` (`mid`);

--
-- Indexes for table `tbl_visitor_entry`
--
ALTER TABLE `tbl_visitor_entry`
  ADD PRIMARY KEY (`veid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `aid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_city`
--
ALTER TABLE `tbl_city`
  MODIFY `cid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tbl_expense`
--
ALTER TABLE `tbl_expense`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_landmark`
--
ALTER TABLE `tbl_landmark`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_maintenance`
--
ALTER TABLE `tbl_maintenance`
  MODIFY `mnid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_maintenance_status`
--
ALTER TABLE `tbl_maintenance_status`
  MODIFY `msid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `mid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `tbl_notice`
--
ALTER TABLE `tbl_notice`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_service_provider`
--
ALTER TABLE `tbl_service_provider`
  MODIFY `spid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_society`
--
ALTER TABLE `tbl_society`
  MODIFY `sid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_state`
--
ALTER TABLE `tbl_state`
  MODIFY `stid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_visitor`
--
ALTER TABLE `tbl_visitor`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_visitor_entry`
--
ALTER TABLE `tbl_visitor_entry`
  MODIFY `veid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_city`
--
ALTER TABLE `tbl_city`
  ADD CONSTRAINT `tbl_city_ibfk_1` FOREIGN KEY (`stid`) REFERENCES `tbl_state` (`stid`);

--
-- Constraints for table `tbl_expense`
--
ALTER TABLE `tbl_expense`
  ADD CONSTRAINT `tbl_expense_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `tbl_member` (`mid`);

--
-- Constraints for table `tbl_landmark`
--
ALTER TABLE `tbl_landmark`
  ADD CONSTRAINT `tbl_landmark_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `tbl_city` (`cid`);

--
-- Constraints for table `tbl_maintenance`
--
ALTER TABLE `tbl_maintenance`
  ADD CONSTRAINT `tbl_maintenance_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `tbl_society` (`sid`);

--
-- Constraints for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD CONSTRAINT `tbl_member_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `tbl_society` (`sid`);

--
-- Constraints for table `tbl_notice`
--
ALTER TABLE `tbl_notice`
  ADD CONSTRAINT `tbl_notice_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `tbl_member` (`mid`);

--
-- Constraints for table `tbl_service_provider`
--
ALTER TABLE `tbl_service_provider`
  ADD CONSTRAINT `tbl_service_provider_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `tbl_society` (`sid`);

--
-- Constraints for table `tbl_society`
--
ALTER TABLE `tbl_society`
  ADD CONSTRAINT `tbl_society_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `tbl_city` (`cid`),
  ADD CONSTRAINT `tbl_society_ibfk_2` FOREIGN KEY (`stid`) REFERENCES `tbl_state` (`stid`);

--
-- Constraints for table `tbl_visitor`
--
ALTER TABLE `tbl_visitor`
  ADD CONSTRAINT `tbl_visitor_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `tbl_member` (`mid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
