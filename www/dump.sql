-- MySQL dump 10.13  Distrib 5.6.10, for osx10.8 (x86_64)
--
-- Host: localhost    Database: dlcc
-- ------------------------------------------------------
-- Server version	5.6.10

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
-- Table structure for table `attraction`
--

DROP TABLE IF EXISTS `attraction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attraction` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(127) NOT NULL,
  `address` varchar(255) NOT NULL DEFAULT '',
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `phone` varchar(31) NOT NULL DEFAULT '',
  `website` varchar(400) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attraction`
--

LOCK TABLES `attraction` WRITE;
/*!40000 ALTER TABLE `attraction` DISABLE KEYS */;
INSERT INTO `attraction` VALUES (1,'Allegheny County Courthouse','5th Ave. and Grant St.',NULL,NULL,'412-350-5313',''),(2,'Andy Warhol Museum','117 Sandusky Street',40.448357,-80.002487,'412-237-8300','http://www.warhol.org/'),(3,'Carnegie Science Center','One Allegheny Avenue',40.446079,-80.017410,'412-237-3400','http://www.carnegiesciencecenter.org/'),(4,'Children’s Museum of Pittsburgh','10 Children\'s Way',40.452587,-80.007072,'412-322-5058','http://www.pittsburghkids.org/'),(5,'Duquesne Incline','1220 Grandview Avenue, Pittsburgh, PA 15211',40.438305,-80.018822,'412-381-1665','http://incline.pghfree.net/'),(6,'Fort Pitt Museum','101 Commonwealth Place',40.440674,-80.009735,'412-471-1764','http://www.heinzhistorycenter.org/secondary.aspx?id=296'),(7,'Heinz Field','Allegheny Avenue and North Shore Drive',40.446785,-80.017464,'412-697-7700','http://www.steelers.com/tickets-and-stadium/'),(8,'Heinz History Center','1212 Smallman St.',40.446323,-79.992805,'412-454-6000','http://www.heinzhistorycenter.org/'),(9,'National Aviary','Allegheny Commons',40.450298,-80.007195,'412-323-7235','http://www.aviary.org/'),(10,'PNC Park','115 Federal St.',40.448391,-80.003334,'412-323-5000','http://pittsburgh.pirates.mlb.com/pit/ballpark/index.jsp'),(11,'Point State Park','101 Commonwealth Place',40.440674,-80.009735,'412-471-0235','http://www.dcnr.state.pa.us/stateparks/findapark/point/index.htm'),(12,'Rivers Casino','777 Casino Dr',40.446632,-80.023140,'412-231-7777','http://www.theriverscasino.com/'),(13,'USS Requin','One Allegheny Avenue',40.446079,-80.017410,'412-237-1550',''),(14,'Benedum Center','803 Liberty Ave',40.442780,-79.999138,'412-456-6666','http://www.trustarts.org/events'),(15,'Byham Theater','101 Sixth Street',40.443851,-80.002609,'412-456-6666','http://www.trustarts.org/events'),(16,'Cabaret at Theater Square','655 Penn Avenue',40.443085,-80.000999,'412-325-6766','http://www.trustarts.org/events'),(17,'Harris Theater','809 Liberty Ave',40.442795,-79.998558,'412-682-4111','http://www.trustarts.org/events'),(18,'Wood Street Galleries','601 Wood Street',40.442184,-79.999466,'412-471-5605','http://www.woodstreetgalleries.org/home.html'),(19,'SPACE','812 Liberty Avenue',40.442715,-79.998680,'412-325-7723','http://www.spacepittsburgh.org/flash.html'),(20,'Future Tenant Gallery','819 Penn Avenue',40.443855,-79.998718,'412-325-7037','http://www.futuretenant.org/'),(21,'O’Reilly Theater','621 Penn Avenue',NULL,NULL,'412-316-1600','http://www.ppt.org/'),(22,'Heinz Hall','600 Penn Avenue',40.442680,-80.001450,'412-392-4900','http://pso.culturaldistrict.org/pso_home'),(23,'August Wilson Center for African American Culture','980 Liberty Avenue',40.443306,-79.995140,'412-258-2700','http://www.augustwilsoncenter.org/'),(24,'ToonSeum','945 Liberty Avenue',40.443604,-79.996468,'412-232-0199','http://www.toonseum.org/index.html'),(25,'Station Square','125 West Station Square Drive',40.433510,-80.004021,'800-859-8959','http://www.stationsquare.com/'),(26,'Consol','1001 Fifth Avenue',40.438824,-79.990845,'412-642-1800','http://www.consolenergycenter.com/'),(27,'Macy\'s','400 Fifth Avenue',40.439564,-79.998878,'412-232-2000','http://www.macys.com/'),(28,'Market Square','24 Market Square',40.441139,-80.002808,'412-566-4190','http://www.downtownpittsburgh.com/play/market-square');
/*!40000 ALTER TABLE `attraction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(127) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `website` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (1,'A past event','2013-03-22','2013-03-23','http://site.com'),(2,'Sample event 1','2013-04-18','2013-04-22','http://example.com'),(3,'Sample event 2','2013-04-23','2013-04-24',''),(4,'Sample event 3','2013-04-26','2013-04-26','http://example.com'),(5,'Event across two months','2013-04-30','2013-05-02',''),(6,'Event with a really really really really long title seriously its so long it\'s going to go on at least 2 lines i hope','2013-05-04','2013-05-05','http://example.com'),(7,'Sample event 4','2013-05-08','2013-05-20','http://example.com'),(8,'Sample event 5','2013-05-22','2013-05-26','http://example.com'),(9,'Sample event 6','2013-05-26','2013-05-26',''),(10,'Sample event 7','2013-05-27','2013-05-28','http://example.com'),(11,'Sample event 8','2013-07-01','2013-07-11',''),(12,'Sample events 9','2013-07-12','2013-07-13','http://example.com');
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotel`
--

DROP TABLE IF EXISTS `hotel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotel` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(127) DEFAULT NULL,
  `address` varchar(255) NOT NULL DEFAULT '',
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `phone` varchar(31) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel`
--

