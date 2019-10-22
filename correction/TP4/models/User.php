<?php

require_once("MyPDO.php");

class User
{
	private $_login;
	private $_password;

	private const USER_TABLE = "Users";

	public function __construct( string $login, string $password = null )
	{
		$this->setLogin($login);
		$this->setPassword($password);
	}

	public function login() : string
	{
		return $this->_login;
	}

	public function setLogin( string $login ) : void
	{
		$this->_login = $login;
	}

	public function password() : string
	{
		return $this->_password;
	}

	public function setPassword( ?string $password ) : void
	{
		$this->_password = $password;
	}

	public function exists() : bool
	{
		// 1. On prépare la requête $result
		$result = MyPDO::pdo()->prepare('SELECT password FROM '.User::USER_TABLE.' WHERE user = :user');
		// 2. On assigne $login au paramêtre :user
	    $ok = $result->bindValue( ":user", $this->_login, PDO::PARAM_STR );
		// 3. On exécute la requête $result
	    $ok &= $result->execute();

		if (!$ok)
			throw new Exception("Error: user access in DB failed.");

		// 4. On vérifie que l'utilisateur a été trouvé et que son mot de passe
		//    correspond à celui de l'attribut $this->_password
		$user = $result->fetch(PDO::FETCH_ASSOC);
		return $user && password_verify($this->_password,$user['password']);
	}

	public function create() : void
	{
		$result = MyPDO::pdo()->prepare('INSERT INTO '.User::USER_TABLE.'(user,password) VALUES (:user,:password)');
	    $ok =  $result->bindValue( ":user", $this->_login, PDO::PARAM_STR );
	    $ok &= $result->bindValue( ":password", password_hash($this->_password,PASSWORD_DEFAULT), PDO::PARAM_STR );
	    $ok &= $result->execute();

		if ( !$ok )
			throw new Exception("Error: user creation in DB failed.");
	}

	public function changePassword( string $newpassword ) : void
	{
		$result = MyPDO::pdo()->prepare('UPDATE '.User::USER_TABLE.' SET password=:password WHERE user=:login');
		$ok =  $result->bindValue(':login',    $this->_login, PDO::PARAM_STR);
		$ok &= $result->bindValue(':password', password_hash($newpassword,PASSWORD_DEFAULT), PDO::PARAM_STR);
		$ok &= $result->execute();

		if ( !$ok || $result->rowCount() != 1 )
			throw new Exception("Error: password updating failed.");

		$this->setPassword($newpassword);
	}

	public function delete() : void
	{
		$result = MyPDO::pdo()->prepare('DELETE FROM '.User::USER_TABLE.' WHERE user = :login');
		$ok =  $result->bindValue(':login', $this->_login, PDO::PARAM_STR);
		$ok &= $result->execute();

		if ( !$ok || $result->rowCount() != 1 )
			throw new Exception("Error while deleting your account.");
	}
}
