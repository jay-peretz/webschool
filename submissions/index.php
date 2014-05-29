<?php 
require('../authenticate_instructor.php');
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Submissions | Santa Rosa Junior College</title>
<link href='http://fonts.googleapis.com/css?family=Lora:400,700,700italic' rel='stylesheet' type='text/css'>
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
<script src="https://login.persona.org/include.js"></script>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
var user = '<?php print $_SESSION['user']['email'] ?>';
var syllabus_id = 3;
</script>
<script src="submissions.js"></script>
<style type="text/css">
.assignments {
	margin-left:10px;
}
.homeworks {
	margin-left:20px;
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
   <div class="row">
    <button class="btn span2 btn-success" type="button" id="logout">Logout</button> 
   </div>
  <div class="row">
   <h2 id="course-info"></h2>
   </div>
   <div class="row">
   <ul class="nav nav-pills" id="syllabus-menu">
   </ul>
  </div>
  </div>
</header>

 <div class="container">
  <div class="row">
  <h3 id="classheader"></h3>
  <div id="submissionscontent"></div>
  </div>
 
 
  
    </div>  
 <div class="row"><div class="span12"><h3 style="text-align:center;">Jay Peretz &mdash; Fall 2013  &mdash; Santa Rosa Junior College &mdash; Computer Studies</h3></div></div>
</div>
</body>
</html>
