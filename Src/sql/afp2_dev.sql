SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `afp2_auth_assignment`;
CREATE TABLE IF NOT EXISTS `afp2_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `afp2_idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `afp2_auth_item`;
CREATE TABLE IF NOT EXISTS `afp2_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `afp2_idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `afp2_auth_item_child`;
CREATE TABLE IF NOT EXISTS `afp2_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `afp2_auth_rule`;
CREATE TABLE IF NOT EXISTS `afp2_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `afp2_card_pair`;
CREATE TABLE IF NOT EXISTS `afp2_card_pair` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `card1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `afp2_category_id` int(11) UNSIGNED NOT NULL,
  `afp2_user_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_afp2_card_pair_afp2_category1_idx` (`afp2_category_id`),
  KEY `fk_afp2_card_pair_afp2_user1_idx` (`afp2_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `afp2_category`;
CREATE TABLE IF NOT EXISTS `afp2_category` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(99) COLLATE utf8_unicode_ci NOT NULL,
  `afp2_user_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_afp2_category_afp2_user1_idx` (`afp2_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `afp2_lexical_game`;
CREATE TABLE IF NOT EXISTS `afp2_lexical_game` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `resolved` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `error` int(4) DEFAULT NULL,
  `afp2_user_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_afp2_memory_game_afp2_user1_idx` (`afp2_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `afp2_memory_game`;
CREATE TABLE IF NOT EXISTS `afp2_memory_game` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `resolved` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `afp2_user_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_afp2_memory_game_afp2_user1_idx` (`afp2_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `afp2_migration`;
CREATE TABLE IF NOT EXISTS `afp2_migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `afp2_user`;
CREATE TABLE IF NOT EXISTS `afp2_user` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(99) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


ALTER TABLE `afp2_auth_assignment`
  ADD CONSTRAINT `afp2_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `afp2_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `afp2_auth_item`
  ADD CONSTRAINT `afp2_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `afp2_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `afp2_auth_item_child`
  ADD CONSTRAINT `afp2_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `afp2_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `afp2_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `afp2_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `afp2_card_pair`
  ADD CONSTRAINT `fk_afp2_card_pair_afp2_category1` FOREIGN KEY (`afp2_category_id`) REFERENCES `afp2_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_afp2_card_pair_afp2_user1` FOREIGN KEY (`afp2_user_id`) REFERENCES `afp2_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `afp2_category`
  ADD CONSTRAINT `fk_afp2_category_afp2_user1` FOREIGN KEY (`afp2_user_id`) REFERENCES `afp2_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `afp2_lexical_game`
  ADD CONSTRAINT `fk_afp2_memory_game_afp2_user10` FOREIGN KEY (`afp2_user_id`) REFERENCES `afp2_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `afp2_memory_game`
  ADD CONSTRAINT `fk_afp2_memory_game_afp2_user1` FOREIGN KEY (`afp2_user_id`) REFERENCES `afp2_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
