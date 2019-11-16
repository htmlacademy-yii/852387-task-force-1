DROP DATABASE taskForce;

CREATE DATABASE taskForce
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE taskForce;

CREATE TABLE `user` (
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL DEFAULT '',
  `email` VARCHAR(255) NOT NULL DEFAULT '',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `password` VARCHAR(64) NOT NULL DEFAULT '',
  `birthday` DATE,
  `city` VARCHAR(255),
  `role` INT NOT NULL, -- 1 === customer/ 2 === worker
  `info` TEXT,
  `phone` VARCHAR(255),
  `skype` VARCHAR(255),
  `another_chat` VARCHAR(255),
  `status_user` INT, -- занят над задачей/свободен(1/2)
  `rating` INT,
  `avatar_photo` VARCHAR(255),
  `last_activity_at` DATETIME,
  `page_visit_count` INT, -- сколько раз страница пользователя просматривалась
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `favorit` (
  `customer_id` INT unsigned NOT NULL,
  `worker_id` INT unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user_category` (
  `user_id` INT unsigned NOT NULL,
  `category` INT                       -- 10/20/30/..
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `notification` (
  `user_id` INT unsigned NOT NULL,
  `notice` INT                         -- 10/20/30/..
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `task` (
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` INT unsigned NOT NULL,
  `worker_id` INT unsigned NOT NULL,
  `category` INT,
  `name_task` VARCHAR(255),
  `icon_task` VARCHAR(255),
  `task_status` INT,
  `add_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `complite_date` DATE DEFAULT NULL,
  `info_task` VARCHAR(255),
  `file_url` VARCHAR(255), -- если несколько файлов, то нужна ещё таблица для файлов?
  `is_remote` VARCHAR(5), -- yes/no
  `location` VARCHAR(255),
  `price` INT,
  `coordinate` VARCHAR(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `review` (
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `user_id` INT unsigned NOT NULL,
  `task_id` INT unsigned NOT NULL,
  `text_review` VARCHAR(255),
  `score` INT unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `photo` (
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `task_id` INT unsigned NOT NULL,
  `user_id` INT unsigned NOT NULL,
  `photo` VARCHAR(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `comment` (
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `user_id` INT unsigned NOT NULL,
  `task_id` INT unsigned NOT NULL,
  `add_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `text_comment` VARCHAR(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `response` (
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `user_id` INT unsigned NOT NULL,
  `task_id` INT unsigned NOT NULL,
  `price` INT,
  `comment` VARCHAR(255),
  `created_at` DATETIME,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `attachment` (
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `task_id` INT unsigned NOT NULL,
  `filename` VARCHAR(225),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
