<?php 
  include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<title>Pensmas</title>
</head>
<body>



<nav class="navbar navbar-expand-lg navbar-light bg-light pt-3 pb-3">
  <div class="container">
    <a class="navbar-brand" href="#">
      <h1>
        <b>Pensmas</b>
      </h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php"><h5>Home</h5></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php"><h5>Login</h5></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cari.php"><h5>Cari Pendaftar</h5></a>
        </li>
      </ul>
    </div>
  </div>
</nav>



	<div class="container mt-5">

      <form action="" method="POST">
        <div class="mt-5 mb-3">
          <h4>
              <b>Cari Pendaftar</b>
          </h4>
        </div>

        <div class="mt-5 mb-3">
            <div class="form-group">
              <input type="text" name="nisn" class="form-control" placeholder="Cari Pendaftar Berdasarkan NISN">
            </div>
            
            <div class="mt-3 mb-5">
              <button type="submit" class="btn btn-primary" name="find">Find</button>
            </div>
        </div>
      </form>
	</div>


  <div class="container mt-5 mb-5">
      
      <?php
          $db = dbConnect();
          
          if(isset($_POST['find'])){
            $nisn = $_POST['nisn'];
            
            $sqlFindByNisn = "SELECT * FROM pendaftar WHERE nisn = '$nisn'";
            $executeFindNisn = mysqli_query($db ,$sqlFindByNisn);

            if (mysqli_num_rows($executeFindNisn) > 0) {
                $assocPend = $executeFindNisn->fetch_assoc();

                $sqlFindNilaiByNisn = "SELECT * FROM nilai WHERE nisn = '$nisn'";
                $executeFindNilaiNisn = mysqli_query($db ,$sqlFindNilaiByNisn);
                $assocNilai = $executeFindNilaiNisn->fetch_assoc();
      ?>
      <table cellpadding="10">

        <tr>
            <th>No Pendaftaran</th>
            <td><?= $assocPend['no_pendaftar']?></td>
        </tr>

        <tr>
            <th>Nama Lengkap</th>
            <td><?= $assocPend['nama_lengkap']?></td>
        </tr>

        <tr>
            <th>Asal Sekolah</th>
            <td><?= $assocPend['asal_sekolah']?></td>
        </tr>

        <tr>
            <th>Total Nilai UN</th>
            <td><?= $assocNilai['matematika'] + $assocNilai['IPA'] + $assocNilai['b_indonesia'] + $assocNilai['b_inggris'] ?></td>
        </tr>

      </table>



      <?php
            }else{
              echo "Data Tidak ditemukan!!!";
            }

          }

      ?>


  </div>











<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>