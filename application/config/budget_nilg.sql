-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2024 at 05:51 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nilg_erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `budget_nilg`
--

CREATE TABLE `budget_nilg` (
  `id` int(11) NOT NULL,
  `amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `dpt_amt` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT 'dept head approve amt',
  `dpt_head_id` int(11) DEFAULT NULL COMMENT 'user id',
  `acc_amt` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT 'account head approve amt',
  `acc_head_id` int(11) DEFAULT NULL COMMENT 'user id',
  `dg_amt` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT 'dg approve amt',
  `dg_user_id` int(11) DEFAULT NULL COMMENT 'user id',
  `revenue_amt` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT 'get revenue amt of financial year ',
  `acc_id` int(11) DEFAULT NULL COMMENT 'user id',
  `fcl_year` varchar(12) DEFAULT NULL COMMENT 'financial year',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=pending,2=dpt. app., 3=reject, 4=acc., 5=dg,  6=draft, 7=revenue received',
  `desk` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=current, 2=forward dpt, 3=forward acc., 4=dg, 5=back acc, 6=complete, ',
  `dept_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budget_nilg`
--
ALTER TABLE `budget_nilg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `acc_id` (`acc_id`),
  ADD KEY `dpt_head_id` (`dpt_head_id`),
  ADD KEY `acc_head_id` (`acc_head_id`),
  ADD KEY `dg_user_id` (`dg_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budget_nilg`
--
ALTER TABLE `budget_nilg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
