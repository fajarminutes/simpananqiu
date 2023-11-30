   <?php 
include "../view/header_t.php";
?>

  <?php 
include "../view/navbar_t.php";
?>

<?php 
include "../view/sidebar_t.php";
?>

<?php 
$query_data = mysqli_query($koneksi, "SELECT * FROM kontak WHERE id_user = $id_users");
$belum_terbaca = 0; // Jumlah pesan yang belum terbaca
$sudah_terbaca = 0; // Jumlah pesan yang belum terbaca

$query_data_jumlah = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah_pesan FROM kontak WHERE id_user = $id_users");
$result = mysqli_fetch_assoc($query_data_jumlah);

$jumlah = $result['jumlah_pesan'];

while ($row = mysqli_fetch_array($query_data)) {
    // Cek apakah status belum terbaca
    if ($row['status'] === NULL) {
        $belum_terbaca++;
    }

     if ($row['status'] === '2') {
        $sudah_terbaca++;
    }
   
    $nama = $row['nama'];
    $email = $row['email'];
    // ... (sisa kolom dari tabel)
    $tgl_b = $row['tgl_b'];
    $tgl_e = $row['tgl_e'];
}


if (isset($_SESSION['gagal'])) {
    echo '<script>';
    echo 'Swal.fire({';
    echo '    position: "center",';
    echo '    icon: "warning",';
    echo '    title: "' . $_SESSION['gagal'] . '",';
    echo '    showConfirmButton: false,';
    echo '    timer: 3000'; //Ini 3 detik
    echo '});';
    echo '</script>';
    unset($_SESSION['gagal']); // Hapus pesan dari session
}
?>


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kontak Kami</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
              <li class="breadcrumb-item active">Kontak Kami</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                 <div class="text-center">
              <h2>Simpanan<strong>Qiu</strong></h2>
              <p class="lead mb-5">Jl. Barokah No. 06 Wanaherang Gunungputri 16965<br>
               CS: <a href="https://wa.me/+6281223952077">0812-2395-2077</a>  
              </p>
            </div>

            <?php 
            if($all['status'] == 1) {
?>
<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> Notifikasi!</h5>
    <p>Mohon maaf, karena Anda belum menjadi pengguna premium. Kami akan tetap merespons keluhan Anda, namun mungkin diperlukan waktu beberapa menit.</p>
</div>
 <?php
            } else {

              ?>
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Notifikasi!</h5>
    <p>Terima kasih karena Anda merupakan pengguna premium. Keluhan Anda, Kami akan segera merespons secepatnya.</p>
</div>
              <?php
           
            }
            ?>
            





              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Notifikasi</h3>
              </div>
              <!-- /.card-header -->
             <div class="card-body">
    <strong><i class="fas fa-envelope mr-1"></i>Pesan</strong>
    <p class="text-muted"><?= $jumlah ?></p>
    <hr>

    <strong><i class="fas fa-exclamation-triangle mr-1"></i> Belum Terlesaikan</strong>
    <p class="text-muted"><?= $belum_terbaca ?></p>
    <hr>

    <strong><i class="fas fa-check-circle mr-1"></i> Terlesaikan</strong>
    <p class="text-muted"><?= $sudah_terbaca ?></p>
</div>

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Keluhan Anda</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Kontak Kami</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                   <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal dan Waktu</th>
                    <th>Nama</th>
                    <th>E-Mail</th>
                    <th>Judul</th>
                    <th>Pesan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  
                  <tbody>
                   <?php
$no = 1;
$query = mysqli_query($koneksi, "SELECT * FROM kontak WHERE id_user = $id_users ORDER BY id_kontak DESC");
while ($k = mysqli_fetch_array($query)) {
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= date('d F Y H.i', strtotime($k['tgl_b'])) ?></td>
    <td><?= $k['nama'] ?></td>
    <td><?= $k['email'] ?></td>
    <td><?= $k['judul'] ?></td>
    <td><?= $k['pesan'] ?></td>
    <td><?= $k['status'] === '1' ? '<span class="badge_own text-bg-success_own">Terlesaikan</span>' : '<span class="badge_own text-bg-warning_own">Belum Terselesaikan </span>' ?></td>
    <td> <a href="#" class="btn btn-danger delete" data-id="<?= $k['id_kontak'] ?>"><i class="fa fa-trash"></i></a></td>
</tr>
<?php } ?>


                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
                  </div>
                  <!-- /.tab-pane -->
                
                  
                  <div class="tab-pane" id="settings">
                   <form id="ContactForm" method="post">
                       <input type="hidden" value="<?= $id_users ?>" id="number_contact" class="form-control" readonly />
                      <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="nama" id="nama" value="<?= $all['nama_user'] ?>" readonly placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">E-Mail</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" name="email" readonly id="email" value="<?= $all['email'] ?>" placeholder="Email" >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Judul">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="pesan" class="col-sm-2 col-form-label">Pesan</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="pesan" name="pesan" placeholder="Masukkan Pesan"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
  $('#ContactForm').on('submit', function(e) {
    e.preventDefault(); // Menghentikan tindakan default submit form

    const userId = $('#number_contact').val();
    const NamaOrang = $('#nama').val();
    const EmailOrang = $('#email').val();
    const Judul = $('#judul').val();
    const PesanOrang = $('#pesan').val();


    // Buat objek FormData untuk mengirim data dalam bentuk form
    const formData = new FormData();
    formData.append('id_user', userId);
    formData.append('nama', NamaOrang);
    formData.append('email', EmailOrang);
    formData.append('judul', Judul);
    formData.append('pesan', PesanOrang);

    $.ajax({
        type: "POST",
        url: "tambah-contact.php", // Sesuaikan dengan URL yang sesuai
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.includes("berhasil")) {
                   // Mengatur SweetAlert untuk ditampilkan setelah 2 detik
setTimeout(() => {
  Swal.fire({
    icon: 'success',
    title: 'Sukses',
    text: response,
    showConfirmButton: false,
    timer: 3000, // Menunggu 5 detik
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
                    icon: 'error',
                    title: 'Gagal',
                    text: response,
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


// Hapus
// Tambahkan event handler untuk tombol "Delete"
$('#example2').on('click', '.delete', function() {
  // Dapatkan ID kategori yang akan dihapus
  const categoryId = $(this).data('id');

  // Tampilkan konfirmasi penghapusan menggunakan SweetAlert
  Swal.fire({
    title: 'Konfirmasi Penghapusan',
    text: 'Anda yakin ingin menghapus keluhan ini?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      // Lakukan permintaan AJAX untuk menghapus keluhan
      $.ajax({
        url: 'delete-contact.php', // Ganti dengan URL yang sesuai
        method: 'POST',
        data: { id: categoryId },
        success: function(response) {
  if (response === 'success') {
    // Berhasil hapus keluhan
   // Mengatur SweetAlert untuk ditampilkan setelah 2 detik
setTimeout(() => {
  Swal.fire({
    icon: 'success',
    title: 'Keluhan Berhasil Dihapus!',
    showConfirmButton: false,
    timer: 2000, // Menunggu 5 detik
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
      title: 'Gagal Menghapus keluhan',
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
include "../view/footer_t.php";
?>