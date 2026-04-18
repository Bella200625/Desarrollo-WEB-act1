-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-04-2026 a las 14:20:36
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
-- Base de datos: `crud_usuarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id` varchar(36) NOT NULL,
  `fecha` date NOT NULL,
  `tipo_servicio` varchar(20) NOT NULL,
  `monto_sin_iva` decimal(10,2) NOT NULL,
  `iva` decimal(10,2) NOT NULL,
  `monto_total` decimal(10,2) NOT NULL,
  `lugar` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id`, `fecha`, `tipo_servicio`, `monto_sin_iva`, `iva`, `monto_total`, `lugar`, `descripcion`, `created_at`, `updated_at`) VALUES
('69e3301a1754a', '2026-04-18', 'LUZ', 20.00, 3.80, 23.80, 'Aguas de cartagena', 'kdfdf ke k wkdwkjdjdjenffv mjfjkefe', '2026-04-18 02:17:46', '2026-04-18 05:16:42'),
('69e35d194f695', '2026-04-18', 'GAS', 10.00, 1.90, 11.90, 'Surtigas', 'usu<h<effiuhofe\r\n\r\nprobando', '2026-04-18 05:29:45', '2026-04-18 05:29:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` varchar(36) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
('649a5f33-bf75-4dae-a59f-e4c7071b51f9', 'merari botello meza', 'merari@gmail.com', '$2y$10$KJsVc1v9UQC8FTYHPVOE3uPtu0cU.Axm38vIi72KXTo1zZSVFpAu2', 'MEMBER', 'ACTIVE', '2026-04-16 20:31:14', '2026-04-16 20:31:14'),
('6dca1002-fa11-4422-aa98-d5d05e3bb1a2', 'robyn', 'roby@gmail.com', '$2y$10$vK4WR4Tj0lHsv3OJQF59uuoRO3cY4kUIr/MOxAva92PbtN4Crj5Ju', 'MEMBER', 'ACTIVE', '2026-04-17 19:32:57', '2026-04-17 19:32:57'),
('a2aa1910-486f-4de4-9fdd-905ade1d424d', 'Bella Botello Meza', 'bbotellom@unicartagena.edu.co', '$2y$10$xImSnDeYw4Mns6zy5k8HlOeDEWuA61jW5ekxWwrDUOVAB/9FVs/7O', 'ADMIN', 'ACTIVE', '2026-04-16 19:37:12', '2026-04-16 20:40:04');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
