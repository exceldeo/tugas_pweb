<?php 
    include 'function.php';
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

    $command = escapeshellcmd("/usr/bin/python3 facerecognition.py ".$target_file);

    $output = shell_exec($command." 2>&1");

    if(strcmp($output, "true\n") == 0){
        $_SESSION["message_upload"] = "face detected";
        $_SESSION['url'] = $target_file;
    }
    else{
        $_SESSION["message_upload"] = "no face detected";
        $_SESSION['url'] = $target_file;
    }
    header('Location: index.php');
    exit;
?>
