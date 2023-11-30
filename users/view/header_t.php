<?php 
include "session.php";
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
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- pace-progress -->
  <link rel="stylesheet" href="../plugins/pace-progress/themes/black/pace-theme-flat-top.css">
   <!-- daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
   <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
   <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../plugins/dropzone/min/dropzone.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


   <!-- Favicons -->
  <link href="../dist/img/favicon.jpeg" rel="icon">
  <link href="../dist/img/favicon.jpeg" rel="apple-touch-icon">

  
    <!-- SweetAlert2 -->
  <!-- <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css"> -->
  <!-- Toastr -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">


<?php 
// Query database untuk memeriksa nilai 'status' dari tabel 'users' untuk pengguna saat ini
$query = "SELECT status FROM users WHERE id_user = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "i", $id_users); // Ganti "i" dengan tipe data yang sesuai
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if ($user['status'] == 1) {
    // Tampilkan peringatan SweetAlert hanya jika 'status' adalah 1 (misalnya, pengguna belum premium)
    echo "<script>
    function tampilkanIklan() {
      Swal.fire({
        title: 'Oops!',
        text: 'Anda Belum Premium!',
        imageUrl: '../../assets/img/promo.png',
        imageWidth: 300,
        imageHeight: 300,
        imageAlt: 'Custom image',
      });
    }

    // Menampilkan SweetAlert pertama kali setelah halaman dimuat
    setTimeout(tampilkanIklan, 120000); // Show the alert after 1 minute

    // Membuat interval untuk menampilkan SweetAlert setiap 1 menit
    setInterval(tampilkanIklan, 120000); // Show the alert every minute
    </script>";
}

?>


  
  <style>

    .badge_own {
        display: inline-block;
        padding: 0.25em 0.5em;
        font-size: 80%;
        font-weight: bold;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
    }

    /* Warna latar belakang dan teks sesuai kebutuhan Anda */
     .text-bg-warning_own {
        background-color: #ffc107;
        color: #212529;
    }

    .text-bg-success_own {
        background-color: #28a745;
        color: #fff;
    }

body{
    background:#eee;
}

/* ===== PRICING PAGE ===== */
.price-tabs {
  background-color: #fff;
  -webkit-box-shadow: 0 5px 20px 0 rgba(39, 39, 39, 0.1);
          box-shadow: 0 5px 20px 0 rgba(39, 39, 39, 0.1);
  display: inline-block;
  padding: 7px;
  border-radius: 40px;
  border: 1px solid #00b5ec;
  margin-bottom: 45px;
}

@media (min-width: 768px) {
  .price-tabs {
    margin-bottom: 60px;
  }
}

.price-tabs .nav-link {
  color: #00b5ec;
  font-weight: 500;
  font-family: "Montserrat", sans-serif;
  font-size: 16px;
  padding: 12px 35px;
  display: inline-block;
  text-transform: capitalize;
  border-radius: 40px;
  -webkit-transition: all 0.3s ease;
  transition: all 0.3s ease;
}

@media (min-width: 768px) {
  .price-tabs .nav-link {
    padding: 12px 40px;
  }
}

.price-tabs .nav-link.active {
  background-color: #00b5ec;
  color: #fff;
}

.price-item {
  background-color: #fff;
  -webkit-box-shadow: 0 5px 30px 0 rgba(39, 39, 39, 0.15);
          box-shadow: 0 5px 30px 0 rgba(39, 39, 39, 0.15);
  border-radius: 10px;
}

@media (min-width: 768px) {
  .price-item {
    margin: 0 20px;
    padding-top: 20px;
  }
}

.price-item .price-top {
  -webkit-box-shadow: 0 5px 30px 0 rgba(39, 39, 39, 0.15);
          box-shadow: 0 5px 30px 0 rgba(39, 39, 39, 0.15);
  padding: 50px 0 25px;
  background-color: #00b5ec;
  border-radius: 10px;
  position: relative;
  z-index: 0;
  margin-bottom: 33px;
}

@media (min-width: 768px) {
  .price-item .price-top {
    margin: 0 -20px;
    border-radius: 20px;
  }
}

.price-item .price-top:after {
  height: 50px;
  width: 100%;
  border-radius: 0 0 10px 10px;
  background-color: #00b5ec;
  position: absolute;
  content: '';
  left: 0;
  bottom: -17px;
  z-index: -1;
  -webkit-transform: skewY(5deg);
          transform: skewY(5deg);
  -webkit-box-shadow: 0 5px 10px 0 rgba(113, 113, 113, 0.15);
          box-shadow: 0 5px 10px 0 rgba(113, 113, 113, 0.15);
}

@media (min-width: 768px) {
  .price-item .price-top:after {
    border-radius: 0 0 20px 20px;
  }
}

.price-item .price-top * {
  color: #fff;
}

.price-item .price-top h2 {
  font-weight: 700;
}

.price-item .price-top h2 sup {
  top: 13px;
  left: -5px;
  font-size: 0.35em;
  font-weight: 500;
  vertical-align: top;
}

