

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+03:00";

DROP TABLE IF EXISTS `user_profile`;

CREATE TABLE `user_profile` (

  `id` int(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,

  `firstname` varchar(50) NOT NULL,

  `lastname` varchar(50) NOT NULL,

  `email` varchar(250) NOT NULL,

  `username` varchar(50) NOT NULL,

    `password` varchar(50) NOT NULL,

  `jobtitle` varchar(50) NOT NULL,

    `company` varchar(50) NOT NULL,

  `job_desc` varchar(250) NOT NULL,

    `telephone` varchar(250) NOT NULL,

  `linkedin` varchar(250) NOT NULL,

    `instagram` varchar(250) NOT NULL,

  `twitter` varchar(250) NOT NULL,

    `facebook` varchar(250) NOT NULL,
    `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)

) ENGINE=MyISAM DEFAULT CHARSET=latin1;




