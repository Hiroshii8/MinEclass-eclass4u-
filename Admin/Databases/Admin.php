<?php
	class Admin extends Connection_Admin {

		public function addMahasiswa($nim, $nama_mhs, $email_mhs, $pass){
			$query = "INSERT INTO mahasiswa (nim, password, nama, email) VALUES 
				(:nim, :password, :nama_mhs, :email)";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":nim", $nim);
			$stmt->bindParam(":password", $pass);
			$stmt->bindParam(":nama_mhs", $nama_mhs);
			$stmt->bindParam(":email", $email_mhs);
			try {
				$result = $stmt->execute();
				return $result;
			} catch (PDOException $e) {
			   return false;
			}
			return false;
		}

		public function addDosen($nik, $nama_dsn, $email_dsn, $pass) {
			$query = "INSERT INTO dosen (nik, password, nama, email) VALUES 
				(:nik, :password, :nama_dsn, :email)";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":nik", $nik);
			$stmt->bindParam(":password", $pass);
			$stmt->bindParam(":nama_dsn", $nama_dsn);
			$stmt->bindParam(":email", $email_dsn);
			try {
				$result = $stmt->execute();
				return $result;
			} catch (PDOException $e) {
			   return false;
			}
			return false;
		}

		public function removeMahasiswa($nim){
			$query = "DELETE FROM mahasiswa WHERE nim = :nim";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":nim", $nim);
			try {
				$result = $stmt->execute();
				return $result;
			} catch (PDOException $e) {
			   return false;
			}
			return false;
		}

		public function removeDosen($nik){
			$query = "DELETE FROM dosen WHERE nik = :nik";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":nik", $nik);
			try {
				$result = $stmt->execute();
				return $result;
			} catch (PDOException $e) {
			   return false;
			}
			return false;
		}

		public function updateMahasiswa($nim, $nama_mhs, $email_mhs, $pass){
			$query = "UPDATE mahasiswa SET password=:password, nama=:nama_mhs, email=:email 
				WHERE nim=:nim";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":nim", $nim);
			$stmt->bindParam(":password", $pass);
			$stmt->bindParam(":nama_mhs", $nama_mhs);
			$stmt->bindParam(":email", $email_mhs);
			try {
				$result = $stmt->execute();
				return $result;
			} catch (PDOException $e) {
			   return false;
			}
			return false;
		}

		public function updateDosen($nik, $nama_dsn, $email_dsn, $pass){
			$query = "UPDATE dosen SET password=:password, nama=:nama_dsn, email=:email 
				WHERE nik=:nik";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":nik", $nik);
			$stmt->bindParam(":password", $pass);
			$stmt->bindParam(":nama_dsn", $nama_dsn);
			$stmt->bindParam(":email", $email_dsn);
			try {
				$result = $stmt->execute();
				return $result;
			} catch (PDOException $e) {
			   return false;
			}
			return false;
		}

		public function selectAll_Mahasiswa() {
			$query = "SELECT * FROM mahasiswa";
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		public function selectNI_Mahasiswa($id_room) { //NI = Not Included in the room
			$query = "SELECT nim, nama FROM mahasiswa WHERE nim NOT IN 
			(SELECT nim FROM daftar_peserta WHERE id_ruang = :id_room)";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":id_room", $id_room);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		public function selectAll_Dosen() {
			$query = "SELECT * FROM dosen";
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		public function selectByNim($nim) {
			$query = "SELECT * FROM mahasiswa WHERE nim=:nim";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":nim", $nim);
			$stmt->execute();
			if ($stmt->rowCount() > 0) {
				$result = $stmt->fetch();
				return array(1, $result);
			}
			return array(0, "Data not found!");
		}

		public function selectByNik($nik) {
			$query = "SELECT * FROM dosen WHERE nik=:nik";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":nik", $nik);
			$stmt->execute();
			if ($stmt->rowCount() > 0) {
				$result = $stmt->fetch();
				return array(true, $result);
			}
			return array(false, "Data not found!");
		}

	}
?>