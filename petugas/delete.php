<?php
    session_start();
	if (!isset($_SESSION['petugas'])) {
    	echo "
			<script>
			alert('Anda harus login terlebih dahulu');
			document.location.href = '../login.php';
			</script>
		";
	}
	include '../config.php';
	$db = dbConnect();


    $id = $_GET['id'];

    if($id){
		$sql = "SELECT * FROM pendaftar WHERE nisn = '$id'";
        $exec = $db->query($sql);
		
		if(mysqli_num_rows($exec) > 0){
			$delete = "DELETE FROM pendaftar WHERE nisn = '$id'";
            $deleteNilai = "DELETE FROM nilai WHERE nisn = '$id'";
            $deleteSkhun = "DELETE FROM skhun WHERE nisn = '$id'";

            $execDel = $db->query($delete);
            $execDelN = $db->query($deleteNilai);
            $execDelS = $db->query($deleteSkhun);
            
            if ($execDel) {
                echo "
                    <script>
                        alert('Data Sukses dihapus');
                        document.location.href = 'index.php';
                    </script>   
                ";
            }else{
                echo "
                    <script>
                        alert('Data Gagal dihapus');
                        document.location.href = 'index.php';
                    </script>   
                ";
            }

		}else{
			echo "<script>document.location.href='index.php'</script>";
		}
	}else{
		echo "<script>document.location.href='index.php'</script>";
	}


?>