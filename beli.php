<?php
session_start();
$kd_barang = $_GET['kd_barang'];
    if (isset($_SESSION['keranjang'][$kd_barang])) {
    $_SESSION['keranjang'][$kd_barang] ++;
    }else {
    $_SESSION['keranjang'][$kd_barang] = 1;
    } 


//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
echo "<script>alert('Produk Berhasil dimasukan')
window.location.replace('keranjang.php');</script>";
?>