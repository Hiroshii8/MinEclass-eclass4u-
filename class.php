<?php
    require_once ("Databases/Database.php");
    require_once ("Databases/Users.php");
    require_once ("Databases/Courses.php");
    require_once ("upload_file.php");
    require_once ('download_file.php');
    session_start();
    if (!isset($_SESSION["LoggedIn"]) && !isset($_SESSION["UserId"])) {
        header("Location: login.php");
        exit();
    }
    if(!isset($_GET['id'])) 
      die("Error: ID Kelas tidak ditemukan");

    else {
      $id_ruang = $_GET['id'];
      $db_c = new Courses();
      $res_c = $db_c->CourseBaseOnID($id_ruang);
    }

    $db_u = new Users();
    $res_u = $db_u->latest_news();
    $db_c = new Courses();
    if ($_POST) {
      $nomor = $_POST["pertemuan"];
      $upload = upload($nomor);
      if (!$upload) {
        }
      else{
        if ($db_c->upload_dosen($upload,$nomor, $id_ruang)) {
            header("Location: class.php?id=".$id_ruang);
            exit();
        }
      }
      }

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
        <li><a href="mycourse.php"  class="current">My Course</a></li>
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
      <h1>(<?php echo $res_c['kode_mk']; ?>) <?php echo $res_c['course'];?></h1>
      <p><img src="images/templatemo_line.jpg" alt="templatemo.com" width="100%" height="2" /></p>
      <h2>Forum</h2>
      <a href="news_forum.php?id=<?php echo $id_ruang ?>" text>
          <p><img src="news_icon.png" width="20" height="20">&nbsp &nbsp News Forum</p>
      </a>
      <br><br>
      <!--
      <div class="templatemo_wedo">
        <h2>Tugas MataKuliah</h2>
        <p><strong>#phptugas</strong></p>
      </div>
      <p><img src="images/templatemo_line.jpg" alt="templatemo.com" /></p>-->
      <div class="templatemo_content">
      <h2>Bahan Ajar</h2>
        <?php if ($_SESSION["role"] == 2) : ?>
          
        <form action='' method='post' enctype='multipart/form-data'>
            <ul>
              <li><label for="pertemuan">pertemuan</label>
                <select name="pertemuan" >
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="13">13</option>
                  <option value="14">14</option>
                </select>
                </li>
            <li><input type="file" name="file"> <button type="submit" name="submit">upload</button>
            </li>
          </ul>
        </form>

        <?php for ($i=1; $i < 15; $i++) : ?>
          
        <p><strong>Pertemuan ke-<?php echo $i; ?> </strong></p>
      <?php 
        $show = $db_c->select_upload($i, $_GET['id']);
        foreach ($show as $shows) {
          echo "<p><a href='files/dosen/" . $shows["realname"] ."' id='file'>" . $shows["realname"] . "</a></p>";
          echo "<br>";
        } ?>
      <?php endfor ?>
        <p>&nbsp</p>      
      <?php else: ?>

        <?php for ($i=1; $i < 15; $i++) : ?>
          
        <p><strong>Pertemuan ke-<?php echo $i; ?> </strong></p>
       <?php 
        $show = $db_c->select_upload($i, $_GET['id']);
        foreach ($show as $shows) {
          echo "<p><a href='files/dosen/" . $shows["realname"] ."' id='file'>" . $shows["realname"] . "</a></p>";
          echo "<br>";
        } ?>
      <?php endfor ?>
        <p>&nbsp</p>
        <?php endif ?>
      
      </div>
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
