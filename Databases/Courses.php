<?php

	class Courses extends Database{
		public function All_TI_course() {
			$query = 'SELECT a.kode_mk, CONCAT(b.nama_mk, " (", a.kelas, ") ", a.semester) AS course, c.nama from ruang_kelas a join mata_kuliah b on a.kode_mk = b.kode_mk JOIN dosen c ON a.nik = c.nik WHERE LEFT(b.kode_mk,2)="TK"';
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}

		public function All_SI_course() {
			$query = 'SELECT a.kode_mk, CONCAT(b.nama_mk, " (", a.kelas, ") ", a.semester) AS course, c.nama from ruang_kelas a join mata_kuliah b on a.kode_mk = b.kode_mk JOIN dosen c ON a.nik = c.nik 
			WHERE LEFT(b.kode_mk,2)="SI"';
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
		
		public function CourseBaseOnID($id_ruang) {
			$query = 'SELECT a.id_ruang,a.kode_mk, CONCAT(b.nama_mk, " (", a.kelas, ") ", a.semester) AS course, c.nama from ruang_kelas a join mata_kuliah b on a.kode_mk = b.kode_mk JOIN dosen c ON a.nik = c.nik WHERE id_ruang = :id_ruang';
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":id_ruang", $id_ruang);
			$stmt->execute();
			return $stmt->fetch();
		}

		// Untuk Mahasiswa
		
		public function RC_Mahasiswa($nim){ // RC = Retrive Course
			$query = 'SELECT a.id_ruang, a.kode_mk, CONCAT(b.nama_mk, " (", a.kelas, ") ", a.semester) AS course, d.nama from ruang_kelas a join mata_kuliah b on a.kode_mk = b.kode_mk 
			JOIN daftar_peserta c ON a.id_ruang = c.id_ruang 
			JOIN dosen d ON a.nik = d.nik
			WHERE c.nim = :nim';
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":nim", $nim);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		} 
		
		//Untuk Dosen
		
		public function RC_Dosen($nik) { // RC = Retrive Course
			$query = 'SELECT a.id_ruang, a.kode_mk, CONCAT(b.nama_mk, " (", a.kelas, ") ", a.semester) AS course, d.nama from ruang_kelas a join mata_kuliah b on a.kode_mk = b.kode_mk 
			JOIN dosen d ON a.nik = d.nik
			WHERE a.nik = :nik';
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":nik", $nik);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
		
		public function upload_dosen($name, $nomor, $id_ruang){
			$query = "INSERT INTO file_upld_dosen(realname,pertemuan,id_ruang) VALUES (:name, :nomor, :id_ruang)";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":name",$name);
			$stmt->bindParam(":nomor",$nomor);
			$stmt->bindParam(":id_ruang", $id_ruang);
			try {
				$result = $stmt->execute();
				return $result;
			} catch (PDOException $e) {
			   return false;
			}
			return false;
		}

		public function select_upload($nomor, $id_ruang){
			$query = "SELECT realname FROM file_upld_dosen WHERE pertemuan = :pertemuan AND id_ruang = :id_ruang";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":pertemuan", $nomor);
			$stmt->bindParam(":id_ruang", $id_ruang);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
	}

?>