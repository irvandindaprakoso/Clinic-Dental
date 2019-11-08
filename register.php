<?php
	include_once 'includes/db_connect.php';
	ini_set('display_errors', 1);
	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Core CSS - Include with every page -->
    <link rel="icon" type="image/png" href="assets/images/logo-app.png" />
    <link href="assets/css/styleku.css" rel="stylesheet" />
    <link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <!-- Gritter -->
    <link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet">
    <script src="assets/plugins/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
</head>

<body background="assets/images/6.jpg" >
 
    <div class="body-Login">
        <div class="body-Login-img"></div>
        <div class="body-Login-back"></div>
    </div>
    <div class="container">
        <div class="row wow fadeIn" data-wow-duration="2s" data-wow-delay="0">
            <div class="col-md-4 col-md-offset-4 text-center logo-margin ">
              <img src="assets/images/logo-app.png" style="width: 80%">
            </div>
            <div class="col-md-4 col-md-offset-4">
                <div align="center" style="color: #8adcfe; margin-top: -45px;">
                    <h4 style="font-size: 17px!important">Sistem Informasi Pelaporan Pelanggaran Parkir</h4>
                </div>
                <div class="login-panel panel panel-default" id="login-panel" style="margin-top: 5%!important">                  
                    <div class="panel-heading">
                        <h3 class="panel-title">Register</h3>
                    </div>
                    <div class="panel-body" id="body-form">
                    	<!-- <div id="error" style="display:none;" class="alert alert-danger animated flipInX">
						  <h4>Oh snap!</h4>
						  <p>Username & password seems to be invalid :(</p>
						</div> -->
                        <form role="form" action="" data-parsley-validate method="POST" name="register_form" id="register_form" >
                            <fieldset>
                                <input type="hidden" name="gambar" value="../assets/images/no-pic.png">
                                <input type="hidden" name="status" value="admin">
                                <div class="form-group">
                                    <input type="username" class="form-control" placeholder="Username" name="username" id="username" autofocus data-parsley-trigger="change" data-parsley-id required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" name="email" id="email" autofocus data-parsley-trigger="change" data-parsley-id required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" data-parsley-minlength="3" data-parsley-trigger="change" required>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" name="btn" class="btn btn-lg btn-success btn-block"  value="Register" id="btn-register">Register</button>

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="assets/plugins/jquery-1.10.2.js"></script>
<script src="assets/js/parsley.min.js" type="text/JavaScript"></script> 
<script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
<!-- Gritter -->
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>

<script type="text/javascript">

  // START UPDATE PROFILE CODE
  var requestadd;
  // Bind to the submit event of our form
  $("#register_form").submit(function(event){
              
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
          url: "admin/admin-add.php",
          type: "post",
          beforeSend: function(){ $("#btn-register").html('<i class="fa fa-spinner fa-pulse"></i> Adding...');},
          data: serializedData
      });
              
      // Callback handler that will be called on success
      requestadd.done(function (msg){
          console.log(msg);
          if(msg=='success') {
              $.gritter.add({
                  title:"Success!",
                  text:"Admin has been added.",
                  image:"assets/images/rambu-success.png",
                  sticky:false,
                  time:""
              });
              setTimeout(function() {
                  window.location="index.php";
              }, 2000);
          }
          else {
              $("#btn-register").html('<i class="fa fa-check"></i> Update');
              $.gritter.add({
                  title:"Failed! Something wrong",
                  text:"Can't Add admin. Please try again.",
                  image:"assets/images/rambu-failed.png",
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
</script>