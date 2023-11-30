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
            <h1>Transaksi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../index.php">Dashboard</a></li>
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
            <div class="card">
              <div class="card-header">
                 <div class="card-tools">
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                 <div class="row">
                <h3 class="card-title">Transaksi</h3>
                    </div>
                <div class="row mt-2">
                    <div class="col-1">
                
                    <a class="btn btn-app" id="tombol" data-toggle="modal" data-target="#modal-lg">
                  <i class="fas fa-plus"></i> Plus
                </a>
              </div>
              </div>
              
               </div>
              <!-- /.card-header -->
             

  
              <div class="card-body">
                <div class="container-fluid ">
               <div class="row">
               <div class="col-lg-4 col-sm-4 ">
 <?php
$query = mysqli_query($koneksi, "SELECT id_user, nama_keuangan, SUM(total) as total_keuangan FROM keuangan WHERE id_user = '$id_users' AND nama_keuangan = 'Pemasukan'");

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_array($query);
   $total_keuangan = 'Rp ' . number_format($row['total_keuangan'], 2, ',', '.');
?>
    <p style="margin-bottom:-5px;text-align:center;font-weight:bold;">Pemasukan</p>
    <?php
    if ($total_keuangan !== NULL) {
        echo '<p  style="color:blue;text-align:center;">' . $total_keuangan . '</p>';
    } else {
        echo '<p  style="color:blue;text-align:center;">0</p>';
    }
    ?>
<?php
} else {
    echo "Tidak ada data yang sesuai dengan kriteria.";
}
?>

</div>

                <div class="col-lg-4 col-sm-4">
                  <?php
$query = mysqli_query($koneksi, "SELECT id_user, nama_keuangan, SUM(total) as total_keuangan FROM keuangan WHERE id_user = '$id_users' AND nama_keuangan = 'Pengeluaran'");

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_array($query);
    $total_keuangan_p = 'Rp ' . number_format($row['total_keuangan'], 2, ',', '.');

?>
    <p style="margin-bottom:-5px;text-align:center;font-weight:bold;">Pengeluaran</p>
    <?php
    if ($total_keuangan_p !== NULL) {
        echo '<p  style="color:red;text-align:center;">' . $total_keuangan_p . '</p>';
    } else {
        echo '<p  style="color:red;text-align:center;">0</p>';
    }
    ?>
