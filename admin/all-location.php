<?php
      //Header File XML
      header("Content-type: text/xml");
       
     // Menghubungkan Koneksi dengan server MySQL 
     $mysql_hostname = "localhost";  //alamat server
     $mysql_user = "root";         //username untuk koneksi ke database
     $mysql_password = "";   //password koneksi ke database
     $mysql_database = "sipelapar";   //nama database yang akan diakses            

     $conn = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database) or die("Koneksi ke database gagal!");
      
     // Parsing Karakter-Karakter Khusus
     function parseToXML($htmlStr)
     {
          $xmlStr=str_replace('<','<',$htmlStr);
          $xmlStr=str_replace('>','>',$xmlStr);
          $xmlStr=str_replace('"','"',$xmlStr);
          $xmlStr=str_replace("'","'",$xmlStr);
          $xmlStr=str_replace("&",'&',$xmlStr);
          return $xmlStr;
     }
  
     // Memilih semua baris pada tabel 'markers'
     $date = $_GET['date'];
     $query = "SELECT * FROM pelanggar_parkir p, stnk s, foto f WHERE p.stnk_platnomor = s.stnk_platnomor AND p.pelanggar_id = f.pelanggar_id AND p.pelanggar_tgl_waktu = '$date'";

     // $tes = mysqli_num_rows(mysqli_query($conn,$query));
     // echo $tes;
     
      
      
      $result = mysqli_query($conn,$query);
     if (!$result) {
          die('Invalid query: ' . mysql_error());
          }
 
     // Parent node XML  
     echo '<markers>';
 
     // Iterasi baris, masing-masing menghasilkan node-node XML
     while ($row = mysqli_fetch_array($result)){
          // Menambahkan ke node dokumen XML
          echo '<marker ';
          echo 'name="' . parseToXML($row['stnk_pemilik']) . '" ';
          echo 'plate="' . parseToXML($row['stnk_platnomor']) . '" ';
          echo 'lat="' . $row['pelanggar_lat'] . '" ';
          echo 'lng="' . $row['pelanggar_lng'] . '" ';
          echo 'foto="' . parseToXML($row['foto_nama']) . '" ';
          echo 'category="pelanggar" ';
          echo '/>';
     }
 
     // Akhir File XML (tag penutup node)
     echo '</markers>';
 
?>