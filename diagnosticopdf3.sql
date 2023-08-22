-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-08-2023 a las 13:17:16
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
-- Base de datos: `diagnosticopdf3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico`
--

CREATE TABLE `diagnostico` (
  `id` int(11) NOT NULL,
  `paciente_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `notas` longtext DEFAULT NULL,
  `borrado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `diagnostico`
--

INSERT INTO `diagnostico` (`id`, `paciente_id`, `date`, `notas`, `borrado`) VALUES
(1, 1, '2023-08-17 18:13:17', 'Llega 30 minutos antes', NULL),
(2, 1, '2023-08-18 17:06:56', 'Dolor agudo intenso desde hace 8 horas. No deposición desde hace 72 horas.', NULL),
(3, 2, '2023-08-21 17:22:20', 'El paciente no acepta su condición', NULL),
(4, 3, '2023-08-22 12:29:20', 'Sin notas', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico_pato`
--

CREATE TABLE `diagnostico_pato` (
  `diagnostico_id` int(11) NOT NULL,
  `pato_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `diagnostico_pato`
--

INSERT INTO `diagnostico_pato` (`diagnostico_id`, `pato_id`) VALUES
(1, 2),
(2, 4),
(3, 4),
(4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico_prueba`
--

CREATE TABLE `diagnostico_prueba` (
  `diagnostico_id` int(11) NOT NULL,
  `prueba_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `diagnostico_prueba`
--

INSERT INTO `diagnostico_prueba` (`diagnostico_id`, `prueba_id`) VALUES
(1, 1),
(2, 4),
(3, 4),
(4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico_trat`
--

CREATE TABLE `diagnostico_trat` (
  `diagnostico_id` int(11) NOT NULL,
  `trat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `diagnostico_trat`
--

INSERT INTO `diagnostico_trat` (`diagnostico_id`, `trat_id`) VALUES
(1, 1),
(2, 3),
(3, 2),
(4, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico_user`
--

CREATE TABLE `diagnostico_user` (
  `diagnostico_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `diagnostico_user`
--

INSERT INTO `diagnostico_user` (`diagnostico_id`, `user_id`) VALUES
(1, 1),
(2, 1),
(3, 3),
(4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `dateborn` date DEFAULT NULL,
  `dni` varchar(255) NOT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `borrado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id`, `name`, `surname`, `dateborn`, `dni`, `telefono`, `direccion`, `borrado`) VALUES
(1, 'Ana', 'Ramos', '2018-07-15', '123123sd', '123124324', 'calle Principal 11', 1),
(2, 'Benancio', 'Ortega', '2018-02-14', '134341534k', '+34622702520', 'calle Principal 11', NULL),
(3, 'Elena', 'Delgado', '2018-07-13', '342345jj', '123124324', 'C/Tardis 563', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pato`
--

CREATE TABLE `pato` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `codcie` varchar(255) DEFAULT NULL,
  `borrado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pato`
--

INSERT INTO `pato` (`id`, `titulo`, `descripcion`, `codcie`, `borrado`) VALUES
(1, 'Tuberculosis miliar aguda de un solo sitio especificado', 'Incluye: - poliserositis tuberculosas - tuberculosis diseminada - tuberculosis generalizada', 'A19.0', NULL),
(2, 'Fiebre tifoidea', 'Excluye 1: - rickettsiosis por Ehrlichia sennetsu (A79.81)', 'A75', NULL),
(3, 'Glaucoma', 'Excluye 1: - glaucoma absoluto (H44.51-) - glaucoma congénito (Q15.0) - glaucoma traumático debido a traumatismo del nacimiento (P15.3)', 'H40', NULL),
(4, 'Brucelosis', 'Incluye: - fiebre de Malta - fiebre mediterránea - fiebre ondulante', 'A23', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prueba`
--

CREATE TABLE `prueba` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` longtext DEFAULT NULL,
  `borrado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `prueba`
--

INSERT INTO `prueba` (`id`, `titulo`, `descripcion`, `borrado`) VALUES
(1, 'Análisis de la función hepática', 'Son un conjunto de pruebas bioquímicas que permiten detectar el estado de las distintas funciones del hígado.\r\n\r\nEl test de excreción se realiza para valorar la función excretora hepática y diferenciar las posibles causas de una ictericia. Se utiliza principalmente la determinación de bilirrubina en sangre. Pueden determinarse también las sales biliares, que se elevarán en sangre en casos de mala extracción biliar.\r\n\r\nTambién puede valorarse la integridad de la estructura celular asociada a esta función hepática a través de la determinación de los enzimas g-glutamil transpeptidasa (GGT), fosfatasa alcalina y 5\'-nucleotidasa, que se elevarán en sangre en casos de obstrucción biliar, consumo de alcohol o de algunos fármacos como la fenitoína.', NULL),
(2, 'Análisis diagnóstico de la diabetes mellitus', 'Son diversas pruebas diagnósticas que se realizan para determinar si se tiene o no diabetes.\r\n\r\nConsisten en la recogida de muestras de sangre u orina y en el posterior análisis para determinar los niveles de glucosa. En algunas pruebas se ingiere una cantidad determinada de glucosa y se mide la capacidad que tiene el organismo para metabolizarla.\r\n\r\nLos nuevos métodos de monitorización continua de glucosa en el espacio intersticial constituyen un gran avance en el manejo de estos pacientes.\r\n\r\nPor medio de una técnica mínimamente invasiva, como es insertar un sensor en la pared anterior del abdomen, se obtienen valores de glucosa durante aproximadamente 72 h ininterrumpidamente.\r\n\r\nEste sistema permite valorar las fluctuaciones glucémicas con el fin de mejorar el control metabólico.', NULL),
(3, 'Angiografía', 'Permite medir el flujo y la presión sanguínea de cavidades cardíacas, así como determinar si las arterias coronarias están obstruidas.\r\n\r\nEl radiólogo, ayudado por un equipo de enfermería especializado, visualiza en una pantalla especial de televisión de rayos X el transcurrir del catéter por los vasos y, cuando llega al área de interés, inyecta a través de este catéter, productos de contraste, que contienen yodo, de manera que consigue claramente delimitar los vasos y conseguir una imagen muy clara de los vasos.\r\n\r\nEn determinados casos, puede seleccionarse otra vía de acceso al torrente sanguíneo.', NULL),
(4, 'Gammagrafía nuclear', 'La gammagrafía es una prueba diagnóstica de Medicina Nuclear que consiste en la administración de una pequeña dosis de radioisótopo (trazador). Este material se distribuye por todo el organismo y los distintos órganos lo captan.\r\n\r\nDespués, se utiliza una gammacámara para detectar los rayos gamma que libera el trazador.\r\n\r\nLas más frecuentes son:\r\n\r\nGammagrafía ósea\r\nGammagrafía tiroidea', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trat`
--

CREATE TABLE `trat` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` longtext DEFAULT NULL,
  `borrado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `trat`
--

INSERT INTO `trat` (`id`, `titulo`, `descripcion`, `borrado`) VALUES
(1, 'ABACAVIR CAMBER film-coated tablet 300 mg', 'Mecanismo de acción\r\nAbacavir\r\nInhibe la transcriptasa inversa del VIH, lo que da lugar a la terminación de la cadena y a la interrupción del ciclo de replicación viral.\r\n\r\nIndicaciones terapéuticas\r\nAbacavir\r\nTto. de infección por VIH, en terapia de combinación antirretroviral. Realizar prueba de detección del alelo HLA-B*5701 antes de iniciar tto. independientemente del origen racial, y sistemáticamente antes de reiniciar tto. en sujetos en los que se desconoce el estatus HLA-B*5701 y que han tolerado abacavir anteriormente.\r\n\r\nPosología\r\nAbacavir\r\nOral. Ads. y adolescentes > 12 años: 600 mg 1 vez/día o 300 mg 2 veces/día. Niños < 12 años: con p.c. ≥ 30 kg: 300 mg 2 veces/día; con p.c. 21-30 kg: 150 mg mañana y 300 mg noche; con p.c. 14-21 kg: 150 mg 2 veces/día. Niños 3 meses-12 años: 8 mg/kg 2 veces/día, máx. 600 mg/día.', 0),
(2, 'ABILIFY DISCMELT oral lyophilisate 10 mg', 'Mecanismo de acción\r\nAripiprazol\r\nAntipsicótico. Agonista parcial de receptores D2 de dopamina y 5-HT1a de serotonina y antagonista de receptores 5-HT2a de serotonina.\r\n\r\nIndicaciones terapéuticas\r\nAripiprazol\r\nVía oral: esquizofrenia en ads. y adolescentes >15 años. Episodios maníacos moderados o severos en trastorno bipolar I en ads. y adolescentes >13 años y en la prevención de recaídas. IM liberación normal: control rápido de la agitación y alteraciones del comportamiento en esquizofrenia, cuando el tto. oral no es adecuado. IM liberación prolongada: tto. de mantenimiento en la esquizofrenia en pacientes ads. Estabilizados con aripiprazol oral.\r\n\r\nPosología\r\nAripiprazol\r\n- Oral:\r\nAds. Esquizofrenia: inicial, 10-15 mg/día; mantenimiento, 15 mg/día como dosis única diaria. Episodios maníacos en trastorno bipolar I: inicio, 15 mg como dosis única diaria. Para la prevención de las recaídas de episodios maniacos continuar con la misma dosis. Considerar ajustes de la dosis diaria, incluyendo reducción, según el estado clínico. Rango de dosis eficaz: 10-30 mg/día', 0),
(3, 'ABREVA cream 10%', 'Mecanismo de acción\r\nDocosanol\r\nSe desconoce el mecanismo exacto de la actividad antiviral del docosanol. Los estudios in vitro indican que afecta a la fusión entre el virus y la membrana plasmática, lo que inhibe la captación intracelular y la replicación del virus. Estudios in vitro muestran que las células tratadas con docosanol resisten la infección por virus con cubierta lipídica como el VHS-1. El docosanol carece de efecto frente a los virus sin cubierta.\r\n\r\nIndicaciones terapéuticas\r\nDocosanol\r\nTto. de fases iniciales (fases de pródromo o eritema) de la infección del herpes simple labial recurrente en inmunocompetentes ads. y adolescentes (> 12 años).\r\n\r\nPosología\r\nDocosanol\r\nTópica, ads. y adolescentes (12-18 años): 1 aplic. 5 veces/día (aproximadamente cada 3 h durante las horas de vigilia), durante 4-6 días, máx. 10 días.', 0),
(4, 'PHAZYME capsule, soft 180 mg', 'ATC: Siliconas\r\n\r\nTracto alimentario y metabolismo  >  Agentes contra padecimientos funcionales del estómago e intestino  >  Agentes contra padecimientos funcionales gastrointestinales  >  Otros agentes contra padecimientos funcionales gastrointestinales\r\n\r\n\r\nMecanismo de acción\r\nSiliconas\r\nEnzimas digestivas que favorecen el proceso digestivo normal de los alimentos, evitando que queden alimentos parcialmente digeridos y la simeticona disminuye la liberación de gases por vías naturales, evitando así molestias gástricas y flatulencia, asociadas a una digestión no completa y a un aumento de gases', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `borrado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `email`, `telefono`, `direccion`, `borrado`) VALUES
(1, 'pepe', '[]', '$2y$13$LhkP2P010GqMolT6lZgyTeOx53jlUAYN/pf5cHK6UgL40CknOGCGq', 'pepe2@pepe.es', '65648837', 'calle Principal 11', NULL),
(2, 'medico1', '[]', '$2y$13$AKsDs4Kb.H4wHIagVm6JLeUTpUC2ebbKNEqU9TP6B/0g2lbt4dyKi', 'medico1@gmail.com', '28924324', 'calle Principal 11', 1),
(3, 'Dr. House', '[]', '$2y$13$PhDmSKy99w6Wr2JTGllxcOaT4uoZurNEiVMlxYY2omWwvLqXEhFKO', 'houseinthahouse@gmail.com', '23244', 'C/Tardis 56', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9B91D4487310DAD4` (`paciente_id`);

--
-- Indices de la tabla `diagnostico_pato`
--
ALTER TABLE `diagnostico_pato`
  ADD PRIMARY KEY (`diagnostico_id`,`pato_id`),
  ADD KEY `IDX_67C4D2E77A94BA1A` (`diagnostico_id`),
  ADD KEY `IDX_67C4D2E744BB6ED2` (`pato_id`);

--
-- Indices de la tabla `diagnostico_prueba`
--
ALTER TABLE `diagnostico_prueba`
  ADD PRIMARY KEY (`diagnostico_id`,`prueba_id`),
  ADD KEY `IDX_C72EF4E27A94BA1A` (`diagnostico_id`),
  ADD KEY `IDX_C72EF4E2E7DE889A` (`prueba_id`);

--
-- Indices de la tabla `diagnostico_trat`
--
ALTER TABLE `diagnostico_trat`
  ADD PRIMARY KEY (`diagnostico_id`,`trat_id`),
  ADD KEY `IDX_4B1677617A94BA1A` (`diagnostico_id`),
  ADD KEY `IDX_4B1677611AAEF298` (`trat_id`);

--
-- Indices de la tabla `diagnostico_user`
--
ALTER TABLE `diagnostico_user`
  ADD PRIMARY KEY (`diagnostico_id`,`user_id`),
  ADD KEY `IDX_7F671A027A94BA1A` (`diagnostico_id`),
  ADD KEY `IDX_7F671A02A76ED395` (`user_id`);

--
-- Indices de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pato`
--
ALTER TABLE `pato`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prueba`
--
ALTER TABLE `prueba`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trat`
--
ALTER TABLE `trat`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pato`
--
ALTER TABLE `pato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `prueba`
--
ALTER TABLE `prueba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `trat`
--
ALTER TABLE `trat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD CONSTRAINT `FK_9B91D4487310DAD4` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`);

--
-- Filtros para la tabla `diagnostico_pato`
--
ALTER TABLE `diagnostico_pato`
  ADD CONSTRAINT `FK_67C4D2E744BB6ED2` FOREIGN KEY (`pato_id`) REFERENCES `pato` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_67C4D2E77A94BA1A` FOREIGN KEY (`diagnostico_id`) REFERENCES `diagnostico` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `diagnostico_prueba`
--
ALTER TABLE `diagnostico_prueba`
  ADD CONSTRAINT `FK_C72EF4E27A94BA1A` FOREIGN KEY (`diagnostico_id`) REFERENCES `diagnostico` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C72EF4E2E7DE889A` FOREIGN KEY (`prueba_id`) REFERENCES `prueba` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `diagnostico_trat`
--
ALTER TABLE `diagnostico_trat`
  ADD CONSTRAINT `FK_4B1677611AAEF298` FOREIGN KEY (`trat_id`) REFERENCES `trat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4B1677617A94BA1A` FOREIGN KEY (`diagnostico_id`) REFERENCES `diagnostico` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `diagnostico_user`
--
ALTER TABLE `diagnostico_user`
  ADD CONSTRAINT `FK_7F671A027A94BA1A` FOREIGN KEY (`diagnostico_id`) REFERENCES `diagnostico` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_7F671A02A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
