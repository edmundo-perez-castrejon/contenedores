-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 26, 2012 at 03:57 PM
-- Server version: 5.5.24-0ubuntu0.12.04.1
-- PHP Version: 5.3.10-1ubuntu3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `contenedores`
--

-- --------------------------------------------------------

--
-- Table structure for table `configuracion`
--

CREATE TABLE IF NOT EXISTS `configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imagen_frontal` varchar(254) NOT NULL,
  `nombre_sistema` varchar(254) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `configuracion`
--

INSERT INTO `configuracion` (`id`, `imagen_frontal`, `nombre_sistema`) VALUES
(2, '25bed-3448211898_67691fe4e7_b.jpg', 'Control de Contenedores');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `pedimentos`
--

CREATE TABLE IF NOT EXISTS `pedimentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_proveedor` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `pedimento` char(16) NOT NULL,
  `cantidad_contenedores` int(11) NOT NULL,
  `conocimiento_embarque` char(16) NOT NULL,
  `numero_cuenta_gastos` int(11) NOT NULL,
  `fecha_cuenta_gastos` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pedimentos`
--

INSERT INTO `pedimentos` (`id`, `id_proveedor`, `id_cliente`, `pedimento`, `cantidad_contenedores`, `conocimiento_embarque`, `numero_cuenta_gastos`, `fecha_cuenta_gastos`) VALUES
(3, 1, 18, '0123456789123456', 77, '0123456789123456', 87987, '2012-08-22');

-- --------------------------------------------------------

--
-- Table structure for table `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rfc` char(18) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `proveedores`
--

INSERT INTO `proveedores` (`id`, `rfc`) VALUES
(1, 'PECE820214UB9');

-- --------------------------------------------------------

--
-- Table structure for table `proveedores_users`
--

CREATE TABLE IF NOT EXISTS `proveedores_users` (
  `id_proveedor` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proveedores_users`
--

INSERT INTO `proveedores_users` (`id_proveedor`, `id_user`) VALUES
(1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `seguimiento`
--

CREATE TABLE IF NOT EXISTS `seguimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedimento` int(11) NOT NULL,
  `estatus` tinyint(4) NOT NULL,
  `descripcion` varchar(254) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `seguimiento`
--

INSERT INTO `seguimiento` (`id`, `id_pedimento`, `estatus`, `descripcion`, `fecha`) VALUES
(1, 3, 0, 'Arribo de la carga', '0000-00-00'),
(2, 3, 0, 'Revalidacion del conocimiento de embarque', '0000-00-00'),
(3, 3, 0, 'Revalidación previos', '0000-00-00'),
(4, 3, 0, 'Pago pedimento', '0000-00-00'),
(5, 3, 0, 'Salida de contenedores', '0000-00-00'),
(6, 3, 0, 'Entrega de vacios', '0000-00-00'),
(7, 3, 0, 'Corte de moras', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` int(10) unsigned NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `user_type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `IX_USERNAME` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `user_type`) VALUES
(17, 2130706433, 'root', 'toor', NULL, 'ing.edmundo@gmail.com', NULL, NULL, NULL, 1268889823, 1345997066, 1, NULL, NULL, NULL, NULL, 2),
(18, 0, 'edmundo', 'mundo', NULL, 'ing.edmundo@gmail.com', NULL, NULL, NULL, 0, 1345997019, 1, 'Edmundo', 'Perez Castrejon', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 3, 2),
(5, 17, 1),
(6, 17, 2),
(7, 19, 1),
(8, 19, 2),
(9, 20, 1),
(10, 20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE IF NOT EXISTS `user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(254) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `description`) VALUES
(1, 'normal'),
(2, 'administrador'),
(3, 'reporteador');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
