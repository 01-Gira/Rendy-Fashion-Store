<?php
include "../config/koneksi.php";

//mencegah terjadinya sql injektion
function anti_injection($data){
    $filter=mysql_real_escape_string(stripcslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
    return $filter;
}

$username=$_POST['username'];
$password=$_POST['password'];

$login=mysqli_query($con, " Select * from user where username='$username' and password='$password'");
$ketemu=mysqli_num_rows($login);
$r=mysqli_fetch_array($login);

//Apabila username dan password ditemukan
if($ketemu >0){ 
    session_start();
    $_SESSION[username]=$r[username];
    $_SESSION[namalengkap]=$r[nama_lengkap];
    $_SESSION[passuser]=$r[password];
    $id_lama =session_id();
    session_regenerate_id();
    $sid_baru=session_id();
    echo "<script>alert('Selamat Datang $_SESSION[namalengkap]');
    window.location.replace('media.php')</script>"; 
} 
else {
        echo"<script>alert('login gagal username dan password anda SALAH '); 
        window.location.replace('index.php')</script>";
}

?>