<?php
include "../../koneksi.php";
$id_users = $_GET['id_users']; // Terima parameter dari permintaan AJAX

// update-profile.php
$query = "SELECT * FROM users WHERE id_user = $id_users";
$result = mysqli_query($koneksi, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $nama_user = $row["nama_user"];
    $username = $row["username"];
    $status = $row["status"];
    $tgl_b = $row["tgl_b"];
    $vr = $row["vr"];
    
} else {
    $nama_user = "Nama Pengguna Tidak Ditemukan";
    $status = "Status Tidak Ditemukan";
    $vr = "Verifikasi Tidak Ditemukan";
}

if($row['status'] == 1) {
$premium = '../premium/premium.php';
} else {
$premium = '../premium/invoice.php';
}

$profileData = "

    <div class='card-body box-profile'>
        <div class='text-center'>
        <a href='#' data-toggle='modal' class='edit-modal modal-gambar' data-id='$id_users' data-target='#gambarModal$id_users'>
            <img class='profile-user-img img-fluid img-circle'
                 src='../../data/img/users/{$row['foto']}'
                 alt='User profile picture'>
                 </a>
        </div>
        <h3 class='profile-username text-center'>$nama_user</h3>
        <p class='text-muted text-center'>$username</p>
        <ul class='list-group list-group-unbordered mb-3'>
            <li class='list-group-item'>
                <b>Status</b> <a href='".$premium."' class='float-right'>" . ($status == 1 ? "Tidak Premium" : "Premium") . "</a>
            </li>
            <li class='list-group-item'>
                <b>Verifikasi 2 Langkah</b> <a class='float-right'>" . ($vr ? "Aktif" : "Tidak Aktif") . "</a>
            </li>
            <li class='list-group-item'>
                <b>Tentang Akun</b> <a class='float-right'>" . date('d F Y H.i', strtotime($tgl_b)) . "</a>
            </li>
        </ul>
    </div>

";
header('Content-Type: application/json');
echo json_encode(['profileData' => $profileData]);
mysqli_close($koneksi);
?>
