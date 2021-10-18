# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.34)
# Database: bank
# Generation Time: 2021-10-18 10:08:22 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table cards
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cards`;

CREATE TABLE `cards` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `card_number` varchar(25) NOT NULL DEFAULT '',
  `card_holder` varchar(50) NOT NULL DEFAULT '',
  `expiration_month` int(11) NOT NULL,
  `expiration_year` int(11) NOT NULL,
  `cvv` int(11) NOT NULL,
  `account_balance` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `cards` WRITE;
/*!40000 ALTER TABLE `cards` DISABLE KEYS */;

INSERT INTO `cards` (`id`, `card_number`, `card_holder`, `expiration_month`, `expiration_year`, `cvv`, `account_balance`)
VALUES
	(68,'5541180537474693','Matej brodziansky',10,2026,853,566),
	(69,'1067851490718501','Jaroslav Ginič',10,2026,996,879),
	(71,'4252582974293764','Jozef zliechovec',10,2026,542,1568),
	(72,'5272510902033694','Michal sobocký',10,2026,444,2000);

/*!40000 ALTER TABLE `cards` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;

INSERT INTO `groups` (`id`, `name`, `description`)
VALUES
	(1,'admin','Administrator'),
	(2,'members','General User');

/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `log`;

CREATE TABLE `log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(50) DEFAULT NULL,
  `log_type` varchar(20) DEFAULT NULL,
  `action` text,
  `created_at` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;

INSERT INTO `log` (`id`, `user_id`, `log_type`, `action`, `created_at`)
VALUES
	(1,14,'auth','Logged out ','2021-10-17 18:12:43'),
	(2,0,'auth','Created new user with unique number 2087832978789332','2021-10-17 18:13:10'),
	(3,2,'auth','Succesfully logged in by 2087832978789332','2021-10-17 18:13:37'),
	(4,NULL,'card','Succesfuly created card 554118053748469','2021-10-17 18:33:39'),
	(5,NULL,'card','Trying to create card 554118053748469 but, this card already exists.','2021-10-17 18:33:41'),
	(6,NULL,'card','Trying to create card 554118053748469 but, this card already exists.','2021-10-17 18:33:43'),
	(7,NULL,'card','Trying to create card 554118053748469 but, this card already exists.','2021-10-17 18:33:44'),
	(8,NULL,'card','Trying to create card 554118053748469 but, this card already exists.','2021-10-17 18:33:44'),
	(9,NULL,'card','Trying to create card 554118053748469 but, this card already exists.','2021-10-17 18:33:51'),
	(10,NULL,'card','Succesfuly created card 1067851490718501','2021-10-17 18:33:57'),
	(11,NULL,'transaction','Sended 1000 € from 554118053748469 to 1067851490718501','2021-10-17 18:34:34'),
	(12,NULL,'transaction','Unsuccessful transaction, this card 554118053748469 does not have enough money','2021-10-17 18:34:49'),
	(13,2,'auth','Logged out 2087832978789332','2021-10-17 19:01:35'),
	(14,2,'auth','Succesfully logged in by 2087832978789332','2021-10-17 19:01:58'),
	(15,NULL,'card','Succesfuly created card 8131988384825735','2021-10-17 19:20:00'),
	(16,NULL,'card','Trying to create card 8131988384825735 but, this card already exists.','2021-10-17 19:20:01'),
	(17,NULL,'card','Trying to create card 8131988384825735 but, this card already exists.','2021-10-17 19:20:02'),
	(18,NULL,'card','Trying to create card 8131988384825735 but, this card already exists.','2021-10-17 19:20:17'),
	(19,NULL,'card','Succesfuly created card 4252582974293764','2021-10-17 19:20:23'),
	(20,NULL,'transaction','Sended 2987 € from 1067851490718501 to 8131988384825735','2021-10-17 19:21:55'),
	(21,NULL,'transaction','Unsuccessful transaction, this card 1067851490718501 does not have enough money','2021-10-17 19:22:02'),
	(22,NULL,'transaction','Unsuccessful transaction, this card 1067851490718501 does not have enough money','2021-10-17 19:22:08'),
	(23,2,'auth','Succesfully logged in by 2087832978789332','2021-10-18 05:03:18'),
	(24,2,'auth','Created new user with unique number 1243112710682107','2021-10-18 07:52:55'),
	(25,NULL,'card','Succesfuly created card 5272510902033694','2021-10-18 07:55:53'),
	(26,NULL,'card','Trying to create card 5272510902033694 but, this card already exists.','2021-10-18 07:55:55'),
	(27,NULL,'transaction','Sended 1000 € from 5541180537474693 to 1067851490718501','2021-10-18 08:28:36'),
	(28,NULL,'transaction','Sended 33 € from 1067851490718501 to 5541180537474693','2021-10-18 08:34:05'),
	(29,NULL,'transaction','Sended 33 € from 1067851490718501 to 5541180537474693','2021-10-18 08:35:22'),
	(30,NULL,'transaction','Sended 34 € from 1067851490718501 to 5541180537474693','2021-10-18 08:35:56'),
	(31,NULL,'transaction','Sended 34 € from 1067851490718501 to 5541180537474693','2021-10-18 08:36:02'),
	(32,2,'auth','Logged out 2087832978789332','2021-10-18 08:56:51'),
	(33,0,'auth','Created new user with unique number 8239692619979688','2021-10-18 08:58:07'),
	(34,4,'auth','Succesfully logged in by 8239692619979688','2021-10-18 08:58:26'),
	(35,4,'auth','Logged out 8239692619979688','2021-10-18 09:06:53'),
	(36,4,'auth','Succesfully logged in by 8239692619979688','2021-10-18 09:07:06'),
	(37,NULL,'transaction','Sended 432 € from 4252582974293764 to 5541180537474693','2021-10-18 09:51:44');

/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table login_attempts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `unique_number` varchar(40) DEFAULT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_email` (`email`),
  UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  UNIQUE KEY `uc_remember_selector` (`remember_selector`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `unique_number`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`)
VALUES
	(1,'127.0.0.1','administrator','$2y$10$f3tVTVWZ5Muhw5dyZfrj1enzKip0vgmZvpnjXNW6jEcqbeWAdVVRq','admin@admin.com','2968994484774694',NULL,'',NULL,NULL,NULL,NULL,NULL,1268889823,1634110892,1,'Admin','istrator','ADMIN','0'),
	(2,'::1',NULL,'$2y$10$x2aejLAdaaL2RUHydRtn.OuBibxsD4744Mza86f6MoocmXQiSM23O','matejbrodziansky@gmail.com','2087832978789332',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1634494390,1634533398,1,'Matej','Brodziansky',NULL,'0944062718'),
	(3,'::1',NULL,'$2y$10$QoK9LbZ7tbLAKi6evkVlvuK6QjcD/CeZE6W0F0CiWGTvJ98ClL78m','michal@email.com','1243112710682107',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1634543575,NULL,1,'Michal','Novek',NULL,'04920492'),
	(4,'::1',NULL,'$2y$10$ChEgzQAM1xYe3Ub5/cNpiuq8AckxR9nGr5amlIME3ncnayXgGqDZK','ondrej@email.com','8239692619979688',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1634547487,1634548026,1,'Ondrej','Valigura',NULL,'435353');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`)
VALUES
	(1,1,1),
	(2,1,2),
	(12,2,2),
	(13,3,2),
	(14,4,2);

/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
