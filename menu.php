<?php
include 'config/koneksi.php';
include 'login.php';
include 'session.php';

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$page = basename($_SERVER['PHP_SELF']); // mendapatkan nama halaman saat ini

// menetapkan kelas "active" pada menu terpilih
function is_active($page_name) {
  global $page;
  if ($page == $page_name) {
    echo 'active';
  }
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
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">Rendy's</span>Fashion Store</h1>
            </a>
        </div>
        <div class="col-sm-3 m-auto ">
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
        <div class="col-l-3 m-auto ">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">Rendy's</span>Fashion Store</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link  <?php is_active('media.php'); ?>">Home</a>
                            <a href="store.php"  class="nav-item nav-link  <?php is_active('store.php'); ?>" >Store</a>
                            <a href="keranjang.php" class="nav-item nav-link  <?php is_active('keranjang.php'); ?>">Keranjang</a>
                            <a href="checkout.php" class="nav-item nav-link"  <?php is_active('checkout.php'); ?>>Checkout</a>
                            <a href="riwayat.php" class="nav-item nav-link"  <?php is_active('riwayat.php'); ?>>Riwayat Pembelian</a>
                            <?php
                            if ($_SESSION['status']=="Belum Login"){
                            echo '<a class="nav-item nav-link" href="#" data-toggle="modal" data-target="#loginModal"><i class="bi bi-person-circle"></i> Login</a>';
                              
                            }
                            else {
                                ?>
                            <li id="header_notification_bar" class="dropdown" style="margin-top:20px;">
                                <?php
                                $total_unread = mysqli_query($con,"SELECT COUNT(*) AS total_unread FROM notifikasi_pelanggan WHERE status_baca = 0 AND id_pelanggan = '$id_pelanggan'"); 
                                $data_unread = mysqli_fetch_assoc($total_unread);
                                $total_unread_data = $data_unread['total_unread'];
                                
                                ?>
                                <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#" >
                                <?php if(empty($total_unread_data)) {echo "<i class='bi bi-bell'></i>";} else {echo "<i class='bi bi-bell-fill'></i>";} ?>
                                <span class="badge"><?php echo"$total_unread_data" ?></span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <li>
                                        <p style="margin-left:15px; color: #c17a74;" >You have <?php echo"$total_unread_data" ?> new notifications 
                                    </p>
                                        <hr>
                                    </li>
                                    <?php
                                    $query = mysqli_query($con, "SELECT * FROM notifikasi_pelanggan ORDER BY tanggal WHERE id_pelanggan = '$id_pelanggan' DESC LIMIT 5 ");
                                    while($data=mysqli_fetch_array($query)){
                                
                                    ?>
                                    <li class="notification-item" style="<?php if($data['status_baca'] == '0') {echo 'color:gray;';} ?>">
                                        <a href="#">
                                            <span class="label" style="margin-left:15px;"><i class="fa fa-bolt"></i></span>
                                            <span class="message" style="margin-left:5px; <?php if($data['status_baca'] == '1') {echo 'color:gray;';} ?>"><?php echo"$data[pesan]";?></span>
                                        </a>
                                        <hr>
                                    </li>
                                    <?php }
                                    
                                    ?>
                                    <li>
                                        <a href="config/read_all_pelanggan.php">
                                            <p style="margin-left:15px; margin-top:10px;">Read All</p>
                                        </a>
                                    </li>
                                    <style>
                                        .dropdown-menu.notification {
                                            padding: 20px;
                                            width: 200px; /* atur lebar yang diinginkan */
                                            max-height: 500px; /* atur tinggi maksimal jika konten notifikasi terlalu banyak */
                                            overflow-x: auto;
                                            /* overflow-y: auto; atur overflow menjadi auto agar ada scrollbar jika konten terlalu banyak */
                                        }
                                    </style>

                                
                                </ul>
                            </li>
                            <a href="logout.php" class="nav-item nav-link">Logout</a>
                            <?php } ?>
                            
                        </div> 
                    </div>
                </nav>
            </div>
    </div>

    
    <div class="modal fade" id="loginModal" role="dialog" ariallabelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-panel panel login-panel">
    <div class="modal-header">
        <div class="container-fluid" style="margin-top: -70px;">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase"><span class="text-primary font-weight-bold border">Rendy's</span> Fashion Store</h1>
        </div>
    </div>
    </div>
<!-- Sign In -->
    <div class="modal-body">
    <div class="container" style="margin-top: -100px;">
        <div class="row content">
            <div class="col-md m-auto">
                <div class="text-center">
                </div>  
                <form method="POST">
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="form-group mt-3">
                     
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="form-group form-check mt-3">
                        <input type="checkbox" class="form-check-input">
                        <label class="form-check-label" for="checkbox">Remember Me</label>
                    </div>
                    <div class="help-block text-center" style="font-size: .78em; line-height: 1.45em; color: inherit; text-align: center;">Dengan masuk ke website ini, berarti anda telah menyetujui <a href="#!">Privacy Policy</a> dan <a href="#!">Term of Use</a> dari Rendy's Fashion Store</div>

                    <button class="btn btn-block btn-primary" name="login">Login</button>
                    <div class="help-block text-center" style="font-size: .90em; line-height: 1.45em; color: inherit; text-align: center;">Belum mempunyai akun? ayo <a href="register.php">register</a><br> sekarang juga!</div>
                </form>
            </div>
        </div>
    </div>
    </div> 
    </div>
</div>
</div>
</div>

</body>
</html>