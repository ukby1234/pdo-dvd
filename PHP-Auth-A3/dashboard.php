<?php
	require __DIR__ . '/vendor/autoload.php';
	require __DIR__ . '/db.php';
	use \Symfony\Component\HttpFoundation\Request;
	use \Symfony\Component\HttpFoundation\RedirectResponse;
	use \Symfony\Component\HttpFoundation\Session\Session;
	use \Carbon\Carbon;
	$session = new Session();
	$username = $session->get('username');
	$email = $session->get('email');
	$loginTime = Carbon::createFromTimeStamp($session->get('loginTime'));
	$dt = Carbon::now()->diffInSeconds($loginTime);
	if (is_null($username) || is_null($email)) {
		$response = new RedirectResponse('login.php');
		return $response->send();
	}
	$flash_message = $session->getFlashBag()->get('statusMessage');
	$songQuery = new ITP\Songs\SongQuery($pdo);
	$songs = $songQuery
    ->withArtist()
    ->withGenre()
    ->orderBy('title')
    ->all();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<link rel="stylesheet" href="style.css" type="text/css">
<body>
	<div>
		<div id="flash_message">
			<?php if (count($flash_message) > 0)
			echo ($flash_message[0]);
			?>
		</div>
		<div id="top_right">
			<?php echo ($username);?> <br>
			<?php echo ($email);?> <br>
			Last Login:<?php echo ($dt); ?> seconds ago.<br>
			<a href="logout.php">Logout</a> <br>
		</div>
	</div>
	<div id="song">
		<div id="title">Title</div>
		<div id="artist">Artist</div>
		<div id="genre">Genre</div>
		<div id="price">Price</div>
	<?php foreach($songs as $song) : ?>
		<div id="title"><?php echo $song->title;?>&nbsp;</div>
		<div id="artist"><?php echo $song->artist_name;?></div>
		<div id="genre"><?php echo $song->genre;?></div>
		<div id="price"><?php echo $song->price;?></div>
	<?php endforeach; ?>
	</div>
</body>
</html>