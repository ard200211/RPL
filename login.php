<?php 

    session_start();
    if (isset($_SESSION['login'])) {
      echo "
      <script>
        document.location.href = 'pendaftar/index.php';
      </script>";
    }else if (isset($_SESSION['petugas'])) {
      echo "
      <script>
        document.location.href = 'petugas/index.php';
      </script>";
    }

  

    include 'config.php';
    $db = dbConnect();

    if (isset($_POST['login'])) {
      $nisn = $_POST['nisn'];
      $password = $_POST['password'];

      $sqlLogin = "SELECT * FROM pendaftar WHERE nisn = '$nisn'";
      $executeLogin = $db->query($sqlLogin);

      if (mysqli_num_rows($executeLogin) > 0) {
        $sqlLoginPass = "SELECT * FROM pendaftar WHERE nisn = '$nisn' AND password = '$password'";
        $executeLoginPass = $db->query($sqlLoginPass);

        if (mysqli_num_rows($executeLoginPass) > 0) {
          $_SESSION['login'] = true;
          $_SESSION['nisn'] = $nisn;
          echo "
            <script>
              alert('Anda berhasil login!');
              document.location.href = 'pendaftar/index.php';
            </script>";
        }else{
          echo "
          <script>
            alert('Password anda salah!');
            document.location.href = 'login.php';
          </script>";
        }
      }else{
        $sqlLoginAdmin = "SELECT * FROM admin WHERE username = '$nisn' AND password = '$password'";
        $executeLoginAdmin = $db->query($sqlLoginAdmin);
        
        if (mysqli_num_rows($executeLoginAdmin) > 0) {
          $_SESSION['petugas'] = true;
          $_SESSION['username'] = $nisn;
          echo "
            <script>
              alert('Anda berhasil login!');
              document.location.href = 'petugas/index.php';
            </script>";
        }else{
          echo "
            <script>
              alert('Password anda salah!');
              document.location.href = 'login.php';
            </script>";
        }
      }
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

    <title>Login</title>
  </head>
  <body>

    <style type="text/css">
      .container{
        width: 30%;
        margin-top: 15%;
        box-shadow: 0 3px 20px rgba(0, 0, 0, 0.2);
        margin-top: 50px;
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



    <div style="margin-top: 80px;">
      <div class="container mt-5">
      <h4 class="text-center">Login</h4>
      <hr>
      <form action="" method="POST">
        <div class="form-group"></div>
          <label>Credential ID</label>
            <div class="input-group">
              <div class="input-group-prepend"></div>
                <div class="input-group-text"><i class="fas fa-user"></i></div>
                  <input type="text" name="nisn" class="form-control" placeholder="NISN (Siswa) / Admin (Username)">
            </div>
        <div class="form-group">
          <label>Password</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-unlock"></i></div>
              </div>
                <input type="password" name="password" class="form-control" placeholder="Masukan password anda">
            </div>
        </div>
        <p>Belum punya akun? <a href="register.php">Daftar</a></p>
        <center><button type="submit" name="login" class="btn btn-primary">Login</button></center>
        <br>
        <br>
        <center><a href="index.php" class="text-danger">Kembali</a></center>
      </form>
    </div>
    </div>






<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/272844a649.js" crossorigin="anonymous"></script>
  </body>
</html>