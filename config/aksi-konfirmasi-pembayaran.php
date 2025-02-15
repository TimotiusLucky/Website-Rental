<?php

$kd_transaksi = $_POST['kd_transaksi'];
$plat_mobil = $_POST['plat_mobil'];
$id_akun = $_POST['id_akun'];
$kd_layanan = $_POST['kd_layanan'];
$tgl_serah = $_POST['tgl_pinjam'];
$sts_pesanan = 1;

include_once("koneksi.php");

mysqli_query($conn, "UPDATE transaksi SET sts_transaksi=1 WHERE kd_transaksi='".$kd_transaksi."'");

mysqli_query($conn, "INSERT INTO pesanan(kd_transaksi, plat_mobil, id_akun, kd_layanan, sts_pesanan) VALUES('$kd_transaksi', '$plat_mobil', '$id_akun', '$kd_layanan', '$sts_pesanan')");

			
header("location:/web_rental/admin/transaksi-index?pesan=konfirmasiTransaksi");


?>