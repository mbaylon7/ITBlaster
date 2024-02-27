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

-- Dumping structure for table qc.tbl_aaml
CREATE TABLE IF NOT EXISTS `tbl_aaml` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `column1` enum('1','2') DEFAULT NULL,
  `ratio` mediumtext DEFAULT NULL,
  `functionality` enum('pass','fail') DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `recorded_by_sig` mediumtext DEFAULT NULL,
  `recorded_by_img` mediumtext DEFAULT NULL,
  `recorded_by_name` mediumtext DEFAULT NULL,
  `date_recorded` datetime DEFAULT NULL,
  `submitted` enum('yes','no') NOT NULL DEFAULT 'no',
  `deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table qc.tbl_aaml_data
CREATE TABLE IF NOT EXISTS `tbl_aaml_data` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `aaml_id` int(7) DEFAULT NULL,
  `temperature` varchar(50) DEFAULT NULL,
  `temperature_reason` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `time_reason` varchar(255) DEFAULT NULL,
  `coverage` enum('pass','fail') DEFAULT NULL,
  `performed_by_sig` mediumtext DEFAULT NULL,
  `performed_by_img` mediumtext DEFAULT NULL,
  `performed_by_name` varchar(255) DEFAULT NULL,
  `date_performed` datetime DEFAULT NULL,
  `haccp_verified_by_sig` mediumtext DEFAULT NULL,
  `haccp_verified_by_img` mediumtext DEFAULT NULL,
  `haccp_verified_by_name` varchar(255) DEFAULT NULL,
  `date_haccp_verified` datetime DEFAULT NULL,
  `deviation` varchar(255) DEFAULT NULL,
  `corrected_by_sig` mediumtext DEFAULT NULL,
  `corrected_by_img` mediumtext DEFAULT NULL,
  `corrected_by_name` varchar(255) DEFAULT NULL,
  `date_corrected` datetime DEFAULT NULL,
  `verified_by_sig` mediumtext DEFAULT NULL,
  `verified_by_img` mediumtext DEFAULT NULL,
  `verified_by_name` varchar(255) DEFAULT NULL,
  `date_verified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table qc.tbl_aaml_settings
CREATE TABLE IF NOT EXISTS `tbl_aaml_settings` (
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
