-- MySQL dump 10.13  Distrib 8.0.35, for Win64 (x86_64)
--
-- Host: localhost    Database: doctordb
-- ------------------------------------------------------
-- Server version	8.0.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('unread','read','replied') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `replied_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contacts_status_index` (`status`),
  KEY `contacts_created_at_index` (`created_at`),
  KEY `contacts_email_index` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'Muhammad Rashid','mrashid2000@gmail.com','03333284252','Testing','unread',NULL,'2025-07-04 02:41:20','2025-07-04 02:41:20'),(2,'Muhammad Rashid','mrashid2000@gmail.com','03333284252','Teset','unread',NULL,'2025-07-04 02:54:25','2025-07-04 02:54:25'),(3,'Muhammad Rashid','mrashid2000@gmail.com','03333284252','Teset','unread',NULL,'2025-07-04 02:55:24','2025-07-04 02:55:24'),(4,'Muhammad Rashid','mrashid2000@gmail.com','03333284252','Test','unread',NULL,'2025-07-04 03:34:08','2025-07-04 03:34:08'),(5,'Muhammad Rashid','mrashid2000@gmail.com','03333284252','Test','unread',NULL,'2025-07-04 03:36:32','2025-07-04 03:36:32'),(6,'Muhammad Rashid','mrashid2000@gmail.com','03333284252','Test','unread',NULL,'2025-07-04 06:42:35','2025-07-04 06:42:35'),(7,'Muhammad Rashid','mrashid2000@gmail.com','03333284252','Test','unread',NULL,'2025-07-04 06:47:30','2025-07-04 06:47:30'),(8,'Muhammad Rashid','mrashid2000@gmail.com','03333284252','Test','unread',NULL,'2025-07-04 06:48:13','2025-07-04 06:48:13'),(9,'Muhammad Rashid','mrashid2000@gmail.com','03333284252','Test','unread',NULL,'2025-07-04 06:52:14','2025-07-04 06:52:14'),(10,'Muhammad Rashid','mrashid2000@gmail.com','03333284252','Test','unread',NULL,'2025-07-04 06:52:52','2025-07-04 06:52:52'),(11,'Muhammad Rashid','mrashid2000@gmail.com','03333284252','Test','unread',NULL,'2025-07-04 08:12:41','2025-07-04 08:12:41'),(12,'Muhammad Rashid','mrashid2000@gmail.com','03333284252','Test2','unread',NULL,'2025-07-04 08:13:37','2025-07-04 08:13:37');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medical_reports`
--

DROP TABLE IF EXISTS `medical_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medical_reports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `patient_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int NOT NULL,
  `report_type` enum('blood_report','xray','mri','ultrasound','ct_scan','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_paths` json NOT NULL,
  `symptoms` text COLLATE utf8mb4_unicode_ci,
  `medical_history` text COLLATE utf8mb4_unicode_ci,
  `urgency_level` enum('normal','urgent','emergency') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `terms_accepted` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('pending','analyzing','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `analysis_result` text COLLATE utf8mb4_unicode_ci,
  `analyzed_at` timestamp NULL DEFAULT NULL,
  `analyzed_by` bigint unsigned DEFAULT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `payment_status` enum('pending','paid','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `medical_reports_analyzed_by_foreign` (`analyzed_by`),
  KEY `medical_reports_status_urgency_level_index` (`status`,`urgency_level`),
  KEY `medical_reports_email_index` (`email`),
  KEY `medical_reports_user_id_foreign` (`user_id`),
  CONSTRAINT `medical_reports_analyzed_by_foreign` FOREIGN KEY (`analyzed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `medical_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medical_reports`
--

LOCK TABLES `medical_reports` WRITE;
/*!40000 ALTER TABLE `medical_reports` DISABLE KEYS */;
INSERT INTO `medical_reports` VALUES (14,'Bilal','03333284252','rashid@gmail.com',40,'blood_report','[\"medical-reports/2025/07/02/emTHnNhR5D/IhHBc4Bh8QIvlzyBLdPVW4QWGl1RLPCZnDCagn6d.pdf\"]','test','testing','normal',1,'pending','pending',NULL,NULL,1500.00,'pending','2025-07-02 11:35:34','2025-07-02 11:35:34',2),(15,'Bilal','03334646464','bilal@gmail.com',39,'blood_report','[\"medical-reports/2025/07/02/CIMagP8pmd/OMss67xC63RGFcOVl5pM0DJP0NOcu6UOQMLaFc7h.pdf\", \"medical-reports/2025/07/02/CIMagP8pmd/Z3bfHwb1wtgZvfO0GkfgMR5k45X21fWIIR0XVmEe.pdf\"]','Testing','test','normal',1,'pending','pending',NULL,NULL,1500.00,'pending','2025-07-02 16:08:59','2025-07-02 16:08:59',3),(16,'Waqas','03334646464','waqas@gmail.com',40,'blood_report','[\"medical-reports/2025/07/03/wLQk9B7zMB/Nigxno7Y9aNF4zGj6jpJEiF0I3d2GwNaXwF4MGEJ.pdf\"]','test','testing','normal',1,'completed','I have checked the report again 3','2025-07-03 17:37:41',2,1500.00,'pending','2025-07-03 14:18:35','2025-07-03 17:37:41',3);
/*!40000 ALTER TABLE `medical_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2025_06_04_065051_create_medical_reports_table',1),(6,'2025_06_09_223853_create_sessions_table',2),(7,'2025_06_27_221104_add_role_to_users_table',3),(8,'2025_06_27_221909_add_user_id_to_medical_reports_table',4),(9,'2025_07_04_072310_create_contacts_table',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','patient') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'patient',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin User','admin@example.com',NULL,'$2y$10$nYgaNVG7J09taD2Xu9bnNuJPgfyKzN/MSro0tgZXBV12N5bXEtD4a',NULL,'2025-06-27 17:47:39','2025-06-27 17:47:39','admin'),(2,'Muhammad Rashid','mrashid2000@gmail.com',NULL,'$2y$10$bzvuU7ot0jqTGKOH4/W9GOHomMV455M13IJWf1ZCP73aybZX4IuPi','IcTZMP9NoU8mgcJHvQa8PF2wUIX7gKlfUpBg4OI1c5snmAz3q1F3n4P7VDLW','2025-06-28 15:01:46','2025-06-28 15:01:46','admin'),(3,'Waqas','waqas@gmail.com',NULL,'$2y$10$vnHHRiu3YkbNZxz9yLaKsOdLuN.SZxGxWdg8dXJ28mbkcnpN9Iroy',NULL,'2025-07-02 16:08:04','2025-07-02 16:08:04','patient'),(4,'Mushtaq','mushtaq@gmail.com',NULL,'$2y$10$8ojfzp/iJIL9/ODDIuU7d.oUGoih0WQn4ArsI3UOvTacg.40C9eqG',NULL,'2025-07-03 10:58:45','2025-07-03 10:58:45','patient');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-04 18:45:36
