<?php
session_start();
include '../koneksi.php';


?>

<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        if ($user['vr'] !== NULL) {
            // Jika kolom 'vr' ada datanya, maka set session 'vr'
            $_SESSION['vr'] = $user['vr'];
        } else {
            // Jika kolom 'vr' NULL atau tidak ada datanya, maka set session 'vr' menjadi NULL
            $_SESSION['vr'] = NULL;
        }

        $_SESSION['user_login'] = $user['id_user'];
        $_SESSION['user_last_activity'] = time(); // Setel waktu aktivitas terakhir

        if ($_SESSION['vr'] !== NULL) {
            $_SESSION['user_login'] = $user['id_user'];
        $_SESSION['user_last_activity'] = time(); // Setel waktu aktivitas terakhir
            header("Location: ../users/lockscreen.php"); // Jika 'vr' ada datanya, arahkan ke index.php
        } else {
            $_SESSION['user_login'] = $user['id_user'];
        $_SESSION['user_last_activity'] = time(); // Setel waktu aktivitas terakhir
            header("Location: ../users/vr/"); // Jika 'vr' NULL, arahkan ke index2.php
        }
        exit();
    } else {
        $_SESSION['error_message'] = 'Email/Password yang Anda masukkan salah.';
        header("Location: index.php");
        exit();
    }
}

?>


<!doctype html>
<html lang="en">
  <head>
  	<title>LOGIN SIMPANANQIU</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
	
	<link rel="stylesheet" href="css/style.css">
    <style>
          .toggle-password {
    position: absolute;
    top: 63%;
    right: 20px;
    transform: translateY(90%);
    transform: scale(1.5);
    cursor: pointer;
  }
    </style>
    <!-- fungsi untuk melihat mata/ buka password -->
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
    <!-- <style>
        body {
            background: url("https://images.unsplash.com/photo-1579621970588-a35d0e7ab9b6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80");
        }
    </style> -->

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Login</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(../assets/img/favicon.jpeg);">
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Selamat Datang!</h3>
			      		</div>
			      	</div>

<!-- Dibawah ini untuk hasil input dari register  -->
<?php

// Hasil Delete Account
if (isset($_SESSION['delete-account'])) {
    echo '<script>';
    echo 'Swal.fire({';
    echo '    position: "center",';
    echo '    icon: "success",';
    echo '    title: "' . $_SESSION['delete-account'] . '",';
    echo '    showConfirmButton: false,';
    echo '    timer: 3000'; //Ini 2 detik
    echo '});';
    echo '</script>';
    unset($_SESSION['delete-account']); // Hapus pesan dari session
}

// Hasil Register
if (isset($_SESSION['success_message'])) {
    echo '<script>';
    echo 'Swal.fire({';
    echo '    position: "center",';
    echo '    icon: "success",';
    echo '    title: "' . $_SESSION['success_message'] . '",';
    echo '    showConfirmButton: false,';
    echo '    timer: 3000'; //Ini 2 detik
    echo '});';
    echo '</script>';
    unset($_SESSION['success_message']); // Hapus pesan dari session
}

// Ingin Masuk ganti password tanpa mengikuti aturan yg ada
if (isset($_SESSION['sengaja_password'])) {
    echo '<script>';
    echo 'Swal.fire({';
    echo '    position: "center",';
    echo '    icon: "error",';
    echo '    title: "' . $_SESSION['sengaja_password'] . '",';
    echo '    showConfirmButton: false,';
    echo '    timer: 3000'; //Ini 2 detik
    echo '});';
    echo '</script>';
    unset($_SESSION['sengaja_password']); // Hapus pesan dari session
}

