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
if (isset($_SESSION['gagal_premium'])) {
    echo '<script>';
    echo 'Swal.fire({';
    echo '    position: "center",';
    echo '    icon: "warning",';
    echo '    title: "' . $_SESSION['gagal_premium'] . '",';
    echo '    showConfirmButton: false,';
    echo '    timer: 3000'; //Ini 3 detik
    echo '});';
    echo '</script>';
    unset($_SESSION['gagal_premium']); // Hapus pesan dari session
}
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
            <h1>Profil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
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
    var id_users = <?= $id_users ?>; // Ganti dengan nilai ID pengguna yang sesuai
    $.ajax({
        url: 'update-profile.php',
        method: 'GET',
        data: { id_users: id_users }, // Kirim parameter ID pengguna
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
    var id_users = <?= $id_users ?>; // Ganti dengan nilai ID pengguna yang sesuai
    $.ajax({
        url: 'update-about.php',
        method: 'GET',
        data: { id_users: id_users }, // Kirim parameter ID pengguna
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
<div class="modal fade" id="gambarModal<?= $id_users ?>" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel<?= $id_users ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title" id="gambarModalLabel<?= $id_users ?>">Gambar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
        <img src="../../data/img/users/<?= $all['foto'] ?>" alt="Gambar Modal" style="max-width: 100%; height: auto;">
      </div>
      <div class="modal-footer">
       <a href="../../data/img/users/<?= $all['foto'] ?>" download title="Download Gambar" class="btn btn-success"><i class="fas fa-download"></i> Download</a>
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
                  <!-- <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Aktivitas</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Waktu</a></li> -->
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Pengaturan Akun</a></li>
                <?php
$kode_contoh = "Minqiu Selalu Ada Untuk Kamu"; // Ganti dengan nilai kode_contoh yang sesuai dari database
$password_hash = password_hash($kode_contoh, PASSWORD_DEFAULT);
?>

<li class="nav-item"><a class="nav-link" href="../vr/kode.php?id=<?= $password_hash ?>">Verifikasi 2 Langkah</a></li>



                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                
                <div class="tab-content">
                  <div class=" tab-pane"  style="max-height: 700px; overflow-y: auto;" id="activity">
                    <!-- Post -->
                   <div id="aktifitas" class="post">
               </div>
              <script>
  // Fungsi untuk memperbarui profil
function Aktivitas() {
    var id_users = <?= $id_users ?>; // Ganti dengan nilai ID pengguna yang sesuai
    $.ajax({
        url: 'aktifitas.php',
        method: 'GET',
        data: { id_users: id_users }, // Kirim parameter ID pengguna
        dataType: 'json',
        success: function(data) {
            $('#aktifitas').html(data.ActivityData);
        },
        error: function() {
            // Penanganan kesalahan jika terjadi
        }
    });
}

  // Memanggil fungsi pembaruan setiap 1 detik
  setInterval(Aktivitas, 1000);
</script>
              
                    <!-- /.post -->

                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-user bg-info"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                          <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                          </h3>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-comments bg-warning"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                          <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                          <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-success">
                          3 Jan. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-camera bg-purple"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                          <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                          <div class="timeline-body">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->


                  <div class="tab-pane active" id="settings">

                   <form class="form-horizontal" id="editForm" enctype="multipart/form-data">
                    <input type="hidden" class="form-control id_users" name="id_user" value="<?= $all['id_user'] ?>" id="id_user" placeholder="Name">
                      <div class="form-group row">
                        <label for="nama_user" class="col-sm-2 col-form-label">Nama User</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="nama_user" value="<?= $all['nama_user'] ?>" id="nama_user" placeholder="Nama Lengkap">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="username" value="<?= $all['username'] ?>" id="username" placeholder="Username">
                        </div>
                      </div>
                     <div class="form-group row">
    <label for="inputName2" class="col-sm-2 col-form-label">Jenis Kelamin</label>
    <div class="col-sm-10">
        <div class="custom-control custom-radio">
            <input class="custom-control-input" type="radio" id="customRadio1" name="gender" value="Laki-Laki" <?php if($all['gender']=='Laki-Laki') echo 'checked'?>>
            <label for="customRadio1" class="custom-control-label">Laki-Laki</label>
        </div>
        <div class="custom-control custom-radio">
            <input class="custom-control-input" type="radio" id="customRadio2" name="gender" value="Perempuan" <?php if($all['gender']=='Perempuan') echo 'checked'?>>
            <label for="customRadio2" class="custom-control-label">Perempuan</label>
        </div>
    </div>
</div>

                       <div class="form-group row">
                        <label for="nohp" class="col-sm-2 col-form-label">No Handphone</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control"  name="no_hp" value="<?= $all['no_hp'] ?>" id="nohp" placeholder="Nomor Handphone">
                        </div>
                      </div>
                       <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" name="email"  value="<?= $all['email'] ?>" id="email" placeholder="Email">
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
                        <label for="fileInput" class="col-sm-2 col-form-label">Foto</label>

                         <div class="col-sm-10 input-container">
<input type="file" class="form-control-file" id="fileInput" name="fileInput" required onchange="validateAndPreviewImage()">
<img id="imgPreview" src="../../data/img/users/<?= $all['foto'] ?>"  style="max-width: 300px; max-height: 300px; margin-top: 10px;">

                      </div>
                      </div>
                     <!-- Ini adalah gambar pratinjau -->

                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                        <button type="button" class="btn btn-primary editSetting" id="">Simpan</button>
                        <a class=" btn btn-md btn-danger" href="#DeleteAccount" data-toggle="tab">Hapus Akun</a>
                        </div>
                      </div>
                    </form>
                 
  
<script>
 function validateAndPreviewImage() {
    const allowedExtensions = ["jpg", "jpeg", "png"];
    const fileInput = document.getElementById("fileInput");
    const imgPreview = document.getElementById('imgPreview');
   

    if (fileInput.files.length > 0) {
        const selectedFile = fileInput.files[0];
        const fileName = selectedFile.name;
        const fileExtension = fileName.split('.').pop().toLowerCase();

        if (allowedExtensions.includes(fileExtension)) {
            // File extension is allowed
            imgPreview.src = URL.createObjectURL(selectedFile); // Menampilkan gambar pratinjau
            document.getElementById("validationMessage").textContent = "";
           
        } else {
            // File extension is not allowed
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'File harus berupa JPG, JPEG, atau PNG.',
                showConfirmButton: false,
                timer: 3000,
            });
            fileInput.value = ""; // Clear the selected file
            imgPreview.src = ""; // Hapus gambar pratinjau
           
        }
    } else {
        imgPreview.src = ""; // Hapus gambar pratinjau jika tidak ada file yang dipilih
        document.getElementById("validationMessage").textContent = "";
       
    }
}


// Edit data
$('#editForm').on('click', '.editSetting', function(e) {
   e.preventDefault(); // Menghentikan tindakan default tombol submit

   const userId = $('#id_user').val(); // Dapatkan ID pengguna
   const nama_user = $('#nama_user').val();
   const fileInput = $('#fileInput')[0].files[0]; // Mengambil objek file yang dipilih
   const username = $('#username').val();
   const gender = $("input[name='gender']:checked").val();
   const no_hp = $('#nohp').val();
   const email = $('#email').val();
   const password = $('#password').val();

   // Buat objek FormData untuk mengirim data yang sesuai dengan tipe FormData
   const formData = new FormData();
   formData.append('id_user', userId);
   formData.append('nama_user', nama_user);
   formData.append('fileInput', fileInput);
   formData.append('username', username);
   formData.append('gender', gender);
   formData.append('no_hp', no_hp);
   formData.append('email', email);
   formData.append('password', password);

   Swal.fire({
     title: 'Konfirmasi Mengubah Data',
     text: 'Anda yakin ingin mengubah?',
     icon: 'question',
     showCancelButton: true,
     confirmButtonText: 'Simpan',
     cancelButtonText: 'Batal',
     
   }).then((result) => {
     if (result.isConfirmed) {
       // Kirim permintaan AJAX untuk mengedit data pengguna
       $.ajax({
         url: 'edit_user.php', // Ganti dengan URL yang sesuai
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

 <div class="tab-pane" id="DeleteAccount">

                   <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Sedih Mendengarnya, <?= $all['nama_user'] ?></h3>

              <div class="card-tools">
                <a href="#" class="btn btn-tool" ><i class="fas fa-info"></i></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5>Pesan Admin SimpananQiu</h5>
                <h6>Dari: simpananqiu@gmail.com
                  <?php 
                  date_default_timezone_set('Asia/Jakarta');
                    $currentDateTime = date('Y-m-d H:i:s');
          
                  ?>
                  <span class="mailbox-read-time float-right"><?= date('d F Y H.i', strtotime($currentDateTime)) ?></span></h6>
              </div>
           
              <div class="mailbox-read-message">
               <?php
date_default_timezone_set('Asia/Jakarta');
$waktu = date('H:i');

if ($waktu >= '00:00' && $waktu < '10:59') {
    $ucapan = "Selamat Pagi";
} elseif ($waktu >= '11:00' && $waktu < '14:59') {
    $ucapan = "Selamat Siang";
} elseif ($waktu >= '15:00' && $waktu < '17:59') {
    $ucapan = "Selamat Sore";
} else {
    $ucapan = "Selamat Malam";
}
?>

<p><?= $ucapan ?> <?= $all['nama_user'] ?></p>


                <p>Kami sangat sedih mendengar bahwa Anda berencana untuk menghapus akun SimpananQiu Anda. Kami memahami bahwa setiap keputusan ini dibuat dengan pertimbangan yang matang. Sebagai bagian dari komunitas SimpananQiu, Anda telah memberikan kontribusi yang berarti, dan kami ingin memastikan bahwa Anda merasa didengar dan dihargai. Kepergian Anda akan meninggalkan kekosongan yang dirasakan oleh kami dan komunitas.</p>

                <p>Mungkin ada aspek atau pengalaman tertentu yang membuat Anda merasa perlu untuk mengambil langkah ini. Jika Anda bersedia, kami ingin mendengar lebih lanjut tentang pengalaman Anda agar kami dapat terus memperbaiki layanan kami. Apakah ada sesuatu yang dapat kami lakukan untuk membuat pengalaman Anda lebih baik? Bisakah kami membantu memecahkan masalah atau kekhawatiran yang mungkin Anda hadapi?</p>
                
                <p>Jika Anda merasa bahwa ini adalah langkah yang harus diambil, kami ingin mengucapkan terima kasih atas waktu dan kontribusi Anda di SimpananQiu. Kami akan merindukan kehadiran Anda di sini. Semua yang terbaik untuk masa depan Anda, dan mungkin suatu saat kita akan bersua kembali.</p>
                
                <div>
                  <div style="float:right;margin-right:10px;">
                     <p>Dengan penuh kebersamaan,<br>Admin SimpananQiu </p>
                  </div>
                  <div style="float:left;">
                    
                  </div>
                </div>
               
               
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer delete-akun">
              <button type="button" class="btn btn-danger delete-account" data-id="<?= $id_users ?>"><i class="far fa-trash-alt"></i> Hapus Akun</button>
            </div>
            <!-- /.card-footer -->

            <script>
              
// Tambahkan event handler untuk tombol "Delete"
$('.delete-akun').on('click', '.delete-account', function() {
  // Dapatkan ID kategori yang akan dihapus
  const ID = $(this).data('id');

  // Tampilkan konfirmasi penghapusan menggunakan SweetAlert
  Swal.fire({
    title: 'Konfirmasi Penghapusan',
    text: 'Anda yakin ingin menghapus akun ini?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      // Lakukan permintaan AJAX untuk menghapus kategori
      $.ajax({
        url: 'delete-account.php', // Ganti dengan URL yang sesuai
        method: 'POST',
        data: { id: ID },
        success: function(response) {
  if (response === 'success') {
    // Berhasil mengedit kategori
    Swal.fire({
  title: 'Akun Telah Dihapus!',
  icon: 'success',
  showConfirmButton: false, // Menghilangkan tombol OK
  timer: 2000, // Menampilkan pesan selama 2 detik (sesuaikan sesuai kebutuhan)
  allowOutsideClick: false // Mencegah pengguna menutup pesan dengan mengklik di luar pesan
});

// Setelah 2 detik, redirect ke halaman back_login.php
setTimeout(function () {
  window.location.href = 'back_login.php';
}, 2000);
} else {
    Swal.fire({
      title: 'Gagal Menghapus Akun',
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
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
                  </div>
<!-- /.tab-pane -->

<div class="tab-pane" id="verifikasi">
 <form class="form-horizontal" id="editVerifikasi">
                    <input type="hidden" class="form-control id_users" name="id_user" value="<?= $all['id_user'] ?>" id="id_user" placeholder="Name">
                      <div class="form-group row">
                        <label for="vr" class="col-sm-2 col-form-label">Verifikasi 2 Langkah</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="vr" id="vr" placeholder="Masukkan Verifikasi 2 Langkah">
                           <span toggle="#vr" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                        </div>
                      </div>
                     

                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                        <button type="button" class="btn btn-primary EditVer" id="">Simpan</button>

                        </div>
                      </div>
                    </form>
                 
  
<script>
// Edit data
$('#editVerifikasi').on('click', '.EditVer', function(e) {
   e.preventDefault(); // Menghentikan tindakan default tombol submit

   const userId = $('#id_user').val(); // Dapatkan ID pengguna
   const vr = $('#vr').val();

   // Buat objek FormData untuk mengirim data yang sesuai dengan tipe FormData
   const formData = new FormData();
   formData.append('id_user', userId);
   formData.append('vr', vr);

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
         url: 'edit_vr.php', // Ganti dengan URL yang sesuai
         method: 'POST',
         data: formData, // Mengirim objek FormData
         dataType: 'json',
         processData: false, // Jangan memproses data
         contentType: false, // Jangan mengatur tipe konten
         success: function(response) {
          if (response.status === 'success') {
             Swal.fire({
               title: 'Data Verifikasi Telah Diedit',
               text: 'Perubahan berhasil disimpan.',
               icon: 'success',
               showConfirmButton: false,
               timer: 2000,
               allowOutsideClick: false
             });

           } else if (response.status === 'error') {
             Swal.fire({
               title: 'Gagal Mengedit Data Verifikasi',
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