<?php
} else {
    echo "Tidak ada data yang sesuai dengan kriteria.";
}
?>

                </div>
                <div class="col-lg-4 col-sm-4">
                <?php 
  $query_p = mysqli_query($koneksi, "SELECT id_user, nama_keuangan, SUM(total) as total_keuangan
  FROM keuangan WHERE id_user = '$id_users' AND nama_keuangan = 'Pengeluaran'");
  
  while ($row_p = mysqli_fetch_array($query_p)) {
    $total_keuangan_p = $row_p['total_keuangan'];

    $query = mysqli_query($koneksi, "SELECT id_user, nama_keuangan, SUM(total) as total_keuangan
    FROM keuangan WHERE id_user = '$id_users' AND nama_keuangan = 'Pemasukan'");
  
    while ($row = mysqli_fetch_array($query)) {
      $total_keuangan = $row['total_keuangan'];
      
      $selisih = $total_keuangan - $total_keuangan_p;
      $formattedSelisih = 'Rp ' . number_format($selisih, 2, ',', '.');
  ?>
  <p style="margin-bottom: -5px; text-align: center; font-weight: bold;">Total</p>
  <p style="text-align: center;"><?= $formattedSelisih ?></p>
  <?php 
    }
  } 
?>

                </div>
               </div>
               </div>
                </div>
                  </div>
               
                  <div class="card">
                    <div class="card-header">
                      <div class="card-tools">
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
            </div>
                

                     <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal dan Waktu</th>
                    <th>Total</th>
                    <th>Kategori</th>
                    <th>Aset</th>
                    <th>Catatan</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  
                  <tbody>
                   <?php
$no = 1;
$query = mysqli_query($koneksi, "SELECT * FROM keuangan WHERE id_user = $id_users ORDER BY id_keuangan DESC");
while ($row = mysqli_fetch_array($query)) {
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= date('d F Y H.i', strtotime($row['tgl_b'])) ?></td>
   <?php
if ($row['nama_keuangan'] === 'Pemasukan') {
  $formattedTotal = 'Rp ' . number_format($row['total'], 2, ',', '.');
  echo '<td style="color: blue;">' . $formattedTotal . '</td>';
} else if ($row['nama_keuangan'] === 'Pengeluaran') {
  $formattedTotal = 'Rp ' . number_format($row['total'], 2, ',', '.');
  echo '<td style="color: red;">' . $formattedTotal . '</td>';
}

?>

    
    <?php
    $noK = $row['id_kategori'];
    $kategori = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori = '$noK' ");
    while ($k = mysqli_fetch_array($kategori)) {
    ?>
    <td><?= $k['nama_kategori'] ?></td>
    <?php }?>
    <?php 
    $noA = $row['id_aset'];
    $aset = mysqli_query($koneksi, "SELECT * FROM aset WHERE id_aset = '$noA'");
    while ($a = mysqli_fetch_array($aset)) {
    ?>
    <td><?= $a['grup'] ?>/ <?= $a['nama_aset']?></td>
    <?php  }?>
    <td><?= $row['catatan'] ?></td>
    <td>
        <?php
        $gambarPath = "../../data/img/transaksi/" . $row['deskripsi']; // Path gambar sesuai dengan data dalam database
        if (file_exists($gambarPath)) {
            // Tampilkan gambar jika file gambar ada
            echo '<img src="' . $gambarPath . '" data-toggle="modal"  alt="Gambar Transaksi" data-target="#gambarModal' . $row['id_keuangan'] . '"  width="100" height="100">';
        } else {
            // Tampilkan deskripsi jika file gambar tidak ada
            echo $row['deskripsi'];
        }
        ?>
    </td>
    <td>
      <a href="#" class="btn btn-warning"
   onclick="setUpdateId(<?= $row['id_keuangan'] ?>)">
   <i class="fa fa-pen"></i>
</a>

<script>
function setUpdateId(id_keuangan) {
    // Simpan id_keuangan dalam session menggunakan AJAX
    $.ajax({
        type: "POST",
        url: "set_session.php", // Buat file set_session.php
        data: { id_keuangan: id_keuangan },
        success: function(response) {
            if (response === 'success') {
                // Session berhasil disimpan
                // Selanjutnya, buka halaman update.php
                window.location.href = 'update.php';
            } else {
                // Sesuatu yang salah terjadi saat menyimpan session
                alert('Terjadi kesalahan saat menyimpan session.');
            }
        }
    });
}

  // Menunggu selama 5 detik sebelum menghapus session
  setTimeout(function() {
    <?php
    // Hapus session id_keuangan
    if (isset($_SESSION['id_keuangan'])) {
      unset($_SESSION['id_keuangan']);
    }
    ?>
  }, 5000); // 5000 milidetik = 5 detik


</script>

      <a href="#" class="btn btn-danger delete" data-id="<?= $row['id_keuangan'] ?>"><i class="fa fa-trash"></i></a>
  </td>
</tr>
<?php } ?>


                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
             
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

           
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
 <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Transaksi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
             <div class="modal-body" >
                <div class="col-12 col-sm-12">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active " id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Pemasukan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Pengeluaran</a>
                  </li>
                  
                </ul>
              </div>


              <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-four-home"  role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                    <form id="TambahMasuk" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="id_user" id="id_user" value="<?= $id_users ?>" name="keuangan" >
                    <input type="hidden" class="form-control" name="nama_keuangan" id="nama_keuangan" value="Pemasukan" name="keuangan" >
                    <input type="hidden" class="form-control" name="keuangan" id="keuangan" value="Pemasukan" name="keuangan" >

                    <!-- Date and time -->
                    
               <div class="form-group">
  <label>Tanggal</label>
  <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
    <input type="text" name="tanggal_waktu" id="tanggal_waktu" class="form-control datetimepicker-input tanggal_waktu" data-target="#reservationdatetime" value="" />
    <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
    </div>
  </div>
</div>



                

                 <div class="form-group">
                    <label for="total">Total</label>
                    <input type="number" class="form-control" name="total" id="total" placeholder="Masukkan Total">
                  </div>

                  <div class="form-group">
                  <label>Kategori</label>
                  <select class="form-control select2bs4" name="kategori" id="kategori" style="width: 100%;">
                   
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_user = '$id_users' AND transaksi = 'Pemasukan'");
echo '<option value="">Pilih</option>';
                    while($row = mysqli_fetch_array($query)) {
                      
                      echo '<option value="'.$row['id_kategori'].'">'.$row['nama_kategori'].'</option>';
                    }
                    ?>
                    
                  </select>
                </div>
                <div class="form-group">
                  <label for="aset">Aset</label>
                  <select name="aset" class="form-control select2bs4" style="width:100%;" id="aset">
                <?php 
                $query_aset = mysqli_query($koneksi, "SELECT * FROM aset WHERE id_user = '$id_users' AND transaksi = 'Pemasukan'");
echo '<option value="">Pilih</option>';
                while($row_aset = mysqli_fetch_array($query_aset)) {
                      
                  echo '<option value="'.$row_aset['id_aset'].'">'.$row_aset['grup'].' / '.$row_aset['nama_aset'].'</option>';
                }
                ?>
                </select>
                </div>

                <div class="form-group">
                  <label for="catatan">Catatan</label>
                   <textarea class="form-control" name="catatan" id="catatan" placeholder="Masukkan Catatan" rows="3"></textarea>
                </div>

              <div class="input-group mb-3">
  <div class="input-group-prepend">
    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
      <i class="fas fa-camera"></i>
    </button>
    <ul class="dropdown-menu">
      <li class="dropdown-item" id="cameraOption">Kamera</li>
      <li class="dropdown-item" id="galleryOption">Galeri</li>
    </ul>
  </div>

  <input type="text" name="deskripsi" class="form-control" id="deskripsi" placeholder="Masukkan Deskripsi">
  <input type="file" name="fileInput" id="fileInput" style="display: none;">
</div>

<div class="text-center">
<img id="previewImage" src="../dist/img/galeri.png" style="max-width: 300px; max-height: 300px;">
</div>

<div class="form-group">
                        <div class="">
                        <button type="submit" class="btn btn-primary tambahpemasukan" id="">Simpan</button>

                        </div>
                      </div>
                    </form>
<script>
  document.getElementById('cameraOption').addEventListener('click', function() {
    // Saat opsi "Kamera" dipilih, set tipe input ke "file" dengan accept "camera"
    document.getElementById('fileInput').setAttribute('accept', 'image/*');
    document.getElementById('fileInput').click();
    
    // Nonaktifkan readonly
    document.getElementById('deskripsi').readOnly = true;
  });

  document.getElementById('galleryOption').addEventListener('click', function() {
    // Saat opsi "Galeri" dipilih, set tipe input ke "file" dengan accept "image"
    document.getElementById('fileInput').setAttribute('accept', 'camera/*');
    document.getElementById('fileInput').click();
    
    // Aktifkan kembali readonly jika pengguna memilih "Galeri"
    document.getElementById('deskripsi').readOnly = true;
  });

 // Merekam perubahan pada input file
document.getElementById('fileInput').addEventListener('change', function() {
    // Menampilkan gambar yang dipilih
    var previewImage = document.getElementById('previewImage');
    var file = this.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
        previewImage.src = e.target.result;
    };

    reader.readAsDataURL(file);
});






// Edit data
$('#TambahMasuk').on('submit', function(e) {
    e.preventDefault(); // Menghentikan tindakan default submit form

    const userId = $('#id_user').val();
    const keuangan = $('#keuangan').val();
    const nama_keuangan = $('#nama_keuangan').val();
    const tanggal_waktu = $('#tanggal_waktu').val();
    const total = $('#total').val();
    const kategori = $('#kategori').val();
    const aset = $('#aset').val();
    const catatan = $('#catatan').val();
    const deskripsi = $('#deskripsi').val();
    const fileInput = $('#fileInput')[0].files[0];

    // Buat objek FormData untuk mengirim data dalam bentuk form
    const formData = new FormData();
    formData.append('id_user', userId);
    formData.append('keuangan', keuangan);
    formData.append('nama_keuangan', nama_keuangan);
    formData.append('tanggal_waktu', tanggal_waktu);
    formData.append('total', total);
    formData.append('kategori', kategori);
    formData.append('aset', aset);
    formData.append('catatan', catatan);
    formData.append('deskripsi', deskripsi);
    formData.append('fileInput', fileInput);

    $.ajax({
        type: "POST",
        url: "tambah.php", // Sesuaikan dengan URL yang sesuai
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


// Tambahkan event handler untuk tombol "Delete"
$('#example2').on('click', '.delete', function() {
  // Dapatkan ID kategori yang akan dihapus
  const categoryId = $(this).data('id');

  // Tampilkan konfirmasi penghapusan menggunakan SweetAlert
  Swal.fire({
    title: 'Konfirmasi Penghapusan',
    text: 'Anda yakin ingin menghapus transaksi ini?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      // Lakukan permintaan AJAX untuk menghapus transaksi
      $.ajax({
        url: 'delete.php', // Ganti dengan URL yang sesuai
        method: 'POST',
        data: { id: categoryId },
        success: function(response) {
  if (response === 'success') {
    // Berhasil mengedit transaksi
   // Mengatur SweetAlert untuk ditampilkan setelah 2 detik
setTimeout(() => {
  Swal.fire({
    icon: 'success',
    title: 'Transaksi Berhasil Dihapus!',
  
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
      title: 'Gagal Menghapus transaksi',
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


                <!-- /.form group -->
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                    <form id="TambahKeluar">
                    <input type="hidden" class="form-control" name="id_user_p" id="id_user_p" value="<?= $id_users ?>" name="keuangan" >
                    <input type="hidden" class="form-control" name="nama_keuangan_p" id="nama_keuangan_p" value="Pengeluaran" name="keuangan" >
                    <input type="hidden" class="form-control" name="keuangan" id="keuangan" value="Pengeluaran" name="keuangan" >

                    <!-- Date and time -->
               <div class="form-group">
  <label>Tanggal</label>
  <div class="input-group date" id="datetime" data-target-input="nearest">
    <input type="text" name="tanggal_waktu_p" id="tanggal_waktu_p" class="form-control datetimepicker-input tanggal-waktu" data-target="#datetime" value="" />
    <div class="input-group-append" data-target="#datetime" data-toggle="datetimepicker">
      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
    </div>
  </div>
</div>



                

                 <div class="form-group">
                    <label for="total">Total</label>
                    <input type="number" class="form-control" name="total_p" id="total_p" placeholder="Masukkan Total">
                  </div>

                  <div class="form-group">
                  <label>Kategori</label>
                  <select class="form-control select2bs4" name="kategori_p" id="kategori_p" style="width: 100%;">
                   
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_user = '$id_users' AND transaksi = 'Pengeluaran'");
                    echo '<option value="">Pilih</option>';
                    while($row = mysqli_fetch_array($query)) {
                      
                      echo '<option value="'.$row['id_kategori'].'">'.$row['nama_kategori'].'</option>';
                    }
                    ?>
                    
                  </select>
                </div>
                <div class="form-group">
                  <label for="aset">Aset</label>
                  <select name="aset_p" class="form-control select2bs4" style="width:100%;" id="aset_p">
                <?php 
                $query_aset = mysqli_query($koneksi, "SELECT * FROM aset WHERE id_user = '$id_users' AND transaksi = 'Pengeluaran'");
                echo '<option value="">Pilih</option>';
                while($row_aset = mysqli_fetch_array($query_aset)) {
                  
                  echo '<option value="'.$row_aset['id_aset'].'">'.$row_aset['grup'].' / '.$row_aset['nama_aset'].'</option>';
                }
                ?>
                </select>
                </div>

                <div class="form-group">
                  <label for="catatan">Catatan</label>
                   <textarea class="form-control" name="catatan_p" id="catatan_p" placeholder="Masukkan Catatan" rows="3"></textarea>
                </div>

              <div class="input-group mb-3">
  <div class="input-group-prepend">
    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
      <i class="fas fa-camera"></i>
    </button>
    <ul class="dropdown-menu">
      <li class="dropdown-item" id="cameraOption_p">Kamera</li>
      <li class="dropdown-item" id="galleryOption_p">Galeri</li>
    </ul>
  </div>

  <input type="text" name="deskripsi_p" class="form-control" id="deskripsi_p" placeholder="Masukkan Deskripsi">
  <input type="file" name="fileInput_p" id="fileInput_p" style="display: none;">
</div>
<div class="text-center">
<img id="previewImage_p" src="../dist/img/galeri.png" style="max-width: 300px; max-height: 300px;">
</div>

<div class="form-group">
                        <div class="">
                        <button type="submit" class="btn btn-primary tambahpemasukan" id="">Simpan</button>

                        </div>
                      </div>
                    </form>
<script>


document.getElementById('cameraOption_p').addEventListener('click', function() {
    // Saat opsi "Kamera" dipilih, set tipe input ke "file" dengan accept "camera"
    document.getElementById('fileInput_p').setAttribute('accept', 'image/*');
    document.getElementById('fileInput_p').click();
    
    // Nonaktifkan readonly
    document.getElementById('deskripsi_p').readOnly = true;
  });

  document.getElementById('galleryOption_p').addEventListener('click', function() {
    // Saat opsi "Galeri" dipilih, set tipe input ke "file" dengan accept "image"
    document.getElementById('fileInput_p').setAttribute('accept', 'camera/*');
    document.getElementById('fileInput_p').click();
    
    // Aktifkan kembali readonly jika pengguna memilih "Galeri"
    document.getElementById('deskripsi_p').readOnly = true;
  });

 // Merekam perubahan pada input file
document.getElementById('fileInput_p').addEventListener('change', function() {
    // Menampilkan gambar yang dipilih
    var previewImage_p = document.getElementById('previewImage_p');
    var file = this.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
        previewImage_p.src = e.target.result;
    };

    reader.readAsDataURL(file);
});


// Edit data
$('#TambahKeluar').on('submit', function(e) {
    e.preventDefault(); // Menghentikan tindakan default submit form

    const user_p = $('#id_user_p').val();
    const keuangan = $('#keuangan').val();
    const nama_keuangan_p = $('#nama_keuangan_p').val();
    const tanggal_waktu_p = $('#tanggal_waktu_p').val();
    const total_p = $('#total_p').val();
    const kategori_p = $('#kategori_p').val();
    const aset_p = $('#aset_p').val();
    const catatan_p = $('#catatan_p').val();
    const deskripsi_p = $('#deskripsi_p').val();
    const fileInput_p = $('#fileInput_p')[0].files[0];

    // Buat objek FormData untuk mengirim data dalam bentuk form
    const formData = new FormData();
    formData.append('id_user_p', user_p);
    formData.append('keuangan', keuangan);
    formData.append('nama_keuangan_p', nama_keuangan_p);
    formData.append('tanggal_waktu_p', tanggal_waktu_p);
    formData.append('total_p', total_p);
    formData.append('kategori_p', kategori_p);
    formData.append('aset_p', aset_p);
    formData.append('catatan_p', catatan_p);
    formData.append('deskripsi_p', deskripsi_p);
    formData.append('fileInput_p', fileInput_p);

    $.ajax({
        type: "POST",
        url: "tambah_p.php", // Sesuaikan dengan URL yang sesuai
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
                  </div>
                  
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->



  <script>

        


// Tambahkan event handler untuk tombol "Delete"
$('#example2').on('click', '.delete', function() {
  // Dapatkan ID kategori yang akan dihapus
  const categoryId = $(this).data('id');

  // Tampilkan konfirmasi penghapusan menggunakan SweetAlert
  Swal.fire({
    title: 'Konfirmasi Penghapusan',
    text: 'Anda yakin ingin menghapus transaksi ini?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      // Lakukan permintaan AJAX untuk menghapus transaksi
      $.ajax({
        url: 'delete.php', // Ganti dengan URL yang sesuai
        method: 'POST',
        data: { id: categoryId },
        success: function(response) {
  if (response === 'success') {
    // Berhasil mengedit transaksi
   // Mengatur SweetAlert untuk ditampilkan setelah 2 detik
setTimeout(() => {
  Swal.fire({
    icon: 'success',
    title: 'Transaksi Berhasil Dihapus!',
  
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
      title: 'Gagal Menghapus transaksi',
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


  <script>
  // Mendapatkan elemen input tanggal dan waktu
  var tanggalWaktuInput = document.querySelector('.tanggal_waktu');

  // Mendapatkan tanggal dan waktu sekarang dari perangkat pengguna
  var now = new Date();
  var year = now.getFullYear();
  var month = String(now.getMonth() + 1).padStart(2, '0');
  var day = String(now.getDate()).padStart(2, '0');
  var hours = String(now.getHours()).padStart(2, '0');
  var minutes = String(now.getMinutes()).padStart(2, '0');

  // Menetapkan nilai awal input dengan tanggal dan waktu perangkat
  tanggalWaktuInput.value = `${month}/${day}/${year} ${hours}:${minutes}`;

  

  // Mendapatkan elemen input tanggal dan waktu
  var tanggalWaktuInput = document.querySelector('.tanggal-waktu');

  // Mendapatkan tanggal dan waktu sekarang dari perangkat pengguna
  var now = new Date();
  var year = now.getFullYear();
  var month = String(now.getMonth() + 1).padStart(2, '0');
  var day = String(now.getDate()).padStart(2, '0');
  var hours = String(now.getHours()).padStart(2, '0');
  var minutes = String(now.getMinutes()).padStart(2, '0');

  // Menetapkan nilai awal input dengan tanggal dan waktu perangkat
  tanggalWaktuInput.value = `${month}/${day}/${year} ${hours}:${minutes}`;

 



</script>


  <?php
  
$query_modal = mysqli_query($koneksi, "SELECT * FROM keuangan WHERE id_user = $id_users");
while ($row_modal = mysqli_fetch_array($query_modal)) {
?>
 <!-- Modal -->
<div class="modal fade" id="gambarModal<?= $row_modal['id_keuangan'] ?>" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel<?= $row_modal['id_keuangan'] ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title" id="gambarModalLabel<?= $row_modal['id_keuangan'] ?>">Gambar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
        <img src="../../data/img/transaksi/<?= $row_modal['deskripsi'] ?>" alt="Gambar Modal" style="max-width: 100%; height: auto;">
      </div>
      <div class="modal-footer">
       <a href="../../data/img/transaksi/<?= $row_modal['deskripsi'] ?>" download title="Download Gambar" class="btn btn-success"><i class="fas fa-download"></i> Download</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
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
?>



   <?php 
}
include "../view/footer_t.php";
?>