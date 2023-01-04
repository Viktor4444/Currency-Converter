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
-- Table structure for table `LatestTablesUpdateDate`
--

DROP TABLE IF EXISTS `LatestTablesUpdateDate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `LatestTablesUpdateDate` (
  `TableID` int NOT NULL AUTO_INCREMENT,
  `TableName` varchar(255) DEFAULT NULL,
  `LatestUpdate` date DEFAULT NULL,
  PRIMARY KEY (`TableID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LatestTablesUpdateDate`
--

LOCK TABLES `LatestTablesUpdateDate` WRITE;
/*!40000 ALTER TABLE `LatestTablesUpdateDate` DISABLE KEYS */;
INSERT INTO `LatestTablesUpdateDate` VALUES (1,'currency','2023-01-04'),(2,'user','2023-01-04');
/*!40000 ALTER TABLE `LatestTablesUpdateDate` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY (`CharCode`),
  UNIQUE KEY `id` (`CharCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currency`
--

LOCK TABLES `currency` WRITE;
/*!40000 ALTER TABLE `currency` DISABLE KEYS */;
INSERT INTO `currency` VALUES (51,'AMD','Армянских драмов',100,17),(36,'AUD','Австралийский доллар',1,47),(944,'AZN','Азербайджанский манат',1,41),(975,'BGN','Болгарский лев',1,38),(986,'BRL','Бразильский реал',1,13),(933,'BYN','Белорусский рубль',1,25),(124,'CAD','Канадский доллар',1,51),(756,'CHF','Швейцарский франк',1,76),(156,'CNY','Китайских юаней',10,98),(203,'CZK','Чешских крон',10,30),(208,'DKK','Датская крона',1,10),(978,'EUR','Евро',1,75),(826,'GBP','Фунт стерлингов Соединенного королевства',1,84),(344,'HKD','Гонконгских долларов',10,90),(348,'HUF','Венгерских форинтов',100,18),(356,'INR','Индийских рупий',100,84),(392,'JPY','Японских иен',100,53),(417,'KGS','Киргизских сомов',100,82),(410,'KRW','Вон Республики Корея',1000,55),(398,'KZT','Казахстанских тенге',100,15),(498,'MDL','Молдавских леев',10,36),(578,'NOK','Норвежских крон',10,71),(985,'PLN','Польский злотый',1,16),(946,'RON','Румынский лей',1,15),(1,'RUB','Российский рубль',1,1),(752,'SEK','Шведских крон',10,67),(702,'SGD','Сингапурский доллар',1,52),(972,'TJS','Таджикских сомони',10,68),(934,'TMT','Новый туркменский манат',1,20),(949,'TRY','Турецких лир',10,37),(980,'UAH','Украинских гривен',10,19),(840,'USD','Доллар США',1,70),(860,'UZS','Узбекских сумов',10000,62),(960,'XDR','СДР (специальные права заимствования)',1,93),(710,'ZAR','Южноафриканских рэндов',10,41);
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
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

-- Dump completed on 2023-01-04 22:08:37
