-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2024 at 08:12 PM
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
-- Database: `housekeeping_service`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_service_request` (IN `user_id` INT, IN `service_id` INT, IN `description` TEXT, OUT `request_id` INT)   BEGIN
    INSERT INTO service_requests (user_id, service_id, description, status, created_at, request_date)
    VALUES (user_id, service_id, description, 'Pending', NOW(), NOW());
    
    -- Return the ID of the newly inserted request
    SET request_id = LAST_INSERT_ID();
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `activity`, `created_at`) VALUES
(9, 10, 'User registered', '2024-12-08 13:22:21'),
(10, 10, 'User registered', '2024-12-08 13:22:21'),
(13, 12, 'User registered', '2024-12-08 14:18:21'),
(14, 12, 'User registered', '2024-12-08 14:18:21'),
(15, 13, 'User registered', '2024-12-08 14:32:49'),
(16, 13, 'User registered', '2024-12-08 14:32:49'),
(17, 14, 'User registered', '2024-12-08 22:38:15'),
(18, 14, 'User registered', '2024-12-08 22:38:15'),
(23, 15, 'User registered', '2024-12-08 23:26:49'),
(24, 16, 'User registered', '2024-12-08 23:26:49'),
(25, 17, 'User registered', '2024-12-08 23:26:49'),
(26, 18, 'User registered', '2024-12-08 23:26:49'),
(27, 19, 'User registered', '2024-12-08 23:26:49'),
(28, 20, 'User registered', '2024-12-08 23:26:49'),
(29, 21, 'User registered', '2024-12-08 23:26:49'),
(30, 22, 'User registered', '2024-12-08 23:26:49'),
(31, 23, 'User registered', '2024-12-08 23:26:49'),
(32, 24, 'User registered', '2024-12-08 23:26:49'),
(33, 25, 'User registered', '2024-12-08 23:26:49'),
(34, 26, 'User registered', '2024-12-08 23:26:49'),
(35, 27, 'User registered', '2024-12-08 23:26:49'),
(36, 28, 'User registered', '2024-12-08 23:26:49'),
(37, 29, 'User registered', '2024-12-08 23:26:49'),
(38, 30, 'User registered', '2024-12-08 23:26:49'),
(39, 31, 'User registered', '2024-12-08 23:26:49'),
(40, 32, 'User registered', '2024-12-08 23:26:49'),
(41, 33, 'User registered', '2024-12-08 23:26:49'),
(42, 34, 'User registered', '2024-12-08 23:26:49'),
(43, 35, 'User registered', '2024-12-08 23:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT 'Assigned',
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `date`, `status`) VALUES
(1, 33, '2024-12-09', 'Active'),
(2, 34, '2024-12-09', 'Active'),
(3, 35, '2024-12-09', 'Inactive'),
(4, 36, '2024-12-09', 'Active'),
(5, 37, '2024-12-09', 'Inactive'),
(6, 38, '2024-12-09', 'Active'),
(7, 39, '2024-12-09', 'Active'),
(8, 40, '2024-12-09', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `action_type` varchar(50) NOT NULL,
  `changed_data` text DEFAULT NULL,
  `changed_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `table_name`, `action_type`, `changed_data`, `changed_at`) VALUES
