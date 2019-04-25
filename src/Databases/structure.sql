drop database wildPost;
create database wildPost;

USE wildPost;


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


DROP TABLE IF EXISTS categories;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS fluxlive;
CREATE TABLE `fluxLive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_heure` datetime NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS tags;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS articles;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `longText` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `topArt` boolean NOT NULL,
  `published` boolean NOT NULL,
  `category_id` int(11) NOT NULL,
  
  PRIMARY KEY (`id`),
  KEY `fk_articles_categories_idx` (`category_id`),
  KEY `fk_articles_authors_idx` (`author_id`),
  
  CONSTRAINT `fk_articles_authors` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_articles_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS imagesArticle;
CREATE TABLE `imagesArticle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `repertory_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_imagesArticle_Articles_idx` (`article_id`),
  CONSTRAINT `fk_imagesArticle_Articles` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS tagsArticle;
CREATE TABLE `tagsArticle` (
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`article_id`,`tag_id`),
  KEY `fk_tagsArticle_tags_idx` (`tag_id`),
  CONSTRAINT `fk_tagsArticle_articles` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tagsArticle_tags` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



insert into categories (name) values ('Sport');
insert into categories (name) values ('Meteo');
insert into categories (name) values ('Politique');
