<?php 
require_once('../xanthippe/includes/sql-jperetz.php');
$students = $mysqli->query("select student_syllabus_id, email, first_name, last_name, syllabus_syllabus_id from student s, class c where c.student_email = s.email  order by syllabus_syllabus_id, last_name;");
while ($student = $students->fetch_object()) {
    $indexer = $student->email.$student->student_syllabus_id;
	$list[$indexer] = $student;
}
$mysqli->close();	
require_once('../xanthippe/includes/JSON.php');
$json = new Services_JSON;
$studentList = $json->encode($list);
echo $studentList;