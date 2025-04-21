-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-03-2025 a las 07:09:12
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
(114, 'JAVIER', 7888888, 'personal', 72345287),
(115, 'TEST 2', 75454545, 'empresa', 78454848),
(116, 'ABC', 7411111, 'empresa', 78454555),
(117, 'Tarija', 78787878, 'empresa', 78788888),
(118, 'example ', 4545555, 'personal', 78888888),
(119, 'asd', 7777777, 'personal', 70000111),
(120, 'new new', 123123123, 'personal', 78383888);

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

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`CODCOMPRA`, `FECHA`, `CODPERSONAL`, `CODPROV`, `ESTADO`) VALUES
(43, '2025-03-14 01:52:14', 1, 9, 0),
(44, '2025-03-14 01:53:27', 1, 9, 0),
(45, '2025-03-17 02:01:14', 1, 9, 0),
(46, '2025-03-17 02:25:32', 1, 9, 0);

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
  `ESTADO` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contrato`
--

INSERT INTO `contrato` (`CODCONTRATO`, `CODCLIENTE`, `CODEMPLEADO`, `SASTRE`, `CODTELA`, `CODCOLOR`, `METROS_TELA`, `COSTO_TOTAL_TELA`, `COSTO_SASTRE`, `FRUNCIDO`, `DESCRIPCION`, `FECHA_INICIO`, `FECHA_ENTREGA`, `ESTADO`) VALUES
(68, 116, 1, 'NO DEFINIDO', 65, '#fa0000', 10, 30, 17, '2.5', 'asdasda sda sd as da sd as', '2025-03-28 03:30:17', '2021-02-18', 1),
(69, 114, 1, 'NO DEFINIDO', 65, '#000000', 10, 30, 17, '2.5', 'kkkklkpopp', '2025-03-28 05:34:34', '2000-02-18', 1),
(70, 114, 1, 'NO DEFINIDO', 65, '#000000', 10, 30, 17, '2.5', 'kkkklkpopp', '2025-03-28 05:34:35', '2000-02-18', 1),
(71, 115, 1, 'NO DEFINIDO', 65, '#000000', 10, 30, 17, '2.5', 'kjjjjjjjjjjjjjjjjjjjjjjjjj', '2025-03-28 05:54:44', '2012-12-12', 1),
(72, 115, 1, 'NO DEFINIDO', 65, '#000000', 10, 30, 17, '2.5', 'kjjjjjjjjjjjjjjjjjjjjjjjjj', '2025-03-28 05:55:04', '2012-12-12', 1),
(73, 118, 1, 'NO DEFINIDO', 65, '#000000', 10, 30, 17, '2.5', 'asdasdas', '2025-03-28 06:02:24', '1222-12-12', 1),
(74, 117, 1, 'NO DEFINIDO', 65, '#000000', 10, 30, 17, '2.5', 'asdasd', '2025-03-28 06:03:36', '2021-12-12', 1),
(75, 120, 1, 'NO DEFINIDO', 65, '#000000', 10, 30, 17, '2.5', 'sdasds', '2025-03-28 06:04:47', '2000-12-12', 1),
(76, 114, 1, 'NO DEFINIDO', 65, '#000000', 10, 30, 17, '2.5', 'ASDASD', '2025-03-28 06:05:43', '2012-12-12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato_material_instalacion`
--

CREATE TABLE `contrato_material_instalacion` (
  `id` int(11) NOT NULL,
  `codcontrato` int(11) NOT NULL,
  `ventanas` int(11) NOT NULL,
  `metrosTubo` decimal(10,1) NOT NULL,
  `c_tubo` decimal(10,1) NOT NULL,
  `numHerraje` int(11) NOT NULL,
  `c_herraje` decimal(10,1) NOT NULL,
  `c_instalacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contrato_material_instalacion`
--

INSERT INTO `contrato_material_instalacion` (`id`, `codcontrato`, `ventanas`, `metrosTubo`, `c_tubo`, `numHerraje`, `c_herraje`, `c_instalacion`) VALUES
(1, 71, 2, '7.0', '49.0', 4, '28.0', 10),
(2, 72, 2, '7.0', '49.0', 4, '28.0', 10),
(3, 73, 2, '4.0', '8.0', 4, '8.0', 0),
(4, 74, 2, '4.0', '44.0', 4, '40.0', 0),
(5, 75, 2, '4.4', '0.0', 4, '0.0', 0),
(6, 76, 2, '4.4', '0.0', 4, '0.0', 100);

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

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`coddcompra`, `codcompra`, `nombre`, `codcolor`, `codmarca`, `calidad`, `cantidad`) VALUES
(60, 43, 'bonge', '#00fbff', 14, 1, 5),
(61, 44, 'bonge', '#000000', 15, 4, 5),
(62, 45, 'bonge', '#000000', 14, 1, 5),
(63, 46, 'Tergal', '#000000', 14, 1, 5);

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

