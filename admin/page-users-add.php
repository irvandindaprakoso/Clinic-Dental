<?php 
  include_once "../includes/database.php";
  include_once "../includes/Users-class.php";
  include_once "../assets/plugins/Crypt.php";

  $crypt = new Crypt;
  $crypt->setKey('pL,mKoiJnbHuyGvcFtrDxzSewAq');

  $class_user   = new Users($pdo);
  $userID       = $_GET['id'];
  $user         = $class_user->editUser($userID);

  if ($page!= 'user-add') {
    $crypt->setData($user->user_password);
    $password = $crypt->decrypt();
  }
?>
<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div id="form-edit" class="col-md-12 col-sm-12 col-xs-12" >
        <div class="x_panel">
          <div class="x_title">
            <h2><?php if($page=='user-add')echo "Add User"; else echo "Edit User" ?></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="crop-avatar" style="margin-top: -100px!important; margin-bottom: -10px!important">
                <?php require_once "avatar-admin.php";?>
            </div>
            <form id="<?php if($page!='user-add')echo 'form-edit-user'; else echo 'form-add-user';?>" data-parsley-validate class="form-horizontal form-label-left">
              <input id="avatarForm" type="hidden" name="gambar" value="<?php if($page!='user-add')echo $user->user_foto; else echo "../assets/images/no-pic.png"?>">
              <?php if($page!='user-add'):?>
                <input id="userID" type="hidden" name="userID" value="<?=$userID?>">
              <?php endif ?>
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-4 col-xs-12" for="username">Username <span class="required">*</span>
                  </label>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="text" id="username" name="username" required="required" value="<?php if($page!='user-add') echo $user->user_nama;?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-4 col-xs-12" for="email">Email <span class="required">*</span>
                  </label>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="text" id="email" name="email" required="required" value="<?php if($page!='user-add')echo $user->user_email;?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-4 col-xs-12" for="password">Password <span class="required">*</span>
                  </label>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="password" id="password" name="password" value="<?php if($page!='user-add') echo $password;?>" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 col-sm-4 col-xs-12" >Select Status*</label>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <select name="status" form="<?php if($page!='user-add') echo 'form-edit-user'; else echo 'form-add-user';?>" class="form-control" title="-Choose option-">
                        <?php if($page!='user-add'){ ?>
                          <option value="admin" <?php if($user->user_status=='admin')echo 'selected';?>>user</option>
                          <option value="operator" <?php if($user->user_status=='operator')echo 'selected';?>>Operator</option>
                        <?php } else { ?>
                          <option value="admin">Admin</option>
                          <option value="operator">Operator</option>
                        <?php }?>
                    </select>
                  </div>
                </div>
                <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button class="btn btn-primary" type="button" id="button-cancel">Cancel</button>
                  <button class="btn btn-primary" type="reset">Reset</button>
                  <button id="<?php if($page!='user-add')echo 'button-update-user'; else echo 'button-add-user';?>" type="submit" class="btn btn-success"><?php if($page!='user-add')echo "Update"; else echo "Add"; ?></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Cropper -->
<script src="../assets/plugins/cropper/cropper.min.js"></script>
<script src="../assets/plugins/cropper/cropper-main.js"></script>
<script type="text/javascript">
  var auto_refresh = setInterval(
    function () {
        var asd = $('#avatar-view').find('img').attr('src');
        $('#avatarForm').attr('value', asd);
    }, 500);

  // START UPDATE PROFILE CODE
  var requestadd;
  // Bind to the submit event of our form
  $("#form-add-user").submit(function(event){
              
      // Abort any pending requestadd
      if (requestadd) {
          requestadd.abort();
      }
      // setup some local variables
      var $form = $(this);
              
      // Let's select and cache all the fields
      var $inputs = $form.find("input, button");
      
      // Serialize the data in the form
      var serializedData = $form.serialize();

      requestadd = $.ajax({
          url: "user-add.php",
          type: "post",
          beforeSend: function(){ $("#button-add-user").html('<i class="fa fa-spinner fa-pulse"></i> Adding...');},
          data: serializedData
      });
              
      // Callback handler that will be called on success
      requestadd.done(function (msg){
          console.log(msg);
          if(msg=='success') {
              $.gritter.add({
                  title:"Success!",
                  text:"user has been added.",
                  image:"../assets/images/rambu-success.png",
                  sticky:false,
                  time:""
              });
              setTimeout(function() {
                  window.location="data-users";
              }, 2000);
          }
          else {
              $("#button-add-user").html('<i class="fa fa-check"></i> Update');
              $.gritter.add({
                  title:"Failed! Something wrong",
                  text:"Can't Add user. Please try again.",
                  image:"../assets/images/rambu-success.png",
                  sticky:false,
                  time:""
              });
          }
      });
      // Callback handler that will be called regardless
      // if the requestupdate failed or succeeded
      requestadd.always(function () {
          // Reenable the inputs
          $inputs.prop("disabled", false);
      });
              
      // Prevent default posting of form
      event.preventDefault();
  });
// END ADD User
// START UPDATE User CODE
  var requestupdate;
  // Bind to the submit event of our form
  $("#form-edit-user").submit(function(event){
              
      // Abort any pending requestupdate
      if (requestupdate) {
          requestupdate.abort();
      }
      // setup some local variables
      var $form = $(this);
              
      // Let's select and cache all the fields
      var $inputs = $form.find("input, button");
      
      // Serialize the data in the form
      var serializedData = $form.serialize();

      requestupdate = $.ajax({
          url: "user-update.php",
          type: "post",
          beforeSend: function(){ $("#button-update-user").html('<i class="fa fa-spinner fa-pulse"></i> Updating...');},
          data: serializedData
      });
              
      // Callback handler that will be called on success
      requestupdate.done(function (msg){
          console.log(msg);
          if(msg=='success') {
              $.gritter.add({
                  title:"Success!",
                  text:"user has been updated.",
                  image:"../assets/images/rambu-success.png",
                  sticky:false,
                  time:""
              });
              setTimeout(function() {
                  window.location="data-users";
              }, 2000);
          }
          else {
              $("#button-update-user").html('<i class="fa fa-check"></i> Update');
              $.gritter.add({
                  title:"Failed! Something wrong",
                  text:"Can't Update user. Please try again.",
                  image:"../assets/images/rambu-success.png",
                  sticky:false,
                  time:""
              });
          }
      });
      // Callback handler that will be called regardless
      // if the requestupdate failed or succeeded
      requestupdate.always(function () {
          // Reenable the inputs
          $inputs.prop("disabled", false);
      });
              
      // Prevent default posting of form
      event.preventDefault();
  });
// END UPDATE Profile
</script>