-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2016 at 09:28 AM
-- Server version: 5.5.27-log
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bankupu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance_histories`
--

CREATE TABLE IF NOT EXISTS `balance_histories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `amount` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `balance_histories`
--

INSERT INTO `balance_histories` (`id`, `user_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 2, 150000, '2016-01-06 04:45:43', '2016-01-06 04:45:43'),
(2, 2, 150000, '2016-01-06 04:46:17', '2016-01-06 04:46:17'),
(3, 3, 17000000, '2016-01-06 04:48:46', '2016-01-06 04:48:46'),
(4, 5, 1500000, '2016-01-06 07:45:34', '2016-01-06 07:45:34'),
(5, 5, 123000, '2016-01-06 08:23:48', '2016-01-06 08:23:48');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_histories`
--

CREATE TABLE IF NOT EXISTS `transfer_histories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_user` int(10) unsigned NOT NULL,
  `to_user` int(10) unsigned NOT NULL,
  `amount` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `transfer_histories`
--

INSERT INTO `transfer_histories` (`id`, `from_user`, `to_user`, `amount`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 200000, '2016-01-06 06:43:42', '2016-01-06 06:43:42'),
(2, 5, 2, 500000, '2016-01-06 07:46:00', '2016-01-06 07:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usergroup_id` int(10) unsigned NOT NULL,
  `activated` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_ktp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `npwp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_rek` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `balance` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expirebandate` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_usergroup_id_foreign` (`usergroup_id`),
  KEY `users_activation_code_index` (`activation_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `usergroup_id`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `first_name`, `last_name`, `tanggal_lahir`, `no_ktp`, `npwp`, `no_rek`, `sex`, `balance`, `remember_token`, `expirebandate`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'admin@bankupu.com', NULL, '$2y$10$JWE7CpQrN4Sf2iK99xL7KOX.4qiOfbVbsNvSbKxOE69JU5GQzT4He', 1, 1, NULL, NULL, '2016-01-06 08:23:32', NULL, 'Bank', 'Upu', '0000-00-00', '', '', '', 'man', 0, '7RtRlO02K8MmzUZzNIjqw2FHQRWWx76JJg4AGpj2cEsjoPac7FkzZPC1Js7o', NULL, NULL, '2015-10-27 18:17:28', '2016-01-06 08:23:54'),
(2, 'daulayreza@gmail.com', NULL, '$2y$10$FTRpgmNZzwL7Ob4soneAmeaLz6VXaaMod2yjQhDWepAQwPugE0ZKK', 2, 1, NULL, NULL, NULL, NULL, 'M Alfi Syah Reza D', '', '1993-08-27', '1210000084', '17081944', '123120000032', 'man', 1000000, NULL, NULL, NULL, '2016-01-06 03:30:33', '2016-01-06 07:46:01'),
(3, 'tamvanbocah@gmail.com', NULL, '$2y$10$wXi0yycFyWu58v13Jphasu0t8sC.l3H5cZ7MF8Z0.dXaNnjZWOcze', 2, 1, NULL, NULL, NULL, NULL, 'Suhendra Su', '', '1993-01-04', '1210000085', '', '123120000034', 'man', 800000, NULL, NULL, NULL, '2016-01-06 03:34:45', '2016-01-06 06:43:42'),
(5, 'rezadaulay@Ymail.com', NULL, '$2y$10$7qIr8k.4YVeVGMb9DvgN6.FOkC0PBoXNCJgHxdgoBi/xwD4wxUBg.', 2, 1, NULL, NULL, NULL, NULL, 'Rahmad Doni', '', '1990-02-06', '1210000087', '12456667', '123456789017', 'man', 1123000, NULL, NULL, NULL, '2016-01-06 07:37:28', '2016-01-06 08:23:48');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
