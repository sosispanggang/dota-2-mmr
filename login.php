<?php
session_start();
ob_start();


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

?>

<html>
<head>

<title>Schematics ITS</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/login.css"/>
	
<script src="https://code.jquery.com/jquery-2.0.2.min.js" integrity="sha256-TZWGoHXwgqBP1AF4SZxHIBKzUdtMGk0hCQegiR99itk=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(function(){
   $('.alert').hide();
   $('.login-form').submit(function(){
      $('.alert').hide();
      if($('input[name=username]').val() == ""){
         $('.alert').fadeIn().html('Kotak input <b>Username</b> masih kosong!');
      }else if($('input[name=password]').val() == ""){
         $('.alert').fadeIn().html('Kotak input <b>Password</b> masih kosong!');
      }else{
         $.ajax({
            type : "POST",
            url : "checker.php",
            data : $(this).serialize(),
            success : function(data){
               if(data == "ok") window.location = "index.php";
               else $('.alert').fadeIn().html(data);
            }
         });
      }
      return false;
   });
});
</script>

</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="alert alert-danger text-center" role="alert"></div>

				<div class="list-group">
					<div class="list-group-item active"><h3 class="text-center">Login Schematics</h3></div>
					<div class="list-group-item list-group-item-info">
					<form class="login-form">
						<div class="input-group">
							<div class="input-group-addon"><i class="glyphicon glyphicon-user"></i></div>
							<input type="text" name="id_tim" placeholder="Email" autofocus class="form-control">
						</div><br/>
						
						<div class="input-group">
							<div class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></div>
							<input type="password" name="password" placeholder="Password" class="form-control">
						</div><br/>

						<button class="btn btn-primary pull-right login-button"><i class="glyphicon glyphicon-log-in"></i> Login Schematics </button><br/>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
