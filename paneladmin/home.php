<h3><i class="fa fa-angle-right"></i> Dashboard</h3>
        <div class="row mt">
        <div class="col">
          <div class="card mx-3 " style="max-width: fit-content; height: fit-content;">
            <div class="card-header text-center">Total Penjualan</div>
            <div class="card-body fw-semibold" style="height: 200px;">
              <form method="post">
                <div class="row mb-3 mx-1">
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
                        $month_num = date("m", mktime(0, 0, 0, $i, 1));
                        echo "<option value='$month_num'>$month</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col">
                    <select class="form-select" name="hari">
                      <option value="">Pilih Hari</option>
                      <?php
                      for($i = 1; $i <= 31; $i++){
                        echo "<option value='$i'>$i</option>";
                      }
                      ?>
                      <option value="0">Tidak Ada</option>
                    </select>
                  </div>
                  <div class="col">
                    <button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
                  </div>
                </div>
              </form>
              <?php
               if(isset($_POST['tahun']) && !empty($_POST['tahun']) && empty($_POST['bulan']) && empty($_POST['hari'])){
                // Jika memilih data berdasarkan tahun saja
                $tahun = $_POST['tahun'];
                $query = mysqli_query($con, "SELECT SUM(total_pembelian) AS total_penjualan FROM pembelian WHERE YEAR(tanggal_pembelian) = $tahun");
                if(mysqli_num_rows($query) > 0){
                    $data = mysqli_fetch_assoc($query);
                    $total_penjualan = $data['total_penjualan'];
                } else {
                    $total_penjualan = 0;
                }
                echo "<p class='card-text fs-1 d-flex align-items-center justify-content-center'>Total Penjualan " . date("F Y", mktime(0, 0, 0, 1, 1, $tahun)) . ": Rp." . number_format($total_penjualan) . "</p>";
                }else if(isset($_POST['tahun']) && isset($_POST['bulan']) && empty($_POST['hari'])){
                  // Jika memilih data berdasarkan tahun dan bulan saja
                  $tahun = $_POST['tahun'];
                  $bulan = $_POST['bulan'];
                  $hari = isset($_POST['hari']) ? $_POST['hari'] : null;
                  $query = mysqli_query($con, "SELECT SUM(total_pembelian) AS total_penjualan FROM pembelian WHERE YEAR(tanggal_pembelian) = $tahun AND MONTH(tanggal_pembelian) = $bulan" . ($hari ? " AND DAY(tanggal_pembelian) = $hari" : ""));

                  if(mysqli_num_rows($query) > 0){
                      $data = mysqli_fetch_assoc($query);
                      $total_penjualan = $data['total_penjualan'];
                  } else {
                      $total_penjualan = 0;
                  }
                  $nama_bulan = date('F', mktime(0, 0, 0, $bulan, 1));
                  echo "<p class='card-text fs-1 d-flex align-items-center justify-content-center'>Total Penjualan $nama_bulan  $tahun: Rp." . number_format($total_penjualan) . "</p>";
                } else if(isset($_POST['tahun']) && isset($_POST['bulan']) && isset($_POST['hari'])){
                // Jika memilih data berdasarkan tahun, bulan, dan hari
                  $tahun = $_POST['tahun'];
                  $bulan = $_POST['bulan'];
                  $hari = $_POST['hari'];
                  $query = mysqli_query($con, "SELECT SUM(total_pembelian) AS total_penjualan FROM pembelian WHERE YEAR(tanggal_pembelian) = '$tahun' AND MONTH(tanggal_pembelian) = '$bulan' AND DAY(tanggal_pembelian) = $hari'");
                  if(mysqli_num_rows($query) > 0){
                      $data = mysqli_fetch_assoc($query);
                      $total_penjualan = $data['total_penjualan'];
                      
                  } else {

                      $total_penjualan = 0;
                  }
                  $bulan = intval($_POST['bulan']); // convert to integer
                  $nama_bulan = date('F', mktime(0, 0, 0, $bulan, 1));
                  echo "<p class='card-text fs-1 d-flex align-items-center justify-content-center'>Total Penjualan $hari $nama_bulan $tahun: Rp." . number_format($total_penjualan) . "</p>";

                }else {
                    // Jika tidak memilih apapun
                    echo "<p class='card-text fs-1 d-flex align-items-center justify-content-center'>Silahkan pilih fiter terlebih dahulu";
                }
              ?>
              
            </div>
          </div>
        </div>
        <div class="col">
        


        </div>
        <div class="col">
          Column
        </div>
        </div>