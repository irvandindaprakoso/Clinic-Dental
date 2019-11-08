<?php
	include_once "../includes/database.php";
	include_once "../includes/Pelanggar-class.php";
	$class_pelanggar = new Pelanggar($pdo);
	$pelanggar       = $class_pelanggar->notifPelanggar();
	$totalPelanggar  = count($pelanggar);
	// if($totalPelanggar!=0) echo $totalPelanggar;
	// echo $totalPelanggar;
?>
<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
    <i class="fa fa-bell-o"></i> <?php 
    if ($pelanggar == 0 || empty($pelanggar)){ ?>
      <span class="badge bg-green" style="display:none"></span> <?php
    }else{ ?>
      <span class="badge bg-green">
      <?php echo $totalPelanggar; ?>
        <!-- <div id="test"></div> -->
      </span> <?php
    } ?>
  </a>
  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
    <?php 
      if ($pelanggar!=0 || !empty($pelanggar)){
        foreach ($pelanggar as $data ): ?>
          <li>
            <a href="detail-pelanggar&<?php echo $data->pelanggar_id ?>" id="detailPelanggar<?php echo $data->pelanggar_id ?>">
              <span class="image"><img src="<?php if (empty($data->user_foto)) echo "../assets/images/no-pic.png"; else echo "../assets/images/users/".$data->user_foto; ?>" alt="Profile Image" /></span>
              <span>
                <span style="color:#0598ff"><?php echo $data->user_nama ?></span>
                <span class="time"><?php echo $data->pelanggar_tgl_waktu;?></span>
              </span>
              <span class="message">
                Kendaraan dengan plat nomor <span class="label label-success"><?php echo $data->stnk_platnomor;?></span> telah melanggar rambu larangan parkir.
              </span>
            </a>
          </li> 
          <script type="text/javascript">
            $('#detailPelanggar<?php echo $data->pelanggar_id;?>').on('click', function() {
                var id   = <?php echo $data->pelanggar_id;?>;
                var read = 1;
                $.ajax({
                    type:"post",
                    url:"read-pelanggar.php",
                    data: {id:id, read:read},
                    cache:false
                });
                setTimeout(function() {
                    window.location="detail-pelanggar&<?=$data->pelanggar_id;?>";
                }, 200);
            })
          </script><?php 
        endforeach;
      } else if ($totalPelanggar>=5){ ?>
      <li>
        <div class="text-center">
          <a>
            <strong>See All Alerts</strong>
            <i class="fa fa-angle-right"></i>
          </a>
        </div>
      </li> <?php 
    } else { ?>
        <li style="background-color: #ffb8b8;">
          <a>
            <span class="image"><img src="../assets/images/close.png" alt="" /></span>
            <span class="message" style="font-size:11pt;">
              You haven't a notification
            </span>
          </a>
        </li> <?php 
    } ?>
  </ul>