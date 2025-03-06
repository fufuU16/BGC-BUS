-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2025 at 07:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bgc_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`log_id`, `user_id`, `username`, `action`, `timestamp`, `ip_address`, `user_agent`) VALUES
(1, 3, 'Test12345', 'User logged in', '2024-11-25 02:24:34', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36'),
(2, 3, 'Test12345', 'User logged in', '2024-11-25 02:54:36', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36'),
(3, 3, 'Test12345', 'User logged in', '2024-11-25 02:55:15', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36'),
(4, 3, 'Test12345', 'User logged in', '2024-11-25 02:57:24', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36'),
(5, 3, 'Test12345', 'User logged in', '2024-11-25 02:57:48', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36'),
(6, 3, 'Test12345', 'User logged in', '2024-11-25 03:00:18', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36'),
(7, 3, 'Test12345', 'User logged in', '2024-11-25 03:02:55', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36'),
(8, 3, 'Test12345', 'User logged in', '2024-11-25 03:03:52', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36'),
(9, 3, 'Test12345', 'User logged in', '2024-11-25 03:04:33', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36'),
(10, 3, 'Test12345', 'User logged in', '2024-11-25 03:06:27', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36'),
(11, 3, 'Test12345', 'User logged in', '2024-11-25 03:08:07', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36'),
(12, 3, 'Test12345', 'User logged in', '2024-11-25 03:08:45', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36'),
(13, 3, 'Test12345', 'User logged in', '2024-11-25 03:14:07', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36'),
(14, 3, 'Test12345', 'User logged out', '2024-11-25 03:14:10', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36'),
(15, 3, 'Test12345', 'User logged in', '2024-11-25 03:25:22', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36'),
(16, 3, 'Test12345', 'User logged in', '2024-11-25 14:48:35', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36'),
(17, 3, 'Test12345', 'User logged in', '2024-11-26 00:51:16', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36'),
(18, 3, 'Test12345', 'User logged in', '2025-02-25 21:36:18', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(19, 3, 'Test12345', 'User logged out', '2025-02-25 21:36:55', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(20, 3, 'Test12345', 'User logged in', '2025-02-25 21:37:12', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(21, 3, 'Test12345', 'User logged out', '2025-02-25 21:37:14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(22, 3, 'Test12345', 'User logged in', '2025-02-25 21:38:18', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(23, 3, 'Test12345', 'User logged out', '2025-02-25 21:39:47', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(24, 3, 'Test12345', 'User logged in', '2025-02-25 21:41:05', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(25, 3, 'Test12345', 'User logged out', '2025-02-25 21:45:37', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(26, 3, 'Test12345', 'User logged in', '2025-02-25 21:47:03', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(27, 3, 'Test12345', 'User logged in', '2025-03-03 19:51:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(28, 3, 'Test12345', 'User logged in', '2025-03-04 01:30:24', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(29, 3, 'Test12345', 'User logged out', '2025-03-04 01:30:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(30, 3, 'Test12345', 'User logged in', '2025-03-04 01:33:56', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(31, 3, 'Test12345', 'User logged out', '2025-03-04 01:34:36', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(32, 3, 'Test12345', 'User logged in', '2025-03-04 01:39:15', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(33, 3, 'Test12345', 'User logged in', '2025-03-05 22:04:08', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(34, 3, 'Test12345', 'User logged in', '2025-03-05 22:19:34', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(35, 3, 'Test12345', 'User logged in', '2025-03-05 22:26:11', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(36, 3, 'Test12345', 'User logged in', '2025-03-05 22:53:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(37, 3, 'Test12345', 'User logged in', '2025-03-05 23:06:14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(38, 3, 'Test12345', 'User logged in', '2025-03-05 23:08:16', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36');

-- --------------------------------------------------------

--
-- Table structure for table `bus_details`
--

CREATE TABLE `bus_details` (
  `bus_id` varchar(50) NOT NULL,
  `plate_number` varchar(20) DEFAULT NULL,
  `chassis_number` varchar(50) DEFAULT NULL,
  `engine_number` varchar(50) DEFAULT NULL,
  `seating_capacity` int(11) DEFAULT NULL,
  `fuel_type` varchar(20) DEFAULT NULL,
  `next_scheduled_maintenance` date DEFAULT NULL,
  `last_maintenance` date DEFAULT NULL,
  `tire_replacement_date` date DEFAULT NULL,
  `battery_replacement_date` date DEFAULT NULL,
  `brake_check_date` date DEFAULT NULL,
  `driver1` varchar(100) DEFAULT NULL,
  `driver2` varchar(100) DEFAULT NULL,
  `daily_usage` varchar(20) DEFAULT NULL,
  `current_status` varchar(50) DEFAULT NULL,
  `fuel_efficiency` varchar(20) DEFAULT NULL,
  `safety_inspection_date` date DEFAULT NULL,
  `accident_history` text DEFAULT NULL,
  `emergency_equipment` text DEFAULT NULL,
  `registration_expiry` date DEFAULT NULL,
  `AfterMaintenanceOdometer` bigint(20) DEFAULT NULL,
  `TotalOdometer` bigint(20) DEFAULT NULL,
  `last_updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_details`
--

INSERT INTO `bus_details` (`bus_id`, `plate_number`, `chassis_number`, `engine_number`, `seating_capacity`, `fuel_type`, `next_scheduled_maintenance`, `last_maintenance`, `tire_replacement_date`, `battery_replacement_date`, `brake_check_date`, `driver1`, `driver2`, `daily_usage`, `current_status`, `fuel_efficiency`, `safety_inspection_date`, `accident_history`, `emergency_equipment`, `registration_expiry`, `AfterMaintenanceOdometer`, `TotalOdometer`, `last_updated`) VALUES
('Bus01', 'XYZ-1234', 'CH1234567890', 'EN9876543210', 50, 'Diesel', '2024-12-01', '2025-02-26', '2025-02-26', '2024-07-20', '2024-08-10', 'Judy ', 'Judy1', '200 km', 'operational', '8 km/l', '2024-09-05', 'No accidents reported.', 'Fire extinguisher, First aid kit', '2024-01-15', 12312310, 123232115, NULL),
('Bus02', 'ABC-5678', 'CH0987654321', 'EN1234567890', 45, 'Petrol', '2024-11-15', '2024-11-13', '2024-05-10', '2024-06-25', '2024-07-30', '', '', '150 km', 'under_maintenance', '10 km/l', '2024-08-20', 'Minor accident in 2023.', 'First aid kit, Reflective triangles', '2024-02-20', 12312310, 12312312, NULL),
('Bus03', 'DEF-9012', 'CH5678901234', 'EN0987654321', 60, 'Electric', '2024-10-10', '2024-11-12', '2024-04-05', '2024-05-15', '2024-06-20', 'Judy ', 'Pogi', '300 km', 'operational', '12 km/l', '2024-07-15', 'No accidents reported.', 'Fire extinguisher, Emergency exit signs', '2024-03-10', 123123120, 123123130, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bus_passenger_data`
--

CREATE TABLE `bus_passenger_data` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `bus_id` varchar(50) NOT NULL,
  `route` varchar(255) NOT NULL,
  `current_passengers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_passenger_data`
--

INSERT INTO `bus_passenger_data` (`id`, `date`, `bus_id`, `route`, `current_passengers`) VALUES
(1, '2024-11-02', 'Bus01', 'Central Route', 30),
(2, '2024-11-02', 'Bus02', 'North Route', 25),
(3, '2024-11-02', 'Bus03', 'East Route', 20),
(4, '2024-11-02', 'Bus01', 'Central Route', 30),
(5, '2024-11-02', 'Bus02', 'North Route', 25),
(6, '2024-11-02', 'Bus03', 'East Route', 20),
(7, '2024-11-03', 'Bus01', 'Central Route', 35),
(8, '2024-11-03', 'Bus02', 'North Route', 28),
(9, '2024-11-03', 'Bus03', 'East Route', 22),
(10, '2024-11-04', 'Bus01', 'Central Route', 40),
(11, '2024-11-04', 'Bus02', 'North Route', 30),
(12, '2024-11-04', 'Bus03', 'East Route', 25),
(13, '2024-11-23', 'Bus01', 'Central Route', 30),
(14, '2024-11-23', 'Bus02', 'North Route', 25),
(16, '2024-11-23', 'Bus01', 'Central Route', 35),
(17, '2024-11-23', 'Bus02', 'North Route', 28),
(18, '2024-11-23', 'Bus03', 'East Route', 22),
(19, '2024-11-16', 'Bus01', 'Central Route', 30),
(20, '2024-11-17', 'Bus02', 'North Route', 25),
(21, '2024-11-18', 'Bus03', 'East Route', 20),
(22, '2024-11-19', 'Bus01', 'Central Route', 35),
(23, '2024-11-20', 'Bus02', 'North Route', 28),
(24, '2024-11-21', 'Bus03', 'West Route', 22),
(25, '2025-02-27', 'Bus01', 'Central Route', 30),
(26, '2025-02-27', 'Bus02', 'North Route', 25),
(27, '2025-02-27', 'Bus03', 'East Route', 20),
(28, '2025-02-27', 'Bus01', 'East Route', 30),
(29, '2025-02-27', 'Bus02', 'Arca Sout Route', 25),
(30, '2025-02-27', 'Bus03', 'West Route', 20),
(31, '2025-02-27', 'Bus01', 'Central Route', 30),
(32, '2025-02-27', 'Bus02', 'North Route', 25),
(33, '2025-02-27', 'Bus03', 'East Route', 20),
(34, '2025-02-27', 'Bus04', 'West Route', 15),
(35, '2025-02-27', 'Bus05', 'South Route', 18),
(37, '2025-02-27', 'Bus07', 'Uptown Route', 28);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `rfid_tag` varchar(50) NOT NULL,
  `contact_info` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `name`, `rfid_tag`, `contact_info`, `created_at`) VALUES
(1, 'judy', '35F83302', 'judy@g.com', '2024-11-25 19:41:55'),
(2, 'malahay', '53357F23', 'malahay@example.com', '2024-11-25 19:41:55'),
(3, 'test', '4038d14', 'test@example.com', '2024-11-25 19:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `driver_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rfid_tag` varchar(50) NOT NULL,
  `bus_id` varchar(50) NOT NULL,
  `route` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`driver_id`, `name`, `email`, `password`, `rfid_tag`, `bus_id`, `route`, `created_at`) VALUES
(1, 'John Doe', 'john.doe@example.com', '$2y$10$eImiTXuWVxfM37uY4JANjQ==', 'RFID123456', '', '', '2024-11-24 16:54:13'),
(2, 'Jane Smith', 'jane.smith@example.com', '$2y$10$eImiTXuWVxfM37uY4JANjQ==', 'RFID654321', '', '', '2024-11-24 16:54:13'),
(3, 'Alice Johnson', 'alice.johnson@example.com', '$2y$10$eImiTXuWVxfM37uY4JANjQ==', 'RFID987654', '', '', '2024-11-24 16:54:13'),
(4, 'JudyMalahay', 'Judy@gmail.com', '$2y$10$E2ZdybdsQt9Qfyu1OxYn1./61WIL59jd.qcQGQCyE.wHTq3.ILVLm', 'qweeQW13', '', '', '2024-11-24 18:00:32'),
(6, 'JudyMalahay', 'Judy12@gmail.com', '$2y$10$QXODXAPugcoA5BC/Sn6Nd.Dcwpi5jXBkHKX6wmht4EWQJdXB1OVmK', 'E0941C13', '', '', '2024-11-25 16:53:33'),
(7, 'asd', 'sad@2asda.com', '$2y$10$C/xCTRF29VBRQ/XiGHhIxOBV1FSkfZmt2m4LBBMnZdOpy9DJKi5CS', 'asd', '', '', '2025-02-23 07:49:30'),
(10, 'asdasdasd', 'ew@gmail.com', '$2y$10$abXJREiI2JUCSZc9WE1Ofu88pQBzyisCC.jKqcpxf/4NADJjDM4qO', '213123wqqeq', '', '', '2025-02-23 07:50:45'),
(12, 'asdasd', 'asdasd@qweqwe.com', '$2y$10$3YFs9zyACmdkw5oivlkTXuC5/nVBoYscPLVeoV62sEyeQSc8X7jxK', 'dasdas13', '', '', '2025-02-23 07:52:40');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`, `submitted_at`) VALUES
(1, 'sadasd', 'asdasd@qweqwe.com', 'sdasdasdasd', '2025-03-05 14:48:09'),
(2, 'sadasd', 'asdasd@qweqwe.com', 'sdasdasdasd', '2025-03-05 14:50:10'),
(3, 'asd', 'asdasdas@asdas.com', 'asdasdasda', '2025-03-05 14:50:19'),
(4, 'qweqwe', 'qweeqw@wqeqwe.com', 'qweqweqwe', '2025-03-05 14:55:01'),
(5, 'qweqweqw', 'qweeqw@wqeqwe.com', 'qweqweqwe', '2025-03-05 14:55:07'),
(6, 'qweqwe', 'qweeqw@wqeqwe.com', 'qawerqweqwe', '2025-03-05 14:55:11'),
(7, 'qweeqw@wqeqwe.com', 'qweeqw@wqeqwe.com', 'qweeqw@wqeqwe.com', '2025-03-05 14:55:14'),
(8, 'qweeqw@wqeqwe.com', 'qweeqw@wqeqwe.com', 'qweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.comqweeqw@wqeqwe.com', '2025-03-05 14:55:29'),
(9, 'dexter', 'asdasd@qweqwe.com', 'olol', '2025-03-05 16:00:48'),
(10, 'dexter', 'asdasd@qweqwe.com', 'olol', '2025-03-05 16:08:10'),
(11, 'dexter', 'asdasd@qweqwe.com', 'olol', '2025-03-05 16:08:15'),
(12, 'dexter', 'asdasd@qweqwe.com', 'olol', '2025-03-05 16:08:59'),
(13, 'dexter', 'asdasd@qweqwe.com', 'olol', '2025-03-05 16:09:02'),
(14, 'dexter', 'asdasd@qweqwe.com', 'olol', '2025-03-05 16:09:07');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_data`
--

CREATE TABLE `maintenance_data` (
  `id` int(11) NOT NULL,
  `bus_id` varchar(50) NOT NULL,
  `model` varchar(100) NOT NULL,
  `last_maintenance` date NOT NULL,
  `TypeofMaintenance` varchar(100) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `odometer_at_maintenance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenance_data`
--

INSERT INTO `maintenance_data` (`id`, `bus_id`, `model`, `last_maintenance`, `TypeofMaintenance`, `status`, `odometer_at_maintenance`) VALUES
(20, 'Bus01', '', '2025-02-26', 'Tire replacement', 'Done', 123232115),
(21, 'Bus03', '', '2025-02-26', 'Brake replacement', 'Done', 123232115),
(22, 'Bus02', '', '2025-02-26', 'Oil change', 'Done', 123232115),
(23, 'Bus01', '', '2025-02-26', 'Oil change', 'Done', 123232115),
(24, 'Bus01', '', '2025-02-26', 'Oil change', 'Done', 123232115),
(25, 'Bus01', '', '2025-02-26', 'Brake replacement', 'Done', 123232115),
(26, 'Bus01', '', '2025-02-26', 'Tire replacement', 'Done', 123232115),
(27, 'Bus03', '', '2025-02-26', 'Brake replacement', 'Done', 123123123);

-- --------------------------------------------------------

--
-- Table structure for table `passenger_data`
--

CREATE TABLE `passenger_data` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `route` varchar(50) NOT NULL,
  `passengers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passenger_data`
--

INSERT INTO `passenger_data` (`id`, `date`, `route`, `passengers`) VALUES
(1, '2025-11-02', 'Central Route', 1200),
(2, '2024-11-03', 'Central Route', 1500),
(3, '2024-11-04', 'Central Route', 1800),
(4, '2024-11-05', 'Central Route', 2000),
(5, '2024-11-06', 'Central Route', 1700),
(6, '2024-11-07', 'Central Route', 1300),
(7, '2024-11-08', 'Central Route', 1600),
(8, '2024-11-02', 'North Route', 1300),
(9, '2024-11-03', 'North Route', 1600),
(10, '2024-11-04', 'North Route', 1900),
(11, '2024-11-05', 'North Route', 2100),
(12, '2024-11-06', 'North Route', 1800),
(13, '2024-11-07', 'North Route', 1400),
(14, '2024-11-08', 'North Route', 1700),
(15, '2024-11-02', 'East Route', 1100),
(16, '2024-11-03', 'East Route', 1400),
(17, '2024-11-04', 'East Route', 1700),
(18, '2024-10-05', 'East Route', 1900),
(19, '2024-11-06', 'East Route', 1600),
(20, '2024-11-07', 'East Route', 1200),
(21, '2024-11-08', 'East Route', 1500),
(22, '2024-11-02', 'West Route', 1000),
(23, '2024-11-03', 'West Route', 1300),
(24, '2024-11-04', 'West Route', 1600),
(25, '2024-11-05', 'West Route', 1800),
(26, '2024-11-06', 'West Route', 1500),
(27, '2024-11-07', 'West Route', 1100),
(28, '2024-11-08', 'West Route', 1400),
(29, '2024-11-02', 'ARCA South Route', 900),
(30, '2024-11-03', 'ARCA South Route', 1200),
(31, '2024-11-04', 'ARCA South Route', 1500),
(32, '2024-11-05', 'ARCA South Route', 1700),
(33, '2024-11-06', 'ARCA South Route', 1400),
(34, '2024-11-07', 'ARCA South Route', 1000),
(35, '2024-11-08', 'ARCA South Route', 1300),
(36, '2024-11-02', 'Weekend Route', 800),
(37, '2024-11-03', 'Weekend Route', 1100),
(38, '2024-11-04', 'Weekend Route', 1400),
(39, '2024-11-05', 'Weekend Route', 1600),
(40, '2024-11-06', 'Weekend Route', 1300),
(41, '2024-11-07', 'Weekend Route', 900),
(42, '2024-11-08', 'Weekend Route', 1200),
(43, '2024-11-01', 'Central Route', 120),
(44, '2024-11-01', 'North Route', 80),
(45, '2024-11-02', 'Central Route', 150),
(46, '2024-11-02', 'North Route', 90),
(47, '2024-11-02', 'East Route', 60);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `route_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shift_log`
--

CREATE TABLE `shift_log` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shift_logs`
--

CREATE TABLE `shift_logs` (
  `log_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `bus_id` varchar(10) NOT NULL,
  `shift_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `route` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('SuperAdmin','MidAdmin','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'Test123', '$2y$10$N1s2vXbnlYaGbYhVYlVZA.whaC2G6hVCvMfCJwtw8x/pwRG/E.MXy', 'SuperAdmin'),
(2, 'Test1234', '$2y$10$qi.FD9oc.PxVoVdErGiDPOlZg/o3X6iK1LTQPjqUkzg/mJbzGDqwS', 'MidAdmin'),
(3, 'Test12345', '$2y$10$qMKeC7Egf7zjfdLwTDaFIuClEy/exlo/J87aOYxYlFGPvNNB6NgPa', 'Admin'),
(4, 'Admin123', '$2y$10$zC5KCr85UH/5Aonf5j..pO/R8WKPQ3HgjLDGIKa58qb7flxIy3/gK', 'SuperAdmin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bus_details`
--
ALTER TABLE `bus_details`
  ADD PRIMARY KEY (`bus_id`);

--
-- Indexes for table `bus_passenger_data`
--
ALTER TABLE `bus_passenger_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rfid_tag` (`rfid_tag`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driver_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `rfid_tag` (`rfid_tag`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenance_data`
--
ALTER TABLE `maintenance_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passenger_data`
--
ALTER TABLE `passenger_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shift_log`
--
ALTER TABLE `shift_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `shift_logs`
--
ALTER TABLE `shift_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `bus_id` (`bus_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `bus_passenger_data`
--
ALTER TABLE `bus_passenger_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `maintenance_data`
--
ALTER TABLE `maintenance_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `passenger_data`
--
ALTER TABLE `passenger_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shift_log`
--
ALTER TABLE `shift_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shift_logs`
--
ALTER TABLE `shift_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shift_log`
--
ALTER TABLE `shift_log`
  ADD CONSTRAINT `shift_log_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shift_logs`
--
ALTER TABLE `shift_logs`
  ADD CONSTRAINT `shift_logs_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`driver_id`),
  ADD CONSTRAINT `shift_logs_ibfk_2` FOREIGN KEY (`bus_id`) REFERENCES `bus_details` (`bus_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
