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
    <title>Login System</title>
    <!-- Core CSS - Include with every page -->
    <link rel="icon" type="image/png" href="assets/images/logo-app.png" />
    <link href="assets/css/styleku.css" rel="stylesheet" />
    <link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <script src="assets/plugins/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
</head>

<body>
	<?php
        if (isset($_GET['error'])) {
            if(@$_SESSION['error']==2)
        echo '<p class="error">Account is locked due to 5 failed logins!</p>';
        else
        echo '<p class="error">Error Logging In!</p>';
        }
    ?> 
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
                <!-- <div align="center" style="color: #8adcfe; margin-top: -45px;">
                    <h4 style="font-size: 17px!important">Sistem Informasi Pelaporan Pelanggaran Parkir</h4>
                </div> -->
                <div class="login-panel panel panel-default" id="login-panel" style="margin-top: 5%!important">                  
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body" id="body-form">
                    	<div id="error" style="display:none;" class="alert alert-danger animated flipInX">
						  <h4>Oh snap!</h4>
						  <p>Username & password seems to be invalid :(</p>
						</div>
                        <form role="form" action="" data-parsley-validate method="POST" name="login_form" id="login_form" >
                            <fieldset>
                                <div class="form-group">
                                    <input type="username" class="form-control" placeholder="Username" name="username" id="username" autofocus data-parsley-trigger="change" data-parsley-id required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" data-parsley-minlength="3" data-parsley-trigger="change" required>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" name="btn" class="btn btn-lg btn-success btn-block"  value="Login" id="btnLogin">Login</button>
                            </fieldset>
                        </form>
                        <?php 
                            require_once "includes/database.php";
                            require_once "includes/Login-class.php";
                            $class_login = new Login($pdo);
                            $login       = $class_login->viewLogin();
                            if($login=='0' || empty($login)){
                                echo "<p>If you don't have an acount, please <a href='register.php'>register</a></p>";
                            }else{
                                echo "";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="assets/plugins/jquery-1.10.2.js"></script>
<script src="assets/js/parsley.min.js" type="text/JavaScript"></script> 
<script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript">
	var sign_in;
	$("#login_form").submit(function(event){
		if(sign_in) {
		    sign_in.abort();
		}
		var $form = $(this);
		var serializedData = $form.serialize();
		sign_in = $.ajax({
		    url: "includes/process_login.php",
		    type: "post",
		    beforeSend: function(){ $("#btnLogin").html('<i class="fa fa-spinner fa-pulse"></i> Signing in...');$("#btnLogin").attr('disabled','disabled');},
		    data: serializedData
		});
		sign_in.done(function (msg){
            console.log(msg);
            console.log(serializedData);
		    if(msg == 'admin') {
		      	window.location = "admin/index.php";
		    }
            else if(msg == 'operator') {
                window.location = "operator/index.php";
            }
		    else if(msg == 'wrong-password') {
		    	$('#login-panel').addClass('animated wobble');
		      	$("#btnLogin").removeAttr('disabled');
				$("#btnLogin").html('Sign in');
				$("#error").show();
				setTimeout(function(){
						$('#login-panel').removeClass('animated wobble');
						}, 500);
		    }
		    else {
		      	$('#login-panel').addClass('animated wobble');
		      	$("#btnLogin").removeAttr('disabled');
				$("#btnLogin").html('Sign in');
				$("#error").show();
                setTimeout(function(){
                        $('#login-panel').removeClass('animated wobble');
                        }, 500);
		    }
		});
		event.preventDefault();
	});
</script>
</body>
</html>