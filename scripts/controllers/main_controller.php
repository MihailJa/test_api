<?php

// INIT
/*
require_once '../../models/courses_model.php';
require_once '../../models/students_model.php';*/


DB::connect();

$q = DB::query("CREATE TABLE IF NOT EXISTS students (
    student_id int(10) NOT NULL AUTO_INCREMENT,
    student_firstname varchar(255) NOT NULL,
    student_lastname varchar(255) NOT NULL,
    student_patronymic varchar(255) NOT NULL,
    student_age int(3) NOT NULL,
    student_sex int(1) NOT NULL,
    PRIMARY KEY (student_id)
) CHARSET=utf8;
") or die (DB::error());

$q = DB::query("CREATE TABLE IF NOT EXISTS courses (
    course_id int(10) NOT NULL AUTO_INCREMENT,
    course_name varchar(255) NOT NULL,     
    PRIMARY KEY (course_id)
) CHARSET=utf8;
") or die (DB::error());

$q = DB::query("CREATE TABLE IF NOT EXISTS stud_cours (
    id int(10) NOT NULL AUTO_INCREMENT,
    student_id int(10) NOT NULL,
    course_id int(10) NOT NULL,    
    PRIMARY KEY (id),
    FOREIGN KEY (student_id)  REFERENCES students (student_id),
    FOREIGN KEY (course_id)  REFERENCES courses (course_id)
) CHARSET=utf8;
") or die (DB::error());


$q = DB::query("INSERT INTO students (student_firstname, student_lastname, student_patronymic, student_age, student_sex)
VALUES ('Игорь', 'Иванов', 'Олегович', 19, 1 ),
       ('Павел', 'Николаев', 'Андреевич', 17, 1), 
       ('Мария', 'Андреева', 'Николаевна', 19, 2),
       ('Александр', 'Бородин', 'Петрович', 18, 1),
       ('Олег', 'Петров', 'Андреевич', 18, 1),
       ('Ксения', 'Губкина', 'Николаевна', 17, 2);
") or die (DB::error());


$q = DB::query("INSERT INTO courses (course_name)
VALUES ('HTML5'),
       ('CSS3'),
       ('JS'),
       ('PHP8'),
       ('Python');
") or die (DB::error());

$q = DB::query("INSERT INTO stud_cours (student_id, course_id)
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
") or die (DB::error());

//HTML::$compile_dir = '../'.HTML::$compile_dir;

// URL

// vars

$result = [];
$query = [];
//$path = '';
$method = $_SERVER['REQUEST_METHOD'];

// headers

$headers = getallheaders();
/*$project = $headers['project'] ?? '';
$token = $headers['token'] ?? '';
$v = $headers['v'] ?? 0;*/

header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');

// path
$url = $_SERVER['REQUEST_URI'];

//$url = preg_replace('~^/api/~i', '', $url);
$url = explode('?', $url);
//$path = isset($url[0]) && $url[0] ? flt_input($url[0]) : '';

// query

if ($method == 'GET') isset($url[1]) ? parse_str($url[1], $query_raw) : $query_raw = [];
else $query_raw = json_decode(file_get_contents('php://input'), true);
if (!$query_raw && $_POST) $query_raw = $_POST;
if (is_array($query_raw)) foreach ($query_raw as $key => $value) $query[flt_input($key)] = flt_input($value);

// ROUTES
/*
error_log($method);
error_log($path);
error_log($token);
error_log(json_encode($query, JSON_UNESCAPED_UNICODE));*/

// validate
/*
if (!$v) response(error_response(1002, 'Invalid request: v (version API) is required'));
else if ($v != 1) response(error_response(1002, 'Invalid request: v (version API) is incorrect'));

if (!$project) response(error_response(1002, 'Invalid request: project is required'));
else if (!in_array($project, ['copybro', 'mafin'])) response(error_response(1002, 'Invalid request: project is incorrect'));
*/
// routes

var_dump($path);
var_dump($url);
var_dump($method);
var_dump($query_raw);
if ($path == 'courses') call('GET', $method, $query, 'Courses::courses_by_student');
else if ($path == 'students') call('GET', $method, $query, 'Students::students_for_military');
else {    
    response(error_response(1002, 'Application authorization failed: method is unavailable with service token.'));
}
