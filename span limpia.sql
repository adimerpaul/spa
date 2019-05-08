-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2019 a las 00:59:05
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

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
  `nombre` varchar(255) DEFAULT NULL,
  `contenido` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `consentimiento`
--

INSERT INTO `consentimiento` (`idconsentimiento`, `nombre`, `contenido`) VALUES
(1, 'CONSENTIMIENTO INFORMADO PARA TRATAMIENTO MEDIANTE PLASMA RICO EN PLAQUETAS - MEGADOSIS VITAMINA C', 'Por el presente consiento que se me realice el procedimiento terapéutico indicado y aconsejado. Se me ha explicado la naturaleza y el objetivo del tratamiento, incluyendo riesgos leves y de gravedad en caso de no cuidarme y alternativas disponibles al tratamiento. Estoy satisfecho con esas explicaciones y las he comprendido.\r\nTambién consiento la realización de todo procedimiento o tratamiento adicional o alternativo que en opinión del Medico sean necesarios. Consiento la administración de aquellos anestésicos que puedan ser considerados necesarios o convenientes, comprendiendo que ello puede implicar ciertos riesgos de distinta envergadura. Además de consentir como la filmación o fotografía para fines comparativos.\r\n\"ESCENCIA SPA MEDICO\", me ha informado en qué consiste el tratamiento. Se me ha realizado una Historia Clínica para descartar patologías y riesgos, que impidan beneficiarme con éste tratamiento, confirmando que no padezco ninguna de las siguientes patologías motivo de contraindicación de la aplicación del tratamiento.\r\n*Embarazo y  Lactancia \r\n*Inmunosupresión , Patología tumoral , Epilepsia convulsiones, deficiencias de coagulación.\r\n*Sitios de infección local activa , Inflamación local activa\r\n*Alergias \r\n*Ingesta de alcohol en la última semana antes del tratamiento. \r\n*Ingesta de Aspirina o antiinflamatorios, o encontrarme con tratamiento antibiótico en la última semana previa al tratamiento\r\n*Enfermedades del corazón,\r\n*Cirugías recientes o próximas al tratamiento excepto para el caso de la megadosis de vitamina C\r\nPROCEDIMIENTO.- Técnica ambulatoria que consiste: paciente en decúbito dorsal se le aplica en la zona a tratar una crema anestésica dejándola que actúe unos minutos, tiempo en el que permanece tranquilamente relajado. Luego se extrae entre 5ml para el plasma superficial y entre 20 y 25ml de sangre venosa del mismo paciente para el caso del plasma profundo, la que se coloca en tubos estériles a una centrifugadora por medio de la cual se separa el plasma de los glóbulos rojos y blancos. Se activa la fracción de plasma a utilizar, al ser retirado el plasma de los tubos en jeringas pre cargadas con el activador. Una vez conseguido el plasma rico en factores de crecimiento se introduce en la dermis mediante inyecciones superficiales intradérmicas superficial o nappage, subcutánea se aplica  con una aguja hipodérmica, haciendo pequeños y múltiples micro inyecciones en la zona a tratar.\r\nPara el caso de la megadosis de vitamina C solamente me colocarán una vía endovenosa en el antebrazo por el lapso de media a una hora donde ingresará la vitamina c y el suero. Para el caso de células madre además deberé firmar un consentimiento adicional.\r\nSe me ha informado que puedo sentir un ligero malestar, dependiendo de mi umbral de dolor. Irritación, Enrojecimiento, Hipersensibilidad en la piel tratada Inflamación,  Picazón, molestias en la piel aparición de hematomas y que según el procedimiento, la duración puede variar , generalmente  de media a una hora, luego de la cual el paciente puede regresar sin problemas a casa siguiendo las indicaciones posteriores. La cantidad de sesiones está en relación directa con el efecto que quiera obtenerse normalmente se requieren de 2 a más sesiones, por lo tanto hago entender que no necesitaré firmar un consentimiento informado en cada sesión, sobreentendiendo que el primero es válido para todas las sesiones que voluntariamente solicite.\r\nCUIDADOS POSTERIORES.-\r\n*Evitar la  exposición al sol, cama solar o cualquier fuente de calor externo (saunas, horno, estufas, radiación solar).\r\n*Utilizar protector solar  FPS mayor 45 cada 2hrs\r\n*No Depilar  o  afeitar  la zona tratada por 48hrs\r\n*Evitar realizar masajes, ejercicios violentos (Excepto plasma superficial y megadosis de vitamina C), natación, baños de inmersión o sauna, ya que estos generan vasodilatación e infección por el lapso de 72Hrs\r\n*No consumir bebidas alcohólicas 72 Hrs, no comidas picantes o muy condimentadas, no gaseosas ni dulces.\r\n*Dejo constancia además de que comunicaré al profesional encargado, cualquier molestia o reacción posterior a la sesión.\r\n*Control Médico en 48 hrs.\r\nHe comprendido, todas las explicaciones otorgadas en lenguaje sencillo y claro, el profesional que me ha atendido me han permitido realizar todas las observaciones y me aclaró dudas planteadas.\r\nPor ello manifiesto que estoy satisfecho(a) con la información recibida y que comprendo el alcance y riesgos del tratamiento libremente y en tales condiciones.\r\n\r\n\r\n'),
(2, 'CONSENTIMIENTO INFORMADO MESOTERAPIA, FOSFA E HIDRO', 'aaaa'),
(3, 'CONSENTIMIENTO INFORMADO ac, hialuronico , botox , rinomodelacion', ''),
(4, 'CONSENTIMIENTO INFORMADO REDUCTOR', ''),
(5, 'CONSENTIMIENTO INFORMADO TRATAMIENTO IPL-PEELENG-DERMO', ' “ESCENCIA SPA MEDICO”, me ha informado en que consiste el tratamiento con Luz Pulsada Intensa (IPL) – Peeleng Facial – Dermoabrasión con puntas de Diamantes. Se me ha realizado una Historia Clínica para descartar patologías y otros, que me impidan beneficiarme con éste tratamiento, también consiento cualquier tratamiento adicional o alternativo que en opini´n de mi médico tratante sugiera. Así mismo autorizo para que se tomen fotografías del antes de mi tratamiento, durante y después, para fines comparativos. \r\nSiendo mi firma al pie de éste documento, la confirmación de que no padezco ninguna de las siguientes patologías motivo de contraindicación.\r\n?	No estoy tomando, ni he tomado isotretinoina, acitetrina, vitamina A o ácido cis-retinoico, en altas dosis, en caso afirmativo se me ha informado que debo esperar por lo menos 4 meses antes del tratamiento.\r\n?	No he usado cremas que contengan ácido glicólico o retinoico ayer ni hoy, tampoco puedo usarlas 72 horas después del tratamiento.\r\n?	No estoy embarazada, ni dando de lactar.\r\n?	No sufro de epilepsia.\r\n?	No estoy en proceso de Herpes Simplex.\r\n?	No tengo fiebre, ni infección aguda.\r\n?	No padezco de ninguna infección dermatológica en éste momento (dermatitis), ni sospecha de cáncer de piel.\r\n?	No padezco de Diabetes Mellitus complicada.\r\n?	No estoy en tratamiento con antibióticos u otros tratamientos que produzcan fotosensibilidad (hipoglucemiantes orales, clordiazpoxido, griseofulvina,  ciprofloxacino, ácido nalidixico, psoralenos, diuréticos tiazídicos, antimaláricos, difenhidramina, isoniazida, noretinodrel, sulfamidas, vacuna antisarampión, barbitúricos, fenotiazidas, mestranol, sales de oro o tetraciclinas.\r\n?	No he tomado sol ni rayos UVA (bronceado en cama solar), 30 días antes del tratamiento.\r\n\r\nPROCEDIMIENTO.- Se me colocará un protector ocular en el caso de la luz pulsada intensa para resguardarme de la luz láser durante el procedimiento. Se apoyará el cabezal láser sobre mi piel con gel y con cada pulsación se me ha informado de que puedo sentir un ligero malestar, dependiendo de mi umbral de dolor. En el caso del peeleng se aplicará un ácido de acuerdo a mi patología sobre la cara que puede ser superficial, medio o profundo, durante un tiempo controlado por el médico tratante. Para la dermoabrasión con puntas de diamantes se aplicará un dispositivo que pule y absorbe mis células muertas de la piel, de igual manera durante un tiempo determinado. Se me ha informado de que según el procedimiento, la duración puede variar entre 2 minutos y 1 hora dependiendo de la zona a tratar. También tengo conocimiento de que será necesario como un  mínimo de 5 sesiones a más, para conseguir mi propósito, por lo tanto hago entender que no necesitaré firmar un consentimiento informado en cada sesión, sobreentendiendo que el primero es válido para todas las sesiones que voluntariamente solicite.\r\n\r\nCUIDADOS POSTERIORES.- Después de realizada la sesión y durante los siguientes 30 días, no me  expondré a los rayos solares de forma directa ni prolongada, usaré protector solar mayor a 45 FPS. Dejo constancia además de que comunicaré al profesional encargado, cualquier molestia o reacción posterior a la sesión.\r\n\r\nHe comprendido, todas las explicaciones otorgadas en lenguaje sencillo y claro, el profesional que me ha atendido me permitió realizar todas las observaciones y me aclaró dudas planteadas.\r\nTambién comprendo que en cualquier momento y sin necesidad de dar ninguna explicación, puedo cancelar el consentimiento que ahora presto.\r\nPor ello manifiesto que estoy satisfecho(a) con la información recibida y que comprendo el alcance y riesgos del tratamiento libremente y en tales condiciones.\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consulta`
--

CREATE TABLE `consulta` (
  `idconsulta` int(11) NOT NULL,
  `motivo` varchar(200) NOT NULL,
  `cot` varchar(200) NOT NULL,
  `ref` varchar(200) NOT NULL,
  `idmonto` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corporal`
--

CREATE TABLE `corporal` (
  `idcorporal` int(11) NOT NULL,
  `tratamiento` varchar(200) NOT NULL,
  `obs` varchar(200) NOT NULL,
  `cub` varchar(200) NOT NULL,
  `idmonto` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE `cotizacion` (
  `idcotizacion` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idhistorial` int(11) NOT NULL,
  `diagnostico` varchar(255) NOT NULL,
  `programa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacionconsetimeinto`
--

CREATE TABLE `cotizacionconsetimeinto` (
  `idconsetimiento` int(11) NOT NULL,
  `idcotizacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `idfactura` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` float NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deudas`
--

CREATE TABLE `deudas` (
  `iddeudas` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comprador` varchar(85) NOT NULL,
  `detalle` varchar(150) NOT NULL,
  `celular` varchar(85) NOT NULL,
  `monto` float NOT NULL,
  `idusuario` int(11) NOT NULL DEFAULT '1',
  `tipo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `deudas`
--

INSERT INTO `deudas` (`iddeudas`, `fecha`, `comprador`, `detalle`, `celular`, `monto`, `idusuario`, `tipo`) VALUES
(6, '2019-04-29 19:07:15', 'adimer', 'adelanto meso', '5261245', 120, 1, 'ADELANTO'),
(7, '2019-04-29 19:08:07', 'adimer', 'adelnato sofware', '', 150, 1, 'PAGO DEUDA'),
(8, '2019-04-30 17:17:40', 'JOSe', 'pago de agua', '', 100, 1, 'PAGO DEUDA'),
(9, '2019-05-06 16:20:58', 'LA LUZ', 'PAGO DE LUZ', '', 100, 1, 'PAGO DEUDA'),
(10, '2019-05-06 16:21:35', 'DON DANIEL', 'adelanto meso', '', 100, 1, 'ADELANTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dosificacion`
--

CREATE TABLE `dosificacion` (
  `iddosificacion` int(11) NOT NULL,
  `nrotramite` text NOT NULL,
  `nroautorizacion` text NOT NULL,
  `nrofacturai` int(11) NOT NULL,
  `llave` varchar(255) NOT NULL,
  `desde` date NOT NULL,
  `hasta` date NOT NULL,
  `leyenda` varchar(255) NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dosificacion`
--

INSERT INTO `dosificacion` (`iddosificacion`, `nrotramite`, `nroautorizacion`, `nrofacturai`, `llave`, `desde`, `hasta`, `leyenda`, `estado`) VALUES
(3, '400001984457', '332401900008210', 1, '38@#I#(Z95qd-@=2ja2JLFUUN)G6GBWCZE#-SVEDHgtQBh@qV_UHPqXSEvnCZJBB', '2019-04-24', '2020-04-24', 'LEY Ley N° 453: Tienes derecho a un trato equitativo sin discriminacion en la oferta de servicios.', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egreso`
--

CREATE TABLE `egreso` (
  `idegreso` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `monto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idtratamiento` int(11) NOT NULL DEFAULT '24'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `egreso`
--

INSERT INTO `egreso` (`idegreso`, `fecha`, `monto`, `idusuario`, `idtratamiento`) VALUES
(1, '2019-04-30 17:38:31', 50, 1, 24),
(2, '2019-04-30 17:39:59', 150, 1, 24),
(3, '2019-04-30 17:55:56', 50, 1, 29),
(4, '2019-05-06 16:15:50', 100, 1, 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `idusuario` int(100) DEFAULT NULL,
  `idpaciente` int(11) NOT NULL DEFAULT '1',
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facial`
--

CREATE TABLE `facial` (
  `idfacial` int(11) NOT NULL,
  `tratamiento` varchar(200) NOT NULL,
  `obs` varchar(200) NOT NULL,
  `cub` varchar(200) NOT NULL,
  `idmonto` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idfactura` int(11) NOT NULL,
  `idpaciente` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` float NOT NULL,
  `codigocontrol` varchar(20) NOT NULL,
  `iddosificacion` int(11) NOT NULL,
  `nrofactura` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(28, 31, '2019-03-26 18:02:46'),
(29, 31, '2019-03-26 18:24:24'),
(30, 31, '2019-03-26 18:26:51'),
(31, 49, '2019-04-08 17:24:47'),
(32, 59, '2019-04-15 18:11:35'),
(33, 65, '2019-04-29 18:02:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `idhistorial` int(11) NOT NULL,
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
  `unas` varchar(255) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `idingreso` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idusuario` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL DEFAULT 'ENTRADA'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ingreso`
--

INSERT INTO `ingreso` (`idingreso`, `fecha`, `idusuario`, `tipo`) VALUES
(1, '2019-04-29 19:25:23', 1, 'ENTRADA'),
(3, '2019-04-29 19:26:40', 1, 'SALIDA'),
(4, '2019-04-29 19:26:57', 1, 'ENTRADA'),
(5, '2019-04-30 16:01:14', 1, 'ENTRADA'),
(6, '2019-04-30 19:18:01', 1, 'SALIDA'),
(7, '2019-04-30 19:18:05', 1, 'ENTRADA'),
(8, '2019-05-02 11:47:49', 3, 'ENTRADA'),
(9, '2019-05-02 15:51:41', 1, 'ENTRADA'),
(10, '2019-05-02 16:40:21', 1, 'ENTRADA'),
(11, '2019-05-02 16:51:10', 3, 'ENTRADA'),
(12, '2019-05-06 15:57:18', 1, 'ENTRADA'),
(13, '2019-05-06 16:47:11', 1, 'ENTRADA'),
(14, '2019-05-06 17:01:24', 3, 'ENTRADA'),
(15, '2019-05-08 18:47:10', 1, 'ENTRADA');

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
-- Estructura de tabla para la tabla `medida`
--

CREATE TABLE `medida` (
  `idmedida` int(11) NOT NULL,
  `papada` varchar(45) NOT NULL,
  `brazosd1` varchar(45) NOT NULL,
  `espaldaalta` varchar(45) NOT NULL,
  `espaldabaja` varchar(45) NOT NULL,
  `cintura` varchar(45) NOT NULL,
  `ombligo` varchar(45) NOT NULL,
  `cm2` varchar(45) NOT NULL,
  `cm4` varchar(45) NOT NULL,
  `cadera` varchar(45) NOT NULL,
  `muslo` varchar(45) NOT NULL,
  `idcotizacion` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medida`
--

INSERT INTO `medida` (`idmedida`, `papada`, `brazosd1`, `espaldaalta`, `espaldabaja`, `cintura`, `ombligo`, `cm2`, `cm4`, `cadera`, `muslo`, `idcotizacion`, `fecha`) VALUES
(8, '15/45', '15/45', '', '', '94/92', '', '', '', '', '', 49, '2019-04-08 17:30:44'),
(9, '', '15/45', '', '', '93/92', '', '', '', '', '', 49, '2019-04-08 17:30:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `montos`
--

CREATE TABLE `montos` (
  `idmonto` int(11) NOT NULL,
  `monto` float NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idcotizacion` int(11) NOT NULL,
  `idtratamiento` int(11) DEFAULT NULL,
  `obs` varchar(200) NOT NULL,
  `cub` varchar(200) NOT NULL,
  `idusuario` int(11) NOT NULL DEFAULT '1'
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
  `exp` varchar(255) NOT NULL,
  `referencia` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL,
  `nombre` varchar(55) NOT NULL,
  `precio` float NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `nombre`, `precio`, `stock`) VALUES
(1, 'NEUROVIRIL', 150, 96),
(3, 'MENTISAN', 20, 0),
(5, 'PROTECTOR SOLAR COREANO', 160, 36),
(6, 'PROTECTOR SOLAR VEGANO', 230, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reactivo`
--

CREATE TABLE `reactivo` (
  `idreactivo` int(11) NOT NULL,
  `nombre` varchar(55) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `presentacion` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reactivo`
--

INSERT INTO `reactivo` (`idreactivo`, `nombre`, `cantidad`, `presentacion`) VALUES
(1, 'FOSFATIDILCOLINA 5% ', 500, '10ml'),
(2, 'L-Carnitina 20% ph7 ', 20, '20ML'),
(3, 'YOHIMBINA 0.5% PH 4-5 ', 20, '10ML'),
(5, 'Triac 0.035% pH 8-9 ', 20, '10ML'),
(7, 'green tea 5% pH6 ', 15, '10ML'),
(8, 'Cynara Scolimus pH6 ', 15, '10ML'),
(9, 'Blufomedilo 100mg pH6 ', 15, '10ML'),
(10, 'Lipasa ', 15, '10ML'),
(11, 'Aminofilina ', 15, '10ML'),
(12, 'ADN 2,5% ', 15, '10ML'),
(13, 'Acido Lactobionico 0.1 % pH 6  ', 15, '10ML'),
(14, 'Acido Mandélico 0.01%- pH 6-7  ', 15, '10ML'),
(15, 'Acido Retinoico 0.1%- pH 8,5-9,5  ', 10, '10ML'),
(16, 'Emblica 3% ', 10, '10ML'),
(17, 'Melatonina 3mcg ', 10, '10ml'),
(18, 'Glicólico 0,01% ', 10, '10ML'),
(19, 'Ac. Azelaico  2% ', 15, '10ML'),
(20, 'Acido Kójico 0.1% pH 5-5.6 ', 15, '10ML'),
(21, 'UFA 0,2% Ph6 ', 10, '10ML'),
(22, 'Idebenona ', 10, '10ML'),
(23, 'Ac. Fítico 0.1% pH 5-6 ', 15, '10ML'),
(24, 'Finasteride 3mg + Minoxidil 0.1 g+ Buflomedilo 1% + Pro', 10, '10ML'),
(25, 'Minoxidil 0.2g + Biotina 0.005g+Pantenol 1g pH 7.5-8 ', 10, '10ML'),
(26, 'coenzima q10 0,02% ', 10, '10ML'),
(27, 'Ac. Hialuronico 0.5% pH7 ', 15, '10ML'),
(28, 'Colágeno Hidrolizado 5% pH 6-7 ', 15, '10ML'),
(29, 'Elastina Hidrolizado 5% pH 6-7 ', 15, '10ML'),
(30, 'Selenio 0.002% pH 6.5-7 ', 10, '10ML'),
(31, 'Equisetum Arvense Ext. 5% pH6 ', 15, '10ML'),
(32, 'Vitamina C 20% pH 6-6.5 ', 15, '10ML'),
(33, 'Vitamina K 0.01% ', 10, '10ML'),
(34, 'Ampelopsina 1% ', 15, '10ML'),
(35, 'Silicio 3% ', 10, '10ML'),
(36, 'Cobre 0.025%+Magnesio 0.7%+Zinc 0.025% pH 5-6 ', 10, '10ML'),
(37, 'DMAE 400mg pH 6-7 ', 10, '10ML'),
(38, 'Hidroxiprolina 0.5% ', 15, '10ML'),
(39, 'Centella Asiática 5% pH 6-7 ', 20, '10ML'),
(40, 'Eritromicina 1% pH 6-7  ', 15, '10ML'),
(41, 'Clindamicina 0.1% ', 10, '10ML'),
(42, 'Isotetrinoína 0.1%  ', 20, '10ML'),
(43, 'Triamcinolona 0.12%- pH 7  ', 15, '10ML'),
(44, '5 FLUORACILO+ TRIAMCINOLONA ', 450, '5ML'),
(45, 'Procaina neutra ', 10, '5ML'),
(46, 'procaina acida ', 10, '10ML'),
(47, 'Cloruro de calcio 10% ', 20, '10ML'),
(48, 'Lidocaína 2% neutra c/epinefrina pH7 ', 10, '20ML'),
(49, 'Bicarbonato de sodio pH9 ', 10, '10ml'),
(50, 'Vitamina C cristales de ultrapureza ', 2, '50GR'),
(51, 'Crema Anestésica Antihematomas ', 6, '50ML'),
(52, 'Shampoo c/Ac. Salicílico y Urea ', 2, '1000ML'),
(53, 'Quick Fade ultrablanqueadora ', 15, '50ML'),
(54, 'Lactobionic ', 8, '50ML'),
(55, 'Crema hidroxiprolina, Dmae, Aceite de Argán ', 15, '50ML'),
(56, 'Gel Transductor', 9940, 'envase'),
(57, 'tubos citrato de sodio', 500, 'pza'),
(58, 'PUNTAS DERMAPEN N°9', 10, 'PUNTA');

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
-- Estructura de tabla para la tabla `soap`
--

CREATE TABLE `soap` (
  `idsoap` int(11) NOT NULL,
  `idcotizacion` int(255) NOT NULL,
  `subjetivo` varchar(255) NOT NULL,
  `objetivo` varchar(255) NOT NULL,
  `analisis` varchar(255) NOT NULL,
  `plan` varchar(255) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idusuario` int(11) NOT NULL,
  `monto` int(11) NOT NULL
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
-- Estructura de tabla para la tabla `tipotratamiento`
--

CREATE TABLE `tipotratamiento` (
  `idtipotratamiento` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(1500) NOT NULL,
  `costo` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipotratamiento`
--

INSERT INTO `tipotratamiento` (`idtipotratamiento`, `nombre`, `descripcion`, `costo`) VALUES
(3, 'LUZ PULSADA INTENSA', 'El láser frío permite la regeneración natural de la piel mediante fotoestimulación no invasiva, el procedimiento tarda de 15 minutos a una hora dependiendo de la extensión de la zona. Se realiza mediante disparos de luz con la respectiva protección ocular para el paciente y el operador. Se requiere un promedio de 5 a 8 sesiones con intervalos de 2 a 3 semanas. No requiere anestesia al ser completamente tolerable y el paciente vuelve a sus actividades de forma inmediata. El cuidado mínimo es protección solar cada 3 horas.', 'Los costos pueden ir desde 100 Bs a 700Bs la sesión todo depende de la cantidad de disparos de láser a realizar, a menor extensión el costo es menor a mayor extensión el costo es mayor.'),
(4, 'DERMOABRASION PUNTAS DE DIAMANTE', 'Procedimiento de limpieza y absorción de células muertas que permite tener un cutis más limpio. Utilizado previo al tratamiento de mesoterapia y plasma rico en plaquetas superficial. También previo al uso de máscaras faciales', '100 Bs. Para el tratamiento previo a mesoterapia o plasma rico en plaquetas es completamente gratis.'),
(5, 'ELECTROCAUTERIO PARA ELIMINAR LUNARES', 'Procedimiento previo anestesia local para extraer de raíz verrugas y lunares. Sin anestesia los pólipos. Se requiere de 1 a 2 sesiones máximo.', 'De 50 a 200 Bs. Dependiendo del tamaño de las lesiones'),
(6, 'ULTRACAVITACION', 'Procedimiento que mediante ultrasonido específico, permite la implosión de las células grasa. Es decir éstas se disuelven para eliminar su contenido mediante los ganglios linfáticos. Además permite la lipomodelación. Se requiere de 2 a más sesiosen según la cantidad de grasa del paciente con intervalos de 1 semana.', 'de 280 Bs a 380 Bs'),
(7, 'RADIOFRECUENCIA TRIPOLAR', 'Calor que permite la estimulación de las fibras de colágeno y elastina, provocando un efecto tensor o lifting en la zona tratada. Coadyuvante en el tratamiento de reducción y post plasma rico en plaquetas.', 'de 50bs a 200Bs la sesión dependiendo de la zona a tratar'),
(8, 'LIPOLASER DE DIODO', 'Método que utiliza la energía del láser para reducir el tamaño de la célula grasa. Estimula el metabolismo celular, logrando perder entre 2 a 4 cm de grasa en media hora de tratamiento. Se requiere entre 2 a 12 sesiones dependiendo el tamaño de la grasa a reducir. No requiere de cuidados y la persona puede realizar sus actividades de forma inmediata y normal.', '200 a 280 Bs la sesión.'),
(9, 'ELECTROESTIMULACIÓN', 'Método que mediante la energía de corrientes rusas permite la estimulación muscular. Generando alivio de dolores, descontracción muscular,  mayor firmeza en zonas trabajadas para reducción de grasa y tonificación. No requiere cuidados y uno puede realizarse éste método hasta diariamente.', 'de 100 a 250 Bs'),
(10, 'VACCUMTERAPIA', 'Movilización de la grasas lozalizada difícil de tratar mediante el sistema de vacío por ventosa. Cuadyuvante en el tratamiento con Ultracavitación.', 'de 100 a 200 Bs.'),
(11, 'MESOTERAPIA', 'Intradermoterapia mediante la aplicación de sustancias químicas directamente en la zona afectada. No dolorosa, puede realizarse semanalmente. Los cuidados mínimos son la protección solar cada 3 horas. Los resultados se ven desde la primera sesión. Se requiere un mínimo de 4 sesiones.', 'de 180 Bs a 380 Bs'),
(12, 'PLASMA RICO EN PLAQUETAS', 'Mediante la extracción de sangre venosa, se procede a la extracción de las plaquetas, células reparadoras y regeneradoras del cuerpo humano. Se aplica mediante inyecciones superficiales, subcutáneas o intrarticulares. No requiere nestesia ya que es muy tolerable. Los cuidados son mínimos y se puede realizar de acuerdo a la indicación médica.', 'Superficial de 290 a 350 Bs; medio de 400 a 750 Bs; profundo de 1050 a 2100 Bs; articular de 250 a 350 Bs; capilar de 290 a 350 Bs. Pestañas a 400Bs '),
(13, 'PLASMA RICO EN PLAQUETAS', 'Mediante la extracción de sangre venosa, se procede a la extracción de las plaquetas, células reparadoras y regeneradoras del cuerpo humano. Se aplica mediante inyecciones superficiales, subcutáneas o intrarticulares. No requiere nestesia ya que es muy tolerable. Los cuidados son mínimos y se puede realizar de acuerdo a la indicación médica.', 'Superficial de 290 a 350 Bs; medio de 400 a 750 Bs; profundo de 1050 a 2100 Bs; articular de 250 a 350 Bs; capilar de 290 a 350 Bs. Pestañas a 400Bs '),
(14, 'PEELING QUIMICO', 'Mediante la aplicación de sustancias químicas de forma directa en las zonas afectadas. Sin inyecciones se coloca las sustancias por un lapso de tiempo controlado, de acuerdo a la profudidad se indica la siguiente sesión y los cuidados son la no exposición al sol de forma directa.', 'Superficial de 180 a 250 Bs; Medio de 300 a 500 Bs; Profundo de 580 a 700 Bs.'),
(15, 'MASCARA EN CONSULTORIO', 'Aplicación de máscaras según necesidad o requerimiento de la persona, factibles de realizar semanalmente , no requiere mayores cuidados.', 'De acuerdo al tpo de máscara de 150 a 500 Bs.'),
(16, 'RELLENOS FACIALES CON ACIDO HIALURONICO', 'Mediante la aplicación de relleno de ácido hialurónico por inyecciones, procedmiento con una duración de 30 minutos a 1 hora. En algunas zonas previa anestesia local. Cuidados por 3 días de no ir al sauna, comer picantes y cuidarse del sol. Se realiza una sesión cada 6 meses.', ''),
(17, 'TOXINA BOTULINICA', 'Aplicación de microinyecciones en zonas específicas para relajar la musculatura y permitir la desaparición de arrugas y líneas. No requiere previa anestesia del lugar. Cuidados de evitar ciertas posturas por el lapso de 24 horas, sauna y sol. Puede realizarse una sesión cada 6 meses', ''),
(18, 'HILOS TENSORES', 'Aplicación de hilos mediante microinyecciones previa anestesia local, en zonas con flacidez, de cualquier parte del cuerpo. Los hilos son reabsorvibles en 6 meses y su efecto dura de 1 a 2 años dependiendo el cuidado. Se requires los PDO o polidioxanona entre 4 y 12 hilos. Los cog de 2 a 6 hilos', ''),
(19, 'HIDROLIPOCLASIA QUIMICA', 'Mediante la inyección de suero y sustancias liporeductoras de forma directa en la grasa, previa anestesia local. Se logra reducir de 6 a 11 cm en una sola sesión. Procedmiento no doloroso y posterior al mismo se puede realizar actividad física. De acuerdo al caso pueden realizarse 2 a 12 sesiones. Un promedio de 4', ''),
(20, 'METODO DE EXTRACCION LIPIDICA AMBULATORIA', 'Procedmiento minimamente invasivo previa anestesia local, para la extarcción de una pequeña cantidad de grasa subumbilical. La misma puede aplicarse en rostro como relleno definitivo, o extraerse en zonas con grasa no deseada. Así mismo se puede procesar la grasa para la extracción de células madre y utilizar en zonas para regeneración como el cuero cabelludo, ariculaciones y piel.', '5000 a 7000 bs'),
(21, 'MEGADOSIS INTRAVENOSA DE VITAMINA C', 'Mediante una vía venosa se administra 7500 a 15000mg de vitamina c en suero. El procedmiento dura de media hora a una hora. Sin molestias ni dolor. Para la regeneración integral del organismo. Aclara la piel, previene enfermedades como el resfrío, cáncer, alzheimer, osteoporosis y otras degenerativas. Aumenta la energía, mejora el sueño con un descanso reparador. Se puede utilizar entre 3 meses a 6.', ''),
(22, 'MEGADOSIS INTRAVENOSA DE VITAMINA C', '', ''),
(23, 'AUTO HEMO TERAPIA', 'Para elevar las defensas celulares y de tejidos, especialmente en casos de acné. La terapia debe realizarse cada 5 días por 5 veces.', '50 Bs.'),
(24, 'DERMAPEN', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamiento`
--

CREATE TABLE `tratamiento` (
  `idtratamiento` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `caracteristica` varchar(200) NOT NULL,
  `sesiones` int(11) NOT NULL,
  `costo` int(11) NOT NULL,
  `idtipotratamiento` int(11) NOT NULL DEFAULT '1',
  `tiempo` varchar(200) NOT NULL,
  `tipo` varchar(200) NOT NULL,
  `reposicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tratamiento`
--

INSERT INTO `tratamiento` (`idtratamiento`, `nombre`, `caracteristica`, `sesiones`, `costo`, `idtipotratamiento`, `tiempo`, `tipo`, `reposicion`) VALUES
(24, 'DEPILACION', 'PROLONGADA O PERMANENTE', 6, 100, 3, '15min', 'CORPORAL', 0),
(25, 'ACNE', 'LEVE A MODERADO', 5, 180, 3, '2 sem', 'FACIAL', 0),
(27, 'FTR', 'LEVE A MODERADO', 6, 180, 3, '15min', 'FACIAL', 0),
(28, 'PRP', 'PROFUNDO', 1, 1050, 13, '60 min', 'FACIAL', 0),
(29, 'MESOTERAPIA BAJA', 'MESOTERAPIA FINA', 6, 150, 11, '10 min', 'CORPORAL', 50),
(31, 'PLASMA ARTICULAR', 'MINI INVASIVO', 5, 350, 12, '40 min', 'CORPORAL', 0),
(32, 'DEPILACION BOZO', 'PERMANENTE', 7, 100, 3, '15 MIN', 'FACIAL', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientoreactivo`
--

CREATE TABLE `tratamientoreactivo` (
  `idtratamiento` int(11) NOT NULL,
  `idreactivo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tratamientoreactivo`
--

INSERT INTO `tratamientoreactivo` (`idtratamiento`, `idreactivo`, `cantidad`) VALUES
(24, 56, 10),
(27, 44, 10),
(28, 57, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` varchar(45) NOT NULL DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `email`, `password`, `tipo`, `nombre`, `estado`) VALUES
(1, 'admin@gmail.com', '123456', 'ADMIN', 'ADIMER', 'ACTIVO'),
(2, 'miguel.reynolds@gmail.com', '1234567', 'ADMIN', 'MIGUEL', 'ACTIVO'),
(3, 'allisonpaez@hotmail.com', '123456', 'ADMIN', 'ALLISON PAEZ TROCHE', 'ACTIVO'),
(4, 'ANDRE.MILE723@GMAIL.COM', '654321', 'ADMIN', 'ANDREINA GONZALES', 'ACTIVO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consentimiento`
--
ALTER TABLE `consentimiento`
  ADD PRIMARY KEY (`idconsentimiento`);

--
-- Indices de la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`idconsulta`),
  ADD KEY `idcosto` (`idmonto`);

--
-- Indices de la tabla `corporal`
--
ALTER TABLE `corporal`
  ADD PRIMARY KEY (`idcorporal`),
  ADD KEY `idmonto` (`idmonto`);

--
-- Indices de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD PRIMARY KEY (`idcotizacion`),
  ADD KEY `idpaciente` (`idhistorial`);

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
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`idfactura`,`idproducto`),
  ADD KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `deudas`
--
ALTER TABLE `deudas`
  ADD PRIMARY KEY (`iddeudas`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `dosificacion`
--
ALTER TABLE `dosificacion`
  ADD PRIMARY KEY (`iddosificacion`);

--
-- Indices de la tabla `egreso`
--
ALTER TABLE `egreso`
  ADD PRIMARY KEY (`idegreso`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idtratamiento` (`idtratamiento`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idpaciente` (`idpaciente`);

--
-- Indices de la tabla `facial`
--
ALTER TABLE `facial`
  ADD PRIMARY KEY (`idfacial`),
  ADD KEY `idmonto` (`idmonto`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idfactura`),
  ADD KEY `idcliente` (`idpaciente`),
  ADD KEY `iddosificacion` (`iddosificacion`),
  ADD KEY `idusuario` (`idusuario`);

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
  ADD PRIMARY KEY (`idhistorial`),
  ADD UNIQUE KEY `idhistorial` (`idhistorial`),
  ADD UNIQUE KEY `idhistorial_2` (`idhistorial`),
  ADD KEY `idpaciente` (`idpaciente`);

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`idingreso`),
  ADD KEY `idusuario` (`idusuario`);

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
-- Indices de la tabla `medida`
--
ALTER TABLE `medida`
  ADD PRIMARY KEY (`idmedida`),
  ADD KEY `idpaciente` (`idcotizacion`);

--
-- Indices de la tabla `montos`
--
ALTER TABLE `montos`
  ADD PRIMARY KEY (`idmonto`),
  ADD KEY `idcotizacion` (`idcotizacion`),
  ADD KEY `idtratamiento` (`idtratamiento`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`idpaciente`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`);

--
-- Indices de la tabla `reactivo`
--
ALTER TABLE `reactivo`
  ADD PRIMARY KEY (`idreactivo`);

--
-- Indices de la tabla `receta`
--
ALTER TABLE `receta`
  ADD PRIMARY KEY (`idreceta`),
  ADD KEY `idcotizacion` (`idcotizacion`);

--
-- Indices de la tabla `soap`
--
ALTER TABLE `soap`
  ADD PRIMARY KEY (`idsoap`),
  ADD KEY `idcotizacion` (`idcotizacion`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `tipolaboratorio`
--
ALTER TABLE `tipolaboratorio`
  ADD PRIMARY KEY (`idtipolaboratorio`);

--
-- Indices de la tabla `tipotratamiento`
--
ALTER TABLE `tipotratamiento`
  ADD PRIMARY KEY (`idtipotratamiento`);

--
-- Indices de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  ADD PRIMARY KEY (`idtratamiento`),
  ADD KEY `idtipotratamiento` (`idtipotratamiento`);

--
-- Indices de la tabla `tratamientoreactivo`
--
ALTER TABLE `tratamientoreactivo`
  ADD PRIMARY KEY (`idtratamiento`,`idreactivo`),
  ADD KEY `idreactivo` (`idreactivo`);

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
-- AUTO_INCREMENT de la tabla `consulta`
--
ALTER TABLE `consulta`
  MODIFY `idconsulta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `corporal`
--
ALTER TABLE `corporal`
  MODIFY `idcorporal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  MODIFY `idcotizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `cotizacionlaboratorio`
--
ALTER TABLE `cotizacionlaboratorio`
  MODIFY `idcotizacionlaboratorio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `deudas`
--
ALTER TABLE `deudas`
  MODIFY `iddeudas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `dosificacion`
--
ALTER TABLE `dosificacion`
  MODIFY `iddosificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `egreso`
--
ALTER TABLE `egreso`
  MODIFY `idegreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `facial`
--
ALTER TABLE `facial`
  MODIFY `idfacial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idfactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `foto`
--
ALTER TABLE `foto`
  MODIFY `idfoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `idhistorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `idingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
-- AUTO_INCREMENT de la tabla `medida`
--
ALTER TABLE `medida`
  MODIFY `idmedida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `montos`
--
ALTER TABLE `montos`
  MODIFY `idmonto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `idpaciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `reactivo`
--
ALTER TABLE `reactivo`
  MODIFY `idreactivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `receta`
--
ALTER TABLE `receta`
  MODIFY `idreceta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `soap`
--
ALTER TABLE `soap`
  MODIFY `idsoap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `tipolaboratorio`
--
ALTER TABLE `tipolaboratorio`
  MODIFY `idtipolaboratorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipotratamiento`
--
ALTER TABLE `tipotratamiento`
  MODIFY `idtipotratamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  MODIFY `idtratamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD CONSTRAINT `consulta_ibfk_1` FOREIGN KEY (`idmonto`) REFERENCES `montos` (`idmonto`);

--
-- Filtros para la tabla `corporal`
--
ALTER TABLE `corporal`
  ADD CONSTRAINT `corporal_ibfk_1` FOREIGN KEY (`idmonto`) REFERENCES `montos` (`idmonto`);

--
-- Filtros para la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD CONSTRAINT `cotizacion_ibfk_1` FOREIGN KEY (`idhistorial`) REFERENCES `historial` (`idhistorial`);

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
-- Filtros para la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD CONSTRAINT `detallefactura_ibfk_1` FOREIGN KEY (`idfactura`) REFERENCES `factura` (`idfactura`),
  ADD CONSTRAINT `detallefactura_ibfk_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`);

--
-- Filtros para la tabla `deudas`
--
ALTER TABLE `deudas`
  ADD CONSTRAINT `deudas_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `egreso`
--
ALTER TABLE `egreso`
  ADD CONSTRAINT `egreso_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `egreso_ibfk_2` FOREIGN KEY (`idtratamiento`) REFERENCES `tratamiento` (`idtratamiento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`idpaciente`) REFERENCES `paciente` (`idpaciente`);

--
-- Filtros para la tabla `facial`
--
ALTER TABLE `facial`
  ADD CONSTRAINT `facial_ibfk_1` FOREIGN KEY (`idmonto`) REFERENCES `montos` (`idmonto`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`idpaciente`) REFERENCES `paciente` (`idpaciente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`iddosificacion`) REFERENCES `dosificacion` (`iddosificacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_3` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`idcotizacion`) REFERENCES `cotizacion` (`idcotizacion`);

--
-- Filtros para la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD CONSTRAINT `ingreso_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD CONSTRAINT `laboratorio_ibfk_1` FOREIGN KEY (`idtipolaboratorio`) REFERENCES `tipolaboratorio` (`idtipolaboratorio`);

--
-- Filtros para la tabla `medida`
--
ALTER TABLE `medida`
  ADD CONSTRAINT `medida_ibfk_1` FOREIGN KEY (`idcotizacion`) REFERENCES `cotizacion` (`idcotizacion`);

--
-- Filtros para la tabla `montos`
--
ALTER TABLE `montos`
  ADD CONSTRAINT `montos_ibfk_1` FOREIGN KEY (`idcotizacion`) REFERENCES `cotizacion` (`idcotizacion`),
  ADD CONSTRAINT `montos_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

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

--
-- Filtros para la tabla `soap`
--
ALTER TABLE `soap`
  ADD CONSTRAINT `soap_ibfk_1` FOREIGN KEY (`idcotizacion`) REFERENCES `cotizacion` (`idcotizacion`),
  ADD CONSTRAINT `soap_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  ADD CONSTRAINT `tratamiento_ibfk_1` FOREIGN KEY (`idtipotratamiento`) REFERENCES `tipotratamiento` (`idtipotratamiento`);

--
-- Filtros para la tabla `tratamientoreactivo`
--
ALTER TABLE `tratamientoreactivo`
  ADD CONSTRAINT `tratamientoreactivo_ibfk_1` FOREIGN KEY (`idtratamiento`) REFERENCES `tratamiento` (`idtratamiento`),
  ADD CONSTRAINT `tratamientoreactivo_ibfk_2` FOREIGN KEY (`idreactivo`) REFERENCES `reactivo` (`idreactivo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
