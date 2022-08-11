<?php 
  include 'config.php';


  $db = dbConnect();

  if (isset($_POST['register'])) {
      $no_pendaftaran = "pn-".uniqid();
      $namaLengkap = $_POST['nama'];
      $email = $_POST['email'];
      $nisn = $_POST['nisn'];
      $password = $_POST['password'];

      $register = register($no_pendaftaran, $nisn, $email, $namaLengkap, $password);
  }



?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <title>Daftar</title>
  </head>
  <body>

    <style type="text/css">
      .container{
        width: 30%;
        margin-top: 15%;
        box-shadow: 0 3px 20px rgba(0, 0, 0, 0.2);
        margin-top: 150px;
        padding: 50px;
      }

      button{
        width: 100%;
        margin-top: 10px;
      }

      .form-group{
        margin-top: 15px;
      }

      a{
        text-decoration: none;
      }

      a:hover{
        text-decoration: none;
        color: #000000;
      }
    </style>


    <div class="container mt-5">
      <h4 class="text-left">Daftar</h4>
      <form action="" method="POST">
        <div class="form-group">
          <label>Nama Lengkap</label>
            <div class="input-group">
              <div class="input-group-prepend"></div>
                <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                  <input type="text" name="nama" class="form-control" placeholder="Masukan nama lengkap anda" required>
            </div>
        </div>

        <div class="form-group">
          <label>Email</label>
            <div class="input-group">
              <div class="input-group-prepend"></div>
                <div class="input-group-text"><i class="fa-solid fa-envelope"></i></div>
                  <input type="email" name="email" class="form-control" placeholder="Masukan email anda" required>
            </div>
        </div>

        <div class="form-group">
          <label>NISN</label>
            <div class="input-group">
              <div class="input-group-prepend"></div>
                <div class="input-group-text"><i class="fa-solid fa-key"></i></div>
                  <input type="text" name="nisn" class="form-control" placeholder="Masukan NISN Anda" required>
            </div>
        </div>

        <div class="form-group">
          <label>Password</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-unlock"></i></div>
              </div>
                <input type="password" name="password" class="form-control" placeholder="Masukan password anda" required>
            </div>
        </div>
        <center><button type="submit" name="register" class="btn btn-primary">Daftar</button></center>
        <br>
        <br>
        <center><a href="index.php" class="text-danger">Kembali</a></center>
      </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/272844a649.js" crossorigin="anonymous"></script>
  </body>
</html>