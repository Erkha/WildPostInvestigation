DROP DATABASE IF EXISTS wildPost;

create database wildPost character set UTF8mb4 collate utf8mb4_bin;

USE wildPost;

CREATE TABLE articles
(
id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
title VARCHAR(100) NOT NULL,
articleDate DATE NOT NULL,
author VARCHAR(50) NOT NULL,
category VARCHAR(50) NOT NULL,
content text NOT NULL,
tag VARCHAR(30),
topArt BOOL NOT NULL,
published BOOL NOT NULL,
imageName VARCHAR(50)
);

CREATE TABLE category
(
id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
name VARCHAR(50) NOT NULL
);
insert into category (name) values ('Sport');
insert into category (name) values ('Meteo');
insert into category (name) values ('Politique');


CREATE TABLE live
(
id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
articleDate DATE NOT NULL,
content text NOT NULL,
tag VARCHAR(30)
);

