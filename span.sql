-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-03-2019 a las 13:03:45
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `span`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consentimiento`
--

CREATE TABLE `consentimiento` (
  `idconsentimiento` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `consentimiento`
--

INSERT INTO `consentimiento` (`idconsentimiento`, `nombre`) VALUES
(1, 'CONSENTIMIENTO INFORMADO PLASMA RICO, CELULAS MADRE, MEGADOSIS VITAMINA C'),
(2, 'CONSENTIMIENTO INFORMADO MESOTERAPIA, FOSFA E HIDRO'),
(3, 'CONSENTIMIENTO INFORMADO ac, hialuronico , botox , rinomodelacion'),
(4, 'CONSENTIMIENTO INFORMADO REDUCTOR'),
(5, 'CONSENTIMIENTO INFORMADO TRATAMIENTO IPL-PEELENG-DERMO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE `cotizacion` (
  `idcotizacion` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idpaciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`idcotizacion`, `fecha`, `idpaciente`) VALUES
(4, '2019-01-24 16:49:51', 9),
(5, '2019-01-24 16:50:58', 9),
(6, '2019-01-24 17:59:17', 17),
(7, '2019-01-25 16:26:22', 18),
(8, '2019-01-31 12:10:41', 1000),
(9, '2019-01-31 12:25:35', 1),
(10, '2019-01-31 12:32:17', 14),
(11, '2019-01-31 12:36:20', 1),
(12, '2019-01-31 12:43:48', 16),
(16, '2019-01-31 14:47:46', 3),
(17, '2019-02-04 15:28:30', 1003);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacionconsetimeinto`
--

