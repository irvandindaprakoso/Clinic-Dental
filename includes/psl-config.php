<?php
/**
 * Menghubungkan Koneksi dengan server MySQL
 */  
define("HOST", "localhost");     // alamat server
define("USER", "root");    // username untuk koneksi ke database 
define("PASSWORD", "");    // Password koneksi ke database 
define("DATABASE", "vozz");    // nama database yang akan diakses
 
define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
 
define("SECURE", FALSE);    // FOR DEVELOPMENT ONLY!!!!
?>