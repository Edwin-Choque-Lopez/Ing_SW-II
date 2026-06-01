-- MySQL dump 10.13  Distrib 8.0.45, for Linux (x86_64)
--
-- Host: localhost    Database: bd_ignacio
-- ------------------------------------------------------
-- Server version	8.0.45

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
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_origin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'Honda','Japón',NULL,'2026-05-12 03:30:23','2026-05-18 06:54:34'),(2,'Mazda','Japón',NULL,'2026-05-12 03:40:26','2026-05-18 06:54:51'),(3,'Nissan','Japón',NULL,'2026-05-12 03:43:31','2026-05-18 06:55:16'),(4,'Mitsubishi','Japón',NULL,'2026-05-12 03:43:52','2026-05-18 06:55:32'),(5,'Toyota','Japón',NULL,'2026-05-17 00:58:21','2026-05-18 06:55:46'),(6,'Suzuki','Japón',NULL,'2026-05-17 00:59:20','2026-05-18 06:56:08'),(7,'Jac','China',NULL,'2026-05-18 06:56:47','2026-05-18 06:56:47'),(8,'Foton','China',NULL,'2026-05-18 06:57:02','2026-05-18 06:57:02'),(9,'Generico',NULL,NULL,'2026-05-20 00:51:21','2026-05-20 00:51:21');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('laravel-cache-alied@gmial.com|127.0.0.1','i:1;',1778979401),('laravel-cache-alied@gmial.com|127.0.0.1:timer','i:1778979401;',1778979401),('laravel-cache-boost:mcp:database-schema:mysql:clients:0:0:0:1','a:2:{s:6:\"engine\";s:5:\"mysql\";s:6:\"tables\";a:1:{s:7:\"clients\";a:5:{s:7:\"columns\";a:8:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:2:\"ci\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"full_name\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:5:\"phone\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:5:\"email\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"deleted_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:2:{s:17:\"clients_ci_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"ci\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}}}',1778649690),('laravel-cache-boost:mcp:database-schema:mysql:products:0:0:0:1','a:2:{s:6:\"engine\";s:5:\"mysql\";s:6:\"tables\";a:2:{s:8:\"products\";a:5:{s:7:\"columns\";a:16:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:3:\"oem\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:4:\"name\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:11:\"category_id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:8:\"brand_id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"status_id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:19:\"compatibility_notes\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:15:\"technical_specs\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"price_buy\";a:4:{s:4:\"type\";s:13:\"decimal(10,2)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"price_sell\";a:4:{s:4:\"type\";s:13:\"decimal(10,2)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:5:\"stock\";a:4:{s:4:\"type\";s:3:\"int\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"min_stock\";a:4:{s:4:\"type\";s:3:\"int\";s:8:\"nullable\";b:0;s:7:\"default\";s:1:\"5\";s:14:\"auto_increment\";b:0;}s:10:\"image_main\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"deleted_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:5:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:25:\"products_brand_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:8:\"brand_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:28:\"products_category_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:11:\"category_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:19:\"products_oem_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:3:\"oem\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:26:\"products_status_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:9:\"status_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:3:{i:0;a:7:{s:4:\"name\";s:25:\"products_brand_id_foreign\";s:7:\"columns\";a:1:{i:0;s:8:\"brand_id\";}s:14:\"foreign_schema\";s:10:\"bd_ignacio\";s:13:\"foreign_table\";s:6:\"brands\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}i:1;a:7:{s:4:\"name\";s:28:\"products_category_id_foreign\";s:7:\"columns\";a:1:{i:0;s:11:\"category_id\";}s:14:\"foreign_schema\";s:10:\"bd_ignacio\";s:13:\"foreign_table\";s:10:\"categories\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}i:2;a:7:{s:4:\"name\";s:26:\"products_status_id_foreign\";s:7:\"columns\";a:1:{i:0;s:9:\"status_id\";}s:14:\"foreign_schema\";s:10:\"bd_ignacio\";s:13:\"foreign_table\";s:15:\"status_products\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:15:\"status_products\";a:5:{s:7:\"columns\";a:6:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:4:\"name\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:11:\"description\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"deleted_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}}}',1778656175),('laravel-cache-boost:mcp:database-schema:mysql:store_profiles:0:0:0:1','a:2:{s:6:\"engine\";s:5:\"mysql\";s:6:\"tables\";a:1:{s:14:\"store_profiles\";a:5:{s:7:\"columns\";a:12:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:4:\"name\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:3:\"nit\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:7:\"address\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:4:\"city\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";s:5:\"Oruro\";s:14:\"auto_increment\";b:0;}s:14:\"phone_whatsapp\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:5:\"email\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"logo_path\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:11:\"footer_text\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"deleted_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}}}',1778644445),('laravel-cache-boost.roster.scan','a:2:{s:6:\"roster\";O:21:\"Laravel\\Roster\\Roster\":3:{s:13:\"\0*\0approaches\";O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:11:\"\0*\0packages\";O:32:\"Laravel\\Roster\\PackageCollection\":2:{s:8:\"\0*\0items\";a:10:{i:0;O:22:\"Laravel\\Roster\\Package\":8:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^12.0\";s:9:\"\0*\0source\";E:43:\"Laravel\\Roster\\Enums\\PackageSource:COMPOSER\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:LARAVEL\";s:14:\"\0*\0packageName\";s:17:\"laravel/framework\";s:10:\"\0*\0version\";s:7:\"12.54.1\";s:6:\"\0*\0dev\";b:0;s:7:\"\0*\0path\";s:86:\"/home/edwin/Documentos/Proyectos laravel/ISW2_Ignacio_Systems/vendor/laravel/framework\";}i:1;O:22:\"Laravel\\Roster\\Package\":8:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:7:\"v0.3.14\";s:9:\"\0*\0source\";r:11;s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PROMPTS\";s:14:\"\0*\0packageName\";s:15:\"laravel/prompts\";s:10:\"\0*\0version\";s:6:\"0.3.14\";s:6:\"\0*\0dev\";b:0;s:7:\"\0*\0path\";s:84:\"/home/edwin/Documentos/Proyectos laravel/ISW2_Ignacio_Systems/vendor/laravel/prompts\";}i:2;O:22:\"Laravel\\Roster\\Package\":8:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^2.0\";s:9:\"\0*\0source\";r:11;s:10:\"\0*\0package\";E:35:\"Laravel\\Roster\\Enums\\Packages:BOOST\";s:14:\"\0*\0packageName\";s:13:\"laravel/boost\";s:10:\"\0*\0version\";s:5:\"2.3.1\";s:6:\"\0*\0dev\";b:1;s:7:\"\0*\0path\";s:82:\"/home/edwin/Documentos/Proyectos laravel/ISW2_Ignacio_Systems/vendor/laravel/boost\";}i:3;O:22:\"Laravel\\Roster\\Package\":8:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"v0.6.2\";s:9:\"\0*\0source\";r:11;s:10:\"\0*\0package\";E:33:\"Laravel\\Roster\\Enums\\Packages:MCP\";s:14:\"\0*\0packageName\";s:11:\"laravel/mcp\";s:10:\"\0*\0version\";s:5:\"0.6.2\";s:6:\"\0*\0dev\";b:1;s:7:\"\0*\0path\";s:80:\"/home/edwin/Documentos/Proyectos laravel/ISW2_Ignacio_Systems/vendor/laravel/mcp\";}i:4;O:22:\"Laravel\\Roster\\Package\":8:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^1.2.2\";s:9:\"\0*\0source\";r:11;s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PAIL\";s:14:\"\0*\0packageName\";s:12:\"laravel/pail\";s:10:\"\0*\0version\";s:5:\"1.2.6\";s:6:\"\0*\0dev\";b:1;s:7:\"\0*\0path\";s:81:\"/home/edwin/Documentos/Proyectos laravel/ISW2_Ignacio_Systems/vendor/laravel/pail\";}i:5;O:22:\"Laravel\\Roster\\Package\":8:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.24\";s:9:\"\0*\0source\";r:11;s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PINT\";s:14:\"\0*\0packageName\";s:12:\"laravel/pint\";s:10:\"\0*\0version\";s:6:\"1.29.0\";s:6:\"\0*\0dev\";b:1;s:7:\"\0*\0path\";s:81:\"/home/edwin/Documentos/Proyectos laravel/ISW2_Ignacio_Systems/vendor/laravel/pint\";}i:6;O:22:\"Laravel\\Roster\\Package\":8:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.41\";s:9:\"\0*\0source\";r:11;s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:SAIL\";s:14:\"\0*\0packageName\";s:12:\"laravel/sail\";s:10:\"\0*\0version\";s:6:\"1.53.0\";s:6:\"\0*\0dev\";b:1;s:7:\"\0*\0path\";s:81:\"/home/edwin/Documentos/Proyectos laravel/ISW2_Ignacio_Systems/vendor/laravel/sail\";}i:7;O:22:\"Laravel\\Roster\\Package\":8:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^4.4\";s:9:\"\0*\0source\";r:11;s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PEST\";s:14:\"\0*\0packageName\";s:12:\"pestphp/pest\";s:10:\"\0*\0version\";s:5:\"4.4.2\";s:6:\"\0*\0dev\";b:1;s:7:\"\0*\0path\";s:81:\"/home/edwin/Documentos/Proyectos laravel/ISW2_Ignacio_Systems/vendor/pestphp/pest\";}i:8;O:22:\"Laravel\\Roster\\Package\":8:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:7:\"12.5.12\";s:9:\"\0*\0source\";r:11;s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PHPUNIT\";s:14:\"\0*\0packageName\";s:15:\"phpunit/phpunit\";s:10:\"\0*\0version\";s:7:\"12.5.12\";s:6:\"\0*\0dev\";b:1;s:7:\"\0*\0path\";s:84:\"/home/edwin/Documentos/Proyectos laravel/ISW2_Ignacio_Systems/vendor/phpunit/phpunit\";}i:9;O:22:\"Laravel\\Roster\\Package\":8:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^4.0.0\";s:9:\"\0*\0source\";E:38:\"Laravel\\Roster\\Enums\\PackageSource:NPM\";s:10:\"\0*\0package\";E:41:\"Laravel\\Roster\\Enums\\Packages:TAILWINDCSS\";s:14:\"\0*\0packageName\";s:11:\"tailwindcss\";s:10:\"\0*\0version\";s:5:\"4.2.1\";s:6:\"\0*\0dev\";b:1;s:7:\"\0*\0path\";s:86:\"/home/edwin/Documentos/Proyectos laravel/ISW2_Ignacio_Systems/node_modules/tailwindcss\";}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:21:\"\0*\0nodePackageManager\";E:43:\"Laravel\\Roster\\Enums\\NodePackageManager:NPM\";}s:9:\"timestamp\";i:1778644422;}',1778730822);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_short` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Sistema Eléctrico y Sensores','rrrrr',NULL,NULL,'2026-05-12 02:09:46','2026-05-17 00:57:45'),(2,'Motor y Componentes',NULL,NULL,NULL,'2026-05-12 02:16:11','2026-05-12 02:16:11'),(3,'Suspensión y Transmisión',NULL,NULL,NULL,'2026-05-12 02:17:12','2026-05-12 02:17:12'),(4,'Sistema de Frenos y Embrague',NULL,NULL,NULL,'2026-05-12 02:17:30','2026-05-12 02:17:30'),(5,'Sensores IAC','432423',1,NULL,'2026-05-12 02:18:12','2026-05-12 02:58:40'),(6,'Sensores de Temperatura',NULL,1,NULL,'2026-05-12 02:22:03','2026-05-18 06:59:35'),(7,'Alternadores y Arranques',NULL,1,NULL,'2026-05-12 02:22:38','2026-05-18 06:59:59'),(8,'Cilindros Maestros y Esclavos',NULL,4,NULL,'2026-05-12 02:22:52','2026-05-12 03:04:57'),(9,'Componentes de Motor',NULL,2,NULL,'2026-05-13 21:02:05','2026-05-18 07:00:26'),(10,'Bombas de Agua y Termostatos',NULL,2,NULL,'2026-05-13 21:02:41','2026-05-18 07:00:50'),(11,'Juntas Homocinéticas',NULL,3,NULL,'2026-05-18 07:01:26','2026-05-18 07:01:26'),(12,'Rodamientos y Mazas',NULL,3,NULL,'2026-05-18 07:01:41','2026-05-18 07:01:41'),(13,'Pastillas y Balatas',NULL,4,NULL,'2026-05-18 07:02:49','2026-05-18 07:02:49');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ci` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_ci_unique` (`ci`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'7352409','Edwin Choque Lopez','64302059','echoque09@gmail.com',NULL,'2026-05-13 05:29:58','2026-05-18 07:20:04'),(2,'69923456','Jhanet Ana Maria Flores Caceres','62840616','JhanetAna@gmail.com',NULL,'2026-05-13 05:36:44','2026-05-18 07:23:50'),(3,'5943155','Marco Antonio Gutierrez Beltran','71856386','marco93@gmail.com',NULL,'2026-05-20 01:45:07','2026-05-20 01:45:07'),(4,'7879613','Alvaro Vargas Huanaco','68247642','alvarito89@gmail.com',NULL,'2026-05-20 01:48:04','2026-05-20 01:48:04'),(5,'7293530','Dennise Paola Padilla Cruz','60412060','deniss3paola@gmail.com',NULL,'2026-05-20 01:49:48','2026-05-20 01:49:48'),(6,'7372726','Nataly Rodriguez Ramirez','71854364','naty237@gmail.com',NULL,'2026-05-20 01:51:19','2026-05-20 01:51:19'),(7,'3248923','Cesar Arturo Miranda Guarachi','71454423','cesararturo@gmail.com',NULL,'2026-05-20 01:53:37','2026-05-20 01:53:37'),(8,'9879060','Edgar Claudio Vadillo Hilaquita','75401467','asdas@gmail.com',NULL,'2026-05-20 01:54:58','2026-05-20 01:54:58'),(9,'7248954','Jesus Jhonatan Macias Mamani','76137027','jesusmamani@gmail.com',NULL,'2026-05-20 01:56:45','2026-05-20 01:56:45'),(10,'5746193','WIlfredo Achocalla Cena','67255099','wilfredo776@gmail.com',NULL,'2026-05-20 01:58:16','2026-05-20 01:58:16'),(11,'7278635','Daniel Eduardo Uberguaga Chungara','69582256','daniEdu@gmail.com',NULL,'2026-05-20 01:59:46','2026-05-20 01:59:46');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
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
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_03_30_121958_create_store_profiles_table',1),(5,'2026_03_30_122005_create_categories_table',1),(6,'2026_03_30_122015_create_brands_table',1),(7,'2026_03_30_122017_create_status_reservations_table',1),(8,'2026_03_30_122018_create_status_products_table',1),(9,'2026_03_30_122030_create_products_table',1),(10,'2026_03_30_122040_create_clients_table',1),(11,'2026_03_30_122053_create_reservations_table',1),(12,'2026_03_30_122126_create_reservation_items_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `oem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint unsigned NOT NULL,
  `brand_id` bigint unsigned NOT NULL,
  `status_id` bigint unsigned NOT NULL,
  `compatibility_notes` text COLLATE utf8mb4_unicode_ci,
  `technical_specs` text COLLATE utf8mb4_unicode_ci,
  `price_buy` decimal(10,2) NOT NULL,
  `price_sell` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `min_stock` int NOT NULL DEFAULT '5',
  `image_main` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_oem_unique` (`oem`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_brand_id_foreign` (`brand_id`),
  KEY `products_status_id_foreign` (`status_id`),
  CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status_products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'31100P0AA01','Motor de Arranque / Alternador',7,1,2,'MODELO: HONDA','ACCORD 1994',100.00,110.00,45,15,'products/PROD1.jpg',NULL,'2026-05-13 07:14:33','2026-05-18 07:08:13'),(2,'J5T23281','Sensor de Posición / Componente',5,2,2,NULL,'MODELO: MAZDA 2 3 323',100.00,110.00,1000,20,'products/PROD2.jpg',NULL,'2026-05-13 21:07:49','2026-05-18 07:10:31'),(3,'30620-0650R','Repuesto Nissan',9,3,2,NULL,'MODELO: Nissan',100.00,1300.00,150,10,'products/PROD3.jpg',NULL,'2026-05-18 04:09:23','2026-05-18 07:14:25'),(4,'23250-75050','Inyector de Combustible',9,5,2,'MODELO: TOYOTA TACOMA 3RZ 95-04, 4RUNNER 3RZ 95-02',NULL,500.00,550.00,300,50,'products/PROD4.jpg',NULL,'2026-05-18 07:17:02','2026-05-18 07:17:03'),(5,'402027S000','Maza de Rueda / Rodamiento',12,3,1,NULL,'MODELO: Nissan',450.00,500.00,15,20,'products/PROD5.jpg',NULL,'2026-05-18 07:19:21','2026-05-18 07:19:21'),(6,'SB-4822','Rótula de Suspensión',11,9,2,NULL,'Marca de repuesto \"Sankei 555\" o similar',160.00,170.00,100,10,'products/PROD6.jpg',NULL,'2026-05-20 00:53:03','2026-05-20 00:53:04'),(7,'13234-53J01','Balancín / Componente de Válvula',9,3,2,'Componente interno de motor Nissan',NULL,230.00,240.00,150,20,'products/PROD7.jpg',NULL,'2026-05-20 00:55:09','2026-05-20 01:30:28'),(8,'55496663','Repuesto Eléctrico / Motor',9,9,1,'Revisar compatibilidad en catálogo físico',NULL,400.00,450.00,15,20,'products/PROD8.jpg',NULL,'2026-05-20 01:29:43','2026-05-20 01:29:43'),(9,'31470-60071','Cilindro Esclavo de Embrague',8,5,2,'Sistema de embrague Toyota',NULL,370.00,400.00,45,5,'products/PROD9.jpg',NULL,'2026-05-20 01:32:19','2026-05-20 01:32:19'),(10,'160310Y010','Termostato / Entrada Agua',10,5,2,'Repuesto de refrigeración',NULL,360.00,380.00,45,10,'products/PROD10.jpg',NULL,'2026-05-20 01:33:55','2026-05-20 01:33:55'),(11,'16100-80010','Bomba de Agua',10,5,2,'Compatible con motores Toyota comunes',NULL,420.00,450.00,150,10,'products/PROD11.jpg',NULL,'2026-05-20 01:35:21','2026-05-20 01:36:17'),(12,'35310-2S100','Inyector / Componente',9,9,1,NULL,'Datos de modelo no especificados',170.00,200.00,10,15,'products/PROD12.jpg',NULL,'2026-05-20 01:41:33','2026-05-20 01:41:33');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation_items`
--

DROP TABLE IF EXISTS `reservation_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservation_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reservation_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `unite_price` decimal(8,2) NOT NULL,
  `item_subtotal` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservation_items_reservation_id_foreign` (`reservation_id`),
  KEY `reservation_items_product_id_foreign` (`product_id`),
  CONSTRAINT `reservation_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reservation_items_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation_items`
--

LOCK TABLES `reservation_items` WRITE;
/*!40000 ALTER TABLE `reservation_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservation_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `code_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` bigint unsigned NOT NULL,
  `admin_notes` text COLLATE utf8mb4_unicode_ci,
  `total_amount` decimal(10,2) NOT NULL,
  `expiry_date` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reservations_code_order_unique` (`code_order`),
  KEY `reservations_client_id_foreign` (`client_id`),
  KEY `reservations_status_id_foreign` (`status_id`),
  CONSTRAINT `reservations_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `reservations_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status_reservations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
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
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `sessions` VALUES ('8EeO5jdcmgMTj7hjywFWOYonnpW9fj6bO2aXcFtY',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:150.0) Gecko/20100101 Firefox/150.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVGRoRVRFQjRYMmxWajNYbjBjamFoeE45eEZxNkhzWjFBcUhacHBmTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYXJhbWV0ZXJzIjtzOjU6InJvdXRlIjtzOjE2OiJwYXJhbWV0ZXJzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NzkyMzgwNzU7fX0=',1779242413),('QoYmq4eOEm7atGaAJj5p9SHn3vVh8khG2RO4B3Ta',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:150.0) Gecko/20100101 Firefox/150.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVDBkM1Z5bHk2QWZMaWhXSGt6QzRYUkpVa0tLZUhqUFZMOVlOVVdpUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1779238327);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_products`
--

