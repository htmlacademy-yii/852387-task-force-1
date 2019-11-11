CREATE DATABASE taskForce
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE taskForce;

CREATE TABLE `users` {
  `id` INT unsigned NOT NULL AUTO_INCTEMENT,
  `name` CHAR(255) NOT NULL,
  `email` CHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `password` CHAR(64) NOT NULL,
  `birthday` DATE,
  `city` CHAR(255),
  `role` CHAR(255) NOT NULL, -- customer/worker
  `info` CHAR,
  `phone` INT,
  `skype` CHAR(255),
  `another_chat` CHAR(255),
  `status_user` INT, -- занят над задачей/свободен(1/0)
  `rating` INT,
  `avatar` CHAR(255),
  `last_activity_at` TIMESTAMP,
  `popular` INT, -- сколько раз страница пользователя просматривалась
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
} ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `favorites` {
  `user_customer_id` INT unsigned NOT NULL,
  `user_worker_id` INT unsigned NOT NULL
} ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `specializations` {
  `user_id` INT unsigned NOT NULL,
  `courier` TINYINT DEFAULT '0',
  `remote` TINYINT DEFAULT '0',
  `repair_transport` TINYINT DEFAULT '0',
  `trasportation` TINYINT DEFAULT '0',
  `translation` TINYINT DEFAULT '0',
  `visit` TINYINT DEFAULT '0'
} ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `notice` {
  `user_id` INT unsigned NOT NULL,
  `new_message` TINYINT DEFAULT '0',
  `action_task` TINYINT DEFAULT '0',
  `new_review` TINYINT DEFAULT '0',
  `show_contacts` TINYINT DEFAULT '0',
} ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tasks` {
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `user_customer_id` INT unsigned NOT NULL,
  `user_worker_id` INT unsigned NOT NULL,
  `category` CHAR(255),
  `name_task` CHAR(255),
  `icon_task` CHAR(255),
  `add_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `complite_date` DATE DEFAULT NULL,
  `info_task` CHAR(255),
  `file_url` CHAR(255), -- если несколько файлов, то нужна ещё таблица для файлов?
  `location` CHAR(255),
  `price` INT,
  `coordinates` CHAR(255),
  PRIMARY KEY (`id`),
} ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `reviews` {
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `user_id` INT unsigned NOT NULL,
  `task_id` unsigned NOT NULL,
  `text_review` CHAR(255),
  `score` INT unsigned NOT NULL
} ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `status_task` {
  `task_id` INT unsigned NOT NULL,
  `new` TINYINT DEFAULT '1',
  `cancel` TINYINT DEFAULT '0',
  `done` TINYINT DEFAULT '0',
  `fail` TINYINT DEFAULT '0',
  `active` TINYINT DEFAULT '0'
} ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `photo_works` {
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `task_id` INT unsigned NOT NULL,
  `user_id` INT unsigned NOT NULL,
  `photo` CHAR(255)
} ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `comments` {
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `user_id` INT unsigned NOT NULL,
  `task_id` INT unsigned NOT NULL,
  `add_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `role_user` CHAR(255),             -- customer/worker
  `text_comment` CHAR(255)
} ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `responses` {
  `id` INT unsigned NOT NULL AUTO_INCREMENT,
  `user_id` INT unsigned NOT NULL,
  `task_id` INT unsigned NOT NULL,
  `price` INT,
  `comment` CHAR(255)
} ENGINE=InnoDB DEFAULT CHARSET=utf8;

