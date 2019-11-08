<?php 
  include_once "../includes/Users-class.php";
  $class_users = new Users($pdo);
  $users       = $class_users->showUsers();

?>
<div class="right_col" role="main">
  <center><div id="map"></div></center>
  
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Kontak Pengguna Aplikasi</h3>
      </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>List <small>Pengguna Aplikasi Android</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <p class="text-muted font-13 m-b-30">
              Dibawah ini merupakan data member pengguna 
            </p>
            <table id="datatable" class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Alamat</th>
                  <th>Status</th>
                  <th width="10%">Action</th>
                </tr>
              </thead>
              <tbody >
              <?php 
                $no = 0;
                if (count($users) != 0 ):
                  foreach ($users as $data):
                    if ($data->user_block != 1)$block = "Active"; else $block = "Blocked";
                    $no++; ?>
                    <tr style="<?php if ($block=="Active") echo "color: #09bff5;"?>">
                      <td><?php echo $no; ?></td>
                      <td><?php echo $data->user_nama ?></td>
                      <td><?php echo $data->user_email ?></td>
                      <td><?php echo $data->user_alamat ?></td>
                      <td><?php echo $block ?></td>
                      <td>
                        <button id="detail-kontak<?=$data->user_id;?>" data-target="#detail-kontak<?=$data->user_id;?>" data-toggle="modal" type="button" class="btn btn-success btn-icon btn-circle" title="Details" ><i class="fa fa-eye"></i></button>
                        <!-- <button type="button" class="btn btn-danger btn-icon btn-circle" data-target="#delete-dialog" data-nm="<?=$data->user_nama;?>" data-hapus="<?=$data->user_id;?>"  title="Delete" data-toggle="modal"><i class="fa fa-times"></i></button> -->
                      </td>
                    </tr>
                    <div class="modal animated rotateInDownLeft" id="detail-kontak<?=$data->user_id;?>">
                      <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                              <div class="modal-header bg-green">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                  <h4 class="modal-title text-white">Detail Kontak</h4>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="chef-thumb">
                                      <img src="<?php if($data->user_foto == '') echo '../assets/images/no-pic.png'; echo '../assets/images/users/'.$data->user_foto;?>"  style="max-height: 100%; ">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <form id="form-admin-add" data-parsley-validate action=""  method="post">
                                      <legend>Data Pengguna Aplikasi</legend>
                                      <h2><strong><?=$data->user_nama?></strong></h2>
                                      
                                      <ul class="list-unstyled">
                                        <li><i class="fa fa-building"></i> <?=$data->user_alamat?> </li>
                                        <li><i class="fa fa-envelope"></i> <?=$data->user_email?> </li>
                                        <li><i class="fa fa-phone"></i> <?=$data->user_telpon?> </li>
                                      </ul><br>
                                      <legend>Status Pengguna</legend>
                                      <div class="form-group">
                                      <?php  if ($data->user_block == 0){?>
                                        <label class="control-label col-md-5 col-sm-5 col-xs-12 "><span style="background: #28a509;border-radius: 7px;padding: 10px;color: #FFF;">Active User</span ></label>
                                      <?php } else { ?>
                                      <label class="control-label col-md-5 col-sm-5 col-xs-12 "><span style="background: #656765;border-radius: 7px;padding: 10px;color: #FFF;">Blocked User</span></label>
                                      <?php }?>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                          <button  type="button" class="btn btn-success btn-icon btn-circle" id="user_active<?=$data->user_id?>" title="Active User" ><i class="fa fa-user"></i></button>
                                          <button  type="button" class="btn btn-dark btn-icon btn-circle" id="user_block<?=$data->user_id?>" title="Block User" ><i class="fa fa-user"></i></button>
                                          
                                        </div>
                                      </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-white" data-dismiss="modal">Back</button>
                                  <!-- <button id="button-admin-add" type="submit" class="btn btn-success">Simpan</button> -->
                                  </form>
                              </div>
                          </div>
                      </div>
                    </div>
                    <script type="text/javascript">
                      $('#user_block<?=$data->user_id?>').on('click', function(){
                        // $(this).hide();
                        // $('#lamp<?php //echo $data->lampID?>').attr('src', 'images/invention-on.png');
                        // var returnVal = confirm("Are you sure want to Block <?=$data->user_nama?>");
                        // $('#user_active<?=$data->user_id?>').show();
                        var block = 1; 
                        var id  = '<?=$data->user_id?>';
                        $.ajax({
                            type:"POST",
                            url:"user-block.php",
                            data: {block:block, id:id},
                            cache:false,
                            success:function(msg){
                              // console.log(msg);
                              if(msg == 'success'){
                                $.gritter.add({
                                    title:"Success!",
                                    text:"User has been Blocked.",
                                    image:"../assets/images/rambu-success.png",
                                    sticky:false,
                                    time:""
                                });
                              }
                            }
                        });
                        setInterval(function(){
                          window.location.reload();
                        },500);
                      });

                      $('#user_active<?=$data->user_id?>').on('click', function(){
                        // $(this).hide();
                        // $('#lamp<?php //echo $data->lampID?>').attr('src', 'images/invention-on.png');
                        // var returnVal = confirm("Are you sure want to Activate <?=$data->user_nama?>");
                        // $(this).prop(returnVal);
                        // $('#user_block<?=$data->user_id?>').show();
                        var block = 0; 
                        var id  = '<?=$data->user_id?>';
                        var req = $.ajax({
                            type:"post",
                            url:"user-block.php",
                            data: {block:block, id:id},
                            cache:false
                        });

                        req.done(function(msg){
                          // alert(msg);
                          if(msg == 'success'){
                              $.gritter.add({
                                  title:"Success!",
                                  text:"User has been Activate.",
                                  image:"../assets/images/rambu-success.png",
                                  sticky:false,
                                  time:""
                              });
                            }
                        });
                        setInterval(function(){
                          window.location.reload();
                        },500);
                      });
                    </script>
                    <?php 
                  endforeach;
                endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<!-- <div class="modal animated rotateInUpLeft" id="delete-dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-red">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title text-white">Peringatan!</h4>
      </div>
      <div class="modal-body">
        <p>Yakin akan Menghapus Data "<span id="nm"></span>" ? </p>
        <?php
        if (isset ($_POST['hapus'])) {
        //Delete Handler
        $deleteit    = sha1("deleteit");
        $userID      = $_POST['userID'];
        $delete      = $class_users->deleteUser($userID);
        header('location:kontak-pengguna') ;
        }
        ?>
        <form action="" method="post">
          <input type="text" name="userID" value="" id="delete">
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
</script> -->