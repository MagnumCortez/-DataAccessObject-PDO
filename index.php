<?php
require_once("config.php");

/***********************/
/* Testando classe PDO */
/***********************/
$conn = new ConnectionPDO();

$sql = "INSERT INTO users (name, login, password) VALUES (:name, :login, :password);";

$params = [
	'name' => 'Beltrano dos Santos', 
	'login' => 'bsantos', 
	'password' => md5('secreta')
];

$result = $conn->query($sql, $params);


$sql = "SELECT * FROM users;";

$users = $conn->select($sql);

echo json_encode($users);


/***********************************/
/* Testando classe DAO de Usuários */
/***********************************/
$user = new UserDAO();

$user->loadUser(1);

echo $user;