<?php
	class Forum extends Database {
		public function CreateNewsForum($topic_discusion, $started_by, $message, $id_ruang) {
			$query = 'INSERT INTO forum_news (discusion, started_by, message, id_ruang)
			VALUES (:discusion, :started_by, :message, :id_ruang)';
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":discusion", $topic_discusion);
			$stmt->bindParam(":started_by", $started_by);
			$stmt->bindParam(":message", $message);
			$stmt->bindParam(":id_ruang", $id_ruang);
			try {
					$result = $stmt->execute();
					return $result;
				} 
				catch (PDOException $e) {
				   return false;
				}
			return false;
		}

		public function DeleteNewsForum($id_news) {
			$query = "DELETE FROM forum_news WHERE id_news = :id_news";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":id_news", $id_news);
			try {
				$result = $stmt->execute();
				return $result;
			} catch (PDOException $e) {
			   return false;
			}
			return false;
		}

		public function RetriveNewsForus($id_ruang){
			$query = "SELECT a.id_news, a.discusion, a.lastpost, b.nama, a.message, a.id_ruang 
			FROM forum_news a 
			JOIN dosen b ON a.started_by = b.nik 
			WHERE id_ruang = :id_ruang";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":id_ruang", $id_ruang);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		public function RetriveSingleNewsForus($id_news){
			$query = "SELECT a.id_news, a.discusion, a.lastpost, b.nama, a.message, a.id_ruang 
			FROM forum_news a 
			JOIN dosen b ON a.started_by = b.nik 
			WHERE id_news = :id_news";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":id_news", $id_news);
			$stmt->execute();
			return $stmt->fetch();
		}

		public function UpdateNewsForum($id_news, $message){
			$query = "UPDATE forum_news SET message = :message
			 WHERE id_news = :id_news";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(":message", $message);
			$stmt->bindParam(":id_news", $id_news);
			return $stmt->execute();
		}
	}
?>