(1, 'users', 'BEFORE INSERT', 'New user: Alice Johnson, Email: alice.johnson@example.com', '2024-12-08 23:26:49'),
(2, 'users', 'BEFORE INSERT', 'New user: Bob Smith, Email: bob.smith@example.com', '2024-12-08 23:26:49'),
(3, 'users', 'BEFORE INSERT', 'New user: Charlie Brown, Email: charlie.brown@example.com', '2024-12-08 23:26:49'),
(4, 'users', 'BEFORE INSERT', 'New user: John Doe, Email: john.doe@example.com', '2024-12-08 23:26:49'),
(5, 'users', 'BEFORE INSERT', 'New user: Jane Smith, Email: jane.smith@example.com', '2024-12-08 23:26:49'),
(6, 'users', 'BEFORE INSERT', 'New user: Mary Johnson, Email: mary.johnson@example.com', '2024-12-08 23:26:49'),
(7, 'users', 'BEFORE INSERT', 'New user: James Brown, Email: james.brown@example.com', '2024-12-08 23:26:49'),
(8, 'users', 'BEFORE INSERT', 'New user: Patricia Davis, Email: patricia.davis@example.com', '2024-12-08 23:26:49'),
(9, 'users', 'BEFORE INSERT', 'New user: Michael Wilson, Email: michael.wilson@example.com', '2024-12-08 23:26:49'),
(10, 'users', 'BEFORE INSERT', 'New user: Elizabeth Moore, Email: elizabeth.moore@example.com', '2024-12-08 23:26:49'),
(11, 'users', 'BEFORE INSERT', 'New user: David Taylor, Email: david.taylor@example.com', '2024-12-08 23:26:49'),
(12, 'users', 'BEFORE INSERT', 'New user: Emma Wilson, Email: emma.wilson@example.com', '2024-12-08 23:26:49'),
(13, 'users', 'BEFORE INSERT', 'New user: Olivia Moore, Email: olivia.moore@example.com', '2024-12-08 23:26:49'),
(14, 'users', 'BEFORE INSERT', 'New user: Liam Brown, Email: liam.brown@example.com', '2024-12-08 23:26:49'),
(15, 'users', 'BEFORE INSERT', 'New user: Sophia Lee, Email: sophia.lee@example.com', '2024-12-08 23:26:49'),
(16, 'users', 'BEFORE INSERT', 'New user: Jackson Green, Email: jackson.green@example.com', '2024-12-08 23:26:49'),
(17, 'users', 'BEFORE INSERT', 'New user: Ava Harris, Email: ava.harris@example.com', '2024-12-08 23:26:49'),
(18, 'users', 'BEFORE INSERT', 'New user: Mason Clark, Email: mason.clark@example.com', '2024-12-08 23:26:49'),
(19, 'users', 'BEFORE INSERT', 'New user: Isabella Adams, Email: isabella.adams@example.com', '2024-12-08 23:26:49'),
(20, 'users', 'BEFORE INSERT', 'New user: Ethan Nelson, Email: ethan.nelson@example.com', '2024-12-08 23:26:49'),
(21, 'users', 'BEFORE INSERT', 'New user: Aiden Carter, Email: aiden.carter@example.com', '2024-12-08 23:26:49'),
(22, 'employees', 'DELETE', 'Employee ID: 25, Name: John Doe', '2024-12-08 23:33:46'),
(23, 'employees', 'DELETE', 'Employee ID: 26, Name: Jane Smith', '2024-12-08 23:33:46'),
(24, 'employees', 'DELETE', 'Employee ID: 27, Name: Mary Johnson', '2024-12-08 23:33:46'),
(25, 'employees', 'DELETE', 'Employee ID: 28, Name: James Brown', '2024-12-08 23:33:46'),
(26, 'employees', 'DELETE', 'Employee ID: 29, Name: Patricia Davis', '2024-12-08 23:33:46'),
(27, 'employees', 'DELETE', 'Employee ID: 30, Name: Michael Wilson', '2024-12-08 23:33:46'),
(28, 'employees', 'DELETE', 'Employee ID: 31, Name: Elizabeth Moore', '2024-12-08 23:33:46'),
(29, 'employees', 'DELETE', 'Employee ID: 32, Name: David Taylor', '2024-12-08 23:33:46');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `payment_status` enum('Pending','Completed','Failed') DEFAULT 'Pending',
  `status` enum('Scheduled','Completed','Cancelled') DEFAULT 'Scheduled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `service_id`, `booking_date`, `start_time`, `end_time`, `total_cost`, `payment_status`, `status`, `created_at`, `updated_at`) VALUES
