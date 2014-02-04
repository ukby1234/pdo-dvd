<?php
class ArtistMenu {
	protected $artists;
	protected $name;
	public function __construct($name, $artists) {
		$this->name = $name;
		$this->artists = $artists;
	}
	public function __toString() {
		$name = $this->name;
		$str = "<select name=$name>\n";
		foreach ($this->artists as $artist) {
			$id = $artist->id;
			$artist_name = $artist->artist_name;
			$str = $str . "<option value=$id>$artist_name</option>\n";
		}
		$str = $str . "</select>\n";
		return $str;
	} 
}
?>