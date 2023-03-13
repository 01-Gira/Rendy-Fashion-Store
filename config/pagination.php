<?php 
require 'koneksi.php';
// Jumlah data per halaman
$limit = 6;

// Menentukan halaman aktif
$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

// Hitung jumlah data total
$sql = "SELECT COUNT(*) FROM barang";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_row($result);
$total = $row[0];

// Hitung jumlah halaman
$total_pages = ceil($total / $limit);

// Memastikan halaman aktif tidak melebihi total halaman
if ($current_page > $total_pages) {
    $current_page = $total_pages;
}

// Memastikan halaman aktif tidak kurang dari 1
if ($current_page < 1) {
    $current_page = 1;
}

// Hitung offset
$offset = ($current_page - 1) * $limit;

// Query data produk dengan limit dan offset
$query_page_data = mysqli_query($con, "SELECT * FROM barang WHERE jumlah_barang > 0 LIMIT $offset, $limit");



?>