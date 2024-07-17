-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2024 at 12:40 PM
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
-- Database: `db_journal_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_title`
--

CREATE TABLE `tbl_account_title` (
  `account_code` int(8) NOT NULL,
  `account_name` varchar(150) NOT NULL,
  `account_type` varchar(150) NOT NULL,
  `type_code` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_account_title`
--

INSERT INTO `tbl_account_title` (`account_code`, `account_name`, `account_type`, `type_code`) VALUES
(10101010, ' Cash-Collecting Officers', 'Assets', 1),
(10101020, 'Petty Cash', 'Assets', 1),
(10101030, 'Local Currency on Hand', 'Assets', 1),
(10301020, 'Notes Receivable', 'Assets', 1),
(20101010, 'Accounts Payable', 'Liability', 2),
(30801010, 'Share Capital', 'Equity', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_type`
--

CREATE TABLE `tbl_account_type` (
  `type_code` int(8) NOT NULL,
  `account_type` varchar(100) NOT NULL,
  `normal_balance` varchar(100) NOT NULL,
  `type_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_account_type`
--

INSERT INTO `tbl_account_type` (`type_code`, `account_type`, `normal_balance`, `type_description`) VALUES
(1, 'Asset', 'Debit', ''),
(2, 'Liability', 'Credit', ''),
(3, 'Equity', 'Credit', ''),
(4, 'Expenses', 'Debit', ''),
(5, 'Revenue', 'Credit', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_general_ledger`
--

CREATE TABLE `tbl_general_ledger` (
  `ledger_id` int(8) NOT NULL,
  `ledger_date` date NOT NULL,
  `account_code` int(8) NOT NULL,
  `debit` decimal(10,2) NOT NULL,
  `credit` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `journal_voucher_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_general_ledger`
--

INSERT INTO `tbl_general_ledger` (`ledger_id`, `ledger_date`, `account_code`, `debit`, `credit`, `description`, `journal_voucher_id`) VALUES
(1, '2024-06-12', 10101010, 2000.00, 0.00, 'To record Cash Collecting', 1),
(2, '2024-06-12', 10301020, 0.00, 2000.00, 'To Record Cash Collecting', 1),
(3, '2024-07-02', 10101010, 2000.00, 0.00, 'To record Collecting Payments', 21),
(4, '2024-07-02', 30801010, 2000.00, 0.00, 'To record Collecting Payments', 21),
(5, '2024-07-03', 10101010, 4000.00, 0.00, 'To record Collecting Payments', 22),
(6, '2024-07-03', 20101010, 4000.00, 0.00, 'To record Collecting Payments', 22),
(7, '2024-07-03', 10101010, 1200.00, 0.00, 'To record Collecting Payments', 23),
(8, '2024-07-03', 10101010, 1000.00, 0.00, 'To record Collecting Payments', 23),
(9, '2024-07-03', 10101010, 200.00, 0.00, 'To record Collecting Payments', 23),
(10, '2024-07-03', 10101030, 2000.00, 0.00, 'To record Collecting Payments', 24),
(11, '2024-07-03', 20101010, 2000.00, 0.00, 'To record Collecting Payments', 24);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_journal_category`
--

CREATE TABLE `tbl_journal_category` (
  `category_id` int(8) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_journal_category`
--

INSERT INTO `tbl_journal_category` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'Billing', 'For the Billing Processes'),
(2, 'Collection', 'This category is for the collection Processes of the Water District'),
(3, 'Disbursement', 'Records payment transactions of the organization'),
(4, 'Adjustments/Accrual', 'Used for adjusting entries and accrued transactions'),
(5, 'Materials', 'Used for materials in the inventory');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_journal_entry`
--

CREATE TABLE `tbl_journal_entry` (
  `journal_voucher_id` int(8) NOT NULL,
  `journal_voucher_no` varchar(10) NOT NULL,
  `journal_date` date NOT NULL,
  `description` text NOT NULL,
  `uid` int(8) NOT NULL,
  `category_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_journal_entry`
--

INSERT INTO `tbl_journal_entry` (`journal_voucher_id`, `journal_voucher_no`, `journal_date`, `description`, `uid`, `category_id`) VALUES
(1, '24-0001', '2024-06-12', 'To record Collecting Payments', 1, 1),
(2, '24-0002', '2024-06-13', 'To record Petty Cash ', 1, 3),
(21, '24-0003', '2024-07-02', 'To record Collecting Payments', 1, 1),
(22, '24-0004', '2024-07-03', 'To record Collecting Payments', 2, 2),
(23, '24-0005', '2024-07-03', 'To record Collecting Payments', 1, 2),
(24, '24-0006', '2024-07-03', 'To record Collecting Payments', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_journal_items`
--

CREATE TABLE `tbl_journal_items` (
  `journal_item_id` int(8) NOT NULL,
  `journal_voucher_id` int(10) NOT NULL,
  `account_code` int(8) NOT NULL,
  `journal_amount` decimal(10,2) NOT NULL,
  `journal_adjustment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_journal_items`
--

INSERT INTO `tbl_journal_items` (`journal_item_id`, `journal_voucher_id`, `account_code`, `journal_amount`, `journal_adjustment`) VALUES
(1, 1, 10101010, 2000.00, 'Debit'),
(2, 1, 10301020, 2000.00, 'Credit'),
(3, 2, 10101010, 1500.00, 'Debit'),
(4, 2, 10101020, 1500.00, 'Credit'),
(35, 21, 10101010, 2000.00, 'Debit'),
(36, 21, 30801010, 2000.00, 'Credit'),
(37, 22, 10101010, 4000.00, 'Debit'),
(38, 22, 20101010, 4000.00, 'Credit'),
(39, 23, 10101010, 1200.00, 'Debit'),
(40, 23, 10101010, 1000.00, 'Credit'),
(41, 23, 10101010, 200.00, 'Credit'),
(42, 24, 10101030, 2000.00, 'Debit'),
(43, 24, 20101010, 2000.00, 'Credit');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `uid` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `userlevel` varchar(100) NOT NULL,
  `user_status` varchar(100) NOT NULL,
  `user_info_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`uid`, `username`, `password`, `userlevel`, `user_status`, `user_info_id`) VALUES
(1, 'admin', '$2y$10$Sia0EyxKRHkR5xlNDJeyvO.tLcIwSrZHhBYxO6beqy0GGxpGhDXhm', 'Administrator', 'Active', 1),
(3, 'bookkeeper1', '$2y$10$v3LSiJlgOOKHlzdaYcjS1.9W88/Yhl/uR5dND/sbr5SOxTstOJb9G', 'Bookkeeper', 'Active', 3),
(5, 'james', '$2y$10$3V/ktz0brpgG6xSC34Bq3easZSENbqFCTxZfx7tzGZYcLp6Rakwni', 'Administrator', 'Active', 5),
(4, 'jfcm', '$2y$10$G4SUNZ9UXeipFCBjhNYfQu4k7xCuWikKaV2jP5wRkk42WCWuEz6uS', 'Accountant', 'Active', 4),
(2, 'user2', '$2y$10$8FuuJWc8QMb/p.R79jGgL.G.uAWv2TsuAr9y0X.6Rar8BpVbeiyFq', 'Accountant', 'Active', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_info`
--

CREATE TABLE `tbl_user_info` (
  `user_info_id` int(10) NOT NULL,
  `user_fname` varchar(120) NOT NULL,
  `user_mname` varchar(120) NOT NULL,
  `user_lname` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_info`
--

INSERT INTO `tbl_user_info` (`user_info_id`, `user_fname`, `user_mname`, `user_lname`) VALUES
(1, 'Jack', 'Lopez', 'Gates'),
(2, 'Jenny', 'Lopes', 'Reyes'),
(3, 'Noelle', 'Brooks', 'Haytham'),
(4, 'Julleane', 'Qwerty', 'Maynes'),
(5, 'james', 'james', 'james');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account_title`
--
ALTER TABLE `tbl_account_title`
  ADD PRIMARY KEY (`account_code`);

--
-- Indexes for table `tbl_account_type`
--
ALTER TABLE `tbl_account_type`
  ADD PRIMARY KEY (`type_code`);

--
-- Indexes for table `tbl_general_ledger`
--
ALTER TABLE `tbl_general_ledger`
  ADD PRIMARY KEY (`ledger_id`);

--
-- Indexes for table `tbl_journal_category`
--
ALTER TABLE `tbl_journal_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_journal_entry`
--
ALTER TABLE `tbl_journal_entry`
  ADD PRIMARY KEY (`journal_voucher_id`);

--
-- Indexes for table `tbl_journal_items`
--
ALTER TABLE `tbl_journal_items`
  ADD PRIMARY KEY (`journal_item_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `tbl_user_info`
--
ALTER TABLE `tbl_user_info`
  ADD PRIMARY KEY (`user_info_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account_type`
--
ALTER TABLE `tbl_account_type`
  MODIFY `type_code` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_general_ledger`
--
ALTER TABLE `tbl_general_ledger`
  MODIFY `ledger_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_journal_entry`
--
ALTER TABLE `tbl_journal_entry`
  MODIFY `journal_voucher_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_journal_items`
--
ALTER TABLE `tbl_journal_items`
  MODIFY `journal_item_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_user_info`
--
ALTER TABLE `tbl_user_info`
  MODIFY `user_info_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