CREATE TABLE `cotizacionconsetimeinto` (
  `idconsetimiento` int(11) NOT NULL,
  `idcotizacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cotizacionconsetimeinto`
--

INSERT INTO `cotizacionconsetimeinto` (`idconsetimiento`, `idcotizacion`) VALUES
(1, 6),
(2, 9),
(2, 16),
(4, 6),
(4, 7),
(4, 17),
(5, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacionlaboratorio`
--

CREATE TABLE `cotizacionlaboratorio` (
  `idcotizacion` int(11) DEFAULT NULL,
  `idlaboratorio` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `diagnostico` varchar(255) DEFAULT NULL,
  `otros` varchar(255) DEFAULT NULL,
  `indicaciones` varchar(255) DEFAULT NULL,
  `idcotizacionlaboratorio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cotizacionlaboratorio`
--

INSERT INTO `cotizacionlaboratorio` (`idcotizacion`, `idlaboratorio`, `fecha`, `diagnostico`, `otros`, `indicaciones`, `idcotizacionlaboratorio`) VALUES
(9, 1, '2019-01-31 14:33:21', '', '', '', 1),
(9, 3, '2019-01-31 14:33:21', '', '', '', 2),
(9, 1, '2019-01-31 14:34:21', 'sida', 'no', 'tomar en cuenta la columna', 3),
(9, 2, '2019-01-31 14:34:21', 'sida', 'no', 'tomar en cuenta la columna', 4),
(9, 25, '2019-01-31 14:34:21', 'sida', 'no', 'tomar en cuenta la columna', 5),
(9, 26, '2019-01-31 14:34:22', 'sida', 'no', 'tomar en cuenta la columna', 6),
(11, 1, '2019-01-31 14:40:33', 'sida', '', '', 7),
(11, 26, '2019-01-31 14:40:33', 'sida', '', '', 8),
(11, 16, '2019-01-31 14:41:12', '', '', '', 9),
(11, 1, '2019-01-31 14:41:21', '', '', '', 10),
(16, 1, '2019-01-31 14:48:12', '', '', '', 11),
(16, 2, '2019-01-31 14:48:12', '', '', '', 12),
(16, 12, '2019-01-31 14:48:12', '', '', '', 13),
(16, 13, '2019-01-31 14:48:13', '', '', '', 14),
(8, 1, '2019-01-31 15:51:48', '', '', '', 15),
(8, 7, '2019-01-31 15:51:48', '', '', '', 16),
(8, 19, '2019-01-31 15:51:48', '', '', '', 17),
(8, 5, '2019-01-31 15:52:32', '', '', '', 18),
(8, 6, '2019-01-31 15:52:32', '', '', '', 19),
(8, 7, '2019-01-31 15:52:50', '', '', '', 20),
(9, 25, '2019-01-31 17:23:11', '', '', '', 21),
(6, 20, '2019-01-31 17:23:37', '', '', '', 22),
(6, 23, '2019-01-31 17:25:23', '', '', '', 23),
(17, 1, '2019-02-04 15:35:06', '', '', '', 24),
(17, 4, '2019-02-04 15:35:06', '', '', '', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciontratamiento`
--

CREATE TABLE `cotizaciontratamiento` (
  `idcotizacion` int(11) NOT NULL,
  `idtratamiento` int(11) NOT NULL,
  `n` varchar(255) NOT NULL,
  `tiempo` varchar(255) NOT NULL,
  `costo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cotizaciontratamiento`
--

INSERT INTO `cotizaciontratamiento` (`idcotizacion`, `idtratamiento`, `n`, `tiempo`, `costo`) VALUES
(5, 1, '10', '20', '30'),
(5, 2, '10', '10', ''),
(5, 3, '', '25', '20'),
(5, 4, '10', '20', '30'),
(6, 1, '10', '20', '30'),
(6, 2, '10', '10', '10'),
(6, 5, '10', '20', '30'),
(6, 6, '10', '10', '10'),
(7, 1, '2', '10', '50'),
(7, 3, '2', '10', '20'),
(7, 4, '2', '10', '20'),
(8, 1, '2', '10', '200'),
(9, 1, '2', '10', '20'),
(9, 2, '1', '10', '30'),
(10, 1, '10', '1', '10'),
(11, 2, '2', '2', '20'),
(11, 3, '1', '1', '10'),
(12, 1, '10', '10', '30'),
(16, 1, '10', '10', '30'),
(17, 2, '2', '7', '280'),
(17, 17, '2', '1', '380'),
(17, 20, '1', '1', '300');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `idreceta` int(11) DEFAULT NULL,
  `idmedicamento` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `title` text,
  `uid` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`id`, `start`, `end`, `title`, `uid`) VALUES
(2, '2019-01-31 07:30:00', '2019-01-31 08:00:00', 'asdsaaaa', '1'),
(3, '2019-02-01 08:00:00', '2019-02-01 08:30:00', 'asdsa', '1'),
(4, '2019-01-30 07:30:00', '2019-01-30 08:00:00', 'adimer', '1'),
(5, '2019-02-01 09:30:00', '2019-02-01 11:30:00', 'asdsa', '1'),
(7, '2019-01-31 11:30:00', '2019-01-31 12:00:00', 'jose jose', '1'),
(8, '2019-01-30 14:30:00', '2019-01-30 15:00:00', 'asdsa', '1'),
(9, '2019-01-29 06:00:00', '2019-01-29 06:30:00', 'asdsadsa', '1'),
(11, '2019-01-31 08:00:00', '2019-01-31 08:30:00', 'adimer', '1'),
(12, '2019-01-29 08:00:00', '2019-01-29 08:30:00', 'jpose', '1'),
(14, '2019-02-05 11:30:00', '2019-02-05 12:00:00', 'deysi poma', '1'),
(15, '2019-02-05 12:00:00', '2019-02-05 12:30:00', 'jose manuel', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto`
--

CREATE TABLE `foto` (
  `idfoto` int(11) NOT NULL,
  `idcotizacion` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `foto`
--

INSERT INTO `foto` (`idfoto`, `idcotizacion`, `fecha`) VALUES
(1, 2, '2019-01-09 22:13:13'),
(2, 2, '2019-01-09 22:15:26'),
(3, 2, '2019-01-09 22:17:57'),
(4, 2, '2019-01-09 22:20:48'),
(5, 2, '2019-01-09 22:31:53'),
(7, 2, '2019-01-09 22:33:03'),
(8, 1, '2019-01-09 22:37:45'),
(9, 7, '2019-01-25 16:31:51'),
(10, 8, '2019-01-31 12:10:54'),
(11, 8, '2019-01-31 12:24:24'),
(12, 9, '2019-01-31 12:25:44'),
(13, 9, '2019-01-31 12:26:53'),
(14, 9, '2019-01-31 12:27:34'),
(15, 10, '2019-01-31 12:32:32'),
(16, 10, '2019-01-31 12:32:59'),
(17, 11, '2019-01-31 12:36:29'),
(18, 11, '2019-01-31 12:37:58'),
(19, 6, '2019-01-31 12:42:37'),
(20, 6, '2019-01-31 12:42:44'),
(21, 6, '2019-01-31 12:42:47'),
(22, 6, '2019-01-31 12:43:14'),
(23, 17, '2019-02-04 15:42:01'),
(24, 17, '2019-02-04 15:42:32'),
(25, 17, '2019-02-04 15:45:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `idpaciente` int(11) NOT NULL,
  `consulta` varchar(255) DEFAULT NULL,
  `pa` varchar(255) DEFAULT NULL,
  `fc` varchar(255) DEFAULT NULL,
  `peso` varchar(255) DEFAULT NULL,
  `talla` varchar(255) DEFAULT NULL,
  `imc` varchar(255) DEFAULT NULL,
  `gc` varchar(255) DEFAULT NULL,
  `diabetes` varchar(255) DEFAULT NULL,
  `hta` varchar(255) DEFAULT NULL,
  `cardios` varchar(255) DEFAULT NULL,
  `cancer` varchar(255) DEFAULT NULL,
  `quefamilia` varchar(255) DEFAULT NULL,
  `estadocivil` varchar(255) DEFAULT NULL,
  `ocupacion` varchar(255) DEFAULT NULL,
  `fuma` varchar(255) DEFAULT NULL,
  `bebe` varchar(255) DEFAULT NULL,
  `actividadfisica` varchar(255) DEFAULT NULL,
  `sueno` varchar(255) DEFAULT NULL,
  `alimentos` varchar(255) DEFAULT NULL,
  `diuresis` varchar(255) DEFAULT NULL,
  `catarsis` varchar(255) DEFAULT NULL,
  `patologico` varchar(255) DEFAULT NULL,
  `alergias` varchar(255) DEFAULT NULL,
  `tratamientos` varchar(255) DEFAULT NULL,
  `estadopsicologico` varchar(255) DEFAULT NULL,
  `fum` varchar(255) DEFAULT NULL,
  `dias` varchar(255) DEFAULT NULL,
  `frecuencia` varchar(255) DEFAULT NULL,
  `caracteristica` varchar(255) DEFAULT NULL,
  `gestas` varchar(255) DEFAULT NULL,
  `partos` varchar(255) DEFAULT NULL,
  `ab` varchar(255) DEFAULT NULL,
  `cesareas` varchar(255) DEFAULT NULL,
  `lactancia` varchar(255) DEFAULT NULL,
  `nhijos` varchar(255) DEFAULT NULL,
  `menopausia` varchar(255) DEFAULT NULL,
  `pap` varchar(255) DEFAULT NULL,
  `anticonceptivos` varchar(255) DEFAULT NULL,
  `examenmamario` varchar(255) DEFAULT NULL,
  `ptsimamaria` varchar(255) DEFAULT NULL,
  `cremas` varchar(255) DEFAULT NULL,
  `cutis` varchar(255) DEFAULT NULL,
  `donde` varchar(255) DEFAULT NULL,
  `queutilizaron` varchar(255) DEFAULT NULL,
  `sol` varchar(255) DEFAULT NULL,
  `solar` varchar(255) DEFAULT NULL,
  `otros` varchar(255) DEFAULT NULL,
  `alopecia` varchar(255) DEFAULT NULL,
  `depilacion` varchar(255) DEFAULT NULL,
  `piel` varchar(255) DEFAULT NULL,
  `biotipo` varchar(255) DEFAULT NULL,
  `arrugas` varchar(255) DEFAULT NULL,
  `referencia` varchar(255) NOT NULL,
  `unas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`idpaciente`, `consulta`, `pa`, `fc`, `peso`, `talla`, `imc`, `gc`, `diabetes`, `hta`, `cardios`, `cancer`, `quefamilia`, `estadocivil`, `ocupacion`, `fuma`, `bebe`, `actividadfisica`, `sueno`, `alimentos`, `diuresis`, `catarsis`, `patologico`, `alergias`, `tratamientos`, `estadopsicologico`, `fum`, `dias`, `frecuencia`, `caracteristica`, `gestas`, `partos`, `ab`, `cesareas`, `lactancia`, `nhijos`, `menopausia`, `pap`, `anticonceptivos`, `examenmamario`, `ptsimamaria`, `cremas`, `cutis`, `donde`, `queutilizaron`, `sol`, `solar`, `otros`, `alopecia`, `depilacion`, `piel`, `biotipo`, `arrugas`, `referencia`, `unas`) VALUES
(1, 'xx', 'xx', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', 'XX', '', ''),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(4, '', '10', '10', '10', '10', '10', '10', '', 'on', '', 'on', 'padre', 'casado', 'talar piedra', 'si', 'si', 'no', '8 horas', '', 'no', 'no', 'patologico', 'no', 'no', 'muy bien', '10', '10', '10', '10', '10', '10', '10', '10', '10', '10', '10', '10', 'nop', 'no', '', 'bagon', 'no', 'espalda', 'sastre', 'nop', 'no', 'no', 'no', 'sin depilar', 'Tipo II', 'muy buena', 'no', '', ''),
(7, 'calle bolivar', '20', '20', '20', '20', '20', '20', 'on', 'on', '', 'on', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(9, 'nada en comun', '30', '30', '30', '30', '30', '30', 'on', 'on', 'on', 'on', 'tio', 'soltera', 'cocinera', 'no', 'no', 'cocina', '8 horas', 'pan', 'no', 'no', 'no hay patologias', 'no', 'ninguno', 'todo blu', '30', '30', '30', '30', '30', '30', '30', '30', '30', '30', '30', '30', 'no', 'no', 'no', 'bagon', 'no', 'espalda', 'sastre', 'nop', 'no', 'no', 'no', 'sin depilar', 'Tipo II', 'muy buena', 'no', '', ''),
(14, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(15, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'no', 'no', '', 'no', '', '', '', '', '', 'no', '', 'Tipo I', '', '', '', ''),
(16, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'no', 'no', '', 'no', '', '', '', '', '', 'no', '', 'Tipo I', '', '', '', ''),
(17, 'mucho reniega', '20', '30', '56', '80', '20', '30', '1', '', '', '', 'TIA', 'SOLTERA', 'COCINERA', 'SI', 'NO', 'futsala', '8', 'fruta', '50', '20', 'alergica a la lavar mucha ropa se le cae lapiel', 'no', 'dentista', 'amor de gente', '10', '20', '20', 'nada', '1', '1', '1', 'no', 'no', '54', 'no', 'no', 'si', 'no', 'no', 'nivea', 'si', 'en la cabeza', 'nada', 'si', 'si', '', 'no', 'la cabeza', 'Tipo III', '', '', '', ''),
(18, 'acne', '10', '20', '20', '23', '12', '12', '', '1', '', '', 'tia', 'soltera', 'sastre', 'no', 'no', '', '8 horas', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'no', 'no', '', 'no', '', '', '', '', '', 'no', '', 'Tipo I', '20', 'describir', '', ''),
(1000, 'dolor de espalda', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'no', 'no', '', 'no', '', '', '', '', '', 'no', '', 'Tipo I', '', '', '', ''),
(1001, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(1002, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(1003, 'aumento de peso', '', '', '74.2', '1.57', '30', '33.5', '1', '', '', '', 'madre', 'Casado', 'labores de casa', 'si', 'si', 'no', 'insomnio', 'no desayuna', 'oscuras', 'estreñida', 'Migraña', 'al polvo', 'ninguno', 'le afecta', '05/01/2019', '4', 'irregular', 'doloroso', '1', '0', '0', '1', 'si', '2', 'no', 'no', 'implante', 'si', 'no', '', 'no', '', '', 'poco', 'si', '', 'si', 'no', 'Tipo IV', 'mixto', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE `laboratorio` (
  `idlaboratorio` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `idtipolaboratorio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `laboratorio`
--

INSERT INTO `laboratorio` (`idlaboratorio`, `nombre`, `idtipolaboratorio`) VALUES
(1, 'HERMOGRAMA COMPLETO', 1),
(2, 'TIEMPO COAGULACIONJ Y SANGRE', 1),
(3, 'RECUENTO DE PLAQUETAS', 1),
(4, 'GLUSOCA', 2),
(5, 'UREA', 2),
(6, 'CREATINA', 2),
(7, 'ACIDO URICO', 2),
(8, 'TRANSAMINASAS(GOT-GPT)', 2),
(9, 'LDH', 2),
(10, 'BILIRRUBINAS(D.I.T.)', 2),
(11, 'FOSFATASA ALCALINA', 2),
(12, 'FOFATASA ACIDA', 2),
(13, 'COLESTEROL TOTAL', 2),
(14, 'TRIGLICERIDOS', 2),
(15, 'T3 TOTAL', 3),
(16, 'T4 TOTAL', 3),
(17, 'TSH', 3),
(18, 'TESTOTERONNA', 3),
(19, 'PCR (PROTEINA REACTIVA)', 4),
(20, 'HIV-AIDS', 4),
(21, 'CLAMIDIA', 4),
(22, 'COPROPARASITOLOGICO(1 MUESTRA)', 5),
(23, 'COPROPARASITOLOGICO SERIADO(3 MUESTRAS)', 5),
(24, 'LEUCOCITOS y PIOCITOS', 5),
(25, 'EXAMEN GENERAL DE ORINA', 6),
(26, 'CULTIVO Y ANTIBIOGRAMA', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamento`
--

CREATE TABLE `medicamento` (
  `idmedicamento` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `idpaciente` int(11) NOT NULL,
  `ci` varchar(255) NOT NULL,
  `nombres` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `zona` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `fechanac` date DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `celular` varchar(255) NOT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `exp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`idpaciente`, `ci`, `nombres`, `apellidos`, `zona`, `direccion`, `fechanac`, `telefono`, `celular`, `idusuario`, `exp`) VALUES
(1, '', 'ADIMER', 'CHAMBI AJATA', 'sud', 'calle x y españa', '2000-01-09', NULL, '', 1, ''),
(3, '', 'PEDRO ', 'CALLE LOPEZ', 'norte', 'avenida españa', '2000-01-09', NULL, '', 1, ''),
(4, '', 'PEDRO', 'PICAPIERDA', 'SUD', 'tratamiento de cadera', '2000-01-16', '5261245', '', 1, ''),
(7, '', 'ANACLETO', 'VELAZQUES', 'sud', 'calle x y españa', '2000-01-23', '5261245', '5861245', 1, ''),
(9, '', 'NELLY', 'ZURITA', 'sud', 'calle corque', '2000-01-23', '5261245', '68702443', 1, ''),
(14, '', 'JUAN', 'PEREZ', 'sud', 'calle x y españa', '1990-01-23', '5261245', '69603145', 1, ''),
(15, '', 'ANDRU', 'MAQUINA', 'sud', 'calle bolivar y españa', '1998-01-23', '52315', '5261245', 1, ''),
(16, '', 'PORSHAN', 'CALLE', 'norte', 'calle bolivar y españa', '1989-01-23', '526124', '5261245', 1, ''),
(17, '7457785', 'NELLY', 'ZURITA', 'SUD', 'circunvalacion tarija # 52', '1992-08-04', '5261245', '68702443', 1, ''),
(18, '606060', 'PEDRO', 'GEBARA', 'sud', 'calle bolivar y españa', '1990-01-25', '5261245', '606060', 1, ''),
(1000, '3030', 'ANA', 'BANANA', 'sud', '5261245', '2000-01-31', '5261245', '69603027', 1, ''),
(1001, '', '', '', '123456', '', '0000-00-00', '', '', 1, ''),
(1002, '', '', '', '123456', '', '0000-00-00', '', '', 1, ''),
(1003, '', 'DEYSI', 'POMA TORREZ', '', '', '2019-02-04', '', '72330968', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta`
--

CREATE TABLE `receta` (
  `idreceta` int(11) NOT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `idcotizacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipolaboratorio`
--

CREATE TABLE `tipolaboratorio` (
  `idtipolaboratorio` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipolaboratorio`
--

INSERT INTO `tipolaboratorio` (`idtipolaboratorio`, `nombre`) VALUES
(1, 'HEMATOLOGIA'),
(2, 'QUIMICA SANGUINEA'),
(3, 'HORMONAS'),
(4, 'INMUNOLOGIA'),
(5, 'COPROLOGIA'),
(6, 'URIANALISIS'),
(7, 'BACTERIOLOGIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamiento`
--

CREATE TABLE `tratamiento` (
  `idtratamiento` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tratamiento`
--

INSERT INTO `tratamiento` (`idtratamiento`, `nombre`) VALUES
(1, 'Luz Pulsada Intensa '),
(2, 'Mesoterapia '),
(3, 'Peeleng '),
(4, 'Dermoabrasion con puntas diamante'),
(5, 'Mascara'),
(6, 'Plasma Rico en Plaquetas'),
(7, 'Radiofrecuencia Tripolar '),
(8, 'Relleno Ac. Hialuronico'),
(9, 'Toxina Botulinica'),
(10, 'Rinomodelación sin Cirugía'),
(11, 'Hilos PDO - COG'),
(12, 'Lipotransferencia'),
(13, 'MELA'),
(14, 'Celulas madre'),
(15, 'Megadosis Vitamina \"C\" Intravenosa'),
(16, 'terapia homeopatica'),
(17, 'ultracavitacion'),
(18, 'Lipolaser de diodo'),
(19, 'electroestimulacion'),
(20, 'hidrolipoclasia quimica'),
(21, 'Crema Exclusiva'),
(22, 'Protector Solar Médico'),
(23, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `email`, `password`, `tipo`, `nombre`) VALUES
(1, 'admin@gmail.com', '123456', 'ADMIN', 'ADIMER PAUL CHAMBI AJATA'),
(4, 'pedro@gmail.com', '123456', 'DOCTOR', 'PEDRO ZUARES'),
(5, 'allisonpaez@hotmail.com', '123456', 'DOCTOR', 'ALLISON PAEZ TROCHE');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consentimiento`
--
ALTER TABLE `consentimiento`
  ADD PRIMARY KEY (`idconsentimiento`);

--
-- Indices de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD PRIMARY KEY (`idcotizacion`),
  ADD KEY `idpaciente` (`idpaciente`);

--
-- Indices de la tabla `cotizacionconsetimeinto`
--
ALTER TABLE `cotizacionconsetimeinto`
  ADD PRIMARY KEY (`idconsetimiento`,`idcotizacion`),
  ADD KEY `idcotizacion` (`idcotizacion`);

--
-- Indices de la tabla `cotizacionlaboratorio`
--
ALTER TABLE `cotizacionlaboratorio`
  ADD PRIMARY KEY (`idcotizacionlaboratorio`),
  ADD KEY `idcotizacion` (`idcotizacion`),
  ADD KEY `idlaboratorio` (`idlaboratorio`);

--
-- Indices de la tabla `cotizaciontratamiento`
--
ALTER TABLE `cotizaciontratamiento`
  ADD PRIMARY KEY (`idcotizacion`,`idtratamiento`),
  ADD KEY `idtratamiento` (`idtratamiento`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD KEY `idreceta` (`idreceta`),
  ADD KEY `idmedicamento` (`idmedicamento`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`idfoto`),
  ADD KEY `idcotizacion` (`idcotizacion`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`idpaciente`);

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`idlaboratorio`),
  ADD KEY `tipolaboratorio` (`idtipolaboratorio`);

--
-- Indices de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  ADD PRIMARY KEY (`idmedicamento`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`idpaciente`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `receta`
--
ALTER TABLE `receta`
  ADD PRIMARY KEY (`idreceta`),
  ADD KEY `idcotizacion` (`idcotizacion`);

--
-- Indices de la tabla `tipolaboratorio`
--
ALTER TABLE `tipolaboratorio`
  ADD PRIMARY KEY (`idtipolaboratorio`);

--
-- Indices de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  ADD PRIMARY KEY (`idtratamiento`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `consentimiento`
--
ALTER TABLE `consentimiento`
  MODIFY `idconsentimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  MODIFY `idcotizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `cotizacionlaboratorio`
--
ALTER TABLE `cotizacionlaboratorio`
  MODIFY `idcotizacionlaboratorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `foto`
--
ALTER TABLE `foto`
  MODIFY `idfoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `idlaboratorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  MODIFY `idmedicamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `idpaciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- AUTO_INCREMENT de la tabla `receta`
--
ALTER TABLE `receta`
  MODIFY `idreceta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipolaboratorio`
--
ALTER TABLE `tipolaboratorio`
  MODIFY `idtipolaboratorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  MODIFY `idtratamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD CONSTRAINT `cotizacion_ibfk_1` FOREIGN KEY (`idpaciente`) REFERENCES `historial` (`idpaciente`);

--
-- Filtros para la tabla `cotizacionconsetimeinto`
--
ALTER TABLE `cotizacionconsetimeinto`
  ADD CONSTRAINT `cotizacionconsetimeinto_ibfk_1` FOREIGN KEY (`idconsetimiento`) REFERENCES `consentimiento` (`idconsentimiento`),
  ADD CONSTRAINT `cotizacionconsetimeinto_ibfk_2` FOREIGN KEY (`idcotizacion`) REFERENCES `cotizacion` (`idcotizacion`);

--
-- Filtros para la tabla `cotizacionlaboratorio`
--
ALTER TABLE `cotizacionlaboratorio`
  ADD CONSTRAINT `cotizacionlaboratorio_ibfk_1` FOREIGN KEY (`idcotizacion`) REFERENCES `cotizacion` (`idcotizacion`),
  ADD CONSTRAINT `cotizacionlaboratorio_ibfk_2` FOREIGN KEY (`idlaboratorio`) REFERENCES `laboratorio` (`idlaboratorio`);

--
-- Filtros para la tabla `cotizaciontratamiento`
--
ALTER TABLE `cotizaciontratamiento`
  ADD CONSTRAINT `cotizaciontratamiento_ibfk_1` FOREIGN KEY (`idcotizacion`) REFERENCES `cotizacion` (`idcotizacion`),
  ADD CONSTRAINT `cotizaciontratamiento_ibfk_2` FOREIGN KEY (`idtratamiento`) REFERENCES `tratamiento` (`idtratamiento`);

--
-- Filtros para la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD CONSTRAINT `detalle_ibfk_1` FOREIGN KEY (`idreceta`) REFERENCES `receta` (`idreceta`),
  ADD CONSTRAINT `detalle_ibfk_2` FOREIGN KEY (`idmedicamento`) REFERENCES `medicamento` (`idmedicamento`);

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`idpaciente`) REFERENCES `paciente` (`idpaciente`);

--
-- Filtros para la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD CONSTRAINT `laboratorio_ibfk_1` FOREIGN KEY (`idtipolaboratorio`) REFERENCES `tipolaboratorio` (`idtipolaboratorio`);

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `receta`
--
ALTER TABLE `receta`
  ADD CONSTRAINT `receta_ibfk_1` FOREIGN KEY (`idcotizacion`) REFERENCES `cotizacion` (`idcotizacion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
