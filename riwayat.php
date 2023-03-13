<?php
require 'config/koneksi.php';
require 'config/session.php';
include 'config/fungsi_indotgl.php';

if (($_SESSION['status'])=="Belum Login"){
    echo "<script>alert('Silahkan Login terlebih dahulu')
    window.location.replace('index.php');</script>";
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
    <!-- Topbar End -->
    <?php include'menu.php';?>
    <!-- Navbar End -->
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Riwayat Pembelian</h1>
            <h2><?php echo $_SESSION['pelanggan']['nama_pelanggan']?></h2>
            <div class="d-inline-flex">
                <p class="m-0"><a href="index.php">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Riwayat Pembelian</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 align-items-center justify-content-center">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>No</th>
                            <th>Tanggal <a href="?p=riwayat&sort=tanggal_asc"><i class="fa fa-arrow-up"></i></a><a href="?p=riwayat&sort=tanggal_desc"><i class="fa fa-arrow-down"></i></a></th>
                            <th>Status <a href="?p=riwayat&sort=status_asc"><i class="fa fa-arrow-up"></i></a><a href="?p=riwayat&sort=status_desc"><i class="fa fa-arrow-down"></i></a></th>
                            <th>Total <a href="?p=riwayat&sort=total_asc"><i class="fa fa-arrow-up"></i></a><a href="?p=riwayat&sort=total_desc"><i class="fa fa-arrow-down"></i></a></th>
                            <th>Opsi</th>
                            
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                    <?php
                       $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

                       if(!empty($id_pelanggan)) {
                           if (isset($_GET['sort'])) {
                               $sort = $_GET['sort'];
                               switch ($sort) {
                                   case 'tanggal_asc':
                                       $sql = mysqli_query($con, "SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan' ORDER by tanggal_pembelian ASC");
                                       break;
                                   case 'tanggal_desc':
                                       $sql = mysqli_query($con, "SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan' ORDER by tanggal_pembelian DESC");
                                       break;
                                   case 'status_asc':
                                       $sql = mysqli_query($con, "SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan' ORDER by status_pembelian ASC");
                                       break;
                                   case 'status_desc':
                                       $sql = mysqli_query($con, "SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan' ORDER by status_pembelian DESC");
                                       break;
                                   case 'total_asc':
                                       $sql = mysqli_query($con, "SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan' ORDER by total_pembelian ASC");
                                       break;
                                   case 'total_desc':
                                       $sql = mysqli_query($con, "SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan' ORDER by total_pembelian DESC");
                                       break;
                                   default:
                                       $sql = mysqli_query($con, "SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan' order by tanggal_pembelian DESC");
                                       break;
                               }
                           } else {
                               $sql = mysqli_query($con, "SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan' order by tanggal_pembelian DESC");
                           }
                       }
                       

                        
                        $nomor=1;
                        // $sql=$con->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan' ORDER BY tanggal_pembelian DESC");
                        while ($pecah=$sql->fetch_assoc()) {
                            $tanggalindonesia = tgl_indo($pecah['tanggal_pembelian']);
                        ?>
                        <tr>
                            <td class="align-middle"><?php echo $nomor;?></td>
                            <td class="align-middle"><?php echo $tanggalindonesia;?></td>
                            <td class="align-middle"><?php echo $pecah['status_pembelian'];?><br>
                            <?php if(!empty($pecah['resi_pembelian'])):?>
                            Resi: <?php echo $pecah['resi_pembelian']?>   
                            <?php endif ?>  
                            </td>
                            
                            <td class="align-middle">Rp.<?php echo number_format($pecah['total_pembelian']);?></td>
                            <td class="align-middle">
                                <a href="nota.php?id=<?php echo $pecah['id_pembelian']?>" class="btn btn-info me-3">Nota</a>
                                <?php if($pecah['status_pembelian']=="pending"): ?>
                                    <a href="pembayaran.php?id=<?php echo $pecah['id_pembelian'];?>" class="btn btn-success"> Input Pembayaran </a>
                                <?php elseif($pecah['status_pembelian']=="Barang Dikirim"): ?>
                                    <form method="post">
                                        <input type="hidden" name="id_pembelian" value="<?php echo $pecah['id_pembelian']; ?>">
                                        <button type="submit" name="terima_barang" class="btn btn-success mt-1" onclick="return confirm('Anda yakin barang sudah diterima?')"> Barang telah diterima</button>
                                    </form>
                                    <?php 
                                    // jika tombol "Barang telah diterima" ditekan
                                    if(isset($_POST['terima_barang'])) {
                                        $id_pembelian = $_POST['id_pembelian'];
                                        $status_pembelian = 'Barang Diterima';
                                        // update status pembelian menjadi "selesai"
                                        $con->query("UPDATE pembelian SET status_pembelian='$status_pembelian' WHERE id_pembelian='$id_pembelian'");

                                        // notifikasi pemesanan
                                        $tanggal = date("Y-m-d H:i:s");
                                        $pesan = "Pesanan dengan ID #$id_pembelian $status_pembelian";

                                        $con->query("INSERT INTO notifikasi_pelanggan (id_pelanggan, id_pesanan, tanggal, pesan) VALUES ('$id_pelanggan','$id_pembelian','$tanggal','$pesan')");

                                        echo"<script>alert('Barang telah diterima');
                                        window.location.replace('riwayat.php')</script>";
                                    }
                                    ?>
                                <?php else: ?>
                                    <a href="lihat_pembayaran.php?id=<?php echo $pecah['id_pembelian'];?>" class="btn btn-warning"> Lihat Pembayaran </a>
                                <?php endif ?>

                            </td>
                        <?php $nomor++;?>
                        <?php 
                        } 
                        ?>
                        </tr>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">Rendy's</span>Fashion Store</h1>
                </a>
                <p>Dolore erat dolor sit lorem vero amet. Sed sit lorem magna, ipsum no sit erat lorem et magna ipsum dolore amet erat.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="store.php"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-dark mb-2" href="detail.php"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-dark mb-2" href="cart.php"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-dark mb-2" href="checkout.php"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="contact.php"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="store.php"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-dark mb-2" href="detail.php"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-dark mb-2" href="cart.php"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-dark mb-2" href="checkout.php"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="contact.php"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" class="form-control border-0 py-4" placeholder="Your Name" required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 py-4" placeholder="Your Email"
                                    required="required" />
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block border-0 py-3" type="submit">Subscribe Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">Your Site Name</a>. All Rights Reserved. Designed
                    by
                    <a class="text-dark font-weight-semi-bold" href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>