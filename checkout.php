<?php
include 'config/koneksi.php';
require 'config/session.php';

if (($_SESSION['status'])=="Belum Login"){
    echo "<script>alert('Silahkan Login terlebih dahulu')
    window.location.replace('index.php');</script>";
}
if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])) {
    echo "<script>alert('Keranjang anda kosong, silahkan belanja dulu')
    window.location.replace('media.php');</script>";
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
	<?php
    include 'config/koneksi.php';
    include 'config/kompres.php';
    ?>
    <!-- Topbar Start -->
     <?php include 'menu.php'?>
    <!-- Navbar End -->
<!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="index.php">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Checkout</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 align-items-center justify-content-center">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subharga</th>
                            
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php $nomor = 1;?>
                        <?php $total_belanja = 0; ?>
                    	<?php foreach ($_SESSION['keranjang'] as $kd_barang => $jumlah): 
                    	?>
                    	<?php
                    	$ambil = mysqli_query($con,"SELECT * FROM barang WHERE kd_barang = '$kd_barang'");
                    	$pecah = $ambil->fetch_assoc();
                    	$subharga = $pecah['harga_jual'] * $jumlah;
                    	
                    	?>
                        <tr>
                            <td class="align-middle"><?php echo $nomor; ?></td>
                            <td class="align-middle"><img src=<?php echo "foto_produk/small_$pecah[foto]";?> alt="" style="width: 50px;"><?php echo $pecah['nama'];?></td>
                            <td class="align-middle">Rp.<?php echo number_format($pecah['harga_jual']);?></td>
                            <td class="align-middle"><?php echo $jumlah; ?></td>
                            <td class="align-middle">Rp.<?php echo number_format($subharga);?></td>
                            
                        </tr>
                        <?php $total_belanja+=$subharga;?>
                        <?php $nomor++;?>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <th class="text-center" colspan="4">Total Belanja</th>
                        <th class="text-center">Rp.<?php echo number_format($total_belanja);?></th>
                    </tfoot>
                </table>
                <form method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['nama_pelanggan'];?>">
                        </div>
                        <div class="col-md-4">
                            <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['no_pelanggan'];?>">
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                               <select name="id_ongkir" class="form-control text-center" required autofocus>
                                    <option value="">-- Pilih Ongkir --</option>
                                    <?php $ambil = $con->query("SELECT * FROM ongkir");
                                    while ($perongkir = $ambil->fetch_assoc()) { 
                                    
                                    ?>
                                    <option value="<?php echo $perongkir['id_ongkir'];?>"><?php echo $perongkir['nama_kota'];?> - Rp.<?php echo number_format($perongkir['tarif']);?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alamat Pengiriman</label>
                        <textarea name="alamat_pengiriman" rows="2" class="form-control" style="resize: none;" placeholder="Masukan Alamat Pengiriman Secara Lengkap (Termasuk Kode Pos)" required autofocus></textarea>
                    </div>
                    <button class="btn btn-primary" name="checkout">Checkout</button>
                    
                </form>
                <?php
                        if (isset($_POST["checkout"])) {
                            $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                            $id_ongkir = $_POST["id_ongkir"];
                            $tanggal_pembelian = date("Ymd");
                            $alamat_pengiriman = $_POST['alamat_pengiriman']; 

                            $ambil = $con->query("SELECT * FROM ongkir WHERE id_ongkir = '$id_ongkir'");
                            $arrray_ongkir = $ambil->fetch_assoc();
                            $nama_kota=$arrray_ongkir['nama_kota'];
                            $tarif = $arrray_ongkir['tarif'];

                            $total_pembelian = $total_belanja + $tarif;
                            $con -> query("INSERT INTO pembelian(id_pelanggan, id_ongkir, tanggal_pembelian, total_pembelian, nama_kota, tarif, alamat_pengiriman) VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman')");
                            
                            $id_pembelian_barusan = $con->insert_id;

                            foreach ($_SESSION['keranjang'] as $kd_barang => $jumlah) {
                                $con->query("INSERT INTO pembelian_barang (id_pembelian, kd_barang, jumlah) VALUES ('$id_pembelian_barusan','$kd_barang','$jumlah')");
                            
                            $con->query("UPDATE barang SET jumlah_barang = jumlah_barang - $jumlah WHERE kd_barang='$kd_barang'");

                            }
                            unset($_SESSION['keranjang']);
                            echo "<script>alert('Pembelian Sukses')
                            window.location.replace('nota.php?id=$id_pembelian_barusan');</script>";
                        }
                        ?>
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
</html>
</body>