CREATE DATABASE fileshare;
USE fileshare;
CREATE TABLE login_details (id int NOT NULL AUTO_INCREMENT, email text, username text, password text, PRIMARY KEY (id));
CREATE TABLE upload_files (id int NOT NULL AUTO_INCREMENT, username text, file_upld text, PRIMARY KEY (id));