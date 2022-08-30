-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2020 a las 18:03:41
-- Versión del servidor: 10.3.15-MariaDB
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `micole.net_norest`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id` int(11) NOT NULL,
  `NIF` varchar(20) NOT NULL,
  `img` varchar(255) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `apellido2` varchar(20) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `tutor1` int(20) NOT NULL,
  `tutor2` int(20) DEFAULT NULL,
  `tutor3` int(20) DEFAULT NULL,
  `curso` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id`, `NIF`, `img`, `nombre`, `apellido`, `apellido2`, `fecha_nacimiento`, `tutor1`, `tutor2`, `tutor3`, `curso`) VALUES
(3, '23442353245', '../uploads/Copia de Informática Alteanense SL es una empresa de servicios informáticos fundada en 2009 y enfocada a cubrir todas aquellas necesidades de los partículares como empresariales, tanto en hardware como software..png', 'Alumno   ', 'Apellido1     ', 'Apellido2     ', '2020-04-07', 1, 2, NULL, 7),
(4, '', '../uploads/814(1).gif', 'Alumno2        ', 'Apellido1        ', 'Apellido2        ', '2020-04-01', 1, 2, NULL, 7),
(8, '23523345234', '../uploads/814(1).gif', 'Alumno3      ', 'Apellido1      ', 'Apellido2   ', '2020-04-09', 2, 10, NULL, 7),
(24, 'rasdfasdf', '../uploads/Screenshot_1481.png', 'Alumno4 ', 'Apellido1 ', 'Apellido2 ', '2020-04-16', 2, 10, NULL, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnoasisitetemaaula`
--

CREATE TABLE `alumnoasisitetemaaula` (
  `IDALUMNO` int(10) NOT NULL,
  `IDAULA` int(10) NOT NULL,
  `IDTEMA` int(20) NOT NULL,
  `asistencia` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumnoasisitetemaaula`
--

INSERT INTO `alumnoasisitetemaaula` (`IDALUMNO`, `IDAULA`, `IDTEMA`, `asistencia`) VALUES
(3, 1, 1, 0),
(3, 1, 2, 1),
(3, 1, 3, 1),
(3, 1, 4, 1),
(3, 1, 22, 1),
(3, 1, 23, 1),
(4, 1, 1, 1),
(4, 1, 2, 0),
(4, 1, 3, 0),
(4, 1, 4, 0),
(4, 1, 7, 0),
(4, 1, 8, 0),
(4, 1, 22, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `curso` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id`, `nombre`, `descripcion`, `curso`) VALUES
(1, 'Matemáticas 1º Infantil', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus maximus scelerisque. Suspendisse ac ante magna. Etiam egestas at felis viverra', 7),
(2, 'Inglés 1º Infantil ', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus maximus scelerisque. Suspendisse ac ante magna. Etiam egestas at felis viverra', 7),
(3, 'L. Castellana 1º Infantil ', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus maximus scelerisque. Suspendisse ac ante magna. Etiam egestas at felis viverra', 7),
(5, 'Música 1º Infantil ', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus maximus scelerisque. Suspendisse ac ante magna. Etiam egestas at felis viverra', 7),
(6, 'Matemáticas 2º Infantil', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus maximus scelerisque. Suspendisse ac ante magna. Etiam egestas at felis viverra', 8),
(7, ' Inglés 2º Infantil ', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus maximus scelerisque. Suspendisse ac ante magna. Etiam egestas at felis viverra', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aula`
--

CREATE TABLE `aula` (
  `id` int(10) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `centro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `aula`
--

INSERT INTO `aula` (`id`, `nombre`, `centro`) VALUES
(1, 'AULA1', 1),
(2, 'AULA2', 1),
(8, 'AULA3', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buzon`
--

CREATE TABLE `buzon` (
  `id` bigint(20) NOT NULL,
  `id2` bigint(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `user1` varchar(150) NOT NULL,
  `user2` varchar(150) NOT NULL,
  `user1type` varchar(1) NOT NULL,
  `user2type` varchar(1) NOT NULL,
  `message` text NOT NULL,
  `timestamp` int(10) NOT NULL,
  `user1read` varchar(3) NOT NULL,
  `user2read` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `buzon`
--

INSERT INTO `buzon` (`id`, `id2`, `title`, `user1`, `user2`, `user1type`, `user2type`, `message`, `timestamp`, `user1read`, `user2read`) VALUES
(1, 1, 'ASDFAS', 'docente1@docente.com', 'docente2@docente.com', 'd', 'd', '                      <br />\r\n                    ASDFASDF', 1589488828, 'yes', 'yes'),
(1, 2, '', 'docente2@docente.com', 'docente1@docente.com', 'd', 'd', 'ASDFASDF', 1589488838, '', ''),
(1, 4, '', 'docente2@docente.com', 'docente1@docente.com', 'd', 'd', 'ASDFASDF', 1589488849, '', ''),
(4, 1, 'de docente a tutor', 'docente1@docente.com', 'benja@infoaltea.net', 'd', 't', 'de docente a tutor', 1589488876, 'yes', 'yes'),
(4, 2, '', 'docente1@docente.com', 'benja@infoaltea.net', 't', 'd', 'ASDasd', 1589488895, '', ''),
(4, 3, '', 'docente1@docente.com', 'benja@infoaltea.net', 't', 'd', 'sunboasdf', 1589531619, '', ''),
(7, 1, 'test', 'docente1@docente.com', 'benja@infoaltea.net', 'd', 't', 'test1', 1590142190, 'yes', 'yes'),
(7, 2, '', 'docente1@docente.com', 'benja@infoaltea.net', 't', 'd', 'sdfsdf', 1590142302, '', ''),
(7, 4, '', 'benja@infoaltea.net', 'docente1@docente.com', 'd', 't', 'asdfasdf', 1590142329, '', ''),
(10, 1, 'de docente a tutor', 'docente1@docente.com', 'benja@infoaltea.net', 'd', 't', 'hola', 1590216422, 'yes', 'yes'),
(10, 2, '', 'benja@infoaltea.net', 'docente1@docente.com', 'd', 't', 'docente otra vez', 1590216448, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro`
--

CREATE TABLE `centro` (
  `ID` int(10) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `CIF` varchar(20) NOT NULL,
  `calle` varchar(20) NOT NULL,
  `n_calle` varchar(20) NOT NULL,
  `CP` int(10) NOT NULL,
  `logo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `centro`
--

INSERT INTO `centro` (`ID`, `nombre`, `CIF`, `calle`, `n_calle`, `CP`, `logo`) VALUES
(1, 'Centro1', 'B5444444', 'Avda JaumeI', '20', 3590, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id` int(10) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `ciclo` varchar(20) NOT NULL,
  `descripcion` longtext NOT NULL,
  `docente_tutor` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id`, `nombre`, `ciclo`, `descripcion`, `docente_tutor`) VALUES
(7, 'Primero ', 'Infantil', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus maximus scelerisque. Suspendisse ac ante magna. Etiam egestas at felis viverra aliquam. Nullam eu orci semper, condimentum ipsum sed, vehicula enim. Morbi ut ex nibh. Donec quis lorem ultrices, sagittis massa et, dapibus nibh. Nam vitae odio non risus lacinia placerat at in diam. Maecenas quis dignissim purus, at facilisis ante. ', 1),
(8, 'Segundo ', 'Infantil', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus maximus scelerisque. Suspendisse ac ante magna. Etiam egestas at felis viverra aliquam. Nullam eu orci semper, condimentum ipsum sed, vehicula enim. Morbi ut ex nibh. Donec quis lorem ultrices, sagittis massa et, dapibus nibh. Nam vitae odio non risus lacinia placerat at in diam. Maecenas quis dignissim purus, at facilisis ante. ', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `id` int(10) NOT NULL,
  `CIF` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `apellido2` varchar(20) NOT NULL,
  `img` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contrasenya` varchar(255) NOT NULL,
  `rol` varchar(20) NOT NULL DEFAULT 'docente',
  `is_admin` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`id`, `CIF`, `nombre`, `apellido`, `apellido2`, `img`, `email`, `contrasenya`, `rol`, `is_admin`) VALUES
(1, '3434534F', 'Docente1', 'Apellido1', 'Apellido2', '../uploads/editor-1s-48px.png', 'docente1@docente.com', '202cb962ac59075b964b07152d234b70', 'docente', '1'),
(2, '3434234534F', 'Docente2', 'Apellido1', 'Apellido2', '../uploads/bxzgfr_2680db0b536d463cdb45bac9c634e987.jpg', 'docente2@docente.com', '202cb962ac59075b964b07152d234b70', 'docente', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docenteasisitetemaaula`
--

CREATE TABLE `docenteasisitetemaaula` (
  `IDDOCENTE` int(10) NOT NULL,
  `IDAULA` int(10) NOT NULL,
  `IDTEMA` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `docenteasisitetemaaula`
--

INSERT INTO `docenteasisitetemaaula` (`IDDOCENTE`, `IDAULA`, `IDTEMA`) VALUES
(1, 1, 1),
(1, 1, 4),
(1, 1, 5),
(4, 1, 8),
(8, 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen`
--

CREATE TABLE `examen` (
  `IDALUMNO` int(11) NOT NULL,
  `IDASIGNATURA` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `nota` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `examen`
--

INSERT INTO `examen` (`IDALUMNO`, `IDASIGNATURA`, `fecha`, `nota`) VALUES
(2, 1, '2020-03-24', '5.00'),
(2, 2, '2020-03-25', '5.00'),
(3, 1, '2020-04-04', '10.00'),
(3, 1, '2020-05-15', '6.50'),
(3, 2, '2020-04-15', '10.00'),
(3, 3, '2020-04-01', '5.00'),
(3, 3, '2020-05-06', '7.20'),
(3, 5, '2020-05-01', '1.20'),
(3, 5, '2020-05-04', '1.00'),
(4, 1, '2020-03-31', '5.00'),
(4, 2, '2020-04-15', '9.99'),
(4, 3, '2020-04-01', '8.70'),
(24, 1, '2020-04-06', '1.00'),
(24, 1, '2020-04-14', '1.00'),
(24, 1, '2020-04-27', '1.00'),
(24, 2, '2020-04-01', '5.00'),
(24, 3, '2020-04-01', '1.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frontend`
--

CREATE TABLE `frontend` (
  `ID` int(11) NOT NULL,
  `seo_titulo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `seo_descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `logo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `favicon` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `primary_color` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `banner_text` text COLLATE utf8_spanish_ci NOT NULL,
  `menu1` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `menu1_subtitle` text COLLATE utf8_spanish_ci NOT NULL,
  `menu1_icon1` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `menu1_icon1_title` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `menu1_icon1_text` text COLLATE utf8_spanish_ci NOT NULL,
  `menu1_icon2` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `menu1_icon2_title` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `menu1_icon2_text` text COLLATE utf8_spanish_ci NOT NULL,
  `menu1_icon3` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `menu1_icon3_title` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `menu1_icon3_text` text COLLATE utf8_spanish_ci NOT NULL,
  `menu2` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `menu2_subtitle` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `menu2_text` text COLLATE utf8_spanish_ci NOT NULL,
  `menu2_icon1_top` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `menu2_icon2_top` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `menu2_icon3_top` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `menu2_icon1_text` text COLLATE utf8_spanish_ci NOT NULL,
  `menu2_icon2_text` text COLLATE utf8_spanish_ci NOT NULL,
  `menu2_icon3_text` text COLLATE utf8_spanish_ci NOT NULL,
  `foto_direc1` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `foto_direc2` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `foto_direc3` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `testimonio1` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `testimonio1_text` text COLLATE utf8_spanish_ci NOT NULL,
  `testimonio2` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `testimonio2_text` text COLLATE utf8_spanish_ci NOT NULL,
  `menu3` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `menu3_subtitle` text COLLATE utf8_spanish_ci NOT NULL,
  `menu3_1_img` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `menu3_1_title` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `menu3_1_text` text COLLATE utf8_spanish_ci NOT NULL,
  `menu3_2_img` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `menu3_2_title` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `menu3_2_text` text COLLATE utf8_spanish_ci NOT NULL,
  `menu3_3_img` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `menu3_3_title` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `menu3_3_text` text COLLATE utf8_spanish_ci NOT NULL,
  `menu4` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `menu4_text` text COLLATE utf8_spanish_ci NOT NULL,
  `slider_title` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `slider_subtitle` longtext COLLATE utf8_spanish_ci NOT NULL,
  `slider_texto` longtext COLLATE utf8_spanish_ci NOT NULL,
  `slider_img` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `centro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `frontend`
--

INSERT INTO `frontend` (`ID`, `seo_titulo`, `seo_descripcion`, `logo`, `favicon`, `primary_color`, `banner_text`, `menu1`, `menu1_subtitle`, `menu1_icon1`, `menu1_icon1_title`, `menu1_icon1_text`, `menu1_icon2`, `menu1_icon2_title`, `menu1_icon2_text`, `menu1_icon3`, `menu1_icon3_title`, `menu1_icon3_text`, `menu2`, `menu2_subtitle`, `menu2_text`, `menu2_icon1_top`, `menu2_icon2_top`, `menu2_icon3_top`, `menu2_icon1_text`, `menu2_icon2_text`, `menu2_icon3_text`, `foto_direc1`, `foto_direc2`, `foto_direc3`, `testimonio1`, `testimonio1_text`, `testimonio2`, `testimonio2_text`, `menu3`, `menu3_subtitle`, `menu3_1_img`, `menu3_1_title`, `menu3_1_text`, `menu3_2_img`, `menu3_2_title`, `menu3_2_text`, `menu3_3_img`, `menu3_3_title`, `menu3_3_text`, `menu4`, `menu4_text`, `slider_title`, `slider_subtitle`, `slider_texto`, `slider_img`, `centro`) VALUES
(1, 'Colegio de Prueba 1', 'Descripcion Colegio Prueba1', '../uploads/logo_03[1].png', '../favicon.ico', '#ff00ea', 'MiCole.Net será su aliado para agilizar la gestión del centro, docentes y alumnado. Y su herramienta para comunicación interna y con padres y madres', 'Nuestros Valores', 'Donec et lectus bibendum dolor dictum auctor in ac erat. ', 'fas fa-ambulance', 'Colegio Moderno', 'Donec et lectus bibendum dolor dictum auctor in ac erat. Vestibulum egestas sollicitudin metus non urna in eros tincidunt convallis id id nisi in interdum.', 'fas fa-air-freshener', 'Alumnos Felices', 'Donec et lectus bibendum dolor dictum auctor in ac erat. Vestibulum egestas sollicitudin metus non urna in eros tincidunt convallis id id nisi in interdum.', 'fas fa-chalkboard-teacher', 'Docentes Profesionales', 'Donec et lectus bibendum dolor dictum auctor in ac erat. Vestibulum egestas sollicitudin metus non urna in eros tincidunt convallis id id nisi in interdum.', 'Ventajas', '(Estadísticas reales...)', 'Donec et lectus bibendum dolor dictum auctor in ac erat. Vestibulum egestas sollicitudin metus non urna in eros tincidunt convallis id id nisi in interdum.', '+150', '1h', '100%', 'Centros Adaptados 2020', 'Tiempo Respuesta Soporte', 'Centros recomiendan MiCole.Net ', '../uploads/android-chrome-256x256.png', '../uploads/emmet.png', '../uploads/snippets-cson.jpg', 'John López - Padre alumna 2º Primaria', 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, nec sagittis sem ', 'Mª José Pérez - Madre alumno 1º Infantil', 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, nec sagittis sem', 'Nuestro Centro ', 'sdfasdf', '../uploads/Untitled.png', 'sdfgsdfg', 'cxvbxcvb', '../uploads/android-chrome-256x256.png', 'xcvbxcvb', 'xcvbxcvb', '../uploads/índice.png', 'xcvb', 'xcvb', 'Tarifas', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem nesciunt vitae, maiores, magni dolorum aliquam.', 'EDUCACIÓN DE CALIDAD', '¡Una educación de calidad para sus hijos nunca fué tan fácil!', ' Nuestro colegio será su aliado para conseguir los objetivos educativos de sus hijos en un entorno moderno, aplicándo las últimas tecnologías y con los docentes más preparados. \r\n\r\n           ', '/uploads/img_231444.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impartirtemaaula`
--

CREATE TABLE `impartirtemaaula` (
  `IDAULA` int(10) NOT NULL,
  `IDTEMA` int(10) NOT NULL,
  `IDDOCENTE` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `hora_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `impartirtemaaula`
--

INSERT INTO `impartirtemaaula` (`IDAULA`, `IDTEMA`, `IDDOCENTE`, `fecha`, `hora`, `hora_fin`) VALUES
(1, 1, 1, '2020-04-27', '09:00:00', '10:00:00'),
(1, 2, 1, '2020-04-27', '10:00:00', '11:00:00'),
(1, 3, 1, '2020-04-27', '11:00:00', '13:00:00'),
(1, 4, 1, '2020-04-27', '13:00:00', '14:00:00'),
(1, 7, 2, '2020-04-27', '14:00:00', '15:00:00'),
(1, 8, 1, '2020-04-27', '15:00:00', '16:00:00'),
(1, 22, 1, '2020-04-28', '09:00:00', '10:00:00'),
(2, 20, 2, '2020-04-27', '13:10:00', '14:30:00'),
(2, 21, 2, '2020-04-27', '14:30:00', '15:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temaasignatura`
--

CREATE TABLE `temaasignatura` (
  `ID` int(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `asignatura` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `temaasignatura`
--

INSERT INTO `temaasignatura` (`ID`, `nombre`, `descripcion`, `asignatura`) VALUES
(1, 'Tema 1 Matemáticas 1', 'Tema 1 Matemáticas 1º Infantil', 1),
(2, 'Tema 2 Matemáticas 1', 'Tema 2 Matemáticas 1º Infantil', 1),
(3, 'Tema 1 Inglés 2', 'Tema 1 Inglés 2º Infantil', 2),
(4, 'Tema 2 Inglés 2', 'Tema 2 Inglés 2º Infantil', 2),
(7, 'Tema 1  Lengua Castellana', 'Tema 1 de  Lengua Castellana de Primero Infantil', 3),
(8, 'Tema 2  Lengua Castellana', 'Tema 2 de  Lengua Castellana de Primero Infantil', 3),
(20, ' Tema 1 Música 1 ', ' Tema 1 Música 1º Infantil', 5),
(21, ' Tema 2 Música 1º Infantil', ' Tema 2 Música 1º Infantil', 5),
(22, 'Tema 3 Lengua Castallano', 'Tema 3 Lengua Castallano Primero Infantil', 3),
(23, 'Tema 4 Lengua Castallano', 'Tema 3 Lengua Castallano Primero Infantil', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor`
--

CREATE TABLE `tutor` (
  `id` int(20) NOT NULL,
  `NIF` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contrasenya` varchar(255) NOT NULL,
  `relacion_alumno` varchar(20) NOT NULL,
  `img` varchar(255) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `apellido2` varchar(20) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `movil` varchar(20) NOT NULL,
  `calle` varchar(20) NOT NULL,
  `n_calle` int(10) NOT NULL,
  `CP` int(10) NOT NULL,
  `poblacion` varchar(20) NOT NULL,
  `provincia` varchar(20) NOT NULL,
  `xtra_direccion` varchar(40) NOT NULL,
  `rol` varchar(20) DEFAULT 'tutor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tutor`
--

INSERT INTO `tutor` (`id`, `NIF`, `email`, `contrasenya`, `relacion_alumno`, `img`, `nombre`, `apellido`, `apellido2`, `telefono`, `movil`, `calle`, `n_calle`, `CP`, `poblacion`, `provincia`, `xtra_direccion`, `rol`) VALUES
(1, 'X1463667Q', 'benja@infoaltea.net', '202cb962ac59075b964b07152d234b70', 'Padre', '../uploads/image (1).png', 'Benjamin', 'Pastor', 'Briones', '965847284', '686535154', 'Judia', 8, 3590, 'Altea', 'Alicante', 'Loca A', 'tutor'),
(2, 'X143667R', 'padre1@padre1.com', '202cb962ac59075b964b07152d234b70', 'Padre', 'photoshop_new.png', 'Padre', 'Apellido1', 'Apellido2', '965847284', '686535154', 'Judia', 8, 3599, 'Altea', 'Alicante', '', 'tutor'),
(10, '12345555X', 'padre2@padres.com', 'd41d8cd98f00b204e9800998ecf8427e', '', '../uploads/814.gif', 'Padre2', 'Apellido1', 'Apellidos2', '966885555', '686665566', 'Calle', 3, 3590, 'Altea', 'Alicante', '', 'tutor');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `NIF` (`NIF`),
  ADD KEY `tutor1` (`tutor1`,`tutor2`,`tutor3`,`curso`),
  ADD KEY `curso` (`curso`);

--
-- Indices de la tabla `alumnoasisitetemaaula`
--
ALTER TABLE `alumnoasisitetemaaula`
  ADD PRIMARY KEY (`IDALUMNO`,`IDAULA`,`IDTEMA`),
  ADD KEY `IDTEMA` (`IDTEMA`),
  ADD KEY `IDAULA` (`IDAULA`);

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curso` (`curso`);

--
-- Indices de la tabla `aula`
--
ALTER TABLE `aula`
  ADD PRIMARY KEY (`id`),
  ADD KEY `centro` (`centro`);

--
-- Indices de la tabla `buzon`
--
ALTER TABLE `buzon`
  ADD PRIMARY KEY (`id`,`id2`),
  ADD KEY `user1` (`user1`,`user2`),
  ADD KEY `user2` (`user2`);

--
-- Indices de la tabla `centro`
--
ALTER TABLE `centro`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `docente_tutor` (`docente_tutor`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `docenteasisitetemaaula`
--
ALTER TABLE `docenteasisitetemaaula`
  ADD PRIMARY KEY (`IDDOCENTE`,`IDAULA`,`IDTEMA`),
  ADD KEY `IDTEMA` (`IDTEMA`),
  ADD KEY `IDAULA` (`IDAULA`);

--
-- Indices de la tabla `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`IDALUMNO`,`IDASIGNATURA`,`fecha`),
  ADD KEY `IDASIGNATURA` (`IDASIGNATURA`);

--
-- Indices de la tabla `frontend`
--
ALTER TABLE `frontend`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `centro` (`centro`);

--
-- Indices de la tabla `impartirtemaaula`
--
ALTER TABLE `impartirtemaaula`
  ADD PRIMARY KEY (`IDAULA`,`IDTEMA`,`fecha`);

--
-- Indices de la tabla `temaasignatura`
--
ALTER TABLE `temaasignatura`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `asignatura` (`asignatura`),
  ADD KEY `ID` (`ID`),
  ADD KEY `asignatura_2` (`asignatura`);

--
-- Indices de la tabla `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `aula`
--
ALTER TABLE `aula`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `frontend`
--
ALTER TABLE `frontend`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `temaasignatura`
--
ALTER TABLE `temaasignatura`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `tutor`
--
ALTER TABLE `tutor`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
