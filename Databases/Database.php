<?php
	class Database{
		protected $db;
		function __construct(){
			$host = "localhost";
    		$dbname = "eclass_php";
    		$username = "root";
    		$password = "";
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