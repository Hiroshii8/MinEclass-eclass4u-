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

    if(!isset($_GET['id'])) 
      die("Error: ID Kelas tidak ditemukan");
    else {
      $_SESSION['news_forum'] = $_GET['id'];
       $id_r = $_GET['id'];
        $db_f = new Forum();
        $result = $db_f->RetriveNewsForus($id_r);
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
          <?php 
            if ($_SESSION['role']=="2")  { ?>
              <p><center><input type='button' value='Tambahkan diskusi' 
                onclick="location.href='add_news_forum.php?id=<?php echo $id_r;?>';"/>
              </center></p>
              <?php
            }
                if($_SESSION['role']=="2" && sizeof($result) > 0){
          ?>
          <table class="table" width="90%">
              <thead>
                <tr>
                    <th width="35%">
                      <center>Discusion</center>
                    </th>
                    <th width="25%">
                      <center>Started By</center>
                    </th>
                    <th width="30%">
                      <center>Posted In</center>
                    </th>
                    <th width="10">
                      <center>Edit</center>
                    </th>
                </tr>

          <?php  
            
          ?>
           </thead>
                  <tbody class="searchable">
                    <?php 

                        foreach ($result as $res) {
                            echo "<tr>";
                              echo "<td><center>
                                        <a small href='forum_detail.php?id_nf=".$res['id_news']."'>".$res['discusion']."</a>
                                    </center></td>";
                              echo "<td><center>".$res['nama']."</center></td>";
                              echo "<td><center>".$res['lastpost']."</center></td>";
                              ?>
                              <td><center><a href="edit_news_forum.php?idn=<?php echo $res['id_news']; ?>" text>
                                  <i class="fa fa-edit"></i>
                               </a></center></td>
                              <?php
                              //echo "<h2>".$res["course"]."</h2><br>";
                            echo "</tr>";
                        }
                    ?>
                  </tbody>
          </table>
        <?php 
          } else if($_SESSION['role']=="3" && sizeof($result) > 0) {
          ?>
            <table class="table" width="90%">
              <thead>
                <tr>
                    <th width="35%">
                      <center>Discusion</center>
                    </th>
                    <th width="25%">
                      <center>Started By</center>
                    </th>
                    <th width="30%">
                      <center>Posted In</center>
                    </th>
                </tr>

          <?php  
            
          ?>
           </thead>
                  <tbody class="searchable">
                    <?php 

                        foreach ($result as $res) {
                            echo "<tr>";
                              echo "<td><center>
                                        <a small href='forum_detail.php?id_nf=".$res['id_news']."'>".$res['discusion']."</a>
                                    </center></td>";
                              echo "<td><center>".$res['nama']."</center></td>";
                              echo "<td><center>".$res['lastpost']."</center></td>";
                              //echo "<h2>".$res["course"]."</h2><br>";
                            echo "</tr>";
                        }
                    ?>
                  </tbody>
          </table>
          <?php 
           } 
           else {
            ?> 
              <p><center><h1>Kelas ini belum memiliki ruang diskusi</h1></center></p>
            <?php
              
          }
        ?>
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
