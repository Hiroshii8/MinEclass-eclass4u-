<?php
	class Database{
		protected $db;
		function __construct(){
			$host = "sql202.epizy.com";
    		$dbname = "epiz_22159811_eclass_php";
    		$username = "epiz_22159811";
    		$password = "testing";
    		try {
        		$this->db = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
        		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		} 
    		catch (PDOException $exception) {
        		die("Connection error: " . $exception->getMessage());
    		}
		}
		function __get_error(){
			return $this->db->error;
		}
	}
?>