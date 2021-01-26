-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 26-01-2021 a las 22:15:22
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `almadisa`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `prcListadoUsuarios` ()  NO SQL
SELECT L.id_usuario,
       L.nombre, 
	   L.apellido,
       L.correo,
       L.acceso,
       L.estado, 
       L.avatar, 
       concat (S.razons,' - ',PA.nombre) as  sucursal ,
       D.nombre as depto,
       P.nombre as puesto
		FROM `login`  as L inner JOIN
        	sucursal as S on S.id_sucursal = L.id_sucursal inner JOIN
            depto as D on D.id_depto = L.id_depto inner join 
            puesto as P on P.id_puesto = L.id_puesto INNER JOIN
            pais as PA on PA.idpais = S.idpais$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prclogin` (IN `codigol` VARCHAR(30) CHARSET utf8, IN `usuariol` VARCHAR(30) CHARSET utf8, IN `passl` VARCHAR(100) CHARSET utf8)  NO SQL
select L.id_usuario,
	   L.id_sucursal,
       L.nombre,
       L.apellido,
       L.correo,
       L.avatar,
       S.logo,
       S.direccion,
       S.Telefono,
       S.identificacion,
       S.idpais,
       P.nombre as puesto
		from login as L INNER JOIN
            sucursal as S on S.id_sucursal = L.id_sucursal INNER JOIN 
            puesto as P on P.id_puesto = L.id_puesto
 where L.acceso = usuariol and L.pass = passl 
 	   and S.codigo = codigol
       and L.estado = 1$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id_almacen` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `id_consignado` int(11) NOT NULL,
  `codigo` varchar(25) NOT NULL,
  `contenedor_placa` varchar(50) NOT NULL,
  `poliza` varchar(50) NOT NULL,
  `referencia` varchar(50) NOT NULL,
  `peso` float NOT NULL,
  `id_medida_peso` int(11) NOT NULL,
  `volumen` float NOT NULL,
  `id_medida_volumen` int(11) NOT NULL,
  `bultos` int(11) NOT NULL,
  `fecha_almacen` date DEFAULT NULL,
  `fecha_graba` date NOT NULL,
  `id_usuario_modifica` int(11) DEFAULT NULL,
  `fecha_modifica` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asigna_menu`
--

CREATE TABLE `asigna_menu` (
  `idasigna_menu` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asigna_menu`
--

