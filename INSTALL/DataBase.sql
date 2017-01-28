SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- Base de datos: `jespinosap_kiosco`

CREATE DATABASE IF NOT EXISTS `jespinosap_kiosco` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `jespinosap_kiosco`;


-- Estructura de tabla para la tabla `art_com`

DROP TABLE IF EXISTS `art_com`;

CREATE TABLE `art_com` (
  `ID_Art` int(11) NOT NULL,
  `ID_Com` int(11) NOT NULL,
  `Unidades` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ID_Art`,`ID_Com`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- Estructura de tabla para la tabla `art_dep`

DROP TABLE IF EXISTS `art_dep`;

CREATE TABLE `art_dep` (
  `ID_Art` int(11) NOT NULL,
  `ID_Dep` int(11) NOT NULL,
  `Pedidas` int(10) NOT NULL,
  `Recibidas` int(10) DEFAULT 0,
  `Vendidas` int(10) DEFAULT 0,
  `Devolver` int(10) DEFAULT 0,
  PRIMARY KEY (`ID_Art`,`ID_Dep`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- Estructura de tabla para la tabla `articulo`

DROP TABLE IF EXISTS `articulo`;

CREATE TABLE `articulo` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Fam` int(11) NOT NULL,
  `ID_Pro` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Stock` int(11) unsigned NOT NULL DEFAULT '0',
  `PCBase` float unsigned NOT NULL,
  `PCFinal` float unsigned NOT NULL,
  `PVP` float unsigned NOT NULL DEFAULT '0',
  `Comentario` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Nombre` (`Nombre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- Estructura de tabla para la tabla `cliente`

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DNI` varchar(9) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Direccion` varchar(50) DEFAULT NULL,
  `Telefono` varchar(9) DEFAULT NULL,
  `Mail` varchar(50) DEFAULT NULL,
  `Comentario` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `DNI` (`DNI`),
  UNIQUE KEY `Nombre` (`Nombre`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- Volcar la base de datos para la tabla `cliente`

INSERT INTO cliente VALUES (1, '00000000O', 'Anonimo', '', '', '', 'Cliente no registrado en la base de datos');


-- Estructura de tabla para la tabla `compra`

DROP TABLE IF EXISTS `compra`;

CREATE TABLE `compra` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Cli` int(11) NOT NULL DEFAULT '1',
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Importe` float NOT NULL DEFAULT '0',
  `Comentario` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- Estructura de tabla para la tabla `deposito`

DROP TABLE IF EXISTS `deposito`;

CREATE TABLE `deposito` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Pro` int(11) NOT NULL,
  `Importe` float NOT NULL DEFAULT '0',
  `Estado` tinyint(1) NOT NULL DEFAULT '0',
  `FechaPedido` timestamp NULL DEFAULT NULL,
  `FechaDeposito` timestamp NULL DEFAULT NULL,
  `FechaCierre` timestamp NULL DEFAULT NULL,
  `Comentario` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- Estructura de tabla para la tabla `familia`

DROP TABLE IF EXISTS `familia`;

CREATE TABLE `familia` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(25) NOT NULL,
  `IVA` float unsigned NOT NULL,
  `RecEq` float unsigned NOT NULL,
  `Comentario` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Nombre` (`Nombre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- Volcar la base de datos para la tabla `cliente`

INSERT INTO familia VALUES (1, 'General', 18, 4, '');
INSERT INTO familia VALUES (2, 'Reducido', 8, 1, '');
INSERT INTO familia VALUES (3, 'Superreducido', 4, 0.5, '');
INSERT INTO familia VALUES (4, 'Labores del Tabaco', 0, 1.75, 'Impuesto Especial');


-- Estructura de tabla para la tabla `proveedor`

DROP TABLE IF EXISTS `proveedor`;

CREATE TABLE `proveedor` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CIF` varchar(9) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Direccion` varchar(50) DEFAULT NULL,
  `Telefono` varchar(9) DEFAULT NULL,
  `Mail` varchar(50) DEFAULT NULL,
  `Comentario` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `CIF` (`CIF`),
  UNIQUE KEY `Nombre` (`Nombre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;