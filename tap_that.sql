-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Host: localhost:8080
-- Generation Time: Aug 31, 2015 at 10:14 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tap_that`
--
CREATE DATABASE IF NOT EXISTS `tap_that` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tap_that`;

-- --------------------------------------------------------

--
-- Table structure for table `beers`
--

CREATE TABLE IF NOT EXISTS `beers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `abv` decimal(3,1) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `ibu` int(10) DEFAULT NULL,
  `brewery_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `breweries`
--

CREATE TABLE IF NOT EXISTS `breweries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `drunks`
--

CREATE TABLE IF NOT EXISTS `drunks` (
  `id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `on_tap`
--

CREATE TABLE IF NOT EXISTS `on_tap` (
  `id` int(11) NOT NULL,
  `pub_id` int(11) DEFAULT NULL,
  `beer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pubs`
--

CREATE TABLE IF NOT EXISTS `pubs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beers`
--
ALTER TABLE `beers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `breweries`
--
ALTER TABLE `breweries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drunks`
--
ALTER TABLE `drunks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `on_tap`
--
ALTER TABLE `on_tap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pubs`
--
ALTER TABLE `pubs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beers`
--
ALTER TABLE `beers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `breweries`
--
ALTER TABLE `breweries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `drunks`
--
ALTER TABLE `drunks`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `on_tap`
--
ALTER TABLE `on_tap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pubs`
--
ALTER TABLE `pubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
