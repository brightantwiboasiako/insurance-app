-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2016 at 05:23 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insurance`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(10) UNSIGNED NOT NULL,
  `identifier` varchar(15) NOT NULL,
  `name` varchar(64) NOT NULL,
  `branch` int(10) UNSIGNED NOT NULL,
  `status` int(4) NOT NULL,
  `added_by` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

CREATE TABLE `claims` (
  `id` int(10) UNSIGNED NOT NULL,
  `policy_number` varchar(16) NOT NULL,
  `policy_type` int(10) UNSIGNED NOT NULL,
  `cover_type` int(4) NOT NULL,
  `cover_id` int(10) UNSIGNED NOT NULL,
  `amount` bigint(20) NOT NULL,
  `status` int(4) NOT NULL,
  `captured_by` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE `commissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `premium_id` int(10) UNSIGNED NOT NULL,
  `agent_id` int(11) NOT NULL,
  `policy_number` int(11) NOT NULL,
  `policy_type` int(10) UNSIGNED NOT NULL,
  `amount` bigint(20) NOT NULL,
  `rate_earned` int(3) NOT NULL,
  `tax` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(16) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `other_name` varchar(32) NOT NULL,
  `gender` char(1) NOT NULL,
  `birth_day` date NOT NULL,
  `email` varchar(1024) NOT NULL,
  `phone_numbers` varchar(1024) NOT NULL,
  `primary_phone_number` varchar(15) NOT NULL,
  `occupation` varchar(128) NOT NULL,
  `employer_name` varchar(64) NOT NULL,
  `employer_address` varchar(1024) NOT NULL,
  `personal_address` varchar(1024) NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `title`, `surname`, `first_name`, `other_name`, `gender`, `birth_day`, `email`, `phone_numbers`, `primary_phone_number`, `occupation`, `employer_name`, `employer_address`, `personal_address`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Mr.', 'Antwi Boasiako', 'Bright', '', 'M', '1992-11-05', 'brightantwiboasiako@aol.com', '', '0247699975', 'Teaching and Research Assistant', 'KNUST', 'KNUST, Kumasi', 'KNUST, Kumasi', 1, '2016-05-22 06:55:56', '2016-05-22 10:48:07'),
