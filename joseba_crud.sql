-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2022 a las 13:55:21
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `joseba_crud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `edad` int(3) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombre`, `apellido`, `email`, `edad`, `created_at`, `updated_at`, `id_curso`) VALUES
(1, 'Pacolimbo', 'Porras', 'a@uni.eus', 123, '2022-09-27 12:02:53', '2022-11-08 07:39:45', NULL),
(2, 'Manolo', 'Manolete', 'a@a.com', 40, '2022-09-27 12:02:56', '2022-09-28 11:06:38', NULL),
(3, 'Paco', 'Porras', 'a@a.com', 123, '2022-09-27 12:03:29', '2022-09-27 12:03:29', NULL),
(4, 'Peter', 'Parker', 'aa@gmail.com', 123, '2022-10-19 08:20:50', '2022-10-19 08:20:50', 1),
(5, 'Juanjo', 'Blanco', 'aaa@gmail.com', 12, '2022-11-02 10:44:04', '2022-11-02 10:44:04', NULL),
(6, 'Chetos', 'Ludau', 'aa@gmail.com', 99, '2022-11-03 07:45:45', '2022-11-03 07:45:45', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `Id` int(11) NOT NULL,
  `Abreviatura` varchar(255) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Tutor` varchar(255) NOT NULL,
  `Horas` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`Id`, `Abreviatura`, `Nombre`, `Tutor`, `Horas`) VALUES
(1, 'DAM', 'Desarrollo de aplicaciones multiplataforma', 'Petxa011', 250),
(2, 'DAW', 'Desarrollo de aplicaciones web', 'El pipe', 260),
(3, 'ASIR', 'Administracion de sistemas informaticos y redes', 'Manolo', 255),
(4, 'CIB', 'Ciberseguridad', 'El chetos', 230);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `mail` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Admin` int(10) NOT NULL,
  `IkasleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `mail`, `password`, `Admin`, `IkasleID`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$.d3UowNp/acJmHcwas5DKeYmjs.PRqIATL376orW8QsLjAEdtNsQy', 1, 0),
(3, 'prueba2', 'aaaa', '123', 1, 3),
(19, 'JosebaHL09', 'hernandez.joseba@uni', '$2y$10$cm7WRFuxB8zr/B9BGOkw/ep0tYoMSJqp7GWPRBRM329xXT83IQKl.', 0, 4),
(20, 'petxa011', 'petxa011@uni.eus', '$2y$10$gMFlIj4xUKK0l.ptq8Ywt.aKYvfJ9wgmK7a/G2phx/akI6lqsVcja', 1, 2),
(49, 'Willyrex', 'willy@uni.eus', '$2y$10$ObKilJy2/OhKg63jv9nLrumdIxgMniwjFL8zT5cRQF4Z4HRHYHhQ.', 0, 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `IkasleID` (`IkasleID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
