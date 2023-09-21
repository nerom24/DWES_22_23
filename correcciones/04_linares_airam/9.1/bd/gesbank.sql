-- MariaDB dump 10.18  Distrib 10.4.16-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: gesbank
-- ------------------------------------------------------
-- Server version	10.4.16-MariaDB
drop database gesbank;
create database gesbank;
use gesbank;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `apellidos` varchar(45) DEFAULT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `telefono` char(9) DEFAULT NULL,
  `ciudad` varchar(20) DEFAULT NULL,
  `dni` char(9) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni` (`dni`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'García Pérez','Francisco','956465432','Ubrique','12345678A','francisco@perez.com','2021-03-16 15:35:25','2021-03-16 15:35:25'),(2,'Moreno Gracia','José Carlos','956487896','Ubrique','25693874B','moreno@gracia.com','2021-03-16 15:35:25','2021-03-16 15:35:25'),(3,'Romero Ramírez','Rocío','956874521','Ubrique','25693582C','rocio@romero.com','2021-03-16 15:35:25','2021-03-16 15:35:25');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuentas`
--

DROP TABLE IF EXISTS `cuentas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuentas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `num_cuenta` char(20) DEFAULT NULL,
  `id_cliente` int(10) unsigned DEFAULT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_ul_mov` datetime DEFAULT NULL,
  `num_movtos` int(10) unsigned DEFAULT NULL,
  `saldo` decimal(15,2) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `num_cuenta` (`num_cuenta`),
  KEY `id_cliente` (`id_cliente`),
  CONSTRAINT `cuentas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuentas`
--

LOCK TABLES `cuentas` WRITE;
/*!40000 ALTER TABLE `cuentas` DISABLE KEYS */;
INSERT INTO `cuentas` VALUES (1,'210311111234567890',1,'2010-03-11 23:00:00','0000-00-00 00:00:00',5,320.00,'2021-03-16 15:35:25','2021-03-16 15:35:25'),(2,'210322221234567890',2,'2010-02-03 23:00:00','0000-00-00 00:00:00',5,-820.00,'2021-03-16 15:35:25','2021-03-16 15:35:25'),(3,'210333331234567890',3,'2010-05-13 22:00:00','0000-00-00 00:00:00',3,-920.00,'2021-03-16 15:35:25','2021-03-16 15:35:25');
/*!40000 ALTER TABLE `cuentas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimientos`
--

DROP TABLE IF EXISTS `movimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movimientos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_cuenta` int(10) unsigned DEFAULT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp(),
  `concepto` varchar(50) DEFAULT NULL,
  `tipo` enum('I','R','') DEFAULT 'I',
  `cantidad` decimal(12,2) DEFAULT NULL,
  `saldo` decimal(12,2) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_cuenta` (`id_cuenta`),
  CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`id_cuenta`) REFERENCES `cuentas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimientos`
--

LOCK TABLES `movimientos` WRITE;
/*!40000 ALTER TABLE `movimientos` DISABLE KEYS */;
INSERT INTO `movimientos` VALUES (1,1,'2021-03-16 15:35:25','Movimiento de Ingreso','I',100.00,100.00,'2021-03-16 15:35:25','2021-03-16 15:35:25'),(2,1,'2021-03-16 15:35:25','Movimiento de Ingreso','I',120.00,220.00,'2021-03-16 15:35:25','2021-03-16 15:35:25'),(3,2,'2021-03-16 15:35:25','Movimiento de Ingreso','I',100.00,100.00,'2021-03-16 15:35:25','2021-03-16 15:35:25'),(4,3,'2021-03-16 15:35:25','Movimiento de Ingreso','I',100.00,100.00,'2021-03-16 15:35:25','2021-03-16 15:35:25'),(5,1,'2021-03-16 15:35:25','Movimiento de Ingreso','I',300.00,520.00,'2021-03-16 15:35:25','2021-03-16 15:35:25'),(6,3,'2021-03-16 15:35:25','Movimiento de Reintegro','R',40.00,60.00,'2021-03-16 15:35:25','2021-03-16 15:35:25'),(7,2,'2021-03-16 15:35:25','Movimiento de Reintegro','R',20.00,80.00,'2021-03-16 15:35:25','2021-03-16 15:35:25'),(8,1,'2021-03-16 15:35:25','Movimiento de Ingreso','I',100.00,620.00,'2021-03-16 15:35:25','2021-03-16 15:35:25'),(9,3,'2021-12-13 11:56:32','Compra del PC','R',980.00,-920.00,'2021-12-13 11:56:32','2021-12-13 11:56:32'),(10,2,'2021-12-13 12:01:10','Compra del PC','R',900.00,-820.00,'2021-12-13 12:01:10','2021-12-13 12:01:10'),(11,2,'2021-12-13 12:05:46','sdf','I',2000.00,1180.00,'2021-12-13 12:05:46','2021-12-13 12:05:46'),(12,2,'2021-12-13 21:00:11','Compra del PC','R',2000.00,-820.00,'2021-12-13 21:00:11','2021-12-13 21:00:11'),(13,1,'2021-12-13 21:56:56','Compra del PC','R',300.00,320.00,'2021-12-13 21:56:56','2021-12-13 21:56:56');
/*!40000 ALTER TABLE `movimientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador','Todos los privilegios de la aplicación','2021-03-16 15:35:46','2021-03-16 15:35:46'),(2,'Editor','Sólo podrá consultar, modificar y añadir información. No podrá eliminar','2021-03-16 15:35:46','2021-03-16 15:35:46'),(3,'Registrado','Sólo podrá realizar consultas','2021-03-16 15:35:46','2021-03-16 15:35:46');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles_users`
--

DROP TABLE IF EXISTS `roles_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `role_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `roles_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `roles_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles_users`
--

LOCK TABLES `roles_users` WRITE;
/*!40000 ALTER TABLE `roles_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` char(60) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2021-12-14  9:49:13
