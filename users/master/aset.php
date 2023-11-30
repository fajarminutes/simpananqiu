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
            <h1>Aset</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../index.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Aset</li>
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
        <a class="nav-link" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Kategori</a>
    </li>
  
</ul>

        <div class="row">
          <div class="col-12">
            
            <div class="card">
              
              <div class="card-header">
                 <div class="row">
                <h3 class="card-title">Data Aset</h3>
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
 <form id="kategoriForm" class="Kategori">
                                <input type="hidden" class="form-control" required name="id_user" id="id_user"  value="<?= $id_users ?>">
                                <input type="hidden" class="form-control" required name="status" id="status"  value="<?= $all['status'] ?>">

                                 <div class="form-group">
                  <label>Transaksi</label>
                  <select class="form-control select2" name="transaksi" id="transaksi" style="width: 100%;">
                    <option value="">Pilih</option>
                    <option value="Pemasukan">Pemasukan</option>
                    <option value="Pengeluaran">Pengeluaran</option>
                  </select>
                </div>
                                   <div class="form-group">
                  <label>Grup</label>
                  <select class="form-control select2" name="grup" id="grup" style="width: 100%;">
                    <option value="">Pilih</option>
                    <option value="Tunai">Tunai</option>
                    <option value="Bank">Bank</option>
                    <option value="Kartu">Kartu</option>
                    <option value="Lainnya">Lainnya</option>
                  </select>
                </div>

                            <div class="form-group">
                                <label for="nama">Nama Aset</label>
                                <input type="text" class="form-control" required name="nama_aset" id="nama" placeholder="Masukkan Nama Aset">
                            </div>

                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="number" class="form-control" required name="total_aset" id="total" placeholder="Masukkan Total">
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                              <textarea class="form-control" rows="3" id="deskripsi" name="deskripsi_aset" placeholder="Masukkan Deskripsi"></textarea>
                            </div>
                            <button type="button" id="simpanAset" class="btn btn-primary mt-3">Simpan</button>
                           <button type="button" class="btn btn-success mt-3" id="tombolKembali">Kembali</button>

                        </form>
                        
