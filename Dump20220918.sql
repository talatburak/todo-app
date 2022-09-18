CREATE DATABASE  IF NOT EXISTS `todo_app` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_turkish_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `todo_app`;
-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: localhost    Database: todo_app
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `daily`
--

DROP TABLE IF EXISTS `daily`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `daily` (
  `dailyid` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `content` longtext COLLATE utf8_turkish_ci,
  `ipadress` varchar(45) COLLATE utf8_turkish_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `daily_time` time DEFAULT NULL,
  PRIMARY KEY (`dailyid`),
  KEY `userid` (`user_id`),
  CONSTRAINT `userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily`
--

LOCK TABLES `daily` WRITE;
/*!40000 ALTER TABLE `daily` DISABLE KEYS */;
INSERT INTO `daily` VALUES (1,1,'asdasdghasd asdghasdjgkaşsdlkgasdg','::1','2022-05-22',NULL),(2,1,'sadahsdghasdg','::1','2022-05-22',NULL),(3,1,'asdkhjasdngk ak naksdhgasdg','::1','2022-05-22',NULL),(4,1,'Deneme deneme deneme deneme','::1','2022-05-22',NULL),(5,1,'asdfahsdgasd kashdgasdg','::1','2022-05-22',NULL),(6,1,'asjdshdgasdg','::1','2022-05-22',NULL),(7,1,'asdfhasdg','::1','2022-05-22',NULL),(8,1,'asdfahsdg','::1','2022-05-22',NULL),(9,1,'Mebbis hatası giderildi','::1','2022-05-22',NULL),(10,1,'546','127.0.0.1','2022-09-04',NULL),(11,1,'0,,213546246321321654621354321654321','127.0.0.1','2022-09-04',NULL),(12,1,'165132165123165132','127.0.0.1','2022-09-04',NULL),(13,1,'1654132165423165','127.0.0.1','2022-09-04',NULL),(14,1,'Mehmet beyin faturalarını işledim','127.0.0.1','2022-09-04',NULL),(15,1,'Sülüman beye tebligat yolladım','127.0.0.1','2022-09-04',NULL),(16,1,'ddddd','127.0.0.1','2022-09-09',NULL),(17,1,'Gülşahı çok seviyorum xd','127.0.0.1','2022-09-09',NULL),(18,1,'asdfhasdgasdg','127.0.0.1','2022-09-09',NULL),(19,1,'dgasldkgasldkhgasdgasdg','127.0.0.1','2022-09-09','14:55:00'),(20,1,'asdfasdg','127.0.0.1','2022-09-09','22:56:00'),(21,1,'asdfasdgasd','127.0.0.1','2022-09-09','22:56:00'),(22,1,'asdasgasdfkjasdg','127.0.0.1','2022-09-09','22:56:00'),(23,1,'asdfğıahsdgasdg','127.0.0.1','2022-09-09','22:56:00'),(24,1,'mebbis kontrol edildi','127.0.0.1','2022-09-09','22:58:00'),(25,1,'mebbis tarafında kullanıcı girişleri düzeltildi','127.0.0.1','2022-09-09','22:58:00'),(26,1,'mebbis fotoğraf gönderme tamamlandı','127.0.0.1','2022-09-09','22:58:00'),(27,1,'eylül eva aradı 2 saatimi yedi','127.0.0.1','2022-09-09','22:59:00'),(28,1,'hasan abi çağırdı 4 saat boş yaptık','127.0.0.1','2022-09-09','22:59:00'),(29,1,'deme','127.0.0.1','2022-09-11','16:14:00'),(30,1,'deneme','127.0.0.1','2022-09-11','16:14:00'),(31,1,'denemeee','127.0.0.1','2022-09-11','16:14:00');
/*!40000 ALTER TABLE `daily` ENABLE KEYS */;
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
-- Table structure for table `in_out_log`
--

DROP TABLE IF EXISTS `in_out_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `in_out_log` (
  `user_id` bigint DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `year` varchar(4) COLLATE utf8_turkish_ci DEFAULT NULL,
  `mounth` varchar(2) COLLATE utf8_turkish_ci DEFAULT NULL,
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `in_out_log`
--

LOCK TABLES `in_out_log` WRITE;
/*!40000 ALTER TABLE `in_out_log` DISABLE KEYS */;
INSERT INTO `in_out_log` VALUES (1,'2022-09-09','22:56:00',NULL,'2022','09'),(1,'2022-09-11','16:13:00','23:16:00','2022','09');
/*!40000 ALTER TABLE `in_out_log` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1);
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
-- Table structure for table `task_process`
--

DROP TABLE IF EXISTS `task_process`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `task_process` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `sender_id` bigint DEFAULT NULL,
  `description` blob,
  `create_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `attachments` tinyint DEFAULT '0',
  `task_id` bigint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `task_id` (`task_id`),
  CONSTRAINT `sender_id` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `task_id` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_process`
--

LOCK TABLES `task_process` WRITE;
/*!40000 ALTER TABLE `task_process` DISABLE KEYS */;
/*!40000 ALTER TABLE `task_process` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tasks` (
  `task_id` bigint NOT NULL AUTO_INCREMENT,
  `task_name` varchar(150) COLLATE utf8_turkish_ci DEFAULT NULL,
  `task_desc` blob,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `creator_id` bigint DEFAULT NULL,
  `given_id` bigint DEFAULT NULL,
  `remember` tinyint DEFAULT '0',
  `done` tinyint DEFAULT '0',
  `unlimited` tinyint DEFAULT '0',
  `done_date` date DEFAULT NULL,
  `finish_date` datetime DEFAULT NULL,
  PRIMARY KEY (`task_id`),
  KEY `creator_id` (`creator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,'Mebbis hatasını gider',_binary 'Fotoğraf gönderiminde sorun varmış','2022-09-09 22:57:41','2022-09-09 22:57:41',1,NULL,0,0,0,NULL,NULL),(2,'Deneme',_binary 'Bir görev ekliyorum','2022-09-13 23:57:11','2022-09-13 23:57:11',1,NULL,0,0,0,NULL,NULL),(4,'asdfasdg',_binary 'asdgasdfasdf','2022-09-14 00:04:10','2022-09-14 00:04:10',1,NULL,0,0,1,NULL,NULL),(5,'asdfasdg123 124123',_binary 'asdgasdfasdf','2022-09-14 00:04:19','2022-09-14 00:04:19',1,NULL,0,0,0,'2014-09-20',NULL),(6,'asdfasdg',_binary 'asdfasdg','2022-09-14 00:07:43','2022-09-14 00:07:43',1,NULL,0,0,1,NULL,NULL),(7,'12 1124 124',_binary 'asdfasdg','2022-09-14 00:07:52','2022-09-14 00:07:52',1,NULL,0,0,1,NULL,NULL),(8,'asdfasdgasdfasdg',_binary 'asdgasdfasdgasdf','2022-09-14 00:07:58','2022-09-14 00:07:58',1,NULL,0,0,0,'2015-09-20',NULL);
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `adi` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `soyadi` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','email@email.com',NULL,'$2y$10$wAyQ6htX.gRiuySZXkFZHuMFAFj5XEewLGQOAX25TcIIKwaNPnLMS',NULL,NULL,NULL,'Talat Burak','Duran',NULL),(2,'admin','email@email1.com',NULL,'$2y$10$DK2Ck4u4JxBDT5ysQwRHOey0S02AvIw3fQHeZ7uyjNbmhTR7.8DXi',NULL,NULL,NULL,NULL,NULL,NULL);
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

-- Dump completed on 2022-09-18 18:23:26
