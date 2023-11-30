<?php
include "../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi data yang diterima (nama, tanggal, total, kategori, aset, catatan)
    if (empty($_POST['id_user'])) {
        echo "Id User tidak boleh kosong.";
    } else if (empty($_POST['nama'])) {
        echo "Nama Pelanggan tidak boleh kosong.";
    } else if (empty($_POST['email'])) {
        echo "E-Mail tidak boleh kosong.";
    } else if (empty($_POST['judul'])) {
        echo "Judul Pesan tidak boleh kosong.";
    } else if (empty($_POST['pesan'])) {
        echo " Pesan Pelanggan tidak boleh kosong.";
    } else {
    // Lakukan validasi seperti yang Anda lakukan sebelumnya untuk semua field yang diperlukan.
    // ...
            $id_user = mysqli_real_escape_string($koneksi, $_POST['id_user']);
            $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
            $email = mysqli_real_escape_string($koneksi, $_POST['email']);
            $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
            $pesan = mysqli_real_escape_string($koneksi, $_POST['pesan']);
        
  // Periksa apakah status pengguna dengan id_user yang sesuai adalah 0
            $statusQuery = "SELECT status FROM users WHERE id_user = '$id_user'";
            $statusResult = mysqli_query($koneksi, $statusQuery);
            $statusRow = mysqli_fetch_assoc($statusResult);
            $userStatus = $statusRow['status'];

            // Query untuk menghitung jumlah kontak dengan id_user dan transaksi tertentu
            $kontakCountQuery = "SELECT COUNT(*) as count FROM kontak WHERE id_user = '$id_user' AND tgl_b != '0000-00-00 00:00:00'";
            $kontakCountResult = mysqli_query($koneksi, $kontakCountQuery);
            $countRow = mysqli_fetch_assoc($kontakCountResult);
            $kontakCount = $countRow['count'];

            if ($userStatus == '0') {
                // Jika status pengguna adalah 0 dan jumlah kontak mencapai batasan, tampilkan pesan harus menjadi premium
                if ($kontakCount >= 5) {
                    echo "Anda harus upgrade akun ke premium";
                } else {

                        // Lanjutkan dengan query untuk menambahkan data
                        date_default_timezone_set('Asia/Jakarta');
                        $currentDateTime = date('Y-m-d H:i:s');
                        $query = "INSERT INTO kontak (id_user, nama, email, judul, pesan,  tgl_b) VALUES ('$id_user', '$nama',  '$email', '$judul', '$pesan', '$currentDateTime')";

                        if (mysqli_query($koneksi, $query)) {
                            echo "Data keluhan berhasil ditambahkan.";
                        } else {
                            echo "Terjadi kesalahan saat menambahkan data keluhan: " . mysqli_error($koneksi);
                        }
                }
            } else {
                    // Lanjutkan dengan query untuk menambahkan data
                    date_default_timezone_set('Asia/Jakarta');
                    $currentDateTime = date('Y-m-d H:i:s');
                   $query = "INSERT INTO kontak (id_user, nama, email, judul, pesan,  tgl_b) VALUES ('$id_user', '$nama',  '$email', '$judul', '$pesan', '$currentDateTime')";


                    if (mysqli_query($koneksi, $query)) {
                        echo "Data keluhan berhasil ditambahkan.";
                    } else {
                        echo "Terjadi kesalahan saat menambahkan data keluhan: " . mysqli_error($koneksi);
                    }
            }
    
}
} else {
    echo "Permintaan tidak valid.";
}
?>
