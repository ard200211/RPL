<?php 
  session_start();
	if (!isset($_SESSION['login'])) {
    echo "
	    <script>
	      alert('Anda harus login terlebih dahulu');
	      document.location.href = '../login.php';
	    </script>
		";
	}
	include '../config.php';

	$db = dbConnect();

	$sesi = $_SESSION['nisn'];

	// Pendaftar
	$selectPendaftar = "SELECT * FROM pendaftar WHERE nisn = '$sesi'";
	$executePendaftar = $db->query($selectPendaftar);
	$assoc = $executePendaftar->fetch_assoc();
	// Pendaftar

	// Skhun
	$selectSkhun = "SELECT * FROM skhun WHERE nisn = '$sesi'";
	$executeskhun = $db->query($selectSkhun);
	$assocskhun = $executeskhun->fetch_assoc();
	// Skhun

	// Nilai
	$selectNilai = "SELECT * FROM nilai WHERE nisn = '$sesi'";
	$executeNilai = $db->query($selectNilai);
	$assocNilai = $executeNilai->fetch_assoc();
	// Nilai

  if (isset($_POST['save'])) {
  	// biodata
  	$nisn = $assoc['nisn'];
  	$namaLengkap = $_POST['namaPendaftar'];
  	$ttl = $_POST['ttl'];
  	$jk = $_POST['jk'];
  	$agama = $_POST['agama'];
  	$alamat = $_POST['alamat'];
  	$noTelp = $_POST['noTelp'];
  	$asalSekolah = $_POST['asalSekolah'];
  	$namaOrtu = $_POST['namaOrtu'];
  	$gambarLama = $_POST['gambarLama'];
  	// biodata

  	// nilai
  	$matematika = $_POST['matematika'];
  	$ipa = $_POST['ipa'];
  	$bindo = $_POST['bindo'];
  	$binggris = $_POST['binggris'];
	$total = $matematika + $ipa + $bindo + $binggris;
	$tb = $total / 4;
  	// nilai

  	// skhun
  	$no_skhun = $_POST['no_skhun'];
  	$ekstensi_allowed = array('png','jpg','pdf','jpeg');
		$nama = $_FILES['file']['name'];
		$x = explode('.', $nama);
		$ekstensi = strtolower(end($x));
		$ukuran = $_FILES['file']['size'];
		$file_tmp = $_FILES['file']['tmp_name'];
		$namaFileBaru = uniqid();
		$namaFileBaru .= '.';
		$namaFileBaru .= $ekstensi;

		$proses_gambar = $_FILES['file']['error'];
		
		if($proses_gambar === 4){
				$picture = $gambarLama;
		}
		else{
				if(in_array($ekstensi, $ekstensi_allowed) === true){
				
						if($ukuran < 40000000){

								move_uploaded_file($file_tmp, 'skhun/'.$namaFileBaru);
								$picture = $namaFileBaru;

								$sqlFoto = "SELECT * FROM skhun WHERE nisn = '$nisn'";
								$executeFoto = $db->query($sqlFoto);
								$assocFoto = $executeFoto->fetch_assoc();

								unlink("skhun/".$assocFoto["foto_skhun"]);
						}else
								echo 'UKURAN FILE TERLALU BESAR';
				}else 
						echo 'UPLOAD DALAM BENTUK jpg/pdf/jpeg/png';
		}
  	// skhun


  	$sqlUpdatePendaftar = updatePendaftar($nisn, $namaLengkap, $ttl, $jk, $agama, $alamat, $noTelp, $asalSekolah, $namaOrtu, $matematika, $ipa, $bindo, $binggris, $picture, $no_skhun, $tb);


  }


  if (empty($assocskhun['foto_skhun'])) {
	$img = "doc.png";
  }else{
	$img = $assocskhun["foto_skhun"];
  }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<title></title>
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
	          <a class="nav-link" href="logout.php"><h5>Logout</h5></a>
	        </li>
	      </ul>
	    </div>
	  </div>
	</nav>



	<div class="container mt-5 mb-5">
		
		<div class="mt-5 mb-5">
			<h4>
				<b>Biodata Pendaftar</b>
			</h4>
		</div>

		<hr>
		<form action="" method="POST" enctype="multipart/form-data">
			
			<table cellpadding="5" width="100%">
			 	
			 	<tr>
			 		<th>Nama Lengkap</th>
			 		<td><input type="text" class="form-control" name="namaPendaftar" placeholder="Nama Lengkap" value="<?= $assoc['nama_lengkap']?>" required></td>
			 	</tr>

			 	<tr>
			 		<th>Tempat dan Tanggal Lahir</th>
			 		<td><input type="text" class="form-control" name="ttl" placeholder="Example : Bandung, 15 Agustus 2002" value="<?= $assoc['ttl']?>" required></td>
			 	</tr>

			 	<tr>
			 		<th>Jenis Kelamin</th>
			 		<td>
  						<select name="jk" class="form-control">
							<option value="<?= $assoc['jenis_kelamin']?>"><?= $assoc['jenis_kelamin']?></option>
							<option value="Laki-Laki">Laki-Laki</option>
  							<option value="Perempuan">Perempuan</option>
						</select>
					</td>
			 	</tr>

			 	<tr>
			 		<th>Agama</th>
			 		<td><input type="text" class="form-control" name="agama" placeholder="Agama" value="<?= $assoc['agama']?>" required></td>
			 	</tr>

			 	<tr>
			 		<th>Alamat</th>
			 		<td>
			 			<input type="text" name="alamat" value="<?= $assoc['alamat']?>" class="form-control" placeholder="Alamat" required>
			 		</td>
			 	</tr>

			 	<tr>
			 		<th>No Telp</th>
			 		<td><input type="text" class="form-control" name="noTelp" placeholder="No Telpon (Whatsapp)" value="<?= $assoc['no_telp']?>" required></td>
			 	</tr>

			 	<tr>
			 		<th>Asal Sekolah</th>
			 		<td><input type="text" class="form-control" name="asalSekolah" placeholder="Asal Sekolah (SMPN 15 Papua Barat)" value="<?= $assoc['asal_sekolah']?>" required></td>
			 	</tr>

			 	<tr>
			 		<th>Nama Orang Tua</th>
			 		<td><input type="text" class="form-control" name="namaOrtu" placeholder="Nama Ayah / Ibu" value="<?= $assoc['nama_orangtua']?>" required></td>
			 	</tr>

			</table>

			<hr>

			<div class="mt-5 mb-5">
				<h4>
					<b>Nilai Pendaftar</b>
				</h4>
			</div>

			<table cellpadding="5" width="100%">
				
				<tr>
			 		<th>Matematika</th>
			 		<td><input type="number" max="100" min="0" class="form-control" name="matematika" placeholder="Matematika" value="<?= $assocNilai['matematika']?>" required></td>
			 	</tr>

			 	<tr>
			 		<th>IPA</th>
			 		<td><input type="number" max="100" min="0" class="form-control" name="ipa" placeholder="IPA" value="<?= $assocNilai['IPA']?>" required></td>
			 	</tr>

			 	<tr>
			 		<th>Bahasa Indonesia</th>
			 		<td><input type="number" max="100" min="0" class="form-control" name="bindo" value="<?= $assocNilai['b_indonesia']?>" placeholder="B Indonesia" required></td>
			 	</tr>

			 	<tr>
			 		<th>Bahasa Inggris</th>
			 		<td><input type="number" max="100" min="0" class="form-control" name="binggris" value="<?= $assocNilai['b_inggris']?>" placeholder="B Inggris" required></td>
			 	</tr>

			</table>

			<hr>

			<div class="mt-5 mb-5">
				<h4>
					<b>Upload SKHUN</b>
				</h4>
			</div>
			<input type="hidden" name="gambarLama" value="<?= $assocskhun["foto_skhun"] ?>">
			<table cellpadding="5" width="100%">
				
				<tr>
			 		<th>Nomor SKHUN</th>
			 		<td><input type="number" class="form-control" name="no_skhun" value="<?= $assocskhun["no_skhun"] ?>"" placeholder="Nomor SKHUN" required></td>
			 	</tr>

				<tr>
			 		<th>SKHUN</th>
			 		<td><input type="file" class="form-control" name="file" placeholder="SKHUN"></td>
			 	</tr>

			 	<tr>
			 		<td></td>
			 		<td><img src="skhun/<?= $img;?>" width="150px"></td>
			 	</tr>

			</table>

			<div class="mt-5 mb-5">
				<button name="save" type="submit" class="btn btn-primary">Save</button>
			</div>

		</form>

	</div>











<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>