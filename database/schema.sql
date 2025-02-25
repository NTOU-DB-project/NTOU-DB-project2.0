CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creator_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (creator_id) REFERENCES users(id)
);

CREATE TABLE `note_auths` (
  `user_id` int (11) NOT NULL,
  `note_id` int (11) NOT NULL,
  `can_read` BIT,
  `creator_id` int(11) Not NULL,
  PRIMARY KEY(`user_id`, `note_id`),
  FOREIGN KEY (creator_id) REFERENCES users(id),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN key (note_id) REFERENCES notes(id)
);

-- CREATE TABLE `image` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `note_id` int(11) NOT NULL,
--   `url` varchar(255) NOT NULL,
--   PRIMARY KEY (`id`),
--   FOREIGN KEY (note_id) REFERENCES notes(id)
-- )

