-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2025 at 11:11 AM
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
-- Database: `base`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `email`, `password`) VALUES
(1, 'anandpaswan4812@gmail.com', 'admin1234');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `title`, `description`, `file_path`, `uploaded_at`) VALUES
(29, 'computer graphics', NULL, 'uploads/computer graphics.pdf', '2024-11-17 04:59:02'),
(30, 'discreate math', NULL, 'uploads/DiscMath.pdf', '2024-11-17 04:59:22'),
(32, 'dAA', NULL, 'uploads/dsa.pdf', '2024-11-17 08:44:13'),
(33, 'computer network', NULL, 'uploads/Computer-Network-Notes.pdf', '2024-11-17 16:04:57'),
(34, 'sda', NULL, 'uploads/1.pdf', '2025-03-08 16:39:15'),
(35, 'sda', NULL, 'uploads/1.pdf', '2025-03-08 16:39:20'),
(36, 'sda', NULL, 'uploads/1.pdf', '2025-03-08 16:40:20'),
(37, 'ads', NULL, 'uploads/1741452214_1.pdf', '2025-03-08 16:43:34'),
(38, 'ads', NULL, 'uploads/1741452325_1.pdf', '2025-03-08 16:45:25'),
(39, 'aas', NULL, 'uploads/1741453269_1.pdf', '2025-03-08 17:01:09'),
(40, 'aas', NULL, 'uploads/1741453660_1.pdf', '2025-03-08 17:07:40'),
(41, 'aas', NULL, 'uploads/1741453824_bca.pdf', '2025-03-08 17:10:24'),
(42, 'aas', NULL, 'uploads/1741453961_bca.pdf', '2025-03-08 17:12:41');

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

CREATE TABLE `papers` (
  `id` int(11) NOT NULL,
  `paper_name` varchar(255) NOT NULL,
  `paper_year` int(11) NOT NULL,
  `university` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `papers`
--

INSERT INTO `papers` (`id`, `paper_name`, `paper_year`, `university`, `file_path`) VALUES
(1, 'math', 2023, 'grhu', '1.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `id` int(11) NOT NULL,
  `fname` text NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`id`, `fname`, `name`) VALUES
(13, '20241115115910_ANAND using arduino.pdf', 'ANAND using arduino.pdf'),
(14, '20241115115919_DiscMath.pdf', 'DiscMath.pdf'),
(15, '20241116142852_Major_Project_Phase_-1Presentation[1] 2.pdf', 'Major_Project_Phase_-1Presentation[1] 2.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `google_id`, `created_at`, `is_admin`) VALUES
(10, 'anandpaswan4812@gmail.com', '$2y$10$e8C6O5/F94t4sv5kuhaNdO.ofb5.oQjR6Qq4u8CaX.rSJa4y.K5K2', 'Anand Paswan', NULL, '2025-03-08 16:19:50', 0),
(12, 'arjundev953@gmail.com', '$2y$10$MvOxU81EFIUCCq883ndRaux1FQ9M7Q42RRT3c3WfXKpdecbTwiwhS', 'arjun', NULL, '2025-03-10 04:52:12', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `papers`
--
ALTER TABLE `papers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `papers`
--
ALTER TABLE `papers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
