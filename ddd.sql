-- --------------------------------------------------------
-- Host:                         108.167.181.226
-- Server version:               5.5.40-36.1 - Percona Server (GPL), Release 36.1, Revision 707
-- Server OS:                    Linux
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for cryptxe_exchange
CREATE DATABASE IF NOT EXISTS `cryptxe_exchange` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `cryptxe_exchange`;


-- Dumping structure for table cryptxe_exchange.addresses
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` text NOT NULL,
  `coin` text NOT NULL,
  `username` text NOT NULL,
  `date` datetime NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cryptxe_exchange.api
CREATE TABLE IF NOT EXISTS `api` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `pubkey` text NOT NULL,
  `secret` text NOT NULL,
  `date` date NOT NULL,
  `user` text NOT NULL,
  `perms` varchar(10) NOT NULL,
  `nonce` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cryptxe_exchange.banlist
CREATE TABLE IF NOT EXISTS `banlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `bannedby` text NOT NULL,
  `banneduntil` date NOT NULL,
  `reason` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cryptxe_exchange.coins
CREATE TABLE IF NOT EXISTS `coins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coin` text NOT NULL,
  `description` text NOT NULL,
  `title` text NOT NULL,
  `market` int(11) NOT NULL,
  `enabled` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cryptxe_exchange.emailactivate
CREATE TABLE IF NOT EXISTS `emailactivate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `code` text NOT NULL,
  `date` date NOT NULL,
  `renewed` int(11) NOT NULL,
  `complete` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cryptxe_exchange.faq
CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `faq` text NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cryptxe_exchange.identifications
CREATE TABLE IF NOT EXISTS `identifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `image` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `city` text NOT NULL,
  `postcode` text NOT NULL,
  `state` text NOT NULL,
  `dateofbirth` text NOT NULL,
  `ip` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cryptxe_exchange.logins
CREATE TABLE IF NOT EXISTS `logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `ip` text NOT NULL,
  `date` datetime NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cryptxe_exchange.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `message` text NOT NULL,
  `user` text NOT NULL,
  `messageread` varchar(10) NOT NULL DEFAULT 'unread',
  `whofrom` text NOT NULL,
  `type` text NOT NULL,
  `date` datetime NOT NULL,
  `tempdelete` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cryptxe_exchange.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `page` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table cryptxe_exchange.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` text NOT NULL,
  `market` varchar(25) NOT NULL,
  `fee` varchar(25) NOT NULL,
  `cost` varchar(25) NOT NULL,
  `time` datetime NOT NULL,
  `user` varchar(25) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `price` text NOT NULL,
  `beforefee` text NOT NULL,
  `buysell` varchar(10) NOT NULL,
  `maincoin` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cryptxe_exchange.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `url` text NOT NULL,
  `body` text NOT NULL,
  `date` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cryptxe_exchange.referal
CREATE TABLE IF NOT EXISTS `referal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `market` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `tfhour` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `tdays` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `summary` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `user` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table cryptxe_exchange.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `sitename` varchar(25) NOT NULL,
  `slogan` text NOT NULL,
  `siteurl` varchar(25) NOT NULL,
  `keywords` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `coins` varchar(250) NOT NULL,
  `fees` varchar(10) NOT NULL,
  `vat` text NOT NULL,
  `address` text NOT NULL,
  `phonenumber` text NOT NULL,
  `email` text NOT NULL,
  `emailverify` int(11) NOT NULL,
  `userverify` int(11) NOT NULL,
  `maintenance` int(11) NOT NULL,
  PRIMARY KEY (`sitename`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cryptxe_exchange.support
CREATE TABLE IF NOT EXISTS `support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text COLLATE utf8_unicode_ci NOT NULL,
  `category` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `ipaddress` int(11) NOT NULL,
  `priority` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table cryptxe_exchange.tickets
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text COLLATE utf8_unicode_ci,
  `user` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `mainticket` int(11) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table cryptxe_exchange.trades
CREATE TABLE IF NOT EXISTS `trades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` text NOT NULL,
  `market` varchar(25) NOT NULL,
  `cost` varchar(25) NOT NULL,
  `fee` varchar(25) NOT NULL,
  `time` time NOT NULL,
  `user` varchar(25) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `price` text NOT NULL,
  `buysell` text NOT NULL,
  `date` datetime NOT NULL,
  `maincoin` text NOT NULL,
  `charttime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cryptxe_exchange.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `firstname` text COLLATE utf8_unicode_ci NOT NULL,
  `lastname` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `country` text COLLATE utf8_unicode_ci NOT NULL,
  `state` text COLLATE utf8_unicode_ci NOT NULL,
  `street` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` text COLLATE utf8_unicode_ci NOT NULL,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `confirmations` int(11) NOT NULL,
  `txid` text COLLATE utf8_unicode_ci NOT NULL,
  `amount` text COLLATE utf8_unicode_ci NOT NULL,
  `market` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `time` text COLLATE utf8_unicode_ci NOT NULL,
  `transaction` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table cryptxe_exchange.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` text NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varbinary(100) NOT NULL,
  `password` text NOT NULL,
  `passwordsalt` text NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  `staff` int(11) NOT NULL DEFAULT '0',
  `nofees` int(11) NOT NULL DEFAULT '0',
  `btc` decimal(10,4) DEFAULT '0.0000',
  `ltc` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `usd` decimal(10,2) NOT NULL DEFAULT '0.00',
  `gbp` decimal(10,2) NOT NULL DEFAULT '0.00',
  `eur` decimal(10,2) NOT NULL DEFAULT '0.00',
  `firstname` varbinary(100) DEFAULT NULL,
  `lastname` varbinary(100) DEFAULT NULL,
  `address1` varbinary(100) DEFAULT NULL,
  `address2` varbinary(100) DEFAULT NULL,
  `city` varbinary(100) DEFAULT NULL,
  `zip` varbinary(100) DEFAULT NULL,
  `state` varbinary(100) DEFAULT NULL,
  `country` varbinary(100) DEFAULT NULL,
  `dob` varbinary(100) DEFAULT NULL,
  `security_question2` varbinary(100) NOT NULL,
  `security_answer1` varbinary(100) NOT NULL,
  `security_question1` varbinary(100) NOT NULL,
  `security_answer2` varbinary(100) NOT NULL DEFAULT 'english',
  `emailverified` int(11) NOT NULL DEFAULT '0',
  `detailverified` int(11) NOT NULL DEFAULT '0',
  `detailssubmitted` int(11) NOT NULL DEFAULT '0',
  `invalidid` int(11) NOT NULL,
  `verifyimg` text NOT NULL,
  `ipwhitelist` text NOT NULL,
  `banned` int(11) NOT NULL DEFAULT '0',
  `messagenotify` int(11) NOT NULL DEFAULT '1',
  `sidebaropen` int(11) NOT NULL DEFAULT '0',
  `chatbaropen` int(11) NOT NULL DEFAULT '0',
  `twofactor` int(11) NOT NULL DEFAULT '0',
  `twofackey` text NOT NULL,
  `referer` text NOT NULL,
  `loginnotify` int(11) DEFAULT NULL,
  `withdrawnotify` int(11) DEFAULT NULL,
  `voicecommands` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1;

-- Data exporting was unselected.


-- Dumping structure for table cryptxe_exchange.userguides
CREATE TABLE IF NOT EXISTS `userguides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `message` text NOT NULL,
  `date` int(11) NOT NULL,
  `url` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