(25, 12, 3, '2024-12-09', '10:00:00', '12:00:00', 50.00, 'Pending', 'Scheduled', '2024-12-09 04:08:39', '2024-12-09 04:08:39'),
(26, 13, 4, '2024-12-09', '11:00:00', '13:00:00', 75.00, 'Pending', 'Scheduled', '2024-12-09 04:08:39', '2024-12-09 04:08:39'),
(27, 14, 5, '2024-12-09', '14:00:00', '16:00:00', 60.00, 'Completed', 'Completed', '2024-12-09 04:08:39', '2024-12-09 04:08:39'),
(28, 15, 6, '2024-12-09', '09:00:00', '11:00:00', 90.00, 'Failed', 'Cancelled', '2024-12-09 04:08:39', '2024-12-09 04:08:39'),
(29, 16, 7, '2024-12-10', '10:30:00', '12:30:00', 45.00, 'Pending', 'Scheduled', '2024-12-09 04:08:39', '2024-12-09 04:08:39'),
(30, 17, 8, '2024-12-10', '13:00:00', '15:00:00', 85.00, 'Completed', 'Completed', '2024-12-09 04:08:39', '2024-12-09 04:08:39'),
(31, 18, 9, '2024-12-10', '15:30:00', '17:30:00', 100.00, 'Pending', 'Scheduled', '2024-12-09 04:08:39', '2024-12-09 04:08:39'),
(32, 19, 10, '2024-12-10', '08:30:00', '10:30:00', 70.00, 'Completed', 'Completed', '2024-12-09 04:08:39', '2024-12-09 04:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `phone`, `specialization`, `created_at`) VALUES
(33, 'Alice Johnson', 'alice.johnson@example.com', '1234567890', 'Cleaning Specialist', '2024-12-08 17:34:08'),
(34, 'Bob Smith', 'bob.smith@example.com', '1234567891', 'Laundry Expert', '2024-12-08 17:34:08'),
(35, 'Carol Davis', 'carol.davis@example.com', '1234567892', 'Cooking Specialist', '2024-12-08 17:34:08'),
(36, 'David Brown', 'david.brown@example.com', '1234567893', 'Organization Expert', '2024-12-08 17:34:08'),
(37, 'Eve Taylor', 'eve.taylor@example.com', '1234567894', 'Deep Cleaning Specialist', '2024-12-08 17:34:08'),
(38, 'Frank Harris', 'frank.harris@example.com', '1234567895', 'Part-Time Housekeeping', '2024-12-08 17:34:08'),
(39, 'Grace Lee', 'grace.lee@example.com', '1234567896', 'Full-Time Housekeeping', '2024-12-08 17:34:08'),
(40, 'Henry Walker', 'henry.walker@example.com', '1234567897', 'Specialized Cleaner', '2024-12-08 17:34:08');

--
-- Triggers `employees`
--
DELIMITER $$
CREATE TRIGGER `after_delete_employees` AFTER DELETE ON `employees` FOR EACH ROW BEGIN
    INSERT INTO audit_logs (table_name, action_type, changed_data)
    VALUES ('employees', 'DELETE', CONCAT('Employee ID: ', OLD.id, ', Name: ', OLD.name));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_delete_employee` BEFORE DELETE ON `employees` FOR EACH ROW BEGIN
  INSERT INTO logs (action, user_id, log_time) 
  VALUES ('Employee Deleted', OLD.id, NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comments` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `service_id`, `rating`, `comments`, `created_at`) VALUES
