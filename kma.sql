-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: kma
-- ------------------------------------------------------
-- Server version	5.7.20-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `borrow`
--

DROP TABLE IF EXISTS `borrow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `borrow` (
  `id` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `id_document` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `book_status` varchar(255) DEFAULT NULL,
  `expiry` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `borrow`
--

LOCK TABLES `borrow` WRITE;
/*!40000 ALTER TABLE `borrow` DISABLE KEYS */;
INSERT INTO `borrow` VALUES ('1','admin','GT00001',NULL,NULL,NULL,NULL,'Mới',NULL),('2','test','VG01',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `borrow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) DEFAULT NULL,
  `department_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (1,'An toàn thông tin','security'),(2,'Mật mã','crpt'),(3,'Phổ thông','public'),(4,'Khác','orther');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document` (
  `id` varchar(255) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT 'Chưa có dữ liệu',
  `publishing_company` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `borrow_by` varchar(255) DEFAULT NULL,
  `review` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document`
--

LOCK TABLES `document` WRITE;
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
INSERT INTO `document` VALUES ('123412312','Tôi đi code','Tôi','Tôi','Chọn một','Mới','2018-06-17 11:04:57','2018-06-17 11:28:33','admin','admin',NULL,'Sửa thất bại',NULL),('GG','GG','GG','GG','Tham Khảo','Hỏng','2018-06-18 04:02:55','2018-06-18 04:02:55','admin',NULL,NULL,'GG','Phổ thông'),('GT00001','Giáo trình đại cương','Ai đó','Ai đó','Giáo Trình','Cũ','2018-06-18 02:51:36','2018-06-18 03:32:46','admin','admin',NULL,'Ai đó viết ra','An toàn thông tin'),('VG01','Mác Lê Nin đại cương','Mác','Nxb Kim Đồng','$2y$10$tijIaiXLLcFlDnrKkzTBquPL9erX8CoTaOrCGDhGB5ZImjHi86R66','Mới','2018-06-17 11:36:29','2018-06-17 11:36:29','admin',NULL,NULL,'Rất hay và bổ ích',NULL),('VG0101','Toán Siêu cao cấp','Toán học thế giới','Book of World','$2y$10$rPYYeaE1PmDoPXjAvJBwpOl8s/hnFQVe44VIlXtKfWyrmYHghW2Ju','Cũ','2018-06-17 11:37:30','2018-06-17 11:37:30','admin',NULL,NULL,'Read to super man',NULL),('VG0102','Toán Siêu cao cấp','Toán học thế giới','Book of World','$2y$10$z8euNHP2E8MdmtE0oE/pV.YlxL6QmjvjolL.lO1BIDvdrLcxSZjaW','Chọn một','2018-06-17 11:37:38','2018-06-17 11:37:38','admin',NULL,NULL,'Read to super man',NULL),('VG0103','Toán Siêu cao cấp','Toán học thế giới','Book of World','$2y$10$m1TwIQ7vZRxevN2ITd3cxOG/FSKT2hG9wnVxn7Iu1CILzS4/05Wyy','Chọn một','2018-06-17 11:37:41','2018-06-17 11:37:41','admin',NULL,NULL,'Read to super man',NULL);
/*!40000 ALTER TABLE `document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2018_06_02_100000_create_maths_question_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reimburse`
--

DROP TABLE IF EXISTS `reimburse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reimburse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `id_book` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reimburse`
--

LOCK TABLES `reimburse` WRITE;
/*!40000 ALTER TABLE `reimburse` DISABLE KEYS */;
/*!40000 ALTER TABLE `reimburse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) DEFAULT NULL,
  `role_value` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Quản trị viên','admin'),(2,'Sinh viên ','student'),(4,'Giáo viên','teacher');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(255) DEFAULT NULL,
  `status_value` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'Mất','lose'),(2,'Hỏng','broken'),(3,'Mới','new'),(4,'Cũ','old');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) DEFAULT NULL,
  `type_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
INSERT INTO `type` VALUES (1,'Giáo Trình','Curriculum'),(2,'Tham Khảo','reference'),(3,'Đồ án','project'),(4,'Giáo án','lesson_plan');
/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `classroom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`username`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'Nguyễn Văn Luân','AT120633','$2y$12$/8sk1Nj1Zq5Z6QEPrKpmheGvhULGvuBwAaLveoFoCZ3CB8JeJnPPW','ersDDV7hqX5OJBAESpiKonPQvq4I8ee1Cyl4ZCkLmtGb3e1QlzROWCjgjhFT',NULL,NULL,'An Toàn Thông tin','https://ffp4g1ylyit3jdyti1hqcvtb-wpengine.netdna-ssl.com/theden/files/2013/06/fb_social_avatar_403x403-160x160.png',NULL,NULL,NULL,NULL,NULL,NULL),(3,'Văn A','MM120633','$2y$12$/8sk1Nj1Zq5Z6QEPrKpmheGvhULGvuBwAaLveoFoCZ3CB8JeJnPPW',NULL,NULL,NULL,'Hệ Mật mã','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTc6G7wgrOcCtSDp2uIvDbI6oDk2wdYSFFvwlfLAIoQNTeGASIT',NULL,NULL,NULL,NULL,NULL,NULL),(4,'Thầy Sơn','GV01','$2y$12$/8sk1Nj1Zq5Z6QEPrKpmheGvhULGvuBwAaLveoFoCZ3CB8JeJnPPW',NULL,NULL,NULL,'Giáo Viên','http://pixel.nymag.com/imgs/custom/tvrecaps/recaps-the-legend-of-korra-160x160.w80.h80.2x.png',NULL,NULL,NULL,NULL,NULL,NULL),(15,'Quản trị viên','admin','$2y$10$DQKjrJMyRAaoLtXHwxCIKORDYeMDso838LroLlmbPnYsxw1ZUI0qa','y9PWE3WNFmAvnXVlFzOrGEjN2DAnko27mdJ8aVzoj0WV1Lwp4TaIplCIeTsx',NULL,'2018-06-17 21:45:24','Admin','http://admin','Admin TÉ','AT12','Admin',NULL,'admin','Phổ thông'),(17,'Sinh viên 1','studentAT','$2y$10$NExL.YZRPTdWh9jSfPTgXOhj/vUKpMLHlbm1ARAPni4VONdGXAOD2',NULL,'2018-06-17 19:47:59','2018-06-17 19:48:33','Sinh viên','http://attt.com','Hà Nội','AT12','2015-2020','admin','admin','An toàn thông tin');
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

-- Dump completed on 2018-06-18 18:13:07
