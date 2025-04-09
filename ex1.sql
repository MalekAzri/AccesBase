CREATE DATABASE IF NOT EXISTS school;
DROP TABLE IF EXISTS student;
USE school;

CREATE TABLE IF NOT EXISTS student (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    birthday DATE NOT NULL
);

INSERT INTO student (id, name, birthday) VALUES
(1,'Aymen', '1982-02-07'),
(2,'Skandar', '2018-07-11');
SHOW TABLES;
SHOW DATABASES;
select * from student;

CREATE TABLE section (
    id INT AUTO_INCREMENT PRIMARY KEY,
    designation VARCHAR(255) NOT NULL,
    description TEXT
);

CREATE TABLE etudiant (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    birthday DATE NOT NULL,
    image VARCHAR(255), 
    section_id INT,
    FOREIGN KEY (section_id) REFERENCES section(id) ON DELETE SET NULL
);

