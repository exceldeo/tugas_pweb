<?php
    require 'function.php';

    $username = $_POST['username'];
    $password = md5($_POST['pswd']);

    $data = query("SELECT * FROM user WHERE nama = '$username' AND '$password'");
    if($data == NULL){
        echo ' <script>
        alert("Password atau Username salah");
        document.location.href="index.php";
        </script>';
    }
    else{
        $handle = fopen("counter.txt", "r"); 
        if(!$handle){ echo "could not open the file"; } 
        else { $counter=(int )fread($handle,20); 
        fclose($handle); 
        $counter++; 
        $_SESSION['count'] = $counter;
        $handle= fopen("counter.txt", "w" ) ; 
        fwrite($handle,$counter) ; 
        fclose ($handle) ; }

        $_SESSION['user'] = $data;
        echo ' <script>
        alert("Berhasil Login");
        document.location.href="index.php";
        </script>';
    }
