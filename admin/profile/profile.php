<?php 
include "../view/header_t.php";
?>

  <?php 
include "../view/navbar_t.php";
?>

<?php 
include "../view/sidebar_t.php";
?>


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../dashboard/">Dashboard</a></li>
              <li class="breadcrumb-item active">Profil Pengguna</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
          <div id="profile-container" class="card card-primary card-outline">
  <!-- Konten profile -->
</div>
<script>
  // Fungsi untuk memperbarui profil
function updateProfile() {
    var id_admin = <?= $id_admin ?>; // Ganti dengan nilai ID pengguna yang sesuai
    $.ajax({
        url: 'update-profile.php',
        method: 'GET',
        data: { id_admin: id_admin }, // Kirim parameter ID pengguna
        dataType: 'json',
        success: function(data) {
            $('#profile-container').html(data.profileData);
        },
        error: function() {
            // Penanganan kesalahan jika terjadi
        }
    });
}
  // Memanggil fungsi pembaruan setiap 1 detik
  setInterval(updateProfile, 1000);
</script>
            <!-- /.card -->

            <!-- About Me Box -->
            <div id="profile-about" >
               </div>
              <script>
  // Fungsi untuk memperbarui profil
function updateAbout() {
    var id_admin = <?= $id_admin ?>; // Ganti dengan nilai ID pengguna yang sesuai
    $.ajax({
        url: 'update-about.php',
        method: 'GET',
        data: { id_admin: id_admin }, // Kirim parameter ID pengguna
        dataType: 'json',
        success: function(data) {
            $('#profile-about').html(data.aboutData);
        },
        error: function() {
            // Penanganan kesalahan jika terjadi
        }
    });
}

  // Memanggil fungsi pembaruan setiap 1 detik
  setInterval(updateAbout, 1000);
</script>

   

             <!-- Modal -->
<div class="modal fade" id="gambarModal<?= $id_admin ?>" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel<?= $id_admin ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title" id="gambarModalLabel<?= $id_admin ?>">Gambar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body text-center">
        <img src="../../assets/img/admin-aja.png" alt="Gambar Modal" style="max-width: 100%; height: auto;">
      </div>
      <div class="modal-footer text-center">
       <a href="../../assets/img/admin-aja.png" download title="Download Gambar" class="btn btn-success"><i class="fas fa-download"></i> Download</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Pengaturan Akun</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                
                <div class="tab-content">
                  
                 


                  <div class="tab-pane active" id="settings">

                   <form class="form-horizontal" id="editForm" enctype="multipart/form-data">
                    <input type="hidden" class="form-control id_admin" name="id_admin" value="<?= $all['id_admin'] ?>" id="id_admin" placeholder="Name">
                      <div class="form-group row">
                        <label for="nama_admin" class="col-sm-2 col-form-label">Nama Admin</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="nama_admin" value="<?= $all['nama_admin'] ?>" id="nama_admin" placeholder="Nama Lengkap">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="username" value="<?= $all['username'] ?>" id="username" placeholder="Username">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10 input-container">
                           <input type="password" class="form-control" value="" name="password" id="password" placeholder="Password">
            <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                      </div>


                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                        <button type="button" class="btn btn-primary editSetting" id="">Simpan</button>

                        </div>
                      </div>
                    </form>
                 
  
<script>
// Edit data
$('#editForm').on('click', '.editSetting', function(e) {
   e.preventDefault(); // Menghentikan tindakan default tombol submit

   const adminId = $('#id_admin').val(); // Dapatkan ID pengguna
   const nama_admin = $('#nama_admin').val();
   const username = $('#username').val();
   const password = $('#password').val();

   // Buat objek FormData untuk mengirim data yang sesuai dengan tipe FormData
   const formData = new FormData();
   formData.append('id_admin', adminId);
   formData.append('nama_admin', nama_admin);
   formData.append('username', username);
   formData.append('password', password);

   Swal.fire({
     title: 'Konfirmasi Mengubah Data',
     text: 'Anda yakin ingin menguah?',
     icon: 'question',
     showCancelButton: true,
     confirmButtonText: 'Simpan',
     cancelButtonText: 'Batal',
     
   }).then((result) => {
     if (result.isConfirmed) {
       // Kirim permintaan AJAX untuk mengedit data pengguna
       $.ajax({
         url: 'edit_admin.php', // Ganti dengan URL yang sesuai
         method: 'POST',
         data: formData, // Mengirim objek FormData
         dataType: 'json',
         processData: false, // Jangan memproses data
         contentType: false, // Jangan mengatur tipe konten
         success: function(response) {
           if (response.status === 'success') {
           // Mengatur SweetAlert untuk ditampilkan setelah 2 detik
setTimeout(() => {
  Swal.fire({
    title: 'Data Pengguna Telah Diubah',
    text: 'Perubahan berhasil disimpan.',
    icon: 'success',
    showConfirmButton: false,
    timer: 1000, // Menunggu 5 detik
    allowOutsideClick: false
  }).then(() => {
    // Menunggu 5 detik sebelum mereset ulang halaman
    setTimeout(() => {
      location.reload(); // Melakukan refresh halaman setelah 5 detik
    }, 3000);
  });
}, 1000);

           } else if (response.status === 'error') {
             Swal.fire({
               title: 'Gagal Mengedit Data Pengguna',
               html: response.message.join('<br>'),
               icon: 'error',
               showConfirmButton: false,
               timer: 2000,
               allowOutsideClick: false
             });
           }
         }
       });
     }
   });
 });

</script>




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
   <?php 
include "../view/footer_t.php";
?>
<!-- fungsi untuk melihat mata/ buka password -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.querySelector('.toggle-password');
    const passwordInput = document.querySelector(togglePassword.getAttribute('toggle'));
    
    togglePassword.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            togglePassword.classList.remove('fa-eye');
            togglePassword.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            togglePassword.classList.remove('fa-eye-slash');
            togglePassword.classList.add('fa-eye');
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.querySelector('.toggle-password2');
    const passwordInput = document.querySelector(togglePassword.getAttribute('toggle'));
    
    togglePassword.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            togglePassword.classList.remove('fa-eye');
            togglePassword.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            togglePassword.classList.remove('fa-eye-slash');
            togglePassword.classList.add('fa-eye');
        }
    });
});
</script>
