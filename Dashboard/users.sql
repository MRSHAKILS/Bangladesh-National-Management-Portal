create table users (
	user_id int primary key AUTO_INCREMENT,
	username varchar(255) NOT NULL UNIQUE,
	email varchar(150) NOT NULL,
	password varchar(255) NOT NULL,
	registration_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);