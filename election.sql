-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2025 at 03:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `election`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `c_id` int(11) NOT NULL,
  `election_id` int(11) DEFAULT NULL,
  `c_name` varchar(100) DEFAULT NULL,
  `c_details` text DEFAULT NULL,
  `c_photo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`c_id`, `election_id`, `c_name`, `c_details`, `c_photo`) VALUES
(19, 107, 'megha', 'will bring happiness', '../assets/images/candidate_photos/69515520563_77359460495cand1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `e_id` int(11) NOT NULL,
  `e_topic` varchar(100) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `e_status` varchar(20) DEFAULT NULL,
  `no_of_candidates` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `election`
--

INSERT INTO `election` (`e_id`, `e_topic`, `start_date`, `end_date`, `e_status`, `no_of_candidates`) VALUES
(107, 'MP', '2024-11-20 14:12:00', '2024-11-25 23:16:00', 'Expired', 2);

-- --------------------------------------------------------

--
-- Table structure for table `e_admin`
--

CREATE TABLE `e_admin` (
  `a_id` varchar(11) NOT NULL,
  `a_pass` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `e_admin`
--

INSERT INTO `e_admin` (`a_id`, `a_pass`) VALUES
('Admin', 'admin156');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `r_id` int(11) NOT NULL,
  `new_name` varchar(255) DEFAULT NULL,
  `new_fname` varchar(255) DEFAULT NULL,
  `new_mname` varchar(255) DEFAULT NULL,
  `new_dob` date DEFAULT NULL,
  `new_gender` varchar(255) DEFAULT NULL,
  `new_age` int(11) DEFAULT NULL,
  `new_phone` varchar(11) DEFAULT NULL,
  `new_nationality` varchar(255) DEFAULT NULL,
  `new_disability` varchar(255) DEFAULT NULL,
  `new_photo` text DEFAULT NULL,
  `new_email` varchar(255) DEFAULT NULL,
  `new_education` varchar(255) DEFAULT NULL,
  `r_status` enum('Pending','Accepted','Rejected') DEFAULT 'Pending',
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_action_date` timestamp NULL DEFAULT NULL,
  `message_shown` tinyint(1) DEFAULT 0,
  `voter_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `vote_id` int(11) NOT NULL,
  `e_id` int(11) DEFAULT NULL,
  `v_id` int(55) DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`vote_id`, `e_id`, `v_id`, `c_id`) VALUES
(1, 105, 6, 5),
(2, 105, 14, 4),
(3, 105, 620040912, 4),
(4, 105, 620040922, 6),
(5, 106, 620040922, 13),
(6, 106, 1520040519, 14),
(7, 107, 2147483647, 19);

-- --------------------------------------------------------

--
-- Table structure for table `voter`
--

CREATE TABLE `voter` (
  `app_id` int(11) NOT NULL,
  `v_name` varchar(100) DEFAULT NULL,
  `f_name` varchar(100) DEFAULT NULL,
  `m_name` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `v_status` varchar(20) DEFAULT NULL,
  `disability` varchar(10) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `education` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `v_photo` text DEFAULT NULL,
  `v_id` int(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voter`
--

INSERT INTO `voter` (`app_id`, `v_name`, `f_name`, `m_name`, `dob`, `gender`, `age`, `v_status`, `disability`, `nationality`, `education`, `email`, `phone`, `pass`, `v_photo`, `v_id`) VALUES
(6, 'Sheetal Maurya', 'Shekhar Maurya', 'Anamika Maurya', '2004-09-12', 'Female', 20, 'Approved', 'NO', 'indian', 'B.tech', 'sheetal@gmail.com', '2147483665', '8d2aec51707a48f73cfe754b1561c6e718578b71', 'assets/images/voter_photos/9028729404_10037839161voter.jpg', 620040912),
(23, 'Shruti Suman', 'fhdjj', 'anita singh', '2001-08-12', 'Female', 29, 'Approved', 'NO', 'indian', 'b.tech', 'ajcio@gmail.com', '8765432123', '8d2aec51707a48f73cfe754b1561c6e718578b71', 'assets/images/voter_photos/24552723144_96927277836voter1.jpg', 232024);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `election_id` (`election_id`);

--
-- Indexes for table `election`
--
ALTER TABLE `election`
  ADD PRIMARY KEY (`e_id`),
  ADD UNIQUE KEY `e_topic` (`e_topic`);

--
-- Indexes for table `e_admin`
--
ALTER TABLE `e_admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`vote_id`);

--
-- Indexes for table `voter`
--
ALTER TABLE `voter`
  ADD PRIMARY KEY (`app_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `voter`
--
ALTER TABLE `voter`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `candidate_ibfk_1` FOREIGN KEY (`election_id`) REFERENCES `election` (`e_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
