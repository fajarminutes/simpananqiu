<?php
// Koneksi ke database (sesuaikan dengan informasi koneksi Anda)
include '../../koneksi.php';

// Periksa jenis transaksi yang dikirim dari permintaan AJAX
if (isset($_GET['transaksi'])) {
  $transaksi = $_GET['transaksi'];
  $id_user = $_GET['id_user'];
  
  // Query database untuk mendapatkan aset berdasarkan jenis transaksi
  $query = "SELECT id_aset, grup, nama_aset FROM aset WHERE id_user = '$id_user' AND transaksi = '$transaksi'";
  $result = mysqli_query($koneksi, $query);

  $options = '<option value="">Pilih Aset</option>'; // Opsi pertama kosong
  while ($row = mysqli_fetch_array($result)) {
    $options .= '<option value="' . $row['id_aset'] . '">' . $row['grup'] . '/' . $row['nama_aset'] . '</option>';
  }
  echo $options;
}
?>
