<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
// uplod gambar untuk produk 
function UploadImage($fupload_name){

	
	//direktori gambar
	$vdir_upload ="../../../foto_produk/";
	$vfile_upload = $vdir_upload . $fupload_name;

	//simpan gambar dalam ukuran sebenarnya 
	move_uploaded_file($_FILES["file"] ["tmp_name"], $vfile_upload);

	//identitas files asli
	$image_info = getimagesize($vfile_upload);
	$image_type = $image_info[2];

	switch($image_type) {
		case IMAGETYPE_JPEG:
			$im_src = imagecreatefromjpeg($vfile_upload);
			break;
		case IMAGETYPE_PNG:
			$im_src = imagecreatefrompng($vfile_upload);
			break;
		default:
			throw new Exception('Format gambar tidak didukung');
	}

	$src_width = imagesx($im_src);
	$src_height = imagesy($im_src);

	//simpan dalam versi small 110 pixel
	//set ukuran gambar hasil perubahan
	$dst_width = 110;
	$dst_height = intval(($dst_width/$src_height)*$src_height);

	//proses perubahan ukuran 
	$im = imagecreatetruecolor($dst_width, $dst_height);
	imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

	//simpan gambar 
	switch($image_type) {
		case IMAGETYPE_JPEG:
			imagejpeg($im,$vdir_upload . "small_" . $fupload_name);
			break;
		case IMAGETYPE_PNG:
			imagepng($im,$vdir_upload . "small_" . $fupload_name);
			break;
	}

	//simpan dalam versi medium  360 pixel
	//set ukuran gambar hasil perubahan
	$dst_width2 = 233;
	$dst_height2 = 288;

	//proses perubahan ukuran 
	$im2 = imagecreatetruecolor($dst_width2,$dst_height2);
	imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

	//simpan gambar 
	switch($image_type) {
		case IMAGETYPE_JPEG:
			imagejpeg($im2,$vdir_upload . "medium_" . $fupload_name);
			break;
		case IMAGETYPE_PNG:
			imagepng($im2,$vdir_upload . "medium_" . $fupload_name);
			break;
	}

	//hapus gambar di memori komputer
	imagedestroy($im_src);
	imagedestroy($im);
	imagedestroy($im2);

	// //direktori gambar
	// $vdir_upload ="../../../foto_produk/";
	// $vfile_upload = $vdir_upload . $fupload_name;

	// //simpan gambar dalam ukuran sebenarnya 
	// move_uploaded_file($_FILES["file"] ["tmp_name"], $vfile_upload);

	// //identitas files asli
	// $im_src = imagecreatefromjpeg($vfile_upload);
	// $src_width = imagesx($im_src);
	// $src_height = imagesy($im_src);

	// //simpan dalam versi small 110 pixel
	// //set ukuran gambar hasil perubahan
	// $dst_width = 110;
	// $dst_height = intval(($dst_width/$src_height)*$src_height);

	// //proses perubahan ukuran 
	// $im = imagecreatetruecolor($dst_width, $dst_height);
	// imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

	// //simpan gambar 
	// imagejpeg($im,$vdir_upload . "small_" . $fupload_name);

	// //simpan dalam versi medium  360 pixel
	// //set ukuran gambar hasil perubahan
	// $dst_width2 = 233;
	// $dst_height2 = 288;

	// //proses perubahan ukuran 
	// $im2 = imagecreatetruecolor($dst_width2,$dst_height2);
	// imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

	// //simpan gambar 
	// imagejpeg($im2,$vdir_upload . "medium_" . $fupload_name);

	// //hapus gambar di memori komputer
	// imagedestroy($im_src);
	// imagedestroy($im);
	// imagedestroy($im2);

}
?>