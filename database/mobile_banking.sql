-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 10:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobile_banking`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `bank_id` int(11) NOT NULL,
  `prefix_code` varchar(6) NOT NULL,
  `bank_address` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`bank_id`, `prefix_code`, `bank_address`) VALUES
(2, '110011', 'Bahan Yangon');

-- --------------------------------------------------------

--
-- Table structure for table `cash_in`
--

CREATE TABLE `cash_in` (
  `cash_in_id` int(11) NOT NULL,
  `customer_name` varchar(55) NOT NULL,
  `wallet_id` int(11) NOT NULL,
  `cash_in_date` date NOT NULL,
  `note` varchar(512) NOT NULL,
  `amount` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cash_in`
--

INSERT INTO `cash_in` (`cash_in_id`, `customer_name`, `wallet_id`, `cash_in_date`, `note`, `amount`) VALUES
(1, 'franky', 1, '2024-04-25', 'cash in test', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(225) NOT NULL,
  `customer_email` varchar(225) NOT NULL,
  `customer_password` varchar(512) NOT NULL,
  `customer_address` varchar(225) NOT NULL,
  `customer_phone_number` varchar(225) NOT NULL,
  `nrc_no` varchar(225) NOT NULL,
  `nrc_photo` varchar(225) NOT NULL,
  `customer_profile` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `customer_password`, `customer_address`, `customer_phone_number`, `nrc_no`, `nrc_photo`, `customer_profile`) VALUES
(1, 'franky', 'franky@gmail.com', '$2y$10$FVLFYloIYlDvs7jkSwIyqeaGn0KOuCD/yfC/idGq60Cw3H8Qagyle', 'Yangon', '0833424234', '7/TAnana(N)123133', '../images/nrcs/franky_test.jpg', '../images/profiles/franky_test.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `loan_id` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `type_of_loan_id` int(11) NOT NULL,
  `loan_start_date` date NOT NULL,
  `loan_end_date` date NOT NULL,
  `loan_status` varchar(11) NOT NULL,
  `description` varchar(512) NOT NULL,
  `police_recommendation_letter` varchar(225) NOT NULL,
  `work_recommendation_letter` varchar(225) NOT NULL,
  `wallet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(225) NOT NULL,
  `staff_email` varchar(225) NOT NULL,
  `staff_password` varchar(512) NOT NULL,
  `staff_address` varchar(225) NOT NULL,
  `staff_phone_number` varchar(225) NOT NULL,
  `staff_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`staff_id`, `staff_name`, `staff_email`, `staff_password`, `staff_address`, `staff_phone_number`, `staff_type_id`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$6rMTQV.LTfGK.ZEPmMMg/euI4Phs3GCLcSpcmwzFcvga2iXlJuqEi', 'Yangon', '12934452', 1),
(2, 'manager', 'manager@gmail.com', '$2y$10$I8DjmuSvDTAEaHpwxxvj/utEzD1aIRb300FxgJnU3gkWD69TuJpEm', 'Yangon', '09876446', 3);

-- --------------------------------------------------------

--
-- Table structure for table `staff_type`
--

CREATE TABLE `staff_type` (
  `staff_type_id` int(11) NOT NULL,
  `staff_type` varchar(55) NOT NULL COMMENT '1 = admin, 2 = manager, 3 = staff'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `staff_type`
--

INSERT INTO `staff_type` (`staff_type_id`, `staff_type`) VALUES
(1, 'admin'),
(2, 'Manager'),
(3, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `wallet_id_1` int(11) NOT NULL,
  `wallet_id_2` int(11) NOT NULL,
  `date` date NOT NULL,
  `note` varchar(512) NOT NULL,
  `transaction_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_type`
--

CREATE TABLE `transaction_type` (
  `transaction_type_id` int(11) NOT NULL,
  `transaction_type` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_of_loan`
--

CREATE TABLE `type_of_loan` (
  `type_of_loan_id` int(11) NOT NULL,
  `type_of_loan` varchar(11) NOT NULL,
  `rate` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `wallet_id` int(11) NOT NULL,
  `wallet_number` varchar(225) NOT NULL,
  `wallet_status` varchar(11) NOT NULL,
  `balance` decimal(10,0) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`wallet_id`, `wallet_number`, `wallet_status`, `balance`, `customer_id`, `bank_id`) VALUES
(1, '11001120240425191442', 'Active', 612000, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `cash_in`
--
ALTER TABLE `cash_in`
  ADD PRIMARY KEY (`cash_in_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`loan_id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `staff_type`
--
ALTER TABLE `staff_type`
  ADD PRIMARY KEY (`staff_type_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `transaction_type`
--
ALTER TABLE `transaction_type`
  ADD PRIMARY KEY (`transaction_type_id`);

--
-- Indexes for table `type_of_loan`
--
ALTER TABLE `type_of_loan`
  ADD PRIMARY KEY (`type_of_loan_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`wallet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cash_in`
--
ALTER TABLE `cash_in`
  MODIFY `cash_in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff_type`
--
ALTER TABLE `staff_type`
  MODIFY `staff_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_type`
--
ALTER TABLE `transaction_type`
  MODIFY `transaction_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_of_loan`
--
ALTER TABLE `type_of_loan`
  MODIFY `type_of_loan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `wallet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
