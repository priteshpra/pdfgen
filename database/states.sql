-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 08:16 AM
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
-- Database: `pdfgen`
--

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `StateID` bigint(20) NOT NULL,
  `CountryID` bigint(20) NOT NULL DEFAULT 0,
  `State` varchar(250) DEFAULT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT 1,
  `GSTCode` varchar(50) DEFAULT NULL,
  `CreatedBy` tinyint(4) NOT NULL DEFAULT 1,
  `CreatedDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `ModifiedBy` tinyint(4) DEFAULT NULL,
  `ModifiedDate` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`StateID`, `CountryID`, `State`, `Status`, `GSTCode`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`, `created_at`, `updated_at`) VALUES
(1, 101, 'Andaman and Nicobar Island', 1, '35', 1, '2018-04-05 13:29:08', 1, '2020-11-23 09:17:33', '2024-12-05 05:15:22', '2024-12-04 23:59:58'),
(2, 101, 'Andhra Pradesh', 1, '28', 1, '2018-04-05 13:29:08', 1, '2020-11-23 09:17:45', '2024-12-05 05:15:22', NULL),
(3, 101, 'Arunachal Pradesh', 1, '12', 1, '2018-04-05 13:29:08', 1, '2020-11-23 09:18:23', '2024-12-05 05:15:22', NULL),
(4, 101, 'Assam', 1, '18', 1, '2018-04-05 13:29:08', 1, '2020-11-23 09:18:36', '2024-12-05 05:15:22', NULL),
(5, 101, 'Bihar', 1, '10', 1, '2018-04-05 13:29:08', 1, '2020-11-23 09:18:42', '2024-12-05 05:15:22', NULL),
(6, 101, 'Chandigarh', 1, '04', 1, '2018-04-05 13:29:08', 1, '2020-11-23 09:18:55', '2024-12-05 05:15:22', NULL),
(7, 101, 'Chhattisgarh', 1, '22', 1, '2018-04-05 13:29:08', 1, '2020-11-23 09:19:01', '2024-12-05 05:15:22', NULL),
(8, 101, 'Dadra and Nagar Haveli', 1, '26', 1, '2018-04-05 13:29:08', 1, '2020-11-23 09:19:16', '2024-12-05 05:15:22', NULL),
(9, 101, 'Daman and Diu', 1, '25', 1, '2018-04-05 13:29:08', 1, '2020-11-23 09:19:22', '2024-12-05 05:15:22', NULL),
(10, 101, 'Delhi', 1, '07', 1, '2018-04-05 13:29:08', 1, '2020-11-23 09:19:31', '2024-12-05 05:15:22', NULL),
(11, 101, 'Goa', 1, '30', 1, '2018-04-05 13:29:08', 1, '2020-11-23 09:19:45', '2024-12-05 05:15:22', NULL),
(12, 101, 'Gujarat', 1, '24', 1, '2018-04-05 13:29:08', 1, '2020-11-19 06:44:20', '2024-12-05 05:15:22', NULL),
(13, 101, 'Haryana', 1, '06', 1, '2018-04-05 13:29:08', 1, '2020-11-23 09:20:01', '2024-12-05 05:15:22', NULL),
(14, 101, 'Himachal Pradesh', 1, '02', 1, '2018-04-05 13:29:08', 1, '2020-11-23 09:20:09', '2024-12-05 05:15:22', NULL),
(15, 101, 'Jammu and Kashmir', 1, '01', 1, '2018-04-05 13:29:08', 1, '2020-11-23 09:20:15', '2024-12-05 05:15:22', NULL),
(16, 101, 'Jharkhand', 1, '20', 1, '2018-04-05 13:29:08', 1, '2020-11-23 09:20:32', '2024-12-05 05:15:22', NULL),
(17, 101, 'Karnataka', 1, '29', 1, '2018-04-05 13:29:08', 1, '2020-11-23 09:20:42', '2024-12-05 05:15:22', NULL),
(18, 101, 'Kenmore', 1, NULL, 1, '2018-04-05 13:29:08', NULL, NULL, '2024-12-05 05:15:22', NULL),
(19, 101, 'Kerala', 1, '32', 1, '2018-04-05 13:29:08', 1, '2020-11-23 09:21:05', '2024-12-05 05:15:22', NULL),
(20, 101, 'Lakshadweep', 1, '31', 1, '2018-04-05 13:29:08', 1, '2020-11-23 09:21:23', '2024-12-05 05:15:22', NULL),
(21, 101, 'Madhya Pradesh', 1, '23', 1, '2018-04-05 13:29:08', 1, '2020-11-23 12:39:29', '2024-12-05 05:15:22', NULL),
(22, 101, 'Maharashtra', 1, '27', 1, '2018-04-05 13:29:08', 1, '2020-11-23 12:39:42', '2024-12-05 05:15:22', NULL),
(23, 101, 'Manipur', 1, '14', 1, '2018-04-05 13:29:08', 1, '2020-11-23 12:40:03', '2024-12-05 05:15:22', NULL),
(24, 101, 'Meghalaya', 1, '17', 1, '2018-04-05 13:29:08', 1, '2020-11-23 12:40:16', '2024-12-05 05:15:22', NULL),
(25, 101, 'Mizoram', 1, '15', 1, '2018-04-05 13:29:08', 1, '2020-11-23 12:45:03', '2024-12-05 05:15:22', NULL),
(26, 101, 'Nagaland', 1, '13', 1, '2018-04-05 13:29:32', 1, '2020-11-23 12:45:13', '2024-12-05 05:15:22', NULL),
(27, 101, 'Narora', 1, NULL, 1, '2018-04-05 13:29:32', NULL, NULL, '2024-12-05 05:15:22', NULL),
(28, 101, 'Natwar', 1, NULL, 1, '2018-04-05 13:29:32', NULL, NULL, '2024-12-05 05:15:22', NULL),
(29, 101, 'Odisha', 1, '21', 1, '2018-04-05 13:29:32', 1, '2020-11-23 12:45:40', '2024-12-05 05:15:22', NULL),
(30, 101, 'Paschim Medinipur', 1, NULL, 1, '2018-04-05 13:29:32', NULL, NULL, '2024-12-05 05:15:22', NULL),
(31, 101, 'Pondicherry', 1, '34', 1, '2018-04-05 13:29:32', 1, '2020-11-23 12:45:56', '2024-12-05 05:15:22', NULL),
(32, 101, 'Punjab', 1, '03', 1, '2018-04-05 13:29:32', 1, '2020-11-23 12:46:11', '2024-12-05 05:15:22', NULL),
(33, 101, 'Rajasthan', 1, '08', 1, '2018-04-05 13:29:32', 1, '2020-11-23 12:46:56', '2024-12-05 05:15:22', NULL),
(34, 101, 'Sikkim', 1, '11', 1, '2018-04-05 13:29:32', 1, '2020-11-23 12:48:06', '2024-12-05 05:15:22', NULL),
(35, 101, 'Tamil Nadu', 1, '33', 1, '2018-04-05 13:29:32', 1, '2020-11-23 12:48:21', '2024-12-05 05:15:22', NULL),
(36, 101, 'Telangana', 1, '36', 1, '2018-04-05 13:29:32', 1, '2020-11-23 12:48:39', '2024-12-05 05:15:22', NULL),
(37, 101, 'Tripura', 1, '16', 1, '2018-04-05 13:29:32', 1, '2020-11-23 12:48:56', '2024-12-05 05:15:22', NULL),
(38, 101, 'Uttar Pradesh', 1, '09', 1, '2018-04-05 13:29:32', 1, '2020-11-23 12:49:11', '2024-12-05 05:15:22', NULL),
(39, 101, 'Uttarakhand', 1, '05', 1, '2018-04-05 13:29:32', 1, '2020-11-23 12:49:27', '2024-12-05 05:15:22', NULL),
(40, 101, 'Vaishali', 1, NULL, 1, '2018-04-05 13:29:32', NULL, NULL, '2024-12-05 05:15:22', NULL),
(41, 101, 'West Bengal', 1, '19', 1, '2018-04-05 13:29:32', 1, '2020-11-23 12:49:50', '2024-12-05 05:15:22', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`StateID`),
  ADD KEY `StateID` (`StateID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `StateID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
