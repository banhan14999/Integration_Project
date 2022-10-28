-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: payroll
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee` (
  `idEmployee` int NOT NULL,
  `Employee Number` int unsigned NOT NULL,
  `Last Name` varchar(45) NOT NULL,
  `First Name` varchar(45) NOT NULL,
  `SSN` decimal(10,0) NOT NULL,
  `Pay Rate` varchar(40) DEFAULT NULL,
  `Pay Rates_idPay Rates` int NOT NULL,
  `Vacation Days` int DEFAULT NULL,
  `Paid To Date` decimal(2,0) DEFAULT NULL,
  `Paid Last Year` decimal(2,0) DEFAULT NULL,
  PRIMARY KEY (`Employee Number`,`Pay Rates_idPay Rates`),
  UNIQUE KEY `Employee Number_UNIQUE` (`Employee Number`),
  KEY `fk_Employee_Pay Rates` (`Pay Rates_idPay Rates`),
  CONSTRAINT `fk_Employee_Pay Rates` FOREIGN KEY (`Pay Rates_idPay Rates`) REFERENCES `mydb`.`pay rates` (`idPay Rates`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,1,'Nhân','Huynh',1,'4.0',1,1,80,50),(2,2,'Dang','Truc',1,'3.5',2,1,70,40),(3,3,'Tin','Nguyen',1,'3.3',4,1,50,30),(4,4,'Doan','Thang',1,'3.2',5,1,30,20),(5,5,'Oanh','Nguyen',1,'2.0',6,3,30,20),(6,6,'11','Phuoc',1,'2.0',6,5,30,20),(7,7,'Van','Cong',1,'2.0',6,4,30,20),(8,8,'Quynh','Duc',1,'3.0',3,1,40,25),(9,9,'Long','Hoang',1,'2.0',6,1,25,18),(10,10,'Hang','Phuong',1,'1.5',6,0,0,0),(11,11,'My','Huyen',1,'3.0',3,1,60,35),(12,12,'1','Test',1,'1.5',6,0,50,25),(1456,1456,'Nhan','Huynh',1,'1.2',6,0,10,2),(2000,2000,'Hang','Bich',1,'1.9',2,0,0,0),(18888,18888,'test2','test',1,'1.2',6,0,0,0);
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay rates`
--

DROP TABLE IF EXISTS `pay rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pay rates` (
  `idPay Rates` int NOT NULL,
  `Pay Rate Name` varchar(40) NOT NULL,
  `Value` decimal(10,0) NOT NULL,
  `Tax Percentage` decimal(10,0) NOT NULL,
  `Pay Type` int NOT NULL,
  `Pay Amount` decimal(10,0) NOT NULL,
  `PT - Level C` decimal(10,0) NOT NULL,
  PRIMARY KEY (`idPay Rates`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay rates`
--

LOCK TABLES `pay rates` WRITE;
/*!40000 ALTER TABLE `pay rates` DISABLE KEYS */;
INSERT INTO `pay rates` VALUES (1,'CEO',5,10,1,400000000,1),(2,'Director',5,10,2,200000000,2),(3,'Secretary',4,10,3,50000000,3),(4,'Vice president',4,10,4,150000000,4),(5,'Manager',4,10,5,100000000,5),(6,'Employee',2,10,6,10000000,6);
/*!40000 ALTER TABLE `pay rates` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-30  7:59:21
