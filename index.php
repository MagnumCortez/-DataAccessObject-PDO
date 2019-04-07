<?php

require_once("config.php");

$conn = new ConnectionDAO();

$sql = "SELECT * FROM users;";

$users = $conn->select($sql);

echo json_encode($users);