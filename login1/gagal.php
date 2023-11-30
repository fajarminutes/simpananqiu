<?php 
session_start();
$_SESSION['gagal_password'] = "Oops, Coba Lagi!";
header("Location: index.php");
?>