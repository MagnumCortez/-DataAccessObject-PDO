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

	private function setData(Array $user)
	{
		$this->setUserID($user['userID']);
		$this->setName($user['name']);
		$this->setLogin($user['login']);
		$this->setPassword($user['password']);
	}

	/**
	 * Load a user by ID
	 */
	public function loadUser($userID) 
	{
		$statement = new ConnectionPDO();

		$sql = "SELECT * FROM users WHERE userID = :USERID;";

		$params = [
			'USERID' => $userID
		];

		$result = $statement->select($sql, $params);

		if (isset($result[0])) {
			$row = $result[0];

			$this->setData($row);
		}
	}

	/**
	 * return a list of users
	 */
	public static function getList() 
	{
		$statement = new ConnectionPDO();

		$sql = "SELECT * FROM users ORDER BY name;";

		return $statement->select($sql);
	}

	/**
	 * Does search for login and returns a user
	 */
	public static function search($login)
	{
		$statement = new ConnectionPDO();

		$sql = "SELECT * FROM users WHERE login LIKE :SEARCH ORDER BY name;";

		$params = [
			'SEARCH' => '%' . $login . '%'
		];

		return $statement->select($sql, $params);
	}

	/**
	 * Validate login and password and load user
	 */
	public function login($login, $password)
	{
		$statement = new ConnectionPDO();

		$sql = "SELECT * FROM users WHERE login = :LOGIN AND password = :PASSWORD;";

		$params = [
			'LOGIN' => $login,
			'PASSWORD' => $password
		];

		$result = $statement->select($sql, $params);

		if (!isset($result[0] )) {
			throw new Exception("Login e/ou senha inválido!", 1);
		}

		$row = $result[0];

		$this->setData($row);
	}

	/**
	 * Persist user data and return userID
	 */
	public function insert()
	{
		$statement = new ConnectionPDO();

		//CAll Procedure
		$sql = "CALL sp_users_insert(:NAME, :LOGIN, :PASSWORD);";

		$params = [
			'NAME' => $this->getName(),
			'LOGIN' => $this->getLogin(),
			'PASSWORD' => $this->getPassword()
		];

		$result = $statement->select($sql, $params);

		if (!isset($result[0] )) {
			throw new Exception("Não foi possivel persistir dados do usuário!", 1);
		}

		$row = $result[0];

		$this->setData($row);	
	}

	public function update($name, $login, $password)
	{
		$statement = new ConnectionPDO();

		$this->setName($name);
		$this->setLogin($login);
		$this->setPassword($password);

		$sql = "UPDATE users SET name = :NAME, login = :LOGIN, password = :PASSWORD WHERE userID = :USERID;";

		$params = [
			'NAME' => $this->getName(),
			'LOGIN' => $this->getLogin(),
			'PASSWORD' => $this->getPassword(),
			'USERID' => $this->getUserID()
		];

		$statement->query($sql, $params);
	}

	public function delete()
	{
		$statement = new ConnectionPDO();

		$sql = "DELETE FROM users WHERE userID = :USERID;";

		$params = [
			'USERID' => $this->getUserID()
		];

		$result = $statement->query($sql, $params);

		if ($result->rowCount() == 0) {
			throw new Exception("Não foi possivel remover dados do usuário!", 1);
		}

		$this->setData([]);
	}

	public function __toString() 
	{
		return json_encode([
			'userID' => $this->getUserID(),
			'name' => $this->getName(),
			'login' => $this->getLogin(),
			'password' => $this->getPassword()
		]);
	}

}