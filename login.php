<?php
    session_start();
    require_once("Databases/Database.php");
    require_once("Databases/Users.php");

    $db = new Users();
    if ($_POST) {
      $username = $_POST["username_login"];
      $password = $_POST["password_login"];

      $check = $db->Login($username, $password);
      if($check[0]==0) {
        echo "<script>alert(".$check[2].")</script>";
      } else {
          $_SESSION["LoggedIn"] = true;
          $_SESSION["UserId"] = $check[2];
          $_SESSION["Name"] = $check[3];
		      $_SESSION["role"] = $check[1];
          if($check[1]==1) {
            echo "<script>window.location.href='Admin/'</script>";
          } else if ($check[1]==2) {
            echo "<script>window.location.href='index.php'</script>";
          } else if ($check[1]==3) {
            echo "<script>window.location.href='index.php'</script>";
          }
      }
    }
    require_once ("Databases/Database.php");
    require_once ("Databases/Users.php");

    $db_u = new Users();
    $res_u = $db_u->latest_news();
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Eclass-4u@UNTAR</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="indexstyle.css" rel="stylesheet" type="text/css" />
<link rel="icon" type="image/png" href="icon1.png">
<style type="text/css">
.style1 {
	font-size: 12px;
	font-weight: bold;
}
</style>
</head>

<body>
<div id="templatemo_container">
<div id="templatemo_left_column"></div>
<div id="templatemo_menu_column">
    <div id="templatemo_left_title">
      ECLASS-4U<br />
      <span>Universitas Tarumanagara</span></div>
   <
   <div class="templatemo_menu_list"><ul>
        <br>
        <br>
        <br>
        <!--
        <li><a href="index.php" class="current">Home</a></li>
        <li><a href="mycourse.php">My Course</a></li>
        <li><a href="kontakadmin.php">Kontak Admin</a></li>-->
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
    Email: suryantohot@hotmail.com</div>
  </div>
<div id="templatemo_right_column">
    <div id="templatemo_right_header">
      <div class="templatemo_right_link">
        <form method="post">
          <ul>
            <li class="a" placeholder="Masukan NIM">
              <b>Username</b>
              <input type="text" name="username_login" required></li>
            <li class="a" placeholder="Masukan Password">
              <b>Password</b>
              <input type="password" name="password_login" required></li>
              <button type="submit" name="login"><b>LOGIN</b></button>
          </ul>
        </form>
      </div>
      <div class="templatemo_right_slogan"><strong>.....Media Belajar Daring FTI UNTAR.....<br />
      </strong>
      Berlajar Bersama FTI UNTAR melalui Eclass-4u</div>
    </div>
    <div id="templatemo_content">
      <h1>Selamat Datang Di Website Eclass-4U FTI UNTAR</h1>
      <p>Eclass ini di peruntukan untuk membantu kegiatan perkuliahan mahasiswa dan dosen dari FTI UNTAR.</p>
      <p>Selamat Datang Mahasiswa Baru FTI UNTAR angkatan 2017/2018.
        Selamat bergabung menjadi keluarga besar FTI Untar.
      Silakan menggunakan website e-learning FTI Untar ini. Apabila ada kesulitan, silakan hubungi admin di Gedung R Lantai 11</p>
      <p><img src="images/templatemo_line.jpg" alt="templatemo.com" width="430" height="2" /></p>
      <div class="templatemo_wedo">
        <h2>FAKULTAS TEKNOLOGI INFORMASI</h2>
        <p><strong><img src="images/templatemo_pic1.png" alt="templatemo" width="133" height="176" />FTI-Untar </strong>didirikan berdasarkan surat keputusan 01-305/KR/UNTAR/X/2001 tanggal 26 Oktober 2001, mempunyai dua program studi: Program Studi Teknik Informatika Jenjang Pendidikan S1 (Terakreditasi A) dan Program Studi Sistem Informasi Jenjang Pendidikan S1 (Terakreditasi B).Berlandaskan misi menjadi fakultas entrepreneurial unggul yang memiliki integritas dan profesionalisme di Asia Tenggara, Kurikulum Program Studi Teknik Informatika dan Sistem Informasi disusun dengan pola berimbang antara matakuliah dasar ilmu komputer, matakuliah keahlian komputer serta praktikum komputer yang dilakukan secara kelompok dan mandiri di bidang teknologi informasi.</p>
        <p><strong>FTI-Untar</strong> berkomitmen untuk mempersiapkan lulusannya sebagai profesional yang siap bekerja di bidang teknologi informasi serta lulusan yang ahli di bidang keilmuan teknologi informasi, melalui kurikulum dan kegiatan akademis yang sejalan dengan perkembangan era globalisasi. Alumni FTI-Untar memberikan rekam jejak yang baik sebagai profesional bidang teknologi informasi.</p>
        <p>Pada saat ini FTI-Untar mengalami pertumbuhan yang pesat dalam bidang penalaran ilmiah termasuk penelitian, serta dalam bidang sistem informasi akademik. Pada tanggal 17 Februari 2012 FTI-Untar memperoleh Sertifikasi ISO 9001:2008 melalui Badan Pemberi Sertifikat yaitu URS-UKAS (United Registrar of System – United Kingdom Accreditation Service). Dosen FTI-Untar saat ini tercatat berjenjang Akademik : Guru Besar, Lektor Kepala dan Lektor hampir 90%, prestasi ini sulit dicapai oleh Perguruan Tinggi Swasta di Indonesia. Penalaran ilmiah yang dilakukan oleh mahasiswa FTI-Untar juga sangat menggembirakan, sejak tahun 2011 beberapa kelompok mahasiswa FTI-Untar mendapatkan hibah DIKTI dalam Lomba Kreativitas Mahasiswa pada setiap tahun.</p>
      </div>
      <p><img src="images/templatemo_line.jpg" alt="templatemo.com" /></p>
      <div class="templatemo_wedo">
        <h2>VISI & MISI</h2>
        <p><b>Visi</b></p>
        <p>Menjadi fakultas entrepreneurial unggul yang memiliki integritas dan profesionalisme di bidang teknologi informasi di kawasan Asia Tenggara pada tahun 2025.</p>
        <p><b>Misi</b></p>
        <p>- Menghasilkan lulusan yang kompeten, berintegritas, profesional di bidang teknologi informasi dan berjiwa entrepreneurial.<br />
          - Menyelenggarakan dan mengembangkan kegiatan tridharma perguruan tinggi di bidang teknologi informasi untuk mencapai keunggulan institusi berlandaskan nilai-nilai integritas, profesional dan entrepreneurship.<br />
          - Memanfaatkan ilmu pengetahuan, dan teknologi informasi secara berkesinambungan untuk meningkatkan kesejahteraan masyarakat.<br />
          - Menyelenggarakan kerjasama yang saling menguntungkan di bidang teknologi informasi dengan institusi di dalam maupun di luar negeri untuk mendukung pertumbuhan organisasi</p>
        <p>&nbsp;</p>
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
