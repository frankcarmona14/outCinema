CREATE DATABASE outcinema;

SHOW DATABASES;

USE outcinema;

CREATE TABLE usuario(
    id_usuario INT(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    admin TINYINT(1) NOT NULL DEFAULT 0,
    nombre VARCHAR(120),
    num_tel INT(9),
    email VARCHAR(210),
    password VARCHAR(100)
 ); 

CREATE TABLE precios(
    tipo VARCHAR(30) PRIMARY KEY,
    precio DECIMAL(4,2)
);

CREATE TABLE butacasVendidas(
    id int(12) PRIMARY KEY AUTO_INCREMENT,
    id_transaccion VARCHAR(10),
    id_usuario INT(10) REFERENCES usuario(id_usuario),
    nom_usuario VARCHAR(120) REFERENCES usuario(nombre),
    tipo_entrada VARCHAR(20) REFERENCES precios(tipo),
    precio DECIMAL(4,2) REFERENCES precios(precio),
    pelicula VARCHAR (260), 
    fecha VARCHAR(30),
    hora VARCHAR(8),
    butaca VARCHAR(10),
    scan TINYINT(1) NOT NULL DEFAULT 0
);

INSERT INTO precios(tipo, precio) VALUES('Entrada general', 9);
INSERT INTO precios(tipo, precio) VALUES('Entrada reducida', 7.50);