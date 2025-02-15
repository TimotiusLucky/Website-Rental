<?php

$id_akun = $_POST['id_akun'];
$plat_mobil = $_POST['plat_mobil'];
$kd_layanan = $_POST['kd_layanan'];
$sts_supir = $_POST['status_supir'];
$tgl_pinjam = $_POST['tgl_pinjam'];
$tgl_kembali = $_POST['tgl_kembali'];
$ttl_harga = $_POST['ttl_harga'];
$jml_sewa = $_POST['jml_sewa'];
$mtd_bayar = $_POST['mtd_bayar'];

$tgl_pinjam = strtotime($tgl_pinjam);
$tgl_kembali = strtotime($tgl_kembali);

$tgl_pinjam = date("Y-m-d H:i", $tgl_pinjam);
$tgl_kembali = date("Y-m-d H:i", $tgl_kembali);

include_once("koneksi.php");

$filename = $_FILES["uploadfile"]["name"];
$tempname = $_FILES["uploadfile"]["tmp_name"];
$folder = "./img_pembayaran/bukti_pembayaran/" . $filename;

if (move_uploaded_file($tempname, $folder)) {

	mysqli_query($conn, "INSERT INTO transaksi(id_akun, plat_mobil, kd_layanan, sts_supir, tgl_pinjam, tgl_kembali, ttl_harga, jml_sewa, mtd_bayar, gambar_bukti) VALUES('$id_akun', '$plat_mobil', '$kd_layanan', '$sts_supir', '$tgl_pinjam', '$tgl_kembali', '$ttl_harga', '$jml_sewa', '$mtd_bayar', '$filename')");

	mysqli_query($conn, "UPDATE mobil SET status=1 WHERE plat_mobil='".$plat_mobil."'");
	
	header("location:/web_rental/index?pesan=bayarSukses");

} else {
	echo "<h3> Failed to upload image!</h3>";
}

?>