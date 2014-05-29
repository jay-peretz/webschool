<?php 
require('../authenticate_instructor.php');
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Gradebook | Santa Rosa Junior College</title>
<link href='http://fonts.googleapis.com/css?family=Lora:400,700,700italic' rel='stylesheet' type='text/css'>
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="https://login.persona.org/include.js"></script>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
var user = '<?php print $_SESSION['user']['email'] ?>';
</script>
<script src="grades.js"></script>
<style type="text/css">
ul#students li {
    width:150px;
    height:40px;
}
.nav-list>.active>a {
    background-color:#9CF;
    color:white;
}
.homeworks {
	margin-left:20px;
}
.pagesubmission {
    margin-left:40px;
}
.formanswers  {
	margin-left:30px;
	color: blue;
}
.testanswerred {
	margin-left:30px;
	color:red;
}
.testanswergreen {
	margin-left:30px;
	color:green;
}

</style>
</head>

<body>
<header class="jumbotron subhead" id="overview">
  <div class="container">
   <div class="row"><h2>Gradebook</h2>
  </div>
  <div class="row">
   <ul class="nav nav-pills" id="syllabus-menu">
   </ul>
  </div>
  </div>
</header>

 <div class="container">
  <div class="row">
  <div class="span4">
  <h5>Students</h5>
  <ul class="nav nav-list" id="students"></ul>
  </div>
  <div class="span8">
  <h4 id="studentName"></h4>
  <p id="studentParticipation"></p>
  <div class="row"><section id="grades"></section></div>
  
  </div>
  </div>
 
 
  
    </div>  
 <div class="row"><div class="span12"><h4 style="text-align:center;">Jay Peretz &mdash; Fall 2013  &mdash; Santa Rosa Junior College &mdash; Computer Studies</h4></div></div>
</div>
</body>
</html>
