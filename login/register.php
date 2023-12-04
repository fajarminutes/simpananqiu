

<?php
include '../koneksi.php';



   // Tambah Data Register
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    // Validasi input
    $errors = [];

     if (empty($_POST['nama'])) {
        $errors[] = 'nama tidak boleh kosong';
    } else {
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    }

     if (empty($_POST['username'])) {
        $errors[] = 'username tidak boleh kosong';
    } else {
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
$username = strtolower($username);
    }

    if (empty($_POST['jenis_kelamin'])) {
        $errors[] = 'jenis_kelamin tidak boleh kosong';
    } else {
        $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    }

    if (empty($_POST['nohp'])) {
        $errors[] = 'nohp Regu tidak boleh kosong';
    } else {
        $nohp = mysqli_real_escape_string($koneksi, $_POST['nohp']);
    }

    if (empty($_POST['email'])) {
        $errors[] = 'email Petugas tidak boleh kosong';
    } else {
        $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    }

    if (empty($_POST['password'])) {
        $errors[] = 'password Petugas tidak boleh kosong';
    } else {
        $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    }

    // Lakukan hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
       

    $gambarDir = "../data/img/users/"; // Direktori penyimpanan gambar
         $gambar = $_FILES['gambar']['name'];
    $gambarTmp = $_FILES['gambar']['tmp_name'];
    $gambarSize = $_FILES['gambar']['size'];
    $gambarExt = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));
    $gambarName = time() . '_' . $gambar;
     move_uploaded_file($gambarTmp, $gambarDir . $gambarName);

   if (empty($errors)) {
    // Query untuk insert data ke dalam tabel "area"
   // Mengambil tanggal dan waktu saat ini dalam format datetime
date_default_timezone_set('Asia/Jakarta'); // Set zona waktu ke Indonesia

$currentDateTime = date('Y-m-d H:i:s');

$query = "INSERT INTO users (nama_user, username, gender, no_hp, email, password, foto, tgl_b, status, vr) VALUES ('$nama', '$username', '$jenis_kelamin', '$nohp', '$email',  '$hashedPassword', '$gambarName', '$currentDateTime', 1, NULL)";

// Eksekusi query untuk "area"
if (mysqli_query($koneksi, $query)) {
    // Berhasil ditambahkan
    session_start();
    $_SESSION['success_message'] = 'Selamat, Pendaftaran Berhasil. Silahkan Login!';
    header("Location: index.php");
    exit();
} else {
    // Terjadi kesalahan saat eksekusi query "area"
    session_start();
    $_SESSION['error_message'] = 'Terjadi kesalahan saat menambahkan data ke tabel "area": ' . mysqli_error($koneksi);
    header("Location: index.php");
    exit();
}
} else {
    // Terdapat error validasi input
    foreach ($errors as $error) {
        echo $error . '<br>';
    }
}

}
   ?>

<html lang="en">
  <head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Sweetalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


	<link rel="stylesheet" href="css/style.css">
    
    <title>Halaman Register</title>
    <!-- Link ke Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Link ke Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Style untuk formulir -->
    <style>
        /* Gaya CSS Anda di sini */
        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
        }
         .my-swal-popup {
    font-size: 18px;
    width: 500px;
  }
  .my-swal-title {
    font-size: 24px;
  }
  .my-swal-content {
    font-size: 16px;
  }
    </style>
   <script>
   
// Cek username jika ada di database maka tombol nya dihilangkan, jika tidak ada maka tampilkan tombol

function checkUsernameAvailability() {
    var username = document.getElementById("username").value;
    var nama = document.getElementById("nama").value;

    var nextButtonContainer = document.getElementById("nextButtonContainer");
    var warningMessage = document.getElementById("warningMessage");

    if (username && nama) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'check_username.php?username=' + username, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    if (response === "exists") {
                        nextButtonContainer.style.display = "none";
                        warningMessage.textContent = "Gagal.";
                        warningMessage.style.display = "block";
                    } else {
                        nextButtonContainer.style.display = "block";
                        warningMessage.style.display = "none";
                    }
                }
            }
        };

        xhr.send();
    } else {
        nextButtonContainer.style.display = "none";
        warningMessage.textContent = "Silahkan isi data terlebih dahulu.";
        warningMessage.style.display = "block";
    }
}

// Fungsi yang dijalankan saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    checkUsernameAvailability();
});


// Cek email jika ada di database maka tombol nya dihilangkan, jika tidak ada maka tampilkan tombol
      function checkemail() {
        var email = document.getElementById("email").value;

        // Kirim permintaan AJAX ke file PHP yang telah dibuat
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'check_email.php?email=' + email, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    if (response === "exists") {
                        document.getElementById("tombol").style.display = "none";
                        document.getElementById("warning").style.display = "block";
                    } else {
                        document.getElementById("tombol").style.display = "block";
                        document.getElementById("warning").style.display = "none";
                    }
                }
            }
        };

        xhr.send();
    }
</script>
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Register</h2>
                  
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                      <div class="img" id="imgPreview" style="background-image: url(https://images.unsplash.com/photo-1579621970795-87facc2f976d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80);"></div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Register</h3>
                                </div>
                            </div>
                             <form action="" class="signin-form" method="post" enctype="multipart/form-data">
                                <div class="form-step step-1 active">
                                    <div class="form-group mb-3">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="nama" id="nama">
                                    </div>
                                    <div class="form-group mb-3">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" id="username" onkeyup="checkUsernameAvailability()">
