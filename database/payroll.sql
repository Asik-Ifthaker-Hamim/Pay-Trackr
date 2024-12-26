-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2024 at 09:41 AM
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
-- Database: `payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `allowances`
--

CREATE TABLE `allowances` (
  `id` int(30) NOT NULL,
  `allowance` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allowances`
--

INSERT INTO `allowances` (`id`, `allowance`, `description`) VALUES
(1, 'Housing Allowance', 'We provide a housing allowance to support safe and comfortable accommodations for our employees.'),
(2, 'Medical Allowance', 'Our medical allowance ensures access to essential healthcare services for all team members.'),
(3, 'Transportation Allowance', 'The transportation allowance is provided to cover commuting expenses for our employees.'),
(4, 'Education Allowance', 'We offer an education allowance to support continuous learning and professional development.'),
(5, 'Meal Allowance', 'The meal allowance is designed to subsidize daily food expenses for our workforce.'),
(6, 'Communication Allowance', 'Our communication allowance helps employees stay connected through phone and internet services.'),
(7, 'Performance Allowance', 'The performance allowance rewards employees for exceptional contributions and achievements.'),
(8, 'Overtime Allowance\r\n', 'Employees working additional hours receive an overtime allowance as per company policy.\r\n'),
(9, 'Festival Allowance\r\n', 'We provide a festival allowance to help employees celebrate and enjoy special occasions with their families.');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `log_type` tinyint(1) NOT NULL COMMENT '1 = AM IN,2 = AM out, 3= PM IN, 4= PM out\r\n',
  `datetime_log` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `log_type`, `datetime_log`, `date_updated`) VALUES
(1, 3, 1, '2024-12-01 10:00:00', '2024-12-21 21:38:16'),
(2, 3, 4, '2024-12-01 04:00:00', '2024-12-21 21:38:16'),
(3, 3, 1, '2024-12-02 10:00:00', '2024-12-22 23:16:20'),
(4, 3, 4, '2024-12-02 04:00:00', '2024-12-22 23:16:20'),
(5, 3, 1, '2024-12-03 10:00:00', '2024-12-22 23:17:07'),
(6, 3, 4, '2024-12-03 04:00:00', '2024-12-22 23:17:07'),
(7, 3, 1, '2024-12-04 10:00:00', '2024-12-22 23:17:34'),
(8, 3, 4, '2024-12-04 04:00:00', '2024-12-22 23:17:34'),
(9, 3, 1, '2024-12-07 10:00:00', '2024-12-22 23:18:34'),
(10, 3, 4, '2024-12-07 04:00:00', '2024-12-22 23:18:34'),
(11, 5, 1, '2024-12-01 10:00:00', '2024-12-22 23:19:04'),
(12, 5, 4, '2024-12-01 04:00:00', '2024-12-22 23:19:04'),
(13, 5, 1, '2024-12-02 10:00:00', '2024-12-22 23:19:54'),
(14, 5, 4, '2024-12-02 04:00:00', '2024-12-22 23:19:54'),
(15, 5, 1, '2024-12-03 10:00:00', '2024-12-22 23:20:14'),
(16, 5, 4, '2024-12-03 04:00:00', '2024-12-22 23:20:14'),
(17, 5, 1, '2024-12-04 10:00:00', '2024-12-22 23:20:44'),
(18, 5, 4, '2024-12-04 04:00:00', '2024-12-22 23:20:44'),
(19, 5, 1, '2024-12-07 10:00:00', '2024-12-22 23:21:20'),
(20, 5, 4, '2024-12-07 04:00:00', '2024-12-22 23:21:20'),
(21, 9, 1, '2024-12-01 10:00:00', '2024-12-22 23:22:22'),
(22, 9, 4, '2024-12-01 04:00:00', '2024-12-22 23:22:22'),
(23, 9, 1, '2024-12-02 10:00:00', '2024-12-22 23:22:51'),
(24, 9, 4, '2024-12-02 04:00:00', '2024-12-22 23:22:51'),
(25, 9, 1, '2024-12-03 10:00:00', '2024-12-22 23:23:12'),
(26, 9, 4, '2024-12-03 04:00:00', '2024-12-22 23:23:12'),
(27, 9, 1, '2024-12-04 10:00:00', '2024-12-22 23:23:38'),
(28, 9, 4, '2024-12-04 04:00:00', '2024-12-22 23:23:38'),
(29, 9, 1, '2024-12-07 10:00:00', '2024-12-22 23:24:01'),
(30, 9, 4, '2024-12-07 04:00:00', '2024-12-22 23:24:01'),
(31, 6, 1, '2024-12-01 10:00:00', '2024-12-22 23:24:47'),
(32, 6, 4, '2024-12-01 04:00:00', '2024-12-22 23:24:47'),
(33, 6, 1, '2024-12-02 10:00:00', '2024-12-22 23:26:35'),
(34, 6, 4, '2024-12-02 04:00:00', '2024-12-22 23:26:35'),
(35, 6, 1, '2024-12-03 10:00:00', '2024-12-22 23:26:55'),
(36, 6, 4, '2024-12-03 04:00:00', '2024-12-22 23:26:55'),
(37, 6, 1, '2024-12-04 10:00:00', '2024-12-22 23:27:12'),
(38, 6, 4, '2024-12-04 04:00:00', '2024-12-22 23:27:12'),
(39, 6, 1, '2024-12-07 10:00:00', '2024-12-22 23:27:32'),
(40, 6, 4, '2024-12-07 04:00:00', '2024-12-22 23:27:32'),
(41, 12, 1, '2024-12-01 10:00:00', '2024-12-22 23:41:06'),
(42, 12, 4, '2024-12-01 04:00:00', '2024-12-22 23:41:06'),
(43, 12, 1, '2024-12-02 10:00:00', '2024-12-22 23:41:31'),
(44, 12, 4, '2024-12-02 04:00:00', '2024-12-22 23:41:31'),
(45, 12, 1, '2024-12-03 10:00:00', '2024-12-22 23:41:54'),
(46, 12, 4, '2024-12-03 04:00:00', '2024-12-22 23:41:54'),
(47, 12, 1, '2024-12-04 10:00:00', '2024-12-22 23:42:35'),
(48, 12, 4, '2024-12-04 04:00:00', '2024-12-22 23:42:35'),
(49, 12, 1, '2024-12-07 10:00:00', '2024-12-22 23:42:52'),
(50, 12, 4, '2024-12-07 04:00:00', '2024-12-22 23:42:52'),
(51, 1, 1, '2024-12-01 10:00:00', '2024-12-22 23:43:27'),
(52, 1, 4, '2024-12-01 04:00:00', '2024-12-22 23:43:27'),
(53, 1, 1, '2024-12-02 10:00:00', '2024-12-22 23:44:06'),
(54, 1, 4, '2024-12-02 04:00:00', '2024-12-22 23:44:06'),
(55, 1, 1, '2024-12-03 10:00:00', '2024-12-22 23:47:14'),
(56, 1, 4, '2024-12-03 04:00:00', '2024-12-22 23:47:14'),
(57, 1, 1, '2024-12-04 10:00:00', '2024-12-22 23:48:03'),
(58, 1, 4, '2024-12-04 02:00:00', '2024-12-22 23:48:03'),
(59, 1, 1, '2024-12-07 10:00:00', '2024-12-22 23:48:27'),
(60, 1, 4, '2024-12-07 04:00:00', '2024-12-22 23:48:27');

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` int(30) NOT NULL,
  `deduction` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deductions`
