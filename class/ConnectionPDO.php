<?php

class ConnectionPDO extends PDO {
	private $conn;

	public function __construct()
	{
		$this->conn = new PDO("mysql:host=localhost;dbname=DbTest", "root", "admin");
	}

	private function setParam($statement, $field, $value)
	{
		$statement->bindParam($field, $value);
	}

	private function setParams($statement, $params = [])
	{
		foreach ($params as $field => $value) {
			$this->setParam($statement, $field, $value);
		}
	}

	public function query($rawQuery, $params = [])
	{
		$statement = $this->conn->prepare($rawQuery);

		$this->setParams($statement, $params);

		$statement->execute();

		return $statement;
	}

	public function select($rawQuery, $params = []) : array
	{
		$statement = $this->query($rawQuery, $params);

		return $statement->fetchAll(PDO::FETCH_ASSOC);		
	}
}