<?php 
require 'function.php';

$data= query("SELECT * FROM user");

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
    <script src="plotly.min.js"></script>

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
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li> 
        <?php if(isset($_SESSION['user'])) {?>
          <li class="nav-item">
            <a class="nav-link" href="user.php">List Akun</a>
          </li> 
        <?php
        }else{ ?>
          <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#exampleModal">List Akun</a>
          </li>
        <?php } ?> 
      </ul>
      <?php if(isset($_SESSION['user'])) {?>
        <div class="nav-item">
          <a class="nav-link btn btn-danger" href="logout.php">Logout</a>
        </div>
      <?php
      }else{ ?>
        <div class="nav-item">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
        Login
        </button>
        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#register">
        Register
        </button>
        </div>
      <?php } ?> 
    </div>
  </nav>

  <div class="jumbotron jumbotron-fluid" style="background-color: cornflowerblue;
    background-size: cover;
    background-image: url('bb.jpeg');">
    <div class="container" style="color:white;">
      <h1 class="display-4">Selamat datang</h1>
    <?php if(isset($_SESSION['user'])) {?>
      <h2 class="display-6"><?= $_SESSION['user'][0]['nama']?> <br> <span> Anda pengunjung ke <?=$_SESSION['count']?> </span></h2>
    <?php }else{ ?>
      <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">
        Silahkan Login
        </button>
    <?php }?>
    </div>
  </div>
  
  
  <main class="container">
    <?php if(isset($_SESSION['user'])) {?>
        <h2> Tugas Form Validasi</h2>
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#validasi">
                  Form Validasi
        </button>
    <?php } ?>
    <!-- <div>
        <h1>Tugas Chart</h1>
        <h2>Chart BTC in USD</h2>
        <div id="chart" style="width:100%"></div>
    </div> -->
    <div>
        <h1>Tugas detect face in image</h1>
        <form action="upload.php" method="post" enctype="multipart/form-data" class="my-5">
          Select image to check:
          <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" required> <br>
          <input type="submit" value="Upload Image" name="submit">
        </form>
    </div>
    <?php if(isset($_SESSION['message_upload'])) { ?>
      <div class="mb-5 text-center">
        <h1><?= $_SESSION['message_upload'] ?></h1>
        <img class="img-fluid" src="<?= $_SESSION['url'] ?>" alt="image">
      </div>
    <?php 
      $_SESSION['message_upload'] = $_SESSION['url'] = NULL;
    } ?>
  </main>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Login</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="login.php" method="post">
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control" name="username" placeholder="Username" id="username" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="pswds">Password</label>
              <input type="password" class="form-control" name="pswd" placeholder="Password" id="pswds">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
    <!-- Modal -->
  <div class="modal fade" id="register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    <!-- Modal -->
  <div class="modal fade" id="validasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Validais Form</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                <label for="coba">Username</label>
                <input type="text" class="form-control" id="coba" autocomplete="off">
              </div>
                <p id="cek1"></p>
                <p id="cek2"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
  </div>

<script>
//     function getData() {
//        var val = "<?php
// $getrate = 'https://api.alternative.me/v2/ticker/?convert=USD';

// $price = file_get_contents($getrate);
// $result = json_decode($price, true);

// // BTC in USD
// $result = $result['data'][1]['quotes']['USD']['price'];

// $value = $result;
// echo $value; ?>"
// console.log(val);
//         return val;
//     }  
//     Plotly.plot('chart',[{
//         y:[getData()],
//         type:'line'
//     }]);
    
//     var cnt = 0;
//     setInterval(function(){
//         Plotly.extendTraces('chart',{ y:[[getData()]]}, [0]);
//         cnt++;
//         if(cnt > 500) {
//             Plotly.relayout('chart',{
//                 xaxis: {
//                     range: [cnt-500,cnt]
//                 }
//             });
//         }
//     },1000);
</script>
<script>

const text = document.querySelector('#coba');
const cek1 = document.querySelector('#cek1');
const cek2 = document.querySelector('#cek2');

text.addEventListener('input',cek);

function cek(value) {
    const input = value.target.value;
    console.log(input);
    if(input.length < 6)
    cek1.textContent = 'minimal 6 karakter'; 
    else
    cek1.textContent = ''; 

    if(!/[a-z]/.test(input) || ! /[A-Z]/.test(input) ||  !/[0-9]/.test(input))
    cek2.textContent = 'harus mengandung a-z, A-Z dan 0-9'; 
    else
    cek2.textContent = ''; 
}

</script>

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