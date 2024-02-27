-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2023 at 06:40 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fwc`
--

-- --------------------------------------------------------

--
-- Table structure for table `astrl_allergens`
--

CREATE TABLE `astrl_allergens` (
  `allergens_id` int(11) NOT NULL,
  `allergen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `astrl_allergen_countries`
--

CREATE TABLE `astrl_allergen_countries` (
  `ctry_allrgn_id` int(11) NOT NULL,
  `allergen_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `allergens_label` text NOT NULL,
  `has_specificity` tinyint(1) NOT NULL,
  `specificity_details` varchar(100) NOT NULL,
  `ppm_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `astrl_countries`
--

CREATE TABLE `astrl_countries` (
  `cntry_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_astrl_list`
--

CREATE TABLE `tbl_astrl_list` (
  `astrl_list_id` int(11) NOT NULL,
  `astrl_list_date` date NOT NULL,
  `astrl_list_location` text NOT NULL,
  `astrl_list_eq_name` varchar(100) NOT NULL,
  `astrl_list_swab_p` text NOT NULL,
  `astrl_list_allergen_type` text NOT NULL,
  `astrl_list_allrgn_typ_cmmnt` text NOT NULL,
  `astrl_list_result` tinyint(1) NOT NULL,
  `astrl_list_crrctive_act` text NOT NULL,
  `astrl_list_flag` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_astrl_record`
--

CREATE TABLE `tbl_astrl_record` (
  `astrl_record_id` int(11) NOT NULL,
  `astrl_record_table_id` int(11) NOT NULL,
  `astrl_list_id` int(11) NOT NULL,
  `record_created` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_astrl_sign`
--

CREATE TABLE `tbl_astrl_sign` (
  `id` int(11) NOT NULL,
  `astrl_record_table_id` int(11) NOT NULL,
  `per_sign` text NOT NULL,
  `per_name` varchar(100) NOT NULL,
  `per_position` varchar(100) NOT NULL,
  `per_sign_image` text NOT NULL,
  `per_date` text NOT NULL,
  `rev_sign` text NOT NULL,
  `rev_name` varchar(100) NOT NULL,
  `rev_position` varchar(100) NOT NULL,
  `rev_sign_image` longblob NOT NULL,
  `rev_date` text NOT NULL,
  `ver_sign` text NOT NULL,
  `ver_name` varchar(100) NOT NULL,
  `ver_position` varchar(100) NOT NULL,
  `ver_sign_image` text NOT NULL,
  `ver_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `astrl_allergens`
--
ALTER TABLE `astrl_allergens`
  ADD PRIMARY KEY (`allergens_id`);

--
-- Indexes for table `astrl_allergen_countries`
--
ALTER TABLE `astrl_allergen_countries`
  ADD PRIMARY KEY (`ctry_allrgn_id`);

--
-- Indexes for table `astrl_countries`
--
ALTER TABLE `astrl_countries`
  ADD PRIMARY KEY (`cntry_id`);

--
-- Indexes for table `tbl_astrl_list`
--
ALTER TABLE `tbl_astrl_list`
  ADD PRIMARY KEY (`astrl_list_id`);

--
-- Indexes for table `tbl_astrl_record`
--
ALTER TABLE `tbl_astrl_record`
  ADD PRIMARY KEY (`astrl_record_id`);

--
-- Indexes for table `tbl_astrl_sign`
--
ALTER TABLE `tbl_astrl_sign`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `astrl_allergens`
--
ALTER TABLE `astrl_allergens`
  MODIFY `allergens_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `astrl_allergen_countries`
--
ALTER TABLE `astrl_allergen_countries`
  MODIFY `ctry_allrgn_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `astrl_countries`
--
ALTER TABLE `astrl_countries`
  MODIFY `cntry_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_astrl_list`
--
ALTER TABLE `tbl_astrl_list`
  MODIFY `astrl_list_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_astrl_record`
--
ALTER TABLE `tbl_astrl_record`
  MODIFY `astrl_record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_astrl_sign`
--
ALTER TABLE `tbl_astrl_sign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
