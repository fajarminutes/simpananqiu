<?php
include "../../koneksi.php";
$id_admin = $_GET['id_admin']; // Terima parameter dari permintaan AJAX

// update-profile.php
$query = "SELECT * FROM admin WHERE id_admin = $id_admin";
$result = mysqli_query($koneksi, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $nama_admin = $row["nama_admin"];
    $username = $row["username"];
   
} 

$profileData = "

    <div class='card-body box-profile'>
        <div class='text-center'>
        <a href='#' data-toggle='modal' class='edit-modal modal-gambar' data-id='$id_admin' data-target='#gambarModal$id_admin'>
            <img class='profile-user-img img-fluid img-circle'
                 src='../../assets/img/admin-aja.png'
                 alt='Admin profile picture'>
                 </a>
        </div>
        <h3 class='profile-username text-center'>$nama_admin</h3>
        <p class='text-muted text-center'>$username</p>

         
        
    </div>

";
header('Content-Type: application/json');
echo json_encode(['profileData' => $profileData]);
mysqli_close($koneksi);
?>
