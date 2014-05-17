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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Zrzucanie danych dla tabeli ecms.gallery_category: ~5 rows (około)
DELETE FROM `gallery_category`;
/*!40000 ALTER TABLE `gallery_category` DISABLE KEYS */;
INSERT INTO `gallery_category` (`id`, `order`, `name`, `slug`, `active`) VALUES
	(8, 5, 'portraits', 'portraits', 1),
	(9, 3, 'people', 'people', 1),
	(10, 2, 'stories', 'stories', 1),
	(11, 4, 'shadow/light', 'shadow-light', 1),
	(12, 1, 'miscellaneous', 'miscellaneous', 1);
/*!40000 ALTER TABLE `gallery_category` ENABLE KEYS */;


-- Zrzut struktury tabela ecms.gallery_pictures
CREATE TABLE IF NOT EXISTS `gallery_pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL DEFAULT '0',
  `filename` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_bin,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Zrzucanie danych dla tabeli ecms.gallery_pictures: ~0 rows (około)
DELETE FROM `gallery_pictures`;
/*!40000 ALTER TABLE `gallery_pictures` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Zrzucanie danych dla tabeli ecms.user: ~2 rows (około)
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Zrzucanie danych dla tabeli ecms.user_extra: ~0 rows (około)
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Zrzucanie danych dla tabeli ecms.user_logs: ~78 rows (około)
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
	(1, 10, '1399583182', 'REMOVEPICTURE', 'stories', ''),
	(1, 10, '1399669322', 'REMOVEPICTURE', 'stories', ''),
	(1, 10, '1399669504', 'REMOVEPICTURE', 'stories', ''),
	(1, 10, '1399669539', 'REMOVEPICTURE', 'stories', ''),
	(1, 10, '1399669614', 'ADDPICTURE', 'stories', ''),
	(1, 10, '1399669622', 'REMOVEPICTURE', '', ''),
	(1, 10, '1399843670', 'LOGIN', '', ''),
	(1, 10, '1399843680', 'ADDPICTURE', 'stories', ''),
	(1, 10, '1399843689', 'REMOVEPICTURE', '', ''),
	(1, 10, '1399843874', 'ADDPICTURE', 'stories', ''),
	(1, 10, '1399843880', 'REMOVEPICTURE', 'stories', ''),
	(1, 10, '1399930679', 'LOGIN', '', ''),
	(1, 10, '1399931219', 'ADDPICTURE', 'stories', ''),
	(1, 10, '1399931226', 'REMOVEPICTURE', 'stories', ''),
	(1, 10, '1400000945', 'LOGIN', '', ''),
	(1, 10, '1400317500', 'LOGIN', '', ''),
	(0, 0, '1400351201', 'LOGOUT', '', ''),
	(1, 10, '1400351204', 'LOGIN', '', ''),
	(1, 10, '1400359123', 'LOGOUT', '', ''),
	(1, 10, '1400359126', 'LOGIN', '', ''),
	(1, 10, '1400359564', 'LOGOUT', '', ''),
	(1, 5, '1400360037', 'LOGIN', '', ''),
	(1, 10, '1400360071', 'LOGIN', '', ''),
	(1, 10, '1400360488', 'LOGOUT', '', ''),
	(1, 10, '1400361064', 'LOGIN', '', ''),
	(1, 10, '1400361070', 'LOGOUT', '', ''),
	(1, 10, '1400361082', 'LOGIN', '', ''),
	(1, 10, '1400362749', 'LOGOUT', '', ''),
	(1, 10, '1400363677', 'LOGIN', '', ''),
	(1, 10, '1400363723', 'LOGOUT', '', ''),
	(1, 10, '1400363733', 'LOGIN', '', ''),
	(1, 10, '1400363808', 'LOGOUT', '', ''),
	(1, 10, '1400363822', 'LOGIN', '', ''),
	(1, 10, '1400364119', 'LOGIN', '', ''),
	(1, 10, '1400364215', 'LOGIN', '', ''),
	(1, 10, '1400364280', 'LOGOUT', '', ''),
	(1, 10, '1400364359', 'LOGIN', '', ''),
	(1, 10, '1400364922', 'LOGIN', '', ''),
	(1, 10, '1400364924', 'LOGIN', '', ''),
	(1, 10, '1400364925', 'LOGIN', '', ''),
	(1, 10, '1400364926', 'LOGIN', '', ''),
	(1, 10, '1400365520', 'LOGOUT', '', ''),
	(1, 10, '1400365542', 'LOGIN', '', ''),
	(1, 10, '1400365544', 'LOGOUT', '', ''),
	(1, 10, '1400365610', 'LOGIN', '', ''),
	(1, 10, '1400365653', 'LOGOUT', '', ''),
	(1, 3, '1400365664', 'LOGIN', '', ''),
	(1, 3, '1400365665', 'LOGIN', '', ''),
	(1, 5, '1400365677', 'LOGIN', '', ''),
	(1, 5, '1400365695', 'LOGIN', '', ''),
	(1, 5, '1400365720', 'LOGIN', '', ''),
	(1, 5, '1400365770', 'LOGIN', '', ''),
	(1, 5, '1400365776', 'LOGOUT', '', ''),
	(1, 5, '1400365778', 'LOGIN', '', ''),
	(1, 5, '1400365785', 'LOGOUT', '', ''),
	(1, 5, '1400365788', 'LOGIN', '', ''),
	(1, 10, '1400365945', 'LOGIN', '', '');
/*!40000 ALTER TABLE `user_logs` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
