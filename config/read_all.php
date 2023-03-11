<?php
include "koneksi.php";

$query = "UPDATE pembelian_barang SET status_baca = '1'";
mysqli_query($con, $query);

header('location:../paneladmin/media.php?p=home');
?>