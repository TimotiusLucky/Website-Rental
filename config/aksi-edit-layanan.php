<?php

$kode_layanan = $_POST['kode_layanan'];
$nm_layanan = $_POST['nm_layanan'];
$param_hari = $_POST['param_hari'];
$jml_hari = $_POST['jml_hari'];
$ket_layanan = $_POST['ket_layanan'];
$hrg_tambahan = $_POST['hrg_tambahan'];

if ($param_hari == "Jam"){

	$jml_hari = $jml_hari/24;

}

include_once("koneksi.php");

$hpsgbr = mysqli_query($conn, "SELECT * FROM layanan where kode_layanan='$kode_layanan'");
$hapus_gambar =mysqli_fetch_array($hpsgbr);

if ($hapus_gambar['gambar_layanan'] == "") {

}else{

unlink("img_layanan/$hapus_gambar[gambar_layanan]");

}

$filename = $_FILES["uploadfile"]["name"];
$tempname = $_FILES["uploadfile"]["tmp_name"];
$folder = "./img_layanan/" . $filename;


if (move_uploaded_file($tempname, $folder)) {

	mysqli_query($conn, "UPDATE layanan SET nm_layanan='$nm_layanan',jml_hari='$jml_hari',ket_layanan='$ket_layanan',hrg_tambahan='$hrg_tambahan',gambar_layanan='$filename' WHERE kode_layanan='$kode_layanan'");

		
	header("location:/web_rental/admin/layanan-index?pesan=editlayanan");

} else {
	echo "<h3> Failed to upload image!</h3>";
}

?>