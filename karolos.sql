-- phpMyAdmin SQL Dump
-- version 4.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Sep 27, 2014 at 02:19 PM
-- Server version: 5.6.17-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `karolos`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'ΚΑΤΗΓΟΡΙΑ 1'),
(2, 'ΚΑΤΗΓΟΡΙΑ 2'),
(3, 'ΚΑΤΗΓΟΡΙΑ 3'),
(4, 'ΚΑΤΗΓΟΡΙΑ 4'),
(5, 'ΚΑΤΗΓΟΡΙΑ 5');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`comm_id` int(11) NOT NULL,
  `comm_user_id` int(11) NOT NULL,
  `comm_spot_id` int(11) NOT NULL,
  `comment_text` text COLLATE utf8_unicode_ci NOT NULL,
  `admin_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `comm_created_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comm_id`, `comm_user_id`, `comm_spot_id`, `comment_text`, `admin_email`, `comm_created_at`) VALUES
(1, 2, 39, 'asdasdasd', 'l.g.karolos@gmail.com', '2014-09-18 16:37:55'),
(2, 2, 39, 'asdasdasd', 'l.g.karolos@gmail.com', '2014-09-18 16:37:55'),
(3, 2, 40, '123123123123123123123132', 'l.g.karolos@gmail.com', '2014-09-18 16:41:47'),
(4, 13, 42, 'akakakakakakaaak', 'l.g.karolos@gmail.com', '2014-09-18 16:57:58'),
(5, 2, 41, 'Prwth dokimh pou paei teleia epitelous', 'l.g.karolos@gmail.com', '2014-09-18 18:59:54'),
(6, 2, 43, 're les n petuxei epitelous', 'l.g.karolos@gmail.com', '2014-09-20 20:37:20'),
(7, 2, 44, 'kai omws t katafera meta apo 2 mhnes', 'l.g.karolos@gmail.com', '2014-09-21 20:17:56'),
(8, 0, 46, 'prwth dokimh olwwwwwwwn', 'l.g.karolos@gmail.com', '2014-09-24 21:25:36'),
(9, 0, 45, 'pame 2', 'l.g.karolos@gmail.com', '2014-09-24 21:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
`image_id` int(11) NOT NULL,
  `image_path` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `spot_id` int(11) NOT NULL,
  `image_type` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `image_created_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `spots`
--

CREATE TABLE IF NOT EXISTS `spots` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `latitude` varchar(20) COLLATE utf8_bin NOT NULL,
  `longitude` varchar(20) COLLATE utf8_bin NOT NULL,
  `address` varchar(50) COLLATE utf8_bin NOT NULL,
  `area` varchar(50) COLLATE utf8_bin NOT NULL,
  `title` varchar(50) COLLATE utf8_bin NOT NULL,
  `category` varchar(40) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `solved` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=55 ;

--
-- Dumping data for table `spots`
--

INSERT INTO `spots` (`id`, `user_id`, `latitude`, `longitude`, `address`, `area`, `title`, `category`, `description`, `solved`, `created_at`, `updated_at`) VALUES
(39, 2, '38.24907', '21.73848', 'Αρατου 14', 'Πάτρα', '1η Αναφορά', 'ΚΑΤΗΓΟΡΙΑ 2', 'Εδώ έχουμε την περιγραφή της αναφοράς', 1, '2014-09-09 22:44:49', '2014-10-10 22:44:53'),
(40, 2, '38.24987', '21.73846', 'Ζαίμη 24', 'Πατρα', '2η Αναφορά', 'ΚΑΤΗΓΟΡΙΑ 2', 'εδω γραφουμε οτι να sdasdasaειναι', 1, '2014-09-09 23:01:54', '2014-09-11 23:01:57'),
(41, 2, '38.24937', '21.73927', 'Zaimi 39', 'Patra', 'zaimi 39', 'ΚΑΤΗΓΟΡΙΑ 2', 'patra', 1, '2014-09-12 18:37:19', '2014-09-12 21:37:23'),
(42, 13, '38.25036', '21.73689', 'aratou 56', 'patra', 'patra', 'ΚΑΤΗΓΟΡΙΑ 2', 'sofiabubi', 1, '2014-09-12 23:50:33', '2014-09-13 23:59:34'),
(43, 2, '38.24562', '21.73400', 'Patreos 40', 'Patra', 'Patreos', 'ΚΑΤΗΓΟΡΙΑ 1', 'asdasdasdsada', 1, '2014-09-15 20:58:42', '2014-10-15 20:58:43'),
(44, 2, '38.25334', '21.74432', 'korinthou 56', 'ΠΑΤΡΑ', 'Spiti', 'ΚΑΤΗΓΟΡΙΑ 4', '', 1, '2014-09-20 21:16:57', '2014-09-20 21:16:58'),
(45, 2, '38.25380', '21.73807', 'norman 13', 'patra', 'sdasda', 'ΚΑΤΗΓΟΡΙΑ 3', 'sdasdasdad', 1, '2014-09-20 21:22:06', '2014-09-24 21:26:07'),
(46, 2, '38.23960', '21.72713', 'gounari 12', 'ΠΑΤΡΑ', 'asdads', 'ΚΑΤΗΓΟΡΙΑ 4', 'asdasdasdasd', 1, '2014-09-20 21:25:50', '2014-09-24 21:25:36'),
(47, 2, '38.24958', '21.73495', 'kanakari roufou 48', 'patra', 'sdasd', 'ΚΑΤΗΓΟΡΙΑ 5', 'asdasd', 0, '2014-09-20 22:59:18', '2014-09-20 22:59:18'),
(48, 2, '38.24892', '21.73979', 'ΖΑΙΜΗ 42', 'patra', 'asdasd', 'ΚΑΤΗΓΟΡΙΑ 5', 'asdasdasd', 0, '2014-09-20 22:59:36', '2014-09-20 22:59:36'),
(49, 2, '38.24401', '21.73920', 'sotiriadou 4', 'patra', 'Patrasdasd', 'ΚΑΤΗΓΟΡΙΑ 4', 'descritttp', 0, '2014-09-21 16:26:43', '2014-09-21 16:26:43'),
(50, 2, '38.24844', '21.74037', 'ΖΑΙΜΗ 23', 'ΠΑΤΡΑ', 'dasdasdas', 'ΚΑΤΗΓΟΡΙΑ 1', 'dasdasdasdas', 0, '2014-09-21 16:42:44', '2014-09-21 16:42:44'),
(51, 2, '38.09698', '23.97663', 'kefalinias', 'patra', '', 'ΚΑΤΗΓΟΡΙΑ 2', '', 0, '2014-09-22 00:56:55', '2014-09-22 00:56:55'),
(52, 2, '38.25481', '21.74424', 'kefalhnias 13', 'patra', 'kin', 'ΚΑΤΗΓΟΡΙΑ 2', 'Akakaka', 0, '2014-09-22 00:58:43', '2014-09-22 00:58:43'),
(53, 2, '38.26025', '21.73914', 'kiprou 21', 'patra', 'asdasda', 'ΚΑΤΗΓΟΡΙΑ 3', 'asdasdasd', 0, '2014-09-27 17:16:50', '2014-09-27 17:16:50'),
(54, 1, '38.24845', '21.73984', 'kanakari roufou 48-50', 'ΠΑΤΡΑ', 'Spiti', 'ΚΑΤΗΓΟΡΙΑ 3', 'asdasd', 0, '2014-09-27 17:17:56', '2014-09-27 17:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `hash` varchar(60) COLLATE utf8_bin NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `surname` varchar(50) COLLATE utf8_bin NOT NULL,
  `phone` varchar(15) COLLATE utf8_bin NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `hash`, `name`, `surname`, `phone`, `admin`, `created_at`, `updated_at`) VALUES
