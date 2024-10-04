-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2024 a las 14:49:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bderik`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catastro`
--

CREATE TABLE `catastro` (
  `id` int(11) NOT NULL,
  `zona` varchar(50) NOT NULL,
  `x_inicio` decimal(10,6) NOT NULL,
  `y_inicio` decimal(10,6) NOT NULL,
  `x_fin` decimal(10,6) NOT NULL,
  `y_fin` decimal(10,6) NOT NULL,
  `superficie` decimal(10,2) NOT NULL,
  `ci` varchar(20) DEFAULT NULL,
  `distrito` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `catastro`
--

INSERT INTO `catastro` (`id`, `zona`, `x_inicio`, `y_inicio`, `x_fin`, `y_fin`, `superficie`, `ci`, `distrito`) VALUES
(10000, 'Zona A', -16.500000, -68.119000, -16.499000, -68.118000, 100.50, '45678901', 'Centro'),
(10001, 'Zona D', -16.540000, -68.150000, -16.539000, -68.149000, 250.25, '45678901', 'El Alto'),
(20000, 'Zona B', -16.520000, -68.130000, -16.519000, -68.129000, 150.75, '56789012', 'Miraflores'),
(20001, 'Zona E', -16.550000, -68.160000, -16.549000, -68.159000, 300.30, '56789012', 'La Florida'),
(30000, 'Zona C', -16.530000, -68.140000, -16.529000, -68.139000, 200.00, '67890123', 'San Miguel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `ci` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `paterno` varchar(50) NOT NULL,
  `materno` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `tipo_persona` enum('funcionario','dueño') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`ci`, `nombre`, `paterno`, `materno`, `contrasena`, `tipo_persona`) VALUES
('12345678', 'Moisés', 'Gutiérrez', 'Pérez', '$2y$10$P1fssyvgzEJJuq1DsJayKeoZMeP.DnS8gjmsB4iiI3aLdInLbfcri', 'funcionario'),
('23456789', 'Ana', 'Martínez', 'López', '$2y$10$AmeqypG3Y3MDiaTCQUwvj.1tkD2lEmfU38GV/XqZJTpQjSK.MlCoi', 'funcionario'),
('34567890', 'Carlos', 'Sánchez', 'Ramírez', '$2y$10$lRfhJGOgmLEnc.li1oyKo.rzgqM/pmOUzPHTbdyvU7SmJOOM/kBwm', 'funcionario'),
('45678901', 'Beatriz', 'Flores', 'González', '$2y$10$zAG/2A4ILLHeDOpmVz97Fe/4DBlnm6afaFC5mebVv28LVN9eGkoRi', 'dueño'),
('56789012', 'Jorge', 'Morales', 'Hernández', '$2y$10$Jwp/s4HVhR/dl7Ox3wxkDOn8HFpY1uEndhW9MUg90SdAavCkJM7iy', 'dueño'),
('67890123', 'Erik', 'Choque', 'Ajnota', '$2y$10$6HJE8a1gnZzqHb4o1la8NuHwwnqVNCJcET7.KOKy1JLP13.MDciTm', 'dueño');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `catastro`
--
ALTER TABLE `catastro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci` (`ci`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`ci`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `catastro`
--
ALTER TABLE `catastro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30002;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `catastro`
--
ALTER TABLE `catastro`
  ADD CONSTRAINT `catastro_ibfk_1` FOREIGN KEY (`ci`) REFERENCES `persona` (`ci`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
