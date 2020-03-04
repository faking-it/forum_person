<?php
require "../pdo.php";
session_start();

$sql_logs = "UPDATE logs
SET (user_id,status)
VALUES (:user_id,:status);";

 $stmnt = $link->prepare($sql_logs);
 $stmnt->bindValue(':user_id',        $user_id,            PDO::PARAM_INT);
 $stmnt->bindValue(':status',          false,              PDO::PARAM_STR);
 $stmnt->execute();
$_SESSION = array();

session_destroy();
header("Location: connexion.php");
?>