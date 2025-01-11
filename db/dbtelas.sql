-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-01-2025 a las 04:10:27
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbtelas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `IDCLIENTE` int(11) NOT NULL,
  `RAZONSOCIAL` varchar(100) NOT NULL,
  `CI_NIT` int(11) NOT NULL,
  `CODTIPO` enum('personal','empresa','','') DEFAULT NULL,
  `TELEFONO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `CODCOMPRA` int(11) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `CODPERSONAL` int(11) NOT NULL,
  `CODPROV` int(11) NOT NULL,
  `ESTADO` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE `contrato` (
  `CODCONTRATO` int(11) NOT NULL,
  `CODCLIENTE` int(11) NOT NULL,
  `CODEMPLEADO` int(11) NOT NULL,
  `SASTRE` varchar(1509) DEFAULT NULL,
  `CODTELA` int(11) DEFAULT NULL,
  `METROS_TELA` int(11) NOT NULL,
  `COSTO_TOTAL_TELA` float DEFAULT NULL,
  `COSTO_SASTRE` float DEFAULT NULL,
  `DESCRIPCION` text NOT NULL,
  `FECHA_INICIO` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `FECHA_ENTREGA` date DEFAULT NULL,
  `ESTADO` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `coddcompra` int(11) NOT NULL,
  `codcompra` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `codcolor` varchar(10) DEFAULT NULL,
  `codmarca` int(11) DEFAULT NULL,
  `calidad` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_contrato`
--

