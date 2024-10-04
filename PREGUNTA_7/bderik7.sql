-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2024 a las 15:05:50
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
-- Base de datos: `bderik7`
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
-- Estructura de tabla para la tabla `macrodistritos`
--

CREATE TABLE `macrodistritos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `macrodistritos`
--

INSERT INTO `macrodistritos` (`id`, `nombre`) VALUES
(1, 'Mallasa'),
(2, 'Zona Sur'),
(3, 'San Antonio'),
(4, 'Periférica'),
(5, 'Max Paredes'),
(6, 'Zona Centro'),
(7, 'Cotahuma'),
(8, 'Zongo'),
(9, 'Hampaturi');

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
  `tipo_persona` enum('funcionario','dueño') NOT NULL,
  `macrodistrito_id` int(11) DEFAULT NULL,
  `zona_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`ci`, `nombre`, `paterno`, `materno`, `contrasena`, `tipo_persona`, `macrodistrito_id`, `zona_id`) VALUES
('12345678', 'Moisés', 'Gutiérrez', 'Pérez', '$2y$10$P1fssyvgzEJJuq1DsJayKeoZMeP.DnS8gjmsB4iiI3aLdInLbfcri', 'funcionario', NULL, NULL),
('23456789', 'Ana', 'Martínez', 'López', '$2y$10$AmeqypG3Y3MDiaTCQUwvj.1tkD2lEmfU38GV/XqZJTpQjSK.MlCoi', 'funcionario', NULL, NULL),
('34567890', 'Carlos', 'Sánchez', 'Ramírez', '$2y$10$lRfhJGOgmLEnc.li1oyKo.rzgqM/pmOUzPHTbdyvU7SmJOOM/kBwm', 'funcionario', NULL, NULL),
('45678901', 'Beatriz', 'Flores', 'González', '$2y$10$zAG/2A4ILLHeDOpmVz97Fe/4DBlnm6afaFC5mebVv28LVN9eGkoRi', 'dueño', NULL, NULL),
('56789012', 'Jorge', 'Morales', 'Hernández', '$2y$10$Jwp/s4HVhR/dl7Ox3wxkDOn8HFpY1uEndhW9MUg90SdAavCkJM7iy', 'dueño', NULL, NULL),
('67890123', 'Erik', 'Choque', 'Ajnota', '$2y$10$6HJE8a1gnZzqHb4o1la8NuHwwnqVNCJcET7.KOKy1JLP13.MDciTm', 'dueño', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE `zonas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `macrodistrito_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`id`, `nombre`, `macrodistrito_id`) VALUES
(1, 'Amor de Dios', 1),
(2, 'Mallasa', 1),
(3, 'Muela del Diablo', 1),
(4, 'Mallasilla', 1),
(5, 'Jupapina', 1),
(6, 'Obrajes', 2),
(7, 'Alto Obrajes', 2),
(8, 'Bella Vista', 2),
(9, 'Bolognia', 2),
(10, 'Irpavi', 2),
(11, 'Calacoto', 2),
(12, 'Cota Cota', 2),
(13, 'Achumani', 2),
(14, 'Chasquipampa', 2),
(15, 'Ovejuyo', 2),
(16, 'Koani', 2),
(17, 'La Florida', 2),
(18, 'Següencoma', 2),
(19, 'San Miguel', 2),
(20, 'San Antonio', 3),
(21, 'Villa Copacabana', 3),
(22, 'Pampahasi', 3),
(23, 'Valle Hermoso', 3),
(24, 'Kupini', 3),
(25, 'Villa Armonía', 3),
(26, 'Callapa', 3),
(27, 'San Isidro', 3),
(28, 'Achachicala', 4),
(29, 'Chuquiaguillo', 4),
(30, 'Villa Fátima', 4),
(31, 'Villa Pabon', 4),
(32, 'Agua de la Vida', 4),
(33, 'Vino Tinto', 4),
(34, '5 Dedos', 4),
(35, 'Santiago de Lacaya', 4),
(36, 'Rosasani', 4),
(37, 'Chualluma', 4),
(38, 'Munaypata', 5),
(39, 'La Portada', 5),
(40, 'El Tejar', 5),
(41, 'Gran Poder', 5),
(42, 'Obispo Indaburo', 5),
(43, 'Chamoco Chico', 5),
(44, 'Pura Pura', 5),
(45, 'Ciudadela Ferroviaria', 5),
(46, 'Casco Urbano Central', 6),
(47, 'San Jorge', 6),
(48, 'Miraflores', 6),
(49, 'Barrio Gráfico', 6),
(50, 'San Sebastián', 6),
(51, 'Santa Bárbara', 6),
(52, 'Parque Urbano Central', 6),
(53, 'Sopocachi', 7),
(54, 'Alto Sopocachi', 7),
(55, 'Pasankeri', 7),
(56, 'Tembladerani', 7),
(57, 'Alpacoma', 7),
(58, 'Belén', 7),
(59, 'Tacagua', 7),
(60, 'San Pedro', 7),
(61, 'Bajo Llojeta', 7),
(62, 'Zongo', 8),
(63, 'El Alto de Zongo', 8),
(64, 'Río Zongo', 8),
(65, 'Villa Zongo', 8),
(66, 'Hampaturi', 9),
(67, 'Villa Hampaturi', 9),
(68, 'Bajo Hampaturi', 9),
(69, 'Alto Hampaturi', 9);

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
-- Indices de la tabla `macrodistritos`
--
ALTER TABLE `macrodistritos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`ci`),
  ADD KEY `fk_macrodistrito` (`macrodistrito_id`),
  ADD KEY `fk_zona` (`zona_id`);

--
-- Indices de la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `macrodistrito_id` (`macrodistrito_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `catastro`
--
ALTER TABLE `catastro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30002;

--
-- AUTO_INCREMENT de la tabla `macrodistritos`
--
ALTER TABLE `macrodistritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `zonas`
--
ALTER TABLE `zonas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `catastro`
--
ALTER TABLE `catastro`
  ADD CONSTRAINT `catastro_ibfk_1` FOREIGN KEY (`ci`) REFERENCES `persona` (`ci`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_macrodistrito` FOREIGN KEY (`macrodistrito_id`) REFERENCES `macrodistritos` (`id`),
  ADD CONSTRAINT `fk_zona` FOREIGN KEY (`zona_id`) REFERENCES `zonas` (`id`);

--
-- Filtros para la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD CONSTRAINT `zonas_ibfk_1` FOREIGN KEY (`macrodistrito_id`) REFERENCES `macrodistritos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
