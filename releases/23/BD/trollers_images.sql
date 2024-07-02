-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 52.23.241.94    Database: trollers
-- ------------------------------------------------------
-- Server version	5.7.28-0ubuntu0.18.04.4

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
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (4,'nochevieja.jpg'),(5,'denia.jpg'),(6,'carnaval.jpg'),(8,'realMichigan.jpg'),(9,'cachimba.jpg'),(12,'avis19.jpg'),(13,'micojuanmi.jpg'),(14,'ernesto2.jpg'),(16,'winter.jpg'),(17,'cumplemico.jpg'),(18,'mandarina.jpg'),(19,'sanpascual.jpg'),(21,'ernesto.jpg'),(22,'cumpleWani.jpg'),(24,'palace.jpg'),(25,'slav.jpg'),(26,'chapa.jpg'),(27,'avis15.jpg'),(28,'santaceci.jpg'),(29,'obos.jpg'),(31,'michigan.jpg'),(34,'rafa.jpg'),(35,'banda.jpg'),(50,'IMG-20190707-WA0004.jpg'),(53,'IMG-20180930-WA0031.jpg'),(54,'IMG-20190707-WA0003.jpg'),(55,'IMG-20181216-WA0008.jpg'),(56,'IMG-20190518-WA0051.jpg'),(57,'IMG-20190324-WA0001.jpg'),(58,'IMG-20191013-WA0008.jpeg'),(72,'F9E733B7-6AA3-4954-BB02-A206CE9ED44C.jpeg'),(73,'92BE5AFA-B81B-44EF-BE65-9CBD91BB09D0.jpeg'),(74,'01D795EA-7CC7-49C3-84DA-D5E0B39086EB.jpeg'),(75,'5E8BFE3C-D161-4338-ABBA-24482563B7A4.jpeg'),(85,'IMG-20190624-WA0020.jpg'),(86,'IMG-20190624-WA0015.jpg');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-04 22:10:30
