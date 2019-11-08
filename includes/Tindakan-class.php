<?php

class Tindakan{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    public function showTindakan (){
        $result  = $this->pdo->query("SELECT * FROM tindakan");
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
    }
    public function editTindakan ($tindakan_id){
        $result  = $this->pdo->query("SELECT * FROM tindakan WHERE tindakan_id ='$tindakan_id'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
}