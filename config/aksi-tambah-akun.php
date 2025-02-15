<?php

include'koneksi.php';

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];

mysqli_query($conn, "INSERT INTO akun(username, password, nama, no_telp, alamat, email, level) VALUES('$username', MD5('$password'), '$nama', '$no_telp', '$alamat', '$email', '$level')");

if ($level == "user") {

	header("location:/web_rental/login?pesan=tambahAkun");
}else{

	header("location:/web_rental/admin/adm-index?pesan=tambahAdmin");
}

?>