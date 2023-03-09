<?php 
include '../config/koneksi.php';
 error_reporting(0);

 if (empty($_SESSION['username']) AND empty($_SESSION['password'])) {

   echo"<center>Untuk akses halaman ini Anda harus login dulu ya</center> <br>";
   echo"<center><a href=../../index.php>Silahkan login</center>";
}
?>

<h3>Data Pembayaran </h3>

        <div class="row mt">
          <div class="col-lg-12">
            <div class="content-panel">
            	<?php 
            	$id_pembelian = $_GET['id'];

            	$sql=mysqli_query($con, "SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
            	$r=mysqli_fetch_array($sql);
            	$tanggalindonesia = tgl_indo($r['tanggal']);
            	?>
            		<table class="table">
            			<tr>
            				<th>Nama</th>
            				<td><?php echo $r['nama'];?></td>
            			</tr>
            			<tr>
            				<th>Bank</th>
            				<td><?php echo $r['bank'];?></td>
            			</tr>
            			<tr>
            				<th>Jumlah</th>
            				<td>Rp.<?php echo number_format($r['jumlah']);?></td>
            			</tr>
            			<tr>
            				<th>Tanggal</th>
            				<td><?php echo $tanggalindonesia;?></td>
            			</tr>
            		</table>
            	<div class="col-md-6">
            		<img src="../foto_bukti/<?php echo $r['bukti'];?>" alt="" class="img-responsive">
            	</div>
            </div>
          </div>
        </div>

        <div class="row mt">
        <div class="col-lg-12">
        <div class="content-panel">
        <form method="POST">
        	<div class="form-group">
        		<label>No Resi Pengiriman</label>
        		<input type="text" name="resi" class="form-control">
        	</div>
        	<div class="form-group">
        		<label>Status</label>
        		<select name="status" class="form-control">
        			<option value="">Pilih Status</option>
        			<option value="Lunas">Lunas</option>
        			<option value="Barang dikirim">Barang Dikirim</option>
        			<option value="Batal">Batal</option>
        		</select>
        	</div>
        	<button class="btn btn-primary" name="proses">Proses</button>
        </form>
        <?php
        if (isset($_POST['proses'])) {
        	$resi=$_POST['resi'];
        	$status=$_POST['status'];

        	$sql=mysqli_query($con,"UPDATE pembelian SET resi_pembelian ='$resi', status_pembelian='$status' WHERE id_pembelian='$id_pembelian'");       

        	echo "<script>alert('Data pembelian terupdate'); 
        	window.location.replace('?p=pembelian')</script>";
        }
        ?>
    </div>
</div>
</div>