<script>
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


 $(document).ready(function () {
    // Event saat tombol "Simpan" diklik
    $("#simpanAset").on("click", function () {
        var idUsers = $("#id_user").val(); // Dapatkan nilai input id_user
        var transaksi = $("#transaksi").val(); // Dapatkan nilai input transaksi
        var status = $("#status").val(); // Dapatkan nilai input status
        var grup = $("#grup").val(); // Dapatkan nilai input grup
        var namaAset = $("#nama").val(); // Dapatkan nilai input nama aset
        var totalAset = $("#total").val(); // Dapatkan nilai input total aset
        var deskripsiAset = $("#deskripsi").val(); // Dapatkan nilai input deskripsi aset

        // Kirim permintaan Ajax
        $.ajax({
            type: "POST",
            url: "aksi-aset.php", // Ganti dengan alamat file PHP yang sesuai
            data: {
                id_user: idUsers, // Tambahkan id_user ke data yang dikirimkan
                transaksi: transaksi, // Tambahkan transaksi ke data yang dikirimkan
                status: status, // Tambahkan status ke data yang dikirimkan
                grup: grup, // Tambahkan grup ke data yang dikirimkan
                nama_aset: namaAset, // Tambahkan nama_aset ke data yang dikirimkan
                total_aset: totalAset, // Tambahkan total_aset ke data yang dikirimkan
                deskripsi_aset: deskripsiAset // Tambahkan deskripsi_aset ke data yang dikirimkan
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
                            $("#total").val("");
                            $("#deskripsi").val("");
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
    });
});


</script>

                <!-- /.form group -->
                  </div>
                </div>
              <!-- <button class="btn btn-primary" id="openModal">Buka Modal</button> -->
<div class="modal modal-bottom" id="myModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
  <h4 class="modal-title">Judul Modal</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

      <div class="modal-body">
        <!-- Isi modal di sini -->
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium ad voluptatibus magnam obcaecati, aliquam dolore pariatur cupiditate quis perferendis earum nulla nihil sunt quibusdam ab adipisci, corrupti, atque perspiciatis nisi.</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium ad voluptatibus magnam obcaecati, aliquam dolore pariatur cupiditate quis perferendis earum nulla nihil sunt quibusdam ab adipisci, corrupti, atque perspiciatis nisi.</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium ad voluptatibus magnam obcaecati, aliquam dolore pariatur cupiditate quis perferendis earum nulla nihil sunt quibusdam ab adipisci, corrupti, atque perspiciatis nisi.</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium ad voluptatibus magnam obcaecati, aliquam dolore pariatur cupiditate quis perferendis earum nulla nihil sunt quibusdam ab adipisci, corrupti, atque perspiciatis nisi.</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium ad voluptatibus magnam obcaecati, aliquam dolore pariatur cupiditate quis perferendis earum nulla nihil sunt quibusdam ab adipisci, corrupti, atque perspiciatis nisi.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
  $("#openModal").click(function() {
    $("#myModal").modal("show");
  });
});

</script>

              </div>

              <div class="card-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-sm-4">
                <p style="margin-bottom:-5px;text-align:center;font-weight:bold;">Aset</p>
                <p id="totalAset" style="color:blue;text-align:center;">Rp 0.00</p>
            </div>

            <div class="col-lg-4 col-sm-4">
                <p style="margin-bottom:-5px;text-align:center;font-weight:bold;">Liabilitas</p>
                <p id="totalLiabilitas" style="color:red;text-align:center;">Rp 0.00</p>
            </div>

            <div class="col-lg-4 col-sm-4">
                <p style="margin-bottom: -5px; text-align: center; font-weight: bold;">Total</p>
                <p id="selisihTotal" style="text-align: center;">Rp 0.00</p>
            </div>
        </div>
    </div>
</div>

<!-- Pastikan library jQuery sudah disertakan -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    // Fungsi untuk memperbarui tampilan aset secara real-time
    function updateAset() {
        $.ajax({
            url: 'update_aset.php',
            method: 'GET',
            data: { id_user: <?php echo json_encode($id_users); ?> }, // Mengirim id_user sebagai parameter
            dataType: 'json',
            success: function (data) {
                // Update tampilan aset
                $('#totalAset').text(data.totalAset);
                $('#totalLiabilitas').text(data.totalLiabilitas);
                $('#selisihTotal').text(data.selisihTotal);
            },
            error: function (error) {
                console.log('Error:', error);
            }
        });
    }

    // Panggil fungsi updateAset setiap 1 detik
    setInterval(updateAset, 1000);
</script>


              </div>
              <!-- /.card-header -->
            
               
<script>
$(document).ready(function() {
   function loadAset(grup) {
    var idUsers = <?= $id_users ?>; // Ambil id_users dari PHP dan sisipkan ke dalam JavaScript

    // Lakukan permintaan AJAX untuk mengambil data aset
    $.ajax({
        url: 'muncul_aset.php',
        method: 'GET',
        data: {
            id_users: idUsers,
            grup: grup,
        },
        success: function (data) {
            if (grup === 'Tunai') {
                $('#pemasukan-container').html(data);
            } else if (grup === 'Bank') {
                $('#pengeluaran-container').html(data);
            } else if (grup === 'Kartu') {
                $('#kartu-container').html(data);
            } else if (grup === 'Lainnya') {
                $('#lainnya-container').html(data);
            }
        }
    });
}
// Pertama kali, tampilkan data aset
loadAset('Tunai', '#pemasukan-container');
loadAset('Bank', '#pengeluaran-container');
loadAset('Kartu', '#kartu-container');
loadAset('Lainnya', '#lainnya-container');

// Atur penyegaran setiap 2 detik untuk masing-masing grup
setInterval(function() {
    loadAset('Tunai', '#pemasukan-container');
}, 2000); // Contoh penyegaran setiap 2 detik (2000 milidetik)

setInterval(function() {
    loadAset('Bank', '#pengeluaran-container');
}, 2000); // Contoh penyegaran setiap 2 detik (2000 milidetik)

setInterval(function() {
    loadAset('Kartu', '#kartu-container');
}, 2000); // Contoh penyegaran setiap 2 detik (2000 milidetik)

setInterval(function() {
    loadAset('Lainnya', '#lainnya-container');
}, 2000); // Contoh penyegaran setiap 2 detik (2000 milidetik)



 


$('#pemasukan-container, #pengeluaran-container, #kartu-container, #lainnya-container').on('click', '.edit-category', function() {
    const cardBody = $(this).closest('.card-body');
    const categoryId = cardBody.find('.nama_aset').data('id');
    const categoryName = cardBody.find('.nama_aset').text();
    const Transaksi = cardBody.find('.transaksi_aset').text();
    const deskripsi = cardBody.find('.deskripsi').text();
    const total = cardBody.find('.total').text();
    const idUsers = cardBody.find('.id_user').text();
    const grup = cardBody.find('.grup').text();
  
    Swal.fire({
      title: 'Edit Aset',
      html: `
      <div class="form-group">
        <label for="transaksi_aset">Transaksi</label>
        <select class="form-control" name="transaksi_aset" id="transaksi_aset" style="width: 100%"></select>
      </div>
      <div class="form-group">
        <label for="grup_aset">Jenis Grup</label>
        <select class="form-control" name="grup_aset" id="grup_aset" style="width: 100%"></select>
      </div>
      <div class="form-group">
        <label for="nama_aset">Nama Aset</label>
        <input type="text" class="form-control" required name="nama" id="nama_aset" placeholder="Masukkan Nama Aset" value="${categoryName}">
        <input type="hidden" class="form-control" required name="id_users" id="id_user" value="${idUsers}">
      </div>
      <div class="form-group">
        <label for="total_aset">Total</label>
        <input type="number" class="form-control" required name="total_aset" id="total_aset" placeholder="Masukkan Total Aset" value="${total}">
      </div>

      
      <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea class="form-control" rows="3" id="deskripsi_aset" name="deskripsi_aset" placeholder="Masukkan Deskripsi">${deskripsi}</textarea>
      </div>
      `,
      showCancelButton: true,
      confirmButtonText: 'Simpan',
      cancelButtonText: 'Batal',
      didOpen: () => {
        // Buat opsi-opsi untuk elemen select
         const selectOptions = [];
            if (grup === 'Tunai') {
                selectOptions.push('Tunai', 'Bank', 'Kartu', 'Lainnya');
            } else if (grup === 'Bank') {
                selectOptions.push('Tunai', 'Bank', 'Kartu', 'Lainnya');
            } else if (grup === 'Kartu') {
                selectOptions.push('Tunai', 'Bank', 'Kartu', 'Lainnya');
            } else if (grup === 'Lainnya') {
                selectOptions.push('Tunai', 'Bank', 'Kartu', 'Lainnya');
            }

            const selectOptionsTransaksi = [];
            if (Transaksi === 'Pemasukan') {
                selectOptionsTransaksi.push('Pemasukan', 'Pengeluaran');
            } else if (Transaksi === 'Pengeluaran') {
                selectOptionsTransaksi.push('Pemasukan', 'Pengeluaran');
            }
  
        // Perbarui select box berdasarkan nilai grup yang diperoleh
        selectOptions.forEach((option) => {
          const isSelected = option === grup ? 'selected' : '';
          $('#grup_aset').append(`<option value="${option}" ${isSelected}>${option}</option>`);
        });

        selectOptionsTransaksi.forEach((optionTransaksi) => {
          const isSelectedTransaksi = optionTransaksi === Transaksi ? 'selected' : '';
          $('#transaksi_aset').append(`<option value="${optionTransaksi}" ${isSelectedTransaksi}>${optionTransaksi}</option>`);
        });
      },
    }).then((result) => {
      if (result.isConfirmed) {
        const editedCategoryName = $('#nama_aset').val();
        const editIdUser = $('#id_user').val();
        const total_aset = $('#total_aset').val();
        const grup_aset = $('#grup_aset').val();
        const deskripsi_aset = $('#deskripsi_aset').val();
        const transaksi_aset = $('#transaksi_aset').val();

        $.ajax({
          url: 'edit_aset.php',
          method: 'POST',
          data: {
            id: categoryId,
            id_users: editIdUser,
            nama: editedCategoryName,
            total_aset: total_aset,
            grup_aset: grup_aset,
            deskripsi_aset: deskripsi_aset,
            transaksi_aset: transaksi_aset,
          },
          dataType: 'json', // Mengharapkan respons dalam format JSON
          success: function(response) {
            if (response.status === 'success') {
              Swal.fire({
                title: 'Aset Telah Diedit',
                icon: 'success',
                showConfirmButton: false,
                timer: 2000,
                allowOutsideClick: false,
              });

              // Untuk mengganti nama aset yang ditampilkan pada tampilan
              cardBody.find('.nama_aset').text(editedCategoryName);
              cardBody.find('.transaksi_aset').text(Transaksi);
              cardBody.find('.total').text(total_aset);
              cardBody.find('.deskripsi').text(deskripsi_aset);

            } else if (response.status === 'error') {
              Swal.fire({
                title: 'Gagal Mengedit Aset',
                html: response.message.join('<br>'), // Menampilkan pesan kesalahan dalam bentuk daftar
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
$('#pemasukan-container, #pengeluaran-container, #kartu-container, #lainnya-container').on('click', '.delete-category', function() {
  // Dapatkan ID kategori yang akan dihapus
  const categoryId = $(this).data('id');

  // Tampilkan konfirmasi penghapusan menggunakan SweetAlert
  Swal.fire({
    title: 'Konfirmasi Penghapusan',
    text: 'Anda yakin ingin menghapus kategori ini?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      // Lakukan permintaan AJAX untuk menghapus kategori
      $.ajax({
        url: 'delete_aset.php', // Ganti dengan URL yang sesuai
        method: 'POST',
        data: { id: categoryId },
        success: function(response) {
  if (response === 'success') {
    // Berhasil mengedit kategori
    Swal.fire({
      title: 'Kategori Telah Dihapus!',
      icon: 'success',
      showConfirmButton: false, // Menghilangkan tombol OK
      timer: 2000, // Menampilkan pesan selama 2 detik (sesuaikan sesuai kebutuhan)
      allowOutsideClick: false // Mencegah pengguna menutup pesan dengan mengklik di luar pesan
    });
    loadCategories(); // Muat ulang data kategori setelah mengedit
  } else {
    Swal.fire({
      title: 'Gagal Menghapus Kategori',
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
                  <li class="pt-2 px-3"><h3 class="card-title">Aset</h3></li>
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Tunai</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Bank</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-kartu-tab" data-toggle="pill" href="#custom-tabs-two-kartu" role="tab" aria-controls="custom-tabs-two-kartu" aria-selected="false">Kartu</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-lainnya-tab" data-toggle="pill" href="#custom-tabs-two-lainnya" role="tab" aria-controls="custom-tabs-two-lainnya" aria-selected="false">Lainnya</a>
                  </li>
                </ul>
              </div>
              <div class="card-body" style="max-height: 700px; overflow-y: auto;">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                    <div id="pemasukan-container" class="row"></div>
                  </div>

                  <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                    <div id="pengeluaran-container" class="row"></div>
                  </div>

                   <div class="tab-pane fade" id="custom-tabs-two-kartu" role="tabpanel" aria-labelledby="custom-tabs-two-kartu-tab">
                    <div id="kartu-container" class="row"></div>
                  </div>

                   <div class="tab-pane fade" id="custom-tabs-two-lainnya" role="tabpanel" aria-labelledby="custom-tabs-two-lainnya-tab">
                    <div id="lainnya-container" class="row"></div>
                  </div>


                </div>
              </div>
              <!-- /.card -->
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
  <!-- /.content-wrapper -->
   <?php 
include "../view/footer_t.php";
?>