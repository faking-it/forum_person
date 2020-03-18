<?php 

require "pdo.php";

$sql = "SELECT date_up, title, avatar, board_id, board_name, id_topic
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

// Effacer les articles en trop de l'onglet Random

foreach ($topics as $topic){
    if ($topic->board_id == 5){
        $topics_rdm++;
        echo $topics_rdm;
    }
}
echo $topics_rdm;
if ($topics_rdm>5){
    for ($j=5;$j<$topics_rdm;$j++){
        $sql_delete = "DELETE FROM topics WHERE board_id = 5 ORDER BY date_crea ASC LIMIT 1";
        $sth = $link->prepare($sql_delete);
        $sth->execute();
        $topics = $sth->fetchAll(PDO::FETCH_OBJ);
    }
}
?>