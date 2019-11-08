<?php
include "../assets/plugins/Crypt.php";
require "../includes/database.php";//database
require "../includes/Users-class.php";//all data
$crypt = new Crypt;
$crypt->setKey('pL,mKoiJnbHuyGvcFtrDxzSewAq');
	
	$class_user = new Users($pdo);
	$userID 	 = $_POST['userID'];
	$username    = $_POST['username'];
	$email 	     = $_POST['email'];
	$enpassword  = $_POST['password'];
	$crypt->setData($enpassword);
	$password    = $crypt->encrypt();
	$foto        = $_POST['gambar'];
	$status      = $_POST['status'];
	if(strlen($username)<1){ echo "no-username";}
	elseif(strlen($password)<1){echo "no-password";}
	elseif(strlen($foto)<1){echo "no-gambar";}
	else{
			$update_user = $class_user->updateUser($username, $password, $email, $foto, $status, $userID);
			echo "success";
		}
?>