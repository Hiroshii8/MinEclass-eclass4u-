<?php 

function upload() {

 	$namaFile = $_FILES['file']['name'];
 	$error = $_FILES['file']['error'];
 	$tmpName = $_FILES['file']['tmp_name'];

 	if ($error === 4) {
 		echo "<script>
 			alert('Pilih file terlebih dahulu')</script>";

 			return false;
 	}
 	
 	//cek apakah yang diupload adalah gambar
 	$ekstensiFileValid = ['pdf','doc','xls'];
 	$ekstensiFile = explode('.', $namaFile); //("huruf apa yg di tandai lalu pecah", "string yang mau di pecah")
 	$ekstensiFile = strtolower(end($ekstensiFile));

 	if (!in_array($ekstensiFile, $ekstensiFileValid)) {
 		echo "<script>
 			alert('Yang diupload bukan pdf/doc/xls')
 			</script>";

 			return false;
 		}

 	//lolos pengecekan, gambar siap di upload
 	move_uploaded_file($tmpName, 'files/dosen/'.$namaFile);

 	return $namaFile;

 }

 ?>