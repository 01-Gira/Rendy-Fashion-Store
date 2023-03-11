<?php
include 'config/koneksi.php';
include 'login.php';
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
     <!-- <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div>
            </div>
        </div> -->
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">Rendy's</span>Fashion Store</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
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
    </div>
    <!-- Topbar End -->
     <div class="container-fluid mb-6 col-6">
            <div class="col-lg-9 ">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">Rendy's</span>Fashion Store</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <a href="store.php" class="nav-item nav-link active">Store</a>
                            <a href="keranjang.php" class="nav-item nav-link">Keranjang</a>
                            <a href="checkout.php" class="nav-item nav-link">Checkout</a>
                            <a href="riwayat.php" class="nav-item nav-link">RiwayatPembelian</a>
                            <?php
                            if ($_SESSION['status']=="Belum Login"){
                            echo '<button type ="button" class="nav-item" data-toggle="modal" data-target="#loginModal"><i class="bi bi-person-circle"></i>Login</button>
                            ';
                              
                            }
                            else {
                            echo '<a href="logout.php" class="nav-item nav-link">Logout</a>';
                            }
                            ?>
                        </div> 
                
                    </div>
                </nav>
            </div>
        </div>
    <!-- Navbar End -->
    
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