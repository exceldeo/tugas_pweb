<?php
  require 'function.php';

  $id=$_POST["id"];
  // var_dump($_SESSION['user'][0]['id']);die;
  if($id == $_SESSION['user'][0]['id']){
    $_SESSION["fail_message"] = "user sedang di gunakan";
  }
  elseif(hapus($id)>0){
    $_SESSION["success_message"] = "data berhasil dihapus";
  }
  else{
    $_SESSION["fail_message"] = "data gagal dihapus";
  }
  header('Location: user.php');
  exit;