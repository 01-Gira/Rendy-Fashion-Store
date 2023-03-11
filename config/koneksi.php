<?php 
// $con = mysqli_connect("localhost","root","","penjualan") or die();

$con = mysqli_connect("localhost", "root", "", "penjualan");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

?>