<?php
session_start();

$kd_barang=$_GET['kd_barang'];
unset($_SESSION['keranjang'][$kd_barang]);
echo "<script>alert('Produk dihapus dari keranjang')</script>";
header('location:keranjang.php');;
?>