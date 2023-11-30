<!-- invoice-print-html.php -->

<?php
include '../../koneksi.php';
$id_users = $_SESSION['user_login'];
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user = $id_users");
$all = mysqli_fetch_array($query);

$query_data = mysqli_query($koneksi, "SELECT * FROM premium WHERE id_user = $id_users");
$row = mysqli_fetch_array($query_data);
$filename = "invoice-" . $row['no_invoice'] . ".pdf";
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
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Dari
                  <address>
                    <strong>MinQiu.</strong><br>
                   Jl. Barokah No. 06<br>
                     Wanaherang Gunungputri 16965<br>
                   CS:<a href="tel:+6281223952077" style="color:black;text-decoration:none;">0812-2395-2077</a><br>
                    Email: <a href="mailto:simpananqiu@gmail.com" style="color:black;text-decoration:none;">simpananqiu@gmail.com</a>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Ke
                  <address>
                    <strong><?= $all['nama_user'] ?></strong><br>
                    Telepon: <?= $all['no_hp'] ?><br>
                    Email: <?= $all['email'] ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice : <title>
    <?= $filename ?>
</title></b><br>
                  <br>
                  <b>Status : </b><?= $all['status'] !== '1' ? 'Sukses' : 'Pending' ?> <br>
                 <?php
if ($row['tgl_e'] === NULL) {
   
} else {
   echo '<b>Tanggal : </b>';
    echo date('d F Y', strtotime($row['tgl_e']));
}
?>

                  

                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Produk</th>
                      <th>Tipe Produk</th>
                      <th>Keterangan</th>
                      <th>Harga</th>
                    </tr>
                    </thead>
                    <?php 
                    $no = 1;
                    ?>
                    <tbody>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $row['nama_produk'] ?></td>
                      <td><?= $row['tipe_produk'] ?></td>
                      <td><?= $row['deskripsi'] !== NULL ? $row['deskripsi'] : 'Tidak Ada Keterangan' ?></td>
                      <td>Rp <?= number_format($row['harga'], 2, '.', ',') ?></td>
                    </tr>
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Metode Pembayaran:</p>
                  <img src="../dist/img/dana.jpg" alt="Dana" style="width:100px; height:60px;">
                  <img src="../dist/img/ovo.png"  alt="Ovo" style="width:130px; height:50px;">
                  <img src="../dist/img/gopay.webp"  alt="Ovo" style="width:130px; height:80px;">

                  
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Detail Transaksi <?= date('d F Y', strtotime($row['tgl_b'])) ?></p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>Rp <?= number_format($row['harga'], 2, ',', '.') ?></td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>Rp <?= number_format($row['harga'], 2, ',', '.') ?></td>
                      </tr>
                    </table>
                  </div>
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