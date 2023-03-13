<?php 
include '../config/koneksi.php';


error_reporting(0);

if (empty($_SESSION['username']) AND empty($_SESSION['password'])) {

echo"<center>Untuk akses halaman ini Anda harus login dulu ya</center> <br>";
echo"<center><a href=../../index.php>Silahkan login</center>";
}


$id_pembelian = $_GET['id'];

$sql=mysqli_query($con, "SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
$r=mysqli_fetch_assoc($sql);

$sql=mysqli_query($con, "SELECT * FROM pembelian WHERE id_pembelian='$id_pembelian'");
$r2=mysqli_fetch_assoc($sql);

$id_pelanggan = $r['id_pelanggan'];
$tanggalindonesia = tgl_indo($r['tanggal']);
            
?>

<h3>Data Pembayaran </h3>
        <div class="row mt">
          <div class="col-lg-12">
				<div class="content-panel p-3">
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
				<div class="col-md-6 mt-5">
					<p>Bukti Pembayaran</p>
					<img src="../foto_bukti/<?php echo $r['bukti'];?>" alt="" class="img-responsive">
				</div>
            </div>
		  </div>
        </div>

        <div class="row mt">
        <div class="col-lg-12">
        <div class="content-panel p-3">
        <form method="POST">
        	<div class="form-group">
        		<label>No Resi Pengiriman</label>
        		<input type="text" name="resi" class="form-control" value="<?php echo $r2['resi_pembelian']; ?>" <?php if(!empty($r2['resi_pembelian'])) { echo "disabled";} ?> >
        	</div>
        	<div class="form-group">
        		<label>Status</label>
        		<select name="status" class="form-control">
        			<option value="">Pilih Status</option>
        			<option value="Lunas">Lunas</option>
        			<?php if($r2['status_pembelian'] != 'Barang Dikirim') { echo "<option value='Barang Dikirim'>Barang Dikirim</option>"; } ?>
					<option value="Pembelian Ditolak">Pembelian Ditolak</option>
        			<option value="Batal">Pembelian Dibatalkan</option>
        		</select>
        	</div>
			<div class="form-group">
        		<label>Pesan</label>
        		<input type="text" name="pesan" class="form-control" >
        	</div>
			<a href='?p=pembelian' style='color: white; text-decoration: none; font-weight: bold;' class="btn btn-danger">Kembali</a>
        	<button class="btn btn-primary" name="proses">Proses</button>
        </form>
        <?php
        if (isset($_POST['proses'])) {
        	$resi=$_POST['resi'];
        	$status=$_POST['status'];

			// mendapatkan data pembelian
			$ambil = $con->query("SELECT * FROM pembelian WHERE id_pembelian='$id_pembelian'");
			$data = $ambil->fetch_assoc();


			// mendapatkan id_pelanggan dari pembelian
			$id_pelanggan = $data['id_pelanggan'];


			// notifikasi pemesanan
			$tanggal = date("Y-m-d H:i:s");
			
			if(empty($_POST['pesan'])) {
				$pesan = "Pesanan dengan ID #$id_pembelian $status";
			} else {
				$pesan = $_POST['pesan'];
			}

        	// update status pembelian dan nomor resi
			$con->query("UPDATE pembelian SET resi_pembelian='$resi', status_pembelian='$status' WHERE id_pembelian='$id_pembelian'");

			// tambahkan notifikasi ke tabel notifikasi_pelanggan
			$tanggal = date("Y-m-d H:i:s");
			$con->query("INSERT INTO notifikasi_pelanggan (id_pelanggan, id_pesanan, tanggal, pesan) VALUES ('$id_pelanggan','$id_pembelian','$tanggal','$pesan')");

			// tampilkan pesan sukses dan berikan tombol kembali ke halaman pembelian
			echo "<script>alert('Data berhasil diubah')
                            window.location.replace('media.php?p=pembelian');</script>";
        }
        ?>
    </div>
</div>
</div>
