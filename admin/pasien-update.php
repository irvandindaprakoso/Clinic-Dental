<?php
	require "../includes/database.php";//database
	require "../includes/Pasien-class.php";

	$class_pasien = new Pasien($pdo);

	$nomor    		= $_POST['no_rm'];
	$nama 	     	= $_POST['nama_pasien'];
	$tgllahir  		= $_POST['tgl-lahir'];
	$umur     	 	= $_POST['umur_pasien'];
	$alamat 		= $_POST['alamat'];
	$jk 	       	= $_POST['gender'];
	$telp       	= $_POST['telp'];
	$ortu 			= $_POST['nama_ortu'];
	
	
	if(empty($nomor) || empty($nama) || empty($tgllahir) || empty($umur) || empty($alamat) || empty($jk) || empty($telp) || empty($ortu)){
		echo "error";
	}
	else {
		
		$update_pasien = $class_pasien->updatePasien($nomor,$nama, $tgllahir, $umur, $alamat, $jk, $telp, $ortu);
		echo 'success';
	}
	
?>