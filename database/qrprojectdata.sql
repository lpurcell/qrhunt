-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 08, 2013 at 08:40 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `qrproject`
--

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`EVENT_ID`, `ORGANIZATION_ID`, `EVENT_NAME`, `EVENT_LOCATION`, `EVENT_DATE`, `EVENT_COORDINATOR`, `EVENT_EMAIL`, `EVENT_LOGO`, `EVENT_MAINCOLOR`, `EVENT_TEXTCOLOR`, `EVENT_HEADERCOLOR`) VALUES
(123, 456, 'Kitties', 'Looney Complex', '2013-05-22', 'kis', 'kisa@kisa.com', NULL, '#7a0eed', '#d61313', '#dbc00f'),
(125, 456, 'Bird Expo', 'Civic Arean', '2013-05-05', '', 'toby@toby.com', '', '', '', ''),
(126, 456, 'Catalpawloosa!', 'Looney Complex', '2013-05-05', '', 'toby@toby.com', 'sdf', 'sadf', 'sdaf', 'asfd'),
(789, 456, 'Birds Galore!', 'Looney Complex', '2013-05-29', 'Toby Bird', 'bird@bird.com', 'GEResize.jpg', '#F3E2A9', '#8000FF', '#D0A9F5'),
(800, 456, 'wwww', 'wwww', '2013-07-17', '', 'danny@danny', 'brr 040.jpg', '', '', ''),
(801, 456, 'thunderstorm', 'missouri', '2013-07-26', '', 'toby@toby.com', '0', '#753939', '#c72c2c', '#dbc7c7'),
(802, 456, 'lightning', 'platte city', '2013-06-27', '', 'danny@danny', '0', '#3561f2', '#1cc4b9', '#00ff00'),
(803, 456, 'Pretty Kitties', 'Looney Complex', '2013-06-29', '', 'danny@danny', '0', '#451c40', '#873a83', '#2a367a'),
(804, 456, 'Blue Cats', 'platte city', '2013-06-30', '', 'kitties@kitties.com', '0', '#ebca0e', '#000000', '#82817b'),
(805, 456, 'Toby', 'toby''s cage', '2013-07-18', '', 'toby@toby.com', 'brr 082.jpg', '#580eed', '#e817de', '#1420c9'),
(806, 456, 'Green Cats', 'platte city', '2013-06-30', '', 'kitties@kitties.com', 'brr 082.jpg', '#168743', '#607275', '#00b819'),
(807, 456, 'Purple Cats', 'kitty palace', '2013-06-30', '', 'kitties@kitties.com', 'brr 082.jpg', '#8c0eed', '#000000', '#ae94e3'),
(808, 456, 'Purple Cats', 'kitty palace', '2013-06-30', '', 'kitties@kitties.com', 'brr 059.jpg', '#8c0eed', '#000000', '#ae94e3'),
(809, 456, 'Purple Cats', 'kitty palace', '2013-06-30', '', 'kitties@kitties.com', 'brr 059.jpg', '#8c0eed', '#000000', '#ae94e3'),
(810, 456, 'adf', 'dasf', '2013-06-30', '', 'kitties@kitties.com', 'brr 123.jpg', '#ebca0e', '#000000', '#82817b'),
(811, 456, 'kjgh', 'kjg', '2013-06-29', '', 'kitties@kitties.com', 'brr 081.jpg', '#ebca0e', '#000000', '#82817b'),
(825, 456, 'adf', 'df', '2013-06-29', '', 'danny@danny', 'brr 030.jpg', '#ebca0e', '#000000', '#82817b'),
(826, 456, 'adf', 'df', '2013-06-29', '', 'danny@danny', 'brr_030.jpg', '#ebca0e', '#000000', '#82817b');

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`ORGANIZATION_ID`, `ORGANIZATION_NAME`, `ORGANIZATION_SPONSOR`) VALUES
(456, 'Crazy Cat Ladies', 'Krystle'),
(457, 'CHEESE', 'kisa'),
(458, 'I love cats', 'Toby'),
(459, 'kitty club', 'danny purcell');

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`PARTICIPANT_ID`, `EVENT_ID`, `PARTICIPANT_LNAME`, `PARTICIPANT_FNAME`, `PARTICIPANT_EMAIL`, `PARTICIPANT_WEBSITE`, `QRCODE`, `PARTICIPANT_PICTURE`) VALUES
(4, 123, 'kitty', 'cat', 'toby@toby.com', '', '32165', ''),
(5, 123, 'kitty', 'Toby', 'cat@cat.com', '', '32156', ''),
(6, 123, 'Cheese', 'Delicious', 'toby@toby.com', 'ldskjf', 'lakdsj', 'meeting6.18.txt'),
(7, 123, 'daf', 'asdf', 'toby@toby.com', '', 'adf', '100_0027.jpg'),
(11, 123, 'The musical', 'Shoesical', 'kitties@kitties.com', '', 'asdf', 'Photo0026.JPG'),
(12, 123, 'Kat', 'Kitty', 'kitties@kitties.com', '', 'adf', 'Photo00261.JPG'),
(13, 123, 'asdf', 'asdf', 'toby@toby.com', '', 'adf', 'brr_0271.jpg'),
(14, 123, 'teaf', 'asdf', 'toby@toby.com', '', 'asdf', 'brr_039.jpg'),
(15, 123, 'teaf', 'asdf', 'toby@toby.com', '', 'asdf', 'brr_071.jpg'),
(16, 123, 'teaf', 'asdf', 'toby@toby.com', '', 'asdf', 'brr_0711.jpg'),
(17, 123, 'Purcell', 'Laura', 'danny@danny.com', '', 'lsadkf', 'Allyssa_flower2.jpg'),
(18, 123, 'adf', 'asdf', 'danny@danny.com', '', 'adsf', '0'),
(19, 123, 'brr', 'becker', 'danny@danny.com', '', 'adsf', '0'),
(20, 123, 'adf', 'asdf', 'danny@danny.com', '', 'asdf', '0'),
(21, 123, 'adf', 'adf', 'danny@danny.com', '', 'adsf', '0'),
(22, 123, 'adf', 'asdf', 'danny@danny.com', '', 'sdf', 'Allyssa_flower3.jpg'),
(23, 123, 'hxd', 'utf', 'danny@danny.com', '', 'jhf', '0'),
(24, 123, 'afd', 'asdf', 'danny@danny.com', '', 'asdf', '0'),
(25, 123, 'BRR', 'asdf', 'danny@danny.com', '', 'sadf', '100_00271.jpg'),
(26, 123, 'kjgb', 'jb', 'danny@danny.com', '', 'KJBG', 'brr_058.jpg'),
(28, 123, 'Bird', 'Toby', 'toby@toby.com', '', '123456', 'brr_026.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
