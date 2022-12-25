-- MySQL dump 10.13  Distrib 8.0.31, for Linux (x86_64)
--
-- Host: localhost    Database: CurrencyConverter
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.20.04.2

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
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `currency` (
  `NumCode` int NOT NULL,
  `CharCode` char(3) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Nominal` float DEFAULT NULL,
  `Value` float DEFAULT NULL,
  `dt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CharCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currency`
--

LOCK TABLES `currency` WRITE;
/*!40000 ALTER TABLE `currency` DISABLE KEYS */;
INSERT INTO `currency` VALUES (51,'AMD','Армянских драмов',100,17.4389,'2022-12-25 08:16:26'),(944,'AZN','Азербайджанский манат',1,40.3976,'2022-12-25 08:16:25'),(975,'BGN','Болгарский лев',1,37.3361,'2022-12-25 08:16:26'),(986,'BRL','Бразильский реал',1,13.2405,'2022-12-25 08:16:27'),(933,'BYN','Белорусский рубль',1,25.5083,'2022-12-25 08:16:26'),(124,'CAD','Канадский доллар',1,50.29,'2022-12-25 08:16:28'),(756,'CHF','Швейцарский франк',1,73.7421,'2022-12-25 08:16:31'),(156,'CNY','Китайских юаней',10,97.5884,'2022-12-25 08:16:29'),(203,'CZK','Чешских крон',10,30.1581,'2022-12-25 08:16:31'),(208,'DKK','Датских крон',10,98.1927,'2022-12-25 08:16:27'),(978,'EUR','Евро',1,73.0407,'2022-12-25 08:16:28'),(826,'GBP','Фунт стерлингов Соединенного королевства',1,82.6172,'2022-12-25 08:16:25'),(344,'HKD','Гонконгских долларов',10,88.1931,'2022-12-25 08:16:27'),(348,'HUF','Венгерских форинтов',100,18.1875,'2022-12-25 08:16:27'),(356,'INR','Индийских рупий',100,82.9236,'2022-12-25 08:16:28'),(392,'JPY','Японских иен',100,51.7723,'2022-12-25 08:16:32'),(417,'KGS','Киргизских сомов',100,80.1541,'2022-12-25 08:16:29'),(410,'KRW','Вон Республики Корея',1000,53.6196,'2022-12-25 08:16:32'),(398,'KZT','Казахстанских тенге',100,14.7064,'2022-12-25 08:16:28'),(498,'MDL','Молдавских леев',10,35.6144,'2022-12-25 08:16:29'),(578,'NOK','Норвежских крон',10,69.6751,'2022-12-25 08:16:29'),(985,'PLN','Польский злотый',1,15.682,'2022-12-25 08:16:29'),(946,'RON','Румынский лей',1,14.8714,'2022-12-25 08:16:29'),(752,'SEK','Шведских крон',10,65.5612,'2022-12-25 08:16:31'),(702,'SGD','Сингапурский доллар',1,50.7883,'2022-12-25 08:16:30'),(972,'TJS','Таджикских сомони',10,67.278,'2022-12-25 08:16:30'),(934,'TMT','Новый туркменский манат',1,19.6217,'2022-12-25 08:16:31'),(949,'TRY','Турецких лир',10,36.7861,'2022-12-25 08:16:30'),(980,'UAH','Украинских гривен',10,18.5947,'2022-12-25 08:16:31'),(840,'USD','Доллар США',1,68.676,'2022-12-25 08:16:28'),(860,'UZS','Узбекских сумов',10000,61.1797,'2022-12-25 08:16:31'),(960,'XDR','СДР (специальные права заимствования)',1,91.4373,'2022-12-25 08:16:30'),(710,'ZAR','Южноафриканских рэндов',10,40.1285,'2022-12-25 08:16:32');
/*!40000 ALTER TABLE `currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-25 22:49:05
