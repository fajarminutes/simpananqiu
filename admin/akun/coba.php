<?php include '../view/header_t.php' ?>
<?php include '../view/navbar_t.php' ?>
<?php include '../view/sidebar_t.php' ?>


<style>
.onoffswitch {
    position: relative;
    width: 90px;
    user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid #999999;
    border-radius: 20px;
}
.onoffswitch-inner {
    width: 200%;
    margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner:before,
.onoffswitch-inner:after {
    float: left;
    width: 50%;
    height: 30px;
    padding: 0;
    line-height: 30px;
    font-size: 14px;
    color: white;
    font-family: Trebuchet, Arial, sans-serif;
    font-weight: bold;
    box-sizing: border-box;
}
.onoffswitch-inner:before {
    content: "ON";
    padding-left: 10px;
    background-color: #2FCCFF;
    color: #FFFFFF;
}
.onoffswitch-inner:after {
    content: "OFF";
    padding-right: 10px;
    background-color: #EEEEEE;
    color: #999999;
    text-align: right;
}
.onoffswitch-switch {
    width: 18px;
    margin: 6px;
    background: #FFFFFF;
    border: 2px solid #999999;
    border-radius: 20px;
    position: absolute;
    top: 0;
    bottom: 0;
    right: 56px;
    transition: all 0.3s ease-in 0s;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px;
}
</style>

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
              <li class="breadcrumb-item"><a href="../dashboard/">Dashboard</a></li>
              <li class="breadcrumb-item active">Transaksi</li>
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
                    <th>Harga</th>
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
$query = mysqli_query($koneksi, "SELECT * FROM users");
while ($row = mysqli_fetch_array($query)) {
?>
<tr>
  <td><?= $no++; ?></td>
  <td><?= $row['nama_user']; ?></td>
  <td><?= $row['gender']; ?></td>
  <td><?= $row['no_hp']; ?></td>
  <td><?= sensorEmail($row['email']); ?></td>

  <td><?php
        $gambarPath = "../../data/img/users/" . $row['foto']; // Path gambar sesuai dengan data dalam database
        if (file_exists($gambarPath)) {
            // Tampilkan gambar jika file gambar ada
            echo '<img src="' . $gambarPath . '" data-toggle="modal"  alt="Gambar Transaksi" data-target="#gambarModal' . $row['id_user'] . '"  width="100" height="100">';
        } else {
            // Tampilkan deskripsi jika file gambar tidak ada
            echo $row['foto'];
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
  
$query_modal = mysqli_query($koneksi, "SELECT * FROM users");
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
        <img src="../../data/img/users/<?= $row_modal['foto'] ?>" alt="Gambar Modal" style="max-width: 100%; height: auto;">
      </div>
      <div class="modal-footer">
       <a href="../../data/img/users/<?= $row_modal['foto'] ?>" download title="Download Gambar" class="btn btn-success"><i class="fas fa-download"></i> Download</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


<?php
}
include '../view/footer_t.php' ?>