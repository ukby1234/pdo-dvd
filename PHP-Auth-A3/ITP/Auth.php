<?php
namespace ITP;
class Auth {
	public $pdo;
	public $email;
	public function __construct($pdo) {
		$this->pdo = $pdo;
	}

	public function attempt($username, $password) {
		$sql = "SELECT * FROM users WHERE username=:username AND password=:hash";
		$hash = sha1($password);
		$statement = $this->pdo->prepare($sql);
		$statement->bindParam(':username', $username);
		$statement->bindParam(':hash', $hash);
		$statement->execute();
		$users = $statement->fetchAll(\PDO::FETCH_OBJ);
		if (count($users) > 0) {
			$this->email = $users[0]->email;
			return true;
		}
		else
			return false;
	}
	
}
?>