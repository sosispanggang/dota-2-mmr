<?php
session_start();
include "library/config.php";

if(empty($_SESSION['id_tim']) or empty($_SESSION['password']) ){
   header('location: login.php');
}

//Proses ketika memilih jawaban
if($_GET['action']=="kirim_jawaban"){
   $rnilai = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM nilai WHERE id_tes='$_POST[tes]' AND id_tim='$_SESSION[id_tim]'"));
	
   $jawaban = explode(",", $rnilai['jawaban']);
   $index = $_POST['index'];	
   $jawaban[$index] = $_POST['jawab'];
	
   $jawabanfix = implode(",", $jawaban);
   mysqli_query($mysqli, "UPDATE nilai SET jawaban='$jawabanfix', sisa_waktu='$_POST[sisa_waktu]' WHERE id_tes='$_POST[tes]' AND id_tim='$_SESSION[id_tim]'");
	
   echo "ok";
}

//Ketiak selesai tes
elseif($_GET['action']=="selesai_tes"){
   $rnilai = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM nilai WHERE id_tes='$_POST[tes]' AND id_tim='$_SESSION[id_tim]'"));
	
   $arr_soal = explode(",", $rnilai['acak_soal']);
   $jawaban = explode(",", $rnilai['jawaban']);
   $jbenar = 0;
   for($i=0; $i<count($arr_soal); $i++){
      $rsoal = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM soal WHERE id_tes='$_POST[tes]' AND id_soal='$arr_soal[$i]'"));
      if($rsoal['kunci'] == $jawaban[$i]) $jbenar++;
   }
	
   $nilai = $jbenar/count($arr_soal)*100;
	
   mysqli_query($mysqli, "UPDATE nilai SET jml_benar='$jbenar', nilai='$nilai' WHERE id_tes='$_POST[tes]' AND id_tim='$_SESSION[id_tim]'");
   
   mysqli_query($mysqli, "UPDATE peserta SET status='login' WHERE id_tim='$_SESSION[id_tim]'");
   
   echo "ok";
}
?>
