<?php
include '../koneksi.php';

if(isset($_GET['username'])) {
    $username = $_GET['username'];

    $query = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    if(mysqli_num_rows($result) > 0) {
        echo "exists";
    } else {
        echo "available";
    }
}
?>
