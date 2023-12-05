CREATE TABLE `brand` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL
);

CREATE TABLE `user` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `PasswordConfirmation` varchar(255) NOT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL
);

CREATE TABLE `shoe` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `model` varchar(20) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `size` varchar(100) NOT NULL,
  `description` varchar(999) NOT NULL,
  `color` varchar(100) NOT NULL,
  `path` varchar(100) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `data_upload` datetime NOT NULL DEFAULT current_timestamp(),
  FOREIGN KEY (brand_id) REFERENCES brand(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
);

CREATE TABLE favorites(
 	`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 	`user_id` int(11) NOT NULL,
 	`shoe_id` int(11) NOT NULL,
 	FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
	FOREIGN KEY (shoe_id) REFERENCES shoe(id) ON DELETE CASCADE
);