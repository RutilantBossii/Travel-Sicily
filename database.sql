-- MySQL dump 10.13  Distrib 8.4.9, for Linux (x86_64)
--
-- Host: localhost    Database: sicilyTravel
-- ------------------------------------------------------
-- Server version	8.4.9

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `place_user`
--

DROP TABLE IF EXISTS `place_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `place_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `place_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_user_place` (`user_id`,`place_id`),
  KEY `place_id` (`place_id`),
  CONSTRAINT `place_user_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`) ON DELETE CASCADE,
  CONSTRAINT `place_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `place_user`
--

LOCK TABLES `place_user` WRITE;
/*!40000 ALTER TABLE `place_user` DISABLE KEYS */;
INSERT INTO `place_user` VALUES (13,1,2,'2026-06-22 14:47:20','2026-06-22 14:47:20'),(19,4,2,'2026-06-22 16:24:57','2026-06-22 16:24:57'),(25,3,6,'2026-06-22 18:18:36','2026-06-22 18:18:36'),(26,4,6,'2026-06-22 18:29:28','2026-06-22 18:29:28'),(28,4,7,'2026-06-22 18:32:56','2026-06-22 18:32:56'),(29,5,7,'2026-06-22 18:33:49','2026-06-22 18:33:49'),(32,1,6,'2026-06-22 18:47:00','2026-06-22 18:47:00'),(34,2,9,'2026-06-22 19:06:32','2026-06-22 19:06:32');
/*!40000 ALTER TABLE `place_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `places`
--

DROP TABLE IF EXISTS `places`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `places` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `img` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `places`
--

