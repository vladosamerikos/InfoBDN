-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 23 2022 г., 23:03
-- Версия сервера: 10.4.22-MariaDB
-- Версия PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `infobdn`
--
CREATE DATABASE IF NOT EXISTS `infobdn` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `infobdn`;

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `Mail` varchar(55) NOT NULL,
  `Password` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`Mail`, `Password`) VALUES
('vladadmin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Структура таблицы `alumnes`
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
-- Дамп данных таблицы `alumnes`
--

INSERT INTO `alumnes` (`DNI`, `Nom`, `Cognoms`, `Edat`, `Foto`, `Mail`, `password`) VALUES
('A11111111', 'Daniel', 'Garcia', 18, 'img/D11111111.png', 'daniel@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
('B11111111', 'Marc', 'Garcia', 21, 'img/D11111111.png', 'marc@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
('C11111111', 'Pau', 'Garcia', 25, 'img/D11111111.png', 'pau@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
('D11111111', 'Vladyslav', 'Pasichnyk', 19, 'img/D11111111.png', 'vlad@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
('X11111111', 'Pep', 'Garcia', 20, 'img/D11111111.png', 'pep@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
('Y1234567O', 'Prova', 'Prova', 44, 'img/Y1234567O.png', 'prova@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
('Y1234567Y', 'Vladyslav', 'Prova', 6, 'img/Y1234567Y.jpg', 'vladprova@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Структура таблицы `cursos`
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
-- Дамп данных таблицы `cursos`
--

INSERT INTO `cursos` (`Codi`, `Nom`, `Descripcio`, `Horres_durara`, `Data_inici`, `Data_final`, `DNI_prof`, `Actiu`, `Foto`) VALUES
(1, 'DAW', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris id arcu fringilla, pretium libero ac, fringilla est. Vestibulum ante ipsum primis in faucibus orci luctus.', 1000, '2022-10-20', '2022-10-22', '12345678x', 'si', 'img/1.png'),
(2, 'DAW2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris id arcu fringilla, pretium libero ac, fringilla est. Vestibulum ante ipsum primis in faucibus orci luctus. ', 2000, '2023-03-03', '2023-01-28', '12345678x', 'si', 'img/2.svg'),
(3, 'SMX', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris id arcu fringilla, pretium libero ac, fringilla est. Vestibulum ante ipsum primis in faucibus orci luctus.', 2000, '2023-02-24', '2023-12-01', '12345678x', 'si', 'img/3.svg'),
(4, 'SMX2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris id arcu fringilla, pretium libero ac, fringilla est. Vestibulum ante ipsum primis in faucibus orci luctus.', 2000, '2023-03-10', '2024-03-31', '88888888C', 'si', 'img/4.svg'),
(5, 'SO', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris id arcu fringilla, pretium libero ac, fringilla est. Vestibulum ante ipsum primis in faucibus orci luctus.', 500, '2023-02-16', '2023-06-22', '12345678x', 'si', 'img/5.png'),
(6, 'Java', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris id arcu fringilla, pretium libero ac, fringilla est. Vestibulum ante ipsum primis in faucibus orci luctus.', 200, '2023-03-07', '2023-03-30', '44444444f', 'si', 'img/6.svg');

-- --------------------------------------------------------

--
-- Структура таблицы `matricula`
--

CREATE TABLE `matricula` (
  `DNI_alum` varchar(12) NOT NULL,
  `Codi_curs` int(3) NOT NULL,
  `nota` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `matricula`
--

INSERT INTO `matricula` (`DNI_alum`, `Codi_curs`, `nota`) VALUES
('A11111111', 1, 9),
('A11111111', 3, 4),
('B11111111', 1, 5),
('B11111111', 3, 3),
('C11111111', 1, 2),
('C11111111', 3, 0),
('D11111111', 1, 0),
('D11111111', 2, 0),
('D11111111', 6, 0),
('X11111111', 1, 1),
('X11111111', 3, 0),
('Y1234567O', 1, 0),
('Y1234567O', 3, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `professor`
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
-- Дамп данных таблицы `professor`
--

INSERT INTO `professor` (`DNI`, `Nom`, `Cognoms`, `Edat`, `Titol_academic`, `Foto`, `Mail`, `Actiu`, `password`) VALUES
('00000000X', 'Temporal', 'Temporal', 30, 'Temporal', 'img/00000000X.png', 'temporal@gmail.com', 'si', '827ccb0eea8a706c4c34a16891f84e7b'),
('12345678x', 'Pep', 'Garcia', 21, 'DAW', 'img/12345678x.jpg', 'pepi@gmail.com', 'si', '827ccb0eea8a706c4c34a16891f84e7b'),
('44444444f', 'Marcos', 'Cobos', 25, 'DAW', 'img/44444444f.jpg', 'marcoscobos@gmail.com', 'si', '827ccb0eea8a706c4c34a16891f84e7b'),
('88888888C', 'Noah', 'Carmona', 22, 'DAW', 'img/88888888C.jpeg', 'noahcarmona@gmail.com', 'si', '827ccb0eea8a706c4c34a16891f84e7b'),
('X1234567X', 'Manuel', 'Cordoba', 25, 'DAW', 'img/X1234567X.webp', 'manuelcardoba@gmail.com', 'si', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD UNIQUE KEY `Mail` (`Mail`);

--
-- Индексы таблицы `alumnes`
--
ALTER TABLE `alumnes`
  ADD PRIMARY KEY (`DNI`),
  ADD UNIQUE KEY `Mail` (`Mail`);

--
-- Индексы таблицы `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`Codi`),
  ADD KEY `DNI_prof` (`DNI_prof`);

--
-- Индексы таблицы `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`DNI_alum`,`Codi_curs`),
  ADD KEY `Codi_curs` (`Codi_curs`);

--
-- Индексы таблицы `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`DNI`),
  ADD UNIQUE KEY `mail` (`Mail`);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`DNI_prof`) REFERENCES `professor` (`DNI`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`Codi_curs`) REFERENCES `cursos` (`Codi`) ON DELETE CASCADE,
  ADD CONSTRAINT `matricula_ibfk_3` FOREIGN KEY (`DNI_alum`) REFERENCES `alumnes` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
