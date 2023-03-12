<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Dashio - Bootstrap Admin Template</title>

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <?php 
    if ($_GET['p']=='home') {
      include 'home.php';
    }else if($_GET['p']=='produk') {
      include 'modul/produk/produk.php'; 
     }else if($_GET['p']=='kategori') {
      include 'modul/kategori/kategori.php'; 
    }else if($_GET['p']=='pembelian') {
      include 'modul/menutransaksi/pembelian.php'; 
    }else if($_GET['p']=='laporan_transaksi') {
      include 'modul/menutransaksi/laporan_transaksiphp'; 
    }else if($_GET['p']=='detail_pembelian') {
      include 'modul/menutransaksi/detail_pembelian.php'; 
    }else if($_GET['p']=='pembayaran') {
      include 'modul/menutransaksi/pembayaran.php'; 
    }



    else{
      include '404.html';
    }

  ?>


</body>

<script>
    document.getElementById("search-bar-produk").addEventListener("input", function() {
        // Ambil nilai input dan ubah menjadi lowercase
        var input = this.value.toLowerCase();

        // Ambil semua baris pada tabel
        var rows = document.getElementsByTagName("tr");

        // Loop melalui semua baris, mulai dari baris kedua
        for (var i = 1; i < rows.length; i++) {
            // Ambil nama produk pada kolom kedua
            var namaProduk = rows[i].getElementsByTagName("td")[1].textContent.toLowerCase();
            var kategoriProduk = rows[i].getElementsByTagName("td")[2].textContent.toLowerCase();
            var hargaProduk = rows[i].getElementsByTagName("td")[3].textContent.toLowerCase();
            var tanggalMasuk = rows[i].getElementsByTagName("td")[4].textContent.toLowerCase();
            var jumlahProduk = rows[i].getElementsByTagName("td")[5].textContent.toLowerCase();

            // Cek apakah nama produk, kategori, harga, tanggal masuk, atau jumlah mengandung nilai input
            if (namaProduk.indexOf(input) > -1 || kategoriProduk.indexOf(input) > -1 || hargaProduk.indexOf(input) > -1 || tanggalMasuk.indexOf(input) > -1 || jumlahProduk.indexOf(input) > -1) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    });

    document.getElementById("search-bar-kategori").addEventListener("input", function() {
        // Ambil nilai input dan ubah menjadi lowercase
        var input = this.value.toLowerCase();

        // Ambil semua baris pada tabel
        var rows = document.getElementsByTagName("tr");

        // Loop melalui semua baris, mulai dari baris kedua
        for (var i = 1; i < rows.length; i++) {
            // Ambil value pada kolom 
            var kodeKategori = rows[i].getElementsByTagName("td")[1].textContent.toLowerCase();
            var kategori = rows[i].getElementsByTagName("td")[2].textContent.toLowerCase();
           
            // Cek apakah kategori mengandung nilai input
            if (kodeKategori.indexOf(input) > -1 || kategori.indexOf(input) > -1) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    });

    
</script>


</html>        