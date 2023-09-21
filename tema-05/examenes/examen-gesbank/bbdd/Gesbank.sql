# Base de Datos - Gesbank.sql
# Módulo - Bases de Datos 
# Ciclo - DAW


DROP DATABASE IF EXISTS Gesbank;
CREATE DATABASE  IF NOT EXISTS Gesbank;
USE Gesbank;

--
-- Tabla Clientes
drop table if exists clientes;
create table if not exists clientes(
    id int unsigned auto_increment primary key,
    apellidos varchar(45),
    nombre varchar(20),
    telefono char(9),
    ciudad varchar(20),
    dni char(9) unique,
    email varchar(45) unique,
	fechaalta timestamp default current_timestamp
);

--
-- Tabla Cuentas
drop table if exists cuentas;
create table if not exists cuentas(
    id int unsigned auto_increment primary key,
    num_cuenta char(20) unique,
    id_cliente int unsigned,
    fecha_alta timestamp default CURRENT_TIMESTAMP,
	fecha_ul_mov datetime,
	num_movtos int unsigned,
    saldo decimal(15, 2 ),
    foreign key (id_cliente) references clientes (id) 
    ON DELETE SET NULL ON UPDATE CASCADE
);

--
-- Tabla Movimientos

drop table if exists movimientos;
create table if not exists movimientos(
    id int unsigned auto_increment Primary key,
    id_cuenta int unsigned,
    fecha_hora timestamp default CURRENT_TIMESTAMP,
    tipo enum ('I', 'R', ' ') default 'I',
    cantidad decimal(12, 2 ),
    saldo decimal(12,2),
    foreign key(id_cuenta) references cuentas(id) 
    ON DELETE CASCADE ON UPDATE CASCADE
);


delimiter ;

insert into clientes values
(null, 'García Pérez', 'Francisco', '956465432', 'Ubrique', '12345678A', 'francisco@perez.com', null),
(null, 'Moreno Gracia', 'José Carlos', '956487896', 'Ubrique', '25693874B', 'moreno@gracia.com', null),
(null, 'Romero Ramírez', 'Rocío', '956874521', 'Ubrique', '25693582C', 'rocio@romero.com', null);

insert into cuentas values
(null, '210311111234567890', 1, '2010-03-12', current_timestamp, 4, 620),
(null, '210322221234567890', 2, '2010-02-04', current_timestamp, 2, 80),
(null, '210333331234567890', 3, '2010-05-14', current_timestamp, 2, 60);

insert into movimientos values
(null, 1, null, 'I', 100, 100),
(null, 1, null, 'I', 120, 220),
(null, 2, null, 'I', 100, 100),
(null, 3, null, 'I', 100, 100),
(null, 1, null, 'I', 300, 520),
(null, 3, null, 'R', 40, 60),
(null, 2, null, 'R', 20, 80),
(null, 1, null, 'I', 100, 620);
