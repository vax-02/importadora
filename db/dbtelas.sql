-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-03-2025 a las 04:26:09
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

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`IDCLIENTE`, `RAZONSOCIAL`, `CI_NIT`, `CODTIPO`, `TELEFONO`) VALUES
(114, 'JAVIER', 7888888, 'personal', 72345287);

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
  `CODCOLOR` varchar(10) NOT NULL,
  `METROS_TELA` int(11) NOT NULL,
  `COSTO_TOTAL_TELA` float DEFAULT NULL,
  `COSTO_SASTRE` float DEFAULT NULL,
  `FRUNCIDO` decimal(10,1) NOT NULL,
  `DESCRIPCION` text NOT NULL,
  `FECHA_INICIO` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `FECHA_ENTREGA` date DEFAULT NULL,
  `C_INSTALACION` int(10) NOT NULL DEFAULT 0,
  `C_TUBOS` int(10) NOT NULL DEFAULT 0,
  `ESTADO` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contrato`
--

INSERT INTO `contrato` (`CODCONTRATO`, `CODCLIENTE`, `CODEMPLEADO`, `SASTRE`, `CODTELA`, `CODCOLOR`, `METROS_TELA`, `COSTO_TOTAL_TELA`, `COSTO_SASTRE`, `FRUNCIDO`, `DESCRIPCION`, `FECHA_INICIO`, `FECHA_ENTREGA`, `C_INSTALACION`, `C_TUBOS`, `ESTADO`) VALUES
(57, 114, 1, 'NO DEFINIDO', 65, '#00ff04', 20, 60, 17, '0.0', 'asd', '2025-03-10 02:08:28', '2025-12-12', 0, 0, 1),
(58, 114, 1, 'NO DEFINIDO', 65, '#00ff04', 20, 60, 17, '0.0', 'asd', '2025-03-10 02:19:29', '2025-12-12', 0, 0, 1),
(59, 114, 1, 'NO DEFINIDO', 65, '#00ff04', 20, 60, 17, '0.0', 'asd', '2025-03-10 02:28:04', '2025-12-12', 0, 0, 1),
(60, 114, 1, 'NO DEFINIDO', 65, '#00ff04', 20, 60, 17, '0.0', 'asd', '2025-03-10 02:28:09', '2025-12-12', 0, 0, 1),
(61, 114, 1, 'NO DEFINIDO', 65, '#00ff04', 20, 60, 17, '0.0', 'asd', '2025-03-10 02:28:23', '2025-12-12', 0, 0, 1),
(62, 114, 1, 'NO DEFINIDO', 65, '#fa0000', 20, 60, 17, '0.0', 'sdasd', '2025-03-10 02:35:53', '2025-12-12', 0, 0, 1),
(63, 114, 1, 'NO DEFINIDO', 65, '#fa0000', 20, 60, 17, '0.0', 'sdasd', '2025-03-10 02:36:39', '2025-12-12', 0, 0, 1),
(66, 114, 1, 'NO DEFINIDO', 65, '#fa0000', 144, 432, 17, '0.0', 'dad', '2025-03-10 02:50:22', '2025-02-12', 0, 0, 1),
(67, 114, 1, 'NO DEFINIDO', 65, '#fa0000', 14, 42, 17, '2.5', 'adsdasdas', '2025-03-10 03:21:44', '2025-12-12', 10, 2, 1);

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
    DECLARE METROS DECIMAL(10,2);  -- Usamos DECIMAL para manejar fracciones
    DECLARE ROLLO_NUEVO DECIMAL(10,2);  -- Usamos DECIMAL para manejar fracciones
    DECLARE AUX INT;
    DECLARE SOBRANTE DECIMAL(10,2);  -- Usamos DECIMAL para manejar fracciones
    DECLARE NUM_ROLLOS INT;
    DECLARE METRAJE_TOTAL  DECIMAL(10,1);
    -- Obtén los valores de la tabla ROLLO_TELA
    SELECT METROLLO, MROLLOCOMPLETO, NUMROLLOS
    INTO METROS, ROLLO_NUEVO, NUM_ROLLOS
    FROM ROLLO_TELA
    WHERE CODTELA = NEW.CODTELA AND CODCOLOR = NEW.CODCOLOR;

    -- CASO 1: ROLLOS ABIERTOS
    IF METROS < ROLLO_NUEVO THEN
        -- Si la cantidad a vender es menor a la cantidad en metro
        IF NEW.CANTIDAD < METROS THEN
            UPDATE ROLLO_TELA
            SET METROLLO = METROS - NEW.CANTIDAD
            WHERE CODTELA = NEW.CODTELA AND CODCOLOR = NEW.CODCOLOR;
        -- Si la cantidad a vender es igual que los metros 
        ELSEIF NEW.CANTIDAD = METROS THEN
            IF NUM_ROLLOS >= 1 THEN
                UPDATE ROLLO_TELA
                SET METROLLO = ROLLO_NUEVO
                WHERE CODTELA = NEW.CODTELA AND CODCOLOR = NEW.CODCOLOR;
            ELSE
                UPDATE ROLLO_TELA
                SET NUMROLLOS = 0,
                METROLLO = 0
                WHERE CODTELA = NEW.CODTELA AND CODCOLOR = NEW.CODCOLOR;
            END IF;
        -- Si la cantidad a vender es mayor que los metros y hay rollos disponibles
        ELSEIF NEW.CANTIDAD > METROS THEN
            SET METRAJE_TOTAL = ROLLO_NUEVO * NUM_ROLLOS + METROS;
            IF METRAJE_TOTAL > NEW.CANTIDAD THEN -- SI VA HA SOBRAR TELA
                SET METRAJE_TOTAL = METRAJE_TOTAL - NEW.CANTIDAD;

                SET NUM_ROLLOS = FLOOR(METRAJE_TOTAL/ROLLO_NUEVO);
                SET METROS = (METRAJE_TOTAL%ROLLO_NUEVO);
                IF METROS = 0 THEN
                    UPDATE ROLLO_TELA
                    SET NUMROLLOS = NUM_ROLLOS
                    WHERE CODTELA = NEW.CODTELA AND CODCOLOR = NEW.CODCOLOR;
                ELSE    
                    UPDATE ROLLO_TELA
                    SET METROLLO = METROS, NUMROLLOS = NUM_ROLLOS
                    WHERE CODTELA = NEW.CODTELA AND CODCOLOR = NEW.CODCOLOR;
                END IF;
            ELSEIF METRAJE_TOTAL = NEW.CANTIDAD THEN -- SI SE LLEGA A VENDER TODO
                    UPDATE ROLLO_TELA
                    SET METROLLO = 0, NUMROLLOS = 0
                    WHERE CODTELA = NEW.CODTELA AND CODCOLOR = NEW.CODCOLOR;
            END IF;

        END IF;
    ELSE
    -- CASO 2: ROLLOS CERRADOS
        IF NEW.CANTIDAD < METROS THEN
            UPDATE ROLLO_TELA
            SET METROLLO = METROS - NEW.CANTIDAD,
            NUMROLLOS = NUM_ROLLOS-1
            WHERE CODTELA = NEW.CODTELA AND CODCOLOR = NEW.CODCOLOR;
        ELSEIF NEW.CANTIDAD = METROS THEN
            IF NUM_ROLLOS >= 1 THEN
                UPDATE ROLLO_TELA
                SET NUMROLLOS = NUM_ROLLOS - 1
                WHERE CODTELA = NEW.CODTELA AND CODCOLOR = NEW.CODCOLOR;
            ELSE
                UPDATE ROLLO_TELA
                SET NUMROLLOS = 0,
                METROLLO = 0
                WHERE CODTELA = NEW.CODTELA AND CODCOLOR = NEW.CODCOLOR;
            END IF;
        ELSEIF NEW.CANTIDAD > METROS THEN
            SET METRAJE_TOTAL = ROLLO_NUEVO * NUM_ROLLOS;
            IF METRAJE_TOTAL > NEW.CANTIDAD THEN
                SET METRAJE_TOTAL = METRAJE_TOTAL - NEW.CANTIDAD;

                SET NUM_ROLLOS = FLOOR(METRAJE_TOTAL/ROLLO_NUEVO);
                SET METROS = (METRAJE_TOTAL%ROLLO_NUEVO);
                IF METROS = 0 THEN
                    UPDATE ROLLO_TELA
                    SET NUMROLLOS = NUM_ROLLOS
                    WHERE CODTELA = NEW.CODTELA AND CODCOLOR = NEW.CODCOLOR;
                ELSE    
                    UPDATE ROLLO_TELA
                    SET METROLLO = METROS, NUMROLLOS = NUM_ROLLOS
                    WHERE CODTELA = NEW.CODTELA AND CODCOLOR = NEW.CODCOLOR;
                END IF;
            ELSEIF METRAJE_TOTAL = NEW.CANTIDAD THEN -- SI SE LLEGA A VENDER TODO
                    UPDATE ROLLO_TELA
                    SET METROLLO = 0, NUMROLLOS = 0
                    WHERE CODTELA = NEW.CODTELA AND CODCOLOR = NEW.CODCOLOR;
            END IF;
        END IF;
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
  `INICIO` date DEFAULT NULL,
  `FIN` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(14, 'Hanes Fabrics'),
(16, 'Liberty Fabrics'),
(13, 'Robert Kaufman Fabrics'),
(15, 'Sunbrella');

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
(1, 'Administrador', '.', '.', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 71234567, 1, '1', 1, '2025-03-04 02:17:53');

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
(14, 'bonge');

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
  `METROLLO` decimal(11,1) NOT NULL,
  `MROLLOCOMPLETO` int(11) NOT NULL,
  `PRECIOROLLO` float DEFAULT NULL,
  `PRECIOROLLOREAL` float NOT NULL,
  `PRECIO_METRO` int(11) NOT NULL,
  `PRECIO_METRO_REAL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rollo_tela`
--

INSERT INTO `rollo_tela` (`CODROLLO`, `CODTELA`, `CODCOLOR`, `NUMROLLOS`, `METROLLO`, `MROLLOCOMPLETO`, `PRECIOROLLO`, `PRECIOROLLOREAL`, `PRECIO_METRO`, `PRECIO_METRO_REAL`) VALUES
(399, 65, '#000000', 0, '0.0', 100, 240, 200, 0, 0),
(400, 65, '#fa0000', 0, '92.0', 100, 240, 200, 0, 0),
(401, 65, '#00ff04', 0, '80.0', 100, 240, 200, 0, 0);

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

--
-- Volcado de datos para la tabla `tela`
--

INSERT INTO `tela` (`CODTELA`, `NOMBRE`, `CALIDAD`, `CODMARCA`, `METROS`, `PRECIO`, `PRECIO_REAL`, `CODSUCURSAL`) VALUES
(65, 'bonge', '1', 14, 100, 3, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `CODVENTA` int(11) NOT NULL,
  `IDPERSONAL` int(11) NOT NULL,
  `CODCLIENTE` int(11) DEFAULT NULL,
  `FECHA_VENTA` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `CODSUCURSAL` int(11) NOT NULL,
  `DESCUENTO` int(11) NOT NULL DEFAULT 0,
  `TIPO_VENTA` int(11) NOT NULL DEFAULT 0
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
  ADD PRIMARY KEY (`CODDVENTA`),
  ADD KEY `fk_cod_venta` (`CODVENTA`),
  ADD KEY `fk_cod_tela` (`CODTELA`);

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
  ADD PRIMARY KEY (`CODMARCA`),
  ADD UNIQUE KEY `DESCRIPCION` (`DESCRIPCION`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `USUARIO` (`USUARIO`),
  ADD UNIQUE KEY `unique_nombre_apellido` (`NOMBRE`,`PATERNO`,`MATERNO`),
  ADD KEY `personal_sucursal` (`CODSUCURSAL`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`CODPROV`),
  ADD UNIQUE KEY `NOMBRE` (`NOMBRE`);

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
  ADD UNIQUE KEY `NOMBRE` (`NOMBRE`),
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
  ADD PRIMARY KEY (`CODVENTA`),
  ADD KEY `fk_cod_personal` (`IDPERSONAL`),
  ADD KEY `fk_cod_cliente` (`CODCLIENTE`),
  ADD KEY `fk_cod_sucursal` (`CODSUCURSAL`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `IDCLIENTE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `CODCOMPRA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `contrato`
--
ALTER TABLE `contrato`
  MODIFY `CODCONTRATO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `coddcompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `detalle_contrato`
--
ALTER TABLE `detalle_contrato`
  MODIFY `CODDCONTRATO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `CODDVENTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de la tabla `encargado_sucursal`
--
ALTER TABLE `encargado_sucursal`
  MODIFY `COD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `CODMARCA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `CODPROV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `rollo_tela`
--
ALTER TABLE `rollo_tela`
  MODIFY `CODROLLO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=402;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `CODSUCURSAL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `tela`
--
ALTER TABLE `tela`
  MODIFY `CODTELA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `CODVENTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

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
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_cod_tela` FOREIGN KEY (`CODTELA`) REFERENCES `tela` (`CODTELA`),
  ADD CONSTRAINT `fk_cod_venta` FOREIGN KEY (`CODVENTA`) REFERENCES `venta` (`CODVENTA`);

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

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_cod_cliente` FOREIGN KEY (`CODCLIENTE`) REFERENCES `cliente` (`IDCLIENTE`),
  ADD CONSTRAINT `fk_cod_personal` FOREIGN KEY (`IDPERSONAL`) REFERENCES `personal` (`ID`),
  ADD CONSTRAINT `fk_cod_sucursal` FOREIGN KEY (`CODSUCURSAL`) REFERENCES `sucursal` (`CODSUCURSAL`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
