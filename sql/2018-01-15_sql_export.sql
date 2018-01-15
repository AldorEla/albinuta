-- MySQL dump 10.13  Distrib 5.6.33, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: albinuta
-- ------------------------------------------------------
-- Server version	5.6.33-0ubuntu0.14.04.1

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
-- Table structure for table `blog_post`
--

DROP TABLE IF EXISTS `blog_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `draft` tinyint(1) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BA5AE01D12469DE2` (`category_id`),
  CONSTRAINT `FK_BA5AE01D12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_post`
--

LOCK TABLES `blog_post` WRITE;
/*!40000 ALTER TABLE `blog_post` DISABLE KEYS */;
INSERT INTO `blog_post` VALUES (1,'My first blog post','<p>This is the conten of My first blog post</p>',1,1),(2,'Caracteristicile lui Eugen','<p>Prost</p>\r\n<p>Betiv</p>\r\n<p>Impotent</p>\r\n<p>Corupt</p>\r\n<p>Senil</p>\r\n<p>Bolnav</p>\r\n<p>Loser</p>\r\n<p>Mesterul curului</p>\r\n<p>Branza buna in burduf de caine</p>\r\n<p>Antisocial fara pereche</p>\r\n<p>Fara femei</p>\r\n<p>Branza cu mucegai</p>\r\n<p>Contaminat</p>\r\n<p>Incurabil</p>\r\n<p>Drogat</p>\r\n<p>Tradator</p>\r\n<p>Fitilos</p>\r\n<p>Habarnist</p>\r\n<p>Handicapat</p>\r\n<p>Null</p>\r\n<p>Senil</p>\r\n<p>Hartuitor</p>\r\n<p>Carcotas maxim</p>\r\n<p>Caine rau</p>',0,5);
/*!40000 ALTER TABLE `blog_post` ENABLE KEYS */;
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
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_64C19C1727ACA70` (`parent_id`),
  CONSTRAINT `FK_64C19C1727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Development',NULL),(2,'Audio',NULL),(3,'Book',NULL),(4,'Video',NULL),(5,'Eugen',NULL);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ext_log_entries`
--

DROP TABLE IF EXISTS `ext_log_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ext_log_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `logged_at` datetime NOT NULL,
  `object_id` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `object_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` int(11) NOT NULL,
  `data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_class_lookup_idx` (`object_class`),
  KEY `log_date_lookup_idx` (`logged_at`),
  KEY `log_user_lookup_idx` (`username`),
  KEY `log_version_lookup_idx` (`object_id`,`object_class`,`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ext_log_entries`
--

LOCK TABLES `ext_log_entries` WRITE;
/*!40000 ALTER TABLE `ext_log_entries` DISABLE KEYS */;
/*!40000 ALTER TABLE `ext_log_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ext_translations`
--

DROP TABLE IF EXISTS `ext_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ext_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `object_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `foreign_key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lookup_unique_idx` (`locale`,`object_class`,`field`,`foreign_key`),
  KEY `translations_lookup_idx` (`locale`,`object_class`,`foreign_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ext_translations`
--

LOCK TABLES `ext_translations` WRITE;
/*!40000 ALTER TABLE `ext_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `ext_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fos_user`
--

