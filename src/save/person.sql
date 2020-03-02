CREATE TABLE `users` (
  `id_user` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(64) NOT NULL,
  `mail` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `signature` varchar(260) ,
  `avatar` varchar(64) NOT NULL
);

CREATE TABLE `topics` (
  `id_topic` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `content` varchar(500) NOT NULL,
  `date` datetime,
  `date_up` datetime,
  `user_id` int(11),
  `board_id` int(11)
);

CREATE TABLE `boards` (
  `id_board` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` varchar(500) NOT NULL
);

CREATE TABLE `comments` (
  `id_comment` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `content` varchar(500) NOT NULL,
  `date` datetime,
  `user_id` int(11),
  `topic_id` int(11)
);

ALTER TABLE `topics` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);

ALTER TABLE `topics` ADD FOREIGN KEY (`board_id`) REFERENCES `boards` (`id_board`);

ALTER TABLE `comments` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);

ALTER TABLE `comments` ADD FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id_topic`);