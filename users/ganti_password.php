
<?php 
session_start();
include '../koneksi.php';
// Periksa apakah session verifikasi dan expiration ada
if (!isset($_SESSION['verifikasi']) || !isset($_SESSION['expiration'])) {
    // Jika tidak ada, kembalikan ke halaman sebelumnya
           $_SESSION['sengaja_password'] = 'Oops, Anda gagal!';

    header("Location: ../login/");
    exit();
}

// Periksa apakah waktu kedaluwarsa sudah tercapai
if ($_SESSION['expiration'] < time()) {
    // Waktu sudah habis, unset session dan alihkan ke halaman lain
    unset($_SESSION['verifikasi']);
    unset($_SESSION['expiration']);
       $_SESSION['gagal_password'] = 'Oops, Coba Lagi!';
    header("Location: ../login/");
    exit();
}

$id_user = $_SESSION['verifikasi'];

// Jika form disubmit
if (isset($_POST['submit'])) {
    // Ambil password baru yang dimasukkan oleh pengguna
    $newPassword = $_POST['password'];

    // Hash password baru
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update password di tabel users berdasarkan id_user
    $updateQuery = "UPDATE users SET vr = '$hashedPassword' WHERE id_user = $id_user";
    mysqli_query($koneksi, $updateQuery);

    // Buat session untuk tampilkan notifikasi di login
    $id_user = $_SESSION['verifikasi'];

    // Redirect pengguna ke halaman lain jika diperlukan
    header("Location: lockscreen.php");
    exit();
}

?>


<!doctype html>
<html lang="en">
  <head>
  	<title> Ganti Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
	
	<link rel="stylesheet" href="../login/css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Ganti Password Verifikasi 2 Langkah </h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(https://images.unsplash.com/photo-1670836037273-1da88ca47acd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1030&q=80);">
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Ganti Password Verifikasi 2 Langkah</h3>
			      		</div>
			      	</div>
 <script>
        // Fungsi untuk menghitung mundur waktu
        function startCountdown() {
            var seconds = 120; // Waktu awal dalam detik
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


							<form action="" class="signin-form" method="post">
			      		<p style="color:red;">Lakukan ganti password secepatnya!</p>
			      		 <p style="color:red;">Sisa waktu: <span id="countdown">120</span></p>
		            <div class="form-group mb-3">
		            	<label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password">
		            </div>
					
		            <div class="form-group">
		            	<button type="submit" name="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
						

						
		            </div>
		        
		          </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

  <script src="../login/js/jquery.min.js"></script>
  <script src="../login/js/popper.js"></script>
  <script src="../login/js/bootstrap.min.js"></script>
  <script src="../login/js/main.js"></script>

	</body>
</html>


