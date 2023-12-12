   <?php 
include "../view/header_t.php";
?>

  <?php 
include "../view/navbar_t.php";
?>

<?php 
include "../view/sidebar_t.php";
?>

<?php 
if (isset($_SESSION['gagal'])) {
    echo '<script>';
    echo 'Swal.fire({';
    echo '    position: "center",';
    echo '    icon: "warning",';
    echo '    title: "' . $_SESSION['gagal'] . '",';
    echo '    showConfirmButton: false,';
    echo '    timer: 3000'; //Ini 3 detik
    echo '});';
    echo '</script>';
    unset($_SESSION['gagal']); // Hapus pesan dari session
}
?>
<!-- referesh halaman  -->
<script>
    if (window.history.replaceState) {
        // Mengganti URL dengan URL tanpa parameter
        window.history.replaceState(null, null, window.location.href.split('?')[0]);
    }
</script>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Keuangan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../index.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Laporan Keuangan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
           

            
            <div class="card-body">
              <div class="col-lg-4 mb-2">
                <form action="" method="get">
              <div class="form-group">
                <label>Tanggal</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                 <input type="text" class="form-control" id="reservation" name="date_range">
                </div>
              </div>
              <button type="submit" class="btn btn-primary" name="tampilkan">Tampilkan</button>
              <a href="print.php<?= isset($_GET['tampilkan']) ? '?tampilkan&date_range=' . $_GET['date_range'] : '' ?>" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Print</a>
              <a href="pdf.php<?= isset($_GET['tampilkan']) ? '?tampilkan&date_range=' . $_GET['date_range'] : '' ?>"  class="btn btn-success"><i class="fas fa-download"></i> Download</a>

              </div>
              </form>
              
             
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal dan Waktu</th>
                    <th>Total</th>
                    <th>Kategori</th>
                    <th>Aset</th>
                    <th>Catatan</th>
                    <th>Deskripsi</th>
                  </tr>
                  </thead>
                  
                  <tbody>
                   <?php
$no = 1;
// Periksa apakah parameter "tampilkan" ada dalam URL
if (isset($_GET['tampilkan'])) {
    // Dapatkan rentang tanggal dari parameter GET
    $dateRange = $_GET['date_range'];
    $dateArray = explode(' - ', $dateRange);
    $startDate = date('Y-m-d', strtotime($dateArray[0])); // Awal bulan dari tanggal awal
    $endDate = date('Y-m-d', strtotime($dateArray[1]));   // Akhir bulan dari tanggal akhir

    // Perbarui query SQL untuk memfilter data berdasarkan rentang tanggal
    $query = mysqli_query($koneksi, "SELECT * FROM keuangan WHERE id_user = $id_users AND tgl_b BETWEEN '$startDate' AND '$endDate' ORDER BY tgl_b DESC");
} else {
    // Jika parameter "tampilkan" tidak ada, ambil data dari awal hingga akhir bulan saat ini
    $startDate = date('Y-m-01'); // Awal bulan saat ini
    $endDate = date('Y-m-t');    // Akhir bulan saat ini

    $query = mysqli_query($koneksi, "SELECT * FROM keuangan WHERE id_user = $id_users AND tgl_b BETWEEN '$startDate' AND '$endDate' ORDER BY tgl_b DESC");
}



while ($row = mysqli_fetch_array($query)) {
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= date('d F Y H.i', strtotime($row['tgl_b'])) ?></td>
   <?php
if ($row['nama_keuangan'] === 'Pemasukan') {
  $formattedTotal = 'Rp ' . number_format($row['total'], 2, ',', '.');
  echo '<td style="color: blue;">' . $formattedTotal . '</td>';
} else if ($row['nama_keuangan'] === 'Pengeluaran') {
  $formattedTotal = 'Rp ' . number_format($row['total'], 2, ',', '.');
  echo '<td style="color: red;">' . $formattedTotal . '</td>';
}

?>

    
    <?php
    $noK = $row['id_kategori'];
    $kategori = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori = '$noK' ");
    while ($k = mysqli_fetch_array($kategori)) {
    ?>
    <td><?= $k['nama_kategori'] ?></td>
    <?php }?>
    <?php 
    $noA = $row['id_aset'];
    $aset = mysqli_query($koneksi, "SELECT * FROM aset WHERE id_aset = '$noA'");
    while ($a = mysqli_fetch_array($aset)) {
    ?>
    <td><?= $a['grup'] ?>/ <?= $a['nama_aset']?></td>
    <?php  }?>
    <td><?= $row['catatan'] ?></td>
    <td>
        <?php
        $gambarPath = "../../data/img/transaksi/" . $row['deskripsi']; // Path gambar sesuai dengan data dalam database
        if (file_exists($gambarPath)) {
            // Tampilkan gambar jika file gambar ada
            echo '<img src="' . $gambarPath . '" data-toggle="modal"  alt="Gambar Transaksi" data-target="#gambarModal' . $row['id_keuangan'] . '"  width="100" height="100">';
        } else {
            // Tampilkan deskripsi jika file gambar tidak ada
            echo $row['deskripsi'];
        }
        ?>
    </td>
   
</tr>
<?php } ?>


                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
             
              <!-- /.card-body -->
            </div>

                  </div>
               
                  
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



 <?php 
include "../view/footer_t.php";
?>