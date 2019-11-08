<?php

class Foto{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    public function viewFoto($pasien_id) {
        $result = $this->pdo->query("SELECT * FROM foto f, pasien p WHERE f.pasien_id = p.pasien_id AND f.pasien_id='$pasien_id'");
        if($result->rowCount() < 1){
            $alert = 0;
            return $alert;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[]=$rows;
            return $data;
        }
    }
    public function addFoto($foto_nama, $pasien_id) {
        $result = $this->pdo->prepare("INSERT INTO foto(
                        foto_nama, pasien_id) VALUES (?,?)");
        $result->bindParam(1, $foto_nama);
        $result->bindParam(2, $pasien_id);
        if($result->execute()) {
            return "success";
        }
        else {
            return "failed";
        }
    }
    public function updateFoto($foto_desc, $foto_id) {
        $result = $this->pdo->prepare("UPDATE foto SET
                        foto_desc =:foto_desc
                        WHERE foto_id =:foto_id");

        $result->bindParam(':foto_desc', $foto_desc);
        $result->bindParam(':foto_id', $foto_id);

        if($result->execute()){
            return true;
        } else {return false;}
    }
    public function deleteFoto($foto_id){
        $cek_foto_query = $this->pdo->query("SELECT * FROM foto WHERE foto_id ='$foto_id'");
        $cek_foto = $cek_foto_query->fetch(PDO::FETCH_OBJ);
        $nama_foto = $cek_foto->foto_nama;
        unlink($_SERVER['DOCUMENT_ROOT'].'/vozz/assets/images/pasien/'.$nama_foto);
        unlink($_SERVER['DOCUMENT_ROOT'].'/vozz/assets/images/_thumbs/'.$nama_foto);

        $result = $this->pdo->prepare("DELETE FROM foto WHERE foto_id=?");
        $result->bindParam(1, $foto_id);
        if($result->execute()){
            return true;
        } else {return false;}
    }
}