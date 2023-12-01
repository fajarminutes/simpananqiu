<?php 
$koneksi = mysqli_connect("localhost", "root", "", "simpananqiu");

// Menentukan halaman saat ini
$current_page = basename($_SERVER['PHP_SELF']);

// Periksa apakah halaman saat ini bukan transaksi.php atau update.php
if ($current_page === 'send_kontak.php') {
// Fungsi untuk melakukan koneksi ke database
function connectToDatabase() {
    $host = 'localhost';  // Ganti dengan host database Anda
    $username = 'root';  // Ganti dengan username database Anda
    $password = '';  // Ganti dengan password database Anda
    $database = 'simpananqiu';  // Ganti dengan nama database Anda

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}
    
}
?>