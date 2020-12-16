<?php 
require 'function.php';

if(!isset($_SESSION['user'])){
  echo ' <script>
  document.location.href="index.php";
  </script>';
}

$data= query("SELECT * FROM user");
// close();

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Sweetalert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">

    <title>Guess Book</title>
  </head>
  <body>
    
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Logo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home </a>
        </li> 
          <li class="nav-item active">
            <a class="nav-link" href="user.php">List Akun <span class="sr-only">(current)</span></a>
          </li> 
      </ul>
        <div class="nav-item">
          <a class="nav-link btn btn-danger" href="logout.php">Logout</a>
        </div>
    </div>
  </nav>

    <main class="container mt-3">
      <div class="row justify-content-end mb-1">
        <div class="col-2">
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
            Tambah Data
          </button>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <?php 
            if (isset($_SESSION["success_message"]))
            {
              echo '<div class="alert alert-success" role="alert">'.$_SESSION["success_message"].'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
              unset($_SESSION["success_message"]);
            }
            if (isset($_SESSION["fail_message"]))
            {
              echo '<div class="alert alert-danger" role="alert">'.$_SESSION["fail_message"].'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
              unset($_SESSION["fail_message"]);
            }
          ?>
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col" class="text-center" style="width:5%">#</th>
                <th scope="col" class="text-center">Nama</th>
                <th scope="col" class="text-center">Alamat</th>
                <th scope="col" class="text-center">No Hp</th>
                <th scope="col" class="text-center" style="width:30%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $nomor = 1;
              foreach($data as $row) :?>
                <tr>
                  <td class="text-center"><?= $nomor++ ?></td>
                  <td class="text-center"><?= $row['nama'] ?></td>
                  <td class="text-center"><?= $row['alamat'] ?></td>
                  <td class="text-center"><?= $row['no_hp'] ?></td>
                  <td class="text-center">
                    <div class="row justify-content-center">
                      <div class="col-3">
                        <form action="tampilan_ubah.php" method="post">
                          <input type="hidden" name="id" value="<?= $row['id'] ?>">
                          <button class="btn btn-info" type="submit" >Ubah</button>
                        </form>
                      </div>
                      <div class="col-3">
                        <form action="hps.php" method="post">
                          <input type="hidden" name="id" value="<?= $row['id'] ?>">
                          <button class="btn btn-danger delete-confirm" type="submit">Hapus</button>
                        </form>
                      </div>
                    </div>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="tambah.php" method="post">
              <div class="form-group">
                <label for="nama">Username</label>
                <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off">
              </div>
              <div class="form-group">
              <label for="pswd">Password</label>
              <input type="password" class="form-control" name="pswd" id="pswd" required>
            </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" required autocomplete="off">
              </div>
              <div class="form-group">
                <label for="no_hp">No HP</label>
                <input type="number" class="form-control" id="no_hp" name="no_hp" required autocomplete="off">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
    $('.delete-confirm').on('click', function (event) {
        event.preventDefault();
        var form = event.target.form;
        Swal.fire({
            title: 'Apakah Anda yakin untuk menghapus pengguna?',
            icon: 'warning',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Batal',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
        })
    });
  </script>
    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>