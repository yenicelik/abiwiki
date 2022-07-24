-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jan 04, 2015 at 04:17 PM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `DBtestQuery`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `comment_ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `comment_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_entries`
--

CREATE TABLE `blog_entries` (
`ID` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `content` text NOT NULL,
  `teaser` tinytext NOT NULL,
  `entry_time` datetime NOT NULL,
  `category` varchar(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COMMENT='Table including the article Contents';

--
-- Dumping data for table `blog_entries`
--

INSERT INTO `blog_entries` (`ID`, `title`, `content`, `teaser`, `entry_time`, `category`) VALUES
(11, '', 'Some other Sample Text This Time this way\r\n', '', '0000-00-00 00:00:00', 'BIOLO0101');

-- --------------------------------------------------------

--
-- Table structure for table `blog_users`
--

CREATE TABLE `blog_users` (
`user_ID` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_mail` varchar(50) NOT NULL,
  `user_password` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COMMENT='User Table';

--
-- Dumping data for table `blog_users`
--

INSERT INTO `blog_users` (`user_ID`, `user_name`, `user_mail`, `user_password`) VALUES
(13, 'asdas', 'dasda@adsdsa.com', 'cd3f10e127f060f50c66a31257468bbdf7a8fd3c'),
(15, 'Dave', 'david.yenicelik@gmail.com', 'e12ec55eeacaf5bd29e6eae34eefb5e7a8415464');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `blog_entries`
--
ALTER TABLE `blog_entries`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `category` (`category`);

--
-- Indexes for table `blog_users`
--
ALTER TABLE `blog_users`
 ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_entries`
--
ALTER TABLE `blog_entries`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `blog_users`
--
ALTER TABLE `blog_users`
MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
