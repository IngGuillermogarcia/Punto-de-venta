-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-03-2023 a las 05:20:50
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_venta`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `baja_stock` (IN `stockt` INT, IN `cod_producto` INT)   BEGIN
DECLARE stocka int;
set stocka = (select stock from productos where id_producto=cod_producto);
set stockt = (stocka - stockt);
update productos set stock = stockt where id_producto=cod_producto;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf32 DEFAULT NULL,
  `estado` varchar(10) CHARACTER SET utf32 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`, `estado`) VALUES
(1, 'Leche', 'activo'),
(2, 'Chocolate', 'activo'),
(3, 'Agua', 'activo'),
(4, 'Bebida', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id_ventas` int(11) DEFAULT NULL,
  `id_productos` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(9,2) DEFAULT NULL,
  `importe` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id_ventas`, `id_productos`, `cantidad`, `precio`, `importe`) VALUES
(1, 1, 2, '5.00', '10.00'),
(1, 3, 1, '1.50', '1.50'),
(2, 3, 1, '1.50', '1.50'),
(2, 4, 2, '1.20', '2.40'),
(2, 1, 1, '5.00', '5.00'),
(3, 1, 50, '5.00', '250.00'),
(3, 3, 6, '1.50', '9.00'),
(4, 1, 50, '5.00', '250.00'),
(4, 3, 6, '1.50', '9.00'),
(5, 1, 50, '5.00', '250.00'),
(5, 3, 6, '1.50', '9.00'),
(6, 1, 3, '5.00', '15.00'),
(6, 3, 6, '1.50', '9.00'),
(7, 3, 6, '1.50', '9.00'),
(8, 1, 10, '5.00', '50.00'),
(8, 3, 6, '1.50', '9.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `precio_compra` decimal(9,2) DEFAULT NULL,
  `precio_venta` decimal(9,2) DEFAULT NULL,
  `stock` int(10) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `precio_compra`, `precio_venta`, `stock`, `id_proveedor`, `estado`, `id_categoria`) VALUES
(1, 'Leche Gloria Lata', '4.00', '5.00', 20, 1, 'activo', 1),
(2, 'Leche LaiveLata', '4.50', '5.20', 50, 1, 'inactivo', 1),
(3, 'Bon Bon bolsa', '0.70', '1.50', 50, 1, 'activo', 2),
(4, 'Pepsi 350ml', '0.80', '1.20', 60, 2, 'activo', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre`, `direccion`, `telefono`, `email`, `estado`) VALUES
(1, 'Proveedor 1', 'Perú - Lima', '958741257', 'proveedor1@hotmail.com', 'activo'),
(2, 'Proveedor 2', 'Meximo', '987451623', 'proveedor2@hotmail.com', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `clave` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `clave`, `tipo`, `estado`) VALUES
(3, 'gabriel', 'a346bc80408d9b2a5063fd1bddb20e2d5586ec30', 'admin', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `cliente` varchar(100) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `numero` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `fecha`, `cliente`, `estado`, `total`, `tipo`, `numero`) VALUES
(1, '2023-02-19', 'Cliente Prueba 1', 'vista', '11.50', 'Boleta', '1'),
(2, '2023-02-19', 'Cliente 2', 'vista', '8.90', 'Factura', '1'),
(3, '2023-03-14', 'Gabriel', 'vista', '259.00', 'Boleta', '75'),
(4, '2023-03-14', 'Cliente 22', 'vista', '259.00', 'Boleta', '73'),
(5, '2023-03-14', 'fewf', 'vista', '259.00', 'Boleta', '5454'),
(6, '2023-03-14', '3543', 'vista', '24.00', 'Boleta', '3543'),
(7, '2023-03-14', '55', 'vista', '9.00', 'Boleta', '5'),
(8, '2023-03-14', 'eg', 'activo', '59.00', 'Boleta', 'gr');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `productos_ibfk_1` (`id_categoria`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `id_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
