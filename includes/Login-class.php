<?php

class Login {
    private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewLogin() {
        $result = $this->pdo->query("SELECT * FROM users ");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
}