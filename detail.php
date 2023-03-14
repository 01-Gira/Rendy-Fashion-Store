<?php
require 'config/koneksi.php';
require 'config/session.php';
require 'config/kompres.php'; 
include 'config/fungsi_indotgl.php';


if (isset($_SESSION['pelanggan'])) {
    $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
} else {
    $id_pelanggan = 0; // nilai default jika pelanggan belum login
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
	<?php include 'menu.php'; ?>
	<!-- Navbar End -->
	<!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Detail Produk</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="index.php">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Detail Produk</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    <?php
    $kd_barang = $_GET['kd_barang'];
    $ambil=$con->query("SELECT * FROM barang WHERE kd_barang='$kd_barang'");
    $detail=$ambil->fetch_assoc();
    ?>
    <!--<pre><?php print_r($detail);?></pre>-->
    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src=<?php echo "foto_produk/medium_$detail[foto]";?> alt=" ">
                        </div>
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src=<?php echo "foto_produk/medium_$detail[foto]";?> alt=" ">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold"><?php echo"$detail[nama]";?></h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">(50 Reviews)</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">Rp.<?php echo number_format ($detail['harga_jual']);?></h3>
                <p class="mb-4"><?php echo"$detail[deskripsi]";?></p>
                
                <form method="POST">
                	<div class="form-group">
                		<p class="text-dark font-weight-medium">Stok Barang : <?php echo $detail['jumlah_barang'];?></p>
	                <div class="d-flex align-items-center mb-4 pt-2">

	                    <div class="input-group quantity mr-3" style="width: 130px;">
	                        <input type="number" class="form-control bg-secondary text-center" name="jumlah" max="<?php echo $detail['jumlah_barang'];?>"value="1" required autofocus>
	                    </div>
	                   <button class="btn btn-primary" name="beli"><i class="fa fa-shopping-cart mr-1"></i>Masukan Ke Keranjang</button>
	                </div>
	            	</div>
            	</form>
                <?php
                if (isset($_POST['beli'])) {
                 	$jumlah=$_POST['jumlah'];

                 	$_SESSION['keranjang'][$kd_barang] = $jumlah;

                 	echo "<script>alert('Produk Berhasil dimasukan')
					window.location.replace('keranjang.php');</script>";
                 } 
                ?>
                <div class="d-flex pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
            $sql2 = mysqli_query($con,"SELECT COUNT(rp.id_review) AS jumlah_review, p.nama_pelanggan, rp.tanggal, rp.rating, rp.pesan_review FROM review_produk rp INNER JOIN pelanggan p ON rp.id_pengguna = p.id_pelanggan WHERE rp.id_produk='$kd_barang'");
            $count = mysqli_fetch_assoc($sql2); 
            $jumlah_review = $count['jumlah_review'];
            
        ?>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Reviews (<?php echo "$jumlah_review" ?>)</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Product Deskripsi</h4>
                        <p><?php echo"$detail[deskripsi]";?></p>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-2">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4"><?php echo "$jumlah_review"?> ulasan untuk produk "<?php echo $detail['nama'] ?>"</h4>
                                <div class="review-list" style="max-height: 400px;  <?= ($jumlah_review > 3) ? 'overflow-y: scroll;' : ''; ?>"> 
                                <?php 
                                    // melakukan fetch_assoc sekali lagi agar pointer di hasil query kembali ke awal
                                        $sql3 = mysqli_query($con, "SELECT rp.*, p.nama_pelanggan FROM review_produk rp INNER JOIN pelanggan p ON rp.id_pengguna = p.id_pelanggan WHERE rp.id_produk='$kd_barang' ORDER BY tanggal DESC");
                                        while($data_review = mysqli_fetch_assoc($sql3)) { 
                                            $tanggalindonesia = tgl_indo($data_review['tanggal']);
                                            ?>
                                    <div class="media mb-4">
                                        <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6><?php echo $data_review['nama_pelanggan'] ?><small> - <i><?php echo $tanggalindonesia ?></i></small></h6>
                                            <div class="text-primary mb-2">
                                                <?php for($i=1; $i<=$data_review['rating']; $i++) { ?>
                                                    <i class="fas fa-star"></i>
                                                <?php } 
                                                for($j=$i; $j<=5; $j++) { ?>
                                                    <i class="far fa-star"></i>
                                                <?php } ?>
                                            </div>
                                            <p><?php echo $data_review['pesan_review'] ?></p>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php 
                                // $sql_join_pembelian = "SELECT p.*, pb.jumlah
                                // FROM pembelian p
                                // INNER JOIN pembelian_barang pb ON p.id_pembelian = pb.id_pembelian
                                // WHERE p.id_pelanggan = $id_pelanggan AND p.status_pembelian = 'Pesanan Selesai'";
                                // $result = mysqli_query($con, $sql_join_pembelian);
                                // $sql = "SELECT pb.*, p.status_pembelian FROM pembelian p INNER JOIN pembelian_barang pb ON p.id_pembelian = pb.id_pembelian LEFT JOIN review_produk r ON pb.kd_barang = r.id_produk AND p.id_pelanggan = r.id_pengguna WHERE p.id_pelanggan = '$id_pelanggan' AND p.status_pembelian = 'Pesanan Selesai' AND r.id_review IS NULL;";
                                
                                // Query untuk mengambil data dari tabel review_produk, pembelian, dan pembelian_barang
                                $sql = "SELECT r.id_review, r.rating, r.pesan_review, r.tanggal, p.status_pembelian, pb.id_pembelian, pb.jumlah, pl.nama_pelanggan FROM review_produk r 
                                JOIN pembelian_barang pb ON r.id_produk = pb.kd_barang
                                JOIN pembelian p ON pb.id_pembelian = p.id_pembelian
                                JOIN pelanggan pl ON r.id_pengguna = pl.id_pelanggan
                                WHERE r.id_pengguna = '$id_pelanggan' AND pb.kd_barang = '$kd_barang' AND p.status_pembelian = 'Pesanan Selesai'";
                                $result = mysqli_query($con, $sql);
                                if(mysqli_num_rows($result) > 0){
                                    $row = mysqli_fetch_assoc($result);
                                    
                                    $tanggalindonesia = isset($row['tanggal']) ? tgl_indo($row['tanggal']) : '';
                                }
                                else{
                                
                                    $tanggalindonesia = '';
                                }
                                if (mysqli_num_rows($result) > 0) {
                                    ?>
                                    <div class="col-md-6">
                                        <h4 class="mb-4">Anda sudah menulis ulasan!</h4>
                                        <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6><?php echo $row['nama_pelanggan'] ?><small> - <i><?php echo $tanggalindonesia ?></i></small></h6>
                                            <div class="text-primary mb-2">
                                                <?php for($i=1; $i<=$row['rating']; $i++) { ?>
                                                    <i class="fas fa-star"></i>
                                                <?php } 
                                                for($j=$i; $j<=5; $j++) { ?>
                                                    <i class="far fa-star"></i>
                                                <?php } ?>
                                            </div>
                                            <p><?php echo $row['pesan_review'] ?></p>
                                        </div>
                                    </div>
                                <?php } else {
                                    // Ambil jumlah pembelian barang
                                    $sql_jumlah_barang = "SELECT id_pembelian, jumlah FROM pembelian_barang WHERE kd_barang = '$kd_barang' AND id_pembelian IN (SELECT id_pembelian FROM pembelian WHERE id_pelanggan = '$id_pelanggan' AND status_pembelian = 'Pesanan Selesai')";
                                    $result_jumlah_barang = mysqli_query($con, $sql_jumlah_barang);
                                    
                                    if(mysqli_num_rows($result_jumlah_barang) > 0){
                                        $row_jumlah_barang = mysqli_fetch_assoc($result_jumlah_barang);
                                        $id_pembelian = $row_jumlah_barang['id_pembelian'];
                                        $jumlah_barang = $row_jumlah_barang['jumlah'];
                                        
                                    }
                                    else{
                                        $id_pembelian = '';
                                        $jumlah_barang = '';  
                                    }
                                    // Jika jumlah pembelian barang lebih dari 1 dan status_pembelian = Pesanan Selesai, buka form review
                                    if ($jumlah_barang > 0) { ?>
                                    <div class="col-md-6">
                                        <h4 class="mb-4">Tinggalkan review anda untuk produk ini!</h4>
                                        <form method="post">
                                            <div class="d-flex my-3">
                                                <p class="mb-0 mr-2">Berikan bintang untuk produk ini! * :</p>
                                                <div class="text-primary">
                                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                                        <input type="radio" id="star<?php echo $i ?>" name="rating" value="<?php echo $i ?>" required>
                                                        <label for="star<?php echo $i ?>"><i class="far fa-star"></i></label>
                                                    <?php endfor; ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="message">Bagaimana tanggapan anda tentang produk ini!</label>
                                                <textarea id="message" cols="30" rows="5" class="form-control" placeholder="Opsional" name="text_review"></textarea>
                                            </div>
                                            <div class="form-group mb-0">
                                                <input type="submit" name="review_submit" value="Leave Your Review" class="btn btn-primary px-3">
                                            </div>
                                        </form>
                                    </div>
                            <?php 
                                    }
                                }
                                
                                if(isset($_POST['review_submit'])) {
                                    $rating = $_POST['rating'];
                                    $pesan = $_POST['text_review'];
                                    $tanggal = date("Y-m-d H:i:s");



                                    $pesan_notifikasi = "Terima Kasih telah memberikan ulasan pada produk #$kd_barang dengan id pesanan #$id_pembelian";
                                    $pesan_admin = "User ID#$id_pelanggan telah memberikan ulasan pada produk #$kd_barang";

                                    $con->query("INSERT INTO review_produk (id_pengguna, id_produk, rating, pesan_review, tanggal) VALUES ('$id_pelanggan','$kd_barang','$rating','$pesan','$tanggal')");
                                    $con->query("INSERT INTO notifikasi_pelanggan (id_pelanggan, id_pesanan, tanggal, pesan) VALUES ('$id_pelanggan','$id_pembelian','$tanggal','$pesan_notifikasi')");
                                    $con->query("INSERT INTO notifikasi_admin (id_pelanggan, id_pembelian, tanggal, pesan) VALUES ('$id_pelanggan','$id_pembelian','$tanggal','$pesan_admin')");
                                    echo"<script>alert('Terima kasih atas ulasan anda!');
                                    window.location.replace('detail.php?kd_barang=$kd_barang')</script>";
                                }
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->

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
</body>
</html>