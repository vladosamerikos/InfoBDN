-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час створення: Жов 12 2022 р., 23:27
-- Версія сервера: 10.4.24-MariaDB
-- Версія PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `infobdn`
--
CREATE DATABASE IF NOT EXISTS `infobdn` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `infobdn`;

-- --------------------------------------------------------

--
-- Структура таблиці `admins`
--

CREATE TABLE `admins` (
  `Mail` varchar(55) NOT NULL,
  `Password` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `admins`
--

INSERT INTO `admins` (`Mail`, `Password`) VALUES
('vladadmin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Структура таблиці `alumnes`
--

CREATE TABLE `alumnes` (
  `DNI` varchar(12) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Cognoms` varchar(20) NOT NULL,
  `Edat` int(3) NOT NULL,
  `Foto` varchar(255) NOT NULL,
  `Mail` varchar(55) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `alumnes`
--

INSERT INTO `alumnes` (`DNI`, `Nom`, `Cognoms`, `Edat`, `Foto`, `Mail`, `password`) VALUES
('A11111111', 'Daniel', 'Garcia', 18, 'img/D11111111.png', 'daniel@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
('B11111111', 'Marc', 'Garcia', 21, 'img/D11111111.png', 'marc@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
('C11111111', 'Pau', 'Garcia', 25, 'img/D11111111.png', 'pau@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
('D11111111', 'Vladyslav', 'pasichnyk', 19, 'img/D11111111.png', 'vlad@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
('X11111111', 'Pep', 'Garcia', 20, 'img/D11111111.png', 'pep@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Структура таблиці `cursos`
--

CREATE TABLE `cursos` (
  `Codi` int(3) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Descripcio` varchar(800) NOT NULL,
  `Horres_durara` int(3) NOT NULL,
  `Data_inici` date NOT NULL,
  `Data_final` date NOT NULL,
  `DNI_prof` varchar(12) NOT NULL,
  `Actiu` varchar(2) NOT NULL DEFAULT 'si',
  `Foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `cursos`
--

INSERT INTO `cursos` (`Codi`, `Nom`, `Descripcio`, `Horres_durara`, `Data_inici`, `Data_final`, `DNI_prof`, `Actiu`, `Foto`) VALUES
(1, 'DAW', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris id arcu fringilla, pretium libero ac, fringilla est. Vestibulum ante ipsum primis in faucibus orci luctus.', 1000, '2023-04-13', '2022-09-14', '12345678x', 'si', 'img/1.svg'),
(2, 'DAW2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris id arcu fringilla, pretium libero ac, fringilla est. Vestibulum ante ipsum primis in faucibus orci luctus. ', 2000, '2023-03-03', '2023-01-28', '12345678x', 'si', 'img/2.jpg'),
(3, 'SMX', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris id arcu fringilla, pretium libero ac, fringilla est. Vestibulum ante ipsum primis in faucibus orci luctus.', 2000, '2023-02-24', '2023-12-01', '12345678x', 'si', 'img/3.svg'),
(4, 'SMX2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris id arcu fringilla, pretium libero ac, fringilla est. Vestibulum ante ipsum primis in faucibus orci luctus.', 2000, '2023-03-10', '2024-03-31', '88888888C', 'si', 'img/4.svg'),
(6, 'Usuarios', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris id arcu fringilla, pretium libero ac, fringilla est. Vestibulum ante ipsum primis in faucibus orci luctus.', 200, '2022-11-14', '2023-03-30', '44444444f', 'si', 'img/6.svg');

-- --------------------------------------------------------

--
-- Структура таблиці `matricula`
--

CREATE TABLE `matricula` (
  `DNI_alum` varchar(12) NOT NULL,
  `Codi_curs` int(3) NOT NULL,
  `nota` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `matricula`
--

INSERT INTO `matricula` (`DNI_alum`, `Codi_curs`, `nota`) VALUES
('A11111111', 1, 8),
('A11111111', 3, 2),
('B11111111', 1, 5),
('B11111111', 3, 3),
('C11111111', 1, 2),
('C11111111', 3, 0),
('D11111111', 1, 0),
('D11111111', 3, 0),
('X11111111', 1, 0),
('X11111111', 3, 0);

-- --------------------------------------------------------

--
-- Структура таблиці `professor`
--

CREATE TABLE `professor` (
  `DNI` varchar(12) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Cognoms` varchar(20) NOT NULL,
  `Edat` int(2) NOT NULL DEFAULT 30,
  `Titol_academic` varchar(20) NOT NULL,
  `Foto` varchar(255) NOT NULL,
  `Mail` varchar(55) NOT NULL,
  `Actiu` varchar(2) NOT NULL DEFAULT 'si',
  `password` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `professor`
--

INSERT INTO `professor` (`DNI`, `Nom`, `Cognoms`, `Edat`, `Titol_academic`, `Foto`, `Mail`, `Actiu`, `password`) VALUES
('12345678x', 'Pep', 'Garcia', 20, 'DAW', 'img/12345678x.jpg', 'pepi@gmail.com', 'si', '827ccb0eea8a706c4c34a16891f84e7b'),
('3212321', '123', '321', 30, '32131', 'img/3212321.png', 'pepe@gmail.com', 'si', '827ccb0eea8a706c4c34a16891f84e7b'),
('44444444f', 'pig', 'pepa', 30, 'TUT', 'img/44444444f.png', 'PIG@gmail.com', 'si', '827ccb0eea8a706c4c34a16891f84e7b'),
('88888888C', 'Koko', 'Kok', 30, 'UNI', 'img/88888888C.png', 'koko@gmail.com', 'si', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `admins`
--
ALTER TABLE `admins`
  ADD UNIQUE KEY `Mail` (`Mail`);

--
-- Індекси таблиці `alumnes`
--
ALTER TABLE `alumnes`
  ADD PRIMARY KEY (`DNI`),
  ADD UNIQUE KEY `Mail` (`Mail`);

--
-- Індекси таблиці `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`Codi`),
  ADD KEY `DNI_prof` (`DNI_prof`);

--
-- Індекси таблиці `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`DNI_alum`,`Codi_curs`),
  ADD KEY `Codi_curs` (`Codi_curs`);

--
-- Індекси таблиці `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`DNI`),
  ADD UNIQUE KEY `mail` (`Mail`);

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`DNI_prof`) REFERENCES `professor` (`DNI`) ON DELETE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`Codi_curs`) REFERENCES `cursos` (`Codi`) ON DELETE CASCADE,
  ADD CONSTRAINT `matricula_ibfk_3` FOREIGN KEY (`DNI_alum`) REFERENCES `alumnes` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
