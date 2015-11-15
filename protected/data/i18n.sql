CREATE TABLE IF NOT EXISTS `i18n_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `charset` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `i18n_info`
--

INSERT INTO `i18n_info` (`id`, `country`, `language`, `code`, `charset`) VALUES
(1, '', 'Afrikaans', 'af', 'iso-8859-1, windows-1252'),
(2, '', 'Albanian', 'sq', 'iso-8859-1, windows-1252'),
(3, '', 'Arabic', 'ar', 'iso-8859-6'),
(4, '', 'Basque', 'eu', 'iso-8859-1, windows-1252'),
(5, '', 'Bulgarian', 'bg', 'iso-8859-5'),
(6, '', 'Byelorussian', 'be', 'iso-8859-5'),
(7, '', 'Catalan', 'ca', 'iso-8859-1, windows-1252'),
(8, '', 'Croatian', 'hr', 'iso-8859-2,windows-1250'),
(9, '', 'Czech', 'cs', 'iso-8859-2'),
(10, '', 'Danish', 'da', 'iso-8859-1, windows-1252'),
(11, '', 'Dutch', 'nl', 'iso-8859-1, windows-1252'),
(12, '', 'English', 'en', 'iso-8859-1, windows-1252'),
(13, '', 'Esperanto', 'eo', 'iso-8859-3*'),
(14, '', 'Estonian', 'et', 'iso-8859-15'),
(15, '', 'Faroese', 'fo', 'iso-8859-1, windows-1252'),
(16, '', 'Finnish', 'fi', 'iso-8859-1, windows-1252'),
(17, '', 'French', 'fr', 'iso-8859-1, windows-1252'),
(18, '', 'Galician', 'gl', 'iso-8859-1, windows-1252'),
(19, '', 'German', 'de', 'iso-8859-1, windows-1252'),
(20, '', 'Greek', 'el', 'iso-8859-7'),
(21, '', 'Hebrew', 'iw', 'iso-8859-8'),
(22, '', 'Hungarian', 'hu', 'iso-8859-2'),
(23, '', 'Icelandic', 'is', 'iso-8859-1, windows-1252'),
(24, '', 'Inuit', 'eskimo', 'iso-8859-10'),
(25, '', 'Irish', 'ga', 'iso-8859-1, windows-1252'),
(26, '', 'Italian', 'it', 'iso-8859-1, windows-1252'),
(27, '', 'Japanese', 'ja', 'shift_jis, iso-2022-jp, euc-jp'),
(28, '', 'Korean', 'ko', 'euc-kr'),
(29, '', 'Lapp', 'lapp', 'iso-8859-10'),
(30, '', 'Latvian', 'lv', 'iso-8859-13, windows-1257'),
(31, '', 'Lithuanian', 'lt', 'iso-8859-13, windows-1257'),
(32, '', 'Macedonian', 'mk', 'iso-8859-5,windows-1251'),
(33, '', 'Maltese', 'mt', 'iso-8859-3'),
(34, '', 'Norwegian', 'no', 'iso-8859-1, windows-1252'),
(35, '', 'Polish', 'pl', 'iso-8859-2'),
(36, '', 'Portuguese', 'pt', 'iso-8859-1, windows-1252'),
(37, '', 'Romanian', 'ro', 'iso-8859-2'),
(38, '', 'Russian', 'ru', 'koi8-r, iso-8859-5'),
(39, '', 'Scottish', 'gd', 'iso-8859-1, windows-1252'),
(40, '', 'Serbian ~ cyrillic', 'sr', 'windows-1251, iso-8859-5'),
(41, '', 'Serbian ~ latin', 'sr', 'iso-8859-2, windows-1250'),
(42, '', 'Slovak', 'sk', 'iso-8859-2'),
(43, '', 'Slovenian', 'sl', 'iso-8859-2,windows-1250'),
(44, '', 'Spanish', 'es', 'iso-8859-1, windows-1252'),
(45, '', 'Swedish', 'sv', 'iso-8859-1, windows-1252'),
(46, '', 'Turkish', 'tr', 'iso-8859-9, windows-1254'),
(47, '', 'Ukrainian', 'uk', 'iso-8859-5');

-- --------------------------------------------------------

--
-- Table structure for table `i18n_source_message`
--

CREATE TABLE IF NOT EXISTS `i18n_source_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(32) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `i18n_source_message`
--

INSERT INTO `i18n_source_message` (`id`, `category`, `message`) VALUES
(1, 'strings', 'the quick brown fox jumped over the lazy dog'),
(2, 'strings', 'you have {count} new emails'),
(3, 'strings', 'n==1#one book|n>1#many books'),
(4, 'ui', 'Do you really want to delete this item?');

CREATE TABLE IF NOT EXISTS `i18n_translated_message` (
  `id` int(11) NOT NULL DEFAULT '0',
  `language` varchar(16) NOT NULL DEFAULT '',
  `translation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`,`language`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `i18n_translated_message`
  ADD CONSTRAINT `i18n_translated_message_ibfk_1` FOREIGN KEY (`id`) REFERENCES `i18n_source_message` (`id`) ON DELETE CASCADE;


INSERT INTO `i18n_translated_message` (`id`, `language`, `translation`) VALUES
(1, 'ar', 'قفز الثعلب البني السريع فوق الكلب الكسول'),
(1, 'bg', 'бързата кафява лисица скочи над мързелив куче'),
(1, 'de', 'Der schnelle braune Fuchs über den faulen Hund sprang'),
(1, 'es', 'el zorro marrón rápido saltó sobre el perro perezoso'),
(1, 'fr', 'le renard marron agile saute par dessus le chien  paresseux'),
(1, 'it', 'La volpe marrone veloce saltò sul cane pigro'),
(1, 'nl', 'de snelle bruine vos sprong over de luie hond'),
(1, 'pt', 'A ligeira raposa marrom saltou sobre o cão preguiçoso'),
(1, 'ru', 'Быстрая, коричневая лиса, перепрыгнула через ленивого пса'),
(1, 'ta', 'விரைவு பழுப்பு நரி சோம்பேறி நாய் மீது உயர்ந்தது'),
(1, 'uk', 'Швидка коричнева лисиця перестрибнула через ледачу собаку'),
(2, 'fr', 'vous avez {count} nouveaux e-mails'),
(3, 'fr', 'n==1#un livre|n>1#de nombreux livres'),
(4, 'de', 'Glauben Sie wirklich diesen Inhalt löschen wollen'),
(4, 'fr', 'Voulez-vous vraiment supprimer cet objet');

