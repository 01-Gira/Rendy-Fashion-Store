<?php
include "../config/koneksi.php";

//mencegah terjadinya sql injektion
function anti_injection($data){
    global $con;
    $filter=mysqli_real_escape_string($con,stripcslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
    return $filter;
}

$username=anti_injection($_POST['username']);
$password=anti_injection($_POST['password']);

$login=mysqli_query($con, "SELECT * FROM user WHERE username = '$username' and password='$password'");
$ketemu=mysqli_num_rows($login);
$r=mysqli_fetch_array($login);

//Apabila username dan password ditemukan
if($ketemu >0){ 
    session_start();

    $_SESSION['username']=$r['username'];
    $_SESSION['namalengkap']=$r['nama_lengkap'];
    $_SESSION['passuser']=$r['password'];

    $id_lama =session_id();
    session_regenerate_id();
    $id_baru=session_id();

    echo "<script>alert('Selamat Datang $_SESSION[namalengkap]')
    window.location.replace('media.php?p=home')</script>";

}else {
        echo"<script>alert('Login Gagal Username dan Password Anda SALAH');
        window.location.replace('index.php')</script>";
}

?>
