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