(1, 12, 4, 5, 'Excellent service, very professional!', '2024-12-09 04:12:57'),
(2, 13, 5, 4, 'Good cleaning, but could be faster.', '2024-12-09 04:12:57'),
(3, 14, 6, 3, 'Average experience, some areas were missed.', '2024-12-09 04:12:57'),
(4, 15, 7, 2, 'Service was not up to expectations, had issues with staff.', '2024-12-09 04:12:57'),
(5, 16, 8, 5, 'Very thorough and efficient cleaning. Highly recommend!', '2024-12-09 04:12:57'),
(6, 17, 9, 4, 'Nice job, but some areas could use more attention.', '2024-12-09 04:12:57'),
(7, 18, 10, 4, 'Overall good, but the bathroom was not cleaned properly.', '2024-12-09 04:12:57'),
(8, 19, 11, 5, 'Great service, the staff was courteous and did a great job!', '2024-12-09 04:12:57'),
(9, 20, 12, 5, 'Fantastic work, my house looks brand new!', '2024-12-09 04:12:57'),
(10, 21, 4, 4, 'Good service, but the kitchen was not cleaned well.', '2024-12-09 04:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `following_user_id` int(11) NOT NULL,
  `followed_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`following_user_id`, `followed_user_id`, `created_at`) VALUES
(12, 13, '2024-12-09 04:14:22'),
(12, 14, '2024-12-09 04:14:22'),
(13, 14, '2024-12-09 04:14:22'),
(13, 15, '2024-12-09 04:14:22'),
(14, 15, '2024-12-09 04:14:22'),
(15, 16, '2024-12-09 04:14:22'),
(16, 17, '2024-12-09 04:14:22'),
(17, 18, '2024-12-09 04:14:22'),
(18, 19, '2024-12-09 04:14:22'),
(19, 12, '2024-12-09 04:14:22');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `generated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `request_id`, `total_amount`, `generated_at`) VALUES
(1, 9, 50.00, '2024-12-09 04:36:05'),
(2, 10, 75.00, '2024-12-09 04:36:05'),
(3, 11, 60.00, '2024-12-09 04:36:05'),
(4, 12, 90.00, '2024-12-09 04:36:05'),
(5, 13, 45.00, '2024-12-09 04:36:05'),
(6, 14, 85.00, '2024-12-09 04:36:05'),
(7, 15, 100.00, '2024-12-09 04:36:05'),
(8, 16, 70.00, '2024-12-09 04:36:05');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `sent_at`) VALUES
(6, 12, 'Your service request for Service ID: 3 has been created.', '2024-12-09 04:16:20'),
(7, 13, 'Your service request for Service ID: 4 has been created.', '2024-12-09 04:16:20'),
(8, 14, 'Your service request for Service ID: 5 has been created.', '2024-12-09 04:16:20'),
(9, 15, 'Your service request for Service ID: 6 has been created.', '2024-12-09 04:16:20'),
(10, 16, 'Your service request for Service ID: 7 has been created.', '2024-12-09 04:16:20'),
(11, 17, 'Your service request for Service ID: 8 has been created.', '2024-12-09 04:16:20'),
(12, 18, 'Your service request for Service ID: 9 has been created.', '2024-12-09 04:16:20'),
(13, 19, 'Your service request for Service ID: 10 has been created.', '2024-12-09 04:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `discount` decimal(5,2) NOT NULL,
  `valid_until` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `request_id`, `user_id`, `amount_paid`, `payment_date`) VALUES
(9, 9, 12, 50.00, '2024-12-09 04:34:56'),
(10, 10, 13, 75.00, '2024-12-09 04:34:56'),
(11, 11, 14, 60.00, '2024-12-09 04:34:56'),
(12, 12, 15, 90.00, '2024-12-09 04:34:56'),
(13, 13, 16, 45.00, '2024-12-09 04:34:56'),
(14, 14, 17, 85.00, '2024-12-09 04:34:56'),
(15, 15, 18, 100.00, '2024-12-09 04:34:56'),
(16, 16, 19, 70.00, '2024-12-09 04:34:56');

--
-- Triggers `payments`
--
DELIMITER $$
CREATE TRIGGER `after_update_payment` AFTER UPDATE ON `payments` FOR EACH ROW BEGIN
  INSERT INTO logs (action, user_id, log_time) 
  VALUES ('Payment Updated', NEW.user_id, NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `price`, `duration`, `description`, `status`, `created_at`) VALUES
