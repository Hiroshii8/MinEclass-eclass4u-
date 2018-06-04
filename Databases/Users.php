<?php
	class Users extends Database {

		public function check_roles($username, $password) {     
			$query =	"SELECT role FROM admin WHERE      
						username=:usr AND password=:pass      
						UNION     
						SELECT role FROM dosen 
						WHERE  nik=:usr AND password=:pass     
						UNION     
						SELECT role FROM mahasiswa 
						WHERE  nim=:usr AND password=:pass";
			$stmt = $this->db->prepare($query);     
			$stmt->bindParam(":usr",$username);     
			$stmt->bindParam(":pass", $password); 
			$stmt->execute();     
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if ($stmt->rowCount() > 0) {
				foreach ($result as $res) {
					$roles = $res['role'];
					return $roles;
				}
			}
			else
				return -1;
		}

		public function Login($username, $password) {
			$roles = $this->check_roles($username, $password);
			if($roles!=-1){
				if ($roles == 1)
					return $this->login_admin($username, $password);
				else if ($roles == 2)
					return $this->login_dosen($username, $password);
				else if ($roles == 3)
					return $this->login_mahasiswa($username, $password);
			} 
			return array(0, -1, "account tidak ditemukan");
		}

		public function login_admin($username, $password) {
			$query = "SELECT * FROM admin WHERE username=:usr AND password=:pass";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":usr", $username);
			$stmt->bindParam(":pass", $password);
			$stmt->execute();
			$result = $stmt->fetch();
			if ($password == $result["password"]) {
				return array(1, 1, $result["username"], $result["nama"]);
			}
			return array(0, 1, "username atau password Admin salah");
		}

		public function login_dosen($username, $password) {
			$query = "SELECT * FROM dosen WHERE nik=:nik AND password=:pass";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":nik", $username);
			$stmt->bindParam(":pass", $password);
			$stmt->execute();
			$result = $stmt->fetch();
			if ($password == $result["password"]) {
				return array(1, 2, $result["nik"], $result["nama"]);
			}
			return array(0, 2, "username atau password Dosen salah");
		}

		public function login_mahasiswa($username, $password) {
			$query = "SELECT * FROM mahasiswa WHERE nim=:nim AND password=:pass";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":nim", $username);
			$stmt->bindParam(":pass", $password);
			$stmt->execute();
			$result = $stmt->fetch();
			if ($password == $result["password"]) {
				return array(1, 3, $result["nim"], $result["nama"]);
			}
			return array(0, 3, "username atau password Mahasiswa salah");
		}


		public function latest_news(){
			$query = "SELECT * FROM news WHERE type = 'latest' ORDER BY waktu DESC limit 2";
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		public function news(){
			$query = "SELECT * FROM news WHERE type = 'main' ORDER BY id DESC";
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll();
		}
	}
?>