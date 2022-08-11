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
	$selectPendaftar = "SELECT * FROM pendaftar WHERE nisn = '$sesi'";
	$executePendaftar = $db->query($selectPendaftar);
	$assoc = $executePendaftar->fetch_assoc();

	if (empty($assoc['nama_orangtua'])) {
		echo "
			<script>
				alert('Lengkapi dahulu biodata anda');
				document.location.href = 'index.php	';
			</script>
		";
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


	<div class="container">
		
		<div class="mt-5 mb-3">
		
			<div class="jd-pensmas mb-3 mt-5">
				<h1>
					Bukti Pendaftaran
				</h1>
			</div>

			<div class="mt-5">
				<table cellpadding="10">
					
					<tr>
						<th>No Pendaftaran</th>
						<td><?= $assoc['no_pendaftar']?></td>
					</tr>

					<tr>
						<th>Nama Pendaftar</th>
						<td><?= $assoc['nama_lengkap']?></td>
					</tr>

					<tr>
						<th>Tempat dan tanggal lahir</th>
						<td><?= $assoc['ttl']?></td>
					</tr>

					<tr>
						<th>Jenis Kelamin</th>
						<td><?= $assoc['jenis_kelamin']?></td>
					</tr>

					<tr>
						<th>Agama</th>
						<td><?= $assoc['agama']?></td>
					</tr>

					<tr>
						<th>Asal Sekolah</th>
						<td><?= $assoc['asal_sekolah']?></td>
					</tr>

				</table>
			</div>

			<div class="mt-5 mb-5">
				<p>
					<?= $assoc['nama_lengkap']?>, dengan nomor pendaftaran <?= $assoc['no_pendaftar']?>. Segera lakukan daftar ulang, dengan cara datang ke sekolah, berikan bukti pendaftaran agar data bisa langsung diproses oleh petugas
				</p>
			</div>

		</div>

	</div>



<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>