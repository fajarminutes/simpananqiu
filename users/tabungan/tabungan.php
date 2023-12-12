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
            <h1>Menabung</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../index.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Menabung</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
    <li class="nav-item" id="kategoriTab" style="display: none;">
        <a class="nav-link" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Target Menabung</a>
    </li>
  
</ul>

        <div class="row">
          <div class="col-12">
            
            <div class="card">
              
              <div class="card-header">
                 <div class="row">
                <h3 class="card-title">Data Target Menabung</h3>
                    </div>
                <div class="row mt-2">
                    <div class="col-1" style="margin-bottom:-50px;">
                
                     <a class="btn btn-app" id="tombol" onclick="showTabAndHideButton('custom-tabs-four-home')">
                            <i class="fas fa-plus"></i> Plus
                        </a>
              </div>
              </div>
             <script>
    function showTabAndHideButton(tabId) {
        // Menampilkan tab yang diklik
        $(`#custom-tabs-four-tab a[href="#${tabId}"]`).tab("show");
        
        // Menghilangkan tombol "Plus"
        document.getElementById("tombol").style.display = "none";
        
        
        // Menampilkan elemen "Kategori" dan "Pengeluaran"
        document.getElementById("kategoriTab").style.display = "block";
        document.getElementById("custom-tabs-four-tabContent").style.display = "block";
        document.getElementById("pengeluaranTab").style.display = "block";
    }

       function hide(tabId) {
        // Menampilkan tab yang diklik
        $(`#custom-tabs-four-tab a[href="#${tabId}"]`).tab("show");
        
        // Menghilangkan tombol "Plus"
        document.getElementById("tombol1").style.display = "none";
        
        
        // Menampilkan elemen "Kategori" dan "Pengeluaran"
        document.getElementById("kategoriTab").style.display = "block";
        document.getElementById("custom-tabs-four-tabContent").style.display = "block";
        document.getElementById("pengeluaranTab").style.display = "block";
    }

    function muncul(tabId) {
        // Menampilkan tab yang diklik
        $(`#custom-tabs-four-tab a[href="#${tabId}"]`).tab("show");
        
        // Menghilangkan tombol "Plus"
        document.getElementById("tombol").style.display = "block";
        
        
        // Menampilkan elemen "Kategori" dan "Pengeluaran"
        document.getElementById("kategoriTab").style.display = "none";
        document.getElementById("custom-tabs-four-tabContent").style.display = "none";
        document.getElementById("pengeluaranTab").style.display = "none";
    }

    function kembali(tabId) {
        // Menampilkan tab yang diklik
        $(`#custom-tabs-four-tab a[href="#${tabId}"]`).tab("show");
        
        // Menghilangkan tombol "Plus"
        document.getElementById("tombol1").style.display = "block";
        
        
        // Menampilkan elemen "Kategori" dan "Pengeluaran"
        document.getElementById("kategoriTab").style.display = "none";
        document.getElementById("custom-tabs-four-tabContent").style.display = "none";
        document.getElementById("pengeluaranTab").style.display = "none";
    }
</script>
 

              <div class="card-body">

                 <div class="tab-content" id="custom-tabs-four-tabContent" style="display: none;">
                  <div class="tab-pane fade show active" id="custom-tabs-four-home"  role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                    

                    <!-- Form -->
 <form id="TabunganForm" class="Kategori" method="post" enctype="multipart/form-data">
                                <input type="hidden" class="form-control"  name="user_id" id="user_id"  value="<?= $id_users ?>">
                                

                                <div class="row">
                                <div class="col-sm-6">

                                <div class="form-group">
                                <label for="nama_tabungan">Nama Tabungan</label>
                                <input type="text" class="form-control"  name="nama_tabungan" id="nama_tabungan" placeholder="Masukkan Nama Tabungan">
                            </div>

                            <div class="form-group">
                                <label for="target">Target Tabungan</label>
                                <input type="text" class="form-control"  id="target" placeholder="Masukkan Target Tabungan" oninput="convertCurrency(this)">
    <input type="hidden" class="form-control nilai_total"  name="target_tabungan" id="target_tabungan">
                            </div>

                            <script>
