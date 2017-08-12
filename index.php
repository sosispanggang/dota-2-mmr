<?php
session_start();
ob_start();

if( empty($_SESSION['id_tim']) or empty($_SESSION['password']) ){
   header('location: login.php');
}
?>

<html>
<head>
   <title>Schematics ITS</title>

   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width,initial-scale=1" />

   <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"/>
   <link type="text/css" rel="stylesheet" href="assets/dataTables/css/dataTables.bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="css/style.css"/>
	
   <script type="text/javascript" src="assets/jquery/jquery-2.0.2.min.js"></script>
   <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top"> 
   <div class="container">
      <?php include "menu.php"; ?>
   </div>
</nav>	

<section>   
   <div  class="container">
      <div class="row">
         <div class="col-xs-12" id="content"></div>
      </div>
	</div>
</section>

<footer> 
   <div class="container">
      <p class="text-center">Copyright &copy; Schematics ITS. All right reserved.</p>
   </div>
</footer>
   <script type="text/javascript" src="js/main.js"></script>

</body>
</html>
