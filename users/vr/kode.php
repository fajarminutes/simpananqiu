<?php 
session_start();
?>
<!-- Sweetalert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>

<?php
$id_users = $_SESSION['user_login'];

// Ambil nilai id dari parameter URL
$id_from_url = $_GET['id'];

// Misalnya, ambil id_users dari database sesuai dengan hash yang diberikan
// Gantilah ini dengan koneksi ke database dan query yang sesuai
$id_users_from_db = "Minqiu Selalu Ada Untuk Kamu"; // Gantilah dengan nilai id_users dari database

// Verifikasi apakah id yang diberikan sesuai dengan id dari database
if (password_verify($id_users_from_db, $id_from_url)) {
    // Jika cocok, tampilkan pesan selamat
  
    ?>

    <script>
  $(document).ready(function() {
    <?php if (isset($_SESSION['berhasil'])) : ?>
      Swal.fire({
        position: "center",
        icon: "success",
        title: "<?= $_SESSION['berhasil'] ?>",
        showConfirmButton: false,
        timer: 3000 // Ini 3 detik
      });
      <?php unset($_SESSION['berhasil']); // Hapus pesan dari session ?>
    <?php elseif (isset($_SESSION['gagal'])) : ?>
      Swal.fire({
        position: "center",
        icon: "error",
        title: "<?= $_SESSION['gagal'] ?>",
        showConfirmButton: false,
        timer: 3000 // Ini 3 detik
      });
      <?php unset($_SESSION['gagal']); // Hapus pesan dari session ?>
    <?php endif; ?>
  });
</script>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Verifikasi 2 Langkah</title>

 <!-- Sweetalert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">

<link rel="stylesheet" href="../dist/css/adminlte.min.css?v=3.2.0">
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.querySelector('.toggle-password');
    const passwordInput = document.querySelector(togglePassword.getAttribute('toggle'));
    
    togglePassword.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            togglePassword.classList.remove('fa-eye');
            togglePassword.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            togglePassword.classList.remove('fa-eye-slash');
            togglePassword.classList.add('fa-eye');
        }
    });
});
</script>
<style>
   .toggle-password {
    position: absolute;
    top: -10%;
    right: 5px;
    transform: translateY(90%);
    cursor: pointer;
  }
</style>
</head>
<body class="hold-transition register-page">
<div class="register-box">
<div class="register-logo">
<a href="#"><b>Verifikasi 2 Langkah</b></a>
</div>
<div class="card">
<div class="card-body register-card-body">
<p class="login-box-msg">Lakukan Verifikasi 2 Langkah</p>
<p class="login-box-msg"><b>Harap Mencatat Verifikasi 2 Langkah!</b></p>

<form action="update_kode.php" method="post">
    <input type="text" class="form-control" required name="id_users" value="<?=$id_users ?>">

<div class="input-group mb-3">
<input type="password" class="form-control" id="password" required name="vr" placeholder="Verifikasi 2 Langkah">
            <!-- <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span> -->

<div class="input-group-append">
<div class="input-group-text">
<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
</div>
</div>
</div>

<div class="row">
<div class="col-lg-12 col-sm-12">
<button type="submit" class="btn btn-primary btn-block" name="tambah">Kirim</button>
<button type="button" class="btn btn-warning btn-block mt-2" onclick="goBack()">Kembali</button>
<script>
function goBack() {
    window.history.back();
}
</script>

</div>


</div>
</form>


</div>
</div>


<script src="../plugins/jquery/jquery.min.js"></script>

<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../dist/js/adminlte.min.js?v=3.2.0"></script>
</body>
</html>
    <?php 
} else {
    // Jika tidak cocok, tampilkan pesan kesalahan atau lakukan tindakan lain
    echo "Verifikasi gagal. ID tidak valid.";
}
?>
