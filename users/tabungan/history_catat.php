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
        if ($total_nominal === $target_tabungan) {
            // Allow insertion of new data
        ?>
       

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
        url: 'content-history.php',
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
                        <label for="noninal" class="col-sm-2 col-form-label">Nominal</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" name="nominal" id="nominal" placeholder="Nominal">
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
                          <button type="submit" class="btn btn-primary">Simpan</button>
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
        $_SESSION['tabungan_belum'] = 'Oops, Tabungan Anda Belum Terpenuhi!';
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
