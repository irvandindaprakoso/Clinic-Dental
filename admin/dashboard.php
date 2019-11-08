<?php 
  require_once "../includes/Pasien-class.php";
  $class_users     = new Users($pdo);
  $class_pasien    = new Pasien($pdo);
  $pasien          = $class_pasien->showPasien();
  $superUser       = $class_user->showSuperUser();
  $operator        = $class_user->showOperator();
?>
<div class="right_col" role="main" style="min-height: 400px!important">
  <div class="">
    <div class="row top_tiles">
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-ban"></i></div>
          <div class="count"><?php echo count($pasien);?></div>
          <h3>Total Pasien</h3>
          <!-- <p>Lorem ipsum psdea itgum rixt.</p> -->
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-user"></i></div>
          <div class="count"><?php echo count($user);?></div>
          <h3>Total Administrator</h3>
          <!-- <p>Lorem ipsum psdea itgum rixt.</p> -->
        </div>
      </div>
      <!-- <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-users"></i></div>
          <div class="count"><?php echo count($operator);?></div>
          <h3>Total Operator</h3> -->
          <!-- <p>Lorem ipsum psdea itgum rixt.</p> -->
        <!-- </div>
      </div> -->
    </div>
    <div class="bs-example" data-example-id="simple-jumbotron">
      <div class="jumbotron" style="background: #2b2b2b; margin-bottom: 0!important">
        <h3 class="text-success">Welcome to Dashboard Vozz Dental </h3>
        <p class="text-white" align="justify">Sistem informasi klinik <span class="label label-success">Vozz Dental</span> digunakan untuk mempermudah penyimpanan data pasien dan rekam medis. Dalam sistem ini juga terdapat kasir yg berfungsi untuk mempermudah transaksi antara pasien dan dokter serta menyimpan riwayat pembayaran.</p>
        <!-- <p class="text-white">We will gives you full creativity to create your own <span class="label label-success">creative website</span>. Check our documentation for more help, or email us if you have any problems.</p> -->
      </div>
    </div>
    
  </div>
</div>