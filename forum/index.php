<?php 
require('../authenticate.php');
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Class Forum | Jay Peretz | Santa Rosa Junior College</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="https://login.persona.org/include.js"></script>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
var user = '<?php print $_SESSION['user']['email'] ?>';
</script>
<script src="forum.js"></script>
</head>

<body>
<header class="jumbotron subhead" id="overview">
  <div class="container">
  
   <h2 class="page-header">Class Forum | Jay Peretz | Santa Rosa Junior College</h2>
  </div>
</header>
<div class="container">
<nav class="row">
<div class="span12">
<ul class="nav nav-pills">
   <li><a href="../index.php/html5/">HTML5 Home</a></li>
    <li><a href="../index.php/javascript/">Javascript Home</a></li>
     <li><a href="../wiki/">Wiki</a></li>
</ul>
</div>
</nav>

  <div class="row">
  <h3>Class Forum</h3>
         <div class="span12">
         
           <div class="row"> 
            <div class="well row"><p class="span5"><small>This forum is the place to ask any questions regarding the topics of the class and to reply and help your fellow students.  Participation is included in your grade.  The forum is shared by students in both the HTML5 and Javascript classes.  Please share PERTINENT, BRIEF,  APPROPRIATE & HELPFUL comments only. <em>You can add links using the HTML &lt;a href=http://...&gt; tag.</em> DO NOT PUT JAVASCRIPT into this form.   </small> </p>
            <div class="input-append span6">
            <form class="form-horizontal">
            <div class="control-group">
                <label class="control-label" for="forumtopic">                  Topic</label>
                <div class="controls">
                     <input id="forumtopic" type="text" placeholder="Topic" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="newpost">                  Comment</label>
                <div class="controls">
                      <textarea rows="5"  id="newpost" placeholder="Comment"></textarea>
                </div>
            </div>
            <div class="control-group">
            <div class="controls">
                <button id="newpostbtn" class="btn btn-primary" type="button">Post a comment</button>
                </div>
                </div>
            
  </form>
</div>
</div>
            
            <div id="forum-list"></div>
          
            
            
            
            </div>
            </div> 
        
         
         </div>
   
  </div>  
  
         

</body>
</html>