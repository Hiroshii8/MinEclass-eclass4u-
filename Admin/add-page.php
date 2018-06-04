<?php  
    include 'condb.php';

    if(isset($_POST['submit']))
	{
				$nim   = htmlentities($_POST['nim']);
				$nama  = htmlentities($_POST['nama']);
				$kode_jus  = htmlentities($_POST['kode_jur']);
				$que = $db->prepare("select NIM from tbmahasiswa where NIM=:nim");
			
				$que = $db->prepare("INSERT into tbmahasiswa SET 
				NIM=:nim, nama_mhs=:nama, kode_jurusan=:kode_jur");
				
				$que->bindParam(":nim",$nim);
				$que->bindParam(":nama",$nama);
				$que->bindParam(":kode_jur",$kode_jur);
				$que->execute();
				if($que->rowCount()==0)
				{
					echo "<script type=\"text/javascript\">
							alert(\"FAILED TO INSERT NEW DATA. REDIRECTED TO Mahasiswa Page.\");
							window.location = \"mahasiswa-page.php\"
						</script>";
				}
				else	
				{
					echo "<script type=\"text/javascript\">
							alert(\"NEW DATA INSERTED. REDIRECTED TO Mahasiswa Page.\");
							window.location = \"mahasiswa-page.php\"
						</script>";
				}
	}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<style>
   table {border-collapse:collapse; table-layout:fixed; width:1200px;}
	table td {width:100px; word-wrap:break-word; word-wrap:hidden;}
   </style>
    <title>Skripsi Page</title>
	
	<!-- BOOTSTRAP DATEPICKER -->
	  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $(function() {
    $('#datepicker').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
		dateFormat: "dd-mm-yy"
    });
});
  </script>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
	<!-- upload -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
</head>
<body>
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center user-image-back">
                        <img src="assets/img/FTI-UNTAR-LOGO.png" class="img-responsive" />
                    </li>
                    
                    <li>
                        <a href="index.php"><i class="fa fa-home "></i>Home</a>
                    </li>
                     <li>
                        <a href="#"><i class="fa fa-edit "></i>MENU<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="mahasiswa-page.php">Data Mahasiswa</a>
                            </li>
                            <li>
                                <a href="dosen-page.php">Data Dosen</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="Ruangkelas.php"><i class="fa fa-table "></i>Ruang kelas</a>
                    </li>
                    <li>
                        <a href="../logout.php"><i class="fa fa-sign-out"></i>Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Mahasiswa Page</h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                
				<!-- div class col-md-4 itu bisa diatur untuk panjang lebar-->
                <hr />
				<form method="post">

					<div class="form-group">
						<label>NIM		  	: </label>
						<input required type="text" class="form-control"  style="width:400px" name="nim" placeholder="NIM"/>
					</div>
					<br>
					<div class="form-group">
						<label>Nama Mahasiswa	  	: </label>
						<input required type="text" class="form-control"  style="width:400px" name="nama" placeholder="NIM"/>
					</div>
					<br>
					<div class="form-group">
						<label>Kode Jurusan	: </label>
						<?php $ambil_data = $db->prepare("SELECT * FROM tbjurusan");
							  $ambil_data->execute();
							  $data = $ambil_data->fetchAll(); 
						?>
						<select name="kode_jur">
						<?php 
							foreach ($data as $dapet):
								echo "<option value='".$dapet['kode_jurusan']."'>".$dapet['jurusan']." - ".$dapet['kunci']."</option>";
							endforeach;
						?>
						</select>
					</div>
					<br>
            <input type="submit" name="submit" value="Tambah Mahasiswa" />
        </form>
                <!-- /. ROW  -->
                <hr />
			</div>
		</div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>