<h3><i class="fa fa-angle-right"></i> Dashboard</h3>
        <div class="row mt">
        <div class="col">
          <div class="card text-bg-success mb-3 " style="max-width: 24rem; height: fit-content;">
            <div class="card-header text-center">Total Penjualan</div>
            <div class="card-body fw-semibold d-flex align-items-center justify-content-center" style="height: 100px;">
            <?php
              $query = mysqli_query($con, "SELECT SUM(total_pembelian) as total_penjualan FROM pembelian");
              $data = mysqli_fetch_assoc($query);
            ?>
            <p class="card-text fs-1 "><?php echo "Rp. " . number_format($data['total_penjualan'], 0, ',', '.'); ?></p>
            </div>
          </div>
        </div>
        <div class="col">
        <div class="card">
            <div class="card-header">
              <h5>Total Penjualan</h5>
            </div>
            <div class="card-body">
              <form method="post">
                <div class="row mb-3">
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
                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                  </div>
                </div>
              </form>
              <?php
              if(isset($_POST['tahun']) && !empty($_POST['tahun']) && empty($_POST['bulan']) && empty($_POST['hari'])){
                  // Jika memilih data berdasarkan tahun saja
                  $tahun = $_POST['tahun'];
                  $query = mysqli_query($con, "SELECT SUM(total_pembelian) AS total_penjualan FROM pembelian WHERE YEAR(tanggal_pembelian) = '$tahun' GROUP BY YEAR(tanggal_pembelian)");
                  if(mysqli_num_rows($query) > 0){
                      $data = mysqli_fetch_assoc($query);
                      $total_penjualan = $data['total_penjualan'];
                  } else {
                      $total_penjualan = 0;
                  }
                  echo "<h3>Total Penjualan Tahun $tahun: Rp." . number_format($total_penjualan) . "</h3>";
              } else if(isset($_POST['tahun']) && !empty($_POST['tahun']) && isset($_POST['bulan']) && !empty($_POST['bulan']) && empty($_POST['hari'])){
                  // Jika memilih data berdasarkan tahun dan bulan saja
                  $tahun = $_POST['tahun'];
                  $bulan = $_POST['bulan'];
                  $query = mysqli_query($con, "SELECT SUM(total_pembelian) AS total_penjualan FROM pembelian WHERE YEAR(tanggal_pembelian) = '$tahun' AND MONTH(tanggal_pembelian) = '$bulan'");
                  if(mysqli_num_rows($query) > 0){
                      $data = mysqli_fetch_assoc($query);
                      $total_penjualan = $data['total_penjualan'];
                  } else {
                      $total_penjualan = 0;
                  }
                  $nama_bulan = date('F', mktime(0, 0, 0, $bulan, 1));
                  echo "<h3>Total Penjualan Bulan $nama_bulan $tahun: Rp." . number_format($total_penjualan) . "</h3>";
              } else if(isset($_POST['tahun']) && !empty($_POST['tahun']) && isset($_POST['bulan']) && !empty($_POST['bulan']) && isset($_POST['hari']) && !empty($_POST['hari'])){
                  // Jika memilih data berdasarkan tahun, bulan, dan hari
                  $tahun = $_POST['tahun'];
                  $bulan = $_POST['bulan'];
                  $hari = $_POST['hari'];
                  $query = mysqli_query($con, "SELECT SUM(total_pembelian) AS total_penjualan FROM pembelian WHERE YEAR(tanggal_pembelian) = '$tahun' AND MONTH(tanggal_pembelian) = '$bulan' AND DAY(tanggal_pembelian) = '$hari'");
                  if(mysqli_num_rows($query) > 0){
                      $data = mysqli_fetch_assoc($query);
                      $total_penjualan = $data['total_penjualan'];
                  } else {
                      $total_penjualan = 0;
                  }
                  $bulan = intval($_POST['bulan']); // convert to integer
                  $nama_bulan = date('F', mktime(0, 0, 0, $bulan, 1));
                  echo "<h3>Total Penjualan Tanggal $hari $nama_bulan $tahun: Rp." . number_format($total_penjualan) . "</h3>";
              } else {
                  // Jika tidak memilih apapun
                  echo "<h3>Silahkan pilih filter penjualan terlebih dahulu</h3>";
              }
              ?>
              
            </div>
          </div>


        </div>
        <div class="col">
          Column
        </div>
        </div>