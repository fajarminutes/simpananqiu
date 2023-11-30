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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Kontak Kami</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

     <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-body row">
          <div class="col-5 text-center d-flex align-items-center justify-content-center">
            <div class="">
              <h2>Simpanan<strong>Qiu</strong></h2>
              <p class="lead mb-5">Jl. Barokah No. 06 Wanaherang Gunungputri 16965<br>
               CS: <a href="https://wa.me/+6281223952077">0812-2395-2077</a>  
              </p>
            </div>
          </div>
          <div class="col-7">
            
              <form id="ContactForm" method="post">
                <div class="form-group">
              <input type="hidden" value="<?= $id_users ?>" id="number_contact" class="form-control" readonly />
              <label for="nama">Nama</label>
              <input type="text" value="<?= $all['nama_user'] ?>" id="nama" class="form-control" readonly />
            </div>
            <div class="form-group">
              <label for="email">E-Mail</label>
              <input type="email" value="<?= $all['email'] ?>" id="email" class="form-control"  readonly/>
            </div>
            <div class="form-group">
              <label for="judul">Judul</label>
              <input type="text" id="judul" class="form-control" />
            </div>
            <div class="form-group">
              <label for="pesan">Pesan</label>
              <textarea id="pesan" class="form-control" rows="4"></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
            </form>
          </div>
        </div>
      </div>
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
    timer: 1000, // Menunggu 5 detik
    allowOutsideClick: false
  });
}, );
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

</script>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php 
include "../view/footer_t.php";
?>