<?php
	ini_set('display_errors', 1);
  error_reporting(E_ERROR | E_WARNING | E_PARSE);
/*
-- Source Code from My Notes Code (www.mynotescode.com)
-- 
-- Follow Us on Social Media
-- Facebook : http://facebook.com/mynotescode/
-- Twitter  : http://twitter.com/code_notes
-- Google+  : http://plus.google.com/118319575543333993544
--
-- Terimakasih telah mengunjungi blog kami.
-- Jangan lupa untuk Like dan Share catatan-catatan yang ada di blog kami.
*/

// Load file koneksi.php
include "../includes/database.php";
include "../includes/Pasien-class.php";

if(isset($_POST['import'])){ // Jika user mengklik tombol Import	
	$nama_file_baru = 'data-pasien.xls';
		// Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
		// Upload file yang dipilih ke folder tmp
		// dan rename file tersebut menjadi data{ip_address}.xlsx
		// {ip_address} diganti jadi ip address user yang ada di variabel $ip
		// Contoh nama file setelah di rename : data127.0.0.1.xlsx
		$tipe_file = $_FILES['file']['type']; // Ambil tipe file yang akan diupload
		$tmp_file = $_FILES['file']['tmp_name'];
		$tipe_file="application/vnd.ms-excel";     
		move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);
		// Load librari PHPExcel nya
		require_once "../assets/plugins/PHPExcel-1.8/classes/PHPExcel.php"; 
		require_once "../assets/plugins/PHPExcel-1.8/classes/PHPExcel/IOFactory.php"; 
		
		$excelreader = PHPExcel_IOFactory::load('tmp/'.$nama_file_baru);
		?>
		<!-- <table border="1"> -->
			
		<?php
		$deletePasien = $pdo->prepare("DELETE FROM pasien");
		$deletePasien->execute();
		foreach ($excelreader->getWorksheetIterator() as $worksheet){
			$worksheetTitle = $worksheet->getTitle();
			$highestRow = $worksheet->getHighestRow();
			$highestColumn = $worksheet->getHighestColumn();
			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

			$nrColumns = ord($highestColumn) - 64;

			for ($row= 2; $row <= $highestRow; $row++){
				$val= array();
				// echo "<tr>";
				
				for($col=0; $col< $highestColumnIndex; ++ $col){
					$cell = $worksheet->getCellByColumnAndRow($col, $row);
					$val[] = $cell->getValue();
				}
				// echo "<td>$val[0]</td>";
				// echo "<td>$val[1]</td>";
				// echo "<td>$val[2]</td>";
				// echo "<td>$val[3]</td>";
				// echo "<td>$val[4]</td>";
				// echo "<td>$val[5]</td>";
				// echo "<td>$val[6]</td>";
				// echo "</tr>";
				$sql = $pdo->prepare("INSERT INTO pasien VALUES(
			            :pasien_id, 
			            :pasien_nama,
			            :pasien_tglLahir,
			            :pasien_umur,
			            :pasien_alamat,
			            :pasien_jk,
			            :pasien_telp,
			            :pasien_ortu)");
					$sql->bindParam(':pasien_id', $val[0]);
					$sql->bindParam(':pasien_nama', $val[1]);
					$sql->bindParam(':pasien_tglLahir', $val[2]);
					$sql->bindParam(':pasien_umur', $val[3]);
					$sql->bindParam(':pasien_alamat', $val[4]);
					$sql->bindParam(':pasien_jk', $val[5]);
					$sql->bindParam(':pasien_telp', $val[6]);
					$sql->bindParam(':pasien_ortu', $val[7]);
					$sql->execute(); // Eksekusi query insert
			}
		}
	// echo "</table>";
		
	}
else {
	echo "gagal";
}



header('location: data-pasien'); // Redirect ke halaman awal
?>
