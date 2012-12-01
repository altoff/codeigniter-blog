CREATE TABLE IF NOT EXISTS `category` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PARENT_ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `CODE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `category` (`ID`, `PARENT_ID`, `NAME`, `CODE`) VALUES
(1, 0, 'Тестовый раздел', 'test1'),
(2, 1, 'Подраздел', 'test2'),
(3, 0, 'Разное', 'other');

CREATE TABLE IF NOT EXISTS `posts` (
  `POST_ID` int(11) NOT NULL AUTO_INCREMENT,
  `POST_NAME` varchar(255) NOT NULL,
  `POST_TEXT` longtext NOT NULL,
  `POST_CATEGORY` int(11) NOT NULL,
  `POST_DATE` date NOT NULL,
  `POST_USER` int(11) NOT NULL,
  `POST_VIEW` int(11) NOT NULL,
  `POST_CODE` varchar(255) NOT NULL,
  `POST_TAGS` text NOT NULL,
  PRIMARY KEY (`POST_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

INSERT INTO `posts` (`POST_ID`, `POST_NAME`, `POST_TEXT`, `POST_CATEGORY`, `POST_DATE`, `POST_USER`, `POST_VIEW`, `POST_CODE`, `POST_TAGS`) VALUES
(1, 'Тестовая запись', '<p>Тестовая записьТестовая записьТестовая записьТестовая записьТестовая записьТестовая записьТестовая записьТестовая записьТестовая записьТестовая записьТестовая записьТестовая записьТестовая записьТестовая записьТестовая записьТестовая записьТестовая записьТестовая записьТестовая записьТестовая записьТестовая записьТестовая записьТестовая записьТестовая записьТестовая записьТестовая запись</p>\r\n', 1, '2012-11-13', 1, 0, 'test1', 'тег1, тег2'),
(2, 'Тестовая запись2', '<p>Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2Тестовая запись2<br></p>', 2, '2012-11-02', 1, 0, 'test2', 'тег2, тег3'),
(3, 'Тестовая запись3', '<p>Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3Тестовая запись3<br></p>', 3, '2012-10-28', 1, 9, 'test3', 'тег3, тег4'),
(4, 'Тестовая запись 4', '<p>Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4Тестовая запись 4<br></p>', 1, '2012-11-27', 1, 0, 'test4', 'тест'),
(5, 'Тестовая запись 5', '<p>Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5Тестовая запись 5<br></p>', 2, '2012-11-16', 1, 0, 'test5', ''),
(6, 'Тестовая запись 6', '<p>Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6Тестовая запись 6<br></p>', 3, '2012-11-27', 1, 0, 'test6', ''),
(7, 'Тестовая запись 7', '<p>Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7Тестовая запись 7<br></p>', 1, '2012-11-03', 1, 0, 'test7', 'тег1, тег2');

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(100) NOT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `NICKNAME` varchar(255) NOT NULL,
  `FNAME` varchar(200) NOT NULL,
  `LNAME` varchar(200) NOT NULL,
  `PASSWORD` varchar(200) NOT NULL,
  `GROUP` int(2) NOT NULL,
  `STATUS` int(2) NOT NULL,
  `NETWORK` varchar(255) NOT NULL,
  `IDENTITY` varchar(255) NOT NULL,
  `PROFILE` varchar(255) NOT NULL,
  `SOCPHOTO` varchar(255) NOT NULL,
  `PHOTO` varchar(255) NOT NULL,
  `CITY` varchar(255) NOT NULL,
  `COUNTRY` varchar(255) NOT NULL,
  `REG_DATE` datetime NOT NULL,
  `AUTH_DATE` datetime NOT NULL,
  `INFO` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `users` (`ID`, `UID`, `EMAIL`, `NICKNAME`, `FNAME`, `LNAME`, `PASSWORD`, `GROUP`, `STATUS`, `NETWORK`, `IDENTITY`, `PROFILE`, `SOCPHOTO`, `PHOTO`, `CITY`, `COUNTRY`, `REG_DATE`, `AUTH_DATE`, `INFO`) VALUES
(1, 0, 'admin@blog.local', '', 'Admin', 'Admin', 'e10adc3949ba59abbe56e057f20f883e', 99, 0, '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '');