<?php  
	session_start();
    if (!isset($_SESSION["LoggedIn"]) && !isset($_SESSION["UserId"])) {
        header("Location: ../login.php");
        exit();
    }

    require_once("Databases/Database.php");
    require_once("Databases/Courses.php");
    require_once("Databases/Forum.php");
    require_once("Databases/Users.php");

	if(isset($_GET['idn'])) {
		try {
		$db = new Forum();
		$id_news = $_GET['idn'];
		$result = $db->DeleteNewsForum($id_news);
			if($result){
				echo "<script type=\"text/javascript\">
								alert(\"News Forum successfully deleted.\");
								window.location = \"mycourse.php\"
							  </script>";
			} else {
				echo "<script type=\"text/javascript\">
								alert(\"Operation Failed.\");
								window.location = \"mycourse.php\"
							</script>";
			}
		}
		catch(Exception $e){
			echo "<script type=\"text/javascript\">
								alert(\"Operation Failed.\");
								window.location = \"Ruangkelas.php\"
							</script>";
		}	
	}
?>