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

<?php
$target_query = "SELECT * FROM premium WHERE id_user = '$id_users'";
    $target_result = mysqli_query($koneksi, $target_query);
    $row = mysqli_fetch_assoc($target_result);

    if (mysqli_num_rows($target_result) > 0) {
      
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Catatan</h5>
              Halaman ini merupakan halaman invoice, Gunakan invoice dengan sebaik-sebaiknya.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
    <h4>
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
                    <strong>MinQIu.</strong><br>
                   Jl. Barokah No. 06<br>
                     Wanaherang Gunungputri 16965<br>
                   CS:<a href="https://wa.me/+6281223952077" style="color:black;">0812-2395-2077</a><br>
                    Email: <a href="mailto:simpananqiu@gmail.com" style="color:black;">simpananqiu@gmail.com</a>
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
                  <b>Invoice : <?= $row['no_invoice'] ?></b><br>
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

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                   Pilih metode pembayaran yang sesuai dengan kebutuhan Anda.
                  </p>
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

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.php" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Cetak</a>
                  <a href="../help/contact.php" class="btn btn-success float-right"><i class="fas fa-phone-alt"></i> Hubungi Admin
                  </a>
                  <a href="pdf.php" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Download PDF
                  </a>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php 
} else {
         // Tidak sesuai, redirect ke halaman yang sesuai
        $_SESSION['gagal'] = 'Opps, Anda Gagal!';
        echo '<script>window.location.href = "premium.php";</script>';
}

?>


 <?php 
include "../view/footer_t.php";
?>