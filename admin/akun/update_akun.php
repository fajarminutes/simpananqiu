<?php
// Sesuaikan dengan koneksi database Anda
include "../../koneksi.php";

// Cek apakah permintaan datang dari metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi data yang diterima
    if (empty($_POST['id_user'])) {
        echo "Id User tidak boleh kosong.";
    } else if (empty($_POST['status'])) {
        echo "Status tidak boleh kosong.";
    } else {
        $id_user = mysqli_real_escape_string($koneksi, $_POST['id_user']);
        $status = mysqli_real_escape_string($koneksi, $_POST['status']);

        // Lanjutkan dengan query untuk mengupdate status di tabel 'users'
        $query = "UPDATE users SET status = '$status' WHERE id_user = '$id_user'";

        if (mysqli_query($koneksi, $query)) {
            // Lanjutkan dengan query untuk mengupdate tanggal di tabel 'premium' berdasarkan status
            if ($status == 1) {
                $query_premium = "UPDATE premium SET tgl_e = NULL WHERE id_user = '$id_user'";
            } elseif ($status == 2) {
                date_default_timezone_set('Asia/Jakarta');
                $currentDateTime = date('Y-m-d H:i:s');
                $query_premium = "UPDATE premium SET tgl_e = '$currentDateTime' WHERE id_user = '$id_user'";
            }

            if (mysqli_query($koneksi, $query_premium)) {
                echo "Status akun telah diubah";
            } else {
                echo "Terjadi kesalahan saat mengupdate tanggal premium: " . mysqli_error($koneksi);
            }
        } else {
            echo "Terjadi kesalahan saat mengupdate status akun: " . mysqli_error($koneksi);
        }
    }
} else {
    // Permintaan bukan dari metode POST
    echo "Permintaan tidak valid.";
}

// Tutup koneksi database
mysqli_close($koneksi);
?>
