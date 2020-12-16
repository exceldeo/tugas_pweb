<?php 
session_start();
// koneksi ke mysql
function conn_mysql(){
  return mysqli_connect("localhost","root","","tugas_pweb");
}

// mengambil satu-satu query di masukan ke array
function query($query){
  $conn = conn_mysql();
  $result = mysqli_query($conn,$query);

  $rows=[];
  while($row = mysqli_fetch_assoc($result)){
    $rows[]=$row;
  }
  close();
  return $rows;
}

// fungsi tambah data
function tambah($data){
  $conn = conn_mysql();
  $nama=htmlspecialchars($data["nama"]);
  $pwd=htmlspecialchars($data["pswd"]);
  $pwd = md5($pwd);
  $alamat=htmlspecialchars($data["alamat"]);
  $no_hp=htmlspecialchars($data["no_hp"]);
  
  $query="INSERT INTO user value (NULL,'$nama','$pwd','$alamat','$no_hp')";
  // var_dump($query);
  // die;
  mysqli_query($conn,$query);
  $cek = mysqli_affected_rows($conn);
  close();
  return $cek;
}

// fungsi hapus data
function hapus($id){
    $conn = conn_mysql();
    mysqli_query($conn,"DELETE FROM user WHERE id = $id");
    $cek = mysqli_affected_rows($conn);
    close();
    return $cek;
}

function ubah($data){
  $conn = conn_mysql();
  $id=$data['id'];
  $alamat=htmlspecialchars($data["alamat"]);

  if($data["pswdbaru"]){
    $pwd=htmlspecialchars($data["pswdbaru"]);
  }
  else{
    $pwd=htmlspecialchars($data["pswdlama"]);
  }
  $no_hp=htmlspecialchars($data["no_hp"]);
  $nama=htmlspecialchars($data["nama"]);

  $query="UPDATE user SET 
      nama = '$nama',
      pwd =  '$pwd',
      alamat = '$alamat',
      no_hp = '$no_hp'
      WHERE id=$id
      ";
  // var_dump($query);die;
  mysqli_query($conn,$query);
  $cek = mysqli_affected_rows($conn);
  close();
  return $cek;
}

function close(){
  mysqli_close(mysqli_connect("localhost","root","","tugas_pweb"));
}