(1, 'Basic Plan', 50.00, 30, NULL, 'inactive', '2024-12-08 17:36:12'),
(2, 'Premium Plan', 100.00, 30, NULL, 'inactive', '2024-12-08 17:36:12'),
(3, 'Gold Plan', 150.00, 30, NULL, 'inactive', '2024-12-08 17:36:12'),
(4, 'Silver Plan', 75.00, 30, NULL, 'inactive', '2024-12-08 17:36:12'),
(5, 'Deluxe Plan', 200.00, 30, NULL, 'inactive', '2024-12-08 17:36:12'),
(6, 'Essential Plan', 40.00, 30, NULL, 'inactive', '2024-12-08 17:36:12'),
(7, 'Luxury Plan', 250.00, 30, NULL, 'inactive', '2024-12-08 17:36:12'),
(8, 'Economy Plan', 30.00, 30, NULL, 'inactive', '2024-12-08 17:36:12'),
(9, 'Standard Plan', 60.00, 30, NULL, 'inactive', '2024-12-08 17:36:12'),
(10, 'Family Plan', 120.00, 30, NULL, 'inactive', '2024-12-08 17:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `plan_features`
--

CREATE TABLE `plan_features` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `feature_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan_features`
--

INSERT INTO `plan_features` (`id`, `plan_id`, `feature_description`) VALUES
(1, 1, 'Basic cleaning services with limited options'),
(2, 2, 'Premium cleaning services with additional features'),
(3, 3, 'Gold cleaning services including premium add-ons'),
(4, 4, 'Silver cleaning plan with window washing included'),
(5, 5, 'Deluxe cleaning with full house and carpet cleaning services'),
(6, 6, 'Essential cleaning plan with basic services'),
(7, 7, 'Luxury cleaning plan with all-inclusive services'),
(8, 8, 'Economy plan for standard cleaning needs'),
(9, 9, 'Standard cleaning plan with moderate services'),
(10, 10, 'Family plan with house-wide cleaning services');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `user_id`, `status`, `created_at`) VALUES
(2, 'Deep Cleaning for Your Home', 'We offer deep cleaning services that cover all rooms and surfaces.', 12, 'Published', '2024-12-09 04:19:44'),
(3, 'Special Discounts for Premium Services', 'Get 20% off on our premium cleaning plans.', 13, 'Published', '2024-12-09 04:19:44'),
(4, 'How to Keep Your House Organized', 'Tips and tricks to keep your home neat and tidy with our cleaning services.', 14, 'Draft', '2024-12-09 04:19:44'),
(5, 'Customer Testimonials on Housekeeping Services', 'Our customers share their experiences with our top-notch housekeeping services.', 15, 'Published', '2024-12-09 04:19:44'),
(6, 'Cleaning Services for Special Occasions', 'We offer tailored cleaning services for your special events and parties.', 16, 'Published', '2024-12-09 04:19:44'),
(7, 'Benefits of Regular Cleaning', 'Learn why regular cleaning is essential for your home and health.', 17, 'Draft', '2024-12-09 04:19:44'),
(8, 'Housekeeping Tips for a Healthier Environment', 'Simple steps to make your living space healthier and more organized.', 18, 'Published', '2024-12-09 04:19:44'),
(9, 'Winter Cleaning Tips for Your Home', 'How to prepare your home for winter with our deep cleaning services.', 19, 'Published', '2024-12-09 04:19:44');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `review_text` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `service_id`, `review_text`, `rating`, `created_at`) VALUES
(22, 12, 3, 'Excellent cleaning service. The team was very professional and thorough.', 5, '2024-12-09 04:22:01'),
(23, 13, 4, 'Good service, but there were some areas that needed more attention.', 4, '2024-12-09 04:22:01'),
(24, 14, 5, 'The kitchen was cleaned perfectly, but some other rooms could have been better.', 3, '2024-12-09 04:22:01'),
(25, 15, 6, 'Very happy with the window cleaning, highly recommend this service.', 5, '2024-12-09 04:22:01'),
(26, 16, 7, 'Carpet cleaning was done well. Some stains were not removed completely.', 4, '2024-12-09 04:22:01'),
(27, 17, 8, 'Bathroom was cleaned properly, but the overall service felt rushed.', 3, '2024-12-09 04:22:01'),
(28, 18, 9, 'Full house cleaning service was great, and I noticed a big difference.', 5, '2024-12-09 04:22:01'),
(29, 19, 10, 'Office cleaning service was completed on time and met our expectations.', 4, '2024-12-09 04:22:01');

--
-- Triggers `reviews`
--
DELIMITER $$
CREATE TRIGGER `after_delete_review` AFTER DELETE ON `reviews` FOR EACH ROW BEGIN
  INSERT INTO logs (action, user_id, log_time) 
  VALUES ('Review Deleted', OLD.user_id, NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `employee_id`, `date`, `start_time`, `end_time`) VALUES
