CREATE DATABASE outcinema;

SHOW DATABASES;

USE outcinema;

CREATE TABLE usuario(
 id_usuario INT(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
 nombre VARCHAR(120),
 num_tel INT(9),
 email VARCHAR(210),
 password VARCHAR(100)); 

CREATE TABLE butacasVendidas(
    id int(12) PRIMARY KEY AUTO_INCREMENT,
    id_transaccion VARCHAR(10),
    id_usuario INT(6) REFERENCES usuario(id_usuario),
    nom_usuario VARCHAR(120) REFERENCES usuario(nombre),
    email_usuario VARCHAR(210) REFERENCES usuario(email),
    tipo_entrada VARCHAR(8) DEFAULT "Normal",
    precio INT(2) DEFAULT 8,
    pelicula VARCHAR (260), 
    fecha VARCHAR(30),
    hora VARCHAR(8),
    butaca VARCHAR(10)
);