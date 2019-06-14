-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2017 at 01:11 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `social_network`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` mediumtext NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `user_id`, `comment`, `date_time`) VALUES
(2, 8, 65, 'adfhajk', '0000-00-00 00:00:00'),
(3, 8, 65, 'ali danish', '0000-00-00 00:00:00'),
(4, 8, 65, 'hehehe ye kia bakwaas hai', '0000-00-00 00:00:00'),
(5, 8, 65, 'kia bakwas hai', '0000-00-00 00:00:00'),
(6, 8, 65, 'kia hai', '0000-00-00 00:00:00'),
(7, 7, 65, '', '0000-00-00 00:00:00'),
(8, 7, 65, '', '0000-00-00 00:00:00'),
(9, 7, 65, '', '0000-00-00 00:00:00'),
(10, 7, 65, '?????', '0000-00-00 00:00:00'),
(11, 3, 65, 'he he he ', '0000-00-00 00:00:00'),
(12, 6, 68, 'oh bhai ye kia hai?', '0000-00-00 00:00:00'),
(13, 6, 68, 'bhens ki dum', '0000-00-00 00:00:00'),
(14, 6, 68, 'sae hai', '0000-00-00 00:00:00'),
(15, 5, 68, 'kia baat hai', '0000-00-00 00:00:00'),
(16, 2, 68, 'good morning bhai', '0000-00-00 00:00:00'),
(17, 5, 65, 'wah g wah', '0000-00-00 00:00:00'),
(18, 5, 65, 'chah gye ho', '0000-00-00 00:00:00'),
(19, 11, 68, ' ye black pic q janii?', '0000-00-00 00:00:00'),
(20, 11, 69, 'kia khudi apni pic pr comment kr raha?', '0000-00-00 00:00:00'),
(21, 11, 69, 'oye', '0000-00-00 00:00:00'),
(22, 11, 69, 'oye hoye', '0000-00-00 00:00:00'),
(23, 11, 69, 'oye kia hai ye bc?', '0000-00-00 00:00:00'),
(24, 10, 69, 'hahahaa', '0000-00-00 00:00:00'),
(25, 9, 65, 'ye kia', '0000-00-00 00:00:00'),
(26, 8, 65, 'bla bla', '0000-00-00 00:00:00'),
(27, 7, 65, 'asad?', '0000-00-00 00:00:00'),
(28, 9, 65, 'ye to', '0000-00-00 00:00:00'),
(29, 1, 65, 'oooo lala', '0000-00-00 00:00:00'),
(30, 14, 73, 'good!!', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `friend1` int(11) NOT NULL,
  `friend2` int(11) NOT NULL,
  `request_accepted` tinyint(1) NOT NULL,
  `request_sent` int(11) NOT NULL,
  PRIMARY KEY (`friend1`,`friend2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`friend1`, `friend2`, `request_accepted`, `request_sent`) VALUES
(65, 68, 1, 0),
(65, 69, 0, 1),
(65, 70, 1, 0),
(65, 73, 0, 1),
(68, 65, 1, 0),
(68, 69, 1, 0),
(68, 70, 1, 0),
(68, 71, 1, 0),
(68, 72, 1, 0),
(68, 73, 0, 1),
(69, 65, 0, 1),
(69, 68, 1, 0),
(69, 71, 0, 1),
(69, 72, 0, 1),
(70, 65, 1, 0),
(70, 68, 1, 0),
(71, 68, 1, 0),
(71, 69, 0, 1),
(71, 73, 1, 0),
(72, 68, 1, 0),
(72, 69, 0, 1),
(73, 65, 0, 1),
(73, 68, 0, 1),
(73, 71, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`post_id`, `user_id`) VALUES
(1, 65),
(2, 68),
(3, 65),
(4, 68),
(5, 65),
(5, 68),
(6, 68),
(7, 65),
(8, 65),
(8, 69),
(9, 65),
(9, 68),
(10, 69),
(11, 68),
(11, 69),
(14, 73);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `time`) VALUES
(67, 68, 70, 'hello laiba. kia haal hai?', '0000-00-00 00:00:00'),
(68, 70, 68, 'main theek hun asad, tum sunao?', '0000-00-00 00:00:00'),
(69, 68, 70, 'tayyari kitni ki?', '0000-00-00 00:00:00'),
(70, 70, 68, 'esay questions nae krte', '0000-00-00 00:00:00'),
(71, 68, 71, 'hello sohaib!', '0000-00-00 00:00:00'),
(72, 71, 68, 'hello asad!', '0000-00-00 00:00:00'),
(73, 68, 71, 'how was the presentation?', '0000-00-00 00:00:00'),
(74, 73, 71, 'salam!', '0000-00-00 00:00:00'),
(75, 71, 73, 'wassalam!', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id1` int(11) NOT NULL,
  `user_id2` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=135 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id1`, `user_id2`, `type`, `date`, `time`) VALUES
