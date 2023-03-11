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
  <link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <script src="lib/chart-master/Chart.js"></script>

  
</head>
<body>
  <li class="mt">
    <a <?php if ($_GET['p'] == 'home') { echo 'class="active"'; } ?> href="?p=home">
      <i class="fa fa-dashboard"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <li class="sub-menu <?php if ($_GET['p'] == 'produk' || $_GET['p'] == 'kategori') { echo 'active'; } ?>">
    <a href="javascript:;">
      <i class="fa fa-th"></i>
      <span> Master Produk</span>
    </a>
    <ul class="sub" <?php if ($_GET['p'] == 'produk' || $_GET['p'] == 'kategori') { echo 'style="display: block;"'; } ?>>
      <li <?php if ($_GET['p'] == 'produk') { echo 'class="active"'; } ?>><a href="?p=produk">Produk</a></li>
      <li <?php if ($_GET['p'] == 'kategori') { echo 'class="active"'; } ?>><a href="?p=kategori">Kategori Produk</a></li>
    </ul>
  </li>
  <li class="sub-menu <?php if ($_GET['p'] == 'pembelian') { echo 'active'; } ?>">
    <a href="javascript:;">
      <i class="fa fa-book"></i>
      <span> Menu Transaksi</span>
    </a>
    <ul class="sub" <?php if ($_GET['p'] == 'pembelian') { echo 'style="display: block;"'; } ?>>
      <li <?php if ($_GET['p'] == 'pembelian') { echo 'class="active"'; } ?>><a href="?p=pembelian">Pembelian </a></li>
    </ul>
  </li>
  <li class="menu">
    <a href="logout.php">
      <i class="fa fa-sign-out"></i>
      <span> Logout</span>
    </a>
  </li>
</body>



</html>     