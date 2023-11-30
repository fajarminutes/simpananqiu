
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
   <a href="" class="brand-link">
      <img src="../dist/img/favicon.jpeg" alt="Logo SimpananQiu" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SimpananQiu</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" id="GambarProfile" >
       

               </div>
              <script>
  // Fungsi untuk memperbarui profil
function Yaaa() {
    var id_users = <?= $id_users ?>; // Ganti dengan nilai ID pengguna yang sesuai
    console.log("ID Users: " + id_users); // Tambahkan ini untuk memeriksa ID Users
    $.ajax({
        url: '../koneksi_gambar/gambar.php',
        method: 'GET',
        data: { id_users: id_users }, // Kirim parameter ID pengguna
        dataType: 'json',
        success: function(data) {
            console.log("AJAX Success", data); // Tambahkan ini untuk memeriksa hasil dari permintaan
            $('#GambarProfile').html(data.aboutGambar);
        },
        error: function(xhr, status, error) {
            console.log("AJAX Error: " + error); // Tambahkan ini untuk menangani kesalahan
        }
    });
}


  // Memanggil fungsi pembaruan setiap 1 detik
  setInterval(Yaaa, 1000);
</script>

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
    'profile.php' => ['icon' => 'fas fa-user', 'title' => 'Profile', 'path' => '../profile/'],
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
        <a href="../index.php" class="nav-link <?= ($current_page === 'index.php') ? 'active' : ''; ?>">
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
        <a href="../master/<?= $page ?>" class="nav-link <?= ($current_page === $page) ? 'active' : ''; ?>">
            <i class="<?= $master['icon'] ?> nav-icon"></i>
            <p><?= $master['title'] ?></p>
        </a>
    </li>
<?php endforeach; ?>

        </ul>
    </li>

    <li class="nav-item">
        <a href="../transaksi/transaksi.php" class="nav-link <?= ($current_page === 'transaksi.php' || $current_page === 'update.php') ? 'active' : ''; ?>
">
            <i class="nav-icon fas fa-dollar-sign"></i>
            <p>
                Transaksi
            </p>
        </a>
    </li>

    <li class="nav-item">
    <a href="../tabungan/tabungan.php" class="nav-link <?= ($current_page === 'tabungan.php' || $current_page === 'catat_tabungan.php') ? 'active' : ''; ?>">
        <i class="nav-icon fas fa-piggy-bank"></i>
        <p>
            Target Menabung
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="../laporan/laporan.php" class="nav-link <?= ($current_page === 'laporan.php' || $current_page === 'statistik.php') ? 'active' : ''; ?>">
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
    <a href="../premium/invoice.php" class="nav-link' . (($current_page === 'premium.php' || $current_page === 'beli.php' || $current_page === 'invoice.php') ? ' active' : '') . '">
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
    <a href="../premium/premium.php" class="nav-link' . (($current_page === 'premium.php' || $current_page === 'beli.php' || $current_page === 'invoice.php') ? ' active' : '') . '">
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
        <a href="../help/<?= $page ?>" class="nav-link <?= ($current_page === $page) ? 'active' : ''; ?>">
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
            window.location.href = '../../logout.php';
        }
    });
});
</script>