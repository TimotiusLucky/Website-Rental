<?php

    include_once("koneksi.php");
    
    $plat_mobil = $_GET['plat_mobil'];

    $hpsgbr = mysqli_query($conn, "SELECT * FROM mobil where plat_mobil='$plat_mobil'");
	$hapus_gambar =mysqli_fetch_array($hpsgbr);

	if ($hapus_gambar['gambar_mobil'] == "") {

	}else{

	unlink("img_mobil/$hapus_gambar[gambar_mobil]");

	}
    
	mysqli_query($conn, "DELETE FROM mobil WHERE plat_mobil LIKE '%$plat_mobil%'");

	header("location:/web_rental/admin/mobil-index?pesan=hapusMobil");

?>