function convertCurrency(inputElement) {
    // Ambil nilai input total
    let inputTotal = inputElement.value;

    // Hilangkan karakter non-numeric dari input (misal: ,)
    let numericValue = inputTotal.replace(/[^\d]/g, '');

    // Setel nilai yang sesuai ke input nilai_total
    let nilaiTotalInput = inputElement.closest('.form-group').querySelector('.nilai_total');
    nilaiTotalInput.value = numericValue;

    // Format nilai sebagai mata uang dengan menggunakan fungsi rupiah
    let formattedValue = "Rp " + addThousandSeparator(numericValue);

    // Setel nilai yang diformat kembali ke input total
    inputElement.value = formattedValue;
}

function convertCurrencyNominal(inputElement) {
    // Ambil nilai input total
    let inputTotal = inputElement.value;

    // Hilangkan karakter non-numeric dari input (misal: ,)
    let numericValue = inputTotal.replace(/[^\d]/g, '');

    // Setel nilai yang sesuai ke input nominal_ngisi
    let nilaiTotalInput = inputElement.closest('.form-group').querySelector('.nominal_ngisi');
    nilaiTotalInput.value = numericValue;

    // Format nilai sebagai mata uang dengan menggunakan fungsi rupiah
    let formattedValue = "Rp " + addThousandSeparator(numericValue);

    // Setel nilai yang diformat kembali ke input total
    inputElement.value = formattedValue;
}

const addThousandSeparator = (number) => {
    // Menggunakan regex untuk menambahkan pemisah ribuan
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
};



</script>

                            </div>

                            <div class="col-sm-6">
                               <div class="form-group">
                  <label for="rencana_pengisian">Rencana Pengisian</label>
                  <select class="form-control select2" name="rencana_pengisian" id="rencana_pengisian" style="width: 100%;">
                    <option value="Harian">Harian</option>
                    <option value="Mingguan">Mingguan</option>
                    <option value="Bulanan">Bulanan</option>
                  </select>
                </div>
                  
               <div class="form-group">
    <label for="nominal_ngisi">Nominal Pengisian</label>
    <div class="input-group">
        <input type="text" name="nominal_ngisi" placeholder="Masukkan Nominal Pengisian" id="nominal_ngisi" class="form-control" oninput="convertCurrencyNominal(this)">
    <input type="hidden" class="form-control nominal_ngisi"  name="nominal_pengisian" id="nominal_pengisian">
        <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
        </div>
    </div>
</div>


                            </div>
                            </div>


                             <div class="form-group">
                                <label for="fileInput">Gambar</label>
                                <input type="file" class="form-control"  name="fileInput" id="fileInput" accept=".jpg, .jpeg, .png"  placeholder="Masukkan Nama Tabungan">
                            </div>
                            <div class="text-center">
<img id="imageValidationMessage" src="../dist/img/galeri.png" style="max-width: 250px; max-height: 250px;">
</div>

                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                           <button type="button" class="btn btn-success mt-3" id="tombolKembali">Kembali</button>

                        </form>
                        
<script>


 // Merekam perubahan pada input file
document.getElementById('fileInput').addEventListener('change', function() {
    // Menampilkan fileInput yang dipilih
    var previewImage = document.getElementById('imageValidationMessage');
    var file = this.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
        previewImage.src = e.target.result;
    };

    reader.readAsDataURL(file);
});


// Fungsi untuk mengosongkan isian formulir
function resetForm() {
    document.querySelector(".Kategori").reset();
}


// Fungsi untuk perangkat handphone
function kembaliHandphone(target) {
    // Tambahkan kode yang ingin Anda jalankan untuk perangkat handphone di sini
    resetForm(); // Mengosongkan isian formulir
    kembali();
}

// Fungsi untuk perangkat laptop
function kembaliLaptop(target) {
    // Tambahkan kode yang ingin Anda jalankan untuk perangkat laptop di sini
    resetForm(); // Mengosongkan isian formulir
    muncul();
}

// Periksa jenis perangkat dan atur fungsi onclick sesuai kebutuhan
if (window.innerWidth <= 768) {
    document.getElementById('tombolKembali').onclick = function() {
        kembaliHandphone('custom-tabs-four-home');
    };
} else {
    document.getElementById('tombolKembali').onclick = function() {
        kembaliLaptop('custom-tabs-four-home');
    };
}

