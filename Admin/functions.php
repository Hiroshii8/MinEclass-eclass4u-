<?php
include('connection.php');
$con = getdb();

	// import data mahasiswa
   if(isset($_POST["Import-mah"])){		
		echo $filename=$_FILES["file"]["tmp_name"];	

		 if($_FILES["file"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
	           $sql = "INSERT into tbmahasiswa (NIM,nama_mhs) values ('".$getData[0]."','".$getData[1]."')";
	           $result = mysqli_query($con, $sql);
			    // var_dump(mysqli_error_list($con));
			    // exit();
				if(!isset($result))
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"skripsi.php\"
						  </script>";		
				}
				else {
					  echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"skripsi.php\"
					</script>";
				}
	         }
			
	         fclose($file);	
		 }
	}	 
	// import data dosen
	if(isset($_POST["Import-dos"])){		
		echo $filename=$_FILES["file"]["tmp_name"];	

		 if($_FILES["file"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
	           $sql = "INSERT into tbdosen (NIK,nama_dsn) values ('".$getData[0]."','".$getData[1]."')";
	           $result = mysqli_query($con, $sql);
			    // var_dump(mysqli_error_list($con));
			    // exit();
				if(!isset($result))
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"skripsi.php\"
						  </script>";		
				}
				else {
					  echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"skripsi.php\"
					</script>";
				}
	         }
			
	         fclose($file);	
		 }
	}
	
	/*
		Export Data CSV
	*/
	
	//Export Dosen
	if(isset($_POST["exp-dosen"]))
	{
		 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data-dosen.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('NIK','NAMA'));  
      $query = "SELECT * from tbdosen";  
      $result = mysqli_query($con, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
	}
	
	//Export Mahasiswa
	if(isset($_POST["exp-mah"]))
	{
		 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data-mahasiswa.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('NIM', 'NAMA', 'KODE JURUSAN', 'JURUSAN'));  
      $query = "select a.NIM, a.nama_mhs, b.kode_jurusan, b.jurusan from tbmahasiswa a
				join tbjurusan b 
				WHERE a.kode_jurusan = b.kode_jurusan";
      $result = mysqli_query($con, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
	}
	//Export Skripsi
	
	if(isset($_POST["exp-skripsi"]))
	{
		 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data-skripsi.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('KODE BUKU', 'NIM', 'NAMA_MAHASISWA', 'JURUSAN', 'JUDUL SKRIPSI', 'PEMBIMBING 1', 'PEMBIMBING 2', 'TAHUN LULUS', 'RAK', 'CD'));  
      $query = "SELECT kode_buku, nim_mah as NIM, a.nama_mhs as nama_mahasiswa, d.jurusan, judul_skripsi, b.nama_dsn AS pembimbing_1, c.nama_dsn AS pembimbing_2, 
	  CONCAT(MONTHNAME(tahun_lulus),' ',YEAR(tahun_lulus)) AS grad, 
	cd, rak from tbdataskripsi
	left join tbmahasiswa a
	ON tbdataskripsi.nim_mah = a.nim
	left join tbdosen b
	on tbdataskripsi.pem1 = b.NIK
	left join tbdosen c
	on tbdataskripsi.pem2 = c.NIK
    left join tbjurusan d
    on a.kode_jurusan = d.kode_jurusan
	ORDER BY a.kode_jurusan ASC, grad DESC";  
      $result = mysqli_query($con, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
	}	
?>