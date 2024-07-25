-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-01-2024 a las 01:40:47
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
-- Base de datos: `siees`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id`, `area`, `created_at`, `updated_at`) VALUES
(1, 'Computación', NULL, NULL),
(2, 'Humanidades', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
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
-- Volcado de datos para la tabla `encuesta`
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
-- Estructura de tabla para la tabla `failed_jobs`
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
-- Estructura de tabla para la tabla `metrica_evaluacion`
--

CREATE TABLE `metrica_evaluacion` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `metrica_evaluacion`
--

INSERT INTO `metrica_evaluacion` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Escala de Likert', 'Permite conocer el nivel de acuerdo y desacuerdo de las personas sobre un tema.', NULL, NULL),
(2, 'Abierta', 'Respuesta libre.', NULL, NULL),
(3, 'Opción múltiple', 'Diversas opciones, sin ser parte de una escala.', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
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
(53, '2023_11_29_094838_create_pregunta_encuesta_table', 5),
(54, '2024_01_08_235349_drop_unused_tables', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('correo@gmail.com', '$2y$10$R6Nbw1XYBju77B6GP..IYeWMlb8ZN/yNC5Ppsw4F6oPW2yeB7z08W', '2024-01-07 07:55:27'),
('correo@gmail.com', '$2y$10$R6Nbw1XYBju77B6GP..IYeWMlb8ZN/yNC5Ppsw4F6oPW2yeB7z08W', '2024-01-07 07:55:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
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
-- Estructura de tabla para la tabla `pregunta`
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
-- Volcado de datos para la tabla `pregunta`
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
-- Estructura de tabla para la tabla `pregunta_encuesta`
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
-- Volcado de datos para la tabla `pregunta_encuesta`
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
-- Estructura de tabla para la tabla `tema`
--

CREATE TABLE `tema` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_area` bigint(20) NOT NULL,
  `tema` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tema`
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
-- Estructura de tabla para la tabla `users`
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
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `id_area`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(24, 1, 'Héctor Gámez González (ISI 2018)', 'A295210@alumnos.uaslp.mx', NULL, '$2y$10$/2MQUGXxCFzZ1VnsYlJ.bu2T5PgU3omChXUkIJuuk/hNty80Yn5KO', NULL, '2024-01-21 06:26:55', '2024-01-21 06:26:55'),
(25, 1, 'Francisco Jacob Flores Rodríguez (ISI 2018)', 'A291423@alumnos.uaslp.mx', NULL, '$2y$10$9OcmG2r.EEAoE.TdtiRV4uY6vSfLFaEniZh1V/Cdkp2uRKkgjnoje', NULL, '2024-01-21 06:26:55', '2024-01-21 06:26:55'),
(26, 1, 'Omar Vital Ochoa', 'ovital@uaslp.mx', NULL, '$2y$10$iTK/MU0ACPHTO/6Lmycq3OO0yZ7Qi/imThiUHNEiU7QftqtHsLllu', NULL, '2024-01-21 06:26:55', '2024-01-21 06:26:55'),
(27, 1, 'Francisco Edgar Castillo Barrera', 'ecastillo@uaslp.mx', NULL, '$2y$10$v2qU7wQUQMOCSwDop4EmquY6ukEuNrRGSGLqRCbFiZU18jievJj0G', NULL, '2024-01-21 06:26:55', '2024-01-21 06:26:55'),
(28, 1, 'Francisco Eduardo Martínez Pérez', 'eduardo.perez@uaslp.mx', NULL, '$2y$10$ghe0iCFRIhT/5hNMFhghUe8AFOsQILG02047u4tmk5ESRglm5WSPi', NULL, '2024-01-21 06:26:55', '2024-01-21 06:26:55'),
(29, 1, 'Silvia Luz Vaca Rivera', 'silviav@uaslp.mx', NULL, '$2y$10$iGXNvcoZloFJM490fO/d/eUCA8P2REal6qEXtwQ50/bQnlUFapZkm', NULL, '2024-01-21 06:26:55', '2024-01-21 06:26:55'),
(30, 1, 'César Augusto Puente Montejano', 'cesar.puente@uaslp.mx', NULL, '$2y$10$kKcMAhSoAUirEKS76iR9wuzmVkpifMU35Wls0ICbFdKenyDKkzFCK', NULL, '2024-01-21 06:26:55', '2024-01-21 06:26:55');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `metrica_evaluacion`
--
ALTER TABLE `metrica_evaluacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pregunta_encuesta`
--
ALTER TABLE `pregunta_encuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pregunta_encuesta_pregunta_id_foreign` (`pregunta_id`),
  ADD KEY `pregunta_encuesta_encuesta_id_foreign` (`encuesta_id`);

--
-- Indices de la tabla `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `metrica_evaluacion`
--
ALTER TABLE `metrica_evaluacion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `pregunta_encuesta`
--
ALTER TABLE `pregunta_encuesta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `tema`
--
ALTER TABLE `tema`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pregunta_encuesta`
--
ALTER TABLE `pregunta_encuesta`
  ADD CONSTRAINT `pregunta_encuesta_encuesta_id_foreign` FOREIGN KEY (`encuesta_id`) REFERENCES `encuesta` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pregunta_encuesta_pregunta_id_foreign` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
