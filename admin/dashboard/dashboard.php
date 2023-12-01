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
$qU = mysqli_query($koneksi, "SELECT * FROM users");
$users = mysqli_num_rows($qU);
$qC = mysqli_query($koneksi, "SELECT * FROM kontak");
$kontak = mysqli_num_rows($qC);
 
?>       
      

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
         
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $users ?></h3>

                <p>User</p>
              </div>
              <div class="icon">
              <i class="fas fa-users"></i>
              </div>
              <a href="../akun/akun.php" class="small-box-footer">Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?= $kontak ?></h3>

                <p>Kontak</p>
              </div>
              <div class="icon">
              <i class="far fa-comment-alt"></i>
              </div>
              <a href="../kontak/kontak.php" class="small-box-footer">Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
</div>
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php 
include "../view/footer_t.php";
?>