LOCK TABLES `hotel` WRITE;
/*!40000 ALTER TABLE `hotel` DISABLE KEYS */;
INSERT INTO `hotel` VALUES (1,'Cambria Suites Pittsburgh at Consol Energy Center','1320 Centre Ave.',40.440445,-79.987816,'412-381-6687'),(2,'Courtyard by the Marriott Pittsburgh Downtown','945 Penn Ave.',40.444302,-79.996445,'412-434-5551'),(3,'DoubleTree by Hilton Hotel & Suites Pittsburgh Downtown','One Bigelow Square',40.440887,-79.994278,'412-281-5800'),(4,'Fairmont Pittsburgh','510 Market St.',40.441433,-80.002052,'412-773-8800'),(5,'Wyndham Grand Pittsburgh Downtown Hotel','600 Commonwealth Place',40.441727,-80.006447,'412-391-4600'),(6,'Hampton Inn & Suites Pittsburgh Downtown','1247 Smallman St.',40.446892,-79.992561,'412-288-4350'),(7,'Hyatt Place Pittsburgh North Shore','260 North Shore Dr.',40.446342,-80.009064,'412-321-3000'),(8,'Omni William Penn Hotel','530 William Penn Place',40.440495,-79.996269,'412-218-7100'),(9,'Pittsburgh Marriott City Center','112 Washington Place',40.439396,-79.992813,'412-471-4000'),(10,'Renaissance Pittsburgh Hotel','107 Sixth Street',40.443821,-80.002243,'412-562-1200'),(11,'Residence Inn Pittsburgh North Shore','574 West General Robinson St.',40.447987,-80.006012,'412-321-2099'),(12,'Sheraton Station Square Hotel','300 W. Station Square Dr.',40.440624,-79.995888,'412-261-2000'),(13,'Westin Convention Center Pittsburgh','1000 Penn Ave.',40.444115,-79.995132,'412-281-7000');
/*!40000 ALTER TABLE `hotel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parking`
--

DROP TABLE IF EXISTS `parking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parking` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(127) DEFAULT NULL,
  `address` varchar(255) NOT NULL DEFAULT '',
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `rates` varchar(127) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parking`
--

LOCK TABLES `parking` WRITE;
/*!40000 ALTER TABLE `parking` DISABLE KEYS */;
INSERT INTO `parking` VALUES (1,'Convention Center Parking Garage','10th Street and Penn Avenue',40.444427,-79.995605,'0-2 hrs $5.00; 2-6 hrs $8.00; 6-8 hrs $11; 8-15 hrs $12; 15-24 hrs $20'),(2,'11th and Smallman Strip District','11th and Smallman',40.445686,-79.994072,'4am-9:45am $8; after 9:45am $5'),(3,'Courtyard by the Marriott Parking Lot','945 Penn Avenue',40.444302,-79.996445,'Valet (in & out priveleges) $22'),(4,'15th and Smallman Strip District','15th and Smallman',40.448666,-79.989349,'5am-4pm $6; 4pm-close $6'),(5,'9th and Penn Garage','136 9th Street',40.444187,-79.998596,'1 hr or less $3.75; 1-2 hrs $4.75; 2-4 hrs $7.50; 4-24 hrs $9.75'),(6,'Smithfield and Liberty','629 Smithfield Street',40.442211,-79.997246,'1 hr or less $5; 3 hrs or less $8; 4 hrs or less $11; 4-24 hrs $13.75'),(7,'Lower Pennsylvanian','1100 Liberty Avenue',40.444241,-79.992416,'6am-10am $12; 10am-2pm $12'),(8,'Upper Pennsylvanian','1100 Liberty Avenue',40.444241,-79.992416,'6am-10am $12; 10am-7pm $7'),(9,'Benedum','7th and Penn Avenue',40.443211,-80.000252,'0-1/2 hr $5; 1/2 hr -2 hrs $10; 2-4 hrs $15; 4-close $20'),(10,'Cultural Trust 7th Street Lot','7th and Ft. Duquesne Boulevard',40.444557,-80.000854,'Evening/weekends $7'),(11,'6th and Penn Garage','542 Penn Avenue',40.442562,-80.002388,'0-1/2 hr $4; 1/2 hr -2 hrs $8; 2-4 hrs $10; 4-24 hrs $14'),(12,'North Shore Garage','20 E. General Robinson Street',40.448826,-80.003365,'2 hrs or less $3; 2-4 hrs $7; 4-24 hrs $9'),(13,'North Shore Lots','North Shore',40.446709,-80.012970,'Before 3pm $6; after 5pm $5'),(14,'Westin Hotel','1000 Penn Avenue',40.444115,-79.995132,'2hrs $8; 4hrs $14; 8hrs $16; 12 hrs $19; 24 hrs $20'),(15,'Theatre Square Garage','120 Seventh Street',40.443974,-80.000610,'0-1/2 hr $4; 1/2 hr -2 hrs $7; 2-4 hrs $10; 4-24 hrs $15'),(16,'6th and Ft. Duquesne Boulevard','126 Sixth Street',40.444027,-80.002769,'1 hr or less $3.75; 2 hrs or less $4.75; 4 hrs or less $7.50; 5-24 hrs $9.75'),(17,'Mellon Square','6th and William Penn Way',40.441750,-79.996269,'1 hr or less $2; 2 hrs or less $3; 3hrs to max $5'),(18,'Grant Street Transportation Center','11th and Penn Avenue/Liberty Avenue',40.455303,-79.976349,'1 hr or less $2; 2 hrs or less $3; 3hrs to max $5');
/*!40000 ALTER TABLE `parking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '',
  `address` varchar(256) NOT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `price` varchar(15) NOT NULL DEFAULT '',
  `type` varchar(63) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant`
--

LOCK TABLES `restaurant` WRITE;
/*!40000 ALTER TABLE `restaurant` DISABLE KEYS */;
INSERT INTO `restaurant` VALUES (1,'Andy\'s Wine Bar','Fairmont Pittsburgh Hotel, 510 Market St',40.441433,-80.002052,'$-$$','Full Service Restaurant'),(2,'Arby\'s','604 Wood St',40.442165,-79.999039,'$','Fast Food'),(3,'Atria\'s Restaurant & Tavern','PNC Park, 103 Federal St',40.440624,-79.995888,'$-$$','Full Service Restaurant'),(4,'Au Bon Pain (Liberty Ave)','625 Liberty Ave',40.442337,-80.000748,'$','Sandwich Shop'),(5,'Au Bon Pain (Smithfield St)','535 Smithfield St',40.441250,-79.997894,'$','Sandwich Shop'),(6,'Au Bon Pain (Grant St)','7th & Grant St',40.442162,-79.995018,'$','Sandwich Shop'),(7,'August Henry\'s','946 Penn Ave',40.444180,-79.996368,'$-$$','Full Service Restaurant'),(8,'Backstage Bar','655 Penn Ave',40.443085,-80.000999,'$-$$','Full Service Restaurant'),(9,'Ben & Jerry\'s','936 Penn Ave',40.443882,-79.996689,'$','Confections'),(10,'Bigelow Grille','Doubletree Hotel, One Bigelow Square',40.440838,-79.994423,'$-$$','Full Service Restaurant'),(11,'Bossa Nova','123 7th St',40.443939,-80.000603,'$-$$','Full Service Restaurant'),(12,'Braddock\'s American Brasserie','Renaissance Hotel, 107 6th St',40.443821,-80.002243,'$$$','Full Service Restaurant'),(13,'Bravo Franco\'s Ristorante','613 Penn Ave',40.443027,-80.001732,'$-$$','Full Service Restaurant'),(14,'Brown Bag Deli','Liberty Center, 1001 Liberty Ave',NULL,NULL,'$','Sandwich Shop'),(15,'Bruegger\'s Bagels (7th Ave)','411 Seventh Ave',40.442673,-79.996361,'$','Sandwich Shop'),(16,'Bruegger\'s Bagels (Grant St)','531 Grant St',40.440269,-79.996407,'$','Sandwich Shop'),(17,'Café Milano','134 6th St',40.443108,-80.002632,'$','Pizzeria'),(18,'Christos Authentic Greek Cuisine','130 6th St',40.444016,-80.002762,'$-$$','Full Service Restaurant'),(19,'Cioppino','2350 Railroad St',40.454338,-79.982620,'$$$','Full Service Restaurant'),(20,'Clark Bar & Grill','North Shore, 503 Martindale St',40.449211,-80.008812,'$-$$','Full Service Restaurant'),(21,'Crazy Mocha (Liberty Center)','1001 Liberty Ave',40.444275,-79.994568,'$','Coffee Shop'),(22,'Crazy Mocha','707 Grant St',40.442581,-79.995224,'$','Coffee Shop'),(23,'Diamond Pizza','PNC Park, 101 Federal St',40.440624,-79.995888,'$','Pizzeria'),(24,'Domino\'s Pizza','300 Sixth Ave',40.442059,-79.999435,'$','Pizzeria'),(25,'Doubleday\'s Famous Burgers & Fries','121 6th St',40.443516,-80.002235,'$','Sandwich Shop'),(26,'Dunkin Donuts','601 Grant St',40.441093,-79.996010,'$','Coffee Shop'),(27,'Eleven Contemporary Kitchen','1150 Smallman St',40.446129,-79.993210,'$$$','Full Service Restaurant'),(28,'F. Tambellini\'s Restaurant','139 7th St',40.443604,-80.000343,'$-$$','Full Service Restaurant'),(29,'Fernando\'s Café','963 Liberty Ave',40.443626,-79.995712,'$','Sandwich Shop'),(30,'Finnigan\'s Wake Irish Pub','North Shore, 20 E. General Robinson St',40.448826,-80.003365,'$-$$','Full Service Restaurant'),(31,'Garden Café','Heinz hall, 601 Penn Ave',40.453983,-79.991074,'$','Sandwich Shop'),(32,'Giovanni Pizza & Pasta','123 6th St',40.443462,-80.002213,'$','Pizzeria'),(33,'Go Pretzel','807 Liberty Ave',40.442783,-79.998596,'$','Confections'),(34,'Golden Palace Buffet','647 Smithfield St',40.442696,-79.996872,'$','Full Service Restaurant'),(35,'Grille on Seventh','130 7th St',40.443634,-80.000702,'$-$$','Full Service Restaurant'),(36,'Habitat Restaurant','Fairmont Pgh Hotel   510 Market St',40.441433,-80.002052,'$$$','Full Service Restaurant'),(37,'Hanlon\'s Café','961 Liberty Ave',40.443623,-79.995842,'$','Full Service Restaurant'),(38,'Hyde Park Prime Steakhouse','North Shore, 247 North Shore Dr',40.446362,-80.008408,'$$$','Full Service Restaurant'),(39,'Indian Palace','137 6th St',40.444012,-80.002724,'$-$$','Full Service Restaurant'),(40,'Indian Spices','129 6th St',40.443359,-80.002167,'$','Full Service Restaurant'),(41,'Isabella St Café','North Shore, 201 Isabella St',40.447769,-80.001198,'$','Sandwich Shop'),(42,'Istanbul Grille','643 Liberty Ave',40.442532,-80.000214,'$','Sandwich Shop'),(43,'Jerome Bettis Grille 36','North Shore, 375 North Shore Dr',40.445805,-80.011322,'$-$$','Full Service Restaurant'),(44,'Jimmy John\'s','501 Grant St',40.439930,-79.997032,'$','Sandwich Shop'),(45,'Keystone Café & Deli','339 Sixth Ave',40.441742,-79.998451,'$','Sandwich Shop'),(46,'Lesvos Gryro #2','212 10th St',40.443985,-79.995544,'$','Sandwich Shop'),(47,'Lidia\'s Pittsburgh','1400 Smallman St',40.448463,-79.989410,'$$','Full Service Restaurant'),(48,'Little E\'s Jazz Club & Restaurant','949 Liberty Ave',40.443623,-79.996330,'$-$$','Full Service Restaurant'),(49,'Long Ash Club','711 Penn Ave',40.443649,-79.999825,'$-$$','Full Service Restaurant'),(50,'Mahoney\'s Restaurant & Lounge','949 Liberty Ave',40.443623,-79.996330,'$-$$','Full Service Restaurant'),(51,'McCormick & Schmick\'s Seafood Restaurant','Piatt Place, 301 Fifth Ave',40.440769,-79.999626,'$$','Full Service Restaurant'),(52,'McDonald\'s (Smithfield St)','505 Smithfield St',40.440235,-79.998543,'$','Fast Food'),(53,'McDonald\'s (Wood St)','608 Wood St',40.442276,-79.998955,'$','Fast Food'),(54,'McFaddens Restaurant & Saloon','North Shore, 211 North Shore Dr',40.446487,-80.007683,'$-$$','Full Service Restaurant'),(55,'Meat & Potatoes','649 Penn Ave',40.443150,-80.001190,'$$','Full Service Restaurant'),(56,'Melange Bistro Bar','136 6th St',40.443085,-80.002365,'$-$$','Full Service Restaurant'),(57,'Mike & Tony\'s Gyro & Shish-Kabob','927 Liberty Ave',40.443432,-79.997078,'$','Sandwich Shop'),(58,'Mix Stirs Café (Grant St)','555 Grant St',40.440464,-79.996201,'$','Sandwich Shop'),(59,'Mix Stirs Café (Smallman St)','1212 Smallman St',40.446323,-79.992805,'$','Sandwich Shop'),(60,'Monte Cello\'s Pizza','305 Seventh Ave',40.443073,-79.997330,'$','Pizzeria'),(61,'Morton\'s of Chicago','Dominion Tower, 625 Liberty Ave',40.442337,-80.000748,'$$$','Full Service Restaurant'),(62,'Mullen\'s Bar & Grill','North Shore, 200 Federal St',40.448414,-80.003952,'$','Full Service Restaurant'),(63,'My City Subs and More','633 Smithfield St',40.442413,-79.997314,'$','Sandwich Shop'),(64,'Nine on Nine','900 Penn Ave',40.443611,-79.998047,'$$-$$$','Full Service Restaurant'),(65,'North Shore Saloon','North Shore, 208 Federal St',40.448555,-80.004356,'$','Full Service Restaurant'),(66,'Olive or Twist','140 6th St',40.442928,-80.002556,'$-$$','Full Service Restaurant'),(67,'Osteria','2350 Railroad St',40.454338,-79.982620,'$$','Full Service Restaurant'),(68,'Palazzo Ristorante','144 6th St',40.442928,-80.002373,'$-$$','Full Service Restaurant'),(69,'Penn City Grille','Westin Convention Center & Hotel, 1000 Penn Ave',40.444115,-79.995132,'$-$$','Full Service Restaurant'),(70,'Pittsburgh Popcorn','822 Liberty Ave',40.442711,-79.997841,'$','Confections'),(71,'Pittsburgh Grille & Sports Bar','600 Grant St',40.441357,-79.994850,'$-$$','Full Service Restaurant'),(72,'Pizza Parma','823 Penn Ave',40.443806,-79.998512,'$','Pizzeria'),(73,'Qdoba Mexican Grille (Grant St)','601 Grant St',40.441093,-79.996010,'$','Fast Food'),(74,'Qdoba Mexican Grille (Liberty Ave)','808 Liberty Ave',40.442513,-79.998749,'$','Fast Food'),(75,'Quiznos','210 Sixth Ave',40.442169,-80.000015,'$','Sandwich Shop'),(76,'Rivertowne','North Shore, 337 North Shore Dr',40.445976,-80.010849,'$-$$','Full Service Restaurant'),(77,'Salonika Gyros','133 6th St',40.443226,-80.002235,'$','Sandwich Shop'),(78,'Sammy\'s Famous Corned Beef','901 Liberty Ave',40.443199,-79.997955,'$','Sandwich Shop'),(79,'Seviche','930 Penn Ave',40.443832,-79.996849,'$-$$','Full Service Restaurant'),(80,'Sharp Edge Bistro','922 Penn Ave',40.443790,-79.997169,'$-$$','Full Service Restaurant'),(81,'Six Penn Kitchen','146 6th St',40.442810,-80.002319,'$$','Full Service Restaurant'),(82,'Smithfield Café','639 Smithfield St',40.442432,-79.997200,'$','Full Service Restaurant'),(83,'SOHO','North Shore, 203 Federal St',40.448360,-80.004440,'$$','Full Service Restaurant'),(84,'Sonoma Grille','947 Penn Ave',40.444229,-79.996407,'$$','Full Service Restaurant'),(85,'Srees\'','701 Smithfield St',40.443020,-79.996788,'$','Sandwich Shop'),(86,'Starbucks (Washington Pl)','112 Washington Place',40.439396,-79.992813,'$','Coffee Shop'),(87,'Starbucks (Sixth Ave)','210 Sixth Ave',40.442169,-80.000015,'$','Coffee Shop'),(88,'Starbucks (6th St)','202 6th St',40.442654,-80.002251,'$','Coffee Shop'),(89,'Starbucks (Wm Penn Pl)','530 William Penn Place',40.440495,-79.996269,'$','Coffee Shop'),(90,'Starbucks (Grant St)','600 Grant St',40.441357,-79.994850,'$','Coffee Shop'),(91,'Subway (7th Ave)','417 Seventh Ave',40.442616,-79.996201,'$','Sandwich Shop'),(92,'Subway (Liberty Ave)','703 Liberty Ave',40.442474,-79.999786,'$','Sandwich Shop'),(93,'Subway (Penn Ave)','930 Penn Ave',40.443832,-79.996849,'$','Sandwich Shop'),(94,'Sushi Kim','1241 Penn Ave',40.446388,-79.991592,'$-$$','Full Service Restaurant'),(95,'Sweetlix','820 Liberty Ave',40.442657,-79.998108,'$','Confections'),(96,'The Capital Grille','Piatt Place, 300 Fifth Ave',40.440769,-79.999626,'$$$','Full Service Restaurant'),(97,'The Carlton','One Mellon Center, 500 Grant St',40.439606,-79.996254,'$$$','Full Service Restaurant'),(98,'The City Deli & Catering','Koppers Building, 436 7th Ave',40.442123,-79.995537,'$','Sandwich Shop'),(99,'The Original Fish Market','Westin Convention Center & Hotel, 1000 Penn Ave',40.444115,-79.995132,'$$$','Full Service Restaurant'),(100,'The Tap Room','Omni William Penn Hotel, 530 William Penn Place',40.440624,-79.995888,'$-$$','Full Service Restaurant'),(101,'The Terrace Room','Omni William Penn Hotel, 530 William Penn Place',40.440624,-79.995888,'$$$','Full Service Restaurant'),(102,'Tilted Kilt Pub & Eatery','North Shore, 353 North Shore Dr',40.445869,-80.010818,'$-$$','Full Service Restaurant'),(103,'Tonic Bar & Grill','971 Liberty Ave',40.443817,-79.995461,'$$','Full Service Restaurant'),(104,'Two Louie\'s Market','1233 Penn Ave',40.446342,-79.991661,'$','Sandwich Shop'),(105,'Villa Reale Restaurant','628 Smithfield St',40.442142,-79.996956,'$-$$','Full Service Restaurant'),(106,'Weiner World','626 Smithfield St',40.442123,-79.997040,'$','Sandwich Shop');
/*!40000 ALTER TABLE `restaurant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-04-18 16:37:42