(1, 33, '2024-12-09', '09:00:00', '17:00:00'),
(2, 34, '2024-12-09', '10:00:00', '18:00:00'),
(3, 35, '2024-12-09', '08:30:00', '16:30:00'),
(4, 36, '2024-12-09', '07:00:00', '15:00:00'),
(5, 37, '2024-12-09', '09:00:00', '17:00:00'),
(6, 38, '2024-12-10', '10:00:00', '18:00:00'),
(7, 39, '2024-12-10', '08:30:00', '16:30:00'),
(8, 40, '2024-12-10', '07:00:00', '15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`, `duration`, `created_at`) VALUES
(3, 'House Cleaning', 'Regular cleaning of the house', 50.00, 2, '2024-12-08 17:36:27'),
(4, 'Deep Cleaning', 'Intensive cleaning of the entire house', 100.00, 4, '2024-12-08 17:36:27'),
(5, 'Lawn Mowing', 'Lawn mowing and maintenance', 30.00, 1, '2024-12-08 17:36:27'),
(6, 'Electrical Repair', 'Repairs for electrical issues', 80.00, 3, '2024-12-08 17:36:27'),
(7, 'Plumbing', 'Fixing plumbing issues in your house', 75.00, 2, '2024-12-08 17:36:27'),
(8, 'Home Painting', 'Interior and exterior painting services', 150.00, 5, '2024-12-08 17:36:27'),
(9, 'Furniture Assembly', 'Assembly of furniture', 60.00, 2, '2024-12-08 17:36:27'),
(10, 'Laundry Service', 'Washing and folding of laundry', 25.00, 3, '2024-12-08 17:36:27'),
(11, 'Pet Sitting', 'Sitting and walking your pets', 50.00, 2, '2024-12-08 17:36:27'),
(12, 'Household Repairs', 'Small household repairs', 40.00, 2, '2024-12-08 17:36:27');

--
-- Triggers `services`
--
DELIMITER $$
CREATE TRIGGER `before_delete_services` BEFORE DELETE ON `services` FOR EACH ROW BEGIN
    IF EXISTS (SELECT 1 FROM service_requests WHERE service_id = OLD.id AND status = 'Pending') THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Cannot delete a service associated with active service requests.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_insert_service` BEFORE INSERT ON `services` FOR EACH ROW BEGIN
  SET NEW.name = CONCAT(UPPER(LEFT(NEW.name, 1)), LOWER(SUBSTRING(NEW.name, 2)));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_service` BEFORE UPDATE ON `services` FOR EACH ROW BEGIN
  IF NEW.price < 0 THEN
    SET NEW.price = 0;
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`id`, `name`) VALUES
(1, 'Cleaning'),
(2, 'Gardening'),
(3, 'Plumbing'),
(4, 'Electrical'),
(5, 'Home Repairs'),
(6, 'Carpentry'),
(7, 'Painting'),
(8, 'Household Helpers'),
(9, 'Pet Care'),
(10, 'Laundry');

-- --------------------------------------------------------

--
-- Table structure for table `service_mappings`
--

CREATE TABLE `service_mappings` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_requests`
--

CREATE TABLE `service_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `special_requests` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `request_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_requests`
--

INSERT INTO `service_requests` (`id`, `user_id`, `service_id`, `special_requests`, `status`, `created_at`, `request_date`) VALUES
(9, 12, 3, 'Need deep cleaning of the house', 'Pending', '2024-12-09 04:16:20', '2024-12-09 04:16:20'),
(10, 13, 4, 'General cleaning request', 'Pending', '2024-12-09 04:16:20', '2024-12-09 04:16:20'),
(11, 14, 5, 'Cleaning and organizing the kitchen', 'Pending', '2024-12-09 04:16:20', '2024-12-09 04:16:20'),
(12, 15, 6, 'House cleaning with window washing', 'Pending', '2024-12-09 04:16:20', '2024-12-09 04:16:20'),
(13, 16, 7, 'Carpet cleaning in living room', 'Pending', '2024-12-09 04:16:20', '2024-12-09 04:16:20'),
(14, 17, 8, 'Bathroom cleaning and sanitation', 'Pending', '2024-12-09 04:16:20', '2024-12-09 04:16:20'),
(15, 18, 9, 'Full house cleaning with kitchen deep cleaning', 'Pending', '2024-12-09 04:16:20', '2024-12-09 04:16:20'),
(16, 19, 10, 'Cleaning service for office building', 'Pending', '2024-12-09 04:16:20', '2024-12-09 04:16:20');

