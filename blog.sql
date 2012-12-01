-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 27 2012 г., 22:01
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PARENT_ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `CODE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`ID`, `PARENT_ID`, `NAME`, `CODE`) VALUES
(18, 0, 'Тестовый раздел', 'temp');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`POST_ID`, `POST_NAME`, `POST_TEXT`, `POST_CATEGORY`, `POST_DATE`, `POST_USER`, `POST_VIEW`, `POST_CODE`, `POST_TAGS`) VALUES
(1, 'Тестовая запись', '<p>Hello World!</p>\r\n', 18, '2012-11-04', 1, 111, 'test', 'личное');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(100) NOT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `FNAME` varchar(200) NOT NULL,
  `LNAME` varchar(200) NOT NULL,
  `PASSWORD` varchar(200) NOT NULL,
  `GROUP` int(2) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`ID`, `UID`, `EMAIL`, `FNAME`, `LNAME`, `PASSWORD`, `GROUP`) VALUES
(1, 0, 'admin@blog.local', 'Admin', 'Admin', '5f4dcc3b5aa765d61d8327deb882cf99', 99);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
