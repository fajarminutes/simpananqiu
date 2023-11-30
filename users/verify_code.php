<?php 
session_start();
include '../koneksi.php';

// Periksa apakah session user_verifikasi verifikasi ada
if (!isset($_SESSION['user_verifikasi'])) {
    // Jika tidak ada, kembalikan ke halaman lupa_password.php
           $_SESSION['sengaja_password'] = 'Oops, Anda gagal!';
    header("Location: ../login/index.php");
    exit();
}
// Periksa apakah waktu kedaluwarsa sudah tercapai
if ($_SESSION['verify'] < time()) {
    // Waktu sudah habis, unset session dan alihkan ke halaman lain
   unset($_SESSION['user_verifikasi']);
        
    unset($_SESSION['verify']);
    header("Location: ../login/index.php");
    exit();
}
$id_user = $_SESSION['user_verifikasi'];

// Tampil datanya hanya satu, tapi yg terbaru
$query = mysqli_query($koneksi, "SELECT * FROM ganti_password WHERE id_user = $id_user ORDER BY id_password DESC LIMIT 1");
while($ambil = mysqli_fetch_array($query)) :
    // Untuk menampilkan data terbaru
    $kodeVerifikasiTerbaru = $ambil['kode'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userVerificationCode = $_POST['text'];
    if ($userVerificationCode == $kodeVerifikasiTerbaru) {
        // Hapus data dari tabel ganti_password berdasarkan id_user
        mysqli_query($koneksi, "DELETE FROM ganti_password WHERE id_user = $id_user");

           // Waktu kedaluwarsa dalam detik (contoh: 2 menit)
$expiration = time() + 12; // 120 detik
          // Simpan id_user ke dalam session untuk digunakan di halaman selanjutnya
        $_SESSION['verifikasi'] = $id_user;
     
$_SESSION['expiration'] = $expiration;

        
        // Alihkan pengguna ke halaman selanjutnya tanpa menampilkan id_user di URL
        header("Location: ganti_password.php");
        exit();
    } else {
        // Kode verifikasi tidak cocok, tampilkan pesan error
        $error_message = 'Kode verifikasi yang dimasukkan salah.';
    }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            background-color: #f7f7f7;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
       
        .card-header {
            background-color: #007bff;
            color: white;
            text-align: center;
            border-radius: 10px 10px 0 0;
            padding: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .card-footer {
            background-color: white;
            text-align: center;
            border-radius: 0 0 10px 10px;
            padding: 20px;
        }
      
    .fade-out {
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }
   </style>
  <script>
        // Fungsi untuk menghitung mundur waktu
        function startCountdown() {
            var seconds = 300; // Waktu awal dalam detik
            var countdownElem = document.getElementById("countdown");

            var countdownInterval = setInterval(function() {
                seconds--;

                // Perbaharui tampilan countdown
                countdownElem.textContent = seconds + " detik";

                // Hentikan interval jika waktu sudah habis
                if (seconds <= 0) {
                    clearInterval(countdownInterval);
                    countdownElem.textContent = "Waktu habis!";
                    
                    // Paksa keluar dari halaman setelah waktu habis
                    setTimeout(function() {
                        window.location.href = "gagal.php"; // Ganti dengan URL halaman tujuan
                    }, 2000); // Waktu tunggu sebelum mengarahkan (dalam milidetik)
                }
            }, 1000); // Setiap 1 detik (1000 ms)
        }

        // Panggil fungsi startCountdown saat halaman dimuat
        window.onload = startCountdown;
    </script>

</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Lupa Password</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-4">Masukkan kode verifikasi Anda untuk mereset password.</p>
  <p style="color:red; text-align:center;">Peringatan Anda, harus memasukkan kode verifikasi secepatnya!</p>
   <p style="color:red; text-align:center;">Sisa waktu: <span id="countdown">300</span></p>
    <?php
    if (isset($error_message)) {
        echo '<p style="color: red;">' . $error_message . '</p>';
    }
    ?>
   
    <!-- <p style="text-align:center;">Kode Verifikasi <br><span style="font-weight:bold;letter-spacing:10px;"> <?= $kodeVerifikasiTerbaru ?></span></p> -->
    <?php endwhile; ?>
    
  <form action="" method="post">
                            <div class="mb-3">
                                <label for="text" class="form-label">Kode Verifikasi</label>
                                <input type="text" class="form-control" style="letter-spacing: 10px;" id="text" name="text" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Kirim Permintaan Reset Password</button>
                        </form>
                    </div>
                    

      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
