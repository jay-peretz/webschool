<?php 
require_once('sql-jperetz.php');
$selectnews = $mysqli->query('select * from news order by posted desc limit 15');
$i = 0;
while ($newsitem = $selectnews->fetch_object()) {
    $news[$i] = $newsitem;
    $i = $i + 1;
};

$mysqli->close();
require_once('JSON.php');
$json = new Services_JSON;
$newsjson = $json->encode($news);
echo $newsjson;