--
-- Triggers `service_requests`
--
DELIMITER $$
CREATE TRIGGER `after_insert_service_requests` AFTER INSERT ON `service_requests` FOR EACH ROW BEGIN
    INSERT INTO notifications (user_id, message)
    VALUES (NEW.user_id, CONCAT('Your service request for Service ID: ', NEW.service_id, ' has been created.'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_id`, `plan_id`, `start_date`, `end_date`, `created_at`) VALUES
(1, 12, 1, '2024-12-09', '2025-12-09', '2024-12-09 04:31:25'),
(2, 13, 2, '2024-12-10', '2025-12-10', '2024-12-09 04:31:25'),
(3, 14, 3, '2024-12-11', '2025-12-11', '2024-12-09 04:31:25'),
(4, 15, 4, '2024-12-12', '2025-12-12', '2024-12-09 04:31:25'),
(5, 16, 5, '2024-12-13', '2025-12-13', '2024-12-09 04:31:25'),
(6, 17, 6, '2024-12-14', '2025-12-14', '2024-12-09 04:31:25'),
(7, 18, 7, '2024-12-15', '2025-12-15', '2024-12-09 04:31:25'),
(8, 19, 8, '2024-12-16', '2025-12-16', '2024-12-09 04:31:25');

--
-- Triggers `subscriptions`
--
DELIMITER $$
CREATE TRIGGER `after_update_subscriptions` AFTER UPDATE ON `subscriptions` FOR EACH ROW BEGIN
    INSERT INTO notifications (user_id, message)
    VALUES (NEW.user_id, CONCAT('Your subscription has been updated. Plan ID: ', NEW.plan_id, ', Start Date: ', NEW.start_date, ', End Date: ', NEW.end_date));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `referral_code` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user','employee') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `created_at`, `full_name`, `email`, `phone_number`, `address`, `referral_code`, `password`, `role`) VALUES
(10, 'noorejannat999', '2024-12-08 07:22:21', 'Neha', 'Jannatneha2@gmail.com', '01795707958', 'House no 1009, East Shewrapara, Mirpur Dhaka 1216, Flat no C3L', '', '$2y$10$H54.82TX1.ibg3I9yStcO.ozOI.oUKS.C3loy5cbvU0YvRzeYv0Ly', 'admin'),
(12, 'noorejannat9999', '2024-12-08 08:18:21', 'Noor E Jannat Neha', 'Jannatneha2@gmail.com', '01795707958', 'House no 1009, East Shewrapara, Mirpur Dhaka 1216, Flat no C3L', '', '$2y$10$opBrapgTRN38mcpJbYdVIO/TJseEABPxuM70il0CNEHFlkNhs2ER.', 'user'),
(13, 'noorejannat99999', '2024-12-08 08:32:49', 'Noor E Jannat Neha', 'Jannatneha2@gmail.com', '01795707958', 'House no 1009, East Shewrapara, Mirpur Dhaka 1216, Flat no C3L', '', '$2y$10$jGxjHofTyw1UWItSmAeVIOD4o87yZdAWqdRMBLVTEcit4zQpKY.G2', 'employee'),
(14, 'anik', '2024-12-08 16:38:15', 'Anik', 'anik@gmail.com', '0123456789', 'savar', '', '$2y$10$m7wmjGne2MVjuordGfCILemQeXW3eDcDnSCdQzRnVKrjERGwSW4Su', 'admin'),
(15, 'admin1', '2024-12-08 17:26:49', 'Alice Johnson', 'alice.johnson@example.com', '111-222-3333', '123 Admin St, City, Country', NULL, 'hashedpassword1', 'admin'),
(16, 'admin2', '2024-12-08 17:26:49', 'Bob Smith', 'bob.smith@example.com', '111-222-3334', '124 Admin St, City, Country', NULL, 'hashedpassword2', 'admin'),
(17, 'admin3', '2024-12-08 17:26:49', 'Charlie Brown', 'charlie.brown@example.com', '111-222-3335', '125 Admin St, City, Country', NULL, 'hashedpassword3', 'admin'),
(18, 'housekeeper1', '2024-12-08 17:26:49', 'John Doe', 'john.doe@example.com', '111-222-3336', '123 Housekeeper Ave, City, Country', NULL, 'hashedpassword4', ''),
(19, 'housekeeper2', '2024-12-08 17:26:49', 'Jane Smith', 'jane.smith@example.com', '111-222-3337', '124 Housekeeper Ave, City, Country', NULL, 'hashedpassword5', ''),
(20, 'housekeeper3', '2024-12-08 17:26:49', 'Mary Johnson', 'mary.johnson@example.com', '111-222-3338', '125 Housekeeper Ave, City, Country', NULL, 'hashedpassword6', ''),
(21, 'housekeeper4', '2024-12-08 17:26:49', 'James Brown', 'james.brown@example.com', '111-222-3339', '126 Housekeeper Ave, City, Country', NULL, 'hashedpassword7', ''),
(22, 'housekeeper5', '2024-12-08 17:26:49', 'Patricia Davis', 'patricia.davis@example.com', '111-222-3340', '127 Housekeeper Ave, City, Country', NULL, 'hashedpassword8', ''),
(23, 'housekeeper6', '2024-12-08 17:26:49', 'Michael Wilson', 'michael.wilson@example.com', '111-222-3341', '128 Housekeeper Ave, City, Country', NULL, 'hashedpassword9', ''),
(24, 'housekeeper7', '2024-12-08 17:26:49', 'Elizabeth Moore', 'elizabeth.moore@example.com', '111-222-3342', '129 Housekeeper Ave, City, Country', NULL, 'hashedpassword10', ''),
(25, 'housekeeper8', '2024-12-08 17:26:49', 'David Taylor', 'david.taylor@example.com', '111-222-3343', '130 Housekeeper Ave, City, Country', NULL, 'hashedpassword11', ''),
(26, 'user1', '2024-12-08 17:26:49', 'Emma Wilson', 'emma.wilson@example.com', '111-222-3344', '131 User St, City, Country', NULL, 'hashedpassword12', 'user'),
(27, 'user2', '2024-12-08 17:26:49', 'Olivia Moore', 'olivia.moore@example.com', '111-222-3345', '132 User St, City, Country', NULL, 'hashedpassword13', 'user'),
(28, 'user3', '2024-12-08 17:26:49', 'Liam Brown', 'liam.brown@example.com', '111-222-3346', '133 User St, City, Country', NULL, 'hashedpassword14', 'user'),
(29, 'user4', '2024-12-08 17:26:49', 'Sophia Lee', 'sophia.lee@example.com', '111-222-3347', '134 User St, City, Country', NULL, 'hashedpassword15', 'user'),
(30, 'user5', '2024-12-08 17:26:49', 'Jackson Green', 'jackson.green@example.com', '111-222-3348', '135 User St, City, Country', NULL, 'hashedpassword16', 'user'),
(31, 'user6', '2024-12-08 17:26:49', 'Ava Harris', 'ava.harris@example.com', '111-222-3349', '136 User St, City, Country', NULL, 'hashedpassword17', 'user'),
(32, 'user7', '2024-12-08 17:26:49', 'Mason Clark', 'mason.clark@example.com', '111-222-3350', '137 User St, City, Country', NULL, 'hashedpassword18', 'user'),
(33, 'user8', '2024-12-08 17:26:49', 'Isabella Adams', 'isabella.adams@example.com', '111-222-3351', '138 User St, City, Country', NULL, 'hashedpassword19', 'user'),
(34, 'user9', '2024-12-08 17:26:49', 'Ethan Nelson', 'ethan.nelson@example.com', '111-222-3352', '139 User St, City, Country', NULL, 'hashedpassword20', 'user'),
(35, 'user10', '2024-12-08 17:26:49', 'Aiden Carter', 'aiden.carter@example.com', '111-222-3353', '140 User St, City, Country', NULL, 'hashedpassword21', 'user');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `after_insert_user` AFTER INSERT ON `users` FOR EACH ROW BEGIN
  INSERT INTO logs (action, user_id, log_time) 
  VALUES ('User Created', NEW.id, NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_users` BEFORE UPDATE ON `users` FOR EACH ROW BEGIN
    IF NEW.role NOT IN ('Admin', 'User', 'Housekeeper') THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Invalid role. Allowed roles are Admin, User, and Housekeeper.';
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`following_user_id`,`followed_user_id`),
  ADD KEY `followed_user_id` (`followed_user_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan_features`
--
ALTER TABLE `plan_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_mappings`
--
ALTER TABLE `service_mappings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `service_requests`
--
ALTER TABLE `service_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `plan_features`
--
ALTER TABLE `plan_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `service_mappings`
--
ALTER TABLE `service_mappings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service_requests`
--
ALTER TABLE `service_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `service_requests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assignments_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`following_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`followed_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `service_requests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `service_requests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `plan_features`
--
ALTER TABLE `plan_features`
  ADD CONSTRAINT `plan_features_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_mappings`
--
ALTER TABLE `service_mappings`
  ADD CONSTRAINT `service_mappings_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_mappings_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `service_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_requests`
--
ALTER TABLE `service_requests`
  ADD CONSTRAINT `service_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_requests_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
