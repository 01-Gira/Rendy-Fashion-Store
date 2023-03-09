<?php 
include "../../../config/koneksi.php";
 error_reporting(0);

 if (empty($_SESSION['username']) AND empty($_SESSION['password'])) {

   echo"<center>Untuk akses halaman ini Anda harus login dulu ya</center> <br>";
   echo"<center><a href=../../index.php>Silahkan login</center>";

?>


<h3><i class="fa fa-angle-right"></i> Master Produk</h3>
        <div class="row mt">
          <div class="col-lg-12">
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Data Produk</h4>
              <div class="col-sm-12" align="right">
              <a href=<?php echo"?p=produk&aksi=tambah";?> ><button type="button" class="btn btn-info">Tambah Data Produk</button></a>
              </div>
              <br> <br>
              <section id="unseen">
                <br>
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Produk</th>
                      <th>Kategori</th>
                      <th>Harga Jual</th>
                      <th>Tanggal Masuk</th>
                      <th>Jumlah</th>
                      <th>Aksi</th>


                  </thead>
                  <tbody>
                    <?php
                    $sql=mysqli_query($con,"SELECT * FROM barang order by nama asc ");
                    $no=1;
                    while ($r=mysqli_fetch_array($sql)) {
                      $tanggalindonesia = tgl_indo($r[tanggal_masuk]);
                      echo "<tr><td>$no</td>
                                <td>$r[nama]</td>";

                                $sql2=mysqli_query($con, "SELECT * FROM kategori where id_kategori = $r[id_kategori]");
                                $r2=mysqli_fetch_array($sql2);

                      echo      "<td>$r2[nama_kategori]</td>
                                <td>$r[harga_jual]</td>
                                <td>$tanggalindonesia</td>
                                <td>$r[jumlah_barang]</td>
                                <td>
                                <a href=?p=produk&aksi=edit&id=$r[kd_barang]><button type='button' class='btn btn-info'>Edit</button></a>
                                <a href='$aksi?act=hapus&id=$r[kd_barang]'<button type='button' class='btn btn-danger'>Hapus</button></a>
                                ";
                      $no++;          
                    }
                    ?>
                   
                  </tbody>
                </table>
              </section>
            </div>
            <!-- /content-panel -->
          </div>
          <!-- /col-lg-4 -->
        </div>