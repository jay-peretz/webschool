<?php 
/* create a SQL connection */
$mysqli = new mysqli("student.santarosa.edu", "jperetz_admin", "0CniBVJG", "jperetz");

/* check SQL connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
