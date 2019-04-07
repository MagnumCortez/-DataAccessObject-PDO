<?php
class UserDAO {
	private $userID;
	private $name;
	private $login;
	private $password;

	public function getUserID()
	{
		return $this->userID;
	}

	public function setUserID($userID)
	{
		$this->userID = $userID		;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getLogin()
	{
		return $this->login;
	}

	public function setLogin($login)
	{
		$this->login = $login;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

	private function fillUser(Array $user)
	{
		$this->setUserID($user['userID']);
		$this->setName($user['name']);
		$this->setLogin($user['login']);
		$this->setPassword($user['password']);
	}

	public function loadUser($userID) {
		$statement = new ConnectionPDO();

		$sql = "SELECT * FROM users WHERE userID = :userID;";

		$params = [
			'userID' => $userID
		];

		$result = $statement->select($sql, $params);

		if (isset($result[0])) {
			$row = $result[0];

			$this->fillUser($row);
		}
	}

	public function __toString() {
		return json_encode([
			'userID' => $this->getUserID(),
			'name' => $this->getName(),
			'login' => $this->getLogin(),
			'password' => $this->getPassword()
		]);
	}

}