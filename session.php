<?php
    require 'config/koneksi.php';
    require 'login.php';



    if(empty($_SESSION["email"])){
        $_SESSION["status"] = "Belum Login";
        
    }
    else {
        $_SESSION["status"] = "Login";
        $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
    }

?>