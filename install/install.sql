CREATE TABLE `bingtranslator_settings` (
  `idx` int(90) NOT NULL AUTO_INCREMENT,
  `seq` int(90) DEFAULT NULL,
  `default_lang1` varchar(10) DEFAULT NULL,
  `default_lang2` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;