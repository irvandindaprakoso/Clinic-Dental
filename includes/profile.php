<?php 
    $userID = $_SESSION['id'];
    $class_user     = new Users($pdo);
    $user           = $class_user->editUser($userID);
?>
<!-- menu profile quick info -->
<div class="profile clearfix">
  <div class="sidebar-profile">
    <img src="<?php if ($user->user_foto == "")echo "../assets/images/no-pic.png"; else echo $user->user_foto;?>"  class="img-responsive">
  </div>
  <div class="profile_info">
    <span>Welcome, <?php echo $user->user_nama ?></span>
    <h2><?=$user->user_status;?></h2>
  </div>
</div>
<!-- /menu profile quick info -->