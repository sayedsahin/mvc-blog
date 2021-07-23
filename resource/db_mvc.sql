-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 09, 2019 at 10:44 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `ctitle` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `cname`, `ctitle`) VALUES
(1, 'Sports', 'Sports'),
(2, 'Regional', 'Regional'),
(3, 'Country', 'Country'),
(4, 'World', 'World'),
(5, 'Technology', 'Technology'),
(6, 'Education', 'Education'),
(7, 'Health Male', 'Health Female'),
(8, 'Coding', 'Coding'),
(9, 'Science', 'Science');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `comid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `body` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_update` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comid`, `uid`, `pid`, `body`, `date`, `date_update`, `status`) VALUES
(1, 1, 1, 'Comment', '2019-09-23 15:21:59', NULL, 0),
(2, 2, 1, 'Comment user 2 post 1', '2019-09-23 15:27:41', NULL, 0),
(3, 1, 2, 'Comment user 1 post 2', '2019-09-23 15:27:41', NULL, 0),
(5, 1, 1, 'Hello World ! This is Comment 2', '2019-09-24 03:14:45', NULL, 0),
(6, 1, 28, 'Bangladesh is a beautiful', '2019-09-24 03:16:59', NULL, 0),
(7, 3, 1, 'Alhamdulillah', '2019-09-24 03:19:33', NULL, 0),
(8, 3, 1, 'How are you friends', '2019-09-24 03:27:23', NULL, 0),
(9, 16, 28, 'National Flag Bangladesh National Flag', '2019-09-24 03:29:46', NULL, 0),
(10, 16, 1, 'The PHP team is glad to announce', '2019-09-24 03:32:51', NULL, 0),
(11, 16, 1, 'The PHP team is glad to announce', '2019-09-24 03:44:46', NULL, 0),
(12, 16, 1, 'The PHP team is glad to announce the third and last beta release of PHP 7.4: PHP 7.4.0beta4. This continues the PHP 7.4 release cycle, the rough outline of which is specified in the PHP Wiki. For source downloads of PHP 7.4.0beta4 please visit the download page. Please carefully test this version and report any issues found in the bug reporting system.', '2019-09-24 03:48:14', NULL, 0),
(13, 1, 39, 'This is dummy comment', '2019-09-25 11:06:51', NULL, 0),
(14, 0, 1, 'Sayed Sahin Without Login', '2019-09-26 05:00:35', NULL, 0),
(15, 1, 1, 'Login After Comment', '2019-09-26 05:05:28', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_update` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `cid`, `uid`, `image`, `date_create`, `date_update`) VALUES
(1, '1 The PHP development team announces the immediate availability of PHP 7.1.32. This is a security release.', '&lt;p&gt;The PHP team is glad to announce the third and last beta release of PHP 7.4: PHP 7.4.0beta4. This continues the PHP 7.4 release cycle, the rough outline of which is specified in the PHP Wiki. For source downloads of PHP 7.4.0beta4 please visit the download page. Please carefully test this version and report any issues found in the bug reporting system.&lt;/p&gt;&lt;p&gt;Please DO NOT use this version in production, it is an early test version.For more information on the new features and other changes, you can read the NEWS file, or the UPGRADING file for a complete list of upgrading notes. These files can also be found in the release archive.&lt;/p&gt;&lt;p&gt;The next release would be RC 1, planned for September 5th. The signatures for the release can be found in the manifest or on the QA site. Thank you for helping us make PHP better.&lt;/p&gt;', 7, 2, '', '2019-09-18 08:02:29', '2019-09-24 00:12:22'),
(2, '2 The PHP development team announces the immediate availability of PHP 7.1.32. This is a security release.', '&lt;p&gt;The PHP team is glad to announce the third and last beta release of PHP 7.4: PHP 7.4.0beta4. This continues the PHP 7.4 release cycle, the rough outline of which is specified in the PHP Wiki. For source downloads of PHP 7.4.0beta4 please visit the download page. Please carefully test this version and report any issues found in the bug reporting system.&lt;/p&gt;&lt;p&gt;Please DO NOT use this version in production, it is an early test version.For more information on the new features and other changes, you can read the NEWS file, or the UPGRADING file for a complete list of upgrading notes. These files can also be found in the release archive.&lt;/p&gt;&lt;p&gt;The next release would be RC 1, planned for September 5th. The signatures for the release can be found in the manifest or on the QA site. Thank you for helping us make PHP better.&lt;/p&gt;', 2, 4, '', '2019-09-18 08:02:29', '2019-09-24 00:12:31'),
(3, '3 The PHP development team announces the immediate availability of PHP 7.1.32. This is a security release.', '&lt;p&gt;The PHP team is glad to announce the third and last beta release of PHP 7.4: PHP 7.4.0beta4. This continues the PHP 7.4 release cycle, the rough outline of which is specified in the PHP Wiki. For source downloads of PHP 7.4.0beta4 please visit the download page. Please carefully test this version and report any issues found in the bug reporting system.&lt;/p&gt;&lt;p&gt;Please DO NOT use this version in production, it is an early test version.For more information on the new features and other changes, you can read the NEWS file, or the UPGRADING file for a complete list of upgrading notes. These files can also be found in the release archive.&lt;/p&gt;&lt;p&gt;The next release would be RC 1, planned for September 5th. The signatures for the release can be found in the manifest or on the QA site. Thank you for helping us make PHP better.&lt;/p&gt;', 3, 1, '', '2019-09-18 08:02:29', '2019-09-24 00:12:38'),
(4, '4 The PHP development team announces the immediate availability of PHP 7.1.32. This is a security release.', '&lt;p&gt;The Python team is glad to announce the third and last beta release of PHP 7.4: PHP 7.4.0beta4. This continues the PHP 7.4 release cycle, the rough outline of which is specified in the PHP Wiki. For source downloads of PHP 7.4.0beta4 please visit the download page. Please carefully test this version and report any issues found in the bug reporting system.&lt;/p&gt;&lt;p&gt;Please DO NOT use this version in production, it is an early test version.For more information on the new features and other changes, you can read the NEWS file, or the UPGRADING file for a complete list of upgrading notes. These files can also be found in the release archive.&lt;/p&gt;&lt;p&gt;The next release would be RC 1, planned for September 5th. The signatures for the release can be found in the manifest or on the QA site. Thank you for helping us make PHP better.&lt;/p&gt;', 4, 1, '', '2019-09-18 08:02:29', '2019-09-24 00:12:46'),
(5, '5 The PHP development team announces the immediate availability of PHP 7.1.32. This is a security release.', '&lt;p&gt;The PHP team is glad to announce the third and last beta release of PHP 7.4: PHP 7.4.0beta4. This continues the PHP 7.4 release cycle, the rough outline of which is specified in the PHP Wiki. For source downloads of PHP 7.4.0beta4 please visit the download page. Please carefully test this version and report any issues found in the bug reporting system.&lt;/p&gt;&lt;p&gt;Please DO NOT use this version in production, it is an early test version.For more information on the new features and other changes, you can read the NEWS file, or the UPGRADING file for a complete list of upgrading notes. These files can also be found in the release archive.&lt;/p&gt;&lt;p&gt;The next release would be RC 1, planned for September 5th. The signatures for the release can be found in the manifest or on the QA site. Thank you for helping us make PHP better.&lt;/p&gt;', 4, 1, '', '2019-09-18 08:02:29', '2019-09-24 00:12:52'),
(6, '6 The PHP development team announces the immediate availability of PHP 7.1.32. This is a security release.', '&lt;p&gt;The PHP team is glad to announce the third and last beta release of PHP 7.4: PHP 7.4.0beta4. This continues the PHP 7.4 release cycle, the rough outline of which is specified in the PHP Wiki. For source downloads of PHP 7.4.0beta4 please visit the download page. Please carefully test this version and report any issues found in the bug reporting system.&lt;/p&gt;&lt;p&gt;Please DO NOT use this version in production, it is an early test version.For more information on the new features and other changes, you can read the NEWS file, or the UPGRADING file for a complete list of upgrading notes. These files can also be found in the release archive.&lt;/p&gt;&lt;p&gt;The next release would be RC 1, planned for September 5th. The signatures for the release can be found in the manifest or on the QA site. Thank you for helping us make PHP better.&lt;/p&gt;', 2, 1, '', '2019-09-18 08:02:29', '2019-09-24 00:12:58'),
(7, '7 And maybe the benefits between one or the other বাংলা', '&lt;p&gt;Once defined, a \'constant\' cannot be changed at run time, whereas an ordinary variable assignment can.&lt;/p&gt;&lt;p&gt;Constants are better for things like configuration directives which should not be changed during execution. Furthermore, code is easier to read (and maintain &amp;amp; handover) if values which are meant to be constant are explicitly made so.&lt;/p&gt;', 6, 1, '', '2019-09-18 08:02:29', '2019-09-24 00:13:03'),
(8, '8 And maybe the benefits between one or the other', '&lt;p&gt;I am currently trying to implement a custom listView for my Fragment, but when i try to add the item to the ListView it doesn\'t show up, and i get no exception or anything.&lt;/p&gt;&lt;p&gt;What i\'m trying to do is to create an object with a name and a number by typing, both of these things work, but it seems like i did a mistake with the listView&lt;/p&gt;&lt;p&gt;Here is the Fragment with the ListView&lt;/p&gt;', 1, 1, '', '2019-09-18 08:02:29', '2019-09-24 00:13:08'),
(13, '9 Post After Validation with PHP পিএইচপি পোস্ট আফটার ভ্যালিডেশন', '&lt;p&gt;à¦†à¦®à¦¿ Test Post After Validation with PHP 12. Post After Validation with PHP12. Post After Validation with PHP12. Post After Validation with PHP12. Post After Validation with PHP12. Post After Validation with PHP12. Post After Validation with PHP12. Post After Validation with PHP12. Post After Validation with PHP12. Post After Validation with PHP12. Post After Validation with PHP12. Post After Validation with PHP12. Post After Validation with PHP12. Post After Validation with PHP12. Post After Validation with PHP&lt;/p&gt;&lt;p&gt;12. Post After Validation with PHP12. Post After Validation with PHP12. Post After Validation with PHP12. Post After Validation with PHP12. Post After Validation with PHP12. Post After Validation with PHP12. Post After Validation with PHP12. Post After Validation with PHP12. Post After Validation with PHP&lt;/p&gt;', 3, 1, '', '2019-09-18 08:02:29', '2019-09-24 00:13:38'),
(15, '10 And maybe the benefits between one or the other বাংলা বাংলা', '&lt;p&gt;The And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;&lt;/p&gt;&lt;p&gt;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;7. And maybe the benefits between one or the other&amp;nbsp;&lt;/p&gt;', 4, 3, '', '2019-09-18 08:02:29', '2019-09-24 00:14:23'),
(21, '11 This is my 1st post.', '&lt;p&gt;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;&lt;/p&gt;&lt;p&gt;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;&lt;/p&gt;&lt;p&gt;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World !&amp;nbsp;Hello World ?? !&amp;nbsp;&lt;/p&gt;', 9, 3, 'img/2019/09/5d8404c2c60a0.png', '2019-09-18 08:02:29', '2019-09-24 00:14:30'),
(23, '12 Bangladesh is a beautiful country', '&lt;p&gt;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;&lt;/p&gt;&lt;p&gt;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;&lt;/p&gt;&lt;p&gt;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;&lt;/p&gt;&lt;p&gt;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;I Love Bangladesh&amp;nbsp;&lt;/p&gt;', 3, 1, 'img/5d8308c2d5856.png', '2019-09-19 04:49:06', '2019-09-24 00:14:37'),
(28, '13 Bangladesh National Flag', '&lt;p&gt;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;&lt;/p&gt;&lt;p&gt;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;&lt;/p&gt;&lt;p&gt;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;Bangladesh National Flag&amp;nbsp;&lt;/p&gt;', 3, 1, 'img/2019/09/5d840ae326b10.jpg', '2019-09-19 22:08:10', '2019-09-24 00:14:42'),
(29, '14 This is dummy post title', '&lt;p&gt;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;&lt;/p&gt;&lt;p&gt;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;&lt;/p&gt;&lt;p&gt;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;14 This is dummy post title&amp;nbsp;&lt;/p&gt;', 1, 1, 'img/2019/09/5d8a491c19b63.jpg', '2019-09-24 16:49:32', NULL),
(30, '15 This is dummy post title ', 'This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title ', 1, 1, '', '2019-09-24 16:53:07', NULL),
(31, '16 This is dummy post title ', 'This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title ', 1, 1, '', '2019-09-24 16:53:07', NULL),
(32, '17 This is dummy post title ', 'This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title ', 1, 1, '', '2019-09-24 16:53:07', NULL),
(33, '18 This is dummy post title ', 'This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title ', 1, 1, '', '2019-09-24 16:53:07', NULL),
(34, '19 This is dummy post title ', 'This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title ', 1, 1, '', '2019-09-24 16:53:07', NULL),
(35, '20 This is dummy post title ', 'This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title ', 1, 1, '', '2019-09-24 16:53:07', NULL),
(36, '21 This is dummy post title ', 'This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title ', 1, 1, '', '2019-09-24 16:53:07', NULL),
(37, '22 This is dummy post title ', 'This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title ', 1, 1, '', '2019-09-24 16:53:07', NULL),
(38, '23 This is dummy post title ', 'This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title ', 1, 1, '', '2019-09-24 16:53:07', NULL),
(39, '24 This is dummy post title', '&lt;p&gt;This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title This is dummy post title&lt;/p&gt;', 1, 1, 'img/2019/09/5d8b4a3ce925f.jpg', '2019-09-24 16:53:07', '2019-09-25 05:06:36');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `username` varchar(30) CHARACTER SET latin1 NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(32) CHARACTER SET latin1 NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `level` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `password`, `image`, `date`, `level`) VALUES
(1, 'Sayed Ahme', 'sayed', 'sayed@gmail.com', '4f90718bc1a7ee98cdedfdabd68ab333', 'img/profile/sayed.png', '2019-09-13 21:12:00', 3),
(2, 'MD Sahin', 'sahin', 'sahin@gmail.com', '399103aa6219f16ad3621554c2dbc8c7', 'img/profile/sahin.jpg', '2019-09-13 21:12:00', 2),
(3, 'Ahmed', 'ahmed', 'ahmed@gmail.com', '32aa2fd87338e241978c48ab319641bc', 'img/profile/ahmed.jpg', '2019-09-13 21:12:00', 1),
(16, 'ashfi', 'ashfi', 'ashfi@gmail.com', 'fbcee0786696ef960ee8b9b6241d577b', '', '2019-09-14 01:54:39', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
