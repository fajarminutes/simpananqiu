<?php
// Sesuaikan dengan koneksi database Anda
include "../../koneksi.php";

// Cek apakah permintaan datang dari metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi data yang diterima
    if (empty($_POST['id_kontak'])) {
        echo "Id Kontak tidak boleh kosong.";
    } else if (empty($_POST['status'])) {
        echo "Status tidak boleh kosong.";
    } else {
        $id_kontak = mysqli_real_escape_string($koneksi, $_POST['id_kontak']);
        $status = mysqli_real_escape_string($koneksi, $_POST['status']);

        // Lanjutkan dengan query untuk mengupdate status di tabel 'kontak'
        $query = "UPDATE kontak SET status = '$status' WHERE id_kontak = '$id_kontak'";

        if (mysqli_query($koneksi, $query)) {
           echo "Status keluhan pelanggan telah diubah";
        } else {
            echo "Terjadi kesalahan saat mengupdate status keluhan: " . mysqli_error($koneksi);
        }
    }
} else {
    // Permintaan bukan dari metode POST
    echo "Permintaan tidak valid.";
}

// Tutup koneksi database
mysqli_close($koneksi);
?>
