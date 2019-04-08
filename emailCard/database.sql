CREATE DATABASE IF NOT EXISTS `greeting-cards`;
USE `greeting-cards`;


CREATE TABLE IF NOT EXISTS `tbl_cards` (
  `card_id` int(11) NOT NULL auto_increment,
  `card_title` varchar(255) NOT NULL,
  `card_url` varchar(255) NOT NULL,
  PRIMARY KEY  (`card_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;


INSERT INTO `tbl_cards` (`card_id`, `card_title`, `card_url`) VALUES
(1, 'Card1', 'cards/1387959219.gif'),
(2, 'Card2', 'cards/1387959256.gif'),
(3, 'Card3', 'cards/1387959277.jpg'),
(4, 'Card4', 'cards/1387959296.gif');

CREATE TABLE IF NOT EXISTS `tbl_subscribers` (
  `email_id` varchar(255) NOT NULL,
  `status` enum('A','I') NOT NULL default 'I',
  PRIMARY KEY  (`email_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `tbl_subscribers` (`email_id`, `status`) VALUES
('test@gmail.com', 'A'),
('abc@gmail.com', 'A'),
('xyz@live.in', 'A'),
('sam@hotmail.com', 'A'),
('rabi@yahoo.com', ''),
('kamini@abc.com', 'A'),
('sharmila@yahoo.com', 'I'),
('andrews@yahoo.com', 'A'),
('kirthi@gmail.com', 'A'),
('tashi@gmail.com', 'A'),
('ramesh@gmail.com', 'A');