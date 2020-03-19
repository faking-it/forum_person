<?php
session_start();
define("PATH", "./");
require PATH . "header.php";
require_once "./parsedown-1.7.4/Parsedown.php";
?>
<?php
/* php requete side by berthold
* nous selectionons sur base de l'id topic
*/
include "../pdo.php";
if (isset($_GET['id_topic']) and is_numeric($_GET['id_topic']) and $_GET['id_topic'] > 0) {
    $id_topic = $_GET['id_topic'];
    $sql2 = ("SELECT  id_topic, title, content, topics.date_crea , topics.date_up,  board_name 
            AS categorie, users.id_user, pseudo
            FROM topics
            INNER JOIN users ON users.id_user= topics.user_id
            INNER JOIN boards ON topics.board_id = boards.id_board
            WHERE id_topic=:id_topic;");
    $requete = $link->prepare($sql2);
    $requete->bindvalue(':id_topic', $id_topic, PDO::PARAM_INT);
    $requete->execute();

    $requete->rowCount();
    $topic_infos = $requete->rowCount();

    if ($topic_infos == 1) {
        $topic_infos = $requete->fetch();
    } else {
        $message = " #erreur sql info article# ";
    }
} else {
    $message =  " id_topic doit être numeric et non vide";
} 
?>

<div class="conteneur">
    <?php
    if (isset($message)) {
        echo "<font color='red'>" . $message . "</font>";
    }
    ?>
    <h1>Titre du L'article : <?php echo $topic_infos['title']; ?></h1> <br>
    <div class="card text-white bg-primary mb-3" style="max-width: 600px;">
        <div class="card-header">Titre du topic :<?php echo $topic_infos['title']; ?> <br>
            Ecrit par <h4><?php echo $topic_infos['pseudo']; ?></h4> Le <?php echo $topic_infos['date_crea']; ?></div>
            <div class="card-body">
                <p class="card-text">Catégorie: <?php echo $topic_infos['categorie']; ?></p>

                <h5 class="card-title"><?php echo $topic_infos['content']; ?></h5>
                <p class="card-text">Date de création du topic : <?php echo $topic_infos['date_crea']; ?></p>
                <p class="card-text">Date de mise à jour : <?php echo $topic_infos['date_up']; ?></p>
                <!-- <p class="card-text">Date de mise à jour : <?php echo $topic_infos['id_user']; ?></p>-->
            </div>
        <div>

        </div>
    </div>
    </ol>

    <!-- Ajoutez un commentaire 
            je récupère en premier id du topic et id de l'user qui ajoute un commentaire
        -->
    <?php
    //envoie commentaire
    if (isset($_POST['send_comment'])) {
        $user_id   =       intval($_POST['user_id']);
        $topic_id  =       intval($_POST['topic_id']);
        $comment   =       htmlspecialchars($_POST['content']);

        $user_id    =   $_SESSION["id"];
        $topic_id   =   $topic_infos['id_topic'];
     
        #la condition if pour conditionner tous les parametres rentrés 'user_id' 'comment' 'comment2' 'password' 'password2'
        if (
            !empty($user_id)
            and !empty($topic_id)
            and !empty($comment)

        ) {
            $sql_inst = "INSERT 
                        INTO `comments` ( `content`, `user_id`, `topic_id`) 
                        VALUES (? , ? , ? );";
            $stmnt = $link->prepare($sql_inst);
            $stmnt->execute(array($comment, $user_id, $topic_id));
            if ($stmnt && $stmnt->rowCount() == 1) {
                $message = "Votre commentaire a été bien ajouté ... merci!";
            } else {
                $message = 'error 404';
                $message = 'Problème de réseau, recommencer si le problème persiste veuiller contacter l\'équipe Person :hamilton 3.19';
            }
        } else {
            $message = "Ajouter un commentaire!";
        }
    }

    ?>

    <div class="commentaire">
        <div class="">
            <h3>Ajouter un commentaire</h3>
            <?php
            if (isset($message)) {
                echo "<font color='red'>" . $message . "</font>";
            }
            ?>
            <form method="POST">
                <!-- <label>Nouveau Commentaire</label>  --><br>
                <div class="lead emoji-picker-container ajout_comment">
                    <input name="content" type="text" placeholder="Ajouter un commentaire" 
                    data-emojiable="true" data-emoji-input="unicode" /><br>
                    <input type="submit" name="send_comment" value="Ajouter un commentaire">
                </div>

            </form>
        </div>
        <!-- deleted commentaire -->
        <?php
        if (isset($_REQUEST["id_comments"]) and $_SESSION["id"] != "") {
            $id_comment   = intval($_REQUEST["id_comments"]);
            $sql_delete = ("UPDATE comments
                            SET content ='deleted'
                            WHERE id_comment=?;");
            $requete = $link->prepare($sql_delete);
            //$requete->bindvalue(':id_topic', $id_topic, PDO::PARAM_INT);
            $requete->execute(array($id_comment));
            //var_dump($requete->execute());
            if ($requete && $requete->rowCount() > 0) {
                if (isset($_SESSION["id"])) {
                      $message = 'le commentaire  n° ' . $id_comment . ' a été bien effacé';
                }
            } else {
                $message = 'erreur sql test';
            }
        }

        ?>
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
            
            //echo $comment['comment'] ;
        }
        ?>
        
        
    </div> <br>

    <h4>Liste des commentaires</h4>
    <div class="" >
    
        <ul class="list-group">
            <?php  while ($comment = $req->fetch()) {
                $Parsedown = new Parsedown();
                $content = $comment['content'];
                $content= $Parsedown->text($content);?> 
               
            <li class=" list-group-item d-flex justify-content-between align-items-center li_edit_comment">
                <div><span class="badge badge-primary badge-pill"><?php  echo $content; ?></span></div> 
                <div class="pseudo"> <br>
                    <span> 
                    <strong>Ecrit par</strong> : <?php echo $comment["pseudo"];?> </span>
                </div>   

                <div>
                    <form method="post">
                        <button type="submit" value="<?php echo $comment["id_comment"];?>" name="id_comments" class="<?php if($comment['content']=='deleted'){echo "";}else{echo "btn btn-danger";} ?>">
                        <?php if($comment['content']=='deleted'){echo "";}else{echo "Effacer";} ?></button> 
                        <button type="button"  name="comment_edit" class="<?php if($comment['content']=='deleted'){echo "";}else{echo "btn btn-primary";} ?>"
                        data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <?php if($comment['content']=='deleted'){echo "";}else{echo "Editer";} ?></button> 
                    </form> <!-- <a href="" class="btn btn-secondary">Répondre</a> -->
                 </div>
               
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                    <div class="commentaire">
        <div class="">
            <h3>Editer le Commentaire</h3>
            <?php
            if (isset($message_edit)) {
                echo "<font color='red'>" . $message . "</font>";
            }
            ?>
            <form method="POST">
                <!-- <label>Nouveau Commentaire</label>  --><br>
                <div class="lead emoji-picker-container ajout_comment">
                    <input name="content" type="text" placeholder="Ajouter un commentaire" 
                    data-emojiable="true" data-emoji-input="unicode" /><br>
                    <input type="submit" name="form_edit_comment" value="Ajouter un commentaire">
                </div>

            </form>
        </div> </div>
                </div>
                     
            </li> 
        <?php } ?>
        </ul>
    </div>

    
                     
    
</div>



<?php
require PATH . "footer.php";
?>