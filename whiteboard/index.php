<?php 
require('../authenticate.php');
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Whiteboard | Jay Peretz | Santa Rosa Junior College</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="https://login.persona.org/include.js"></script>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<style>
#whiteboard {
    width:1000px;
    height: 800px;
}
</style>
<script type="text/javascript">
var user = '<?php print $_SESSION['user']['email'] ?>';
</script>
<!-- AWW widget -->
<script type="text/javascript" src="https://awwapp.com/static/1.0/aww.min.js"></script>

<!-- Connection to the whiteboard sharing service -->
<script type="text/javascript" src="https://awwapp.com/nowjs/now.js"></script>

<!-- CSS styles used by the widget -->
<link rel="stylesheet" type="text/css" href="https://awwapp.com/static/1.0/aww.css"/>
</head>

<body>
<header class="jumbotron subhead" id="overview">
  <div class="container">
  
   <h2 class="page-header">Whiteboard || Jay Peretz || Santa Rosa Junior College</h2>
  </div>
</header>
<div class="container">


  <div class="row">
         <div class="span12" id="whiteboard">
         
            
        
         
          
         </div>
   
  </div>  
  
         <footer class="row well well-large">
       
        </footer>
</div>
<script type="text/javascript">
    $(function() {
        /* initialize the whiteboard widget on #wrapper element */
        var aww = $('#whiteboard').awwCanvas();
    });
</script>
</body>
</html>