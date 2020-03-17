<?php

$host   = "g4yltwdo6z0izlm6.chr7pe7iynqr.eu-west-1.rds.amazonaws.com";
$user   = "bmrdiz3f0jm6kh4g";
$pass   = "k6kuc4z9jkjal81t";
$dbname = "p92u6s9jlpuzov62";

$dsn = "mysql:host=$host;dbname=$dbname";

$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4");

try {
    $link= new \PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e){
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}


// Connection aux tables de la base de données 'test'
$tables = array(
    "users",
    "boards",
    "topics",
    "comments");

?>