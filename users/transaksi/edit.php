<?php
include "../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi data yang diterima
    if (empty($_POST['id_keuangan'])) {
        echo "Tidak Boleh Kosong";
    } else if (empty($_POST['id_user'])) {
        echo "Id User tidak boleh kosong.";
    } else if (empty($_POST['nilai_transaksi'])) {
        echo "Transaksi tidak boleh kosong.";
    } else if (empty($_POST['tanggal_waktu_edit'])) {
        echo "Tanggal tidak boleh kosong.";
    } else if (empty($_POST['total_edit'])) {
        echo "Total tidak boleh kosong.";
    } else if (empty($_POST['nilai_kategori'])) {
        echo "Kategori tidak boleh kosong.";
    } else if (empty($_POST['aset_edit'])) {
        echo "Aset tidak boleh kosong.";
    } else if (empty($_POST['catatan_edit'])) {
        echo "Catatan tidak boleh kosong.";
    } else {
        $id_keuangan = mysqli_real_escape_string($koneksi, $_POST['id_keuangan']);
        $nilai_transaksi = mysqli_real_escape_string($koneksi, $_POST['nilai_transaksi']);
        $nilai_kategori = mysqli_real_escape_string($koneksi, $_POST['nilai_kategori']);
        $id_user = mysqli_real_escape_string($koneksi, $_POST['id_user']);
        $tanggal_waktu = mysqli_real_escape_string($koneksi, $_POST['tanggal_waktu_edit']);
        $catatan = mysqli_real_escape_string($koneksi, $_POST['catatan_edit']);
        $aset = mysqli_real_escape_string($koneksi, $_POST['aset_edit']);
        $total = mysqli_real_escape_string($koneksi, $_POST['total_edit']);
        $deskripsi = "";

        // Check if the user has selected both description and image
        if (!empty($_POST['deskripsi_ubah']) && !empty($_FILES['fileInput_ubah']['name'])) {
            // Both description and image selected, handle as desired
            $gambarDir = "../../data/img/transaksi/";
            $gambar = $_FILES['fileInput_ubah']['name'];
            $gambarTmp = $_FILES['fileInput_ubah']['tmp_name'];
            $gambarName = time() . '_' . $gambar;

            move_uploaded_file($gambarTmp, $gambarDir . $gambarName);

            // Hapus gambar lama jika ada
            $queryCekGambar = "SELECT deskripsi FROM keuangan WHERE id_keuangan = $id_keuangan";
            $resultCekGambar = mysqli_query($koneksi, $queryCekGambar);

            if ($resultCekGambar && mysqli_num_rows($resultCekGambar) > 0) {
                $rowCekGambar = mysqli_fetch_assoc($resultCekGambar);
                $gambarLama = $rowCekGambar['deskripsi'];

                if (!empty($gambarLama) && file_exists("../../data/img/transaksi/$gambarLama")) {
                    unlink("../../data/img/transaksi/$gambarLama");
                }
            }

            // Setel deskripsi ke nama file yang diunggah
            $deskripsi = $gambarName;
        } else if (!empty($_FILES['fileInput_ubah']['name'])) {
            // User selected to change to an image
            $gambarDir = "../../data/img/transaksi/";
            $gambar = $_FILES['fileInput_ubah']['name'];
            $gambarTmp = $_FILES['fileInput_ubah']['tmp_name'];
            $gambarName = time() . '_' . $gambar;

            move_uploaded_file($gambarTmp, $gambarDir . $gambarName);

            // Hapus gambar lama jika ada
            $queryCekGambar = "SELECT deskripsi FROM keuangan WHERE id_keuangan = $id_keuangan";
            $resultCekGambar = mysqli_query($koneksi, $queryCekGambar);

            if ($resultCekGambar && mysqli_num_rows($resultCekGambar) > 0) {
                $rowCekGambar = mysqli_fetch_assoc($resultCekGambar);
                $gambarLama = $rowCekGambar['deskripsi'];

                if (!empty($gambarLama) && file_exists("../../data/img/transaksi/$gambarLama")) {
                    unlink("../../data/img/transaksi/$gambarLama");
                }
            }

            // Setel deskripsi ke nama file yang diunggah
            $deskripsi = $gambarName;
        } else if (!empty($_POST['deskripsi_ubah'])) {
            // User selected to change to a description
            $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi_ubah']);
            
            // Hapus gambar lama jika ada
            $queryCekGambar = "SELECT deskripsi FROM keuangan WHERE id_keuangan = $id_keuangan";
            $resultCekGambar = mysqli_query($koneksi, $queryCekGambar);

            if ($resultCekGambar && mysqli_num_rows($resultCekGambar) > 0) {
                $rowCekGambar = mysqli_fetch_assoc($resultCekGambar);
                $gambarLama = $rowCekGambar['deskripsi'];

                if (!empty($gambarLama) && file_exists("../../data/img/transaksi/$gambarLama")) {
                    unlink("../../data/img/transaksi/$gambarLama");
                }
            }
        } else {
            // User didn't select either, use the existing data
            // Retrieve existing description from the database
            $queryGetDeskripsi = "SELECT deskripsi FROM keuangan WHERE id_keuangan = $id_keuangan";
            $resultGetDeskripsi = mysqli_query($koneksi, $queryGetDeskripsi);

            if ($resultGetDeskripsi && mysqli_num_rows($resultGetDeskripsi) > 0) {
                $rowGetDeskripsi = mysqli_fetch_assoc($resultGetDeskripsi);
                $deskripsi = $rowGetDeskripsi['deskripsi'];
            }
        }

         // Periksa apakah status pengguna dengan id_user yang sesuai adalah 0
            $statusQuery = "SELECT status FROM users WHERE id_user = '$id_user'";
            $statusResult = mysqli_query($koneksi, $statusQuery);
            $statusRow = mysqli_fetch_assoc($statusResult);
            $userStatus = $statusRow['status'];

            // Query untuk menghitung jumlah keuangan dengan id_user dan nama_keuangan tertentu
            $keuanganCountQuery = "SELECT COUNT(*) as count FROM keuangan WHERE id_user = '$id_user' AND nama_keuangan = '$nilai_transaksi' AND tgl_b != '0000-00-00 00:00:00'";
            $keuanganCountResult = mysqli_query($koneksi, $keuanganCountQuery);
            $countRow = mysqli_fetch_assoc($keuanganCountResult);
            $keuanganCount = $countRow['count'];

            if ($userStatus == '1') {
                // Jika status pengguna adalah 0 dan jumlah keuangan mencapai batasan, tampilkan pesan harus menjadi premium
                if ($keuanganCount >= 5 ) {
                    echo "Anda harus upgrade akun ke premium";
                } else {
                   // Lanjutkan dengan query untuk mengubah data
        date_default_timezone_set('Asia/Jakarta');
        $currentDateTime = date('Y-m-d H:i:s');
        $query = "UPDATE keuangan SET
            id_user = '$id_user',
            id_kategori = '$nilai_kategori',
            id_aset = '$aset',
            nama_keuangan = '$nilai_transaksi',
            total = '$total',
            catatan = '$catatan',
            deskripsi = '$deskripsi',
            tgl_e = '$currentDateTime'
        WHERE id_keuangan = $id_keuangan";

        if (mysqli_query($koneksi, $query)) {
           // Update kolom total di tabel aset dengan menambahkan nilai baru
    $queryUpdateAset = "UPDATE aset SET total = total + $total WHERE id_aset = '$aset' AND id_user = '$id_user'";
    
    // Jalankan query untuk melakukan update di tabel aset
    if (mysqli_query($koneksi, $queryUpdateAset)) {
       echo "Data keuangan berhasil diubah.";
    } else {
        echo "Terjadi kesalahan saat melakukan update total di tabel aset: " . mysqli_error($koneksi);
    }
        } else {
            echo "Terjadi kesalahan saat mengubah data keuangan: " . mysqli_error($koneksi);
        }
                }
            } else {
               // Lanjutkan dengan query untuk mengubah data
        date_default_timezone_set('Asia/Jakarta');
        $currentDateTime = date('Y-m-d H:i:s');
        $query = "UPDATE keuangan SET
            id_user = '$id_user',
            id_kategori = '$nilai_kategori',
            id_aset = '$aset',
            nama_keuangan = '$nilai_transaksi',
            total = '$total',
            catatan = '$catatan',
            deskripsi = '$deskripsi',
            tgl_e = '$currentDateTime'
        WHERE id_keuangan = $id_keuangan";

        if (mysqli_query($koneksi, $query)) {
            // Update kolom total di tabel aset dengan menambahkan nilai baru
    $queryUpdateAset = "UPDATE aset SET total = total + $total WHERE id_aset = '$aset' AND id_user = '$id_user'";
    
    // Jalankan query untuk melakukan update di tabel aset
    if (mysqli_query($koneksi, $queryUpdateAset)) {
       echo "Data keuangan berhasil diubah.";
    } else {
        echo "Terjadi kesalahan saat melakukan update total di tabel aset: " . mysqli_error($koneksi);
    }
        } else {
            echo "Terjadi kesalahan saat mengubah data keuangan: " . mysqli_error($koneksi);
        }
            }
    }
} else {
    // Permintaan bukan dari metode POST
    echo "Permintaan tidak valid.";
}

mysqli_close($koneksi);
?>
