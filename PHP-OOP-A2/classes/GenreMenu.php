<?php
class GenreMenu {
	protected $genres;
	protected $name;
	public function __construct($name, $genres) {
		$this->name = $name;
		$this->genres = $genres;
	}
	public function __toString() {
		$name = $this->name;
		$str = "<select name=$name>\n";
		foreach ($this->genres as $genre){
			$id = $genre->id;
			$genre_name = $genre->genre;
			$str = $str . "<option value=$id>$genre_name</option>\n";
		}
		$str = $str . "</select>\n";
		return $str;
	} 
}
?>