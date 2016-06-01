CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) BINARY NOT NULL DEFAULT '',
  `password` varchar(255) BINARY NOT NULL DEFAULT '',
  `area` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `locale` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  UNIQUE (`email`),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
