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
-- Table structure for table `proyectos`
--

DROP TABLE IF EXISTS `proyectos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyectos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `lugar` varchar(100) NOT NULL,
  `descripcion` varchar(400) NOT NULL,
  `nivel` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyectos`
--

LOCK TABLES `proyectos` WRITE;
/*!40000 ALTER TABLE `proyectos` DISABLE KEYS */;
INSERT INTO `proyectos` VALUES (1,'Real Míchigan','Parque de los patos','Birras, pitis, risas y boleros',8),(2,'Rostov','Zona Arge','Vodka, pitis ,risas y villancicos navideños',9),(3,'Real Palace','Ático de pepito','Birras, pitis, pelis, risas y boleros en la azotea',7),(4,'Kansas','Asia Kebab','La cena de todos los viernes',1),(5,'Manhattan','Cuando la cosa se pone sabrosa','Salir por patas cuando estas hasta los cojones',8),(6,'Florida','Casa de David','Lugar de alto riesgo de ciego involuntario',9),(7,'Orlando','Aseo de David','Una manzanilla en el aseo de David',8),(8,'Everest','San Miguel','Poleo en la cima de San Miguel',9),(9,'K-2','Santa Lucía','Un helado en la cima de Santa Lucía',7),(10,'Arizona','Parc de les Hortes','Un dorito en el Parc de les Hortes',7),(11,'Kilimanjaro','Ático de Eduardo','Birras, pizzas, pitis, risas y una manzanilla',9),(12,'Vodafone','Máquinas exprendedoras','Repostar fuerzas con buenos alimentos',3),(13,'Vietnam','Aleatorio','Nunca se sabe lo que puede pasar',10),(14,'Gran Cañón','Trompa del elefante','Un vinico con boleros en plena montaña',9),(15,'Mississippi','Parque de los patos','Buscar una infusión en el Parque de los patos',8),(16,'Ohio','La Casa','Buscar té en la casa de nuestro amigo',7),(17,'Puerto Vallarta','Casa del Loco','Birras, pizzas, pitis, risas y una manzanilla',9),(18,'BK','Alcoy','Salir por patas hacia el Burguer King',2),(19,'California','Casa Wani','Birras, risas, pizzas y boleros',6),(21,'Sarajevo','Emplazamiento random','Proyecto planeado que se declara de excesiva peligrosidad',10);
/*!40000 ALTER TABLE `proyectos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-04 22:10:32
