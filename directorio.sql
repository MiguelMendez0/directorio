-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-01-2025 a las 22:59:06
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
-- Base de datos: `directorio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios`
--

CREATE TABLE `privilegios` (
  `PrivilegioId` int(11) NOT NULL,
  `PrivilegioNombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `privilegios`
--

INSERT INTO `privilegios` (`PrivilegioId`, `PrivilegioNombre`) VALUES
(1, 'UsuarioComun'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `UsuarioId` int(11) NOT NULL,
  `UsuarioEmail` varchar(50) NOT NULL,
  `UsuarioPass` varchar(255) NOT NULL,
  `UsuarioPrivilegio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`UsuarioId`, `UsuarioEmail`, `UsuarioPass`, `UsuarioPrivilegio`) VALUES
(11, 'jose.dedios@fast-net.com.mx', '$2y$10$b7TpAAqZj8Kflju52jyGquejMxRALg6MMYkcB/2YjzmeSmXidyrbC', 2),
(16, 'miguelmendez@fast-net.com.mx', '$2y$10$YdPff2t2A8A9KJXNGzlsT.ixMpacE45hDQuaUAkVJT2fTKfhbJPey', 2),
(23, 'abraham@fast-net.com.mx', '$2y$10$YLuRJJVeEmukzSQesI1Owu1WuWe8b/utFmwxTfdB6UFL4rhr62li.', 1),
(26, 'abraham.montejo@fast-net.com.mx', '$2y$10$fZo9WfBXej2LPyfepBKS9OG8IRQceK.I96nqywL9Tka0ZvZYYNgyu', 1),
(27, 'jose@fast-net.com.mx', '$2y$10$FCvXH6wNp5awJyFJGSypH.65wm85e4B19Y3lgVo9sBWENV3HE/Twe', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  ADD PRIMARY KEY (`PrivilegioId`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`UsuarioId`),
  ADD KEY `UsuarioPrivilegio` (`UsuarioPrivilegio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  MODIFY `PrivilegioId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `UsuarioId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`UsuarioPrivilegio`) REFERENCES `privilegios` (`PrivilegioId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
