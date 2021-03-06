<?php
    session_start();
    if (!isset($_SESSION["LoggedIn"]) && !isset($_SESSION["UserId"])) {
        header("Location: login.php");
        exit();
    }
    
    require_once ("Databases/Database.php");
    require_once ("Databases/Users.php");
    require_once ("Databases/Courses.php");
    require_once ("Databases/Forum.php");

    if(!isset($_GET['idn'])) 
      die("Error: ID Kelas tidak ditemukan");
    else {
       $id_n = $_GET['idn'];
       $db_f = new Forum();
       $res_f = $db_f->RetriveSingleNewsForus($id_n);
    }
    if($_POST) {
    	try {
	    	$id_news = $_GET['idn'];
	    	$message = $_POST['message'];
	    	$db_f = new Forum();
	    	$res_f = $db_f->UpdateNewsForum($id_news, $message);
	   		if($res_f) {
                echo "<script type=\"text/javascript\">
                                alert(\"".'Success editing Reply'."\");
                                window.location = \"news_forum.php?id=".$_SESSION['news_forum']."\"
                            </script>";
	   		} else {
	   			echo "<script type=\"text/javascript\">
                                alert(\"Failed editing Reply.\");
                                window.location = \"news_forum.php?id=".$_SESSION['news_forum']."\"
                            </script>";	
	   		}
	   	}  catch(Exception $e){
            echo "<script type=\"text/javascript\">
                                alert(\"Failed editing Reply.\");
                                window.location = \"news_forum.php?id=".$_SESSION['news_forum']."\"
                            </script>";
        } 
    }
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
      <h1>News Forum</h1>
        <p><img src="images/templatemo_line.jpg" alt="templatemo.com" width="100%" height="2" /></p>
        <div class="templatemo_wedo">
          <form method="post">
            <p><h1>Edit Message</h1></p>
	          <p><textarea class="text" cols="86" rows ="20" name="message">
              <?php 
                echo $res_f['message'];
              ?> 
            </textarea></p>
	          <p><input type="submit" name="submit"></p>
          </form>
        </div>
        <p><img src="images/templatemo_line.jpg" alt="templatemo.com" width="100%" height="2" /></p>
    </div>
</div>
  
  <div id="templatemo_footer">Copyright &copy; 2018 By Ninuninuninu~<!-- Credit: www.templatemo.com --></div>
</div>
<!-- templatemo 027 classic -->
<!-- 
Classic Template 
http://www.templatemo.com/preview/templatemo_027_classic 
-->
</body>
</html>
