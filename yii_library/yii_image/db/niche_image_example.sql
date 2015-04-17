DROP TABLE IF EXISTS `niche_image_example`;

CREATE TABLE `niche_image_example` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image1` text COLLATE utf8_unicode_ci,
  `image2` text COLLATE utf8_unicode_ci,
  `image3` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;