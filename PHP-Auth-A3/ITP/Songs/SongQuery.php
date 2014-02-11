<?php
namespace ITP\Songs;
class SongQuery {
	protected $pdo;
	protected $sql;
	public function __construct($pdo) {
		$this->pdo = $pdo;
		$this->sql = "SELECT * FROM songs ";
	}
	public function all() {
		$statement = $this->pdo->prepare($this->sql);
		$statement->execute();
		return $statement->fetchAll(\PDO::FETCH_OBJ);
	}

	public function withArtist() {
		$this->sql = $this->sql . "INNER JOIN artists ON artists.id = songs.artist_id ";
		return $this;
	}

	public function withGenre() {
		$this->sql = $this->sql . "INNER JOIN genres ON genres.id = songs.genre_id ";
		return $this;
	}

	public function orderBy($order) {
		$this->sql = $this->sql . "ORDER BY $order";
		return $this;
	}
}
?>