<?php

$servername = "localhost";
$database = "db-web-rental";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

if(is_resource($conn) && get_resource_type($conn)==='mysql link'){
    $conn->close();
}

?>