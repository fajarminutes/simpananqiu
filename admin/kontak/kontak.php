<?php include '../view/header_t.php' ?>
<?php include '../view/navbar_t.php' ?>
<?php include '../view/sidebar_t.php' ?>
<?php 
$query_data = mysqli_query($koneksi, "SELECT * FROM kontak");
$belum_terbaca = 0; // Jumlah pesan yang belum terbaca
$sudah_terbaca = 0; // Jumlah pesan yang belum terbaca

$query_data_jumlah = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah_pesan FROM kontak");
$result = mysqli_fetch_assoc($query_data_jumlah);

$jumlah = $result['jumlah_pesan'];

while ($row = mysqli_fetch_array($query_data)) {
    // Cek apakah status belum terbaca
    if ($row['status'] === '1') {
        $belum_terbaca++;
    }

     if ($row['status'] === '2') {
        $sudah_terbaca++;
    }
}


if (isset($_SESSION['email_sent'])) {
    echo '<script>';
    echo 'Swal.fire({';
    echo '    position: "center",';
    echo '    icon: "success",';
    echo '    title: "' . $_SESSION['email_sent'] . '",';
    echo '    showConfirmButton: false,';
    echo '    timer: 3000'; //Ini 3 detik
    echo '});';
    echo '</script>';
    unset($_SESSION['email_sent']); // Hapus pesan dari session
}
?>

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
      <div class="card-header">
      <div class="card-body">
                <div class="container-fluid ">
               <div class="row">
               <div class="col-lg-4 col-sm-4 ">

    <p style="margin-bottom:-5px;text-align:center;font-weight:bold;">Pesan</p>
    <p  style="color:black;text-align:center;"><?= $jumlah ?></p>

</div>

                <div class="col-lg-4 col-sm-4">
                 
    <p style="margin-bottom:-5px;text-align:center;font-weight:bold;">Pesan Belum Terselesaikan</p>
    <p  style="color:red;text-align:center;"><?= $belum_terbaca ?></p>
  

                </div>
                <div class="col-lg-4 col-sm-4">
              
  <p style="margin-bottom: -5px; text-align: center; font-weight: bold;">Pesan Terselesaikan</p>
  <p style="text-align: center; color:green;"><?= $sudah_terbaca ?></p>

                </div>
               </div>
               </div>
                </div>
     </div>


    </div>
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
  <td><?= $row['status'] !== '2' ? 'Belum Terselesaikan' :  'Terselesaikan' ?></td>
  <td>
   <?php 
   $id_kontak = $row['id_kontak'];
   $email = $row['email'];
    if ($row['id_user'] == 0) {
      if($row['status'] !== '2') {
 echo '<form action="send_kontak.php" method="post">';
echo '<input type="hidden" name="id_kontak" value="' . $id_kontak . '">';
echo '<input type="hidden" name="email" value="' . $email . '">';
echo "<button type='submit' name='send' class='btn btn-warning mb-2' data-toggle='tooltip' data-placement='top' title='Kirim Email'><i class='fas fa-envelope'></i></button>";
echo '</form>';
      } else {
echo '<div class="onoffswitch">
    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch' . $row['id_kontak'] . '" ' . (($row['status'] == 2) ? 'checked' : '') . ' data-id="' . $row['id_kontak'] . '">
    <label class="onoffswitch-label" for="myonoffswitch' . $row['id_kontak'] . '">
        <div class="onoffswitch-inner"></div>
        <div class="onoffswitch-switch"></div>
    </label>
</div>';

      }
     

    } else {
        $phoneNumber = $user['no_hp'];
        // Remove leading '0' and add '+62'
        $whatsappLink = "https://wa.me/+62" . substr($phoneNumber, 1);
        echo "<a class='btn btn-success mb-2' href='$whatsappLink'><i class='fab fa-whatsapp'></i></a>";
        echo '<div class="onoffswitch">
    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch' . $row['id_kontak'] . '" ' . (($row['status'] == 2) ? 'checked' : '') . ' data-id="' . $row['id_kontak'] . '">
    <label class="onoffswitch-label" for="myonoffswitch' . $row['id_kontak'] . '">
        <div class="onoffswitch-inner"></div>
        <div class="onoffswitch-switch"></div>
    </label>
</div>';
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

                 <script>
    $(document).ready(function () {
        $(".onoffswitch-checkbox").on("change", function () {
            var idUser = $(this).data('id');
            var newStatus = ($(this).is(":checked")) ? 2 : 1; // Ubah logika untuk membalik status

            $.ajax({
                type: "POST",
                url: "update_kontak.php",
                data: {
                    id_kontak: idUser,
                    status: newStatus,
                },
                success: function (response) {
                    if (response) {
                      setTimeout(() => {
 Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: 'Status berhasil diperbarui!',
                            showConfirmButton: false,
                            timer: 1500
  }).then(() => {
    // Menunggu 5 detik sebelum mereset ulang halaman
    setTimeout(() => {
      location.reload(); // Melakukan refresh halaman setelah 5 detik
    }, 1000);
  });
}, 1000);
                      
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gagal memperbarui status.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Terjadi kesalahan: ' + error,
                    });
                }
            });
        });
    });
</script>
           

  <script>
    // Pastikan jQuery sudah dimuat sebelum menjalankan skrip ini

    $(document).ready(function () {
        $('.send-email').click(function () {
            var email = $(this).data('email');

            // Ganti url_ke_send_email.php dengan file yang sesuai di backend Anda
            $.ajax({
                url: 'send_email.php',
                method: 'POST',
                data: { email: email },
                success: function (response) {
                    response = JSON.parse(response);
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Email berhasil dikirim!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal mengirim email. Silahkan coba lagi.',
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan. Silahkan coba lagi.',
                    });
                }
            });
        });
    });
</script>


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