(1, 'lykos@ceid.upatras.gr', '$2a$12$bb562b672908328dc459au6X6kZFo2c2SnNKAn2kg.ImsJU0LFiDG', 'Καρολος', 'Λυκος', '2106814254', 0, '2014-09-05 19:40:15', '2014-09-05 19:40:15'),
(2, 'l.g.karolos@gmail.com', '$2a$12$7bc966d736bde07622690ur6LSyRA6LbCzKQVFImzzJ4iXEslRICK', 'kariolos', 'Lykos', '2106109731', 1, '2014-09-05 20:03:46', '2014-09-12 23:25:39'),
(3, 'lykos@upatras.gr', '$2a$12$aa5f43926d95d3837ed3cuUNK8uEpYtMNp8yyDl.CrntIEPEGvMUm', 'kariolos', 'kariolos', '21021023102112', 0, '2014-09-06 23:40:52', '2014-09-15 19:24:15'),
(4, 'kariolos_mospit@hotmail.com', '$2a$12$3aafc0d8f2b4418820368u3p.8JclaWOO5uV5xufnVt0BhUQWnjnK', 'kairkasdask', 'askndkasjdndk', '74556415646', 0, '2014-09-06 23:41:19', '2014-09-06 23:41:19'),
(5, 'l.g.karolos@gmail.com1', '$2a$12$bff0ee97dd4ec7f667648erLxMuRJ1XYgMLcaC9dOILHkt9atT06S', 'akkasdkaksdka', 'kasdasnsdkjnasjkd', '4456545321', 0, '2014-09-06 23:49:49', '2014-09-06 23:49:49'),
(6, 'lykos2@ceid.upatras.gr', '$2a$12$f9f9a990f5792d5ab7a6auNOfiOu5.i0asHMn/8MZPGH.wq9o1iPi', 'kariolos2', 'kariolos2', '2102255556', 0, '2014-09-06 23:50:57', '2014-09-12 20:26:26'),
(9, 'lykos5@ceid.upatras.gr', '$2a$12$14c3cc0873a4093913aa8uFUtUeQtCn/CdDlTgyU7kz5h7Jy/8YZG', 'aksdjlkasd', 'aklsmdklmas', '44654656', 0, '2014-09-06 23:52:37', '2014-09-06 23:52:37'),
(10, 'lykos6@ceid.upatras.gr', '$2a$12$2493cfa426e4e9747c95eurjvKvMfLkefGQnoO7eJM2JxBkQOdn4e', 'kasdikasd', 'jaskldnjas', '45656523', 0, '2014-09-06 23:53:02', '2014-09-06 23:53:02'),
(11, 'lykos7@ceid.upatra.gr', '$2a$12$98edda060c43540e6272fu.z8vcQBzjo15RCnmqzwYtOzfIqQZo3i', 'ajksndjasd', 'akjsndkjasd', '456466', 0, '2014-09-06 23:53:27', '2014-09-06 23:53:27'),
(12, 'lykos10@ceid.upatras.gr', '$2a$12$a9c50805297148f8f0e3dupjwN0iprSoVfN7VG1xbOGQG1YMshQgu', 'kaaiaia', 'kakakaiai', '456+5464', 0, '2014-09-06 23:53:41', '2014-09-06 23:53:41'),
(13, 'sofiabubi@hotmail.com', '$2a$12$07bb8c315c4807211245bOIenwVYDBUXDnEQN6E3Yw5CxbPX9slMa', '4Euaaaaaaa', 'Laouvra', '694212356695', 0, '2014-09-08 06:22:36', '2014-09-08 06:22:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`comm_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
 ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `spots`
--
ALTER TABLE `spots`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `comm_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `spots`
--
ALTER TABLE `spots`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
