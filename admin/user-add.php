<?php
include "../assets/plugins/Crypt.php";
require "../includes/database.php";//database
require "../includes/Users-class.php";//all data
$crypt = new Crypt;
$crypt->setKey('pL,mKoiJnbHuyGvcFtrDxzSewAq');
	
	$class_user = new Users($pdo);
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
	$checkName = $class_user->checkName($username);
		if($checkName == 1){echo "same-username";}
		else{
			$addUser = $class_user->addUser($username, $password, $email, $foto, $status);
			echo "success";
		}
	}	
?>