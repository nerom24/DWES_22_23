-- Actividad 6.1
-- 26/11/2017

DROP DATABASE IF EXISTS fp;
CREATE DATABASE IF NOT EXISTS fp
	DEFAULT CHARACTER SET UTF8
    DEFAULT COLLATE UTF8_GENERAL_CI;

USE fp;
DROP TABLE IF EXISTS cursos;
CREATE TABLE IF NOT EXISTS cursos(
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    ciclo VARCHAR(50) NOT NULL,
    nombreCorto VARCHAR(4) NOT NULL,
    nivel CHAR(1) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=UTF8 COLLATE=UTF8_GENERAL_CI;

INSERT INTO cursos VALUES
	(NULL, "Primero de Desarrollo de Aplicaciones Web", "Desarrollo de Aplicaciones Web", "1DAW", "1"),
    (NULL, "Segundo de Desarrollo de Aplicaciones Web", "Desarrollo de Aplicaciones Web", "2DAW", "2"),
    (NULL, "Primero de Sistemas Microinformáticos y Redes", "Sistemas Microinformáticos y Redes", "1SMR", "1"),
    (NULL, "Segundo de Sistemas Microinformáticos y Redes", "Sistemas Microinformáticos y Redes", "2SMR", "2"),
    (NULL, "Primero de Asistencia a la Dirección", "Asistencia a la Dirección", "1AD", "1"),
    (NULL, "Segundo de Asistencia a la Dirección", "Asistencia a la Dirección", "2AD", "2")
;

DROP TABLE IF EXISTS alumnos;
CREATE TABLE alumnos (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    email VARCHAR(50) UNIQUE,
    telefono CHAR(9),
    direccion VARCHAR(50),
    poblacion VARCHAR(30),
    provincia VARCHAR(30),
    nacionalidad VARCHAR(30),
    dni CHAR(9) UNIQUE,
    fechaNac DATE,
    id_curso INT UNSIGNED,
    FOREIGN KEY (id_curso) REFERENCES cursos(id)
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=UTF8 COLLATE=UTF8_GENERAL_CI;

INSERT INTO alumnos VALUES
	(NULL, "Javier", "Fernández Román", "javier@correo.es", "956787454", "Una calle, 1", "Ubrique", "Cádiz", "Española", "45789654A", "1990-05-15", "1"),
    (NULL, "Cristina", "Mena Holgado", "cristina@correo.es", "956000054", "Una calle, 2", "Ubrique", "Cádiz", "Española", "71465454B", "1993-07-25", "3"),
    (NULL, "Paco", "Pérez Mota", "francisco@correo.es", "956000123", "Una calle, 3", "Ubrique", "Cádiz", "Española", "95789754B", "1995-11-05", "2"),
    (NULL, "Yohana", "Ruíz Aguilera", "yohana@correo.es", "956001234", "Una calle, 4", "Ubrique", "Cádiz", "Española", "65457544C", "1991-02-02", "5"),
	(NULL, "Antonio", "Rojo Atienza", "antonio@correo.es", "956123000", "Una calle, 5", "Ubrique", "Cádiz", "Española", "56897845D", "1989-12-28", "4"),
    (NULL, "Alba", "Florencio Romero", "alba@correo.es", "956140055", "Una calle, 6", "Ubrique", "Cádiz", "Española", "12457836F", "1990-05-15", "6")
;