(85, 65, 72, 'request', '0000-00-00', '00:00:00'),
(86, 65, 64, 'request', '0000-00-00', '00:00:00'),
(87, 68, 72, 'request', '0000-00-00', '00:00:00'),
(89, 72, 69, 'request', '0000-00-00', '00:00:00'),
(90, 69, 68, 'request', '0000-00-00', '00:00:00'),
(91, 65, 69, 'comment', '0000-00-00', '00:00:00'),
(92, 65, 68, 'comment', '0000-00-00', '00:00:00'),
(93, 65, 68, 'comment', '0000-00-00', '00:00:00'),
(94, 69, 65, 'like', '0000-00-00', '00:00:00'),
(95, 69, 65, 'like', '0000-00-00', '00:00:00'),
(96, 69, 68, 'like', '0000-00-00', '00:00:00'),
(97, 65, 69, 'comment', '0000-00-00', '00:00:00'),
(98, 68, 65, 'like', '0000-00-00', '00:00:00'),
(99, 68, 65, 'like', '0000-00-00', '00:00:00'),
(100, 68, 65, 'like', '0000-00-00', '00:00:00'),
(101, 65, 69, 'comment', '0000-00-00', '00:00:00'),
(102, 69, 72, 'accept', '0000-00-00', '00:00:00'),
(103, 69, 70, 'request', '0000-00-00', '00:00:00'),
(104, 70, 69, 'accept', '0000-00-00', '00:00:00'),
(105, 69, 72, 'accept', '0000-00-00', '00:00:00'),
(106, 69, 72, 'accept', '0000-00-00', '00:00:00'),
(107, 68, 70, 'request', '0000-00-00', '00:00:00'),
(108, 70, 68, 'accept', '0000-00-00', '00:00:00'),
(109, 70, 69, 'accept', '0000-00-00', '00:00:00'),
(110, 68, 65, 'request', '0000-00-00', '00:00:00'),
(111, 68, 71, 'request', '0000-00-00', '00:00:00'),
(112, 68, 69, 'request', '0000-00-00', '00:00:00'),
(113, 68, 72, 'request', '0000-00-00', '00:00:00'),
(114, 71, 68, 'accept', '0000-00-00', '00:00:00'),
(115, 70, 68, 'accept', '0000-00-00', '00:00:00'),
(116, 70, 69, 'accept', '0000-00-00', '00:00:00'),
(117, 70, 68, 'request', '0000-00-00', '00:00:00'),
(118, 68, 70, 'accept', '0000-00-00', '00:00:00'),
(119, 69, 68, 'accept', '0000-00-00', '00:00:00'),
(120, 65, 68, 'accept', '0000-00-00', '00:00:00'),
(121, 65, 70, 'request', '0000-00-00', '00:00:00'),
(122, 70, 65, 'accept', '0000-00-00', '00:00:00'),
(123, 72, 68, 'accept', '0000-00-00', '00:00:00'),
(124, 72, 65, 'accept', '0000-00-00', '00:00:00'),
(125, 72, 65, 'accept', '0000-00-00', '00:00:00'),
(126, 69, 65, 'request', '0000-00-00', '00:00:00'),
(127, 69, 71, 'request', '0000-00-00', '00:00:00'),
(128, 69, 72, 'request', '0000-00-00', '00:00:00'),
(129, 73, 68, 'request', '0000-00-00', '00:00:00'),
(130, 71, 73, 'request', '0000-00-00', '00:00:00'),
(131, 73, 71, 'accept', '0000-00-00', '00:00:00'),
(132, 73, 71, 'like', '0000-00-00', '00:00:00'),
(133, 73, 71, 'comment', '0000-00-00', '00:00:00'),
(134, 73, 65, 'request', '0000-00-00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_text` longtext NOT NULL,
  `date` datetime NOT NULL,
  `post_img` varchar(255) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_text`, `date`, `post_img`) VALUES
(1, 69, 'hello how are u people ?', '0000-00-00 00:00:00', ''),
(2, 65, 'Good Morning People!!!!!!!!', '0000-00-00 00:00:00', ''),
(3, 68, 'oooo lala la la lae oooo\r\n', '0000-00-00 00:00:00', ''),
(4, 65, 'hello people', '0000-00-00 00:00:00', 'Desert.jpg'),
(5, 69, 'yohhhoooooooooo', '0000-00-00 00:00:00', 'Penguins.jpg'),
(6, 65, '', '0000-00-00 00:00:00', 'Desert.jpg'),
(7, 68, 'lalalalala', '0000-00-00 00:00:00', 'Penguins.jpg'),
(8, 68, '', '0000-00-00 00:00:00', 'Jellyfish.jpg'),
(9, 69, 'ooo lalalala', '0000-00-00 00:00:00', 'Muhammad Usman Ahsen - Executive Events.jpg'),
(10, 65, 'hahahahah', '0000-00-00 00:00:00', 'footer.JPG'),
(11, 65, 'lul', '0000-00-00 00:00:00', 'Untitled.jpg'),
(13, 69, 'hello people', '0000-00-00 00:00:00', 'me.jpg'),
(14, 71, 'hello world!', '0000-00-00 00:00:00', 'Will_code_html_for_food.jpg'),
(15, 73, 'feeling good!', '0000-00-00 00:00:00', '15873041_1631847393778383_6827432563271902487_n.png');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `cover_pic` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `profile_pic`, `cover_pic`) VALUES
(64, '16714_851070718245401_4134933011432209341_n.jpg', ''),
(65, 'Muhammad Usman Ahsen - Executive Events.jpg', ''),
(67, '', ''),
(68, 'Muhammad Usman Ahsen - Executive Events.jpg', ''),
(69, 'Rohan Manzoor_Events.jpg', ''),
(70, 'Will_code_html_for_food.jpg', ''),
(71, 'me.jpg', ''),
(72, '', ''),
(73, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `dob`, `password`, `active`) VALUES
(64, 'ali danish', 'danishboy000@gmail.com', '1996-12-19', 'e899ddbfacb98c8ef775ef40184bc45d3f1e7b98', 0),
(65, 'Saad Ahmad', 'saad000@gmail.com', '1996-03-07', '9b8c46645894f26deaacaa1075babed2b5d5f34f', 0),
(67, 'Adul Rafay', 'abdul000@gmail.com', '1996-12-10', '596b63251bf890367c1b948efe7247f312e919ae', 0),
(68, 'Asad Nawaz', 'asad000@gmail.com', '1995-08-13', '212aae4a58e94ce1c67507a16a7397ef98adb86d', 0),
(69, 'Faseih Saad', 'faseih000@gmail.com', '1995-03-13', 'eb6ab55d5941d59b92fc748c3379604ff0565f0f', 0),
(70, 'Laiba Bukhari', 'laiba000@gmail.com', '2003-11-23', '89698b446bd0becff2e9abe7f271717877042a2e', 0),
(71, 'sohaib zahid', 'sohaib000@gmail.com', '2017-01-05', '3f78a187cad6d64b251400749e72411945376c3d', 0),
(72, 'shahzad virani', 'shahzad000@gmail.com', '1996-01-24', '8e33bc73c6175add6e2d3184f64ba17b1587dcad', 0),
(73, 'Hirra Anwar', 'hirra000@gmail.com', '1980-10-03', '2501991da09023606d89902cad7e2da034a739f4', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
