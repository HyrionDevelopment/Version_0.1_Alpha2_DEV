-- phpMyAdmin SQL Dump
-- version 3.4.8
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 23 aug 2012 om 01:08
-- Serverversie: 5.5.8
-- PHP-Versie: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `alpha2`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `hr_admin_dashboard_sc`
--

CREATE TABLE IF NOT EXISTS `hr_admin_dashboard_sc` (
  `admin_dashboard_sc_id` int(11) NOT NULL,
  `sc_title` varchar(255) NOT NULL,
  `sc_image` varchar(255) NOT NULL,
  `sc_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `hr_admin_menu_category`
--

CREATE TABLE IF NOT EXISTS `hr_admin_menu_category` (
  `menu_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_alias` varchar(255) NOT NULL,
  `order_by` int(11) NOT NULL,
  PRIMARY KEY (`menu_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `hr_admin_menu_category`
--

INSERT INTO `hr_admin_menu_category` (`menu_category_id`, `category_name`, `category_alias`, `order_by`) VALUES
(1, 'Dashboard', 'dashboard', 2),
(2, 'Pagina''s', 'Paginas', 3),
(3, 'Homepage', 'homepage', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `hr_admin_menu_items`
--

CREATE TABLE IF NOT EXISTS `hr_admin_menu_items` (
  `menu_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_category_id` int(11) NOT NULL,
  `order_by` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_alt` varchar(255) NOT NULL,
  `item_link` varchar(255) NOT NULL,
  PRIMARY KEY (`menu_item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `hr_admin_menu_items`
--

INSERT INTO `hr_admin_menu_items` (`menu_item_id`, `menu_category_id`, `order_by`, `item_name`, `item_alt`, `item_link`) VALUES
(1, 2, 1, 'Pagina''s Home', 'Paginas_Home', '{BaseUrli_admin}pages/home/'),
(2, 2, 2, 'Pagina''s Toevoegen', 'paginas_toevoegen', '{BaseUrli_admin}pages/add');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `hr_app_permissions`
--

CREATE TABLE IF NOT EXISTS `hr_app_permissions` (
  `app_permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `app_name` varchar(255) NOT NULL,
  `rank_id` int(11) NOT NULL,
  `all_class_access` tinyint(1) NOT NULL,
  `all_controller_access` tinyint(1) NOT NULL,
  `all_model_access` tinyint(1) NOT NULL,
  `access` tinyint(1) NOT NULL,
  PRIMARY KEY (`app_permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `hr_default_permissions`
--

CREATE TABLE IF NOT EXISTS `hr_default_permissions` (
  `DefPermission_id` int(11) NOT NULL AUTO_INCREMENT,
  `App_name` varchar(255) NOT NULL,
  `Class_name` varchar(255) NOT NULL,
  `Function_name` varchar(255) NOT NULL,
  `Access` enum('0','1') NOT NULL,
  PRIMARY KEY (`DefPermission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `hr_default_permissions`
--

INSERT INTO `hr_default_permissions` (`DefPermission_id`, `App_name`, `Class_name`, `Function_name`, `Access`) VALUES
(2, 'cms', '*', '*', '1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `hr_menu_category`
--

CREATE TABLE IF NOT EXISTS `hr_menu_category` (
  `menu_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_alias` varchar(255) NOT NULL,
  `order_by` int(11) NOT NULL,
  PRIMARY KEY (`menu_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Gegevens worden uitgevoerd voor tabel `hr_menu_category`
--

INSERT INTO `hr_menu_category` (`menu_category_id`, `category_name`, `category_alias`, `order_by`) VALUES
(1, 'Main Menu', 'Main_Menu', 1),
(3, 'Webshop', 'webshop', 3),
(4, 'Profiel', 'profiel', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `hr_menu_items`
--

CREATE TABLE IF NOT EXISTS `hr_menu_items` (
  `menu_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_category_id` int(11) NOT NULL,
  `order_by` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_alt` varchar(255) NOT NULL,
  `item_link` varchar(255) NOT NULL,
  PRIMARY KEY (`menu_item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Gegevens worden uitgevoerd voor tabel `hr_menu_items`
--

INSERT INTO `hr_menu_items` (`menu_item_id`, `menu_category_id`, `order_by`, `item_name`, `item_alt`, `item_link`) VALUES
(1, 1, 2, 'Home Page', 'Homepage', ''),
(2, 1, 1, 'Login', 'Login', 'ucp/login/'),
(5, 3, 1, 'Bekijk winkelmandje', 'Bekijk winkelmandje', 'webshop/winkelmandje/bekijken/'),
(6, 3, 2, 'Product zoeken', 'Product zoeken', 'webshop/producten/zoeken'),
(7, 4, 1, 'Bewerk Profiel', 'profile edit', 'profile/edit');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `hr_pages`
--

CREATE TABLE IF NOT EXISTS `hr_pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) NOT NULL,
  `page_alias` varchar(255) NOT NULL,
  `page_create_user_id` int(11) NOT NULL,
  `page_date` datetime NOT NULL,
  `page_content` text NOT NULL,
  `page_is_homepage` int(11) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Gegevens worden uitgevoerd voor tabel `hr_pages`
--

INSERT INTO `hr_pages` (`page_id`, `page_title`, `page_alias`, `page_create_user_id`, `page_date`, `page_content`, `page_is_homepage`) VALUES
(2, 'Homepage', 'Homepage', 2, '2011-10-09 11:02:45', '<h1>\r\n	&#39;Samsung brengt Galaxy S&nbsp;2 HD ook buiten Azi&euml; uit&#39;</h1>\r\n<p class="author">\r\n	<span style="color:#cccccc;"><span style="font-size: 10px;">Door </span></span><span style="font-size:10px;"><span style="color:#cccccc;"><strong>Yoeri Nijs</strong></span></span><span style="color:#cccccc;"><span style="font-size: 10px;">, maandag 17 oktober 2011 11:09, views: 14.710</span></span></p>\r\n<div class="article">\r\n	<p class="lead">\r\n		<strong>Samsung gaat zijn eerder aangekondigde Galaxy S II HD misschien ook buiten Korea uitbrengen. Het Amerikaanse keuringsinstituut FCC zou de telefoon al hebben g</strong><strong>oedgekeurd, blijkt uit documenten op de website van de organisatie.</strong></p>\r\n	<p>\r\n		<img alt="Samsung Galaxy S II HD LTE" height="287" src="http://ic.tweakimg.net/ext/i/imagenormal/1317038966.jpeg" style="margin: 5px 0px 0px 10px; float: right;" title="Samsung Galaxy S II HD LTE" width="150" />De telefoon staat in de <a href="https://fjallfoss.fcc.gov/oetcf/eas/reports/ViewExhibitReport.cfm?mode=Exhibits&amp;RequestTimeout=500&amp;calledFromFrame=N&amp;application_id=575089&amp;fcc_id=%27A3LSHVE120L" rel="external" target="_blank" title="FCC -- OET Exhibits List">documenten</a> als SHV-E120L. Dat typenummer is vanwege de uitgelekte specificaties al eerder in verband gebracht met de nieuwe smartphone van Samsung. Engadget <a href="http://www.engadget.com/2011/10/14/samsungs-korea-bound-shv-e120l-pops-up-in-fcc-filings/" rel="external" target="_blank" title="Engadget -- http://www.engadget.com/2011/10/14/samsungs-korea-bound-shv-e120l-pops-up-in-fcc-filings/">suggereert</a> dat het ook deze keer om de opvolger van de Galaxy S II gaat: de HD LTE. Die naam ontbreekt echter in de documenten.</p>\r\n	<p>\r\n		Samsungs nieuwe smartphone <a href="http://tweakers.net/nieuws/77008/samsung-komt-in-korea-met-hd-versie-van-galaxy-s-ii.html" target="_self" title="Samsung komt in Korea met HD-versie van Galaxy S II">kwam</a> aanvankelijk alleen uit in Korea. Met de goedkeuring van de FCC is het aannemelijk dat de telefoon ook in de Verenigde Staten zal verschijnen. De specificaties van de nog niet vrijgegeven Google Nexus Prime komen volgens geruchten overeen met die van de Galaxy S II HD. Het zou niet de eerste keer zijn dat de Nexus- en Galaxy-telefoons veel gemeen hebben; vorig jaar fabriceerde Samsung al de Nexus S, die sterk was gebaseerd op de Galaxy S.</p>\r\n	<p>\r\n		De Galaxy S II HD kan, behalve met gsm en 3g, ook overweg met lte-netwerken. Het toestel draait op een dualcoreprocessor met 1,5GHz. De beelddiagonaal van het Super Amoled-scherm is 4,65&quot; bij 1280x720 pixels. Verder beschikt de telefoon over een accu van 1850mAh.</p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', 1),
(4, 'test', 'test', 1, '2011-10-17 19:29:38', '<p>\r\n	Hallo allemaal, ik ben stom ihihihih</p>\r\n', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `hr_permissions`
--

CREATE TABLE IF NOT EXISTS `hr_permissions` (
  `permission_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `permission_value` varchar(255) NOT NULL,
  `permission_type` int(11) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `hr_permissions`
--

INSERT INTO `hr_permissions` (`permission_id`, `permission_value`, `permission_type`) VALUES
(1, '127.0.0.1', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `hr_permissions2`
--

CREATE TABLE IF NOT EXISTS `hr_permissions2` (
  `permissions2_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `permission_id` bigint(20) NOT NULL,
  `App_name` varchar(255) NOT NULL,
  `Class_name` varchar(255) NOT NULL,
  `Function_Name` varchar(255) NOT NULL,
  `Access` enum('0','1') NOT NULL,
  PRIMARY KEY (`permissions2_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `hr_permission_rank`
--

CREATE TABLE IF NOT EXISTS `hr_permission_rank` (
  `rank_id` int(11) NOT NULL AUTO_INCREMENT,
  `rank_name` varchar(255) NOT NULL,
  `rank_color` varchar(7) NOT NULL,
  `special_rank` int(11) NOT NULL,
  PRIMARY KEY (`rank_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Gegevens worden uitgevoerd voor tabel `hr_permission_rank`
--

INSERT INTO `hr_permission_rank` (`rank_id`, `rank_name`, `rank_color`, `special_rank`) VALUES
(1, 'Gast', '#cccccc', 0),
(2, 'User', '#000000', 0),
(3, 'Admin', '#FF0000', 0),
(4, 'test_special', '#cc3333', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `hr_profile`
--

CREATE TABLE IF NOT EXISTS `hr_profile` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_field` varchar(255) NOT NULL,
  `required` int(11) NOT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Gegevens worden uitgevoerd voor tabel `hr_profile`
--

INSERT INTO `hr_profile` (`profile_id`, `profile_field`, `required`) VALUES
(1, 'Voornaam', 1),
(2, 'Achternaam', 1),
(3, 'Adres', 0),
(4, 'Postcode', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `hr_profile_data`
--

CREATE TABLE IF NOT EXISTS `hr_profile_data` (
  `profiel_data_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `profile_data_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`profiel_data_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Gegevens worden uitgevoerd voor tabel `hr_profile_data`
--

INSERT INTO `hr_profile_data` (`profiel_data_id`, `user_id`, `profile_id`, `profile_data_value`) VALUES
(18, 1, 1, 'Maarten'),
(19, 1, 2, 'Oosting'),
(20, 1, 3, 'Amelterhout 45'),
(21, 1, 4, '9403 EC');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `hr_rank_admin_access`
--

CREATE TABLE IF NOT EXISTS `hr_rank_admin_access` (
  `rank_admin_access_id` int(11) NOT NULL AUTO_INCREMENT,
  `rank_id` int(11) NOT NULL,
  `access` tinyint(11) NOT NULL,
  PRIMARY KEY (`rank_admin_access_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `hr_sessions`
--

CREATE TABLE IF NOT EXISTS `hr_sessions` (
  `session_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `session_code` varchar(12) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `timestamp` int(20) NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Gegevens worden uitgevoerd voor tabel `hr_sessions`
--

INSERT INTO `hr_sessions` (`session_id`, `user_id`, `session_code`, `ip`, `timestamp`) VALUES
(8, 1, '7bf972bccd47', '127.0.0.1', 1345135294);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `hr_settings`
--

CREATE TABLE IF NOT EXISTS `hr_settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(255) NOT NULL,
  `setting_value` varchar(255) NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Gegevens worden uitgevoerd voor tabel `hr_settings`
--

INSERT INTO `hr_settings` (`setting_id`, `setting_name`, `setting_value`) VALUES
(1, 'default_style', 'default'),
(2, 'website_name', 'Hyrion'),
(3, 'path_url', '/'),
(4, 'system_version', '2.0.0'),
(5, 'Website_url', 'localhost'),
(6, 'prefix_url', 'http://'),
(7, 'rewrites_enabled', 'true'),
(8, 'admin_rewrites_enabled', 'true');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `hr_styles`
--

CREATE TABLE IF NOT EXISTS `hr_styles` (
  `style_id` int(11) NOT NULL AUTO_INCREMENT,
  `style_name` varchar(255) NOT NULL,
  `style_made_by` varchar(255) NOT NULL,
  `style_activated` tinyint(4) NOT NULL,
  PRIMARY KEY (`style_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `hr_styles`
--

INSERT INTO `hr_styles` (`style_id`, `style_name`, `style_made_by`, `style_activated`) VALUES
(2, 'Test2', 'Maarten', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `hr_users`
--

CREATE TABLE IF NOT EXISTS `hr_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `rank_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `hr_user_ranks`
--

CREATE TABLE IF NOT EXISTS `hr_user_ranks` (
  `user_rank_id` int(11) NOT NULL AUTO_INCREMENT,
  `rank_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `default_rank_user` int(11) NOT NULL,
  PRIMARY KEY (`user_rank_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `hr_user_ranks`
--

INSERT INTO `hr_user_ranks` (`user_rank_id`, `rank_id`, `user_id`, `default_rank_user`) VALUES
(2, 2, 1, 0);

-- --------------------------------------------------------