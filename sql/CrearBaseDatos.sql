CREATE DATABASE Innovacion CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE Innovacion;

CREATE TABLE listanoticias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(110) NOT NULL,
  subtitulo VARCHAR(200),
  descripcion VARCHAR(7000) NOT NULL,
  fecha DATE NOT NULL,
  internoExterno INT NOT NULL,
  img VARCHAR(250),
  alineacion INT,
  autor VARCHAR(110),
  enlace VARCHAR(300),
  Relevante INT,
  nombreusuario VARCHAR(100)
);

CREATE TABLE listaeventos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(110) NOT NULL,
  descripcion VARCHAR(7000) NOT NULL,
  correos VARCHAR(250),
  telefonos VARCHAR(250),
  fechaInicio DATE NOT NULL,
  fechaFin DATE NOT NULL,
  horario VARCHAR(100),
  lugar VARCHAR(150) NOT NULL,
  coordenadas VARCHAR(250),
  video VARCHAR(250),
  internoExterno INT NOT NULL,
  categoria INT NOT NULL,
  nombreusuario VARCHAR(100)
);

CREATE TABLE listaeventos_imagenes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  evento_id INT,
  img VARCHAR(250),
  esprincipal INT,
  FOREIGN KEY (evento_id) REFERENCES listaeventos(id)
);

CREATE TABLE DescubreHidalgo (
  id INT AUTO_INCREMENT PRIMARY KEY,
  TituloMarcador VARCHAR(255) NOT NULL,
  Descripcion TEXT NOT NULL,
  lugar VARCHAR(150) NOT NULL,
  coordenadas VARCHAR(250) NOT NULL,
  img VARCHAR(255) NOT NULL,
  enlace VARCHAR(300),
  nombreusuario VARCHAR(100) NOT NULL
);

CREATE TABLE categoriaareaGeografica (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  visible INT
);

INSERT INTO
  categoriaareaGeografica (nombre, visible)
VALUES
  ('Internacionales', 1),
  ('Nacionales', 1),
  ('Estatal (Hidalgo)', 1);

CREATE TABLE noticia_cAreaGeografica (
  id INT AUTO_INCREMENT PRIMARY KEY,
  noticia_id INT,
  categoria_id INT,
  FOREIGN KEY (noticia_id) REFERENCES listanoticias(id),
  FOREIGN KEY (categoria_id) REFERENCES categoriaareaGeografica(id)
);

CREATE TABLE categoriaMunicipio (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  visible INT
);

INSERT INTO
  categoriaMunicipio (nombre, visible)
VALUES
  ('Acatlán', 1),
  ('Acaxochitlán', 1),
  ('Actopan', 1),
  ('Agua Blanca de Iturbide', 1),
  ('Ajacuba', 1),
  ('Alfajayucan', 1),
  ('Almoloya', 1),
  ('Apan', 1),
  ('El Arenal', 1),
  ('Atitalaquia', 1),
  ('Atlapexco', 1),
  ('Atotonilco el Grande', 1),
  ('Atotonilco de Tula', 1),
  ('Calnali', 1),
  ('Cardonal', 1),
  ('Cuautepec de Hinojosa', 1),
  ('Chapantongo', 1),
  ('Chapulhuacán', 1),
  ('Chilcuautla', 1),
  ('Eloxochitlán', 1),
  ('Emiliano Zapata', 1),
  ('Epazoyucan', 1),
  ('Francisco I. Madero', 1),
  ('Huasca de Ocampo', 1),
  ('Huautla', 1),
  ('Huazalingo', 1),
  ('Huehuetla', 1),
  ('Huejutla de Reyes', 1),
  ('Huichapan', 1),
  ('Ixmiquilpan', 1),
  ('Jacala de Ledezma', 1),
  ('Jaltocán', 1),
  ('Juárez Hidalgo', 1),
  ('Lolotla', 1),
  ('Metepec', 1),
  ('San Agustín Metzquititlán', 1),
  ('Metztitlán', 1),
  ('Mineral del Chico', 1),
  ('Mineral del Monte', 1),
  ('La Misión', 1),
  ('Mixquiahuala de Juárez', 1),
  ('Molango de Escamilla', 1),
  ('Nicolás Flores', 1),
  ('Nopala de Villagrán', 1),
  ('Omitlán de Juárez', 1),
  ('San Felipe Orizatlán', 1),
  ('Pacula', 1),
  ('Pachuca de Soto', 1),
  ('Pisaflores', 1),
  ('Progreso de Obregón', 1),
  ('Mineral de la Reforma', 1),
  ('San Agustín Tlaxiaca', 1),
  ('San Bartolo Tutotepec', 1),
  ('San Salvador', 1),
  ('Santiago de Anaya', 1),
  ('Santiago Tulantepec de Lugo Guerrero', 1),
  ('Singuilucan', 1),
  ('Tasquillo', 1),
  ('Tecozautla', 1),
  ('Tenango de Doria', 1),
  ('Tepeapulco', 1),
  ('Tepehuacán de Guerrero', 1),
  ('Tepeji del Río de Ocampo', 1),
  ('Tepetitlán', 1),
  ('Tetepango', 1),
  ('Villa de Tezontepec', 1),
  ('Tezontepec de Aldama', 1),
  ('Tianguistengo', 1),
  ('Tizayuca', 1),
  ('Tlahuelilpan', 1),
  ('Tlahuiltepa', 1),
  ('Tlanalapa', 1),
  ('Tlanchinol', 1),
  ('Tlaxcoapan', 1),
  ('Tolcayuca', 1),
  ('Tula de Allende', 1),
  ('Tulancingo de Bravo', 1),
  ('Xochiatipan', 1),
  ('Xochicoatlán', 1),
  ('Yahualica', 1),
  ('Zacualtipán de Ángeles', 1),
  ('Zapotlán de Juárez', 1),
  ('Zempoala', 1),
  ('Zimapán', 1);

