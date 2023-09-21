# Base de Datos - Gesbank.sql
# Módulo - Bases de Datos 
# Ciclo - DAW


DROP DATABASE IF EXISTS Gesbank;
CREATE DATABASE  IF NOT EXISTS Gesbank;
USE Gesbank;

--
-- Tabla Clientes
DROP TABLE IF EXISTS clientes;
CREATE TABLE IF NOT EXISTS clientes(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    apellidos VARCHAR(45),
    nombre VARCHAR(20),
    telefono CHAR(9),
    ciudad VARCHAR(20),
    dni CHAR(9) UNIQUE,
    email VARCHAR(45) UNIQUE,
	create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--
-- Tabla Cuentas
DROP TABLE IF EXISTS cuentas;
CREATE TABLE IF NOT EXISTS cuentas(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    num_cuenta CHAR(20) UNIQUE,
    id_cliente INT UNSIGNED,
    fecha_alta TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	fecha_ul_mov DATETIME,
	num_movtos INT UNSIGNED,
    saldo DECIMAL(15, 2 ),
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Restricciones
    FOREIGN KEY (id_cliente) REFERENCES clientes (id) 
    ON DELETE SET NULL ON UPDATE CASCADE
);

--
-- Tabla Movimientos

DROP TABLE IF EXISTS movimientos;
CREATE TABLE IF NOT EXISTS movimientos(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_cuenta INT UNSIGNED,
    fecha_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    concepto VARCHAR(50),
    tipo ENUM ('I', 'R', ' ') DEFAULT 'I',
    cantidad DECIMAL(12, 2 ),
    saldo DECIMAL(12,2),
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Restricciones
    FOREIGN KEY(id_cuenta) REFERENCES cuentas(id) 
    ON DELETE CASCADE ON UPDATE CASCADE
);


delimiter ;

INSERT INTO clientes VALUES
(NULL, 'García Pérez', 'Francisco', '956465432', 'Ubrique', '12345678A', 'francisco@perez.com', NULL, NULL),
(NULL, 'Moreno Gracia', 'José Carlos', '956487896', 'Ubrique', '25693874B', 'moreno@gracia.com', NULL, NULL),
(NULL, 'Romero Ramírez', 'Rocío', '956874521', 'Ubrique', '25693582C', 'rocio@romero.com', NULL, NULL);

INSERT INTO cuentas VALUES
(NULL, '210311111234567890', 1, '2010-03-12', CURRENT_TIMESTAMP, 4, 620, NULL, NULL),
(NULL, '210322221234567890', 2, '2010-02-04', CURRENT_TIMESTAMP, 2, 80, NULL,  NULL),
(NULL, '210333331234567890', 3, '2010-05-14', CURRENT_TIMESTAMP, 2, 60, NULL, NULL);

INSERT INTO movimientos VALUES
(NULL, 1, NULL, 'Movimiento de Ingreso', 'I', 100, 100, NULL, NULL),
(NULL, 1, NULL, 'Movimiento de Ingreso', 'I', 120, 220, NULL, NULL),
(NULL, 2, NULL, 'Movimiento de Ingreso', 'I', 100, 100, NULL, NULL),
(NULL, 3, NULL, 'Movimiento de Ingreso', 'I', 100, 100, NULL, NULL),
(NULL, 1, NULL, 'Movimiento de Ingreso', 'I', 300, 520, NULL, NULL),
(NULL, 3, NULL, 'Movimiento de Reintegro', 'R', 40, 60, NULL, NULL),
(NULL, 2, NULL, 'Movimiento de Reintegro', 'R', 20, 80, NULL, NULL),
(NULL, 1, NULL, 'Movimiento de Ingreso', 'I', 100, 620, NULL, NULL);
