<?php
	require __DIR__ . '/vendor/autoload.php';
	require __DIR__ . '/db.php';
	use \Symfony\Component\HttpFoundation\Request;
	use \Symfony\Component\HttpFoundation\RedirectResponse;
	use \Symfony\Component\HttpFoundation\Session\Session;
	use ITP\Auth;
	$request = Request::createFromGlobals();
	$username = $request->request->get('username');
	$password = $request->request->get('password');
	$auth = new Auth($pdo);
	$session = new Session();
	if (!is_null($session->get('username')) && !is_null($session->get('email'))) {
		$response = new RedirectResponse('dashboard.php');
		return $response->send();
	}
	if (is_null($username) || is_null($password)) {
		$response = new RedirectResponse('login.php');
		return $response->send();
	}
	if ($auth->attempt($username, $password)) {	
		$session->start();
		$session->set('username', $username);
		$session->set('email', $auth->email);
		$session->set('loginTime', time());
		$session->getFlashBag()->set('statusMessage', 'You have successfully logged in!');
		$response = new RedirectResponse('dashboard.php');
		return $response->send();
	}
	else {
		$session->getFlashBag()->set('statusMessage', 'Incorrect credentials');
		$response = new RedirectResponse('login.php');
		return $response->send();
	}
?>