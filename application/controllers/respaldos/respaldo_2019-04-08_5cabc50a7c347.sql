SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `span`
--




CREATE TABLE `consentimiento` (
  `idconsentimiento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `contenido` mediumtext NOT NULL,
  PRIMARY KEY (`idconsentimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;


INSERT INTO consentimiento VALUES
("1","CONSENTIMIENTO INFORMADO PARA TRATAMIENTO MEDIANTE PLASMA RICO EN PLAQUETAS - MEGADOSIS VITAMINA C","Por el presente consiento que se me realice el procedimiento terapéutico indicado y aconsejado. Se me ha explicado la naturaleza y el objetivo del tratamiento, incluyendo riesgos leves y de gravedad en caso de no cuidarme y alternativas disponibles al tratamiento. Estoy satisfecho con esas explicaciones y las he comprendido.\nTambién consiento la realización de todo procedimiento o tratamiento adicional o alternativo que en opinión del Medico sean necesarios. Consiento la administración de aquellos anestésicos que puedan ser considerados necesarios o convenientes, comprendiendo que ello puede implicar ciertos riesgos de distinta envergadura. Además de consentir como la filmación o fotografía para fines comparativos.\n\"ESCENCIA SPA MEDICO\", me ha informado en qué consiste el tratamiento. Se me ha realizado una Historia Clínica para descartar patologías y riesgos, que impidan beneficiarme con éste tratamiento, confirmando que no padezco ninguna de las siguientes patologías motivo de contraindicación de la aplicación del tratamiento.\n*Embarazo y  Lactancia \n*Inmunosupresión , Patología tumoral , Epilepsia convulsiones, deficiencias de coagulación.\n*Sitios de infección local activa , Inflamación local activa\n*Alergias \n*Ingesta de alcohol en la última semana antes del tratamiento. \n*Ingesta de Aspirina o antiinflamatorios, o encontrarme con tratamiento antibiótico en la última semana previa al tratamiento\n*Enfermedades del corazón,\n*Cirugías recientes o próximas al tratamiento excepto para el caso de la megadosis de vitamina C\nPROCEDIMIENTO.- Técnica ambulatoria que consiste: paciente en decúbito dorsal se le aplica en la zona a tratar una crema anestésica dejándola que actúe unos minutos, tiempo en el que permanece tranquilamente relajado. Luego se extrae entre 5ml para el plasma superficial y entre 20 y 25ml de sangre venosa del mismo paciente para el caso del plasma profundo, la que se coloca en tubos estériles a una centrifugadora por medio de la cual se separa el plasma de los glóbulos rojos y blancos. Se activa la fracción de plasma a utilizar, al ser retirado el plasma de los tubos en jeringas pre cargadas con el activador. Una vez conseguido el plasma rico en factores de crecimiento se introduce en la dermis mediante inyecciones superficiales intradérmicas superficial o nappage, subcutánea se aplica  con una aguja hipodérmica, haciendo pequeños y múltiples micro inyecciones en la zona a tratar.\nPara el caso de la megadosis de vitamina C solamente me colocarán una vía endovenosa en el antebrazo por el lapso de media a una hora donde ingresará la vitamina c y el suero. Para el caso de células madre además deberé firmar un consentimiento adicional.\nSe me ha informado que puedo sentir un ligero malestar, dependiendo de mi umbral de dolor. Irritación, Enrojecimiento, Hipersensibilidad en la piel tratada Inflamación,  Picazón, molestias en la piel aparición de hematomas y que según el procedimiento, la duración puede variar , generalmente  de media a una hora, luego de la cual el paciente puede regresar sin problemas a casa siguiendo las indicaciones posteriores. La cantidad de sesiones está en relación directa con el efecto que quiera obtenerse normalmente se requieren de 2 a más sesiones, por lo tanto hago entender que no necesitaré firmar un consentimiento informado en cada sesión, sobreentendiendo que el primero es válido para todas las sesiones que voluntariamente solicite.\nCUIDADOS POSTERIORES.-\n*Evitar la  exposición al sol, cama solar o cualquier fuente de calor externo (saunas, horno, estufas, radiación solar).\n*Utilizar protector solar  FPS mayor 45 cada 2hrs\n*No Depilar  o  afeitar  la zona tratada por 48hrs\n*Evitar realizar masajes, ejercicios violentos (Excepto plasma superficial y megadosis de vitamina C), natación, baños de inmersión o sauna, ya que estos generan vasodilatación e infección por el lapso de 72Hrs\n*No consumir bebidas alcohólicas 72 Hrs, no comidas picantes o muy condimentadas, no gaseosas ni dulces.\n*Dejo constancia además de que comunicaré al profesional encargado, cualquier molestia o reacción posterior a la sesión.\n*Control Médico en 48 hrs.\nHe comprendido, todas las explicaciones otorgadas en lenguaje sencillo y claro, el profesional que me ha atendido me han permitido realizar todas las observaciones y me aclaró dudas planteadas.\nPor ello manifiesto que estoy satisfecho(a) con la información recibida y que comprendo el alcance y riesgos del tratamiento libremente y en tales condiciones.\n\n\n"),
("2","CONSENTIMIENTO INFORMADO MESOTERAPIA, FOSFA E HIDRO","aaaa"),
("3","CONSENTIMIENTO INFORMADO ac, hialuronico , botox , rinomodelacion",""),
("4","CONSENTIMIENTO INFORMADO REDUCTOR",""),
("5","CONSENTIMIENTO INFORMADO TRATAMIENTO IPL-PEELENG-DERMO","");




CREATE TABLE `consulta` (
  `idconsulta` int(11) NOT NULL AUTO_INCREMENT,
  `motivo` varchar(200) NOT NULL,
  `cot` varchar(200) NOT NULL,
  `ref` varchar(200) NOT NULL,
  `idmonto` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idconsulta`),
  KEY `idcosto` (`idmonto`),
  CONSTRAINT `consulta_ibfk_1` FOREIGN KEY (`idmonto`) REFERENCES `montos` (`idmonto`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;


INSERT INTO consulta VALUES
("5","","","","7","2019-04-03 16:33:09"),
("6","","","","8","2019-04-08 17:23:36");




CREATE TABLE `corporal` (
  `idcorporal` int(11) NOT NULL AUTO_INCREMENT,
  `tratamiento` varchar(200) NOT NULL,
  `obs` varchar(200) NOT NULL,
  `cub` varchar(200) NOT NULL,
  `idmonto` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcorporal`),
  KEY `idmonto` (`idmonto`),
  CONSTRAINT `corporal_ibfk_1` FOREIGN KEY (`idmonto`) REFERENCES `montos` (`idmonto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `cotizacion` (
  `idcotizacion` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idhistorial` int(11) NOT NULL,
  `diagnostico` varchar(255) NOT NULL,
  `programa` varchar(255) NOT NULL,
  PRIMARY KEY (`idcotizacion`),
  KEY `idpaciente` (`idhistorial`),
  CONSTRAINT `cotizacion_ibfk_1` FOREIGN KEY (`idhistorial`) REFERENCES `historial` (`idhistorial`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;


INSERT INTO cotizacion VALUES
("30","2019-03-26 17:23:19","3","melasma llameal","dieta"),
("31","2019-03-26 17:44:28","4","melasma llameal","dieta"),
("37","2019-03-26 19:09:20","4","",""),
("38","2019-03-27 15:59:18","1","deficiencia","6 a 8 realizarse una mejoria"),
("39","2019-03-27 16:20:53","1","",""),
("48","2019-04-03 16:33:09","6","melasma llameal",""),
("49","2019-04-08 17:23:36","11","melasma llameal","");




CREATE TABLE `cotizacionconsetimeinto` (
  `idconsetimiento` int(11) NOT NULL,
  `idcotizacion` int(11) NOT NULL,
  PRIMARY KEY (`idconsetimiento`,`idcotizacion`),
  KEY `idcotizacion` (`idcotizacion`),
  CONSTRAINT `cotizacionconsetimeinto_ibfk_1` FOREIGN KEY (`idconsetimiento`) REFERENCES `consentimiento` (`idconsentimiento`),
  CONSTRAINT `cotizacionconsetimeinto_ibfk_2` FOREIGN KEY (`idcotizacion`) REFERENCES `cotizacion` (`idcotizacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO cotizacionconsetimeinto VALUES
("1","30"),
("1","48"),
("1","49"),
("3","31"),
("4","30"),
("5","31");




CREATE TABLE `cotizacionlaboratorio` (
  `idcotizacion` int(11) DEFAULT NULL,
  `idlaboratorio` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `diagnostico` varchar(255) DEFAULT NULL,
  `otros` varchar(255) DEFAULT NULL,
  `indicaciones` varchar(255) DEFAULT NULL,
  `idcotizacionlaboratorio` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idcotizacionlaboratorio`),
  KEY `idcotizacion` (`idcotizacion`),
  KEY `idlaboratorio` (`idlaboratorio`),
  CONSTRAINT `cotizacionlaboratorio_ibfk_1` FOREIGN KEY (`idcotizacion`) REFERENCES `cotizacion` (`idcotizacion`),
  CONSTRAINT `cotizacionlaboratorio_ibfk_2` FOREIGN KEY (`idlaboratorio`) REFERENCES `laboratorio` (`idlaboratorio`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;






CREATE TABLE `cotizaciontratamiento` (
  `idcotizacion` int(11) NOT NULL,
  `idtratamiento` int(11) NOT NULL,
  `n` varchar(255) NOT NULL,
  `tiempo` varchar(255) NOT NULL,
  `costo` varchar(255) NOT NULL,
  PRIMARY KEY (`idcotizacion`,`idtratamiento`),
  KEY `idtratamiento` (`idtratamiento`),
  CONSTRAINT `cotizaciontratamiento_ibfk_1` FOREIGN KEY (`idcotizacion`) REFERENCES `cotizacion` (`idcotizacion`),
  CONSTRAINT `cotizaciontratamiento_ibfk_2` FOREIGN KEY (`idtratamiento`) REFERENCES `tratamiento` (`idtratamiento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO cotizaciontratamiento VALUES
("30","2","","","180"),
("30","6","","","250"),
("37","2","","","180"),
("37","3","","","250"),
("38","1","2","2sem","250"),
("38","2","2","2sem","180"),
("48","2","","","150"),
("48","3","","","280"),
("49","1","4","2 sem","180"),
("49","2","","","180"),
("49","3","","","250");




CREATE TABLE `detalle` (
  `idreceta` int(11) DEFAULT NULL,
  `idmedicamento` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  KEY `idreceta` (`idreceta`),
  KEY `idmedicamento` (`idmedicamento`),
  CONSTRAINT `detalle_ibfk_1` FOREIGN KEY (`idreceta`) REFERENCES `receta` (`idreceta`),
  CONSTRAINT `detalle_ibfk_2` FOREIGN KEY (`idmedicamento`) REFERENCES `medicamento` (`idmedicamento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `idusuario` int(100) DEFAULT NULL,
  `idpaciente` int(11) NOT NULL DEFAULT '1',
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `idusuario` (`idusuario`),
  KEY `idpaciente` (`idpaciente`),
  CONSTRAINT `events_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  CONSTRAINT `events_ibfk_2` FOREIGN KEY (`idpaciente`) REFERENCES `paciente` (`idpaciente`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;


INSERT INTO events VALUES
("25","2019-04-11 08:00:00","2019-04-11 08:30:00","ADIMER CHAMBI AJATA","1","1",""),
("26","2019-04-12 09:00:00","2019-04-12 09:30:00","PEDRO  CALLE LOPEZ","1","3",""),
("27","2019-04-08 20:00:00","2019-04-08 20:30:00","PEDRO  CALLE LOPEZ","2","3",""),
("28","2019-04-09 07:00:00","2019-04-09 10:30:00","MIGUEL REYNOLDS","1","1009","");




CREATE TABLE `facial` (
  `idfacial` int(11) NOT NULL AUTO_INCREMENT,
  `tratamiento` varchar(200) NOT NULL,
  `obs` varchar(200) NOT NULL,
  `cub` varchar(200) NOT NULL,
  `idmonto` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idfacial`),
  KEY `idmonto` (`idmonto`),
  CONSTRAINT `facial_ibfk_1` FOREIGN KEY (`idmonto`) REFERENCES `montos` (`idmonto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `foto` (
  `idfoto` int(11) NOT NULL AUTO_INCREMENT,
  `idcotizacion` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idfoto`),
  KEY `idcotizacion` (`idcotizacion`),
  CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`idcotizacion`) REFERENCES `cotizacion` (`idcotizacion`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;


INSERT INTO foto VALUES
("28","31","2019-03-26 18:02:46"),
("29","31","2019-03-26 18:24:24"),
("30","31","2019-03-26 18:26:51"),
("31","49","2019-04-08 17:24:47");




CREATE TABLE `historial` (
  `idhistorial` int(11) NOT NULL AUTO_INCREMENT,
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
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idhistorial`),
  KEY `idpaciente` (`idpaciente`),
  CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`idpaciente`) REFERENCES `paciente` (`idpaciente`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;


INSERT INTO historial VALUES
("1","1007","","","","","","","","","","","","","","","no","no","no","","","","","cirugia neurologica 3 vecesd hace 2 años","","ninguno","","","","","","0","0","0","0","no","","no","","","no","no","","no","","","","no","","no","","Tipo I","","","","","2019-03-26 16:16:41"),
("2","1007","","","","","","","","","","","","","","","no","no","no","","","","","cirugia neurologica 3 veces hace 2 años","","ninguno","","","","","","0","0","0","0","no","","no","","","no","no","","no","","","","no","","no","","","","","","","2019-03-26 16:16:41"),
("3","1007","","","","","","","","","","","","","","","","","","","","","","cirujia neurologica","","ninguno","","","","","","0","0","0","0","no","","no","","","no","no","","no","","","","no","","no","","","","","","","2019-03-26 16:16:41"),
("4","1008","","","","","","","","","","","","","","","","","","","","","","INFECCION UNIRINARIA","","ninguno","","","","","","0","0","0","0","no","","no","","","no","no","","no","","","","no","","no","","","","","","","2019-03-26 17:42:23"),
("5","1008","","","","80","1.7","27.68","","","","","","","","","si","no","si","","","","","","","ninguno","","","","","","0","0","0","0","no","","no","","","no","no","","no","","","","no","","no","","","","","","","2019-03-26 17:43:02"),
("6","1","dolor de espalda","","","","","","","","","","","","","","","","","","","","","","","ninguno","","","","","","0","0","0","0","no","","no","","","no","no","","no","","","","no","","no","","Tipo IV","","","","","2019-03-27 17:26:36"),
("8","1","asdsada","","","","","","","","","","","","","","","","","","","","","","","ninguno","","","","","","0","0","0","0","no","","no","","","no","no","","no","","","","no","","no","","","","","","","2019-04-03 18:40:01"),
("9","1","asdsadasd","","","45","45","0.02","","","","1","","","","","","","","","","","","","","ninguno","","","","","","0","0","0","0","no","","no","","","no","no","","no","","","","no","","no","","","","","","","2019-04-03 18:40:15"),
("10","1","asdasdas","","10","80","1.70","27.68","","","","","","","","","","","","","","","","","","ninguno","","","","","","0","0","0","0","no","","no","","","no","no","","no","","","","no","","no","","","","","","","2019-04-03 18:49:49"),
("11","1009","DOLOR ESPALDA","","","67","1.65","24.61","","","","","","","","","","","","","","","","","","ninguno","","","","","","0","0","0","0","no","","no","","","no","no","","no","","","","no","","no","","","","","","","2019-04-08 17:09:42");




CREATE TABLE `laboratorio` (
  `idlaboratorio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `idtipolaboratorio` int(11) NOT NULL,
  PRIMARY KEY (`idlaboratorio`),
  KEY `tipolaboratorio` (`idtipolaboratorio`),
  CONSTRAINT `laboratorio_ibfk_1` FOREIGN KEY (`idtipolaboratorio`) REFERENCES `tipolaboratorio` (`idtipolaboratorio`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;


INSERT INTO laboratorio VALUES
("1","HERMOGRAMA COMPLETO","1"),
("2","TIEMPO COAGULACIONJ Y SANGRE","1"),
("3","RECUENTO DE PLAQUETAS","1"),
("4","GLUSOCA","2"),
("5","UREA","2"),
("6","CREATINA","2"),
("7","ACIDO URICO","2"),
("8","TRANSAMINASAS(GOT-GPT)","2"),
("9","LDH","2"),
("10","BILIRRUBINAS(D.I.T.)","2"),
("11","FOSFATASA ALCALINA","2"),
("12","FOFATASA ACIDA","2"),
("13","COLESTEROL TOTAL","2"),
("14","TRIGLICERIDOS","2"),
("15","T3 TOTAL","3"),
("16","T4 TOTAL","3"),
("17","TSH","3"),
("18","TESTOTERONNA","3"),
("19","PCR (PROTEINA REACTIVA)","4"),
("20","HIV-AIDS","4"),
("21","CLAMIDIA","4"),
("22","COPROPARASITOLOGICO(1 MUESTRA)","5"),
("23","COPROPARASITOLOGICO SERIADO(3 MUESTRAS)","5"),
("24","LEUCOCITOS y PIOCITOS","5"),
("25","EXAMEN GENERAL DE ORINA","6"),
("26","CULTIVO Y ANTIBIOGRAMA","7");




CREATE TABLE `medicamento` (
  `idmedicamento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idmedicamento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `medida` (
  `idmedida` int(11) NOT NULL AUTO_INCREMENT,
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
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idmedida`),
  KEY `idpaciente` (`idcotizacion`),
  CONSTRAINT `medida_ibfk_1` FOREIGN KEY (`idcotizacion`) REFERENCES `cotizacion` (`idcotizacion`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;


INSERT INTO medida VALUES
("6","15/45","","","","94/92","101/96","","","","","38","2019-03-27 16:54:33"),
("7","15/15","","","","10.5","104.4","100","","","","38","2019-03-27 16:57:40"),
("8","15/45","15/45","","","94/92","","","","","","49","2019-04-08 17:30:44"),
("9","","15/45","","","93/92","","","","","","49","2019-04-08 17:30:50");




CREATE TABLE `montos` (
  `idmonto` int(11) NOT NULL AUTO_INCREMENT,
  `monto` float NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idcotizacion` int(11) NOT NULL,
  PRIMARY KEY (`idmonto`),
  KEY `idcotizacion` (`idcotizacion`),
  CONSTRAINT `montos_ibfk_1` FOREIGN KEY (`idcotizacion`) REFERENCES `cotizacion` (`idcotizacion`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;


INSERT INTO montos VALUES
("1","100","2019-03-27 15:59:18","38"),
("7","100","2019-04-03 16:33:09","48"),
("8","100","2019-04-08 17:23:36","49");




CREATE TABLE `paciente` (
  `idpaciente` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`idpaciente`),
  KEY `idusuario` (`idusuario`),
  CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=1010 DEFAULT CHARSET=latin1;


INSERT INTO paciente VALUES
("1","7336199","ADIMER","CHAMBI AJATA","sud","calle x y españa","2000-01-09","","","1",""),
("3","","PEDRO ","CALLE LOPEZ","norte","avenida españa","2000-01-09","","","1",""),
("4","","PEDRO","PICAPIERDA","SUD","tratamiento de cadera","2000-01-16","5261245","","1",""),
("7","","ANACLETO","VELAZQUES","sud","calle x y españa","2000-01-23","5261245","5861245","1",""),
("9","","NELLY","ZURITA","sud","calle corque","2000-01-23","5261245","68702443","1",""),
("14","","JUAN","PEREZ","sud","calle x y españa","1990-01-23","5261245","69603145","1",""),
("15","","ANDRU","MAQUINA","sud","calle bolivar y españa","1998-01-23","52315","5261245","1",""),
("16","","PORSHAN","CALLE","norte","calle bolivar y españa","1989-01-23","526124","5261245","1",""),
("17","7457785","NELLY","ZURITA","SUD","circunvalacion tarija # 52","1992-08-04","5261245","68702443","1",""),
("18","606060","PEDRO","GEBARA","sud","calle bolivar y españa","1990-01-25","5261245","606060","1",""),
("1000","3030","ANA","BANANA","sud","5261245","2000-01-31","5261245","69603027","1",""),
("1003","","DEYSI","POMA TORREZ","","","2019-02-04","","72330968","1",""),
("1004","7336199","EDWIN GUSTAVI","CHAMBI AJATA","CENTRICA","CALLE BOLIVAR","2000-03-19","5261245","69603027","1",""),
("1005","7333166","ANA","CAROL","SUD","CALLE BOLIVAR","2000-03-20","5261245","5261245","1",""),
("1007","123123","ROMY LIANET","CONDORI ZURITA","SUD","calle bolivar y velasco","2000-03-26","5261245","6960307","1",""),
("1008","4545","IGNACIO","ARANDIA PAEZ","CENTRAL","CALLE BOLIVAR","2000-03-26","5261245","69603027","1",""),
("1009","1115447","MIGUEL","REYNOLDS","NORTE","URBANIZACION AURORA","1972-09-12","","71843757","1","");




CREATE TABLE `receta` (
  `idreceta` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `idcotizacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`idreceta`),
  KEY `idcotizacion` (`idcotizacion`),
  CONSTRAINT `receta_ibfk_1` FOREIGN KEY (`idcotizacion`) REFERENCES `cotizacion` (`idcotizacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `soap` (
  `idsoap` int(11) NOT NULL AUTO_INCREMENT,
  `idcotizacion` int(255) NOT NULL,
  `subjetivo` varchar(255) NOT NULL,
  `objetivo` varchar(255) NOT NULL,
  `analisis` varchar(255) NOT NULL,
  `plan` varchar(255) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idsoap`),
  KEY `idcotizacion` (`idcotizacion`),
  KEY `idusuario` (`idusuario`),
  CONSTRAINT `soap_ibfk_1` FOREIGN KEY (`idcotizacion`) REFERENCES `cotizacion` (`idcotizacion`),
  CONSTRAINT `soap_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;


INSERT INTO soap VALUES
("2","37","subjetivo","objetivo","analisi","plan","2019-03-26 19:45:04","1"),
("3","37","px","acude a llevar ","tener","dma","2019-03-26 19:56:33","1"),
("4","37","paciente sano","falta de agua","mucha bebida","medidas ","2019-03-26 19:57:23","1"),
("5","37","paciente enfermo","mucha comida","bajar de peso","controlar","2019-03-26 19:57:55","1"),
("6","37","Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó u","acude a llevar ","analisi","plan","2019-03-26 20:12:59","1"),
("7","37","Tuvo pocas molestas","OBSERVO MEJORÍA","Segunda session","continuar contratamiento","2019-03-26 20:26:07","1"),
("9","48","paciente enfermo","acude a llevar ","analisi","plan","2019-04-03 16:33:30","1"),
("10","49","Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó u","acude a llevar ","analisi","plan","2019-04-08 17:29:43","1");




CREATE TABLE `tipolaboratorio` (
  `idtipolaboratorio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`idtipolaboratorio`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;


INSERT INTO tipolaboratorio VALUES
("1","HEMATOLOGIA"),
("2","QUIMICA SANGUINEA"),
("3","HORMONAS"),
("4","INMUNOLOGIA"),
("5","COPROLOGIA"),
("6","URIANALISIS"),
("7","BACTERIOLOGIA");




CREATE TABLE `tratamiento` (
  `idtratamiento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idtratamiento`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;


INSERT INTO tratamiento VALUES
("1","Luz Pulsada Intensa "),
("2","Mesoterapia "),
("3","Peeleng "),
("4","Dermoabrasion con puntas diamante"),
("5","Mascara"),
("6","Plasma Rico en Plaquetas"),
("7","Radiofrecuencia Tripolar "),
("8","Relleno Ac. Hialuronico"),
("9","Toxina Botulinica"),
("10","Rinomodelación sin Cirugía"),
("11","Hilos PDO - COG"),
("12","Lipotransferencia"),
("13","MELA"),
("14","Celulas madre"),
("15","Megadosis Vitamina \"C\" Intravenosa"),
("16","terapia homeopatica"),
("17","ultracavitacion"),
("18","Lipolaser de diodo"),
("19","electroestimulacion"),
("20","hidrolipoclasia quimica"),
("21","Crema Exclusiva"),
("22","Protector Solar Médico"),
("23","Otro");




CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` varchar(45) NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


INSERT INTO usuario VALUES
("1","admin@gmail.com","123456","ADMIN","ADIMER PAUL CHAMBI AJATA","ACTIVO"),
("2","miguel.reynolds@gmail.com","123456","ADMIN","MIGUEL","ACTIVO");




/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;