CREATE DATABASE sitebuilder
	CHARACTER SET utf8
	COLLATE utf8_general_ci;

CREATE TABLE users(
  `id` int(11) not null auto_increment primary key,
  `firstname` varchar(100) not null,
  `lastname` varchar(100) not null,
  `email` varchar(50) not null,
  `username` varchar(50) not null,
  `password` varchar(255) not null,
  `token` varchar(255) not null,
  `is_active` enum('0', '1') not null,
  `date_time` date not null
); 