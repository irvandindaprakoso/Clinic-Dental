<?php 
	require_once "../includes/database.php";//database
	require_once "../includes/Pelanggar-class.php";//all data
	$class_pelanggar  = new Pelanggar($pdo);
	$pelanggar_id 	  = $_POST['id'];
	$status      	  = $_POST['status'];
    $updateStatus     = $class_pelanggar->updateLaporan($status,$pelanggar_id);
    echo "success";
?> 