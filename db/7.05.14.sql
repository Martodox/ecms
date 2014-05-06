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
	(12, 5, 'miscellaneous', 'miscellaneous', 1),
	(9, 2, 'people', 'people', 1),
	(10, 3, 'stories', 'stories', 1),
	(11, 4, 'shadow/light', 'shadow-light', 1),
	(8, 1, 'portraits', 'portraits', 1);
/*!40000 ALTER TABLE `gallery_category` ENABLE KEYS */;


-- Zrzut struktury tabela ecms.gallery_pictures
CREATE TABLE IF NOT EXISTS `gallery_pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL DEFAULT '0',
  `filename` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_bin,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=160 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Zrzucanie danych dla tabeli ecms.gallery_pictures: 0 rows
DELETE FROM `gallery_pictures`;
/*!40000 ALTER TABLE `gallery_pictures` DISABLE KEYS */;
INSERT INTO `gallery_pictures` (`id`, `category`, `filename`, `description`) VALUES
	(176, 10, 'd01c91ecc9463900cc9b0facbeec7284aa301b65.jpeg', NULL),
	(175, 10, 'a3f2ab26e9262614cb03d610b2dacb725a057c14.jpeg', NULL),
	(174, 10, '3c5555c73dd792996c7753e4216b5be188e03190.jpeg', NULL),
	(173, 10, '94cef33139a0368547485ef225720c547ad64ef7.jpeg', NULL),
	(172, 10, '59fb8aa71ded5bdefa59e2154ade47d91d84749d.jpeg', NULL),
	(171, 10, '7c4d04217f148df03d588c245767f04ceb43223c.jpeg', NULL),
	(170, 10, 'd8d0ad3dc548886f97ae5f53ce0451a287e44c11.jpeg', NULL),
	(169, 10, '4dad693c806d61240db520e928b9fb023f369832.jpeg', NULL),
	(168, 10, 'bccbd03ac17e7c39cbbb041758a73f1e82659ff5.jpeg', NULL),
	(167, 10, '787da09c6dfb89be114b57443c5ec3aa581a96c6.jpeg', NULL),
	(166, 10, 'fde0845d7d5887e8c3a6807127d074ef07b0c9d1.jpeg', NULL),
	(165, 10, '1743924ec47ce0ebb66fb3f73c2a2c3160dacf9f.jpeg', NULL),
	(164, 10, '0efaa3c6605fb63cee12d8516bfd3d91709f53fa.jpeg', NULL),
	(163, 10, 'c5267b7783f3d1d44e2bba53b753d1846bf79fc3.jpeg', NULL),
	(162, 10, '3b2e33f8b86ce0160efd454183f3cf924633e85d.jpeg', NULL),
	(177, 10, 'fd43acbdca4c8b64b8ead73ab4c5c89ca2b2c8db.jpeg', NULL),
	(178, 10, 'a0fdee954c72d32146030d4fbce648363b4841ad.jpeg', NULL);
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
