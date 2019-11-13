DROP DATABASE GTFS;

CREATE DATABASE GTFS;

USE GTFS;

CREATE TABLE nome (
 id_nome int not null primary key auto_increment,
 nome varchar(50) not null
 );

INSERT INTO nome (id_nome,nome) values ('vini');
INSERT INTO nome (id_nome,nome) values ('joão');

DROP TABLE api_user;
CREATE TABLE api_user(
user_id int not null primary key auto_increment,
username varchar(80) not null unique key,
email varchar(150) not null unique key,
password blob(256) not null,
thumbnail blob(256) null,
last_login datetime not null default now(),
created_at datetime not null default now(),
is_admin boolean not null default false
);

INSERT INTO api_user (username, email, password, thumbnail, last_login, created_at, is_admin)
VALUES ('vini','vini@vini.com',12345,null,now(),now(),true);