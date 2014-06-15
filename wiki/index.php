<?php 
require('../authenticate.php');
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Web Development Wiki | Jay Peretz | Santa Rosa Junior College</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="https://login.persona.org/include.js"></script>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../css/spring2013.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
var user = '<?php print $_SESSION['user']['email'] ?>';
</script>
<script src="wiki.js"></script>
</head>

<body>
<header class="jumbotron subhead" id="overview">
  <div class="container">
  
   <h2 class="page-header">Web Development Wiki</h2>
  </div>
</header>
<div class="container">
<div id="update-definition" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  
    <h3>Update Your Definition</h3>
     
  </div>
  <div class="modal-body"> 
  
  <h3 id="change-term" class="span5"></h3>
   <p class="span5"> Definition </p>
 <p  class="span5"> <textarea columns=600 rows=2 id="new-definition"></textarea></p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
     <a class="btn btn-danger" id="delete-definition">Delete</a>
    <a class="btn btn-warning" id="change-definition">Update</a>
  </div>
</div>
<div id="write-definition" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  
    <h3>Add or Edit a Web Term Definition </h3>
     
  </div>
  <div class="modal-body"> 
  <p class="span5">Web Term </p>
  <p id="enter-term" class="span5" contenteditable=true></p>
   <p class="span5"> Definition </p>
 <p  class="span5"> <textarea columns=600 rows=2 id="enter-definition"></textarea></p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
    <a class="btn btn-warning" id="submit-definition">Submit</a>
  </div>
</div>
<nav class="row">
<div class="span12">
<ul class="nav nav-pills">
    <li><a href="http://santarosa.edu/~jperetz/fall2013/index.php/html5/">HTML5</a></li>
    <li><a href="http://santarosa.edu/~jperetz/fall2013/index.php/javascript/">Javascript</a></li>
     <li><a href="../glossary/">The Glossary</a></li>
</ul>
</div>
</nav>

  <div class="row">
 <div class="span12">
 <div class="row">
 <h3>Glossary of Terms</h3>
 <p><strong>Note:</strong> Please do not enter HTML tags directly into the definition or term.   Is is easiers if you just enter element names in all CAPS.   If you insist on displaying an HTML tag, you must use the HTML character codes for the opening and closing angle brackets, and wrap all code within CODE tags. </p>
  <button class="btn btn-large span3" type="button" id="add-definition" data-toggle="modal" data-target="#write-definition">Add or Amend a Term</button>
 </div>
 <div id="glossary"></div>
 
 </div>
    
   
    </div>  
  
 
   

         <footer class="row well well-large">
       
        </footer>
</div>
</body>
</html>