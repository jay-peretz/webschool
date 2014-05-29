<?php
	$checklate = $mysqli->prepare("SELECT allow_late OR due_date IS NULL OR (due_date IS NOT NULL AND due_date >= NOW()) FROM (SELECT exercise.due_date, allow_late FROM exercise LEFT JOIN assignment ON assignment_assignment_id = assignment_id WHERE exercise.due_date IS NOT NULL AND exercise_id = ? UNION SELECT assignment.due_date, allow_late FROM exercise LEFT JOIN assignment ON assignment_assignment_id = assignment_id WHERE exercise.due_date IS NULL AND exercise_id = ?) t1");
	$checklate->bind_param('ii',$_POST['exercise_id'],$_POST['exercise_id']);
	$checklate->execute();
	$checklate->bind_result($isNotLate);
	$checklate->fetch();
	$checklate->close();