--

INSERT INTO `deductions` (`id`, `deduction`, `description`) VALUES
(1, 'Tax Deduction', 'Mandatory tax deductions as per government regulations.'),
(2, 'Miscellaneous Deduction', 'Company-incurred expense deductions.'),
(3, 'Unpaid Leave Deduction', 'Proportional deductions for any unpaid leaves taken.'),
(4, 'Late Attendance Penalty', 'Penalty applied for repeated late attendance instances.'),
(5, 'Loan Repayment Deduction', 'Scheduled deductions for company-provided loans or advances.'),
(6, 'Health Insurance Premium', 'Health insurance premium share.');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'IT Department'),
(2, 'HR Department'),
(3, 'Accounting and Finance Department'),
(4, 'Marketing'),
(5, 'Sales'),
(6, 'Production Management'),
(7, 'Office Management'),
(8, 'Customer Service'),
(9, 'Research & Development (R&D)'),
(10, 'Legal'),
(11, 'Administration');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(20) NOT NULL,
  `employee_no` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(20) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `department_id` int(30) NOT NULL,
  `position_id` int(30) NOT NULL,
  `salary` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `employee_no`, `firstname`, `middlename`, `lastname`, `department_id`, `position_id`, `salary`) VALUES
(1, '2024-741', 'Asik', 'Ifthaker', 'Hamim', 1, 1, 55000),
(2, '2024-113', 'Abdul', '', 'Mohaimin', 2, 2, 60000),
(3, '2024-1063', 'Adrishikhar', '', 'Barua', 7, 7, 35000),
(4, '2024-136', 'Sheik', 'Mohammad', 'Rajking', 10, 11, 25000),
(5, '2024-5427', 'Fuad', '', 'Ahmed', 4, 12, 40000),
(6, '2024-7263', 'Uday', '', 'Barua', 6, 6, 42000),
(7, '2024-5127', 'Shafin', '', 'Shahriar', 5, 8, 37000),
(8, '2024-8919', 'Al', 'Fahim', 'Ishmum', 3, 3, 35000),
(9, '2024-2965', 'Niloy', '', 'Barua', 1, 1, 30000),
(10, '2024-5521', 'MD', 'Abdur', 'Rahman', 6, 6, 34000),
(11, '2024-2130', 'Mohammad', '', 'Imran', 9, 13, 56000),
(12, '2024-9400', 'Mir', '', 'Eju', 9, 14, 45000),
(13, '2024-3225', 'Ifthekar', 'Ahmed', 'Sayem', 11, 9, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `employee_allowances`
--

CREATE TABLE `employee_allowances` (
  `id` int(30) NOT NULL,
  `employee_id` int(30) NOT NULL,
  `allowance_id` int(30) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1 = Monthly, 2= Semi-Montly, 3 = once',
  `amount` float NOT NULL,
  `effective_date` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_allowances`
--

INSERT INTO `employee_allowances` (`id`, `employee_id`, `allowance_id`, `type`, `amount`, `effective_date`, `date_created`) VALUES
(1, 3, 1, 1, 10000, '0000-00-00', '2024-12-26 14:38:28'),
(2, 3, 5, 1, 3000, '0000-00-00', '2024-12-26 14:38:28'),
(3, 3, 2, 1, 1000, '0000-00-00', '2024-12-26 14:38:28'),
(4, 3, 3, 1, 1000, '0000-00-00', '2024-12-26 14:38:28'),
(5, 2, 1, 1, 10000, '0000-00-00', '2024-12-26 14:39:16'),
(6, 2, 5, 1, 3000, '0000-00-00', '2024-12-26 14:39:16'),
(7, 2, 2, 1, 1000, '0000-00-00', '2024-12-26 14:39:16'),
(8, 2, 3, 1, 1000, '0000-00-00', '2024-12-26 14:39:16'),
(9, 4, 1, 1, 10000, '0000-00-00', '2024-12-26 14:39:50'),
(10, 4, 5, 1, 3000, '0000-00-00', '2024-12-26 14:39:50'),
(11, 4, 2, 1, 1000, '0000-00-00', '2024-12-26 14:39:50');

-- --------------------------------------------------------

--
-- Table structure for table `employee_deductions`
--

CREATE TABLE `employee_deductions` (
  `id` int(30) NOT NULL,
  `employee_id` int(30) NOT NULL,
  `deduction_id` int(30) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1 = Monthly, 2= Semi-Montly, 3 = once',
  `amount` float NOT NULL,
  `effective_date` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_deductions`
--

INSERT INTO `employee_deductions` (`id`, `employee_id`, `deduction_id`, `type`, `amount`, `effective_date`, `date_created`) VALUES
(1, 3, 1, 1, 500, '0000-00-00', '2024-12-26 14:38:39'),
(2, 2, 1, 1, 500, '0000-00-00', '2024-12-26 14:39:25'),
(3, 4, 1, 1, 500, '0000-00-00', '2024-12-26 14:39:58');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` int(30) NOT NULL,
  `ref_no` text NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1 = monthly ,2 semi-monthly',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 =New,1 = computed',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_items`
--

CREATE TABLE `payroll_items` (
  `id` int(30) NOT NULL,
  `payroll_id` int(30) NOT NULL,
  `employee_id` int(30) NOT NULL,
  `present` int(30) NOT NULL,
  `absent` int(10) NOT NULL,
  `late` text NOT NULL,
  `salary` double NOT NULL,
  `allowance_amount` double NOT NULL,
  `allowances` text NOT NULL,
  `deduction_amount` double NOT NULL,
  `deductions` text NOT NULL,
  `net` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(30) NOT NULL,
  `department_id` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `department_id`, `name`) VALUES
(1, 1, 'Programmer'),
(2, 2, 'HR Manager'),
(3, 3, 'Budget Manager'),
(4, 0, 'Marketing Manager'),
(6, 6, 'Product Development'),
(7, 7, 'Health and Safety'),
(8, 5, 'Customer Engagement'),
(9, 11, 'Administrative Manager'),
(10, 8, 'Customer Service Manager'),
(11, 10, 'Legal Advisor'),
(12, 4, 'Marketing Manager'),
(13, 9, 'R&D Manager'),
(14, 9, 'Innovation Analyst');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `doctor_id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `contact` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=admin , 2 = staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `doctor_id`, `name`, `address`, `contact`, `username`, `password`, `type`) VALUES
(1, 0, 'Administrator', '', '', 'admin', 'admin123', 1),
(2, 0, 'Asik Ifthaker Hamim', '', '', 'Hamim', 'hamim', 2),
(3, 0, 'Abdul Mohaimin', '', '', 'mohaimin', 'mohaimin', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allowances`
--
ALTER TABLE `allowances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_allowances`
--
ALTER TABLE `employee_allowances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_deductions`
--
ALTER TABLE `employee_deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll_items`
--
ALTER TABLE `payroll_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allowances`
--
ALTER TABLE `allowances`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `employee_allowances`
--
ALTER TABLE `employee_allowances`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `employee_deductions`
--
ALTER TABLE `employee_deductions`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll_items`
--
ALTER TABLE `payroll_items`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
