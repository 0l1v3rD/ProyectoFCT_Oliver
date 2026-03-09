-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-03-2026 a las 09:19:31
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
  `id_usuario` int(11) NOT NULL,
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

INSERT INTO `clientes` (`id`, `id_usuario`, `nombre`, `apellidos`, `email`, `genero`, `direccion`, `codpostal`, `poblacion`, `provincia`, `password`, `creacion`) VALUES
(62, 62, 'Oliver', 'Dominguez Moreno', 'oliverdominguezmoreno@gmail.com', 'H', 'Calle Villa Madrid', '03123', 'Torrevieja', 'Alicante', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2026-02-20 10:56:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `estado` enum('Pendiente','Cancelado','Completado') NOT NULL DEFAULT 'Pendiente',
  `creado` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_cliente`, `fecha_inicio`, `fecha_final`, `estado`, `creado`) VALUES
(2, 62, '2026-03-05', '2026-04-14', 'Pendiente', '2026-03-05'),
(3, 62, '2026-03-05', '2026-04-14', 'Pendiente', '2026-03-05'),
(4, 62, '2026-03-06', '2026-04-15', 'Pendiente', '2026-03-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_detalles`
--

CREATE TABLE `pedido_detalles` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido_detalles`
--

INSERT INTO `pedido_detalles` (`id`, `id_pedido`, `id_producto`, `cantidad`, `precio_total`) VALUES
(21, 3, 4, 1, 19),
(22, 3, 16, 1, 5),
(23, 3, 15, 1, 15),
(24, 4, 15, 1, 15),
(25, 4, 26, 1, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `precio_unidad` int(11) DEFAULT NULL,
  `encargo` tinyint(1) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `img_url` text DEFAULT NULL,
  `creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `stock`, `precio_unidad`, `encargo`, `tipo`, `img_url`, `creacion`) VALUES
(4, 'Camiseta Negra', 'Camiseta de talla L', 2, 19, 0, 'Camiseta', './img/img_prod/isolated_white_and_black_t_shirt_front_view-no-bg.png', '2025-12-16 11:56:06'),
(12, 'Camiseta Grande Negra', 'Camiseta negra de talla XL', 5, 12, 1, 'Camiseta', './img/img_prod/isolated_white_and_black_t_shirt_front_view-no-bg.png', '2025-12-17 10:23:29'),
(15, 'Camiseta Negra Pequeña', 'Camiseta negra de talla S', 5, 15, 0, 'Camiseta', './img/img_prod/isolated_white_and_black_t_shirt_front_view-no-bg.png', '2026-02-13 10:47:03'),
(16, 'Pantalon Negro Grande', 'Pantalón negro de talla L', 2, 5, 0, 'Pantalon', './img/img_prod/dsf.png', '2026-02-13 10:48:11'),
(20, 'Pantalón Negro Mediano', 'Pantalón negro de talla M', 2, 19, 0, 'Pantalon', './img/img_prod/dsf.png', '2025-12-16 11:56:06'),
(25, 'Pantalon Negro Pequeño', 'Pantalón negro de talla S', 2, 4, 0, 'Pantalon', './img/img_prod/dsf.png', '2025-12-16 11:56:06'),
(26, 'Camiseta Negra Grande', 'Camiseta negra de talla L', 2, 19, 0, 'Camiseta', './img/img_prod/isolated_white_and_black_t_shirt_front_view-no-bg.png', '2025-12-16 11:56:06'),
(27, 'Camiseta Negra Mediana', 'Camiseta negra de talla M', 1, 14, 0, 'Camiseta', './img/img_prod/isolated_white_and_black_t_shirt_front_view-no-bg.png', '2025-12-16 11:56:06'),
(34, 'Pantalon Negro', 'Pantalón negro para hombre', 2, 12, 0, 'Pantalon', './img/img_prod/dsf.png', '2026-03-06 08:00:46'),
(35, 'Pantalon Negro Basico', 'Pantalón negro básico para hombre', 2, 10, 0, 'Pantalon', './img/img_prod/dsf.png', '2026-03-06 08:00:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(40) NOT NULL,
  `rol` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `imagen_url` text NOT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `rol`, `nombre`, `imagen_url`, `creado`) VALUES
(62, 'oliverdominguezmoreno@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '0', 'Oliver', './img/img_usr/69aa96ceb68519.89558603.jpg', '2026-02-20 10:56:10');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_id_usuario` (`id_usuario`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`) USING BTREE;

--
-- Indices de la tabla `pedido_detalles`
--
ALTER TABLE `pedido_detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_pedido` (`id_pedido`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `pedido_detalles`
--
ALTER TABLE `pedido_detalles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido_detalles`
--
ALTER TABLE `pedido_detalles`
  ADD CONSTRAINT `id_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_detalles_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