LOCK TABLES `places` WRITE;
/*!40000 ALTER TABLE `places` DISABLE KEYS */;
INSERT INTO `places` VALUES (1,'images/places/castello_ursino.png','Castello Ursino','Fondato da Federico II di Svevia nel XIII secolo, il Castello Ursino è uno dei pochi monumenti di Catania sopravvissuti al terremoto del 1693 e alla colata lavica dell\'Etna del 1669, che un tempo ne lambiva le mura modificando la linea di costa. Oggi si presenta come un\'imponente fortezza a pianta quadrata con quattro grandi torri angolari e ospita il Museo Civico della città, custodendo collezioni archeologiche che spaziano dall\'epoca ellenistica e romana fino a pinacoteche d\'arte moderna e reperti medievali.',37.49876720,15.08472500,'2026-06-18 20:03:38','2026-06-18 20:03:38'),(2,'images/places/teatro_taormina.png','Teatro Antico di Taormina','Scavato direttamente nella roccia del Monte Tauro tra il III e il II secolo a.C., il Teatro Antico di Taormina è il secondo teatro più grande della Sicilia dopo quello di Siracusa. Originariamente concepito dai greci per le rappresentazioni drammatiche, fu successivamente modificato e ampliato dai romani per ospitare i combattimenti dei gladiatori. La sua fama mondiale è dovuta non solo alla straordinaria conservazione architettonica, ma soprattutto alla sua posizione panoramica mozzafiato: la cavea si apre su una vista spettacolare che abbraccia il mar Ionio, la costa calabra e l\'imponente profilo fumante dell\'Etna sullo sfondo.',37.85235750,15.29210210,'2026-06-18 20:15:33','2026-06-18 20:15:33'),(3,'images/places/tempio_segesta.png','Tempio di Segesta','Adagiato su una collina circondata da un suggestivo panorama selvaggio, il Tempio di Segesta è uno dei monumenti in stile dorico meglio conservati al mondo. Costruito alla fine del V secolo a.C. dagli Elimi, un\'antica popolazione della Sicilia occidentale fortemente influenzata dalla cultura greca, il tempio presenta una particolarità affascinante: non è mai stato completato. Mancano infatti la copertura del tetto e le scanalature delle sue 36 imponenti colonne. Questa incompletezza, unita al totale isolamento nella natura incontaminata, dona al sito un\'atmosfera senza tempo e di straordinaria bellezza archeologica.',37.94132890,12.83229040,'2026-06-18 20:17:10','2026-06-18 20:17:10'),(4,'images/places/universta_catania.png','Università di Catania','L\'Università degli Studi di Catania (UniCt), fondata nel 1444 dal re Alfonso V d\'Aragona, è il più antico ateneo della Sicilia e tra i maggiori in Italia per numero di iscritti. Con una ricca offerta formativa che spazia dalle discipline umanistiche e giuridiche a quelle scientifiche, ingegneristiche e biomediche, l\'ateneo è un polo strategico per l\'istruzione superiore e la ricerca scientifica nel Mediterraneo. Le sue strutture sono dislocate tra lo storico centro cittadino e il moderno polo tecnologico della Cittadella Universitaria.',37.94132890,12.83229040,'2026-06-20 18:19:43','2026-06-20 18:19:43'),(5,'images/places/scala_turchi.png','Scala dei Turchi','La Scala dei Turchi è una monumentale falesia di marna bianca situata lungo la costa di Realmonte, in provincia di Agrigento. Celebre in tutto il mondo per la sua singolare forma a gradoni naturali e per il contrasto cromatico tra l\'abbagliante bianco della roccia e il blu intenso del mare, deve il suo nome alle storiche incursioni dei pirati saraceni (chiamati convenzionalmente \"Turchi\"), che trovavano in questa baia un approdo sicuro e riparato dai venti per le loro navi. Oggi è uno dei siti naturalistici e turistici più iconici e fotografati della Sicilia.',37.94132890,12.83229040,'2026-06-20 18:19:47','2026-06-20 18:19:47');
/*!40000 ALTER TABLE `places` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_images`
--

DROP TABLE IF EXISTS `post_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_images` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `img_url` varchar(255) NOT NULL,
  `post_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `post_images_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_images`
--

LOCK TABLES `post_images` WRITE;
/*!40000 ALTER TABLE `post_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_user`
--

DROP TABLE IF EXISTS `post_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_user_post` (`user_id`,`post_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `post_user_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_user`
--

LOCK TABLES `post_user` WRITE;
/*!40000 ALTER TABLE `post_user` DISABLE KEYS */;
INSERT INTO `post_user` VALUES (25,6,2,'2026-06-22 13:27:28','2026-06-22 13:27:28'),(35,4,6,'2026-06-22 16:50:58','2026-06-22 16:50:58'),(36,16,6,'2026-06-22 17:12:58','2026-06-22 17:12:58'),(37,4,2,'2026-06-22 18:21:02','2026-06-22 18:21:02'),(42,5,2,'2026-06-22 18:21:13','2026-06-22 18:21:13'),(44,9,6,'2026-06-22 18:27:22','2026-06-22 18:27:22'),(45,18,7,'2026-06-22 18:33:12','2026-06-22 18:33:12'),(49,5,6,'2026-06-22 19:01:24','2026-06-22 19:01:24'),(52,21,9,'2026-06-22 19:06:54','2026-06-22 19:06:54'),(53,4,9,'2026-06-22 19:23:42','2026-06-22 19:23:42'),(54,6,9,'2026-06-22 19:23:44','2026-06-22 19:23:44'),(55,10,9,'2026-06-22 19:23:47','2026-06-22 19:23:47'),(56,9,9,'2026-06-22 19:23:50','2026-06-22 19:23:50'),(57,18,9,'2026-06-22 19:23:54','2026-06-22 19:23:54');
/*!40000 ALTER TABLE `post_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `user_id` int unsigned NOT NULL,
  `place_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `place_id` (`place_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (4,'Questi poveracci non hanno le mura :,(',2,3,'2026-06-20 00:13:57','2026-06-20 00:13:57'),(5,'Nome fuorviante, non vedo Orsi',6,1,'2026-06-20 00:15:07','2026-06-20 00:15:07'),(6,'Comunque meno antico delle slide di Misurazioni Elettroniche',6,2,'2026-06-20 00:16:28','2026-06-20 00:16:28'),(8,'Questo post esiste solo per fare numero',2,2,'2026-06-20 01:22:15','2026-06-20 01:22:15'),(9,'Questo messaggio include fini promozionali: Compra anche tu una Cavia Peruviana',7,2,'2026-06-20 15:42:56','2026-06-20 15:42:56'),(10,'Bella ma non ci vivrei',6,4,'2026-06-21 17:59:57','2026-06-21 17:59:57'),(14,'Sono passati 84 anni',2,4,'2026-06-22 16:24:53','2026-06-22 16:24:53'),(16,'Ma sti turchi che razza di gambe hanno?',6,5,'2026-06-22 17:12:53','2026-06-22 17:12:53'),(17,'Questo terreno sarebbe perfetto per un rifugio di porcellini d\'India',7,3,'2026-06-22 18:30:14','2026-06-22 18:30:14'),(18,'[MOD POWER SHOWCASE] Questo commento esiste per essere eliminato dal nostro glorioso moderatore, Josif \'RutilantBossi\' Stalin',7,4,'2026-06-22 18:32:56','2026-06-22 18:32:56'),(20,'Bello se si è ciechi',9,1,'2026-06-22 19:05:31','2026-06-22 19:05:31'),(21,'Fa freddo, costruite un tetto',9,2,'2026-06-22 19:06:33','2026-06-22 19:06:33');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT 'images/default-avatar.png',
  `cover` varchar(255) DEFAULT 'images/default-cover.png',
  `about` text,
  `lastfm_username` varchar(255) DEFAULT NULL,
  `lastfm_session_key` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `moderator` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nickname` (`nickname`),
  UNIQUE KEY `lastfm_username` (`lastfm_username`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'Matteo','04112002','images/profiles/etna.png','images/profiles/sicilia.png','Ciao, sono matteo un ragazzo profondamente traumatizzato da Analisi 1',NULL,NULL,'2026-06-19 16:46:14','2026-06-19 16:46:14',0),(6,'RutilantBossi','Zm_DysmlUKdK7X5esELEz9UpUaDG7Eyf','images/profiles/stalin.png','images/profiles/carri.png','1943 best year of my life','RutilantBossi','Zm_DysmlUKdK7X5esELEz9UpUaDG7Eyf','2026-06-19 18:30:40','2026-06-19 18:30:40',1),(7,'Veronica','12345678','images/profiles/capy.png','images/profiles/cavia.png','Mi piacciono tantissimo i roditori',NULL,NULL,'2026-06-20 15:41:43','2026-06-20 15:41:43',0),(9,'Born-To-Die','CiaoProf','images/default-avatar.png','images/default-cover.png','Nessuna descrizione fornita.',NULL,NULL,'2026-06-22 19:05:12','2026-06-22 19:05:12',0);
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

-- Dump completed on 2026-06-23  0:30:03
