<?php 
include '../config/koneksi.php';
 error_reporting(0);

 if (empty($_SESSION['username']) AND empty($_SESSION['password'])) {

   echo"<center>Untuk akses halaman ini Anda harus login dulu ya</center> <br>";
   echo"<center><a href=../../index.php>Silahkan login</center>";
}
?>


<h3><i class="fa fa-angle-right"></i> Pembelian </h3>
        <div class="row mt">
          <div class="col-lg-12">
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Data Pembelian </h4>
              <br> <br>
              
                <br>
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Pelanggan</th>
                      <th>Tanggal Pembelian</th>
                      <th>Status Pembelian</th>
                      <th>Total</th>
                      <th>Aksi</th>
                  </thead>
                  <tbody>
                  	<?php 
                  	$nomor = 1;
                  	$sql=mysqli_query($con, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan");
                  	while ($r=mysqli_fetch_array($sql)){
                      $tanggalindonesia = tgl_indo($r['tanggal_pembelian']);
                  	
                  	?>
                  	<tr>
                  		<td><?php echo $nomor;?></td>
                  		<td><?php echo $r['nama_pelanggan'];?></td>
                  		<td><?php echo $tanggalindonesia;?></td>
                      <td><?php echo $r['status_pembelian']?></td>
                  		<td>Rp.<?php echo number_format($r['total_pembelian']);?></td>
                  		<td>
                      <a href="?p=detail_pembelian&id=<?php echo $r['id_pembelian'];?>" class="btn btn-primary"> Detail </a> 
                      <?php if($r['status_pembelian']!=="pending"): ?>
                      <a href="?p=pembayaran&id=<?php echo $r['id_pembelian'];?>" class="btn btn-success"> Lihat Pembayaran </a>
                      <?php endif ?>   
                      </td>
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