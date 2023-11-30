<?php
session_start();
// Koneksi ke database
include '../koneksi.php';

// $id_pengguna = $_SESSION['user_verifikasi'];

// Eksekusi jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data email dari form
    $email = $_POST['email'];

    // Cari email di database
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($koneksi, $query);
    $pengguna = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {
        // Email ditemukan, lanjutkan dengan proses reset password
        $_SESSION['user_verifikasi'] = $pengguna['id_user'];

             // Generate dan simpan kode verifikasi 6 digit ke dalam session
        $verificationCode = rand(100000, 999999);
        $_SESSION['verification_code'] = $verificationCode;

        // Simpan juga email pengguna untuk validasi
        $email = $pengguna['email'];
        $_SESSION['verification_email'] = $email;

        // Waktu kedaluwarsa dalam detik (contoh: 5 menit)
        $verify = time() + 300; // 300 detik
        $_SESSION['verify'] = $verify;

        // Simpan data di tabel ganti_password dengan id_user dari tabel users
        $id_user = $pengguna['id_user'];
        $insertQuery = "INSERT INTO ganti_password (id_user, kode) VALUES ('$id_user', '$verificationCode')";
        mysqli_query($koneksi, $insertQuery);
    
         $query = mysqli_query($koneksi, "SELECT * FROM ganti_password WHERE id_user = $id_user ORDER BY id_password DESC LIMIT 1");
$ambil = mysqli_fetch_array($query);

$to = $pengguna['email'];
$subject = 'Kode Verifikasi';
$message = $ambil['kode'];


include 'send_email.php'; // Include file send_email.php untuk mengirim email

header("Location: verify_code.php"); // Jika 'vr' ada datanya, arahkan ke index.php
exit();
       
    } else {
        // Email tidak ditemukan, tampilkan pesan error menggunakan notifikasi bawaan dari PHP
        $_SESSION['error_message'] = 'Email yang Anda masukkan tidak terdaftar di sistem.';
        header("Location: lupa_password.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        <p class="text-muted mb-4">Masukkan alamat email Anda untuk mereset password.</p>
              


                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Kirim Permintaan Reset Password</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <a href="index.php">Kembali ke halaman login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <?php
if (isset($_SESSION['error_message'])) {
    echo '<script>';
    echo 'Swal.fire({';
    echo '    position: "center",';
    echo '    icon: "error",';
    echo '    title: "' . $_SESSION['error_message'] . '",';
    echo '    showConfirmButton: false,';
    echo '    timer: 2000'; //Ini 2 detik
    echo '});';
    echo '</script>';
    unset($_SESSION['error_message']); // Hapus pesan dari session
}


if (isset($_SESSION['y'])) {
    echo '<script>';
    echo 'Swal.fire({';
    echo '    position: "center",';
    echo '    icon: "error",';
    echo '    title: "' . $_SESSION['y'] . '",';
    echo '    showConfirmButton: false,';
    echo '    timer: 2000'; //Ini 2 detik
    echo '});';
    echo '</script>';
    unset($_SESSION['y']); // Hapus pesan dari session
}

// 
?>
</body>

</html>
