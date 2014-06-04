<?php 
require_once('sql-jperetz.php');
$selecthomeworks = $mysqli->query('select  h.homework_id,e.description, weight, 
DATE_FORMAT(due_date,"%b %e") due_date, DATE_FORMAT(h.submitted,"%b %e") submitted, exercise_id, grade, DATE_FORMAT(h.graded,"%b %e") graded 
from  jperetz.exercise e left join 
(select exercise_exercise_id , submitted, homework_id, grade, graded from jperetz.homework where student_email = "'.$_GET['email'].'") h on  (e.exercise_id = h.exercise_exercise_id ) 
inner join jperetz.lesson l on l.lesson_id = e.lesson_lesson_id  
where l.syllabus_syllabus_id='.$_GET["syllabus_id"].' and e.private = 0 order by exercise_id');
$i = 0;
while ($homework = $selecthomeworks->fetch_object()) {
    $homeworks[$i] = $homework;
    $i = $i + 1;
};
$mysqli->close();
require_once('JSON.php');
$json = new Services_JSON;
$homeworkList = $json->encode($homeworks);
echo $homeworkList;