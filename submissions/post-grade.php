<?php 
require_once('../xanthippe/includes/sql-jperetz.php');
if ($_POST['homeworkid'] && $_POST['grade'] != null) {
	 $row = $mysqli->prepare("update homework set  grade = ? where homework_id = ?");
     $row->bind_param('si',$_POST['grade'],$_POST['homeworkid']);
     $row->execute(); 
	 $row->close();
}; 