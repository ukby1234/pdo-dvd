<?php
class ArtistQuery {
	protected $pdo;
	public function __construct($pdo) {
		$this->pdo = $pdo;
	}
	public function getAll() {
		$statement = $this->pdo->prepare('SELECT * FROM artists');
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_OBJ);
	}
}
?>