<?php

 session_start();
 error_reporting(0);

 if (empty($_SESSION['username']) AND empty($_SESSION['password'])) {

   echo"<center>Untuk akses halaman ini Anda harus login dulu ya</center> <br>";
   echo"<center><a href=../../index.php>Silahkan login</center>";

 }else{
  include "../../../config/koneksi.php";
 

 	$p=$_GET['p'];
 	$act=$_GET['aksi'];

 	// if ($act=='hapus') {
 	// 	mysqli_query($con,"DELETE FROM kategori WHERE id_kategori='$_GET[id]'");
 	// 	header('location:../../media.php?p=kategori');
 	// }else if ($act=='tambah') {
 	
 	// 			// $sql=mysqli_query($con, "INSERT INTO kategori (nama_kategori)values('$_POST[nama_kategori]','$_POST[nama_kategori]')"); 
	// 			 $sql=mysqli_query($con, "INSERT INTO kategori (nama_kategori) values ('$_POST[nama_kategori]')");
	// 			 header('location:../../media.php?p=kategori');
 			
 	// 	}else if ($act=='update') {
 		
 				
 	// 			$sql=mysqli_query($con, "UPDATE kategori set  nama_kategori ='$_POST[nama_kategori]'where id_kategori ='$_POST[kode]'");
 	// 			header('location:../../media.php?p=kategori');
 			
 	// 	}

	 if ($act == 'hapus') {
		mysqli_query($con, "DELETE FROM kategori WHERE id_kategori='$_GET[id]'");
		header('location:../../media.php?p=kategori');
	  } else if ($act == 'tambah') {
		$nama_kategori = $_POST['nama_kategori'];
		$sql = mysqli_query($con, "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')");
		header('location:../../media.php?p=kategori');
	  } else if ($act == 'update') {
		$id_kategori = $_POST['id_kategori'];
		$nama_kategori = $_POST['nama_kategori'];
		mysqli_query($con, "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id_kategori='$id_kategori'");
		header('location:../../media.php?p=kategori');
	  }
	  
 	}


 ?>