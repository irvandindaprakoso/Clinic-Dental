<?php 
  include_once "../includes/database.php";
  include_once "../includes/Admin-class.php";
  include_once "../assets/plugins/Crypt.php";

  $crypt = new Crypt;
  $crypt->setKey('pL,mKoiJnbHuyGvcFtrDxzSewAq');

  $class_admin   = new Admin($pdo);
  $adminID       = $_SESSION['id'];
  $admin         = $class_admin->editAdmin($adminID);

  $crypt->setData($admin->admin_password);
  $password = $crypt->decrypt();
?>
<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-4 col-sm-4 col-xs-12" style="min-height: 536px;">
        <div class="x_panel">
          <div class="x_title">
            <h2>Your Profile</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="chef-thumb">
              <img src="<?php if($admin->admin_foto == '') echo '../assets/images/no-pic.png'; echo $admin->admin_foto;?>" class="img-responsive">
            </div>
            <div class="form-group">
              <h3 align="center"> <?php echo $admin->admin_nama;?></h3>
              <div class="ln_solid"></div>
              <!-- <button id="button-edit" type="button" class="btn btn-success pull-right">Edit</button> -->
            </div>
          </div>
        </div>
      </div>
      <div id="form-edit" class="col-md-8 col-sm-8 col-xs-12" >
        <div class="x_panel">
          <div class="x_title">
            <h2>Profile</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="crop-avatar" style="margin-top: -50px!important; margin-bottom: -10px!important">
                <?php require_once "avatar-admin.php";?>
            </div>
            <form id="form-edit-admin" data-parsley-validate class="form-horizontal form-label-left">
              <input id="avatarForm" type="hidden" name="gambar" value="">
              <input id="adminID" type="hidden" name="adminID" value="<?=$adminID?>">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="username" name="username" required="required" value="<?=$admin->admin_nama;?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="email" name="email" required="required" value="<?=$admin->admin_email;?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="password" id="password" name="password" value="<?=$password;?>" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Select Status*</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="status" form="form-edit-admin" class="form-control" title="-Choose option-">
                      <option value="admin">Admin</option>
                      <option value="operator">Operator</option>
                    </select>
                  </div>
                </div>
                <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button class="btn btn-primary" type="button" id="button-cancel">Cancel</button>
                  <button class="btn btn-primary" type="reset">Reset</button>
                  <button id="button-update-profile" type="submit" class="btn btn-success">Update</button>
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
  var requestupdateprofile;
  // Bind to the submit event of our form
  $("#form-edit-admin").submit(function(event){
              
      // Abort any pending requestupdateprofile
      if (requestupdateprofile) {
          requestupdateprofile.abort();
      }
      // setup some local variables
      var $form = $(this);
              
      // Let's select and cache all the fields
      var $inputs = $form.find("input, button");
      
      // Serialize the data in the form
      var serializedData = $form.serialize();

      requestupdateprofile = $.ajax({
          url: "admin-update.php",
          type: "post",
          beforeSend: function(){ $("#button-update-profile").html('<i class="fa fa-spinner fa-pulse"></i> Updating...');},
          data: serializedData
      });
              
      // Callback handler that will be called on success
      requestupdateprofile.done(function (msg){
          console.log(msg);
          if(msg=='success') {
              $.gritter.add({
                  title:"Success!",
                  text:"Profile has been updated.",
                  image:"../assets/images/rambu-success.png",
                  sticky:false,
                  time:""
              });
              setTimeout(function() {
                  window.location="profile";
              }, 2000);
          }
          else {
              $("#button-update-profile").html('<i class="fa fa-check"></i> Update');
              $.gritter.add({
                  title:"Failed! Something wrong",
                  text:"Can't Update Profile. Please try again.",
                  image:"../assets/images/rambu-success.png",
                  sticky:false,
                  time:""
              });
          }
      });
      // Callback handler that will be called regardless
      // if the requestupdateprofile failed or succeeded
      requestupdateprofile.always(function () {
          // Reenable the inputs
          $inputs.prop("disabled", false);
      });
              
      // Prevent default posting of form
      event.preventDefault();
  });
// END UPDATE Profile
</script>