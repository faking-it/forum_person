<?php
session_start();
define("PATH", "./");
require "../pdo.php";
require PATH . "header.php";
require_once "./parsedown-1.7.4/Parsedown.php";
?>
<div class="commentaire">
<div class="form">
    <h3>Ajouter un commentaire</h3>
    <?php
    if (isset($message)) {
        echo "<font color='red'>" . $message . "</font>";
    }
    ?>
    <form method="POST">
        <!-- <label>Nouveau Commentaire</label>  --><br>
        <div class="lead emoji-picker-container">
            <input name="content" type="text" placeholder="Ajouter un commentaire" data-emojiable="true" 
            data-emoji-input="unicode" /><br>
            <input type="submit" name="send_comment" value="Ajouter un commentaire">
        </div>

    </form>
</div>
<!-- select commentaires -->
<?php
$topic_id   =   $topic_infos['id_topic'];

if (isset($_REQUEST["id_topic"])) {
    $topic_id   =  intval($_REQUEST["id_topic"]);
    $sql_com = "SELECT DISTINCT C.id_comment, C.content, C.date, U.pseudo
        FROM comments AS C
        INNER JOIN users AS U
        ON C.user_id=U.id_user
        INNER JOIN topics AS T 
        ON T.id_topic=C.topic_id
        WHERE T.id_topic=:id_topic
        ORDER BY date DESC";

    $req = $link->prepare($sql_com);
    $req->bindValue(':id_topic',           $id_topic,              PDO::PARAM_INT);
    $req->execute();
    //var_dump($req->execute());
    //$comment=$req->fetch();
    //echo $comment['comment'] ;
}
?>
<!-- deleted commentaire -->
<?php
if (isset($_REQUEST["id_comment"]) and $_SESSION["id"] != "") {
    $id_comment   = intval($_REQUEST["id_comment"]);
    $sql_delete = ("DELETE  
            FROM comments
            WHERE id_comment=?;");
    $requete = $link->prepare($sql_delete);
    //$requete->bindvalue(':id_topic', $id_topic, PDO::PARAM_INT);
    $requete->execute(array($id_comment));
    //var_dump($requete->execute());
    if ($requete && $requete->rowCount() > 0) {
        if (isset($_SESSION["id"])) {
            echo  $message = 'le commentaire  n° ' . $id_comment . ' a été bien effacé';
            //header('Location: http://localhost/index.php'); ;
        }
    } else {
        //$message_del = 'error';
        if (isset($_SESSION["id"])) {
            //echo $message = 'erreur sql';
            //header("Location:index.php");
        }
    }
}
?>
<h4>Liste des commentaires</h4>
<div class="modal-header">
                                    <h5 class="modal-title"> contenu :<?php 
                                    //$Parsedown = new Parsedown();
                                   /*  $content = $comment['content'];
                                    $content= $Parsedown->text($content); */
                                   // echo $content; 
                                   echo "test".$comment["content"]; 
                                   var_dump("test");?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
</div>

