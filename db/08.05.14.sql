-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Wersja serwera:               5.6.16 - MySQL Community Server (GPL)
-- Serwer OS:                    Win32
-- HeidiSQL Wersja:              8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Zrzut struktury tabela ecms.gallery_category
CREATE TABLE IF NOT EXISTS `gallery_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Zrzucanie danych dla tabeli ecms.gallery_category: 5 rows
DELETE FROM `gallery_category`;
/*!40000 ALTER TABLE `gallery_category` DISABLE KEYS */;
INSERT INTO `gallery_category` (`id`, `order`, `name`, `slug`, `active`) VALUES
	(12, 2, 'miscellaneous', 'miscellaneous', 1),
	(9, 3, 'people', 'people', 1),
	(10, 1, 'stories', 'stories', 1),
	(11, 4, 'shadow/light', 'shadow-light', 1),
	(8, 5, 'portraits', 'portraits', 1);
/*!40000 ALTER TABLE `gallery_category` ENABLE KEYS */;


-- Zrzut struktury tabela ecms.gallery_pictures
CREATE TABLE IF NOT EXISTS `gallery_pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL DEFAULT '0',
  `filename` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_bin,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=206 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Zrzucanie danych dla tabeli ecms.gallery_pictures: 19 rows
DELETE FROM `gallery_pictures`;
/*!40000 ALTER TABLE `gallery_pictures` DISABLE KEYS */;
INSERT INTO `gallery_pictures` (`id`, `category`, `filename`, `description`) VALUES
	(204, 10, 'eef747f7ac8ea283c80d1030854650ff1a8d983f.jpeg', NULL),
	(203, 10, '4d1f00e98532c31ac6fd8c0103b03996154ac16c.jpeg', NULL),
	(202, 10, '80a8fb40001a744d33ecda3b6cc04806d7d8f909.jpeg', NULL),
	(201, 10, '9e9357b85e22c80403e80baf7ce08bb94c6b1380.jpeg', NULL),
	(200, 10, '368e5f2a93cd14bc013a0422ff9d1089af1ff2b3.jpeg', NULL),
	(199, 10, '775d45fa8abf16576e9ffdb04bc52204f6e685c1.jpeg', NULL),
	(198, 10, '0f10ba01a079ae4122cb326c288dd1c4c9356306.jpeg', NULL),
	(197, 10, '92cfd59757f5c71d8e7e5e719216ef9954bdaed3.jpeg', NULL),
	(196, 10, '17d57cf94f0aed210a5990ec5f8bb8dc08e7e2ba.jpeg', NULL),
	(195, 10, 'b29e8ec88eac11dd4fcf8b13a6d596196fda1584.jpeg', NULL),
	(194, 10, 'a16e1281686893670cffd7d1b1776f3dab6f95b7.jpeg', NULL),
	(193, 10, '76fd7918200ec8d85a8b9e5424ed58f6fb83d801.jpeg', NULL),
	(192, 10, '3f473ef3a1943bcbba7a703e5336ec81350ca039.jpeg', NULL),
	(191, 10, '7019c5beddfe352ae8a5b9fb960f9a69b8ba8200.jpeg', NULL),
	(189, 10, 'b55de210730f2bff74ca9892d38d7fbda22a5276.jpeg', NULL),
	(190, 10, '60d14ace54b07846fa084f7a85c54f48d47672d1.jpeg', NULL),
	(188, 10, 'd49eb2241cb5a61b715478baa1108f6f3029c68b.jpeg', NULL),
	(187, 10, 'cce73e905cfc08a46fca00d5ccdc78ef630a9734.jpeg', NULL);
/*!40000 ALTER TABLE `gallery_pictures` ENABLE KEYS */;


-- Zrzut struktury tabela ecms.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `level` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `first_name` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `last_name` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `salt` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `password` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Zrzucanie danych dla tabeli ecms.user: 2 rows
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `email`, `level`, `active`, `first_name`, `last_name`, `salt`, `password`) VALUES
	(1, 'bartosz@jakubowiak.pl', 10, 1, 'Bartosz', 'Jakubowiak', '0df717f87dd98e0446477f52b1efeacdf78fee3b6de376efcbbb6eed97328462', '34b2751abfd33d83541f139691cbe21ac2b6d6ad19463c2af3bda45ed6e9542c'),
	(34, 'biuro@even-art.com', 10, 1, 'Marcin', 'Wieczorek', '6012dfdd3f872da1f6745c66fd8e45fd11b6f07f54926d599470eafba836c11e', '1cbe13a986e5af51744713f5e5c9a6930fd75b8b733674167f916bfef5d1a888');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Zrzut struktury tabela ecms.user_extra
CREATE TABLE IF NOT EXISTS `user_extra` (
  `id` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Zrzucanie danych dla tabeli ecms.user_extra: 0 rows
DELETE FROM `user_extra`;
/*!40000 ALTER TABLE `user_extra` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_extra` ENABLE KEYS */;


-- Zrzut struktury tabela ecms.user_logs
CREATE TABLE IF NOT EXISTS `user_logs` (
  `user_id` int(11) DEFAULT NULL,
  `user_level` tinyint(4) DEFAULT NULL,
  `timestamp` varchar(12) COLLATE utf8_bin DEFAULT NULL,
  `action` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `what` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `where` varchar(200) COLLATE utf8_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Zrzucanie danych dla tabeli ecms.user_logs: 21 rows
DELETE FROM `user_logs`;
/*!40000 ALTER TABLE `user_logs` DISABLE KEYS */;
INSERT INTO `user_logs` (`user_id`, `user_level`, `timestamp`, `action`, `what`, `where`) VALUES
	(0, 0, '1399582158', 'LOGOUT', '', ''),
	(1, 10, '1399582237', 'LOGIN', '', ''),
	(1, 10, '1399582307', 'LOGOUT', '', ''),
	(1, 10, '1399582536', 'LOGIN', '', ''),
	(1, 10, '1399583150', 'ADDPICTURE', 'stories', ''),
	(1, 10, '1399583151', 'ADDPICTURE', 'stories', ''),
	(1, 10, '1399583151', 'ADDPICTURE', 'stories', ''),
	(1, 10, '1399583152', 'ADDPICTURE', 'stories', ''),
	(1, 10, '1399583153', 'ADDPICTURE', 'stories', ''),
	(1, 10, '1399583153', 'ADDPICTURE', 'stories', ''),
	(1, 10, '1399583154', 'ADDPICTURE', 'stories', ''),
	(1, 10, '1399583154', 'ADDPICTURE', 'stories', ''),
	(1, 10, '1399583155', 'ADDPICTURE', 'stories', ''),
	(1, 10, '1399583156', 'ADDPICTURE', 'stories', ''),
	(1, 10, '1399583156', 'ADDPICTURE', 'stories', ''),
	(1, 10, '1399583157', 'ADDPICTURE', 'stories', ''),
	(1, 10, '1399583157', 'ADDPICTURE', 'stories', ''),
	(1, 10, '1399583158', 'ADDPICTURE', 'stories', ''),
	(1, 10, '1399583159', 'ADDPICTURE', 'stories', ''),
	(1, 10, '1399583159', 'ADDPICTURE', 'stories', ''),
	(1, 10, '1399583160', 'ADDPICTURE', 'stories', ''),
	(1, 10, '1399583182', 'REMOVEPICTURE', 'stories', '');
/*!40000 ALTER TABLE `user_logs` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
