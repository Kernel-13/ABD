-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2017 a las 20:41:19
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `kernel9`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `group_name` varchar(50) NOT NULL,
  `group_genre` varchar(50) NOT NULL,
  `group_min_age` tinyint(4) NOT NULL,
  `group_max_age` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`group_name`, `group_genre`, `group_min_age`, `group_max_age`) VALUES
('Breakbeat Pals', 'Breakbeat', 14, 50),
('Jazz Lovers', 'Jazz', 35, 45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_grupales`
--

CREATE TABLE `mensajes_grupales` (
  `message_id` int(11) NOT NULL,
  `message_sender` int(11) NOT NULL,
  `message_group` varchar(255) NOT NULL,
  `message_issue` varchar(50) NOT NULL,
  `message_body` text NOT NULL,
  `message_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_privados`
--

CREATE TABLE `mensajes_privados` (
  `message_id` int(11) NOT NULL,
  `message_sender` int(11) NOT NULL,
  `message_receiver` int(11) NOT NULL,
  `message_issue` varchar(50) NOT NULL,
  `message_body` text NOT NULL,
  `message_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_publicos`
--

CREATE TABLE `mensajes_publicos` (
  `message_id` int(11) NOT NULL,
  `message_sender` int(11) NOT NULL,
  `message_issue` varchar(50) NOT NULL,
  `message_body` text NOT NULL,
  `message_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `user_age` tinyint(4) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_genre` varchar(255) NOT NULL,
  `user_groups` varchar(200) NOT NULL,
  `user_isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user_id`, `user_name`, `user_email`, `user_age`, `user_pass`, `user_genre`, `user_groups`, `user_isAdmin`) VALUES
(1, 'Alice', 'alice@coeurvert.com', 31, '$2y$10$uWJRlIEZoYVU.l6iylTEG./7b8Yidy0n9bXCkjmBVg5xgoKAQp25i', 'Electronic music', 'General', 0),
(2, 'Ederson', 'ederson@funes.com', 36, '$2y$10$DK75iMaZ93Kg4fYaeY5VP.tpR3SE7Mf8asxIUmLn2.znmmemrU..u', 'Hardstyle', 'General', 0),
(3, 'Lili', 'lili@traumhann.com', 40, '$2y$10$PVxc1ZVucHwm4F/.8WKItODOAUAZ4me0K2NC5dFrx2QNbq2ZE8fWy', 'Jazz', 'General,Jazz Lovers', 1),
(4, 'Karo', 'karmezina@karo.com', 28, '$2y$10$l6ZA3/RiAC0oY.6AePyyM.UjN/At.IyKv7gdypDWNUf5bFyF8l9Ju', 'Breakbeat', 'General,Breakbeat Pals', 0),
(5, 'Alexia', 'alexia@shyrose.com', 21, '$2y$10$7gRY7syo/CTZdyrjK8cNZO8d2aDLGjnQUPSvA2ICyNY/zXY.SkCUu', 'Pop', 'General', 0),
(11, 'Nila', 'nila@fortune.com', 44, '$2y$10$I7ppiY.Bg1GMONy0.oP0TOB80gu1rf.kuNqDRzc.StQaOiXPln3Qe', 'Jazz', 'General,Jazz Lovers', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`group_name`);

--
-- Indices de la tabla `mensajes_grupales`
--
ALTER TABLE `mensajes_grupales`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `emisor` (`message_sender`),
  ADD KEY `receptor` (`message_group`);

--
-- Indices de la tabla `mensajes_privados`
--
ALTER TABLE `mensajes_privados`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `emisor` (`message_sender`),
  ADD KEY `receptor` (`message_receiver`);

--
-- Indices de la tabla `mensajes_publicos`
--
ALTER TABLE `mensajes_publicos`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `emisor` (`message_sender`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mensajes_grupales`
--
ALTER TABLE `mensajes_grupales`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `mensajes_privados`
--
ALTER TABLE `mensajes_privados`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT de la tabla `mensajes_publicos`
--
ALTER TABLE `mensajes_publicos`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mensajes_grupales`
--
ALTER TABLE `mensajes_grupales`
  ADD CONSTRAINT `mensajes_grupales_ibfk_1` FOREIGN KEY (`message_sender`) REFERENCES `usuarios` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensajes_privados`
--
ALTER TABLE `mensajes_privados`
  ADD CONSTRAINT `mensajes_privados_ibfk_1` FOREIGN KEY (`message_sender`) REFERENCES `usuarios` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mensajes_privados_ibfk_2` FOREIGN KEY (`message_receiver`) REFERENCES `usuarios` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensajes_publicos`
--
ALTER TABLE `mensajes_publicos`
  ADD CONSTRAINT `mensajes_publicos_ibfk_1` FOREIGN KEY (`message_sender`) REFERENCES `usuarios` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
