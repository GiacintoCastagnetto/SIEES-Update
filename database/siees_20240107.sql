-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 08, 2024 at 02:50 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siees`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `area`, `created_at`, `updated_at`) VALUES
(1, 'Computación', NULL, NULL),
(2, 'Humanidades', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `encuesta`
--

CREATE TABLE `encuesta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token_encuesta` varchar(50) NOT NULL,
  `realizado` tinyint(4) DEFAULT 0,
  `nombre` varchar(255) NOT NULL,
  `empresa` varchar(255) NOT NULL,
  `puesto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `encuesta`
--

INSERT INTO `encuesta` (`id`, `token_encuesta`, `realizado`, `nombre`, `empresa`, `puesto`, `created_at`, `updated_at`) VALUES
(109, 'i4xHFTlhPRbwKO8fjTRUFG7J3HE6CAI1', 0, 'Jacob (Test)', 'UASLP', 'TI', '2024-01-06 07:36:51', '2024-01-06 07:38:04'),
(112, 'keB7W7tvMhSLtde5bQXmzKOwEcMEvwSy', 0, 'Hector(Test)', 'GBM', 'TI', '2024-01-07 08:38:15', '2024-01-07 08:38:35'),
(113, 'ZRKV1rzxZraVdrmIHB23S6Jdm4PJ7GJI', 0, 'Victor (Test)', 'GMB', 'TI', '2024-01-07 08:39:04', '2024-01-07 08:39:49'),
(114, '3mgL81J4fQH131Yw8NI0fJiiS4eYsW5o', 0, 'Jacob (Test)', 'ASCA', 'TI', '2024-01-07 08:39:53', '2024-01-07 08:41:04'),
(115, 'R9K3sG3WZQO6xVSgJ6Ywh0XO3DPzAWkA', 0, 'Arturo (Test)', 'BMW', 'Ingeniero de Software Senior', '2024-01-07 08:53:53', '2024-01-07 08:54:17'),
(116, '1s6zXWykPRxZXCukCbTtyG3v3iKylLar', 0, 'David (Test)', 'Gomez', 'TI', '2024-01-08 05:59:27', '2024-01-08 06:12:08');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `metrica_evaluacion`
--

CREATE TABLE `metrica_evaluacion` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metrica_evaluacion`
--

INSERT INTO `metrica_evaluacion` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Escala de Likert', 'Permite conocer el nivel de acuerdo y desacuerdo de las personas sobre un tema.', NULL, NULL),
(2, 'Abierta', 'Respuesta libre.', NULL, NULL),
(3, 'Opción múltiple', 'Diversas opciones, sin ser parte de una escala.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(39, '2014_10_12_000000_create_users_table', 1),
(40, '2014_10_12_100000_create_password_resets_table', 1),
(41, '2019_08_19_000000_create_failed_jobs_table', 1),
(42, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(43, '2021_09_30_021839_pregunta', 1),
(44, '2021_09_30_021856_respuesta', 1),
(45, '2021_09_30_021909_encuestado', 1),
(46, '2021_09_30_021923_respuesta_encuestado', 1),
(47, '2021_09_30_021932_area', 1),
(48, '2021_11_13_230755_tema', 1),
(49, '2023_10_02_230008_create_metrica_evaluacion_table', 2),
(50, '2023_10_02_230231_add_metrica_evaluacion_to_pregunta', 2),
(51, '2023_11_29_070508_add_opciones_to_pregunta', 3),
(52, '2023_11_29_082436_rename_encuestado_to_encuesta', 4),
(53, '2023_11_29_094838_create_pregunta_encuesta_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('correo@gmail.com', '$2y$10$R6Nbw1XYBju77B6GP..IYeWMlb8ZN/yNC5Ppsw4F6oPW2yeB7z08W', '2024-01-07 07:55:27');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pregunta`
--

