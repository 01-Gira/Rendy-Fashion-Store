<?php
    require 'config/koneksi.php';
    session_start();
    if(empty($_SESSION["email"])){
        $_SESSION["status"] = "Belum Login";
    }
    else {
        $_SESSION["status"] = "Login";
    }
?>