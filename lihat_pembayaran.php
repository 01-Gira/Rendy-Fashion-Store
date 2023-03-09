<?php
require 'config/koneksi.php';
require 'config/session.php';
include 'config/fungsi_indotgl.php';
if (($_SESSION['status'])=="Belum Login"){
    echo "<script>alert('Silahkan Login terlebih dahulu')
    window.location.replace('login.php');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>EShopper - Bootstrap Shop Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <body>
    <?php
    include 'config/kompres.php';
    ?>
    <?php include'menu.php';?>
    <!-- Navbar End -->
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Lihat Pembayaran</h1>
            <h2><?php echo $_SESSION['pelanggan']['nama_pelanggan']?></h2>
            <div class="d-inline-flex">
                <p class="m-0"><a href="index.php">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Lihat Pembayaran</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    <div class="row mt">
          <div class="col-lg-12">
            <div class="content-panel justify-content-center ">
                <?php 
                $id_pembelian = $_GET['id'];

                $sql=mysqli_query($con, "SELECT * FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian WHERE pembelian.id_pembelian='$id_pembelian'");
                
                $r=mysqli_fetch_array($sql);
                $tanggalindonesia = tgl_indo($r['tanggal']);
                if (empty($r)) {
                    echo "<script>alert('Belum ada data pembayaran');
                    window.location.replace('riwayat.php')</script>";
                }
                if ($_SESSION['pelanggan']['id_pelanggan']!==$r['id_pelanggan']) {
                    echo "<script>alert('Anda tidak berhak melihat pembayaran orang lain');
                    window.location.replace('riwayat.php')</script>";
                }
                ?>

                    <table class="table">
                        <tr>
                            <th>Nama</th>
                            <td><?php echo $r['nama'];?></td>
                        </tr>
                        <tr>
                            <th>Bank</th>
                            <td><?php echo $r['bank'];?></td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td>Rp.<?php echo number_format($r['jumlah']);?></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td><?php echo $tanggalindonesia;?></td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td><?php echo $r['status_pembelian'];?></td>
                        </tr>
                    </table>
                <div class="col-md-6">
                    <img src="../foto_bukti/<?php echo $r['bukti'];?>" alt="" class="img-responsive">
                </div>
            </div>
          </div>
        </div>
