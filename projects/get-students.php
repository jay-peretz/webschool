<?php 
require_once('../xanthippe/includes/sql-jperetz.php');
$getstudents = $mysqli->query("select email, first_name ,last_name ,gallery_URL ,github_userid , type, student_syllabus_id, syllabus_syllabus_id , project_description from student, class where email = student_email order by syllabus_syllabus_id ASC , first_name ASC");
while ($studentrow = $getstudents->fetch_object()) {
	$students[$studentrow->student_syllabus_id] = $studentrow;
	 if ($getcomments = $mysqli->query("select id_project_comment, student_email, first_name , comment from project_comment , student where student_email = email and class_student_syllabus_id = ".$studentrow->student_syllabus_id)) {
		 while ($commentrow = $getcomments->fetch_object()) {
			 $students[$studentrow->student_syllabus_id]->comments[$commentrow->id_project_comment] = $commentrow;
		 }
	 }
}
require_once('../xanthippe/includes/JSON.php');
$json = new Services_JSON;
$studentlist = $json->encode($students);
echo $studentlist;
$getcomments->close();
$getstudents->close();
$mysqli->close();