CREATE TABLE students(
    id int(5) AUTO_INCREMENT PRIMARY KEY,
    faculty_id int(5),
    pib varchar(300),
    telephone varchar(20),
    age int(3),
    birthday date,
    other_info text);

CREATE TABLE faculty(
    id int(5) AUTO_INCREMENT PRIMARY KEY,
    name varchar(100),
    description varchar(300));

CREATE TABLE subject(
    id int(5) AUTO_INCREMENT PRIMARY KEY,
    faculty_id int(5),
    name varchar(100),
    description varchar(300));

CREATE TABLE rating(
id int(5) AUTO_INCREMENT PRIMARY KEY,
indication int(2));

CREATE TABLE students_rating(
id int(5) AUTO_INCREMENT PRIMARY KEY,
student_id int(5),
subject_id int(5),
rating_id int(5));


INSERT INTO faculty(id, name, description) VALUES (1,'Computer Science','The faculty that is engaged in the study of computer areas');
INSERT INTO faculty(id, name, description) VALUES (2,'Management','Is engaged in teaching enterprise resource management');

INSERT INTO subject(id, faculty_id, name, description) VALUES (1, 1, 'Programming on PHP','The subject on which the basics of the PHP language are studied');
INSERT INTO subject(id, faculty_id, name, description) VALUES (2, 2, 'Administrative management','The subject deals with the study of measures and methods of managing people at the enterprise, aimed exclusively at achieving set goals');

INSERT INTO students(id, faculty_id, pib, telephone, age, birthday, other_info) VALUES (1,1,'Petrenko Petro Petrovich','+38(050)111-11-11',24,'1999-05-15','info student 1');
INSERT INTO students(id, faculty_id, pib, telephone, age, birthday, other_info) VALUES (2,2,'Ivanchenko Ivan Ivanovich','+38(099)123-45-67',22,'2001-03-11','info student 2');

INSERT INTO rating(id, indication) VALUES (1, 4);
INSERT INTO rating(id, indication) VALUES (2, 5);

INSERT INTO students_rating(id, student_id, subject_id, rating_id) VALUES (1,1,1,2);
INSERT INTO students_rating(id, student_id, subject_id, rating_id) VALUES (2,2,2,1);

