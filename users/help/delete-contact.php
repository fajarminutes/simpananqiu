<?php 
include "../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $Id_kontak = $_POST['id']; // Dapatkan ID kontak yang akan dihapus

  // Lakukan proses penghapusan data dari database
  $query = "DELETE FROM kontak WHERE id_kontak = ?";
  $stmt = mysqli_prepare($koneksi, $query);
  mysqli_stmt_bind_param($stmt, "i", $Id_kontak);

  if (mysqli_stmt_execute($stmt)) {
    // Berhasil menghapus kontak
    echo 'success'; // Atau berikan respons JSON jika diperlukan
  } else {
    // Gagal menghapus kontak
    echo 'error'; // Atau berikan respons JSON jika diperlukan
  }
}

?>