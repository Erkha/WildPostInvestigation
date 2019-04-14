DROP DATABASE IF EXISTS wildPost;

create database wildPost character set UTF8mb4 collate utf8mb4_bin;

USE wildPost;

CREATE TABLE articles
(
id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
title VARCHAR(100) NOT NULL,
date DATE NOT NULL,
author VARCHAR(50) NOT NULL,
category VARCHAR(50) NOT NULL,
shortText VARCHAR(150) NOT NULL,
content text NOT NULL,
tag VARCHAR(30) NULL
);