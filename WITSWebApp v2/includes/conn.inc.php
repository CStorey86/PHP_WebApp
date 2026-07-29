<?php

$dsn = 'mysql:host=localhost;dbname=b7035879_db2';
$user = 'b7035879';
$password = 'magpie55';

try {
$pdo = new PDO($dsn, $user, $password);
$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo ->exec("SET CHARACTER SET utf8");
}
catch (PDOException $e) {
echo 'Connection failed again: ' . $e->getMessage();
}

?>