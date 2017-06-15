-- MySQL dump 10.13  Distrib 5.5.53, for Win32 (AMD64)
--
-- Host: localhost    Database: blog
-- ------------------------------------------------------
-- Server version	5.5.53

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(30) NOT NULL,
  `QQ` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (7,'js','6f6220d2abf3111e83f2bb49e16ff05a','1062976570@qq.com',1062976570);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `article_type_id` int(5) NOT NULL,
  `keywords` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `view_times` int(10) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL,
  `introduction` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,'第一篇文章',1,'第一','我oioi',0,1497493846,'写的第一篇文章'),(2,'糊涂神',2,'糊涂','难得糊涂',0,1497496727,'关于糊涂'),(3,'大大世界',2,'大','大世界',0,1497497102,'关于世界'),(4,'My World',2,'world','<p>\r\n	<span style=\"font-size:18px;\"><br />\r\n</span> \r\n</p>\r\n<p>\r\n	<span style=\"font-size:18px;\"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;about world</span><span style=\"font-size:18px;\">about world</span><span style=\"font-size:18px;\">about world</span><span style=\"font-size:18px;\">about world</span><span style=\"font-size:18px;\">about world</span> \r\n</p>',0,1497497822,'about world'),(5,'第四篇文章',2,'第四','<p>\r\n	<span style=\"color:#337FE5;font-size:16px;\"><br />\r\n</span>\r\n</p>\r\n<p>\r\n	<span style=\"color:#337FE5;font-size:16px;\"><br />\r\n</span>\r\n</p>\r\n<p>\r\n	<span style=\"color:#337FE5;font-size:16px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;第四的一篇文章</span>\r\n</p>',0,1497498079,'第四的文章'),(6,'五',1,'五','五',0,1497498715,'五'),(7,'六',1,'六','六',0,1497498732,'六'),(8,'七',1,'七','七啊七',0,1497498744,'七'),(9,'八',1,'八','八',0,1497498756,'八'),(10,'九',1,'九','九',0,1497498768,'九'),(11,'十',2,'十','十',0,1497498780,'十'),(12,'第十四',1,'十四','苏菲的世界',0,1497517014,'blablabla'),(13,'乱乱的',1,'wonder','啥都乱乱的',0,1497517648,'没有'),(14,'二十一',1,'四','二十一',0,1497520304,'二十一'),(15,'二十二',1,'四','二十二',0,1497520328,'二十二'),(16,'二十三',1,'四','二十三',0,1497520360,'二十三'),(17,'二十四',1,'四','二十四',0,1497520372,'二十四'),(18,'二十五',1,'四','二十五',0,1497520384,'二十五'),(19,'二十六',1,'四','二十六',0,1497520398,'二十六'),(20,'二十七',1,'四','二十七',0,1497520412,'二十七'),(21,'二十八',1,'四','二十八',0,1497520429,'二十八'),(22,'二十九',1,'四','二十九',0,1497520444,'二十九'),(23,'三十',1,'四','三十',0,1497520458,'三十'),(24,'三十一',1,'四','三十一',0,1497520471,'三十一');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_type`
--

DROP TABLE IF EXISTS `article_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_type` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_type`
--

LOCK TABLES `article_type` WRITE;
/*!40000 ALTER TABLE `article_type` DISABLE KEYS */;
INSERT INTO `article_type` VALUES (1,'life'),(2,'skill');
/*!40000 ALTER TABLE `article_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `sex` smallint(1) NOT NULL,
  `signature` varchar(30) DEFAULT NULL,
  `avatar_path` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Jorelanbo',1,'Haircut really matters!','templates/images/js111.jpg');
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

-- Dump completed on 2017-06-15 18:40:29
