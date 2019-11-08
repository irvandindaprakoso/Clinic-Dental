<?php 
  $adminID         = $_SESSION['id'];
  // $class_pelanggar = new Pelanggar($pdo);
  $class_admin     = new Admin($pdo);
  // $pelanggar       = $class_pelanggar->notifPelanggar();
  $admin           = $class_admin->editAdmin($adminID);
  // $totalPelanggar  = count($pelanggar);

?>
<div class="top_nav" id="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="<?php if (empty($admin->admin_foto)) echo "../assets/images/no-pic.png"; else echo $admin->admin_foto; ?>" alt="<?php if (empty($admin->admin_foto)) echo "../assets/images/no-pic.png"; else echo $admin->admin_foto; ?>"><?php echo $admin->admin_nama ?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="profile"> Profile</a></li>
            <li><a href="../logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
          </ul>
        </li>

        <li role="presentation" class="dropdown" id="notify">
          
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->
