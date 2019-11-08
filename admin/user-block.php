<?php 
	require_once "../includes/database.php";//database
	require_once "../includes/Users-class.php";//all data user
	$class_user   = new Users($pdo);
	$block     	  = $_POST['block'];
	$id 	  	  = $_POST['id'];
    $update       = $class_user->blockUser($block,$id);
    echo "success";
?> 