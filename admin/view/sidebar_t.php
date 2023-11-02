
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../index.php" class="brand-link text-center">
      <span class="brand-text font-weight-light ">SIMPANANQIU</span>
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
    'profile.php' => ['icon' => 'fas fa-user', 'title' => 'Profile'],
    
   
];
$master = [
    'k_s.php' => ['icon' => 'fas fa-tag', 'title' => 'Kategori'],
    // 'aset.php' => ['icon' => 'fas fa-wallet', 'title' => 'Aset'],
   
];

?>

<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
        <a href="../dashboard/index.php" class="nav-link <?= ($current_page === 'index.php') ? 'active' : ''; ?>">
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
        <a href="../akun/akun.php" class="nav-link <?= ($current_page === 'akun.php') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-dollar-sign"></i>
            <p>
                Akun user
            </p>
        </a>
    </li>
    
    <li class="nav-item <?= (in_array($current_page, array_keys($setting))) ? 'menu-open' : ''; ?>">
        <a href="#" class="nav-link <?= (in_array($current_page, array_keys($setting))) ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-cog"></i>
            <p>
                Pengaturan
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <?php foreach ($setting as $page => $settings): ?>
    <li class="nav-item">
        <a href="../profile/<?= $page ?>" class="nav-link <?= ($current_page === $page) ? 'active' : ''; ?>">
            <i class="<?= $settings['icon'] ?> nav-icon"></i>
            <p><?= $settings['title'] ?></p>
        </a>
    </li>
    </ul>
    </li>

    <li class="nav-item">
        <a href="#" id="logoutLink" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
                Logout
            </p>
        </a>
    </li>
    
<?php endforeach; ?>

        

     

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