<?php

class Pasien{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    public function addPasien($no, $nama, $tgllahir, $umur, $alamat, $jk, $telp, $ortu) {
        $result = $this->pdo->prepare("INSERT INTO pasien (
            pasien_id,
            pasien_nama,
            pasien_tglLahir,
            pasien_umur,
            pasien_alamat,
            pasien_jk,
            pasien_telp,
            pasien_ortu)
            VALUES(
            :pasien_id,
            :pasien_nama,
            :pasien_tglLahir,
            :pasien_umur,
            :pasien_alamat,
            :pasien_jk,
            :pasien_telp,
            :pasien_ortu)");        
        $result->bindParam(':pasien_id',$no);
        $result->bindParam(':pasien_nama',$nama);
        $result->bindParam(':pasien_tglLahir',$tgllahir);
        $result->bindParam(':pasien_umur',$umur);
        $result->bindParam(':pasien_alamat',$alamat);
        $result->bindParam(':pasien_jk',$jk);
        $result->bindParam(':pasien_telp',$telp);
        $result->bindParam(':pasien_ortu',$ortu);
        $result->execute();
    }
    public function detailPasien ($pasienID){
        $result = $this->pdo->query("SELECT * FROM pasien WHERE pasien_id='$pasienID'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function showPasien (){
        $result  = $this->pdo->query("SELECT * FROM pasien");
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
    }
    public function editPasien ($pasienID){
        $result = $this->pdo->query("SELECT * FROM pasien WHERE pasien_id='$pasienID'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function deletePasien($pasienID, $nama_foto) {
        $cek_foto_query = $this->pdo->query("SELECT * FROM pasien p, foto f WHERE p.pasien_id='$pasienID' AND p.pasien_id = f.pasien_id");
        if ($cek_foto_query->rowCount() > 0 ) {
            $cek_foto = $cek_foto_query->fetch(PDO::FETCH_OBJ);
            $nama_foto = $cek_foto->foto_nama;
            $array_foto = array($nama_foto);
            for ($i=0; $i<=$cek_foto_query->rowCount(); $i++ ) {
                unlink($_SERVER['DOCUMENT_ROOT'].'/vozz/assets/images/pasien/'.$array_foto[$i]);
                unlink($_SERVER['DOCUMENT_ROOT'].'/vozz/assets/images/_thumbs/'.$array_foto[$i]);
                $i += 1;
                // echo $data;
            }
            // $delFoto = $this->pdo->prepare("DELETE FROM foto WHERE pasien_id='$pasienID'");
            // $delFoto->execute();
        }

        // $result = $this->pdo->prepare("DELETE FROM pasien WHERE pasien_id = ?");
        // $result->bindParam(1, $pasienID);
        // $result->execute();
    }
    public function updatePasien($no, $nama, $tgllahir, $umur, $alamat, $jk, $telp, $ortu) {
        $result = $this->pdo->prepare("UPDATE pasien SET  
            pasien_id        =:pasien_id, 
            pasien_nama      =:pasien_nama,
            pasien_tglLahir  =:pasien_tglLahir,
            pasien_umur      =:pasien_umur,
            pasien_alamat    =:pasien_alamat,
            pasien_jk      =:pasien_jk,
            pasien_telp      =:pasien_telp,
            pasien_ortu      =:pasien_ortu
            WHERE pasien_id  =:pasien_id"); 
        $result->bindParam(':pasien_id', $no);
        $result->bindParam(':pasien_nama', $nama);
        $result->bindParam(':pasien_tglLahir', $tgllahir);
        $result->bindParam(':pasien_umur', $umur);
        $result->bindParam(':pasien_alamat', $alamat);
        $result->bindParam(':pasien_jk', $jk);
        $result->bindParam(':pasien_telp', $telp);
        $result->bindParam(':pasien_ortu', $ortu);
        
        if($result->execute()){
            return true;
        } else {return false;}
    }
    public function checkName($nama) {
        $result = $this->pdo->query("SELECT * FROM pasien WHERE pasien_nama = '$nama'");
        if($result->rowCount() < 1){
            $alert = 0;
            return $alert;
        }
        else {
            $alert = 1;
            return $alert;
        }
    }
    
}