<!doctype html>
<html lang="en">

	<head>
		<meta charset="utf-8">

		<title>Class Lecture Notes | Jay Peretz | Santa Rosa Junior College</title>

		<link rel="stylesheet" href="reveal/css/reveal.min.css">
        <link rel="stylesheet" href="reveal/css/theme/sky.css" id="theme">
	</head>
	<body>
		<div class="reveal">
			<div class="slides">
<?php
                /* create a SQL connection */
$mysqli = new mysqli("student.santarosa.edu", "jperetz_admin", "0CniBVJG", "jperetz");

/* check SQL connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
$selectslides = $mysqli->query('select slides from lesson where lesson_id ='.$_GET['lesson']);
$slides = $selectslides->fetch_row();

if ($slides[0] != "") {
	echo $slides[0];
} else {
echo "<section>Class Notes to Come</section>";
}
$mysqli->close();
 ?>
			</div>
		</div>
		<script src="reveal/lib/js/head.min.js"></script>
		<script src="reveal/js/reveal.min.js"></script>
		<script>
			Reveal.initialize();
		</script>

	</body>
</html>
