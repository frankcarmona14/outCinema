CREATE DATABASE outcinema;

SHOW DATABASES;

USE outcinema;

CREATE TABLE usuario(
 id_usuario INT(6) PRIMARY KEY NOT NULL AUTO_INCREMENT,
 admin INT(1) DEFAULT 0,
 nombre VARCHAR(100),
 num_tel INT(9),
 email VARCHAR(110),
 password VARCHAR(100)); 

CREATE TABLE pelicula(
 id_pelicula INT(6) PRIMARY KEY NOT NULL AUTO_INCREMENT,
 nombre VARCHAR(150) NOT NULL,
 fecha_estreno VARCHAR(10),
 fecha_retiro VARCHAR(10));

CREATE TABLE cartelera(
 mes int(2) PRIMARY KEY NOT NULL,
 id_pelicula INT(6) REFERENCES pelicula(id_pelicula),
 nombre VARCHAR(120) REFERENCES pelicula(nombre),
 horarios VARCHAR(10));

CREATE TABLE butacasVendidas(
    id int(10) PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT(6) REFERENCES usuario(id_usuario),
    nom_usuario VARCHAR(100) REFERENCES usuario(nombre),
    email_usuario VARCHAR(110) REFERENCES usuario(email),
    pelicula VARCHAR (115), 
    fecha VARCHAR(20),
    hora VARCHAR(5),
    butaca VARCHAR(8)
);