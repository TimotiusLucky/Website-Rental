<?php

    include_once("koneksi.php");
    
    $kode_layanan = $_GET['kode_layanan'];

    $hpsgbr = mysqli_query($conn, "SELECT * FROM layanan WHERE kode_layanan='$kode_layanan'");
	$hapus_gambar =mysqli_fetch_array($hpsgbr);

	if ($hapus_gambar['gambar_layanan'] == "") {

	}else{

	unlink("img_layanan/$hapus_gambar[gambar_layanan]");

	}
    
	mysqli_query($conn, "DELETE FROM layanan WHERE kode_layanan='$kode_layanan'");

	header("location:/web_rental/admin/layanan-index?pesan=hapusLayanan");

?>