CREATE TABLE `pregunta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_area` bigint(20) NOT NULL,
  `id_tema` bigint(20) NOT NULL,
  `id_metrica_evaluacion` bigint(20) UNSIGNED DEFAULT NULL,
  `opciones` varchar(255) DEFAULT NULL,
  `pregunta` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pregunta`
--

INSERT INTO `pregunta` (`id`, `id_area`, `id_tema`, `id_metrica_evaluacion`, `opciones`, `pregunta`, `created_at`, `updated_at`) VALUES
(42, 1, 1, 3, 'ROS (Robot Operating System);Gazebo;OpenRAVE;Player Project;Webots;A-Workshop', '¿Qué Frameworks de robótica conoce?', NULL, NULL),
(43, 1, 1, 3, 'Método de matrices de transformación homogénea;Método de Jacobianos;Método de geometría analítica;Método de cinemática de paralelogramos;Método de cinemática algebraica', '¿Qué métodos de cinemática directa e inversa en robótica considera necesitan reforzarse en la carrera?', NULL, NULL),
(46, 1, 1, 1, NULL, '¿Qué tan hábil es para aplicar algoritmos inspirados bio-inspirados? Del 1 al 7, siendo 1 muy poco y 7 bastante hábil.', NULL, NULL),
(47, 1, 1, 2, NULL, '¿En cuanto a tareas de visión computacional, que tipo de conocimiento le hacen falta al egresado?', NULL, NULL),
(48, 1, 1, 2, NULL, '¿Qué tipos de algoritmos en la rama de aprendizaje automático necesitan estudiarse en su opinión?', NULL, NULL),
(49, 1, 1, 2, NULL, '¿Si pudiera sugerir una nueva materia en la especialidad de Robótica Inteligente e Inteligencia Artificial cual sería?', NULL, NULL),
(50, 1, 2, 3, 'Unity;Unreal Engine 4;Unreal Engine 5;Motor propietario', '¿En qué motor gráfico desarrollan juegos o experiencias?', NULL, NULL),
(51, 1, 2, 1, NULL, '¿Qué tan bueno es el empleado en la programación de juegos? Siendo 1 muy poco y 7 muy hábil', NULL, NULL),
(52, 1, 2, 2, NULL, '¿En su opinión, que temas del desarrollo de videojuegos deben enseñarse?', NULL, NULL),
(53, 1, 2, 2, NULL, '¿Considera que es bueno que el empleado sepa temas de arte conceptual, y diseño de juegos al tener una posición de programador? Y ¿Por qué?', NULL, NULL),
(54, 1, 2, 3, 'Conocer elementos básicos del editor;Optimización;Físicas;Inteligencia artificial;Lógica del juego;Crear un ejecutable', 'Al usar el motor gráfico, ¿qué áreas el empleado necesitaría desarrollarse mejor previamente al trabajo?', NULL, NULL),
(55, 1, 2, 3, 'Desarrollo en PC;Desarrollo Móvil;Realidad aumentada;Realidad virtual', '¿Qué tipo de desarrollo sería mejor enfocar para que el empleado tenga un mejor desempeño en el trabajo?', NULL, NULL),
(56, 1, 2, 2, NULL, '¿Si pudiera sugerir una nueva materia en la especialidad de Interacción y videojuegos cual sería?', NULL, NULL),
(57, 1, 4, 1, NULL, '¿Qué tan bueno es utilizando PHP? Siendo 1 nada bueno y 7 muy bueno.', NULL, NULL),
(59, 1, 4, 3, 'Laravel;Bootstrap;JQUERY;APIs', '¿Qué herramientas de desarrollo web domina el empleado?', NULL, NULL),
(60, 1, 4, 2, NULL, '¿Qué temas de desarrollo web considera necesarios que se enseñen?', NULL, NULL),
(61, 1, 5, 1, NULL, '¿El empleado sabe analizar algoritmos complejos? siendo 1 no sabe y 7 que si lo sabe hacer bien y de forma detallada y especifica', NULL, NULL),
(62, 1, 5, 3, 'Apuntadores;Grafos;Listas enlazadas;Árboles binarios;Árboles multicaminos', '¿Qué temas de estructuras de datos necesita reforzar?', NULL, NULL),
(63, 1, 5, 2, NULL, '¿Qué nueva materia o temas sugeriría dentro del campo de la algoritmia para que un empleado tenga mejor desempeño?', NULL, NULL),
(64, 1, 6, 3, 'Lógica y sistemas digitales;Ensambladores;Arquitectura de sistema de memoria;Representación de registros y arreglos', '¿Qué temas de arquitectura de computadoras considera necesarios?', NULL, NULL),
(65, 1, 6, 3, 'Estructuras de los sistemas operativos;Procesos e hilos;Planificación del procesador;Sincronización de procesos;Interbloqueos', 'En cuanto a sistemas operativos, ¿qué temas de los siguientes considera fundamentales?', NULL, NULL),
(66, 1, 6, 2, NULL, '¿Qué otra materia o temas dentro del desarrollo de software de base sugiere se enseñen?', NULL, NULL),
(67, 1, 7, 1, NULL, '¿Qué tanto domina el empleado temas de ingeniería de software? Siendo 1 que no lo domina, y 7 que si lo domina muy bien', NULL, NULL),
(68, 1, 7, 2, NULL, '¿Qué temas de bases de datos se necesitan reforzar? y ¿por qué?', NULL, NULL),
(69, 1, 7, 2, NULL, '¿Qué otra materia o temas dentro del desarrollo de software de aplicación sugiere se enseñen?', NULL, NULL),
(70, 1, 8, 2, NULL, '¿Qué habilidades blandas requiere tener el empleado?', NULL, NULL),
(71, 1, 8, 2, NULL, '¿El empleado sabe trabajar en equipo?', NULL, NULL),
(72, 1, 8, 1, NULL, '¿El empleado toma alguna una forma de liderazgo en el trabajo o proyectos que realiza? Siendo 1 que no lo tiene y 7 que siempre toma liderazgo en lo que hace', NULL, NULL),
(73, 1, 9, 3, 'Inglés;Alemán;Francés;Italiano;Cantonés;Portugués', '¿Qué lenguas extranjeras requiere saber el empleado?', NULL, NULL),
(74, 1, 9, 3, 'Algebra;Cálculo;Probabilidad y estadística;Teoría de Grafos', '¿Qué temas de matemáticas son necesarios?', NULL, NULL),
(75, 1, 9, 1, NULL, '¿Qué tan bueno es el inglés del empleado? Siendo 1 muy malo y 7 muy fluido', NULL, NULL),
(76, 1, 9, 1, NULL, '¿El empleado entiende el vocabulario en inglés en temas de computación? Siendo 1 casi no lo comprende y 7 que lo domina', NULL, NULL),
(77, 1, 8, 3, 'Sí;No', '¿Tiene capacidad gerenciales?', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pregunta_encuesta`
--

