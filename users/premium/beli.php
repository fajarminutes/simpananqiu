<?php 
include "../view/header_t.php";
include "../view/navbar_t.php";
include "../view/sidebar_t.php";

if(isset($_GET['no'])) {
    $premium = $_GET['no'];

    $target_query = "SELECT * FROM premium WHERE id_user = '$id_users'";
    $target_result = mysqli_query($koneksi, $target_query);
    $row = mysqli_fetch_assoc($target_result);

    if (mysqli_num_rows($target_result) > 0) {
       // Tidak sesuai, redirect ke halaman yang sesuai
        $_SESSION['gagal'] = 'Opps, Anda Sudah Melakukan Pemesanan!';
        echo '<script>window.location.href = "premium.php";</script>';
      } else {
       
    

    if($premium == 1 && $all['status'] == 1) {
        ?>

        
         <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tingkatkan Akun</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tingkatkan Akun</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
<h5><i class="fas fa-info"></i> Catatan:</h5>
Halaman ini merupakan halaman pemesanan, Silahkan mengisi data yang diperlukan.
</div>
            <div class="card">
           <div class="card-header">
    <form id="TabunganForm" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?= $id_users ?>" >

                    <div class="row">
                    <div class="col-lg-6">
                 <div class="form-group">
                    <label for="nama_premium">Nama Produk</label>
                    <input type="text" class="form-control" name="nama_premium" value="Bisnis" id="nama_premium" readonly>
                  </div>

                  <div class="form-group">
                    <label for="tipe_premium">Tipe Produk</label>
                    <input type="text" class="form-control" name="tipe_premium" value="Tahun" id="tipe_premium" readonly>
                  </div>

                  <div class="form-group">
                    <label for="">Harga</label>
                    <input type="text" class="form-control" name="" value="Rp 500.000,00" id="" readonly>
                    <input type="hidden" class="form-control" name="harga" value="500000" id="harga" readonly>
                  </div>

                  <div class="form-group">
                    <label for="bayaran">Metode Pembayaran</label>
                    <input type="text" class="form-control" name="bayaran" value="E-Wallet" id="bayaran" readonly>
                  </div>
                  
                  
                </div>

            
                    <div class="col-lg-6">


                    <div class="form-group">
    <label for="metode_pembayaran">E-Wallet</label>
    <select class="form-control select2" name="metode_pembayaran" id="metode_pembayaran" style="width: 100%;">
        <option value="">Pilih</option>
        <option value="081223952077 - Dana">081223952077 - Dana</option>
        <option value="081223952077 - Ovo">081223952077 - Ovo</option>
        <option value="081223952077 - Gopay">081223952077 - Gopay</option>
    </select>
</div>

<div class="form-group">
    <label for="bukti">Bukti Pembayaran</label>
    <input type="file" class="form-control" name="bukti"  id="bukti" accept=".jpg, .jpeg, .png">
    <div class="form-text">
        Lakukan transfer sejumlah Rp 1.100.000,00 (Satu Juta Seratus Ribu Rupiah) ke nomor E-Wallet yang dipilih di atas.
        Pastikan untuk menyertakan bukti pembayaran yang jelas.
    </div>
</div>



 <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                   <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Masukkan Keterangan" rows="3"></textarea>
                </div>
                

</div>

</div>
<div class="text-center">
<img id="imageValidationMessage" src="../dist/img/galeri.png" style="max-width: 250px; max-height: 250px;">
</div>
<div class="form-group">
                        <button type="submit" class="btn btn-success  tambahpemasukan" id=""><i class="fas fa-paper-plane"></i> Kirim</button>
                        <a href="premium.php" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i> Kembali</a>


                        </div>
                      </div>
                    </form>
</div>
                  </div>
          
<script>
   // Merekam perubahan pada input file
document.getElementById('bukti').addEventListener('change', function() {
    // Menampilkan bukti yang dipilih
    var previewImage = document.getElementById('imageValidationMessage');
    var file = this.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
        previewImage.src = e.target.result;
    };

    reader.readAsDataURL(file);
});


$('#TabunganForm').on('submit', function(e) {
    e.preventDefault(); // Menghentikan tindakan default submit form

    const userId = $('#user_id').val();
    const NamaPremium = $('#nama_premium').val();
    const TipePremium = $('#tipe_premium').val();
    const Harga = $('#harga').val();
    const MetodePembayaran = $('#metode_pembayaran').val();
    const Keterangan = $('#keterangan').val();
    const Bukti = $('#bukti')[0].files[0];

    // Buat objek FormData untuk mengirim data dalam bentuk form
    const formData = new FormData();
    formData.append('id_user', userId);
    formData.append('nama_premium', NamaPremium);
    formData.append('tipe_premium', TipePremium);
    formData.append('harga', Harga);
    formData.append('metode_pembayaran', MetodePembayaran);
    formData.append('keterangan', Keterangan);
    formData.append('bukti', Bukti);

    $.ajax({
        type: "POST",
        url: "aksi.php", // Sesuaikan dengan URL yang sesuai
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
  }).then(() => {
    // Menunggu 5 detik sebelum mereset ulang halaman
    setTimeout(() => {
      window.location.href = 'invoice.php';
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
</script>   
                  
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
        <?php 
    } else if($premium == 2) {
        ?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tingkatkan Akun</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tingkatkan Akun</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
<h5><i class="fas fa-info"></i> Catatan:</h5>
Halaman ini merupakan halaman pemesanan, Silahkan mengisi data yang diperlukan.
</div>
            <div class="card">
           <div class="card-header">
    <form id="TabunganForm_b" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?= $id_users ?>" >

                    <div class="row">
                    <div class="col-lg-6">
                 <div class="form-group">
                    <label for="nama_premium_b">Nama Produk</label>
                    <input type="text" class="form-control" name="nama_premium_b" value="Bisnis" id="nama_premium_b" readonly>
                  </div>

                  <div class="form-group">
                    <label for="tipe_premium_b">Tipe Produk</label>
                    <input type="text" class="form-control" name="tipe_premium_b" value="Bulan" id="tipe_premium_b" readonly>
                  </div>

                  <div class="form-group">
                    <label for="">Harga</label>
                    <input type="text" class="form-control" name="" value="Rp 50.000,00" id="" readonly>
                    <input type="hidden" class="form-control" name="harga_b" value="50000" id="harga_b" readonly>
                  </div>

                  <div class="form-group">
                    <label for="bayaran">Metode Pembayaran</label>
                    <input type="text" class="form-control" name="bayaran" value="E-Wallet" id="bayaran" readonly>
                  </div>
                  
                  
                </div>

            
                    <div class="col-lg-6">


                    <div class="form-group">
    <label for="metode_pembayaran_b">E-Wallet</label>
    <select class="form-control select2" name="metode_pembayaran_b" id="metode_pembayaran_b" style="width: 100%;">
        <option value="">Pilih</option>
        <option value="081223952077 - Dana">081223952077 - Dana</option>
        <option value="081223952077 - Ovo">081223952077 - Ovo</option>
        <option value="081223952077 - Gopay">081223952077 - Gopay</option>
    </select>
</div>

<div class="form-group">
    <label for="bukti_b">Bukti Pembayaran</label>
    <input type="file" class="form-control" name="bukti_b"  id="bukti_b" accept=".jpg, .jpeg, .png">
    <div class="form-text">
        Lakukan transfer sejumlah Rp 100.000,00 (Satu Juta Seratus Ribu Rupiah) ke nomor E-Wallet yang dipilih di atas.
        Pastikan untuk menyertakan bukti pembayaran yang jelas.
    </div>
</div>



 <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                   <textarea class="form-control" name="keterangan" id="keterangan_b" placeholder="Masukkan Keterangan" rows="3"></textarea>
                </div>
                

</div>

</div>
<div class="text-center ">
<img id="imageValidationMessage_b" src="../dist/img/galeri.png" style="max-width: 250px; max-height: 250px;">
</div>
<div class="card-footer" >
  <button type="submit" class="btn btn-success"  id=""><i class="fas fa-paper-plane"></i> Kirim</button>
  <a href="premium.php" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i> Kembali</a>


                        </div>
                      </div>
                    </form>
</div>
                  </div>
          
<script>
   // Merekam perubahan pada input file
document.getElementById('bukti_b').addEventListener('change', function() {
    // Menampilkan bukti yang dipilih
    var previewImage = document.getElementById('imageValidationMessage_b');
    var file = this.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
        previewImage.src = e.target.result;
    };

    reader.readAsDataURL(file);
});


$('#TabunganForm_b').on('submit', function(e) {
    e.preventDefault(); // Menghentikan tindakan default submit form

    const userId = $('#user_id').val();
    const NamaPremium = $('#nama_premium_b').val();
    const TipePremium = $('#tipe_premium_b').val();
    const Harga = $('#harga_b').val();
    const MetodePembayaran = $('#metode_pembayaran_b').val();
    const Keterangan = $('#keterangan_b').val();
    const Bukti = $('#bukti_b')[0].files[0];

    // Buat objek FormData untuk mengirim data dalam bentuk form
    const formData = new FormData();
    formData.append('id_user', userId);
    formData.append('nama_premium', NamaPremium);
    formData.append('tipe_premium', TipePremium);
    formData.append('harga', Harga);
    formData.append('metode_pembayaran', MetodePembayaran);
    formData.append('keterangan', Keterangan);
    formData.append('bukti', Bukti);

    $.ajax({
        type: "POST",
        url: "aksi.php", // Sesuaikan dengan URL yang sesuai
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
  }).then(() => {
    // Menunggu 5 detik sebelum mereset ulang halaman
    setTimeout(() => {
      window.location.href = 'premium.php';
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
</script>   
                  
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
        <?php

    
   } else {
        // Tidak sesuai, redirect ke halaman yang sesuai
        $_SESSION['gagal'] = 'Opps, Anda Gagal!';
        echo '<script>window.location.href = "premium.php";</script>';
    } 
  }
  }  else {
        // Tidak sesuai, redirect ke halaman yang sesuai
        $_SESSION['gagal'] = 'Opps, Anda Gagal!';
        echo '<script>window.location.href = "premium.php";</script>';
    }
?>


<?php 
include '../view/footer_t.php';
?>