-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: http://localhost/phpmyadmin/index.php?route=/database/structure&db=attendance-major
-- Generation Time: Feb 07, 2024 at 09:25 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arjun`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `duration` varchar(255) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `duration`, `modified_at`) VALUES
(5, 'BCA', '3 years', '2021-02-06 00:57:30'),
(10, 'vdvgfg', 'frgd', '2021-02-06 03:00:46'),
(11, 'MCA', '2 yrs', '2021-02-07 08:06:34');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `designation` text NOT NULL,
  `course` text NOT NULL,
  `subject` text NOT NULL,
  `t_id` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `name`, `designation`, `course`, `subject`, `t_id`, `password`, `modified_at`) VALUES
(3, 'Arjun', 'Designer', 'BCA', 'O.S.', '123', '123', '2021-02-06 04:54:22'),
(4, 'Gaurav', 'Engineer', 'BCA', 'Network', '222', '222', '2021-02-06 05:25:46'),
(6, 'ankur', 'engineer', 'MCA', 'Files', '888', '888', '2021-02-07 08:18:58');

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `id` int(11) NOT NULL,
  `sid` bigint(20) NOT NULL,
  `tid` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `record` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`id`, `sid`, `tid`, `status`, `record`, `date`, `day`, `month`, `year`, `modified_at`) VALUES
(3, 11, 333, '1', 1, '06-02-2021', 6, 2, 2021, '2021-02-06 07:47:13'),
(4, 12, 333, '1', 0, '06-02-2021', 6, 2, 2021, '2021-02-06 07:47:22'),
(5, 7, 123, '0', 1, '05-02-2021', 5, 2, 2021, '2021-02-06 08:24:15'),
(6, 8, 123, '0', 0, '05-02-2021', 5, 2, 2021, '2021-02-07 08:16:35'),
(7, 9, 123, '0', 1, '05-02-2021', 5, 2, 2021, '2021-02-07 08:16:54'),
(8, 7, 123, '0', 1, '06-02-2021', 6, 2, 2021, '2021-02-07 08:16:32'),
(9, 7, 123, '1', 1, '07-02-2021', 7, 2, 2021, '2021-02-07 08:16:32'),
(10, 8, 123, '1', 0, '07-02-2021', 7, 2, 2021, '2021-02-07 08:16:35'),
(11, 9, 123, '1', 1, '07-02-2021', 7, 2, 2021, '2021-02-07 08:16:54'),
(12, 13, 888, '1', 1, '07-02-2021', 7, 2, 2021, '2021-02-07 08:19:56');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `roll_no` varchar(20) NOT NULL,
  `course` text NOT NULL,
  `subject` text NOT NULL,
  `s_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `roll_no`, `course`, `subject`, `s_id`, `password`, `address`, `modified_at`) VALUES
(7, 'abc', '123', 'BCA', 'O.S.', '123', '123', 'padegoan', '2021-02-06 04:57:43'),
(8, 'xyz', '456', 'BCA', 'O.S.', '456', '456', 'padegoan', '2021-02-06 04:58:10'),
(9, 'tomar', '789', 'BCA', 'O.S.', '789', '789', 'padegoan', '2021-02-06 04:58:30'),
(10, 'pandit', '789', 'BCA', 'Network', '000', '000', 'padegoan', '2021-02-06 05:20:50'),
(11, 'suraj', '4165', 'BCA', 'Files', '111', '111', 'ansar colny', '2021-02-06 05:21:14'),
(12, 'meghna', '484655', 'BCA', 'Files', '222', '222', 'padegoan', '2021-02-06 05:52:43'),
(13, 'vivek', '456789', 'MCA', 'Files', '777', '123', 'mumbai', '2021-02-07 08:12:19');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `course` text NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `name`, `course`, `modified_at`) VALUES
(1, 'O.S.', 'BCA - 3 years', '2021-02-06 04:45:45'),
(2, 'Network', 'BCA - 3 years', '2021-02-06 04:45:55'),
(3, 'Files', 'BCA - 3 years', '2021-02-06 04:46:08'),
(5, 'abc', 'MCA - 2 yrs', '2021-02-07 08:07:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `record`
--
ALTER TABLE `record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
