<?php
$gradebookarray = array();
require_once("../xanthippe/includes/sql-jperetz.php");
if ($assignments = $mysqli->query('select * from assignment where syllabus_syllabus_id ='.$_GET['syllabus'].' order by assignment.position'))  { 
  $a = 0;
  while ($assignment = $assignments->fetch_object())
  {
      $gradebookarray[$assignment->assignment_id] = $assignment;
       if ($homeworks = $mysqli->query('select assignment_assignment_id, homework_id, exercise_exercise_id, submitted, homework.url, grade, comment , type, description, weight, due_date from homework ,  exercise where  exercise_exercise_id = exercise_id and student_email="'.$_GET['email'].'" and assignment_assignment_id ='.$assignment->assignment_id)) {
	   while ($homework = $homeworks->fetch_object())
	   {		   
		   $gradebookarray[$assignment->assignment_id]->homeworks[$homework->homework_id] = $homework;
		   switch ($homework->type) {
			   case "test":
			   		if ($testanswers = $mysqli->query('select o.text as correcttext,  a.test_answer_id , q.text as question,   a.test_option_number as answer ,o.number as correct from test_answer a, question q, test_option o where q.question_id = a.test_option_question_question_id and q.question_id = o.question_question_id and o.value = 1 and a.homework_homework_id ='.$homework->homework_id)) {
						while ($testanswer = $testanswers->fetch_object()) {
							$findwronganswer = $mysqli->query('select o.text as wronganswer from test_answer a, test_option o where a.test_option_question_question_id = o.question_question_id and  a.test_option_number = o.number and test_answer_id ='.$testanswer->test_answer_id);
						$wronganswer = $findwronganswer->fetch_object();
						$testanswer->wronganswer = $wronganswer->wronganswer;
						$findwronganswer->close();
							$gradebookarray[$assignment->assignment_id]->homeworks[$homework->homework_id]->testanswers[$testanswer->test_answer_id] = $testanswer;
						}
						$testanswers->close();
					}
					
			   		break;
			   case "url":
			   		break;
			   case "form":
			   		if ($formanswers = $mysqli->query('select form_answer_id, exercise_exercise_id, homework_homework_id, question_id, form_answer.text AS answer, question.text AS question, question_num from form_answer, question where question_id = question_question_id and homework_homework_id ='.$homework->homework_id)) {
						while($formanswer = $formanswers->fetch_object()) {
							$gradebookarray[$assignment->assignment_id]->homeworks[$homework->homework_id]->formsanswers[$formanswer->form_answer_id] = $formanswer;
						}
					//	$formanswers-close();
					}
					
			   		break;
		   }
	   }
	   
	  $homeworks->close();
   }
      
      }
  
  $assignments->close();
};
$mysqli->close(); 
require_once('../xanthippe/includes/JSON2.php');
$gradebook = __json_encode(array_values($gradebookarray));
echo $gradebook;
?>