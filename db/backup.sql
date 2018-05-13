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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `comments` */

insert  into `comments`(`id`,`comment`,`by_user_id`,`to_user_id`,`date`) values 
(5,'hello',1,1,'2018-05-13 17:45:32'),
(6,'no comment',1,1,'2018-05-13 18:52:51'),
(7,'no comment',1,2,'2018-05-13 18:52:55'),
(8,'no comment',2,1,'2018-05-13 18:53:02');

/*Table structure for table `comments_vote` */

DROP TABLE IF EXISTS `comments_vote`;

CREATE TABLE `comments_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `vote_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `comments_vote` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_url` text,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`image_url`,`name`,`email`) values 
(1,'14024020170.jpg','Zain','14024020170@umt.edu.pk'),
(2,'14024020170.jpg','Anas','14024020016@umt.edu.pk'),
(3,'14024020170.jpg','Saad','14024020017@umt.edu.pk');

/*Table structure for table `user_vote` */

DROP TABLE IF EXISTS `user_vote`;

CREATE TABLE `user_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `by_user_id` int(11) DEFAULT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `vote_type` int(11) DEFAULT NULL,
  `vote_level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `user_vote` */

insert  into `user_vote`(`id`,`by_user_id`,`to_user_id`,`vote_type`,`vote_level`) values 
(1,1,1,10,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
