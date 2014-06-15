<?php
require_once('../xanthippe/includes/sql-jperetz.php');
if ($_POST["comment"]) {
	$newcomment = $mysqli->prepare("insert into project_comment (student_email, comment, class_student_syllabus_id) values (?,?,?)");
	$newcomment->bind_param("ssi",$_POST['student_email'],$_POST['comment'],$_POST['id']);
	$newcomment->execute();
 	$commentid = $newcomment->insert_id;  	
	$newcomment->close();
	$getname = $mysqli->query('select first_name from student where email ="'.$_POST['student_email'].'"');
	$first_name = $getname->fetch_object();
	$getname->close();
}
$mysqli->close();
$returndata->commentid = $commentid;
$returndata->first_name = $first_name->first_name;
require_once('../xanthippe/includes/JSON.php');
$json = new Services_JSON;
$comment = $json->encode($returndata);
echo $comment;