CREATE TABLE `pregunta_encuesta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pregunta_id` bigint(20) UNSIGNED NOT NULL,
  `encuesta_id` bigint(20) UNSIGNED NOT NULL,
  `respuesta` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pregunta_encuesta`
--

INSERT INTO `pregunta_encuesta` (`id`, `created_at`, `updated_at`, `pregunta_id`, `encuesta_id`, `respuesta`) VALUES
(76, NULL, NULL, 70, 109, NULL),
(77, NULL, NULL, 73, 109, NULL),
(78, NULL, NULL, 74, 109, NULL),
(85, NULL, '2024-01-07 08:38:47', 42, 112, 'Gazebo;Player Project;A-Workshop'),
(86, NULL, '2024-01-07 08:38:50', 43, 112, 'Método de geometría analítica'),
(87, NULL, '2024-01-07 08:39:00', 46, 112, '6'),
(88, NULL, NULL, 42, 113, NULL),
(89, NULL, NULL, 43, 113, NULL),
(90, NULL, NULL, 46, 113, NULL),
(91, NULL, '2024-01-07 08:41:47', 42, 114, 'Gazebo;Player Project;Webots'),
(92, NULL, '2024-01-07 08:52:43', 43, 114, 'Método de Jacobianos;Método de cinemática algebraica'),
(93, NULL, '2024-01-07 08:52:46', 46, 114, '4'),
(94, NULL, '2024-01-07 08:54:21', 42, 115, 'Webots'),
(95, NULL, '2024-01-07 08:54:25', 43, 115, 'Método de matrices de transformación homogénea'),
(96, NULL, '2024-01-07 08:54:29', 46, 115, '7'),
(97, NULL, '2024-01-08 06:16:11', 42, 116, 'Gazebo;Webots;A-Workshop'),
(98, NULL, '2024-01-08 06:43:02', 46, 116, '5'),
(99, NULL, '2024-01-08 06:46:00', 47, 116, 'Le falta practicar mas ejercicios');

-- --------------------------------------------------------

--
-- Table structure for table `respuesta`
--

CREATE TABLE `respuesta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pregunta` bigint(20) NOT NULL,
  `respuesta` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `respuesta`
--

INSERT INTO `respuesta` (`id`, `id_pregunta`, `respuesta`, `created_at`, `updated_at`) VALUES
(1, 5, '6', NULL, NULL),
(2, 8, '5', NULL, NULL),
(3, 7, '7', NULL, NULL),
(4, 4, '6', NULL, NULL),
(5, 6, '7', NULL, NULL),
(6, 16, '5', NULL, NULL),
(7, 13, '4', NULL, NULL),
(8, 12, '6', NULL, NULL),
(9, 11, '7', NULL, NULL),
(10, 1, '4', NULL, NULL),
(11, 8, '5', NULL, NULL),
(12, 6, '7', NULL, NULL),
(13, 5, '4', NULL, NULL),
(14, 24, '6', NULL, NULL),
(15, 22, '4', NULL, NULL),
(16, 23, '7', NULL, NULL),
(17, 25, '6', NULL, NULL),
(18, 25, '7', NULL, NULL),
(19, 5, '5', NULL, NULL),
(20, 7, '6', NULL, NULL),
(21, 6, '6', NULL, NULL),
(22, 8, '3', NULL, NULL),
(23, 5, '7', NULL, NULL),
(24, 7, '5', NULL, NULL),
(25, 4, '7', NULL, NULL),
(26, 22, '3', NULL, NULL),
(27, 22, '6', NULL, NULL),
(28, 22, '7', NULL, NULL),
(29, 22, '7', NULL, NULL),
(30, 5, '7', NULL, NULL),
(31, 8, '5', NULL, NULL),
(32, 4, '6', NULL, NULL),
(33, 6, '7', NULL, NULL),
(34, 7, '5', NULL, NULL),
(35, 30, '0', NULL, NULL),
(36, 27, '7', NULL, NULL),
(37, 31, '4', NULL, NULL),
(38, 28, '6', NULL, NULL),
(39, 29, '7', NULL, NULL),
(40, 5, '6', NULL, NULL),
(41, 6, '4', NULL, NULL),
(42, 6, '7', NULL, NULL),
(43, 6, '5', NULL, NULL),
(44, 6, '4', NULL, NULL),
(45, 6, '6', NULL, NULL),
(46, 6, '7', NULL, NULL),
(47, 7, '7', NULL, NULL),
(48, 7, '4', NULL, NULL),
(49, 7, '4', NULL, NULL),
(50, 7, '4', NULL, NULL),
(51, 7, '0', NULL, NULL),
(52, 7, '0', NULL, NULL),
(53, 7, '0', NULL, NULL),
(54, 7, '0', NULL, NULL),
(55, 7, '0', NULL, NULL),
(56, 5, '0', NULL, NULL),
(57, 5, '6', NULL, NULL),
(58, 4, '7', NULL, NULL),
(59, 4, '7', NULL, NULL),
(60, 4, '6', NULL, NULL),
(61, 4, '7', NULL, NULL),
(62, 4, '6', NULL, NULL),
(63, 4, '6', NULL, NULL),
(64, 4, '6', NULL, NULL),
(65, 4, '6', NULL, NULL),
(66, 4, '6', NULL, NULL),
(67, 4, '6', NULL, NULL),
(68, 4, '6', NULL, NULL),
(69, 8, '0', NULL, NULL),
(70, 4, '6', NULL, NULL),
(71, 6, '7', NULL, NULL),
(72, 4, '5', NULL, NULL),
(73, 6, '7', NULL, NULL),
(74, 6, '7', NULL, NULL),
(75, 5, '7', NULL, NULL),
(76, 6, '5', NULL, NULL),
(77, 7, '6', NULL, NULL),
(78, 8, '4', NULL, NULL),
(79, 4, '7', NULL, NULL),
(80, 25, '4', NULL, NULL),
(81, 24, '6', NULL, NULL),
(82, 22, '3', NULL, NULL),
(83, 23, '7', NULL, NULL),
(84, 5, '7', NULL, NULL),
(85, 8, '6', NULL, NULL),
(86, 7, '7', NULL, NULL),
(87, 6, '6', NULL, NULL),
(88, 4, '7', NULL, NULL),
(89, 31, '7', NULL, NULL),
(90, 30, '5', NULL, NULL),
(91, 29, '6', NULL, NULL),
(92, 26, '7', NULL, NULL),
(93, 7, '7', NULL, NULL),
(94, 8, '6', NULL, NULL),
(95, 5, '7', NULL, NULL),
(96, 6, '6', NULL, NULL),
(97, 4, '7', NULL, NULL),
(98, 1, '6', NULL, NULL),
(99, 12, '7', NULL, NULL),
(100, 14, '5', NULL, NULL),
(101, 10, '7', NULL, NULL),
(102, 4, '7', NULL, NULL),
(103, 8, '6', NULL, NULL),
(104, 6, '7', NULL, NULL),
(105, 7, '5', NULL, NULL),
(106, 5, '7', NULL, NULL),
(107, 27, '5', NULL, NULL),
(108, 26, '7', NULL, NULL),
(109, 32, '6', NULL, NULL),
(110, 31, '3', NULL, NULL),
(111, 7, '7', NULL, NULL),
(112, 4, '5', NULL, NULL),
(113, 6, '6', NULL, NULL),
(114, 5, '7', NULL, NULL),
(115, 8, '5', NULL, NULL),
(116, 7, '7', NULL, NULL),
(117, 6, '5', NULL, NULL),
(118, 5, '6', NULL, NULL),
(119, 8, '4', NULL, NULL),
(120, 4, '5', NULL, NULL),
(121, 23, '6', NULL, NULL),
(122, 22, '5', NULL, NULL),
(123, 25, '7', NULL, NULL),
(124, 24, '4', NULL, NULL),
(125, 5, '6', NULL, NULL),
(126, 6, '5', NULL, NULL),
(127, 7, '7', NULL, NULL),
(128, 8, '4', NULL, NULL),
(129, 4, '6', NULL, NULL),
(130, 29, '5', NULL, NULL),
(131, 31, '6', NULL, NULL),
(132, 32, '7', NULL, NULL),
(133, 27, '5', NULL, NULL),
(134, 6, '6', NULL, NULL),
(135, 4, '5', NULL, NULL),
(136, 7, '7', NULL, NULL),
(137, 5, '6', NULL, NULL),
(138, 8, '4', NULL, NULL),
(139, 18, '7', NULL, NULL),
(140, 8, '7', NULL, NULL),
(141, 4, '5', NULL, NULL),
(142, 5, '6', NULL, NULL),
(143, 6, '4', NULL, NULL),
(144, 7, '7', NULL, NULL),
(145, 18, '6', NULL, NULL),
(146, 21, '5', NULL, NULL),
(147, 20, '4', NULL, NULL),
(148, 17, '7', NULL, NULL),
(149, 7, '6', NULL, NULL),
(150, 6, '4', NULL, NULL),
(151, 4, '7', NULL, NULL),
(152, 5, '6', NULL, NULL),
(153, 8, '6', NULL, NULL),
(154, 18, '4', NULL, NULL),
(155, 17, '6', NULL, NULL),
(156, 19, '7', NULL, NULL),
(157, 21, '5', NULL, NULL),
(158, 6, '6', NULL, NULL),
(159, 7, '7', NULL, NULL),
(160, 8, '5', NULL, NULL),
(161, 5, '6', NULL, NULL),
(162, 4, '5', NULL, NULL),
(163, 15, '6', NULL, NULL),
(164, 11, '7', NULL, NULL),
(165, 14, '5', NULL, NULL),
(166, 1, '6', NULL, NULL),
(167, 5, '6', NULL, NULL),
(168, 7, '4', NULL, NULL),
(169, 4, '7', NULL, NULL),
(170, 6, '4', NULL, NULL),
(171, 4, '6', NULL, NULL),
(172, 7, '7', NULL, NULL),
(173, 8, '0', NULL, NULL),
(174, 5, '5', NULL, NULL),
(175, 17, '5', NULL, NULL),
(176, 19, '7', NULL, NULL),
(177, 5, '7', NULL, NULL),
(178, 4, '6', NULL, NULL),
(179, 7, '6', NULL, NULL),
(180, 6, '6', NULL, NULL),
(181, 8, '6', NULL, NULL),
(182, 16, '7', NULL, NULL),
(183, 11, '4', NULL, NULL),
(184, 10, '6', NULL, NULL),
(185, 14, '5', NULL, NULL),
(186, 5, '1', NULL, NULL),
(187, 6, '7', NULL, NULL),
(188, 4, '5', NULL, NULL),
(189, 7, '4', NULL, NULL),
(190, 44, '7', NULL, NULL),
(191, 44, '7', NULL, NULL),
(192, 44, '7', NULL, NULL),
(193, 44, '7', NULL, NULL),
(194, 42, '6', NULL, NULL),
(195, 63, '7', NULL, NULL),
(196, 57, '7', NULL, NULL),
(197, 43, '6', NULL, NULL),
(198, 53, '6', NULL, NULL),
(199, 56, '5', NULL, NULL),
(200, 43, '6', NULL, NULL),
(201, 42, '6', NULL, NULL),
(202, 48, '6', NULL, NULL),
(203, 66, '6', NULL, NULL),
(204, 69, '6', NULL, NULL),
(205, 52, '4', NULL, NULL),
(206, 43, '4', NULL, NULL),
(207, 59, '6', NULL, NULL),
(208, 60, '6', NULL, NULL),
(209, 57, '6', NULL, NULL),
(210, 57, '6', NULL, NULL),
(211, 62, '5', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `respuesta_encuesta`
--

CREATE TABLE `respuesta_encuesta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_encuesta` bigint(20) NOT NULL,
  `id_respuesta` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `respuesta_encuesta`
--

INSERT INTO `respuesta_encuesta` (`id`, `id_encuesta`, `id_respuesta`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 1, 5, NULL, NULL),
(6, 1, 6, NULL, NULL),
(7, 1, 7, NULL, NULL),
(8, 1, 8, NULL, NULL),
(9, 1, 9, NULL, NULL),
(10, 1, 10, NULL, NULL),
(11, 6, 11, NULL, NULL),
(12, 6, 12, NULL, NULL),
(13, 6, 13, NULL, NULL),
(14, 6, 14, NULL, NULL),
(15, 6, 15, NULL, NULL),
(16, 6, 16, NULL, NULL),
(17, 6, 17, NULL, NULL),
(18, 6, 18, NULL, NULL),
(19, 7, 19, NULL, NULL),
(20, 7, 20, NULL, NULL),
(21, 8, 21, NULL, NULL),
(22, 8, 22, NULL, NULL),
(23, 8, 23, NULL, NULL),
(24, 8, 24, NULL, NULL),
(25, 8, 25, NULL, NULL),
(26, 8, 26, NULL, NULL),
(27, 8, 27, NULL, NULL),
(28, 8, 28, NULL, NULL),
(29, 8, 29, NULL, NULL),
(30, 9, 30, NULL, NULL),
(31, 9, 31, NULL, NULL),
(32, 9, 32, NULL, NULL),
(33, 9, 33, NULL, NULL),
(34, 9, 34, NULL, NULL),
(35, 9, 35, NULL, NULL),
(36, 9, 36, NULL, NULL),
(37, 9, 37, NULL, NULL),
(38, 9, 38, NULL, NULL),
(39, 9, 39, NULL, NULL),
(40, 11, 40, NULL, NULL),
(41, 12, 69, NULL, NULL),
(42, 12, 70, NULL, NULL),
(43, 12, 71, NULL, NULL),
(44, 12, 72, NULL, NULL),
(45, 12, 73, NULL, NULL),
(46, 12, 74, NULL, NULL),
(47, 13, 75, NULL, NULL),
(48, 13, 76, NULL, NULL),
(49, 13, 77, NULL, NULL),
(50, 13, 78, NULL, NULL),
(51, 13, 79, NULL, NULL),
(52, 13, 80, NULL, NULL),
(53, 13, 81, NULL, NULL),
(54, 13, 82, NULL, NULL),
(55, 13, 83, NULL, NULL),
(56, 14, 84, NULL, NULL),
(57, 14, 85, NULL, NULL),
(58, 14, 86, NULL, NULL),
(59, 14, 87, NULL, NULL),
(60, 14, 88, NULL, NULL),
(61, 14, 89, NULL, NULL),
(62, 14, 90, NULL, NULL),
(63, 14, 91, NULL, NULL),
(64, 14, 92, NULL, NULL),
(65, 15, 93, NULL, NULL),
(66, 15, 94, NULL, NULL),
(67, 15, 95, NULL, NULL),
(68, 15, 96, NULL, NULL),
(69, 15, 97, NULL, NULL),
(70, 15, 98, NULL, NULL),
(71, 15, 99, NULL, NULL),
(72, 15, 100, NULL, NULL),
(73, 15, 101, NULL, NULL),
(74, 16, 102, NULL, NULL),
(75, 16, 103, NULL, NULL),
(76, 16, 104, NULL, NULL),
(77, 16, 105, NULL, NULL),
(78, 16, 106, NULL, NULL),
(79, 16, 107, NULL, NULL),
(80, 16, 108, NULL, NULL),
(81, 16, 109, NULL, NULL),
(82, 16, 110, NULL, NULL),
(83, 17, 111, NULL, NULL),
(84, 17, 112, NULL, NULL),
(85, 17, 113, NULL, NULL),
(86, 17, 114, NULL, NULL),
(87, 17, 115, NULL, NULL),
(88, 17, 116, NULL, NULL),
(89, 17, 117, NULL, NULL),
(90, 17, 118, NULL, NULL),
(91, 17, 119, NULL, NULL),
(92, 17, 120, NULL, NULL),
(93, 17, 121, NULL, NULL),
(94, 17, 122, NULL, NULL),
(95, 17, 123, NULL, NULL),
(96, 17, 124, NULL, NULL),
(97, 17, 125, NULL, NULL),
(98, 17, 126, NULL, NULL),
(99, 17, 127, NULL, NULL),
(100, 17, 128, NULL, NULL),
(101, 17, 129, NULL, NULL),
(102, 17, 130, NULL, NULL),
(103, 17, 131, NULL, NULL),
(104, 17, 132, NULL, NULL),
(105, 17, 133, NULL, NULL),
(106, 14, 134, NULL, NULL),
(107, 14, 135, NULL, NULL),
(108, 14, 136, NULL, NULL),
(109, 14, 137, NULL, NULL),
(110, 14, 138, NULL, NULL),
(111, 14, 139, NULL, NULL),
(112, 18, 140, NULL, NULL),
(113, 18, 141, NULL, NULL),
(114, 18, 142, NULL, NULL),
(115, 18, 143, NULL, NULL),
(116, 18, 144, NULL, NULL),
(117, 18, 145, NULL, NULL),
(118, 18, 146, NULL, NULL),
(119, 18, 147, NULL, NULL),
(120, 18, 148, NULL, NULL),
(121, 19, 149, NULL, NULL),
(122, 19, 150, NULL, NULL),
(123, 19, 151, NULL, NULL),
(124, 19, 152, NULL, NULL),
(125, 19, 153, NULL, NULL),
(126, 19, 154, NULL, NULL),
(127, 19, 155, NULL, NULL),
(128, 19, 156, NULL, NULL),
(129, 19, 157, NULL, NULL),
(130, 20, 158, NULL, NULL),
(131, 20, 159, NULL, NULL),
(132, 20, 160, NULL, NULL),
(133, 20, 161, NULL, NULL),
(134, 20, 162, NULL, NULL),
(135, 20, 163, NULL, NULL),
(136, 20, 164, NULL, NULL),
(137, 20, 165, NULL, NULL),
(138, 20, 166, NULL, NULL),
(139, 22, 167, NULL, NULL),
(140, 22, 168, NULL, NULL),
(141, 22, 169, NULL, NULL),
(142, 22, 170, NULL, NULL),
(143, 22, 171, NULL, NULL),
(144, 22, 172, NULL, NULL),
(145, 22, 173, NULL, NULL),
(146, 22, 174, NULL, NULL),
(147, 22, 175, NULL, NULL),
(148, 22, 176, NULL, NULL),
(149, 29, 177, NULL, NULL),
(150, 29, 178, NULL, NULL),
(151, 29, 179, NULL, NULL),
(152, 29, 180, NULL, NULL),
(153, 29, 181, NULL, NULL),
(154, 29, 182, NULL, NULL),
(155, 29, 183, NULL, NULL),
(156, 29, 184, NULL, NULL),
(157, 29, 185, NULL, NULL),
(158, 64, 186, NULL, NULL),
(159, 64, 187, NULL, NULL),
(160, 64, 188, NULL, NULL),
(161, 64, 189, NULL, NULL),
(162, 67, 190, NULL, NULL),
(163, 67, 191, NULL, NULL),
(164, 67, 192, NULL, NULL),
(165, 67, 193, NULL, NULL),
(166, 67, 194, NULL, NULL),
(167, 68, 195, NULL, NULL),
(168, 68, 196, NULL, NULL),
(169, 68, 197, NULL, NULL),
(170, 68, 198, NULL, NULL),
(171, 68, 199, NULL, NULL),
(172, 68, 200, NULL, NULL),
(173, 68, 201, NULL, NULL),
(174, 70, 202, NULL, NULL),
(175, 70, 203, NULL, NULL),
(176, 70, 204, NULL, NULL),
(177, 70, 205, NULL, NULL),
(178, 70, 206, NULL, NULL),
(179, 70, 207, NULL, NULL),
(180, 70, 208, NULL, NULL),
(181, 70, 209, NULL, NULL),
(182, 70, 210, NULL, NULL),
(183, 73, 211, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tema`
--

