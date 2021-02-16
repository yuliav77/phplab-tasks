CREATE DATABASE test;

CREATE TABLE students (
id INT AUTO_INCREMENT PRIMARY KEY,
first_name VARCHAR(55) NOT NULL,
last_name VARCHAR(55) NOT NULL,
birth_date DATE,
origin_city VARCHAR(25)
);

CREATE TABLE courses (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL,
description TINYTEXT,
fee FLOAT(10,2) NOT NULL,
start_date DATE
);

CREATE TABLE bonuses (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL,
discount DECIMAL(5,2)
);

ALTER TABLE bonuses
ADD CONSTRAINT check_discount_value 
CHECK (discount >= 0 AND discount <= 1);

CREATE TABLE applications (
id INT AUTO_INCREMENT PRIMARY KEY,
student_id INT,
course_id INT,
bonus_id INT,
approved BOOLEAN NOT NULL DEFAULT FALSE,
app_comment VARCHAR(100),
FOREIGN KEY (student_id)  REFERENCES students (id),
FOREIGN KEY (course_id)  REFERENCES courses (id),
FOREIGN KEY (bonus_id)  REFERENCES bonuses (id)
);

ALTER TABLE applications
ALTER bonus_id SET DEFAULT 1;

CREATE TABLE payments (
id INT AUTO_INCREMENT PRIMARY KEY,
student_id INT,
course_id INT,
payment_amount FLOAT(10,2) NOT NULL,
payment_date date NOT NULL,
FOREIGN KEY (student_id)  REFERENCES students (id),
FOREIGN KEY (course_id)  REFERENCES courses (id)
);

INSERT INTO students
VALUES (1, 'Petro', 'Ivanov', '1990.11.10', 'Odessa');

INSERT INTO students(first_name, last_name, birth_date, origin_city)
VALUES ('Ivan', 'Sidorov', '1980.01.20', 'Lviv');

INSERT INTO courses(title, description, fee, start_date)
VALUES ('PHP Basics', 'Introduction to PHP, basic concepts.', 500.60, '2021.03.24');

INSERT INTO courses(title, description, fee, start_date)
VALUES ('Advanced PHP Programming', 'This PHP training covers the Object Oriented components of PHP8, including advanced features.', 2500.10, '2021.03.30');

INSERT INTO bonuses(title, discount)
VALUES ('No discount', 0);

INSERT INTO bonuses(title, discount)
VALUES ('Grant 1', 0.2);

INSERT INTO bonuses(title, discount)
VALUES ('Grant 2', 0.5);

INSERT INTO applications(student_id, course_id)
VALUES (1, 1);

INSERT INTO applications(student_id, course_id, bonus_id)
VALUES (2, 1, 2);

INSERT INTO payments(student_id, course_id, payment_amount, payment_date)
VALUES (1, 1, 500.60, '2021.02.23');

INSERT INTO payments(student_id, course_id, payment_amount, payment_date)
VALUES (2, 1, 500.00, '2021.02.22');
