-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-02-2024 a las 15:29:29
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
-- Base de datos: `intesprogsrl`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id_actividad` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id_actividad`, `nombre`) VALUES
(1, 'FANCOIL'),
(2, 'DIFUSORES Y REJILLAS DE AIRE'),
(3, 'CALDEROS PARA AGUA CALIENTE'),
(4, 'CIRCUITO DE TUBERIAS PARA CALEFACCION'),
(5, 'VENTILADOR/EXTRACTOR DE AIRE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcate` int(11) NOT NULL,
  `nocate` varchar(100) NOT NULL,
  `state` char(1) NOT NULL,
  `fere` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcate`, `nocate`, `state`, `fere`) VALUES
(2, 'plantilla hoja de mantenimiento IntesprogSRL / actividades', '1', '2024-01-31 14:42:01'),
(4, 'plantilla hoja de mantenimiento IntesprogSRL / imagenes', '1', '2024-01-31 14:42:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idcli` int(11) NOT NULL,
  `cliente` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fiscal_servicio` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `numero_contacto` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idcli`, `cliente`, `fiscal_servicio`, `direccion`, `nombre`, `numero_contacto`, `fecha`) VALUES
(1, 'ORGANO JUDICIAL - EDIFICIO EL ALTO', '123', 'Av. Franco Valle cruce Viacha', '123', '123', '2024-01-23 22:15:03'),
(2, 'C.A.F. BANCO DE DESARROLLO DE AMÉRICA LATINA', '456', 'AV. ARCE 2915, LA PAZ', '456', '456', '2024-01-23 22:15:26'),
(3, 'asd', 'asd', 'asd', 'asd', 'asd', '2024-01-24 14:22:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `iditem` int(11) NOT NULL,
  `serie` char(14) NOT NULL,
  `nombre` text NOT NULL,
  `modelo` text NOT NULL,
  `marca` text NOT NULL,
  `capacidad` text NOT NULL,
  `tipo` text NOT NULL,
  `voltaje` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`iditem`, `serie`, `nombre`, `modelo`, `marca`, `capacidad`, `tipo`, `voltaje`) VALUES
