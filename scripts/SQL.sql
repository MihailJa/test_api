CREATE TABLE IF NOT EXISTS students (
    student_id int(10) NOT NULL AUTO_INCREMENT,
    student_firstname varchar(255) NOT NULL,
    student_lastname varchar(255) NOT NULL,
    student_patronymic varchar(255) NOT NULL,
    student_age int(3) NOT NULL,
    student_sex int(1) NOT NULL,
    PRIMARY KEY (student_id)
) CHARSET=utf8;


CREATE TABLE IF NOT EXISTS courses (
    course_id int(10) NOT NULL AUTO_INCREMENT,
    course_name varchar(255) NOT NULL,     
    PRIMARY KEY (course_id)
) CHARSET=utf8;


CREATE TABLE IF NOT EXISTS stud_cours (
    id int(10) NOT NULL AUTO_INCREMENT,
    student_id int(10) NOT NULL,
    course_id int(10) NOT NULL,    
    PRIMARY KEY (id),
    FOREIGN KEY (student_id)  REFERENCES students (student_id),
    FOREIGN KEY (course_id)  REFERENCES courses (course_id)
) CHARSET=utf8;

INSERT INTO students (student_firstname, student_lastname, student_patronymic, student_age, student_sex)
VALUES ('Игорь', 'Иванов', 'Олегович', 19, 1 ),
       ('Павел', 'Николаев', 'Андреевич', 17, 1), 
       ('Мария', 'Андреева', 'Николаевна', 19, 2),
       ('Александр', 'Бородин', 'Петрович', 18, 1),
       ('Олег', 'Петров', 'Андреевич', 18, 1),
       ('Ксения', 'Губкина', 'Николаевна', 17, 2);



INSERT INTO courses (course_name)
VALUES ('HTML5'),
       ('CSS3'),
       ('JS'),
       ('PHP8'),
       ('Python');


INSERT INTO stud_cours (student_id, course_id)
VALUES (1, 1),
       (1,2),
       (1,3),
       (2,4),
       (2,5),
       (3,4),
       (3,5),
       (4,1),
       (4,3),
       (5,3),
       (6,1);
