<link rel="stylesheet" href="style.css" type="text/css">
<?php
	$host = 'itp460.usc.edu';
	$dbname = 'dvd';
	$user = 'student';
	$pass = 'ttrojan';
	$title = $_GET['dvd_title'];
	$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$sql = "
	SELECT title, rating, genre, format
	FROM dvd_titles
	INNER JOIN ratings
	ON ratings.id = dvd_titles.rating_id
	INNER JOIN genres
	ON genres.id = dvd_titles.genre_id
	INNER JOIN formats
	ON formats.id = dvd_titles.format_id
	WHERE title LIKE ?
	";
	$statement = $pdo->prepare($sql);
	$like = '%' . $title . '%';
	$statement->bindParam(1, $like);
	$statement->execute();
	$movies = $statement->fetchAll(PDO::FETCH_OBJ);
	echo "You searched for '$title':"
	//var_dump($movies);
?>
<?php if(count($movies) < 1) : ?>
    <a href="search.php">Nothing was found</a>
<?php endif; ?>
<?php if(count($movies) >= 1) : ?>
<div id="movie">
	<div id="title">Title</div>
	<div id="rating">Rating</div>
	<div id="genre">Genre</div>
	<div id="format">Format</div>
</div>
<?php foreach($movies as $movie) : ?>
	<div id="movie">
	<div id="title"><?php echo $movie->title;?></div>
	<div id="rating"><?php echo $movie->rating;?></div>
	<div id="genre"><?php echo $movie->genre;?></div>
	<div id="format"><?php echo $movie->format;?></div>
	</div>
<?php endforeach; ?>
<?php endif; ?>
