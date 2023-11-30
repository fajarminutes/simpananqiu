<?php include '../view/header_t.php' ?>
<?php include '../view/navbar_t.php' ?>
<?php include '../view/sidebar_t.php' ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kontak</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Kontak User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    

<div class="card">
               <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Email</th>
                    <th>Judul</th>
                    <th>Pesan</th>
                    <th>Tanggal Buat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  
                  <tbody>
                  <?php
                  function sensorEmail($email) {
    $parts = explode('@', $email);
    $username = $parts[0];
    $domain = $parts[1];

    $sensoredUsername = substr($username, 0, 3) . str_repeat('*', max(0, strlen($username) - 4));

    return $sensoredUsername . '@' . $domain;
}
$no = 1;
$query = mysqli_query($koneksi, "SELECT * FROM kontak");
while ($row = mysqli_fetch_array($query)) {
?>
<tr>
  <td><?= $no++; ?></td>
  <td><?= $row['nama']; ?></td>
  <td>
     <?php
      if ($row['id_user'] == 0) {
          echo 'Bukan Pengguna';
      } else {
          echo 'Pengguna';
      }
      ?>
      </td>
<td>
   <?php
      if ($row['id_user'] == 0) {
          echo sensorEmail($row['email']);
      } else {
        $id_user = $row['id_user'];
        $query_user = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user = $id_user");
        $user = mysqli_fetch_array($query_user);
          echo sensorEmail($user['email']);
      }
   ?>
</td>

  <td><?= $row['judul']; ?></td>
  <td><?= $row['pesan']; ?></td>
  <td><?= date('d F Y H.i', strtotime($row['tgl_b'])); ?></td>
  <td><?= $row['status'] !== '1' ? 'Halo' :  'Hai' ?></td>
  <td>
   <?php 
    if ($row['id_user'] == 0) {
        echo "<a href='' class='btn btn-warning' href=''><i class='fas fa-envelope'></i></a>";
    } else {
        $phoneNumber = $user['no_hp'];
        // Remove leading '0' and add '+62'
        $whatsappLink = "https://wa.me/+62" . substr($phoneNumber, 1);
        echo "<a class='btn btn-success' href='$whatsappLink'><i class='fab fa-whatsapp'></i></a>";
    }
?>

    <a href="#" class="btn btn-danger delete" data-id="<?= $row['id_kontak'] ?>"><i class="fa fa-trash"></i></a>
  </td>

</tr>
<?php } ?>
                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
             
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

           
          </div>
          <!-- /.col -->
        </div>
<script>
  $('#example2').on('click', '.delete', function() {
  // Dapatkan ID kategori yang akan dihapus
  const kontakId = $(this).data('id');

  // Tampilkan konfirmasi penghapusan menggunakan SweetAlert
  Swal.fire({
    title: 'Konfirmasi Penghapusan',
    text: 'Anda yakin ingin menghapus transaksi ini?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      // Lakukan permintaan AJAX untuk menghapus transaksi
      $.ajax({
        url: 'delete.php', // Ganti dengan URL yang sesuai
        method: 'POST',
        data: { id: kontakId },
        success: function(response) {
  if (response === 'success') {
    // Berhasil mengedit transaksi
   // Mengatur SweetAlert untuk ditampilkan setelah 2 detik
setTimeout(() => {
  Swal.fire({
    icon: 'success',
    title: 'Transaksi Berhasil Dihapus!',
  
    showConfirmButton: false,
    timer: 1000, // Menunggu 5 detik
    allowOutsideClick: false
  }).then(() => {
    // Menunggu 5 detik sebelum mereset ulang halaman
    setTimeout(() => {
      location.reload(); // Melakukan refresh halaman setelah 5 detik
    }, 1000);
  });
}, 1000);
  } else {
    Swal.fire({
      title: 'Gagal Menghapus transaksi',
      icon: 'error',
      showConfirmButton: false, // Menghilangkan tombol OK
      timer: 2000, // Menampilkan pesan selama 2 detik (sesuaikan sesuai kebutuhan)
      allowOutsideClick: false // Mencegah pengguna menutup pesan dengan mengklik di luar pesan
    });
  }
}
      });
    }
  });
});
</script>   

<?php

include '../view/footer_t.php' ?>