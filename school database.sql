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
INSERT INTO etudiant (id,name,birthday,src_image,alt_image,section)Values
(1, 'Malek','2004-10-8',"images\photomalek.jpg","photo1" ,'GL'),
(2, 'Emna','2005-01-01',"images\photoemna.jpg","photo2" ,'GL'),
(3, 'Emna','2004-07-21',"images\photoemnaa.jpg","photo3",'GL');
INSERT INTO section (id,designation,description)Values
(1,'GL','Genie Logiciel'),
(2,'RT','Reseaux et Telecommunications'),
(3,'IIA','Informatique Industrielle et Automatique'),
(4,'IMI','Instrumentation et Maintenance Industrielle');
SHOW TABLES;
