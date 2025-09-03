-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2025 at 11:27 AM
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
-- Database: `calendar_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_description` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `event_name`, `event_description`, `start_date`, `end_date`, `start_time`, `end_time`, `created_at`) VALUES
(20, 'IJA1 Ispit', 'CSS animacije', '2025-09-08', '2025-09-08', '09:00:00', '10:00:00', '2025-09-03 09:17:20'),
(22, 'Ispit Elektro', 'Tautologija - Amfi', '2025-09-11', '2025-09-11', '08:00:00', '10:00:00', '2025-09-03 09:24:36'),
(23, 'Ispit RM', '100 Pitanja - Amfi', '2025-09-14', '2025-09-14', '11:00:00', '12:00:00', '2025-09-03 09:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_stats`
--

CREATE TABLE `visitor_stats` (
  `id` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `visit_count` int(11) DEFAULT 0,
  `events_added` int(11) DEFAULT 0,
  `events_edited` int(11) DEFAULT 0,
  `events_deleted` int(11) DEFAULT 0,
  `downloads` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitor_stats`
--

INSERT INTO `visitor_stats` (`id`, `visit_date`, `visit_count`, `events_added`, `events_edited`, `events_deleted`, `downloads`) VALUES
(1, '2025-09-03', 35, 4, 2, 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor_stats`
--
ALTER TABLE `visitor_stats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_date` (`visit_date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `visitor_stats`
--
ALTER TABLE `visitor_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
