<?php
    session_start();
    if (!isset($_SESSION["LoggedIn"]) && !isset($_SESSION["UserId"])) {
        header("Location: login.php");
        exit();
    }
    
    require_once ("Databases/Database.php");
    require_once ("Databases/Users.php");
    require_once ("Databases/Courses.php");
    $db_u = new Users();
    $res_u = $db_u->latest_news();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Eclass-4u@UNTAR</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="loginstyle.css" rel="stylesheet" type="text/css" />
<link rel="icon" type="image/png" href="icon1.png">
<style type="text/css">
.style1 {
  font-size: 12px;
  font-weight: bold;
}
-->
</style>
</head>

<body>
<div id="templatemo_container">
<div id="templatemo_left_column"></div>
<div id="templatemo_menu_column">
    <div id="templatemo_left_title">
      ECLASS-4U<br />
      <span>Universitas Tarumanagara</span></div>
    <div class="templatemo_menu_list"><ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="mycourse.php" class="current">My Course</a></li>
        <li><a href="kontakadmin.php">Kontak Admin</a></li>
      </ul></div>
    <div id="templatemo_new">
      <p class="style1">LATEST NEWS &amp; EVENTS</p>
            <?php foreach ($res_u as $news) : ?>
      <p><span><b>Post Date: </b><br><?php echo $news["waktu"]; ?></span></p>
      <p><?php echo $news["isi"]; ?></p>
    <?php endforeach ?>
      </div>
    <div id="templatemo_contact"><span>QUICK CONTACT<br />
    </span>
    Pak Suryanto<br />
    Tel: 666-100-2000<br />
      Fax: 666-666-6666<br />
      Email: suryantohot@hotmail.com</div>
  </div>
<div id="templatemo_right_column">
    <div id="templatemo_right_header">
      <div class="templatemo_right_link">
        <form action="logout.php">
          <ul>
            <li><a><b><?php echo $_SESSION["Name"]; ?></b></a></li>
            <button type="submit"><b>LOG OUT</b></button>
          </ul>
        </form>
      </div>
      <div class="templatemo_right_slogan"><strong>.....Media Belajar Daring FTI UNTAR.....<br />
      </strong>
      Berlajar Bersama FTI UNTAR melalui Eclass-4u</div>
    </div>
    <div id="templatemo_content">
      <h1>Course Overview</h1>
        <p><img src="images/templatemo_line.jpg" alt="templatemo.com" width="430" height="2" /></p>
        <div class="templatemo_wedo">
          <br>
          <?php
              $db_c = new Courses();
              $username = $_SESSION['UserId'];
              if($_SESSION['role']=="2") {
                $result = $db_c->RC_Dosen($username);
                $count_element = count($result);
                $i = 0;
                  foreach ($result as $res) {
                      echo "<h2><a href=class.php?id=".$res["id_ruang"].">".$res["course"]."</a></h2><br>";
                      //echo "<h2>".$res["course"]."</h2><br>";
                      echo "<h3> Pengajar : ".$res["nama"]." </h3>";
                      if($i!=$count_element) 
                        echo "<br>";
                  }
              } else if ($_SESSION['role']=="3"){
                  $result = $db_c->RC_Mahasiswa($username);
                  $count_element = count($result);
                  $i = 0;
                  foreach ($result as $res) {
                      echo "<h2><a href=class.php?id=".$res["id_ruang"].">".$res["course"]."</a></h2><br>";
                      //echo "<h2>".$res["course"]."</h2><br>";
                      echo "<h3> Pengajar : ".$res["nama"]." </h3>";
                      if($i!=$count_element) 
                        echo "<br>";
                  }
              } 
          ?>
        </div>
        <p><img src="images/templatemo_line.jpg" alt="templatemo.com" width="430" height="2" /></p>
    </div>
</div>
  
  <div id="templatemo_footer">Copyright &copy; 2018 By Ninuninuninu~<!-- Credit: www.templatemo.com --></div>
</div>
</body>
</html>
