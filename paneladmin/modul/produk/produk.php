 <?php
  include "../config/koneksi.php";
 error_reporting(0);

 if (empty($_SESSION['username']) AND empty($_SESSION['password'])) {

   echo"<center>Untuk akses halaman ini Anda harus login dulu ya</center> <br>";
   echo"<center><a href=../../index.php>Silahkan login</center>";

 }else{
  $aksi="modul/produk/aksi_produk.php";
  switch ($_GET['aksi']) {
    default:
 ?> 

 <h3><i class="fa fa-angle-right"></i> Master Produk</h3>
        <div class="row mt">
          <div class="col-lg-12">
            <div class="content-panel p-4">
              <h4><i class="fa fa-angle-right"></i> Data Produk</h4>
              <div class="col-sm-12" align="right">
                <a href=<?php echo"?p=produk&aksi=tambah";?> ><button type="button" class="btn btn-info">Tambah Data Produk</button></a>
                <input type="text" class="form-control xm-2 mb-3 mt-5" style="width: 20%;"  id="search-bar-produk" placeholder="Cari produk...">        
                <script>
                    // produk
                    document.getElementById("search-bar-produk").addEventListener("input", function() {
                        // Ambil nilai input dan ubah menjadi lowercase
                        var input = this.value.toLowerCase();

                        // Ambil semua baris pada tabel
                        var rows = document.getElementsByTagName("tr");

                        // Loop melalui semua baris, mulai dari baris kedua
                        for (var i = 1; i < rows.length; i++) {
                            // Ambil nama produk pada kolom kedua
                            var namaProduk = rows[i].getElementsByTagName("td")[1].textContent.toLowerCase();
                            var kategoriProduk = rows[i].getElementsByTagName("td")[2].textContent.toLowerCase();
                            var hargaProduk = rows[i].getElementsByTagName("td")[3].textContent.toLowerCase();
                            var tanggalMasuk = rows[i].getElementsByTagName("td")[4].textContent.toLowerCase();
                            var jumlahProduk = rows[i].getElementsByTagName("td")[5].textContent.toLowerCase();

                            // Cek apakah nama produk, kategori, harga, tanggal masuk, atau jumlah mengandung nilai input
                            if (namaProduk.indexOf(input) > -1 || kategoriProduk.indexOf(input) > -1 || hargaProduk.indexOf(input) > -1 || tanggalMasuk.indexOf(input) > -1 || jumlahProduk.indexOf(input) > -1) {
                                rows[i].style.display = "";
                            } else {
                                rows[i].style.display = "none";
                            }
                        }
                    });
                </script>
              </div>
              <div class="col-sm-2 mb-2 d-flex justify-content-end">
                
              </div>
              <br> <br>
              <section id="unseen">
                <br>
                
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama <a href="?p=produk&sort=nama_asc"><i class="fa fa-arrow-up"></i></a><a href="?p=produk&sort=nama_desc"><i class="fa fa-arrow-down"></i></a></th>
                    <th>Kategori <a href="?p=produk&sort=kategori_asc"><i class="fa fa-arrow-up"></i></a><a href="?p=produk&sort=kategori_desc"><i class="fa fa-arrow-down"></i></a></th>
                    <th>Harga Jual <a href="?p=produk&sort=harga_jual_asc"><i class="fa fa-arrow-up"></i></a><a href="?p=produk&sort=harga_jual_desc"><i class="fa fa-arrow-down"></i></a></th>
                    <th>Tanggal Masuk <a href="?p=produk&sort=tanggal_masuk_asc"><i class="fa fa-arrow-up"></i></a><a href="?p=produk&sort=tanggal_masuk_desc"><i class="fa fa-arrow-down"></i></a></th>
                    <th>Jumlah <a href="?p=produk&sort=jumlah_barang_asc"><i class="fa fa-arrow-up"></i></a><a href="?p=produk&sort=jumlah_barang_desc"><i class="fa fa-arrow-down"></i></th>
                    <th>Aksi</th>
                  </thead>
                  <tbody>
                    <?php
                
                    // Set kondisi sorting berdasarkan parameter yang dikirimkan
                    if (isset($_GET['sort'])) {
                      $sort = $_GET['sort'];
                      switch ($sort) {
                        case 'nama_asc':
                          $query = mysqli_query($con, "SELECT * FROM barang ORDER BY nama ASC");
                          break;
                        case 'nama_desc':
                          $query = mysqli_query($con, "SELECT * FROM barang ORDER BY nama DESC");
                          break;
                        case 'kategori_asc':
                          $query = mysqli_query($con, "SELECT * FROM barang ORDER BY id_kategori ASC");
                          break;
                        case 'kategori_desc':
                          $query = mysqli_query($con, "SELECT * FROM barang ORDER BY id_kategori DESC");
                          break;
                        case 'harga_jual_asc':
                          $query = mysqli_query($con, "SELECT * FROM barang ORDER BY harga_jual ASC");
                          break;
                        case 'harga_jual_desc':
                          $query = mysqli_query($con, "SELECT * FROM barang ORDER BY harga_jual DESC");
                          break;
                        case 'tanggal_masuk_asc':
                          $query = mysqli_query($con, "SELECT * FROM barang ORDER BY tanggal_masuk ASC");
                          break;
                        case 'tanggal_masuk_desc':
                          $query = mysqli_query($con, "SELECT * FROM barang ORDER BY tanggal_masuk DESC");
                          break;
                        case 'jumlah_barang_asc':
                          $query = mysqli_query($con, "SELECT * FROM barang ORDER BY jumlah_barang ASC");
                          break;
                        case 'jumlah_barang_desc':
                          $query = mysqli_query($con, "SELECT * FROM barang ORDER BY jumlah_barang DESC");
                          break;
                        default:
                          $query = mysqli_query($con, "SELECT * FROM barang ORDER BY nama ASC");
                          break;
                        }
                    } else {
                        $query = mysqli_query($con, "SELECT * FROM barang ORDER BY nama ASC");
                    }


                    $no=1;
                    while ($r=mysqli_fetch_array($query)) {
                      $tanggalindonesia = tgl_indo($r['tanggal_masuk']);
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
                                <a href='$aksi?aksi=hapus&id=$r[kd_barang]><button type='button' class='btn btn-danger' onclick='return confirm('Anda yakin ingin')'>Hapus</button></a>
                                ";
                      $no++;          
                    }

                    if(mysqli_num_rows($query) == 0){
                      echo "<tr><td colspan='7'>Tidak ada data yang ditemukan</td></tr>";
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


 <?php
  break;
  case 'tambah':

 ?>

 <h3><i class="fa fa-angle-right"></i>Master Produk</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Form Produk</h4>
              <form class="form-horizontal style-form" method="POST" action=<?php echo"modul/produk/aksi_produk.php?aksi=tambah";?> enctype="multipart/form-data">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nama Produk</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Kategori</label>
                  <div class="col-sm-10">
                  <select name="kategori" class="form-control">
                    <?php 
                    $sql=mysqli_query($con,"SELECT * FROM kategori order by nama_kategori ");
                    while($r=mysqli_fetch_array($sql)){
                      echo"<option value=$r[id_kategori]>$r[nama_kategori]</option>";
                    }
                    ?>
                  </select>
                </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Deskripsi</label>
                  <div class="col-sm-10">
                    <textarea class ="form-control" name="deskripsi" required> 
                    </textarea> 
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Jumlah</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="jumlah" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Tanggal masuk</label>
                   <div class="col-md-3 col-xs-11">
                    <div data-date-viewmode="date" data-date-format="yyyy-mm-dd" data-date="now" class="input-append date dpYears">
                      <input type="text" name="tanggal_masuk" value="2023-01-01" size="16" class="form-control">
                      <span class="input-group-btn add-on">
                        <button class="btn btn-theme" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                    <span class="help-block">Select date</span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Harga Jual</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="harga_jual" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">Foto Produk</label>
                  <div class="controls col-md-9">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <span class="btn btn-theme02 btn-file">
                        <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select file</span>
                      <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                      <input type="file" name="file" class="default" />
                      </span>
                      <span class="fileupload-preview" style="margin-left:5px;"></span>
                      <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-10"></div>
                  <input type="submit" class="btn btn-primary" value="tambah">
                  </div>
                </div>
              </form>
            </div>
          </div>

        <?php
        break;
        case 'edit':
        $sql=mysqli_query($con, "SELECT * FROM barang WHERE kd_barang='$_GET[id]'");
        $r=mysqli_fetch_array($sql);
        ?>  

          <h3><i class="fa fa-angle-right"></i>Edit Produk</h3>
          <!-- BASIC FORM ELELEMNTS -->
          <div class="row mt">
            <div class="col-lg-12">
              <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i>Edit Produk</h4>
                <form class="form-horizontal style-form" method="POST" action=<?php echo"modul/produk/aksi_produk.php?aksi=update";?> enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="kode" value=<?php echo "$r[kd_barang]";?>>
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nama Produk</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" value="<?php echo $r['nama']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Kategori</label>
                    <div class="col-sm-10">
                    <select name="kategori" class="form-control">
                      <?php
                      $tampil=mysqli_query($con," select * from kategori order by nama_kategori");
                      if ($r['id_kategori']==0) {
                        echo "<option value=0 selected>- Pilih kategori -</option>";
                      }
                      while ($w=mysqli_fetch_array($tampil)) {
                        if ($r['id_kategori']==$w['id_kategori']){
                          echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>" ;
                        }
                        else {
                          echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";

                        }

                      
                      }
                      
                      ?>
                    </select>
                  </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Deskripsi</label>
                    <div class="col-sm-10">
                      <textarea class ="form-control" name="deskripsi" required><?php echo "$r[deskripsi]";?></textarea> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Jumlah</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" name="jumlah" required value=<?php echo "$r[jumlah_barang]";?>>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tanggal masuk</label>
                     <div class="col-md-3 col-xs-11">
                      <div data-date-viewmode="years" data-date-format="yyyy-mm-dd" data-date="01-01-2014" class="input-append date dpYears">
                        <input type="text" name="tanggal_masuk" value=<?php echo "$r[tanggal_masuk]";?> size="16" class="form-control">
                        <span class="input-group-btn add-on">
                          <button class="btn btn-theme" type="button"><i class="fa fa-calendar"></i></button>
                          </span>
                      </div>
                      <span class="help-block">Select date</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Harga Jual</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" name="harga_jual" required value=<?php echo "$r[harga_jual]";?>>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Foto Produk</label>
                    <img src=<?php echo "../foto_produk/$r[foto]" ;?> >
                    <div class="controls col-md-9">
                      <div class="fileupload fileupload-new" data-provides="fileupload">
                        <span class="btn btn-theme02 btn-file">
                          <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select file</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                        <input type="file" name="file" class="default" />
                        </span>
                        <span class="fileupload-preview" style="margin-left:5px;"></span>
                        <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-10"></div>
                       <input type="submit" class="btn btn-primary" value="update">
                    </div>
                  </div>
                </form>
              </div>
            </div>
        <?php
        break;
      }//tutup switch


      }//tutup if 

                
        ?>