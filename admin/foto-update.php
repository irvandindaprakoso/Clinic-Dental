<?php
	$foto_id       = $_POST['foto_id'];
	$foto_desc     = $_POST['foto_desc'];
	if(isset($foto_id) && isset($foto_desc)) {
		require_once "../includes/database.php";//database
		require_once "../includes/Foto-class.php";//all data
		$class_foto = new Foto($pdo);
		$foto_update = $class_foto->updateFoto($foto_desc, $foto_id);
		if($foto_update == 'success') {echo 'success';}
		else {echo 'failed';}
	}
	else {echo "error";}
?>