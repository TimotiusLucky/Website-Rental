<?php

$plat_mobil = $_GET['plat_mobil'];
$kd_pesanan = $_GET['kd_pesanan'];
$denda = $_GET['denda'];
$tgl_terima = date("Y-m-d");
$sts_pesanan = 0;

include_once("koneksi.php");

mysqli_query($conn, "UPDATE mobil SET status=0 WHERE plat_mobil='$plat_mobil'");

mysqli_query($conn, "UPDATE pesanan SET denda='$denda',tgl_terima='$tgl_terima',sts_pesanan='$sts_pesanan' WHERE kd_pesanan='".$kd_pesanan."'");

			
header("location:/web_rental/admin/pesanan-index?pesan=pengembalianMobil");


?>