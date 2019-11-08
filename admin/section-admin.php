<?php 
  $superUser = $class_user->showSuperUser();
  $sessionID  = $_SESSION['id'];
?>
        <div class="x_content">

          <div class="row" style="padding-top:10px;">
            <?php
              if($superUser==0 || empty($superUser)){
              ?>
                <div class="col-sm-5" style="padding-top: 10px;">
                    <div id="note-gallery" class="note note-info">
                        <p>You have not entered data on this page.</p>
                    </div>
                </div>
          </div>
          <div class="row"  >
              <?php
              } else {
              foreach ($superUser as $data) {
            ?>
              <div class="col-md-3 col-xs-12">
                  <div class=" thumbnail" data-wow-duration="1.5s" data-wow-delay="0s" style="height: 430px">
                      <div class="image-inner">
                        <img src="<?php if ($data->user_foto=='') echo '../assets/images/no-pic.png'; else echo $data->user_foto; ?>" alt="user foto" />
                        
                        <div class=" portfolio-actbutton" style="bottom:-15px;">
                          <center>
                            <span >
                                <button type="button" class="btn btn-success btn-icon btn-circle" <?php if($sessionID != $data->user_id)echo "onclick=location.href='user-edit&$data->user_id'"; else echo "onclick=location.href='profile'";?> title="Edit User" ><i class="fa fa-pencil"></i></button>
                                <?php 
                                if ($sessionID != $data->user_id) { ?>
                                <button type="button" class="btn btn-danger btn-icon btn-circle" data-target="#delete-dialog" data-nm="<?=$data->user_nama; ?>" data-hapus="<?=$data->user_id; ?>"  title="Delete user" data-toggle="modal"><i class="fa fa-times"></i></button>
                                <?php } ?>
                            </span>
                          </center>
                        </div> 
                      </div>
                    <?php 
                    $crypt->setData($data->user_password);
                    $pass = $crypt->decrypt();
                    ?>
                    <div class="caption" style="background: rgba(242,245,245,0.8); height: 151px;">
                      <div class="rating" align="center">
                        <h3><?=$data->user_nama;?> </h3>
                      </div>
                        <h4><i class="fa fa-envelope"> <?=$data->user_email;?></i></h4>
                        <h4><i class="fa fa-eye"> <?=$pass ?></i></h4>
                        <h4><i class="fa fa-star"> <?=$data->user_status?></i></h4>
                    </div>
                  </div>
              </div> 
          <?php 
              } 
          } 
          ?>
          <div class="col-sm-3">
              <div class=" thumbnail" style="height: 430px">
                  <div class="image-inner">
                      <a href="user-add">
                          <img src="../assets/images/add.png" alt="..." title="Add User" />
                      </a>
                  </div>
                <div class="caption" style="height:151px; background: rgba(242,245,245,0.8);">
                  <h3>Add new user </h3>
                    <div class="rating">
                    </div>
                    <div class="desc">
                      Click here to add new user
                    </div>
                </div>
              </div>
          </div> 
        </div>
      </div>
  <div class="clearfix"></div>
  <div class="modal animated rotateInUpLeft" id="delete-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-white">Peringatan!</h4>
            </div>
            <div class="modal-body">
                <p>Yakin Akan Menghapus Data "<span id="nm"></span>" ? </p>
                <?php
                    if (isset ($_POST['hapus'])) {
                        //Delete Handler
                        $deleteit    = sha1("deleteit");
                        $userID     = $_POST['userID'];
                        $delUser    = $class_user->deleteUser($userID);
                          header('location:data-users') ;
                    } 
                ?>
                <form action="" method="post">
                    <input type="hidden" name="userID" value="" id="delete">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                </form>
            </div>
        </div>
    </div>
  </div>
<script type="text/javascript">
$(document).ready(function() {
  $('#delete-dialog').on('show.bs.modal', function(e) {
    $(this).find('#delete').attr('value', $(e.relatedTarget).data('hapus'));
    $(this).find('#nm').html($(e.relatedTarget).data('nm'));
  });
});
</script>