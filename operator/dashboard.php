<?php 
  $class_pelanggar = new Pelanggar($pdo);
  $class_users     = new Users($pdo);
  $class_admin     = new Admin($pdo);
  $admin           = $class_admin->showSuperAdmin();
  $operator        = $class_admin->showOperator();
  $pelanggar       = $class_pelanggar->showPelanggar();
  $users           = $class_users->showUsers();
?>
<div class="right_col" role="main" style="min-height: 400px!important">
  <div class="">
    <div class="row top_tiles">
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-ban"></i></div>
          <div class="count"><?php echo count($pelanggar);?></div>
          <h3>Total Pelanggar</h3>
          <!-- <p>Lorem ipsum psdea itgum rixt.</p> -->
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-user"></i></div>
          <div class="count"><?php echo count($admin);?></div>
          <h3>Total Administrator</h3>
          <!-- <p>Lorem ipsum psdea itgum rixt.</p> -->
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-users"></i></div>
          <div class="count"><?php echo count($operator);?></div>
          <h3>Total Operator</h3>
          <!-- <p>Lorem ipsum psdea itgum rixt.</p> -->
        </div>
      </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-mobile"></i></div>
          <div class="count"><?php echo count($users);?></div>
          <h3>Pengguna Aplikasi</h3>
          <!-- <p>Lorem ipsum psdea itgum rixt.</p> -->
        </div>
      </div>
    </div>
    <div class="bs-example" data-example-id="simple-jumbotron">
      <div class="jumbotron" style="background: #2b2b2b; margin-bottom: 0!important">
        <h3 class="text-success">Welcome to Dashboard Sistem Informasi Pelaporan Pelanggaran Parkir</h3>
        <p class="text-white" align="justify">Sistem informasi pelaporan pelanggaran parkir merupakan suatu sistem yang menampung keluhan masyarakat mengenai pelanggaran parkir dibahu jalan. Melalui sistem ini kami dapat memantau dimana pelanggaran parkir kerap terjadi. Selain memantau, kami juga dapat melakukan tindakan lebih lanjut seperti <span class="label label-success">Tilang online</span></p>
        <!-- <p class="text-white">We will gives you full creativity to create your own <span class="label label-success">creative website</span>. Check our documentation for more help, or email us if you have any problems.</p> -->
      </div>
    </div>
    
  </div>
</div>