// Waktu habis karena tidak ngisi ganti password
if (isset($_SESSION['gagal_password'])) {
    echo '<script>';
    echo 'Swal.fire({';
    echo '    position: "center",';
    echo '    icon: "error",';
    echo '    title: "' . $_SESSION['gagal_password'] . '",';
    echo '    showConfirmButton: false,';
    echo '    timer: 3000'; //Ini 2 detik
    echo '});';
    echo '</script>';
    unset($_SESSION['gagal_password']); // Hapus pesan dari session
}
// Belum Login
if (isset($_SESSION['belum_login'])) {
    echo '<script>';
    echo 'Swal.fire({';
    echo '    position: "center",';
    echo '    icon: "error",';
    echo '    title: "' . $_SESSION['belum_login'] . '",';
    echo '    showConfirmButton: false,';
    echo '    timer: 3000'; //Ini 3 detik
    echo '});';
    echo '</script>';
    unset($_SESSION['belum_login']); // Hapus pesan dari session
}

// Logout
if (isset($_SESSION['logout_success'])) {
    echo '<script>';
    echo 'Swal.fire({';
    echo '    position: "center",';
    echo '    icon: "success",';
    echo '    title: "' . $_SESSION['logout_success'] . '",';
    echo '    showConfirmButton: false,';
    echo '    timer: 3000'; //Ini 3 detik
    echo '});';
    echo '</script>';
    unset($_SESSION['logout_success']); // Hapus pesan dari session
}
?>




<!-- Untuk Tampilkan ganti passoword berhasil -->
<?php
if (isset($_SESSION['authenticated_user'])) {
    echo '<script>';
    echo 'Swal.fire({';
    echo '    position: "center",';
    echo '    icon: "success",';
    echo '    title: "Berhasil ganti password. Silahkan login!",';
    echo '    showConfirmButton: false,';
    echo '    timer: 3000'; //Ini 3 Detik
    echo '});';
    echo '</script>';
    unset($_SESSION['authenticated_user']); // Hapus authenticated_user dari session
}
?>


<!-- Untuk Tampilkan ganti passoword VR berhasil -->
<?php
if (isset($_SESSION['verifikasi'])) {
    echo '<script>';
    echo 'Swal.fire({';
    echo '    position: "center",';
    echo '    icon: "success",';
    echo '    title: "Berhasil ganti password",';
    echo '    showConfirmButton: false,';
    echo '    timer: 3000'; //Ini 3 Detik
    echo '});';
    echo '</script>';
    unset($_SESSION['verifikasi']); // Hapus verifikasi dari session
}
?>

<!-- Untuk Pemberitahuan kalo data pasword/akun salah -->
<?php
if (isset($_SESSION['error_message'])) {
    echo '<script>';
    echo 'Swal.fire({';
    echo '    position: "center",';
    echo '    icon: "error",';
    echo '    title: "' . $_SESSION['error_message'] . '",';
    echo '    showConfirmButton: false,';
    echo '    timer: 3000'; //Ini 3 detik
    echo '});';
    echo '</script>';
    unset($_SESSION['error_message']); // Hapus pesan dari session
}

?>



							<form action="" class="signin-form" method="post">
			      		<div class="form-group mb-3">
			      			 <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email">
			      		</div>
		            <div class="form-group mb-3">
		            	<label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password">
                                          <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
		            </div>
					<div class="form-check form-check-inline">
  <input class="form-check-input ml-3 mb-2" type="checkbox" id="rememberMe" name="rememberMe">
            <label class="form-check-label ml-3 mb-2" for="rememberMe">Ingat Saya</label>
        
</div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
						<p>Belum punya akun? Silahkan daftar terlebih dahulu</p>

						<div>
						<div style="float:left;">
						<a href="lupa_password.php"><p>Ups, Lupa Password? Klik</p></a>
						</div>

						<div style="float:right;">
<a href="register.php"><button type="button" class=" btn btn-success rounded submit mb-3 px-3">Daftar</button></a> 
						</div>

						</div>
		            </div>
		            <!-- <div class="form-group d-md-flex">
		            	 <div class="w-50 text-left">
			            	<label class="checkbox-wrap checkbox-primary mb-0">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
										</label>
									</div>
									<div class="w-50 text-md-right">
										<a href="#">Forgot Password</a>
									</div> 
		            </div> -->
		          </form>
		          <!-- <p class="text-center">Not a member? <a data-toggle="tab" href="#signup">Sign Up</a></p> -->
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

