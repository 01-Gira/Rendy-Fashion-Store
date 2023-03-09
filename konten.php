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
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Produk Populer</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
                        <?php
                        $terlaris=mysqli_query($con, "SELECT * FROM barang order by terjual desc LIMIT 4");
                        while ($data=mysqli_fetch_array($terlaris)){
                        
                        ?>
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src=<?php echo "foto_produk/medium_$data[foto]";?> alt="" /></a>
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
                        <?php
                        }   
                        ?>
        </div>
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Produk Terbaru</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
                        <?php
                        $produk=mysqli_query($con, "SELECT * FROM barang order by kd_barang desc LIMIT 4");
                        while ($data=mysqli_fetch_array($produk)){
                         
                        ?>
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
                        <?php
                        }   
                        ?>
        </div>
    </div>
</body>
</html>