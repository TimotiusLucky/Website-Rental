<?php

$nm_layanan = $_POST['nm_layanan'];
$param_hari = $_POST['param_hari'];
$jml_hari = $_POST['jml_hari'];
$ket_layanan = $_POST['ket_layanan'];
$hrg_tambahan = $_POST['hrg_tambahan'];

if ($param_hari == "Jam"){

	$jml_hari = $jml_hari/24;

}

include_once("koneksi.php");

$filename = $_FILES["uploadfile"]["name"];
$tempname = $_FILES["uploadfile"]["tmp_name"];
$folder = "./img_layanan/" . $filename;

if (move_uploaded_file($tempname, $folder)) {

	mysqli_query($conn, "INSERT INTO layanan(nm_layanan, jml_hari, ket_layanan, hrg_tambahan, gambar_layanan) VALUES('$nm_layanan', '$jml_hari', '$ket_layanan', '$hrg_tambahan', '$filename')");
	
	header("location:/web_rental/admin/layanan-index?pesan=tambahlayanan");

} else {
	echo "<h3> Failed to upload image!</h3>";
}

?>