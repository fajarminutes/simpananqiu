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

$target_query = "SELECT * FROM premium WHERE id_user = '$id_users'";
    $target_result = mysqli_query($koneksi, $target_query);
    $row = mysqli_fetch_assoc($target_result);

    if (mysqli_num_rows($target_result) > 0) {
       // Tidak sesuai, redirect ke halaman yang sesuai
        $_SESSION['gagal'] = 'Opps, Anda Sudah Melakukan Pemesanan!';
        echo '<script>window.location.href = "invoice.php";</script>';
      } else {

if($all['status'] == 1) {
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
              <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
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
            <div class="card">
           <div class="card-header">
    <h4>Nikmati Fitur Premium</h4>
    <p style="font-size:18px;">Dengan meningkatkan akun Anda ke versi premium, Anda akan membuka pintu menuju pengalaman yang lebih luar biasa. Fitur-fitur premium kami tidak hanya memberikan akses tak terbatas, tetapi juga memperluas jangkauan fungsionalitas untuk memberikan manfaat optimal bagi kebutuhan keuangan Anda.</p>
    <p style="font-size:18px;">Temukan kenyamanan dan fleksibilitas dalam pencatatan pengeluaran dan pemasukan tanpa batasan. Dapatkan prioritas akses, saran keuangan pribadi, dan berbagai keuntungan eksklusif lainnya yang akan membuat perjalanan keuangan Anda menjadi lebih lancar dan terarah.</p>
    <p style="font-size:18px;">Langkahlah lebih maju, tingkatkan akun Anda hari ini, dan temukan potensi penuh dalam mencatat keuangan Anda dengan lebih efisien!</p>
</div>

            
             <div class="container mb-5 mt-5">
            <div class="text-center">
                <div class="nav price-tabs" role="tablist">
                    <a class="nav-link active" href="#yearly" role="tab" data-toggle="tab">Tahun</a>
                    <a class="nav-link" href="#monthly" role="tab" data-toggle="tab">Bulan</a>
                </div>
            </div>
            <div class="tab-content wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
                <div role="tabpanel" class="tab-pane fade show active" id="yearly">
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-lg-4 mb-30">
                            <div class="price-item text-center">
                                <div class="price-top">
                                    <h4>Gratis</h4>
                                    <h2 class="mb-0"><sup>Rp</sup>0</h2>
                                    <span class="text-capitalize">per tahun</span>
                                </div>
                                <div class="price-content">
                                    <ul class="border-bottom mb-30 mt-md-4 pb-3 text-left">
                                        <li>
                                            <i class="zmdi zmdi-check mr-2"></i>
                                            <span class="c-black">Fitur Menabung Terbatas</span>
                                        </li>
                                        <li>
                                            <i class="zmdi zmdi-check mr-2"></i>
                                            <span class="c-black">Fitur Mencatat Pemasukan Terbatas</span>
                                        </li>
                                        <li>
                                            <i class="zmdi zmdi-check mr-2"></i>
                                            <span class="c-black">Fitur Mencatat Pengeluaran Terbatas</span>
                                        </li>
                                        <li>
                                            <i class="zmdi zmdi-close mr-2"></i>
                                            <span>Fitur Laporan Keuangan Terbatas</span>
                                        </li>
                                        <li>
                                            <i class="zmdi zmdi-close mr-2"></i>
                                            <span>Fitur Kategori dan Aset Terbatas</span>
                                        </li>
                                        <li>
                                            <i class="zmdi zmdi-close mr-2"></i>
                                            <span>Tidak Termasuk Layanan Prioritas (VIP)</span>
                                        </li>
                                    </ul>
                                    <a href="#" class="btn btn-custom">Sedang Digunakan</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-30">
                            <div class="price-item text-center popular">
                                <div class="price-top">
                                    <h4>Bisnis</h4>
                                    <h2 class="mb-0"><sup>Rp</sup>500.000,00</h2>
                                    <span class="text-capitalize">per Tahun</span>
                                </div>
                                <div class="price-content">
                                    <ul class="border-bottom mb-30 mt-md-4 pb-3 text-left">
                                      <li>
                                          <i class="zmdi zmdi-check mr-2"></i>
                                          <span class="c-black">Fitur Menabung Tanpa Batasan</span>
                                      </li>
                                      <li>
                                          <i class="zmdi zmdi-check mr-2"></i>
                                          <span class="c-black">Fitur Pencatatan Pemasukan Tanpa Batasan</span>
                                      </li>
                                      <li>
                                          <i class="zmdi zmdi-check mr-2"></i>
                                          <span class="c-black">Fitur Pencatatan Pengeluaran Tanpa Batasan</span>
                                      </li>
                                      <li>
                                          <i class="zmdi zmdi-check mr-2"></i>
                                          <span class="c-black">Akses Penuh ke Fitur Laporan Keuangan</span>
                                      </li>
                                      <li>
                                          <i class="zmdi zmdi-check mr-2"></i>
                                          <span class="c-black">Pilihan Kategori dan Aset yang Luas</span>
                                      </li>
                                      <li>
                                          <i class="zmdi zmdi-check mr-2"></i>
                                          <span class="c-black">Layanan Prioritas (VIP)</span>
                                      </li>
                                  </ul>
                                    <a href="beli.php?no=1" class="btn btn-custom btn-light">Beli Sekarang</a>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="monthly">
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-lg-4 mb-30">
                            <div class="price-item text-center">
                                <div class="price-top">
                                    <h4>Gratis</h4>
                                    <h2 class="mb-0"><sup>Rp</sup>0</h2>
                                    <span class="text-capitalize">per bulan</span>
                                </div>
                                <div class="price-content">
                                    <ul class="border-bottom mb-30 mt-md-4 pb-3 text-left">
                                        <li>
                                            <i class="zmdi zmdi-check mr-2"></i>
                                            <span class="c-black">Fitur Menabung Terbatas</span>
                                        </li>
                                        <li>
                                            <i class="zmdi zmdi-check mr-2"></i>
                                            <span class="c-black">Fitur Mencatat Pemasukan Terbatas</span>
                                        </li>
                                        <li>
                                            <i class="zmdi zmdi-check mr-2"></i>
                                            <span class="c-black">Fitur Mencatat Pengeluaran Terbatas</span>
                                        </li>
                                        <li>
                                            <i class="zmdi zmdi-close mr-2"></i>
                                            <span>Fitur Laporan Keuangan Terbatas</span>
                                        </li>
                                        <li>
                                            <i class="zmdi zmdi-close mr-2"></i>
                                            <span>Fitur Kategori dan Aset Terbatas</span>
                                        </li>
                                        <li>
                                            <i class="zmdi zmdi-close mr-2"></i>
                                            <span>Tidak Termasuk Layanan Prioritas (VIP)</span>
                                        </li>
                                    </ul>
                                    <a href="#" class="btn btn-custom">Sedang Digunakan</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-30">
                            <div class="price-item text-center popular">
                                <div class="price-top">
                                    <h4>Bisnis</h4>
                                    <h2 class="mb-0"><sup>Rp</sup>50.000,00</h2>
                                    <span class="text-capitalize">per bulan</span>
                                </div>
                                <div class="price-content">
                                    <ul class="border-bottom mb-30 mt-md-4 pb-3 text-left">
                                      <li>
                                          <i class="zmdi zmdi-check mr-2"></i>
                                          <span class="c-black">Fitur Menabung Tanpa Batasan</span>
                                      </li>
                                      <li>
                                          <i class="zmdi zmdi-check mr-2"></i>
                                          <span class="c-black">Fitur Pencatatan Pemasukan Tanpa Batasan</span>
                                      </li>
                                      <li>
                                          <i class="zmdi zmdi-check mr-2"></i>
                                          <span class="c-black">Fitur Pencatatan Pengeluaran Tanpa Batasan</span>
                                      </li>
                                      <li>
                                          <i class="zmdi zmdi-check mr-2"></i>
                                          <span class="c-black">Akses Penuh ke Fitur Laporan Keuangan</span>
                                      </li>
                                      <li>
                                          <i class="zmdi zmdi-check mr-2"></i>
                                          <span class="c-black">Pilihan Kategori dan Aset yang Luas</span>
                                      </li>
                                      <li>
                                          <i class="zmdi zmdi-check mr-2"></i>
                                          <span class="c-black">Layanan Prioritas (VIP)</span>
                                      </li>
                                  </ul>
                                    <a href="beli.php?no=2" class="btn btn-custom btn-light">Beli Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                  </div>
               
                  
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
    $_SESSION['gagal_premium'] = 'Anda Sudah Meningkatkan Akun!';
    echo '<script>window.location.href = "../profile/profile.php";</script>';
}
      }

?>


 <?php 
include "../view/footer_t.php";
?>