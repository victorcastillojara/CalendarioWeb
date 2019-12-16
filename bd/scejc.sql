-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-12-2019 a las 04:12:00
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `scejc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloque`
--

CREATE TABLE `bloque` (
  `id_bloque` int(11) NOT NULL,
  `bloque` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bloque`
--

INSERT INTO `bloque` (`id_bloque`, `bloque`) VALUES
(1, '8:00 a 9:30'),
(2, '9:45 a 11:15'),
(3, '11:30 a 12:45'),
(4, '14:00 a 15:30'),
(5, '15:45 a 17:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `curso` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nivel` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cant_alumnos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id_curso`, `curso`, `nivel`, `cant_alumnos`) VALUES
(1, 'Sin Curso', 'null', 0),
(2, 'Primero A', 'Básico', 20),
(3, 'Primero B', 'Básico', 0),
(4, 'Segundo A', 'Básico', 0),
(5, 'Segundo B', 'Básico', 0),
(6, 'Tercero A', 'Básico', 0),
(7, 'Tercero B', 'Básico', 0),
(8, 'Cuarto A', 'Básico', 0),
(9, 'Cuarto B', 'Básico', 0),
(10, 'Quinto A', 'Básico', 0),
(11, 'Quinto B', 'Básico', 0),
(12, 'Sexto A', 'Básico', 0),
(13, 'Sexto B', 'Básico', 0),
(14, 'Séptimo A', 'Básico', 0),
(15, 'Séptimo B', 'Básico', 0),
(16, 'Octavo A', 'Básico', 0),
(17, 'Octavo B', 'Básico', 0),
(18, 'Primero A', 'Media', 0),
(19, 'Primero B', 'Media', 0),
(20, 'Segundo A', 'Media', 0),
(21, 'Segundo B', 'Media', 0),
(22, 'Tercero A', 'Media', 0),
(23, 'Tercero B', 'Media', 0),
(24, 'Cuarto A', 'Media', 0),
(25, 'Cuarto B', 'Media', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dia`
--

CREATE TABLE `dia` (
  `id_dia` int(11) NOT NULL,
  `dia` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dia`
--

INSERT INTO `dia` (`id_dia`, `dia`) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miércoles'),
(4, 'Jueves'),
(5, 'Viernes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `id_docente` int(11) NOT NULL,
  `rut` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente_curso`
--

CREATE TABLE `docente_curso` (
  `id_docente` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(255) NOT NULL,
  `usuario` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `curso` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `bloque` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `textColor` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id_horario` int(11) NOT NULL,
  `id_dia` int(11) NOT NULL,
  `id_bloque` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_docente` int(11) NOT NULL,
  `id_ramo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informaciones`
--

CREATE TABLE `informaciones` (
  `id_informacion` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ramo`
--

CREATE TABLE `ramo` (
  `id_ramo` int(11) NOT NULL,
  `ramo` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ramo`
--

INSERT INTO `ramo` (`id_ramo`, `ramo`) VALUES
(1, 'Lenguaje'),
(2, 'Matemática'),
(3, 'Inglés'),
(4, 'Historia'),
(5, 'Filosofía'),
(6, 'Biología'),
(7, 'Física'),
(8, 'Química'),
(9, 'Cs. Naturales'),
(10, 'Artes Visuales'),
(11, 'Artística'),
(12, 'Tecnología'),
(13, 'Música'),
(14, 'Ed. Física'),
(15, 'Religión'),
(16, 'Dif. de Lenguaje'),
(17, 'Dif. de Matemática'),
(18, 'Dif. de Ed. Física'),
(19, 'Cs. para la ciudadanía'),
(20, 'Formación cuidadana'),
(21, 'Dif. de Historia'),
(22, 'Dif. de Ciencias'),
(23, 'Vida saludable'),
(24, 'Manejo'),
(25, 'Análisis Físico Químico'),
(26, 'Procedimientos'),
(27, 'Fabricación'),
(28, 'Emprendimiento'),
(29, 'Medio ambiente'),
(30, 'Toma de muestras'),
(31, 'Mantenimiento'),
(32, 'Prep. de muestras'),
(33, 'Análisis instrumental'),
(34, 'Técnicas de laboratorio'),
(35, 'Taller de Lenguaje'),
(36, 'Taller de Matemática'),
(37, 'Taller de Computación'),
(38, 'Taller de Ecología'),
(39, 'Taller de Teatro'),
(40, 'Taller de Geometría'),
(41, 'Taller de vida saludable'),
(42, 'Taller de formación ciudadana'),
(43, 'Taller de reciclaje');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'admin'),
(2, 'docente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bloque`
--
ALTER TABLE `bloque`
  ADD PRIMARY KEY (`id_bloque`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `dia`
--
ALTER TABLE `dia`
  ADD PRIMARY KEY (`id_dia`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`id_docente`);

--
-- Indices de la tabla `docente_curso`
--
ALTER TABLE `docente_curso`
  ADD KEY `fk_curso_curso` (`id_curso`),
  ADD KEY `fk_docente_docente` (`id_docente`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id_horario`),
  ADD KEY `fk_horario_dia` (`id_dia`),
  ADD KEY `fk_horario_bloque` (`id_bloque`),
  ADD KEY `fk_horario_curso` (`id_curso`),
  ADD KEY `fk_horario_docente` (`id_docente`),
  ADD KEY `fk_horario_ramo` (`id_ramo`);

--
-- Indices de la tabla `informaciones`
--
ALTER TABLE `informaciones`
  ADD PRIMARY KEY (`id_informacion`);

--
-- Indices de la tabla `ramo`
--
ALTER TABLE `ramo`
  ADD PRIMARY KEY (`id_ramo`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_usuario_roles` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bloque`
--
ALTER TABLE `bloque`
  MODIFY `id_bloque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `dia`
--
ALTER TABLE `dia`
  MODIFY `id_dia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `informaciones`
--
ALTER TABLE `informaciones`
  MODIFY `id_informacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ramo`
--
ALTER TABLE `ramo`
  MODIFY `id_ramo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `docente_curso`
--
ALTER TABLE `docente_curso`
  ADD CONSTRAINT `fk_curso_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_docente_docente` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `fk_horario_bloque` FOREIGN KEY (`id_bloque`) REFERENCES `bloque` (`id_bloque`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_horario_curso` FOREIGN KEY (`id_curso`) REFERENCES `docente_curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_horario_dia` FOREIGN KEY (`id_dia`) REFERENCES `dia` (`id_dia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_horario_docente` FOREIGN KEY (`id_docente`) REFERENCES `docente_curso` (`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_horario_ramo` FOREIGN KEY (`id_ramo`) REFERENCES `ramo` (`id_ramo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_docente` FOREIGN KEY (`id_usuario`) REFERENCES `docente` (`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_roles` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
