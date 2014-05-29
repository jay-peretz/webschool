<?php 
require_once('../xanthippe/includes/sql-jperetz.php');
$forumposts = $mysqli->query('select count(*) from forum where student_email="'.$_POST["student"].'";');
$result->posts = $forumposts->fetch_row();
$forumposts->close();
$reviewposts = $mysqli->query('select count(*) from review where student_email="'.$_POST["student"].'";');
$result->reviews = $reviewposts->fetch_row();

$mysqli->close();	
require_once('../xanthippe/includes/JSON.php');
$json = new Services_JSON;
$studentdata = $json->encode($result);
echo $studentdata;