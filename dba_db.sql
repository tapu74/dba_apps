/*
SQLyog Ultimate v8.55 
MySQL - 5.1.41 : Database - elite
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`elite` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `elite`;

/*Table structure for table `checks` */

DROP TABLE IF EXISTS `checks`;

CREATE TABLE `checks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL,
  `server_ip` varchar(100) DEFAULT NULL,
  `db_name` varchar(20) DEFAULT NULL,
  `purpose` varchar(500) DEFAULT NULL,
  `date_engaged` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `comments` varchar(500) DEFAULT NULL,
  `apps_url` varchar(500) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Table structure for table `login_history_db` */

DROP TABLE IF EXISTS `login_history_db`;

CREATE TABLE `login_history_db` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `lan_ip` varchar(20) DEFAULT NULL,
  `lan_mac` varchar(50) DEFAULT NULL,
  `wan_ip` varchar(50) DEFAULT NULL,
  `login_time` time DEFAULT NULL,
  `login_date` date DEFAULT NULL,
  `login_status` int(11) DEFAULT NULL,
  `logout_time` time DEFAULT NULL,
  `logout_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
