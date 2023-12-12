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
if (isset($_SESSION['id_keuangan'])) {
    $id_keuangan = $_SESSION['id_keuangan'];
?>


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Transaksi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Transaksi</li>
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
             <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                  <li class="pt-2 px-3"><h3 class="card-title">Ubah Data</h3></li>
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Transaksi</a>
                  </li>
                
                </ul>
              
               </div>
              <!-- /.card-header -->
             

  
              <div class="card-body">
                <div class="container-fluid ">
              <?php 
      $query_edit = mysqli_query($koneksi, "SELECT * FROM keuangan WHERE id_keuangan = '$id_keuangan' AND  id_user = '$id_users'");
    $edit = mysqli_fetch_array($query_edit) or die(mysqli_error($koneksi));
      ?>

                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                  
                      <form method="post" class="EditTransaksi" enctype="multipart/form-data">
                    <input type="hidden" class="form-control id_user" name="id_user"  value="<?= $id_users ?>">
                    <input type="hidden" class="form-control id_keuangan" name="id_keuangan"  value="<?= $edit['id_keuangan'] ?>">
                    <div class="form-group">
                      <label for="nama_keuangan">Transaksi</label>
  <select class="form-control select2 transaksi-keuangan" style="width:100;" >
    <option value="">Pilih</option>
    <option value="Pemasukan">Pemasukan</option>
    <option value="Pengeluaran">Pengeluaran</option>
  </select>
<div id="passwordHelpBlock" class="form-text">
  Silahkan mengisi transaksi sesuai dengan keinginan Anda.
</div>
                    <input type="hidden" class="form-control nilai_transaksi" name="nilai_transaksi">
                    <input type="hidden" class="form-control nilai_kategori" name="nilai_kategori">

                    </div>
                    <!-- Date and time -->
                    
               <div class="form-group">
  <label>Tanggal</label>
  <div class="input-group date" id="" data-target-input="nearest">
   <input type="text" name="tanggal_waktu_edit" value="<?= date('d/m/Y H:i', strtotime($edit['tgl_b'])) ?>"class="form-control datetimepicker-input tanggal_waktu_edit" data-target="#" />
    <div class="input-group-append" data-target="#" data-toggle="datetimepicker">
      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
    </div>
  </div>
</div>



                

                 <div class="form-group">
                    <label for="total_edit">Total</label>
                    <input type="number" value="<?= $edit['total'] ?>"  class="form-control total_edit" name="total_edit" placeholder="Masukkan Total">
                  </div>


                <div class="form-group">
  <label>Kategori</label>
  <select class="form-control select2 kategori-edit"  style="width: 100%;">
    <!-- Kategori akan dimuat di sini -->
  </select>
</div>

               
                <div class="form-group">
                  <label for="aset_edit">Aset</label>
                  <select name="aset_edit" class="form-control select2 aset-edit"  style="width:100%;">
                <?php 
                $id_aset = $edit['id_aset'];
                $q_aset = mysqli_query($koneksi, "SELECT * FROM aset WHERE id_aset = $id_aset");
                $r_aset = mysqli_fetch_array($q_aset);
                $transaksi = $r_aset['transaksi'];
                $query_aset = mysqli_query($koneksi, "SELECT * FROM aset WHERE id_user = '$id_users' AND transaksi = '$transaksi'");
echo '<option value="">Pilih</option>';
                while($row_aset = mysqli_fetch_array($query_aset)) {
                      $aset_id = $row_aset['id_aset'];
                      $nama_aset =  $row_aset['nama_aset'];
                      $grup =  $row_aset['grup'];

                      $selected = ($aset_id == $id_aset) ? 'selected' : '';
                      echo '<option value="' . $aset_id . '" ' . $selected . '>' . $grup . ' -  '.$nama_aset.'</option>';

                }
                ?>
                </select>
                </div>

                <div class="form-group">
                  <label for="catatan_edit">Catatan</label>
                   <textarea class="form-control catatan_edit" name="catatan_edit"  placeholder="Masukkan Catatan" rows="3"><?= $edit['catatan']  ?></textarea>
                </div>

                <div class="form-group">
  <label for="pilih_tipe">Pilih Tipe</label>
  <select class="form-control select2 pilih_tipe"  style="width:100%;">
    <option value="pilih">Pilih</option>
    <option value="deskripsi">Deskripsi</option>
    <option value="file">File</option>
  </select>
</div>

<div class="form-group deskripsi-input" style="display: none;">
  <label for="deskripsi_ubah">Deskripsi</label>
  <input type="text" name="deskripsi_ubah"  class="form-control deskripsi_ubah" placeholder="Masukkan Deskripsi">
</div>

<div class="form-group file-input" style="display: none;">
    <label for="fileInput_ubah">File</label>
    <input type="file" class="form-control fileInput_ubah" name="fileInput_ubah" id="fileInput" accept=".jpg, .jpeg, .png" placeholder="Masukkan File">
    <div class="text-center mt-3">
        <?php 
        $gambarPath = "../../data/img/transaksi/" . $edit['deskripsi']; // Path gambar sesuai dengan data dalam database
        if (file_exists($gambarPath)) {
            echo '<img src="../../data/img/transaksi/' . $edit['deskripsi']. '" alt="Gambar" style="max-width: 300px; max-height: 300px;">';
        } else {
            echo '<img src="../dist/img/galeri.png" style="max-width: 300px; max-height: 300px;">';
        }
        ?>
    </div>
</div>

<div id="imageValidationMessage" style="display: none; color: red;"></div>

<script>
document.getElementById("fileInput").addEventListener("change", function() {
    const fileInput = this;
    const imageValidationMessage = document.getElementById("imageValidationMessage");

    if (fileInput.files.length > 0) {
        const selectedFile = fileInput.files[0];
        const fileExtension = selectedFile.name.split('.').pop().toLowerCase();

        if (fileExtension === "jpg" || fileExtension === "jpeg" || fileExtension === "png") {
            // File yang dipilih adalah gambar
            const imgPreview = document.querySelector(".form-group.file-input .text-center img");
            imgPreview.src = URL.createObjectURL(selectedFile);
            imageValidationMessage.style.display = "none";
        } else {
            // File yang dipilih bukan gambar
            imageValidationMessage.textContent = "Hanya file gambar (JPG, JPEG, atau PNG) yang diizinkan.";
            imageValidationMessage.style.display = "block";
            fileInput.value = ""; // Hapus file yang dipilih
        }
    } else {
        imageValidationMessage.style.display = "none";
    }
});
</script>




             
<div class="form-group">
                        <div class="">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                         <a href="transaksi.php"><button type="button" class="btn btn-warning">Kembali</button></a>

                        </div>
                      </div>
                    </form>
                  
                  </div>
                 
                
                </div>
               </div>
                </div>
                  </div>
               
                 
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <?php
// Ambil nama gambar dari database
$namaGambarDariDatabase = $edit['deskripsi'];
?>

<script>
// Menggunakan PHP untuk mengirim nama gambar ke JavaScript
var namaGambarDariDatabase = "<?php echo $namaGambarDariDatabase; ?>";
</script>




 <script>

          // Edit data
$('.EditTransaksi').on('submit', function(e) {
    e.preventDefault(); // Menghentikan tindakan default submit form

   const id_user = $('.id_user').val();
const id_keuangan = $('.id_keuangan').val();
const nilai_transaksi = $('.nilai_transaksi').val();
const nilai_kategori = $('.nilai_kategori').val();
const tanggal_waktu_edit = $('.tanggal_waktu_edit').val();
const total_edit = $('.total_edit').val();
const aset_edit = $('.aset-edit').val();
const catatan_edit = $('.catatan_edit').val();
const deskripsi_ubah = $('.deskripsi_ubah').val();
const fileInput_ubah = $('.fileInput_ubah')[0].files[0];

// Buat objek FormData untuk mengirim data dalam bentuk form
const formData = new FormData();
formData.append('id_user', id_user); // Perbaiki nama variabel
formData.append('id_keuangan', id_keuangan); // Perbaiki nama variabel
formData.append('nilai_transaksi', nilai_transaksi);
formData.append('nilai_kategori', nilai_kategori);
formData.append('tanggal_waktu_edit', tanggal_waktu_edit);
formData.append('total_edit', total_edit);
formData.append('aset_edit', aset_edit);
formData.append('catatan_edit', catatan_edit);
formData.append('deskripsi_ubah', deskripsi_ubah);
formData.append('fileInput_ubah', fileInput_ubah);


    $.ajax({
        type: "POST",
        url: "edit.php", // Sesuaikan dengan URL yang sesuai
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


$(document).ready(function () {
  $(".pilih_tipe").change(function () {
    var selectedTipe = $(this).val();

    if (selectedTipe === "deskripsi") {
      $(".deskripsi-input").show();
      $(".file-input").hide();
      // Kosongkan input deskripsi
       // Mengambil deskripsi dari database yang telah disimpan di dalam elemen input tersembunyi
      // Cek apakah gambar sesuai dengan deskripsi ada di folder
var gambarPath = "../../data/img/transaksi/" + namaGambarDariDatabase;

// Buat elemen gambar baru
var img = new Image();
img.src = gambarPath;

img.onload = function () {
  // Gambar sesuai dengan deskripsi ada, tampilkan gambar itu
  $(".form-group.file-input .text-center img").attr("src", gambarPath);
  $(".deskripsi_ubah").val(""); // Tampilkan deskripsi yang sesuai
};

img.onerror = function () {
  // Gambar sesuai dengan deskripsi tidak ada, tampilkan gambar alternatif
  $(".form-group.file-input .text-center img").attr("src", "../dist/img/galeri.png");
  // Tampilkan deskripsi dari var (bisa disesuaikan dengan deskripsi alternatif)
  $(".deskripsi_ubah").val(namaGambarDariDatabase);
};

      // Hapus atribut "src" gambar
      $(".form-group.file-input .text-center img").removeAttr("src");
    } else if (selectedTipe === "file") {
      $(".deskripsi-input").hide();
      $(".file-input").show();

      // Cek apakah gambar sesuai dengan deskripsi ada di folder
      var gambarPath = "../../data/img/transaksi/" + namaGambarDariDatabase;

      // Buat elemen gambar baru
      var img = new Image();
      img.src = gambarPath;

      img.onload = function () {
        // Gambar sesuai dengan deskripsi ada, tampilkan gambar itu
        $(".form-group.file-input .text-center img").attr("src", gambarPath);
      };

      img.onerror = function () {
        // Gambar sesuai dengan deskripsi tidak ada, tampilkan gambar alternatif
        $(".form-group.file-input .text-center img").attr("src", "../dist/img/galeri.png");
      };


      // Hapus gambar yang telah dipilih (reset input file)
      $(".fileInput_ubah").val("");
      // Sembunyikan pesan validasi gambar jika ada
      $("#imageValidationMessage").hide();
    } else {
      $(".deskripsi-input").hide();
      $(".file-input").hide();
      // Kosongkan input deskripsi dan reset input file serta gambar jika ada
      $(".deskripsi_ubah").val("");
      $(".fileInput_ubah").val("");
      // Hapus atribut "src" gambar
      $(".form-group.file-input .text-center img").removeAttr("src");
      // Sembunyikan pesan validasi gambar jika ada
      $("#imageValidationMessage").hide();
    }
  });
});




   

$(document).ready(function () {

  // Ketika jenis transaksi berubah
    $('.transaksi-keuangan').on('change', function () {
        var selectedTransaksi = $(this).val();
        
        // Ganti elemen dengan ID "nilai_transaksi" dengan nilai yang sesuai
        if (selectedTransaksi === 'Pemasukan') {
            $('.nilai_transaksi').val('Pemasukan');
        } else if (selectedTransaksi === 'Pengeluaran') {
            $('.nilai_transaksi').val('Pengeluaran');
        }
    });

      // Ketika jenis transaksi berubah
   // Ketika jenis transaksi berubah
$('.kategori-edit').on('change', function () {
    var selectedKategori = $(this).val();
    
    // Ganti nilai dari input dengan nama "nilai_kategori" dengan nilai yang sesuai
    $('.nilai_kategori').val(selectedKategori);
});

  // Saat halaman dimuat
  $('.transaksi-keuangan').each(function () {
    var savedTransaksi = $(this).data('transaksi');
    var id_user = $('.id_user').val();
    
    // Set opsi yang dipilih berdasarkan transaksi yang tersimpan dalam data
    $(this).val(savedTransaksi);
    
    // Kirim permintaan AJAX untuk memuat kategori berdasarkan transaksi
    var kategoriSelect = $(this).closest('form').find('.kategori-edit'); // Cari elemen kategori di dalam form terkait
    $.ajax({
      type: 'GET',
      url: 'get_kategori.php', // Ganti dengan URL yang sesuai untuk mengambil kategori
      data: { transaksi: savedTransaksi, id_user: id_user }, // Kirim jenis transaksi dan id_user ke server
      success: function (response) {
        // Perbarui pilihan kategori dengan hasil dari server
        kategoriSelect.html(response);
      }
    });
  });
  
  // Ketika jenis transaksi berubah
  $('.transaksi-keuangan').on('change', function () {
    var selectedTransaksi = $(this).val();
    var id_user = $('.id_user').val();
    
    // Kirim permintaan AJAX untuk mendapatkan kategori
    var kategoriSelect = $(this).closest('form').find('.kategori-edit'); // Cari elemen kategori di dalam form terkait
    $.ajax({
      type: 'GET',
      url: 'get_kategori.php', // Ganti dengan URL yang sesuai untuk mengambil kategori
      data: { transaksi: selectedTransaksi, id_user: id_user }, // Kirim jenis transaksi dan id_user ke server
      success: function (response) {
        // Perbarui pilihan kategori dengan hasil dari server
        kategoriSelect.html(response);
      }
    });
  });
});







</script>

   <?php 

include "../view/footer_t.php";
?>

<?php 
} else {
  $_SESSION['gagal'] = 'Opps, Anda Gagal!';
  echo '<script>window.location.href = "transaksi.php";</script>';
}
?>