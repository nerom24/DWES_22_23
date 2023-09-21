-- Base de datos Proyecto Album
-- Proyecto Tema 7 - Gestión Album Fotografias

DROP DATABASE IF EXISTS album;
CREATE DATABASE IF NOT EXISTS album;

USE album;

DROP TABLE IF EXISTS albumes;
CREATE TABLE IF NOT EXISTS albumes(

	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    autor VARCHAR(50),
    fecha DATE,
    lugar VARCHAR(50),
    categoria VARCHAR(50),
    etiquetas VARCHAR(250),
    num_fotos SMALLINT UNSIGNED,
    num_visitas SMALLINT UNSIGNED,
    carpeta VARCHAR(50),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);