<!-- print-html.php -->

<?php
include '../../koneksi.php';
$id_users = $_SESSION['user_login'];
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
<div class="wrapper">
  <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                    
    <h4 >
        <div class="image">
            <img src="../dist/img/favicon.jpeg" alt="SimpananQiu Logo" class="rounded-circle img-thumbnail elevation-2" style="width: 50px; height: 50px;"> SimpananQiu.
            <?php
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime = date('Y-m-d H:i');
            ?>
            <small class="float-right">Tanggal: <?= date('d F Y', strtotime($currentDateTime)) ?></small>
        </div>
    </h4>
</div>


                <!-- /.col -->
              </div>
              <title>
                <?php 
                $filename = "Laporan Keuangan Tanggal " . date('d F Y', strtotime($startDate)) . " - " . date('d F Y', strtotime($endDate)) . "";
                echo $filename;
                ?>
                
              </title>
             

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
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

              
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

         

              
            </div>
            <!-- /.invoice -->
</div>
<!-- ./wrapper -->
</body>
</html>