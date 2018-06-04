<?php  
	session_start();
    if (!isset($_SESSION["LoggedIn"]) && !isset($_SESSION["UserId"])) {
        header("Location: ../login.php");
        exit();
    }
    
    require_once("Databases/Connection_Admin.php");
	require_once("Databases/Admin.php");
	require_once("Databases/Ruang.php");
    
	//data dosen -> berdasarkan NIK
	if(isset($_GET["NIK"]))
	{
		try {
		$db = new Admin();
		$nik = $_GET["NIK"];
		$result = $db->removeDosen($nik);
			if($result){
				echo "<script type=\"text/javascript\">
								alert(\"Data successfully deleted.\");
								window.location = \"dosen-page.php\"
							  </script>";
			} else {
				echo "<script type=\"text/javascript\">
								alert(\"Operation Failed.\");
								window.location = \"dosen-page.php\"
							</script>";
			}

		}
		catch(Exception $e){
			echo "<script type=\"text/javascript\">
								alert(\"Operation Failed.\");
								window.location = \"dosen-page.php\"
							</script>";
		}
	}
	//data mahasiswa -> berdasarkan NIM
	if(isset($_GET["NIM"]))
	{
		try {
		$db = new Admin();
		$nim = $_GET["NIM"];
		$result = $db->removeMahasiswa($nim);
			if($result){
				echo "<script type=\"text/javascript\">
								alert(\"Data successfully deleted.\");
								window.location = \"mahasiswa-page.php\"
							  </script>";
			} else {
				echo "<script type=\"text/javascript\">
								alert(\"Operation Failed.\");
								window.location = \"mahasiswa-page.php\"
							</script>";
			}
		}
		catch(Exception $e){
			echo "<script type=\"text/javascript\">
								alert(\"Operation Failed.\");
								window.location = \"mahasiswa-page.php\"
							</script>";
		}
	}

	if(isset($_GET['id_ruang'])) {
		try {
		$db = new Ruang();
		$id_ruang = $_GET['id_ruang'];
		$result = $db->removeRuang($id_ruang);
			if($result){
				echo "<script type=\"text/javascript\">
								alert(\"Data successfully deleted.\");
								window.location = \"Ruangkelas.php\"
							  </script>";
			} else {
				echo "<script type=\"text/javascript\">
								alert(\"Operation Failed.\");
								window.location = \"Ruangkelas.php\"
							</script>";
			}
		}
		catch(Exception $e){
			echo "<script type=\"text/javascript\">
								alert(\"Operation Failed.\");
								window.location = \"Ruangkelas.php\"
							</script>";
		}	
	}
?>