<?php
require "../pdo.php";
      /*   
       if(isset($_REQUEST["id_topic"])){
        $topic_id   =  intval($_REQUEST["id_topic"]);
        $sql_com="SELECT C.comment, C.date, U.pseudo
        FROM comments AS C
        INNER JOIN users AS U
        ON C.user_id=U.id_user
        INNER JOIN topics AS T 
        ON T.id_topic=C.topic_id
        WHERE T.id_topic=:id_topic";

        $req=$link->prepare($sql_com);
        $req->bindValue(':id_topic',           $id_topic,              PDO::PARAM_INT);
        $req->execute();
       
        
       } */
       
       if(isset($_REQUEST["id_topic"])){
        $topic_id   =  intval($_REQUEST["id_topic"]);
        $sql_com="SELECT C.comment, C.date, U.pseudo
        FROM comments AS C
        INNER JOIN users AS U
        ON C.user_id=U.id_user
        INNER JOIN topics AS T 
        ON T.id_topic=C.topic_id
        WHERE T.id_topic=:id_topic";

        $req=$link->prepare($sql_com);
        $req->bindValue(':id_topic',           $id_topic,              PDO::PARAM_INT);
        $req->execute();
       
        
       } 
    ?>