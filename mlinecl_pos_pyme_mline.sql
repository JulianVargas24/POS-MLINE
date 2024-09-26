-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 26-09-2024 a las 10:46:52
-- Versión del servidor: 10.6.18-MariaDB-cll-lve
-- Versión de PHP: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mlinecl_pos_pyme_mline`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ajustes`
--

CREATE TABLE `ajustes` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `causal` varchar(255) NOT NULL,
  `fecha_emision` date NOT NULL DEFAULT current_timestamp(),
  `observaciones` varchar(255) NOT NULL DEFAULT 'SIN OBSERVACION',
  `id_bodega_origen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ajustes`
--

INSERT INTO `ajustes` (`id`, `codigo`, `causal`, `fecha_emision`, `observaciones`, `id_bodega_origen`) VALUES
(1, 1, 'AJUSTE', '2024-09-09', 'HOY SE AGREGRON A SUPER BODEGA 3000', 2),
(2, 2, 'ROBO', '2024-09-30', 'l', 2),
(3, 3, 'MERMA', '0000-00-00', '', 1),
(4, 3, 'ROBO', '0000-00-00', 'o', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ajuste_producto`
--

CREATE TABLE `ajuste_producto` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_ajuste` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `diferencia` varchar(255) NOT NULL,
  `id_bodega` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ajuste_producto`
--

INSERT INTO `ajuste_producto` (`id`, `id_producto`, `id_ajuste`, `descripcion`, `cantidad`, `diferencia`, `id_bodega`) VALUES
(1, 20, 1, 'SUPER CAJA', 100, '100', 2),
(2, 6, 2, 'Reloj Comedor LAN', 0, '0', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancos`
--

CREATE TABLE `bancos` (
  `id` int(11) NOT NULL,
  `nombre_banco` varchar(100) NOT NULL,
  `codigo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bancos`
--

INSERT INTO `bancos` (`id`, `nombre_banco`, `codigo`) VALUES
(1, 'BANCO DE CHILE', '001'),
(2, 'BANCO INTERNACIONAL', '009'),
(3, 'SCOTIABANK CHILE', '014'),
(4, 'BANCO DE CREDITO E INVERSIONES', '016'),
(5, 'CORPBANCA', '027'),
(6, 'BANCO BICE', '028'),
(7, 'HSBC BANK (CHILE)', '031'),
(8, 'BANCO SANTANDER-CHILE', '037'),
(9, 'BANCO ITAÚ CHILE', '039'),
(10, 'BANCO SECURITY', '049'),
(11, 'BANCO FALABELLA', '051'),
(12, 'DEUTSCHE BANK (CHILE)', '052'),
(13, 'BANCO RIPLEY', '053'),
(14, 'RABOBANK CHILE', '054'),
(15, 'BANCO CONSORCIO', '055'),
(16, 'BANCO PENTA', '056'),
(17, 'BANCO PARIS', '057'),
(18, 'BANCO BILBAO VIZCAYA ARGENTARIA, CHILE (BBVA)', '504'),
(19, 'BANCO DEL ESTADO DE CHILE', '012');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodegas`
--

CREATE TABLE `bodegas` (
  `id` int(11) NOT NULL,
  `nombre` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `region` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `comuna` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `direccion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `jefe` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `telefono` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `email` tinytext DEFAULT NULL,
  `pais` varchar(255) NOT NULL DEFAULT 'Chile'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bodegas`
--

INSERT INTO `bodegas` (`id`, `nombre`, `region`, `comuna`, `direccion`, `jefe`, `telefono`, `email`, `pais`) VALUES
(1, 'Principal', 'Los Lagos', 'Puerto Montt', 'Balmaceda 282', 'Fernando Torres', '974062227', 'ftorres@mline.cl', 'Chile'),
(2, 'super bodega 3000', 'Valparaiso', 'Quillón', 'avenida jose', 'carlos', 'este es el numero', 'hola como estas? correo', 'Chile'),
(3, 'Bodega Acuenta', 'Arica y Parinacota', 'Puerto Montt', 'sí', 'y', '8', 'l', 'Chile');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodega_productos`
--

CREATE TABLE `bodega_productos` (
  `id` int(11) NOT NULL,
  `id_bodega` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `stock_producto` int(11) NOT NULL,
  `fecha_modificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `fecha`) VALUES
(36, 'Soporte', '2021-10-12 18:28:09'),
(37, 'Asesoría', '2021-10-12 18:28:24'),
(38, 'Servicios', '2021-10-12 18:28:33'),
(39, 'Capacitación', '2021-10-12 18:29:21'),
(40, 'Hardware', '2021-10-12 18:29:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centros_costo`
--

CREATE TABLE `centros_costo` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `centro` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `centros_costo`
--

INSERT INTO `centros_costo` (`id`, `codigo`, `centro`) VALUES
(1, 1, 'Sin Especificar'),
(3, 111, 'CENTRO COSTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `rut` varchar(20) NOT NULL,
  `email` text NOT NULL,
  `telefono` text NOT NULL,
  `direccion` text NOT NULL,
  `compras` int(11) NOT NULL,
  `ultima_compra` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `actividad` varchar(255) NOT NULL,
  `ejecutivo` varchar(255) NOT NULL,
  `id_plazo` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `factor_lista` int(11) NOT NULL DEFAULT 0,
  `pais` varchar(255) NOT NULL DEFAULT 'Chile',
  `comuna` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `rut`, `email`, `telefono`, `direccion`, `compras`, `ultima_compra`, `fecha`, `actividad`, `ejecutivo`, `id_plazo`, `id_vendedor`, `factor_lista`, `pais`, `comuna`, `region`) VALUES
(2, 'Comercial Bahamonde y Ulloa Ltda.', '76.063.632-0', '0', '0', '5 de abril N° 125', 0, '0000-00-00 00:00:00', '2021-10-21 21:53:50', 'Ferretería', '0', 1, 7, 1, 'Chile', 'Dalcahue', 'Los Lagos'),
(3, 'Pesquera Pacific Star S.A. ', '96.831.480-7', '0', '0', 'Bernardino 1990', 0, '0000-00-00 00:00:00', '2021-11-19 13:40:57', 'PRODUCCION ALIMENTOS', '0', 3, 7, 1, 'Chile', 'Puerto Montt', 'Los Lagos'),
(4, 'Comercial y Servicios Generales SpA', '76.164.831-4', 'operaciones@segproject.cl', '51882212', 'Madrid 1235', 0, '0000-00-00 00:00:00', '2021-12-09 15:07:25', 'Obras de Ingeniería.', 'Anthony Tovar', 1, 7, 1, 'Chile', 'Santiago', 'Metropolitana de Santiago'),
(5, 'NEUMASERVICE SPA', '76.340.654-7', '0', '0', 'Ecuador 1069', 0, '0000-00-00 00:00:00', '2022-02-07 13:49:58', 'Serviteca', '0', 1, 7, 1, 'Chile', 'Puerto Montt', 'Los Lagos'),
(6, 'Servicios Gastronómicos Austral SPA', '76.608.115-0', '0', '0', 'Pedro Montt 179', 0, '0000-00-00 00:00:00', '2022-03-22 16:47:50', 'Restaurant', '0', 1, 7, 1, 'Chile', 'Puerto Montt', 'Los Lagos'),
(7, 'PEPE', 'este es el rut del c', 'hola como estas? correo', 'este es el numero', 'avenida jose', 0, '0000-00-00 00:00:00', '2024-09-09 14:59:05', 'EJECUTIVO', 'pedro', 1, 7, 1, 'EL MUNDO', 'Arica', 'Los Lagos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `fecha_emision` date NOT NULL,
  `id_centro` int(11) NOT NULL,
  `id_bodega` int(11) NOT NULL,
  `id_plazo_pago` int(11) NOT NULL,
  `id_medio_pago` int(11) NOT NULL,
  `productos` varchar(1000) NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `subtotal` varchar(15) NOT NULL,
  `total_neto` varchar(15) NOT NULL,
  `descuento` varchar(15) NOT NULL DEFAULT '0',
  `iva` varchar(15) NOT NULL,
  `total_final` varchar(15) NOT NULL,
  `folio_oc` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `codigo`, `id_proveedor`, `fecha_emision`, `id_centro`, `id_bodega`, `id_plazo_pago`, `id_medio_pago`, `productos`, `observacion`, `subtotal`, `total_neto`, `descuento`, `iva`, `total_final`, `folio_oc`) VALUES
(1, 1, 2, '2024-09-09', 1, 2, 1, 1, '[{\"id\":\"20\",\"descripcion\":\"SUPER CAJA\",\"cantidad\":\"1\",\"precio\":\"10000\",\"descuento\":\"0\",\"iva\":\"1900\",\"total\":\"11900\"}]', 'observacion muy positiva A+', '10,000', '10,000', '0', '1,900', '11900', 0),
(2, 1112233344, 1, '2024-09-10', 3, 2, 4, 5, '[{\"id\":\"1\",\"descripcion\":\"Desarrollo Software Vive Cermaq cuota 6\",\"cantidad\":\"3\",\"precio\":\"200000\",\"descuento\":\"50000\",\"iva\":\"104500\",\"total\":\"654500\"},{\"id\":\"4\",\"descripcion\":\"Soporte Informático\",\"cantidad\":\"2\",\"precio\":\"100000\",\"descuento\":\"20000\",\"iva\":\"34200\",\"total\":\"214200\"},{\"id\":\"7\",\"descripcion\":\"Impresora Termica Fiscal\",\"cantidad\":\"1\",\"precio\":\"50000\",\"descuento\":\"5000\",\"iva\":\"8550\",\"total\":\"53550\"}]', 'HOLA HOLA ADIOS', '850,000', '775,000', '75,000', '147,250', '922250', 0),
(3, 111111, 2, '2024-09-10', 3, 2, 4, 3, '[{\"id\":\"1\",\"descripcion\":\"Desarrollo Software Vive Cermaq cuota 6\",\"cantidad\":\"10\",\"precio\":\"100000\",\"descuento\":\"4000\",\"iva\":\"189240\",\"total\":\"1185240\"},{\"id\":\"2\",\"descripcion\":\"Soporte mensual Vive Cermaq\",\"cantidad\":\"2\",\"precio\":\"50000\",\"descuento\":\"5000\",\"iva\":\"18050\",\"total\":\"113050\"}]', 'AAAAAAAAAAAAAAAAAAAAAAA', '1,100,000', '1,091,000', '9,000', '207,290', '1298290', 0),
(4, 1313131, 2, '2024-09-09', 3, 2, 1, 2, '[{\"id\":\"2\",\"descripcion\":\"Soporte mensual Vive Cermaq\",\"cantidad\":\"5\",\"precio\":\"20000\",\"descuento\":\"10000\",\"iva\":\"17100\",\"total\":\"107100\"},{\"id\":\"3\",\"descripcion\":\"Asesoría Obtención Patente Cafetería Cermaq PMC\",\"cantidad\":\"15\",\"precio\":\"50000\",\"descuento\":\"5000\",\"iva\":\"141550\",\"total\":\"886550\"}]', 'BBBBBBBBBBBB', '850,000', '835,000', '15,000', '158,650', '993650', 0),
(5, 0, 2, '2024-09-04', 3, 2, 1, 2, '[{\"id\":\"1\",\"descripcion\":\"Desarrollo Software Vive Cermaq cuota 6\",\"cantidad\":\"1\",\"precio\":\"10000\",\"descuento\":\"0\",\"iva\":\"1900\",\"total\":\"11900\"},{\"id\":\"2\",\"descripcion\":\"Soporte mensual Vive Cermaq\",\"cantidad\":\"1\",\"precio\":\"10000\",\"descuento\":\"0\",\"iva\":\"1900\",\"total\":\"11900\"}]', 'BBBBBBBBBBBBB', '20,000', '20,000', '0', '3,800', '23800', 0),
(6, 1112233344, 1, '2024-09-10', 1, 1, 1, 2, '[{\"id\":\"7\",\"descripcion\":\"Impresora Termica Fiscal\",\"cantidad\":\"1\",\"precio\":\"214137\",\"descuento\":\"0\",\"iva\":\"40686\",\"total\":\"254823\"},{\"id\":\"9\",\"descripcion\":\"Gabinete Impresora\",\"cantidad\":\"1\",\"precio\":\"91773\",\"descuento\":\"0\",\"iva\":\"17437\",\"total\":\"109210\"}]', '', '305,910', '305,910', '0', '58,123', '364,033', 49),
(7, 1, 2, '2024-09-10', 3, 2, 5, 6, 'Observación.', 'Observación', '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunas`
--

CREATE TABLE `comunas` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL DEFAULT '',
  `region_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `comunas`
--

INSERT INTO `comunas` (`id`, `nombre`, `region_id`) VALUES
(1, 'Arica', 1),
(2, 'Camarones', 1),
(3, 'General Lagos', 1),
(4, 'Putre', 1),
(5, 'Alto Hospicio', 2),
(6, 'Iquique', 2),
(7, 'Camiña', 2),
(8, 'Colchane', 2),
(9, 'Huara', 2),
(10, 'Pica', 2),
(11, 'Pozo Almonte', 2),
(12, 'Antofagasta', 3),
(13, 'Mejillones', 3),
(14, 'Sierra Gorda', 3),
(15, 'Taltal', 3),
(16, 'Calama', 3),
(17, 'Ollague', 3),
(18, 'San Pedro de Atacama', 3),
(19, 'María Elena', 3),
(20, 'Tocopilla', 3),
(21, 'Chañaral', 4),
(22, 'Diego de Almagro', 4),
(23, 'Caldera', 4),
(24, 'Copiapó', 4),
(25, 'Tierra Amarilla', 4),
(26, 'Alto del Carmen', 4),
(27, 'Freirina', 4),
(28, 'Huasco', 4),
(29, 'Vallenar', 4),
(30, 'Canela', 5),
(31, 'Illapel', 5),
(32, 'Los Vilos', 5),
(33, 'Salamanca', 5),
(34, 'Andacollo', 5),
(35, 'Coquimbo', 5),
(36, 'La Higuera', 5),
(37, 'La Serena', 5),
(38, 'Paihuaco', 5),
(39, 'Vicuña', 5),
(40, 'Combarbalá', 5),
(41, 'Monte Patria', 5),
(42, 'Ovalle', 5),
(43, 'Punitaqui', 5),
(44, 'Río Hurtado', 5),
(45, 'Isla de Pascua', 6),
(46, 'Calle Larga', 6),
(47, 'Los Andes', 6),
(48, 'Rinconada', 6),
(49, 'San Esteban', 6),
(50, 'La Ligua', 6),
(51, 'Papudo', 6),
(52, 'Petorca', 6),
(53, 'Zapallar', 6),
(54, 'Hijuelas', 6),
(55, 'La Calera', 6),
(56, 'La Cruz', 6),
(57, 'Limache', 6),
(58, 'Nogales', 6),
(59, 'Olmué', 6),
(60, 'Quillota', 6),
(61, 'Algarrobo', 6),
(62, 'Cartagena', 6),
(63, 'El Quisco', 6),
(64, 'El Tabo', 6),
(65, 'San Antonio', 6),
(66, 'Santo Domingo', 6),
(67, 'Catemu', 6),
(68, 'Llaillay', 6),
(69, 'Panquehue', 6),
(70, 'Putaendo', 6),
(71, 'San Felipe', 6),
(72, 'Santa María', 6),
(73, 'Casablanca', 6),
(74, 'Concón', 6),
(75, 'Juan Fernández', 6),
(76, 'Puchuncaví', 6),
(77, 'Quilpué', 6),
(78, 'Quintero', 6),
(79, 'Valparaíso', 6),
(80, 'Villa Alemana', 6),
(81, 'Viña del Mar', 6),
(82, 'Colina', 7),
(83, 'Lampa', 7),
(84, 'Tiltil', 7),
(85, 'Pirque', 7),
(86, 'Puente Alto', 7),
(87, 'San José de Maipo', 7),
(88, 'Buin', 7),
(89, 'Calera de Tango', 7),
(90, 'Paine', 7),
(91, 'San Bernardo', 7),
(92, 'Alhué', 7),
(93, 'Curacaví', 7),
(94, 'María Pinto', 7),
(95, 'Melipilla', 7),
(96, 'San Pedro', 7),
(97, 'Cerrillos', 7),
(98, 'Cerro Navia', 7),
(99, 'Conchalí', 7),
(100, 'El Bosque', 7),
(101, 'Estación Central', 7),
(102, 'Huechuraba', 7),
(103, 'Independencia', 7),
(104, 'La Cisterna', 7),
(105, 'La Granja', 7),
(106, 'La Florida', 7),
(107, 'La Pintana', 7),
(108, 'La Reina', 7),
(109, 'Las Condes', 7),
(110, 'Lo Barnechea', 7),
(111, 'Lo Espejo', 7),
(112, 'Lo Prado', 7),
(113, 'Macul', 7),
(114, 'Maipú', 7),
(115, 'Ñuñoa', 7),
(116, 'Pedro Aguirre Cerda', 7),
(117, 'Peñalolén', 7),
(118, 'Providencia', 7),
(119, 'Pudahuel', 7),
(120, 'Quilicura', 7),
(121, 'Quinta Normal', 7),
(122, 'Recoleta', 7),
(123, 'Renca', 7),
(124, 'San Miguel', 7),
(125, 'San Joaquín', 7),
(126, 'San Ramón', 7),
(127, 'Santiago', 7),
(128, 'Vitacura', 7),
(129, 'El Monte', 7),
(130, 'Isla de Maipo', 7),
(131, 'Padre Hurtado', 7),
(132, 'Peñaflor', 7),
(133, 'Talagante', 7),
(134, 'Codegua', 8),
(135, 'Coínco', 8),
(136, 'Coltauco', 8),
(137, 'Doñihue', 8),
(138, 'Graneros', 8),
(139, 'Las Cabras', 8),
(140, 'Machalí', 8),
(141, 'Malloa', 8),
(142, 'Mostazal', 8),
(143, 'Olivar', 8),
(144, 'Peumo', 8),
(145, 'Pichidegua', 8),
(146, 'Quinta de Tilcoco', 8),
(147, 'Rancagua', 8),
(148, 'Rengo', 8),
(149, 'Requínoa', 8),
(150, 'San Vicente de Tagua Tagua', 8),
(151, 'La Estrella', 8),
(152, 'Litueche', 8),
(153, 'Marchihue', 8),
(154, 'Navidad', 8),
(155, 'Paredones', 8),
(156, 'Pichilemu', 8),
(157, 'Chépica', 8),
(158, 'Chimbarongo', 8),
(159, 'Lolol', 8),
(160, 'Nancagua', 8),
(161, 'Palmilla', 8),
(162, 'Peralillo', 8),
(163, 'Placilla', 8),
(164, 'Pumanque', 8),
(165, 'San Fernando', 8),
(166, 'Santa Cruz', 8),
(167, 'Cauquenes', 9),
(168, 'Chanco', 9),
(169, 'Pelluhue', 9),
(170, 'Curicó', 9),
(171, 'Hualañé', 9),
(172, 'Licantén', 9),
(173, 'Molina', 9),
(174, 'Rauco', 9),
(175, 'Romeral', 9),
(176, 'Sagrada Familia', 9),
(177, 'Teno', 9),
(178, 'Vichuquén', 9),
(179, 'Colbún', 9),
(180, 'Linares', 9),
(181, 'Longaví', 9),
(182, 'Parral', 9),
(183, 'Retiro', 9),
(184, 'San Javier', 9),
(185, 'Villa Alegre', 9),
(186, 'Yerbas Buenas', 9),
(187, 'Constitución', 9),
(188, 'Curepto', 9),
(189, 'Empedrado', 9),
(190, 'Maule', 9),
(191, 'Pelarco', 9),
(192, 'Pencahue', 9),
(193, 'Río Claro', 9),
(194, 'San Clemente', 9),
(195, 'San Rafael', 9),
(196, 'Talca', 9),
(197, 'Arauco', 10),
(198, 'Cañete', 10),
(199, 'Contulmo', 10),
(200, 'Curanilahue', 10),
(201, 'Lebu', 10),
(202, 'Los Álamos', 10),
(203, 'Tirúa', 10),
(204, 'Alto Biobío', 10),
(205, 'Antuco', 10),
(206, 'Cabrero', 10),
(207, 'Laja', 10),
(208, 'Los Ángeles', 10),
(209, 'Mulchén', 10),
(210, 'Nacimiento', 10),
(211, 'Negrete', 10),
(212, 'Quilaco', 10),
(213, 'Quilleco', 10),
(214, 'San Rosendo', 10),
(215, 'Santa Bárbara', 10),
(216, 'Tucapel', 10),
(217, 'Yumbel', 10),
(218, 'Chiguayante', 10),
(219, 'Concepción', 10),
(220, 'Coronel', 10),
(221, 'Florida', 10),
(222, 'Hualpén', 10),
(223, 'Hualqui', 10),
(224, 'Lota', 10),
(225, 'Penco', 10),
(226, 'San Pedro de La Paz', 10),
(227, 'Santa Juana', 10),
(228, 'Talcahuano', 10),
(229, 'Tomé', 10),
(230, 'Bulnes', 10),
(231, 'Chillán', 10),
(232, 'Chillán Viejo', 10),
(233, 'Cobquecura', 10),
(234, 'Coelemu', 10),
(235, 'Coihueco', 10),
(236, 'El Carmen', 10),
(237, 'Ninhue', 10),
(238, 'Ñiquen', 10),
(239, 'Pemuco', 10),
(240, 'Pinto', 10),
(241, 'Portezuelo', 10),
(242, 'Quillón', 10),
(243, 'Quirihue', 10),
(244, 'Ránquil', 10),
(245, 'San Carlos', 10),
(246, 'San Fabián', 10),
(247, 'San Ignacio', 10),
(248, 'San Nicolás', 10),
(249, 'Treguaco', 10),
(250, 'Yungay', 10),
(251, 'Carahue', 11),
(252, 'Cholchol', 11),
(253, 'Cunco', 11),
(254, 'Curarrehue', 11),
(255, 'Freire', 11),
(256, 'Galvarino', 11),
(257, 'Gorbea', 11),
(258, 'Lautaro', 11),
(259, 'Loncoche', 11),
(260, 'Melipeuco', 11),
(261, 'Nueva Imperial', 11),
(262, 'Padre Las Casas', 11),
(263, 'Perquenco', 11),
(264, 'Pitrufquén', 11),
(265, 'Pucón', 11),
(266, 'Saavedra', 11),
(267, 'Temuco', 11),
(268, 'Teodoro Schmidt', 11),
(269, 'Toltén', 11),
(270, 'Vilcún', 11),
(271, 'Villarrica', 11),
(272, 'Angol', 11),
(273, 'Collipulli', 11),
(274, 'Curacautín', 11),
(275, 'Ercilla', 11),
(276, 'Lonquimay', 11),
(277, 'Los Sauces', 11),
(278, 'Lumaco', 11),
(279, 'Purén', 11),
(280, 'Renaico', 11),
(281, 'Traiguén', 11),
(282, 'Victoria', 11),
(283, 'Corral', 12),
(284, 'Lanco', 12),
(285, 'Los Lagos', 12),
(286, 'Máfil', 12),
(287, 'Mariquina', 12),
(288, 'Paillaco', 12),
(289, 'Panguipulli', 12),
(290, 'Valdivia', 12),
(291, 'Futrono', 12),
(292, 'La Unión', 12),
(293, 'Lago Ranco', 12),
(294, 'Río Bueno', 12),
(295, 'Ancud', 13),
(296, 'Castro', 13),
(297, 'Chonchi', 13),
(298, 'Curaco de Vélez', 13),
(299, 'Dalcahue', 13),
(300, 'Puqueldón', 13),
(301, 'Queilén', 13),
(302, 'Quemchi', 13),
(303, 'Quellón', 13),
(304, 'Quinchao', 13),
(305, 'Calbuco', 13),
(306, 'Cochamó', 13),
(307, 'Fresia', 13),
(308, 'Frutillar', 13),
(309, 'Llanquihue', 13),
(310, 'Los Muermos', 13),
(311, 'Maullín', 13),
(312, 'Puerto Montt', 13),
(313, 'Puerto Varas', 13),
(314, 'Osorno', 13),
(315, 'Puero Octay', 13),
(316, 'Purranque', 13),
(317, 'Puyehue', 13),
(318, 'Río Negro', 13),
(319, 'San Juan de la Costa', 13),
(320, 'San Pablo', 13),
(321, 'Chaitén', 13),
(322, 'Futaleufú', 13),
(323, 'Hualaihué', 13),
(324, 'Palena', 13),
(325, 'Aisén', 14),
(326, 'Cisnes', 14),
(327, 'Guaitecas', 14),
(328, 'Cochrane', 14),
(329, 'O\'higgins', 14),
(330, 'Tortel', 14),
(331, 'Coihaique', 14),
(332, 'Lago Verde', 14),
(333, 'Chile Chico', 14),
(334, 'Río Ibáñez', 14),
(335, 'Antártica', 15),
(336, 'Cabo de Hornos', 15),
(337, 'Laguna Blanca', 15),
(338, 'Punta Arenas', 15),
(339, 'Río Verde', 15),
(340, 'San Gregorio', 15),
(341, 'Porvenir', 15),
(342, 'Primavera', 15),
(343, 'Timaukel', 15),
(344, 'Natales', 15),
(345, 'Torres del Paine', 15),
(346, 'Cabildo', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones`
--

CREATE TABLE `cotizaciones` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `id_unidad_negocio` int(11) NOT NULL,
  `id_bodega` int(11) NOT NULL,
  `id_medio_pago` int(11) NOT NULL,
  `id_plazo_pago` int(11) NOT NULL,
  `subtotal` varchar(255) NOT NULL,
  `descuento` varchar(255) NOT NULL DEFAULT '0',
  `total_neto` varchar(255) NOT NULL,
  `iva` varchar(255) NOT NULL,
  `total_final` varchar(255) NOT NULL,
  `observacion` varchar(255) NOT NULL DEFAULT 'Sin Observacion',
  `productos` varchar(1000) NOT NULL DEFAULT 'SIN PRODUCTOS',
  `tipo_dte` text NOT NULL DEFAULT 'Cotizacion Afecta',
  `estado` text NOT NULL DEFAULT 'Abierta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cotizaciones`
--

INSERT INTO `cotizaciones` (`id`, `codigo`, `id_cliente`, `fecha_emision`, `fecha_vencimiento`, `id_vendedor`, `id_unidad_negocio`, `id_bodega`, `id_medio_pago`, `id_plazo_pago`, `subtotal`, `descuento`, `total_neto`, `iva`, `total_final`, `observacion`, `productos`, `tipo_dte`, `estado`) VALUES
(2, 2, 3, '2021-11-19', '2021-11-26', 7, 2, 1, 2, 3, '1,330,512', '215,340', '1,115,172', '211,883', '1,327,055', '', '[{\"id\":\"6\",\"descripcion\":\"Reloj Comedor LAN\",\"cantidad\":\"1\",\"precio\":\"584493\",\"descuento\":\"0\",\"iva\":\"111054\",\"total\":\"695547\"},{\"id\":\"7\",\"descripcion\":\"Impresora Termica Fiscal\",\"cantidad\":\"1\",\"precio\":\"301475\",\"descuento\":\"0\",\"iva\":\"57280\",\"total\":\"358755\"},{\"id\":\"8\",\"descripcion\":\"Gabinete Reloj Casino\",\"cantidad\":\"1\",\"precio\":\"215340\",\"descuento\":\"215340\",\"iva\":\"0\",\"total\":\"0\"},{\"id\":\"9\",\"descripcion\":\"Gabinete Impresora\",\"cantidad\":\"1\",\"precio\":\"129204\",\"descuento\":\"0\",\"iva\":\"24549\",\"total\":\"153753\"},{\"id\":\"10\",\"descripcion\":\"Instalación y Configuración Equipo\",\"cantidad\":\"1\",\"precio\":\"100000\",\"descuento\":\"0\",\"iva\":\"19000\",\"total\":\"119000\"}]', 'Cotizacion Afecta', 'Abierta'),
(3, 3, 5, '2022-02-07', '2022-02-14', 7, 2, 1, 2, 1, '24,773', '0', '24,773', '4,707', '29,480', 'La facturación mensual la realiza Victoria SPA directamente con el cliente.', '[{\"id\":\"14\",\"descripcion\":\"Control Asistencia Geovictoria mensual\",\"cantidad\":\"7\",\"precio\":\"3539\",\"descuento\":\"0\",\"iva\":\"4707\",\"total\":\"29480\"}]', 'Cotizacion Afecta', 'Abierta'),
(6, 6, 5, '2022-02-07', '2022-02-14', 7, 2, 1, 2, 1, '180,000', '0', '180,000', '34,200', '214,200', '', '[{\"id\":\"13\",\"descripcion\":\"Huellero URU4500 + Configuración + Instalación\",\"cantidad\":\"1\",\"precio\":\"180000\",\"descuento\":\"0\",\"iva\":\"34200\",\"total\":\"214200\"}]', 'Cotizacion Afecta', 'Abierta'),
(10, 8, 1, '2022-04-06', '2022-04-15', 7, 2, 1, 2, 3, '363,044', '0', '363,044', '68,979', '432,023', '', '[{\"id\":\"15\",\"descripcion\":\"CÁMARA IP  WIFI + MICRO SD + 12V\",\"cantidad\":\"1\",\"precio\":\"62250\",\"descuento\":\"0\",\"iva\":\"11828\",\"total\":\"74078\"},{\"id\":\"16\",\"descripcion\":\"NVRC936_NVRC921 - Grabador de vídeo NVR H.265\",\"cantidad\":\"1\",\"precio\":\"98300\",\"descuento\":\"0\",\"iva\":\"18677\",\"total\":\"116977\"},{\"id\":\"17\",\"descripcion\":\"WD10PURZ - Disco Duro 1TB para Video\",\"cantidad\":\"1\",\"precio\":\"88644\",\"descuento\":\"0\",\"iva\":\"16842.36\",\"total\":\"105486.36\"},{\"id\":\"10\",\"descripcion\":\"Instalación y Configuración Equipo\",\"cantidad\":\"1\",\"precio\":\"80000\",\"descuento\":\"0\",\"iva\":\"15200\",\"total\":\"95200\"},{\"id\":\"18\",\"descripcion\":\"Tarjeta Memoria Micro SD\",\"cantidad\":\"1\",\"precio\":\"21850\",\"descuento\":\"0\",\"iva\":\"4151.5\",\"total\":\"26001.5\"},{\"id\":\"19\",\"descripcion\":\"Despacho\",\"cantidad\":\"1\",\"precio\":\"12000\",\"descuento\":\"0\",\"iva\":\"2280\",\"total\":\"14280\"}]', 'Cotizacion Afecta', 'Abierta'),
(11, 9, 1, '2022-04-06', '2022-04-15', 7, 2, 1, 2, 3, '162,100', '0', '162,100', '30,800', '192,900', '', '[{\"id\":\"15\",\"descripcion\":\"CÁMARA IP  WIFI + MICRO SD + 12V\",\"cantidad\":\"1\",\"precio\":\"62250\",\"descuento\":\"0\",\"iva\":\"11828\",\"total\":\"74078\"},{\"id\":\"10\",\"descripcion\":\"Instalación y Configuración Equipo\",\"cantidad\":\"1\",\"precio\":\"70000\",\"descuento\":\"0\",\"iva\":\"13300\",\"total\":\"83300\"},{\"id\":\"18\",\"descripcion\":\"Tarjeta Memoria Micro SD\",\"cantidad\":\"1\",\"precio\":\"21850\",\"descuento\":\"0\",\"iva\":\"4152\",\"total\":\"26002\"},{\"id\":\"19\",\"descripcion\":\"Despacho\",\"cantidad\":\"1\",\"precio\":\"8000\",\"descuento\":\"0\",\"iva\":\"1520\",\"total\":\"9520\"}]', 'Cotizacion Afecta', 'Abierta'),
(12, 10, 6, '2022-04-19', '2022-04-26', 7, 2, 1, 2, 1, '80,000', '0', '80,000', '15,200', '95,200', '', '[{\"id\":\"10\",\"descripcion\":\"Instalación y Configuración Equipo\",\"cantidad\":\"1\",\"precio\":\"80000\",\"descuento\":\"0\",\"iva\":\"15200\",\"total\":\"95200\"}]', 'Cotizacion Afecta', 'Abierta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones_exentas`
--

CREATE TABLE `cotizaciones_exentas` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `id_unidad_negocio` int(11) NOT NULL,
  `id_bodega` int(11) NOT NULL,
  `id_medio_pago` int(11) NOT NULL,
  `id_plazo_pago` int(11) NOT NULL,
  `subtotal` varchar(255) NOT NULL,
  `descuento` varchar(255) NOT NULL DEFAULT '0',
  `exento` varchar(255) NOT NULL,
  `iva` varchar(255) NOT NULL DEFAULT '0',
  `total_final` varchar(255) NOT NULL,
  `observacion` varchar(255) NOT NULL DEFAULT 'Sin Observacion',
  `productos` varchar(1000) NOT NULL DEFAULT 'SIN PRODUCTOS',
  `tipo_dte` text NOT NULL DEFAULT 'Cotizacion Exenta',
  `estado` text NOT NULL DEFAULT 'Abierta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cotizaciones_exentas`
--

INSERT INTO `cotizaciones_exentas` (`id`, `codigo`, `id_cliente`, `fecha_emision`, `fecha_vencimiento`, `id_vendedor`, `id_unidad_negocio`, `id_bodega`, `id_medio_pago`, `id_plazo_pago`, `subtotal`, `descuento`, `exento`, `iva`, `total_final`, `observacion`, `productos`, `tipo_dte`, `estado`) VALUES
(1, 1, 1, '2021-10-06', '2021-10-31', 7, 2, 1, 3, 10, '2,927,890', '0', '2,927,890', '0', '2,927,890', 'CONDICION DE PAGO 6 CUOTAS', '[{\"id\":\"1\",\"descripcion\":\"Desarrollo Software Vive Cermaq\",\"cantidad\":\"1\",\"precio\":\"2927890\",\"descuento\":\"0\",\"iva\":\"0\",\"total\":\"2927890\"}]', 'Cotizacion Exenta', 'Abierta'),
(2, 2, 1, '2021-10-06', '2021-10-29', 7, 2, 1, 2, 10, '2,927,880', '0', '2,927,880', '0', '2,927,880', '', '[{\"id\":\"1\",\"descripcion\":\"Desarrollo Software Vive Cermaq\",\"cantidad\":\"1\",\"precio\":\"2927880\",\"descuento\":\"0\",\"iva\":\"0\",\"total\":\"2927880\"}]', 'Cotizacion Exenta', 'Abierta'),
(3, 3, 1, '2021-10-14', '2021-10-21', 7, 2, 1, 2, 1, '487,980', '0', '487,980', '0', '487,980', '', '[{\"id\":\"1\",\"descripcion\":\"Desarrollo Software Vive Cermaq cuota 1 de 6\",\"cantidad\":\"1\",\"precio\":\"487980\",\"descuento\":\"0\",\"iva\":\"0\",\"total\":\"487980\"}]', 'Cotizacion Exenta', 'Abierta'),
(4, 4, 1, '2021-10-14', '2021-10-21', 7, 2, 1, 2, 1, '487,980', '0', '487,980', '0', '487,980', '', '[{\"id\":\"1\",\"descripcion\":\"Desarrollo Software Vive Cermaq cuota 1\",\"cantidad\":\"1\",\"precio\":\"487980\",\"descuento\":\"0\",\"iva\":\"0\",\"total\":\"487980\"}]', 'Cotizacion Exenta', 'Abierta'),
(5, 5, 1, '2021-10-15', '2021-10-22', 7, 2, 1, 2, 1, '1,900,000', '0', '1,900,000', '0', '1,900,000', 'Contra Orden de Compra', '[{\"id\":\"3\",\"descripcion\":\"Asesoría Obtención Patente Cafetería Cermaq PMC\",\"cantidad\":\"1\",\"precio\":\"1900000\",\"descuento\":\"0\",\"iva\":\"0\",\"total\":\"1900000\"}]', 'Cotizacion Exenta', 'Abierta'),
(6, 6, 1, '2021-10-18', '2021-10-22', 7, 2, 1, 2, 1, '1,900,000', '190,000', '1,710,000', '0', '1,710,000', '', '[{\"id\":\"3\",\"descripcion\":\"Asesoría Obtención Patente Cafetería Cermaq PMC\",\"cantidad\":\"1\",\"precio\":\"1900000\",\"descuento\":\"190000\",\"iva\":\"0\",\"total\":\"1710000\"}]', 'Cotizacion Exenta', 'Abierta'),
(7, 7, 1, '2021-11-09', '2021-11-16', 7, 2, 1, 2, 1, '487,980', '0', '487,980', '0', '487,980', '', '[{\"id\":\"1\",\"descripcion\":\"Desarrollo Software Vive Cermaq cuota 2\",\"cantidad\":\"1\",\"precio\":\"487980\",\"descuento\":\"0\",\"iva\":\"0\",\"total\":\"487980\"}]', 'Cotizacion Exenta', 'Abierta'),
(8, 8, 1, '2021-12-01', '2021-12-06', 7, 2, 1, 2, 1, '487,980', '0', '487,980', '0', '487,980', '', '[{\"id\":\"1\",\"descripcion\":\"Desarrollo Software Vive Cermaq cuota 3\",\"cantidad\":\"1\",\"precio\":\"487980\",\"descuento\":\"0\",\"iva\":\"0\",\"total\":\"487980\"}]', 'Cotizacion Exenta', 'Abierta'),
(9, 9, 4, '2021-12-09', '2021-12-17', 7, 2, 1, 2, 1, '7,500,000', '500,000', '7,000,000', '0', '7,000,000', '', '[{\"id\":\"11\",\"descripcion\":\"Software Gestion Segproject\",\"cantidad\":\"1\",\"precio\":\"7500000\",\"descuento\":\"500000\",\"iva\":\"0\",\"total\":\"7000000\"}]', 'Cotizacion Exenta', 'Abierta'),
(10, 10, 1, '2021-12-20', '2021-12-23', 7, 2, 1, 2, 1, '800,000', '0', '800,000', '0', '800,000', '', '[{\"id\":\"12\",\"descripcion\":\"Mejoras Software Viveres\",\"cantidad\":\"1\",\"precio\":\"800000\",\"descuento\":\"0\",\"iva\":\"0\",\"total\":\"800000\"}]', 'Cotizacion Exenta', 'Abierta'),
(11, 11, 1, '2022-01-04', '2022-01-05', 7, 2, 1, 2, 1, '487,980', '0', '487,980', '0', '487,980', '', '[{\"id\":\"1\",\"descripcion\":\"Desarrollo Software Vive Cermaq cuota 4\",\"cantidad\":\"1\",\"precio\":\"487980\",\"descuento\":\"0\",\"iva\":\"0\",\"total\":\"487980\"}]', 'Cotizacion Exenta', 'Abierta'),
(12, 12, 1, '2022-02-02', '2022-02-10', 7, 2, 1, 2, 1, '487,980', '0', '487,980', '0', '487,980', '', '[{\"id\":\"1\",\"descripcion\":\"Desarrollo Software Vive Cermaq cuota 5\",\"cantidad\":\"1\",\"precio\":\"487980\",\"descuento\":\"0\",\"iva\":\"0\",\"total\":\"487980\"}]', 'Cotizacion Exenta', 'Abierta'),
(13, 13, 1, '2022-03-07', '2022-03-11', 7, 2, 1, 2, 1, '487,980', '0', '487,980', '0', '487,980', '', '[{\"id\":\"1\",\"descripcion\":\"Desarrollo Software Vive Cermaq cuota 6\",\"cantidad\":\"1\",\"precio\":\"487980\",\"descuento\":\"0\",\"iva\":\"0\",\"total\":\"487980\"}]', 'Cotizacion Exenta', 'Abierta'),
(14, 14, 2, '2024-09-10', '2024-09-21', 7, 4, 1, 1, 1, '23,287,980,000', '0', '23,287,980,000', '0', '23,287,980,000', 'aaaaaaaa', '[{\"id\":\"1\",\"descripcion\":\"Desarrollo Software Vive Cermaq cuota 6\",\"cantidad\":\"1000\",\"precio\":\"487980\",\"descuento\":\"0\",\"iva\":\"0\",\"total\":\"487980000\"},{\"id\":\"3\",\"descripcion\":\"Asesoría Obtención Patente Cafetería Cermaq PMC\",\"cantidad\":\"12000\",\"precio\":\"1900000\",\"descuento\":\"0\",\"iva\":\"0\",\"total\":\"22800000000\"}]', 'Cotizacion Exenta', 'Abierta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id`, `nombre`) VALUES
(1, 'Nota de Venta'),
(2, 'Cotización'),
(3, 'Orden de Compra'),
(4, 'Boleta'),
(5, 'Factura Afecta'),
(6, 'Factura Exenta'),
(7, 'Nota de Credito'),
(8, 'Nota de Debito'),
(9, 'Guia de Despacho'),
(10, 'Vale Venta'),
(11, 'Entrada Inventario'),
(12, 'Salida Inventario'),
(13, 'Ajustes Inventario'),
(14, 'Recibo Cobro'),
(15, 'Recibo Pago'),
(16, 'Orden de Trabajo'),
(17, 'Orden de Produccion'),
(20, 'Orden de Vestuario'),
(21, 'Orden de Trabajo Taller');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `tipo_entrada` varchar(255) NOT NULL,
  `fecha_emision` date NOT NULL,
  `observaciones` varchar(255) NOT NULL DEFAULT 'SIN OBSERVACION',
  `id_bodega_destino` int(11) NOT NULL,
  `valor_tipo_entrada` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id`, `codigo`, `tipo_entrada`, `fecha_emision`, `observaciones`, `id_bodega_destino`, `valor_tipo_entrada`) VALUES
(1, 1, 'Bodega a Bodega', '2024-09-10', '', 1, '1'),
(2, 2, 'Ingreso Manual a Bodega', '2024-09-11', '', 1, '7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_producto`
--

CREATE TABLE `entrada_producto` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_entrada` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `id_bodega` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entrada_producto`
--

INSERT INTO `entrada_producto` (`id`, `id_producto`, `id_entrada`, `cantidad`, `descripcion`, `id_bodega`) VALUES
(1, 20, NULL, 1, 'SUPER CAJA', 2),
(2, 20, NULL, 1, 'SUPER CAJA', 2),
(3, 20, NULL, 1, 'SUPER CAJA', 2),
(4, 1, NULL, 3, 'Desarrollo Software Vive Cermaq cuota 6', 2),
(5, 4, NULL, 2, 'Soporte Informático', 2),
(6, 7, NULL, 1, 'Impresora Termica Fiscal', 2),
(7, 1, NULL, 10, 'Desarrollo Software Vive Cermaq cuota 6', 2),
(8, 2, NULL, 2, 'Soporte mensual Vive Cermaq', 2),
(9, 2, NULL, 5, 'Soporte mensual Vive Cermaq', 2),
(10, 3, NULL, 15, 'Asesoría Obtención Patente Cafetería Cermaq PMC', 2),
(11, 1, NULL, 1, 'Desarrollo Software Vive Cermaq cuota 6', 2),
(12, 2, NULL, 1, 'Soporte mensual Vive Cermaq', 2),
(13, 7, NULL, 1, 'Impresora Termica Fiscal', 1),
(14, 9, NULL, 1, 'Gabinete Impresora', 1),
(15, 1, 1, 1, 'Desarrollo Software Vive Cermaq cuota 6', 1),
(16, 2, 1, 1, 'Soporte mensual Vive Cermaq', 1),
(17, 3, 1, 1, 'Asesoría Obtención Patente Cafetería Cermaq PMC', 1),
(18, 4, 1, 1, 'Soporte Informático', 1),
(19, 5, 1, 1, 'Licencia Aptusoft', 1),
(20, 6, 1, 1, 'Reloj Comedor LAN', 1),
(21, 7, 1, 1, 'Impresora Termica Fiscal', 1),
(22, 5, 2, 1, 'Licencia Aptusoft', 1),
(23, 4, 2, 1, 'Soporte Informático', 1),
(24, 3, 2, 1, 'Asesoría Obtención Patente Cafetería Cermaq PMC', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_ventas`
--

CREATE TABLE `historial_ventas` (
  `id_historial` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `productos` text NOT NULL,
  `impuesto` float NOT NULL,
  `neto` float NOT NULL,
  `total` float NOT NULL,
  `metodo_pago` text NOT NULL,
  `total_pagado` float NOT NULL,
  `total_pendiente_pago` float NOT NULL,
  `descuento` float NOT NULL,
  `observacion` varchar(100) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuestos`
--

CREATE TABLE `impuestos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `factor` int(10) NOT NULL,
  `codigo` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `impuestos`
--

INSERT INTO `impuestos` (`id`, `nombre`, `factor`, `codigo`, `descripcion`) VALUES
(6, 'IVA ANTICIPADO FAENAMIENTO CARNE', 555, 17, 'Tasa  de  5%  sobre  Monto base faenamiento. Se registra el monto de IVA anticipado cobrado al cliente.'),
(7, 'IVA ANTICIPADO CARNE\r\n', 5, 18, 'Tasa de 5%. Se registra  el monto de IVA anticipado cobrado al cliente.'),
(9, 'IVA ANTICIPADO HARINA', 12, 19, 'Tasa de 12%. Se registra el monto de IVA anticipado cobrado al cliente.'),
(10, 'IMPUESTO ADICIONAL\r\nArt 37 Letras a, b, c', 15, 23, 'Tasa del 15%\r\na)artículos    oro,    platino, marfil\r\nb)Joyas, piedras preciosas\r\nc)Pieles finas'),
(11, 'IMPUESTO ADICIONAL\r\nArt 37 Letras e, h, i, l', 15, 44, 'Tasa   del   15%   en   1era. venta\r\ne) Alfombras, tapices\r\nh) Casa rodantes\r\ni) Caviar\r\nl) Armas de aire o gas'),
(12, 'IMPUESTO ADICIONAL\r\nArt 37 Letras j', 50, 45, 'Tasa del 50% en 1era venta Pirotecnia'),
(13, 'IMPUESTO ART. 42,\r\nLey 825/74 letra a', 27, 24, 'Tasa del 27%\r\nLicores, Piscos, destilados, etc.'),
(14, 'IMPUESTO ART. 42,\r\nletra c', 15, 25, 'Tasa del 15% Vinos.'),
(15, 'IMPUESTO ART.42, letra c', 15, 26, 'Tasa del 15% Cervezas y bebidas alcohólicas.'),
(17, 'IVA RETENIDO CARTONES', 19, 47, 'Retención Total.'),
(18, 'IVA RETENIDO FRAMBUESAS Y PASAS', 14, 48, 'Retención del 14%');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_precios`
--

CREATE TABLE `lista_precios` (
  `id` int(11) NOT NULL,
  `nombre_lista` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `factor` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lista_precios`
--

INSERT INTO `lista_precios` (`id`, `nombre_lista`, `factor`) VALUES
(1, 'LISTA DE PRECIOS OFICIALLLLL', 200),
(2, 'EDITAR LISTA PRECIOS 2', 0),
(3, 'EDITAR LISTA PRECIOS 3', 13),
(4, 'EDITAR LISTA PRECIOS 4', 0),
(5, 'EDITAR LISTA PRECIOS 5', 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matrices`
--

CREATE TABLE `matrices` (
  `id` int(11) NOT NULL,
  `razon_social` varchar(255) NOT NULL,
  `actividad` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `ejecutivo` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `tipo_cliente` varchar(255) NOT NULL,
  `tipo_producto` varchar(255) NOT NULL,
  `rut` varchar(13) NOT NULL,
  `comuna` varchar(255) NOT NULL,
  `pais` varchar(255) NOT NULL DEFAULT 'Chile',
  `condicion_venta` varchar(10000) NOT NULL DEFAULT 'Sin Especificar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `matrices`
--

INSERT INTO `matrices` (`id`, `razon_social`, `actividad`, `region`, `direccion`, `ejecutivo`, `telefono`, `email`, `fecha_inicio`, `fecha_vencimiento`, `tipo_cliente`, `tipo_producto`, `rut`, `comuna`, `pais`, `condicion_venta`) VALUES
(4, 'MLINE SPA', 'COMERCIALIZACION Y DISTRIBUCION DE SOFTWARE HARDWARE Y ASESORIAS', 'Los Lagos', 'A Varas 963, Oficina 5, Puerto Montt', 'Fernando Torres Flores', '974062227', 'ftorres@mline.cl', '2020-12-21', '2021-12-21', 'SERCOTEC 2020', 'POS PyMe', '76.605.374-2', 'Puerto Montt', 'Chile', '    AGUAS PROFUNDAS SPA\r\nRUT;77.859.375-0\r\nCUENTA CORRIENTE\r\nBANCO SANTANDER\r\n93397789\r\nalejandromansillavera@gmail.com                                                                                                                                                                                                                                            \r\n\r\n\r\n                                             Sin Especificar                                               Sin Especificar                                             '),
(8, 'SUPER MATRIZ', 'SUPER JERENTE', 'Magallanes y de la Antártica Chilena', 'DIRECCION #5896', 'pedrito el chikitin', 'este es el numero', 'hola como estas? correo', '2024-09-09', '2024-09-30', 'SERCOTEC 2020', 'POS PyMe', 'el rut de la ', 'Isla de Pascua', 'EL MUNDO', 'Sin Especificar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medios_pago`
--

CREATE TABLE `medios_pago` (
  `id` int(11) NOT NULL,
  `medio_pago` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medios_pago`
--

INSERT INTO `medios_pago` (`id`, `medio_pago`) VALUES
(1, 'EFECTIVO'),
(2, 'TRANSFERENCIA'),
(3, 'CREDITO'),
(4, 'VALE VISTA'),
(5, 'CHEQUE'),
(6, 'DEBITO'),
(7, 'TARJETA DE CREDITO'),
(8, 'PAGARE (LO JUROOO)'),
(9, 'AAAA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_credito`
--

CREATE TABLE `nota_credito` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_unidad_negocio` int(11) NOT NULL,
  `id_bodega` int(11) NOT NULL,
  `productos` varchar(1000) NOT NULL,
  `id_plazo_pago` int(11) NOT NULL,
  `id_medio_pago` int(11) NOT NULL,
  `subtotal` varchar(255) NOT NULL,
  `descuento` varchar(255) NOT NULL DEFAULT '0',
  `total_neto` varchar(255) NOT NULL,
  `iva` varchar(255) NOT NULL,
  `total_final` varchar(255) NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `tipo_dte` text NOT NULL DEFAULT 'Nota de Credito Afecta',
  `folio_documento` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_credito_boleta`
--

CREATE TABLE `nota_credito_boleta` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_unidad_negocio` int(11) NOT NULL,
  `id_bodega` int(11) NOT NULL,
  `productos` varchar(1000) NOT NULL,
  `id_plazo_pago` int(11) NOT NULL,
  `id_medio_pago` int(11) NOT NULL,
  `subtotal` varchar(255) NOT NULL,
  `descuento` varchar(255) NOT NULL DEFAULT '0',
  `total_neto` varchar(255) NOT NULL,
  `iva` varchar(255) NOT NULL,
  `total_final` varchar(255) NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `tipo_dte` text NOT NULL DEFAULT 'Nota de Credito Boleta',
  `folio_documento` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nota_credito_boleta`
--

INSERT INTO `nota_credito_boleta` (`id`, `codigo`, `id_cliente`, `id_unidad_negocio`, `id_bodega`, `productos`, `id_plazo_pago`, `id_medio_pago`, `subtotal`, `descuento`, `total_neto`, `iva`, `total_final`, `observacion`, `fecha_emision`, `fecha_vencimiento`, `tipo_dte`, `folio_documento`) VALUES
(1, 1, 1, 2, 1, '', 3, 1, '', '', '', '', '', 'la condición del pago a sido efectiva', '2024-09-09', '2024-09-20', 'Nota de Credito Boleta', 1),
(2, 1, 7, 2, 2, '[{\"id\":\"20\",\"descripcion\":\"SUPER CAJA\",\"cantidad\":\"1\",\"precio\":\"20000\",\"descuento\":\"0\",\"iva\":\"3800\",\"total\":\"23800\"}]', 1, 1, '20,000', '0', '20,000', '3,800', '23800', 'muy buenas observaciones A++', '2024-09-09', '2024-09-10', 'Nota de Credito Boleta', 3),
(3, 1, 7, 2, 2, '[{\"id\":\"20\",\"descripcion\":\"SUPER CAJA\",\"cantidad\":\"1\",\"precio\":\"20000\",\"descuento\":\"0\",\"iva\":\"3800\",\"total\":\"23800\"}]', 10, 1, '20,000', '0', '20,000', '3,800', '23800', 'PAGADO', '2024-09-09', '2024-09-11', 'Nota de Credito Boleta', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_credito_boleta_exenta`
--

CREATE TABLE `nota_credito_boleta_exenta` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_unidad_negocio` int(11) NOT NULL,
  `id_bodega` int(11) NOT NULL,
  `productos` varchar(1000) NOT NULL,
  `id_plazo_pago` int(11) NOT NULL,
  `id_medio_pago` int(11) NOT NULL,
  `subtotal` varchar(255) NOT NULL,
  `descuento` varchar(255) NOT NULL DEFAULT '0',
  `total_final` varchar(255) NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `tipo_dte` text NOT NULL DEFAULT 'Nota de Credito Boleta Exenta',
  `folio_documento` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_credito_exenta`
--

CREATE TABLE `nota_credito_exenta` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_unidad_negocio` int(11) NOT NULL,
  `id_bodega` int(11) NOT NULL,
  `productos` varchar(1000) NOT NULL,
  `id_plazo_pago` int(11) NOT NULL,
  `id_medio_pago` int(11) NOT NULL,
  `subtotal` varchar(255) NOT NULL,
  `descuento` varchar(255) NOT NULL DEFAULT '0',
  `exento` varchar(255) NOT NULL,
  `iva` varchar(255) NOT NULL,
  `total_final` varchar(255) NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `tipo_dte` text NOT NULL DEFAULT 'Nota de Credito Exenta',
  `folio_documento` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

CREATE TABLE `orden_compra` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `id_centro` int(11) NOT NULL,
  `id_bodega` int(11) NOT NULL,
  `id_medio_pago` int(11) NOT NULL,
  `id_plazo_pago` int(11) NOT NULL,
  `estado` varchar(255) NOT NULL DEFAULT 'Abierta',
  `subtotal` varchar(255) NOT NULL,
  `total_neto` varchar(255) NOT NULL,
  `descuento` varchar(255) NOT NULL,
  `iva` varchar(255) NOT NULL,
  `total_final` varchar(255) NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `productos` varchar(8000) NOT NULL,
  `folio_ot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orden_compra`
--

INSERT INTO `orden_compra` (`id`, `codigo`, `id_proveedor`, `fecha_emision`, `fecha_vencimiento`, `id_centro`, `id_bodega`, `id_medio_pago`, `id_plazo_pago`, `estado`, `subtotal`, `total_neto`, `descuento`, `iva`, `total_final`, `observacion`, `productos`, `folio_ot`) VALUES
(1, 49, 1, '2021-11-22', '2021-11-30', 1, 1, 2, 1, 'Cerrada', '305,910', '305,910', '0', '58,123', '364033', '', '[{\"id\":\"7\",\"descripcion\":\"Impresora Termica Fiscal\",\"cantidad\":\"1\",\"precio\":\"214137\",\"descuento\":\"0\",\"iva\":\"40686\",\"total\":\"254823\"},{\"id\":\"9\",\"descripcion\":\"Gabinete Impresora\",\"cantidad\":\"1\",\"precio\":\"91773\",\"descuento\":\"0\",\"iva\":\"17437\",\"total\":\"109210\"}]', 0),
(3, 51, 1, '2024-09-10', '2024-09-21', 3, 2, 1, 4, 'Abierta', '400,000', '391,000', '9,000', '74,290', '465290', 'AAAAAAAAAA', '[{\"id\":\"1\",\"descripcion\":\"Desarrollo Software Vive Cermaq cuota 6\",\"cantidad\":\"10\",\"precio\":\"10000\",\"descuento\":\"5000\",\"iva\":\"18050\",\"total\":\"113050\"},{\"id\":\"2\",\"descripcion\":\"Soporte mensual Vive Cermaq\",\"cantidad\":\"15\",\"precio\":\"20000\",\"descuento\":\"4000\",\"iva\":\"56240\",\"total\":\"352240\"}]', 1),
(4, 52, 1, '2024-09-10', '2024-09-21', 3, 2, 1, 4, 'Abierta', '193,329', '189,996', '3,333', '36,099', '226095', 'AAAAAAAAAAAA', '[{\"id\":\"4\",\"descripcion\":\"Soporte Informático\",\"cantidad\":\"15\",\"precio\":\"11111\",\"descuento\":\"1111\",\"iva\":\"31455\",\"total\":\"197009\"},{\"id\":\"5\",\"descripcion\":\"Licencia Aptusoft\",\"cantidad\":\"12\",\"precio\":\"2222\",\"descuento\":\"2222\",\"iva\":\"4644\",\"total\":\"29086\"}]', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_vestuario`
--

CREATE TABLE `orden_vestuario` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `id_centro` int(11) NOT NULL,
  `id_bodega` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `nombre_orden` varchar(255) NOT NULL,
  `observacion` varchar(255) NOT NULL DEFAULT 'SIN OBSERVACIONES',
  `personal` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orden_vestuario`
--

INSERT INTO `orden_vestuario` (`id`, `codigo`, `fecha_emision`, `fecha_vencimiento`, `id_centro`, `id_bodega`, `id_cliente`, `nombre_orden`, `observacion`, `personal`) VALUES
(1, 1, '2024-09-09', '2024-09-11', 3, 2, 7, '01', 'todo bien ;)', '[{\"id\":\"18\",\"nombre\":\"SASCUASH\",\"rut\":\"elRutNoEsNesesario\",\"empresa\":\"PEPE\",\"medidas\":[{\"busto\":\"120\",\"cintura\":\"120\",\"cadera\":\"120\",\"ancho_espalda\":\"120\",\"talle_delantero\":\"120\",\"talle_espalda\":\"120\",\"largo_manga\":\"120\",\"largo_blusa\":\"120\",\"largo_guillete\":\"120\",\"largo_chaqueta\":\"120\",\"largo_polera\":\"120\",\"largo_parka\":\"120\",\"largo_polar\":\"120\",\"largo_vestido\":\"120\",\"pantalon_cintura\":\"120\",\"pantalon_cadera\":\"120\",\"pantalon_tiro\":\"120\",\"pantalon_enterpierna\":\"120\",\"largo_pantalon\":\"120\",\"falda_cintura\":\"120\",\"falda_cadera\":\"120\",\"largo_falda\":\"120\"}]}]'),
(2, 2, '2024-09-10', '2024-09-10', 3, 2, 7, '01', 'observaciones A++', '[{\"id\":\"19\",\"nombre\":\"Prueba01\",\"rut\":\"elrutcambio\",\"empresa\":\"PEPE\",\"medidas\":[{\"busto\":\"120\",\"cintura\":\"120\",\"cadera\":\"120\",\"ancho_espalda\":\"120\",\"talle_delantero\":\"120\",\"talle_espalda\":\"120\",\"largo_manga\":\"120\",\"largo_blusa\":\"120\",\"largo_guillete\":\"120\",\"largo_chaqueta\":\"120\",\"largo_polera\":\"120\",\"largo_parka\":\"120\",\"largo_polar\":\"120\",\"largo_vestido\":\"120\",\"pantalon_cintura\":\"120\",\"pantalon_cadera\":\"120\",\"pantalon_tiro\":\"120\",\"pantalon_enterpierna\":\"120\",\"largo_pantalon\":\"120\",\"falda_cintura\":\"120\",\"falda_cadera\":\"120\",\"largo_falda\":\"120\"}]}]'),
(3, 3, '2024-09-10', '2024-09-11', 3, 2, 7, '02', 'observacion de vestuario', '[{\"id\":\"19\",\"nombre\":\"Prueba01\",\"rut\":\"elrutcambio\",\"empresa\":\"PEPE\",\"medidas\":[{\"busto\":\"120\",\"cintura\":\"120\",\"cadera\":\"120\",\"ancho_espalda\":\"120\",\"talle_delantero\":\"120\",\"talle_espalda\":\"120\",\"largo_manga\":\"120\",\"largo_blusa\":\"120\",\"largo_guillete\":\"120\",\"largo_chaqueta\":\"120\",\"largo_polera\":\"120\",\"largo_parka\":\"120\",\"largo_polar\":\"120\",\"largo_vestido\":\"120\",\"pantalon_cintura\":\"120\",\"pantalon_cadera\":\"120\",\"pantalon_tiro\":\"120\",\"pantalon_enterpierna\":\"120\",\"largo_pantalon\":\"120\",\"falda_cintura\":\"120\",\"falda_cadera\":\"120\",\"largo_falda\":\"120\"}]}]'),
(4, 4, '2024-09-10', '2024-09-12', 3, 2, 7, 'hola ordden', 'orden de vestuario', '[{\"id\":\"19\",\"nombre\":\"Prueba01\",\"rut\":\"elrutcambio\",\"empresa\":\"PEPE\",\"medidas\":[{\"busto\":\"120\",\"cintura\":\"120\",\"cadera\":\"120\",\"ancho_espalda\":\"120\",\"talle_delantero\":\"120\",\"talle_espalda\":\"120\",\"largo_manga\":\"120\",\"largo_blusa\":\"120\",\"largo_guillete\":\"120\",\"largo_chaqueta\":\"120\",\"largo_polera\":\"120\",\"largo_parka\":\"120\",\"largo_polar\":\"120\",\"largo_vestido\":\"120\",\"pantalon_cintura\":\"120\",\"pantalon_cadera\":\"120\",\"pantalon_tiro\":\"120\",\"pantalon_enterpierna\":\"120\",\"largo_pantalon\":\"120\",\"falda_cintura\":\"120\",\"falda_cadera\":\"120\",\"largo_falda\":\"120\"}]}]'),
(5, 5, '2024-09-10', '2024-09-11', 1, 1, 7, 'nueva orden', 'cambios asignados', '[{\"id\":\"19\",\"nombre\":\"Prueba01\",\"rut\":\"elrutcambio\",\"empresa\":\"PEPE\",\"medidas\":[{\"busto\":\"120\",\"cintura\":\"120\",\"cadera\":\"120\",\"ancho_espalda\":\"120\",\"talle_delantero\":\"120\",\"talle_espalda\":\"120\",\"largo_manga\":\"120\",\"largo_blusa\":\"120\",\"largo_guillete\":\"120\",\"largo_chaqueta\":\"120\",\"largo_polera\":\"120\",\"largo_parka\":\"120\",\"largo_polar\":\"120\",\"largo_vestido\":\"120\",\"pantalon_cintura\":\"120\",\"pantalon_cadera\":\"120\",\"pantalon_tiro\":\"120\",\"pantalon_enterpierna\":\"120\",\"largo_pantalon\":\"120\",\"falda_cintura\":\"120\",\"falda_cadera\":\"120\",\"largo_falda\":\"120\"}]}]'),
(6, 6, '2024-09-10', '2024-09-10', 3, 2, 7, 'cambio 18:23', 'cambio asignado 18:23', '[{\"id\":\"19\",\"nombre\":\"Prueba01\",\"rut\":\"elrutcambio\",\"empresa\":\"PEPE\",\"medidas\":[{\"busto\":\"120\",\"cintura\":\"120\",\"cadera\":\"120\",\"ancho_espalda\":\"120\",\"talle_delantero\":\"120\",\"talle_espalda\":\"120\",\"largo_manga\":\"120\",\"largo_blusa\":\"120\",\"largo_guillete\":\"120\",\"largo_chaqueta\":\"120\",\"largo_polera\":\"120\",\"largo_parka\":\"120\",\"largo_polar\":\"120\",\"largo_vestido\":\"120\",\"pantalon_cintura\":\"120\",\"pantalon_cadera\":\"120\",\"pantalon_tiro\":\"120\",\"pantalon_enterpierna\":\"120\",\"largo_pantalon\":\"120\",\"falda_cintura\":\"120\",\"falda_cadera\":\"120\",\"largo_falda\":\"120\"}]}]'),
(7, 7, '2024-09-10', '2024-09-10', 3, 1, 7, 'orden de cambio', 'cambio 23', '[{\"id\":\"19\",\"nombre\":\"Prueba01\",\"rut\":\"elrutcambio\",\"empresa\":\"PEPE\",\"medidas\":[{\"busto\":\"120\",\"cintura\":\"120\",\"cadera\":\"120\",\"ancho_espalda\":\"120\",\"talle_delantero\":\"120\",\"talle_espalda\":\"120\",\"largo_manga\":\"120\",\"largo_blusa\":\"120\",\"largo_guillete\":\"120\",\"largo_chaqueta\":\"120\",\"largo_polera\":\"120\",\"largo_parka\":\"120\",\"largo_polar\":\"120\",\"largo_vestido\":\"120\",\"pantalon_cintura\":\"120\",\"pantalon_cadera\":\"120\",\"pantalon_tiro\":\"120\",\"pantalon_enterpierna\":\"120\",\"largo_pantalon\":\"120\",\"falda_cintura\":\"120\",\"falda_cadera\":\"120\",\"largo_falda\":\"120\"}]},{\"id\":\"20\",\"nombre\":\"PRUEBA02\",\"rut\":\"hola RUT\",\"empresa\":\"Servicios Gastronómicos Austral SPA\",\"medidas\":[{\"busto\":\"120\",\"cintura\":\"120\",\"cadera\":\"120\",\"ancho_espalda\":\"120\",\"talle_delantero\":\"120\",\"talle_espalda\":\"120\",\"largo_manga\":\"120\",\"largo_blusa\":\"120\",\"largo_guillete\":\"120\",\"largo_chaqueta\":\"120\",\"largo_polera\":\"120\",\"largo_parka\":\"120\",\"largo_polar\":\"120\",\"largo_vestido\":\"120\",\"pantalon_cintura\":\"120\",\"pantalon_cadera\":\"120\",\"pantalon_tiro\":\"120\",\"pantalon_enterpierna\":\"120\",\"largo_pantalon\":\"120\",\"falda_cintura\":\"120\",\"falda_cadera\":\"120\",\"largo_falda\":\"120\"}]}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros_documentos`
--

CREATE TABLE `parametros_documentos` (
  `id` bigint(20) NOT NULL,
  `cotizacion` int(10) UNSIGNED DEFAULT NULL,
  `boleta` int(10) UNSIGNED DEFAULT NULL,
  `orden_compra` int(10) UNSIGNED DEFAULT NULL,
  `factura_exenta` int(10) UNSIGNED DEFAULT NULL,
  `factura_afecta` int(10) UNSIGNED DEFAULT NULL,
  `orden_vestuario` int(10) UNSIGNED DEFAULT NULL,
  `entrada_inventario` int(10) UNSIGNED DEFAULT NULL,
  `salida_inventario` int(10) UNSIGNED DEFAULT NULL,
  `ajuste_inventario` int(10) UNSIGNED DEFAULT NULL,
  `cotizacion_exenta` int(10) NOT NULL DEFAULT 0,
  `compra` int(10) UNSIGNED DEFAULT NULL,
  `nota_credito` int(10) DEFAULT NULL,
  `nota_debito` int(10) DEFAULT NULL,
  `boleta_exenta` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `parametros_documentos`
--

INSERT INTO `parametros_documentos` (`id`, `cotizacion`, `boleta`, `orden_compra`, `factura_exenta`, `factura_afecta`, `orden_vestuario`, `entrada_inventario`, `salida_inventario`, `ajuste_inventario`, `cotizacion_exenta`, `compra`, `nota_credito`, `nota_debito`, `boleta_exenta`) VALUES
(1, 8, 8, 8, 8, 8, 8, 8, 8, 8, 0, 8, NULL, NULL, NULL),
(2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL),
(7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(9, 2, 0, 48, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(10, 10, 3, 0, 0, 1, 1, 0, 0, 1, 0, NULL, NULL, NULL, NULL),
(11, 10, 3, 11, 0, 1, 1, 0, 0, 1, 0, NULL, NULL, NULL, NULL),
(12, 10, 3, 49, 0, 1, 1, 0, 0, 1, 0, NULL, NULL, NULL, NULL),
(13, 10, 3, 49, 11, 1, 1, 0, 0, 1, 0, NULL, NULL, NULL, NULL),
(14, 10, 3, 190, 13, 2, 7, 2, 2, 3, 0, NULL, NULL, NULL, NULL),
(15, 10, 3, 53, 13, 2, 7, 2, 2, 3, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `rut` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_cliente` int(255) NOT NULL,
  `busto` varchar(255) NOT NULL DEFAULT '0',
  `cintura` varchar(255) NOT NULL DEFAULT '0',
  `cadera` varchar(255) NOT NULL DEFAULT '0',
  `ancho_espalda` varchar(255) NOT NULL DEFAULT '0',
  `talle_delantero` varchar(255) NOT NULL DEFAULT '0',
  `talle_espalda` varchar(255) NOT NULL DEFAULT '0',
  `largo_manga` varchar(255) NOT NULL DEFAULT '0',
  `largo_blusa` varchar(255) NOT NULL DEFAULT '0',
  `largo_guillete` varchar(255) NOT NULL DEFAULT '0',
  `largo_chaqueta` varchar(255) NOT NULL DEFAULT '0',
  `largo_polera` varchar(255) NOT NULL DEFAULT '0',
  `largo_parka` varchar(255) NOT NULL DEFAULT '0',
  `largo_polar` varchar(255) NOT NULL DEFAULT '0',
  `largo_vestido` varchar(255) NOT NULL DEFAULT '0',
  `pantalon_cintura` varchar(255) NOT NULL DEFAULT '0',
  `pantalon_cadera` varchar(255) NOT NULL DEFAULT '0',
  `pantalon_tiro` varchar(255) NOT NULL DEFAULT '0',
  `pantalon_entrepierna` varchar(255) NOT NULL DEFAULT '0',
  `largo_pantalon` varchar(255) NOT NULL DEFAULT '0',
  `falda_cintura` varchar(255) NOT NULL DEFAULT '0',
  `falda_cadera` varchar(255) NOT NULL DEFAULT '0',
  `largo_falda` varchar(255) NOT NULL DEFAULT '0',
  `observaciones` varchar(255) NOT NULL DEFAULT 'SIN OBSERVACIONES',
  `pantalon_muslo` varchar(255) NOT NULL DEFAULT '0',
  `pantalon_rodilla` varchar(255) NOT NULL DEFAULT '0',
  `pantalon_basta` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `nombre`, `rut`, `telefono`, `email`, `id_cliente`, `busto`, `cintura`, `cadera`, `ancho_espalda`, `talle_delantero`, `talle_espalda`, `largo_manga`, `largo_blusa`, `largo_guillete`, `largo_chaqueta`, `largo_polera`, `largo_parka`, `largo_polar`, `largo_vestido`, `pantalon_cintura`, `pantalon_cadera`, `pantalon_tiro`, `pantalon_entrepierna`, `largo_pantalon`, `falda_cintura`, `falda_cadera`, `largo_falda`, `observaciones`, `pantalon_muslo`, `pantalon_rodilla`, `pantalon_basta`) VALUES
(19, 'Prueba01', 'elrutcambio', 'este es el numero', 'hola como estas? correo', 7, '58.5', 'cintura', '.,.', '25', 'hola cambio', 'holacambio', '-10', '-10', '20', '20', '60', '21', 'hola', 'adios', '-25', '-60', '55', 'hola', '?¡:;', '(/&', '=)(', '=>_L', 'SIN OBSERVACIONES', '%&/', '!\"#', 'eskjf'),
(20, 'PRUEBA02', 'hola RUT', 'este es el numero', 'hola como estas? correo', 6, 'busto', 'cintura', 'cadera', 'anchoesplada', '10', '10', '-10', '-10', '20', '20', '60', '21', 'hola', 'adios', '-25', '-60', '.36', 'hola', '?¡:;', 'CAMBIO', 'CAMBIO', 'CAMBIO', 'SIN OBSERVACIONES', '%&/', '!\"#', '¡?*[_');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantel`
--

CREATE TABLE `plantel` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `rut` varchar(255) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `comision` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `plantel`
--

INSERT INTO `plantel` (`id`, `nombre`, `rut`, `cargo`, `comision`) VALUES
(7, 'Fernando Torres Flores', '9246172-6', 'Gerente', 0),
(10, 'ALEJANDRO  MANSILLA VERA', '7.641.868-3', 'PROPIETARIO', 20),
(12, 'BUBU', 'elRutNoEsNesesario', 'SUPER JEFE', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plazos`
--

CREATE TABLE `plazos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `plazos`
--

INSERT INTO `plazos` (`id`, `nombre`, `numero`) VALUES
(1, 'Contado', 1),
(4, '45 dias', 45),
(5, '60 dias', 60),
(6, '90 dias', 90),
(9, '120 dias', 120),
(10, '180 dias', 180),
(11, 'CUOTAS', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `codigo` text NOT NULL,
  `codigoBarra` text NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` text NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `ventas` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stock_alerta` int(11) DEFAULT 20,
  `stock_min` int(11) DEFAULT 10,
  `id_bodega` int(11) NOT NULL,
  `id_subcategoria` int(11) NOT NULL,
  `id_medida` int(11) NOT NULL,
  `id_rubro` int(11) NOT NULL,
  `tipo_producto` varchar(255) NOT NULL DEFAULT 'Afecto',
  `id_tabla_lista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `codigo`, `codigoBarra`, `descripcion`, `imagen`, `stock`, `precio_compra`, `precio_venta`, `ventas`, `fecha`, `stock_alerta`, `stock_min`, `id_bodega`, `id_subcategoria`, `id_medida`, `id_rubro`, `tipo_producto`, `id_tabla_lista`) VALUES
(1, 8, '173298410605', '', 'Desarrollo Software Vive Cermaq cuota 6', 'vistas/img/productos/default/anonymous.png', 0, 0, 487980, 0, '2022-03-05 17:11:39', 0, 0, 1, 10, 9, 7, 'Exento', 2),
(2, 36, '610751094238', '', 'Soporte mensual Vive Cermaq', 'vistas/img/productos/default/anonymous.png', 0, 0, 15000000, 0, '2024-09-10 20:38:29', 0, 0, 1, 3, 9, 9, 'Afecto', 0),
(3, 37, '625101409738', '', 'Asesoría Obtención Patente Cafetería Cermaq PMC', 'vistas/img/productos/default/anonymous.png', 0, 0, 1900000, 0, '2021-10-15 23:39:26', 0, 0, 1, 3, 9, 8, 'Exento', 0),
(4, 36, '811042637905', '', 'Soporte Informático', 'vistas/img/productos/default/anonymous.png', 0, 0, 80000, 0, '2021-10-21 21:50:50', 0, 0, 1, 3, 9, 9, 'Afecto', 0),
(5, 8, '410923176805', '', 'Licencia Aptusoft', 'vistas/img/productos/default/anonymous.png', 0, 0, 50000, 0, '2021-10-21 21:51:32', 0, 0, 1, 3, 1, 7, 'Afecto', 0),
(6, 40, '328647910510', '', 'Reloj Comedor LAN', 'vistas/img/productos/default/anonymous.png', 0, 0, 584493, 0, '2021-11-19 13:36:22', 0, 0, 1, 3, 1, 10, 'Afecto', 0),
(7, 40, '102184059367', '', 'Impresora Termica Fiscal', 'vistas/img/productos/default/anonymous.png', 0, 0, 301475, 0, '2021-11-19 13:37:01', 0, 0, 1, 3, 1, 10, 'Afecto', 0),
(8, 40, '321090587164', '', 'Gabinete Reloj Casino', 'vistas/img/productos/default/anonymous.png', 0, 0, 215340, 0, '2021-11-19 13:37:38', 0, 0, 1, 3, 1, 10, 'Afecto', 0),
(9, 40, '652140810793', '', 'Gabinete Impresora', 'vistas/img/productos/default/anonymous.png', 0, 0, 129204, 0, '2021-11-19 13:38:12', 0, 0, 1, 3, 1, 10, 'Afecto', 0),
(10, 38, '101239407568', '', 'Instalación y Configuración Equipo', 'vistas/img/productos/default/anonymous.png', 0, 0, 100000, 0, '2021-11-19 13:38:59', 0, 0, 1, 3, 9, 8, 'Afecto', 0),
(11, 8, '905107863124', '', 'Software Gestion Segproject', 'vistas/img/productos/default/anonymous.png', 0, 0, 7500000, 0, '2021-12-09 15:08:33', 0, 0, 1, 10, 9, 7, 'Exento', 0),
(12, 8, '385016107294', '', 'Mejoras Software Viveres', 'vistas/img/productos/default/anonymous.png', 0, 0, 800000, 0, '2021-12-20 14:06:16', 0, 0, 1, 10, 9, 7, 'Exento', 0),
(13, 40, '812957010364', '', 'Huellero URU4500 + Configuración + Instalación', 'vistas/img/productos/default/anonymous.png', 0, 94000, 180000, 0, '2022-02-07 14:08:39', 0, 0, 1, 3, 1, 10, 'Afecto', 0),
(14, 38, '495310162078', '', 'Control Asistencia Geovictoria mensual', 'vistas/img/productos/default/anonymous.png', 0, 0, 3539, 0, '2022-02-07 13:47:47', 0, 0, 1, 3, 1, 8, 'Afecto', 0),
(15, 40, '101534702689', '', 'CÁMARA IP  WIFI + MICRO SD + 12V', 'vistas/img/productos/default/anonymous.png', 0, 47882, 62250, 0, '2022-04-06 14:24:57', 0, 0, 1, 3, 1, 10, 'Afecto', 0),
(16, 40, '237101809654', '', 'NVRC936_NVRC921 - Grabador de vídeo NVR H.265', 'vistas/img/productos/default/anonymous.png', 0, 75622, 98300, 0, '2022-04-06 14:25:31', 0, 0, 1, 3, 1, 10, 'Afecto', 0),
(17, 40, '102871506493', '', 'WD10PURZ - Disco Duro 1TB para Video', 'vistas/img/productos/default/anonymous.png', 0, 56714, 73730, 0, '2022-04-06 14:25:59', 0, 0, 1, 3, 1, 10, 'Afecto', 0),
(18, 40, '731410986250', '', 'Tarjeta Memoria Micro SD', 'vistas/img/productos/default/anonymous.png', 0, 0, 21850, 0, '2022-04-06 14:44:49', 0, 0, 1, 3, 1, 10, 'Afecto', 0),
(19, 38, '714682359010', '', 'Despacho', 'vistas/img/productos/default/anonymous.png', 0, 0, 12000, 0, '2022-05-04 01:14:50', 0, 0, 1, 3, 9, 8, 'Afecto', 0),
(20, 8, '823401019657', '', 'SUPER CAJA', 'vistas/img/productos/823401019657/279.jpg', 0, 10000, 20000, 0, '2024-09-09 15:09:35', 10, 10, 1, 10, 1, 7, 'Afecto', 0),
(22, 8, '420576810913', '', 'AAAAAAAA', 'vistas/img/productos/420576810913/285.jpg', 0, 11, 22, 0, '2024-09-10 20:20:43', 1111, 9, 1, 10, 1, 7, 'Afecto', 0),
(23, 40, '954836072103', '', 'ñ', 'vistas/img/productos/954836072103/411.jpg', 0, 6, 133, 0, '2024-09-10 20:48:21', 1, 3, 1, 10, 2, 7, 'Exento', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `razon_social` text DEFAULT NULL,
  `rut` varchar(11) NOT NULL,
  `comuna` varchar(50) NOT NULL,
  `nro_cuenta` varchar(50) NOT NULL,
  `banco` varchar(50) NOT NULL,
  `telefono` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `actividad` text DEFAULT 'No Especificada',
  `ejecutivo` text NOT NULL DEFAULT 'No Especificado',
  `rubros` varchar(255) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL DEFAULT 'No Especificada',
  `id_plazo` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `razon_social`, `rut`, `comuna`, `nro_cuenta`, `banco`, `telefono`, `email`, `actividad`, `ejecutivo`, `rubros`, `pais`, `region`, `direccion`, `id_plazo`) VALUES
(1, 'VICTORIA S.A.', '76.188.587-', 'Las Condes', '0', 'BANCO DE CHILE', '0', 'hola como estas? correo', 'EMPRESA DE SERVICIOS INTEGRALES DE INFORMATICA', 'RICARDO LOPEZ', 'Software medida', 'Chile', 'Metropolitana de Santiago', 'AVENIDA LOS LEONES N° 2061, BLOQUEO 2DO PISO, DEPTO OF B', 1),
(2, 'ELECTRONIC S.A.P.F', 'este es el ', 'San Pedro de Atacama', '10', 'BANCO DE CHILE', 'este es el numeroP', 'hola como estas? correPPPP', 'EJECUTIVO', 'pedroP', 'Software medida', 'Chile', 'Ñuble', 'avenida jose', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regiones`
--

CREATE TABLE `regiones` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(128) NOT NULL DEFAULT '',
  `ordinal` varchar(4) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `regiones`
--

INSERT INTO `regiones` (`id`, `nombre`, `ordinal`) VALUES
(1, 'Arica y Parinacota', 'XV'),
(2, 'Tarapacá', 'I'),
(3, 'Antofagasta', 'II'),
(4, 'Atacama', 'III'),
(5, 'Coquimbo', 'IV'),
(6, 'Valparaiso', 'V'),
(7, 'Metropolitana de Santiago', 'RM'),
(8, 'Libertador General Bernardo O\'Higgins', 'VI'),
(9, 'Maule', 'VII'),
(10, 'Biobío', 'VIII'),
(11, 'La Araucanía', 'IX'),
(12, 'Los Ríos', 'XIV'),
(13, 'Los Lagos', 'X'),
(14, 'Aisén del General Carlos Ibáñez del Campo', 'XI'),
(15, 'Magallanes y de la Antártica Chilena', 'XII'),
(16, 'Ñuble', 'XVI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubros`
--

CREATE TABLE `rubros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rubros`
--

INSERT INTO `rubros` (`id`, `nombre`, `descripcion`) VALUES
(7, 'Software medida', 'Programacion especifica para cliente'),
(8, 'Servicios', 'hola'),
(9, 'Soporte', '0'),
(10, 'Equipos Computacionales', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas`
--

CREATE TABLE `salidas` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `tipo_salida` varchar(255) NOT NULL,
  `fecha_emision` date NOT NULL DEFAULT current_timestamp(),
  `observaciones` varchar(255) NOT NULL DEFAULT 'SIN OBSERVACION',
  `id_bodega_origen` int(11) NOT NULL,
  `valor_tipo_salida` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salidas`
--

INSERT INTO `salidas` (`id`, `codigo`, `tipo_salida`, `fecha_emision`, `observaciones`, `id_bodega_origen`, `valor_tipo_salida`) VALUES
(1, 1, 'Salida Manual', '2024-09-30', 'o', 2, '7'),
(2, 2, 'Bodega a O.T', '2024-09-30', 'o', 1, '9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida_producto`
--

CREATE TABLE `salida_producto` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_salida` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `id_bodega` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salida_producto`
--

INSERT INTO `salida_producto` (`id`, `id_producto`, `id_salida`, `cantidad`, `descripcion`, `id_bodega`) VALUES
(1, 2, NULL, 3, 'Soporte mensual Vive Cermaq', 1),
(2, 5, NULL, 1, 'Licencia Aptusoft', 1),
(3, 9, NULL, 1, 'Gabinete Impresora', 1),
(4, 20, NULL, 1, 'SUPER CAJA', 2),
(5, 1, NULL, 1, 'Desarrollo Software Vive Cermaq cuota 6', 1),
(6, 2, NULL, 1, 'Soporte mensual Vive Cermaq', 1),
(7, 3, NULL, 1, 'Asesoría Obtención Patente Cafetería Cermaq PMC', 1),
(8, 4, NULL, 1, 'Soporte Informático', 1),
(9, 5, NULL, 1, 'Licencia Aptusoft', 1),
(10, 6, NULL, 1, 'Reloj Comedor LAN', 1),
(11, 7, NULL, 1, 'Impresora Termica Fiscal', 1),
(12, 9, 1, 1, 'Gabinete Impresora', 2),
(13, 1, 2, 1, 'Desarrollo Software Vive Cermaq cuota 6', 1),
(14, 2, 2, 1, 'Soporte mensual Vive Cermaq', 1),
(15, 3, 2, 1, 'Asesoría Obtención Patente Cafetería Cermaq PMC', 1),
(16, 1, NULL, 1000, 'Desarrollo Software Vive Cermaq cuota 6', 1),
(17, 3, NULL, 12222, 'Asesoría Obtención Patente Cafetería Cermaq PMC', 1),
(18, 1, NULL, 1, 'Desarrollo Software Vive Cermaq', 1),
(19, 1, NULL, 10000, 'Desarrollo Software Vive Cermaq cuota 6', 2),
(20, 3, NULL, 10000, 'Asesoría Obtención Patente Cafetería Cermaq PMC', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `subcategoria` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `id_categoria`, `subcategoria`, `fecha`) VALUES
(10, 8, 'Desarrollo', '2021-10-05 21:14:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `comuna` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `jefe` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bodega` varchar(255) NOT NULL,
  `pais` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id`, `nombre`, `region`, `comuna`, `direccion`, `jefe`, `telefono`, `email`, `bodega`, `pais`) VALUES
(5, 'SUPER COOOL', 'La Araucanía', 'Calama', 'DIRECCION #5896', 'SUPER PEDRO', 'este es el numero', 'hola como estas? correo', 'super bodega 3000', 'EL  UNDO'),
(7, 'LOS NOTROS', 'Arica y Parinacota', 'Camarones', 'AV LOS RURALES', 'AAAAA', 'AAAAAA', '1111111', 'super bodega 3000', 'Chile');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_listas`
--

CREATE TABLE `tabla_listas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tabla_listas`
--

INSERT INTO `tabla_listas` (`id`, `nombre`) VALUES
(1, 'Producto'),
(2, 'Servicio'),
(3, 'Insumo'),
(4, 'Mix'),
(5, 'PRUEBA LISTA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_clientes`
--

CREATE TABLE `tipo_clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_clientes`
--

INSERT INTO `tipo_clientes` (`id`, `nombre`, `codigo`) VALUES
(1, 'SERCOTEC 2020', 1),
(3, 'SERCOTEC 2021', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_de_accion`
--

CREATE TABLE `tipo_de_accion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_de_accion`
--

INSERT INTO `tipo_de_accion` (`id`, `nombre`) VALUES
(1, 'Anula Documento de Referencia'),
(2, 'Corrige Texto Documento Referencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_productos`
--

CREATE TABLE `tipo_productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_productos`
--

INSERT INTO `tipo_productos` (`id`, `nombre`, `codigo`) VALUES
(1, 'POS PyMe', 1),
(2, 'POS Basico', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `id` int(11) NOT NULL,
  `medida` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`id`, `medida`) VALUES
(1, 'Unidad'),
(2, 'Metro'),
(3, 'Kilo'),
(4, 'Caja'),
(6, 'Litros'),
(8, 'CentimetrosSS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades_negocio`
--

CREATE TABLE `unidades_negocio` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `unidad_negocio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `unidades_negocio`
--

INSERT INTO `unidades_negocio` (`id`, `codigo`, `unidad_negocio`) VALUES
(4, 2147483647, 'asdfdd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `usuario` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `password` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `perfil` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `foto` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(74, 'MLINE', 'MLINE', '$2a$07$asxx54ahjppf45sd87a5aur5IvEaFbOa7GTslHYyfAWFYQ.na1lde', 'Administrador', '', 1, '0000-00-00 00:00:00', '2020-12-13 20:05:36'),
(83, 'Fernando Torres Flores', 'admin', '$2a$07$asxx54ahjppf45sd87a5au7TK/8oGAnh/guLnXHOatR5mMTcaM3O.', 'Especial', 'vistas/img/usuarios/admin/777.png', 1, '0000-00-00 00:00:00', '2024-09-26 13:43:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `productos` text NOT NULL,
  `impuesto` float NOT NULL,
  `neto` float NOT NULL,
  `total` float NOT NULL,
  `metodo_pago` text NOT NULL,
  `total_pagado` float NOT NULL,
  `total_pendiente_pago` float NOT NULL,
  `descuento` int(50) NOT NULL,
  `costo_extra` int(11) NOT NULL,
  `observacion` varchar(100) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `codigo`, `id_cliente`, `id_vendedor`, `productos`, `impuesto`, `neto`, `total`, `metodo_pago`, `total_pagado`, `total_pendiente_pago`, `descuento`, `costo_extra`, `observacion`, `fecha`) VALUES
(6, 5, 2, 69, '[{\"id\":\"12\",\"descripcion\":\"ASUS ROG\",\"cantidad\":\"5\",\"stock\":\"5\",\"precio\":\"150000\",\"total\":\"750000\"}]', 0, 750000, 749999, 'Transferencia', 749999, 0, 1, 0, 'pago', '2020-08-07 23:01:07'),
(7, 6, 2, 69, '[{\"id\":\"12\",\"descripcion\":\"ASUS ROG\",\"cantidad\":\"1\",\"stock\":\"4\",\"precio\":\"150000\",\"total\":\"150000\"}]', 0, 150000, 0, 'Pendiente pago', 0, 0, 150000, 0, '', '2020-08-07 23:02:59'),
(8, 7, 2, 69, '[{\"id\":\"13\",\"descripcion\":\"MARTILLO\",\"cantidad\":\"8\",\"stock\":\"7\",\"precio\":\"2000\",\"total\":\"16000\"}]', 0, 16000, 16000, 'Efectivo', 16000, 0, 0, 0, '', '2020-08-07 23:13:01'),
(9, 8, 2, 1, '[{\"id\":\"13\",\"descripcion\":\"MARTILLO\",\"cantidad\":\"6\",\"stock\":\"1\",\"precio\":\"2000\",\"total\":\"12000\"},{\"id\":\"14\",\"descripcion\":\"RAM 8GB\",\"cantidad\":\"1\",\"stock\":\"49\",\"precio\":\"1300000\",\"total\":\"1300000\"}]', 0, 1312000, 812000, 'Transferencia', 812000, 0, 500000, 0, 'PAGO PRUEBA', '2020-08-19 21:26:14');

--
-- Disparadores `ventas`
--
DELIMITER $$
CREATE TRIGGER `eliminar_Ventas` AFTER DELETE ON `ventas` FOR EACH ROW BEGIN
    DELETE 
      FROM historial_ventas
     WHERE codigo = old.codigo;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insertaVentas` AFTER INSERT ON `ventas` FOR EACH ROW BEGIN
        DECLARE existe INT;
        SELECT COUNT(*) INTO existe FROM historial_ventas WHERE codigo = new.codigo;
          IF (existe>0) THEN
	UPDATE historial_ventas a 
    SET a.id_cliente = new.id_cliente,
    a.id_vendedor = new.id_vendedor,
    a.productos = new.productos,
    a.impuesto = new.impuesto,
    a.neto = new.neto,
    a.total = new.total,
    a.metodo_pago = new.metodo_pago,
    a.total_pagado = new.total_pagado,
    a.total_pendiente_pago = new.total_pendiente_pago,
    a.descuento = new.descuento,
    a.observacion = new.observacion,
    a.fecha = new.fecha
    WHERE a.codigo=new.codigo;
	ELSE
	INSERT INTO historial_ventas (codigo, id_cliente, id_vendedor, productos, impuesto, neto, total, metodo_pago, total_pagado, total_pendiente_pago, descuento, observacion, fecha) VALUES (new.codigo, new.id_cliente, new.id_vendedor, new.productos, new.impuesto, new.neto, new.total, new.metodo_pago, new.total_pagado, new.total_pendiente_pago, new.descuento, new.observacion, new.fecha);
      END IF;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `modifica_insertaVentas` AFTER UPDATE ON `ventas` FOR EACH ROW BEGIN
        DECLARE existe INT;
        SELECT COUNT(*) INTO existe FROM historial_ventas WHERE codigo = new.codigo;
	INSERT INTO historial_ventas (codigo, id_cliente, id_vendedor, productos, impuesto, neto, total, metodo_pago, total_pagado, total_pendiente_pago, descuento, observacion, fecha) VALUES (new.codigo, new.id_cliente, new.id_vendedor, new.productos, new.impuesto, new.neto, new.total, new.metodo_pago, new.total_pagado, new.total_pendiente_pago, new.descuento, new.observacion, new.fecha);
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_afecta`
--

CREATE TABLE `venta_afecta` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_unidad_negocio` int(11) NOT NULL,
  `id_bodega` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `productos` varchar(1000) NOT NULL,
  `id_plazo_pago` int(11) NOT NULL,
  `id_medio_pago` int(11) NOT NULL,
  `subtotal` varchar(255) NOT NULL,
  `descuento` varchar(255) NOT NULL DEFAULT '0',
  `total_neto` varchar(255) NOT NULL,
  `iva` varchar(255) NOT NULL,
  `total_final` varchar(255) NOT NULL,
  `pagado` varchar(255) NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `fecha_emision` date NOT NULL,
  `pendiente` varchar(255) NOT NULL,
  `documento` varchar(255) NOT NULL,
  `fecha_documento` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `tipo_dte` varchar(255) NOT NULL DEFAULT 'Factura Afecta',
  `folio_documento` int(11) DEFAULT 0,
  `razon_documento` varchar(255) NOT NULL DEFAULT 'NO APLICA',
  `motivo_documento` varchar(255) NOT NULL DEFAULT 'NO APLICA',
  `estado` varchar(25) NOT NULL DEFAULT 'SIN NC'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta_afecta`
--

INSERT INTO `venta_afecta` (`id`, `codigo`, `id_cliente`, `id_unidad_negocio`, `id_bodega`, `id_vendedor`, `productos`, `id_plazo_pago`, `id_medio_pago`, `subtotal`, `descuento`, `total_neto`, `iva`, `total_final`, `pagado`, `observacion`, `fecha_emision`, `pendiente`, `documento`, `fecha_documento`, `fecha_vencimiento`, `tipo_dte`, `folio_documento`, `razon_documento`, `motivo_documento`, `estado`) VALUES
(1, 1, 3, 2, 1, 7, '', 4, 2, '', '', '', '', '', '0', '', '2024-09-09', '0', 'Nota de Venta', '2024-09-09', '2024-09-30', 'Factura Afecta', 25982, 'color rojo', 'objetivo tapado', 'SIN NC'),
(2, 2, 0, 4, 1, 8, '[{\"id\":\"1\",\"descripcion\":\"Desarrollo Software Vive Cermaq\",\"cantidad\":\"1\",\"precio\":\"2927890\",\"descuento\":\"0\",\"iva\":\"0\",\"total\":\"2927890\"}]', 10, 3, '2,927,890', '0', '2,927,890', '0', '2,927,890', '0', 'CONDICION DE PAGO 6 CUOTAS', '2021-10-06', '2927890', 'Nota de Venta', '0000-00-00', '2021-10-31', 'Factura Afecta', 1232321, '', '', 'SIN NC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_boleta`
--

CREATE TABLE `venta_boleta` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_unidad_negocio` int(11) NOT NULL,
  `id_bodega` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `productos` varchar(1000) NOT NULL,
  `id_plazo_pago` int(11) NOT NULL,
  `id_medio_pago` int(11) NOT NULL,
  `subtotal` varchar(255) NOT NULL,
  `descuento` varchar(255) NOT NULL DEFAULT '0',
  `total_neto` varchar(255) NOT NULL,
  `iva` varchar(255) NOT NULL,
  `total_final` varchar(255) NOT NULL,
  `pagado` varchar(255) NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `fecha_emision` date NOT NULL,
  `pendiente` varchar(255) NOT NULL,
  `tipo_dte` text NOT NULL DEFAULT 'Venta con Boleta',
  `estado` varchar(25) NOT NULL DEFAULT 'SIN NC'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta_boleta`
--

INSERT INTO `venta_boleta` (`id`, `codigo`, `id_cliente`, `id_unidad_negocio`, `id_bodega`, `id_vendedor`, `productos`, `id_plazo_pago`, `id_medio_pago`, `subtotal`, `descuento`, `total_neto`, `iva`, `total_final`, `pagado`, `observacion`, `fecha_emision`, `pendiente`, `tipo_dte`, `estado`) VALUES
(1, 1, 1, 2, 1, 7, '', 3, 1, '', '', '', '', '', '0', '', '2024-09-09', '0', 'Venta con Boleta', 'SIN NC'),
(2, 2, 4, 2, 1, 7, '[{\"id\":\"2\",\"descripcion\":\"Soporte mensual Vive Cermaq\",\"cantidad\":\"3\",\"precio\":\"1500000\",\"descuento\":\"10\",\"iva\":\"854998\",\"total\":\"5354988\"},{\"id\":\"5\",\"descripcion\":\"Licencia Aptusoft\",\"cantidad\":\"1\",\"precio\":\"50000\",\"descuento\":\"0\",\"iva\":\"9500\",\"total\":\"59500\"},{\"id\":\"9\",\"descripcion\":\"Gabinete Impresora\",\"cantidad\":\"1\",\"precio\":\"129204\",\"descuento\":\"0\",\"iva\":\"24549\",\"total\":\"153753\"}]', 1, 1, '4,679,204', '10', '4,679,194', '889,047', '5568241', '150000', 'no hay observaciones', '2024-09-09', '0', 'Venta con Boleta', 'SIN NC'),
(3, 3, 7, 2, 2, 7, '[{\"id\":\"20\",\"descripcion\":\"SUPER CAJA\",\"cantidad\":\"1\",\"precio\":\"20000\",\"descuento\":\"0\",\"iva\":\"3800\",\"total\":\"23800\"}]', 1, 0, '20,000', '0', '20,000', '3,800', '23800', '20000', 'muy buenas observaciones A++', '2024-09-09', '3800', 'Venta con Boleta', 'SIN NC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_boleta_exenta`
--

CREATE TABLE `venta_boleta_exenta` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_unidad_negocio` int(11) NOT NULL,
  `id_bodega` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `productos` varchar(1000) NOT NULL,
  `id_plazo_pago` int(11) NOT NULL,
  `id_medio_pago` int(11) NOT NULL,
  `total_final` varchar(255) NOT NULL,
  `pagado` varchar(255) NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `fecha_emision` date NOT NULL,
  `pendiente` varchar(255) NOT NULL,
  `tipo_dte` text NOT NULL DEFAULT 'Venta con Boleta Exenta',
  `estado` varchar(25) NOT NULL DEFAULT 'SIN NC',
  `descuento` varchar(255) NOT NULL DEFAULT '0',
  `subtotal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta_boleta_exenta`
--

INSERT INTO `venta_boleta_exenta` (`id`, `codigo`, `id_cliente`, `id_unidad_negocio`, `id_bodega`, `id_vendedor`, `productos`, `id_plazo_pago`, `id_medio_pago`, `total_final`, `pagado`, `observacion`, `fecha_emision`, `pendiente`, `tipo_dte`, `estado`, `descuento`, `subtotal`) VALUES
(1, 1, 2, 2, 1, 7, '', 1, 1, '', '0', '', '2024-09-09', '0', 'Venta con Boleta Exenta', 'SIN NC', '', ''),
(2, 2, 2, 4, 1, 7, '[{\"id\":\"1\",\"descripcion\":\"Desarrollo Software Vive Cermaq cuota 6\",\"cantidad\":\"1000\",\"precio\":\"487980\",\"descuento\":\"200\",\"iva\":\"0\",\"total\":\"487979800\"},{\"id\":\"3\",\"descripcion\":\"Asesoría Obtención Patente Cafetería Cermaq PMC\",\"cantidad\":\"12222\",\"precio\":\"1900000\",\"descuento\":\"1500\",\"iva\":\"0\",\"total\":\"23221798500\"}]', 1, 1, '23709778300', '20', 'aaaaaaaaaaa', '2024-09-10', '23,709,778,280', 'Venta con Boleta Exenta', 'SIN NC', '1,700', '23,709,780,000'),
(3, 3, 4, 4, 2, 8, '[{\"id\":\"1\",\"descripcion\":\"Desarrollo Software Vive Cermaq cuota 6\",\"cantidad\":\"10000\",\"precio\":\"487980\",\"descuento\":\"300\",\"iva\":\"0\",\"total\":\"4879799700\"},{\"id\":\"3\",\"descripcion\":\"Asesoría Obtención Patente Cafetería Cermaq PMC\",\"cantidad\":\"10000\",\"precio\":\"1900000\",\"descuento\":\"100\",\"iva\":\"0\",\"total\":\"18999999900\"}]', 1, 1, '23879799600', '2', 'AAAAAAAAAA', '2024-09-10', '23,879,799,598', 'Venta con Boleta Exenta', 'SIN NC', '400', '23,879,800,000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_exenta`
--

CREATE TABLE `venta_exenta` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_unidad_negocio` int(11) NOT NULL,
  `id_bodega` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `productos` varchar(1000) NOT NULL,
  `id_plazo_pago` int(11) NOT NULL,
  `id_medio_pago` int(11) NOT NULL,
  `subtotal` varchar(255) NOT NULL,
  `descuento` varchar(255) NOT NULL DEFAULT '0',
  `iva` varchar(255) NOT NULL,
  `total_final` varchar(255) NOT NULL,
  `pagado` varchar(255) NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `fecha_emision` date NOT NULL,
  `pendiente` varchar(255) NOT NULL,
  `documento` varchar(255) NOT NULL,
  `fecha_documento` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `tipo_dte` text NOT NULL DEFAULT 'Factura Exenta',
  `exento` varchar(255) NOT NULL,
  `motivo_documento` varchar(255) NOT NULL DEFAULT 'FACTURACION',
  `estado` varchar(25) NOT NULL DEFAULT 'SIN NC',
  `folio_documento` int(15) NOT NULL,
  `razon_documento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta_exenta`
--

INSERT INTO `venta_exenta` (`id`, `codigo`, `id_cliente`, `id_unidad_negocio`, `id_bodega`, `id_vendedor`, `productos`, `id_plazo_pago`, `id_medio_pago`, `subtotal`, `descuento`, `iva`, `total_final`, `pagado`, `observacion`, `fecha_emision`, `pendiente`, `documento`, `fecha_documento`, `fecha_vencimiento`, `tipo_dte`, `exento`, `motivo_documento`, `estado`, `folio_documento`, `razon_documento`) VALUES
(1, 12, 2, 4, 1, 8, '[{\"id\":\"1\",\"descripcion\":\"Desarrollo Software Vive Cermaq cuota 6\",\"cantidad\":\"1000\",\"precio\":\"487980\",\"descuento\":\"300\",\"iva\":\"0\",\"total\":\"487979700\"},{\"id\":\"3\",\"descripcion\":\"Asesoría Obtención Patente Cafetería Cermaq PMC\",\"cantidad\":\"2000\",\"precio\":\"1900000\",\"descuento\":\"200\",\"iva\":\"0\",\"total\":\"3799999800\"}]', 4, 1, '4,287,980,000', '500', '0', '4287979500', '0', 'aaaaaaaaaaa', '2024-09-10', '4,287,979,500', 'NO APLICA', '0000-00-00', '2024-09-13', 'Factura Exenta', '4,287,979,500', '', 'SIN NC', 1232321, ''),
(2, 13, 2, 4, 1, 7, '[{\"id\":\"1\",\"descripcion\":\"Desarrollo Software Vive Cermaq cuota 6\",\"cantidad\":\"200000\",\"precio\":\"487980\",\"descuento\":\"0\",\"iva\":\"0\",\"total\":\"97596000000\"},{\"id\":\"3\",\"descripcion\":\"Asesoría Obtención Patente Cafetería Cermaq PMC\",\"cantidad\":\"111111\",\"precio\":\"1900000\",\"descuento\":\"0\",\"iva\":\"0\",\"total\":\"211110900000\"}]', 1, 1, '308,706,900,000', '0', '0', '308706900000', '308706899996', 'aaaaaaaaaaa', '2024-09-10', '4', 'NO APLICA', '0000-00-00', '2024-09-21', 'Factura Exenta', '308,706,900,000', '', 'SIN NC', 0, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ajustes`
--
ALTER TABLE `ajustes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ajuste_producto`
--
ALTER TABLE `ajuste_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bodegas`
--
ALTER TABLE `bodegas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bodega_productos`
--
ALTER TABLE `bodega_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `centros_costo`
--
ALTER TABLE `centros_costo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comunas`
--
ALTER TABLE `comunas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comunas_regiones` (`region_id`);

--
-- Indices de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cotizaciones_exentas`
--
ALTER TABLE `cotizaciones_exentas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entrada_producto`
--
ALTER TABLE `entrada_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial_ventas`
--
ALTER TABLE `historial_ventas`
  ADD PRIMARY KEY (`id_historial`);

--
-- Indices de la tabla `impuestos`
--
ALTER TABLE `impuestos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lista_precios`
--
ALTER TABLE `lista_precios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `matrices`
--
ALTER TABLE `matrices`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medios_pago`
--
ALTER TABLE `medios_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nota_credito`
--
ALTER TABLE `nota_credito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nota_credito_boleta`
--
ALTER TABLE `nota_credito_boleta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nota_credito_boleta_exenta`
--
ALTER TABLE `nota_credito_boleta_exenta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nota_credito_exenta`
--
ALTER TABLE `nota_credito_exenta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orden_vestuario`
--
ALTER TABLE `orden_vestuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `parametros_documentos`
--
ALTER TABLE `parametros_documentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plantel`
--
ALTER TABLE `plantel`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plazos`
--
ALTER TABLE `plazos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `regiones`
--
ALTER TABLE `regiones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rubros`
--
ALTER TABLE `rubros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salida_producto`
--
ALTER TABLE `salida_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tabla_listas`
--
ALTER TABLE `tabla_listas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_clientes`
--
ALTER TABLE `tipo_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_de_accion`
--
ALTER TABLE `tipo_de_accion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unidades_negocio`
--
ALTER TABLE `unidades_negocio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_afecta`
--
ALTER TABLE `venta_afecta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_boleta`
--
ALTER TABLE `venta_boleta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_boleta_exenta`
--
ALTER TABLE `venta_boleta_exenta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_exenta`
--
ALTER TABLE `venta_exenta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ajustes`
--
ALTER TABLE `ajustes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ajuste_producto`
--
ALTER TABLE `ajuste_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `bancos`
--
ALTER TABLE `bancos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `bodegas`
--
ALTER TABLE `bodegas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `bodega_productos`
--
ALTER TABLE `bodega_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `centros_costo`
--
ALTER TABLE `centros_costo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `comunas`
--
ALTER TABLE `comunas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;

--
-- AUTO_INCREMENT de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `cotizaciones_exentas`
--
ALTER TABLE `cotizaciones_exentas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `entrada_producto`
--
ALTER TABLE `entrada_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `historial_ventas`
--
ALTER TABLE `historial_ventas`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `impuestos`
--
ALTER TABLE `impuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `lista_precios`
--
ALTER TABLE `lista_precios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `matrices`
--
ALTER TABLE `matrices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `medios_pago`
--
ALTER TABLE `medios_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `nota_credito`
--
ALTER TABLE `nota_credito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nota_credito_boleta`
--
ALTER TABLE `nota_credito_boleta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `nota_credito_boleta_exenta`
--
ALTER TABLE `nota_credito_boleta_exenta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nota_credito_exenta`
--
ALTER TABLE `nota_credito_exenta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `orden_vestuario`
--
ALTER TABLE `orden_vestuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `parametros_documentos`
--
ALTER TABLE `parametros_documentos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `plantel`
--
ALTER TABLE `plantel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `plazos`
--
ALTER TABLE `plazos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `regiones`
--
ALTER TABLE `regiones`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `rubros`
--
ALTER TABLE `rubros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `salidas`
--
ALTER TABLE `salidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `salida_producto`
--
ALTER TABLE `salida_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tabla_listas`
--
ALTER TABLE `tabla_listas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo_clientes`
--
ALTER TABLE `tipo_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_de_accion`
--
ALTER TABLE `tipo_de_accion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `unidades_negocio`
--
ALTER TABLE `unidades_negocio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `venta_afecta`
--
ALTER TABLE `venta_afecta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `venta_boleta`
--
ALTER TABLE `venta_boleta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `venta_boleta_exenta`
--
ALTER TABLE `venta_boleta_exenta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `venta_exenta`
--
ALTER TABLE `venta_exenta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comunas`
--
ALTER TABLE `comunas`
  ADD CONSTRAINT `comunass_regiones` FOREIGN KEY (`region_id`) REFERENCES `regiones` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
