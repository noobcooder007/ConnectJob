-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 09-06-2019 a las 19:28:08
-- Versión del servidor: 5.7.26-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bolsaD`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Applicant`
--

CREATE TABLE `Applicant` (
  `idApplicant` int(4) NOT NULL,
  `idUser` int(4) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `city` varchar(30) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `state` varchar(30) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `telephone` varchar(13) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `genre` varchar(1) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `image` mediumblob,
  `dateSignUp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `JobApplicant`
--

CREATE TABLE `JobApplicant` (
  `idJobApplicant` int(11) NOT NULL,
  `idJobOffers` int(11) NOT NULL,
  `idApplicant` int(11) NOT NULL,
  `state` int(1) NOT NULL,
  `datePostulate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `JobOffers`
--

CREATE TABLE `JobOffers` (
  `idOffer` int(4) NOT NULL,
  `idPostulator` int(4) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_spanish_ci NOT NULL,
  `salary` int(11) NOT NULL,
  `place` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `publicate` date NOT NULL,
  `state` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Postulator`
--

CREATE TABLE `Postulator` (
  `idPostulator` int(4) NOT NULL,
  `idUser` int(4) NOT NULL,
  `company` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `webPage` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `city` varchar(30) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `state` varchar(30) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `telephone` varchar(13) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `image` mediumblob,
  `dateSignUp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Users`
--

CREATE TABLE `Users` (
  `idUser` int(4) NOT NULL,
  `email` varchar(320) COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `type` int(1) NOT NULL,
  `stateAccount` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Applicant`
--
ALTER TABLE `Applicant`
  ADD PRIMARY KEY (`idApplicant`);

--
-- Indices de la tabla `JobApplicant`
--
ALTER TABLE `JobApplicant`
  ADD PRIMARY KEY (`idJobApplicant`);

--
-- Indices de la tabla `JobOffers`
--
ALTER TABLE `JobOffers`
  ADD PRIMARY KEY (`idOffer`),
  ADD UNIQUE KEY `UNIQUE` (`idPostulator`),
  ADD KEY `idPostulator` (`idPostulator`);

--
-- Indices de la tabla `Postulator`
--
ALTER TABLE `Postulator`
  ADD PRIMARY KEY (`idPostulator`),
  ADD UNIQUE KEY `idUser` (`idUser`),
  ADD KEY `idUser_2` (`idUser`);

--
-- Indices de la tabla `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `UNIQUE` (`email`),
  ADD KEY `idUser` (`idUser`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
