<?php 

require "pdo.php";
$sql = "SELECT * FROM topics ORDER BY date_crea DESC";
    $sth = $link->prepare($sql);
    $sth->execute();

    $topics = $sth->fetchAll(PDO::FETCH_OBJ);
    