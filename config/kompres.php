<?php 
// uplod gambar untuk produk 
function UploadImage($fupload_name){
	//direktori gambar
	$vdir_upload ="../../../foto_produk/";
	$vfile_upload = $vdir_upload . $fupload_name;

	//simpan gambar dalam ukuran sebenarnya 
	move_uploaded_file($_FILES["file"] ["tmp_name"], $vfile_upload);

	//identitas files asli
	$im_src = imagecreatefromjpeg($vfile_upload);
	$src_width = imagesx($im_src);
	$src_height = imagesy($im_src);

	//simpan dalam versi small 110 pixel
	//set ukuran gambar hasil perubahan
	$dst_width = 110;
	$dst_height = ($dst_width/$src_height)*$src_height;

	//proses perubahan ukuran 
	$im = imagecreatetruecolor($dst_width, $dst_height);
	imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

	//simpan gambar 
	imagejpeg($im,$vdir_upload . "small_" . $fupload_name);

	//simpan dalam versi medium  360 pixel
	//set ukuran gambar hasil perubahan
	$dst_width2 = 233;
	$dst_height2 = 288;

	//proses perubahan ukuran 
	$im2 = imagecreatetruecolor($dst_width2,$dst_height2);
	imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

	//simpan gambar 
	imagejpeg($im2,$vdir_upload . "medium_" . $fupload_name);

	//hapus gambar di memori komputer
	imagedestroy($im_src);
	imagedestroy($im);
	imagedestroy($im2);

}
?>