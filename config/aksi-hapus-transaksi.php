<?php

    include_once("koneksi.php");
    
    $kd_transaksi = $_GET['kd_transaksi'];
    $plat_mobil = $_GET['plat_mobil'];

    $hpsgbr = mysqli_query($conn, "SELECT * FROM transaksi where kd_transaksi='$kd_transaksi'");
	$hapus_gambar =mysqli_fetch_array($hpsgbr);

	if ($hapus_gambar['gambar_bukti'] == "") {

	}else{

	unlink("img_pembayaran/bukti_pembayaran/$hapus_gambar[gambar_bukti]");

	}

	mysqli_query($conn, "UPDATE mobil SET status=0 WHERE plat_mobil='".$plat_mobil."'");
    
	mysqli_query($conn, "DELETE FROM transaksi WHERE kd_transaksi='$kd_transaksi'");

	header("location:/web_rental/admin/transaksi-index?pesan=hapusTransaksi");

?>