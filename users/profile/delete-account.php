<?php
include "../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_users = $_POST['id']; // Dapatkan ID users yang akan dihapus

    // Hapus gambar dari tabel users
    $queryGetFoto = "SELECT foto FROM users WHERE id_user = ?";
    $stmtGetFoto = mysqli_prepare($koneksi, $queryGetFoto);
    mysqli_stmt_bind_param($stmtGetFoto, "i", $id_users);
    mysqli_stmt_execute($stmtGetFoto);
    mysqli_stmt_store_result($stmtGetFoto);

    if (mysqli_stmt_num_rows($stmtGetFoto) > 0) {
        mysqli_stmt_bind_result($stmtGetFoto, $foto);
        mysqli_stmt_fetch($stmtGetFoto);

        // Hapus file gambar dari sistem file
        if (!empty($foto) && file_exists("../../data/img/users/$foto")) {
            unlink("../../data/img/users/$foto");
        }
    }

     // Periksa apakah status pengguna dengan id_user yang sesuai adalah 0
$statusQuery = "SELECT * FROM users WHERE id_user = '$id_users'";
$statusResult = mysqli_query($koneksi, $statusQuery);
$users = mysqli_fetch_assoc($statusResult);

$to = $users['email'];
$subject = 'Tentang Akun Anda';
$nama = $users['nama_user'];
$username = $users['username'];
$kelamin = $users['gender'];
$hp = $users['no_hp'];
$tgl_b = date('d F Y', strtotime($users['tgl_b']));
$status = $users['status'] !== '1' ? 'Premium' : 'Tidak Premium';

include 'send_email.php'; // Include file send_email.php untuk mengirim email


    // Gunakan prepared statement untuk menghindari serangan SQL Injection
    $queryDeleteUser = "DELETE FROM users WHERE id_user = ?";
    $stmtDeleteUser = mysqli_prepare($koneksi, $queryDeleteUser);
    mysqli_stmt_bind_param($stmtDeleteUser, "i", $id_users);

    if (mysqli_stmt_execute($stmtDeleteUser)) {
        // Hapus gambar dari tabel transaksi
        $queryGetGambarTransaksi = "SELECT deskripsi FROM keuangan WHERE id_user = ?";
        $stmtGetGambarTransaksi = mysqli_prepare($koneksi, $queryGetGambarTransaksi);
        mysqli_stmt_bind_param($stmtGetGambarTransaksi, "i", $id_users);
        mysqli_stmt_execute($stmtGetGambarTransaksi);
        mysqli_stmt_store_result($stmtGetGambarTransaksi);

        if (mysqli_stmt_num_rows($stmtGetGambarTransaksi) > 0) {
            mysqli_stmt_bind_result($stmtGetGambarTransaksi, $gambarTransaksi);
            while (mysqli_stmt_fetch($stmtGetGambarTransaksi)) {
                // Hapus file gambar dari sistem file
                if (!empty($gambarTransaksi) && file_exists("../../data/img/transaksi/$gambarTransaksi")) {
                    unlink("../../data/img/transaksi/$gambarTransaksi");
                }
            }
        }

         // Hapus gambar dari tabel premium
        $queryGetGambarPremium = "SELECT bukti FROM premium WHERE id_user = ?";
        $stmtGetGambarPremium = mysqli_prepare($koneksi, $queryGetGambarPremium);
        mysqli_stmt_bind_param($stmtGetGambarPremium, "i", $id_users);
        mysqli_stmt_execute($stmtGetGambarPremium);
        mysqli_stmt_store_result($stmtGetGambarPremium);

        if (mysqli_stmt_num_rows($stmtGetGambarPremium) > 0) {
            mysqli_stmt_bind_result($stmtGetGambarPremium, $gambarPremium);
            while (mysqli_stmt_fetch($stmtGetGambarPremium)) {
                // Hapus file gambar dari sistem file
                if (!empty($gambarPremium) && file_exists("../../data/img/premium/$gambarPremium")) {
                    unlink("../../data/img/premium/$gambarPremium");
                }
            }
        }


        

        // Hapus gambar dari tabel tabungan
        $queryGetGambarTabungan = "SELECT gambar, id_tabungan FROM tabungan WHERE id_user = ?";
        $stmtGetGambarTabungan = mysqli_prepare($koneksi, $queryGetGambarTabungan);
        mysqli_stmt_bind_param($stmtGetGambarTabungan, "i", $id_users);
        mysqli_stmt_execute($stmtGetGambarTabungan);
        mysqli_stmt_store_result($stmtGetGambarTabungan);

        if (mysqli_stmt_num_rows($stmtGetGambarTabungan) > 0) {
            mysqli_stmt_bind_result($stmtGetGambarTabungan, $gambarTabungan, $id_tabungan);
            while (mysqli_stmt_fetch($stmtGetGambarTabungan)) {
                // Hapus file gambar dari sistem file
                if (!empty($gambarTabungan) && file_exists("../../data/img/tabungan/$gambarTabungan")) {
                    unlink("../../data/img/tabungan/$gambarTabungan");
                }

                // Hapus catat_tabungan berdasarkan id_tabungan
                $queryDeleteCatatTabungan = "DELETE FROM catat_tabungan WHERE id_tabungan = ?";
                $stmtDeleteCatatTabungan = mysqli_prepare($koneksi, $queryDeleteCatatTabungan);
                mysqli_stmt_bind_param($stmtDeleteCatatTabungan, "i", $id_tabungan);
                mysqli_stmt_execute($stmtDeleteCatatTabungan);
            }
        }

        // Hapus data dari tabel lain yang terkait
        $tablesToDelete = array("kategori", "kontak", "premium", "keuangan", "tabungan", "aset");
        foreach ($tablesToDelete as $table) {
            $queryDeleteTable = "DELETE FROM $table WHERE id_user = ?";
            $stmtDeleteTable = mysqli_prepare($koneksi, $queryDeleteTable);
            mysqli_stmt_bind_param($stmtDeleteTable, "i", $id_users);

            if (mysqli_stmt_execute($stmtDeleteTable)) {
                // Jika tabel adalah tabungan, hapus juga catat_tabungan berdasarkan id_tabungan
                if ($table === "tabungan") {
                    $queryGetIdTabungan = "SELECT id_tabungan FROM $table WHERE id_user = ?";
                    $stmtGetIdTabungan = mysqli_prepare($koneksi, $queryGetIdTabungan);
                    mysqli_stmt_bind_param($stmtGetIdTabungan, "i", $id_users);
                    mysqli_stmt_execute($stmtGetIdTabungan);
                    mysqli_stmt_store_result($stmtGetIdTabungan);

                    if (mysqli_stmt_num_rows($stmtGetIdTabungan) > 0) {
                        mysqli_stmt_bind_result($stmtGetIdTabungan, $id_tabungan);
                        while (mysqli_stmt_fetch($stmtGetIdTabungan)) {
                            $queryDeleteCatatTabungan = "DELETE FROM catat_tabungan WHERE id_tabungan = ?";
                            $stmtDeleteCatatTabungan = mysqli_prepare($koneksi, $queryDeleteCatatTabungan);
                            mysqli_stmt_bind_param($stmtDeleteCatatTabungan, "i", $id_tabungan);
                            mysqli_stmt_execute($stmtDeleteCatatTabungan);
                        }
                    }
                }
            } else {
                echo 'error';
                exit(); // Keluar dari skrip jika terjadi kesalahan penghapusan
            }
        }
       

        echo 'success';
    } else {
        // Gagal menghapus users
        echo 'error';
    }
} else {
    // Permintaan bukan dari metode POST
    echo 'error';
}
?>
