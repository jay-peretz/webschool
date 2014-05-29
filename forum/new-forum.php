<?php 
require_once("../xanthippe/includes/sql-jperetz.php");
if ($_POST['comment'] && $_POST['user'] && $_POST['inreplyto']) {
  $foruminsert = $mysqli->prepare("insert into jperetz.forum (student_email, comment , inreplyto, syllabus_syllabus_id) values (?,?,?,?)");
  $foruminsert->bind_param('ssis',$_POST['user'],$_POST['comment'],$_POST['inreplyto'], $_POST['syllabus']);
  $foruminsert->execute();
 
} else {
 if ($_POST['comment'] && $_POST['user'] && $_POST['syllabus']) {
  $foruminsert = $mysqli->prepare("insert into jperetz.forum (student_email, comment, topic, syllabus_syllabus_id) values (?,?,?,?)");
  $foruminsert->bind_param('sssi',$_POST['user'],$_POST['comment'],$_POST['topic'], $_POST['syllabus']);
  $foruminsert->execute(); 
 }
}
mail( "jperetz@santarosa.edu", "New Forum Post by ".$_POST['user'], $_POST['user']." posted the following comment ".$_POST['comment'], "From:".$_POST['user']);
$mysqli->close(); 
?>