CREATE TABLE noticia_cMunicipio (
  id INT AUTO_INCREMENT PRIMARY KEY,
  noticia_id INT,
  categoria_id INT,
  FOREIGN KEY (noticia_id) REFERENCES listanoticias(id),
  FOREIGN KEY (categoria_id) REFERENCES categoriaMunicipio(id)
);

CREATE TABLE categoriaLugar (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  visible INT
);

INSERT INTO
  categoriaLugar (nombre, visible)
VALUES
  ('Parque', 1),
  ('Balneario', 1),
  ('Restaurante', 1),
  ('Iglesia', 1),
  ('Museo', 1),
  ('Zona arqueológica', 1),
  ('Monumento historico', 1),
  ('Playa', 1),
  ('Montaña', 1);

CREATE TABLE noticia_cLugar (
  id INT AUTO_INCREMENT PRIMARY KEY,
  noticia_id INT,
  categoria_id INT,
  FOREIGN KEY (noticia_id) REFERENCES listanoticias(id),
  FOREIGN KEY (categoria_id) REFERENCES categoriaLugar(id)
);

CREATE TABLE categoriaActividad (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  visible INT
);

INSERT INTO
  categoriaActividad (nombre, visible)
VALUES
  ('Senderismo', 1),
  ('Naturaleza', 1),
  ('Descanso y bienestar', 1),
  ('Actividades al aire libre', 1),
  ('Espectáculo', 1),
  ('Turismo de compras', 1),
  ('Construcción', 1),
  ('Tour', 1);

CREATE TABLE noticia_cActividad (
  id INT AUTO_INCREMENT PRIMARY KEY,
  noticia_id INT,
  categoria_id INT,
  FOREIGN KEY (noticia_id) REFERENCES listanoticias(id),
  FOREIGN KEY (categoria_id) REFERENCES categoriaActividad(id)
);

CREATE TABLE categoriaEvento (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  visible INT
);

INSERT INTO
  categoriaEvento (nombre, visible)
VALUES
  ('Concierto', 1),
  ('Festival', 1),
  ('Exposición', 1),
  ('Politico', 1),
  ('Gobierno', 1),
  ('Educativo', 1),
  ('Deporte', 1),
  ('Gastronomia', 1),
  ('Cultural', 1);

CREATE TABLE noticia_cEvento (
  id INT AUTO_INCREMENT PRIMARY KEY,
  noticia_id INT,
  categoria_id INT,
  FOREIGN KEY (noticia_id) REFERENCES listanoticias(id),
  FOREIGN KEY (categoria_id) REFERENCES categoriaEvento(id)
);

-- Usuarios y sus roles
CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  rol VARCHAR(25) NOT NULL,
  pass VARCHAR(255) NOT NULL
);

INSERT INTO
  usuarios (nombre, rol, pass)
VALUES
  ('Lucero', 'Prensa', 'Wk9p#jL7oR'),
  ('Alberto', 'Prensa', '3aHsG8xQ!z'),
  ('Maria', 'Marketing', 'Qp7#sT5mN'),
  ('Yuliana', 'Marketing', 'nWHas-uR'),
  ('Jose', 'Jefe de edicion Prensa', 'L!u6sA4zXt'),
  ('Pablo', 'Jefe de edicion Marketing', 'nww7HjL82'),
  ('Raul1', 'Admin', 'H8gF$qY2wE'),
  ('Raul2', 'Admin', 'E5f6G7h8@'),
  ('Raul3', 'Admin', 'I9j0K1l2#');