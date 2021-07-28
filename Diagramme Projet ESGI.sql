CREATE TABLE `eazf_user` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `firstname` varchar(50),
  `lastname` varchar(100),
  `birth_date` date,
  `email` varchar(320),
  `password` varchar(255),
  `country` char(2),
  `state` tinyint(4),
  `role` tinyint(4),
  `isDeleted` tinyint(1),
  `createdAt` timestamp,
  `updatedAt` timestamp
);

CREATE TABLE `eazf_article` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(50),
  `image_header` varchar(50),
  `content` text,
  `fk_category` int,
  `fk_page` int,
  `fk_author` int,
  `keywords_json` json,
  `created_at` timestamp,
  `edited_at` timestamp
);

CREATE TABLE `eazf_category` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(50),
  `description` text,
  `image` varchar(50)
);

CREATE TABLE `eazf_page` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(50),
  `fk_author` int
);

CREATE TABLE `eazf_comment` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `fk_author` int,
  `fk_article` int,
  `comment` text,
  `created_at` timestamp,
  `edited_at` timestamp
);

ALTER TABLE `eazf_category` ADD FOREIGN KEY (`id`) REFERENCES `eazf_article` (`fk_category`);

ALTER TABLE `eazf_page` ADD FOREIGN KEY (`id`) REFERENCES `eazf_article` (`fk_page`);

ALTER TABLE `eazf_article` ADD FOREIGN KEY (`fk_author`) REFERENCES `eazf_user` (`id`);

ALTER TABLE `eazf_page` ADD FOREIGN KEY (`fk_author`) REFERENCES `eazf_user` (`id`);

ALTER TABLE `eazf_comment` ADD FOREIGN KEY (`fk_author`) REFERENCES `eazf_user` (`id`);

ALTER TABLE `eazf_comment` ADD FOREIGN KEY (`fk_article`) REFERENCES `eazf_article` (`id`);
