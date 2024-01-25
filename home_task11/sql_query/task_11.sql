CREATE TABLE group_user(
	id int(5) AUTO_INCREMENT PRIMARY KEY, 
	role varchar(50)
);

CREATE TABLE users(
	id int(5) AUTO_INCREMENT PRIMARY KEY, 
	group_user_id int(5),
	username varchar(100),
	email varchar(50),
	password varchar(15)
);

CREATE TABLE messages(
	id int(5) AUTO_INCREMENT PRIMARY KEY, 
	user_id int(5),
	message text,
	date_added datetime
);

INSERT INTO group_users (role) VALUES ('admin');
INSERT INTO group_users (role) VALUES ('user');

INSERT INTO users (group_user_id,username,email,password) VALUES (2,'Petro','test1@test.loc','11111');
INSERT INTO users (group_user_id,username,email,password) VALUES (2,'Ivan','test2@test.loc','22222');
INSERT INTO users (group_user_id,username,email,password) VALUES (2,'Sasha','test3@test.loc','33333');
INSERT INTO users (group_user_id,username,email,password) VALUES (2,'Olga','test4@test.loc','44444');
INSERT INTO users (group_user_id,username,email,password) VALUES (2,'Anna','test5@test.loc','55555');
INSERT INTO users (group_user_id,username,email,password) VALUES (1,'Admin','admin_user@adm.loc','admin');