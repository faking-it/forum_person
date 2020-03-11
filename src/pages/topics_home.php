<?php 

require "pdo.php";

$sql = "SELECT date_up, title, avatar, board_id, board_name
FROM topics 
INNER JOIN users ON topics.user_id = users.id_user
INNER JOIN boards ON topics.board_id = boards.id_board
ORDER BY date_up DESC";

    $sth = $link->prepare($sql);
    $sth->execute();

    $topics = $sth->fetchAll(PDO::FETCH_OBJ);
    $nbr_lignes = count($topics);



$sql = "SELECT *
FROM boards";

    $sth = $link->prepare($sql);
    $sth->execute();

    $boards = $sth->fetchAll(PDO::FETCH_OBJ);
    