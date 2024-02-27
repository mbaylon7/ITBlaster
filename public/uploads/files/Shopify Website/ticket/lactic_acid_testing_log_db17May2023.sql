-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.25-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table qc.tbl_lactic_acid_testing_log
CREATE TABLE IF NOT EXISTS `tbl_lactic_acid_testing_log` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `time` varchar(50) DEFAULT NULL,
  `lactic_acid` int(3) DEFAULT NULL,
  `amt_water_needed` varchar(50) DEFAULT NULL,
  `lactic_acid_after` varchar(50) DEFAULT NULL,
  `column6` enum('1','2') DEFAULT NULL,
  `temperature` varchar(50) DEFAULT NULL,
  `temperature_reason` mediumtext DEFAULT NULL,
  `functionality` enum('pass','fail') DEFAULT NULL,
  `coverage` enum('pass','fail') DEFAULT NULL,
  `performed_by_sig` mediumtext DEFAULT NULL,
  `performed_by_img` varchar(255) DEFAULT NULL,
  `performed_by_name` varchar(255) DEFAULT NULL,
  `deviation` varchar(50) DEFAULT NULL,
  `corrected_by_sig` mediumtext DEFAULT NULL,
  `corrected_by_img` varchar(255) DEFAULT NULL,
  `corrected_by_name` varchar(255) DEFAULT NULL,
  `date_corrected` date DEFAULT NULL,
  `time_corrected` varchar(50) DEFAULT NULL,
  `verified_by_sig` mediumtext DEFAULT NULL,
  `verified_by_img` varchar(255) DEFAULT NULL,
  `verified_by_name` varchar(255) DEFAULT NULL,
  `deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `record_no` int(7) DEFAULT NULL,
  `date_encoded` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table qc.tbl_lactic_acid_testing_log_records
CREATE TABLE IF NOT EXISTS `tbl_lactic_acid_testing_log_records` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `date_log` date DEFAULT NULL,
  `date_submitted` timestamp NULL DEFAULT NULL,
  `submitted_by_sig` mediumtext DEFAULT NULL,
  `submitted_by_img` mediumtext DEFAULT NULL,
  `submitted_by_name` varchar(50) DEFAULT NULL,
  `deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table qc.tbl_lactic_acid_testing_settings
CREATE TABLE IF NOT EXISTS `tbl_lactic_acid_testing_settings` (
  `lactic_acid` float DEFAULT NULL,
  `frequency` int(2) DEFAULT NULL,
  `temperature` mediumtext DEFAULT NULL,
  `interval` int(5) DEFAULT NULL,
  `current` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
