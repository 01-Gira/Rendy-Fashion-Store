<?php
include "koneksi.php";


$query = "UPDATE notifikasi_pelanggan SET status_baca = '1'";
mysqli_query($con, $query);

header('location:../media.php');
?>