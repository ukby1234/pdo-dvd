<?php
	require __DIR__ . '/vendor/autoload.php';
	use \Symfony\Component\HttpFoundation\Request;
	use \Symfony\Component\HttpFoundation\RedirectResponse;
	use \Symfony\Component\HttpFoundation\Session\Session;
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
	<?php
		$session = new Session();
		$flash_message = $session->getFlashBag()->get('statusMessage');
		if (count($flash_message) > 0)
			echo ($flash_message[0]);
	?>
	<br>
	<form action="login-process.php" method="POST">
		<input type="text" name="username">Username</input>
		<br>
		<input type="password" name="password">Password</input>
		<br>
		<input type="submit" value="Login"></input>
	</form>
</body>
</html>