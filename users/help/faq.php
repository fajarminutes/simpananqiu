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
$query_data = mysqli_query($koneksi, "SELECT * FROM kontak WHERE id_user = $id_users");
$belum_terbaca = 0; // Jumlah pesan yang belum terbaca
$sudah_terbaca = 0; // Jumlah pesan yang belum terbaca

$query_data_jumlah = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah_pesan FROM kontak WHERE id_user = $id_users");
$result = mysqli_fetch_assoc($query_data_jumlah);

$jumlah = $result['jumlah_pesan'];

while ($row = mysqli_fetch_array($query_data)) {
    // Cek apakah status belum terbaca
    if ($row['status'] === '1') {
        $belum_terbaca++;
    }

     if ($row['status'] === '2') {
        $sudah_terbaca++;
    }
   
    $nama = $row['nama'];
    $email = $row['email'];
    // ... (sisa kolom dari tabel)
    $tgl_b = $row['tgl_b'];
    $tgl_e = $row['tgl_e'];
}


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


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>FAQ</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
              <li class="breadcrumb-item active">FAQ</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-12" id="accordion">
            <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                    <div class="card-header">
                        <h4 class="card-title w-100" style="color:black;">
                            1. Apakah SimpananQiu Gratis?
                        </h4>
                    </div>
                </a>
                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                    <div class="card-body">
                        Ya, SimpananQiu gratis untuk dipakai. Namun kami membatasi pergerakan Anda untuk menggunakan produk kami.
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                    <div class="card-header">
                        <h4 class="card-title w-100" style="color:black;">
                            2. Apa saja fitur utama SimpananQiu?
                        </h4>
                    </div>
                </a>
                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        SimpananQiu memiliki fitur pencatatan keuangan, laporan keuangan, dan kategori pemasukan dan pengeluaran. Anda dapat dengan mudah melacak pemasukan dan pengeluaran keuangan Anda.
                    </div>
                </div>
            </div>
           
            <!-- Add more FAQ items as needed -->
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-3 text-center">
            <p class="lead">
                <a href="contact.php">Hubungi kami</a>,
                jika Anda tidak menemukan jawaban yang tepat atau memiliki pertanyaan lain?<br />
            </p>
        </div>
    </div>
</section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php 
include "../view/footer_t.php";
?>