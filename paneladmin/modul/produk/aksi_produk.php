<?php

session_start();
// error_reporting(0);

error_reporting(E_ALL);
ini_set('display_errors', 1);

 if (empty($_SESSION['username']) AND empty($_SESSION['password'])) {

   echo"<center>Untuk akses halaman ini Anda harus login dulu ya</center> <br>";
   echo"<center><a href=../../index.php>Silahkan login</center>";

 }else{
  include "../../../config/koneksi.php";
 	include "../../../config/kompres.php";

 	$p=$_GET['p'];
 	$act=$_GET['aksi'];

 	if ($act == 'hapus') {
 		mysqli_query($con,"DELETE FROM barang WHERE kd_barang='$_GET[id]'");
		unlink("foto_produk/".$gambar_produk);
 		header('location:../../media.php?p=produk');
 	}else if ($act == 'tambah') {
		 	
 		// Baca lokasi file sementara dan nama file dari form (fuplod)
		$lokasi_file = $_FILES['file']['tmp_name'];
		$nama_file = $_FILES['file']['name'];
		$acak = rand(1, 99);
		$nama_file_unik = $acak . $nama_file;

		// Tanggal sekarang
		$tgl_upload = date("Ymd");

		if (!empty($lokasi_file)) {
			if (UploadImage($nama_file_unik)) {
				// Simpan data ke dalam database
				$stmt = $con->prepare("INSERT INTO barang (nama, id_kategori, deskripsi, jumlah_barang, tanggal_masuk, harga_jual, foto) VALUES (?, ?, ?, ?, ?, ?, ?)");
				$stmt->bind_param("sisiss", $_POST['nama'], $_POST['kategori'], $_POST['deskripsi'], $_POST['jumlah'], $_POST['tanggal_masuk'], $_POST['harga_jual'], $nama_file_unik);
				$stmt->execute();
		
				header('location:../../media.php?p=produk');
			} else {
				echo "Gagal mengupload file gambar";
			}
		} else {
			$stmt = $con->prepare("INSERT INTO barang (nama, id_kategori, deskripsi, jumlah_barang, tanggal_masuk, harga_jual) VALUES (?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("sisiss", $_POST['nama'], $_POST['kategori'], $_POST['deskripsi'], $_POST['jumlah'], $_POST['tanggal_masuk'], $_POST['harga_jual']);
			$stmt->execute();
		
			header('location:../../media.php?p=produk');
		}

		// if (!empty($lokasi_file)) {
		// 	if (UploadImage($nama_file_unik )) {
		// 		// $sql=mysqli_query($con, "INSERT INTO barang ( nama, id_kategori, deskripsi, jumlah_barang, tanggal_masuk, harga_jual,  foto) values('$_POST[nama]','$_POST[kategori]','$_POST[deskripsi]','$_POST[jumlah]','$_POST[tanggal_masuk]','$_POST[harga_jual]','$nama_file_unik ')"); 
		// 		$con -> query("INSERT INTO barang (nama, id_kategori, deskripsi, jumlah_barang, tanggal_masuk, harga_jual,  foto) VALUES('$_POST[nama]','$_POST[kategori]','$_POST[deskripsi]','$_POST[jumlah]','$_POST[tanggal_masuk]','$_POST[harga_jual]','$nama_file_unik ')");
		// 		header('location:../../media.php?p=produk');
		// 	} else {
		// 		echo "Gagal mengupload file gambar";
		// 	}
		// } else {
		// 	$sql=mysqli_query($con, "INSERT INTO barang (nama, id_kategori, deskripsi, jumlah_barang, tanggal_masuk, harga_jual) VALUES('$_POST[nama]','$_POST[kategori]','$_POST[deskripsi]','$_POST[jumlah]','$_POST[tanggal_masuk]','$_POST[harga_jual]')"); 
		// 	header('location:../../media.php?p=produk');
		// }
		
 		}else if ($act == 'update') {
 		//Baca lokasi  file sementara dan nama file dari form (fuplod)
			$lokasi_file = $_FILES['file']['tmp_name'];
			$nama_file 	 = $_FILES['file']['name'];
			$acak        = rand(1,99);
			$nama_file_unik = $acak.$nama_file;

 		//tanggal sekarang	
 			$tgl_upload = date("Ymd");
 		//Apabila gambar tidak di ganti
 			
 			if (empty($lokasi_file)) {
 				
 				$sql=mysqli_query($con, "UPDATE barang set  nama ='$_POST[nama]' , id_kategori ='$_POST[kategori]', deskripsi ='$_POST[deskripsi]' , jumlah_barang ='$_POST[jumlah]', tanggal_masuk ='$_POST[tanggal_masuk]' , harga_jual ='$_POST[harga_jual]',  foto ='$nama_file_unik' where kd_barang ='$_POST[kode]'");
 				header('location:../../media.php?p=produk');
 			} else {
				UploadImage($nama_file_unik);
 				$sql=mysqli_query($con, "UPDATE barang set  nama ='$_POST[nama]' , id_kategori ='$_POST[kategori]', deskripsi ='$_POST[deskripsi]' , jumlah_barang ='$_POST[jumlah]', tanggal_masuk ='$_POST[tanggal_masuk]' , harga_jual ='$_POST[harga_jual]',  foto ='$nama_file_unik' where kd_barang ='$_POST[kode]'");
 				header('location:../../media.php?p=produk');
 			}
 		}
 	}

?>