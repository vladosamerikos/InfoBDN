-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-09-2022 a las 08:13:49
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `infobdn`
--
CREATE DATABASE IF NOT EXISTS `infobdn` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `infobdn`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `Mail` varchar(55) NOT NULL,
  `Password` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`Mail`, `Password`) VALUES
('alberadmin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
('vladadmin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnes`
--

CREATE TABLE `alumnes` (
  `DNI` varchar(12) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Cognoms` varchar(20) NOT NULL,
  `Edat` int(3) NOT NULL,
  `Foto` varchar(255) NOT NULL,
  `Mail` varchar(55) NOT NULL,
  `Password` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnes`
--

INSERT INTO `alumnes` (`DNI`, `Nom`, `Cognoms`, `Edat`, `Foto`, `Mail`, `Password`) VALUES
('12345678B', 'Pepe', 'Gs', 12, '', 'pepe@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `Codi` int(3) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Descripcio` varchar(255) NOT NULL,
  `Horres_durara` int(3) NOT NULL,
  `Data_inici` date NOT NULL,
  `Data_final` date NOT NULL,
  `DNI_prof` varchar(12) NOT NULL,
  `Actiu` varchar(2) NOT NULL DEFAULT 'si'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`Codi`, `Nom`, `Descripcio`, `Horres_durara`, `Data_inici`, `Data_final`, `DNI_prof`, `Actiu`) VALUES
(1, 'ASIX', 'ASIX', 300, '2022-09-01', '2022-09-30', '123456', 'no'),
(2, 'daw', 'DAW', 300, '2022-09-30', '2022-12-21', '87654321B', 'si'),
(4, 'DAW2', 'DAW2', 333, '2022-10-09', '2022-12-30', '3333333', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `DNI_alum` varchar(12) NOT NULL,
  `Codi_curs` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professor`
--

CREATE TABLE `professor` (
  `DNI` varchar(12) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Cognoms` varchar(20) NOT NULL,
  `Titol_academic` varchar(20) NOT NULL,
  `Foto` varchar(255) NOT NULL,
  `mail` varchar(55) NOT NULL,
  `Actiu` varchar(2) NOT NULL DEFAULT 'si',
  `password` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `professor`
--

INSERT INTO `professor` (`DNI`, `Nom`, `Cognoms`, `Titol_academic`, `Foto`, `mail`, `Actiu`, `password`) VALUES
('12312', 'Vlad', 'asdada', 'dsada', 'img/12312.jpg', '123dsadadasda1@gmail.com', 'si', '827ccb0eea8a706c4c34a16891f84e7b'),
('123456', 'Vlad', 'Pasichnyk', 'DAW', 'img/123456.png', 'vladmod@gmail.com', 'si', '827ccb0eea8a706c4c34a16891f84e7b'),
('321', '3211', '321', '321', 'img/321.png', '321@gmail.com', 'si', '827ccb0eea8a706c4c34a16891f84e7b'),
('321pep123', 'Pep', 'Pep', 'DAW', 'img/321pep123.jpg', '123pep@gmail.com', 'si', '827ccb0eea8a706c4c34a16891f84e7b'),
('3333333', 'Alber', '123', '123', 'img/3333333.png', 'albert@gmail.com', 'si', '827ccb0eea8a706c4c34a16891f84e7b'),
('87654321B', 'Pepe', 'lol', 'ASIX', 'img/87654321B.png', 'pepe@gmail.com', 'si', '827ccb0eea8a706c4c34a16891f84e7b'),
('nou1', 'nou1', 'nou1', 'nou1', 'img/nou1.png', 'nou@gmail.com', 'si', '827ccb0eea8a706c4c34a16891f84e7b'),
('provaclase', 'clase', '321', '123', 'img/provaclase.png', 'anna321@gmail.com', 'no', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD UNIQUE KEY `Mail` (`Mail`);

--
-- Indices de la tabla `alumnes`
--
ALTER TABLE `alumnes`
  ADD PRIMARY KEY (`DNI`),
  ADD UNIQUE KEY `Mail` (`Mail`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`Codi`),
  ADD KEY `DNI_prof` (`DNI_prof`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`DNI_alum`,`Codi_curs`),
  ADD KEY `Codi_curs` (`Codi_curs`);

--
-- Indices de la tabla `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`DNI`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`DNI_prof`) REFERENCES `professor` (`DNI`) ON DELETE CASCADE;

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`Codi_curs`) REFERENCES `cursos` (`Codi`) ON DELETE CASCADE,
  ADD CONSTRAINT `matricula_ibfk_3` FOREIGN KEY (`DNI_alum`) REFERENCES `alumnes` (`DNI`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
