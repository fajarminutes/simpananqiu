<!-- kode.php -->
<?php
session_start(); // Pastikan sesi sudah dimulai
include "../../koneksi.php";

// Tambah Data Verifikasi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    // Validasi input
    $errors = [];

    if (empty($_POST['id_users'])) {
        $errors[] = 'id_users tidak boleh kosong';
    } else {
        $id_users = $_POST['id_users'];
    }

    if (empty($_POST['vr'])) {
        $errors[] = 'vr tidak boleh kosong';
    } else {
        $vr = mysqli_real_escape_string($koneksi, $_POST['vr']);
    }

    // Lakukan hash password
    $hashedPassword = password_hash($vr, PASSWORD_DEFAULT);

    if (empty($errors)) {
        // Query untuk mengupdate data di tabel "users"
        // Mengambil tanggal dan waktu saat ini dalam format datetime
        date_default_timezone_set('Asia/Jakarta'); // Set zona waktu ke Indonesia
        $currentDateTime = date('Y-m-d H:i:s');

        $query = "UPDATE users SET tgl_e = '$currentDateTime', vr = '$hashedPassword' WHERE id_user = '$id_users'";

        // Eksekusi query untuk "users"
        if (mysqli_query($koneksi, $query)) {
           $query = "SELECT * FROM users WHERE id_user = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_user);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($vr, $user['vr'])) {
            $_SESSION['user_login'] = $user['id_user'];
            $_SESSION['status_vr'] = $user['vr'];
        $_SESSION['user_last_activity'] = time(); // Setel waktu aktivitas terakhir
            header("Location: ../"); // Jika 'vr' ada datanya, arahkan ke index.php
    } else {
         // Terjadi kesalahan saat eksekusi query "users"
            $_SESSION['gagal'] = 'Terjadi kesalahan saat mengupdate data di tabel "users": ' . mysqli_error($koneksi);
            header("Location: index.php");
            exit();
    }
        } else {
            // Terjadi kesalahan saat eksekusi query "users"
            $_SESSION['gagal'] = 'Terjadi kesalahan saat mengupdate data di tabel "users": ' . mysqli_error($koneksi);
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

// Sweetalert2