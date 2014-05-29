<?php
$forumarray = array();
require_once("../xanthippe/includes/sql-jperetz.php");
if ($_GET['archivedate']) {
    $queryforum = 'select CAST(`forum_id` AS CHAR) as forum_id,  DATE_FORMAT(CAST(`submitted` AS DATETIME),"%a %M %d %H:%i") as submitted , submitted as sm , comment , topic, student.first_name from forum , student where student.email = forum.student_email and submitted > "'.$_GET['archivedate'].'" and syllabus_syllabus_id = '.$_GET['syllabus'] .' and  inreplyto IS NULL ORDER BY sm DESC';
} else {
    $queryforum = 'select CAST(`forum_id` AS CHAR) as forum_id,  DATE_FORMAT(CAST(`submitted` AS DATETIME),"%a %M %d %H:%i") as submitted , submitted as sm , comment ,topic, student.first_name from forum , student where student.email = forum.student_email and inreplyto IS NULL ORDER BY sm DESC';
}
if ($noreplies = $mysqli->query($queryforum))  { 
  while ($noreply = $noreplies->fetch_object())
  {   
   $forumarray[$noreply->forum_id] = $noreply;
   if ($replies = $mysqli->query("select CAST(`forum_id` AS CHAR) as forum_id, DATE_FORMAT(CAST(`submitted` AS DATETIME),'%a %M %d %H:%i') submitted,comment, topic, student.first_name from forum , student where student.email = forum.student_email and inreplyto = ".$noreply->forum_id.' ORDER BY submitted DESC')) {
	   while ($reply = $replies->fetch_object())
	   {
		   
		   $forumarray[$noreply->forum_id]->replies[$reply->forum_id] = $reply;
		   if ($deepreplies = $mysqli->query("select CAST(`forum_id` AS CHAR) as forum_id, DATE_FORMAT(CAST(`submitted` AS DATETIME),'%a %M %d %H:%i') submitted,comment, topic, student.first_name from forum , student where student.email = forum.student_email and inreplyto = ".$reply->forum_id.' ORDER BY submitted DESC')) {
			   while ($deepreply = $deepreplies->fetch_object())
			   {
				   
				   $forumarray[$noreply->forum_id]->replies[$reply->forum_id]->deepreplies[$deepreply->forum_id] = $deepreply;
				   if ($deeperreplies = $mysqli->query("select CAST(`forum_id` AS CHAR) as forum_id, DATE_FORMAT(CAST(`submitted` AS DATETIME),'%a %M %d %H:%i') submitted,comment, topic,student.first_name from forum, student where student.email = forum.student_email and inreplyto = ".$deepreply->forum_id.' ORDER BY submitted DESC')) {
			   			while ($deeperreply = $deeperreplies->fetch_object())
						   {
							   
							   $forumarray[$noreply->forum_id]->replies[$reply->forum_id]->deepreplies[$deepreply->forum_id]->deeperreplies[$deeperreply->forum_id] = $deeperreply;
							}
							
						   $deeperreplies->close();
					   }
			   		}
					
					$deepreplies->close();
		   }
	   }
	   
	   $replies->close();
   }
  }
  
  $noreplies->close();
};
$mysqli->close(); 
require_once('../xanthippe/includes/JSON2.php');
//$json = new Services_JSON;
$forum = __json_encode(array_values($forumarray));
echo $forum;
?>