INSERT INTO `asigna_menu` (`idasigna_menu`, `id_usuario`, `id_menu`) VALUES
(55, 55, 8),
(56, 55, 9),
(57, 55, 10),
(61, 53, 1),
(83, 56, 1),
(84, 56, 6),
(85, 56, 7),
(86, 56, 9),
(87, 56, 10),
(88, 57, 1),
(89, 57, 6),
(90, 57, 7),
(91, 57, 8),
(92, 57, 9),
(93, 52, 1),
(94, 52, 6),
(95, 52, 7),
(96, 52, 8),
(97, 52, 9),
(98, 52, 10),
(99, 52, 12),
(100, 52, 14),
(101, 52, 19),
(102, 52, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos_e`
--

CREATE TABLE `contactos_e` (
  `id_contacto` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `apellido` varchar(75) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `puesto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `contactos_e`
--

INSERT INTO `contactos_e` (`id_contacto`, `id_empresa`, `nombre`, `apellido`, `correo`, `telefono`, `puesto`) VALUES
(10, 6, 'manuel', 'apeliido', 'it@gmail.com', '3132', 'pueto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `continente`
--

CREATE TABLE `continente` (
  `idcontinente` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `continente`
--

INSERT INTO `continente` (`idcontinente`, `nombre`) VALUES
(1, 'Africa'),
(2, 'America'),
(3, 'Asia'),
(4, 'Asia-Europa'),
(5, 'Europa'),
(6, 'Europa-Asia'),
(7, 'O. Atlantico'),
(8, 'Oceania');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depto`
--

CREATE TABLE `depto` (
  `id_depto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `depto`
--

INSERT INTO `depto` (`id_depto`, `nombre`) VALUES
(1, 'Administración'),
(2, 'Gerencia'),
(3, 'IT'),
(4, 'Operaciones'),
(5, 'Regional'),
(6, 'Servicio Al Cliente'),
(7, 'Ventas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_almacen`
--

CREATE TABLE `detalle_almacen` (
  `id_detalle` int(11) NOT NULL,
  `id_almacen` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_embalaje` int(11) NOT NULL,
  `peso` float NOT NULL,
  `volumen` float NOT NULL,
  `nohbl` varchar(50) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `resa` varchar(50) DEFAULT NULL,
  `dti` varchar(50) DEFAULT NULL,
  `no_cancel` varchar(50) DEFAULT NULL,
  `no_orden` varchar(50) DEFAULT NULL,
  `liberado` tinyint(1) DEFAULT NULL,
  `dut` varchar(50) DEFAULT NULL,
  `mercaderia` varchar(250) NOT NULL,
  `observaciones` varchar(250) NOT NULL,
  `fecha_graba` date NOT NULL,
  `fecha_modificacion` date NOT NULL,
  `id_usuario_modifica` int(11) DEFAULT NULL,
  `bultos_retirados` int(11) DEFAULT NULL,
  `carga_retenida` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id_empresa` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `Razons` varchar(150) NOT NULL,
  `Nombrec` varchar(150) NOT NULL,
  `identificacion` varchar(75) NOT NULL,
  `direccion` varchar(1000) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `Tipoe` varchar(25) NOT NULL,
  `codigo` varchar(25) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `porcentaje_comision` float NOT NULL,
  `tipo_comision` varchar(15) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id_empresa`, `id_sucursal`, `id_usuario`, `Razons`, `Nombrec`, `identificacion`, `direccion`, `telefono`, `Tipoe`, `codigo`, `estado`, `porcentaje_comision`, `tipo_comision`, `fecha`) VALUES
(20, 27, 52, 'MANUEL DE LA CRUZ', 'MANUEL', 'c/f', 'GUATEMALA', '22123085', 'AE', '', 0, 0, '', '2021-01-20'),
(21, 27, 52, 'CODIGO 11', 'COMERCIAL', 'c/f', 'GAUTEA', '22123085', 'AE', '', 0, 0, '', '2021-01-20'),
(22, 27, 52, 'SERVICIOS COMERCIALES', 'SERCOGUA', '2315645', 'GUATEMALA', '22123085', 'AE', '3', 0, 0, '', '2021-01-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id_usuario` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `id_depto` int(11) NOT NULL,
  `id_puesto` int(11) NOT NULL,
  `acceso` varchar(50) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `avatar` varchar(150) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id_usuario`, `id_sucursal`, `id_depto`, `id_puesto`, `acceso`, `pass`, `avatar`, `nombre`, `apellido`, `correo`, `estado`) VALUES
(52, 27, 3, 6, '123456', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1608505306.png', 'Manuel', 'De La Cruz', 'manuelcruz86@gmail.com', 1),
(53, 27, 1, 5, '1234', '1234', '', 'maritza', 'De La Cruz', 'itguatemala@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `id_Padre` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id_menu`, `nombre`, `id_Padre`) VALUES
(1, 'Administracion', 0),
(6, 'Sucursales', 1),
(7, 'Usuarios', 1),
(8, 'Registros', 0),
(9, 'Agente Embarcador', 8),
(10, 'Agencia de Carga', 8),
(11, 'Aéreo-linea', 8),
(12, 'Almacenadora', 8),
(13, 'Consignatario', 8),
(14, 'Consignado', 8),
(15, 'Embarcador', 8),
(16, 'Naviera', 8),
(17, 'Proveedor', 8),
(18, 'Transportista', 8),
(19, 'Almacen', 0),
(20, 'Kardex', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `idpais` int(11) NOT NULL,
  `idcontinente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `iniciales` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`idpais`, `idcontinente`, `nombre`, `iniciales`) VALUES
(1, 3, '﻿Abjasia', 'ABJ'),
(2, 5, 'Acrotiri y Dhekelia', 'AC'),
(3, 3, 'Afganistan', 'AF'),
(4, 5, 'Albania', 'AL'),
(5, 5, 'Alemania', 'DE'),
(6, 5, 'Andorra', 'AD'),
(7, 1, 'Angola', 'AO'),
(8, 2, 'Anguila', 'AL'),
(9, 2, 'Antigua y Barbuda', 'AG'),
(10, 3, 'Arabia Saudita', 'AS'),
(11, 1, 'Argelia', 'DZ'),
(12, 2, 'Argentina', 'AR'),
(13, 4, 'Armenia', 'AM'),
(14, 2, 'Aruba', 'AW'),
(15, 8, 'Australia', 'AU'),
(16, 5, 'Austria', 'AT'),
(17, 4, 'Azerbaiyan', 'AZ'),
(18, 2, 'Bahamas', 'BS'),
(19, 3, 'Barein', 'BRE'),
(20, 3, 'Banglades', 'BD'),
(21, 2, 'Barbados', 'BB'),
(22, 5, 'Belgica', 'BE'),
(23, 2, 'Belize', 'BZ'),
(24, 1, 'Benín', 'BJ'),
(25, 2, 'Bermudas', 'GB'),
(26, 5, 'Bielorrusia', 'BM'),
(27, 3, 'Birmania', 'MYA'),
(28, 2, 'Bolivia', 'BOL'),
(29, 5, 'Bosnia y Herzegovina', 'BIH'),
(30, 1, 'Botsuana', 'BO'),
(31, 2, 'Brasil', 'BA'),
(32, 3, 'Brunei', 'BRU'),
(33, 5, 'Bulgaria', 'BR'),
(34, 1, 'Burkina Faso', 'BUR'),
(35, 1, 'Burundi', 'BG'),
(36, 3, 'Butan', 'BI'),
(37, 1, 'Cabo Verde', 'CV'),
(38, 2, 'Caiman Islas', 'KY'),
(39, 3, 'Camboya', 'CAM'),
(40, 1, 'Camerún', 'CMR'),
(41, 2, 'Canadá', 'CA'),
(42, 3, 'Catar', 'QAT'),
(43, 1, 'Centroafricana República', 'CAF'),
(44, 1, 'Chad', 'CHA'),
(45, 5, 'Checa República', 'CZE'),
(46, 2, 'Chile', 'CL'),
(47, 3, 'China', 'CHN'),
(48, 4, 'Chipre', 'CY'),
(49, 4, 'Chipre del Norte', 'CYN'),
(50, 3, 'Cocos Islas', 'CC'),
(51, 2, 'Colombia', 'CO'),
(52, 1, 'Comoras', 'COM'),
(53, 1, 'Congo República del', 'CGO'),
(54, 1, 'Congo República Democrática del', 'COD'),
(55, 8, 'Cook Islas', 'CK'),
(56, 3, 'Corea del Norte', 'KP'),
(57, 3, 'Corea del Sur', 'KOR'),
(58, 1, 'Costa de Marfil', 'CIV'),
(59, 2, 'Costa Rica', 'CR'),
(60, 5, 'Croacia', 'CRO'),
(61, 2, 'Cuba', 'CU'),
(62, 2, 'Curazao', 'CW'),
(63, 5, 'Dinamarca', 'DEN'),
(64, 2, 'Dominica', 'DMA'),
(65, 2, 'Dominicana República', 'DOM'),
(66, 2, 'Ecuador', 'EC'),
(67, 1, 'Egipto', 'EG'),
(68, 2, 'El Salvador', 'SV'),
(69, 3, 'Emiratos Árabes Unidos', 'AE'),
(70, 1, 'Eritrea', 'ERI'),
(71, 5, 'Eslovaquia', 'SVK'),
(72, 5, 'Eslovenia', 'SLO'),
(73, 5, 'España', 'ES'),
(74, 3, 'Estado Islámico', 'EIS'),
(75, 2, 'Estados Unidos', 'US'),
(76, 5, 'Estonia', 'EST'),
(77, 1, 'Etiopía', 'ETH'),
(78, 5, 'Feroe Islas', 'FRO'),
(79, 3, 'Filipinas', 'PHI'),
(80, 5, 'Finlandia', 'FIN'),
(81, 8, 'Fiyi', 'FIJ'),
(82, 5, 'Francia', 'FR'),
(83, 1, 'Gabón', 'GAB'),
(84, 1, 'Gambia', 'GAM'),
(85, 4, 'Georgia', 'GEO'),
(86, 1, 'Ghana', 'GHA'),
(87, 5, 'Gibraltar', 'GBZ'),
(88, 2, 'Granada', 'GRN'),
(89, 5, 'Grecia', 'GRE'),
(90, 2, 'Groenlandia', 'GL'),
(91, 8, 'Guam', 'GU'),
(92, 2, 'Guatemala', 'GT'),
(93, 5, 'Guernsey', 'GG'),
(94, 1, 'Guinea', 'GUI'),
(95, 1, 'Guinea-Bisáu', 'GBS'),
(96, 1, 'Guinea Ecuatorial', 'GEQ'),
(97, 2, 'Guyana', 'GUY'),
(98, 2, 'Haití', 'HAI'),
(99, 2, 'Honduras', 'HN'),
(100, 3, 'Hong Kong', 'HK'),
(101, 5, 'Hungría', 'HUN'),
(102, 3, 'India', 'IND'),
(103, 3, 'Indonesia', 'INA'),
(104, 3, 'Irak', 'IRQ'),
(105, 3, 'Irán', 'IRI'),
(106, 5, 'Irlanda', 'IRL'),
(107, 5, 'Islandia', 'ISL'),
(108, 3, 'Israel', 'ISR'),
(109, 5, 'Italia', 'ITA'),
(110, 2, 'Jamaica', 'JAM'),
(111, 3, 'Japón', 'JPN'),
(112, 5, 'Jersey', 'JE'),
(113, 3, 'Jordania', 'JOR'),
(114, 4, 'Kazajistán', 'KAZ'),
(115, 1, 'Kenia', 'KEN'),
(116, 3, 'Kirguistán', 'KGZ'),
(117, 8, 'Kiribati', 'KIR'),
(118, 5, 'Kosovo', 'RKS'),
(119, 3, 'Kuwait', 'KUW'),
(120, 3, 'Laos', 'LAO'),
(121, 1, 'Lesoto', 'LES'),
(122, 5, 'Letonia', 'LV'),
(123, 3, 'Líbano', 'LIB'),
(124, 1, 'Liberia', 'LB'),
(125, 1, 'Libia', 'LBA'),
(126, 5, 'Liechtenstein', 'LIE'),
(127, 5, 'Lituania', 'LTU'),
(128, 5, 'Luxemburgo', 'LUX'),
(129, 3, 'Macao', 'MO'),
(130, 5, 'Macedonia', 'MKD'),
(131, 1, 'Madagascar', 'MAD'),
(132, 3, 'Malasia', 'MAS'),
(133, 1, 'Malaui', 'MAW'),
(134, 3, 'Maldivas', 'MDV'),
(135, 1, 'Malí', 'MLI'),
(136, 5, 'Malta', 'MLT'),
(137, 2, 'Malvinas, Islas', 'MIS'),
(138, 5, 'Man Isla de', 'ISM'),
(139, 8, 'Marianas del Norte Islas', 'NIM'),
(140, 1, 'Marruecos', 'MAR'),
(141, 8, 'Marshall Islas', 'MHL'),
(142, 1, 'Mauricio', 'MRI'),
(143, 1, 'Mauritania', 'MTN'),
(144, 2, 'México', 'MX'),
(145, 8, 'Micronesia', 'MCA'),
(146, 5, 'Moldavia', 'MDA'),
(147, 5, 'Mónaco', 'MON '),
(148, 3, 'Mongolia', 'MGL'),
(149, 5, 'Montenegro', 'MNE'),
(150, 2, 'Montserrat', 'MSR'),
(151, 1, 'Mozambique', 'MOZ'),
(152, 4, 'Nagorno Karabaj', 'NKJ'),
(153, 1, 'Namibia', 'NAM'),
(154, 8, 'Nauru', 'NRU'),
(155, 3, 'Navidad Isla de', 'IDN'),
(156, 3, 'Nepal', 'NEP'),
(157, 2, 'Nicaragua', 'NI'),
(158, 1, 'Níger', 'NIG'),
(159, 1, 'Nigeria', 'NGR'),
(160, 8, 'Niue', 'UN'),
(161, 8, 'Norfolk Isla', 'INK'),
(162, 5, 'Noruega', 'NOR'),
(163, 8, 'Nueva Caledonia', 'NC'),
(164, 5, 'Nueva Rusia', 'NR'),
(165, 8, 'Nueva Zelanda', 'NZL'),
(166, 3, 'Omán', 'OMA'),
(167, 4, 'Osetia del Sur', 'OS'),
(168, 5, 'Países Bajos', 'NED'),
(169, 3, 'Pakistán', 'PAK'),
(170, 8, 'Palaos', 'PL'),
(171, 3, 'Palestina', 'PS'),
(172, 2, 'Panamá', 'PA'),
(173, 8, 'Papúa Nueva Guinea', 'PNG'),
(174, 2, 'Paraguay', 'PY'),
(175, 2, 'Perú', 'PER'),
(176, 8, 'Pitcairn Islas', 'IP'),
(177, 8, 'Polinesia Francesa', 'PF'),
(178, 5, 'Polonia', 'POL'),
(179, 5, 'Portugal', 'POR'),
(180, 2, 'Puerto Rico', 'PR'),
(181, 5, 'Reino Unido', 'RU'),
(182, 1, 'Ruanda', 'RUD'),
(183, 5, 'Rumania', 'RO'),
(184, 6, 'Rusia', 'RUS'),
(185, 1, 'Sahara Occidental', 'SO'),
(186, 8, 'Salomón Islas', 'ISM'),
(187, 8, 'Samoa', 'SAM'),
(188, 8, 'Samoa Americana', 'AS'),
(189, 2, 'San Bartolomé', 'SB'),
(190, 2, 'San Cristóbal y Nieves', 'SCN'),
(191, 5, 'San Marino', 'SM'),
(192, 2, 'San Martín', 'SMN'),
(193, 2, 'Sint Maarten', 'SMT'),
(194, 2, 'San Pedro y Miquelón', 'SPM'),
(195, 2, 'San Vicente y las Granadinas', 'SVG'),
(196, 7, 'Santa Elena  Ascensión y Tristán de Acuña', 'SET'),
(197, 2, 'Santa Lucía', 'STL'),
(198, 1, 'Santo Tomé y Príncipe', 'STP'),
(199, 1, 'Senegal', 'SEN'),
(200, 5, 'Serbia', 'SRB'),
(201, 1, 'Seychelles', 'SEY'),
(202, 1, 'Sierra Leona', 'SLE'),
(203, 3, 'Singapur', 'SIN'),
(204, 3, 'Siria', 'SYR'),
(205, 1, 'Somalia', 'SOM'),
(206, 1, 'Somalilandia', 'SOD'),
(207, 3, 'Sri Lanka', 'SLK'),
(208, 1, 'Suazilandia', 'SWZ'),
(209, 1, 'Sudáfrica', 'ZA'),
(210, 1, 'Sudán', 'SUD'),
(211, 1, 'Sudán del Sur', 'SDS'),
(212, 5, 'Suecia', 'SE'),
(213, 5, 'Suiza', 'SUI'),
(214, 2, 'Surinam', 'SUR'),
(215, 5, 'Svalbard', 'SVD'),
(216, 3, 'Tailandia', 'THA'),
(217, 3, 'Taiwán', 'TW'),
(218, 1, 'Tanzania', 'TAN'),
(219, 3, 'Tayikistán', 'TJ'),
(220, 3, 'Timor Oriental', 'TL'),
(221, 1, 'Togo', 'TG'),
(222, 8, 'Tokelau', 'TK'),
(223, 8, 'Tonga', 'TGA'),
(224, 5, 'Transnistria', 'TNA'),
(225, 2, 'Trinidad y Tobago', 'TT'),
(226, 1, 'Túnez', 'TN'),
(227, 2, 'Turcas y Caicos Islas', 'ITC'),
(228, 3, 'Turkmenistán', 'TKM'),
(229, 4, 'Turquía', 'TUR'),
(230, 8, 'Tuvalu', 'TUV'),
(231, 5, 'Ucrania', 'UKR'),
(232, 1, 'Uganda', 'UGA'),
(233, 2, 'Uruguay', 'URU'),
(234, 3, 'Uzbekistán', 'UZB'),
(235, 8, 'Vanuatu', 'VNT'),
(236, 5, 'Vaticano Ciudad del', 'CDV'),
(237, 2, 'Venezuela', 'VEN'),
(238, 3, 'Vietnam', 'VIE'),
(239, 2, 'Vírgenes Británicas Islas', 'IVB'),
(240, 2, 'Vírgenes de los Estados Unidos Islas', 'IVU'),
(241, 8, 'Wallis y Futuna', 'WF'),
(242, 3, 'Yemen', 'YM'),
(243, 1, 'Yibuti', 'YT'),
(244, 1, 'Zambia', 'ZB'),
(245, 1, 'Zimbabue', 'ZBB');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id_permiso` int(11) NOT NULL,
  `nombre` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id_permiso`, `nombre`) VALUES
(1, 'Consultar'),
(2, 'Agregar'),
(3, 'Editar'),
(4, 'Eliminar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `id_puesto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`id_puesto`, `nombre`) VALUES
(1, 'Asistente Cobros'),
(2, 'Asistente Pagos'),
(3, 'Gerente'),
(4, 'Coordinador'),
(5, 'Operaciones'),
(6, 'Programador'),
(7, 'Telemarketing');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `id_sucursal` int(11) NOT NULL,
  `razons` varchar(75) NOT NULL,
  `nombrec` varchar(75) NOT NULL,
  `Telefono` varchar(50) NOT NULL,
  `identificacion` varchar(50) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `fechaingreso` date DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `idpais` int(11) NOT NULL,
  `codigo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`id_sucursal`, `razons`, `nombrec`, `Telefono`, `identificacion`, `direccion`, `logo`, `fechaingreso`, `estado`, `idpais`, `codigo`) VALUES
(0, 'ALAMDISA DE NICARAGUA', 'ALMADISA DE NUCA', '50222123085', 'identi', 'nicaragua', '', '2021-01-20', 1, 0, 'ALMNI3'),
(1, 'Servicios Comerciales de Guatemala', 'Sercogua', '50223037000', '22354589', '0 calle b 17-10 colonia el maestro zona 15, Guatemala', 'logo2.jfif', '2021-01-06', 1, 92, 'SERGT1'),
(27, 'Almacenamiento Manejo y Distribuci&oacute;n de Guatemala', 'Almadisa', '50222123085', '123445', 'Interior Alpasa', '', '2021-01-06', 1, 92, 'ALMGT1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id_almacen`);

--
-- Indices de la tabla `asigna_menu`
--
ALTER TABLE `asigna_menu`
  ADD PRIMARY KEY (`idasigna_menu`);

--
-- Indices de la tabla `contactos_e`
--
ALTER TABLE `contactos_e`
  ADD PRIMARY KEY (`id_contacto`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Indices de la tabla `continente`
--
ALTER TABLE `continente`
  ADD PRIMARY KEY (`nombre`),
  ADD UNIQUE KEY `idcontinente_UNIQUE` (`idcontinente`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `depto`
--
ALTER TABLE `depto`
  ADD PRIMARY KEY (`id_depto`);

--
-- Indices de la tabla `detalle_almacen`
--
ALTER TABLE `detalle_almacen`
  ADD PRIMARY KEY (`id_detalle`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`idpais`),
  ADD UNIQUE KEY `idpais_UNIQUE` (`idpais`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`id_puesto`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`id_sucursal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id_almacen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asigna_menu`
--
ALTER TABLE `asigna_menu`
  MODIFY `idasigna_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `contactos_e`
--
ALTER TABLE `contactos_e`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `depto`
--
ALTER TABLE `depto`
  MODIFY `id_depto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `detalle_almacen`
--
ALTER TABLE `detalle_almacen`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `idpais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `id_puesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
