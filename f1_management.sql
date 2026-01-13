-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-01-2026 a las 20:38:49
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `f1_management`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuderias`
--

CREATE TABLE `escuderias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `sede` varchar(100) NOT NULL,
  `director` varchar(100) NOT NULL,
  `motor` varchar(50) NOT NULL,
  `campeonatos` int(11) DEFAULT 0,
  `fundacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `escuderias`
--

INSERT INTO `escuderias` (`id`, `nombre`, `sede`, `director`, `motor`, `campeonatos`, `fundacion`) VALUES
(1, 'Scuderia Ferrari HP', 'Maranello, Italia', 'Frédéric Vasseur', 'Ferrari', 16, '1929-11-16'),
(2, 'Oracle Red Bull Racing', 'Milton Keynes, Reino Unido', 'Christian Horner', 'Red Bull Ford', 6, '2005-01-01'),
(3, 'McLaren Mastercard F1 Team', 'Woking, Reino Unido', 'Andrea Stella', 'Mercedes', 8, '1963-09-02'),
(4, 'Mercedes-AMG Petronas F1 Team', 'Brackley, Reino Unido', 'Toto Wolff', 'Mercedes', 8, '2010-03-14'),
(5, 'Aston Martin Aramco F1 Team', 'Silverstone, Reino Unido', 'Mike Krack', 'Honda', 0, '1913-01-15'),
(6, 'BWT Alpine F1 Team', 'Enstone, Reino Unido', 'Flavio Briatore', 'Mercedes', 2, '1955-06-22'),
(7, 'Atlassian Williams F1 Team', 'Grove, Reino Unido', 'James Vowles', 'Mercedes', 9, '1977-05-08'),
(8, 'Visa Cash App RB F1 Team', 'Faenza, Italia', 'Laurent Mekies', 'Red Bull Ford', 0, '2024-01-01'),
(9, 'TGR Haas F1 Team', 'Kannapolis, EEUU', 'Ayao Komatsu', 'Ferrari', 0, '2016-04-08'),
(10, 'Audi Revolut F1 Team', 'Hinwil, Suiza', 'Jonathan Wheatley', 'Audi', 0, '2026-01-01'),
(11, 'Cadillac Formula 1 Team', 'Fishers, EEUU', 'Graeme Lowdon', 'Ferrari', 0, '2026-01-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `coduser` int(11) NOT NULL,
  `idusuario` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`coduser`, `idusuario`, `password`, `nombre`, `apellido`) VALUES
(1, 'angel-login', '$2y$10$se50CKRVY7tCWHyON94hNe6pKSK3JcJdPeEwhBbPtdBET1IIyvN/G', 'Ángel', 'Barba');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `escuderias`
--
ALTER TABLE `escuderias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`coduser`),
  ADD UNIQUE KEY `idusuario` (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `escuderias`
--
ALTER TABLE `escuderias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `coduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
