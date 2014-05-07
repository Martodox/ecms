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
	(9, 5, 'people', 'people', 1),
	(10, 1, 'stories', 'stories', 1),
	(11, 3, 'shadow/light', 'shadow-light', 1),
	(8, 4, 'portraits', 'portraits', 1);
/*!40000 ALTER TABLE `gallery_category` ENABLE KEYS */;


-- Zrzut struktury tabela ecms.gallery_pictures
CREATE TABLE IF NOT EXISTS `gallery_pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL DEFAULT '0',
  `filename` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_bin,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=179 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Zrzucanie danych dla tabeli ecms.gallery_pictures: 17 rows
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
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Zrzucanie danych dla tabeli ecms.user: 2 rows
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `email`, `level`, `active`, `first_name`, `last_name`, `salt`, `password`) VALUES
	(1, 'bartosz@jakubowiak.pl', 10, 1, 'Bartosz', 'Jakubowiak', 'b6fda06a4cd7077e1f8ad321cf1553cde26b6004b75ec177886001f17d66a1bb', '1b132dea5826f57c2ef82aacf9294e92fd45390e80e3606dc47ecdc383853f40'),
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
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