</div>
<div class="form-group mb-3" id="nextButtonContainer" style="display: none;">
    <button type="button" class="form-control btn btn-primary rounded submit px-3" onclick="nextStep(1)">Selanjutnya</button>
</div>
<p id="warningMessage" style="display: none; color: red;"></p>



                                        <p>Sudah punya akun? Silahkan login</p>
                                        <div>
						<div style="float:left;">
						
						</div>

						<div style="float:right;">
<a href="index.php"><button type="button" class=" btn btn-success rounded submit mb-3 px-3">Login</button></a> 
						</div>

						</div>
                                    </div>
                                
                              <div class="form-step step-2">
    <label for="jenis_kelamin">Pilih Salah Satu:</label><br>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="Laki-Laki" onclick="checkInputValues(2)">
        <label class="form-check-label" for="laki">Laki-Laki</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" onclick="checkInputValues(2)">
        <label class="form-check-label" for="perempuan">Perempuan</label>
    </div>
    <div class="form-group mb-3">
        <label for="nohp">No. Hp</label>
        <input type="number" class="form-control" name="nohp" id="nohp" oninput="checkInputValues(2)">
    </div>
    <p id="nohpWarning" style="display: none; color: red;">Nomor Hp tidak terdeteksi.</p>
    <p id="warningMessageStep2" style="display: none; color: red;">Silahkan isi data terlebih dahulu.</p>
    <div class="form-group mb-3" id="nextButtonContainerStep2" style="display: none;">
        <button type="button" class="form-control btn btn-primary rounded submit px-3" onclick="nextStep(2)">Selanjutnya</button>
    </div>
</div>

<script>
    // Fungsi cek inputan, apakah sudah disi atau belom
function checkInputValues(step) {
    var nohp = document.getElementById("nohp").value;
    var jenisKelamin = document.querySelector('input[name="jenis_kelamin"]:checked');

    var nextButtonContainer = document.getElementById("nextButtonContainerStep" + step);
    var warningMessage = document.getElementById("warningMessageStep2");
    var nohpWarning = document.getElementById("nohpWarning");

    if (nohp.length >= 12 && jenisKelamin) {
        nextButtonContainer.style.display = "block";
        warningMessage.style.display = "none";
        nohpWarning.style.display = "none";
    } else if (nohp.length < 12) {
        nextButtonContainer.style.display = "none";
        warningMessage.style.display = "none";
        nohpWarning.style.display = "block";
    } else {
        nextButtonContainer.style.display = "none";
        warningMessage.style.display = "block";
        nohpWarning.style.display = "none";
    }
}
</script>


                                <div class="form-step step-3">
                                  <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" required id="email" onkeyup="checkemail()">
                                        <!-- style ini untuk mata password berada di samping kanan -->
										  <style>
  .input-container {
    position: relative;
  }
  
  .toggle-password {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
  }
</style>

<label for="password">Password</label>
<div class="input-container">
  <input type="password" class="form-control" required name="password" id="password">
  <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
</div>

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

                                    <div class="form-group mb-3">
                                      <label for="fileInput">Foto</label>
<input type="file" class="form-control-file" id="fileInput" name="gambar" required onchange="validateAndPreviewImage()">
<span id="validationMessage" style="color: red;"></span>
                                    </div>
                                    <div class="form-group mb-3">
                                        
                                        <button type="submit" id="tombol" name="tambah" class="form-control btn btn-primary rounded submit px-3">Tambah</button>
                                        <p id="warning" style="display: none; color: red;">Gagal.</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	
</script>
 <script>
	
    // fungsi untuk cek apakah gambar atau dokumen 
function validateAndPreviewImage() {
    const allowedExtensions = ["jpg", "jpeg", "png"];
    const fileInput = document.getElementById("fileInput");
    const imgPreview = document.getElementById('imgPreview');

    if (fileInput.files.length > 0) {
        const selectedFile = fileInput.files[0];
        const fileName = selectedFile.name;
        const fileExtension = fileName.split('.').pop().toLowerCase();

        if (allowedExtensions.includes(fileExtension)) {
            // File extension is allowed, you can proceed with previewImage()
            previewImage();
            document.getElementById("validationMessage").textContent = "";
        } else {
            // File extension is not allowed, show SweetAlert error message
            Swal.fire({
              position: 'center',
  icon: 'error',
  title: 'File harus berupa JPG, JPEG, atau PNG.',
  showConfirmButton: false,
  timer: 3000,
            });
            fileInput.value = ""; // Clear the selected file
            imgPreview.style.backgroundImage = "";
        }
    } else {
        imgPreview.style.backgroundImage = "";
        document.getElementById("validationMessage").textContent = "";
    }
}

// fungsi ganti gambar
function previewImage() {
    const fileInput = document.getElementById('fileInput');
    const imgPreview = document.getElementById('imgPreview');

    const file = fileInput.files[0];
    const reader = new FileReader();

    reader.onloadend = function () {
        imgPreview.style.backgroundImage = `url('${reader.result}')`;
    };

    if (file) {
        reader.readAsDataURL(file);
    }
}
	// Next untuk input data 

        function nextStep(step) {
            document.querySelector('.step-' + step).classList.remove('active');
            document.querySelector('.step-' + (step + 1)).classList.add('active');
        }

        function prevStep(step) {
            document.querySelector('.step-' + step).classList.remove('active');
            document.querySelector('.step-' + (step - 1)).classList.add('active');
        }
    </script>
</body>
</html>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

