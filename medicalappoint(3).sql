-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 07, 2018 at 06:25 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medicalappoint`
--
CREATE DATABASE IF NOT EXISTS `medicalappoint` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `medicalappoint`;

-- --------------------------------------------------------

--
-- Table structure for table `clinica`
--

DROP TABLE IF EXISTS `clinica`;
CREATE TABLE IF NOT EXISTS `clinica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  `NIF` int(9) DEFAULT NULL,
  `morada` varchar(250) NOT NULL,
  `codigopostal` varchar(8) NOT NULL,
  `Localidade` varchar(50) NOT NULL,
  `GPS` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Truncate table before insert `clinica`
--

TRUNCATE TABLE `clinica`;
--
-- Dumping data for table `clinica`
--

INSERT INTO `clinica` (`id`, `nome`, `NIF`, `morada`, `codigopostal`, `Localidade`, `GPS`, `status`, `created_at`, `deleted_at`, `updated_at`) VALUES
(1, 'Testes', NULL, 'Rua do Nada', '4510-664', 'Vazio', NULL, 1, '2017-12-29 13:49:39', NULL, '2017-12-29 13:49:39'),
(2, 'clinica 2', NULL, 'Não sei', '4510-664', 'Talvez', NULL, 1, '2018-01-11 11:42:48', NULL, '2018-01-11 11:42:48');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Field` varchar(45) NOT NULL,
  `FieldValue` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `config`
--

TRUNCATE TABLE `config`;
--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `Field`, `FieldValue`) VALUES
(1, 'businessHours_Start', '08:00'),
(2, 'businessHours_End', '20:30');

-- --------------------------------------------------------

--
-- Table structure for table `especialidade`
--

DROP TABLE IF EXISTS `especialidade`;
CREATE TABLE IF NOT EXISTS `especialidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `especialidade`
--

TRUNCATE TABLE `especialidade`;
--
-- Dumping data for table `especialidade`
--

