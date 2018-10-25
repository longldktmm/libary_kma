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
  `document_code` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `document_status` varchar(255) DEFAULT NULL,
  `expiry` int(11) DEFAULT '90',
  `note` varchar(255) DEFAULT NULL,
  `booking_status` int(2) DEFAULT '0',
  `booking_code` varchar(255) DEFAULT NULL,
  `booking_time` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `borrow`
--

LOCK TABLES `borrow` WRITE;
/*!40000 ALTER TABLE `borrow` DISABLE KEYS */;
INSERT INTO `borrow` VALUES ('175bb319-142d-41cd-a084-f43fcc093590','AT120633','VG0101','2018-10-25 06:39:13','2018-10-25 06:40:06','AT120633',NULL,'Cũ',-31,NULL,5,'GM001','2018-10-26'),('6b62ff3a-d692-4ae5-bfce-8160d74555f6','AT120633','GT00001','2018-10-25 06:37:35','2018-10-25 06:40:08','AT120633',NULL,'Cũ',29,NULL,5,'GM001','2018-10-26');
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
INSERT INTO `document` VALUES ('123412312','Tôi đi code','Tôi','Tôi','Tham Khảo','Mới','2018-06-17 11:04:57','2018-10-15 13:19:05','admin','admin',NULL,'Sửa thành công','Khác'),('GA00001','giáo án','test','tesstttttt','Giáo án','Mới','2018-06-19 09:46:33','2018-06-19 09:46:33','admin',NULL,NULL,'GIÁO ÁN','Mật mã'),('GG','GG','GG','GG','Tham Khảo','Mới','2018-06-18 04:02:55','2018-10-24 11:27:42','admin','admin','df1e5748-df6e-472d-af02-bb1944c2447e','GG','Phổ thông'),('GG2','GG','GG','GG','Tham Khảo','Mới','2018-06-18 04:02:55','2018-10-16 05:25:38','admin','admin',NULL,'GG','Phổ thông'),('GT00001','Giáo trình đại cương','Ai đó','Ai đó','Giáo Trình','Cũ','2018-06-18 02:51:36','2018-10-15 11:22:41','admin','admin',NULL,'Ai đó viết ra','An toàn thông tin'),('VG01','Mác Lê Nin đại cương','Mác','Nxb Kim Đồng','Giáo Trình','Mới','2018-06-17 11:36:29','2018-10-22 12:43:58','admin','admin','04acc525-2c18-475b-9844-ca9877cafc35','Rất hay và bổ ích','An toàn thông tin'),('VG0101','Toán Siêu cao cấp','Toán học thế giới','Book of World','Đồ án','Cũ','2018-06-17 11:37:30','2018-10-22 14:29:07','admin','admin',NULL,'Read to super man','An toàn thông tin'),('VG0102','Toán Siêu cao cấp','Toán học thế giới','Book of World','Giáo Trình','Mới','2018-06-17 11:37:38','2018-10-15 11:22:46','admin','admin',NULL,'Read to super man','An toàn thông tin'),('VG0103','Toán Siêu cao cấp','Toán học thế giới','Book of World','Giáo Trình','Mới','2018-06-17 11:37:41','2018-10-15 11:22:30','admin','admin',NULL,'Read to super man','An toàn thông tin');
/*!40000 ALTER TABLE `document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (1,'Admin','Đã thêm một user',NULL,NULL),(2,'AT120632','Đã trả một quyển',NULL,NULL),(3,'AT120632','Đã mượn một quyển sách',NULL,NULL),(4,'AT120632','Đã mượn một quyển sách',NULL,NULL),(5,'AT120632','Đã mượn một quyển sách',NULL,NULL),(6,'Admin','Đã xóa một user',NULL,NULL),(7,'System','admin đã đăng nhập','2018-06-19 05:33:46','2018-06-19 05:33:46'),(8,'admin','Đã sửa một tài khoản admin','2018-06-19 05:40:52','2018-06-19 05:40:52'),(9,'admin','Đã cho AT120633 mượn một quyển sách','2018-06-19 05:41:42','2018-06-19 05:41:42'),(10,'System','AT120633 đã đăng nhập','2018-06-19 05:49:51','2018-06-19 05:49:51'),(11,'System','admin đã đăng nhập','2018-06-19 05:50:07','2018-06-19 05:50:07'),(12,'admin','Đã đổi mật khẩu admin','2018-06-19 05:54:02','2018-06-19 05:54:02'),(13,'System','admin đã đăng nhập','2018-06-19 05:56:44','2018-06-19 05:56:44'),(14,'System','AT120633 đã đăng nhập','2018-06-19 06:13:20','2018-06-19 06:13:20'),(15,'AT120633','Đã tự đổi mật khẩu ','2018-06-19 06:13:29','2018-06-19 06:13:29'),(16,'System','AT120633 đã đăng nhập','2018-06-19 06:13:36','2018-06-19 06:13:36'),(17,'AT120633','Đã tự đổi mật khẩu ','2018-06-19 06:13:44','2018-06-19 06:13:44'),(18,'System','admin đã đăng nhập','2018-06-19 06:13:50','2018-06-19 06:13:50'),(19,'System','AT120633 đã đăng nhập','2018-06-19 06:14:14','2018-06-19 06:14:14'),(20,'AT120633','Đã tự đổi mật khẩu ','2018-06-19 06:14:20','2018-06-19 06:14:20'),(21,'System','admin đã đăng nhập','2018-06-19 06:17:50','2018-06-19 06:17:50'),(22,'admin','Đã đổi mật khẩu admin','2018-06-19 06:18:38','2018-06-19 06:18:38'),(23,'System','admin đã đăng nhập','2018-06-19 06:18:47','2018-06-19 06:18:47'),(24,'admin','Đã đổi mật khẩu admin','2018-06-19 06:19:01','2018-06-19 06:19:01'),(25,'System','admin đã đăng nhập','2018-08-11 03:06:13','2018-08-11 03:06:13'),(26,'System','admin đã đăng nhập','2018-10-07 21:55:58','2018-10-07 21:55:58'),(27,'admin','Đã sửa một tài liệu VG0102','2018-10-08 01:30:13','2018-10-08 01:30:13'),(28,'admin','Đã sửa một tài liệu VG0103','2018-10-08 01:33:19','2018-10-08 01:33:19'),(29,'admin','Đã sửa một tài liệu VG0102','2018-10-08 01:33:52','2018-10-08 01:33:52'),(30,'admin','Đã sửa một tài liệu VG0101','2018-10-08 01:34:12','2018-10-08 01:34:12'),(31,'admin','Đã sửa một tài liệu VG0103','2018-10-08 01:34:43','2018-10-08 01:34:43'),(32,'admin','Đã sửa một tài liệu VG01','2018-10-08 02:07:10','2018-10-08 02:07:10'),(33,'System','admin đã đăng nhập','2018-10-14 20:46:45','2018-10-14 20:46:45'),(34,'admin','Đã thêm một tài khoản Lý Đức Long','2018-10-14 22:51:39','2018-10-14 22:51:39'),(35,'System','admin đã đăng nhập','2018-10-15 00:29:06','2018-10-15 00:29:06'),(36,'System','AT120632 đã đăng nhập','2018-10-15 00:29:44','2018-10-15 00:29:44'),(37,'System','admin đã đăng nhập','2018-10-15 02:34:14','2018-10-15 02:34:14'),(38,'System','AT120633 đã đăng nhập','2018-10-15 02:34:46','2018-10-15 02:34:46'),(39,'System','admin đã đăng nhập','2018-10-15 02:46:15','2018-10-15 02:46:15'),(40,'System','AT120633 đã đăng nhập','2018-10-15 02:47:34','2018-10-15 02:47:34'),(41,'System','admin đã đăng nhập','2018-10-15 03:11:32','2018-10-15 03:11:32'),(42,'System','AT120633 đã đăng nhập','2018-10-15 03:12:50','2018-10-15 03:12:50'),(43,'System','AT120633 đã đăng nhập','2018-10-15 04:13:17','2018-10-15 04:13:17'),(44,'admin','Đã sửa một tài liệu GG2','2018-10-15 04:14:27','2018-10-15 04:14:27'),(45,'admin','Đã sửa một tài liệu VG0101','2018-10-15 04:21:43','2018-10-15 04:21:43'),(46,'admin','Đã sửa một tài liệu VG01','2018-10-15 04:22:04','2018-10-15 04:22:04'),(47,'admin','Đã sửa một tài liệu VG0102','2018-10-15 04:22:16','2018-10-15 04:22:16'),(48,'admin','Đã sửa một tài liệu VG0103','2018-10-15 04:22:30','2018-10-15 04:22:30'),(49,'admin','Đã sửa một tài liệu GT00001','2018-10-15 04:22:41','2018-10-15 04:22:41'),(50,'admin','Đã sửa một tài liệu VG0102','2018-10-15 04:22:46','2018-10-15 04:22:46'),(51,'admin','Đã sửa một tài liệu VG0101','2018-10-15 04:22:54','2018-10-15 04:22:54'),(52,'admin','Đã sửa một tài liệu 123412312','2018-10-15 04:23:09','2018-10-15 04:23:09'),(53,'admin','Đã sửa một tài liệu 123412312','2018-10-15 04:23:09','2018-10-15 04:23:09'),(54,'admin','Đã sửa một tài liệu GG','2018-10-15 04:31:45','2018-10-15 04:31:45'),(55,'admin','Đã sửa một tài liệu GG2','2018-10-15 04:31:56','2018-10-15 04:31:56'),(56,'admin','Đã sửa một tài liệu 123412312','2018-10-15 06:19:05','2018-10-15 06:19:05'),(57,'System','admin đã đăng nhập','2018-10-15 19:22:27','2018-10-15 19:22:27'),(58,'System','AT120633 đã đăng nhập','2018-10-15 19:27:09','2018-10-15 19:27:09'),(59,'admin','Đã cho AT120633 mượn một quyển sách','2018-10-15 21:12:57','2018-10-15 21:12:57'),(60,'admin','Đã trả một quyển sách GG','2018-10-15 21:15:28','2018-10-15 21:15:28'),(61,'admin','Đã cho AT120633 mượn một quyển sách','2018-10-15 21:21:36','2018-10-15 21:21:36'),(62,'admin','Đã trả một quyển sách GG','2018-10-15 21:22:19','2018-10-15 21:22:19'),(63,'admin','Đã cho AT120633 mượn một quyển sách','2018-10-15 22:14:45','2018-10-15 22:14:45'),(64,'admin','Đã trả một quyển sách GG2','2018-10-15 22:25:38','2018-10-15 22:25:38'),(65,'admin','Đã xóa VG0102','2018-10-15 22:37:33','2018-10-15 22:37:33'),(66,'admin','Đã xóa GT00001','2018-10-15 22:42:50','2018-10-15 22:42:50'),(67,'System','admin đã đăng nhập','2018-10-16 21:41:40','2018-10-16 21:41:40'),(68,'System','admin đã đăng nhập','2018-10-16 21:42:22','2018-10-16 21:42:22'),(69,'System','admin đã đăng nhập','2018-10-16 21:43:40','2018-10-16 21:43:40'),(70,'System','AT120633 đã đăng nhập','2018-10-16 22:03:48','2018-10-16 22:03:48'),(71,'System','admin đã đăng nhập','2018-10-16 22:05:19','2018-10-16 22:05:19'),(72,'admin','Đã xóa VG0101','2018-10-16 22:06:22','2018-10-16 22:06:22'),(73,'System','AT120633 đã đăng nhập','2018-10-16 23:49:02','2018-10-16 23:49:02'),(74,'System','admin đã đăng nhập','2018-10-16 23:59:14','2018-10-16 23:59:14'),(75,'System','admin đã đăng nhập','2018-10-17 01:25:11','2018-10-17 01:25:11'),(76,'System','admin đã đăng nhập','2018-10-17 01:26:35','2018-10-17 01:26:35'),(77,'System','admin đã đăng nhập','2018-10-17 06:33:47','2018-10-17 06:33:47'),(78,'System','admin đã đăng nhập','2018-10-17 06:36:00','2018-10-17 06:36:00'),(79,'System','AT120633 đã đăng nhập','2018-10-17 06:45:24','2018-10-17 06:45:24'),(80,'System','at120633 đã đăng nhập','2018-10-17 06:47:40','2018-10-17 06:47:40'),(81,'System','admin đã đăng nhập','2018-10-21 06:19:06','2018-10-21 06:19:06'),(82,'System','AT120633 đã đăng nhập','2018-10-21 06:27:30','2018-10-21 06:27:30'),(83,'System','AT120633 đã đăng nhập','2018-10-21 06:53:51','2018-10-21 06:53:51'),(84,'System','admin đã đăng nhập','2018-10-21 07:04:43','2018-10-21 07:04:43'),(85,'System','admin đã đăng nhập','2018-10-22 03:22:07','2018-10-22 03:22:07'),(86,'System','AT120633 đã đăng nhập','2018-10-22 03:40:28','2018-10-22 03:40:28'),(87,'System','admin đã đăng nhập','2018-10-22 03:41:31','2018-10-22 03:41:31'),(88,'System','admin đã đăng nhập','2018-10-22 03:45:38','2018-10-22 03:45:38'),(89,'admin','Đã xóa VG0101','2018-10-22 03:47:52','2018-10-22 03:47:52'),(90,'admin','Đã xóa 123412312','2018-10-22 03:47:53','2018-10-22 03:47:53'),(91,'System','AT120633 đã đăng nhập','2018-10-22 05:27:06','2018-10-22 05:27:06'),(92,'admin','Đã cho AT120633 mượn một quyển sách','2018-10-22 05:43:58','2018-10-22 05:43:58'),(93,'System','admin đã đăng nhập','2018-10-22 07:24:19','2018-10-22 07:24:19'),(94,'admin','Đã cho At120633 mượn một quyển sách','2018-10-22 07:24:47','2018-10-22 07:24:47'),(95,'admin','Đã trả một quyển sách VG0101','2018-10-22 07:29:07','2018-10-22 07:29:07'),(96,'System','AT120633 đã đăng nhập','2018-10-22 07:55:49','2018-10-22 07:55:49'),(97,'System','admin đã đăng nhập','2018-10-22 08:10:48','2018-10-22 08:10:48'),(98,'System','admin đã đăng nhập','2018-10-23 21:27:51','2018-10-23 21:27:51'),(99,'admin','Đã xóa VG01','2018-10-23 21:36:40','2018-10-23 21:36:40'),(100,'admin','Đã xóa VG01','2018-10-23 21:36:42','2018-10-23 21:36:42'),(101,'System','AT120633 đã đăng nhập','2018-10-23 21:37:13','2018-10-23 21:37:13'),(102,'admin','Đã xóa GG','2018-10-24 00:40:22','2018-10-24 00:40:22'),(103,'admin','Đã xóa 123412312','2018-10-24 00:40:23','2018-10-24 00:40:23'),(104,'admin','Đã xóa VG0102','2018-10-24 00:40:24','2018-10-24 00:40:24'),(105,'admin','Đã xóa VG0102','2018-10-24 00:52:30','2018-10-24 00:52:30'),(106,'admin','Đã xóa GG','2018-10-24 00:52:31','2018-10-24 00:52:31'),(107,'admin','Đã xóa VG0101','2018-10-24 00:52:32','2018-10-24 00:52:32'),(108,'System','AT120633 đã đăng nhập','2018-10-24 03:41:10','2018-10-24 03:41:10'),(109,'System','admin đã đăng nhập','2018-10-24 03:46:19','2018-10-24 03:46:19'),(110,'admin','Đã xóa GG','2018-10-24 03:46:32','2018-10-24 03:46:32'),(111,'admin','Đã xóa VG0101','2018-10-24 03:46:33','2018-10-24 03:46:33'),(112,'admin','Đã xóa VG0102','2018-10-24 03:46:34','2018-10-24 03:46:34'),(113,'admin','Đã xóa phiếu mượn02efa749-f6ca-4bc2-a168-3884d2eae0e0','2018-10-24 04:05:52','2018-10-24 04:05:52'),(114,'System','AT120633 đã đăng nhập','2018-10-24 04:17:20','2018-10-24 04:17:20'),(115,'AT120633','AT120633 đã xin xác nhận phiếu hẹn ','2018-10-24 04:24:27','2018-10-24 04:24:27'),(116,'admin','Đã xóa phiếu mượn 3a0720c9-8729-4d21-8860-71350c1c2a8e','2018-10-24 04:24:45','2018-10-24 04:24:45'),(117,'admin','Đã xóa phiếu mượn 5b9cd033-1c2d-4bdc-b100-b264c3082566','2018-10-24 04:24:46','2018-10-24 04:24:46'),(118,'admin','Đã xóa phiếu mượn a7da29aa-1078-4813-b865-2981388c0f63','2018-10-24 04:24:47','2018-10-24 04:24:47'),(119,'AT120633','AT120633 đã xin xác nhận phiếu hẹn ','2018-10-24 04:25:22','2018-10-24 04:25:22'),(120,'admin','Đã giao cho AT120633 1 tài liệu mã VG0102','2018-10-24 04:26:02','2018-10-24 04:26:02'),(121,'admin','Đã cho AT120633 mượn một quyển sách','2018-10-24 04:27:42','2018-10-24 04:27:42'),(122,'System','admin đã đăng nhập','2018-10-24 21:17:37','2018-10-24 21:17:37'),(123,'admin','admin đã xin xác nhận phiếu hẹn ','2018-10-24 21:26:51','2018-10-24 21:26:51'),(124,'System','admin đã đăng nhập','2018-10-24 21:45:39','2018-10-24 21:45:39'),(125,'admin','Đã cho admin ngoại lệ phiếu mượn VG0102','2018-10-24 22:09:46','2018-10-24 22:09:46'),(126,'admin','Đã xóa phiếu mượn 117f6de4-24b9-48e3-b782-9a924e3bb55b','2018-10-24 22:12:47','2018-10-24 22:12:47'),(127,'admin','admin đã xin xác nhận phiếu hẹn ','2018-10-24 23:03:55','2018-10-24 23:03:55'),(128,'admin','admin đã xin xác nhận phiếu hẹn ','2018-10-24 23:04:20','2018-10-24 23:04:20'),(129,'admin','admin đã xin xác nhận phiếu hẹn ','2018-10-24 23:14:43','2018-10-24 23:14:43'),(130,'admin','admin đã xin xác nhận phiếu hẹn ','2018-10-24 23:21:16','2018-10-24 23:21:16'),(131,'System','AT120633 đã đăng nhập','2018-10-24 23:24:30','2018-10-24 23:24:30'),(132,'System','admin đã đăng nhập','2018-10-24 23:27:10','2018-10-24 23:27:10'),(133,'admin','Đã xóa phiếu mượn 3c514f3f-c882-408f-9ba4-3f182f3989b6','2018-10-24 23:27:19','2018-10-24 23:27:19'),(134,'admin','Đã xóa phiếu mượn df1e5748-df6e-472d-af02-bb1944c2447e','2018-10-24 23:27:20','2018-10-24 23:27:20'),(135,'System','AT120633 đã đăng nhập','2018-10-24 23:27:58','2018-10-24 23:27:58'),(136,'AT120633','AT120633 đã xin xác nhận phiếu hẹn ','2018-10-24 23:28:07','2018-10-24 23:28:07'),(137,'AT120633','AT120633 đã xin xác nhận phiếu hẹn ','2018-10-24 23:29:43','2018-10-24 23:29:43'),(138,'AT120633','AT120633 đã xin xác nhận phiếu hẹn ','2018-10-24 23:31:11','2018-10-24 23:31:11'),(139,'admin','Đã giao cho AT120633 1 tài liệu mã 123412312','2018-10-24 23:31:32','2018-10-24 23:31:32'),(140,'admin','Đã xóa phiếu mượn dfd79e1e-1884-41c9-b92a-72901ffccc42','2018-10-24 23:31:41','2018-10-24 23:31:41'),(141,'AT120633','AT120633 đã xin xác nhận phiếu hẹn ','2018-10-24 23:32:02','2018-10-24 23:32:02'),(142,'AT120633','AT120633 đã xin xác nhận phiếu hẹn ','2018-10-24 23:39:25','2018-10-24 23:39:25'),(143,'admin','Đã giao cho AT120633 1 tài liệu mã VG0101','2018-10-24 23:40:06','2018-10-24 23:40:06'),(144,'admin','Đã giao cho AT120633 1 tài liệu mã GT00001','2018-10-24 23:40:08','2018-10-24 23:40:08');
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
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
  `id` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `document_code` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `commit` varchar(255) DEFAULT NULL,
  `document_status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reimburse`
--

LOCK TABLES `reimburse` WRITE;
/*!40000 ALTER TABLE `reimburse` DISABLE KEYS */;
INSERT INTO `reimburse` VALUES ('40477372-23b9-47e2-89e4-31e83ee2dc47','AT120633','VG0101','2018-06-19 10:00:58','2018-06-19 10:00:58','admin',NULL,'ok','Mới'),('4f9ca8bc-8586-4245-8826-4782d638c6ec','At120633','VG0101','2018-10-22 14:29:06','2018-10-22 14:29:06','admin',NULL,NULL,'Mất'),('5e0e5cd2-5f91-4669-8aa4-a4394f090056','AT120633','GG2','2018-10-16 05:25:38','2018-10-16 05:25:38','admin',NULL,'Tốt','Mới'),('712152ec-57aa-4b71-b747-dc7e8bff2064','AT120633','GG','2018-10-16 04:22:19','2018-10-16 04:22:19','admin',NULL,'ok','Mới'),('e6cc1fce-98e7-4e59-b1e0-6674522b7f1c','AT120633','GT00001','2018-06-19 09:54:08','2018-06-19 09:54:08','admin',NULL,NULL,'Hỏng'),('f705392c-2c0e-4a52-8901-57ca402291ba','AT120633','GG','2018-10-16 04:15:28','2018-10-16 04:15:28','admin',NULL,'ok','Mới');
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
-- Table structure for table `statistics`
--

