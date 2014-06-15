<?php 
require('../authenticate.php');
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Final HTML5/Web Development Projects | Spring 2013 | Jay Peretz | Santa Rosa Junior College</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="https://login.persona.org/include.js"></script>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
var user = '<?php print $_SESSION['user']['email'] ?>';
</script>
<script src="projects.js"></script>
</head>

<body>
<header class="jumbotron subhead" id="overview">
  <div class="container">
<div id="write-comment" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  
    <h3>Comment on this Project Proposal</h3>
     
  </div>
  <div class="modal-body">
  <p id="projecttext" class="span5"></p> 
 <p  class="span5"> <textarea columns=600 rows=2 id="enter-comment"></textarea></p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
    <a class="btn btn-warning" id="submit-comment">Submit</a>
  </div>
</div>  
   <h2 class="page-header">Final Projects</h2>
  
  </div>
</header>
<div class="container">

<nav class="row">
<div class="span12">
<ul class="nav nav-pills">
   <li><a href="../html5/">CS 52.10</a></li>
    <li><a href="../web-programming/">CS 53.11B</a></li>
</ul>
</div>
</nav>

  <div class="row">
 <div class="span8"> 
 <p>The final project <strong>due date is May 12, 2013</strong>.  The first step is to enter a proposal in the profile of your class homepage, which almost all of you have already done.    Instructors will provide feedback to your proposal using this page, and other students can also comment on the project proposals of their peers, offering to collaborate or providing feedback or direction.</p>
 <div id="project-list"></div>
 </div>
    <div class="span4">
  <dl>
  <br>
  <dt>Project Scope - CS50.12</dt>
  <dd>Create a website or web application that demonstrates your ability to implement at least six of the lessons presented in this class, in an integrated and logical way. </dd><br>
  <dt>HTML5 Page Structure<br>
10 points</dt><dd> The website needs to be structured semantically, using current document and metadata markup.</dd> <dt>Interactivity<br>
45 points</dt> <dd> The website needs to provide some way of interacting with the user - either through form elements, services such as  geolocation or data apis, or visual interactions using media or vector elements. </dd> <dt>Responsive Layout<br>
25 points</dt>  <dd>  The website page layouts must be designed for at least 2 screen-widths  using basic HTML5 viewport and media query capabilities.  </dd>
<dt>Overall Concept & Execution<br>
20 points</dt>  <dd>How innovative is your website concept and how fully realized is it the project. </dd>
<br>
<dt><strong>Project Scope - CS53.11b</strong></dt>
  <dd>Create a Database-Driven Website using PHP & MySQL, with an application of your choice.    There are SO many applications you can choose, for example: a TO-DO list, a recipe book, a catalog of your music, a contact list of your friends that automatically sends e-birthday & e-holiday cards, a specialized blog or content management system (such as this class webpage)...</dd> <br>
  <dt>Database Interaction<br>
30 points</dt><dd> The website needs to demonstrate the ability to interact with data in a database using the PHP - AJAX - Javascript techniques demonstrated in the class tutorials.</dd> <dt>Database Design<br>
25 points</dt> <dd> The database needs to be designed using the entity-relationship constraints we explored in the SQL tutorials (ie not in one table). </dd> <dt>Responsive Layout<br>
25 points</dt>  <dd>  The website page layouts must be designed for at least 2 screen-widths  using basic HTML5 viewport and media query capabilities.  </dd>
<dt>Overall Concept & Execution<br>
20 points</dt>  <dd>How innovative is your website concept and how fully realized is it the project. </dd>
</dl>
 </div>
   
    </div>  
  
 
   
<div class="row comments">
        <div class="span12">
        <h3 class="jumbotron subhead">Discussion Forum</h3>
        <p>Please use this discussion form appropriately to ask questions of the instructor or to share information that is of interest to the class.</p>
        <div id="disqus_thread"></div>
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = 'javascriptcs5511'; // required: replace example with your forum shortname

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
        
        </div>
        </div>
         <footer class="row well well-large">
        <h4>This page requires Javascript and is best viewed in the  <a href="https://www.google.com/intl/en/chrome/browser/">latest version of Google Chrome
       <img src="../images/chrome.png" alt="Download Google Chrome" height="100" width="100" /></a></h4>
        </footer>
</div>
</body>
</html>