LOCK TABLES `fos_user` WRITE;
/*!40000 ALTER TABLE `fos_user` DISABLE KEYS */;
INSERT INTO `fos_user` VALUES (1,'ela','ela','elena.coman33@yahoo.com','elena.coman33@yahoo.com',1,NULL,'$2y$13$e0ZTXv3ymcSYi6PWhp436Oe0K4Je3K4ctTmzF2cNF7PDNnLPiWfPC','2018-01-10 09:49:05',NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),(2,'ela2','ela2','elena.coman33+1@gmail.com','elena.coman33+1@gmail.com',1,NULL,'$2y$13$MGM7V5ArG4qhUXHhWz6cyOF7p6yy4kztPja11Sboyh5KdeC37Iuqi','2017-11-01 08:34:21',NULL,NULL,'a:0:{}');
/*!40000 ALTER TABLE `fos_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media__gallery`
--

DROP TABLE IF EXISTS `media__gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media__gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `context` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `default_format` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media__gallery`
--

LOCK TABLES `media__gallery` WRITE;
/*!40000 ALTER TABLE `media__gallery` DISABLE KEYS */;
/*!40000 ALTER TABLE `media__gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media__gallery_media`
--

DROP TABLE IF EXISTS `media__gallery_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media__gallery_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_80D4C5414E7AF8F` (`gallery_id`),
  KEY `IDX_80D4C541EA9FDD75` (`media_id`),
  CONSTRAINT `FK_80D4C5414E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `media__gallery` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_80D4C541EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media__gallery_media`
--

LOCK TABLES `media__gallery_media` WRITE;
/*!40000 ALTER TABLE `media__gallery_media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media__gallery_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media__media`
--

DROP TABLE IF EXISTS `media__media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media__media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `enabled` tinyint(1) NOT NULL,
  `provider_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_status` int(11) NOT NULL,
  `provider_reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_metadata` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `length` decimal(10,0) DEFAULT NULL,
  `content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content_size` int(11) DEFAULT NULL,
  `copyright` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `context` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cdn_is_flushable` tinyint(1) DEFAULT NULL,
  `cdn_flush_identifier` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cdn_flush_at` datetime DEFAULT NULL,
  `cdn_status` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media__media`
--

LOCK TABLES `media__media` WRITE;
/*!40000 ALTER TABLE `media__media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media__media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price_hunter`
--

DROP TABLE IF EXISTS `price_hunter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_hunter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `price_min` double NOT NULL,
  `price_max` double NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'noimage.jpg',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_hunter`
--

LOCK TABLES `price_hunter` WRITE;
/*!40000 ALTER TABLE `price_hunter` DISABLE KEYS */;
/*!40000 ALTER TABLE `price_hunter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `story`
--

DROP TABLE IF EXISTS `story`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `story` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `video` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'maxresdefault.jpg',
  `language` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recommended_age` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `genre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recommended_gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `story`
--

LOCK TABLES `story` WRITE;
/*!40000 ALTER TABLE `story` DISABLE KEYS */;
INSERT INTO `story` VALUES (2,'Disney Fairies Short: Bee\'s Eye','https://www.youtube.com/embed/i5q3CzTciSw?ecver=1','<p>Tink hits the bull\'s-eye with her own version of darts -- but what does Fairy Mary think?</p>','2017-05-30 11:17:06','2017-10-10 16:19:47','59dcc8f38d8b7_maxresdefault.jpg',NULL,NULL,NULL,NULL,NULL),(3,'The Hive','https://www.youtube.com/embed/226QBLjWKiI?ecver=1','<p>Buzzbee wants to go out to play but has to tidy his room first. He gets distracted with all the fun things he can do in his room and starts playing ball. Mum reminds him that he\'s supposed to be tidying, and then they can have some fun!</p>','2017-05-30 11:17:06','2017-09-25 15:49:43','59c8ea73ad904.jpg',NULL,NULL,NULL,NULL,NULL),(4,'Noi, albinele - Calin Gruia','https://www.youtube.com/embed/ftYVl4um41w?ecver=1','<p>Trantorul a plecat sa se plimbe prin gradina şi s-a &icirc;ntors seara tarziu. Nu era obosit cand a intrat &icirc;n stup. De ce sa fie? De somn? A dormit pe o floare de nalba&hellip; A visat ceva, tolanit pe un trandafir roşu&hellip; S-a certat cu un fluture&hellip; A vorbit ceva cu o viespe. Şi ziua a trecut. Atata paguba! Maine o sa fie alta zi, gandi trantorul şi se-ndrepta repede spre sala de mese a stupului. Nu gasi pe nimeni acolo. Şi nu-şi vazu nici ceaşca pe nicaieri. Suparat, &icirc;ncepu sa strige:</p>\r\n<p>&ndash; Ei, dar unde-i ceşcuţa mea? Unde-i cornuleţul meu?&hellip; Nemaipomenit&hellip;</p>\r\n<p>O albina mai &icirc;n varsta, cu o matura sub aripa, se apropie de el şi-i spune:</p>\r\n<p>&ndash; Nu te enerva&hellip; Mananci ce ai adus.</p>\r\n<p>&ndash; Nu &icirc;nţeleg ce vrei sa spui&hellip;</p>\r\n<p>&ndash; Nu ţi se mai da mancare de azi &icirc;nainte, &icirc;i spuse batrana albina.</p>\r\n<p>&ndash; Dar mor de foame. Nu se poate&hellip; Am tot dreptul la porţia mea!.</p>\r\n<p>&ndash; Poftim matura, fa curaţenie pe sub cei doi faguri&hellip;</p>\r\n<p>&ndash; Eu? Eu cu matura?&hellip; Dar n-am muncit niciodata.</p>\r\n<p>&ndash; Ei, vezi?&hellip; Asta-i pricina&hellip; Noi muncim şi noi mancam&hellip; mierea nu pica din cer&hellip; Nu te trimite nimeni sa alergi prin flori&hellip; Dar de curaţat, de reparat, de aerisit, de adus apa la pui, de luptat cu duşmanii noştri din afara, ma rog, se gaseste de lucru&hellip;</p>\r\n<p>&ndash; Şi cine a hotarat toate astea?&hellip;</p>\r\n<p>&ndash; Noi, albinele&hellip;</p>\r\n<p>&ndash; Am sa ma plang &icirc;mpotriva voastra&hellip;</p>\r\n<p>&ndash; N-ai decat&hellip;</p>\r\n<p>&ndash; Am sa ma plang stapanului prisacii&hellip; 0 sa vedeţi voi. O sa va para rau!</p>\r\n<p>Şi trantorul, suparat, ieşi pe urdiniş&hellip; Pe unde o fi umblat, n-a putut sa afle nimeni. Daca-l intalniţi cumva, explicaţi-i voi cum stau lucrurile cu cei care nu vor sa munceasca.</p>','2017-05-30 11:17:06','2017-10-31 12:56:46','59de19c495b0a_aum-albinuta.jpg','English','3+','Short film','Animation Comedy',NULL),(5,'Story','https://www.youtube.com/embed/i5q3CzTciSw?ecver=1','<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>','2017-05-30 11:49:47','2017-10-16 16:29:09','59e4b4251676d_Aulii-Cravalho-as-Moana-Waialiki-03.jpg',NULL,NULL,NULL,NULL,NULL),(6,'Story added via Sonata Admin','https://www.youtube.com/embed/i5q3CzTciSw?ecver=1','<p>Tink hits the bull\'s-eye with her own version of darts -- but what does Fairy Mary think?</p>','2017-10-10 14:27:54','2017-10-10 14:27:54','59dcaeba6e236_maxresdefault.jpg',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `story` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_389B7838DB60186` (`task_id`),
  CONSTRAINT `FK_389B7838DB60186` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (1,NULL,'tag 1 for test'),(2,NULL,'tag 2 for test'),(3,NULL,'tag 1 for test'),(4,NULL,'tag 2 for test');
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (10,'Description test'),(11,'Description test');
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-15 11:27:44
