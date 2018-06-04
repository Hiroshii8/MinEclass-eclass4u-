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
    if(isset($_POST['submit']))
    {
                require_once("Databases/Connection_Admin.php");
                require_once("Databases/Admin.php");
                
                $db = new Admin();

                $nik = $_POST['nik'];
                $nama_dsn  = $_POST['nama'];
                $pass = $_POST['password'];
                $email_dsn = $_POST['email']; 
                $check = $db->selectByNik($nik);
                if(!$check[0]) {
                    $result = $db->addDosen($nik, $nama_dsn, $email_dsn, $pass);
                    if($result) {
                        echo "<script type=\"text/javascript\">
                                alert(\"NEW DATA INSERTED. REDIRECTED TO Dosen Page.\");
                                window.location = \"dosen-page.php\"
                            </script>";
                    } else {
                        echo "<script type=\"text/javascript\">
                                alert(\"FAILED TO INSERT NEW DATA\");
                            </script>";
                    }
                }
                else {
                    echo "<script type=\"text/javascript\">
                                alert(\"Data already exist\");
                            </script>";
                }
    }
?>

<html>
<head>
    <style>
   table {border-collapse:collapse; table-layout:fixed; width:1200px;}
    table td {width:100px; word-wrap:break-word; word-wrap:hidden;}
   </style>
    <title>Add New Dosen</title>
    
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
                        <h2>Dosen Page</h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                
                <!-- div class col-md-4 itu bisa diatur untuk panjang lebar-->
                <hr />
                <form method="post">
                    <div class="form-group">
                        <label>NIK          : </label>
                        <input required type="text" class="form-control"  style="width:150px" name="nik" autocomplete="on" placeholder="NIK"/>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Nama Dosen       : </label>
                        <input required type="text" class="form-control"  style="width:250px" name="nama" autocomplete="on" placeholder="Nama Mahasiswa"/>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Password     : </label>
                        <input required type="text" class="form-control"  style="width:250px" name="password" autocomplete="on" placeholder="Password"/>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Email Dosen      : </label>
                        <input required type="text" class="form-control"  style="width:250px" name="email" autocomplete="on" placeholder="Email Dosen"/>
                    </div>
                    <br>
            <input type="submit" name="submit" value="Add Dosen Account" />
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