<?php

// load an external JSON library - required for php v5.1
require_once("includes/JSON.php");
//create a json service
$json = new Services_JSON;
//load an external rest services library
require_once("includes/rest.php");
/* Create a MySQL Connection */
require_once("includes/sql-jperetz.php");
//get the request data object
$data = RestUtils::processRequest();
//get the request variable for the syllabus id
$requestVars = $data->getRequestVars();
$syllabus_request =  $requestVars["syllabus_id"];
//start the session to get the current user
session_start();
//process request based on the method
switch($data->getMethod()) {
case 'put':
	if ($syllabus_request) {
		
	}
	break;
case 'post':
	/* no support for GET method yet */
	break;
case 'get':
	/* check for the syllabus_id POST request variable */
	if ($syllabus_request) {
		/* Select the requested syllabus */
		if ($syllabi = $mysqli->query("SELECT syllabus_id, lecture_instructions, semester, section_number, course_name, srjc_id, repository FROM course, syllabus where syllabus.course_course_id = course.course_id and syllabus_id=".$syllabus_request)) {
			while ($syllabus = $syllabi->fetch_object()) {
				$syllabus_array[$syllabus->syllabus_id] = $syllabus;
				/* Select the students in the class */
				$studentquery = "SELECT email, first_name, last_name, gallery_URL, github_userid , type , project_description FROM student , class where email = student_email and syllabus_syllabus_id = ".$syllabus->syllabus_id." ORDER BY first_name";
				if ($students = $mysqli->query($studentquery)) {
					while ($student = $students->fetch_object()) {
						$student->gravatar_hash = md5( strtolower( trim($student->email ) ) );
						$syllabus_array[$syllabus->syllabus_id]->students[$student->email] = $student;
						// get homework for each student
						if ($hwsubmissions = $mysqli->query('SELECT topics, homework_id,student_email, first_name, comment, homework.URL url FROM homework , student , exercise, lesson where student_email = email and exercise_exercise_id = exercise_id and lesson_lesson_id = lesson_id and email="'.$student->email.'"')) {
							while ($hwsubmission = $hwsubmissions->fetch_object()) {
								$syllabus_array[$syllabus->syllabus_id]->students[$student->email]->homeworks[$hwsubmission->homework_id] =  $hwsubmission;
							}
							/* free result set */
							$hwsubmissions->close();
						}
					}
					/* free result set */
					$students->close();
				}
				/* Select the lessons in date order */
				if ($lessons = $mysqli->query('SELECT lesson_id, topics, description, lesson.lesson_date as sort_date, DATE_FORMAT(lesson.lesson_date,"%b %e") as lesson_date, blogpost, is_active FROM lesson WHERE syllabus_syllabus_id = '.$syllabus->syllabus_id.' ORDER BY sort_date ASC')) {
					while ($lesson = $lessons->fetch_object()) {
						$syllabus_array[$syllabus->syllabus_id]->lessons[$lesson->lesson_id] = $lesson;
					}
					/* free result set */
					$lessons->close();
				}
				
				/* Select the assignments and associated grades in position order */
				if ($assignments = $mysqli->query('SELECT assignment_id, position, name, grade.value AS score, assignment.value AS value, due_date FROM assignment LEFT JOIN (SELECT * FROM grade WHERE student_email = "'.$mysqli->real_escape_string($_SESSION['user']['email']).'") AS grade ON assignment_assignment_id = assignment_id WHERE syllabus_syllabus_id = '.$syllabus->syllabus_id.' ORDER BY position ASC')) {
					while ($assignment = $assignments->fetch_object()) {
						$syllabus_array[$syllabus->syllabus_id]->assignments[$assignment->position] = $assignment;
					}
					/* free result set */
					$assignments->close();
				}
				
				/* Select the student's grades */
				if ($grades = $mysqli->query('SELECT SUM(grade.value) AS cur, SUM(assignment.value) AS top, (SELECT SUM(value) FROM assignment WHERE syllabus_syllabus_id = '.$syllabus->syllabus_id.') AS tot FROM grade, assignment WHERE assignment_assignment_id = assignment_id AND student_email = "'.$mysqli->real_escape_string($_SESSION['user']['email']).'" AND syllabus_syllabus_id = '.$syllabus->syllabus_id)) {
					if ($grade = $grades->fetch_object()) {
						$syllabus_array[$syllabus->syllabus_id]->grades = $grade;
					}
					/* free result set */
					$grades->close();
				}
			}
			/* free result set */
			$syllabi->close();
		}
		/* close SQL connectiot */
		$mysqli->close();
		
		//echo $json->encode($syllabus_array);
		$resultData = $json->encode($syllabus_array);
		
		RestUtils::sendResponse(200, $resultData, 'application/json');
		break;
	}
}

?>
