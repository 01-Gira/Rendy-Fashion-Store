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
                  <form method="post">
        
                    <div class="row mb-3 ms-1">
                      <div class="col">
                        <select class="form-select" name="tahun">
                          <option selected>Pilih Tahun</option>
                          <?php
                          for($i = 2021; $i <= date('Y'); $i++){
                            echo "<option value='$i'>$i</option>";
                          }
                          ?>
                        </select>
                      </div>
                      <div class="col">
                        <select class="form-select" name="bulan">
                          <option selected>Pilih Bulan</option>
                          <?php
                          for($i = 1; $i <= 12; $i++){
                            $month = date("F", mktime(0, 0, 0, $i, 1));
                            echo "<option value='$i'>$month</option>";
                          }
                          ?>
                        </select>
                      </div>
                      <div class="col">
                        <select class="form-select" name="hari">
                          <option selected>Pilih Hari</option>
                          <?php
                          for($i = 1; $i <= 31; $i++){
                            echo "<option value='$i'>$i</option>";
                          }
                          ?>
                        </select>
                      </div>
                      <div class="col">
                        <button type="submit" class="btn btn-primary">Filter</button>
                      </div>
                    </div>
                  </form>
                <br>
                <table class="table table-bordered table-striped table-condensed mx-3">
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
                      $sql=mysqli_query($con, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan");
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