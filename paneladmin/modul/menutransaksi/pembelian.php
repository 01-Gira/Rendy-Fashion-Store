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
            <div class="content-panel p-4">
              <h4><i class="fa fa-angle-right"></i> Data Pembelian </h4>
              <div class="col-sm-12" align="right">
                <input type="text" class="form-control xm-2 mb-3 mt-5" style="width: 20%;"  id="search-bar-pembelian" placeholder="Cari kategori...">
                <script>
                  document.getElementById("search-bar-pembelian").addEventListener("input", function() {
                    // Ambil nilai input dan ubah menjadi lowercase
                    var input = this.value.toLowerCase();

                    // Ambil semua baris pada tabel
                    var rows = document.getElementsByTagName("tr");

                    // Loop melalui semua baris, mulai dari baris kedua
                    for (var i = 1; i < rows.length; i++) {
                        // Ambil value pada kolom 
                        var namaPelanggan = rows[i].getElementsByTagName("td")[1].textContent.toLowerCase();
                        var tanggalPembelian = rows[i].getElementsByTagName("td")[2].textContent.toLowerCase();
                        var statusPembelian = rows[i].getElementsByTagName("td")[3].textContent.toLowerCase();
                        var totalPembelian = rows[i].getElementsByTagName("td")[4].textContent.toLowerCase();

                        // Cek apakah kategori mengandung nilai input
                        if (namaPelanggan.indexOf(input) > -1 || tanggalPembelian.indexOf(input) > -1 || statusPembelian.indexOf(input) > -1 || totalPembelian.indexOf(input) > -1) {
                            rows[i].style.display = "";
                        } else {
                            rows[i].style.display = "none";
                        }
                    }
                });
                </script>
              </div>
              <br> <br>
                  
                <br>
                <table class="table table-bordered table-striped table-condensed" style="height: fit-content;">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Pelanggan <a href="?p=pembelian&sort=nama_pelanggan_asc"><i class="fa fa-arrow-up"></i></a><a href="?p=pembelian&sort=nama_pelanggan_desc"><i class="fa fa-arrow-down"></i></a></th>
                      <th>Tanggal Pembelian <a href="?p=pembelian&sort=tanggal_pembelian_asc"><i class="fa fa-arrow-up"></i></a><a href="?p=pembelian&sort=tanggal_pembelian_desc"><i class="fa fa-arrow-down"></i></a></th>
                      <th>Status Pembelian <a href="?p=pembelian&sort=status_pembelian_asc"><i class="fa fa-arrow-up"></i></a><a href="?p=pembelian&sort=status_pembelian_desc"><i class="fa fa-arrow-down"></i></a></th>
                      <th>Total <a href="?p=pembelian&sort=total_pembelian_asc"><i class="fa fa-arrow-up"></i></a><a href="?p=pembelian&sort=total_pembelian_desc"><i class="fa fa-arrow-down"></i></a></th>
                      <th>Aksi</th>
                  </thead>
                  <tbody>
                  	<?php 
                    if (isset($_GET['sort'])) {
                      $sort = $_GET['sort'];
                      switch($sort) {
                        case 'nama_pelanggan_asc':
                          $sql = mysqli_query($con, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan order by pelanggan.nama_pelanggan ASC");
                          break;
                        case 'nama_pelanggan_desc':
                          $sql = mysqli_query($con, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan order by pelanggan.nama_pelanggan DESC");
                          break;
                        case 'tanggal_pembelian_asc':
                          $sql = mysqli_query($con, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan order by tanggal_pembelian ASC");
                          break;
                        case 'tanggal_pembelian_desc':
                          $sql = mysqli_query($con, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan order by tanggal_pembelian DESC");
                          break;
                        case 'status_pembelian_asc':
                          $sql = mysqli_query($con, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan order by status_pembelian ASC");
                          break;
                        case 'status_pembelian_desc':
                          $sql = mysqli_query($con, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan order by status_pembelian DESC");
                          break;
                        case 'total_pembelian_asc':
                          $sql = mysqli_query($con, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan order by total_pembelian ASC");
                          break;
                        case 'total_pembelian_desc':
                          $sql = mysqli_query($con, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan order by total_pembelian DESC");
                          break;
                        default:
                          $sql=mysqli_query($con, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan");
                          break;
                      }
                    }else {
                      $sql=mysqli_query($con, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan order by tanggal_pembelian DESC");
                    }
                  	$nomor = 1;
                  	
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
                      <div style="display: flex;">
                      <a href="?p=detail_pembelian&id=<?php echo $r['id_pembelian'];?>" class="btn btn-primary" style="margin-right: 5px;"> Detail </a> 
                      <?php if($r['status_pembelian']=="!pending"): ?>
                      <a href="?p=pembayaran&id=<?php echo $r['id_pembelian'];?>" class="btn btn-success" style="margin-right: 5px;"> Lihat Pembayaran </a>
                      <?php elseif($r['status_pembelian']=="Barang Diterima"): ?>
                        <form method="post">
                            <input type="hidden" name="id_pembelian" value="<?php echo $r['id_pembelian']; ?>">
                            <button type="submit" name="pesanan_selesai" class="btn btn-warning" style="margin-right: 5px;" onclick="return confirm('Anda yakin pesanan sudah selesai?')"> Selesai</button>
                        </form>
                        <?php 
                        // jika tombol "Barang telah diterima" ditekan
                        if(isset($_POST['pesanan_selesai'])) {
                            $id_pembelian = $_POST['id_pembelian'];
                            $id_pelanggan = $r['id_pelanggan'];
                           
                            // update status pembelian menjadi "selesai"
                            $con->query("UPDATE pembelian SET status_pembelian='Pesanan Selesai' WHERE id_pembelian='$id_pembelian'");
                            // notifikasi pemesanan
                            $tanggal = date("Y-m-d H:i:s");
                            $pesan = "Pesanan dengan ID #$id_pembelian telah selesai";
                            $con->query("INSERT INTO notifikasi_pelanggan (id_pelanggan, id_pesanan, tanggal, pesan) VALUES ('$id_pelanggan','$id_pembelian','$tanggal','$pesan')");

                            echo"<script>alert('Pesanan telah selesai');
                            window.location.replace('media.php?p=pembelian')</script>";
                        }
                        ?>
                      <?php endif ?>   
                      </div>
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