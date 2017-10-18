-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2016 at 07:45 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `absen`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_menu`
--

CREATE TABLE IF NOT EXISTS `m_menu` (
  `m_menu_id` int(1) unsigned NOT NULL,
  `m_menu_name` text NOT NULL,
  `m_menu_uri` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_menu`
--

INSERT INTO `m_menu` (`m_menu_id`, `m_menu_name`, `m_menu_uri`) VALUES
(1, 'SCAN', 'scan'),
(2, 'CHECK', 'check'),
(3, 'CHECK ALL', 'check_all'),
(3, 'MASTER PARENTS', 'master/parents'),
(3, 'MASTER STUDENTS', 'master/students'),
(3, 'MASTER TEACHERS', 'master/teacher'),
(3, 'MASTER SECURITY', 'master/security');

-- --------------------------------------------------------

--
-- Table structure for table `m_parents`
--

CREATE TABLE IF NOT EXISTS `m_parents` (
  `m_parents_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `m_parents_name` text NOT NULL,
  `m_parents_username` text NOT NULL,
  `m_parents_password` text NOT NULL,
  PRIMARY KEY (`m_parents_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `m_parents`
--

INSERT INTO `m_parents` (`m_parents_id`, `m_parents_name`, `m_parents_username`, `m_parents_password`) VALUES
(1, 'Tom Cruise', 'tom', '250cf8b51c773f3f8dc8b4be867a9a02'),
(7, 'fgdf', 'dfgdf', 'c4ca4238a0b923820dcc509a6f75849b');

-- --------------------------------------------------------

--
-- Table structure for table `m_security`
--

CREATE TABLE IF NOT EXISTS `m_security` (
  `m_security_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `m_security_name` text NOT NULL,
  `m_security_username` text NOT NULL,
  `m_security_password` text NOT NULL,
  PRIMARY KEY (`m_security_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `m_security`
--

INSERT INTO `m_security` (`m_security_id`, `m_security_name`, `m_security_username`, `m_security_password`) VALUES
(1, 'Jet Li', 'jetli', '202cb962ac59075b964b07152d234b70'),
(2, 'sd', 'sd', '6226f7cbe59e99a90b5cef6f94f966fd');

-- --------------------------------------------------------

--
-- Table structure for table `m_students`
--

CREATE TABLE IF NOT EXISTS `m_students` (
  `m_students_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `m_students_name` text NOT NULL,
  `m_students_parents` int(1) unsigned NOT NULL,
  PRIMARY KEY (`m_students_id`),
  KEY `m_students_parents` (`m_students_parents`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `m_students`
--

INSERT INTO `m_students` (`m_students_id`, `m_students_name`, `m_students_parents`) VALUES
(1, 'Brian', 1),
(2, 'asa', 1),
(5, 'Hdhdyd', 7),
(6, 'asd', 1),
(7, 'asd', 1),
(8, 'asd', 1),
(9, 'asd', 1),
(10, 'asd', 1),
(11, 'asd', 1),
(12, 'asd', 1),
(13, 'asd', 1),
(14, 'asd', 1),
(15, 'asd', 1),
(16, 'asd', 1),
(17, 'asd', 1),
(18, 'asd', 1),
(19, 'asd', 1),
(20, 'asd', 1),
(21, 'asd', 1),
(22, 'asd', 1),
(23, 'asd', 1),
(24, 'asd', 1),
(25, 'asd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_teacher`
--

CREATE TABLE IF NOT EXISTS `m_teacher` (
  `m_teacher_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `m_teacher_name` text NOT NULL,
  `m_teacher_username` text NOT NULL,
  `m_teacher_password` text NOT NULL,
  PRIMARY KEY (`m_teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `m_teacher`
--

INSERT INTO `m_teacher` (`m_teacher_id`, `m_teacher_name`, `m_teacher_username`, `m_teacher_password`) VALUES
(1, 'Prof. Snape', 'snape', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `s_ci_sessions`
--

CREATE TABLE IF NOT EXISTS `s_ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  `create_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`session_id`,`ip_address`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `s_ci_sessions`
--

INSERT INTO `s_ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`, `create_datetime`) VALUES
('0d2eee55939a4b99a86ba9fa1c4ce6d5', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477649006, 'a:6:{s:9:"user_data";s:0:"";s:6:"procid";s:2:"16";s:4:"proc";s:7:"Heading";s:3:"nik";s:3:"300";s:4:"name";s:11:"AMIN DARMIN";s:4:"auth";s:1:"1";}', '2016-10-28 10:03:26'),
('193e8c3dcc17b5b1013f073ac9f245be', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143', 1478747762, 'a:4:{s:9:"user_data";s:0:"";s:2:"id";s:1:"1";s:4:"name";s:11:"Prof. Snape";s:5:"level";s:1:"3";}', '2016-11-10 03:16:02'),
('2c323f3118fbb117326ca192e0f63339', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477644373, '', '2016-10-28 08:46:13'),
('35b5e721e5465cf1b5bee30cd85e9e28', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1478705769, '', '2016-11-09 15:36:09'),
('44ab2dc2534426f894074a8a1921be6a', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477644987, 'a:6:{s:9:"user_data";s:0:"";s:6:"procid";s:2:"16";s:4:"proc";s:7:"Heading";s:3:"nik";s:3:"300";s:4:"name";s:11:"AMIN DARMIN";s:4:"auth";s:1:"1";}', '2016-10-28 08:56:27'),
('44ca2a77d2789a489e09b23cc69247d6', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477645034, 'a:6:{s:9:"user_data";s:0:"";s:6:"procid";s:2:"16";s:4:"proc";s:7:"Heading";s:3:"nik";s:3:"300";s:4:"name";s:11:"AMIN DARMIN";s:4:"auth";s:1:"1";}', '2016-10-28 08:57:14'),
('47f3b3f2ee2c0b91fb8f5adb6e2484c2', '192.168.4.177', 'gvfs/1.28.2', 1477644962, '', '2016-10-28 08:56:02'),
('4926aa19e9618c4532d0a05e3dd42d16', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143', 1478664659, '', '2016-11-09 04:10:59'),
('4d90996dbbdbef9082fa9d89c5f567b7', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1478682109, '', '2016-11-09 09:01:49'),
('4db3076eba45a3c77181609c438eb53f', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143', 1478661710, 'a:4:{s:9:"user_data";s:0:"";s:2:"id";s:1:"1";s:4:"nama";s:13:"Agus Setiawan";s:5:"level";s:1:"1";}', '2016-11-09 03:21:50'),
('5adda62a7dd20213f3aeb923ab33f6e1', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143', 1478759833, 'a:5:{s:9:"user_data";s:0:"";s:2:"id";s:1:"1";s:4:"name";s:10:"Tom Cruise";s:5:"level";s:1:"2";s:5:"table";s:9:"m_parents";}', '2016-11-10 06:37:29'),
('61546eaae9f4b6ec5251e2acec44515c', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477647836, 'a:4:{s:9:"user_data";s:0:"";s:2:"id";s:1:"1";s:4:"nama";s:13:"Agus Setiawan";s:5:"level";s:1:"1";}', '2016-10-28 09:45:06'),
('66fdb58c14805306784cb10ec6df0994', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143', 1478680178, 'a:4:{s:9:"user_data";s:0:"";s:2:"id";s:1:"1";s:4:"name";s:11:"Prof. Snape";s:5:"level";s:1:"3";}', '2016-11-09 08:29:47'),
('690c97f6867a5cf38f6bafd831f9f642', '192.168.4.177', 'gvfs/1.28.2', 1477879677, '', '2016-10-31 02:07:57'),
('7246fa78a46e2d4e630035cf077d4c37', '192.168.4.22', 'Mozilla/5.0 (Linux; Android 5.0; ASUS_Z008D Build/LRX21V) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.124 Mo', 1478687845, 'a:4:{s:9:"user_data";s:0:"";s:2:"id";s:1:"1";s:4:"name";s:11:"Prof. Snape";s:5:"level";s:1:"3";}', '2016-11-09 10:37:25'),
('73a35733670faf09d69b2beac6cdec78', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1478740372, '', '2016-11-10 01:12:52'),
('73d47e9331acbc9a91fa4e49eb3ed70b', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1478600931, '', '2016-11-08 10:28:51'),
('79440127ae5b1c2ccc90fe712910c608', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143', 1478705796, 'a:4:{s:9:"user_data";s:0:"";s:2:"id";s:1:"1";s:4:"name";s:11:"Prof. Snape";s:5:"level";s:1:"3";}', '2016-11-09 15:36:36'),
('84153aacf3fce48ea4c6f14cc2eea7ca', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477644988, 'a:6:{s:9:"user_data";s:0:"";s:6:"procid";s:2:"16";s:4:"proc";s:7:"Heading";s:3:"nik";s:3:"300";s:4:"name";s:11:"AMIN DARMIN";s:4:"auth";s:1:"1";}', '2016-10-28 08:56:28'),
('87a46cd891959446957b51a3eaa32162', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477644987, 'a:6:{s:9:"user_data";s:0:"";s:6:"procid";s:2:"16";s:4:"proc";s:7:"Heading";s:3:"nik";s:3:"300";s:4:"name";s:11:"AMIN DARMIN";s:4:"auth";s:1:"1";}', '2016-10-28 08:56:27'),
('891243629d204312033643bc93fba6d8', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477649440, 'a:6:{s:9:"user_data";s:0:"";s:6:"procid";s:2:"16";s:4:"proc";s:7:"Heading";s:3:"nik";s:3:"300";s:4:"name";s:11:"AMIN DARMIN";s:4:"auth";s:1:"1";}', '2016-10-28 10:10:45'),
('91af977963df723471cbe051f8f61fa1', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477643356, '', '2016-10-28 08:29:16'),
('921c7ec8b3d0ea3962f9c660f440d930', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477645092, 'a:6:{s:9:"user_data";s:0:"";s:6:"procid";s:2:"16";s:4:"proc";s:7:"Heading";s:3:"nik";s:3:"300";s:4:"name";s:11:"AMIN DARMIN";s:4:"auth";s:1:"1";}', '2016-10-28 08:58:33'),
('9287fc1f15ce1c3a480f02ea0de2eaaa', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477649024, '', '2016-10-28 10:03:44'),
('937c671d9fbd9e582da448bbeb08e478', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477644988, 'a:6:{s:9:"user_data";s:0:"";s:6:"procid";s:2:"16";s:4:"proc";s:7:"Heading";s:3:"nik";s:3:"300";s:4:"name";s:11:"AMIN DARMIN";s:4:"auth";s:1:"1";}', '2016-10-28 08:56:28'),
('9a5f0c3a173fe9f2ba9ac7517ccba976', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143', 1478679902, 'a:4:{s:9:"user_data";s:0:"";s:2:"id";s:1:"1";s:4:"name";s:11:"Prof. Snape";s:5:"level";s:1:"3";}', '2016-11-09 08:25:02'),
('a595ebc12ef5960a898b56751d84a6e8', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477644988, 'a:6:{s:9:"user_data";s:0:"";s:6:"procid";s:2:"16";s:4:"proc";s:7:"Heading";s:3:"nik";s:3:"300";s:4:"name";s:11:"AMIN DARMIN";s:4:"auth";s:1:"1";}', '2016-10-28 08:56:28'),
('a5961191ef0544742c86a9111c09434b', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477644988, 'a:6:{s:9:"user_data";s:0:"";s:6:"procid";s:2:"16";s:4:"proc";s:7:"Heading";s:3:"nik";s:3:"300";s:4:"name";s:11:"AMIN DARMIN";s:4:"auth";s:1:"1";}', '2016-10-28 08:56:28'),
('a8f785aaa949ec66971403892b111bb8', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477644986, 'a:6:{s:9:"user_data";s:0:"";s:6:"procid";s:2:"16";s:4:"proc";s:7:"Heading";s:3:"nik";s:3:"300";s:4:"name";s:11:"AMIN DARMIN";s:4:"auth";s:1:"1";}', '2016-10-28 08:56:26'),
('b312de7785cdcb47750556cc282c6dc1', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143', 1478688888, 'a:4:{s:9:"user_data";s:0:"";s:2:"id";s:1:"1";s:4:"name";s:11:"Prof. Snape";s:5:"level";s:1:"3";}', '2016-11-09 10:54:48'),
('b4855656e75d1addd60299d3686316c1', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477880302, 'a:4:{s:9:"user_data";s:0:"";s:2:"id";s:1:"1";s:4:"nama";s:13:"Agus Setiawan";s:5:"level";s:1:"1";}', '2016-10-31 02:18:22'),
('b820318a9d5e38dc14e9b69d494d121a', '192.168.4.22', 'Mozilla/5.0 (Linux; Android 5.0; ASUS_Z008D Build/LRX21V) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.124 Mo', 1478758625, 'a:5:{s:9:"user_data";s:0:"";s:2:"id";s:1:"7";s:4:"name";s:4:"fgdf";s:5:"level";s:1:"2";s:5:"table";s:9:"m_parents";}', '2016-11-10 06:18:13'),
('bd459512c5573b65ce9adfe7670a7d79', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477644979, 'a:6:{s:9:"user_data";s:0:"";s:6:"procid";s:2:"16";s:4:"proc";s:7:"Heading";s:3:"nik";s:3:"300";s:4:"name";s:11:"AMIN DARMIN";s:4:"auth";s:1:"1";}', '2016-10-28 08:56:19'),
('c1064ae8571d407331808f325e02ce7d', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1478680175, '', '2016-11-09 08:29:35'),
('c6ab5bee1e05128f48709d1f8bf062c7', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477644987, 'a:6:{s:9:"user_data";s:0:"";s:6:"procid";s:2:"16";s:4:"proc";s:7:"Heading";s:3:"nik";s:3:"300";s:4:"name";s:11:"AMIN DARMIN";s:4:"auth";s:1:"1";}', '2016-10-28 08:56:27'),
('c818ffc9dc192645146369a870bb80ef', '192.168.0.161', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1478234069, 'a:4:{s:9:"user_data";s:0:"";s:2:"id";s:1:"1";s:4:"nama";s:13:"Agus Setiawan";s:5:"level";s:1:"1";}', '2016-11-04 04:34:39'),
('d125ff916a717a0cb7fa073d9b33fcb9', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477644987, 'a:6:{s:9:"user_data";s:0:"";s:6:"procid";s:2:"16";s:4:"proc";s:7:"Heading";s:3:"nik";s:3:"300";s:4:"name";s:11:"AMIN DARMIN";s:4:"auth";s:1:"1";}', '2016-10-28 08:56:27'),
('d48b28b87ac0a21266198c755be922c2', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1478223436, 'a:4:{s:9:"user_data";s:0:"";s:2:"id";s:1:"1";s:4:"nama";s:13:"Agus Setiawan";s:5:"level";s:1:"1";}', '2016-11-04 01:37:16'),
('d50328847225ab3c7ef0b79ea28cc15c', '192.168.4.177', 'gvfs/1.28.2', 1477650041, '', '2016-10-28 10:20:41'),
('dbb4f73654c8a9f08475b3326056016f', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1478685686, '', '2016-11-09 10:01:26'),
('df3a817d089c0ea90fc0ad839eaf9ecf', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477650135, '', '2016-10-28 10:22:15'),
('ea40cdb2f24d97f214da42997be2f018', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477644988, 'a:6:{s:9:"user_data";s:0:"";s:6:"procid";s:2:"16";s:4:"proc";s:7:"Heading";s:3:"nik";s:3:"300";s:4:"name";s:11:"AMIN DARMIN";s:4:"auth";s:1:"1";}', '2016-10-28 08:56:29'),
('eb507169f3a0abb105f88fd8f1709bf7', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477644987, 'a:6:{s:9:"user_data";s:0:"";s:6:"procid";s:2:"16";s:4:"proc";s:7:"Heading";s:3:"nik";s:3:"300";s:4:"name";s:11:"AMIN DARMIN";s:4:"auth";s:1:"1";}', '2016-10-28 08:56:27'),
('eedf8a78bcfb899e1166e4803f1ee930', '192.168.4.177', 'Mozilla/5.0 (X11; Ubuntu; Linux armv7l; rv:49.0) Gecko/20100101 Firefox/49.0', 1477644988, 'a:6:{s:9:"user_data";s:0:"";s:6:"procid";s:2:"16";s:4:"proc";s:7:"Heading";s:3:"nik";s:3:"300";s:4:"name";s:11:"AMIN DARMIN";s:4:"auth";s:1:"1";}', '2016-10-28 08:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `t_leave`
--

CREATE TABLE IF NOT EXISTS `t_leave` (
  `t_leave_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `t_leave_student` int(1) unsigned NOT NULL,
  `t_leave_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`t_leave_id`),
  KEY `t_absen_student` (`t_leave_student`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `t_leave`
--

INSERT INTO `t_leave` (`t_leave_id`, `t_leave_student`, `t_leave_time`) VALUES
(1, 1, '2016-11-09 01:32:56'),
(2, 1, '2016-11-10 04:28:55');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_students`
--
ALTER TABLE `m_students`
  ADD CONSTRAINT `m_students_ibfk_1` FOREIGN KEY (`m_students_parents`) REFERENCES `m_parents` (`m_parents_id`);

--
-- Constraints for table `t_leave`
--
ALTER TABLE `t_leave`
  ADD CONSTRAINT `t_leave_ibfk_1` FOREIGN KEY (`t_leave_student`) REFERENCES `m_students` (`m_students_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
