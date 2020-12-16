<?php 
  include 'function.php';

  session_start();

  if(ubah($_POST)>0){
    $_SESSION["success_message"] = "data berhasil diubah";
  }
  else{
    $_SESSION["fail_message"] = "data gagal diubah";
  }
  header('Location: user.php');
  exit;
?>