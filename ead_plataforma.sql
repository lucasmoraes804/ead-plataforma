-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 04-Abr-2016 às 01:10
-- Versão do servidor: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ead_plataforma`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ead_clients`
--

CREATE TABLE IF NOT EXISTS `ead_clients` (
  `client_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_name` varchar(50) NOT NULL,
  `client_email` varchar(100) NOT NULL,
  `client_phone` varchar(15) NOT NULL,
  `register_date` datetime NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ead_demands`
--

CREATE TABLE IF NOT EXISTS `ead_demands` (
  `demand_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `service_id` int(10) unsigned NOT NULL,
  `demand_start` date NOT NULL,
  `demand_finish` date NOT NULL,
  `register_date` datetime NOT NULL,
  PRIMARY KEY (`demand_id`),
  KEY `demands_client` (`client_id`),
  KEY `demands_service` (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ead_services`
--

CREATE TABLE IF NOT EXISTS `ead_services` (
  `service_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_name` varchar(32) NOT NULL,
  `service_description` text NOT NULL,
  `register_date` datetime NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ead_users`
--

CREATE TABLE IF NOT EXISTS `ead_users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `ead_demands`
--
ALTER TABLE `ead_demands`
  ADD CONSTRAINT `demands_client` FOREIGN KEY (`client_id`) REFERENCES `ead_clients` (`client_id`),
  ADD CONSTRAINT `demands_service` FOREIGN KEY (`service_id`) REFERENCES `ead_services` (`service_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
