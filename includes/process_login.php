<?php 
ini_set('display_errors', 1);
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
include_once dirname(__FILE__) . '/db_connect.php';
include_once '../assets/plugins/Crypt.php';


$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE user_nama='$username' LIMIT 1";
$login    = $mysqli->query($query);
$cekLogin= $login->fetch_array();
$cekPassword = $cekLogin['user_password'];
$id          = $cekLogin['user_id'];
$status      = $cekLogin['user_status'];
$cek      = mysqli_num_rows($login);
 
if($cek > 0){
    // echo $test;
    $crypt = new Crypt;
    $crypt->setKey('pL,mKoiJnbHuyGvcFtrDxzSewAq');
    $crypt->setData($cekPassword);
    $decrypted = $crypt->decrypt();
    if ($decrypted == $password){
        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['login'] = "login";
        $_SESSION['status'] = $status;

        switch ($status){
            case 'admin': echo "admin"; break;
            case 'operator' : echo "operator"; break;
            default: echo "wrong-password";
        }
    }
    else {
        echo "Failed";
    }
}
else {
    echo "wrong-password";
}
 
?>