DROP DATABASE taskForce;

CREATE DATABASE taskForce
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE taskForce;

CREATE TABLE `profiles` (
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `user_id` INT unsigned NOT NULL,
  `address` VARCHAR(255),
  `birthday` DATE,
  `about` TEXT,
  `phone` VARCHAR(255),
  `skype` VARCHAR(255),
  `another_chat` VARCHAR(255),
  `city_id` INT,
  `role` INT NOT NULL, -- 1 === customer/ 2 === worker
  `status` INT, -- занят над задачей/свободен(1/2)
  `rating` INT,
  `avatar_photo` VARCHAR(255),
  `last_activity_at` DATETIME,
  `page_visit_count` INT -- сколько раз страница пользователя просматривалась
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users` (
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255),
  `name` VARCHAR(255),
  `password` VARCHAR(64),
  `add_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `favorites` (
  `client_id` INT unsigned NOT NULL,
  `worker_id` INT unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user_categories` (
  `user_id` INT unsigned NOT NULL,
  `category_id` INT                       -- 10/20/30/..
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `categories` (
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255),
  `icon` VARCHAR(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `cities` (
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `city` VARCHAR(255),
  `coordinate_lat` DECIMAL(10, 7),
  `coordinate_long` DECIMAL(10,7),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `notifications` (
  `user_id` INT unsigned NOT NULL,
  `notice` INT                         -- 10/20/30/..
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tasks` (
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `client_id` INT unsigned NOT NULL,
  `worker_id` INT unsigned NOT NULL,
  `add_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `category_id` INT unsigned NOT NULL,
  `description` VARCHAR(255),
  `complete_date` DATE DEFAULT NULL,
  `name` VARCHAR(255),
  `address` VARCHAR(255),
  `budget` INT,
  `coordinate_lat` DECIMAL(10, 7),
  `coordinate_long` DECIMAL(10,7),
  `icon` VARCHAR(255),
  `status` INT,
  `file_url` VARCHAR(255),
  `is_remote` VARCHAR(5), -- yes/no
  `city` INT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `opinions` (
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `user_id` INT unsigned NOT NULL,
  `task_id` INT unsigned NOT NULL,
  `add_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `rate` INT unsigned NOT NULL,
  `description` VARCHAR(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `photo_works` (
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `task_id` INT unsigned NOT NULL,
  `user_id` INT unsigned NOT NULL,
  `photo` VARCHAR(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `comments` (
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `user_id` INT unsigned NOT NULL,
  `task_id` INT unsigned NOT NULL,
  `add_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `description` VARCHAR(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `responses` (
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `user_id` INT unsigned NOT NULL,
  `task_id` INT unsigned NOT NULL,
  `add_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `price` INT,
  `comment` VARCHAR(255),
  `created_at` DATETIME,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `attachments` (
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `task_id` INT unsigned NOT NULL,
  `filename` VARCHAR(225),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
