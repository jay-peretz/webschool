<?php

// load an external JSON library - required for php v5.1
require_once("includes/JSON.php");
//  create a json service
$json = new Services_JSON;
// load an external rest services library
require_once("includes/rest.php");
/* Create a MySQL Connection */
require_once("includes/sql-jperetz.php");
// get the request data object
$data = RestUtils::processRequest();
//get the request variable for the syllabus id
$requestVars = $data->getRequestVars();
$lesson_request =  $requestVars["lesson_id"];
// start the session to get the current user
session_start();
$user_email = $mysqli->real_escape_string( $_SESSION['user']['email'] );
// process request based on the method
switch($data->getMethod()) {
	case 'put':
		if ($lesson_request) {
			
		}
		break;
	case 'post':
		/* no support for GET method yet */
		break;
	case 'get':
		/* check for the syllabus_id POST request variable */
		if ($lesson_request) {
			// select the requested lesson
			if ($lessons = $mysqli->query("SELECT lesson_id, topics, description, lesson.lesson_date as sort_date, DATE_FORMAT(lesson_date,'%M %e, %Y' ) as lesson_date ,blogpost , wrapup FROM lesson  WHERE lesson_id = ".$lesson_request)) {
				while ($lesson = $lessons->fetch_object()) {
					$lesson_array[$lesson->lesson_id] = $lesson;
					/* Select the reading */
					if ($reads = $mysqli->query("SELECT read_id,description, title, ISDN, author, url, cover_image, optional, reading_url FROM reading LEFT JOIN resource on (resource.resource_id = reading.resource_resource_id) WHERE lesson_lesson_id =".$lesson->lesson_id)) {
						while ($read = $reads->fetch_object()) {
							$lesson_array[$lesson->lesson_id]->reads[$read->read_id] = $read;
						}
					}
					/* Select the explore */
					if ($explores = $mysqli->query("SELECT explore_id, description, resource_type, url FROM explore WHERE lesson_lesson_id = ".$lesson->lesson_id)) {
						while ($explore = $explores->fetch_object()) {
							$lesson_array[$lesson->lesson_id]->explores[$explore->explore_id] = $explore;
						}
					}
					/* Select the assignments */
					if ($assignments = $mysqli->query("SELECT assignment_id, position, name, assignment_alias.due_date, value FROM (SELECT assignment_id, name, DATE_FORMAT(assignment.due_date,'%m/%d/%y %h:%i %p' ) AS due_date, value, position FROM assignment UNION SELECT null AS assignment_id, null AS name, null AS due_date, null AS value, null AS position) assignment_alias, exercise WHERE (assignment_id = assignment_assignment_id OR (assignment_id IS NULL AND assignment_assignment_id IS NULL))AND lesson_lesson_id = ".$lesson->lesson_id." GROUP BY assignment_id ORDER BY position")) {
						while ($assignment = $assignments->fetch_object()) {
							$lesson_array[$lesson->lesson_id]->assignments[$assignment->position] = $assignment;
							/* Select the exercises */
							if ($assignment->assignment_id)
								$exercises = $mysqli->query("SELECT exercise_id, type, (due_date <= NOW() AND allow_late = FALSE) AS closed, description, DATE_FORMAT(due_date,'%a %b %D ' ) AS due_date, url, private, weight FROM (SELECT exercise_id, type, description, due_date, url, private, allow_late, weight FROM exercise WHERE due_date IS NOT NULL AND assignment_assignment_id = ".$assignment->assignment_id." AND lesson_lesson_id = ".$lesson->lesson_id." UNION SELECT exercise_id, type, description, (SELECT due_date FROM assignment WHERE assignment_id = ".$assignment->assignment_id.") AS due_date, url, private, allow_late, weight FROM exercise WHERE exercise.due_date IS NULL AND assignment_assignment_id = ".$assignment->assignment_id." AND lesson_lesson_id = ".$lesson->lesson_id.") t1");
							else
								$exercises = $mysqli->query("SELECT exercise_id, type, (due_date <= NOW() AND allow_late = FALSE) AS closed, description, DATE_FORMAT(due_date,'%a %b %D ' ) AS due_date , url, private, weight FROM exercise WHERE assignment_assignment_id IS NULL AND lesson_lesson_id = ".$lesson->lesson_id);
							if ($exercises) {
								while ($exercise = $exercises->fetch_object()) {
									$lesson_array[$lesson->lesson_id]->assignments[$assignment->position]->exercises[$exercise->exercise_id] = $exercise;
									if ($exercise->type == "form" || $isTest = ($exercise->type == "test")) {
										if ($isTest)
											$questions = $mysqli->query("SELECT question_id, question_num, question.text".($exercise->closed == 1 ? ", t1.number AS correct" : "" ).", t1.value FROM question JOIN test_option t1 ON t1.question_question_id = question.question_id RIGHT OUTER JOIN (SELECT question_question_id, Max(value) AS value FROM test_option GROUP BY question_question_id) AS t2 ON t2.question_question_id = question_id AND t1.value = t2.value WHERE exercise_exercise_id = ".$exercise->exercise_id." GROUP BY question_id");
										else
											$questions = $mysqli->query("SELECT question_id, question_num, text FROM question WHERE exercise_exercise_id = ".$exercise->exercise_id);
										if ($questions) {
											while ($question = $questions->fetch_object()) {
												$lesson_array[$lesson->lesson_id]->assignments[$assignment->position]->exercises[$exercise->exercise_id]->questions[$question->question_num] = $question;
												if ($isTest) {
													if ($options = $mysqli->query("SELECT number, text FROM test_option WHERE question_question_id = ".$question->question_id)) {
														while ($option = $options->fetch_object()) {
															$lesson_array[$lesson->lesson_id]->assignments[$assignment->position]->exercises[$exercise->exercise_id]->questions[$question->question_num]->options[$option->number] = $option->text;
														}
													}
												}
											}
										}
									}
									if ($homeworks = $mysqli->query( "SELECT homework_id, student_email, first_name, comment, URL FROM homework, student WHERE student_email = email and exercise_exercise_id = ".$exercise->exercise_id.($exercise->private ? " and email = '".$user_email."'" : ""))) {
										while ($homework = $homeworks->fetch_object()) {
											$lesson_array[$lesson->lesson_id]->assignments[$assignment->position]->exercises[$exercise->exercise_id]->homeworks[$homework->homework_id] = $homework;
											if ($exercise->type == "form") {
												if ($answers = $mysqli->query("SELECT question_num, form_answer.text FROM form_answer, question WHERE question_question_id = question_id AND homework_homework_id = ".$homework->homework_id)) {
													while ($answer = $answers->fetch_object()) {
														$lesson_array[$lesson->lesson_id]->assignments[$assignment->position]->exercises[$exercise->exercise_id]->homeworks[$homework->homework_id]->answers[$answer->question_num] = $answer;
													}
												}
											} else if ($exercise->type == "test") {
												if ($answers = $mysqli->query("SELECT question_num, test_option_number".($exercise->closed == 1 ? ", value" : "" )." FROM test_answer, test_option, question WHERE test_option_question_question_id = question_question_id AND test_option_number = number AND question_question_id = question_id AND homework_homework_id = ".$homework->homework_id)) {
													while ($answer = $answers->fetch_object()) {
														$lesson_array[$lesson->lesson_id]->assignments[$assignment->position]->exercises[$exercise->exercise_id]->homeworks[$homework->homework_id]->answers[$answer->question_num] = $answer->test_option_number;
														if ($exercise->closed == 1)
															$lesson_array[$lesson->lesson_id]->assignments[$assignment->position]->exercises[$exercise->exercise_id]->homeworks[$homework->homework_id]->scores[$answer->question_num] = $answer->value;
													}
												}
											}
											if ($reviews = $mysqli->query("SELECT review_id, student_email, first_name, grade,comment FROM review, student WHERE student_email = email and homework_homework_id = ".$homework->homework_id)) {
												while ($review = $reviews->fetch_object()) {
													$lesson_array[$lesson->lesson_id]->assignments[$assignment->position]->exercises[$exercise->exercise_id]->homeworks[$homework->homework_id]->reviews[$review->review_id] = $review;
												}
											}
										}
									}
								}
							}
						}
					}
				}
				
				/* free result set */
				//  $syllabi->close();
			}
			/* close SQL connectiot */
			$mysqli->close();
			
			//echo $json->encode($syllabus_array);
			$resultData = $json->encode($lesson_array);
			
			RestUtils::sendResponse(200, $resultData, 'application/json');
		}
		break;
}

?>
