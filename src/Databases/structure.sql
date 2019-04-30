drop database wildPost;
create database wildPost;

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
articleDate VARCHAR(20) NOT NULL,
content text NOT NULL,
tag VARCHAR(30)
);


DROP TABLE IF EXISTS authors;
CREATE TABLE `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `valid` boolean DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

