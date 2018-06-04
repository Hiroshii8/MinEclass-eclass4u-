<?php  
    session_start();
    if (!isset($_SESSION["LoggedIn"]) && !isset($_SESSION["UserId"])) {
        header("Location: ../login.php");
        exit();
    }
    if($_SESSION['role']!="1") {
         session_destroy();
        header("Location: ../login.php");
        exit();
    }
    require_once("Databases/Connection_Admin.php");
    require_once("Databases/Admin.php");

    if(isset($_POST['submit']))
    {
        // Simpan data yang di inputkan ke POST ke masing-masing variable
        // dan convert semua tag HTML yang mungkin dimasukkan untuk mengindari XSS
        $db = new Admin();
        $nik = $_GET["NIK"];
        $nama = $_POST["nama"];
        $email = $_POST["email"];
        $pass = $_POST["password"];

        $result = $db->updateDosen($nik, $nama, $email, $pass);        
        if($result) {
            echo "<script type=\"text/javascript\">
                            alert(\"Data Edited. Redirected to dosen page.\");
                            window.location = \"dosen-page.php\"
                        </script>";
        } else {
            echo "<script type=\"text/javascript\">
                            alert(\"Failed to edit. Redirected to dosen page.\");
                            window.location = \"dosen-page.php\"
                        </script>";
        }
    }

    if(!isset($_GET['NIK'])){
        die("Error: ID Tidak Dimasukkan");
    }
	else {
        //Ambil data
        $nik = $_GET['NIK'];
        $db = new Admin();
        $result = $db->selectByNik($nik);
        if($result[0]) {
            $data = $result[1];
        } else {
            die($result[1]);
        } 
	}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<style>
   table {border-collapse:collapse; table-layout:fixed; width:1200px;}
	table td {width:100px; word-wrap:break-word; word-wrap:hidden;}
   </style>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Skripsi Page</title>
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
                        <h2>Edit Page</h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                
				<!-- div class col-md-4 itu bisa diatur untuk panjang lebar-->
                <hr />
				<form method="post">
					<div class="form-group">
						<label>NIK 	: </label>
						<?php echo $data['nik'];?>
					</div>
					<br>
					<div class="form-group">
						<label>Nama	Dosen	  	: </label>
						<input required type="text" class="form-control"  
                        style="width:300px" value="<?php echo $data['nama']?>" name="nama" placeholder="Nama Dosen"/>
					</div>
					<br>
                    <div class="form-group">
                        <label>Email Dosen       : </label>
                        <input required type="text" class="form-control"  
                        style="width:300px" value="<?php echo $data['email']?>" name="email" placeholder="Email Dosen"/>
                    </div>
                    <div class="form-group">
                        <label>Password       : </label>
                        <input required type="text" class="form-control"  
                        style="width:300px" value="<?php echo $data['password']?>" name="password" placeholder="password"/>
                    </div>
                    <br>
                    <br>
            <input type="submit" name="submit" value="submit" />
        </form>
                <!-- /. ROW  -->
                <hr />
			</div>
		</div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <!-- BOOTSTRAP DATEPICKER -->
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
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
