<?php
require 'config/koneksi.php';
require 'config/session.php';
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
    include 'config/kompres.php';
    ?>
     <?php include 'menu.php'; ?>
    <!-- Navbar End -->
    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            
            <div class="col-lg-3 col-md-12">
            <h2 class="text-uppercase mb-3">Filter</h2>
            <form method="GET">
                <!-- Price Range Start -->
                <div class="form-group">
                <label for="price_range">Range Harga:</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Harga Min" name="min_price">
                    <span class="input-group-text">-</span>
                    <input type="text" class="form-control" placeholder="Harga Max" name="max_price">
                </div>
                </div>
                <!-- Price Range End -->

                <!-- Sortir Start -->
                <div class="form-group">
                <label for="sort">Sortir:</label>
                <select class="form-control" id="sort" name="sort">
                    <option value="">Tidak Ada</option>
                    <option value="terpopuler">Terpopuler</option>
                    <option value="terbaru">Terbaru</option>
                    <option value="termurah">Termurah</option>
                    <option value="termahal">Termahal</option>
                </select>
                </div>
                <!-- Sortir End -->

                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
          
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="pencarian.php" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari Produk" name="keyword">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                        
                        // ambil value dari sort yang dipilih
                        $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
                    
                        // ambil value dari range harga
                        $min_price = isset($_GET['min_price']) ? $_GET['min_price'] : '';
                        $max_price = isset($_GET['max_price']) ? $_GET['max_price'] : '';
                    
                        // set nilai default untuk sorting
                        $order_by = "kd_barang DESC";
                    
                        switch ($sort) {
                        case "terpopuler":
                            $order_by = "terjual DESC";
                            break;
                        case "terbaru":
                            $order_by = "kd_barang DESC";
                            break;
                        case "termurah":
                            $order_by = "harga_jual ASC";
                            break;
                        case "termahal":
                            $order_by = "harga_jual DESC";
                            break;
                        default:
                            // set nilai default jika sort tidak didefinisikan
                            $sort = '';
                            break;
                        }
                    
                        // filter berdasarkan range harga
                        $price_filter = "";
                        if (!empty($min_price) && !empty($max_price)) {
                        $price_filter = "harga_jual BETWEEN $min_price AND $max_price AND";
                        } elseif (!empty($min_price)) {
                        $price_filter = "harga_jual >= $min_price AND";
                        } elseif (!empty($max_price)) {
                        $price_filter = "harga_jual <= $max_price AND";
                        }
                    


                        // query untuk menampilkan daftar produk
                        $query = "SELECT * FROM barang WHERE $price_filter jumlah_barang > 0 ORDER BY $order_by";
                        $result = mysqli_query($con, $query);
                        while ($data = mysqli_fetch_array($result)) {
                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100" src=<?php echo "foto_produk/medium_$data[foto]";?> alt=" " /></a>
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3"><?php echo"$data[nama]";?></h6>
                                    <div class="d-flex justify-content-center">
                                        <h6>Rp.<?php echo number_format ($data['harga_jual']);?></h6>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="detail.php?kd_barang=<?php echo $data['kd_barang']?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Lihat Detail</a>
                                    <a href="beli.php?kd_barang=<?php echo $data['kd_barang']?>" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Masukan Keranjang</a>
                                </div>
                            </div>
                            
                        </div>
                    <?php
                      }   
                     ?>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
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
