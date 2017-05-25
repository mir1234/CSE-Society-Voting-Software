-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2016 at 08:06 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cse_election`
--

-- --------------------------------------------------------

--
-- Table structure for table `sys_cse_soc_admin`
--

CREATE TABLE IF NOT EXISTS `sys_cse_soc_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sys_cse_soc_admin`
--

INSERT INTO `sys_cse_soc_admin` (`id`, `username`, `password`) VALUES
(1, 'neub', 'fea7f657f56a2a448da7d4b535ee5e279caf3d9a');

-- --------------------------------------------------------

--
-- Table structure for table `sys_cse_soc_candidate`
--

CREATE TABLE IF NOT EXISTS `sys_cse_soc_candidate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `voter_id` varchar(255) NOT NULL,
  `post_id` varchar(255) NOT NULL,
  `votes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `sys_cse_soc_post`
--

CREATE TABLE IF NOT EXISTS `sys_cse_soc_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `sys_cse_soc_voter`
--

CREATE TABLE IF NOT EXISTS `sys_cse_soc_voter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `semester` enum('Spring','Summer','Fall') NOT NULL,
  `year` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `vote_status` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=222 ;

--
-- Dumping data for table `sys_cse_soc_voter`
--

INSERT INTO `sys_cse_soc_voter` (`id`, `student_id`, `name`, `semester`, `year`, `keyword`, `vote_status`, `status`) VALUES
(68, '140203020002', 'Mir Lutfur Rahman', 'Summer', '2014', '18800696', 0, 'Active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