(1, '0101', 'unidad evaporadora (FANCOIL)', 'MODELO AVB-09HJFKA', 'HISENSE', '2.8 Kw', 'tubo', '220v-240v/50Hz'),
(2, '0102', 'unidad evaporadora (FANCOIL)', 'MODELO AVB-12HJFKA', 'HISENSE', '3.6 Kw', 'Tubo', '220v-240v/50Hz'),
(3, '0103', 'unidad evaporadora (FANCOIL)', 'MODELO AVB-15HJFKA', 'HISENSE', '4.5 Kw', 'Tubo', '220v-240v/50Hz'),
(4, '0104', 'unidad evaporadora (FANCOIL)', 'MODELO AVB-19HJFKA', 'HISENSE', '5.6 Kw', 'Tubo', '220v-240v/50Hz'),
(5, '0105', 'unidad evaporadora (FANCOIL)', 'MODELO AVB-22HJFKA', 'HISENSE', '6.3 Kw', 'Tubo', '220v-240v/50Hz'),
(6, '0106', 'unidad evaporadora (FANCOIL)', 'MODELO AVB-24HJFKA', 'HISENSE', '7.1 Kw', 'Tubo', '220v-240v/50Hz'),
(7, '0107', 'unidad evaporadora (FANCOIL)', 'MODELO AVB-38HJFKA', 'HISENSE', '11.2 Kw', 'Tubo', '220v-240v/50Hz'),
(8, '0108', 'unidad evaporadora (FANCOIL)', 'MODELO AVB-48HJFKA', 'HISENSE', '14.0 Kw', 'Tubo', '220v-240v/50Hz'),
(9, '0109', 'unidad evaporadora (FANCOIL)', 'MODELO AVB-07HJFTDD', 'HISENSE', '2.2 Kw', 'unit-wall mounted', '220v-240v/50Hz'),
(10, '0201', 'difusores y rejillas ', 'asd', 'asd', 'asd', 'asd', 'asd'),
(11, 'qwe', 'qwe', 'qwe', 'qwe', 'qwe', 'qwe', 'qwe'),
(12, '000000', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `idprov` int(11) NOT NULL,
  `nombre_proveedor` varchar(255) NOT NULL,
  `direccion` text NOT NULL,
  `codigo_contable` varchar(20) NOT NULL,
  `codigo_interno` varchar(20) NOT NULL,
  `nombre_contacto` varchar(255) NOT NULL,
  `correo_contacto` varchar(50) NOT NULL,
  `telefono_contacto` varchar(15) NOT NULL,
  `moneda_por_defecto` varchar(10) NOT NULL,
  `tipo_iva` varchar(20) NOT NULL,
  `plazo_pago` int(11) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idprov`, `nombre_proveedor`, `direccion`, `codigo_contable`, `codigo_interno`, `nombre_contacto`, `correo_contacto`, `telefono_contacto`, `moneda_por_defecto`, `tipo_iva`, `plazo_pago`, `fecha_registro`) VALUES
(2, 'Proveedor de Ejemplo', 'Calle Principal 123', 'CTB123', 'INT123', 'Contacto Ejemplo', 'contacto@example.com', '+51 987654321', 'USD', 'IVA Standard', 30, '2024-01-23 18:01:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subactividades`
--

CREATE TABLE `subactividades` (
  `id_subactividad` int(11) NOT NULL,
  `id_actividad` int(11) DEFAULT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subactividades`
--

INSERT INTO `subactividades` (`id_subactividad`, `id_actividad`, `descripcion`) VALUES
(1, 1, 'Inspección  de serpentín si es necesario'),
(2, 1, 'Limpieza o sustitución de los filtros según su estado'),
(3, 1, 'Verificar el sistema de control, regulación'),
(4, 1, 'Purgar la batería de agua'),
(5, 1, 'Medición temperatura y presión en fluido portador y aire exterior en la entrada y salida del serpentín'),
(6, 1, 'Verificar el estado de las válvulas de cuatro vías'),
(7, 1, 'Comprobación de fugas'),
(8, 1, 'Comprobar del consumo de energía'),
(9, 1, 'Comprobar eI estado de corrosión'),
(10, 1, 'Verificar el funcionamiento del grupo moto ventilador'),
(11, 1, 'Verificación y reapretado de las conexiones eléctricas, hidráulicas, etc., incluso limpieza de los mismos'),
(12, 1, 'Verificación del funcionamiento de las válvulas de acuerdo a la señal de mando'),
(13, 1, 'Verificación y ajuste de los componentes de accionamiento de las válvulas motorizadas'),
(14, 1, 'Verificación y ajuste de los componentes de accionamiento de las válvulas motorizadas'),
(15, 1, 'Arrancar y observar inexistencia de ruidos extraños'),
(16, 1, 'Anotar temperaturas de entrada/salida de aire'),
(17, 1, 'Anotar temperaturas de entrada/salida de agua'),
(18, 1, 'Comprobación el flujo de aire'),
(19, 2, 'Verificar caudales de aire y regular si fuera necesario (por muestreo)'),
(20, 2, 'Limpieza de rejillas difusores'),
(21, 3, 'Verif. de los aparatos de medida y control de la caldera contrastándolos con aparatos patrón'),
(22, 3, 'Verificación de los termostatos o presostatos de seguridad de la caldera  contrastándolos con aparatos patrón'),
(23, 3, 'Puesta en marcha de la caldera comprobación general de la instalación'),
(24, 3, 'Prueba minuciosa del funcionamiento de todos los elementos de seguridad'),
(25, 3, 'Revisión de los aislamientos de la caldera'),
(26, 3, 'Pruebas hidráulicas de la caldera con comprobación de la no existencia de fugas'),
(27, 3, 'Comprobación del circuito de gases de caldera verificando la no existencia de\r\ncortocircuito de gases'),
(28, 3, 'Comprobación del circuito hidráulico de evacuación de condensados'),
(29, 3, 'Otras inspecciones Indicadas en el manual de instrucciones del Fabricante'),
(30, 3, 'Las medidas verificaciones se realizarán de acuerdo al R.I.T.E.'),
(31, 3, 'Limpieza y/o deshollinado de chimeneas'),
(32, 3, 'Verificaciones de presiones de agua en las tuberías de distribución'),
(33, 4, 'Inspección del estado de las tuberías de los circuitos\r\n'),
(34, 4, 'Inspección de la hermeticidad de los circuitos: corrección de fugas'),
(35, 4, 'Verificación del estado de los aislamientos térmicos de las tuberías y reparación de aislamientos y protecciones exteriores si procede'),
(36, 4, 'Verificación de la ausencia de humedad en el interior de los aislamientos térmicos y sustitución de estos si las hubiera'),
(37, 4, 'Inspección de estado y funcionalidad de purgadores automáticos. Limpieza de orificios'),
(38, 4, 'Inspección de estado funcionalidad de purgadores manuales. Vaciado de reservorios'),
(39, 4, 'Verificación de estado funcionalidad del sistema de llenado automático'),
(40, 4, 'Verificación de estado y funcionalidad de válvulas de corte. Comprobación de inexistencia de agarrotamiento'),
(41, 4, 'Inspección de los cierres y empaquetaduras de los ejes de las válvulas: apriete y corrección de fugas'),
(42, 4, 'Verificación de la actuación y función de cada válvula: cierre, regulación y retención'),
(43, 4, 'Comprobación del posicionado correcto de cada válvula en la condición normal de funcionamiento'),
(44, 1, 'LIMPIEZA de serpentín si es necesario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `username` varchar(25) NOT NULL,
  `correo` varchar(35) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` char(1) NOT NULL,
  `fere` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `state` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `username`, `correo`, `password`, `rol`, `fere`, `state`) VALUES
(3, 'Itzel', 'SuperAdmin', 'correo@example.com', 'e10adc3949ba59abbe56e057f20f883e', '1', '2024-01-23 17:40:11', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id_actividad`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcate`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idcli`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`iditem`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idprov`);

--
-- Indices de la tabla `subactividades`
--
ALTER TABLE `subactividades`
  ADD PRIMARY KEY (`id_subactividad`),
  ADD KEY `id_actividad` (`id_actividad`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idcli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `iditem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idprov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `subactividades`
--
ALTER TABLE `subactividades`
  MODIFY `id_subactividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `subactividades`
--
ALTER TABLE `subactividades`
  ADD CONSTRAINT `subactividades_ibfk_1` FOREIGN KEY (`id_actividad`) REFERENCES `actividades` (`id_actividad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
