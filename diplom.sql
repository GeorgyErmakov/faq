-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `diplom_a` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `diplom_a`;

DROP TABLE IF EXISTS `answer`;
CREATE TABLE `answer` (
  `id` int(11) NOT NULL auto_increment,
  `text` text collate utf8_unicode_ci NOT NULL,
  `published` int(11) NOT NULL,
  `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `answer` (`id`, `text`, `published`, `created_at`, `updated_at`) VALUES
(1,	'1sdasda',	1,	'2018-06-12 08:01:53',	'2018-06-12 05:01:53'),
(2,	'ыывфаывфафывлнглг22222222222222222222',	1,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(3,	'111111111444444444444',	1,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(4,	'можно',	1,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(5,	'1234aaaaaaaaaaaa',	1,	'2018-06-07 11:06:06',	'2018-06-07 08:06:06'),
(6,	'1111',	1,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(7,	'ответил',	1,	'2018-06-06 18:09:21',	'0000-00-00 00:00:00'),
(8,	'ответ',	1,	'2018-06-06 18:32:34',	'0000-00-00 00:00:00'),
(9,	'aaaazzzzzzz',	0,	'2018-06-07 10:58:25',	'2018-06-07 07:58:25'),
(10,	'1111',	0,	'2018-06-07 11:25:59',	'2018-06-07 08:25:59'),
(11,	'ыыыы',	0,	'2018-06-07 11:32:50',	'2018-06-07 08:32:50'),
(12,	'112',	0,	'2018-06-07 12:22:00',	'2018-06-07 09:22:00'),
(13,	'',	0,	'2018-06-07 09:22:41',	'2018-06-07 09:22:41'),
(14,	'задавай',	0,	'2018-06-07 12:24:56',	'2018-06-07 09:24:56'),
(15,	'1',	0,	'2018-06-11 20:01:57',	'2018-06-11 17:01:57'),
(16,	'вот вам ответьилолорллрлрлор',	0,	'2018-06-12 07:27:31',	'2018-06-12 04:27:31'),
(17,	'',	0,	'2018-06-12 05:21:18',	'2018-06-12 05:21:18');

DROP TABLE IF EXISTS `author`;
CREATE TABLE `author` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) collate utf8_unicode_ci NOT NULL,
  `email` varchar(50) collate utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `author` (`id`, `name`, `email`, `updated_at`, `created_at`) VALUES
(1,	'Ваня',	'ууу@uuu',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(2,	'Вася',	'ууу@uuu',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(3,	'Егор',	'egge@ya.ru',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(4,	'Fynjy',	'ermakov.g@gmail.com',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(5,	'avakum',	'av@u',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(6,	'den',	'deb',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(7,	'xxxx',	'hhhh',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(8,	'Нико',	'Arlekino2018',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(9,	'zamba',	'egge@ya11111111.ru',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(10,	'zamba',	'egge@ya11111111.ru',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(11,	'zamba',	'egge@ya11111111.ru',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(12,	'inga',	'inga',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(13,	'artez',	'artes',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(14,	'Иван',	'ermakov.g@gmail.com2',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(15,	'Зоя',	'egge@yandex.ru',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(16,	'd',	'egge@ya.ru',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(17,	'd',	'egge@ya.ru',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(18,	's',	'Arlekino2018@rrrr',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(19,	's',	'Arlekino2018@rrrr',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(20,	's',	'egge@ya.ru',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(21,	's',	'Arlekino2018@rrrrgggggggg',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(22,	's',	'egge@ya.ru',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(23,	'2',	'Arlekino2018@rrrrrrrrrrrrrrrrrrrr',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(24,	'5',	'egge@ya.ru2222',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(25,	'd',	'd@v',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(26,	'asdf',	'egge@ya.ru',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(27,	's',	'ermakov.g@gmail.com',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(28,	's',	'ermakov.g@gmail.com',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(29,	's',	'egge@ya.ru',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(30,	's',	'egge@ya.ru',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(31,	's',	'egge@ya.ru',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(32,	's',	'egge@ya.ru',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(33,	'в',	'ermakov.g@gmail.com',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(34,	's',	'ermakov.g@gmail.com',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(35,	'1',	'1@1',	'2018-06-07 06:08:07',	'2018-06-07 06:08:07'),
(36,	'1',	'1@1',	'2018-06-07 08:24:40',	'2018-06-07 08:24:40'),
(37,	's',	'egge@ya.ru',	'2018-06-07 08:31:49',	'2018-06-07 08:31:49'),
(38,	'Алекс',	'egge@yandex.ru',	'2018-06-07 09:16:07',	'2018-06-07 09:16:07'),
(39,	's',	'egge@ya.ru',	'2018-06-07 09:22:19',	'2018-06-07 09:22:19'),
(40,	'Семен',	'semen@semenov',	'2018-06-07 09:24:19',	'2018-06-07 09:24:19'),
(41,	'Pf',	'sd@ya',	'2018-06-11 16:56:35',	'2018-06-11 16:56:35'),
(42,	'Новый автор',	'egge@ya.ru',	'2018-06-12 04:24:35',	'2018-06-12 04:24:35'),
(43,	'игорь',	'2@ry',	'2018-06-12 05:03:18',	'2018-06-12 05:03:18'),
(44,	'Шарль',	'egge@ya.ru',	'2018-06-12 05:19:47',	'2018-06-12 05:19:47'),
(45,	'Артур',	'1@1',	'2018-06-12 05:20:45',	'2018-06-12 05:20:45'),
(46,	'Артур',	'egge@ya.ru',	'2018-06-12 05:26:34',	'2018-06-12 05:26:34');

DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `id` int(11) NOT NULL auto_increment,
  `question` text collate utf8_unicode_ci NOT NULL,
  `visible` int(11) default '0',
  `aid` int(11) default NULL,
  `athid` int(11) default NULL,
  `sid` int(11) default NULL,
  `created_at` timestamp NULL default NULL,
  `updated_at` timestamp NULL default NULL,
  `vis` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `sid` (`sid`),
  KEY `aid` (`aid`),
  KEY `athid` (`athid`),
  CONSTRAINT `question_ibfk_6` FOREIGN KEY (`sid`) REFERENCES `subject` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `question_ibfk_7` FOREIGN KEY (`aid`) REFERENCES `answer` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `question_ibfk_8` FOREIGN KEY (`athid`) REFERENCES `author` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `question` (`id`, `question`, `visible`, `aid`, `athid`, `sid`, `created_at`, `updated_at`, `vis`) VALUES
(1,	'*B6062F055771B337787A84F2D711796077D7F616',	1,	1,	1,	NULL,	NULL,	'2018-06-06 14:49:15',	1),
(23,	'Сколько можно?444',	1,	8,	1,	NULL,	'2018-06-06 07:12:04',	'2018-06-06 14:32:50',	1),
(25,	'Финал',	0,	10,	11,	NULL,	'2018-06-07 08:24:40',	'2018-06-07 09:15:26',	0),
(27,	'Новый вопрос опять',	0,	12,	38,	NULL,	'2018-06-07 09:16:07',	'2018-06-07 09:17:22',	1),
(28,	'Сколько можно?1111',	0,	13,	39,	NULL,	'2018-06-07 09:22:19',	'2018-06-11 16:47:16',	1),
(33,	'первый вопрос?',	0,	NULL,	44,	NULL,	'2018-06-12 05:19:47',	'2018-06-12 05:19:47',	0),
(34,	'второй вопрос',	0,	17,	45,	18,	'2018-06-12 05:20:45',	'2018-06-12 05:21:18',	1),
(35,	'как использовать классы?',	0,	NULL,	46,	18,	'2018-06-12 05:26:34',	'2018-06-12 05:26:34',	0);

DROP TABLE IF EXISTS `subject`;
CREATE TABLE `subject` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) collate utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `subject` (`id`, `name`, `created_at`, `updated_at`) VALUES
(18,	'Первая тема',	'2018-06-12 05:20:11',	'2018-06-12 05:20:11');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) collate utf8_unicode_ci NOT NULL,
  `password` varchar(60) collate utf8_unicode_ci NOT NULL,
  `email` varchar(60) collate utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `remember_token` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`, `name`, `password`, `email`, `updated_at`, `created_at`, `remember_token`) VALUES
(4,	'admin',	'$2y$10$adlSP.pmlyKO5w6QGYXjeO81SCev3Rd2AdvkRo85tb7k7aYyony9e',	'admin@admin',	'2018-06-12 05:29:48',	'2018-06-01 13:19:55',	'AtPBybQBJfqsBu55lEpAfurCGjmi3mulCTpHLL1XEb6X6CRebOv87QkiqLHJ');

-- 2018-06-12 08:28:25
