<?php 
 
session_start();
unset($_SESSION['id_akun']);  
unset($_SESSION['username']);  
unset($_SESSION['level']);  
session_destroy();
 
header("Location: login?pesan=logout");
 
?>