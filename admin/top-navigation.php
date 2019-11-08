<?php 
  $userID         = $_SESSION['id'];
  // $class_pelanggar = new Pelanggar($pdo);
  $class_user     = new Users($pdo);
  // $pelanggar       = $class_pelanggar->notifPelanggar();
  $user           = $class_user->editUser($userID);
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
            <img src="<?php if (empty($user->user_foto)) echo "../assets/images/no-pic.png"; else echo $user->user_foto; ?>" alt="<?php if (empty($user->user_foto)) echo "../assets/images/no-pic.png"; else echo $user->user_foto; ?>"><?php echo $user->user_nama ?>
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
