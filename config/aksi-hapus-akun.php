<?php

    include "koneksi.php";

    $id = $_GET['id'];

    $db = mysqli_query($conn, "SELECT * FROM akun WHERE id_akun='$id'");

    while($data = mysqli_fetch_array($db)){

    	$level = $data['level'];
    
	    mysqli_query($conn, "DELETE FROM akun WHERE id_akun = $id");

	    if ($level == "admin") {
	    	
	    	header("location:/web_rental/admin/adm-index?pesan=hapusAdmin");

	    }else{

	    	header("location:/web_rental/user/user-index?pesan=hapusUser");

	    }

	}

?>