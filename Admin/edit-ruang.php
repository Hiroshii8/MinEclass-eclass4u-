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
    require_once("Databases/Ruang.php");
    
    if(isset($_POST['submit']))
	{
				$db = new Ruang();
				$id_ruang = $_GET['id_ruang'];
				$kode_mk = $_POST['kode_mk'];
				$nik   = $_POST['nik'];
				$kelas = $_POST['kelas'];
				$semester = $_POST['semester'];

				$result = $db->Update_Ruangkelas($id_ruang, $kode_mk, $nik, $kelas, $semester);
				if($result) {
					echo "<script type=\"text/javascript\">
								alert(\"Ruangan has been edited. Redirect to Ruangkelas Page.\");
								window.location = \"Ruangkelas.php\"
							</script>";
					
				}
				else {
					echo "<script type=\"text/javascript\">
								alert(\"Failed to edit Ruangan\");
							</script>";
				}
	}
	if(!isset($_GET['id_ruang'])){
        die("Error: Ruang Tidak Dimasukkan");
    }
	else {
        //Ambil data
        $id_r = $_GET['id_ruang'];
        $db = new Ruang();
        $result = $db->Get_Ruangkelas($id_r); 
	}
?>

<html>
<head>
	<style>
   table {border-collapse:collapse; table-layout:fixed; width:1200px;}
	table td {width:100px; word-wrap:break-word; word-wrap:hidden;}
   </style>
    <title>Edit Ruang Kelas</title>
	
	<!-- BOOTSTRAP DATEPICKER -->
	  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
                        <h2>Edit Ruang Kelas</h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                
				<!-- div class col-md-4 itu bisa diatur untuk panjang lebar-->
                <hr />
				<form method="post">
					<div class="form-group">
						<label>Mata Kuliah	: </label>
						<?php 
							  $db_r = new Ruang();
							  $data_matkul = $db_r->Retrive_matkul();
						?>
						<select required name="kode_mk" style="width:280px">
						<?php 
							foreach ($data_matkul as $dapet):
								if($result['kode_mk']==$dapet['kode_mk']){
									?>
									<option value="<?php echo $dapet['kode_mk']?>" selected>
										<?php echo $dapet['kode_mk']?> 
											&nbsp &nbsp &nbsp &nbsp - &nbsp &nbsp &nbsp &nbsp
										<?php echo $dapet['nama_mk'] ?>
									</option>;
									<?php
								} else {
									echo "<option value='".$dapet['kode_mk']."'>".$dapet['kode_mk']." &nbsp &nbsp &nbsp &nbsp - &nbsp &nbsp &nbsp &nbsp".$dapet['nama_mk']."</option>";	
								}
								
							endforeach;
						?>
						</select>
					</div>
					<br>
					<div class="form-group">
						<label>Dosen	: </label>
						<?php 
							  $db_a = new Admin();
							  $data_dosen = $db_a->selectAll_Dosen();
						?>
						<select required name="nik" style="width:150px">
						<?php 
							foreach ($data_dosen as $res):
								if($result['nik']==$res['nik']){
								?>
									<option value="<?php echo $res['nik']?>" selected><?php 
									echo $res['nama']?></option>";
								<?php
								} else {
									echo "<option value='".$res['nik']."' >".$res['nama']."</option>";
								}
							endforeach;
						?>
						</select>
					</div>
					<br>
					<div class="form-group">
						<label>Kelas	  	: </label>
						<input required type="text" class="form-control"  style="width:100px" name="kelas"
						 placeholder="kelas" value="<?php echo $result['kelas']?>" />
					</div>
					<br>
					<div class="form-group">
						<label>Semester	  	: </label>
						<input required type="text" class="form-control"  style="width:250px" name="semester"
						value="<?php echo $result['semester']?>" placeholder="semester"/>
					</div>
					<br>
            <input type="submit" name="submit" value="Edit Ruang Kelas" />
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