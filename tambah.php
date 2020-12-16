<?php 
    include 'function.php';
    
    if(tambah($_POST)>0){
        $_SESSION["success_message"] = "data berhasil ditambahkan";
    }
    else{
        $_SESSION["fail_message"] = "data gagal ditambahkan";
    }
    header('Location: user.php');
    exit;
?>
