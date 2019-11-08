<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	$foto_id       = $_POST['foto_id'];
	if(isset($foto_id)) {
		require_once "../includes/database.php";//database
		require_once "../includes/Foto-class.php";//all data
		$class_foto = new Foto($pdo);
		$foto = $class_foto->deleteFoto($foto_id);
		if($foto == 'success') {echo 'success';}
		else {echo 'failed';}
	}
	else {echo "error";}
?>