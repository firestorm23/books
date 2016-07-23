-- MySQL dump 10.13  Distrib 5.7.13, for Linux (x86_64)
--
-- Host: localhost    Database: vacancy2
-- ------------------------------------------------------
-- Server version	5.7.13

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
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` int(11) DEFAULT NULL,
  `name` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datePublished` datetime NOT NULL,
  `description` varchar(4096) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CBE5A33193CB796C` (`file_id`),
  CONSTRAINT `FK_CBE5A33193CB796C` FOREIGN KEY (`file_id`) REFERENCES `file` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES (1,1,'Строительство бани','','2016-07-23 13:00:34','<p>&nbsp;Строительство бани&nbsp;&nbsp;Строительство бани&nbsp;&nbsp;Строительство бани&nbsp;&nbsp;Строительство бани&nbsp;&nbsp;Строительство бани&nbsp;&nbsp;Строительство бани&nbsp;&nbsp;Строительство бани &nbsp;</p>',90),(2,3,'Складываем оригами','','2016-07-14 13:08:47','<p>Оригами&nbsp;Оригами&nbsp;Оригами&nbsp;Оригами&nbsp;Оригами&nbsp;Оригами&nbsp;Оригами&nbsp;Оригами&nbsp;Оригами&nbsp;Оригами&nbsp;Оригами&nbsp;</p>',100),(3,5,'Игры на воздухе','','2016-07-13 16:15:27','<p><img src=\"/upload/57937c58b6dc6.jpg\" alt=\"\" width=\"200\" /></p>\r\n<p>Игры на воздухе&nbsp;Игры на воздухе&nbsp;Игры на воздухе&nbsp;Игры на воздухе&nbsp;Игры на воздухе</p>',20),(4,6,'Игра на гитаре','','2016-07-13 16:17:42','<p><strong>Игры на воздухе&nbsp;<strong>Игры на воздухе &nbsp;<strong>Игры на воздухе &nbsp;<strong>Игры на воздухе &nbsp;<strong>Игры на воздухе &nbsp;<strong>Игры на воздухе&nbsp;</strong></strong></strong></strong></strong></strong></p>',20),(5,7,'Строительство','','2016-07-05 16:19:32','<p>Текст&nbsp;Текст &nbsp;Текст &nbsp;Текст &nbsp;Текст&nbsp;Текст&nbsp;Текст&nbsp;</p>',10);
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book_category`
--

DROP TABLE IF EXISTS `book_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_category` (
  `book_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`,`category_id`),
  KEY `IDX_1FB30F9816A2B381` (`book_id`),
  KEY `IDX_1FB30F9812469DE2` (`category_id`),
  CONSTRAINT `FK_1FB30F9812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_1FB30F9816A2B381` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_category`
--

LOCK TABLES `book_category` WRITE;
/*!40000 ALTER TABLE `book_category` DISABLE KEYS */;
INSERT INTO `book_category` VALUES (1,2),(1,3),(2,3),(2,4),(3,4),(4,3),(4,4),(5,2);
/*!40000 ALTER TABLE `book_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateAdded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (2,'Строительство','2016-07-05 13:01:34'),(3,'Обучающие','2016-07-13 13:07:36'),(4,'Досуг','2016-07-05 13:09:38');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `originalName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dirname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mimetype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file`
--

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` VALUES (1,'57934ebbaedcf.txt','57934ebbaedcf.txt','/upload','txt','text/plain'),(2,'57935063ad4d6.jpg','57935063ad4d6.jpg','/upload','jpg','image/png'),(3,'579350794f0ad.png','579350794f0ad.png','/upload','png','image/png'),(4,'57937c58b6dc6.jpg','57937c58b6dc6.jpg','/upload','jpg','image/jpeg'),(5,'57937c6e019a8.txt','57937c6e019a8.txt','/upload','txt','text/plain'),(6,'57937cb395b9b.txt','57937cb395b9b.txt','/upload','txt','text/plain'),(7,'57937d22b3552.txt','57937d22b3552.txt','/upload','txt','text/plain');
/*!40000 ALTER TABLE `file` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-23 17:31:46
