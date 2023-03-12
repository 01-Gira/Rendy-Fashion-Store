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



</html>        