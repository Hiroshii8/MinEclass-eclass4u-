<?php
	class Ruang extends Connection_Admin {
		
		public function createRuanganKelas($kode_mk, $nik, $kelas, $semester) {
			if($this->CheckRuang($kode_mk, $kelas, $semester) == 0) {
				$query = "INSERT INTO ruang_kelas (kode_mk, nik, kelas, semester)
				VALUES (:kode_mk, :nik, :kelas, :semester)";
				$stmt = $this->db->prepare($query);
				$stmt->bindParam(":kode_mk", $kode_mk);
				$stmt->bindParam(":nik", $nik);
				$stmt->bindParam(":kelas", $kelas);
				$stmt->bindParam(":semester", $semester);
				try {
					$result = $stmt->execute();
					return $result;
				} catch (PDOException $e) {
				   return false;
				}
			} 
			else
				return false;
		}

		public function InsertPeserta($nim, $id_ruang) {
			$query = "INSERT INTO daftar_peserta (nim, id_ruang)
				VALUES(:nim, :id_ruang)";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":nim", $nim);
			$stmt->bindParam(":id_ruang", $id_ruang);
			try {
				$result = $stmt->execute();
				return $result;
			} catch (PDOException $e) {
			   return false;
			}
			return false;
		}

		public function DeletePeserta($id_ruang, $nim) {
			$query = "DELETE FROM daftar_peserta WHERE nim=:nim AND id_ruang=:id_ruang";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":nim", $nim);
			$stmt->bindParam(":id_ruang", $id_ruang);
			try {
				$result = $stmt->execute();
				return $result;
			} catch (PDOException $e) {
			   return false;
			}
			return false;
		}

		public function DeleteAllPeserta($id_ruang) {
			$query = "DELETE FROM daftar_peserta WHERE id_ruang = :id_ruang";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":id_ruang", $id_ruang);
			try {
				$result = $stmt->execute();
				return $result;
			} catch (PDOException $e) {
			   return false;
			}
			return false;
		}

		public function SelectAll_peserta($id_ruang) {
			$query = "SELECT a.nim, b.nama FROM daftar_peserta a 
			JOIN mahasiswa b 
			ON a.nim = b.nim
			WHERE a.id_ruang=:id_ruang ORDER by a.nim ASC";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":id_ruang", $id_ruang);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		public function Retrive_matkul(){
			$query = "SELECT * FROM mata_kuliah";
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		public function Retrive_Ruangkelas() {
			$query = 'SELECT a.kode_mk, CONCAT(a.nama_mk, " (", b.kelas, ") ", b.semester) AS ruang_kelas, b.id_ruang, c.nama FROM ruang_kelas b JOIN mata_kuliah a ON a.kode_mk = b.kode_mk JOIN dosen c ON c.nik = b.nik';
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		public function Get_Ruangkelas($id) {
			$query = 'SELECT a.nama_mk, a.kode_mk, b.kelas, b.semester, c.nama, c.nik FROM ruang_kelas b JOIN mata_kuliah a ON a.kode_mk = b.kode_mk JOIN dosen c ON c.nik = b.nik
				WHERE b.id_ruang=:id';
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":id", $id);
			$stmt->execute();
			return $stmt->fetch();
		}

		public function Update_Ruangkelas($id_ruang, $kode_mk, $nik, $kelas, $semester){
			$query = "UPDATE ruang_kelas SET kode_mk=:kode_mk, nik=:nik, kelas=:kelas, semester=:semester 
			WHERE id_ruang=:id_ruang";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":kode_mk", $kode_mk);
			$stmt->bindParam(":nik", $nik);
			$stmt->bindParam(":kelas", $kelas);
			$stmt->bindParam(":semester", $semester);
			$stmt->bindParam(":id_ruang", $id_ruang);
			try {
				$result = $stmt->execute();
				return $result;
			} catch (PDOException $e) {
			   return false;
			}
			return false;			
		}

		public function removeRuang($id_ruang) {
			$exc = $this->DeleteAllPeserta($id_ruang);
			if($exc) {
				$query = "DELETE FROM ruang_kelas WHERE id_ruang=:id_ruang";
				$stmt = $this->db->prepare($query);
				$stmt->bindParam(":id_ruang", $id_ruang);
				try {
				$result = $stmt->execute();
				return $result;
				} catch (PDOException $e) {
				   return false;
				}	
			}
			return false;		
		}

		public function CheckRuang($kode_mk, $kelas, $semester) {
			$semester = TRIM($semester);
			$kelas = TRIM($kelas);
			$kode_mk = TRIM($kode_mk);
			$query = "SELECT COUNT(*) FROM ruang_kelas WHERE 
						kode_mk = :kode_mk AND
						kelas = :kelas AND 
						semester = :semester";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":kode_mk", $kode_mk);
			$stmt->bindParam(":kelas", $kelas);
			$stmt->bindParam(":semester", $semester);
			$stmt->execute();
			return $stmt->fetchColumn();
		}
	}
?>