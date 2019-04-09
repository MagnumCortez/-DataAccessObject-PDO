<?php
require_once("config.php");

/***********************************/
/*        Testando classe PDO      */
/***********************************/

// $conn = new ConnectionPDO();


/* ### Testando Class PDO - Query ### */

// $sql = "INSERT INTO users (name, login, password) VALUES (:name, :login, :password);";

// $params = [
// 	'name' => 'Beltrano dos Santos', 
// 	'login' => 'bsantos', 
// 	'password' => md5('secreta')
// ];

// $result = $conn->query($sql, $params);
// print_r($result);


/* ### Testando Class PDO - Select ### */

// $sql = "SELECT * FROM users;";
// $users = $conn->select($sql);

// echo json_encode($users);


/***********************************/
/* Testando classe DAO de Usuários */
/***********************************/

$user = new UserDAO();

/* ### Testando method loadUser ### */
$user->loadUser(1);
echo $user; //Call magic method __toString()


/* ### Testando method List ### */
//$listUsers = $user::getList();


/* ### Testando method Search ### */
//$listUsers = $user::search('fmerlin');


/* ### Testando method Login ### */
// $login = 'fmerlin';
// $pwd = 'abcdef';
// $userLogged = $user->login($login, $pwd);

// print_r($userLogged);


/* ### Testando method Insert ### */
// $user->setName('João Grilo');
// $user->setLogin('jgrilo');
// $user->setPassword(md5('secreta'));

// $user->insert();
// echo $user; //Call magic method __toString() 


/* ### Testando method Update ### */
// $user->loadUser(3);
// echo $user;

// $user->update('Sr Madruga', 'madruguinha', 'bruxa71');
// echo $user;


/* ### Testando method Update ### */
// $user->loadUser(4);
// $user->delete();

// echo $user;