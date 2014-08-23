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
$queryclass = "select email from jperetz.class c, jperetz.student s where s.email = c.student_email and getforumemail = 1 and syllabus_syllabus_id=".$_POST['syllabus'];
$result = $mysqli->query($queryclass);
while($row=$result->fetch_array()){
        if($to=='')
        $to.=$row['email'];
        else
        $to.=','.$row['email'];
    }
$headers .= 'From: jperetz@santarosa.edu' . "\r\n";
$headers .= 'Bcc: '. $to . "\r\n";

mail( "jperetz@santrosa.edu" , "SRJC Forum: ".$_POST['topic'], "A new comment was posted on the class forum \n\n".$_POST['topic']."\n\n".$_POST['comment']."\n\nPlease DO NOT REPLY to this email.   Go to the class page and leave your reply on the forum there.", $headers);
$mysqli->close(); 
?>