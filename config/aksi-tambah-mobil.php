<?php

$plat_mobil = $_POST['plat_mobil'];
$merek = $_POST['merek'];
$tipe = $_POST['tipe'];
$model = $_POST['model'];
$warna = $_POST['warna'];
$tahun = $_POST['tahun'];
$jenis = $_POST['jenis'];
$hrg_hari = $_POST['hrg_hari'];
$hrg_supir = $_POST['hrg_supir'];
$status = $_POST['status'];

include_once("koneksi.php");

$filename = $_FILES["uploadfile"]["name"];
$tempname = $_FILES["uploadfile"]["tmp_name"];
$folder = "./img_mobil/" . $filename;

$plat = mysqli_query($conn, "SELECT * from mobil where plat_mobil='$plat_mobil'");

$cek = mysqli_num_rows($plat);

if($cek > 0){

	header("location:/web_rental/admin/tambah-mobil?pesan=cekMobil");

}else{

	if (move_uploaded_file($tempname, $folder)) {

		mysqli_query($conn, "INSERT INTO mobil(plat_mobil, merek, tipe, model, warna, tahun, jenis, gambar_mobil, hrg_hari, hrg_supir, status) VALUES('$plat_mobil', '$merek', '$tipe', '$model', '$warna', '$tahun', '$jenis', '$filename', '$hrg_hari', '$hrg_supir', '$status')");
		
		header("location:/web_rental/admin/mobil-index?pesan=tambahMobil");

	} else {
		echo "<h3> Failed to upload image!</h3>";
	}

}

?>