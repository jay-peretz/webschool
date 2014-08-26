<?php 
require_once("../xanthippe/includes/sql-jperetz.php");
$queryclass = "select email from jperetz.class c, jperetz.student s where s.email = c.student_email and getforumemail = 1 and syllabus_syllabus_id=".$_POST['syllabus'];
$result = $mysqli->query($queryclass);
while($row=$result->fetch_array()){
        if($to=='')
        $to.=$row['email'];
        else
        $to.=','.$row['email'];
    }
$headers = 'From: SRJC Class Forum <jperetz@santarosa.edu>' . "\r\n";
$headers .= 'Bcc: '. $to . "\r\n";
$message = "A new comment was posted on the class forum \n\n".$_POST['topic']."\n\n".$_POST['comment']."\n\nPlease DO NOT REPLY to this email.   Go to the class page and leave your reply on the forum there.";
mail( "jperetz@santarosa.edu" , "SRJC Forum: ".$_POST['topic'], $message, $headers);
$mysqli->close(); 
?>