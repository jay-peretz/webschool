<?php 
require_once('../xanthippe/includes/sql-jperetz.php');
$selectterms = $mysqli->query("select term,class from term  t left outer join definition d on t.term   =  d.term_term where term_term is null and class = 'html5' order by term");
while ($term = $selectterms->fetch_object()) {
	$terms[$term->term] = $term;
}
$mysqli->close();	
require_once('../xanthippe/includes/JSON.php');
$json = new Services_JSON;
$termList = $json->encode($terms);
echo $termList;