<?php
class Song {
	protected $title;
	protected $artistid;
	protected $genreid;
	protected $price;
	protected $pdo;
	protected $id;

	public function __construct($pdo) {
		$this->pdo = $pdo;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function setArtistId($artistid) {
		$this->artistid = $artistid;
	}

	public function setGenreId($genreid) {
		$this->genreid = $genreid;
	}

	public function setPrice($price) {
		$this->price = $price;
	}

	public function save() {
		$sql = "INSERT INTO songs (title, artist_id, genre_id, price) VALUES ('$this->title', $this->artistid, $this->genreid, $this->price)";
		$statement = $this->pdo->prepare($sql);
		return $statement->execute();
	}

	public function getTitle() {
		return $this->title;
	}

	public function getId() {
		return $this->pdo->lastInsertId();
	}
}