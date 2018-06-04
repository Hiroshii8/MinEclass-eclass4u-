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

    $db = new Admin();
    $result = $db->selectAll_Dosen();
?>
<!DOCTYPE html>
<html>
<head>
    <style>
    table {border-collapse:collapse; table-layout:fixed; width:1200px;}
    table td {width:120px; word-wrap:break-word; word-wrap:hidden;}
   </style>
    <!-- table filter function -->
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    
    <script>
    $(document).ready(function () {

        (function ($) {
        
            $('#filter').keyup(function () 
            {
        
                var rex = new RegExp($(this).val(), 'i');
                $('.searchable tr').hide();
                $('.searchable tr').filter(function () {
                    return rex.test($(this).text());
                }).show();

            })

        }(jQuery));

    });
    </script>
    <!-- show data-->
    <script>
        $(document).ready(function() {
    $('#example').DataTable( {
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    } );
} );
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
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
                        <h2>Data Dosen</h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                
                <!-- div class col-md-4 itu bisa diatur untuk panjang lebar-->
                <!--<hr />-->
                <!--
                -->
                <hr />
                <!-- upload CSV -->
                <!--
                <div id="wrap">
        <div class="container">
            <div class="row">
                
                <form class="form-horizontal" action="functions.php" method="post" name="upload_excel" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="singlebutton">Export Data Mahasiswa</label>
                            <div class="col-md-4">
                                <input type="submit" name="exp-mah" class="btn btn-success" value="Export to CSV"/>
                            </div>
                  </div>                    
                </form> 
            </div>
        </div>
        </div>
            <hr />-->
            <!-- tr class list
                                    * success
                                    * info
                                    * warning
                                    * danger -->
               <form action="add-dosen.php">
                    <input  type="submit" style="float: right;" class="btn btn-primary" value="Add New Data" />
                    <!-- class="btn btn-success" -->
                    <br><br> 
                </form>
                <div class="input-group">
                    <span class="input-group-addon">Filter</span>
                    <input id="filter" type="text" margin="center" class="form-control" style="width:200px" placeholder="NIK / NAMA">
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered table-hover" width="450">
                                 <thead>
                                <tr>
                                  <th width="70">
                                        <center>No</center>
                                    </th>
                                    <th width="90">
                                        <center>NIK</center>
                                    </th>
                                    <th width="150">
                                        <center>NAMA</center>
                                    </th>
                                    <th width="70">
                                        <center>Edit</center>
                                    </th>
                                    <th width="70">
                                        <center>Delete</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="searchable">
                                <?php 
                                    $i=1;
                                foreach ($result as $value): 
                                    echo "<tr class='success'>";
                                    echo "<td align='center'>";
                                            echo $i;
                                    echo "</td>";
                                    echo "<td align='center'>";
                                            echo $value['nik'];
                                    echo "</td>";
                                    echo "<td align='center'>";
                                            echo $value['nama'];
                                    echo "</td>";
                                    echo "<td align='center'>"; ?>
                                    <a type="button" class="btn btn-primary btn-xs" data-title="Edit" href="edit-dos.php?NIK=<?php echo $value['nik']?>" >
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>
                                    </td>
                                    <td align="center">
                                    <a type="button" class="btn btn-danger btn-xs" data-title="Delete" href="delete.php?NIK=<?php echo $value['nik']?>" onclick="return confirm('Are you sure want to delete this data?')">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                    <!--class="btn btn-xs btn-info"-->
                                    <!--class="btn btn-xs btn-danger"--> 
                                    <?php echo "</td>";
                                    echo "</tr>";
                                    $i++;
                                endforeach; 
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
            </div>
            </div>
    <!-- /. WRAPPER  -->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