--
-- Volcado de datos para la tabla `detalle_contrato`
--

INSERT INTO `detalle_contrato` (`CODDCONTRATO`, `CODCONTRATO`, `ALTO`, `ANCHO`, `CANTIDAD`) VALUES
(49, 68, 2, 2, 2),
(50, 69, 2, 2, 2),
(51, 70, 2, 2, 2),
(52, 71, 2, 2, 2),
(53, 72, 2, 2, 2),
(54, 73, 2, 2, 2),
(55, 74, 2, 2, 2),
(56, 75, 2, 2, 2),
(57, 76, 2, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `CODDVENTA` int(11) NOT NULL,
  `CODVENTA` int(11) DEFAULT NULL,
  `CODTELA` int(11) DEFAULT NULL,
  `CODCOLOR` varchar(50) DEFAULT NULL,
  `PRECIO` decimal(10,1) DEFAULT NULL,
  `CANTIDAD` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`CODDVENTA`, `CODVENTA`, `CODTELA`, `CODCOLOR`, `PRECIO`, `CANTIDAD`) VALUES
(155, 195, 69, '#000000', '1.5', 10),
(156, 196, 65, '#00ff04', '3.0', 5),
(157, 196, 69, '#000000', '1.5', 5),
(158, 197, 70, '#000000', '3.0', 10),
(159, 197, 70, '#ff0000', '3.0', 10),
(160, 198, 72, '#ff0000', '250.0', 100),
(161, 198, 72, '#04ff00', '250.0', 100),
(162, 199, 71, '#ff0000', '330.0', 150),
(163, 200, 69, '#000000', '1.5', 2),
(164, 201, 69, '#000000', '110.0', 100),
(165, 202, 69, '#000000', '1.5', 10),
(166, 203, 73, '#ffea00', '220.0', 200),
(167, 204, 69, '#000000', '1.5', 10),
(168, 205, 65, '#fa0000', '3.0', 10),
(169, 206, 65, '#00ff04', '240.0', 500),
(170, 207, 65, '#000000', '3.0', 10),
(171, 208, 65, '#000000', '3.0', 10),
(172, 209, 65, '#000000', '3.0', 10),
(173, 210, 65, '#000000', '3.0', 10),
(174, 211, 65, '#000000', '3.0', 10),
(175, 212, 65, '#000000', '3.0', 10),
(176, 213, 65, '#000000', '3.0', 10),
(177, 214, 65, '#000000', '3.0', 10);

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
(1, 'Administrador', '.', '.', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 71234567, 1, '1', 1, '2025-03-14 00:05:13'),
(46, 'TTTTT', 'TTT', 'TTT', 'seller', '25d55ad283aa400af464c76d713c07ad', 78888888, 1, '3', 1, '2025-03-19 04:37:00'),
(47, 'asasd', 'asda', 'sdasd', '1', '102f3a72896214acbbcbc5bc69f6c22b', 78788888, 1, '3', 1, '2025-03-26 03:10:56');

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
(14, 'bonge'),
(15, 'Piel de leon'),
(16, 'Tergal');

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
(399, 65, '#000000', 4, '20.0', 100, 240, 200, 0, 0),
(400, 65, '#fa0000', 3, '100.0', 100, 240, 200, 0, 0),
(401, 65, '#00ff04', 5, '100.0', 100, 240, 200, 0, 0),
(402, 69, '#000000', 0, '79.5', 100, 110, 100, 0, 0),
(403, 70, '#000000', 3, '80.0', 100, 220, 200, 0, 0),
(404, 70, '#ff0000', 2, '90.0', 100, 220, 200, 0, 0),
(405, 71, '#ff0000', 1, '50.0', 150, 330, 300, 0, 0),
(406, 72, '#ff0000', 3, '100.0', 100, 250, 200, 0, 0),
(407, 72, '#04ff00', 4, '100.0', 100, 250, 200, 0, 0),
(408, 73, '#000000', 15, '100.0', 100, 220, 200, 0, 0),
(409, 73, '#ff0095', 5, '100.0', 100, 220, 200, 0, 0),
(410, 73, '#00ff2a', 5, '100.0', 100, 220, 200, 0, 0),
(411, 73, '#ffea00', 3, '100.0', 100, 220, 200, 0, 0);

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
(1, 'Mix COLOR', 'Variedad de todos los colores ', 'Calle simpre viva 123', 77777777, 1),
(37, 'TIENDA TWO', 'ADASDASD', 'ASDASD ASD ASD AS', 72451020, 1),
(38, 'STORE THREE', 'ASD', 'ASD', 7845, 1),
(39, 'store foor', 'asd', 'asd', 45, 1);

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
(65, 'bonge', '1', 14, 100, 3, 2, 1),
(69, 'bonge', '4', 15, 100, 1.5, 1, 1),
(70, 'bonge', '1', 14, 100, 3, 2, 37),
(71, 'bonge', '1', 14, 150, 3, 2, 38),
(72, 'Piel de leon', '1', 15, 100, 3, 2, 39),
(73, 'Tergal', '1', 14, 100, 2.2, 2, 1);

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
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`CODVENTA`, `IDPERSONAL`, `CODCLIENTE`, `FECHA_VENTA`, `CODSUCURSAL`, `DESCUENTO`, `TIPO_VENTA`) VALUES
(195, 1, 114, '2025-03-15 03:57:30', 1, 0, 0),
(196, 1, 114, '2025-03-16 03:58:04', 1, 0, 0),
(197, 1, 114, '2025-03-15 03:00:00', 37, 0, 0),
(198, 1, 114, '2025-03-16 04:01:13', 39, 5, 1),
(199, 1, 114, '2025-03-16 04:08:33', 38, 0, 1),
(200, 1, 114, '2025-03-17 02:34:07', 1, 9, 0),
(201, 1, 114, '2025-03-19 02:27:34', 1, 0, 1),
(202, 1, 117, '2025-03-19 02:46:36', 1, 0, 0),
(203, 1, 118, '2025-03-19 02:47:09', 1, 0, 1),
(204, 46, 114, '2025-03-18 04:37:28', 1, 0, 0),
(205, 1, 116, '2025-03-22 04:41:23', 1, 0, 0),
(206, 1, 120, '2025-03-28 03:47:59', 1, 0, 1),
(207, 1, 114, '2025-03-28 05:34:35', 1, 0, 0),
(208, 1, 114, '2025-03-28 05:34:36', 1, 0, 0),
(209, 1, 115, '2025-03-28 05:54:44', 1, 0, 0),
(210, 1, 115, '2025-03-28 05:55:04', 1, 0, 0),
(211, 1, 118, '2025-03-28 06:02:24', 1, 0, 0),
(212, 1, 117, '2025-03-28 06:03:37', 1, 0, 0),
(213, 1, 120, '2025-03-28 06:04:47', 1, 0, 0),
(214, 1, 114, '2025-03-28 06:05:44', 1, 0, 0);

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
-- Indices de la tabla `contrato_material_instalacion`
--
ALTER TABLE `contrato_material_instalacion`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `IDCLIENTE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `CODCOMPRA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `contrato`
--
ALTER TABLE `contrato`
  MODIFY `CODCONTRATO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `contrato_material_instalacion`
--
ALTER TABLE `contrato_material_instalacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `coddcompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `detalle_contrato`
--
ALTER TABLE `detalle_contrato`
  MODIFY `CODDCONTRATO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `CODDVENTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `CODPROV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `rollo_tela`
--
ALTER TABLE `rollo_tela`
  MODIFY `CODROLLO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=412;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `CODSUCURSAL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `tela`
--
ALTER TABLE `tela`
  MODIFY `CODTELA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `CODVENTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

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
