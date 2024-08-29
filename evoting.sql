-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2024 at 09:47 AM
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
-- Database: `evoting`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `c_id` int(11) NOT NULL,
  `election_id` int(11) DEFAULT NULL,
  `c_name` varchar(250) DEFAULT NULL,
  `c_details` text DEFAULT NULL,
  `c_photo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`c_id`, `election_id`, `c_name`, `c_details`, `c_photo`) VALUES
(65, 106, 'Ram', 'We provide direction and vision, but also inspire and motivate. We are champions for our teams, celebrating successes and offering guidance through challenges.', '../assets/images/candidate_photos/69739186134_676108141380ecdb8c11d3e1d089f36ddfac569b232.jpg'),
(66, 106, 'vivek', 'We provide direction and vision, but also inspire and motivate. We are champions for our teams, celebrating successes and offering guidance through challenges.', '../assets/images/candidate_photos/94101234889_87424563659286-2864045_south-movie-hero-ram.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `e_id` int(11) NOT NULL,
  `e_topic` varchar(255) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `e_status` varchar(45) DEFAULT NULL,
  `no_of_candidates` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `election`
--

INSERT INTO `election` (`e_id`, `e_topic`, `start_date`, `end_date`, `e_status`, `no_of_candidates`) VALUES
(106, 'Manager', '2024-07-11 11:26:00', '2024-07-11 11:30:00', 'Expired', 3);

-- --------------------------------------------------------

--
-- Table structure for table `e_admin`
--

CREATE TABLE `e_admin` (
  `a_id` varchar(45) NOT NULL,
  `a_pass` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `e_admin`
--

INSERT INTO `e_admin` (`a_id`, `a_pass`) VALUES
('admin156', '123');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `vote_id` int(11) NOT NULL,
  `e_id` int(11) DEFAULT NULL,
  `v_id` int(11) DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`vote_id`, `e_id`, `v_id`, `c_id`) VALUES
(33, 106, 87, 65),
(34, 106, 88, 66);

-- --------------------------------------------------------

--
-- Table structure for table `voter`
--

CREATE TABLE `voter` (
  `v_id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `f_name` varchar(45) DEFAULT NULL,
  `l_name` varchar(45) DEFAULT NULL,
  `pass` varchar(45) DEFAULT NULL,
  `v_status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voter`
--

INSERT INTO `voter` (`v_id`, `username`, `f_name`, `l_name`, `pass`, `v_status`) VALUES
(87, '12345', 'vishal', 'kumar', 'da3e59b6fa5e39c57e2849a12160b477a292ea92', 'Active'),
(88, '123', 'vishal', 'kumar', '822e2ebb22bd755aec6f8b7b2f2ec930df44fad8', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `election`
--
ALTER TABLE `election`
  ADD PRIMARY KEY (`e_id`),
  ADD UNIQUE KEY `constraint_name` (`e_topic`);

--
-- Indexes for table `e_admin`
--
ALTER TABLE `e_admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`vote_id`);

--
-- Indexes for table `voter`
--
ALTER TABLE `voter`
  ADD PRIMARY KEY (`v_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `voter`
--
ALTER TABLE `voter`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
