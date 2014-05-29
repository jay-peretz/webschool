<?php
$submissionarray = array();
require_once("../xanthippe/includes/sql-jperetz.php");
if ($submissions = $mysqli->query('select  email,  homework_id, first_name, last_name, submitted, e.type as type, c.srjc_id, e.description, h.URL, grade value, graded, comment, e.weight weight from homework h, exercise e, lesson l, syllabus s, student st, course c  where h.exercise_exercise_id = e.exercise_id and e.lesson_lesson_id = l.lesson_id and l.syllabus_syllabus_id = s.syllabus_id and h.student_email = st.email and s.course_course_id = c.course_id   and l.syllabus_syllabus_id = '.$_GET['syllabus_id'].' order by submitted desc;'))  { 
  while ($submission = $submissions->fetch_object())
  {   
   $submissionarray[$submission->homework_id] = $submission;
		   switch ($submission->type) {
			   case "test":
			   		if ($testanswers = $mysqli->query('select o.text as correcttext,  a.test_answer_id , q.text as question,   a.test_option_number as answer ,o.number as correct,  q.question_id from test_answer a, question q, test_option o where q.question_id = a.test_option_question_question_id and q.question_id = o.question_question_id and o.value = 1 and a.homework_homework_id ='.$submission->homework_id)) {
						while ($testanswer = $testanswers->fetch_object()) {
							$findwronganswer = $mysqli->query('select o.text as wronganswer from test_answer a, test_option o where a.test_option_number = o.number and test_answer_id ='.$testanswer->test_answer_id.' and o.question_question_id ='.$testanswer->question_id);
						$wronganswer = $findwronganswer->fetch_object();
						$testanswer->wronganswer = $wronganswer->wronganswer;
						$findwronganswer->close();
							$submissionarray[$submission->homework_id]->testanswers[$testanswer->test_answer_id] = $testanswer;
						}
						$testanswers->close();
					}
					
			   		break;
			   case "url":
			   		break;
			   case "form":
			   		if ($formanswers = $mysqli->query('select form_answer_id, exercise_exercise_id, homework_homework_id, question_id, form_answer.text AS answer, question.text AS question, question_num from form_answer, question where question_id = question_question_id and homework_homework_id ='.$submission->homework_id)) {
						while($formanswer = $formanswers->fetch_object()) {
							$submissionarray[$submission->homework_id]->formsanswers[$formanswer->form_answer_id] = $formanswer;
						}
					//	$formanswers-close();
					}
					
			   		break;
		   }
	   }
	   
	  $submissions->close();
};
$mysqli->close(); 
require_once('../xanthippe/includes/JSON2.php');
$homeworks = __json_encode(array_values($submissionarray));
echo $homeworks;
?>