CREATE TABLE `detalle_contrato` (
  `CODDCONTRATO` int(11) NOT NULL,
  `CODCONTRATO` int(11) DEFAULT NULL,
  `ALTO` float DEFAULT NULL,
  `ANCHO` float DEFAULT NULL,
  `CANTIDAD` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `CODDVENTA` int(11) NOT NULL,
  `CODVENTA` int(11) DEFAULT NULL,
  `CODTELA` int(11) DEFAULT NULL,
  `CODCOLOR` varchar(50) DEFAULT NULL,
  `PRECIO` int(11) DEFAULT NULL,
  `CANTIDAD` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `detalle_venta`
--
DELIMITER $$
CREATE TRIGGER `reduce_stock_after_insert` AFTER INSERT ON `detalle_venta` FOR EACH ROW BEGIN 
    DECLARE METROS INT;
    DECLARE ROLLO_NUEVO INT;
    DECLARE AUX INT;
    DECLARE SOBRANTE INT;
    DECLARE NUM_ROLLOS INT;

    -- Obtén los valores de la tabla ROLLO_TELA
    SELECT METROLLO, MROLLOCOMPLETO, NUMROLLOS 
    INTO METROS, ROLLO_NUEVO, NUM_ROLLOS
    FROM ROLLO_TELA
    WHERE CODTELA = NEW.CODTELA AND CODCOLOR = NEW.CODCOLOR;

    -- Si la cantidad a vender es menor o igual a la cantidad en metros
    IF NEW.CANTIDAD < METROS THEN
        UPDATE ROLLO_TELA
        SET METROLLO = METROS - NEW.CANTIDAD
        WHERE CODTELA = NEW.CODTELA AND CODCOLOR = NEW.CODCOLOR;
    ELSEIF NEW.CANTIDAD = METROS AND  NUM_ROLLOS >= 1 THEN
        UPDATE ROLLO_TELA
        SET METROLLO = ROLLO_NUEVO, NUMROLLOS = NUM_ROLLOS - 1
        WHERE CODTELA = NEW.CODTELA AND CODCOLOR = NEW.CODCOLOR;
    -- Si la cantidad a vender es mayor que los metros y hay rollos disponibles
    ELSEIF NEW.CANTIDAD > METROS AND NUM_ROLLOS >= 1 THEN
        SET AUX = NEW.CANTIDAD / ROLLO_NUEVO;
        SET SOBRANTE = NEW.CANTIDAD % ROLLO_NUEVO;
        SET METROS = ROLLO_NUEVO - SOBRANTE;
        SET NUM_ROLLOS = NUM_ROLLOS - AUX;

        UPDATE ROLLO_TELA
        SET METROLLO = METROS, NUMROLLOS = NUM_ROLLOS
        WHERE CODCOLOR = NEW.CODCOLOR AND CODTELA = NEW.CODTELA;
    END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargado_sucursal`
--

CREATE TABLE `encargado_sucursal` (
  `COD` int(11) NOT NULL,
  `CODSUCURSAL` int(11) DEFAULT NULL,
  `IDPERSONAL` int(11) DEFAULT NULL,
  `INICIO` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `FIN` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `encargado_sucursal`
--

INSERT INTO `encargado_sucursal` (`COD`, `CODSUCURSAL`, `IDPERSONAL`, `INICIO`, `FIN`) VALUES
(38, 1, 1, '2024-12-30 19:28:13', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `CODMARCA` int(11) NOT NULL,
  `DESCRIPCION` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`CODMARCA`, `DESCRIPCION`) VALUES
(13, 'Robert Kaufman Fabrics'),
(14, 'Hanes Fabrics'),
(15, 'Sunbrella'),
(16, 'Liberty Fabrics');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `PATERNO` varchar(50) DEFAULT NULL,
  `MATERNO` varchar(50) DEFAULT NULL,
  `USUARIO` varchar(50) NOT NULL,
  `CONTRA` varchar(50) NOT NULL,
  `CELULAR` int(11) DEFAULT NULL,
  `ESTADO` int(11) DEFAULT NULL,
  `CODCARGO` enum('1','2','3') DEFAULT NULL,
  `CODSUCURSAL` int(11) DEFAULT NULL,
  `FECHAINICIO` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`ID`, `NOMBRE`, `PATERNO`, `MATERNO`, `USUARIO`, `CONTRA`, `CELULAR`, `ESTADO`, `CODCARGO`, `CODSUCURSAL`, `FECHAINICIO`) VALUES
(1, 'Administrador', NULL, NULL, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 71234567, 1, '1', NULL, '2025-01-08 03:07:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`) VALUES
(13, 'Algodon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `CODPROV` int(11) NOT NULL,
  `NOMBRE` varchar(80) DEFAULT NULL,
  `DIRECCION` varchar(100) DEFAULT NULL,
  `TELEFONO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`CODPROV`, `NOMBRE`, `DIRECCION`, `TELEFONO`) VALUES
(9, 'Telas La Reina', 'Centro de la ciudad', 65212210);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rollo_tela`
--

CREATE TABLE `rollo_tela` (
  `CODROLLO` int(11) NOT NULL,
  `CODTELA` int(11) NOT NULL,
  `CODCOLOR` varchar(15) NOT NULL,
  `NUMROLLOS` int(11) DEFAULT NULL,
  `METROLLO` int(11) NOT NULL,
  `MROLLOCOMPLETO` int(11) NOT NULL,
  `PRECIOROLLO` float DEFAULT NULL,
  `PRECIOROLLOREAL` float NOT NULL,
  `PRECIO_METRO` int(11) NOT NULL,
  `PRECIO_METRO_REAL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `CODSUCURSAL` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `DESCRIPCION` varchar(255) DEFAULT NULL,
  `DIRECCION` varchar(250) DEFAULT NULL,
  `TELEFONO` int(11) DEFAULT NULL,
  `ENCARGADO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`CODSUCURSAL`, `NOMBRE`, `DESCRIPCION`, `DIRECCION`, `TELEFONO`, `ENCARGADO`) VALUES
(1, 'Mix COLOR', 'Variedad de todos los colores ', 'Calle simpre viva 123', 77777777, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tela`
--

CREATE TABLE `tela` (
  `CODTELA` int(11) NOT NULL,
  `NOMBRE` varchar(50) DEFAULT NULL,
  `CALIDAD` enum('1','2','3','4') DEFAULT NULL,
  `CODMARCA` int(11) NOT NULL,
  `METROS` int(11) DEFAULT NULL,
  `PRECIO` float DEFAULT NULL,
  `PRECIO_REAL` float NOT NULL,
  `CODSUCURSAL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `CODVENTA` int(11) NOT NULL,
  `IDPERSONAL` int(11) NOT NULL,
  `CODCLIENTE` int(11) DEFAULT NULL,
  `FECHA_VENTA` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `CODSUCURSAL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`IDCLIENTE`),
  ADD UNIQUE KEY `CI_NIT` (`CI_NIT`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`CODCOMPRA`),
  ADD KEY `COMPRA_PROV` (`CODPROV`),
  ADD KEY `COMPRA_PERSONAL` (`CODPERSONAL`);

--
-- Indices de la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`CODCONTRATO`),
  ADD KEY `CONTRATO_CLI` (`CODCLIENTE`),
  ADD KEY `CONTRATO_EMP` (`CODEMPLEADO`),
  ADD KEY `CONTRATO_TELA` (`CODTELA`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`coddcompra`),
  ADD KEY `D_COMPRA_COMPRA` (`codcompra`),
  ADD KEY `D_COMPRA_MARCA` (`codmarca`);

--
-- Indices de la tabla `detalle_contrato`
--
ALTER TABLE `detalle_contrato`
  ADD PRIMARY KEY (`CODDCONTRATO`),
  ADD KEY `D_CONTRATO_CONTRATO` (`CODCONTRATO`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`CODDVENTA`);

--
-- Indices de la tabla `encargado_sucursal`
--
ALTER TABLE `encargado_sucursal`
  ADD PRIMARY KEY (`COD`),
  ADD KEY `E_SUCURSAL_SUCURSAL` (`CODSUCURSAL`),
  ADD KEY `E_SUCURSAL_PERSONAL` (`IDPERSONAL`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`CODMARCA`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `USUARIO` (`USUARIO`),
  ADD KEY `personal_sucursal` (`CODSUCURSAL`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`CODPROV`);

--
-- Indices de la tabla `rollo_tela`
--
ALTER TABLE `rollo_tela`
  ADD PRIMARY KEY (`CODROLLO`),
  ADD KEY `rollo_tela_tela` (`CODTELA`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`CODSUCURSAL`),
  ADD KEY `sucursal_encar` (`ENCARGADO`);

--
-- Indices de la tabla `tela`
--
ALTER TABLE `tela`
  ADD PRIMARY KEY (`CODTELA`),
  ADD KEY `tela_marca` (`CODMARCA`),
  ADD KEY `tela_sucursal` (`CODSUCURSAL`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`CODVENTA`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `IDCLIENTE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `CODCOMPRA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `contrato`
--
ALTER TABLE `contrato`
  MODIFY `CODCONTRATO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `coddcompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `detalle_contrato`
--
ALTER TABLE `detalle_contrato`
  MODIFY `CODDCONTRATO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `CODDVENTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `encargado_sucursal`
--
ALTER TABLE `encargado_sucursal`
  MODIFY `COD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `CODMARCA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `CODPROV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `rollo_tela`
--
ALTER TABLE `rollo_tela`
  MODIFY `CODROLLO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=391;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `CODSUCURSAL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `tela`
--
ALTER TABLE `tela`
  MODIFY `CODTELA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `CODVENTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `COMPRA_PERSONAL` FOREIGN KEY (`CODPERSONAL`) REFERENCES `personal` (`ID`),
  ADD CONSTRAINT `COMPRA_PROV` FOREIGN KEY (`CODPROV`) REFERENCES `proveedor` (`CODPROV`);

--
-- Filtros para la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `CONTRATO_CLI` FOREIGN KEY (`CODCLIENTE`) REFERENCES `cliente` (`IDCLIENTE`),
  ADD CONSTRAINT `CONTRATO_EMP` FOREIGN KEY (`CODEMPLEADO`) REFERENCES `personal` (`ID`),
  ADD CONSTRAINT `CONTRATO_TELA` FOREIGN KEY (`CODTELA`) REFERENCES `tela` (`CODTELA`);

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `D_COMPRA_COMPRA` FOREIGN KEY (`codcompra`) REFERENCES `compra` (`CODCOMPRA`),
  ADD CONSTRAINT `D_COMPRA_MARCA` FOREIGN KEY (`codmarca`) REFERENCES `marca` (`CODMARCA`);

--
-- Filtros para la tabla `detalle_contrato`
--
ALTER TABLE `detalle_contrato`
  ADD CONSTRAINT `D_CONTRATO_CONTRATO` FOREIGN KEY (`CODCONTRATO`) REFERENCES `contrato` (`CODCONTRATO`);

--
-- Filtros para la tabla `encargado_sucursal`
--
ALTER TABLE `encargado_sucursal`
  ADD CONSTRAINT `E_SUCURSAL_PERSONAL` FOREIGN KEY (`IDPERSONAL`) REFERENCES `personal` (`ID`),
  ADD CONSTRAINT `E_SUCURSAL_SUCURSAL` FOREIGN KEY (`CODSUCURSAL`) REFERENCES `sucursal` (`CODSUCURSAL`);

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_sucursal` FOREIGN KEY (`CODSUCURSAL`) REFERENCES `sucursal` (`CODSUCURSAL`);

--
-- Filtros para la tabla `rollo_tela`
--
ALTER TABLE `rollo_tela`
  ADD CONSTRAINT `rollo_tela_tela` FOREIGN KEY (`CODTELA`) REFERENCES `tela` (`CODTELA`);

--
-- Filtros para la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD CONSTRAINT `sucursal_encar` FOREIGN KEY (`ENCARGADO`) REFERENCES `personal` (`ID`);

--
-- Filtros para la tabla `tela`
--
ALTER TABLE `tela`
  ADD CONSTRAINT `tela_marca` FOREIGN KEY (`CODMARCA`) REFERENCES `marca` (`CODMARCA`),
  ADD CONSTRAINT `tela_sucursal` FOREIGN KEY (`CODSUCURSAL`) REFERENCES `sucursal` (`CODSUCURSAL`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