.price-item .price-content {
  padding: 30px;
  padding-bottom: 40px;
}

.price-item .price-content li {
  position: relative;
  margin-bottom: 15px;
  margin-left: 10px;
  margin-right: 10px;
  text-align: center;
}

@media (min-width: 992px) {
  .price-item .price-content li {
    padding-left: 28px;
    text-align: left;
  }
}

@media (min-width: 992px) {
  .price-item .price-content li i {
    position: absolute;
    left: 0;
    top: 3px;
  }
}

.price-item .price-content .zmdi-check {
  color: #28a745;
}

.price-item .price-content .zmdi-close {
  color: #f00;
}

.popular {
  background-color: #00b5ec;
}

.popular .price-top {
  background-color: #fff;
}

.popular .price-top:after {
  background-color: #fff;
}

.popular .price-top h4 {
  color: #101f41;
}

.popular .price-top h2, .popular .price-top span, .popular .price-top sup {
  color: #00b5ec;
}

.popular .price-content ul *,
.popular .price-content ul .zmdi-close, .popular .price-content ul .zmdi-check {
  color: #fff !important;
}

/* Menghilangkan titik pada daftar */
    .premium-list {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    /* Menambahkan spasi pada setiap item daftar */
    .premium-list li {
        margin-bottom: 10px;
    }

    .profile-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
}


 .input-container {
    position: relative;
  }
  
  .toggle-password {
    position: absolute;
    top: 30%;
    right: 30px;
    transform: translateY(90%);
    transform: scale(1.5);
    cursor: pointer;
  }

   .toggle-password2 {
    position: absolute;
    top: 30%;
    right: 30px;
    transform: translateY(90%);
    transform: scale(1.5);
    cursor: pointer;
  }
  
  
/* CSS untuk tampilan gambar */
.custom-modal-content {
  text-align: center;
}

/* CSS untuk tombol tutup */
.custom-modal-close-button {
  background-color: transparent;
  border: none;
  color: #000;
  position: absolute;
  top: 10px;
  right: 10px;
}


    .floating-icon {
  position: fixed;
  bottom: 85px; /* Jarak dari bawah halaman */
  right: 20px; /* Jarak dari sisi kanan halaman */
  z-index: 999; /* Layer di atas elemen lain */
}


.clickable {
  cursor: pointer;
  transition: background-color 0.9s;
}

.clickable:hover {
  background-color: grey;
   color:white;
}



.modal.modal-bottom .modal-dialog {
  position: fixed;
  bottom: -100%;
  left: 0;
  right: 0;
  margin: 0;
  transition: bottom 0.5s;
}

.modal.modal-bottom.show .modal-dialog {
  bottom: 0;
}
/* CSS untuk modal di layar yang lebih kecil (contohnya, lebar kurang dari 768px) */
@media (max-width: 768px) {
  .modal.modal-bottom .modal-dialog {
    bottom: -100%;
  }
  #previewImage {
    width: 200px;
    height: 200px;
    margin-bottom: 10px;
  }
   #previewImage_p {
    width: 200px;
    height: 200px;
    margin-bottom: 10px;
  }
}

/* CSS untuk modal di layar yang lebih besar */
@media (min-width: 768px) {
  .modal.modal-bottom .modal-dialog {
    bottom: -100%;
  }
}


.circle {
  background-color: #007BFF; /* Warna latar belakang lingkaran */
  width: 50px; /* Lebar lingkaran */
  height: 50px; /* Tinggi lingkaran */
  border-radius: 50%; /* Membuat lingkaran */
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); /* Efek bayangan */
  cursor: pointer; /* Mengubah kursor saat diarahkan ke ikon */
}

.circle i {
  color: white; /* Warna ikon */
  font-size: 24px; /* Ukuran ikon */
}
/* Ganti ukuran tampilan saat lebar layar kurang dari 768px (tampilan mobile) */
@media (max-width: 768px) {
  .floating-icon {
    display: block; /* Tampilkan ikon plus */
  }
}

/* Gantilah ukuran tampilan saat lebar layar lebih dari atau sama dengan 768px (tampilan desktop) */
@media (min-width: 768px) {
  .floating-icon {
    display: none; /* Sembunyikan ikon plus */
  }
}
  /* Tampilkan tombol hanya saat lebar layar >= 768px */
    @media screen and (max-width: 768px) {
        #tombol {
            display: none; /* Tampilkan tombol saat lebar layar >= 768px, dan mobile tidak ada tombolnya */
        }
    }
    
  </style>
</head>
<body class="hold-transition sidebar-mini pace-primary">
<div class="wrapper">


 <?php
// Menentukan halaman saat ini
$current_page = basename($_SERVER['PHP_SELF']);

// Periksa apakah halaman saat ini bukan transaksi.php atau update.php
if ($current_page !== 'transaksi.php' && $current_page !== 'update.php') {
    // Tampilkan preloader.
    ?>
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="../dist/img/favicon.png" alt="Logo SimpananQiu" height="200" width="200">
    </div>
    <?php
}
?>
