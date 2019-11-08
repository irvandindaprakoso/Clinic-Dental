<?php

class Users{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    public function showSuperUser (){
        $result  = $this->pdo->query("SELECT * FROM users WHERE user_status ='admin'");
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
    }
    public function showOperator (){
        $result  = $this->pdo->query("SELECT * FROM users WHERE user_status ='operator'");
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
    }
    public function editUser ($userID){
        $result = $this->pdo->query("SELECT * FROM users WHERE user_id='$userID'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function deleteUser($usersID) {
        $result = $this->pdo->prepare("DELETE FROM users WHERE user_id = ?");
        $result->bindParam(1, $usersID);
        $result->execute();
    }
    public function updateUser($username, $password, $email, $foto, $status, $usersID) {
        $result = $this->pdo->prepare("UPDATE users SET  
            user_nama      =:user_nama, 
            user_password  =:user_password,
            user_email     =:user_email,
            user_foto      =:user_foto,
            user_status      =:user_status
            WHERE user_id  =:user_id"); 
        $result->bindParam(':user_nama', $username);
        $result->bindParam(':user_password', $password);
        $result->bindParam(':user_email', $email);
        $result->bindParam(':user_foto', $foto);
        $result->bindParam(':user_status', $status);
        $result->bindParam(':user_id', $usersID);
        
        if($result->execute()){
            return true;
        } else {return false;}
    }
    public function checkName($username) {
        $result = $this->pdo->query("SELECT * FROM users WHERE user_nama = '$username'");
        if($result->rowCount() < 1){
            $alert = 0;
            return $alert;
        }
        else {
            $alert = 1;
            return $alert;
        }
    }
    public function addUser($username, $password, $email, $foto, $status) {
        $result = $this->pdo->prepare("INSERT INTO users (
            user_nama,
            user_password,
            user_email,
            user_foto,
            user_status)
            VALUES(
            :user_nama,
            :user_password,
            :user_email,
            :user_foto,
            :user_status)");        
        $result->bindParam(':user_nama',$username);
        $result->bindParam(':user_password',$password);
        $result->bindParam(':user_email',$email);
        $result->bindParam(':user_foto',$foto);
        $result->bindParam(':user_status',$status);
        $result->execute();
    }
}