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
	(8, 4, 'portraits', 'portraits', 1),
	(9, 5, 'people', 'people', 1),
	(10, 1, 'stories', 'stories', 1),
	(11, 3, 'shadow/light', 'shadow-light', 1),
	(12, 2, 'miscellaneous', 'miscellaneous', 1);
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
  `where` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `ip` varchar(20) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Zrzucanie danych dla tabeli ecms.user_logs: ~3 rows (około)
DELETE FROM `user_logs`;
/*!40000 ALTER TABLE `user_logs` DISABLE KEYS */;
INSERT INTO `user_logs` (`user_id`, `user_level`, `timestamp`, `action`, `what`, `where`, `ip`) VALUES
	(1, 10, '1401020062', 'LOGOUT', '', '', '127.0.0.1'),
	(1, 10, '1401020066', 'LOGIN', '', '', '127.0.0.1'),
	(1, 10, '1401020069', 'LOGOUT', '', '', '127.0.0.1'),
	(0, 0, '1401020073', 'FAILLOGIN', '', '', '127.0.0.1'),
	(0, 0, '1401020075', 'FAILLOGIN', '', '', '127.0.0.1'),
	(0, 0, '1401020077', 'FAILLOGIN', '', '', '127.0.0.1'),
	(1, 10, '1401020080', 'LOGIN', '', '', '127.0.0.1'),
	(1, 10, '1401020694', 'LOGOUT', '', '', '127.0.0.1'),
	(1, 10, '1401020696', 'LOGIN', '', '', '127.0.0.1'),
	(1, 10, '1401020698', 'LOGOUT', '', '', '127.0.0.1'),
	(0, 0, '1401020700', 'FAILLOGIN', '', '', '127.0.0.1'),
	(0, 0, '1401020702', 'FAILLOGIN', '', '', '127.0.0.1'),
	(1, 10, '1401020703', 'LOGIN', '', '', '127.0.0.1'),
	(1, 10, '1401020707', 'LOGOUT', '', '', '127.0.0.1'),
	(1, 10, '1401020758', 'LOGIN', '', '', '127.0.0.1'),
	(1, 10, '1401021604', 'LOGOUT', '', '', '127.0.0.1'),
	(0, 0, '1401021773', 'LOGOUT', '', '', '127.0.0.1'),
	(1, 10, '1401021889', 'LOGIN', '', '', '127.0.0.1'),
	(1, 10, '1401021892', 'LOGOUT', '', '', '127.0.0.1');
/*!40000 ALTER TABLE `user_logs` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
