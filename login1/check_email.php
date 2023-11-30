<?php
include '../koneksi.php';

if(isset($_GET['email'])) {
    $email = $_GET['email'];

    $query = "SELECT email FROM users WHERE email = '$email'";
    $result = mysqli_query($koneksi, $query);

    if(mysqli_num_rows($result) > 0) {
        echo "exists";
    } else {
        echo "available";
    }
}
?>
