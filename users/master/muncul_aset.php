<?php
include "../../koneksi.php";

$id_users = $_GET['id_users']; // Ambil id_users dari permintaan AJAX
$grup = $_GET['grup']; // Ambil grup dari permintaan AJAX

switch ($grup) {
    case "Tunai":
        // Kode untuk menampilkan aset dengan grup "Tunai"
         $no = 1;
$result = mysqli_query($koneksi, "SELECT * FROM aset WHERE id_user = $id_users AND grup = '$grup' ORDER BY id_aset DESC;
");

while ($d = mysqli_fetch_array($result)) {
  echo '<div class="col-md-4">';
  echo '  <div class="card mb-4">';
  echo '    <div class="card-body clickable">';
  echo '      <h5 class="card-title text-bold mb-2">Aset : '.$no++.'</h5>';
  echo '      <p class="card-text nama_aset" style="display:none;" data-id="' . $d['id_aset'] . '">' . $d['nama_aset'] . '</p>';
  echo '       <p class="card-text transaksi" style="margin-bottom:-4px;">Transaksi : <b>'.$d['transaksi'].'</b>';
  echo '       <p class="card-text" style="margin-bottom:-4px;">Grup : <b>'.$d['grup'].'</b>';
  echo '       <p class="card-text" style="margin-bottom:-4px;">Nama Aset : <b>'.$d['nama_aset'].'</b>';
  echo '       <p class="card-text" style="margin-bottom:-4px;">Total : <b>Rp '.number_format($d['total'], 2, ',', '.').'</b>';
  echo '       <p class="card-text" >Deskripsi : <b>'.$d['deskripsi'].'</b>';
  echo '      <p class="card-text grup" style="display:none;">' . $d['grup'] . '</p>';
    echo '      <p class="card-text transaksi_aset" style="display:none;">' . $d['transaksi'] . '</p>';
  echo '      <p class="card-text id_user" style="display:none;">' . $d['id_user'] . '</p>';
  echo '      <p class="card-text total" style="display:none;">' . $d['total'] . '</p>';
  echo '      <p class="card-text deskripsi" style="display:none;">' . $d['deskripsi'] . '</p>';
  echo '      <a href="#" class="btn btn-warning edit-category"><i class="fa fa-pen"></i></a>';
  echo '     <a href="#" class="btn btn-danger delete-category" data-id="' . $d['id_aset'] . '"><i class="fa fa-trash"></i></a>
';
  echo '    </div>';
  echo '  </div>';
  echo '</div>';
}
        break;

    case "Bank":
        // Kode untuk menampilkan aset dengan grup "Bank"
        
 
 $no = 1;
$result = mysqli_query($koneksi, "SELECT * FROM aset WHERE id_user = $id_users AND grup = '$grup' ORDER BY id_aset DESC;
");

while ($d = mysqli_fetch_array($result)) {
  echo '<div class="col-md-4">';
  echo '  <div class="card mb-4">';
  echo '    <div class="card-body clickable">';
  echo '      <h5 class="card-title text-bold mb-2">Aset : '.$no++.'</h5>';
  echo '      <p class="card-text nama_aset" style="display:none;" data-id="' . $d['id_aset'] . '">' . $d['nama_aset'] . '</p>';
  echo '       <p class="card-text transaksi" style="margin-bottom:-4px;">Transaksi : <b>'.$d['transaksi'].'</b>';
  echo '       <p class="card-text" style="margin-bottom:-4px;">Grup : <b>'.$d['grup'].'</b>';
  echo '       <p class="card-text" style="margin-bottom:-4px;">Nama Aset : <b>'.$d['nama_aset'].'</b>';
  echo '       <p class="card-text" style="margin-bottom:-4px;">Total : <b>Rp '.number_format($d['total'], 2, ',', '.').'</b>';
  echo '       <p class="card-text" >Deskripsi : <b>'.$d['deskripsi'].'</b>';
  echo '      <p class="card-text grup" style="display:none;">' . $d['grup'] . '</p>';
    echo '      <p class="card-text transaksi_aset" style="display:none;">' . $d['transaksi'] . '</p>';
  echo '      <p class="card-text id_user" style="display:none;">' . $d['id_user'] . '</p>';
  echo '      <p class="card-text total" style="display:none;">' . $d['total'] . '</p>';
  echo '      <p class="card-text deskripsi" style="display:none;">' . $d['deskripsi'] . '</p>';
  echo '      <a href="#" class="btn btn-warning edit-category"><i class="fa fa-pen"></i></a>';
  echo '     <a href="#" class="btn btn-danger delete-category" data-id="' . $d['id_aset'] . '"><i class="fa fa-trash"></i></a>
';
  echo '    </div>';
  echo '  </div>';
  echo '</div>';
}


        break;

    case "Kartu":
        // Kode untuk menampilkan aset dengan grup "Kartu"
         $no = 1;
$result = mysqli_query($koneksi, "SELECT * FROM aset WHERE id_user = $id_users AND grup = '$grup' ORDER BY id_aset DESC;
");

while ($d = mysqli_fetch_array($result)) {
  echo '<div class="col-md-4">';
  echo '  <div class="card mb-4">';
  echo '    <div class="card-body clickable">';
  echo '      <h5 class="card-title text-bold mb-2">Aset : '.$no++.'</h5>';
  echo '      <p class="card-text nama_aset" style="display:none;" data-id="' . $d['id_aset'] . '">' . $d['nama_aset'] . '</p>';
  echo '       <p class="card-text transaksi" style="margin-bottom:-4px;">Transaksi : <b>'.$d['transaksi'].'</b>';
  echo '       <p class="card-text" style="margin-bottom:-4px;">Grup : <b>'.$d['grup'].'</b>';
  echo '       <p class="card-text" style="margin-bottom:-4px;">Nama Aset : <b>'.$d['nama_aset'].'</b>';
  echo '       <p class="card-text" style="margin-bottom:-4px;">Total : <b>Rp '.number_format($d['total'], 2, ',', '.').'</b>';
  echo '       <p class="card-text" >Deskripsi : <b>'.$d['deskripsi'].'</b>';
  echo '      <p class="card-text grup" style="display:none;">' . $d['grup'] . '</p>';
    echo '      <p class="card-text transaksi_aset" style="display:none;">' . $d['transaksi'] . '</p>';
  echo '      <p class="card-text id_user" style="display:none;">' . $d['id_user'] . '</p>';
  echo '      <p class="card-text total" style="display:none;">' . $d['total'] . '</p>';
  echo '      <p class="card-text deskripsi" style="display:none;">' . $d['deskripsi'] . '</p>';
  echo '      <a href="#" class="btn btn-warning edit-category"><i class="fa fa-pen"></i></a>';
  echo '     <a href="#" class="btn btn-danger delete-category" data-id="' . $d['id_aset'] . '"><i class="fa fa-trash"></i></a>
';
  echo '    </div>';
  echo '  </div>';
  echo '</div>';
}
        break;

    case "Lainnya":
        // Kode untuk menampilkan aset dengan grup "Lainnya"
         $no = 1;
$result = mysqli_query($koneksi, "SELECT * FROM aset WHERE id_user = $id_users AND grup = '$grup' ORDER BY id_aset DESC;
");

while ($d = mysqli_fetch_array($result)) {
  echo '<div class="col-md-4">';
  echo '  <div class="card mb-4">';
  echo '    <div class="card-body clickable">';
  echo '      <h5 class="card-title text-bold mb-2">Aset : '.$no++.'</h5>';
  echo '      <p class="card-text nama_aset" style="display:none;" data-id="' . $d['id_aset'] . '">' . $d['nama_aset'] . '</p>';
  echo '       <p class="card-text transaksi" style="margin-bottom:-4px;">Transaksi : <b>'.$d['transaksi'].'</b>';
  echo '       <p class="card-text" style="margin-bottom:-4px;">Grup : <b>'.$d['grup'].'</b>';
  echo '       <p class="card-text" style="margin-bottom:-4px;">Nama Aset : <b>'.$d['nama_aset'].'</b>';
  echo '       <p class="card-text" style="margin-bottom:-4px;">Total : <b>Rp '.number_format($d['total'], 2, ',', '.').'</b>';
  echo '       <p class="card-text" >Deskripsi : <b>'.$d['deskripsi'].'</b>';
  echo '      <p class="card-text grup" style="display:none;">' . $d['grup'] . '</p>';
    echo '      <p class="card-text transaksi_aset" style="display:none;">' . $d['transaksi'] . '</p>';
  echo '      <p class="card-text id_user" style="display:none;">' . $d['id_user'] . '</p>';
  echo '      <p class="card-text total" style="display:none;">' . $d['total'] . '</p>';
  echo '      <p class="card-text deskripsi" style="display:none;">' . $d['deskripsi'] . '</p>';
  echo '      <a href="#" class="btn btn-warning edit-category"><i class="fa fa-pen"></i></a>';
  echo '     <a href="#" class="btn btn-danger delete-category" data-id="' . $d['id_aset'] . '"><i class="fa fa-trash"></i></a>
';
  echo '    </div>';
  echo '  </div>';
  echo '</div>';
}
        break;

    default:
        // Handle jika grup tidak dikenali
        echo "Grup tidak valid.";
}
?>
