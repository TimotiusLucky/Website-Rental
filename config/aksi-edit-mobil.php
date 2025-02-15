<?php

$param = $_POST['param'];
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

$hpsgbr = mysqli_query($conn, "SELECT * FROM mobil where plat_mobil='$param'");
$hapus_gambar =mysqli_fetch_array($hpsgbr);

if ($hapus_gambar['gambar_mobil'] == "") {

}else{

unlink("img_mobil/$hapus_gambar[gambar_mobil]");

}

$filename = $_FILES["uploadfile"]["name"];
$tempname = $_FILES["uploadfile"]["tmp_name"];
$folder = "./img_mobil/" . $filename;

$plat = mysqli_query($conn, "SELECT * from mobil where plat_mobil='$plat_mobil'");

$cek = mysqli_num_rows($plat);

if ($param == $plat_mobil) {
	
	if (move_uploaded_file($tempname, $folder)) {

		echo $param;

		mysqli_query($conn, "UPDATE mobil SET plat_mobil='$plat_mobil',merek='$merek',tipe='$tipe',model='$model',warna='$warna',tahun='$tahun',gambar_mobil='$filename',hrg_hari='$hrg_hari',hrg_supir='$hrg_supir' WHERE plat_mobil='".$plat_mobil."'");

			
		header("location:/web_rental/admin/mobil-index?pesan=editMobil");

	} else {
		echo "<h3> Failed to upload image!</h3>";
	}

}else{

	if($cek > 0){

		header("location:/web_rental/admin/edit-mobil?pesan=cekMobil&plat_mobil=$param");

	}else{

		if (move_uploaded_file($tempname, $folder)) {

		mysqli_query($conn, "UPDATE mobil SET plat_mobil='$plat_mobil',merek='$merek',tipe='$tipe',model='$model',warna='$warna',tahun='$tahun',gambar_mobil='$filename',hrg_hari='$hrg_hari',hrg_supir='$hrg_supir' WHERE plat_mobil='".$plat_mobil."'");

			
		header("location:/web_rental/admin/mobil-index?pesan=editMobil");

	} else {
		echo "<h3> Failed to upload image!</h3>";
	}


	}

}

?>