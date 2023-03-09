<?php
	include 'config/koneksi.php';
	require 'config/session.php';
    session_destroy();
    echo "<script>alert('Berhasil Logout!')
    window.location.replace('index.php');</script>";
?> 