$('#TabunganForm').on('submit', function(e) {
    e.preventDefault(); // Menghentikan tindakan default submit form

    const userId = $('#user_id').val();
    const tabungan = $('#nama_tabungan').val();
    const target_tabungan = $('#target_tabungan').val();
    const rencana = $('#rencana_pengisian').val();
    const nominal = $('#nominal_pengisian').val();
    const fileInput = $('#fileInput')[0].files[0];

    // Buat objek FormData untuk mengirim data dalam bentuk form
    const formData = new FormData();
    formData.append('id_user', userId);
    formData.append('nama_tabungan', tabungan);
    formData.append('target_tabungan', target_tabungan);
    formData.append('rencana_pengisian', rencana);
    formData.append('nominal_pengisian', nominal);
    formData.append('fileInput', fileInput);

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


</script>

                <!-- /.form group -->
                  </div>
                </div>
          

              </div>
              </div>
              <!-- /.card-header -->
            
               
<script>
$(document).ready(function() {

// Tambahkan event handler untuk tombol "Delete"
$('#berlangsung-container, .tercapai-container').on('click', '.delete-tabungan', function() {
  // Dapatkan ID kategori yang akan dihapus
  const id_tabungan = $(this).data('id');

  // Tampilkan konfirmasi penghapusan menggunakan SweetAlert
  Swal.fire({
    title: 'Konfirmasi Penghapusan',
    text: 'Anda yakin ingin menghapus tabungan ini?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      // Lakukan permintaan AJAX untuk menghapus tabungan
      $.ajax({
        url: 'delete_tabungan.php', // Ganti dengan URL yang sesuai
        method: 'POST',
        data: { id: id_tabungan },
        success: function(response) {
  if (response === 'success') {
    // Berhasil mengedit tabungan
    setTimeout(() => {
    Swal.fire({
      title: 'Tabungan Telah Dihapus!',
      icon: 'success',
      showConfirmButton: false, // Menghilangkan tombol OK
      timer: 2000, // Menampilkan pesan selama 2 detik (sesuaikan sesuai kebutuhan)
      allowOutsideClick: false // Mencegah pengguna menutup pesan dengan mengklik di luar pesan
    }).then(() => {
    // Menunggu 5 detik sebelum mereset ulang halaman
    setTimeout(() => {
      location.reload(); // Melakukan refresh halaman setelah 5 detik
    }, 1000);
  });
}, 1000);
  } else {
    Swal.fire({
      title: 'Gagal Menghapus Tabungan',
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

});


</script>

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
 <div style="margin-top:-10px">
              <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                  <li class="pt-2 px-3"><h3 class="card-title">Target Menabung</h3></li>
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Berlangsung</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Tercapai</a>
                  </li>
                </ul>
              </div>
              <div class="card-body" style="max-height: 700px; overflow-y: auto;">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                    <div id="berlangsung-container" class="row">
                      <?php 
                        $result = mysqli_query($koneksi, "SELECT * FROM tabungan WHERE id_user = $id_users");
        $dataDitemukan = false; // Variabel penanda

        while ($d = mysqli_fetch_array($result)) {
            $id_tabungan = $d['id_tabungan'];
            $query_catat = mysqli_query($koneksi, "SELECT id_tabungan, SUM(nominal) AS total_nominal FROM catat_tabungan WHERE id_tabungan = $id_tabungan GROUP BY id_tabungan");
            $catat = mysqli_fetch_array($query_catat);

            if (!$catat || $d['target'] > $catat['total_nominal']) {
                
    
              // After fetching $d['id_tabungan']
$_SESSION['id_tabungan'] = $d['id_tabungan'];

               
                echo '<div class="col-md-4">';
            echo '  <div class="card mb-4">';
            echo '    <div class="card-body">';
            echo '      <h5 class="card-text nama_tabungan"  data-id="' . $d['id_tabungan'] . '">' . $d['nama_tabungan'] . '</h5>';
            echo '<div class="text-center mb-2">';
            $gambarPath = "../../data/img/tabungan/" . $d['gambar']; // Path gambar sesuai dengan data dalam database
            if (empty($d['gambar']) || !file_exists($gambarPath)) {
                // Tampilkan "galeri.png" jika kolom gambar kosong atau file gambar tidak ada
                $gambarPath = "../dist/img/galeri.png";
            }

            echo '<a href="#" data-toggle="modal" title="Klik Gambar" class="edit-modal modal-gambar" data-id="'.$d['id_tabungan'].'" data-target="#gambarModal_t'.$d['id_tabungan'].'">
            <img style="width:250px;height:250px;border-radius:20px;"
                 src="'.$gambarPath.'"
                 alt="Gambar Tabungan">
                 </a>';
            echo '</div>';
             
$formatTarget = 'Rp' . number_format($d['target'], 2, ',', '.');
$formatUang = 'Rp' . number_format($d['nominal'], 2, ',', '.');
?>

<div class="profile-info">
    <h3 class="profile-username text-bold"><?= $formatTarget ?></h3>
    <div style="margin-bottom:-13px;">
        <?php
        $id_tabungan = $d['id_tabungan'];

        // Query untuk mengambil data dari tabel catat_tabungan
        $query_catat = mysqli_query($koneksi, "SELECT nominal FROM catat_tabungan WHERE id_tabungan = $id_tabungan");

        // Inisialisasi variabel untuk menyimpan total nominal positif dan negatif
        $total_positif = 0;
        $total_negatif = 0;

        while ($catat = mysqli_fetch_assoc($query_catat)) {
            // Pisahkan tanda dan nilai
            $tanda = substr($catat['nominal'], 0, 1); // Ambil karakter pertama (tanda)
            $nilai = (int) substr($catat['nominal'], 1); // Ambil nilai setelah karakter pertama

            // Lakukan perhitungan berdasarkan tanda
            if ($tanda === '+') {
                $total_positif += $nilai;
            } elseif ($tanda === '-') {
                $total_negatif += $nilai;
            }
        }

        // Hitung total nominal
        $total_nominal = $total_positif - $total_negatif;

        // Hitung persentase progres
        $hitung_persen = min(($total_nominal / $d['target']) * 100, 100); // Persen tidak boleh lebih dari 100
        ?>

        <input type="text" class="knob" value="<?= number_format($hitung_persen, 0, '', '') ?>" readonly data-width="60" data-height="60" data-fgColor="#3c8dbc">
    </div>
</div>

<p style="margin-top:-20px; font-weight:bold; color:black;"><?= $formatUang ?> 
    <?php
    if ($d['rencana'] === 'Harian') {
        echo 'Perhari';
    } elseif ($d['rencana'] === 'Mingguan') {
        echo 'Perminggu';
    } elseif ($d['rencana'] === 'Bulanan') {
        echo 'Perbulan';
    }
    ?>
</p>
<?php 

            echo '<hr>';
             echo '<div class="text-center">';
             $id_tabungan = $d['id_tabungan'];
           // Query untuk mengambil data dari tabel catat_tabungan
$query_catat = mysqli_query($koneksi, "SELECT nominal FROM catat_tabungan WHERE id_tabungan = $id_tabungan");
            // Inisialisasi variabel untuk menyimpan total nominal
$total_nominal = 0;

while ($catat = mysqli_fetch_assoc($query_catat)) {
    // Pisahkan tanda dan nilai
    $tanda = substr($catat['nominal'], 0, 1); // Ambil karakter pertama (tanda)
    $nilai = (int) substr($catat['nominal'], 1); // Ambil nilai setelah karakter pertama

    // Lakukan perhitungan berdasarkan tanda
    if ($tanda === '+') {
        $total_nominal += $nilai;
    } elseif ($tanda === '-') {
        $total_nominal -= $nilai;
    }
}

// Hitung sisa target
$sisa_target = max(0, $d['target'] - $total_nominal);

// Hitung estimasi waktu
$estimasi_waktu = floor($sisa_target / $d['nominal']); // Menggunakan floor untuk membulatkan ke bawah
            if($d['rencana'] === 'Harian') {
                echo '<h6 class="card-text text-bold" style="font-size:15px;">' . $estimasi_waktu. ' Perhari</h6>';
            } else if($d['rencana'] === 'Mingguan') {
                echo '<h6 class="card-text text-bold" style="font-size:15px;">' . $estimasi_waktu. ' Perminggu</h6>';
            } else if($d['rencana'] === 'Bulanan') {
                echo '<h6 class="card-text text-bold" style="font-size:15px;">' . $estimasi_waktu. ' Perbulan</h6>';
            }
// ...


        
             echo '</div>';
           echo '<a href="catat_tabungan.php?nama=' . $id_users . '&no=' . $d['id_tabungan'] . '" class="btn btn-warning"><i class="fa fa-pen"></i></a>';


            echo '     <a href="#" class="btn btn-danger delete-tabungan" data-id="' . $d['id_tabungan'] . '"><i class="fa fa-trash"></i></a>';
            echo '    </div>';
            echo '  </div>';
            echo '</div>';
           
                $dataDitemukan = true; // Set variabel penanda ke true
            }
        }

        if (!$dataDitemukan) {
            // Tidak ada data yang memenuhi target
            echo '<div style="text-align:center;">';
            echo '<a href="#" data-toggle="modal" title="No Data">';
            echo '<img style="width:300px;height:300px;border-radius:20px;margin: auto;"';
            echo 'src="../dist/img/no_data.jpg" alt="Gambar Tabungan">';
            echo '</a>';
            echo '<p>Tidak ada data untuk ditampilkan.</p>';
            echo '</div>';
        }
                      ?>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                    <div  class="row tercapai-container">
                      <?php
                      $result = mysqli_query($koneksi, "SELECT * FROM tabungan WHERE id_user = $id_users ");
    $dataDitemukan = false; // Variabel penanda

    while ($d = mysqli_fetch_array($result)) {
        $id_tabungan = $d['id_tabungan'];

            // Query untuk mengambil data dari tabel catat_tabungan
$query_catat = mysqli_query($koneksi, "SELECT nominal FROM catat_tabungan WHERE id_tabungan = $id_tabungan");
            // Inisialisasi variabel untuk menyimpan total nominal
$total_tambah = 0;
$total_kurang = 0;

while ($catat = mysqli_fetch_assoc($query_catat)) {
    // Pisahkan tanda dan nilai
    $tanda = substr($catat['nominal'], 0, 1); // Ambil karakter pertama (tanda)
    $nilai = (int) substr($catat['nominal'], 1); // Ambil nilai setelah karakter pertama

    // Lakukan perhitungan berdasarkan tanda
    if ($tanda === '+') {
        $total_tambah += $nilai;
    } elseif ($tanda === '-') {
        $total_kurang -= $nilai;
    }

}

        $totalNominal = $total_tambah + $total_kurang; // Selisih total 'tambah' dan 'kurang
        $target = $d['target'];
        $toleransi = 0.01; // Toleransi (misalnya, 1 sen)

        if (abs($totalNominal - $target) <= $toleransi) {
            // Data mencapai atau melebihi target
            echo '<div class="col-md-4">';
            echo '  <div class="card mb-4">';
            echo '    <div class="card-body ">';
            echo '      <h5 class="card-text nama_tabungan" data-id="' . $d['id_tabungan'] . '">' . $d['nama_tabungan'] . '</h5>';
            echo '<div class="text-center mb-2">';
            $gambarPath = "../../data/img/tabungan/" . $d['gambar']; // Path gambar sesuai dengan data dalam database
            if (empty($d['gambar']) || !file_exists($gambarPath)) {
                // Tampilkan "galeri.png" jika kolom gambar kosong atau file gambar tidak ada
                $gambarPath = "../dist/img/galeri.png";
            }

            echo '<a href="#" data-toggle="modal" title="Klik Gambar" class="edit-modal modal-gambar" data-id="'.$d['id_tabungan'].'" data-target="#gambarModal_t'.$d['id_tabungan'].'">';
            echo '<img style="width:250px;height:250px;border-radius:20px;margin: auto;"';
            echo 'src="'.$gambarPath.'" alt="Gambar Tabungan">';
            echo '</a>';
            echo '</div>';
            echo '      <p class="card-text id_user" style="display:none;">' . $d['id_user'] . '</p>';
                        
$formatTarget = 'Rp' . number_format($d['target'], 2, ',', '.');
$formatUang = 'Rp' . number_format($d['nominal'], 2, ',', '.');
?>

<div class="profile-info">
    <h3 class="profile-username text-bold"><?= $formatTarget ?></h3>
    <div style="margin-bottom:-13px;">
        <?php
        $id_tabungan = $d['id_tabungan'];

        // Query untuk mengambil data dari tabel catat_tabungan
        $query_catat = mysqli_query($koneksi, "SELECT nominal FROM catat_tabungan WHERE id_tabungan = $id_tabungan");

        // Inisialisasi variabel untuk menyimpan total nominal positif dan negatif
        $total_positif = 0;
        $total_negatif = 0;

        while ($catat = mysqli_fetch_assoc($query_catat)) {
            // Pisahkan tanda dan nilai
            $tanda = substr($catat['nominal'], 0, 1); // Ambil karakter pertama (tanda)
            $nilai = (int) substr($catat['nominal'], 1); // Ambil nilai setelah karakter pertama

            // Lakukan perhitungan berdasarkan tanda
            if ($tanda === '+') {
                $total_positif += $nilai;
            } elseif ($tanda === '-') {
                $total_negatif += $nilai;
            }
        }

        // Hitung total nominal
        $total_nominal = $total_positif - $total_negatif;

        // Hitung persentase progres
        $hitung_persen = min(($total_nominal / $d['target']) * 100, 100); // Persen tidak boleh lebih dari 100
        ?>

        <input type="text" class="knob" value="<?= number_format($hitung_persen, 0, '', '') ?>" readonly data-width="60" data-height="60" data-fgColor="#3c8dbc">
    </div>
</div>


<p style="margin-top:-20px; font-weight:bold; color:black;"><?= $formatUang ?> 
    <?php
    if ($d['rencana'] === 'Harian') {
        echo 'Perhari';
    } elseif ($d['rencana'] === 'Mingguan') {
        echo 'Perminggu';
    } elseif ($d['rencana'] === 'Bulanan') {
        echo 'Perbulan';
    }
    ?>
</p>
<?php 

            echo '<hr>';
            
            echo '<div class="text-center">';
            $id_tabungan = $d['id_tabungan'];
           // Query untuk mengambil data dari tabel catat_tabungan
$query_catat = mysqli_query($koneksi, "SELECT nominal FROM catat_tabungan WHERE id_tabungan = $id_tabungan");
            // Inisialisasi variabel untuk menyimpan total nominal
$total_nominal = 0;

while ($catat = mysqli_fetch_assoc($query_catat)) {
    // Pisahkan tanda dan nilai
    $tanda = substr($catat['nominal'], 0, 1); // Ambil karakter pertama (tanda)
    $nilai = (int) substr($catat['nominal'], 1); // Ambil nilai setelah karakter pertama

    // Lakukan perhitungan berdasarkan tanda
    if ($tanda === '+') {
        $total_nominal += $nilai;
    } elseif ($tanda === '-') {
        $total_nominal -= $nilai;
    }
}

// Hitung sisa target
$sisa_target = max(0, $d['target'] - $total_nominal);

// Hitung estimasi waktu
$estimasi_waktu = floor($sisa_target / $d['nominal']); // Menggunakan floor untuk membulatkan ke bawah

$tgl_b = new DateTime($d['tgl_b']);
$tgl_e = new DateTime($d['tgl_e']);

// Set waktu pada kedua objek DateTime menjadi pukul 00:00:00
$tgl_b->setTime(0, 0, 0);
$tgl_e->setTime(0, 0, 0);

// Hitung selisih hari
$selisih = $tgl_b->diff($tgl_e)->days;

// Logika kondisional untuk menampilkan selisih waktu sesuai dengan nilai "rencana"
if ($d['rencana'] === 'Harian') {
    echo  '<h6 class="card-text text-bold" style="font-size:15px;">' . $selisih. ' Hari</h6>';
} elseif ($d['rencana'] === 'Mingguan') {
    $minggu = floor($selisih / 7);
    $hariSisa = $selisih % 7;
    echo '<h6 class="card-text text-bold" style="font-size:15px;">'.$minggu.' <inggu '.$hariSisa.' Hari</h6>';
} elseif ($d['rencana'] === 'Bulanan') {
    $bulan = floor($selisih / 30);
    $minggu = floor($selisih / 7);
    $hariSisa = $selisih % 30;
    echo '<h6 class="card-text text-bold" style="font-size:15px;">'.$bulan.' Bulan '.$minggu.' Minggu '.$hariSisa.' Hari</h6>';
}


            echo '</div>';
            echo '      <a href="history_catat.php?nama=' . $id_users . '&no=' . $d['id_tabungan'] . '" class="btn btn-warning "><i class="fa fa-pen"></i></a>';
            echo '     <a href="#" class="btn btn-danger delete-tabungan" data-id="' . $d['id_tabungan'] . '"><i class="fa fa-trash"></i></a>';
            echo '    </div>';
            echo '  </div>';
            echo '</div>';
            $dataDitemukan = true; // Set variabel penanda ke true
        }
    }

    if (!$dataDitemukan) {
        // Tidak ada data yang memenuhi target
        echo '<div style="text-align:center;">';
        echo '<a href="#" data-toggle="modal" title="No Data">';
        echo '<img style="width:300px;height:300px;border-radius:20px;margin: auto;"';
        echo 'src="../dist/img/no_data.jpg" alt="Gambar Tabungan">';
        echo '</a>';
        echo '<p>Tidak ada data untuk ditampilkan.</p>';
        echo '</div>';
    }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
            </div>
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

if (isset($_SESSION['tabungan_terpenuhi'])) {
    echo '<script>';
    echo 'Swal.fire({';
    echo '    position: "center",';
    echo '    icon: "success",';
    echo '    title: "' . $_SESSION['tabungan_terpenuhi'] . '",';
    echo '    showConfirmButton: false,';
    echo '    timer: 4000'; //Ini 3 detik
    echo '});';
    echo '</script>';
    unset($_SESSION['tabungan_terpenuhi']); // Hapus pesan dari session
}

if (isset($_SESSION['tabungan_belum'])) {
    echo '<script>';
    echo 'Swal.fire({';
    echo '    position: "center",';
    echo '    icon: "warning",';
    echo '    title: "' . $_SESSION['tabungan_belum'] . '",';
    echo '    showConfirmButton: false,';
    echo '    timer: 4000'; //Ini 3 detik
    echo '});';
    echo '</script>';
    unset($_SESSION['tabungan_belum']); // Hapus pesan dari session
}
?>

            <?php 
            $query_t = mysqli_query($koneksi, "SELECT * FROM tabungan WHERE id_user = $id_users");
            while($tabungan = mysqli_fetch_array($query_t)) {
            ?>
              <!-- Modal -->
<div class="modal fade" id="gambarModal_t<?= $tabungan['id_tabungan'] ?>" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel<?= $tabungan['id_tabungan'] ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title" id="gambarModalLabel<?= $tabungan['id_tabungan'] ?>">Gambar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
        <?php
        $gambarPath = "../../data/img/tabungan/" . $tabungan['gambar']; // Path gambar sesuai dengan data dalam database
            if (empty($tabungan['gambar']) || !file_exists($gambarPath)) {
                // Tampilkan "galeri.png" jika kolom gambar kosong atau file gambar tidak ada
                $gambarPath = "../dist/img/galeri.png";
            }
            // Tampilkan gambar jika file gambar ada
            echo '<img src="' . $gambarPath . '" alt="Gambar Tabungan" "  width="100%" height="auto">';
        ?>
        
      </div>
      <div class="modal-footer">
        <?php
        $gambarPath = "../../data/img/tabungan/" . $tabungan['gambar']; // Path gambar sesuai dengan data dalam database
        if (empty($tabungan['gambar']) || !file_exists($gambarPath)) {
                // Tampilkan "galeri.png" jika kolom gambar kosong atau file gambar tidak ada
                echo '<a href="../../data/img/tabungan/'. $tabungan['gambar'] .'" style="display:none;" download title="Download Gambar" class="btn btn-success"><i class="fas fa-download"></i> Download</a>';
            } else {
              echo '<a href="../../data/img/tabungan/'. $tabungan['gambar'] .'" download title="Download Gambar" class="btn btn-success"><i class="fas fa-download"></i> Download</a>';
            }
        ?>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>
           
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <?php 
include "../view/footer_t.php";
?>