<?php
include "../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi data yang diterima
    if (empty($_POST['id_user'])) {
        echo "Id User tidak boleh kosong.";
    } else if (empty($_POST['nama_premium'])) {
        echo "Nama Produk tidak boleh kosong.";
    } else if (empty($_POST['tipe_premium'])) {
        echo "Tipe Premium tidak boleh kosong.";
    } else if (empty($_POST['harga'])) {
        echo "Harga tidak boleh kosong.";
    } else if (empty($_POST['metode_pembayaran'])) {
        echo "Metode Pembayaran tidak boleh kosong.";
    } else if (empty($_FILES['bukti']['name'])) {
        echo "Bukti Pembayaran tidak boleh kosong.";
    }else {
        $id_user = mysqli_real_escape_string($koneksi, $_POST['id_user']);
        $nama_premium = mysqli_real_escape_string($koneksi, $_POST['nama_premium']);
        $tipe_premium = mysqli_real_escape_string($koneksi, $_POST['tipe_premium']);
        $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
        $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
        $metode_pembayaran = mysqli_real_escape_string($koneksi, $_POST['metode_pembayaran']);
        
        

        // Periksa apakah status pengguna dengan id_user yang sesuai adalah 0
        $statusQuery = "SELECT status FROM users WHERE id_user = '$id_user'";
        $statusResult = mysqli_query($koneksi, $statusQuery);
        $statusRow = mysqli_fetch_assoc($statusResult);
        $userStatus = $statusRow['status'];

        // Query untuk menghitung jumlah premium dengan id_user  tertentu
        $premiumCountQuery = "SELECT COUNT(*) as count FROM premium WHERE id_user = '$id_user' AND tipe_produk = '$tipe_premium' AND tgl_b != '0000-00-00 00:00:00'";
        $premiumCountResult = mysqli_query($koneksi, $premiumCountQuery);
        $countRow = mysqli_fetch_assoc($premiumCountResult);
        $premiumCount = $countRow['count'];

        if ($userStatus == 1) {
            // Jika status pengguna adalah 0 dan jumlah tabungan mencapai batasan, tampilkan pesan harus menjadi premium
            if ($premiumCount >= 1 ) {
                echo "Menunggu Admin Untuk Validasi Pemesanan Anda!";
                exit();
            } else {
                // Inisialisasi variabel bukti
        $bukti = NULL;

        // Check if the user has selected both description and image
        if (!empty($_FILES['bukti']['name'])) {
            // Both description and image selected, handle as desired
            $buktiDir = "../../data/img/premium/";
             $bukti = $_FILES['bukti']['name'];
            $buktiTmp = $_FILES['bukti']['tmp_name'];
            $buktiName = time() . '_' . $bukti;

            move_uploaded_file($buktiTmp, $buktiDir . $buktiName);

            // Setel bukti ke nama file yang diunggah
            $bukti = $buktiName;
        }
               if(!empty($keterangan)) {
                 // Lanjutkan dengan query untuk menambah data
                date_default_timezone_set('Asia/Jakarta');
                $currentDateTime = date('Y-m-d H:i:s');

                function generateInvoiceNumber() {
    $prefix = 'INV'; // Prefix untuk invoice
   $randomNumber = mt_rand(1000, 9999); // Nomor acak antara 1000 dan 9999
      $randomNumberTwo = mt_rand(1000, 9999); // Nomor acak antara 1000 dan 9999
    $datePart = date('Ymd'); // Bagian tanggal (format: Ymd)

    // Gabungkan semua bagian untuk membuat nomor invoice
    $invoiceNumber = $prefix . '-' . $datePart . '-' . $randomNumber . '-' . $randomNumberTwo;

    return $invoiceNumber;
}

// Contoh penggunaan
$nomorInvoice = generateInvoiceNumber();
                
                // Gabungkan query untuk menghindari duplikasi
                $query = "INSERT INTO premium (id_user, nama_produk, no_invoice, tipe_produk, harga, metode_pembayaran, deskripsi, bukti, tgl_b) VALUES ('$id_user', '$nama_premium', '$nomorInvoice', '$tipe_premium', '$harga', '$metode_pembayaran', '$keterangan', '$bukti', '$currentDateTime')";

                if (mysqli_query($koneksi, $query)) {
                    echo "Pemesanan berhasil ditambah.";
                } else {
                    echo "Terjadi kesalahan saat tingkatkan akun: " . mysqli_error($koneksi);
                }

               } else {
                 // Lanjutkan dengan query untuk menambah data
                date_default_timezone_set('Asia/Jakarta');
                $currentDateTime = date('Y-m-d H:i:s');

                function generateInvoiceNumber() {
    $prefix = 'INV'; // Prefix untuk invoice
     $randomNumber = mt_rand(1000, 9999); // Nomor acak antara 1000 dan 9999
          $randomNumberTwo = mt_rand(1000, 9999); // Nomor acak antara 1000 dan 9999
    $datePart = date('Ymd'); // Bagian tanggal (format: Ymd)

    // Gabungkan semua bagian untuk membuat nomor invoice
    $invoiceNumber = $prefix . '-' . $datePart . '-' . $randomNumber . '-' . $randomNumberTwo;

    return $invoiceNumber;
}

// Contoh penggunaan
$nomorInvoice = generateInvoiceNumber();
                
                // Gabungkan query untuk menghindari duplikasi
                $query = "INSERT INTO premium (id_user, nama_produk, no_invoice, tipe_produk, harga, metode_pembayaran, deskripsi, bukti, tgl_b) VALUES ('$id_user', '$nama_premium', '$nomorInvoice', '$tipe_premium', '$harga', '$metode_pembayaran', NULL, '$bukti', '$currentDateTime')";

                if (mysqli_query($koneksi, $query)) {
                    echo "Pemesanan berhasil ditambah.";
                } else {
                    echo "Terjadi kesalahan saat tingkatkan akun: " . mysqli_error($koneksi);
                }
               }
           
      
        }
        } 
}
} else {
    // Permintaan bukan dari metode POST
    echo "Permintaan tidak valid.";
}

mysqli_close($koneksi);
?>
