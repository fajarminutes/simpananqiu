<?php 
session_start();
// Informasi koneksi database
include '../koneksi.php';

// Periksa apakah sesi 'user_login' dan 'status_vr' sudah diinisialisasi
if (!isset($_SESSION['user_login']) || !isset($_SESSION['status_vr'])) {
  $_SESSION['belum_login'] = 'Anda belum login, silakan login terlebih dahulu.';
  header("Location: ../../../simpananqiu/login/"); // Ganti dengan halaman login yang sesuai
  exit();
}

// Periksa apakah sesi 'user_login' dan 'status_vr' sudah sesuai, misalnya dengan database
$id_users = $_SESSION['user_login'];
$status_vr = $_SESSION['status_vr'];

// Query database untuk memeriksa apakah 'id_users' sesuai dengan 'status_vr'
$query = "SELECT * FROM users WHERE id_user = ? AND vr = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "is", $id_users, $status_vr);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
  // Jika 'id_users' dan 'status_vr' tidak sesuai dengan database, alihkan ke halaman login
  $_SESSION['belum_login'] = 'Anda belum login, silakan login terlebih dahulu.';
  header("Location: ../../../simpananqiu/login/"); // Ganti dengan halaman login yang sesuai
  exit();
}

// Cek apakah sesi timeout sudah diatur atau belum
if (isset($_SESSION['user_last_activity'])) {
  // Hitung selisih waktu
  $now = time();
  $user_last_activity = $_SESSION['user_last_activity'];
  $timeout_duration = 60 * 60 * 6; // 1 hari dalam detik

  if ($now - $user_last_activity > $timeout_duration) {
      // Matikan sesi
      session_unset();
      session_destroy();

      
      header("Location: view/back_login.php"); // Ganti dengan halaman login yang sesuai
      exit();
  }
}

// Perbarui waktu terakhir aktivitas
$_SESSION['user_last_activity'] = time();

// Lanjutkan dengan kode Anda yang menggunakan $id_users, $status_vr, dan $user
$result = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user = $id_users");
$all = mysqli_fetch_array($result);

// Di sini, Anda dapat melanjutkan dengan kode Anda yang menggunakan informasi pengguna.


