<?php

$lastModified = filemtime(__FILE__);
$etagFile = md5(__FILE__);

$ifModifiedSince=(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? $_SERVER['HTTP_IF_MODIFIED_SINCE'] : false);
$etagHeader=(isset($_SERVER['HTTP_IF_NONE_MATCH']) ? trim($_SERVER['HTTP_IF_NONE_MATCH']) : false);

header("Last-Modified: ".gmdate("D, d M Y H:i:s", $lastModified)." GMT");
header("Etag: $etagFile");
header('Cache-Control: public');

if (@strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE'])==$lastModified || $etagHeader == $etagFile)
{
       header("HTTP/1.1 304 Not Modified");
       exit;
}

session_start();
ob_start();

//Timeout login
$timeout = $_SESSION['timeout'];
if(time()<$timeout){
   $_SESSION['timeout'] = time()+5000;
}else{
   $_SESSION['login'] = 0;
}

//Cek status login
if(empty($_SESSION['username']) or empty($_SESSION['password']) or $_SESSION['login']==0){
   header('location: login.php');
}
?>

<html>
<head>
   
<title>Halaman Administrator</title>
 
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />

<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" href="../assets/dataTables/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/admin.css"/>
  
<script type="text/javascript" src="../assets/jquery/jquery-2.0.2.min.js"></script>

</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top"> 
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
  
<script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/dataTables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../assets/dataTables/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript" src="../js/admin.js"></script>

</body>
</html>
