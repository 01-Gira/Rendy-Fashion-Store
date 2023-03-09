<?php
include 'config/koneksi.php';
require 'config/session.php';
include 'config/fungsi_indotgl.php';
if (!isset($_SESSION['status'])){
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
    <?php include 'menu.php'?>
    <!-- Navbar End -->
	<!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Nota Pembelian</h1>
             <?php
				$ambil = $con->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
				$detail = $ambil->fetch_assoc();
                $tanggalindonesia = tgl_indo($detail['tanggal_pembelian']);
				?>
                <?php 
                $idpelanggan_beli = $detail['id_pelanggan'];
                $idpelanggan_login = $_SESSION['pelanggan']['id_pelanggan'];

                if ($idpelanggan_login !== $idpelanggan_beli){
                    echo "<script>alert('Jangan Nakal Ya')
                    window.location.replace('riwayat.php')</script>";
                    exit(); 
                }
                ?>

				<div class="row">
					<div class="col-md-4">
						<h3>Pembelian</h3>
						<strong>No. Pembelian : <?php echo $detail['id_pembelian']?></strong><br>
						Tanggal : <?php echo $tanggalindonesia?><br>
						Total : Rp.<?php echo number_format($detail['total_pembelian']); ?><br>
					</div>
					<div class="col-md-4">
						<h3>Pelanggan</h3>
						<strong>Nama : <?php echo $detail['nama_pelanggan'];?></strong><br>
						Telepon : <?php echo $detail['no_pelanggan']; ?><br>
						Email : <?php echo $detail['email_pelanggan']; ?><br>
					</div>
					<div class="col-md-4">
						<h3>Pengiriman</h3>
						<strong>Kab. / Kota : <?php echo $detail['nama_kota'];?></strong><br>
						Ongkir : Rp.<?php echo number_format($detail['tarif']); ?><br>
						Alamat : <?php echo $detail['alamat_pengiriman']; ?><br>
					</div>
				</div>
        </div>
    </div>
    <!-- Page Header End -->

   
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Produk</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Subharga</th>
			</tr>
		</thead>
		<tbody class="align-middle">
	                        <?php $nomor = 1;?>
	                    	<?php
	                    	$ambil = mysqli_query($con,"SELECT * FROM pembelian_barang JOIN barang 
	                    	ON pembelian_barang.kd_barang=barang.kd_barang 
	                    	WHERE pembelian_barang.id_pembelian='$_GET[id]'");?>
	                    	<?php while ($pecah=$ambil->fetch_assoc()) {
	                    	?>
	                        <tr>
	                            <td class="align-middle"><?php echo $nomor; ?></td>
	                            <td class="align-middle"><?php echo $pecah['nama'];?></td>
	                            <td class="align-middle">Rp.<?php echo number_format($pecah['harga_jual']);?></td>
	                            <td class="align-middle"><?php echo $pecah['jumlah']; ?></td>
	                            <td class="align-middle">Rp.<?php echo number_format($pecah['harga_jual']*$pecah['jumlah']) ;?></td>
	                            
	                        </tr>
	                        <?php $nomor++ ?>
	                        <?php } ?>
	    </tbody>
	</table>
	<div class="row">
		<div class="col-md-7">
			<div class="alert alert-info">
				<p>
					Silahkan melakukan pembayaran Rp.<?php echo number_format($detail['total_pembelian']); ?> ke <br>
					<strong>BANK BRI 180-001234-1234 GIRA MUHAMMAD NUR ICHARISMA</strong>
				</p>
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