INSERT INTO `especialidade` (`id`, `nome`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Especialidade 1', 1, '2017-12-29 13:57:15', '2017-12-29 13:57:15', NULL),
(2, 'Especialidade 2.01', 1, '2018-01-05 10:19:03', '2018-01-05 14:38:11', NULL),
(3, 'Especialidade 3', 1, '2018-01-05 14:38:20', '2018-01-05 14:38:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medicos`
--

DROP TABLE IF EXISTS `medicos`;
CREATE TABLE IF NOT EXISTS `medicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  `NIF` varchar(9) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `medicos`
--

TRUNCATE TABLE `medicos`;
--
-- Dumping data for table `medicos`
--

INSERT INTO `medicos` (`id`, `nome`, `NIF`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Médico teste', '', 1, '2017-12-29 13:54:09', '2017-12-29 13:54:09', NULL),
(2, 'Médico teste 2', '209979151', 1, '2018-01-08 14:29:09', '2018-01-11 09:51:56', NULL),
(3, 'Médico testes 5', '', 3, '2018-01-11 12:35:06', '2018-01-11 15:10:27', '2018-01-11 15:10:27'),
(4, 'Médico teste 3', '', 2, '2018-01-11 12:35:53', '2018-01-11 15:10:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medico_clinica`
--

DROP TABLE IF EXISTS `medico_clinica`;
CREATE TABLE IF NOT EXISTS `medico_clinica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_medico` int(11) NOT NULL,
  `id_clinica` int(11) NOT NULL,
  `principal` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `medico_clinica`
--

TRUNCATE TABLE `medico_clinica`;
--
-- Dumping data for table `medico_clinica`
--

INSERT INTO `medico_clinica` (`id`, `id_medico`, `id_clinica`, `principal`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 1, '2017-12-29 14:03:49', '2017-12-29 14:03:49', NULL),
(2, 4, 1, 0, 1, '2018-01-11 12:35:53', '2018-01-11 12:35:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medico_especialidade`
--

DROP TABLE IF EXISTS `medico_especialidade`;
CREATE TABLE IF NOT EXISTS `medico_especialidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_medico` int(11) NOT NULL,
  `id_especialidade` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `medico_especialidade`
--

TRUNCATE TABLE `medico_especialidade`;
--
-- Dumping data for table `medico_especialidade`
--

INSERT INTO `medico_especialidade` (`id`, `id_medico`, `id_especialidade`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, '2017-12-29 13:59:16', '2017-12-29 13:59:16', NULL),
(2, 2, 1, 1, '2018-01-11 09:51:56', '2018-01-11 09:51:56', NULL),
(3, 2, 3, 1, '2018-01-11 09:51:56', '2018-01-11 09:51:56', NULL),
(4, 4, 1, 1, '2018-01-11 12:35:53', '2018-01-11 12:35:53', NULL),
(5, 4, 2, 1, '2018-01-11 12:35:53', '2018-01-11 12:35:53', NULL),
(8, 3, 1, 1, '2018-01-11 14:30:40', '2018-01-11 14:30:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
CREATE TABLE IF NOT EXISTS `paciente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  `nif` varchar(9) DEFAULT NULL,
  `morada` varchar(250) NOT NULL,
  `codigopostal` varchar(8) NOT NULL,
  `localidade` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `telemovel` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `paciente`
--

TRUNCATE TABLE `paciente`;
--
-- Dumping data for table `paciente`
--

INSERT INTO `paciente` (`id`, `nome`, `nif`, `morada`, `codigopostal`, `localidade`, `status`, `created_at`, `updated_at`, `deleted_at`, `telemovel`, `email`) VALUES
(1, 'Paciente 1', '', 'Rua do tou cansado', '4510-664', 'Coiso', 1, '2017-12-29 14:07:01', '2017-12-29 14:07:01', NULL, NULL, NULL),
(2, 'Testes', '209979151', 'Rua do Fim', '4510-664', 'Loc 2', 1, '2018-04-10 10:55:41', '2018-04-10 10:55:41', NULL, '963333333', 'r@r.pt'),
(3, 'ss', '', 'ss', '', '', 1, '2018-04-10 11:02:24', '2018-04-10 11:02:24', NULL, 's', ''),
(4, '321', '', '32', '', '', 1, '2018-04-10 11:32:57', '2018-04-10 11:32:57', NULL, '321', ''),
(5, 'werw', '', 'rwer', '', 'Loc', 1, '2018-04-10 12:01:41', '2018-04-30 10:07:28', NULL, 'wer', '');

-- --------------------------------------------------------

--
-- Table structure for table `paciente_clinica`
--

DROP TABLE IF EXISTS `paciente_clinica`;
CREATE TABLE IF NOT EXISTS `paciente_clinica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `id_clinica` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `paciente_clinica`
--

TRUNCATE TABLE `paciente_clinica`;
--
-- Dumping data for table `paciente_clinica`
--

INSERT INTO `paciente_clinica` (`id`, `id_paciente`, `id_clinica`, `status`, `created_at`) VALUES
(1, 1, 1, 1, '2018-01-12 03:56:18'),
(9, 5, 2, 1, '2018-04-30 10:10:27'),
(10, 2, 2, 1, '2018-04-30 10:10:43'),
(11, 2, 1, 1, '2018-04-30 10:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` date DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `status`, `created_at`, `deleted_at`, `updated_at`) VALUES
(1, 'admin', '482c811da5d5b4bc6d497ffa98491e38', 'Admin', 'Admin', NULL, 1, '2017-12-29 00:00:00', NULL, '2017-12-29 00:00:00'),
(3, 'rnunes', 'e97878da814e283d65f166d0d243e801', 'Rui', 'Nunes', 'ruinunes25@gmail.com', 1, '2018-01-12 00:04:03', NULL, '2018-01-12 00:29:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_clinica`
--

DROP TABLE IF EXISTS `user_clinica`;
CREATE TABLE IF NOT EXISTS `user_clinica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_clinica` int(11) NOT NULL,
  `principal` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `user_clinica`
--

TRUNCATE TABLE `user_clinica`;
--
-- Dumping data for table `user_clinica`
--

INSERT INTO `user_clinica` (`id`, `id_user`, `id_clinica`, `principal`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 1, '2017-12-29 13:50:46', '2017-12-29 13:50:46', NULL),
(2, 3, 1, 0, 1, '2018-01-12 00:59:40', '2018-01-12 00:59:40', NULL),
(3, 3, 2, 1, 1, '2018-01-12 00:59:40', '2018-01-12 00:59:40', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
