-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-01-2026 a las 12:41:18
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
-- Base de datos: `c-weight`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(75) NOT NULL,
  `email` varchar(50) NOT NULL,
  `genero` char(1) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `codpostal` char(5) NOT NULL,
  `poblacion` varchar(100) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `password` char(40) NOT NULL,
  `creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellidos`, `email`, `genero`, `direccion`, `codpostal`, `poblacion`, `provincia`, `password`, `creacion`) VALUES
(5, 'Oliver', 'Dominguez Moreno', 'oliverdominguezmoreno2@gmail.com', 'M', 'Calle prueba', '03506', 'Mucho', 'Cáceres', 'b95db66b1c83cc40f9a6d85458a54f0f3dd39aae', '2025-12-12 10:20:29'),
(6, 'Oliver', 'Dominguez Moreno', 'oliverdominguezmoreno14@gmail.com', 'M', 'Calle prueba', '03506', 'Mucho', 'Cáceres', 'c539153ba1f947bd4b6f910263b967c4a0a62357', '2025-12-17 10:31:54'),
(7, 'Oliver', 'Dominguez Moreno', 'oliverdominguezmoreno21@gmail.com', 'M', 'Calle prueba', '03506', 'Mucho', 'Cáceres', '8ccbab62be0e579a3baf944540fff80110151cb3', '2026-01-07 09:13:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_total` int(11) NOT NULL,
  `estado` enum('Pendiente','Cancelado','Completado') NOT NULL DEFAULT 'Pendiente',
  `creado` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_cliente`, `id_producto`, `fecha_inicio`, `fecha_final`, `cantidad`, `precio_total`, `estado`, `creado`) VALUES
(18, 6, 12, '2001-11-11', '2020-12-12', 0, 1234432, 'Pendiente', '2026-01-14'),
(20, 6, 12, '2020-02-20', '2026-01-12', 0, 213432675, 'Pendiente', '2026-01-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_detalles`
--

CREATE TABLE `pedido_detalles` (
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `precio_unidad` int(11) NOT NULL,
  `encargo` tinyint(1) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `stock`, `precio_unidad`, `encargo`, `tipo`, `creacion`) VALUES
(2, 'Camisa', 'fdfehtrju', 5, 19, 0, 'Camiseta', '2025-12-16 10:41:48'),
(4, 'tqwe', 'asdwqe', 2, 19, 0, 'Camiseta', '2025-12-16 11:56:06'),
(12, 'Oliver', 'Mu guapo', 5, 12, 1, 'Camiseta', '2025-12-17 10:23:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(40) NOT NULL,
  `rol` tinyint(4) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `imagen_url` text NOT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `rol`, `nombre`, `imagen_url`, `creado`) VALUES
(1, 'oliverdominguezmoreno@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 1, 'Alfredo', '', '2025-12-01 10:29:52'),
(8, 'oliverdominguezmoreno1@gmail.com', 'contrasenya', 1, 'Oliver', '', '2026-01-12 10:09:34'),
(9, 'prueba@gmail.com', 'f72b8794d3f268f4f770e8aaa0a6e71f0ff06a56', 1, 'Yo', '', '2026-01-12 10:21:10'),
(11, 'prueba1@gmail.com', 'e35daf493fa159f49ce7870be8e39812c0644cd8', 1, 'Prueba', '', '2026-01-16 08:02:43'),
(15, 'nueva@gmail.com', '54d91d2dfe759faa3fb099e2bcd3ee607730f7ba', 1, 'Hola', '', '2026-01-16 08:17:51'),
(40, 'gato@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 1, 'gato', './img/img_usr/6970b3982e3fa3.91815995.jpg', '2026-01-21 11:08:08');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`) USING BTREE,
  ADD KEY `id_producto` (`id_producto`) USING BTREE;

--
-- Indices de la tabla `pedido_detalles`
--
ALTER TABLE `pedido_detalles`
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto_FK` (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `id_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `pedido_detalles`
--
ALTER TABLE `pedido_detalles`
  ADD CONSTRAINT `id_pedido_FK` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `id_producto_FK` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
