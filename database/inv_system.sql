-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2021 at 03:56 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inv_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`customer_id`, `customer_name`, `customer_address`) VALUES
(1, 'test customer', 'test address'),
(2, '100', ''),
(3, '100', ''),
(4, '100', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_equipment_report`
--

CREATE TABLE `tbl_equipment_report` (
  `equipment_report_id` int(255) NOT NULL,
  `user_id` int(100) NOT NULL,
  `report_detail` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_equipment_report`
--

INSERT INTO `tbl_equipment_report` (`equipment_report_id`, `user_id`, `report_detail`, `date_added`, `date_updated`, `status`) VALUES
(1, 3, 'Equipment was destroyed', '2021-11-22 12:52:14', '2021-11-22 12:52:14', 'assessed'),
(3, 3, 'testing', '2021-11-23 12:45:40', '2021-11-23 12:45:40', 'assessed');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`location_id`, `location_name`) VALUES
(8, 'ECE LAB');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `product_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `generic_name` varchar(255) NOT NULL,
  `category_description` varchar(255) NOT NULL,
  `warning_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `brand_name`, `generic_name`, `category_description`, `warning_level`) VALUES
(13, 'Kia Pride Engine', '', '5', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stocks`
--

CREATE TABLE `tbl_stocks` (
  `stock_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `supplier_id` int(255) NOT NULL,
  `location_id` int(11) NOT NULL,
  `cost_price` decimal(12,2) NOT NULL,
  `expiry_date` date NOT NULL,
  `date_added` date NOT NULL,
  `date_updated` date NOT NULL,
  `date_repair` date NOT NULL,
  `engine_number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `used_by` varchar(50) NOT NULL DEFAULT 'not used',
  `used_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_stocks`
--

INSERT INTO `tbl_stocks` (`stock_id`, `product_id`, `supplier_id`, `location_id`, `cost_price`, `expiry_date`, `date_added`, `date_updated`, `date_repair`, `engine_number`, `status`, `used_by`, `used_date`) VALUES
(11, 9, 12, 8, '25000.00', '2021-11-20', '2021-11-20', '2021-11-20', '2021-11-20', 'ABCD12345', 'Repair', 'not used', '2021-11-22 11:29:44'),
(12, 9, 12, 8, '26000.00', '2021-11-20', '2021-11-20', '2021-11-20', '2021-11-20', 'yrtes23', 'Healthy', 'not used', '2021-11-22 11:29:44'),
(13, 13, 12, 8, '55.00', '2021-11-25', '2021-11-23', '2021-11-23', '2021-12-08', '221', 'Healthy', 'not used', '2021-11-23 02:49:36'),
(14, 13, 12, 8, '551.00', '2021-11-24', '2021-11-23', '2021-11-23', '2021-11-23', '56456', 'Healthy', 'not used', '2021-11-23 02:55:59'),
(15, 13, 12, 8, '123.00', '2021-12-02', '2021-11-23', '2021-11-23', '2021-11-23', '551', 'Healthy', 'not used', '2021-11-23 02:56:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplier_id`, `supplier_name`) VALUES
(12, 'Kia Company');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `user_no` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_no`, `name`, `position`, `username`, `password`, `role`, `status`) VALUES
(1, '21', 'Super Admin', '', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'Active'),
(2, '33', 'staff 1', '', 'a', '0cc175b9c0f1b6a831c399e269772661', 1, 'Active'),
(3, '66', 'Teacher1', 'sdasdasd', 'b', 'b', 1, 'Active'),
(7, '345', 'Teacher2', 'testa', 'b', '92eb5ffee6ae2fec3ad71c777531578f', 0, 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tbl_equipment_report`
--
ALTER TABLE `tbl_equipment_report`
  ADD PRIMARY KEY (`equipment_report_id`);

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_stocks`
--
ALTER TABLE `tbl_stocks`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_equipment_report`
--
ALTER TABLE `tbl_equipment_report`
  MODIFY `equipment_report_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_stocks`
--
ALTER TABLE `tbl_stocks`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