DROP TABLE IF EXISTS `statistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statistics` (
  `id` varchar(45) CHARACTER SET utf8 NOT NULL,
  `document_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total` int(10) unsigned NOT NULL,
  `new` int(10) unsigned NOT NULL,
  `old` int(10) unsigned NOT NULL,
  `broken` int(10) unsigned NOT NULL,
  `lose` int(10) unsigned NOT NULL,
  `booking` int(10) unsigned NOT NULL,
  `waiting` int(10) unsigned NOT NULL,
  `verified` int(10) unsigned NOT NULL,
  `exception` int(10) unsigned NOT NULL,
  `borrowing` int(10) unsigned NOT NULL,
  `ready` int(10) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statistics`
--

LOCK TABLES `statistics` WRITE;
/*!40000 ALTER TABLE `statistics` DISABLE KEYS */;
INSERT INTO `statistics` VALUES ('135411bb-98cf-4de7-91b7-a23453cbf370','giáo án',1,1,0,0,0,0,0,0,0,0,1,'Giáo án','Mật mã','test',NULL),('39c31819-115e-440f-a83a-3e6e9f63d7f0','Tôi đi code',1,1,0,0,0,0,0,0,0,0,1,'Tham Khảo','Khác','Tôi',NULL),('4fa6e8c6-34f6-4b40-b2c1-f4f9edbad17d','Mác Lê Nin đại cương',1,1,0,0,0,0,0,0,0,0,1,'Giáo Trình','An toàn thông tin','Mác',NULL),('5bcfbe60-e489-4bbc-b7cb-1ba4c91447cb','Toán Siêu cao cấp',2,2,0,0,0,0,0,0,0,0,2,'Giáo Trình','An toàn thông tin','Toán học thế giới',NULL),('ac814a53-176b-47e8-a28d-fa1ec89ff3de','GG',2,2,0,0,0,0,0,0,0,0,2,'Tham Khảo','Phổ thông','GG',NULL),('be876037-d881-4a6d-b5f0-8b8557c17cc5','Giáo trình đại cương',1,0,1,0,0,0,0,0,0,1,0,'Giáo Trình','An toàn thông tin','Ai đó',NULL),('f80840b7-379e-4c18-8297-6ff673ec357e','Toán Siêu cao cấp',1,0,1,0,0,0,0,0,0,1,0,'Đồ án','An toàn thông tin','Toán học thế giới',NULL);
/*!40000 ALTER TABLE `statistics` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
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
-- Table structure for table `status_booking`
--

DROP TABLE IF EXISTS `status_booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_status_name` varchar(255) CHARACTER SET utf8 DEFAULT '"Lỗi"',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_booking`
--

LOCK TABLES `status_booking` WRITE;
/*!40000 ALTER TABLE `status_booking` DISABLE KEYS */;
INSERT INTO `status_booking` VALUES (0,'Chờ hẹn ngày '),(1,'Chờ xử lý'),(2,'Chờ đến nhận'),(3,'Ngoại lệ'),(4,'Bị từ chối'),(5,'Đã lấy tài liệu');
/*!40000 ALTER TABLE `status_booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suggest_document`
--

DROP TABLE IF EXISTS `suggest_document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suggest_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_name` varchar(255) NOT NULL,
  `left` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suggest_document`
--

LOCK TABLES `suggest_document` WRITE;
/*!40000 ALTER TABLE `suggest_document` DISABLE KEYS */;
INSERT INTO `suggest_document` VALUES (1,'Tiếng Anh chuyên nghành',31,NULL,NULL,NULL,NULL),(2,'Vật lý đại cương',50,NULL,NULL,NULL,NULL),(3,'Toán cao cấp A1',200,NULL,NULL,NULL,NULL),(4,'Toán cao cấp A3',130,NULL,NULL,NULL,NULL),(5,'Tin học cơ sở',0,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `suggest_document` ENABLE KEYS */;
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
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('15','Quản trị viên','admin','$2y$10$l5HQM/0E6ZjifR4P22egU.MTWetZ.qah5stgnKjcCUbxGbuTDtGlC','d80CbqOgfqFL6ocnDlkhQpQLmytJCjoY3t6AnmwQYPBI3tttBN20J4Yfvewu',NULL,'2018-06-19 06:19:01','Admin','https://www.koolbadges.co.uk/images/thumbnails/i-love-admin-badges-200x200.jpg','Admin TÉ','AT12','Admin',NULL,'admin','Phổ thông'),('17','Sinh viên 1','studentAT','$2y$10$NExL.YZRPTdWh9jSfPTgXOhj/vUKpMLHlbm1ARAPni4VONdGXAOD2',NULL,'2018-06-17 19:47:59','2018-06-17 19:48:33','Sinh viên','http://attt.com','Hà Nội','AT12','2015-2020','admin','admin','An toàn thông tin'),('2','Nguyễn Văn Luân','AT120633','$2y$10$ZUxHX5Ed5q9MNbf8aLdLTu7VNnx8cDi/N28h.Pc3CYBg8wWRuypPy','e47wMn1n0wYj1YPNJa9HDlRmoc6izYQjhihc8wN4DKDYA1oMobvFbYJgs4rz',NULL,'2018-06-19 06:14:20','An Toàn Thông tin','https://ffp4g1ylyit3jdyti1hqcvtb-wpengine.netdna-ssl.com/theden/files/2013/06/fb_social_avatar_403x403-160x160.png',NULL,NULL,NULL,NULL,NULL,NULL),('3','Văn A','MM120633','$2y$12$/8sk1Nj1Zq5Z6QEPrKpmheGvhULGvuBwAaLveoFoCZ3CB8JeJnPPW',NULL,NULL,NULL,'Hệ Mật mã','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTc6G7wgrOcCtSDp2uIvDbI6oDk2wdYSFFvwlfLAIoQNTeGASIT',NULL,NULL,NULL,NULL,NULL,NULL),('4','Thầy Sơn','GV01','$2y$12$/8sk1Nj1Zq5Z6QEPrKpmheGvhULGvuBwAaLveoFoCZ3CB8JeJnPPW',NULL,NULL,NULL,'Giáo Viên','http://pixel.nymag.com/imgs/custom/tvrecaps/recaps-the-legend-of-korra-160x160.w80.h80.2x.png',NULL,NULL,NULL,NULL,NULL,NULL),('ac01762b-ef2f-4179-922d-0c67be9dd632','Lý Đức Long','AT120632','$2y$10$urNA8RfsNIVM.bGnVun/nuwvgG.bKvR74XgIeIn6SvdCYMumW1Fpe','urlD2NmScK10uRziOiQQHYKaCsDZWl1xFhGb5LHoj0gaeEKWKXH3UZuCafGU','2018-10-14 22:51:39','2018-10-14 22:51:39','Sinh viên','https://photo-zmp3.zadn.vn/thumb/240_240/avatars/e/0/e06d061a77a7bde916b8a91163029d41_1458013595.jpg','Hà  Nội','AT12G','2015-2020','admin',NULL,'An toàn thông tin');
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

-- Dump completed on 2018-10-25 13:41:11
