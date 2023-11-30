<?php
// Include koneksi dan data yang diperlukan
session_start();
include '../../koneksi.php';
$id_users = $_SESSION['user_login'];
// Periksa apakah data premium sudah ada untuk pengguna saat ini
$target_query = "SELECT * FROM premium WHERE id_user = '$id_users'";
$target_result = mysqli_query($koneksi, $target_query);
$row = mysqli_fetch_assoc($target_result);
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user = $id_users");
$all = mysqli_fetch_array($query);

if (mysqli_num_rows($target_result) > 0 && $all['status'] === '1') {
    // Install mpdf melalui composer terlebih dahulu
    include '../vendor/autoload.php';
    // Membuat objek mPDF
    $mpdf = new \Mpdf\Mpdf();

    // Tambahkan halaman
    $mpdf->AddPage();

    // Output HTML dari invoice-html.php
    ob_start();
    include 'invoice-html.php';
    $html = ob_get_clean();

    // Tulis HTML ke file PDF
    $mpdf->WriteHTML($html);

    // Nama file PDF yang akan diunduh
    $filename = "invoice-" . $row['no_invoice'] . ".pdf";

    // Mengatur header sebagai file PDF
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    // Keluaran PDF
    $mpdf->Output($filename, \Mpdf\Output\Destination::DOWNLOAD);
} else {
    // Tidak sesuai, redirect ke halaman yang sesuai
    $_SESSION['gagal'] = 'Opps, Anda Gagal!';
    echo '<script>window.location.href = "../profile/profile.php";</script>';
}
