<?php 
include "../view/header_t.php";
include "../view/navbar_t.php";
include "../view/sidebar_t.php";


// Pastikan bahwa $_GET['nama'] dan $_GET['no'] telah di-set dan bukan kosong
if (isset($_GET['nama']) && isset($_GET['no'])) {
    $id_user_from_url = $_GET['nama'];
    $id_tabungan_from_url = $_GET['no'];

    // Fetch the target_tabungan from the tabungan table
    $target_query = "SELECT * FROM tabungan WHERE id_user = '$id_user_from_url' AND id_tabungan = '$id_tabungan_from_url'";
    $target_result = mysqli_query($koneksi, $target_query);
    $row = mysqli_fetch_assoc($target_result);
    $target_tabungan = $row['target'];

    // Fetch the total_nominal from the catat_tabungan table
    $total_nominal_query = "SELECT SUM(nominal) as total_nominal FROM catat_tabungan WHERE id_tabungan = '$id_tabungan_from_url'";
    $total_nominal_result = mysqli_query($koneksi, $total_nominal_query);
    $total_nominal_row = mysqli_fetch_assoc($total_nominal_result);
    $total_nominal = $total_nominal_row['total_nominal'];

    // Check if there are records in the tabungan table
    if ($target_result && mysqli_num_rows($target_result) > 0) {
        // Check if the total_nominal is less than the target_tabungan
        if ($total_nominal < $target_tabungan) {
            // Allow insertion of new data
        ?>
       <script>
    // Fungsi untuk memeriksa total_nominal secara terus-menerus
    function cekTotalNominal() {
        // Kirim permintaan Ajax untuk mendapatkan total_nominal terbaru
        $.ajax({
            type: "GET",
            url: "check_target.php", // Ganti dengan nama file atau URL yang sesuai
            data: { nama: "<?php echo $id_user_from_url; ?>", no: "<?php echo $id_tabungan_from_url; ?>" },
            success: function(response) {
                // Cek apakah total_nominal sudah mencapai atau melebihi target_tabungan
                if (response >= <?php echo $target_tabungan; ?>) {
                    // Total nominal sudah mencapai target, hentikan interval
                    clearInterval(intervalId);

                    // Tampilkan SweetAlert setelah jeda 2 detik
                    setTimeout(function () {
                        Swal.fire({
                            icon: 'success',
                            title: 'Selamat!',
                            text: 'Target tabungan sudah terpenuhi.',
                            showConfirmButton: false,
                            timer: 2000 // Set durasi SweetAlert (ms)
                        });

                        // Redirect ke halaman lain atau lakukan aksi sesuai kebutuhan
                        setTimeout(function () {
                            window.location.href = 'tabungan.php';
                        }, 2000); // Sesuaikan durasi dengan timer di atas
                    }, 3000); // Jeda 2 detik sebelum menampilkan SweetAlert
                }
            }
        });
    }

    // Jalankan cekTotalNominal secara terus-menerus setiap 1 detik (1000 ms)
    var intervalId = setInterval(cekTotalNominal, 1000);
</script>


        <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tabungan - <?= $row['nama_tabungan'] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../">Home</a></li>
              <li class="breadcrumb-item active">Target Menabung</li>
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

             <div id="Kontent">
  <!-- Konten Info -->
</div>
            <script>
function updateInfo() {
    var id_users = <?= $id_users ?>;
    var id_tabungan = <?= $id_tabungan_from_url ?>;
    $.ajax({
        url: 'content-tabungan.php',
        method: 'GET',
        data: { id_users: id_users, id_tabungan: id_tabungan },
        dataType: 'json',
        success: function(data) {
            $('#Kontent').html(data.konten);
            initializeKnob();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error fetching data:', textStatus, errorThrown);
        }
    });
}

setInterval(updateInfo, 1000);


</script>
            
            <!-- /.card -->

           <!-- Untuk Info -->
          <div id="Content">
  <!-- Konten Info -->
</div>
<script>
  // Fungsi untuk memperbarui profil
function updateInfo() {
    var id_users = <?= $id_users ?>; // Ganti dengan nilai ID pengguna yang sesuai
    var id_tabungan = <?= $id_tabungan_from_url ?>;
    $.ajax({
        url: 'content.php',
        method: 'GET',
        data: { id_users: id_users,
        id_tabungan: id_tabungan }, // Kirim parameter ID pengguna
        dataType: 'json',
        success: function(data) {
            $('#Content').html(data.konten);
        },
        error: function() {
            // Penanganan kesalahan jika terjadi
        }
    });
}
  // Memanggil fungsi pembaruan setiap 1 detik
  setInterval(updateInfo, 1000);
</script>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Aktifitas</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Alur</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tambah" data-toggle="tab"><i class='fas fa-edit'></i></a></li>
                  <li class="nav-item"><a class="nav-link" href="#pengaturan" data-toggle="tab">Pengaturan</a></li>
                  <?php 
                  if($rencana = $row['rencana'] === 'Bulanan') {
                    echo '<li class="nav-item"><a class="nav-link" href="#notifikasi" data-toggle="tab">Notifikasi</a></li>';
                  }
                  ?>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane"  style="max-height: 550px; overflow-y: auto;" id="activity">
                    <!-- Post -->
                    <div class="form-group">
  <label for="pilih_tipe">Pilih Tipe</label>
  <select class="form-control select2 tipe1" style="width:100%;">
    <option value="pilih">Pilih</option>
    <option value="tambah">Tambah</option>
    <option value="ubah">Ubah</option>
  </select>
</div>
<div id="aktifitas" class="post"></div>
<script>
  // Fungsi untuk memperbarui profil
  function Aktivitas() {
    var id_users = <?= json_encode($id_users) ?>; // Ganti dengan nilai ID pengguna yang sesuai
    var id_tabungan = <?= json_encode($id_tabungan_from_url) ?>; // Ganti dengan nilai ID tabungan yang sesuai
    var selectedOption = $('.tipe1').val(); // Ambil nilai yang dipilih dari select

    $.ajax({
      url: 'aktifitas.php',
      method: 'GET',
      data: {
        id_users: id_users,
        id_tabungan: id_tabungan,
        tipe_aktifitas: selectedOption // Kirim tipe aktifitas sebagai parameter
      },
      dataType: 'json',
      success: function (data) {
        $('#aktifitas').html(data.ActivityData);
      },
      error: function () {
        // Penanganan kesalahan jika terjadi
      }
    });
  }

  // Tambahkan event listener ke elemen select
  $('.tipe1').on('change', Aktivitas);

  // Memanggil fungsi pembaruan setiap 1 detik
  setInterval(Aktivitas, 1000);
</script>


              
                    <!-- /.post -->

                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" style="max-height: 550px; overflow-y: auto;" id="timeline">
                    <!-- The timeline -->
                    <div class="form-group">
  <label for="pilih_tipe">Pilih Tipe</label>
  <select class="form-control select2 tipe2" style="width:100%;">
    <option value="pilih">Pilih</option>
    <option value="tambah">Tambah</option>
    <option value="ubah">Ubah</option>
  </select>
</div>
                    <div id="alur" class="post">
               </div>
             <script>
// Fungsi untuk memperbarui profil
function Alur() {
    var id_users = <?= json_encode($id_users) ?>; // Ganti dengan nilai ID pengguna yang sesuai
    var id_tabungan = <?= json_encode($id_tabungan_from_url) ?>; // Ganti dengan nilai ID tabungan yang sesuai
    var selectedOption = $('.tipe2').val(); // Ambil nilai yang dipilih dari select

    $.ajax({
      url: 'alur.php',
      method: 'GET',
      data: {
        id_users: id_users,
        id_tabungan: id_tabungan,
        tipe_alur: selectedOption // Kirim tipe alur sebagai parameter
      },
      dataType: 'json',
      success: function (data) {
        $('#alur').html(data.AlurData);
      },
      error: function () {
        // Penanganan kesalahan jika terjadi
      }
    });
  }

  // Tambahkan event listener ke elemen select
  $('.tipe2').on('change', Alur);

  // Memanggil fungsi pembaruan setiap 1 detik
  setInterval(Alur, 1000);
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Ambil nilai input total saat halaman dimuat
    let initialTotalValue = document.querySelector('.total').value;

    // Setel nilai yang sesuai ke input nilai_total pada saat halaman dimuat
    let nilaiTotalInput = document.querySelector('.nilai_total');
    nilaiTotalInput.value = formatCurrencyWithSymbol(initialTotalValue);

    // Setel nilai yang sesuai ke input nilai_total2 pada saat halaman dimuat
    let nilaiTotalInputTransaksi = document.querySelector('.nilai_total2');
    nilaiTotalInputTransaksi.value = initialTotalValue;
});

document.addEventListener('DOMContentLoaded', function () {
    // Ambil nilai input total saat halaman dimuat
    let initialTotalValue = document.querySelector('.total2').value;

    // Setel nilai yang sesuai ke input nilai_pengisian pada saat halaman dimuat
    let nilaiTotalInput = document.querySelector('.nilai_pengisian');
    nilaiTotalInput.value = formatCurrencyWithSymbol(initialTotalValue);

    // Setel nilai yang sesuai ke input nilai_total3 pada saat halaman dimuat
    let nilaiTotalInputTransaksi = document.querySelector('.nilai_total3');
    nilaiTotalInputTransaksi.value = initialTotalValue;
});

function TambahDataConvert(inputElement) {
    // Ambil nilai input total
    let inputTotal = inputElement.value;

    // Hilangkan karakter non-numeric dari input (misal: ,)
    let numericValue = inputTotal.replace(/[^\d]/g, '');

    // Setel nilai yang sesuai ke input nominal_total
    let nilaiTotalInput = inputElement.closest('.form-group').querySelector('.nominal_total');
    nilaiTotalInput.value = numericValue;

    // Format nilai sebagai mata uang dengan menggunakan fungsi rupiah
    let formattedValue = "Rp " + addThousandSeparator(numericValue);

    // Setel nilai yang diformat kembali ke input total
    inputElement.value = formattedValue;
}

function convertCurrency(inputElement) {
    // Ambil nilai input total
    let inputTotal = inputElement.value;

    // Hilangkan karakter non-numeric dari input (misal: ,)
    let numericValue = inputTotal.replace(/[^\d]/g, '');

    // Setel nilai yang sesuai ke input nilai_total
    let nilaiTotalInput = inputElement.closest('.form-group').querySelector('.nilai_total');
    nilaiTotalInput.value = formatCurrency(numericValue);

    // Setel nilai yang sesuai ke input nilai_total2
    let nilaiTotalInputTransaksi = inputElement.closest('.form-group').querySelector('.nilai_total2');
    nilaiTotalInputTransaksi.value = numericValue;

    // Tampilkan "Rp" secara otomatis pada input total
    inputElement.value = formatCurrencyWithSymbol(numericValue);
}


function ConvertNominal(inputElement) {
    // Ambil nilai input total
    let inputTotal = inputElement.value;

    // Hilangkan karakter non-numeric dari input (misal: ,)
    let numericValue = inputTotal.replace(/[^\d]/g, '');

    // Setel nilai yang sesuai ke input nilai_pengisian
    let nilaiTotalInput = inputElement.closest('.form-group').querySelector('.nilai_pengisian');
    nilaiTotalInput.value = formatCurrency(numericValue);

    // Setel nilai yang sesuai ke input nilai_total3
    let nilaiTotalInputTransaksi = inputElement.closest('.form-group').querySelector('.nilai_total3');
    nilaiTotalInputTransaksi.value = numericValue;

    // Tampilkan "Rp" secara otomatis pada input total
    inputElement.value = formatCurrencyWithSymbol(numericValue);
}


const addThousandSeparator = (number) => {
    // Menggunakan regex untuk menambahkan pemisah ribuan
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
};

const formatCurrency = (number) => {
    // Menggunakan regex untuk menambahkan pemisah ribuan
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
};

const formatCurrencyWithSymbol = (number) => {
    // Menggunakan regex untuk menambahkan pemisah ribuan dan menyertakan simbol "Rp"
    return "Rp " + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
};
</script>
                    
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="tambah">
                    <form id="CatatForm" class="form-horizontal">
                      
                      <input type="hidden" class="form-control" name="nomor" value="<?= $id_users ?>" id="nomor">
                      <input type="hidden" class="form-control" name="nama" value="<?= $id_tabungan_from_url ?>" id="nama">
                      <div class="form-group row">
                        <label for="nama_catat" class="col-sm-2 col-form-label">Nama Catat</label>
                        <div class="col-sm-10">
                           <input type="text" readonly value="Tambah" class="form-control tipe" name="tipe">
                         
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="nominalaja" class="col-sm-2 col-form-label">Nominal</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="nominalaja" id="nominalaja" placeholder="Nominal" oninput="TambahDataConvert(this)">
    <input type="hidden" class="form-control nominal_total"  name="nominal" id="nominal">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                      </div>
                    </form>
                    <hr>
 <div id="catat-tabungan" style="max-height: 450px; overflow-y: auto;" class="row"></div>
                    <script>
$(document).ready(function() {
  function loadData(containerId) {
  var IDTabungan = <?= $id_tabungan_from_url ?>; // Ambil id_tabungan dari PHP dan sisipkan ke dalam JavaScript

  // Lakukan permintaan AJAX untuk mengambil data kategori, termasuk id_tabungan
  $.ajax({
    url: 'get_data.php',
    method: 'GET',
    data: {
      id_tabungan: IDTabungan,
    },
    success: function(data) {
      $('#' + containerId).html(data);
    }
  });
}

// Load data for "Pemasukan" and "Pengeluaran" initially
loadData("catat-tabungan");
// Atur penyegaran setiap 3 detik (3000 milidetik) untuk data "Pemasukan" dan "Pengeluaran"
setInterval(function() {
  loadData("catat-tabungan");
}, 1000);


  $('#catat-tabungan').on('click', '.edit-catat', function() {
  const IDCatat = $(this).closest('.card-body').find('.nomor').data('id');
const Keterangan = $(this).closest('.card-body').find('.keterangan').text();
const Nominal = $(this).closest('.card-body').find('.nominal').text();
const IdTabungan = $(this).closest('.card-body').find('.id_tabungan').text();


  Swal.fire({
    title: 'Edit Catat Kategori',
    html: `<div class="form-group">
      <label for="nominal">Nominal</label>
      <input type="number" class="form-control" required name="nominal" id="nomor_nominal" placeholder="Masukkan Nominal" value="${Nominal}">
      <input type="hidden" class="form-control" required name="id_tabungan" id="id_tabungan" value="${IdTabungan}">
      <input type="hidden" class="form-control" required name="id_users" id="id_users" value="<?= $id_users ?>">
      <input type="hidden" class="form-control" required name="id_catat" id="id_catat" value="${IDCatat}">
    </div>
    <div class="form-group">
      <label for="keterangan_catat">Keterangan</label>
      <textarea class="form-control" id="keterangan_catat" name="keterangan_catat" rows="3">${Keterangan}</textarea>
    </div>
    `,
  }).then((result) => {
    if (result.isConfirmed) {
      const NominalEdit = $('#nomor_nominal').val();
      const editIdTabungan = $('#id_tabungan').val();
      const IDusers = $('#id_users').val();
      const id_catat = $('#id_catat').val();
      const keterangan_catat = $('#keterangan_catat').val();

      $.ajax({
    url: 'edit_catat.php',
    method: 'POST',
    data: {
        id: id_catat,
        id_tabungan: editIdTabungan,
        nomor_nominal: NominalEdit,
        nomor_user : IDusers,
        keterangan_catat: keterangan_catat,
    },
    dataType: 'json', // Mengharapkan respons dalam format JSON
    success: function(response) {
       if (response.status === 'success') {
    Swal.fire({
        title: 'Catat Tabungan Telah Diedit',
        icon: 'success',
        showConfirmButton: false,
        timer: 2000,
        allowOutsideClick: false,
    });
    loadData("catat-tabungan"); // Sesuaikan dengan ID container yang benar
} else if (response.status === 'error') {
    Swal.fire({
        title: 'Gagal Mengedit Catat Tabungan',
        text: response.message.join('<br>'), // Menampilkan pesan kesalahan dalam bentuk daftar
        icon: 'error',
        showConfirmButton: false,
        timer: 2000,
        allowOutsideClick: false,
    });
} else if (response.status === 'MelebihiTarget') {
    Swal.fire({
        title: 'Nominal Melebihi Target',
        icon: 'error',
        showConfirmButton: false,
        timer: 2000,
        allowOutsideClick: false,
    });
}

    },
});

    }
  });
});





// Tambahkan event handler untuk tombol "Delete"
$('#catat-tabungan').on('click', '.delete-catat', function() {
  // Dapatkan ID kategori yang akan dihapus
  const categoryId = $(this).data('id');

  // Tampilkan konfirmasi penghapusan menggunakan SweetAlert
  Swal.fire({
    title: 'Konfirmasi Penghapusan',
    text: 'Anda yakin ingin menghapus catat tabungan ini?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      // Lakukan permintaan AJAX untuk menghapus kategori
      $.ajax({
        url: 'delete_catat.php', // Ganti dengan URL yang sesuai
        method: 'POST',
        data: { id: categoryId },
        success: function(response) {
  if (response === 'success') {
    // Berhasil mengedit kategori
    Swal.fire({
      title: 'Catat Tabungan Telah Dihapus!',
      icon: 'success',
      showConfirmButton: false, // Menghilangkan tombol OK
      timer: 2000, // Menampilkan pesan selama 2 detik (sesuaikan sesuai kebutuhan)
      allowOutsideClick: false // Mencegah pengguna menutup pesan dengan mengklik di luar pesan
    });
    loadCategories(); // Muat ulang data kategori setelah mengedit
  } else {
    Swal.fire({
      title: 'Gagal Menghapus Catat Tabungan',
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
                  
                <!-- /.tab-content -->
              </div><!-- /.card-body -->

              <div class="tab-pane" id="pengaturan">
                    <form id="TabunganForm" class="TabunganForm" method="post" enctype="multipart/form-data">
                                <input type="hidden" class="form-control"  name="user_id" id="user_id"  value="<?= $id_users ?>">
                                <input type="hidden" class="form-control"  name="id" id="id"  value="<?= $row['id_tabungan'] ?>">
                                <div class="row">
                                <div class="col-sm-6">

                                <div class="form-group">
                                <label for="nama_tabungan">Nama Tabungan</label>
                                <input type="text" class="form-control" value="<?= $row['nama_tabungan'] ?>"  name="nama_tabungan" id="nama_tabungan" placeholder="Masukkan Nama Tabungan">
                            </div>

                            <div class="form-group">
                                <label for="target_ngisi">Target Tabungan</label>
                               
    <input type="text" class="form-control nilai_total" name="target_ngisi" id="target_ngisi" oninput="convertCurrency(this)">
    <input type="hidden" value="<?= $row['target'] ?>" class="form-control total" placeholder="Masukkan Total">
    <input type="hidden" value="<?= $row['target'] ?>" class="form-control nilai_total2" id="target_tabungan" placeholder="Masukkan Total">
                            </div>

                            </div>

                            <div class="col-sm-6">
                               <div class="form-group">
                  <label for="rencana_pengisian">Rencana Pengisian</label>
                  <select class="form-control select2" name="rencana_pengisian" id="rencana_pengisian" style="width: 100%;">
                    <option value="Harian" <?= $row['rencana'] == 'Harian' ? 'selected' : '' ?>>Harian</option>
                    <option value="Mingguan" <?= $row['rencana'] == 'Mingguan' ? 'selected' : '' ?>>Mingguan</option>
                    <option value="Bulanan" <?= $row['rencana'] == 'Bulanan' ? 'selected' : '' ?>>Bulanan</option>
                  </select>
                </div>
                  
               <div class="form-group">
    <label for="pengisian_nominal">Nominal Pengisian</label>
    <div class="input-group">
        <!-- <input type="number" name="nominal_pengisian" value="<?= $row['nominal'] ?>" id="nominal_pengisian" class="form-control"> -->
        <input type="text" class="form-control nilai_pengisian" name="pengisian_nominal" id="pengisian_nominal" oninput="ConvertNominal(this)">
    <input type="hidden" value="<?= $row['nominal'] ?>" class="form-control total2" placeholder="Masukkan Total">
    <input type="hidden" value="<?= $row['nominal'] ?>" class="form-control nilai_total3" id="nominal_pengisian" placeholder="Masukkan Total">
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
                              <?php 
                              $gambarPathTabungan = "../../data/img/tabungan/" .$row['gambar'];
                              if(empty($row['gambar']) ||  !file_exists($gambarPathTabungan)) {
                                $gambarPathTabungan = "../dist/img/galeri.png";
                              }
                              ?>
<img id="imageValidationMessage" src="<?= $gambarPathTabungan ?>" style="max-width: 300px; max-height: 300px;">
</div>

                            <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-save"></i> Simpan</button>
                           <button type="button" class="btn btn-danger mt-3 delete-tabungan" data-id="<?= $row['id_tabungan'] ?>"><i class="fas fa-trash"></i> Hapus Tabungan</button>

                        </form>

                        <script>

                          $(document).ready(function() {

// Tambahkan event handler untuk tombol "Delete"
$('#TabunganForm').on('click', '.delete-tabungan', function() {
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
     location.href = 'tabungan.php';
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

$('#TabunganForm').on('submit', function(e) {
    e.preventDefault(); // Menghentikan tindakan default submit form

    const userId = $('#user_id').val();
    const ID = $('#id').val();
    const tabungan = $('#nama_tabungan').val();
    const target_tabungan = $('#target_tabungan').val();
    const rencana = $('#rencana_pengisian').val();
    const nominal = $('#nominal_pengisian').val();
    const fileInput = $('#fileInput')[0].files[0];

    // Buat objek FormData untuk mengirim data dalam bentuk form
    const formData = new FormData();
    formData.append('id', ID);
    formData.append('id_user', userId);
    formData.append('nama_tabungan', tabungan);
    formData.append('target_tabungan', target_tabungan);
    formData.append('rencana_pengisian', rencana);
    formData.append('nominal_pengisian', nominal);
    formData.append('fileInput', fileInput);

    $.ajax({
        type: "POST",
        url: "update-tabungan.php", // Sesuaikan dengan URL yang sesuai
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
                    <hr>
                <!-- /.tab-content -->
              </div>


                <div class="tab-pane" id="notifikasi">
                    <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Harap Disimak, <?= $all['nama_user'] ?></h3>

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


               <p>Kami ingin memberitahu Anda bahwa setiap tahun, target tabungan Anda akan mengalami kenaikan sebesar 10%. Ini dilakukan untuk mengantisipasi adanya inflasi dan memastikan bahwa Anda dapat mencapai target tabungan dengan lebih baik.</p>

<p>Kami melakukan peningkatan nominal pengisian agar sesuai dengan kenaikan target tabungan. Peningkatan ini hanya sebesar 10% per tahun. Tujuannya adalah untuk membantu Anda mencapai target tabungan dengan lebih efektif.</p>

<p>Sebagai contoh, jika Anda menetapkan target tabungan sebesar <?= 'Rp ' . number_format($row['target'], 2, ',', '.') ?> dengan rencana pengisian bulanan sebesar <?= 'Rp ' . number_format($row['nominal'], 2, ',', '.') ?>, dan Anda berencana menyelesaikannya 
<?php 
$id_tabungan = $id_tabungan_from_url;

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


// Hitung estimasi waktu dalam bulan
$estimasi_waktu_bulan = ceil($row['target']  / $row['nominal']); // Menggunakan ceil untuk membulatkan ke atas

// Hitung tahun dan bulan
$tahun = floor($estimasi_waktu_bulan / 12);
$bulan = $estimasi_waktu_bulan % 12;

// Tampilkan data sesuai kebutuhan
if ($row['rencana'] === 'Bulanan') {
    if ($tahun > 0) {
        echo "pada tanggal " . date('d F Y', strtotime("+{$tahun} years +{$bulan} months", strtotime($row['tgl_b']))) . " (Estimasi $tahun tahun";
        if ($bulan > 0) {
            echo " {$bulan} bulan)";
        } else {
            echo ")";
        }
    } elseif ($bulan > 0) {
        echo "pada tanggal " . date('d F Y', strtotime("+{$bulan} months", strtotime($row['tgl_b']))) . " (Estimasi $bulan bulan)";
    } else {
        echo "segera";
    }
}
?>

, setiap tahunnya akan ada peningkatan 10%. Misalnya,
<?php 
$id_tabungan = $id_tabungan_from_url;

// Query untuk mengambil data dari tabel tabungan
$query_tabungan = mysqli_query($koneksi, "SELECT * FROM tabungan WHERE id_tabungan = $id_tabungan");
$row = mysqli_fetch_assoc($query_tabungan);

// Tambahkan 1 tahun pada tanggal awal rencana tabungan
$tanggal_selesai = date('d F Y', strtotime("+1 year", strtotime($row['tgl_b'])));

// Tampilkan data sesuai kebutuhan
if ($row['rencana'] === 'Bulanan') {
    echo "pada tanggal " . $tanggal_selesai;
}
?>


, nominal pengisian bulanan akan naik dari <?= 'Rp ' . number_format($row['nominal'], 2, ',', '.') ?> menjadi <?= 'Rp ' . number_format($row['nominal'] * 1.10, 2, ',', '.') ?>.</p>




                
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
            <div class="card-footer">
               <button type="button" class=" btn btn-md btn-primary" data-toggle="modal" data-target="#staticBackdrop"><i class="fas fa-search"></i> Selengkapnya</button>
              

            </div>
            <!-- /.card-footer -->

           
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
                <!-- /.tab-content -->
              </div>


          

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tabel Informasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nominal Pengisian</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $query_catat = mysqli_query($koneksi, "SELECT * FROM tabungan WHERE id_tabungan = $id_tabungan_from_url ORDER BY id_tabungan DESC");

        // Inisialisasi variabel untuk menyimpan total nominal
        $total_nominal = 0;

        while ($row = mysqli_fetch_assoc($query_catat)) {
            // Pisahkan tanda dan nilai
            $tanda = substr($row['nominal'], 0, 1); // Ambil karakter pertama (tanda)
            $nilai = (int) substr($row['nominal'], 1); // Ambil nilai setelah karakter pertama

            // Lakukan perhitungan berdasarkan tanda
            if ($tanda === '+') {
                $total_nominal += $nilai;
            } elseif ($tanda === '-') {
                $total_nominal -= $nilai;
            }

            // Hitung estimasi waktu
            $estimasi_waktu = floor(($row['target'] - $total_nominal) / $row['nominal']); // Menggunakan floor untuk membulatkan ke bawah

            $currentDate = strtotime($row['tgl_b']); // Tanggal awal
            $nominal = $row['nominal']; // Nominal awal
            $tahun = 0;

            for ($i = 1; $i <= $estimasi_waktu; $i++) {
                // Tambahkan 1 bulan pada tanggal
                $currentDate = strtotime("+1 month", $currentDate);

                // Tambahkan 10% setiap satu tahun
                if ($i % 12 == 0) {
                    $nominal += $nominal * 0.1;
                    $tahun++;
                }

                echo "<tr>
                        <td>{$no}</td>
                        <td>" . date('d F Y', $currentDate) . "</td>
                        <td>Rp " . number_format($nominal, 2, ',', '.') . "</td>
                    </tr>";

                $no++;
            }
        }
        ?>
    </tbody>
</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
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
  $(document).ready(function () {
   // Event saat tombol "Simpan" diklik
    $("#CatatForm").on("submit", function (e) {
  e.preventDefault(); 
        var id_tabungan = $("#nama").val(); 
        var idUsers = $("#nomor").val(); 
          var tipe = $(".tipe").val(); 
        var nominal = $("#nominal").val(); 
        var keterangan = $("#keterangan").val(); 
        // Kirim permintaan Ajax

        if (tipe === "") {
            console.log("Tipe harus diisi.");
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Tipe harus diisi.',
                showConfirmButton: false,
                timer: 2000
            });
        } else if (nominal === "") {
            console.log("Nominal harus diisi.");
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Nominal harus diisi.',
                showConfirmButton: false,
                timer: 2000
            });
        } else {
        $.ajax({
            type: "POST",
            url: "aksi_catat.php", // Ganti dengan alamat file PHP yang sesuai
            data: {
                id_tabungan: id_tabungan, // Tambahkan id_tabungan ke data yang dikirimkan
                id_user: idUsers, // Tambahkan id_user ke data yang dikirimkan
                  tipe: tipe, // Tambahkan tipe ke data yang dikirimkan
                nominal: nominal,
                keterangan: keterangan
            },
            success: function (response) {
            if (response.includes("berhasil")) {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: response,
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Anda bisa mengosongkan input atau menutup modal jika berhasil
                        $("#nama").val("");
                        $("#modal-lg").modal("hide");

                       
                    }
                });
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
            // Tangani kesalahan jika permintaan Ajax gagal
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Terjadi kesalahan: ' + error,
            });
        }
    });
  }
});
});
</script>




   
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
      

    <?php 
        } else {
             // Tidak sesuai, redirect ke halaman yang sesuai
        $_SESSION['tabungan_terpenuhi'] = 'Selamat Tabungan Anda Terpenuhi!';
        echo '<script>window.location.href = "tabungan.php";</script>';
        }
   
    } else {
        // Tidak sesuai, redirect ke halaman yang sesuai
        $_SESSION['gagal'] = 'Opps, Anda Gagal!';
        echo '<script>window.location.href = "tabungan.php";</script>';
    }
} else {
    // Parameter tidak lengkap, redirect ke halaman yang sesuai
    $_SESSION['gagal'] = 'Opps, Anda Gagal!';
    echo '<script>window.location.href = "tabungan.php";</script>';
}
include "../view/footer_t.php";
?>
