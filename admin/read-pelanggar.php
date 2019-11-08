<?php 
	require_once "../includes/database.php";//database
	require_once "../includes/Pelanggar-class.php";//all data
	$class_pelanggar  = new Pelanggar($pdo);
	$pelanggar_id 	  = $_POST['id'];
	$read      		  = $_POST['read'];
    $updateRead       = $class_pelanggar->readPelanggar($read,$pelanggar_id);
    echo "success";
?> 