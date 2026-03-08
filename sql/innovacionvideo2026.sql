-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-03-2026 a las 22:57:39
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
-- Base de datos: `innovacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriaactividad`
--

CREATE TABLE `categoriaactividad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `visible` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoriaactividad`
--

INSERT INTO `categoriaactividad` (`id`, `nombre`, `visible`) VALUES
(1, 'Senderismo', 1),
(2, 'Naturaleza', 1),
(3, 'Descanso y bienestar', 1),
(4, 'Actividades al aire libre', 1),
(5, 'Espectáculo', 1),
(6, 'Turismo de compras', 1),
(7, 'Construcción', 1),
(8, 'Tour', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriaareageografica`
--

CREATE TABLE `categoriaareageografica` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `visible` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoriaareageografica`
--

INSERT INTO `categoriaareageografica` (`id`, `nombre`, `visible`) VALUES
(1, 'Internacionales', 1),
(2, 'Nacionales', 1),
(3, 'Estatal (Hidalgo)', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriaevento`
--

CREATE TABLE `categoriaevento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `visible` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoriaevento`
--

INSERT INTO `categoriaevento` (`id`, `nombre`, `visible`) VALUES
(1, 'Concierto', 1),
(2, 'Festival', 1),
(3, 'Exposición', 1),
(4, 'Politico', 1),
(5, 'Gobierno', 1),
(6, 'Educativo', 1),
(7, 'Deporte', 1),
(8, 'Gastronomia', 1),
(9, 'Cultural', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorialugar`
--

CREATE TABLE `categorialugar` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `visible` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorialugar`
--

INSERT INTO `categorialugar` (`id`, `nombre`, `visible`) VALUES
(1, 'Parque', 1),
(2, 'Balneario', 1),
(3, 'Restaurante', 1),
(4, 'Iglesia', 1),
(5, 'Museo', 1),
(6, 'Zona arqueológica', 1),
(7, 'Monumento historico', 1),
(8, 'Playa', 1),
(9, 'Montaña', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriamunicipio`
--

CREATE TABLE `categoriamunicipio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `visible` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoriamunicipio`
--

INSERT INTO `categoriamunicipio` (`id`, `nombre`, `visible`) VALUES
(1, 'Acatlán', 1),
(2, 'Acaxochitlán', 1),
(3, 'Actopan', 1),
(4, 'Agua Blanca de Iturbide', 1),
(5, 'Ajacuba', 1),
(6, 'Alfajayucan', 1),
(7, 'Almoloya', 1),
(8, 'Apan', 1),
(9, 'El Arenal', 1),
(10, 'Atitalaquia', 1),
(11, 'Atlapexco', 1),
(12, 'Atotonilco el Grande', 1),
(13, 'Atotonilco de Tula', 1),
(14, 'Calnali', 1),
(15, 'Cardonal', 1),
(16, 'Cuautepec de Hinojosa', 1),
(17, 'Chapantongo', 1),
(18, 'Chapulhuacán', 1),
(19, 'Chilcuautla', 1),
(20, 'Eloxochitlán', 1),
(21, 'Emiliano Zapata', 1),
(22, 'Epazoyucan', 1),
(23, 'Francisco I. Madero', 1),
(24, 'Huasca de Ocampo', 1),
(25, 'Huautla', 1),
(26, 'Huazalingo', 1),
(27, 'Huehuetla', 1),
(28, 'Huejutla de Reyes', 1),
(29, 'Huichapan', 1),
(30, 'Ixmiquilpan', 1),
(31, 'Jacala de Ledezma', 1),
(32, 'Jaltocán', 1),
(33, 'Juárez Hidalgo', 1),
(34, 'Lolotla', 1),
(35, 'Metepec', 1),
(36, 'San Agustín Metzquititlán', 1),
(37, 'Metztitlán', 1),
(38, 'Mineral del Chico', 1),
(39, 'Mineral del Monte', 1),
(40, 'La Misión', 1),
(41, 'Mixquiahuala de Juárez', 1),
(42, 'Molango de Escamilla', 1),
(43, 'Nicolás Flores', 1),
(44, 'Nopala de Villagrán', 1),
(45, 'Omitlán de Juárez', 1),
(46, 'San Felipe Orizatlán', 1),
(47, 'Pacula', 1),
(48, 'Pachuca de Soto', 1),
(49, 'Pisaflores', 1),
(50, 'Progreso de Obregón', 1),
(51, 'Mineral de la Reforma', 1),
(52, 'San Agustín Tlaxiaca', 1),
(53, 'San Bartolo Tutotepec', 1),
(54, 'San Salvador', 1),
(55, 'Santiago de Anaya', 1),
(56, 'Santiago Tulantepec de Lugo Guerrero', 1),
(57, 'Singuilucan', 1),
(58, 'Tasquillo', 1),
(59, 'Tecozautla', 1),
(60, 'Tenango de Doria', 1),
(61, 'Tepeapulco', 1),
(62, 'Tepehuacán de Guerrero', 1),
(63, 'Tepeji del Río de Ocampo', 1),
(64, 'Tepetitlán', 1),
(65, 'Tetepango', 1),
(66, 'Villa de Tezontepec', 1),
(67, 'Tezontepec de Aldama', 1),
(68, 'Tianguistengo', 1),
(69, 'Tizayuca', 1),
(70, 'Tlahuelilpan', 1),
(71, 'Tlahuiltepa', 1),
(72, 'Tlanalapa', 1),
(73, 'Tlanchinol', 1),
(74, 'Tlaxcoapan', 1),
(75, 'Tolcayuca', 1),
(76, 'Tula de Allende', 1),
(77, 'Tulancingo de Bravo', 1),
(78, 'Xochiatipan', 1),
(79, 'Xochicoatlán', 1),
(80, 'Yahualica', 1),
(81, 'Zacualtipán de Ángeles', 1),
(82, 'Zapotlán de Juárez', 1),
(83, 'Zempoala', 1),
(84, 'Zimapán', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descubrehidalgo`
--

CREATE TABLE `descubrehidalgo` (
  `id` int(11) NOT NULL,
  `TituloMarcador` varchar(255) NOT NULL,
  `Descripcion` text NOT NULL,
  `lugar` varchar(150) NOT NULL,
  `coordenadas` varchar(250) NOT NULL,
  `img` varchar(255) NOT NULL,
  `enlace` varchar(300) DEFAULT NULL,
  `nombreusuario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `descubrehidalgo`
--

INSERT INTO `descubrehidalgo` (`id`, `TituloMarcador`, `Descripcion`, `lugar`, `coordenadas`, `img`, `enlace`, `nombreusuario`) VALUES
(3, 'Las pirámides de Tula', 'Las pirámides de Tula, ubicadas en Hidalgo, México, son los vestigios de la capital tolteca que floreció entre los siglos X y XII d.C.. El sitio destaca por la Pirámide B o Templo de Tlahuizcalpantecuhtli, coronado por los emblemáticos Atlantes de Tula, cuatro figuras colosales de más de 4 metros de basalto que representaban a guerreros y sostenían el techo del templo superior. \r\n', 'Tula de Allende, Hgo., México', '20.0557971, -99.34243959999999', 'ImagenesInsertadasDescubreHidalgo/69ade9c9ad409_photo1jpg (1).jpg', 'https://www.mexicodesconocido.com.mx/lugares-turisticos-de-hidalgo.html', 'Raul1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listaeventos`
--

CREATE TABLE `listaeventos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(110) NOT NULL,
  `descripcion` varchar(7000) NOT NULL,
  `correos` varchar(250) DEFAULT NULL,
  `telefonos` varchar(250) DEFAULT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `horario` varchar(100) DEFAULT NULL,
  `lugar` varchar(150) NOT NULL,
  `coordenadas` varchar(250) DEFAULT NULL,
  `video` varchar(250) DEFAULT NULL,
  `internoExterno` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `nombreusuario` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `listaeventos`
--

INSERT INTO `listaeventos` (`id`, `titulo`, `descripcion`, `correos`, `telefonos`, `fechaInicio`, `fechaFin`, `horario`, `lugar`, `coordenadas`, `video`, `internoExterno`, `categoria`, `nombreusuario`) VALUES
(6, 'Festival de la Huasteca Hidalguense: Celebrando Tradiciones y Cultura', ' Únete al vibrante Festival de la Huasteca Hidalguense, donde la música, danza y gastronomía se unen para celebrar las ricas tradiciones de la región. Durante tres días llenos de energía, podrás disfrutar de presentaciones de danzas tradicionales, conciertos con música huasteca en vivo, muestras artesanales con piezas únicas y una amplia variedad de platillos típicos que te harán explorar los sabores auténticos de Hidalgo. No te pierdas esta oportunidad única de sumergirte en la cultura huasteca y crear recuerdos inolvidables con tu familia y amigos.', 'alguien@gmail.com', '7730000000', '2024-08-08', '2024-11-08', '10:000 am - 2:00 pm', 'Huejutla, Hgo., México', '21.1367171, -98.41221619999999', 'https://www.youtube.com/watch?v=WCSK_TMro_Q', 2, 5, 'Raul1'),
(7, 'Feria del Pulque', 'La Feria del Pulque de Atotonilco de Tula es una celebración tradicional que reúne a productores, visitantes y familias para rendir homenaje a una de las bebidas más antiguas de México: el pulque. Durante el evento, los asistentes pueden degustar distintas variedades de esta bebida, desde el pulque natural hasta los curados preparados con frutas como guayaba, piñón o avena. La feria también incluye música en vivo, presentaciones culturales y espacios gastronómicos donde se ofrecen platillos típicos de la región.\r\nEste evento se realiza en el municipio de Atotonilco de Tula, en el estado de Hidalgo, una zona con fuerte tradición pulquera debido al cultivo histórico del maguey. Además de promover el consumo responsable del pulque, la feria busca preservar las costumbres locales y fortalecer la identidad cultural de la comunidad, atrayendo tanto a habitantes de la región como a visitantes interesados en conocer más sobre las tradiciones hidalguenses.', 'alguien@gmail.com', '7730000000', '2026-03-09', '2026-03-11', '10:000 am - 2:00 pm', 'Ocampo, Hgo., México', '20.0102227, -99.2383753', 'https://www.youtube.com/watch?v=WCSK_TMro_Q', 1, 3, 'Raul1'),
(9, 'EL MALILLA - TU MALIANTE BEBÉ TOUR', 'Concierto\r\n\r\nAuditorio Explanada Pachuca\r\nPachuca, Hidalgo\r\nAutopista México Pachuca #6201\r\nSan Antonio El Desmonte\r\n42083\r\nVIP DE PIE	\r\nADULTO	\r\n$1,445.00\r\nBLANCA	\r\nADULTO	\r\n$1,090.00\r\nLILA	\r\nADULTO	\r\n$1,030.00\r\nROJA	\r\nADULTO	\r\n$865.00\r\nAZUL	\r\nADULTO	\r\n$750.00\r\nVERDE	\r\nADULTO	\r\n$600.00\r\n', 'alguien@gmail.com', '7730000000', '2026-03-26', '2026-03-27', '10:000 am - 2:00 pm', 'Auditorio Arema Explanada Pachuca, Autopista México - Pachuca, San Antonio el Desmonte, Pachuca de Soto, Hgo., México', '20.036224, -98.7948319', 'https://youtu.be/93r6q6qpzTo?si=M5TBT463H8mHDE2x', 2, 1, 'Raul1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listaeventos_imagenes`
--

CREATE TABLE `listaeventos_imagenes` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) DEFAULT NULL,
  `img` varchar(250) DEFAULT NULL,
  `esprincipal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `listaeventos_imagenes`
--

INSERT INTO `listaeventos_imagenes` (`id`, `evento_id`, `img`, `esprincipal`) VALUES
(21, 6, 'ImagenesInsertadasEventos/imagen_69ade7f429b2a_887.jpg', 0),
(22, 6, 'ImagenesInsertadasEventos/imagen_69ade7f42a546_487.webp', 0),
(23, 6, 'ImagenesInsertadasEventos/imagen_69ade7f42b243_435.png', 0),
(24, 6, 'ImagenesInsertadasEventos/imagen_69ade7f42bd6d_711.png', 1),
(25, 7, 'ImagenesInsertadasEventos/imagen_69ade937d4b60_559.jpeg', 0),
(26, 7, 'ImagenesInsertadasEventos/imagen_69ade937d5866_747.jpg', 0),
(27, 7, 'ImagenesInsertadasEventos/imagen_69ade937d6647_777.png', 0),
(28, 7, 'ImagenesInsertadasEventos/imagen_69ade937d7654_268.webp', 0),
(29, 7, 'ImagenesInsertadasEventos/imagen_69ade937d82c4_958.jpeg', 1),
(31, 9, 'ImagenesInsertadasEventos/imagen_69adef1c92e9a_361.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listanoticias`
--

CREATE TABLE `listanoticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(110) NOT NULL,
  `subtitulo` varchar(200) DEFAULT NULL,
  `descripcion` varchar(7000) NOT NULL,
  `fecha` date NOT NULL,
  `internoExterno` int(11) NOT NULL,
  `img` varchar(250) DEFAULT NULL,
  `alineacion` int(11) DEFAULT NULL,
  `autor` varchar(110) DEFAULT NULL,
  `enlace` varchar(300) DEFAULT NULL,
  `Relevante` int(11) DEFAULT NULL,
  `nombreusuario` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `listanoticias`
--

INSERT INTO `listanoticias` (`id`, `titulo`, `subtitulo`, `descripcion`, `fecha`, `internoExterno`, `img`, `alineacion`, `autor`, `enlace`, `Relevante`, `nombreusuario`) VALUES
(1, 'Descubre las Maravillas Ocultas de Hidalgo este Verano', 'Un espectáculo natural que cautiva a visitantes de todo el mundo', 'Sumérgete en la belleza indescriptible de las Cascadas de Prismas Basálticos en Hidalgo, donde el agua cristalina se precipita entre columnas de basalto formando una obra maestra geológica. Este destino único ofrece no solo vistas impresionantes, sino también la oportunidad de disfrutar de actividades como senderismo, fotografía y contemplación de la naturaleza. Ideal para escapadas familiares y aventuras en solitario, las Cascadas de Prismas Basálticos te esperan para una experiencia inolvidable de conexión con la naturaleza en el corazón de México.', '2024-07-16', 2, 'ImagenesInsertadasNoticias/photo1jpg.jpg', 2, 'Arturo Juárez Monroy', 'https://www.mexicodesconocido.com.mx/lugares-turisticos-de-hidalgo.html', 1, 'Lucero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia_cactividad`
--

CREATE TABLE `noticia_cactividad` (
  `id` int(11) NOT NULL,
  `noticia_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `noticia_cactividad`
--

INSERT INTO `noticia_cactividad` (`id`, `noticia_id`, `categoria_id`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia_careageografica`
--

CREATE TABLE `noticia_careageografica` (
  `id` int(11) NOT NULL,
  `noticia_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `noticia_careageografica`
--

INSERT INTO `noticia_careageografica` (`id`, `noticia_id`, `categoria_id`) VALUES
(1, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia_cevento`
--

CREATE TABLE `noticia_cevento` (
  `id` int(11) NOT NULL,
  `noticia_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `noticia_cevento`
--

INSERT INTO `noticia_cevento` (`id`, `noticia_id`, `categoria_id`) VALUES
(1, 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia_clugar`
--

CREATE TABLE `noticia_clugar` (
  `id` int(11) NOT NULL,
  `noticia_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `noticia_clugar`
--

INSERT INTO `noticia_clugar` (`id`, `noticia_id`, `categoria_id`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia_cmunicipio`
--

CREATE TABLE `noticia_cmunicipio` (
  `id` int(11) NOT NULL,
  `noticia_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `noticia_cmunicipio`
--

INSERT INTO `noticia_cmunicipio` (`id`, `noticia_id`, `categoria_id`) VALUES
(7, 1, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `rol` varchar(25) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `rol`, `pass`) VALUES
(1, 'Lucero', 'Prensa', 'Wk9p#jL7oR'),
(2, 'Alberto', 'Prensa', '3aHsG8xQ!z'),
(3, 'Maria', 'Marketing', 'Qp7#sT5mN'),
(4, 'Yuliana', 'Marketing', 'nWHas-uR'),
(5, 'Jose', 'Jefe de edicion Prensa', 'L!u6sA4zXt'),
(6, 'Pablo', 'Jefe de edicion Marketing', 'nww7HjL82'),
(7, 'Raul1', 'Admin', 'H8gF$qY2wE'),
(8, 'Raul2', 'Admin', 'E5f6G7h8@'),
(9, 'Raul3', 'Admin', 'I9j0K1l2#');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoriaactividad`
--
ALTER TABLE `categoriaactividad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoriaareageografica`
--
ALTER TABLE `categoriaareageografica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoriaevento`
--
ALTER TABLE `categoriaevento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorialugar`
--
ALTER TABLE `categorialugar`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoriamunicipio`
--
ALTER TABLE `categoriamunicipio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `descubrehidalgo`
--
ALTER TABLE `descubrehidalgo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `listaeventos`
--
ALTER TABLE `listaeventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `listaeventos_imagenes`
--
ALTER TABLE `listaeventos_imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evento_id` (`evento_id`);

--
-- Indices de la tabla `listanoticias`
--
ALTER TABLE `listanoticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `noticia_cactividad`
--
ALTER TABLE `noticia_cactividad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noticia_id` (`noticia_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `noticia_careageografica`
--
ALTER TABLE `noticia_careageografica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noticia_id` (`noticia_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `noticia_cevento`
--
ALTER TABLE `noticia_cevento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noticia_id` (`noticia_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `noticia_clugar`
--
ALTER TABLE `noticia_clugar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noticia_id` (`noticia_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `noticia_cmunicipio`
--
ALTER TABLE `noticia_cmunicipio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noticia_id` (`noticia_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoriaactividad`
--
ALTER TABLE `categoriaactividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `categoriaareageografica`
--
ALTER TABLE `categoriaareageografica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categoriaevento`
--
ALTER TABLE `categoriaevento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `categorialugar`
--
ALTER TABLE `categorialugar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `categoriamunicipio`
--
ALTER TABLE `categoriamunicipio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de la tabla `descubrehidalgo`
--
ALTER TABLE `descubrehidalgo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `listaeventos`
--
ALTER TABLE `listaeventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `listaeventos_imagenes`
--
ALTER TABLE `listaeventos_imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `listanoticias`
--
ALTER TABLE `listanoticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `noticia_cactividad`
--
ALTER TABLE `noticia_cactividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `noticia_careageografica`
--
ALTER TABLE `noticia_careageografica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `noticia_cevento`
--
ALTER TABLE `noticia_cevento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `noticia_clugar`
--
ALTER TABLE `noticia_clugar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `noticia_cmunicipio`
--
ALTER TABLE `noticia_cmunicipio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `listaeventos_imagenes`
--
ALTER TABLE `listaeventos_imagenes`
  ADD CONSTRAINT `listaeventos_imagenes_ibfk_1` FOREIGN KEY (`evento_id`) REFERENCES `listaeventos` (`id`);

--
-- Filtros para la tabla `noticia_cactividad`
--
ALTER TABLE `noticia_cactividad`
  ADD CONSTRAINT `noticia_cactividad_ibfk_1` FOREIGN KEY (`noticia_id`) REFERENCES `listanoticias` (`id`),
  ADD CONSTRAINT `noticia_cactividad_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categoriaactividad` (`id`);

--
-- Filtros para la tabla `noticia_careageografica`
--
ALTER TABLE `noticia_careageografica`
  ADD CONSTRAINT `noticia_careageografica_ibfk_1` FOREIGN KEY (`noticia_id`) REFERENCES `listanoticias` (`id`),
  ADD CONSTRAINT `noticia_careageografica_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categoriaareageografica` (`id`);

--
-- Filtros para la tabla `noticia_cevento`
--
ALTER TABLE `noticia_cevento`
  ADD CONSTRAINT `noticia_cevento_ibfk_1` FOREIGN KEY (`noticia_id`) REFERENCES `listanoticias` (`id`),
  ADD CONSTRAINT `noticia_cevento_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categoriaevento` (`id`);

--
-- Filtros para la tabla `noticia_clugar`
--
ALTER TABLE `noticia_clugar`
  ADD CONSTRAINT `noticia_clugar_ibfk_1` FOREIGN KEY (`noticia_id`) REFERENCES `listanoticias` (`id`),
  ADD CONSTRAINT `noticia_clugar_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorialugar` (`id`);

--
-- Filtros para la tabla `noticia_cmunicipio`
--
ALTER TABLE `noticia_cmunicipio`
  ADD CONSTRAINT `noticia_cmunicipio_ibfk_1` FOREIGN KEY (`noticia_id`) REFERENCES `listanoticias` (`id`),
  ADD CONSTRAINT `noticia_cmunicipio_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categoriamunicipio` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
