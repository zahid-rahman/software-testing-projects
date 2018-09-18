-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2016 at 12:41 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `elibrary_doyin2`
--
 

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(250) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `library_book_reservation`
--

CREATE TABLE IF NOT EXISTS `library_book_reservation` (
  `lbr_id` int(11) NOT NULL AUTO_INCREMENT,
  `lbr_trans_id` int(11) NOT NULL,
  `lbr_library_id` int(5) NOT NULL,
  `lbr_date_reserverd_for` date DEFAULT NULL,
  `lbr_date_reserved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lbr_date_to_be_returned` date DEFAULT NULL,
  `lbr_catalog_item_id` int(11) NOT NULL,
  `lbr_reservedby` varchar(250) NOT NULL,
  `lbr_status` tinyint(1) NOT NULL DEFAULT '0',
  `lbr_processedby` varchar(250) NOT NULL,
  `lbr_admin_note` text NOT NULL,
  `lbr_user_note` text,
  PRIMARY KEY (`lbr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `library_borrowed_catalog_item`
--

CREATE TABLE IF NOT EXISTS `library_borrowed_catalog_item` (
  `lbci_id` int(11) NOT NULL AUTO_INCREMENT,
  `lbci_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lbci_user_id` varchar(250) NOT NULL,
  `lbci_user_type` tinyint(1) NOT NULL,
  `lbci_transaction_id` int(11) NOT NULL,
  `lbci_date_to_be_returned` date DEFAULT NULL,
  `lbci_issuer_id` varchar(250) NOT NULL,
  `lbci_catalog_item_id` int(11) NOT NULL,
  `lbci_date_collected` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lbci_return_resource_condition` tinyint(1) NOT NULL DEFAULT '1',
  `lbci_date_returned` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lbci_returned` tinyint(1) NOT NULL DEFAULT '0',
  `lbci_offense` int(11) NOT NULL,
  `lbci_cleared` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`lbci_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `library_catalogue_categories`
--

CREATE TABLE IF NOT EXISTS `library_catalogue_categories` (
  `lcc_id` int(3) NOT NULL AUTO_INCREMENT,
  `lcc_title` varchar(200) CHARACTER SET latin1 NOT NULL,
  `lcc_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `lcc_data_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`lcc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `library_catalogue_categories`
--

INSERT INTO `library_catalogue_categories` (`lcc_id`, `lcc_title`, `lcc_enabled`, `lcc_data_added`) VALUES
(1, 'Books', 1, '2016-04-04 12:24:13'),
(6, 'Journals', 1, '2016-04-15 22:40:08'),
(7, 'Newspapers', 1, '2016-04-15 22:40:08'),
(8, 'Magazines', 1, '2016-04-15 22:40:25');

-- --------------------------------------------------------

--
-- Table structure for table `library_catalogue_format`
--

CREATE TABLE IF NOT EXISTS `library_catalogue_format` (
  `lcf_id` int(3) NOT NULL AUTO_INCREMENT,
  `lcf_title` varchar(200) CHARACTER SET latin1 NOT NULL,
  `lcf_snapshot` varchar(50) CHARACTER SET latin1 NOT NULL,
  `lcf_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `lcf_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`lcf_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `library_catalogue_format`
--

INSERT INTO `library_catalogue_format` (`lcf_id`, `lcf_title`, `lcf_snapshot`, `lcf_enabled`, `lcf_date_created`) VALUES
(1, 'PDF', '', 1, '2016-04-15 16:06:45'),
(2, 'MP3', '', 1, '2016-04-15 16:06:45'),
(3, 'Video', '', 1, '2016-04-15 16:07:03'),
(4, 'Physical Doc', '', 1, '2016-04-15 16:07:03'),
(5, 'Microsoft Doc', '', 1, '2016-04-15 16:07:13');

-- --------------------------------------------------------

--
-- Table structure for table `library_catalog_item`
--

CREATE TABLE IF NOT EXISTS `library_catalog_item` (
  `lci_id` int(15) NOT NULL AUTO_INCREMENT,
  `lci_title` varchar(200) NOT NULL,
  `lci_date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lci_library_id` int(4) NOT NULL,
  `lci_publisher` varchar(50) NOT NULL,
  `lci_year_published` int(6) NOT NULL,
  `lci_date_acquired` varchar(10) NOT NULL,
  `lci_subject_id` int(11) NOT NULL,
  `lci_note` text NOT NULL,
  `lci_is__active` tinyint(1) NOT NULL DEFAULT '1',
  `lci_description` text NOT NULL,
  `lci_author` varchar(60) NOT NULL,
  `lci_qty_remaining` tinyint(5) NOT NULL,
  `lci_snapshot` varchar(200) NOT NULL,
  `lci_callnumber` varchar(200) NOT NULL,
  `lci_category` tinyint(3) NOT NULL,
  `lci_downloadable` tinyint(1) NOT NULL DEFAULT '0',
  `lci_download_link` varchar(250) NOT NULL,
  `lci_qty_acquired` int(3) NOT NULL,
  `lci_isbn` varchar(30) NOT NULL,
  `lci_format` tinyint(3) NOT NULL,
  `lci_preliminary_page_no` varchar(10) NOT NULL,
  `lci_page_past_no` varchar(10) NOT NULL,
  `lci_place_of_publish` varchar(200) NOT NULL,
  `lci_edition` varchar(50) NOT NULL,
  `lci_accession` varchar(100) NOT NULL,
  `lci_source` varchar(100) NOT NULL,
  `lci_cost` varchar(100) NOT NULL,
  PRIMARY KEY (`lci_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `library_catalog_item_authors`
--

CREATE TABLE IF NOT EXISTS `library_catalog_item_authors` (
  `lcia_title` varchar(50) NOT NULL,
  `lcia_date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lcia_catalog_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `library_catalog_item_source`
--

CREATE TABLE IF NOT EXISTS `library_catalog_item_source` (
  `lcis_id` int(3) NOT NULL AUTO_INCREMENT,
  `lcis_title` varchar(250) NOT NULL,
  `lcis_description` text NOT NULL,
  `lcis_date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lcis_type` int(3) NOT NULL,
  `lcis_is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`lcis_id`),
  UNIQUE KEY `lcis_title` (`lcis_title`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `library_catalog_item_source`
--

INSERT INTO `library_catalog_item_source` (`lcis_id`, `lcis_title`, `lcis_description`, `lcis_date_added`, `lcis_type`, `lcis_is_active`) VALUES
(1, 'Purchased', '', '2016-04-04 12:24:33', 0, 1),
(2, 'Federal Govt. Given', '', '2016-04-04 06:48:51', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `library_catalog_item_subject`
--

CREATE TABLE IF NOT EXISTS `library_catalog_item_subject` (
  `lcis_id` int(3) NOT NULL AUTO_INCREMENT,
  `lcis_title` varchar(250) NOT NULL,
  `lcis_description` text NOT NULL,
  `lcis_date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lcis_type` int(3) NOT NULL,
  `lcis_is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`lcis_id`),
  UNIQUE KEY `lcis_title` (`lcis_title`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `library_catalog_item_subjects`
--

CREATE TABLE IF NOT EXISTS `library_catalog_item_subjects` (
  `lcis_title` varchar(100) NOT NULL,
  `lcis_date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lcis_catalog_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `library_external_libraries`
--

CREATE TABLE IF NOT EXISTS `library_external_libraries` (
  `lel_id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `lel_title` varchar(200) NOT NULL,
  `lel_searc_page` varchar(200) NOT NULL,
  `lel_enabled` tinyint(1) DEFAULT '1',
  `lel_homepage` varchar(200) NOT NULL,
  `lel_description` text NOT NULL,
  `lel_date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`lel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `library_external_libraries`
--

INSERT INTO `library_external_libraries` (`lel_id`, `lel_title`, `lel_searc_page`, `lel_enabled`, `lel_homepage`, `lel_description`, `lel_date_added`) VALUES
(1, 'NUC VIRTUAL LIBRARY', 'http://www.nigerianvirtualibrary.com', 1, 'http://www.nigerianvirtualibrary.com', 'NUC VIRTUAL LIBRARY', '2015-08-10 23:21:09'),
(8, 'Google Scholars', 'https://scholar.google.com/scholar?hl=en&q=', 1, 'https://scholar.google.com/', 'Google Scholars', '2015-08-10 23:40:21'),
(11, 'MIT OPEN COURSEWARE', 'http://ocw.mit.edu/?q=', 1, 'http://ocw.mit.edu/', 'MIT OPEN COURSEWARE', '2015-08-10 23:57:20'),
(12, 'EBSCO', 'http://search.ebscohost.com/?q=', 1, 'http://search.epnet.com', 'EBSCO', '2015-08-13 22:33:33'),
(13, 'JSTOR', 'http://www.jstor.org/?q=', 1, 'http://www.jstor.org', 'JSTOR', '2015-08-13 22:34:38'),
(14, 'HINARI', 'http://www.oaresciences.org/?q=', 1, 'http://www.oaresciences.org', 'HINARI', '2015-08-13 22:35:31'),
(15, 'Science Direct', 'http://www.sciencedirect.com/?=', 1, 'http://www.sciencedirect.com', 'Science Direct', '2015-08-13 22:36:09'),
(17, 'Electronic Thesis/Dissertation ', 'http://www.thesis.patent-invent.com/?q=', 1, 'http://www.thesis.patent-invent.com/', 'Electronic Thesis/Dissertation ', '2015-08-13 22:38:10'),
(18, 'SAGE', 'http://online.sagepub.com//?=', 1, 'http://online.sagepub.com/', 'SAGE', '2015-08-13 22:38:52'),
(19, 'Ebrary', 'http://covenant.bravecontent.com/?q=', 1, 'http://covenant.bravecontent.com/', 'Ebrary', '2015-08-13 22:39:47'),
(20, 'Myilibrary', 'http://www.myilibrary.com/?q=', 1, 'http://www.myilibrary.com/', 'Myilibrary', '2015-08-13 22:40:23'),
(21, 'Scopus', 'http://www.scopus.com/?=', 1, 'http://www.myilibrary.com/', 'Scopus', '2015-08-13 22:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `library_libraries`
--

CREATE TABLE IF NOT EXISTS `library_libraries` (
  `ll_id` int(5) NOT NULL AUTO_INCREMENT,
  `ll_title` varchar(200) NOT NULL,
  `ll_description` text NOT NULL,
  `ll_location` varchar(200) NOT NULL,
  `ll_is_active` tinyint(1) NOT NULL DEFAULT '1',
  `ll_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ll_type` tinyint(2) NOT NULL,
  PRIMARY KEY (`ll_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `library_libraries`
--

INSERT INTO `library_libraries` (`ll_id`, `ll_title`, `ll_description`, `ll_location`, `ll_is_active`, `ll_date_created`, `ll_type`) VALUES
(1, 'Main Library', 'Main School Library', 'University Library AUI', 1, '2015-12-02 12:12:22', 2);

-- --------------------------------------------------------

--
-- Table structure for table `library_news_events`
--

CREATE TABLE IF NOT EXISTS `library_news_events` (
  `lne_id` int(11) NOT NULL AUTO_INCREMENT,
  `lne_subject` varchar(250) DEFAULT NULL,
  `lne_type` tinyint(1) NOT NULL DEFAULT '1',
  `lne_content` text,
  `lne_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lne_show` tinyint(1) NOT NULL DEFAULT '0',
  `lne_user` varchar(100) NOT NULL,
  PRIMARY KEY (`lne_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `library_offenders`
--

CREATE TABLE IF NOT EXISTS `library_offenders` (
  `lo_id` int(12) NOT NULL AUTO_INCREMENT,
  `lo_offence_id` tinyint(5) NOT NULL,
  `lo_date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lo_user_id` varchar(250) NOT NULL,
  `lo_note` text NOT NULL,
  `lo_user_type` tinyint(1) NOT NULL,
  `lo_offence_cleared` tinyint(4) NOT NULL DEFAULT '0',
  `lo_cleared_by` int(11) NOT NULL COMMENT 'staff the cleared the issue if any',
  `lo_date_commited` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`lo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `library_offense_fine_types`
--

CREATE TABLE IF NOT EXISTS `library_offense_fine_types` (
  `loft_id` int(5) NOT NULL AUTO_INCREMENT,
  `loft_title` varchar(250) NOT NULL,
  `loft_description` text NOT NULL,
  `loft_fee` varchar(500) NOT NULL,
  `loft_is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`loft_id`),
  UNIQUE KEY `loft_title` (`loft_title`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `library_offense_fine_types`
--

INSERT INTO `library_offense_fine_types` (`loft_id`, `loft_title`, `loft_description`, `loft_fee`, `loft_is_active`) VALUES
(1, 'Delayed Return', 'Amount to be paid for violation', '2000', 1),
(2, 'Item Damaged', 'Item Damaged', '2000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `library_recomended_resources`
--

CREATE TABLE IF NOT EXISTS `library_recomended_resources` (
  `lrr_id` int(11) NOT NULL AUTO_INCREMENT,
  `lrr_title` varchar(200) NOT NULL,
  `lrr_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lrr_recomended_by` varchar(250) NOT NULL,
  `lrr_attended_to_by` varchar(250) NOT NULL,
  `lrr_date_attended_to` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lrr_admin_note` text NOT NULL,
  `lrr_recomender_note` text NOT NULL,
  `lrr_status` tinyint(1) NOT NULL DEFAULT '1',
  `lrr_isbn` varchar(100) NOT NULL,
  `lrr_author` varchar(250) NOT NULL,
  `lrr_release_year` varchar(10) NOT NULL,
  PRIMARY KEY (`lrr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `library_system_config`
--

CREATE TABLE IF NOT EXISTS `library_system_config` (
  `lsc_key` varchar(50) NOT NULL,
  `lsc_value` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `library_system_config`
--

INSERT INTO `library_system_config` (`lsc_key`, `lsc_value`) VALUES
('system.title', 'Modern elibrary'),
('system.address', 'No Address\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `library_users`
--

CREATE TABLE IF NOT EXISTS `library_users` (
  `lu_id` int(11) NOT NULL AUTO_INCREMENT,
  `lu_full_name` varchar(200) NOT NULL,
  `lu_email` varchar(50) NOT NULL,
  `lu_pwd` varchar(50) NOT NULL,
  `lu_acc_type` tinyint(1) NOT NULL DEFAULT '1',
  `lu_acc_status` tinyint(1) NOT NULL DEFAULT '1',
  `lu_reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lu_phn` varchar(20) NOT NULL,
  `passport` varchar(200) NOT NULL,
  PRIMARY KEY (`lu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `library_users`
--

INSERT INTO `library_users` (`lu_id`, `lu_full_name`, `lu_email`, `lu_pwd`, `lu_acc_type`, `lu_acc_status`, `lu_reg_date`, `lu_phn`, `passport`) VALUES
(1, 'Admin User', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 3, 1, '2016-04-19 23:00:00', '23500000000', 'passport.png');

-- --------------------------------------------------------

--
-- Table structure for table `library_user_favourite_list`
--

CREATE TABLE IF NOT EXISTS `library_user_favourite_list` (
  `lufl_id` int(22) NOT NULL AUTO_INCREMENT,
  `lufl_title` varchar(200) NOT NULL,
  `lufl_user_id` varchar(250) NOT NULL,
  `lufl_user_type` tinyint(1) NOT NULL,
  `lufl_date_added` datetime DEFAULT NULL,
  `lufl_hidden` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lufl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `library_user_favourite_list_items`
--

CREATE TABLE IF NOT EXISTS `library_user_favourite_list_items` (
  `lufli_id` int(11) NOT NULL AUTO_INCREMENT,
  `lufli_item` int(11) NOT NULL,
  `lufli_bag_id` int(11) NOT NULL,
  `lufli_is_deleted` tinyint(1) NOT NULL,
  `lufli_user_id` varchar(250) NOT NULL,
  `lufli_date_added` datetime NOT NULL,
  PRIMARY KEY (`lufli_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `library_user_message`
--

CREATE TABLE IF NOT EXISTS `library_user_message` (
  `lur_id` int(11) NOT NULL AUTO_INCREMENT,
  `lur_sender_id` varchar(250) NOT NULL,
  `lur_reciever_id` varchar(250) NOT NULL,
  `lur_msg` text NOT NULL,
  `lur_reciever_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `lur_sender_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `lur_date_sent` timestamp NULL DEFAULT NULL,
  `lur_msg_read` tinyint(1) NOT NULL DEFAULT '0',
  `lur_msg_subject` varchar(255) NOT NULL,
  `lur_msg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lur_has_attachement` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lur_id`),
  KEY `lur_id` (`lur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `library_user_saved_search`
--

CREATE TABLE IF NOT EXISTS `library_user_saved_search` (
  `luss_id` int(11) NOT NULL AUTO_INCREMENT,
  `luss_query` varchar(200) NOT NULL,
  `luss_date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `luss_user` int(11) NOT NULL,
  `luss_search_type` varchar(20) NOT NULL,
  `luss_link` text NOT NULL,
  `luss_last_search` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `luss_no_of_visits` int(5) NOT NULL,
  `luss_seachable_link` int(200) NOT NULL,
  `luss_keyword` varchar(200) NOT NULL,
  PRIMARY KEY (`luss_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `library_user_upload`
--

CREATE TABLE IF NOT EXISTS `library_user_upload` (
  `luu_id` int(11) NOT NULL AUTO_INCREMENT,
  `luu_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `luu_location` varchar(200) NOT NULL,
  `luu_mime` varchar(20) NOT NULL,
  `luu_user_id` varchar(250) NOT NULL,
  `luu_title` varchar(200) NOT NULL,
  `luu_description` text NOT NULL,
  `luu_is_hidden` tinyint(1) NOT NULL DEFAULT '0',
  `luu_size` int(5) NOT NULL,
  `luu_ext` varchar(10) NOT NULL,
  PRIMARY KEY (`luu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
