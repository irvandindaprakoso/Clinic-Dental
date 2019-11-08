<?php
  	require_once "../includes/database.php";//database
	require_once "../includes/Foto-class.php";//all data
	require_once "../includes/ImageResize.php";

	if (!empty($_FILES)) {
	    $temp_file = $_FILES['file']['tmp_name'];               
	    $target_path = '../assets/images/pasien/';  
	    $extension = end(explode(".", $_FILES["file"]["name"]));
	    $file_name = md5(uniqid(rand(), true));
	    $target_file =  $target_path.$file_name;  
	    move_uploaded_file($temp_file,$target_file.'.'.$extension);

	    $image = new \Eventviva\ImageResize('../assets/images/pasien/'.$file_name.'.'.$extension);
	    $image->crop(250, 250);
		$image->save('../assets/images/_thumbs/'.$file_name.'.'.$extension);

	     
	    $foto_class = new Foto($pdo);
	    $pasien_id = $_POST['pasien_id'];
	    $foto = $foto_class->addFoto($file_name.'.'.$extension, $pasien_id);
    	if($foto == "success") {
    		echo "success";
    	}
    	else {
    		echo "failed";
    	}
	}
?>