DROP DATABASE GTFS;

CREATE DATABASE GTFS;

USE GTFS;

CREATE TABLE nome (
 id_nome int not null primary key auto_increment,
 nome varchar(50) not null
 );

INSERT INTO nome (id_nome,nome) values ('vini');
INSERT INTO nome (id_nome,nome) values ('joão');