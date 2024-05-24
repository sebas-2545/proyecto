-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2024 a las 00:14:31
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
-- Base de datos: `recuperar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intructores`
--

CREATE TABLE `intructores` (
  `id` int(11) NOT NULL,
  `name` varchar(29) NOT NULL,
  `identificaion` varchar(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `id_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `intructores`
--

INSERT INTO `intructores` (`id`, `name`, `identificaion`, `correo`, `telefono`, `id_rol`) VALUES
(1, 'Juan Pérez', '123', 'juan@example.com', '318272', 3),
(2, 'María González', '0987654321', 'maria@example.com', '3715272', 3),
(3, 'sebastian Martínez', '1357924680', 'carlos@example.com', '3816387', 3),
(4, 'Ana Rodríguez', '2468013579', 'ana@example.com', '3917372', 3),
(5, 'Laura Sánchez', '9876543210', 'laura@example.com', '31888328', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registroetapaproductiva`
--

CREATE TABLE `registroetapaproductiva` (
  `Id` int(11) NOT NULL,
  `FechaRegistro` date DEFAULT NULL,
  `NumeroDocumentoIdentidad` varchar(20) DEFAULT NULL,
  `NombreCompleto` varchar(100) DEFAULT NULL,
  `NumeroFicha` varchar(20) DEFAULT NULL,
  `CorreoElectronico` varchar(100) DEFAULT NULL,
  `NivelAcademico` varchar(50) DEFAULT NULL,
  `ProgramaFormacion` varchar(100) DEFAULT NULL,
  `NumeroCelular` varchar(20) DEFAULT NULL,
  `EmpresaInicioEtapaProductiva` varchar(100) DEFAULT NULL,
  `FechaInicioEtapa` date DEFAULT NULL,
  `FechaFinEtapa` date DEFAULT NULL,
  `NombreInstructorLectivo` varchar(100) DEFAULT NULL,
  `DireccionEmpresa` varchar(100) DEFAULT NULL,
  `MunicipioCiudad` varchar(100) DEFAULT NULL,
  `NombreJefeInmediato` varchar(100) DEFAULT NULL,
  `TelefonoJefeInmediato` varchar(20) DEFAULT NULL,
  `CorreoJefeInmediato` varchar(100) DEFAULT NULL,
  `TipoAlternativaEtapaProductiva` varchar(100) DEFAULT NULL,
  `DocumentosEntregados` varchar(10) DEFAULT NULL,
  `FechaFormalizacion` date DEFAULT NULL,
  `FechaEvaluacionParcial` date DEFAULT NULL,
  `FechaEvaluacionFinal` date DEFAULT NULL,
  `FechaEstadoPorCertificar` date DEFAULT NULL,
  `FechaRespuestaCertificacion` date DEFAULT NULL,
  `URLFormulario` varchar(255) DEFAULT NULL,
  `Estado` varchar(100) DEFAULT NULL,
  `FechaSolicitudPazySalvo` date DEFAULT NULL,
  `FechaRespuestaCoordinador` date DEFAULT NULL,
  `ObservacionesSeguimiento` text DEFAULT NULL,
  `FormatoGFPIF023` tinyint(1) DEFAULT NULL,
  `CopiaContrato` tinyint(1) DEFAULT NULL,
  `FormatoGFPIF165` tinyint(1) DEFAULT NULL,
  `RUToNIT` varchar(50) DEFAULT NULL,
  `EPS` tinyint(1) DEFAULT NULL,
  `ARL` tinyint(1) DEFAULT NULL,
  `FormatoGFPIF023Completo` tinyint(1) DEFAULT NULL,
  `FormatoGFPIF147Bitacoras` tinyint(1) DEFAULT NULL,
  `CertificacionFinalizacion` tinyint(1) DEFAULT NULL,
  `EstadoPorCertificar` tinyint(1) DEFAULT NULL,
  `CopiaCedula` tinyint(1) DEFAULT NULL,
  `PruebasTyT` tinyint(1) DEFAULT NULL,
  `DestruccionCarnet` tinyint(1) DEFAULT NULL,
  `CertificadoAPE` tinyint(1) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_intructor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registroetapaproductiva`
--

INSERT INTO `registroetapaproductiva` (`Id`, `FechaRegistro`, `NumeroDocumentoIdentidad`, `NombreCompleto`, `NumeroFicha`, `CorreoElectronico`, `NivelAcademico`, `ProgramaFormacion`, `NumeroCelular`, `EmpresaInicioEtapaProductiva`, `FechaInicioEtapa`, `FechaFinEtapa`, `NombreInstructorLectivo`, `DireccionEmpresa`, `MunicipioCiudad`, `NombreJefeInmediato`, `TelefonoJefeInmediato`, `CorreoJefeInmediato`, `TipoAlternativaEtapaProductiva`, `DocumentosEntregados`, `FechaFormalizacion`, `FechaEvaluacionParcial`, `FechaEvaluacionFinal`, `FechaEstadoPorCertificar`, `FechaRespuestaCertificacion`, `URLFormulario`, `Estado`, `FechaSolicitudPazySalvo`, `FechaRespuestaCoordinador`, `ObservacionesSeguimiento`, `FormatoGFPIF023`, `CopiaContrato`, `FormatoGFPIF165`, `RUToNIT`, `EPS`, `ARL`, `FormatoGFPIF023Completo`, `FormatoGFPIF147Bitacoras`, `CertificacionFinalizacion`, `EstadoPorCertificar`, `CopiaCedula`, `PruebasTyT`, `DestruccionCarnet`, `CertificadoAPE`, `id_user`, `id_intructor`) VALUES
(16, '2024-04-24', '1104698706', 'juan', '2345678', 'sebdyjxjig@gmail.com', 'Tecnológico', 'analista de datos', '3224567890', 'claro', '2024-04-25', '2024-10-25', NULL, 'carrera4 #23 A', 'bogota', 'jesius', '3245678997', 'jesius@gmail.com', 'alternativa', 'Si', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'user'),
(3, 'instrutor'),
(4, 'cordinador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contrasena` varchar(200) NOT NULL,
  `id_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `email`, `contrasena`, `id_rol`) VALUES
(2, 'sebas3223518069@gmail.com', '$2y$10$XK1uWCMNADtMkqbNM5t89ORIjuBD3bccSa3qhs6YQYfdlnN1DztVq', 2),
(3, 'sebdyjxjig@gmail.com', '$2y$10$GS0HRbdFxo8TfAesNWV8duZo18ToKSGtPc/0aN/8myKFbB8ygH7IW', 2),
(4, 'mportillac@sena.edu.co', '$2y$10$2.pT1rdajXr16jGWqIjV6eZAgojidtiQ1vUd1L.CkGx1p3xEKoJAi', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `intructores`
--
ALTER TABLE `intructores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rol_instruc` (`id_rol`);

--
-- Indices de la tabla `registroetapaproductiva`
--
ALTER TABLE `registroetapaproductiva`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_user_se` (`id_user`),
  ADD KEY `fk_id_instri` (`id_intructor`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_role_id` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `intructores`
--
ALTER TABLE `intructores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `registroetapaproductiva`
--
ALTER TABLE `registroetapaproductiva`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `intructores`
--
ALTER TABLE `intructores`
  ADD CONSTRAINT `fk_rol_instruc` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);

--
-- Filtros para la tabla `registroetapaproductiva`
--
ALTER TABLE `registroetapaproductiva`
  ADD CONSTRAINT `fk_id_instri` FOREIGN KEY (`id_intructor`) REFERENCES `intructores` (`id`),
  ADD CONSTRAINT `fk_user_se` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
