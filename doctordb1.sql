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
  PRIMARY KEY (`id`),
  KEY `medical_reports_analyzed_by_foreign` (`analyzed_by`),
  KEY `medical_reports_status_urgency_level_index` (`status`,`urgency_level`),
  KEY `medical_reports_email_index` (`email`),
  CONSTRAINT `medical_reports_analyzed_by_foreign` FOREIGN KEY (`analyzed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medical_reports`
--

LOCK TABLES `medical_reports` WRITE;
/*!40000 ALTER TABLE `medical_reports` DISABLE KEYS */;
INSERT INTO `medical_reports` VALUES (1,'Rashid','03333284252','mrashid2000@gmail.com',50,'mri','[\"medical-reports/2025/06/06/QoZpQ2IWrd/A59XTogrng4nx2AFCe5NdUGRsHhEDerHbvkkrsyw.jpg\"]','fever','body pain','normal',1,'pending',NULL,NULL,NULL,3500.00,'pending','2025-06-06 12:29:52','2025-06-06 12:29:52'),(2,'Saad Khan','03353239216','shazianawab2000@gmail.com',18,'ultrasound','[\"medical-reports/2025/06/08/KnG4sxJMTP/VpixUdcaR091HqI7nVoHhGroBeRDdkZeG24tMcaJ.pdf\"]','Toothache','fever','urgent',1,'pending',NULL,NULL,NULL,3750.00,'pending','2025-06-08 00:19:13','2025-06-08 00:19:13'),(3,'Shazia Nawab','03334646464','shazianawab2000@gmail.com',45,'ct_scan','[\"medical-reports/2025/06/08/SlyvAnFk74/5oOg2qCRtpzyPQgo3bhzv0pRf5fOEsCSaG340Tjr.pdf\", \"medical-reports/2025/06/08/SlyvAnFk74/qIvIklEzzpcrlu2rOm4jJWVyuZ97u3pAC3U0LqdE.pdf\"]','Headache','Fever','urgent',1,'pending',NULL,NULL,NULL,4500.00,'pending','2025-06-08 00:31:48','2025-06-08 00:31:48'),(4,'Khatoon Jehan','03333284252','mrashid2000@gmail.com',92,'ct_scan','[\"medical-reports/2025/06/08/bmCMxsZuyo/hJ30P1cs7qdbEFqTSDpx6r3U9gF2Zb2orQiSZW9V.pdf\"]','Fever','Headache','normal',1,'pending',NULL,NULL,NULL,3000.00,'pending','2025-06-08 01:11:40','2025-06-08 01:11:40'),(5,'Bilal','009809809809','mrashid2000@gmail.com',23,'mri','[\"medical-reports/2025/06/08/EGbbTvjLEt/ldZWYWt9yJimszLSg52gBRKiv6KugnbXCgGWXHsH.pdf\"]','Fever','Fever','normal',1,'pending',NULL,NULL,NULL,3500.00,'pending','2025-06-08 02:14:34','2025-06-08 02:14:34'),(6,'Arsalan','03002873782','mrashid2000@gmail.com',21,'mri','[\"medical-reports/2025/06/08/bC6cWItk8d/yAEGEqpqYtn1GtvxJQZS8yKCOjYepnIYVtNvEFJM.pdf\"]','fever','headache','normal',1,'pending',NULL,NULL,NULL,3500.00,'pending','2025-06-08 02:18:22','2025-06-08 02:18:22'),(7,'Waqas','03131234567','mrashid2000@gmail.com',23,'ultrasound','[\"medical-reports/2025/06/08/o7MQGZbbQN/liOyA32I65CiQowj3nSl8OiEG0xc8IQZ9tifNL9B.pdf\", \"medical-reports/2025/06/08/o7MQGZbbQN/TS2tRqYwQp58R4ZF0qz6O0a1CBz8aoilqcrKu2uZ.pdf\"]','Headache','Body pain','urgent',1,'pending',NULL,NULL,NULL,3750.00,'pending','2025-06-08 02:26:18','2025-06-08 02:26:19'),(8,'Khurram','03001234567','mrashid2000@gmail.com',40,'mri','[\"medical-reports/2025/06/08/4VI71S7Y1Z/muX0AZp0VaSfwGzImOCMoETefYTwjRGHOQNq0r5h.png\", \"medical-reports/2025/06/08/4VI71S7Y1Z/8Kg9bRYoo9R3LNkF3zSp6HjUBAzCqSfoJJFJJ5yS.png\"]','Blood Sugar','Blood Pressure','normal',1,'pending',NULL,NULL,NULL,3500.00,'pending','2025-06-08 03:46:23','2025-06-08 03:46:23'),(9,'Khurram','03131234567','mrashid2000@gmail.com',40,'blood_report','[\"medical-reports/2025/06/08/fc4XX4zgwS/xrdA3nWarkoqLClq17PhRUuSecFhLIDeyvfPJOHE.png\", \"medical-reports/2025/06/08/fc4XX4zgwS/T2lbqekHchOFAiZohyLQsTh2e6Mcye5JVh4ITo9n.png\"]','Blood Pressure','Blood Sugar','urgent',1,'pending',NULL,NULL,NULL,2250.00,'pending','2025-06-08 03:48:57','2025-06-08 03:48:57'),(10,'Muhammad Kashif','89798798','mrashid2000@gmail.com',45,'xray','[\"medical-reports/2025/06/09/OUiHZUWZd5/DLywyXLM6ZH90E0TVLQSTDdd3KZaz4rvEOSL0BBv.png\"]','fever','headahe','normal',1,'pending',NULL,NULL,NULL,2000.00,'pending','2025-06-09 14:38:17','2025-06-09 14:38:17'),(11,'Khatoon Jehan','03353239216','mrashid2000@gmail.com',92,'xray','[\"medical-reports/2025/06/09/TKiK6qh9WD/VgqGA7m5UGMRepq0jid3li1KQFRauYrtL4gt5dft.png\"]','Fever','Headache','urgent',1,'pending',NULL,NULL,NULL,3000.00,'pending','2025-06-09 15:23:56','2025-06-09 15:23:56'),(12,'Khurram','03002873782','mrashid2000@gmail.com',24,'ct_scan','[\"medical-reports/2025/06/09/WDsZpN0cYC/ZhvsV4af0OC2D98yaNiLbTbOfOMLdNwba8qro6Ns.png\", \"medical-reports/2025/06/09/WDsZpN0cYC/BJ3rTWl0XYHHHtkPctmYbpvYzMXAprv5UIlUP3Nv.png\"]','Headache','fever','normal',1,'pending',NULL,NULL,NULL,3000.00,'pending','2025-06-09 15:27:22','2025-06-09 15:27:22'),(13,'Ghulam Jelani','03001234567','mrashid2000@gmail.com',65,'xray','[\"medical-reports/2025/06/09/MuxhGOOBel/lxJuURrzAy6vvw2rhDwU7VtaZZ1XMsAx85x18X9N.png\", \"medical-reports/2025/06/09/MuxhGOOBel/BVnSM3B1PGU3HMGrdsA10ZsG2r5Jg8cgauzPjeyP.png\"]','Fever','Headache','normal',1,'pending',NULL,NULL,NULL,2000.00,'pending','2025-06-09 16:28:58','2025-06-09 16:28:58');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2025_06_04_065051_create_medical_reports_table',1),(6,'2025_06_09_223853_create_sessions_table',2);
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2025-06-10  3:41:48
