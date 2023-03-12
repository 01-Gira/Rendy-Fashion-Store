 <?php
  include "../config/koneksi.php";
 error_reporting(0);

 if (empty($_SESSION['username']) AND empty($_SESSION['password'])) {

   echo"<center>Untuk akses halaman ini Anda harus login dulu ya</center> <br>";
   echo"<center><a href=../../index.php>Silahkan login</center>";

 }else{
  $aksi="modul/kategori/aksi_kategori.php";
  switch ($_GET['aksi']) {
    default:
 ?> 

 <h3><i class="fa fa-angle-right"></i> Master Kategori kategori</h3>
        <div class="row mt ">
          <div class="col-lg-12">
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Data Kategori </h4>
              <div class="col-sm-12" align="right">
              <a href=<?php echo"?p=kategori&aksi=tambah";?> ><button type="button" class="btn btn-info">Tambah Data Kategori</button></a>
              </div>
              <br> <br>
              <section id="unseen">
                <br>
                <table class="table table-bordered table-striped table-condensed mx-3">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Kategori <a href="?p=kategori&sort=kode_kategori_asc"><i class="fa fa-arrow-up"></i></a><a href="?p=kategori&sort=kode_kategori_desc"><i class="fa fa-arrow-down"></i></a></th>
                      <th>Kategori <a href="?p=kategori&sort=nama_kategori_asc"><i class="fa fa-arrow-up"></i></a><a href="?p=kategori&sort=nama_kategori_desc"><i class="fa fa-arrow-down"></i></a></th>
                      <th>Aksi</th>
                  </thead>
                  <tbody>
                    <?php
                    if (isset($_GET['sort'])) {
                      $sort = $_GET['sort'];
                      switch($sort) {
                        case 'kode_kategori_asc':
                          $sql = mysqli_query($con, "SELECT * FROM kategori order by id_kategori ASC ");
                          break;
                        case 'kode_kategori_desc':
                          $sql = mysqli_query($con, "SELECT * FROM kategori order by id_kategori DESC ");
                          break;
                        case 'nama_kategori_asc':
                          $sql = mysqli_query($con, "SELECT * FROM kategori order by nama_kategori ASC ");
                          break;
                        case 'nama_kategori_desc':
                          $sql = mysqli_query($con, "SELECT * FROM kategori order by nama_kategori DESC ");
                          break;
                        default:
                          $sql=mysqli_query($con,"SELECT * FROM kategori order by nama_kategori ASC ");
                          break;
                      }
                    } else {
                      $sql=mysqli_query($con,"SELECT * FROM kategori order by nama_kategori ASC ");
                    }
                    $no=1;
                    while ($r=mysqli_fetch_array($sql)) {
                      echo "<tr><td>$no</td>
                                <td>$r[id_kategori]</td>
                                <td>$r[nama_kategori]</td> 
                                <td>
                                <a href=?p=kategori&aksi=edit&id=$r[id_kategori]><button type='button' class='btn btn-info'>Edit</button></a>
                                <a href='$aksi?aksi=hapus&id=$r[id_kategori]'<button type='button' class='btn btn-danger'>Hapus</button></a>
                                </td>";
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



 <h3><i class="fa fa-angle-right"></i>Master Kategori </h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Form Kategori</h4>
              <form class="form-horizontal style-form" method="POST" action="modul/kategori/aksi_kategori.php?p=kategori&aksi=tambah" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nama Kategori</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_kategori">
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
        $sql=mysqli_query($con, "SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
        $r=mysqli_fetch_array($sql);
        ?>  

          <h3><i class="fa fa-angle-right"></i>Edit Kategori</h3>
          <!-- BASIC FORM ELELEMNTS -->
          <div class="row mt">
            <div class="col-lg-12">
              <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i>Edit Kategori</h4>
                <input type="hidden" class="form-control" name="kode" value=<?php echo "$r[id_kategori]";?>>
                <form class="form-horizontal style-form" method="POST" action="modul/kategori/aksi_kategori.php?p=kategori&aksi=update" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nama Kategori</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama_kategori" value="<?php echo$r['nama_kategori'];?>">
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