<?php include '../view/header_t.php' ?>
<?php include '../view/navbar_t.php' ?>
<?php include '../view/sidebar_t.php' ?>




<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Akun User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Akun User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    

<div class="card">
               <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>No Invoice</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Produk</th>
                    <th>Tipe Produk</th>
                    <th>Bukti</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  
                  <tbody>

                  
                  <?php
                  function sensorEmail($email) {
    $parts = explode('@', $email);
    $username = $parts[0];
    $domain = $parts[1];

    $sensoredUsername = substr($username, 0, 3) . str_repeat('*', max(0, strlen($username) - 4));

    return $sensoredUsername . '@' . $domain;
}
$no = 1;
$query = mysqli_query($koneksi, "SELECT users.*, premium.*
                                  FROM users
                                  INNER JOIN premium ON users.id_user = premium.id_user");

while ($row = mysqli_fetch_array($query)) {
?>
<tr>
  <td><?= $no++; ?></td>
  <td><?= $row['no_invoice']; ?></td>
  <td><?= $row['nama_user']; ?></td>
  <td><?= $row['nama_produk']; ?></td>
  <td><?= $row['tipe_produk'] ?></td>

  <td><?php
        $gambarPath = "../../data/img/premium/" . $row['bukti']; // Path gambar sesuai dengan data dalam database
        if (file_exists($gambarPath)) {
            // Tampilkan gambar jika file gambar ada
            echo '<img src="' . $gambarPath . '" data-toggle="modal"  alt="Gambar Transaksi" data-target="#gambarModal' . $row['id_user'] . '"  width="100" height="100">';
        } else {
            // Tampilkan deskripsi jika file gambar tidak ada
            echo $row['bukti'];
        }
        ?>
  </td>
  <td>
    <?php
      if ($row['status'] == 1) {
          echo 'Belum Premium';
      } else {
          echo 'Premium';
      }
      ?>
  </td>
  <td>
    
   <div class="onoffswitch">
    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch<?= $row['id_user']; ?>" <?= ($row['status'] == 2) ? 'checked' : ''; ?> data-id="<?= $row['id_user']; ?>">
    <label class="onoffswitch-label" for="myonoffswitch<?= $row['id_user']; ?>">
        <div class="onoffswitch-inner"></div>
        <div class="onoffswitch-switch"></div>
    </label>
</div>
<!-- Button informasi modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop<?= $row['no_invoice'] ?>">
 <i class="fas fa-info"></i>
</button>


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
   
       <script>
    $(document).ready(function () {
        $(".onoffswitch-checkbox").on("change", function () {
            var idUser = $(this).data('id');
            var newStatus = ($(this).is(":checked")) ? 2 : 1; // Ubah logika untuk membalik status

            $.ajax({
                type: "POST",
                url: "update_akun.php",
                data: {
                    id_user: idUser,
                    status: newStatus,
                },
                success: function (response) {
                    if (response) {
                      setTimeout(() => {
 Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: 'Status berhasil diperbarui!',
                            showConfirmButton: false,
                            timer: 1500
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
                            text: 'Gagal memperbarui status.',
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
    });
</script>

<?php 
$query = mysqli_query($koneksi, "SELECT users.*, premium.* FROM users INNER JOIN premium ON users.id_user = premium.id_user");
while($m = mysqli_fetch_array($query)) {
?>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop<?= $m['no_invoice'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Informasi Pelanggan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="nama_pelanggan" class="col-sm-2 col-form-label">No Invoice</label>
                        <div class="col-sm-10">
                          <input type="text" value="<?= $m['no_invoice'] ?>"  class="form-control" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                        <div class="col-sm-10">
                          <input type="text" value="<?= $m['nama_user'] ?>"  class="form-control" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="text" value="<?= sensorEmail($m['email']); ?>"  class="form-control" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Nama Produk</label>
                        <div class="col-sm-10">
                          <input type="text" value="<?= $m['nama_produk'] ?>"  class="form-control" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Tipe Produk</label>
                        <div class="col-sm-10">
                          <input type="text" value="<?= $m['tipe_produk'] ?>"  class="form-control" readonly>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                          <input type="text" value="<?= number_format($m['harga'], 2 ,',', '.') ?>"  class="form-control" readonly>
                        </div>
                      </div>

                       <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Metode Pembayaran</label>
                        <div class="col-sm-10">
                          <input type="text" value="<?= $m['metode_pembayaran'] ?>"  class="form-control" readonly>
                        </div>
                      </div>

                       <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" readonly><?= $m['deskripsi'] !== NULL ? $m['deskripsi'] : 'Tidak Ada Keterangan' ?></textarea>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Butki Pembayaran</label>
                        <div class="col-sm-10">
                         <img src="../../data/img/premium/<?= $m['bukti'] ?>" alt="Bukti Pembayaran" style="width:300px; height:300px;">
                        </div>
                      </div>

                    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

  <?php
}
$query_modal = mysqli_query($koneksi, "SELECT * FROM premium");
while ($row_modal = mysqli_fetch_array($query_modal)) {
?>
 <!-- Modal -->
<div class="modal fade" id="gambarModal<?= $row_modal['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel<?= $row_modal['id_user'] ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title" id="gambarModalLabel<?= $row_modal['id_user'] ?>">Gambar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
        <img src="../../data/img/premium/<?= $row_modal['bukti'] ?>" alt="Gambar Modal" style="max-width: 100%; height: auto;">
      </div>
      <div class="modal-footer">
       <a href="../../data/img/premium/<?= $row_modal['bukti'] ?>" download title="Download Gambar" class="btn btn-success"><i class="fas fa-download"></i> Download</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


<?php
}
include '../view/footer_t.php' ?>