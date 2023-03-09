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
              <form class="form-horizontal style-form" method="POST" action=<?php echo"modul/produk/aksi_produk.php?act=tambah";?> enctype="multipart/form-data">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nama Produk</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama">
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
                    <textarea class ="form-control" name="deskripsi"> 
                    </textarea> 
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Jumlah</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="jumlah">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Tanggal masuk</label>
                   <div class="col-md-3 col-xs-11">
                    <div data-date-viewmode="years" data-date-format="yyyy-mm-dd" data-date="01-01-2014" class="input-append date dpYears">
                      <input type="text" name="tanggal_masuk" value="2014-01-01" size="16" class="form-control">
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
                    <input type="text" class="form-control" name="harga_jual">
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
                     <input type="submit" class="btn btn-primary" value="Simpan">
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
                <form class="form-horizontal style-form" method="POST" action=<?php echo"modul/produk/aksi_produk.php?act=update";?> enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="kode" value=<?php echo "$r[kd_barang]";?>>
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nama Produk</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" value=<?php echo "$r[nama]";?>>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Kategori</label>
                    <div class="col-sm-10">
                    <select name="kategori" class="form-control">
                      <?php
                      $tampil=mysqli_query($con," select * from kategori order by nama_kategori");
                      if ($r[id_kategori]==0) {
                        echo "<option value=0 selected>- Pilih kategori -</option>";
                      }
                      while ($w=mysqli_fetch_array($tampil)) {
                        if ($r[id_kategori]==$w[id_kategori]){
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
                      <textarea class ="form-control" name="deskripsi"><?php echo "$r[deskripsi]";?></textarea> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Jumlah</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="jumlah" value=<?php echo "$r[jumlah_barang]";?>>
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
                      <input type="text" class="form-control" name="harga_jual" value=<?php echo "$r[harga_jual]";?>>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Foto Produk</label>
                    <img src=<?php echo "../foto_produk/small_$r[foto]" ;?> >
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