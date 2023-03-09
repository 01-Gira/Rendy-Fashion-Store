<?php 
include "../config/koneksi.php";
 error_reporting(0);

 if (empty($_SESSION['username']) AND empty($_SESSION['password'])) {

   echo"<center>Untuk akses halaman ini Anda harus login dulu ya</center> <br>";
   echo"<center><a href=../../index.php>Silahkan login</center>";
}
?>

<div class="row mt">
<h2 class="text-center"> Detail Pembelian </h2>
          <div class="col-lg-12">
            <div class="content-panel">
            	<?php
				$ambil = $con->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
				$detail = $ambil->fetch_assoc();
                $tanggalindonesia = tgl_indo($detail['tanggal_pembelian']);
				?>
                <?php 
                $idpelanggan_beli = $detail['id_pelanggan'];
                $idpelanggan_login = $_SESSION['pelanggan']['id_pelanggan'];
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
              <section id="unseen">
                <br>
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Produk</th>
                      <th>Harga Produk</th>
                      <th>Jumlah</th>
                      <th>Subtotal</th>
                  </thead>
                  <tbody>
                  	<?php 
                  	$nomor = 1;
                  	$sql=mysqli_query($con,"SELECT * FROM pembelian_barang JOIN barang 
	                    	ON pembelian_barang.kd_barang=barang.kd_barang 
	                    	WHERE pembelian_barang.id_pembelian='$_GET[id]'");
                  	while ($r=mysqli_fetch_array($sql)){
                  	
                  	?>
                  	<tr>
                  		<td><?php echo $nomor; ?></td>
                  		<td><?php echo $r['nama'];?></td>
                  		<td>Rp.<?php echo number_format($r['harga_jual']);?></td>
                  		<td><?php echo $r['jumlah'];?></td>
                  		<td>Rp.<?php echo number_format($r['harga_jual']* $r['jumlah']);?></td>
                  	</tr>
                  	<?php $nomor++?>
                    <?php } ?>
                  </tbody>
                </table>
              </section>
            </div>
            <!-- /content-panel -->
          </div>
          <!-- /col-lg-4 -->
        </div>