CREATE TABLE `tema` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_area` bigint(20) NOT NULL,
  `tema` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tema`
--

INSERT INTO `tema` (`id`, `id_area`, `tema`, `created_at`, `updated_at`) VALUES
(1, 1, 'Robótica Inteligente e Inteligencia Artifical ', '2021-11-13 23:17:58', '2023-10-12 21:33:12'),
(2, 1, 'Interacción y Videojuegos', '2021-11-13 23:17:58', '2023-10-12 21:34:57'),
(3, 1, 'Ciberseguridad', '2021-11-13 23:17:58', '2023-10-12 21:35:17'),
(4, 1, 'Desarrollo Web y Multiplataforma', '2021-11-13 23:17:58', '2023-10-12 21:35:39'),
(5, 1, 'Algoritmia ', '2021-11-28 01:41:48', '2023-11-29 05:35:15'),
(6, 1, 'Desarrollo de Software Base', '2023-10-12 21:38:56', '2023-10-12 21:38:56'),
(7, 1, 'Desarrollo de Software de Aplicación', '2023-10-12 21:40:11', '2023-10-12 21:40:11'),
(8, 1, 'Habilidades Blandas', '2023-10-12 21:40:31', '2023-10-12 21:40:31'),
(9, 1, 'Habilidades Duras', '2023-10-12 21:40:48', '2023-11-28 03:40:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_area` bigint(20) NOT NULL DEFAULT 1,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_area`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Eduardo', 'eduardo@gmail.com', NULL, '$2y$10$NnajBIegATntlzeebX9PuuRZ3lhTfRQmZNGpQH.XbGcY34IuYcnCi', NULL, '2021-11-14 05:18:43', '2021-11-14 05:18:43'),
(2, 1, 'admin', 'correo@gmail.com', NULL, '$2y$10$3aWCmX9G./0jSbdSs8.sEeJTgqE0e8DFCiL9YokSZcpNSrvK2JJEW', '1RPpfw5i9F08to8a7fLijtclrYFKBHCCCMDl8ce7GsqQteh5ecTbppteV4Go', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `metrica_evaluacion`
--
ALTER TABLE `metrica_evaluacion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pregunta_encuesta`
--
ALTER TABLE `pregunta_encuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pregunta_encuesta_pregunta_id_foreign` (`pregunta_id`),
  ADD KEY `pregunta_encuesta_encuesta_id_foreign` (`encuesta_id`);

--
-- Indexes for table `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `respuesta_encuesta`
--
ALTER TABLE `respuesta_encuesta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `metrica_evaluacion`
--
ALTER TABLE `metrica_evaluacion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `pregunta_encuesta`
--
ALTER TABLE `pregunta_encuesta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `respuesta_encuesta`
--
ALTER TABLE `respuesta_encuesta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `tema`
--
ALTER TABLE `tema`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pregunta_encuesta`
--
ALTER TABLE `pregunta_encuesta`
  ADD CONSTRAINT `pregunta_encuesta_encuesta_id_foreign` FOREIGN KEY (`encuesta_id`) REFERENCES `encuesta` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pregunta_encuesta_pregunta_id_foreign` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
