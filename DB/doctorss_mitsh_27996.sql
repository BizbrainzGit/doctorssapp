-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2021 at 02:44 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctorss_mitsh_27996`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment_details`
--

CREATE TABLE `appointment_details` (
  `id` int(11) NOT NULL,
  `doctors_id` int(11) NOT NULL,
  `specialization_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `patients_id` int(11) NOT NULL,
  `diseases_description` text NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1,
  `time_slot` varchar(30) NOT NULL,
  `created_ip` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_ip` varchar(20) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `appointment_details`
--

INSERT INTO `appointment_details` (`id`, `doctors_id`, `specialization_id`, `appointment_date`, `patients_id`, `diseases_description`, `status_id`, `time_slot`, `created_ip`, `created_by`, `created_on`, `modified_ip`, `modified_by`, `modified_on`) VALUES
(1, 4, 1, '2021-04-05', 6, 'hello', 4, '09:00  - 09:30 ', '::1', 2, '2021-04-01 13:41:18', NULL, NULL, NULL),
(2, 4, 1, '2021-04-07', 7, '', 4, '09:30  - 10:00 ', '::1', 2, '2021-04-01 13:42:03', NULL, NULL, NULL),
(3, 5, 5, '2021-04-06', 7, '', 4, '09:00  - 09:30 ', '::1', 2, '2021-04-01 13:43:04', NULL, NULL, NULL),
(4, 5, 5, '2021-04-07', 6, '', 4, '10:30  - 11:00 ', '::1', 2, '2021-04-01 13:43:44', NULL, NULL, NULL),
(5, 4, 1, '2021-04-12', 7, '', 4, '09:00  - 09:30 ', '::1', 8, '2021-04-03 11:44:11', NULL, NULL, NULL),
(6, 4, 1, '2021-04-12', 7, '', 6, '09:00  - 09:30 ', '::1', 8, '2021-04-03 11:44:11', NULL, NULL, NULL),
(7, 4, 1, '2021-04-12', 7, '', 2, '16:20  - 16:40 ', '::1', 2, '2021-04-05 13:04:03', NULL, NULL, NULL),
(8, 5, 5, '2021-04-13', 6, 'yfjujkyfk', 1, '09:00  - 09:30 ', '::1', 8, '2021-04-06 06:36:04', NULL, NULL, NULL),
(9, 4, 1, '2021-04-12', 7, 'fdghdcb', 2, '13:00  - 13:20 ', '::1', 4, '2021-04-06 13:50:14', NULL, NULL, NULL),
(10, 5, 5, '2021-04-13', 6, 'gdfhg', 1, '13:30  - 14:00 ', '::1', 4, '2021-04-06 13:51:38', NULL, NULL, NULL),
(11, 5, 5, '2021-04-16', 7, 'dfgbdcgb', 1, '12:00  - 12:30 ', '::1', 4, '2021-04-06 14:44:27', NULL, NULL, NULL),
(12, 4, 1, '2021-04-12', 6, 'dexcyhrdxy', 2, '14:00  - 14:20 ', '::1', 4, '2021-04-06 14:45:14', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `billing_tests`
--

CREATE TABLE `billing_tests` (
  `id` int(11) NOT NULL,
  `patient_billing_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `booking_status`
--

CREATE TABLE `booking_status` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_status`
--

INSERT INTO `booking_status` (`id`, `name`) VALUES
(1, '<label class=\"badge badge-success\" id=\"active\">Pending for Approval</label>'),
(2, '<label class=\"badge badge-primary\" id=\"inactive\">Approved & Booked</label>'),
(3, '<label class=\"badge badge-warning\" id=\"pending\">Cancelled by User</label>'),
(4, '<label class=\"badge badge-info\" id=\"followup\">Visited Doctor</label>'),
(5, ' <label class=\"badge badge-danger\" id=\"closed\">User failed to Visit  </label>'),
(6, '  <label class=\"badge badge-warning\" id=\"pending\">Cancelled By Doctor</label>');

-- --------------------------------------------------------

--
-- Table structure for table `configuration_fields`
--

CREATE TABLE `configuration_fields` (
  `id` int(11) NOT NULL,
  `configuration_id` int(11) NOT NULL,
  `field_name` varchar(150) NOT NULL,
  `field_value` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `configuration_fields`
--

INSERT INTO `configuration_fields` (`id`, `configuration_id`, `field_name`, `field_value`) VALUES
(1, 1, 'smtp_host', NULL),
(2, 1, 'smtp_port', NULL),
(3, 1, 'smtp_username', NULL),
(4, 1, 'smtp_password', NULL),
(5, 2, 'map_api_key', NULL),
(6, 2, 'fcm_android_key', NULL),
(7, 3, 'ios_fcm_key', NULL),
(8, 3, 'ios_pem_file', NULL),
(9, 1, 'smtp_sender', NULL),
(10, 1, 'smtp_tls', '0'),
(11, 1, 'smtp_ssl', '1'),
(12, 4, 'SERVICE_URL', NULL),
(13, 4, 'DEFAULT_LOGO_IMAGE', NULL),
(14, 4, 'DEFAULT_AGENT_IMAGE', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `configuration_settings`
--

CREATE TABLE `configuration_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `configuration_settings`
--

INSERT INTO `configuration_settings` (`id`, `name`) VALUES
(1, 'SMTP Settings'),
(2, 'Google Settings'),
(3, 'IOS Settings'),
(4, 'Other Settings');

-- --------------------------------------------------------

--
-- Table structure for table `doctors_time_schedule`
--

CREATE TABLE `doctors_time_schedule` (
  `id` int(11) NOT NULL,
  `doctors_id` int(11) NOT NULL,
  `weekday` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `appointment_type` tinyint(2) NOT NULL COMMENT '1 for Online, 2 for Offline',
  `shift_start_time` time DEFAULT NULL,
  `shift_end_time` time DEFAULT NULL,
  `patient_time` varchar(120) DEFAULT NULL,
  `created_ip` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_ip` varchar(100) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors_time_schedule`
--

INSERT INTO `doctors_time_schedule` (`id`, `doctors_id`, `weekday`, `appointment_type`, `shift_start_time`, `shift_end_time`, `patient_time`, `created_ip`, `created_by`, `created_on`, `modified_ip`, `modified_by`, `modified_on`) VALUES
(1, 4, 'Monday', 1, '09:00:00', '12:00:00', '30', '::1', 2, '2021-04-01 13:35:30', NULL, NULL, NULL),
(2, 4, 'Monday', 2, '13:00:00', '17:00:00', '20', '::1', 2, '2021-04-01 13:35:54', NULL, NULL, NULL),
(3, 5, 'Tuesday', 2, '09:00:00', '16:00:00', '30', '::1', 2, '2021-04-01 13:36:38', NULL, NULL, NULL),
(4, 5, 'Wednesday', 1, '09:00:00', '14:00:00', '30', '::1', 2, '2021-04-01 13:37:06', '::1', 2, '2021-04-01 13:37:21'),
(5, 4, 'Thursday', 2, '09:00:00', '16:00:00', '30', '::1', 2, '2021-04-01 13:37:51', NULL, NULL, NULL),
(6, 5, 'Saturday', 2, '10:00:00', '16:00:00', '30', '::1', 8, '2021-04-05 06:57:00', NULL, NULL, NULL),
(7, 4, 'Friday', 2, '13:00:00', '18:00:00', '25', '::1', 2, '2021-04-05 07:12:04', NULL, NULL, NULL),
(8, 5, 'Friday', 1, '10:00:00', '16:00:00', '30', '::1', 4, '2021-04-06 13:54:01', '::1', 4, '2021-04-06 14:22:19');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_details`
--

CREATE TABLE `doctor_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `specialist` varchar(200) NOT NULL,
  `specialization_id` int(11) NOT NULL,
  `consultation_fee` decimal(11,0) NOT NULL,
  `blood_group` varchar(200) NOT NULL,
  `education` varchar(200) NOT NULL,
  `biography` varchar(200) NOT NULL,
  `created_ip` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_ip` varchar(20) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_details`
--

INSERT INTO `doctor_details` (`id`, `user_id`, `designation`, `specialist`, `specialization_id`, `consultation_fee`, `blood_group`, `education`, `biography`, `created_ip`, `created_by`, `created_on`, `modified_ip`, `modified_by`, `modified_on`) VALUES
(1, 4, 'MS, MBBS', 'Surgen', 1, '800', 'B+', 'MD, MS, MBBS', '', '::1', 2, '2021-04-01', '', 0, '0000-00-00'),
(2, 5, 'MS, MBBS', 'Genaral ', 5, '500', 'B+', 'MBBS, MD', '', '::1', 2, '2021-04-01', '', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `medicaltest_category`
--

CREATE TABLE `medicaltest_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(111) NOT NULL,
  `created_ip` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_ip` varchar(100) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicaltest_category`
--

INSERT INTO `medicaltest_category` (`id`, `category_name`, `created_ip`, `created_by`, `created_on`, `modified_ip`, `modified_by`, `modified_on`) VALUES
(1, 'Blood Test', '::1', 2, '2021-04-01 13:38:11', NULL, NULL, NULL),
(2, 'Urin Test', '::1', 2, '2021-04-01 13:38:24', NULL, NULL, NULL),
(3, 'Sugar Test', '::1', 2, '2021-04-01 13:38:41', NULL, NULL, NULL),
(4, 'Test', '::1', 12, '2021-04-05 09:11:07', NULL, NULL, NULL),
(5, 'sgdsxdfafaf', '::1', 2, '2021-04-06 14:41:45', '::1', 2, '2021-04-06 14:42:20');

-- --------------------------------------------------------

--
-- Table structure for table `medical_test`
--

CREATE TABLE `medical_test` (
  `id` int(11) NOT NULL,
  `medicaltest_category_id` int(11) NOT NULL,
  `medicaltest_name` varchar(111) NOT NULL,
  `medicaltest_price` decimal(10,2) NOT NULL,
  `discretion` varchar(111) NOT NULL,
  `medicaltest_status` int(11) NOT NULL,
  `created_ip` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_ip` varchar(100) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medical_test`
--

INSERT INTO `medical_test` (`id`, `medicaltest_category_id`, `medicaltest_name`, `medicaltest_price`, `discretion`, `medicaltest_status`, `created_ip`, `created_by`, `created_on`, `modified_ip`, `modified_by`, `modified_on`) VALUES
(1, 1, 'CBP', '399.00', '', 1, '::1', 2, '2021-04-01 13:39:09', NULL, NULL, NULL),
(2, 3, 'Suger Level', '500.00', '', 1, '::1', 2, '2021-04-01 13:39:36', NULL, NULL, NULL),
(3, 2, 'Urint Level', '499.00', '', 1, '::1', 2, '2021-04-01 13:40:05', NULL, NULL, NULL),
(4, 1, 'RCB Count', '599.00', '', 1, '::1', 2, '2021-04-01 13:40:46', NULL, NULL, NULL),
(5, 4, 'Test1', '500.00', 'fgxdfgcd', 1, '::1', 12, '2021-04-05 09:11:36', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_billing_test`
--

CREATE TABLE `patient_billing_test` (
  `id` int(11) NOT NULL,
  `billing_date` date NOT NULL,
  `patient_id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `promocode_id` int(11) DEFAULT NULL,
  `discount_amount` decimal(10,2) DEFAULT 0.00,
  `test_total_amount` decimal(10,2) DEFAULT 0.00,
  `sub_total_amount` decimal(10,2) DEFAULT 0.00,
  `gst_amount` decimal(10,2) DEFAULT 0.00,
  `grand_total_amount` decimal(10,2) DEFAULT 0.00,
  `created_ip` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_ip` varchar(20) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL,
  `patient_user_id` int(11) NOT NULL,
  `doctor_user_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `blood_pressure` varchar(111) DEFAULT NULL,
  `pulse_rate` varchar(111) DEFAULT NULL,
  `note` text NOT NULL,
  `symptoms` text NOT NULL,
  `diagnosis` text NOT NULL,
  `prescription_photo` varchar(111) NOT NULL,
  `created_ip` varchar(111) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_ip` varchar(111) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id`, `patient_user_id`, `doctor_user_id`, `appointment_id`, `blood_pressure`, `pulse_rate`, `note`, `symptoms`, `diagnosis`, `prescription_photo`, `created_ip`, `created_by`, `created_on`, `modified_ip`, `modified_by`, `modified_on`) VALUES
(1, 6, 4, 1, '120', '96', 'Hellp', 'Pains, Fever', 'Hello', 'assets/uploads/prescription/82602_RE.jpg', '::1', 8, '2021-04-01 14:41:06', '', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_medicine`
--

CREATE TABLE `prescription_medicine` (
  `id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `medicine_name` varchar(111) NOT NULL,
  `medicine_note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription_medicine`
--

INSERT INTO `prescription_medicine` (`id`, `prescription_id`, `medicine_name`, `medicine_note`) VALUES
(1, 1, 'Medicine 1', 'M-1, A-1, N-1'),
(2, 1, 'Madicine 2', 'EM-1, N-1'),
(3, 1, 'Medicine 3', 'A-1');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_tests`
--

CREATE TABLE `prescription_tests` (
  `id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription_tests`
--

INSERT INTO `prescription_tests` (`id`, `prescription_id`, `test_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `test_templates`
--

CREATE TABLE `test_templates` (
  `id` int(11) NOT NULL,
  `medical_test_id` int(11) NOT NULL,
  `test_template` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_ip` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_ip` varchar(20) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_details`
--
ALTER TABLE `appointment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_tests`
--
ALTER TABLE `billing_tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_status`
--
ALTER TABLE `booking_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuration_fields`
--
ALTER TABLE `configuration_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuration_settings`
--
ALTER TABLE `configuration_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors_time_schedule`
--
ALTER TABLE `doctors_time_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_details`
--
ALTER TABLE `doctor_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicaltest_category`
--
ALTER TABLE `medicaltest_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_test`
--
ALTER TABLE `medical_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_billing_test`
--
ALTER TABLE `patient_billing_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription_medicine`
--
ALTER TABLE `prescription_medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription_tests`
--
ALTER TABLE `prescription_tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_templates`
--
ALTER TABLE `test_templates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment_details`
--
ALTER TABLE `appointment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `billing_tests`
--
ALTER TABLE `billing_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_status`
--
ALTER TABLE `booking_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `configuration_fields`
--
ALTER TABLE `configuration_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `configuration_settings`
--
ALTER TABLE `configuration_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctors_time_schedule`
--
ALTER TABLE `doctors_time_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `doctor_details`
--
ALTER TABLE `doctor_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medicaltest_category`
--
ALTER TABLE `medicaltest_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `medical_test`
--
ALTER TABLE `medical_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patient_billing_test`
--
ALTER TABLE `patient_billing_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prescription_medicine`
--
ALTER TABLE `prescription_medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prescription_tests`
--
ALTER TABLE `prescription_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `test_templates`
--
ALTER TABLE `test_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
