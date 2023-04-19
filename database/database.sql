-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.31 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping database structure for gwcs_shihab_mirza
CREATE DATABASE IF NOT EXISTS `gwcs_shihab_mirza` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `gwcs_shihab_mirza`;

-- Dumping structure for table gwcs_shihab_mirza.campingsites
CREATE TABLE IF NOT EXISTS `campingsites` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `Features` text NOT NULL,
  `Featured` tinyint DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table gwcs_shihab_mirza.done
CREATE TABLE IF NOT EXISTS `done` (
  `isdone` bigint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- Data exporting was unselected.

-- Dumping structure for table gwcs_shihab_mirza.localattractions
CREATE TABLE IF NOT EXISTS `localattractions` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `attraction_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `milesFromSite` double NOT NULL,
  `site_id` bigint NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `localattractions_site_id_foreign` (`site_id`),
  CONSTRAINT `localattractions_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `campingsites` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table gwcs_shihab_mirza.loginattempts
CREATE TABLE IF NOT EXISTS `loginattempts` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) NOT NULL,
  `time_count` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table gwcs_shihab_mirza.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `Message` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username_foreign` (`username`),
  CONSTRAINT `username_foreign` FOREIGN KEY (`username`) REFERENCES `users` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Data exporting was unselected.

-- Dumping structure for table gwcs_shihab_mirza.pitches
CREATE TABLE IF NOT EXISTS `pitches` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `site_id` bigint NOT NULL,
  `Pitch_Type` bigint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pitches_site_id_foreign` (`site_id`),
  KEY `pitch_type_foreign` (`Pitch_Type`),
  CONSTRAINT `pitch_type_foreign` FOREIGN KEY (`Pitch_Type`) REFERENCES `pitchtypes` (`id`),
  CONSTRAINT `pitches_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `campingsites` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table gwcs_shihab_mirza.pitchtypes
CREATE TABLE IF NOT EXISTS `pitchtypes` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table gwcs_shihab_mirza.reviews
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `site_id` bigint NOT NULL,
  `username` varchar(255) NOT NULL,
  `reviewText` text NOT NULL,
  `rating` bigint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_username_foreign` (`username`),
  KEY `reviews_site_id_foreign` (`site_id`),
  CONSTRAINT `reviews_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `campingsites` (`id`),
  CONSTRAINT `reviews_username_foreign` FOREIGN KEY (`username`) REFERENCES `users` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table gwcs_shihab_mirza.swimmingsessions
CREATE TABLE IF NOT EXISTS `swimmingsessions` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `site_id` bigint NOT NULL,
  `Start` time NOT NULL,
  `End` time NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `swimmingsessions_site_id_foreign` (`site_id`),
  CONSTRAINT `swimmingsessions_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `campingsites` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table gwcs_shihab_mirza.users
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `usertype` varchar(255) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
