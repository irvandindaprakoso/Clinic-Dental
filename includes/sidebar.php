<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>General</h3> 
    <ul class="nav side-menu">
      <li><a href="index.php"><i class="fa fa-home"></i> Dashboard </a> </li>
      <?php if ($_SESSION['status']!='operator') { ?>
      	<li><a href="data-users"><i class="fa fa-user"></i> Data Users </a>
      <?php } ?>
      <li><a href="data-pasien"><i class="fa fa-medkit"></i> Data Pasien </a>
      <li><a href="pembayaran"><i class="fa fa-file-text"></i> Pembayaran </a>
    </ul>
  </div>
</div>

            