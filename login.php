<?php
    require 'config/koneksi.php';
    
    if (isset($_POST['login'])){
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $ambil = $con->query("SELECT * FROM pelanggan WHERE email_pelanggan = '$email' AND password_pelanggan = '$pass'");
        $akunyangcocok = $ambil->num_rows;
        if ($akunyangcocok){
            $akun = $ambil->fetch_assoc();
            echo "<script>alert('Berhasil Login!')
            window.location.replace('index.php');</script>";
            $_SESSION['pelanggan'] = $akun;
            $_SESSION['email'] = $email;
            $_SESSION['status'] = "Login";
            if (isset($_SESSION['keranjang']) OR !empty($_SESSION['keranjang'])) {
                echo "<meta http-equiv='refresh' content='1;url=checkout.php'>";
            }else{
                echo "<meta http-equiv='refresh' content='1;url=index.php'>";
            }
        }
        else {
            echo "<script>alert('Gagal Login! Cek Akun Anda')
            window.location.replace('index.php');</script>";
        }
    }
?>