/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.7.2-MariaDB, for osx10.20 (arm64)
--
-- Host: mysql.danielhsu.dev    Database: project_hubd
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `banner`
--

DROP TABLE IF EXISTS `banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `banner` (
  `banner_id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `banner_title` varchar(50) DEFAULT NULL,
  `banner_img` varchar(255) DEFAULT NULL,
  `banner_description` varchar(100) DEFAULT NULL,
  `banner_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banner`
--

LOCK TABLES `banner` WRITE;
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
INSERT INTO `banner` VALUES
(1,'★ DIY 銀黏土戒指 ★','banners/banner1.jpg','這裡是專屬你的手工飾品小天地！融合創意與心意，讓飾品不只是點綴，更是展現個性的魔法！','http://localhost/client-side/public/lessons','2025-03-17 18:26:13','2025-04-01 01:53:40'),
(2,'★ 週年慶優惠 ★','banners/banner2.jpg','HUBD 兩歲了（撒花）！為了慶祝這個特別的日子，3/20-4/20 期間，購物車結帳金額全面打九折，不要錯過！','http://localhost/client-side/public/categories_accessories','2025-03-17 18:26:13','2025-03-20 06:36:08'),
(3,'★ 春夏新裝到貨 ★','banners/banner3.jpg','黑灰白低調色大好き！換季時尚夏裝全面販售中，邀請大家一起穿出 2025 新氣象！非生日，也快樂！','http://localhost/client-side/public/categories_clothes','2025-03-17 18:26:13','2025-03-20 06:36:23');
/*!40000 ALTER TABLE `banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign_participants`
--

DROP TABLE IF EXISTS `campaign_participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `campaign_participants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `order_id` bigint(20) unsigned DEFAULT NULL,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('pending','completed','cancelled') NOT NULL DEFAULT 'pending',
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `campaign_participants_campaign_id_foreign` (`campaign_id`),
  CONSTRAINT `campaign_participants_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign_participants`
--

LOCK TABLES `campaign_participants` WRITE;
/*!40000 ALTER TABLE `campaign_participants` DISABLE KEYS */;
/*!40000 ALTER TABLE `campaign_participants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaigns`
--

DROP TABLE IF EXISTS `campaigns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `campaigns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` enum('discount','buy_x_get_y','bundle','flash_sale','free_shipping') NOT NULL,
  `discount_method` enum('percentage','fixed') DEFAULT NULL,
  `discount_value` decimal(10,2) DEFAULT NULL,
  `buy_quantity` int(11) DEFAULT NULL,
  `free_quantity` int(11) DEFAULT NULL,
  `bundle_quantity` int(11) DEFAULT NULL,
  `bundle_discount` decimal(10,2) DEFAULT NULL,
  `flash_sale_start_time` timestamp NULL DEFAULT NULL,
  `flash_sale_end_time` timestamp NULL DEFAULT NULL,
  `flash_sale_discount` decimal(10,2) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `stock_limit` int(11) DEFAULT NULL,
  `per_user_limit` int(11) DEFAULT NULL,
  `applicable_products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`applicable_products`)),
  `applicable_categories` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`applicable_categories`)),
  `users` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`users`)),
  `description` text DEFAULT NULL,
  `status` enum('active','disabled') NOT NULL DEFAULT 'active',
  `can_combine` tinyint(1) NOT NULL DEFAULT 0,
  `redemption_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaigns`
--

LOCK TABLES `campaigns` WRITE;
/*!40000 ALTER TABLE `campaigns` DISABLE KEYS */;
INSERT INTO `campaigns` VALUES
(8,'暑期全館8折','discount','percentage',20.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-23','2025-08-31',NULL,NULL,'[{\"id\":\"SPEC202503270801345791\",\"spec_id\":\"SPEC202503270801345791\",\"product_id\":\"pa001\",\"product_main_id\":\"pa001\",\"name\":\"Navajo \\u7da0\\u677e\\u77f3\\u5341\\u5b57\\u661f\\u6212\",\"sku\":\"SPEC202503270801345791\",\"price\":5980,\"color\":null,\"size\":null,\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/accessories\\/pa001_00_01.jpg\",\"stock\":5,\"description\":null}]','[]','[]','暑期特惠，全館商品8折起','active',0,0,'2025-03-23 03:40:29','2025-03-27 17:42:11'),
(9,'快閃6折特賣','flash_sale','percentage',40.00,NULL,NULL,NULL,NULL,'2023-09-15 02:00:00','2023-09-15 14:00:00',40.00,'2023-09-15','2023-09-15',100,2,'[{\"id\":2,\"name\":\"\\u9650\\u91cf\\u806f\\u540d\\u5e06\\u5e03\\u5305\",\"price\":1200}]','[]',NULL,'限時12小時，精選商品6折特賣','active',0,0,'2025-03-23 03:40:45','2025-03-23 03:42:10'),
(10,'配件三件85折','bundle',NULL,NULL,NULL,NULL,3,15.00,NULL,NULL,NULL,'2025-03-23','2025-10-31',NULL,NULL,'[]','[]','[{\"id\":10,\"name\":\"\\u8a31\\u5927\\u7c73\",\"email\":\"pollylearnhsu@gmail.com\",\"phone\":null,\"created_at\":\"2025-03-11T07:25:57.000000Z\"},{\"id\":19,\"name\":\"\\u8a31\\u5c11\\u5b87\",\"email\":\"nasa0824@gmail.com\",\"phone\":null,\"created_at\":\"2025-03-13 06:54:28\"}]','配件任選三件，享85折優惠','active',0,0,'2025-03-23 03:40:53','2025-03-27 17:46:12'),
(11,'指定商品買1送1','buy_x_get_y',NULL,NULL,1,1,NULL,NULL,NULL,NULL,NULL,'2023-11-01','2023-11-30',NULL,NULL,'[{\"id\":3,\"name\":\"\\u82b3\\u9999\\u881f\\u71ed\",\"price\":450},{\"id\":4,\"name\":\"\\u7cbe\\u6cb9\\u64f4\\u9999\\u74f6\",\"price\":580}]','[]',NULL,'指定家居商品買一送一優惠','active',0,0,'2025-03-23 03:41:02','2025-03-23 03:42:25'),
(12,'全館服飾 95 折','discount','percentage',5.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-25','2025-04-25',NULL,NULL,'[]','[{\"id\":\"parent_\\u670d\\u98fe\",\"name\":\"\\u670d\\u98fe\",\"parent_category\":null,\"child_category\":null}]','[]',NULL,'active',0,0,'2025-03-24 19:29:12','2025-03-24 19:29:12'),
(14,'指定分類商品95折','discount','percentage',10.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-28','2025-04-28',NULL,NULL,'[{\"id\":\"SPEC202503270801345791\",\"spec_id\":\"SPEC202503270801345791\",\"product_id\":\"pa001\",\"product_main_id\":\"pa001\",\"name\":\"Navajo \\u7da0\\u677e\\u77f3\\u5341\\u5b57\\u661f\\u6212\",\"sku\":\"SPEC202503270801345791\",\"price\":5980,\"color\":null,\"size\":null,\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/accessories\\/pa001_00_01.jpg\",\"stock\":5,\"category_name\":null,\"description\":null,\"_debug_info\":\"product_id: pa001, spec_id: SPEC202503270801345791, stock: 5\"},{\"id\":\"SPEC202503271307152643\",\"spec_id\":\"SPEC202503271307152643\",\"product_id\":\"pa002\",\"product_main_id\":\"pa002\",\"name\":\"Navajo \\u86cb\\u767d\\u77f3\\u92fc\\u5370\\u6212\",\"sku\":\"SPEC202503271307152643\",\"price\":4590,\"color\":null,\"size\":null,\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/accessories\\/pa002_00_01.jpg\",\"stock\":5,\"category_name\":null,\"description\":null,\"_debug_info\":\"product_id: pa002, spec_id: SPEC202503271307152643, stock: 5\"},{\"id\":\"3\",\"spec_id\":\"3\",\"product_id\":\"pa003\",\"product_main_id\":\"pa003\",\"name\":\"Opal \\u86cb\\u767d\\u77f3\\u81d8\\u96d5\\u7d14\\u9280\\u6212\",\"sku\":\"3\",\"price\":4350,\"color\":null,\"size\":null,\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/accessories\\/pa003_00_01.jpg\",\"stock\":5,\"category_name\":null,\"description\":\"925 silver | natural opal | metric circumference No.10\\uff08\\u516c\\u5236\\u570d10\\u865f\\uff09\",\"_debug_info\":\"product_id: pa003, spec_id: 3, stock: 5\"}]','[{\"id\":\"parent_\\u98fe\\u54c1\",\"name\":\"\\u98fe\\u54c1\",\"parent_category\":null,\"child_category\":null},{\"id\":101,\"name\":\"\\u77ed\\u8896\",\"parent_category\":\"\\u670d\\u98fe\",\"child_category\":null}]','[{\"id\":10,\"name\":\"\\u8a31\\u5927\\u7c73\",\"email\":\"pollylearnhsu@gmail.com\",\"phone\":null,\"created_at\":\"2025-03-11T07:25:57.000000Z\"}]',NULL,'active',0,0,'2025-03-27 18:14:12','2025-03-27 18:14:12');
/*!40000 ALTER TABLE `campaigns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `product_id` varchar(100) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `product_color` varchar(11) DEFAULT NULL,
  `product_size` varchar(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES
('pl002','半拉鍊 高領長袖',19,3,'White','M','2025-03-24 23:27:21','2025-03-31 03:31:28'),
('pj001','斜紋軟呢無領外套',22,10,'Black','S','2025-03-30 19:47:05','2025-03-31 08:22:19'),
('pj001','斜紋軟呢無領外套',22,10,'Black','S','2025-03-30 19:56:49','2025-03-31 08:22:19'),
('pj001','斜紋軟呢無領外套',22,10,'Black','S','2025-03-30 20:15:49','2025-03-31 08:22:19'),
('pl002','半拉鍊 高領長袖',20,4,'Black','S','2025-03-31 00:50:17','2025-03-31 00:50:17'),
('ps002','不對稱異素材上衣',20,4,'Black','S','2025-03-31 03:19:42','2025-03-31 03:19:43');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cash_flow_settings`
--

DROP TABLE IF EXISTS `cash_flow_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cash_flow_settings` (
  `name` varchar(50) NOT NULL,
  `Hash_Key` varchar(50) NOT NULL,
  `Hash_IV` varchar(50) NOT NULL,
  `merchant_ID` varchar(50) NOT NULL,
  `WEB_enable` tinyint(1) NOT NULL,
  `CVS_enable` tinyint(1) NOT NULL,
  `ATM_enable` tinyint(1) NOT NULL,
  `credit_enable` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cash_flow_settings`
--

LOCK TABLES `cash_flow_settings` WRITE;
/*!40000 ALTER TABLE `cash_flow_settings` DISABLE KEYS */;
INSERT INTO `cash_flow_settings` VALUES
('ECPAY','pwFHCqoQZGmho4w6','EkRm7iFT261dpevs','3002607',0,0,1,1,'2025-03-17 18:31:44','2025-03-24 22:34:42');
/*!40000 ALTER TABLE `cash_flow_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupon_usages`
--

DROP TABLE IF EXISTS `coupon_usages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `coupon_usages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `coupon_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `order_id` bigint(20) unsigned DEFAULT NULL,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `used_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coupon_usages_coupon_id_foreign` (`coupon_id`),
  CONSTRAINT `coupon_usages_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupon_usages`
--

LOCK TABLES `coupon_usages` WRITE;
/*!40000 ALTER TABLE `coupon_usages` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupon_usages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `coupons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `discount_type` enum('percentage','fixed','shipping','buy_x_get_y') NOT NULL,
  `discount_value` decimal(10,2) DEFAULT NULL,
  `min_purchase` decimal(10,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `usage_limit` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`products`)),
  `categories` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`categories`)),
  `users` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`users`)),
  `applicable_products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`applicable_products`)),
  `applicable_categories` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`applicable_categories`)),
  `buy_quantity` int(11) DEFAULT NULL,
  `free_quantity` int(11) DEFAULT NULL,
  `status` enum('active','disabled','expired') NOT NULL DEFAULT 'active',
  `can_combine` tinyint(1) NOT NULL DEFAULT 0,
  `usage_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES
(1,'2025年4月生日券','BIRTH2504','fixed',200.00,NULL,'2025-04-21','2025-05-30',NULL,NULL,'[]','[]','[{\"id\":19,\"name\":\"\\u8a31\\u5c11\\u5b87\",\"email\":\"nasa0824@gmail.com\",\"phone\":null,\"created_at\":\"2025-03-13 06:54:28\"},{\"id\":20,\"name\":\"\\u8a31\",\"email\":\"daniel@danielhsu.dev\",\"phone\":null,\"created_at\":\"2025-03-13 07:27:40\"},{\"id\":10,\"name\":\"\\u8a31\\u5927\\u7c73\",\"email\":\"pollylearnhsu@gmail.com\",\"phone\":null,\"created_at\":\"2025-03-11T07:25:57.000000Z\"}]','[]','[]',NULL,NULL,'active',0,0,'2025-03-23 04:44:09','2025-03-27 19:02:10'),
(2,'新客首購85折','NEWUSER15','percentage',15.00,500.00,'2025-03-23','2025-12-31',1,'新用戶註冊後首次購物可享85折優惠','[]','[]','[{\"id\":10,\"name\":\"\\u8a31\\u5927\\u7c73\",\"email\":\"pollylearnhsu@gmail.com\",\"phone\":null,\"created_at\":\"2025-03-11T07:25:57.000000Z\"},{\"id\":20,\"name\":\"\\u8a31\",\"email\":\"daniel@danielhsu.dev\",\"phone\":\"0912345678\",\"created_at\":\"2025-03-13T07:27:40.000000Z\"}]','[]','[]',NULL,NULL,'active',0,0,'2025-03-23 03:40:01','2025-03-27 23:28:33'),
(3,'週年慶滿千折百','ANNIV100','fixed',100.00,1000.00,'2025-03-23','2025-04-30',3,'週年慶期間，單筆消費滿1000元，立即折抵100元','[]','[]','[]',NULL,NULL,NULL,NULL,'active',0,0,'2025-03-23 03:40:07','2025-03-23 03:42:39'),
(4,'399折價券','FIXED100','fixed',399.00,NULL,NULL,NULL,NULL,'399折100','[]','[]','[]','[]','[]',NULL,NULL,'active',0,0,'2025-03-23 07:55:06','2025-03-27 22:48:10'),
(16,'NRP外套95折','NRPJ95PERC','percentage',9.00,NULL,NULL,NULL,NULL,NULL,'[]','[]','[]','[{\"id\":\"89\",\"spec_id\":\"89\",\"product_id\":\"pj006\",\"product_main_id\":\"pj006\",\"name\":\"NRP \\u7fbd\\u7d68\\u5916\\u5957\",\"sku\":\"89\",\"price\":\"10600\",\"color\":\"Black\",\"size\":\"S\",\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/clothes\\/jackets\\/pj006_03_01.jpg\",\"stock\":20,\"category_name\":null,\"description\":null,\"_debug_info\":\"product_id: pj006, spec_id: 89, stock: 20\"},{\"id\":\"90\",\"spec_id\":\"90\",\"product_id\":\"pj006\",\"product_main_id\":\"pj006\",\"name\":\"NRP \\u7fbd\\u7d68\\u5916\\u5957\",\"sku\":\"90\",\"price\":\"10600\",\"color\":\"Black\",\"size\":\"M\",\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/clothes\\/jackets\\/pj006_03_01.jpg\",\"stock\":20,\"category_name\":null,\"description\":null,\"_debug_info\":\"product_id: pj006, spec_id: 90, stock: 20\"},{\"id\":\"92\",\"spec_id\":\"92\",\"product_id\":\"pj006\",\"product_main_id\":\"pj006\",\"name\":\"NRP \\u7fbd\\u7d68\\u5916\\u5957\",\"sku\":\"92\",\"price\":\"10600\",\"color\":\"White\",\"size\":\"S\",\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/clothes\\/jackets\\/pj006_03_01.jpg\",\"stock\":20,\"category_name\":null,\"description\":null,\"_debug_info\":\"product_id: pj006, spec_id: 92, stock: 20\"},{\"id\":\"93\",\"spec_id\":\"93\",\"product_id\":\"pj006\",\"product_main_id\":\"pj006\",\"name\":\"NRP \\u7fbd\\u7d68\\u5916\\u5957\",\"sku\":\"93\",\"price\":\"10600\",\"color\":\"White\",\"size\":\"M\",\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/clothes\\/jackets\\/pj006_03_01.jpg\",\"stock\":20,\"category_name\":null,\"description\":null,\"_debug_info\":\"product_id: pj006, spec_id: 93, stock: 20\"},{\"id\":\"94\",\"spec_id\":\"94\",\"product_id\":\"pj006\",\"product_main_id\":\"pj006\",\"name\":\"NRP \\u7fbd\\u7d68\\u5916\\u5957\",\"sku\":\"94\",\"price\":\"10600\",\"color\":\"White\",\"size\":\"L\",\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/clothes\\/jackets\\/pj006_03_01.jpg\",\"stock\":20,\"category_name\":null,\"description\":null,\"_debug_info\":\"product_id: pj006, spec_id: 94, stock: 20\"},{\"id\":\"91\",\"spec_id\":\"91\",\"product_id\":\"pj006\",\"product_main_id\":\"pj006\",\"name\":\"NRP \\u7fbd\\u7d68\\u5916\\u5957\",\"sku\":\"91\",\"price\":10600,\"color\":\"Black\",\"size\":\"L\",\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/clothes\\/jackets\\/pj006_03_01.jpg\",\"stock\":20,\"category_name\":null,\"description\":\"\\u63a1\\u7528\\u7fbd\\u7d68\\u88dc\\u4e01\\u8a2d\\u8a08\\uff0c\\u76f8\\u7576\\u84ec\\u9b06\\u67d4\\u8edf\\uff0c\\u5167\\u5074\\u62bd\\u7e69\\u8a2d\\u8a08\\u53ef\\u5f62\\u5851\\u8170\\u7dda\\uff0c\\u9632\\u98a8\\u6548\\u679c\\u4f73\\uff0c\\u9069\\u5408\\u8cfc\\u5165\\u504f\\u5927\\u7684\\u5c3a\\u5bf8\\uff0c\\u5728\\u79cb\\u51ac\\u5b63\\u7bc0\\u7a7f\\u8457\",\"_debug_info\":\"product_id: pj006, spec_id: 91, stock: 20\"}]','[]',NULL,NULL,'active',0,0,'2025-03-23 08:37:29','2025-03-27 18:04:13'),
(18,'買二送一','BUY2GET1','buy_x_get_y',NULL,0.00,'2023-09-01','2023-09-30',5,'指定商品買2件送1件，最低價商品免費','[{\"id\":1,\"name\":\"\\u57fa\\u790e\\u6b3eT\\u6064\",\"price\":590}]','[]','[]',NULL,NULL,2,1,'active',0,0,'2025-03-23 03:40:14','2025-03-23 03:41:51'),
(20,'全館免運','FREESHIP','shipping',NULL,1500.00,'2023-11-11','2023-11-12',0,'雙11限定，全館滿1500元免運費','[]','[]','[{\"id\":19,\"name\":\"\\u8a31\\u5c11\\u5b87\",\"email\":\"nasa0824@gmail.com\",\"phone\":null,\"created_at\":\"2025-03-13 06:54:28\"}]',NULL,NULL,NULL,NULL,'disabled',0,0,'2025-03-23 03:40:21','2025-03-23 04:32:44'),
(23,'限定會員指定商品優惠','ULIMIT100','fixed',100.00,NULL,NULL,NULL,NULL,NULL,'[]','[]','[{\"id\":20,\"name\":\"\\u8a31\",\"email\":\"daniel@danielhsu.dev\",\"phone\":\"0912345678\",\"created_at\":\"2025-03-13T07:27:40.000000Z\"},{\"id\":19,\"name\":\"\\u8a31\\u5c11\\u5b87\",\"email\":\"nasa0824@gmail.com\",\"phone\":\"0910305411\",\"created_at\":\"2025-03-13T06:54:28.000000Z\"}]','[{\"id\":\"65\",\"spec_id\":\"65\",\"product_id\":\"pj002\",\"product_main_id\":\"pj002\",\"name\":\"\\u7f8a\\u7f94\\u7d68\\u5916\\u5957\",\"sku\":\"65\",\"price\":3540,\"color\":\"Grey\",\"size\":\"S\",\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/clothes\\/jackets\\/pj002_02_01.jpg\",\"stock\":20,\"description\":null},{\"id\":\"66\",\"spec_id\":\"66\",\"product_id\":\"pj002\",\"product_main_id\":\"pj002\",\"name\":\"\\u7f8a\\u7f94\\u7d68\\u5916\\u5957\",\"sku\":\"66\",\"price\":3540,\"color\":\"Grey\",\"size\":\"M\",\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/clothes\\/jackets\\/pj002_02_01.jpg\",\"stock\":20,\"description\":null},{\"id\":\"67\",\"spec_id\":\"67\",\"product_id\":\"pj002\",\"product_main_id\":\"pj002\",\"name\":\"\\u7f8a\\u7f94\\u7d68\\u5916\\u5957\",\"sku\":\"67\",\"price\":3540,\"color\":\"Grey\",\"size\":\"L\",\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/clothes\\/jackets\\/pj002_02_01.jpg\",\"stock\":20,\"description\":null},{\"id\":\"68\",\"spec_id\":\"68\",\"product_id\":\"pj002\",\"product_main_id\":\"pj002\",\"name\":\"\\u7f8a\\u7f94\\u7d68\\u5916\\u5957\",\"sku\":\"68\",\"price\":3540,\"color\":\"White\",\"size\":\"S\",\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/clothes\\/jackets\\/pj002_02_01.jpg\",\"stock\":20,\"description\":null},{\"id\":\"69\",\"spec_id\":\"69\",\"product_id\":\"pj002\",\"product_main_id\":\"pj002\",\"name\":\"\\u7f8a\\u7f94\\u7d68\\u5916\\u5957\",\"sku\":\"69\",\"price\":3540,\"color\":\"White\",\"size\":\"M\",\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/clothes\\/jackets\\/pj002_02_01.jpg\",\"stock\":20,\"description\":null},{\"id\":\"70\",\"spec_id\":\"70\",\"product_id\":\"pj002\",\"product_main_id\":\"pj002\",\"name\":\"\\u7f8a\\u7f94\\u7d68\\u5916\\u5957\",\"sku\":\"70\",\"price\":3540,\"color\":\"White\",\"size\":\"L\",\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/clothes\\/jackets\\/pj002_02_01.jpg\",\"stock\":20,\"description\":null},{\"id\":\"77\",\"spec_id\":\"77\",\"product_id\":\"pj004\",\"product_main_id\":\"pj004\",\"name\":\"\\u8170\\u90e8\\u62bd\\u7e69\\u5916\\u5957\",\"sku\":\"77\",\"price\":3540,\"color\":\"Grey\",\"size\":\"S\",\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/clothes\\/jackets\\/pj004_03_01.jpg\",\"stock\":20,\"description\":null},{\"id\":\"78\",\"spec_id\":\"78\",\"product_id\":\"pj004\",\"product_main_id\":\"pj004\",\"name\":\"\\u8170\\u90e8\\u62bd\\u7e69\\u5916\\u5957\",\"sku\":\"78\",\"price\":3540,\"color\":\"Grey\",\"size\":\"M\",\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/clothes\\/jackets\\/pj004_03_01.jpg\",\"stock\":20,\"description\":null},{\"id\":\"79\",\"spec_id\":\"79\",\"product_id\":\"pj004\",\"product_main_id\":\"pj004\",\"name\":\"\\u8170\\u90e8\\u62bd\\u7e69\\u5916\\u5957\",\"sku\":\"79\",\"price\":3540,\"color\":\"Grey\",\"size\":\"L\",\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/clothes\\/jackets\\/pj004_03_01.jpg\",\"stock\":20,\"description\":null},{\"id\":\"80\",\"spec_id\":\"80\",\"product_id\":\"pj004\",\"product_main_id\":\"pj004\",\"name\":\"\\u8170\\u90e8\\u62bd\\u7e69\\u5916\\u5957\",\"sku\":\"80\",\"price\":3540,\"color\":\"White\",\"size\":\"S\",\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/clothes\\/jackets\\/pj004_03_01.jpg\",\"stock\":20,\"description\":null},{\"id\":\"81\",\"spec_id\":\"81\",\"product_id\":\"pj004\",\"product_main_id\":\"pj004\",\"name\":\"\\u8170\\u90e8\\u62bd\\u7e69\\u5916\\u5957\",\"sku\":\"81\",\"price\":3540,\"color\":\"White\",\"size\":\"M\",\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/clothes\\/jackets\\/pj004_03_01.jpg\",\"stock\":20,\"description\":null},{\"id\":\"82\",\"spec_id\":\"82\",\"product_id\":\"pj004\",\"product_main_id\":\"pj004\",\"name\":\"\\u8170\\u90e8\\u62bd\\u7e69\\u5916\\u5957\",\"sku\":\"82\",\"price\":3540,\"color\":\"White\",\"size\":\"L\",\"image\":\"http:\\/\\/localhost:8000\\/storage\\/products\\/clothes\\/jackets\\/pj004_03_01.jpg\",\"stock\":20,\"description\":null}]','[{\"id\":101,\"name\":\"\\u77ed\\u8896\",\"parent_category\":\"\\u670d\\u98fe\",\"child_category\":null}]',NULL,NULL,'active',0,0,'2025-03-27 18:15:30','2025-03-30 18:06:40');
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daily_reconciliations`
--

DROP TABLE IF EXISTS `daily_reconciliations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `daily_reconciliations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reconciliation_number` varchar(255) NOT NULL COMMENT '對帳編號',
  `reconciliation_date` date NOT NULL COMMENT '對帳日期',
  `transaction_count` int(11) NOT NULL DEFAULT 0 COMMENT '交易筆數',
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT '總金額',
  `total_fee` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT '總手續費',
  `total_net_amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT '總淨收入',
  `status` enum('normal','abnormal','pending') NOT NULL DEFAULT 'pending' COMMENT '對帳狀態',
  `staff_id` bigint(20) unsigned DEFAULT NULL COMMENT '操作人員ID',
  `staff_name` varchar(255) DEFAULT NULL COMMENT '操作人員姓名',
  `notes` text DEFAULT NULL COMMENT '備註',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `daily_reconciliations_reconciliation_number_unique` (`reconciliation_number`),
  KEY `daily_reconciliations_reconciliation_date_index` (`reconciliation_date`),
  KEY `daily_reconciliations_status_index` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_reconciliations`
--

LOCK TABLES `daily_reconciliations` WRITE;
/*!40000 ALTER TABLE `daily_reconciliations` DISABLE KEYS */;
INSERT INTO `daily_reconciliations` VALUES
(1,'20250221309974','2025-02-21',17,25593.31,563.54,25029.77,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:09','2025-03-23 18:27:09'),
(2,'20250222192103','2025-02-22',25,45345.76,898.65,44447.11,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:09','2025-03-23 18:27:09'),
(3,'20250223519919','2025-02-23',21,30642.26,515.48,30126.78,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:09','2025-03-23 18:27:09'),
(4,'20250224894385','2025-02-24',36,59825.34,1164.98,58660.37,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:09','2025-03-23 18:27:09'),
(5,'20250225143725','2025-02-25',25,36557.30,742.01,35815.29,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:09','2025-03-23 18:27:09'),
(6,'20250226389548','2025-02-26',33,51835.48,1112.29,50723.20,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:09','2025-03-23 18:27:09'),
(7,'20250227335979','2025-02-27',29,40489.21,846.75,39642.46,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:09','2025-03-23 18:27:09'),
(8,'20250228142348','2025-02-28',34,55547.06,1091.44,54455.62,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:10','2025-03-23 18:27:10'),
(9,'20250303727220','2025-03-03',35,64765.45,1397.74,63367.71,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:10','2025-03-23 18:27:10'),
(10,'20250304021464','2025-03-04',18,25848.60,470.87,25377.73,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:10','2025-03-23 18:27:10'),
(11,'20250305528882','2025-03-05',2,1627.51,27.38,1600.13,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:10','2025-03-23 18:27:10'),
(12,'20250306687931','2025-03-06',11,19966.14,381.95,19584.19,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:10','2025-03-23 18:27:10'),
(13,'20250307304240','2025-03-07',6,6752.15,139.20,6612.95,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:10','2025-03-23 18:27:10'),
(14,'20250308060788','2025-03-08',8,18311.16,331.53,17979.65,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:10','2025-03-23 18:27:10'),
(15,'20250309926566','2025-03-09',12,22673.12,397.77,22275.35,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:11','2025-03-23 18:27:11'),
(16,'20250310179369','2025-03-10',19,29491.46,604.32,28887.14,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:11','2025-03-23 18:27:11'),
(17,'20250311462360','2025-03-11',6,9945.20,185.65,9759.55,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:11','2025-03-23 18:27:11'),
(18,'20250312389276','2025-03-12',10,12247.70,270.90,11976.80,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:11','2025-03-23 18:27:11'),
(19,'20250313975588','2025-03-13',20,28656.95,543.55,28113.40,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:11','2025-03-23 18:27:11'),
(20,'20250314911605','2025-03-14',11,17514.43,391.67,17122.76,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:11','2025-03-23 18:27:11'),
(21,'20250315021606','2025-03-15',10,15432.34,302.77,15129.57,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:11','2025-03-23 18:27:11'),
(22,'20250317965457','2025-03-17',1,23732.00,0.00,23732.00,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:11','2025-03-23 18:27:11'),
(23,'20250319597148','2025-03-19',3,174606.00,0.00,174606.00,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:12','2025-03-23 18:27:12'),
(24,'20250320593282','2025-03-20',3,192156.00,0.00,192156.00,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:12','2025-03-23 18:27:12'),
(25,'20250322956671','2025-03-22',3,88746.00,0.00,88746.00,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:12','2025-03-23 18:27:12'),
(26,'20250324970548','2025-03-24',443,1157612.93,13501.31,1144111.66,'normal',1,'System','系統自動生成的對帳記錄','2025-03-23 18:27:12','2025-03-23 18:27:12');
/*!40000 ALTER TABLE `daily_reconciliations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maintenance`
--

DROP TABLE IF EXISTS `maintenance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `maintenance` (
  `maintain_status` int(11) NOT NULL,
  `maintain_description` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`maintain_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maintenance`
--

LOCK TABLES `maintenance` WRITE;
/*!40000 ALTER TABLE `maintenance` DISABLE KEYS */;
INSERT INTO `maintenance` VALUES
(1,'親愛的顧客，感謝您長期以來的支持！為了慶祝周年慶，我們將於近期暫時關閉網站進行升級與維護。敬請留意我們的開放時間，期待與您再度相見！','2025-02-11','2025-04-22');
/*!40000 ALTER TABLE `maintenance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `members` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2025_03_06_052803_create_personal_access_tokens_table',1),
(5,'2025_03_13_023216_create_members_table',2),
(6,'2025_03_13_055321_add_fields_to_users_table',2),
(7,'2025_03_17_181946_add_timestamps_to_banner_table',3),
(8,'2025_03_17_182219_add_timestamps_to_product_spec_table',4),
(9,'2025_03_20_032306_add_spec_id_to_product_spec',5),
(10,'2025_03_17_041536_create_coupons_table',6),
(11,'2025_03_17_041621_create_campaigns_table',6),
(12,'2025_03_18_042334_create_coupon_usages_table',6),
(13,'2025_03_18_042413_create_campaign_participants_table',6),
(14,'2025_03_22_100754_create_products_table',7),
(15,'2025_03_22_100300_create_coupon_product_table',8),
(16,'2025_03_22_100304_create_coupon_category_table',9),
(17,'2025_03_22_100309_create_coupon_user_table',10),
(18,'2025_03_22_100313_create_campaign_product_table',11),
(19,'2025_03_22_100317_create_campaign_category_table',12),
(20,'2025_03_22_100322_create_campaign_user_table',13),
(21,'2025_03_22_100326_update_coupons_and_campaigns_table',14),
(22,'2025_03_22_104648_update_coupon_and_campaign_category_table',15),
(23,'2025_03_22_104931_drop_and_recreate_coupon_product_table',16),
(24,'2025_03_23_133538_add_applicable_fields_to_coupons_table',17),
(25,'2025_03_24_100034_alter_order_main_for_reconciliation',18),
(26,'2025_03_24_100038_create_reconciliations_table',19),
(27,'2025_03_28_060430_update_coupons_table_for_client_side',20),
(28,'2025_03_28_055859_create_coupon_usages_table',21);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_detail` (
  `order_id` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_size` varchar(10) DEFAULT NULL,
  `product_color` varchar(10) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `product_price` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `order_detail_order_main_FK` (`order_id`),
  CONSTRAINT `order_detail_order_main_FK` FOREIGN KEY (`order_id`) REFERENCES `order_main` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_detail`
--

LOCK TABLES `order_detail` WRITE;
/*!40000 ALTER TABLE `order_detail` DISABLE KEYS */;
INSERT INTO `order_detail` VALUES
('601','女裝百褶拼接寬鬆上衣','S','Black',1,1640,'2025-03-16 22:02:52','2025-03-16 22:02:52'),
('707','女裝百褶拼接寬鬆上衣','S','Grey',24,1640,'2025-03-18 22:09:40','2025-03-18 22:09:40'),
('707','女裝不對稱異素材上衣','L','Black',9,1380,'2025-03-18 22:09:40','2025-03-18 22:09:40'),
('821','女裝百褶拼接寬鬆上衣','L','Black',30,1640,'2025-03-18 22:49:41','2025-03-18 22:49:41'),
('821','女裝不對稱異素材上衣','L','Grey',16,1380,'2025-03-18 22:49:41','2025-03-18 22:49:41'),
('676','女裝百褶拼接寬鬆上衣','L','Black',30,1640,'2025-03-19 22:11:01','2025-03-19 22:11:01'),
('676','女裝不對稱異素材上衣','L','Grey',16,1380,'2025-03-19 22:11:01','2025-03-19 22:11:01'),
('883','女裝百褶拼接寬鬆上衣','L','Black',30,1640,'2025-03-19 22:11:01','2025-03-19 22:11:01'),
('883','女裝不對稱異素材上衣','L','Grey',16,1380,'2025-03-19 22:11:01','2025-03-19 22:11:01'),
('570','女裝百褶拼接寬鬆上衣','M','Black',2,1640,'2025-03-22 01:36:22','2025-03-22 01:36:22'),
('570','斜紋軟呢無領外套','L','Black',3,9900,'2025-03-22 01:36:22','2025-03-22 01:36:22'),
('441','女裝百褶拼接寬鬆上衣','M','Black',2,1640,'2025-03-22 01:43:30','2025-03-22 01:43:30'),
('441','斜紋軟呢無領外套','L','Black',3,9900,'2025-03-22 01:43:30','2025-03-22 01:43:30'),
('851','女裝百褶拼接寬鬆上衣','M','Black',2,1640,'2025-03-22 01:43:53','2025-03-22 01:43:53'),
('851','斜紋軟呢無領外套','L','Black',3,9900,'2025-03-22 01:43:53','2025-03-22 01:43:53'),
('771','女裝百褶拼接寬鬆上衣','M','Black',4,1640,'2025-03-24 18:46:44','2025-03-24 18:46:44'),
('771','斜紋軟呢無領外套','L','Black',3,9900,'2025-03-24 18:46:44','2025-03-24 18:46:44'),
('771','不對稱異素材上衣','L','White',11,1380,'2025-03-24 18:46:44','2025-03-24 18:46:44'),
('771','斜紋軟呢無領外套','S','Black',1,9900,'2025-03-24 18:46:45','2025-03-24 18:46:45'),
('866','女裝百褶拼接寬鬆上衣','M','Black',4,1640,'2025-03-24 18:48:27','2025-03-24 18:48:27'),
('866','斜紋軟呢無領外套','L','Black',3,9900,'2025-03-24 18:48:27','2025-03-24 18:48:27'),
('866','不對稱異素材上衣','L','White',11,1380,'2025-03-24 18:48:27','2025-03-24 18:48:27'),
('866','斜紋軟呢無領外套','S','Black',1,9900,'2025-03-24 18:48:27','2025-03-24 18:48:27'),
('662','斜紋軟呢無領外套','L','Black',1,9900,'2025-03-24 21:06:57','2025-03-24 21:06:57'),
('662','女裝百褶拼接寬鬆上衣','S','Black',3,1640,'2025-03-24 21:06:57','2025-03-24 21:06:57'),
('662','女裝不對稱異素材上衣','L','Black',3,1380,'2025-03-24 21:06:57','2025-03-24 21:06:57'),
('256','斜紋軟呢無領外套','L','Black',1,9900,'2025-03-24 21:17:55','2025-03-24 21:17:55'),
('256','半拉鍊 高領長袖','M','Black',2,2900,'2025-03-24 21:17:55','2025-03-24 21:17:55'),
('256','斜紋軟呢無領外套','L','Black',2,9900,'2025-03-24 21:17:55','2025-03-24 21:17:55'),
('256','百褶拼接寬鬆上衣','L','Black',4,1640,'2025-03-24 21:17:55','2025-03-24 21:17:55'),
('287','斜紋軟呢無領外套','L','Black',1,9900,'2025-03-24 21:36:56','2025-03-24 21:36:56'),
('287','百褶拼接寬鬆上衣','S','Black',4,1640,'2025-03-24 21:36:56','2025-03-24 21:36:56'),
('287','不對稱異素材上衣','S','Black',1,1380,'2025-03-24 21:36:56','2025-03-24 21:36:56'),
('849','斜紋軟呢無領外套','L','Black',1,9900,'2025-03-24 21:47:46','2025-03-24 21:47:46'),
('849','蕾絲滾邊短袖T恤','S','Black',1,2280,'2025-03-24 21:47:46','2025-03-24 21:47:46'),
('849','百褶拼接寬鬆上衣','S','Black',1,1640,'2025-03-24 21:47:46','2025-03-24 21:47:46'),
('849','百褶拼接寬鬆上衣','L','Black',1,1640,'2025-03-24 21:47:46','2025-03-24 21:47:46'),
('123','斜紋軟呢無領外套','S','Black',10,9900,'2025-03-30 23:55:50','2025-03-30 23:55:50'),
('230','斜紋軟呢無領外套','S','Black',10,9900,'2025-03-31 00:29:57','2025-03-31 00:29:57'),
('230','蕾絲滾邊短袖T恤','S','Black',2,2280,'2025-03-31 00:29:57','2025-03-31 00:29:57'),
('584','斜紋軟呢無領外套','S','Black',10,9900,'2025-03-31 00:49:52','2025-03-31 00:49:52');
/*!40000 ALTER TABLE `order_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_main`
--

DROP TABLE IF EXISTS `order_main`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_main` (
  `order_id` varchar(100) NOT NULL,
  `trade_No` varchar(50) DEFAULT NULL,
  `trade_Date` timestamp NULL DEFAULT NULL,
  `id` bigint(20) DEFAULT NULL,
  `total_price_with_discount` int(11) DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `trade_status` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `fee_amount` decimal(10,2) DEFAULT NULL COMMENT '手續費金額',
  `reconciliation_status` varchar(255) DEFAULT NULL COMMENT '對帳狀態: pending, normal, abnormal, completed',
  `reconciliation_notes` text DEFAULT NULL COMMENT '對帳備註',
  `reconciliation_date` timestamp NULL DEFAULT NULL COMMENT '對帳日期',
  `notes` text DEFAULT NULL COMMENT '交易備註',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_main`
--

LOCK TABLES `order_main` WRITE;
/*!40000 ALTER TABLE `order_main` DISABLE KEYS */;
INSERT INTO `order_main` VALUES
('123','52703750','2025-03-30 23:55:50',19,88901,'信用卡付款','交易成功','2025-03-30 23:55:50','2025-03-30 23:55:50',NULL,NULL,NULL,NULL,NULL),
('230','24152172','2025-03-31 00:29:57',20,93204,'信用卡付款','交易成功','2025-03-31 00:29:57','2025-03-31 00:29:57',NULL,NULL,NULL,NULL,NULL),
('232','66667120','2025-03-24 21:05:36',19,16964,'信用卡付款','交易成功','2025-03-24 21:05:36','2025-03-24 21:05:36',NULL,NULL,NULL,NULL,NULL),
('256','16370808','2025-03-24 21:17:55',19,37754,'信用卡付款','交易成功','2025-03-24 21:17:55','2025-03-24 21:17:55',NULL,NULL,NULL,NULL,NULL),
('287','73324843','2025-03-24 21:36:56',19,15956,'信用卡付款','交易成功','2025-03-24 21:36:56','2025-03-24 21:36:56',NULL,NULL,NULL,NULL,NULL),
('441','65077856','2025-03-22 01:43:30',19,29582,'信用卡付款','交易成功','2025-03-27 07:10:25','2025-03-22 01:43:30',NULL,'normal','系統對帳(正常) - 2025/3/25 上午10:18:28','2025-03-27 07:10:25',NULL),
('570','78251044','2025-03-22 01:36:22',19,29582,'信用卡付款','交易成功','2025-03-27 07:10:25','2025-03-22 01:36:22',NULL,'normal','系統對帳(正常) - 2025/3/25 上午10:18:28','2025-03-27 07:10:25',NULL),
('584','52732276','2025-03-31 00:49:52',20,88701,'信用卡付款','交易成功','2025-03-31 00:49:52','2025-03-31 00:49:52',NULL,NULL,NULL,NULL,NULL),
('592','24507849','2025-03-30 19:58:12',20,16740,'信用卡付款','交易成功','2025-03-30 19:58:12','2025-03-30 19:58:12',NULL,NULL,NULL,NULL,NULL),
('601','33458611','2025-03-16 22:02:52',19,23732,'信用卡付款','交易成功','2025-03-27 18:29:54','2025-03-16 22:02:52',NULL,'abnormal','系統對帳(異常) - 2025/3/25 上午10:18:35','2025-03-27 18:29:54',NULL),
('619','31963400','2025-03-18 22:48:37',19,64052,'信用卡付款','交易成功','2025-03-24 02:31:05','2025-03-18 22:48:37',NULL,'pending','系統對帳(待處理) - 2025/3/24 下午6:31:05','2025-03-24 02:31:05',NULL),
('645','12402759','2025-03-19 22:11:00',19,64052,'ATM轉帳','交易成功','2025-03-19 22:11:00','2025-03-19 22:11:00',NULL,NULL,NULL,NULL,NULL),
('662','47812047','2025-03-24 21:06:57',19,16964,'信用卡付款','交易成功','2025-03-24 21:06:57','2025-03-24 21:06:57',NULL,NULL,NULL,NULL,NULL),
('676','21205944','2025-03-19 22:11:01',19,64052,'ATM轉帳','交易成功','2025-03-19 22:11:01','2025-03-19 22:11:01',NULL,NULL,NULL,NULL,NULL),
('707','24682708','2025-03-18 22:09:40',19,46502,'信用卡付款','交易成功','2025-03-24 02:31:05','2025-03-18 22:09:40',NULL,'pending','系統對帳(待處理) - 2025/3/24 下午6:31:05','2025-03-24 02:31:05',NULL),
('771','58017194','2025-03-24 18:46:44',19,55106,'信用卡付款','交易成功','2025-03-24 18:46:44','2025-03-24 18:46:44',NULL,NULL,NULL,NULL,NULL),
('821','98077253','2025-03-18 22:49:41',19,64052,'ATM轉帳','交易成功','2025-03-24 02:31:05','2025-03-18 22:49:41',NULL,'pending','系統對帳(待處理) - 2025/3/24 下午6:31:05','2025-03-24 02:31:05',NULL),
('849','47923987','2025-03-24 21:47:46',19,10862,'信用卡付款','交易成功','2025-03-24 21:47:46','2025-03-24 21:47:46',NULL,NULL,NULL,NULL,NULL),
('851','47938494','2025-03-22 01:43:53',19,29582,'信用卡付款','交易成功','2025-03-27 07:10:25','2025-03-22 01:43:53',NULL,'normal','系統對帳(正常) - 2025/3/25 上午10:18:28','2025-03-27 07:10:25',NULL),
('866','95456170','2025-03-24 18:48:27',19,55106,'信用卡付款','交易成功','2025-03-24 18:48:27','2025-03-24 18:48:27',NULL,NULL,NULL,NULL,NULL),
('883','48861557','2025-03-19 22:11:01',19,64052,'ATM轉帳','交易成功','2025-03-19 22:11:01','2025-03-19 22:11:01',NULL,NULL,NULL,NULL,NULL),
('971','79859297','2025-03-24 21:09:50',19,16964,'信用卡付款','交易成功','2025-03-24 21:09:50','2025-03-24 21:09:50',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `order_main` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
INSERT INTO `password_reset_tokens` VALUES
('nasa0824@gmail.com','826533','2025-03-16 23:37:22');
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
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
-- Table structure for table `product_classification`
--

DROP TABLE IF EXISTS `product_classification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_classification` (
  `category_id` int(11) NOT NULL,
  `parent_category` varchar(11) DEFAULT NULL,
  `child_category` varchar(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_classification`
--

LOCK TABLES `product_classification` WRITE;
/*!40000 ALTER TABLE `product_classification` DISABLE KEYS */;
INSERT INTO `product_classification` VALUES
(101,'服飾','短袖','2025-03-17 18:30:59','2025-03-17 18:30:59'),
(102,'服飾','長袖','2025-03-17 18:30:59','2025-03-17 18:30:59'),
(103,'服飾','外套','2025-03-17 18:30:59','2025-03-17 18:30:59'),
(201,'飾品','異世界2000','2025-03-17 18:30:59','2025-03-19 01:15:10'),
(202,'飾品','水晶晶系列','2025-03-19 01:15:04','2025-03-19 01:15:19');
/*!40000 ALTER TABLE `product_classification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_display_img`
--

DROP TABLE IF EXISTS `product_display_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_display_img` (
  `product_id` varchar(100) DEFAULT NULL,
  `product_img_URL` varchar(255) DEFAULT NULL,
  `product_display_order` int(11) DEFAULT NULL,
  `product_alt_text` varchar(100) DEFAULT NULL,
  KEY `fk_product_display_img` (`product_id`),
  CONSTRAINT `fk_product_display_img` FOREIGN KEY (`product_id`) REFERENCES `product_main` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_display_img`
--

LOCK TABLES `product_display_img` WRITE;
/*!40000 ALTER TABLE `product_display_img` DISABLE KEYS */;
INSERT INTO `product_display_img` VALUES
('pj001','products_display/clothes/jackets/pj001_01_02.jpg',2,'斜紋軟呢無領外套'),
('pj001','products_display/clothes/jackets/pj001_03_02.jpg',4,'斜紋軟呢無領外套'),
('ps013','products_display/服飾/短袖/測試商品/cf47f9fac4ed3037ff2a8ea83204e32aff8fb5f3.png',1,'測試商品'),
('ps013','products_display/服飾/短袖/測試商品/3245e4f8c04aa0619cb31884dbf123c6918b3700.png',2,'測試商品'),
('ps013','products_display/服飾/短袖/測試商品/0186d64c5773c8d3d03cd05dc79574b2d2798d4f.png',3,'測試商品');
/*!40000 ALTER TABLE `product_display_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_img`
--

DROP TABLE IF EXISTS `product_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_img` (
  `product_id` varchar(100) DEFAULT NULL,
  `product_display_order` int(11) DEFAULT NULL,
  `product_alt_text` varchar(100) DEFAULT NULL,
  `product_img_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `fk_product_img` (`product_id`),
  CONSTRAINT `fk_product_img` FOREIGN KEY (`product_id`) REFERENCES `product_main` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_img`
--

LOCK TABLES `product_img` WRITE;
/*!40000 ALTER TABLE `product_img` DISABLE KEYS */;
INSERT INTO `product_img` VALUES
('ps001',1,'女裝百褶拼接寬鬆上衣','products/clothes/shorts/ps001_01_01.jpg\n','2025-03-17 18:30:34','2025-03-19 03:35:05'),
('ps001',2,'女裝百褶拼接寬鬆上衣','products/clothes/shorts/ps001_01_02.jpg','2025-03-17 18:30:34','2025-03-19 03:35:10'),
('ps001',3,'女裝百褶拼接寬鬆上衣','products/clothes/shorts/ps001_03_01.jpg','2025-03-17 18:30:34','2025-03-19 03:35:14'),
('ps001',4,'女裝百褶拼接寬鬆上衣','products/clothes/shorts/ps001_03_02.jpg','2025-03-17 18:30:34','2025-03-19 03:35:18'),
('ps002',1,'女裝不對稱異素材上衣','products/clothes/shorts/ps002_01_01.jpg','2025-03-17 18:30:34','2025-03-19 03:35:26'),
('ps002',2,'女裝不對稱異素材上衣','products/clothes/shorts/ps002_01_02.jpg','2025-03-17 18:30:34','2025-03-19 03:35:31'),
('ps002',3,'女裝不對稱異素材上衣','products/clothes/shorts/ps002_03_01.jpg','2025-03-17 18:30:34','2025-03-19 03:35:35'),
('ps002',4,'女裝不對稱異素材上衣','products/clothes/shorts/ps002_03_02.jpg','2025-03-17 18:30:34','2025-03-19 03:35:39'),
('ps003',1,'蕾絲滾邊短袖T恤','products/clothes/shorts/ps003_01_01.jpg','2025-03-18 03:13:28','2025-03-19 03:35:58'),
('ps003',2,'蕾絲滾邊短袖T恤','products/clothes/shorts/ps003_01_02.jpg','2025-03-18 03:13:28','2025-03-19 03:36:05'),
('ps003',3,'蕾絲滾邊短袖T恤','products/clothes/shorts/ps003_03_01.jpg','2025-03-18 03:13:28','2025-03-19 03:36:11'),
('ps003',4,'蕾絲滾邊短袖T恤','products/clothes/shorts/ps003_03_02.jpg','2025-03-18 03:13:28','2025-03-19 03:36:17'),
('ps004',1,'網紗層次荷葉袖上衣','products/clothes/shorts/ps004_01_01.jpg','2025-03-18 03:15:12','2025-03-19 03:36:24'),
('ps004',2,'網紗層次荷葉袖上衣','products/clothes/shorts/ps004_01_02.jpg','2025-03-18 03:15:12','2025-03-19 03:36:33'),
('ps004',3,'網紗層次荷葉袖上衣','products/clothes/shorts/ps004_03_01.jpg','2025-03-18 03:15:12','2025-03-19 03:36:40'),
('ps004',4,'網紗層次荷葉袖上衣','products/clothes/shorts/ps004_03_02.jpg','2025-03-18 03:15:12','2025-03-19 03:36:47'),
('ps005',1,'薄紗層次無袖背心','products/clothes/shorts/ps005_01_01.jpg','2025-03-18 03:15:12','2025-03-19 03:36:53'),
('ps005',2,'薄紗層次無袖背心','products/clothes/shorts/ps005_01_02.jpg','2025-03-18 03:15:12','2025-03-19 03:37:04'),
('ps005',3,'薄紗層次無袖背心','products/clothes/shorts/ps005_03_01.jpg','2025-03-18 03:15:12','2025-03-19 03:37:28'),
('ps005',4,'薄紗層次無袖背心','products/clothes/shorts/ps005_03_02.jpg','2025-03-18 03:15:12','2025-03-19 03:37:44'),
('ps006',1,'微高領拉克蘭袖T恤','products/clothes/shorts/ps006_01_01.jpg','2025-03-18 03:15:12','2025-03-19 03:37:52'),
('ps006',2,'微高領拉克蘭袖T恤','products/clothes/shorts/ps006_01_02.jpg','2025-03-18 03:15:12','2025-03-19 03:38:04'),
('ps006',3,'微高領拉克蘭袖T恤','products/clothes/shorts/ps006_03_01.jpg','2025-03-18 03:15:12','2025-03-19 03:38:43'),
('ps006',4,'微高領拉克蘭袖T恤','products/clothes/shorts/ps006_03_02.jpg','2025-03-18 03:15:12','2025-03-19 03:38:43'),
('ps007',1,'扭轉袖上衣','products/clothes/shorts/ps007_01_01.jpg','2025-03-18 03:15:12','2025-03-19 03:38:43'),
('ps007',2,'扭轉袖上衣','products/clothes/shorts/ps007_01_02.jpg','2025-03-18 03:15:12','2025-03-19 03:38:43'),
('ps007',3,'扭轉袖上衣','products/clothes/shorts/ps007_03_01.jpg','2025-03-18 03:15:12','2025-03-19 03:38:43'),
('ps007',4,'扭轉袖上衣','products/clothes/shorts/ps007_03_02.jpg','2025-03-18 03:15:12','2025-03-19 03:38:43'),
('ps008',1,'蕾絲拼接上衣','products/clothes/shorts/ps008_01_01.jpg','2025-03-18 03:15:12','2025-03-19 03:38:43'),
('ps008',2,'蕾絲拼接上衣','products/clothes/shorts/ps008_01_02.jpg','2025-03-18 03:15:12','2025-03-19 03:38:43'),
('ps008',3,'蕾絲拼接上衣','products/clothes/shorts/ps008_03_01.jpg','2025-03-18 03:15:12','2025-03-19 03:38:43'),
('ps008',4,'蕾絲拼接上衣','products/clothes/shorts/ps008_03_02.jpg','2025-03-18 03:15:12','2025-03-19 03:38:43'),
('pl001',1,'圈布打褶圓領上衣','products/clothes/longs/pl001_01_01.jpg','2025-03-18 03:17:40','2025-03-19 03:38:43'),
('pl001',2,'圈布打褶圓領上衣','products/clothes/longs/pl001_01_02.jpg','2025-03-18 03:17:40','2025-03-19 03:38:43'),
('pl001',3,'圈布打褶圓領上衣','products/clothes/longs/pl001_03_01.jpg','2025-03-18 03:17:40','2025-03-19 03:38:43'),
('pl001',4,'圈布打褶圓領上衣','products/clothes/longs/pl001_03_02.jpg','2025-03-18 03:17:40','2025-03-19 03:38:43'),
('pl002',1,'半拉鍊高領長袖','products/clothes/longs/pl002_01_01.jpg','2025-03-18 03:17:40','2025-03-19 03:38:43'),
('pl002',2,'半拉鍊高領長袖','products/clothes/longs/pl002_01_02.jpg','2025-03-18 03:17:40','2025-03-19 03:38:43'),
('pl002',3,'半拉鍊高領長袖','products/clothes/longs/pl002_03_01.jpg','2025-03-18 03:17:40','2025-03-19 03:38:43'),
('pl002',4,'半拉鍊高領長袖','products/clothes/longs/pl002_03_02.jpg','2025-03-18 03:17:40','2025-03-19 03:38:43'),
('pl003',1,'打褶拼接圓領襯衫','products/clothes/longs/pl003_01_01.jpg','2025-03-18 03:17:40','2025-03-19 03:38:43'),
('pl003',2,'打褶拼接圓領襯衫','products/clothes/longs/pl003_01_02.jpg','2025-03-18 03:17:40','2025-03-19 03:38:43'),
('pl003',3,'打褶拼接圓領襯衫','products/clothes/longs/pl003_03_01.jpg','2025-03-18 03:17:40','2025-03-19 03:38:43'),
('pl003',4,'打褶拼接圓領襯衫','products/clothes/longs/pl003_03_02.jpg','2025-03-18 03:17:40','2025-03-19 03:38:43'),
('pl004',1,'正面蕾絲上衣','products/clothes/longs/pl004_01_01.jpg','2025-03-18 03:17:40','2025-03-19 03:38:43'),
('pl004',2,'正面蕾絲上衣','products/clothes/longs/pl004_01_02.jpg','2025-03-18 03:17:40','2025-03-19 03:38:43'),
('pl004',3,'正面蕾絲上衣','products/clothes/longs/pl004_03_01.jpg','2025-03-18 03:17:40','2025-03-19 03:38:43'),
('pl004',4,'正面蕾絲上衣','products/clothes/longs/pl004_03_02.jpg','2025-03-18 03:17:40','2025-03-19 03:38:43'),
('pj001',1,'斜紋軟呢無領外套','products/clothes/jackets/pj001_01_01.jpg','2025-03-18 03:19:29','2025-03-19 03:38:43'),
('pj001',2,'斜紋軟呢無領外套','products/clothes/jackets/pj001_01_02.jpg','2025-03-18 03:19:29','2025-03-19 03:38:43'),
('pj001',3,'斜紋軟呢無領外套','products/clothes/jackets/pj001_03_01.jpg','2025-03-18 03:19:29','2025-03-19 03:38:43'),
('pj001',4,'斜紋軟呢無領外套','products/clothes/jackets/pj001_03_02.jpg','2025-03-18 03:19:29','2025-03-19 03:38:43'),
('pj002',1,'羊羔絨外套','products/clothes/jackets/pj002_01_01.jpg','2025-03-18 03:19:30','2025-03-19 03:38:43'),
('pj002',2,'羊羔絨外套','products/clothes/jackets/pj002_01_02.jpg','2025-03-18 03:19:30','2025-03-19 03:38:43'),
('pj002',3,'羊羔絨外套','products/clothes/jackets/pj002_03_01.jpg','2025-03-18 03:19:30','2025-03-19 03:38:43'),
('pj002',4,'羊羔絨外套','products/clothes/jackets/pj002_03_02.jpg','2025-03-18 03:19:30','2025-03-19 03:38:43'),
('pj003',1,'粗花呢圓領外套','products/clothes/jackets/pj003_01_01.jpg','2025-03-18 03:19:30','2025-03-19 03:38:43'),
('pj003',2,'粗花呢圓領外套','products/clothes/jackets/pj003_01_02.jpg','2025-03-18 03:19:30','2025-03-19 03:38:43'),
('pj003',3,'粗花呢圓領外套','products/clothes/jackets/pj003_03_01.jpg','2025-03-18 03:19:30','2025-03-19 03:38:43'),
('pj003',4,'粗花呢圓領外套','products/clothes/jackets/pj003_03_02.jpg','2025-03-18 03:19:30','2025-03-19 03:38:43'),
('pj004',1,'腰部抽繩外套','products/clothes/jackets/pj004_01_01.jpg','2025-03-18 03:19:30','2025-03-19 03:38:43'),
('pj004',2,'腰部抽繩外套','products/clothes/jackets/pj004_01_02.jpg','2025-03-18 03:19:30','2025-03-19 03:38:43'),
('pj004',3,'腰部抽繩外套','products/clothes/jackets/pj004_03_01.jpg','2025-03-18 03:19:30','2025-03-19 03:38:43'),
('pj004',4,'腰部抽繩外套','products/clothes/jackets/pj004_03_02.jpg','2025-03-18 03:19:30','2025-03-19 03:38:43'),
('pj005',1,'雙釦短版西裝外套','products/clothes/jackets/pj005_01_01.jpg','2025-03-18 03:19:52','2025-03-19 03:38:43'),
('pj005',2,'雙釦短版西裝外套','products/clothes/jackets/pj005_01_02.jpg','2025-03-18 03:19:52','2025-03-19 03:38:43'),
('pj005',3,'雙釦短版西裝外套','products/clothes/jackets/pj005_03_01.jpg','2025-03-18 03:19:52','2025-03-19 03:38:43'),
('pj005',4,'雙釦短版西裝外套','products/clothes/jackets/pj005_03_02.jpg','2025-03-18 03:19:52','2025-03-19 03:38:43'),
('pj006',1,'NRP羽絨外套','products/clothes/jackets/pj006_01_01.jpg','2025-03-18 03:19:52','2025-03-19 03:38:43'),
('pj006',2,'NRP羽絨外套','products/clothes/jackets/pj006_01_02.jpg','2025-03-18 03:19:52','2025-03-19 03:38:43'),
('pj006',3,'NRP羽絨外套','products/clothes/jackets/pj006_03_01.jpg','2025-03-18 03:19:52','2025-03-19 03:38:43'),
('pj006',4,'NRP羽絨外套','products/clothes/jackets/pj006_03_02.jpg','2025-03-18 03:19:52','2025-03-19 03:38:43'),
('ps009',1,'緹花無領上衣','products/clothes/shorts/ps009_01_01.jpg','2025-03-18 07:08:51','2025-03-19 03:38:43'),
('ps009',2,'緹花無領上衣','products/clothes/shorts/ps009_01_02.jpg','2025-03-18 07:08:51','2025-03-19 03:38:43'),
('ps009',3,'緹花無領上衣','products/clothes/shorts/ps009_03_01.jpg','2025-03-18 07:08:51','2025-03-19 03:38:43'),
('ps009',4,'緹花無領上衣','products/clothes/shorts/ps009_03_02.jpg','2025-03-18 07:08:51','2025-03-19 03:38:43'),
('ps010',1,'高領打褶無袖上衣','products/clothes/shorts/ps010_01_01.jpg','2025-03-18 07:08:51','2025-03-19 03:38:43'),
('ps010',2,'高領打褶無袖上衣','products/clothes/shorts/ps010_01_02.jpg','2025-03-18 07:08:51','2025-03-19 03:38:43'),
('ps010',3,'高領打褶無袖上衣','products/clothes/shorts/ps010_03_01.jpg','2025-03-18 07:08:51','2025-03-19 03:38:43'),
('ps010',4,'高領打褶無袖上衣','products/clothes/shorts/ps010_03_02.jpg','2025-03-18 07:08:51','2025-03-19 03:38:43'),
('ps011',1,'異素材寬鬆上衣','products/clothes/shorts/ps011_01_01.jpg','2025-03-18 07:08:51','2025-03-19 03:38:43'),
('ps011',2,'異素材寬鬆上衣','products/clothes/shorts/ps011_01_02.jpg','2025-03-18 07:08:51','2025-03-19 03:38:43'),
('ps011',3,'異素材寬鬆上衣','products/clothes/shorts/ps011_03_01.jpg','2025-03-18 07:08:51','2025-03-19 03:38:43'),
('ps011',4,'異素材寬鬆上衣','products/clothes/shorts/ps011_03_02.jpg','2025-03-18 07:08:51','2025-03-19 03:38:43'),
('ps012',1,'背部異素材上衣','products/clothes/shorts/ps012_01_01.jpg','2025-03-18 07:08:51','2025-03-19 03:38:43'),
('ps012',2,'背部異素材上衣','products/clothes/shorts/ps012_01_02.jpg','2025-03-18 07:08:51','2025-03-19 03:38:43'),
('ps012',3,'背部異素材上衣','products/clothes/shorts/ps012_03_01.jpg','2025-03-18 07:08:51','2025-03-19 03:38:43'),
('ps012',4,'背部異素材上衣','products/clothes/shorts/ps012_03_02.jpg','2025-03-18 07:08:51','2025-03-19 03:38:43'),
('pa001',1,'Navajo 綠松石十字星戒','products/accessories/pa001_00_01.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa001',2,'Navajo 綠松石十字星戒','products/accessories/pa001_00_02.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa001',3,'Navajo 綠松石十字星戒','products/accessories/pa001_00_03.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa002',1,'Navajo 蛋白石鋼印戒','products/accessories/pa002_00_01.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa002',2,'Navajo 蛋白石鋼印戒','products/accessories/pa002_00_02.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa002',3,'Navajo 蛋白石鋼印戒','products/accessories/pa002_00_03.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa003',1,'Opal 蛋白石臘雕純銀戒','products/accessories/pa003_00_01.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa003',2,'Opal 蛋白石臘雕純銀戒','products/accessories/pa003_00_02.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa003',3,'Opal 蛋白石臘雕純銀戒','products/accessories/pa003_00_03.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa004',1,'水晶晶戒指（藍）','products/accessories/pa004_00_01.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa004',2,'水晶晶戒指（藍）','products/accessories/pa004_00_02.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa004',3,'水晶晶戒指（藍）','products/accessories/pa004_00_03.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa005',1,'水晶晶戒指（粉）','products/accessories/pa005_00_01.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa005',2,'水晶晶戒指（粉）','products/accessories/pa005_00_02.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa005',3,'水晶晶戒指（粉）','products/accessories/pa005_00_03.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa006',1,'水晶晶戒指（粉黃）','products/accessories/pa006_00_01.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa006',2,'水晶晶戒指（粉黃）','products/accessories/pa006_00_02.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa006',3,'水晶晶戒指（粉黃）','products/accessories/pa006_00_03.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa007',1,'水晶晶戒指（亮黃）','products/accessories/pa007_00_01.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa007',2,'水晶晶戒指（亮黃）','products/accessories/pa007_00_02.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa007',3,'水晶晶戒指（亮黃）','products/accessories/pa007_00_03.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa008',1,'水晶晶耳環 耳針式','products/accessories/pa008_00_01.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa008',2,'水晶晶耳環 耳針式','products/accessories/pa008_00_02.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa008',3,'水晶晶耳環 耳針式','products/accessories/pa008_00_03.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa009',1,'泡泡耳環 耳針式','products/accessories/pa009_00_01.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa009',2,'泡泡耳環 耳針式','products/accessories/pa009_00_02.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa009',3,'泡泡耳環 耳針式','products/accessories/pa009_00_03.jpg','2025-03-25 01:06:17','2025-03-25 01:06:17'),
('pa001',4,'Navajo 綠松石十字星戒','products/accessories/pa001_00_04.jpg','2025-03-25 01:06:57','2025-03-25 01:07:11'),
('pa002',4,'Navajo 蛋白石鋼印戒','products/accessories/pa002_00_04.jpg','2025-03-25 01:07:27','2025-03-25 01:07:38'),
('pa004',4,'水晶晶戒指（藍）','products/accessories/pa004_00_04.jpg','2025-03-25 01:07:52','2025-03-25 01:08:04'),
('ps013',1,'測試商品','products/服飾/短袖/測試商品/224892b2e43c31d5666f73bc6116d0e5719293d2.png','2025-03-31 04:42:50','2025-03-31 04:42:50');
/*!40000 ALTER TABLE `product_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_information`
--

DROP TABLE IF EXISTS `product_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_information` (
  `product_id` varchar(100) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `content` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `fk_product_information` (`product_id`),
  CONSTRAINT `fk_product_information` FOREIGN KEY (`product_id`) REFERENCES `product_main` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_information`
--

LOCK TABLES `product_information` WRITE;
/*!40000 ALTER TABLE `product_information` DISABLE KEYS */;
INSERT INTO `product_information` VALUES
('pa003','材質','純銀92.5% (925 silver)｜蛋白石(natural opal)','2025-03-18 03:42:24','2025-03-18 03:50:28'),
('pa003','規格','公制圍10號 (Metric circumference No.10)','2025-03-18 03:42:24','2025-03-18 03:50:28'),
('pa003','其他補充','飾品皆手工製作，誤差值 ±0.5公分皆為正常範圍','2025-03-18 03:42:24','2025-03-18 03:50:28'),
('pa003','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:42:24','2025-03-18 03:50:28'),
('pa004','材質','淡水珍珠｜日本玻璃珠｜日本米珠','2025-03-18 03:47:25','2025-03-18 03:50:28'),
('pa004','規格','Free size','2025-03-18 03:47:25','2025-03-18 03:50:28'),
('pa004','其他補充','飾品皆手工製作，誤差值 ±0.5公分皆為正常範圍','2025-03-18 03:47:25','2025-03-18 03:50:28'),
('pa004','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:47:25','2025-03-18 03:50:28'),
('pa005','材質','淡水珍珠｜日本玻璃珠｜日本米珠','2025-03-18 03:47:25','2025-03-18 03:50:28'),
('pa005','規格','Free size','2025-03-18 03:47:25','2025-03-18 03:50:28'),
('pa005','其他補充','飾品皆手工製作，誤差值 ±0.5公分皆為正常範圍','2025-03-18 03:47:25','2025-03-18 03:50:28'),
('pa005','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:47:25','2025-03-18 03:50:28'),
('pa006','材質','淡水珍珠｜日本玻璃珠｜日本米珠','2025-03-18 03:47:25','2025-03-18 03:50:28'),
('pa006','規格','Free size','2025-03-18 03:47:25','2025-03-18 03:50:28'),
('pa006','其他補充','飾品皆手工製作，誤差值 ±0.5公分皆為正常範圍','2025-03-18 03:47:25','2025-03-18 03:50:28'),
('pa006','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:47:25','2025-03-18 03:50:28'),
('pa007','材質','淡水珍珠｜日本玻璃珠｜日本米珠','2025-03-18 03:47:25','2025-03-18 03:50:28'),
('pa007','規格','Free size','2025-03-18 03:47:25','2025-03-18 03:50:28'),
('pa007','其他補充','飾品皆手工製作，誤差值 ±0.5公分皆為正常範圍','2025-03-18 03:47:25','2025-03-18 03:50:28'),
('pa007','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:47:25','2025-03-18 03:50:28'),
('pa008','材質','淡水珍珠｜日本玻璃珠｜日本米珠','2025-03-18 03:47:25','2025-03-18 03:50:28'),
('pa008','規格','Free size','2025-03-18 03:47:26','2025-03-18 03:50:28'),
('pa008','其他補充','飾品皆手工製作，誤差值 ±0.5公分皆為正常範圍','2025-03-18 03:47:26','2025-03-18 03:50:28'),
('pa008','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:47:26','2025-03-18 03:50:28'),
('ps001','材質','聚酯纖維｜棉','2025-03-18 03:56:52','2025-03-18 03:56:52'),
('ps001','規格','S | M | L','2025-03-18 03:56:52','2025-03-18 03:56:52'),
('ps001','其他補充','商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。','2025-03-18 03:56:52','2025-03-18 03:56:52'),
('ps001','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:56:52','2025-03-18 03:56:52'),
('ps002','材質','聚酯纖維｜棉','2025-03-18 03:56:52','2025-03-18 03:56:52'),
('ps002','規格','S | M | L','2025-03-18 03:56:52','2025-03-18 03:56:52'),
('ps002','其他補充','商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。','2025-03-18 03:56:52','2025-03-18 03:56:52'),
('ps002','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:56:52','2025-03-18 03:56:52'),
('ps003','材質','聚酯纖維｜棉','2025-03-18 03:56:52','2025-03-18 03:56:52'),
('ps003','規格','S | M | L','2025-03-18 03:56:52','2025-03-18 03:56:52'),
('ps003','其他補充','商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('ps003','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('ps004','材質','聚酯纖維｜棉','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('ps004','規格','S | M | L','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('ps004','其他補充','商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('ps004','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('ps005','材質','聚酯纖維｜棉','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('ps005','規格','S | M | L','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('ps005','其他補充','商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('ps005','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('ps008','材質','聚酯纖維｜棉','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('ps008','規格','S | M | L','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('ps008','其他補充','商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('ps008','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('ps007','材質','聚酯纖維｜棉','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('ps007','規格','S | M | L','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('ps007','其他補充','商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('ps007','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('ps008','材質','聚酯纖維｜棉','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('ps008','規格','S | M | L','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('ps008','其他補充','商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('ps008','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:56:53','2025-03-18 03:56:53'),
('pl001','材質','聚酯纖維｜棉','2025-03-18 03:57:17','2025-03-18 03:57:17'),
('pl001','規格','S | M | L','2025-03-18 03:57:17','2025-03-18 03:57:17'),
('pl001','其他補充','商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。','2025-03-18 03:57:17','2025-03-18 03:57:17'),
('pl001','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:57:17','2025-03-18 03:57:17'),
('pl002','材質','聚酯纖維｜棉','2025-03-18 03:57:17','2025-03-18 03:57:17'),
('pl002','規格','S | M | L','2025-03-18 03:57:17','2025-03-18 03:57:17'),
('pl002','其他補充','商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。','2025-03-18 03:57:17','2025-03-18 03:57:17'),
('pl002','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:57:17','2025-03-18 03:57:17'),
('pl003','材質','聚酯纖維｜棉','2025-03-18 03:57:17','2025-03-18 03:57:17'),
('pl003','規格','S | M | L','2025-03-18 03:57:17','2025-03-18 03:57:17'),
('pl003','其他補充','商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。','2025-03-18 03:57:17','2025-03-18 03:57:17'),
('pl003','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:57:17','2025-03-18 03:57:17'),
('pl004','材質','聚酯纖維｜棉','2025-03-18 03:57:17','2025-03-18 03:57:17'),
('pl004','規格','S | M | L','2025-03-18 03:57:17','2025-03-18 03:57:17'),
('pl004','其他補充','商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。','2025-03-18 03:57:18','2025-03-18 03:57:18'),
('pl004','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:57:18','2025-03-18 03:57:18'),
('pl005','材質','聚酯纖維｜棉','2025-03-18 03:57:18','2025-03-18 03:57:18'),
('pl005','規格','S | M | L','2025-03-18 03:57:18','2025-03-18 03:57:18'),
('pl005','其他補充','商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。','2025-03-18 03:57:18','2025-03-18 03:57:18'),
('pl005','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:57:18','2025-03-18 03:57:18'),
('pl008','材質','聚酯纖維｜棉','2025-03-18 03:57:18','2025-03-18 03:57:18'),
('pl008','規格','S | M | L','2025-03-18 03:57:18','2025-03-18 03:57:18'),
('pl008','其他補充','商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。','2025-03-18 03:57:18','2025-03-18 03:57:18'),
('pl008','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:57:18','2025-03-18 03:57:18'),
('pl007','材質','聚酯纖維｜棉','2025-03-18 03:57:18','2025-03-18 03:57:18'),
('pl007','規格','S | M | L','2025-03-18 03:57:18','2025-03-18 03:57:18'),
('pl007','其他補充','商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。','2025-03-18 03:57:18','2025-03-18 03:57:18'),
('pl007','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:57:18','2025-03-18 03:57:18'),
('pl008','材質','聚酯纖維｜棉','2025-03-18 03:57:18','2025-03-18 03:57:18'),
('pl008','規格','S | M | L','2025-03-18 03:57:18','2025-03-18 03:57:18'),
('pl008','其他補充','商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。','2025-03-18 03:57:18','2025-03-18 03:57:18'),
('pl008','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:57:18','2025-03-18 03:57:18'),
('pj001','材質','聚酯纖維｜棉','2025-03-18 03:57:22','2025-03-18 03:57:22'),
('pj001','規格','S | M | L','2025-03-18 03:57:22','2025-03-18 03:57:22'),
('pj001','其他補充','商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。','2025-03-18 03:57:22','2025-03-18 03:57:22'),
('pj001','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:57:22','2025-03-18 03:57:22'),
('pj002','材質','聚酯纖維｜棉','2025-03-18 03:57:22','2025-03-18 03:57:22'),
('pj002','規格','S | M | L','2025-03-18 03:57:22','2025-03-18 03:57:22'),
('pj002','其他補充','商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。','2025-03-18 03:57:23','2025-03-18 03:57:23'),
('pj002','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:57:23','2025-03-18 03:57:23'),
('pj003','材質','聚酯纖維｜棉','2025-03-18 03:57:23','2025-03-18 03:57:23'),
('pj003','規格','S | M | L','2025-03-18 03:57:23','2025-03-18 03:57:23'),
('pj003','其他補充','商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。','2025-03-18 03:57:23','2025-03-18 03:57:23'),
('pj003','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:57:23','2025-03-18 03:57:23'),
('pj004','材質','聚酯纖維｜棉','2025-03-18 03:57:23','2025-03-18 03:57:23'),
('pj004','規格','S | M | L','2025-03-18 03:57:23','2025-03-18 03:57:23'),
('pj004','其他補充','商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。','2025-03-18 03:57:23','2025-03-18 03:57:23'),
('pj004','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:57:23','2025-03-18 03:57:23'),
('pj005','材質','聚酯纖維｜棉','2025-03-18 03:57:23','2025-03-18 03:57:23'),
('pj005','規格','S | M | L','2025-03-18 03:57:23','2025-03-18 03:57:23'),
('pj005','其他補充','商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。','2025-03-18 03:57:23','2025-03-18 03:57:23'),
('pj005','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 03:57:23','2025-03-18 03:57:23'),
('ps009','材質','聚酯纖維｜棉','2025-03-18 07:11:42','2025-03-18 07:11:42'),
('ps009','規格','S | M | L','2025-03-18 07:11:42','2025-03-18 07:11:42'),
('ps009','其他補充','緹花無商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。領上衣','2025-03-18 07:11:42','2025-03-18 07:11:42'),
('ps009','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 07:11:42','2025-03-18 07:11:42'),
('ps010','材質','聚酯纖維｜棉','2025-03-18 07:11:51','2025-03-18 07:11:51'),
('ps010','規格','S | M | L','2025-03-18 07:11:51','2025-03-18 07:11:51'),
('ps010','其他補充','緹花無商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。領上衣','2025-03-18 07:11:51','2025-03-18 07:11:51'),
('ps010','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 07:11:51','2025-03-18 07:11:51'),
('ps011','材質','聚酯纖維｜棉','2025-03-18 07:11:53','2025-03-18 07:11:53'),
('ps011','規格','S | M | L','2025-03-18 07:11:53','2025-03-18 07:11:53'),
('ps011','其他補充','緹花無商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。領上衣','2025-03-18 07:11:53','2025-03-18 07:11:53'),
('ps011','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 07:11:53','2025-03-18 07:11:53'),
('ps012','材質','聚酯纖維｜棉','2025-03-18 07:11:55','2025-03-18 07:11:55'),
('ps012','規格','S | M | L','2025-03-18 07:11:55','2025-03-18 07:11:55'),
('ps012','其他補充','緹花無商品色澤會依據環境光源或個人的手機電腦螢幕顯示而有些許不同，如實際商品有色差之情況敬請見諒。領上衣','2025-03-18 07:11:55','2025-03-18 07:11:55'),
('ps012','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-18 07:11:55','2025-03-18 07:11:55'),
('pa001','材質','純銀92.5% (925 silver)｜天然綠松石(natural turquoise)','2025-03-27 00:01:34','2025-03-27 00:01:34'),
('pa001','規格','公制圍10號 (Metric circumference No.10 )','2025-03-27 00:01:34','2025-03-27 00:01:34'),
('pa001','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-27 00:01:34','2025-03-27 00:01:34'),
('pa001','其他補充','飾品皆手工製作，誤差值 ±0.5公分皆為正常範圍','2025-03-27 00:01:34','2025-03-27 00:01:34'),
('pa002','材質','純銀92.5% (925 silver)｜蛋白石(natural opal)','2025-03-27 05:07:16','2025-03-27 05:07:16'),
('pa002','規格','公制圍10號 (Metric circumference No.10 )','2025-03-27 05:07:16','2025-03-27 05:07:16'),
('pa002','出貨說明','預購商品出貨約21工作天(不含假日)，建議與現貨商品分開下單','2025-03-27 05:07:16','2025-03-27 05:07:16'),
('pa002','其他補充','飾品皆手工製作，誤差值 ±0.5公分皆為正常範圍','2025-03-27 05:07:16','2025-03-27 05:07:16'),
('ps013','材質','測試商品11','2025-03-30 21:03:23','2025-03-30 21:03:23'),
('ps013','規格','測試商品11','2025-03-30 21:03:23','2025-03-30 21:03:23'),
('ps013','出貨說明','測試商品11','2025-03-30 21:03:23','2025-03-30 21:03:23'),
('ps013','其他補充','測試商品11','2025-03-30 21:03:23','2025-03-30 21:03:23');
/*!40000 ALTER TABLE `product_information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_main`
--

DROP TABLE IF EXISTS `product_main`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_main` (
  `product_id` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(11) DEFAULT NULL,
  `product_description` varchar(255) DEFAULT NULL,
  `product_img` varchar(255) DEFAULT NULL,
  `product_status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`product_id`),
  KEY `fk_product_main` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_main`
--

LOCK TABLES `product_main` WRITE;
/*!40000 ALTER TABLE `product_main` DISABLE KEYS */;
INSERT INTO `product_main` VALUES
('pa001',201,'Navajo 綠松石十字星戒',5980,NULL,'products/accessories/pa001_00_01.jpg','active','2025-03-10 02:44:53','2025-03-27 00:30:42'),
('pa002',201,'Navajo 蛋白石鋼印戒',4590,NULL,'products/accessories/pa002_00_01.jpg','active','2025-03-10 03:42:49','2025-03-27 05:07:15'),
('pa003',201,'Opal 蛋白石臘雕純銀戒',4350,'925 silver | natural opal | metric circumference No.10（公制圍10號）','products/accessories/pa003_00_01.jpg',NULL,'2025-03-10 03:47:06','2025-03-19 03:39:30'),
('pa004',201,'水晶晶戒指（藍）',1590,'淡水珍珠｜日本玻璃珠｜日本米珠｜Free size','products/accessories/pa004_00_01.jpg',NULL,'2025-03-10 03:54:00','2025-03-19 03:39:30'),
('pa005',201,'水晶晶戒指（粉）',1490,'淡水珍珠｜日本玻璃珠｜日本米珠｜Free size','products/accessories/pa005_00_01.jpg',NULL,'2025-03-17 15:08:21','2025-03-19 03:39:30'),
('pa006',201,'水晶晶戒指（粉黃）',1490,'淡水珍珠｜日本玻璃珠｜日本米珠｜Free size','products/accessories/pa006_00_01.jpg',NULL,'2025-03-17 15:10:09','2025-03-19 03:39:30'),
('pa007',201,'水晶晶戒指（亮黃）',1490,'淡水珍珠｜日本玻璃珠｜日本米珠｜Free size','products/accessories/pa007_00_01.jpg',NULL,'2025-03-17 15:11:41','2025-03-19 03:39:30'),
('pa008',201,'水晶晶耳環 耳針式',1590,'淡水珍珠｜日本玻璃珠｜日本米珠｜Free size','products/accessories/pa008_00_01.jpg',NULL,'2025-03-17 15:12:55','2025-03-19 03:39:30'),
('pa009',201,'泡泡耳環 耳針式',1290,'淡水珍珠｜日本玻璃珠｜日本米珠｜Free size','products/accessories/pa009_00_01.jpg',NULL,'2025-03-17 15:14:00','2025-03-19 03:39:30'),
('pj001',103,'斜紋軟呢無領外套',9900,'單色基底，橫向織線製成花式紗線，袖口採用開岔設計，無論作為休閒裝扮或正式裝扮都非常適合','products/clothes/jackets/pj001_01_01.jpg',NULL,'2025-03-15 07:43:02','2025-03-19 03:39:30'),
('pj002',103,'羊羔絨外套',3540,'以大鈕扣與大衣領為特徵的防寒外套，表面為羊羔絨材質，排扣設計，適合春秋季天氣微涼時的穿搭，展現俐落性格','products/clothes/jackets/pj002_02_01.jpg',NULL,'2025-03-15 07:48:00','2025-03-19 03:39:30'),
('pj003',103,'粗花呢圓領外套',5760,'經典剪裁，向後推得上袖設計，讓整體看起來更加支幹練，適合當作休閒或正式場合的小外套','products/clothes/jackets/pj003_03_01.jpg',NULL,'2025-03-15 07:50:08','2025-03-19 03:39:30'),
('pj004',103,'腰部抽繩外套',3540,'採用兼具適度應討和柔韌性的聚酯纖維，帶有些許光澤，腰部設有可調節設計，本身較薄，適合搭配更多層次的穿搭，例如圍巾、針織衫或是背心','products/clothes/jackets/pj004_03_01.jpg',NULL,'2025-03-15 07:51:56','2025-03-19 03:39:30'),
('pj005',103,'雙釦短版西裝外套',5500,'聚酯纖維與螺紋材質，下襬加入了不同步材料增加層次，既是經典的西裝造型，也適合作為休閒服裝','products/clothes/jackets/pj005_01_01.jpg',NULL,'2025-03-15 07:54:20','2025-03-19 03:39:30'),
('pj006',103,'NRP 羽絨外套',10600,'採用羽絨補丁設計，相當蓬鬆柔軟，內側抽繩設計可形塑腰線，防風效果佳，適合購入偏大的尺寸，在秋冬季節穿著','products/clothes/jackets/pj006_03_01.jpg',NULL,'2025-03-15 07:59:08','2025-03-19 03:39:30'),
('pl001',102,'毛圈布 打褶 圓領上衣',2940,'百搭單品，內刷毛使用毛圈布製成，下擺為寬版羅紋的短版設計','products/clothes/longs/pl001_03_01.jpg',NULL,'2025-03-10 06:50:42','2025-03-19 04:59:56'),
('pl002',102,'半拉鍊 高領長袖',2900,'衣襬的毛邊設計是亮點，兩側繩帶可以調整尺寸，拉緊後下擺會收攏成波浪狀','products/clothes/longs/pl002_01_01.jpg',NULL,'2025-03-10 06:55:21','2025-03-19 04:58:32'),
('pl003',102,'打褶 拼接 圓領襯衫',3540,'採用立領樣式作為領口亮點，從稍微收緊的腰線延伸出百褶，與休閒下身衣著非常搭','products/clothes/longs/pl003_03_01.jpg',NULL,'2025-03-10 07:02:02','2025-03-19 03:39:30'),
('pl004',102,'正面蕾絲上衣',1800,'優雅蕾絲花紋加上藏釦設計，展現清爽俐落的風格','products/clothes/longs/pl004_01_01.jpg',NULL,'2025-03-10 07:16:31','2025-03-19 03:39:30'),
('pl005',102,'緹花流蘇V領開襟衫',3780,'以斜紋緹花編織，表面採流蘇設計剪裁，打造亮點，推薦與長大衣搭配穿著','products/clothes/longs/pl005_03_01.jpg',NULL,'2025-03-17 16:13:54','2025-03-19 03:39:30'),
('pl006',102,'緹花流蘇V領開襟衫',1040,NULL,'products/clothes/longs/pl006_01_01.jpg','inactive','2025-03-17 16:16:27','2025-03-30 20:28:18'),
('pl007',102,'圓點緹花襯衫',6990,'圓點花紋加上緹花剪裁設計，展現華麗與優雅氣質，非常適合作為典禮等活動場合的穿著','products/clothes/longs/pl007_03_01.jpg',NULL,'2025-03-17 16:20:59','2025-03-19 03:39:30'),
('pl008',102,'緹花流蘇高領上衣',3540,'秋冬經典人氣針織衫，以斜線緹花編織，搭配流蘇設計','products/clothes/longs/pl008_01_01.jpg',NULL,'2025-03-17 17:15:49','2025-03-19 03:39:30'),
('ps001',101,'百褶拼接寬鬆上衣',1640,'袖口與衣襬為雪紡百褶，版型寬鬆，簡約中帶有特色，適合搭配丹寧褲或西裝褲','products/clothes/shorts/ps001_03_01.jpg',NULL,'2025-03-10 01:44:29','2025-03-19 05:00:20'),
('ps002',101,'不對稱異素材上衣',1380,'異素材拼接搭配同色材質，下擺加入不對稱設計，不同角度看起來不盡相同的造型讓人愛不釋手','products/clothes/shorts/ps002_01_01.jpg',NULL,'2025-03-10 01:44:29','2025-03-19 05:00:41'),
('ps003',101,'蕾絲滾邊短袖T恤',2280,'具有彈性的合身剪裁，蕾絲與滾邊設計，具有HUBD風格的單品','products/clothes/shorts/ps003_03_01.jpg',NULL,'2025-03-18 00:52:28','2025-03-19 03:39:30'),
('ps004',101,'網紗層次荷葉袖上衣',2080,NULL,'products/clothes/shorts/ps004_01_01.jpg','active','2025-03-18 00:56:53','2025-03-26 23:33:46'),
('ps005',101,'薄紗層次無袖背心',1490,'飄逸的荷葉邊袖是整體的穿搭亮點！俐落的剪裁版型，非常適合搭配吊帶褲、工裝裙或吊帶裙穿著','products/clothes/shorts/ps005_03_01.jpg',NULL,'2025-03-18 00:59:26','2025-03-19 03:39:30'),
('ps006',101,'微高領拉克蘭袖T恤',1040,'小高領設計，主打簡約風格，適合搭配西裝褲或單寧褲','products/clothes/shorts/ps006_01_01.jpg',NULL,'2025-03-18 01:01:05','2025-03-19 03:39:30'),
('ps007',101,'扭轉袖上衣',1048,'稍微有挺度的天竺棉材質，扭轉袖為其亮點，簡約中帶有不凡，適合搭配西裝褲穿著或長裙','products/clothes/shorts/ps007_03_01.jpg',NULL,'2025-03-18 01:04:32','2025-03-19 03:39:30'),
('ps008',101,'蕾絲拼接上衣',2360,'衣身為天竺棉材質，袖口部分使用彈力網狀物，透膚感式中，推薦與簡約的單寧褲或中長裙做搭配','products/clothes/shorts/ps008_01_01.jpg',NULL,'2025-03-18 01:06:55','2025-03-19 03:39:30'),
('ps009',101,'緹花無領上衣',1340,'前短後長的剪裁，麻花編織紋路設計，適合與寬褲或長裙做搭配','products/clothes/shorts/ps009_03_01.jpg',NULL,'2025-03-18 06:56:30','2025-03-19 03:39:30'),
('ps010',101,'高領打褶無袖上衣',1340,'簡約時尚，肩部加入打褶的箱型剪裁上衣，微高領設計','products/clothes/shorts/ps010_01_01.jpg',NULL,'2025-03-18 07:00:45','2025-03-19 03:39:30'),
('ps011',101,'異素材寬鬆上衣',1280,'結合異材質拼貼的上衣，下襬有收緊抽繩，推薦搭配丹寧褲或是長裙','products/clothes/shorts/ps011_03_01.jpg',NULL,'2025-03-18 07:03:11','2025-03-19 03:39:30'),
('ps012',101,'背部異素材上衣',1280,'異材質拼接，下襬前短後長，展現簡約時尚的風格','products/clothes/shorts/ps012_01_01.jpg',NULL,'2025-03-18 07:05:26','2025-03-19 03:39:30'),
('ps013',101,'測試商品11',1200000,'測試商品11','products/服飾/短袖/測試商品/224892b2e43c31d5666f73bc6116d0e5719293d2.png','active','2025-03-31 04:42:50','2025-03-30 21:03:23');
/*!40000 ALTER TABLE `product_main` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_spec`
--

DROP TABLE IF EXISTS `product_spec`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_spec` (
  `product_id` varchar(100) NOT NULL,
  `product_size` varchar(20) DEFAULT NULL,
  `product_color` varchar(20) DEFAULT NULL,
  `product_stock` int(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `spec_id` varchar(100) DEFAULT NULL,
  KEY `fk_product_spec_product` (`product_id`),
  KEY `spec_id` (`spec_id`),
  CONSTRAINT `fk_product_spec_product` FOREIGN KEY (`product_id`) REFERENCES `product_main` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_spec`
--

LOCK TABLES `product_spec` WRITE;
/*!40000 ALTER TABLE `product_spec` DISABLE KEYS */;
INSERT INTO `product_spec` VALUES
('pa003','null','null',5,'2025-03-17 18:34:06','2025-03-17 18:34:06','3'),
('pa004','null','null',5,'2025-03-17 18:34:06','2025-03-17 18:34:06','4'),
('pl001','S','Black',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','5'),
('pl001','S','Grey',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','6'),
('pl001','S','White',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','7'),
('pl001','M','Black',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','8'),
('pl001','M','Grey',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','9'),
('pl001','M','White',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','10'),
('pl001','L','Black',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','11'),
('pl001','L','Grey',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','12'),
('pl001','L','White',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','13'),
('pl002','S','Black',0,'2025-03-17 18:34:06','2025-03-30 19:58:12','14'),
('pl002','S','Grey',15,'2025-03-17 18:34:06','2025-03-30 19:58:12','15'),
('pl002','S','White',15,'2025-03-17 18:34:06','2025-03-30 19:58:12','16'),
('pl002','M','Black',15,'2025-03-17 18:34:06','2025-03-30 19:58:12','17'),
('pl002','M','Grey',15,'2025-03-17 18:34:06','2025-03-30 19:58:12','18'),
('pl002','M','White',15,'2025-03-17 18:34:06','2025-03-30 19:58:12','19'),
('pl002','L','Black',15,'2025-03-17 18:34:06','2025-03-30 19:58:12','20'),
('pl002','L','Grey',15,'2025-03-17 18:34:06','2025-03-30 19:58:12','21'),
('pl002','L','White',15,'2025-03-17 18:34:06','2025-03-30 19:58:12','22'),
('pl003','S','Black',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','23'),
('pl003','S','Grey',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','24'),
('pl003','S','White',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','25'),
('pl003','M','Black',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','26'),
('pl003','M','Grey',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','27'),
('pl003','M','White',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','28'),
('pl003','L','Black',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','29'),
('pl003','L','Grey',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','30'),
('pl003','L','White',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','31'),
('pl004','S','Black',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','32'),
('pl004','S','Grey',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','33'),
('pl004','S','White',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','34'),
('pl004','M','Black',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','35'),
('pl004','M','Grey',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','36'),
('pl004','M','White',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','37'),
('pl004','L','Black',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','38'),
('pl004','L','Grey',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','39'),
('pl004','L','White',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','40'),
('ps001','S','Black',16,'2025-03-17 18:34:06','2025-03-24 21:36:56','41'),
('ps001','S','Grey',16,'2025-03-17 18:34:06','2025-03-24 21:36:56','42'),
('ps001','S','White',16,'2025-03-17 18:34:06','2025-03-24 21:36:56','43'),
('ps001','M','Black',16,'2025-03-17 18:34:06','2025-03-24 21:36:56','44'),
('ps001','M','Grey',16,'2025-03-17 18:34:06','2025-03-24 21:36:56','45'),
('ps001','M','White',16,'2025-03-17 18:34:06','2025-03-24 21:36:56','46'),
('ps001','L','Black',16,'2025-03-17 18:34:06','2025-03-24 21:36:56','47'),
('ps001','L','Grey',16,'2025-03-17 18:34:06','2025-03-24 21:36:56','48'),
('ps001','L','White',16,'2025-03-17 18:34:06','2025-03-24 21:36:56','49'),
('ps002','S','Black',9,'2025-03-17 18:34:06','2025-03-24 21:36:56','50'),
('ps002','S','Grey',9,'2025-03-17 18:34:06','2025-03-24 21:36:56','51'),
('ps002','S','White',9,'2025-03-17 18:34:06','2025-03-24 21:36:56','52'),
('ps002','M','Black',9,'2025-03-17 18:34:06','2025-03-24 21:36:56','53'),
('ps002','M','Grey',9,'2025-03-17 18:34:06','2025-03-24 21:36:56','54'),
('ps002','M','White',9,'2025-03-17 18:34:06','2025-03-24 21:36:56','55'),
('ps002','L','Black',9,'2025-03-17 18:34:06','2025-03-24 21:36:56','56'),
('ps002','L','Grey',9,'2025-03-17 18:34:06','2025-03-24 21:36:56','57'),
('ps002','L','White',9,'2025-03-17 18:34:06','2025-03-24 21:36:56','58'),
('pj001','S','Black',80,'2025-03-17 18:34:06','2025-03-31 00:49:52','59'),
('pj001','M','Black',80,'2025-03-17 18:34:06','2025-03-31 00:49:52','60'),
('pj001','L','Black',80,'2025-03-17 18:34:06','2025-03-31 00:49:52','61'),
('pj001','S','White',80,'2025-03-17 18:34:06','2025-03-31 00:49:52','62'),
('pj001','M','White',80,'2025-03-17 18:34:06','2025-03-31 00:49:52','63'),
('pj001','L','White',80,'2025-03-17 18:34:06','2025-03-31 00:49:52','64'),
('pj002','S','Grey',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','65'),
('pj002','M','Grey',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','66'),
('pj002','L','Grey',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','67'),
('pj002','S','White',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','68'),
('pj002','M','White',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','69'),
('pj002','L','White',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','70'),
('pj003','S','Black',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','71'),
('pj003','M','Black',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','72'),
('pj003','L','Black',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','73'),
('pj003','S','White',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','74'),
('pj003','M','White',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','75'),
('pj003','L','White',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','76'),
('pj004','S','Grey',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','77'),
('pj004','M','Grey',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','78'),
('pj004','L','Grey',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','79'),
('pj004','S','White',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','80'),
('pj004','M','White',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','81'),
('pj004','L','White',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','82'),
('pj005','S','Black',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','83'),
('pj005','M','Black',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','84'),
('pj005','L','Black',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','85'),
('pj005','S','Grey',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','86'),
('pj005','M','Grey',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','87'),
('pj005','L','Grey',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','88'),
('pj006','S','Black',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','89'),
('pj006','M','Black',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','90'),
('pj006','L','Black',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','91'),
('pj006','S','White',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','92'),
('pj006','M','White',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','93'),
('pj006','L','White',20,'2025-03-17 18:34:06','2025-03-17 18:34:06','94'),
('pl005','S','Black',20,NULL,NULL,'96'),
('pl005','M','Black',20,NULL,NULL,'97'),
('pl005','L','Black',20,NULL,NULL,'98'),
('pl005','S','Grey',20,NULL,NULL,'99'),
('pl005','M','Grey',20,NULL,NULL,'100'),
('pl005','L','Grey',20,NULL,NULL,'101'),
('pl005','S','White',20,NULL,NULL,'102'),
('pl005','M','White',20,NULL,NULL,'103'),
('pl005','L','White',20,NULL,NULL,'104'),
('pl006','S','Black',20,NULL,NULL,'105'),
('pl006','M','Black',20,NULL,NULL,'106'),
('pl006','L','Black',20,NULL,NULL,'107'),
('pl006','S','Grey',20,NULL,NULL,'108'),
('pl006','M','Grey',20,NULL,NULL,'109'),
('pl006','L','Grey',20,NULL,NULL,'110'),
('pl006','S','White',20,NULL,NULL,'111'),
('pl006','M','White',20,NULL,NULL,'112'),
('pl006','L','White',20,NULL,NULL,'113'),
('pl007','S','Black',20,NULL,NULL,'114'),
('pl007','M','Black',20,NULL,NULL,'115'),
('pl007','L','Black',20,NULL,NULL,'116'),
('pl007','S','Grey',20,NULL,NULL,'117'),
('pl007','M','Grey',20,NULL,NULL,'118'),
('pl007','L','Grey',20,NULL,NULL,'119'),
('pl007','S','White',20,NULL,NULL,'120'),
('pl007','M','White',20,NULL,NULL,'121'),
('pl007','L','White',20,NULL,NULL,'122'),
('pl008','S','Black',20,NULL,NULL,'123'),
('pl008','M','Black',20,NULL,NULL,'124'),
('pl008','L','Black',20,NULL,NULL,'125'),
('pl008','S','Grey',20,NULL,NULL,'126'),
('pl008','M','Grey',20,NULL,NULL,'127'),
('pl008','L','Grey',20,NULL,NULL,'128'),
('pl008','S','White',20,NULL,NULL,'129'),
('pl008','M','White',20,NULL,NULL,'130'),
('pl008','L','White',20,NULL,NULL,'131'),
('ps003','S','Black',18,NULL,'2025-03-31 00:29:57','132'),
('ps003','M','Black',18,NULL,'2025-03-31 00:29:57','133'),
('ps003','L','Black',18,NULL,'2025-03-31 00:29:57','134'),
('ps003','S','Grey',18,NULL,'2025-03-31 00:29:57','135'),
('ps003','M','Grey',18,NULL,'2025-03-31 00:29:57','136'),
('ps003','L','Grey',18,NULL,'2025-03-31 00:29:57','137'),
('ps003','S','White',18,NULL,'2025-03-31 00:29:57','138'),
('ps003','M','White',18,NULL,'2025-03-31 00:29:57','139'),
('ps003','L','White',18,NULL,'2025-03-31 00:29:57','140'),
('ps004','S','Black',20,NULL,NULL,'141'),
('ps004','M','Black',20,NULL,NULL,'142'),
('ps004','L','Black',20,NULL,NULL,'143'),
('ps004','S','Grey',20,NULL,NULL,'144'),
('ps004','M','Grey',20,NULL,NULL,'145'),
('ps004','L','Grey',20,NULL,NULL,'146'),
('ps004','S','White',20,NULL,NULL,'147'),
('ps004','M','White',20,NULL,NULL,'148'),
('ps004','L','White',20,NULL,NULL,'149'),
('ps005','S','Black',20,NULL,NULL,'150'),
('ps005','M','Black',20,NULL,NULL,'151'),
('ps005','L','Black',20,NULL,NULL,'152'),
('ps005','S','Grey',20,NULL,NULL,'153'),
('ps005','M','Grey',20,NULL,NULL,'154'),
('ps005','L','Grey',20,NULL,NULL,'155'),
('ps005','S','White',20,NULL,NULL,'156'),
('ps005','M','White',20,NULL,NULL,'157'),
('ps005','L','White',20,NULL,NULL,'158'),
('ps006','S','Black',20,NULL,NULL,'159'),
('ps006','M','Black',20,NULL,NULL,'160'),
('ps006','L','Black',20,NULL,NULL,'161'),
('ps006','S','Grey',20,NULL,NULL,'162'),
('ps006','M','Grey',20,NULL,NULL,'163'),
('ps006','L','Grey',20,NULL,NULL,'164'),
('ps006','S','White',20,NULL,NULL,'165'),
('ps006','M','White',20,NULL,NULL,'166'),
('ps006','L','White',20,NULL,NULL,'167'),
('ps007','S','Black',20,NULL,NULL,'168'),
('ps007','M','Black',20,NULL,NULL,'169'),
('ps007','L','Black',20,NULL,NULL,'170'),
('ps007','S','Grey',20,NULL,NULL,'171'),
('ps007','M','Grey',20,NULL,NULL,'172'),
('ps007','L','Grey',20,NULL,NULL,'173'),
('ps007','S','White',20,NULL,NULL,'174'),
('ps007','M','White',20,NULL,NULL,'175'),
('ps007','L','White',20,NULL,NULL,'176'),
('ps008','S','Black',20,NULL,NULL,'177'),
('ps008','M','Black',20,NULL,NULL,'178'),
('ps008','L','Black',20,NULL,NULL,'179'),
('ps008','S','Grey',20,NULL,NULL,'180'),
('ps008','M','Grey',20,NULL,NULL,'181'),
('ps008','L','Grey',20,NULL,NULL,'182'),
('ps008','S','White',20,NULL,NULL,'183'),
('ps008','M','White',20,NULL,NULL,'184'),
('ps008','L','White',20,NULL,NULL,'185'),
('ps009','S','Black',20,NULL,NULL,'186'),
('ps009','M','Black',20,NULL,NULL,'187'),
('ps009','L','Black',20,NULL,NULL,'188'),
('ps009','S','Grey',20,NULL,NULL,'189'),
('ps009','M','Grey',20,NULL,NULL,'190'),
('ps009','L','Grey',20,NULL,NULL,'191'),
('ps009','S','White',20,NULL,NULL,'192'),
('ps009','M','White',20,NULL,NULL,'193'),
('ps009','L','White',20,NULL,NULL,'194'),
('ps010','S','Black',20,NULL,NULL,'195'),
('ps010','M','Black',20,NULL,NULL,'196'),
('ps010','L','Black',20,NULL,NULL,'197'),
('ps010','S','Grey',20,NULL,NULL,'198'),
('ps010','M','Grey',20,NULL,NULL,'199'),
('ps010','L','Grey',20,NULL,NULL,'200'),
('ps010','S','White',20,NULL,NULL,'201'),
('ps010','M','White',20,NULL,NULL,'202'),
('ps010','L','White',20,NULL,NULL,'203'),
('ps011','S','Black',20,NULL,NULL,'204'),
('ps011','M','Black',20,NULL,NULL,'205'),
('ps011','L','Black',20,NULL,NULL,'206'),
('ps011','S','Grey',20,NULL,NULL,'207'),
('ps011','M','Grey',20,NULL,NULL,'208'),
('ps011','L','Grey',20,NULL,NULL,'209'),
('ps011','S','White',20,NULL,NULL,'210'),
('ps011','M','White',20,NULL,NULL,'211'),
('ps011','L','White',20,NULL,NULL,'212'),
('ps012','S','Black',20,NULL,NULL,'213'),
('ps012','M','Black',20,NULL,NULL,'214'),
('ps012','L','Black',20,NULL,NULL,'215'),
('ps012','S','Grey',20,NULL,NULL,'216'),
('ps012','M','Grey',20,NULL,NULL,'217'),
('ps012','L','Grey',20,NULL,NULL,'218'),
('ps012','S','White',20,NULL,NULL,'219'),
('ps012','M','White',20,NULL,NULL,'220'),
('ps012','L','White',20,NULL,NULL,'221'),
('pa005',NULL,NULL,100,NULL,NULL,NULL),
('pa006',NULL,NULL,100,NULL,NULL,NULL),
('pa007',NULL,NULL,100,NULL,NULL,NULL),
('pa008',NULL,NULL,100,NULL,NULL,NULL),
('pa009',NULL,NULL,100,NULL,NULL,NULL),
('pa001','null','null',100,'2025-03-27 00:01:34','2025-03-27 00:01:34','SPEC202503270801345791'),
('pa002','null','null',100,'2025-03-27 05:07:15','2025-03-27 05:07:15','SPEC202503271307152643'),
('ps013','L','Gray',100,'2025-03-30 21:03:23','2025-03-30 21:03:23','SPEC202503310503231538'),
('ps013','M','Gray',100,'2025-03-30 21:03:23','2025-03-30 21:03:23','SPEC202503310503237651');
/*!40000 ALTER TABLE `product_spec` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reconciliations`
--

DROP TABLE IF EXISTS `reconciliations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `reconciliations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reconciliation_number` varchar(255) NOT NULL COMMENT '對帳編號',
  `reconciliation_date` date NOT NULL COMMENT '對帳日期',
  `transaction_count` int(11) NOT NULL DEFAULT 0 COMMENT '交易筆數',
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT '交易總額',
  `total_fee` decimal(10,2) DEFAULT NULL COMMENT '手續費總額',
  `total_net_amount` decimal(10,2) DEFAULT NULL COMMENT '淨收入',
  `staff_id` bigint(20) unsigned DEFAULT NULL COMMENT '對帳人員ID',
  `staff_name` varchar(255) DEFAULT NULL COMMENT '對帳人員姓名',
  `status` enum('normal','abnormal','pending','completed') NOT NULL DEFAULT 'pending' COMMENT '對帳狀態',
  `notes` text DEFAULT NULL COMMENT '對帳備註',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reconciliations_reconciliation_number_unique` (`reconciliation_number`),
  KEY `reconciliations_reconciliation_date_index` (`reconciliation_date`),
  KEY `reconciliations_status_index` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reconciliations`
--

LOCK TABLES `reconciliations` WRITE;
/*!40000 ALTER TABLE `reconciliations` DISABLE KEYS */;
INSERT INTO `reconciliations` VALUES
(1,'REC1742812242','2025-03-19',3,174606.00,NULL,NULL,NULL,'系統','normal','系統對帳(正常) - 2025/3/24 下午6:30:42','2025-03-24 02:30:42','2025-03-24 02:30:42'),
(2,'REC1742812265','2025-03-19',3,174606.00,NULL,NULL,NULL,'系統','pending','系統對帳(待處理) - 2025/3/24 下午6:31:05','2025-03-24 02:31:05','2025-03-24 02:31:05'),
(3,'REC1742820914','2025-03-22',3,88746.00,NULL,NULL,NULL,'系統','normal','系統對帳(正常) - 2025/3/24 下午8:55:14','2025-03-24 04:55:14','2025-03-24 04:55:14'),
(4,'REC1742868274','2025-03-22',3,88746.00,NULL,NULL,NULL,'系統','normal','系統對帳(正常) - 2025/3/25 上午10:04:34','2025-03-24 18:04:34','2025-03-24 18:04:34'),
(5,'REC1742868487','2025-03-22',3,88746.00,NULL,NULL,NULL,'系統','pending','系統對帳(待處理) - 2025/3/25 上午10:08:07','2025-03-24 18:08:07','2025-03-24 18:08:07'),
(6,'REC1742869108','2025-03-22',3,88746.00,NULL,NULL,NULL,'系統','normal','系統對帳(正常) - 2025/3/25 上午10:18:28','2025-03-24 18:18:28','2025-03-24 18:18:28'),
(7,'REC1742869115','2025-03-17',1,23732.00,NULL,NULL,NULL,'系統','abnormal','系統對帳(異常) - 2025/3/25 上午10:18:35','2025-03-24 18:18:35','2025-03-24 18:18:35'),
(8,'REC1743085069','2025-03-17',1,23732.00,NULL,NULL,NULL,'系統','normal','系統對帳(異常) - 2025/3/25 上午10:18:35','2025-03-27 06:17:49','2025-03-27 06:17:49'),
(9,'REC1743085192','2025-03-17',1,23732.00,NULL,NULL,NULL,'系統','abnormal','系統對帳(異常) - 2025/3/25 上午10:18:35','2025-03-27 06:19:52','2025-03-27 06:19:52'),
(10,'REC1743085415','2025-03-17',1,23732.00,NULL,NULL,NULL,'系統','normal','系統對帳(異常) - 2025/3/25 上午10:18:35','2025-03-27 06:23:35','2025-03-27 06:23:35'),
(11,'REC1743087512','2025-03-17',1,23732.00,NULL,NULL,NULL,'系統','abnormal','系統對帳(異常) - 2025/3/25 上午10:18:35','2025-03-27 06:58:32','2025-03-27 06:58:32'),
(12,'REC1743087521','2025-03-17',1,23732.00,NULL,NULL,NULL,'系統','pending','系統對帳(異常) - 2025/3/25 上午10:18:35','2025-03-27 06:58:41','2025-03-27 06:58:41'),
(13,'REC1743087526','2025-03-17',1,23732.00,NULL,NULL,NULL,'系統','abnormal','系統對帳(異常) - 2025/3/25 上午10:18:35','2025-03-27 06:58:46','2025-03-27 06:58:46'),
(14,'REC1743088222','2025-03-22',3,88746.00,NULL,NULL,NULL,'系統','pending','系統對帳(正常) - 2025/3/25 上午10:18:28','2025-03-27 07:10:22','2025-03-27 07:10:22'),
(15,'REC1743088225','2025-03-22',3,88746.00,NULL,NULL,NULL,'系統','normal','系統對帳(正常) - 2025/3/25 上午10:18:28','2025-03-27 07:10:25','2025-03-27 07:10:25'),
(16,'REC1743088229','2025-03-17',1,23732.00,NULL,NULL,NULL,'系統','pending','系統對帳(異常) - 2025/3/25 上午10:18:35','2025-03-27 07:10:29','2025-03-27 07:10:29'),
(17,'REC1743088233','2025-03-17',1,23732.00,NULL,NULL,NULL,'系統','abnormal','系統對帳(異常) - 2025/3/25 上午10:18:35','2025-03-27 07:10:33','2025-03-27 07:10:33'),
(18,'REC1743128990','2025-03-17',1,23732.00,NULL,NULL,NULL,'系統','normal','系統對帳(異常) - 2025/3/25 上午10:18:35','2025-03-27 18:29:50','2025-03-27 18:29:50'),
(19,'REC1743128994','2025-03-17',1,23732.00,NULL,NULL,NULL,'系統','abnormal','系統對帳(異常) - 2025/3/25 上午10:18:35','2025-03-27 18:29:54','2025-03-27 18:29:54');
/*!40000 ALTER TABLE `reconciliations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
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
INSERT INTO `sessions` VALUES
('5YQOkawZza2ZjEeOW2ZfYQyQQgijD93sYRtMgZW7',NULL,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.3.1 Safari/605.1.15','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiR2w1NlBZTXdYNVdOWlBoaGI5NmdqNWxub3NiMEx6Mno5VnpvazFvRiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NzoiaHR0cDovL2xvY2FsaG9zdC9jbGllbnQtc2lkZS9wdWJsaWMvdXNlci9vcmRlcnMiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NzoiaHR0cDovL2xvY2FsaG9zdC9jbGllbnQtc2lkZS9wdWJsaWMvdXNlci9vcmRlcnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1743470167),
('6zzSyRnT830ndY1yizBcDUt9y4VdoU28eoqYMXCL',20,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiN3JEYlY2OU16NGZrZTNha1JXNW41NjFnQnZKbUJHTzlpb3h3bk83aSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cDovL2xvY2FsaG9zdC9jbGllbnQtc2lkZS9wdWJsaWMvY2FydCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vbG9jYWxob3N0L2NsaWVudC1zaWRlL3B1YmxpYy9jYXJ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjA7fQ==',1743472559),
('DVovoPya1Cd1F9G3mRC5EPjdtSNqKMS1cTW5BCgZ',10,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUExkZ09ickFWNldRVTZzcUVkVVVjN2txb2JKNVJ0bEFUVjU3WkVZbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3QvY2xpZW50LXNpZGUvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NjoiaHR0cDovL2xvY2FsaG9zdC9jbGllbnQtc2lkZS9wdWJsaWMvd2lzaC1saXN0cyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEwO30=',1743472455),
('FqBkQ4AfkIC0ZwAXFRmYbD2l8xoZG4aACigT6WmH',19,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.3.1 Safari/605.1.15','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWTNYVWl0ZU9XaG1PVE0wc2NUYnJWb0RIdFp2dUpLQ0t0UUN0QXViOCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NzoiaHR0cDovL2xvY2FsaG9zdC9jbGllbnQtc2lkZS9wdWJsaWMvdXNlci9vcmRlcnMiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNToiaHR0cDovL2xvY2FsaG9zdC9jbGllbnQtc2lkZS9wdWJsaWMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxOTt9',1743472445),
('pMWllc3vlxL5OvgM9yWrsZCAOYVZaNfF1XKazBFm',NULL,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.3.1 Safari/605.1.15','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRHZ4bVRKVHdoMnJ1QlF2WVBFU014bkltRTR0dWJlbmw3aDJlMFg3OSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NzoiaHR0cDovL2xvY2FsaG9zdC9jbGllbnQtc2lkZS9wdWJsaWMvdXNlci9vcmRlcnMiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NzoiaHR0cDovL2xvY2FsaG9zdC9jbGllbnQtc2lkZS9wdWJsaWMvdXNlci9vcmRlcnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1743470167),
('RuittID815TN92jZqB70BMljS3Ln41YjfUhANNew',NULL,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUkNVSUhlU3l3WDd1S0VWd29TSkt5WWttaGZmYzBKaGs5NDFRUHM0dyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9sb2NhbGhvc3QvY2xpZW50LXNpZGUvcHVibGljL215bG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1743471460),
('xjRsJqUludQ6eWavz1ptDwA7RIvIl8d8kyXCsc51',NULL,'::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOEt1MUJPa24zT2hPdlFUbHVjVVpFUzRvbzZqbHVCYkpUQWxja1JZYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3QvY2xpZW50LXNpZGUvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1743471455);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(10,'許大米','pollylearnhsu@gmail.com',NULL,NULL,'2025-03-10 23:25:57','$2y$12$oeM9TP7A6yOb9fq2pT/H7uOHS6WqAnhwqbVpOa.fTP7G6GN1Zfgqm',NULL,'2025-03-10 23:25:57','2025-03-24 21:20:22'),
(19,'許少宇','nasa0824@gmail.com','0912345678',NULL,'2025-03-12 23:27:40','$2y$12$FgAcLzOBpV2keBfpARb3geTgvnIRyM0KaMl9g.P4TYc571KCCpdyu',NULL,'2025-03-12 23:27:40','2025-03-31 00:30:34'),
(20,'許','daniel@danielhsu.dev','0912345678',NULL,'2025-03-12 23:27:40','$2y$12$FgAcLzOBpV2keBfpARb3geTgvnIRyM0KaMl9g.P4TYc571KCCpdyu',NULL,'2025-03-12 23:27:40','2025-03-31 00:23:57');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `wishlists` (
  `id` bigint(20) unsigned NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`,`product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `wishlists_member_id_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlists`
--

LOCK TABLES `wishlists` WRITE;
/*!40000 ALTER TABLE `wishlists` DISABLE KEYS */;
/*!40000 ALTER TABLE `wishlists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-04-01 10:05:53
