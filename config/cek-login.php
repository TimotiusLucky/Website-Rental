<?php
session_start();

include'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$login = mysqli_query($conn, "SELECT * from akun where username='$username' AND password=MD5('$password')");

$cek = mysqli_num_rows($login);

if($cek > 0){

	$data = mysqli_fetch_assoc($login);

	if($data['level'] == "admin"){

		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";

		header("location:/web_rental/admin/adm-index");

	}else if($data['level'] == "user"){

        $_SESSION['id_user'] = $data['id_akun'];
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "user";

		header("location:/web_rental");

	}else{

		header("location:/web_rental/login?pesan=gagal");
	}

}else{
	header("location:/web_rental/login?pesan=gagal");
}
?>