(2, 'Dr.', 'Asare', 'Gabriel', 'Okyere', 'M', '1961-05-15', 'antwiboasiako.bright@gmail.com', '', '0277752426', 'Lecturer', 'KNUST', 'Kwame Nkrumah University of Science and Technology,\nPrivate Mail Bag,\nKumasi.', 'Department of Mathematics, KNUST', 1, '2016-05-22 07:53:29', '2016-05-22 09:38:39'),
(3, 'Dr.', 'Antwi Boasiako', 'Francis', '', 'M', '2003-07-23', 'francisantwiboasiako@aol.com', '', '0244759632', 'Student', 'Glory Preparatory School', 'Box 44, \nFomena Adansi.', 'Adansi Fomena', 1, '2016-05-22 10:46:39', '2016-05-22 10:48:52'),
(4, 'Mr.', 'Kwantwi-Mensah', 'Ignatius', '', 'M', '2016-05-22', 'ikemensah1855@yahoo.co.uk', '', '0244836642', 'Teaching and Research Assistant', 'ADB', 'Accra', 'ADB, Box 4191, Accra', 1, '2016-05-22 11:06:11', '2016-05-22 11:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `funeral_policies`
--

CREATE TABLE `funeral_policies` (
  `id` int(10) UNSIGNED NOT NULL,
  `policy_number` varchar(16) NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `staff_id` varchar(16) DEFAULT NULL,
  `sum_assured` bigint(20) NOT NULL,
  `sum_assured_original` bigint(20) NOT NULL,
  `basic_periodic_premium` bigint(20) NOT NULL,
  `underwriting_premium` bigint(20) NOT NULL,
  `staff_discount` bigint(20) NOT NULL,
  `status` int(4) NOT NULL,
  `payment_frequency` int(4) NOT NULL,
  `mode_of_payment` int(4) NOT NULL,
  `automatic_update_percentage` int(3) NOT NULL,
  `next_automatic_update` datetime DEFAULT NULL,
  `accident_rider` int(4) NOT NULL,
  `accident_rider_premium` bigint(20) NOT NULL,
  `original_accident_rider_premium` bigint(20) NOT NULL,
  `family_rider` int(4) NOT NULL,
  `family_members` text,
  `issue_date` datetime NOT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `agent_id` int(10) UNSIGNED NOT NULL,
  `trustee` text NOT NULL,
  `bank_information` text,
  `captured_by` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_frequencies`
--

CREATE TABLE `payment_frequencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_frequencies`
--

INSERT INTO `payment_frequencies` (`id`, `title`) VALUES
(1, 'MONTHLY'),
(2, 'QUARTERLY'),
(3, 'SEMI-ANNUALLY'),
(4, 'ANNUALLY');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `title`) VALUES
(1, 'CASH'),
(2, 'CHEQUE'),
(3, 'STANDING ORDER'),
(4, 'CAG'),
(5, 'DIRECT DEBIT');

-- --------------------------------------------------------

--
-- Table structure for table `policy_types`
--

CREATE TABLE `policy_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(64) NOT NULL,
  `identifier` varchar(64) NOT NULL,
  `options` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `policy_types`
--

INSERT INTO `policy_types` (`id`, `title`, `identifier`, `options`) VALUES
(1, 'FUNERAL POLICY', 'funeral', '{"automatic_update_percentages":[0,7.5,15,20],\r\n"payment_methods":["CASH","CHEQUE","STANDING ORDER","DIRECT DEBIT","CAG"],\r\n"payment_frequencies":["MONTHLY","QUARTERLY","SEMI-ANNUALLY","ANNUALLY"],\r\n"supported_family": ["SPOUSE","CHILD","PARENT","PARENT-IN-LAW","BUSINESS PARTNER"]}'),
(2, 'MOTOR INSURANCE', 'motor', '');

-- --------------------------------------------------------

--
-- Table structure for table `premiums`
--

CREATE TABLE `premiums` (
  `id` int(10) UNSIGNED NOT NULL,
  `policy_type` int(10) UNSIGNED NOT NULL,
  `policy_number` varchar(16) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `period` datetime NOT NULL,
  `adequacy_status` int(4) NOT NULL,
  `cheque_number` varchar(16) NOT NULL,
  `receipt_code` varchar(16) NOT NULL,
  `date_received` datetime NOT NULL,
  `captured_by` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `system_logs`
--

CREATE TABLE `system_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `seen` int(4) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `password` varchar(60) NOT NULL,
  `remember_token` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `role` int(10) UNSIGNED NOT NULL,
  `status` int(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `remember_token`, `phone`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bright Antwi Boasiako', 'brightantwiboasiako', 'brightantwiboasiako@aol.com', '$2y$10$CNY2Ol4BIP181Osqi8NUWeQivHIaUycxO2g5iazsaId0IYE1lgU/u', 'nnDowqeNv8cacxuEgl3MbuOGLa7A2Tc0FUiGaAifrL4ZQXUk2yUTS1ywmchp', '0501373573', 1, 4112, '2016-05-10 00:00:00', '2016-05-26 13:44:23');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `date_captured` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(32) NOT NULL,
  `identifier` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `title`, `identifier`) VALUES
(1, 'SYSTEM CREATOR', 'system creator'),
(2, 'SYSTEM ADMINISTRATOR', 'system administrator'),
(3, 'MANAGER', 'manager'),
(4, 'IT STAFF', 'it staff'),
(5, 'ACCOUNT OFFICER', 'account officer'),
(6, 'STANDARD USER', 'standard user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `claims`
--
ALTER TABLE `claims`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funeral_policies`
--
ALTER TABLE `funeral_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_frequencies`
--
ALTER TABLE `payment_frequencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `policy_types`
--
ALTER TABLE `policy_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `premiums`
--
ALTER TABLE `premiums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `claims`
--
ALTER TABLE `claims`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `funeral_policies`
--
ALTER TABLE `funeral_policies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_frequencies`
--
ALTER TABLE `payment_frequencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `policy_types`
--
ALTER TABLE `policy_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `premiums`
--
ALTER TABLE `premiums`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
