/*
SQLyog Community
MySQL - 5.7.19-log : Database - farewelldiaries
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(255) DEFAULT NULL,
  `by_user_id` int(11) DEFAULT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `comments` */

insert  into `comments`(`id`,`comment`,`by_user_id`,`to_user_id`,`date`) values 
(1,'hello',1,1,'2018-05-14 00:17:34'),
(2,'no comments',1,1,'2018-05-14 00:17:40'),
(3,'no comments',1,2,'2018-05-14 00:24:51'),
(4,'Nice comments',1,2,'2018-05-14 00:24:56'),
(5,'holala',1,3,'2018-05-14 00:25:00'),
(6,'Add comment',1,1,'2018-05-14 00:26:33'),
(7,'h',1,3,'2018-05-14 10:33:32'),
(8,'My comment',1,4,'2018-05-14 13:47:37'),
(9,'no comment',1,4,'2018-05-14 13:47:48'),
(10,'Such a great personality',1,3,'2018-05-14 15:16:40'),
(11,'Hello I know you',1,1,'2018-05-14 15:20:48');

/*Table structure for table `comments_vote` */

DROP TABLE IF EXISTS `comments_vote`;

CREATE TABLE `comments_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `vote_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `comments_vote` */

insert  into `comments_vote`(`id`,`user_id`,`comment_id`,`vote_type`) values 
(1,1,2,1),
(2,1,2,2),
(3,2,1,1);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_url` text,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `activation_hash` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`image_url`,`name`,`email`,`activation_hash`) values 
(1,'14024020170.jpg','Zain','14024020170@umt.edu.pk','1652a15a861e49bf1d985415e84d3511'),
(2,'14024020170.jpg','Anas','14024020016@umt.edu.pk','dbe78d410019ee44dac2484170539c85'),
(3,'14024020170.jpg','Saad','14024020017@umt.edu.pk','f1f416f5470dac3d342675f20cc6bbc4'),
(4,'14024020170.jpg','Holala','140240201111@umt.edu.pk',NULL),
(5,'14024020170.jpg','Bolala','140240201111@umt.edu.pk',NULL);

/*Table structure for table `user_vote` */

DROP TABLE IF EXISTS `user_vote`;

CREATE TABLE `user_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `by_user_id` int(11) DEFAULT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `vote_type` int(11) DEFAULT NULL,
  `vote_level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `user_vote` */

insert  into `user_vote`(`id`,`by_user_id`,`to_user_id`,`vote_type`,`vote_level`) values 
(1,1,1,2,1),
(2,1,2,2,1),
(3,1,4,2,1),
(4,1,5,2,0),
(5,2,2,1,1),
(6,1,3,1,1),
(7,1,1,1,1),
(8,1,2,1,1),
(9,1,4,1,1),
(10,1,5,1,1),
(11,1,3,2,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