$qK = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_user = $id_users");
$kategori = mysqli_num_rows($qK);
$qA = mysqli_query($koneksi, "SELECT * FROM aset WHERE id_user = $id_users");
$aset = mysqli_num_rows($qA);
$qTP = mysqli_query($koneksi, "SELECT * FROM keuangan WHERE id_user = $id_users AND nama_keuangan = 'Pemasukan'");
$pemasukan = mysqli_num_rows($qTP);
$qTPP = mysqli_query($koneksi, "SELECT * FROM keuangan WHERE id_user = $id_users AND nama_keuangan = 'Pengeluaran'");
$pengeluaran = mysqli_num_rows($qTPP); 
?>
<?php 
if (isset($_SESSION['gagal_premium'])) {
  echo '<script>';
  echo 'Swal.fire({';
  echo '    position: "center",';
  echo '    icon: "warning",';
  echo '    title: "' . $_SESSION['gagal_premium'] . '",';
  echo '    showConfirmButton: false,';
  echo '    timer: 3000'; //Ini 3 detik
  echo '});';
  echo '</script>';
  unset($_SESSION['gagal_premium']); // Hapus pesan dari session
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SimpananQiu</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Sweetalert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- JQVMap -->
<link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/adminlte.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
<!-- summernote -->
<link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <!-- Favicons -->
<link href="../assets/img/favicon.jpeg" rel="icon">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
  <img class="animation__shake" src="dist/img/favicon.png" alt="Logo SimpananQiu" height="200" width="200">
</div>


<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="index.php" class="nav-link">Dashboard</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="help/contact.php" class="nav-link">Kontak</a>
    </li>
      <li class="nav-item d-none d-sm-inline-block">
      <a href="profile/profile.php" class="nav-link">Profil</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="profile/" role="button">
          <i class="nav-icon fas fa-user"></i>
      </a>
      
    </li>
  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="" class="brand-link">
    <img src="dist/img/favicon.jpeg" alt="Logo SimpananQiu" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">SimpananQiu</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../data/img/users/<?= $all['foto'] ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="profile/profile.php" class="d-block"><?= $all['username'] ?></a>
      </div>
    </div>

  <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
    <?php
// Dapatkan nama file skrip PHP saat ini
$current_page = basename($_SERVER['PHP_SELF']);
// Daftar kategori
$setting = [
  'profile.php' => ['icon' => 'fas fa-user', 'title' => 'Profile', 'path' => 'profile/'],
  '' => ['icon' => 'fas fa-sign-out-alt', 'title' => 'Logout', 'id' => 'logoutLink', 'path' => '#']
  
];
$master = [
  'k_s.php' => ['icon' => 'fas fa-tag', 'title' => 'Kategori'],
  'aset.php' => ['icon' => 'fas fa-wallet', 'title' => 'Aset'],
  
];

$bantuan = [
  'contact.php' => ['icon' => 'fas fa-envelope', 'title' => 'Kontak'],
'faq.php' => ['icon' => 'fas fa-question-circle', 'title' => 'FAQ'],

  
];

?>

<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  <li class="nav-item">
      <a href="index.php" class="nav-link <?= ($current_page === 'index.php') ? 'active' : ''; ?>">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
              Dashboard
          </p>
      </a>
  </li>
    <li class="nav-item <?= (in_array($current_page, array_keys($master))) ? 'menu-open' : ''; ?>">
      <a href="#" class="nav-link <?= (in_array($current_page, array_keys($master))) ? 'active' : ''; ?>">
          <i class="nav-icon fas fa-folder"></i>
          <p>
              Master Data
              <i class="fas fa-angle-left right"></i>
          </p>
      </a>
      <ul class="nav nav-treeview">
          <?php foreach ($master as $page => $master): ?>
  <li class="nav-item">
      <a href="master/<?= $page ?>" class="nav-link <?= ($current_page === $page) ? 'active' : ''; ?>">
          <i class="<?= $master['icon'] ?> nav-icon"></i>
          <p><?= $master['title'] ?></p>
      </a>
  </li>
<?php endforeach; ?>

      </ul>
  </li>

  <li class="nav-item">
      <a href="transaksi/transaksi.php" class="nav-link <?= ($current_page === 'transaksi.php' || $current_page === 'update.php') ? 'active' : ''; ?>
">
          <i class="nav-icon fas fa-dollar-sign"></i>
          <p>
              Transaksi
          </p>
      </a>
  </li>

  <li class="nav-item">
  <a href="tabungan/tabungan.php" class="nav-link <?= ($current_page === 'tabungan.php' || $current_page === 'catat_tabungan.php') ? 'active' : ''; ?>">
      <i class="nav-icon fas fa-piggy-bank"></i>
      <p>
          Target Menabung
      </p>
  </a>
</li>

<li class="nav-item">
  <a href="laporan/laporan.php" class="nav-link <?= ($current_page === 'laporan.php' || $current_page === 'statistik.php') ? 'active' : ''; ?>">
      <i class="nav-icon fas fa-chart-bar"></i>
      <p>
          Laporan & Statistik
      </p>
  </a>
</li>

<?php 
$target_query = "SELECT * FROM premium WHERE id_user = '$id_users'";
  $target_result = mysqli_query($koneksi, $target_query);
  $row = mysqli_fetch_assoc($target_result);

  if (mysqli_num_rows($target_result) > 0) {
    if($all['status'] == 1 && mysqli_num_rows($target_result) > 0) {
  echo '<li class="nav-item">
  <a href="premium/invoice.php" class="nav-link' . (($current_page === 'premium.php' || $current_page === 'beli.php' || $current_page === 'invoice.php') ? ' active' : '') . '">
      <i class="nav-icon fas fa-arrow-up"></i>
      <p>
          Tingkatkan Akun
      </p>
  </a>
</li>';
} else {

}
  

    } else {

if($all['status'] == 1) {
  echo '<li class="nav-item">
  <a href="premium/premium.php" class="nav-link' . (($current_page === 'premium.php' || $current_page === 'beli.php' || $current_page === 'invoice.php') ? ' active' : '') . '">
      <i class="nav-icon fas fa-arrow-up"></i>
      <p>
          Tingkatkan Akun
      </p>
  </a>
</li>';
} else {
  // Code untuk status tidak sama dengan 1 (misalnya, status bukan 1)
}
    }
?>



    <li class="nav-item <?= (in_array($current_page, array_keys($bantuan))) ? 'menu-open' : ''; ?>">
      <a href="#" class="nav-link <?= (in_array($current_page, array_keys($bantuan))) ? 'active' : ''; ?>">
          <i class="nav-icon fas fa-life-ring"></i>
          <p>
              Bantuan
              <i class="fas fa-angle-left right"></i>
          </p>
      </a>
      <ul class="nav nav-treeview">
          <?php foreach ($bantuan as $page => $bantuan): ?>
  <li class="nav-item">
      <a href="help/<?= $page ?>" class="nav-link <?= ($current_page === $page) ? 'active' : ''; ?>">
          <i class="<?= $bantuan['icon'] ?> nav-icon"></i>
          <p><?= $bantuan['title'] ?></p>
      </a>
  </li>
<?php endforeach; ?>

      </ul>
  </li>

  <li class="nav-item <?= (in_array($current_page, array_keys($setting))) ? 'menu-open' : ''; ?>">
      <a href="#"  class="nav-link <?= (in_array($current_page, array_keys($setting))) ? 'active' : ''; ?>">
          <i class="nav-icon fas fa-cog"></i>
          <p>
              Pengaturan
              <i class="fas fa-angle-left right"></i>
          </p>
      </a>
      <ul class="nav nav-treeview">
          <?php foreach ($setting as $page => $settings): ?>
  <li class="nav-item">
      <a href="<?= $settings['path'] ?><?= $page ?>" id="<?= $settings['id'] ?>" class="nav-link <?= ($current_page === $page) ? 'active' : ''; ?>">
          <i class="<?= $settings['icon'] ?> nav-icon"></i>
          <p><?= $settings['title'] ?></p>
      </a>
  </li>
<?php endforeach; ?>

      </ul>
  </li>

    

</ul>

    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<script>
document.getElementById('logoutLink').addEventListener('click', function (e) {
  e.preventDefault();

  Swal.fire({
      title: 'Apakah Anda yakin ingin logout?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya',
      cancelButtonText: 'Tidak',
  }).then((result) => {
      if (result.isConfirmed) {
          window.location.href = '../logout.php';
      }
  });
});
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $kategori ?></h3>

              <p>Kategori</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="master/k_s.php" class="small-box-footer">Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= $aset ?></h3>

              <p>Aset</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="master/aset.php" class="small-box-footer">Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>
                <?= $pemasukan ?>
              </h3>

              <p>Transaksi Pemasukan</p>
            </div>
            <div class="icon">
  <i class="fas fa-dollar-sign"></i>
</div>

            <a href="transaksi/transaksi.php" class="small-box-footer">Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>
                <?= $pengeluaran ?>
              </h3>

              <p>Transaksi Pengeluaran</p>
            </div>
            <div class="icon">
  <i class="fas fa-dollar-sign"></i>
</div>

            <a href="transaksi/transaksi.php" class="small-box-footer">Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

          <div class="col-lg-4 col-12">
          <!-- small box -->
          <div class="small-box bg-light">
            <div class="inner">
                <?php
$query = mysqli_query($koneksi, "SELECT id_user, nama_keuangan, SUM(total) as total_keuangan FROM keuangan WHERE id_user = '$id_users' AND nama_keuangan = 'Pemasukan'");

if (mysqli_num_rows($query) > 0) {
  $row = mysqli_fetch_array($query);
  $total_keuangan_p = 'Rp ' . number_format($row['total_keuangan'], 2, ',', '.');

?>
  <p style="margin-bottom:-5px;font-weight:bold;">Pemasukan</p>
  <?php
  if ($total_keuangan_p !== NULL) {
      echo '<h3  style="color:green;font-weight:bold;">' . $total_keuangan_p . '</h3>';
  } else {
      echo '<h3 style="color:green;font-weight:bold;">0</h3>';
  }
  ?>
<?php
} else {
  echo "Tidak ada data yang sesuai dengan kriteria.";
}
?>

              <p>Total Pemasukan</p>
            </div>
            <div class="icon">
  <i class="fas fa-dollar-sign"></i>
</div>

            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->

          <div class="col-lg-4 col-12">
          <!-- small box -->
          <div class="small-box bg-light">
            <div class="inner">
                <?php
$query = mysqli_query($koneksi, "SELECT id_user, nama_keuangan, SUM(total) as total_keuangan FROM keuangan WHERE id_user = '$id_users' AND nama_keuangan = 'Pengeluaran'");

if (mysqli_num_rows($query) > 0) {
  $row = mysqli_fetch_array($query);
  $total_keuangan_p = 'Rp ' . number_format($row['total_keuangan'], 2, ',', '.');

?>
  <p style="margin-bottom:-5px;font-weight:bold;">Pengeluaran</p>
  <?php
  if ($total_keuangan_p !== NULL) {
      echo '<h3  style="color:red;font-weight:bold;">' . $total_keuangan_p . '</h3>';
  } else {
      echo '<h3 style="color:red;font-weight:bold;">0</h3>';
  }
  ?>
<?php
} else {
  echo "Tidak ada data yang sesuai dengan kriteria.";
}
?>

              <p>Total Pengeluaran</p>
            </div>
            <div class="icon">
  <i class="fas fa-dollar-sign"></i>
</div>

            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->


          <div class="col-lg-4 col-12">
          <!-- small box -->
          <div class="small-box bg-light">
            <div class="inner">
                <?php 
$query_p = mysqli_query($koneksi, "SELECT id_user, nama_keuangan, SUM(total) as total_keuangan
FROM keuangan WHERE id_user = '$id_users' AND nama_keuangan = 'Pengeluaran'");

while ($row_p = mysqli_fetch_array($query_p)) {
  $total_keuangan_p = $row_p['total_keuangan'];

  $query = mysqli_query($koneksi, "SELECT id_user, nama_keuangan, SUM(total) as total_keuangan
  FROM keuangan WHERE id_user = '$id_users' AND nama_keuangan = 'Pemasukan'");

  while ($row = mysqli_fetch_array($query)) {
    $total_keuangan = $row['total_keuangan'];
    
    $selisih = $total_keuangan - $total_keuangan_p;
    $formattedSelisih = 'Rp ' . number_format($selisih, 2, ',', '.');
?>
  <p style="margin-bottom:-5px;font-weight:bold;">Total</p>

<h3><?= $formattedSelisih ?></h3>
              <p>Total Semuanya</p>
              <?php }}?>
            </div>
            <div class="icon">
  <i class="fas fa-dollar-sign"></i>
</div>

            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

  <footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 1.0.0
  </div>
  <strong>Copyright &copy;<?php echo date("Y"); ?> -<a href="">SIMPANANQIU</a>.</strong> All rights reserved.
</footer>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>
