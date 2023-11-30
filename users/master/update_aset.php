<?php
include '../../koneksi.php';

// Periksa apakah id_user ada dalam parameter URL atau data GET
$id_users = isset($_GET['id_user']) ? $_GET['id_user'] : null;

// Pastikan untuk menyaring dan membersihkan nilai yang diterima dari klien
$id_users = mysqli_real_escape_string($koneksi, $id_users);

// Periksa apakah id_user tidak kosong
if (!empty($id_users)) {
    // Query untuk mengambil data aset
    $queryPemasukan = mysqli_query($koneksi, "SELECT SUM(total) as totalAset FROM aset WHERE id_user = '$id_users' AND transaksi = 'Pemasukan'");
    $queryPengeluaran = mysqli_query($koneksi, "SELECT SUM(total) as totalLiabilitas FROM aset WHERE id_user = '$id_users' AND transaksi = 'Pengeluaran'");

    $rowPemasukan = mysqli_fetch_assoc($queryPemasukan);
    $rowPengeluaran = mysqli_fetch_assoc($queryPengeluaran);

    $totalAset = $rowPemasukan['totalAset'] ?? 0;
    $totalLiabilitas = $rowPengeluaran['totalLiabilitas'] ?? 0;
    $selisihTotal = $totalAset - $totalLiabilitas;

    // Format data dalam format JSON
    $data = [
        'totalAset' => 'Rp ' . number_format($totalAset, 2, ',', '.'),
        'totalLiabilitas' => 'Rp ' . number_format($totalLiabilitas, 2, ',', '.'),
        'selisihTotal' => 'Rp ' . number_format($selisihTotal, 2, ',', '.'),
    ];

    // Mengembalikan data dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Jika id_user tidak ada atau kosong, kembalikan respon kosong
    header('Content-Type: application/json');
    echo json_encode([]);
}
?>