DROP TABLE IF EXISTS `status_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status_products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_products`
--

LOCK TABLES `status_products` WRITE;
/*!40000 ALTER TABLE `status_products` DISABLE KEYS */;
INSERT INTO `status_products` VALUES (1,'Agotado','6tggtrhggbb  fgbf','2026-05-12 04:44:23','2026-05-13 21:04:02',NULL),(2,'Disponible','El producto tiene existencia en el inventerio.','2026-05-12 05:12:56','2026-05-12 05:44:10',NULL),(3,'Pedido',NULL,'2026-05-17 01:00:48','2026-05-18 07:03:53',NULL);
/*!40000 ALTER TABLE `status_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_reservations`
--

DROP TABLE IF EXISTS `status_reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status_reservations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_reservations`
--

LOCK TABLES `status_reservations` WRITE;
/*!40000 ALTER TABLE `status_reservations` DISABLE KEYS */;
INSERT INTO `status_reservations` VALUES (1,'Entregado','El pedido ya fue entregado al cliente.','2026-05-12 06:26:19','2026-05-12 06:55:24',NULL),(2,'Preparado','Pedido listo para la entrega.','2026-05-12 06:34:07','2026-05-12 07:05:01',NULL),(3,'Cancelado','Pedido que el cliente cancelo.','2026-05-12 06:34:46','2026-05-12 07:04:52',NULL);
/*!40000 ALTER TABLE `status_reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_profiles`
--

DROP TABLE IF EXISTS `store_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `store_profiles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Oruro',
  `phone_whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_text` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_profiles`
--

LOCK TABLES `store_profiles` WRITE;
/*!40000 ALTER TABLE `store_profiles` DISABLE KEYS */;
INSERT INTO `store_profiles` VALUES (1,'Casa Ignacio','4041849016','Calle Herrera Esquina Pagador N308 Zona Central Acera Oeste Plena Esquina','Oruro Bolivia','64392059','casaignacio@gmail.com','store_profiles/4041849016/4041849016.jpg','Venta de auto partes en la ciudad de Oruro.',NULL,NULL,'2026-05-13 04:25:10');
/*!40000 ALTER TABLE `store_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ci` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_ci_unique` (`ci`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'7352409','Alied Eddy Ignacio Tito','photos/7352409.jpg','alied@gmail.com',NULL,'$2y$12$z5Lr8uO/4JjZRhncT35MveIHvJy/YlDbDtJz8QAY25giwPxOLRP36',NULL,'2026-05-12 00:18:14','2026-05-13 02:01:58');
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

-- Dump completed on 2026-05-19 22:00:54
